<?php
$sub_menu = '400380';
require_once './_common.php';

$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$br_no = isset($_POST['br_no']) && $_POST['br_no'] ? (int)$_POST['br_no'] : 0;
$br_name = isset($_POST['br_name']) && $_POST['br_name'] ? strip_tags(clean_xss_attributes($_POST['br_name'])) : '';

$sql_common = "
    br_name = '{$br_name}' ";

if ($w == '') {
    $sql = "INSERT INTO {$g5['g5_shop_brand_table']}
        SET {$sql_common}
            , cn_id = '{$cn_id}'
            , br_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql, false);

    $br_no = sql_insert_id();

} else if ($w == 'u') {
    $sql = "UPDATE {$g5['g5_shop_brand_table']}
        SET {$sql_common}
        WHERE br_no = '{$br_no}' ";
    sql_query($sql);
} else if ($w == 'd') {
    $sql = "DELETE FROM {$g5['g5_shop_brand_table']} WHERE br_no = '{$br_no}' ";
    sql_query($sql);
}

if ($w == 'd') {
    goto_url('./brand_list.php'.$qstr);
} else {
    goto_url('./brand_form.php?'.$qstr.'&amp;w=u&amp;br_no='.$br_no);
}