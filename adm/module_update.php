<?php
$sub_menu = "100650";
include_once('./_common.php');
/*
if ($is_admin != 'super')
    die('최고관리자만 접근 가능합니다.');

admin_referer_check();
*/

$module = isset($_POST['module']) ? trim($_POST['module']) : '';
$module = 'pass';

$module_dir = get_module_dir();

if(!in_array($module, $module_dir)) {
    die('선택하신 모듈이 설치되어 있지 않습니다.');
}

define('G5_MODULE_INSTALL', true);

include_once(G5_PATH.'/'.G5_MODULE_DIR.'/'.$module.'/install/install.php');

run_event('adm_module_update', $module);

die('');