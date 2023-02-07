<?php
$sub_menu = "100610";
require_once './_common.php';

check_demo();

if (!(isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$cn_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택수정") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_cn_name = (isset($_POST['cn_name'][$k]) && $_POST['cn_name'][$k]) ? strip_tags(clean_xss_attributes($_POST['cn_name'][$k])) : '';
        $post_cg_id = (isset($_POST['cg_id'][$k]) && $_POST['cg_id'][$k]) ? (int)$_POST['cg_id'][$k] : 0;

        $sql = "SELECT *
            FROM {$g5['channel_table']}
            WHERE cn_id = '{$_POST['cn_id'][$k]}'
            LIMIT 0, 1 ";
        $cn_datas[] = $cn = sql_fetch($sql);

        if (!(isset($cn['cn_id']) && $cn['cn_id'])) {
            $msg .= $cn['cn_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = " UPDATE {$g5['channel_table']}
                SET cn_name = '{$post_cn_name}',
                    cg_id = '{$post_cg_id}'
                WHERE cn_id = '".sql_real_escape_string($cn['cn_id'])."' ";
            sql_query($sql);
        }
    }
} elseif ($_POST['act_button'] == "선택삭제") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $sql = "SELECT *
            FROM {$g5['channel_table']}
            WHERE cn_id = '{$_POST['cn_id'][$k]}'
            LIMIT 0, 1 ";
        $cn_datas[] = $cn = sql_fetch($sql);

        if (!$cn['cn_id']) {
            $msg .= $cn['cn_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            $sql = " UPDATE {$g5['channel_table']}
                SET cn_use = 0
                WHERE cn_id = '".sql_real_escape_string($cn['cn_id'])."' ";
            sql_query($sql);
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

run_event('admin_channel_list_update', $_POST['act_button'], $cn_datas);

goto_url('./channel_list.php?' . $qstr);
