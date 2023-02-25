<?php
// 공통
include_once('../../common.php');

// 패스 설정
include_once('./config.php');

// 패스 라이브러리
include_once('./common.lib.php');

// 프로필
$profile = array();

$dp = get_display_parameter();
$pfid = get_profile_id_parameter();

$profile = get_profile($pfid);
?>