<?php
if (!defined('_GNUBOARD_')) exit;

// 프로필 구하기
function get_profile($pfid) {
    global $g5;

    $sql = " SELECT *
        FROM {$g5['profile_table']}
        WHERE pf_id = '{$pfid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}