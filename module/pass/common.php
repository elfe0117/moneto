<?php
/*
// 모듈 기본 경록
$basepath = pathinfo(__FILE__)['dirname'];
define(G5_MODULE_PASS_PATH, $basepath);

// 패스 설정
include_once(G5_MODULE_PASS_PATH.'/config.php');

// 패스 라이브러리
include_once(G5_MODULE_PASS_PATH.'/common.lib.php');

// 프로필
$profile = array();

$dp = get_display_parameter();
$pfid = get_profile_id_parameter();

$profile = get_profile($pfid);

// 관리자 여부 확인
$is_pass_admin = false;
if (isset($profile['pf_admin']) && $profile['pf_admin'] == $member['mb_id']) {
    $is_pass_admin = true;
}
*/