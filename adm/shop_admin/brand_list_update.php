<?php
$sub_menu = "400380";
require_once './_common.php';

check_demo();

if (!(isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$br_datas = array();
$msg = '';

if ($_POST['act_button'] == "선택수정") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_br_no = (isset($_POST['br_no'][$k]) && $_POST['br_no'][$k]) ? (int)$_POST['br_no'][$k] : 0;
        $post_br_name = (isset($_POST['br_name'][$k]) && $_POST['br_name'][$k]) ? strip_tags(clean_xss_attributes($_POST['br_name'][$k])) : '';

        $sql = "SELECT *
            FROM {$g5['g5_shop_brand_table']}
            WHERE br_no = '{$post_br_no}'
            LIMIT 0, 1 ";
        $br_datas[] = $br = sql_fetch($sql);

        if (!(isset($br['br_no']) && $br['br_no'])) {
            $msg .= $br['br_no'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = " UPDATE {$g5['g5_shop_brand_table']}
                SET br_name = '{$post_br_name}'
                WHERE br_no = '{$br['br_no']}' ";
            sql_query($sql);
        }
    }
} elseif ($_POST['act_button'] == "선택삭제") {
    for($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_br_no = (isset($_POST['br_no'][$k]) && $_POST['br_no'][$k]) ? (int)$_POST['br_no'][$k] : 0;

        $sql = "SELECT *
            FROM {$g5['g5_shop_brand_table']}
            WHERE br_no = '{$post_br_no}'
            LIMIT 0, 1 ";
        $br_datas[] = $br = sql_fetch($sql);

        if (!$br['br_no']) {
            $msg .= $br['br_no'] . ' : 자료가 존재하지 않습니다.\\n';
        } else {
            $sql = "DELETE
                FROM {$g5['g5_shop_brand_table']}
                WHERE br_no = '{$br['br_no']}' ";
            sql_query($sql);
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

run_event('admin_brand_list_update', $_POST['act_button'], $br_datas);

goto_url('./brand_list.php?' . $qstr);
