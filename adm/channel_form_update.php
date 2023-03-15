<?php
$sub_menu = '100610';
require_once './_common.php';

$cn_id = isset($_POST['cn_id']) && !is_array($_POST['cn_id']) && $_POST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_POST['cn_id'])) : '';

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$cn_name = isset($_POST['cn_name']) ? strip_tags(clean_xss_attributes($_POST['cn_name'])) : '';
$cg_id = isset($_POST['cg_id']) ? (int)$_POST['cg_id'] : 0;
$cn_use = isset($_POST['cn_use']) ? (int)$_POST['cn_use'] : 0;

$cf_admin = isset($_POST['cf_admin']) ? trim($_POST['cf_admin']) : '';
$cf_admin_email = isset($_POST['cf_admin_email']) ? get_email_address(trim($_POST['cf_admin_email'])) : '';

$sql_common = "
    cn_name = '{$cn_name}',
    cg_id = '{$cg_id}',
    cn_use = '{$cn_use}' ";

if ($w == '') {
    $cn = sql_fetch("SELECT * FROM {$g5['channel_table']} WHERE cn_id = '{$cn_id}' ");
    if (isset($cn['cn_id']) && $cn['cn_id']) {
        alert('이미 존재하는 정보입니다.');
    }

    crt_channel_directory($cn_id);

    $sql = "INSERT INTO {$g5['channel_table']}
        SET {$sql_common}
            , cn_id = '{$cn_id}'
            , cn_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql, false);

    sql_channel_config_insert($cn_id, $cn_name, $cf_admin, $cf_admin_email);
} else if ($w == 'u') {
    $sql = "UPDATE {$g5['channel_table']}
        SET {$sql_common}
        WHERE cn_id = '{$cn_id}' ";
    sql_query($sql);

    // 기본환경설정 정보 수정
    $sql = "UPDATE {$g5['config_table']}
        SET cf_admin = '{$cf_admin}',
            cf_admin_email = '{$cf_admin_email}'
        WHERE cn_id = '{$cn_id}' ";
    sql_query($sql);
} else if ($w == 'd') {
    del_channel($cn['cn_id']);
}

// 채널 데이터 경로
$channel_data_path = get_channel_data_path($cn_id);

if (! empty($_POST['pf_img_del']))  @unlink($channel_data_path."/common/profile_img");
if ($w == '' || $w == 'u') {
    if ($_FILES['pf_img']['name']) upload_file($_FILES['pf_img']['tmp_name'], "profile_img", $channel_data_path."/common");

    $pf_name= isset($_POST['pf_name']) ? strip_tags(clean_xss_attributes($_POST['pf_name'])) : '';
    $pf_summary = isset($_POST['pf_summary']) ? strip_tags(clean_xss_attributes($_POST['pf_summary'])) : '';

    $sql = "SELECT *
        FROM {$g5['profile_table']}
        WHERE pf_id = '{$cn_id}'
        LIMIT 0, 1 ";
    $pf = sql_fetch($sql);
    if (isset($pf['pf_id']) && $pf['pf_id']) { // 수정
        $sql = "UPDATE {$g5['profile_table']}
            SET pf_admin = '{$cf_admin}',
                pf_name = '{$pf_name}',
                pf_summary = '{$pf_summary}'
            WHERE pf_id = '{$cn_id}' ";
        sql_query($sql);
    } else { // 등록
        $sql = "INSERT INTO {$g5['profile_table']}
            SET pf_id = '{$cn_id}',
                pf_admin = '{$cf_admin}',
                pf_name = '{$pf_name}',
                pf_summary = '{$pf_summary}',
                pf_datetime = '".G5_TIME_YMDHIS."' ";
        sql_query($sql);

        $pf_id = sql_insert_id();
    }
} else if ($w == 'd') {
    $sql = "DELETE FROM {$g5['profile_table']} WHERE pf_id = '{$cn_id}' ";
    sql_query($sql);
}

if ($w == 'd') {
    goto_url('./channel_list.php'.$qstr);
} else {
    goto_url('./channel_form.php?'.$qstr.'&amp;w=u&amp;cn_id='.$cn_id);
}