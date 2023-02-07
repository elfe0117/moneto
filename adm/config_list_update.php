<?php
$sub_menu = "100100";
require_once './_common.php';

check_demo();

if (!(isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$cf_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택수정") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_cf_title = (isset($_POST['cf_title'][$k]) && $_POST['cf_title'][$k]) ? strip_tags(clean_xss_attributes($_POST['cf_title'][$k])) : '';
        $post_cf_admin_email = (isset($_POST['cf_admin_email'][$k]) && $_POST['cf_admin_email'][$k]) ? strip_tags(clean_xss_attributes($_POST['cf_admin_email'][$k])) : '';

        $sql = "SELECT *
            FROM {$g5['config_table']}
            WHERE cn_id = '{$_POST['cn_id'][$k]}'
            LIMIT 0, 1 ";
        $cf_datas[] = $cf = sql_fetch($sql);

        if (!(isset($cf['cn_id']) && $cf['cn_id'])) {
            $msg .= $cf['cn_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = " UPDATE {$g5['config_table']}
                SET cf_title = '{$post_cf_title}',
                    cf_admin_email = '{$post_cf_admin_email}'
                WHERE cn_id = '".sql_real_escape_string($cf['cn_id'])."' ";
            sql_query($sql);
        }
    }
} elseif ($_POST['act_button'] == "선택삭제") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // 환경설정과 채널정보를 한세트로 산택삭제시 채널의 사용여부를 수정한다.
        $sql = "SELECT *
            FROM {$g5['channel_table']}
            WHERE cn_id = '{$_POST['cn_id'][$k]}'
            LIMIT 0, 1 ";
        $cf_datas[] = $cf = sql_fetch($sql);

        if (!$cf['cn_id']) {
            $msg .= $cf['cn_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            $sql = " UPDATE {$g5['channel_table']}
                SET cn_use = 0
                WHERE cn_id = '".sql_real_escape_string($cf['cn_id'])."' ";
            sql_query($sql);
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

run_event('admin_config_list_update', $_POST['act_button'], $cf_datas);

goto_url('./config_list.php?' . $qstr);
