<?php
include_once('./_common.php');

$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';

if (!$cn_id) {
    die("{\"error\":\"올바른 채널ID를 입력하세요.\"}");
}

$cn = get_channel($cn_id);

if (!(isset($cn['cn_id']) && $cn['cn_id'])) {
    die("{\"error\":\"존재하지 않는 채널ID 입니다.\\n\\n채널ID : {$cn_id}\"}");

}

die("{\"error\":\"\"}"); // 정상;