<?php
$sub_menu = '100610';
require_once './_common.php';

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';
$ch_id = isset($_POST['ch_id']) && $_POST['ch_id'] ? (int)$_POST['ch_id'] : 0;
$ch_host = isset($_POST['ch_host']) && $_POST['ch_host'] ? trim($_POST['ch_host']) : '';

if ($w == '') {
    $sql = " SELECT *
        FROM {$g5[channel_host_table]}
        WHERE ch_host = '{$ch_host}'
        LIMIT 0, 1 ";
    $ch = sql_fetch($sql);
    if (isset($ch['ch_host']) && $ch['ch_host']) {
        alert('이미 존재하는 HOST 입니다.', './channelhost_form.php?cn_id='.$cn_id);
    }

    if (!$ch_host) {
        alert('정확한 HOST를 입력하세요.'.$ch_host, './channelhost_form.php?cn_id='.$cn_id);
    }

    $sql = " INSERT INTO {$g5['channel_host_table']}
        SET cn_id = '{$cn_id}',
            ch_host = '{$ch_host}' ";
    sql_query($sql);

    $ch_id = sql_insert_id();
} else if ($w == 'u') {
    if (!$ch_id) {
        alert('잘못된 실행입니다.');
    }

    $sql = " SELECT *
        FROM {$g5[channel_host_table]}
        WHERE ch_host = '{$ch_host}'
        LIMIT 0, 1 ";
    $ch = sql_fetch($sql);
    if (isset($ch['ch_host']) && $ch['ch_host'] && $ch['ch_id'] != $ch_id) {
        alert('이미 존재하는 HOST 입니다.', './channelhost_form.php?ch_id='.$ch_id);
    }

    $sql = " UPDATE {$g5['channel_host_table']}
        SET ch_host = '{$ch_host}'
        WHERE ch_id = '{$ch_id}' ";
    sql_query($sql);
} else if ($w == 'd') {
    if (!$ch_id) {
        alert('잘못된 실행입니다.');
    }

    $sql = " DELETE
        FROM {$g5[channel_host_table]}
        WHERE ch_id = '{$ch_id}' ";
    sql_query($sql);
} else {
    alert();
}

if ($w == 'd') {
    goto_url('./channelhost_list.php'.$qstr);
} else {
    goto_url('./channelhost_form.php?'.$qstr.'&amp;w=u&amp;ch_id='.$ch_id);
}