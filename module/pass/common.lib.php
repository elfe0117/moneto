<?php
if (!defined('_GNUBOARD_')) exit;

// 파라메터 프로필 구하기
function get_profile_id_parameter() {
    return isset($_REQUEST['pfid']) && !is_array($_REQUEST['pfid']) && $_REQUEST['pfid'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['pfid'])) : '';
}

// 파라메터 디스플레이 구하기
function get_display_parameter() {
    return isset($_REQUEST['dp']) && !is_array($_REQUEST['dp']) && $_REQUEST['dp'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['dp'])) : '';
}

// 프로필 구하기
function get_profile($pfid) {
    global $g5;

    $sql = " SELECT *
        FROM {$5['profile_table']}
        WHERE pf_id = '{$pfid}'
        LIIMIT 0, 1 ";
    return sql_fetch($sql);
}