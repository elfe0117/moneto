<?php
$menu['menu100'] = array(
    array('100000', $lang_json['adm']['admin.menu100']['1'], G5_ADMIN_URL . '/config_list.php',   'config'),
    array('100100', $lang_json['adm']['admin.menu100']['2'], G5_ADMIN_URL . '/config_list.php',   'cf_basic'),
    array('100200', $lang_json['adm']['admin.menu100']['3'], G5_ADMIN_URL . '/auth_list.php',     'cf_auth'),
    array('100280', $lang_json['adm']['admin.menu100']['4'], G5_ADMIN_URL . '/theme.php',     'cf_theme', 1),
    array('100290', $lang_json['adm']['admin.menu100']['5'], G5_ADMIN_URL . '/menu_list.php',     'cf_menu', 1),
    array('100300', $lang_json['adm']['admin.menu100']['6'], G5_ADMIN_URL . '/sendmail_test.php', 'cf_mailtest'),
    array('100310', $lang_json['adm']['admin.menu100']['7'], G5_ADMIN_URL . '/newwinlist.php', 'scf_poplayer'),
    array('100800', $lang_json['adm']['admin.menu100']['8'], G5_ADMIN_URL . '/session_file_delete.php', 'cf_session', 1),
    array('100900', $lang_json['adm']['admin.menu100']['9'], G5_ADMIN_URL . '/cache_file_delete.php',   'cf_cache', 1),
    array('100910', $lang_json['adm']['admin.menu100']['10'], G5_ADMIN_URL . '/captcha_file_delete.php',   'cf_captcha', 1),
    array('100920', $lang_json['adm']['admin.menu100']['11'], G5_ADMIN_URL . '/thumbnail_file_delete.php',   'cf_thumbnail', 1),
    array('100500', $lang_json['adm']['admin.menu100']['12'], G5_ADMIN_URL . '/phpinfo.php',       'cf_phpinfo')
);

if (version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
    $menu['menu100'][] = array('100510', 'Browscap 업데이트', G5_ADMIN_URL . '/browscap.php', 'cf_browscap');
    $menu['menu100'][] = array('100520', '접속로그 변환', G5_ADMIN_URL . '/browscap_convert.php', 'cf_visit_cnvrt');
}

$menu['menu100'][] = array('100410', 'DB업그레이드', G5_ADMIN_URL . '/dbupgrade.php', 'db_upgrade');
$menu['menu100'][] = array('100400', '부가서비스', G5_ADMIN_URL . '/service.php', 'cf_service');

// 2023-02-06 채널관리 메뉴 추가
$menu['menu100'][] = array('100610', '채널관리', G5_ADMIN_URL . '/channel_list.php', 'cf_channel');
$menu['menu100'][] = array('100620', '채널그룹관리', G5_ADMIN_URL . '/channelgroup_list.php', 'cf_channelgroup');
$menu['menu100'][] = array('100630', '데이터베이스 재설치', G5_ADMIN_URL . '/database_install.php', 'cf_database');
