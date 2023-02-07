<?php
$sub_menu = '100610';
require_once './_common.php';

$cn_id = isset($_POST['cn_id']) ? trim($_POST['cn_id']) : '';

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$cn_name = isset($_POST['cn_name']) ? strip_tags(clean_xss_attributes($_POST['cn_name'])) : '';
$cg_id = isset($_POST['cg_id']) ? (int)$_POST['cg_id'] : 0;

$sql_common = "
    cn_name = '{$cn_name}',
    cg_id = '{$cg_id}' ";

if ($w == '') {
    $cn = sql_fetch("SELECT * FROM {$g5['channel_table']} WHERE cn_id = '{$cn_id}' ");
    if (isset($cn['cn_id']) && $cn['cn_id']) {
        alert('이미 존재하는 정보입니다.');
    }

    $sql = "INSERT INTO {$g5['channel_table']}
        SET {$sql_common}
            , cn_id = '{$cn_id}' ";
    sql_query($sql);
} else if ($w == 'u') {
    $sql = "UPDATE {$g5['channel_table']}
        SET {$sql_common}
        WHERE cn_id = '{$cn_id}' ";
    sql_query($sql);
} else if ($w == 'd') {
    $sql = "DELETE FROM {$g5['channel_table']} WHERE cn_id = '{$cn_id}' ";
    sql_query($sql);
}

if ($w == 'd') {
    goto_url('./channel_list.php'.$qstr);
} else {
    goto_url('./channel_form.php?'.$qstr.'&amp;w=u&amp;cn_id='.$cn_id);
}