<?php
if (!defined('_GNUBOARD_')) exit;

// 파라메터 채널 구하기
function get_channel_id_parameter() {
    return isset($_REQUEST['cid']) && !is_array($_REQUEST['cid']) && $_REQUEST['cid'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['cid'])) : '';
}

// 세션 채널 ID 구하기
function get_channel_id_session() {
    return (isset($_SESSION['ss_cid']) && $_SESSION['ss_cid']) ? $_SESSION['ss_cid'] : '';
}

// 채널 ID 구하기
function get_channel_id() {
    $cid = get_channel_id_parameter();
    $cid = $cid ? $cid : get_channel_id_session();
    return $cid ? $cid : G5_DEFAULT_CHANNEL;
}

// 채널 구하기
function get_channel($cid='') {
    global $g5;

    if (!$cid) {
        $cid = get_channel_id();
    }

    $sql = "SELECT *
        FROM {$g5['channel_table']}
        WHERE cn_id = '{$cid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}