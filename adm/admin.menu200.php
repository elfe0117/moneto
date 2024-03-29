<?php
$menu['menu200'] = array(
    array('200000', '회원관리', G5_ADMIN_URL . '/member_list.php', 'member'),
    array('200100', '회원관리', G5_ADMIN_URL . '/member_list.php', 'mb_list'),
    array('200300', '회원메일발송', G5_ADMIN_URL . '/mail_list.php', 'mb_mail'),
    array('200800', '접속자집계', G5_ADMIN_URL . '/visit_list.php', 'mb_visit', 1),
    array('200810', '접속자검색', G5_ADMIN_URL . '/visit_search.php', 'mb_search', 1),
    array('200820', '접속자로그삭제', G5_ADMIN_URL . '/visit_delete.php', 'mb_delete', 1),
    array('200200', '포인트관리', G5_ADMIN_URL . '/point_list.php', 'mb_point'),
    array('200900', '투표관리', G5_ADMIN_URL . '/poll_list.php', 'mb_poll')
);

$menu['menu200'][] = array('200110', '회원계보관리', G5_ADMIN_URL . '/member_chart.php', 'mb_chart');
$menu['menu200'][] = array('200150', '프로필관리', G5_ADMIN_URL . '/profile_form.php', 'pf_form');
$menu['menu200'][] = array('200190', '회원등급관리', G5_ADMIN_URL . '/level_form.php', 'mb_level');