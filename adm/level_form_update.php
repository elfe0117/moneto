<?php
$sub_menu = '200190';
require_once './_common.php';

$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';
/*
if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();
*/

$lv_type = (isset($_POST['lv_type']) && $_POST['lv_type']) ? strip_tags(clean_xss_attributes($_POST['lv_type'])) : '';

for($i = 0; $i < 10; $i++) {
    $post_lv_value = (isset($_POST['lv_value'][$i]) && $_POST['lv_value'][$i]) ? (int)$_POST['lv_value'][$i] : 0;
    $post_lv_name = (isset($_POST['lv_name'][$i]) && $_POST['lv_name'][$i]) ? strip_tags(clean_xss_attributes($_POST['lv_name'][$i])) : '';

    $sql = "SELECT *
        FROM {$g5['level_table']}
        WHERE cn_id = '{$cn_id}'
            AND lv_type = '{$lv_type}'
            AND lv_value = '{$post_lv_value}'
        LIMIT 0, 1 ";
    $row = sql_fetch($sql);

    if (isset($row['lv_no']) && $row['lv_no']) {
        $sql = "UPDATE {$g5['level_table']}
            SET lv_name = '{$post_lv_name}'
            WHERE lv_no = '{$row['lv_no']}' ";
        sql_query($sql);
    } else {
        $sql = "INSERT INTO {$g5['level_table']}
            SET lv_value = '{$post_lv_value}',
                lv_name = '{$post_lv_name}',
                cn_id = '{$cn_id}',
                lv_type = '{$lv_type}' ";
        sql_query($sql);
    }
}

goto_url('./level_form.php?'.$qstr.'&amp;w=u&amp;cn_id='.$cn_id);
?>