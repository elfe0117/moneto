<?php
$sub_menu = '100620';
require_once './_common.php';

$cg_id = isset($_POST['cg_id']) ? (int)$_POST['cg_id'] : 0;

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$cg_name = isset($_POST['cg_name']) ? strip_tags(clean_xss_attributes($_POST['cg_name'])) : '';
$cg_admin = isset($_POST['cg_admin']) ? strip_tags(clean_xss_attributes($_POST['cg_admin'])) : '';
$cg_use = isset($_POST['cg_use']) ? (int)$_POST['cg_use'] : 0;

$sql_common = "
    cg_name = '{$cg_name}',
    cg_admin = '{$cg_admin}',
    cg_use = '{$cg_use}' ";

if ($w == '') {
    $cg = sql_fetch("SELECT * FROM {$g5['channel_group_table']} WHERE cg_id = '{$cg_id}' ");
    if (isset($cg['cg_id']) && $cn['cg_id']) {
        alert('이미 존재하는 정보입니다.');
    }

    $sql = "INSERT INTO {$g5['channel_group_table']}
        SET {$sql_common} ";
    sql_query($sql);

    $cg_id = sql_insert_id();
} else if ($w == 'u') {
    $sql = "UPDATE {$g5['channel_group_table']}
        SET {$sql_common}
        WHERE cg_id = '{$cg_id}' ";
    sql_query($sql);
} else if ($w == 'd') {
    $sql = "DELETE FROM {$g5['channel_group_table']} WHERE cg_id = '{$cg_id}' ";
    sql_query($sql);
}

if ($w == 'd') {
    goto_url('./channelgroup_list.php'.$qstr);
} else {
    goto_url('./channelgroup_form.php?'.$qstr.'&amp;w=u&amp;cg_id='.$cg_id);
}