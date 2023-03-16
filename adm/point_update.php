<?php
$sub_menu = "200200";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();
// 채널 ID
$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';
$cn = get_channel($cn_id);
if (!(isset($cn['cn_id']) && $cn['cn_id'])) {
    alert('존재하는 채널ID가 아닙니다.', './point_list.php?', $qstr);
}

$mb_id = isset($_POST['mb_id']) ? strip_tags(clean_xss_attributes($_POST['mb_id'])) : '';
$po_point = isset($_POST['po_point']) ? (int)strip_tags(clean_xss_attributes($_POST['po_point'])) : 0;
$po_content = isset($_POST['po_content']) ? strip_tags(clean_xss_attributes($_POST['po_content'])) : '';
$expire = isset($_POST['po_expire_term']) ? preg_replace('/[^0-9]/', '', $_POST['po_expire_term']) : '';

$mb = get_member($mb_id);

if (!$mb['mb_id']) {
    alert('존재하는 회원아이디가 아닙니다.', './point_list.php?' . $qstr);
}

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point'])) {
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', './point_list.php?' . $qstr);
}

insert_point($cn_id, $mb_id, $po_point, $po_content, '@passive', $mb_id, $member['mb_id'] . '-' . uniqid(''), $expire);

goto_url('./point_list.php?' . $qstr);
