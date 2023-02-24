<?php
include_once('./_common.php');

$psid = isset($_REQUEST['psid']) && $_REQUEST['psid'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['psid'])) : '';

$sql = " SELECT *
    FROM {$g5['module_pass_table']}
    WHERE ps_id = '{$psid}'
    LIMIT 0, 1 ";
$ps = sql_fetch($sql);

var_dump($ps);
?>
<input type="text" name="ps_id" id="ps_id">