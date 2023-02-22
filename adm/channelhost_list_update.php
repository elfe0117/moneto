<?php
$sub_menu = "100640";
require_once './_common.php';

check_demo();

if (!(isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$ch_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택삭제") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_ch_id = (isset($_POST['ch_id'][$k]) && $_POST['ch_id'][$k]) ? (int)$_POST['ch_id'][$k] : 0;

        $sql = " SELECT *
            FROM {$g5['channel_host_table']}
            WHERE ch_id = '{$post_ch_id}'
            LIMIT 0, 1 ";
        $ch_datas[] = $ch = sql_fetch($sql);

        if (!$ch['ch_id']) {
            $msg .= $ch['ch_id'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = " DELETE FROM {$g5['channel_host_table']} WHERE ch_id = '{$post_ch_id}' ";
            sql_query($sql);
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

run_event('admin_channelhost_list_update', $_POST['act_button'], $ch_datas);

goto_url('./channelhost_list.php?' . $qstr);