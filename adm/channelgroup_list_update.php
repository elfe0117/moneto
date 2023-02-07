<?php
$sub_menu = "100620";
require_once './_common.php';

check_demo();

if (!(isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$cg_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택수정") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_cg_name = (isset($_POST['cg_name'][$k]) && $_POST['cg_name'][$k]) ? strip_tags(clean_xss_attributes($_POST['cg_name'][$k])) : '';

        $sql = "SELECT *
            FROM {$g5['channel_group_table']}
            WHERE cg_id = '{$_POST['cg_id'][$k]}'
            LIMIT 0, 1 ";
        $cg_datas[] = $cg = sql_fetch($sql);

        if (!(isset($cg['cg_id']) && $cg['cg_id'])) {
            $msg .= $cg['cg_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = " UPDATE {$g5['channel_group_table']}
                SET cg_name = '{$post_cg_name}'
                WHERE cg_id = '".sql_real_escape_string($cg['cg_id'])."' ";
            sql_query($sql);
        }
    }
} elseif ($_POST['act_button'] == "선택삭제") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $sql = "SELECT *
            FROM {$g5['channel_group_table']}
            WHERE cg_id = '{$_POST['cg_id'][$k]}'
            LIMIT 0, 1 ";
        $cg_datas[] = $cg = sql_fetch($sql);

        if (!$cg['cg_id']) {
            $msg .= $cg['cg_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            $sql = " UPDATE {$g5['channel_group_table']}
                SET cg_use = 0
                WHERE cg_id = '".sql_real_escape_string($cg['cg_id'])."' ";
            sql_query($sql);
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

run_event('admin_channelgroup_list_update', $_POST['act_button'], $cg_datas);

goto_url('./channelgroup_list.php?' . $qstr);
