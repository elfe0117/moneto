<?php
if (!defined('_GNUBOARD_')) exit;

// 파라메터 채널 구하기
function get_channel_id_parameter() {
    return isset($_REQUEST['cid']) && !is_array($_REQUEST['cid']) && $_REQUEST['cid'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['cid'])) : '';
}

// 세션 채널 ID 구하기
function get_channel_id_session() {
    return (isset($_SESSION['ss_cid']) && $_SESSION['ss_cid']) ? $_SESSION['ss_cid'] : '';
}

// 채널 ID 구하기
function get_channel_id() {
    $cid = get_channel_id_parameter();
    $cid = $cid ? $cid : get_channel_id_session();
    return $cid ? $cid : G5_DEFAULT_CHANNEL;
}

// 채널 구하기
function get_channel($cid='') {
    global $g5;

    if (!$cid) {
        $cid = get_channel_id();
    }

    $sql = "SELECT *
        FROM {$g5['channel_table']}
        WHERE cn_id = '{$cid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}

// 채널 데이터 경로 구하기
function get_channel_data_path($cid) {
    $data_path = G5_CHANNEL_PATH.'/'.$cid.'/'.G5_STORAGE_DIR;
    return $data_path;
}

// 채널 데이터 URL 구하기
function get_channel_data_url($cid, $is_channel=true) {
    $data_url = '';

    if ($is_channel) {
        $data_url = G5_URL.'/data';
    } else {
        $data_url = G5_CHANNEL_URL.'/'.$cid.'/'.G5_STORAGE_DIR;
    }
    return $data_url;
}

// 채널 생성
function crt_channel($cid) {
    // 채널 디렉토리 생성
    $channel_path = G5_CHANNEL_PATH.'/'.$cid;

    @mkdir($channel_path, G5_DIR_PERMISSION);
    @chmod($channel_path, G5_DIR_PERMISSION);

    // 채널 데이터 디렉토리 생성
    $channel_data_path = $channel_path.'/'.G5_STORAGE_DIR;
    @mkdir($channel_data_path, G5_DIR_PERMISSION);
    @chmod($channel_data_path, G5_DIR_PERMISSION);

    // 채널 데이터 하위 디렉토리 생성
    $sub_dir = array ('cache','editor','file','log','member','member_image','session','content','faq','tmp','banner','common','event','item');
    foreach($sub_dir as $dir_name) {
        $channel_data_sub_path = $channel_data_path.'/'.$dir_name;
        @mkdir($channel_data_sub_path, G5_DIR_PERMISSION);
        @chmod($channel_data_sub_path, G5_DIR_PERMISSION);
    }
}

// 채널 삭제
function del_channel($cid) {
    global $g5;

    $sql = "UPDATE {$g5['channel_table']}
        SET cn_use = 0
        WHERE cn_id = '{$cid}' ";
    sql_query($sql);

    // 폴더 전체 삭제
    $channel_path = G5_CHANNEL_PATH.'/'.$cid;
    //rm_rf($channel_path);
}

// 채널그룹 구하기
function get_channelgroup($cgid) {
    global $g5;

    $sql = "SELECT *
        FROM {$g5['channel_group_table']}
        WHERE cg_id = '{$cgid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}

// 채널그룹 목록 구하기
function get_channelgroup_list() {
    global $g5;

    $array_result = array();

    $sql = "SELECT *
        FROM {$g5['channel_group_table']}
        WHERE cg_use = '1'
        ORDER BY cg_name ASC ";
    $result = sql_query($sql);
    if ($result) {
        while($row = sql_fetch_array($result)) {
            array_push($array_result, $row);
        }
        unset($result);
    }

    return count($array_result) ? $array_result : NULL;
}