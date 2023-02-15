<?php
$sub_menu = '500300';
include_once('./_common.php');

if ($w == "u" || $w == "d")
    check_demo();

if ($w == 'd')
    auth_check_menu($auth, $sub_menu, "d");
else
    auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

$cn_id = (isset($_REQUEST['cn_id']) && $_REQUEST['cn_id']) ? preg_replace('/[^a-z0-9_]/i', '', (string)$_REQUEST['cn_id']) : '';
if (!$cn_id) {
    alert('채널 ID는 반드시 선택하세요.');
}

$event_path = G5_DATA_PATH.'/event';

@mkdir($event_path, G5_DIR_PERMISSION);
@chmod($event_path, G5_DIR_PERMISSION);

$ev_mimg_del = isset($_POST['ev_mimg_del']) ? (int) $_POST['ev_mimg_del'] : 0;
$ev_himg_del = isset($_POST['ev_himg_del']) ? (int) $_POST['ev_himg_del'] : 0;
$ev_timg_del = isset($_POST['ev_timg_del']) ? (int) $_POST['ev_timg_del'] : 0;

$ev_skin = isset($_POST['ev_skin']) ? clean_xss_tags($_POST['ev_skin'], 1, 1) : '';
$ev_mobile_skin = isset($_POST['ev_mobile_skin']) ? clean_xss_tags($_POST['ev_mobile_skin'], 1, 1) : '';

$ev_img_width = isset($_POST['ev_img_width']) ? (int) $_POST['ev_img_width'] : 0;
$ev_img_height = isset($_POST['ev_img_height']) ? (int) $_POST['ev_img_height'] : 0;
$ev_list_mod = isset($_POST['ev_list_mod']) ? (int) $_POST['ev_list_mod'] : 0;
$ev_list_row = isset($_POST['ev_list_row']) ? (int) $_POST['ev_list_row'] : 0;
$ev_mobile_img_width = isset($_POST['ev_mobile_img_width']) ? (int) $_POST['ev_mobile_img_width'] : 0;
$ev_mobile_img_height = isset($_POST['ev_mobile_img_height']) ? (int) $_POST['ev_mobile_img_height'] : 0;
$ev_mobile_list_mod = isset($_POST['ev_mobile_list_mod']) ? (int) $_POST['ev_mobile_list_mod'] : 0;
$ev_mobile_list_row = isset($_POST['ev_mobile_list_row']) ? (int) $_POST['ev_mobile_list_row'] : 0;
$ev_use = isset($_POST['ev_use']) ? (int) $_POST['ev_use'] : 0;
$ev_subject_strong = isset($_POST['ev_subject_strong']) ? (int) $_POST['ev_subject_strong'] : 0;

$ev_subject = isset($_POST['ev_subject']) ? clean_xss_tags($_POST['ev_subject'], 1, 1) : '';
$ev_head_html = isset($_POST['ev_head_html']) ? $_POST['ev_head_html'] : '';
$ev_tail_html = isset($_POST['ev_tail_html']) ? $_POST['ev_tail_html'] : '';

if ($ev_mimg_del)  @unlink($event_path."/{$ev_id}_m");
if ($ev_himg_del)  @unlink($event_path."/{$ev_id}_h");
if ($ev_timg_del)  @unlink($event_path."/{$ev_id}_t");

$ev_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_skin);
$ev_mobile_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_mobile_skin);

$skin_regex_patten = "^list.[0-9]+\.skin\.php";

$ev_skin = (preg_match("/$skin_regex_patten/", $ev_skin) && file_exists(G5_SHOP_SKIN_PATH.'/'.$ev_skin)) ? $ev_skin : ''; 
$ev_mobile_skin = (preg_match("/$skin_regex_patten/", $ev_mobile_skin) && file_exists(G5_MSHOP_SKIN_PATH.'/'.$ev_mobile_skin)) ? $ev_mobile_skin : ''; 
$ev_subject = strip_tags($ev_subject);

$sql_common = " set ev_skin             = '$ev_skin',
                    ev_mobile_skin      = '$ev_mobile_skin',
                    ev_img_width        = '$ev_img_width',
                    ev_img_height       = '$ev_img_height',
                    ev_list_mod         = '$ev_list_mod',
                    ev_list_row         = '$ev_list_row',
                    ev_mobile_img_width = '$ev_mobile_img_width',
                    ev_mobile_img_height= '$ev_mobile_img_height',
                    ev_mobile_list_mod  = '$ev_mobile_list_mod',
                    ev_mobile_list_row  = '$ev_mobile_list_row',
                    ev_subject          = '$ev_subject',
                    ev_head_html        = '$ev_head_html',
                    ev_tail_html        = '$ev_tail_html',
                    ev_use              = '$ev_use',
                    ev_subject_strong   = '$ev_subject_strong'
                    ";

if ($w == "")
{
    $ev_id = G5_SERVER_TIME;

    $sql = " INSERT INTO {$g5['g5_shop_event_table']}
                    {$sql_common}
                  , ev_id = '$ev_id'
                  , cn_id = '{$cn_id}' ";
    sql_query($sql);
}
else if ($w == "u")
{
    $sql = " UPDATE {$g5['g5_shop_event_table']}
                {$sql_common}
              WHERE ev_id = '$ev_id' ";
    sql_query($sql);
}
else if ($w == "d")
{
    @unlink($event_path."/{$ev_id}_m");
    @unlink($event_path."/{$ev_id}_h");
    @unlink($event_path."/{$ev_id}_t");

    // 이벤트상품삭제
    $sql = " delete from {$g5['g5_shop_event_item_table']} where ev_id = '$ev_id' ";
    sql_query($sql);

    $sql = " delete from {$g5['g5_shop_event_table']} where ev_id = '$ev_id' ";
    sql_query($sql);
}

if ($w == "" || $w == "u")
{
    if ($_FILES['ev_mimg']['name']) upload_file($_FILES['ev_mimg']['tmp_name'], $ev_id."_m", $event_path);
    if ($_FILES['ev_himg']['name']) upload_file($_FILES['ev_himg']['tmp_name'], $ev_id."_h", $event_path);
    if ($_FILES['ev_timg']['name']) upload_file($_FILES['ev_timg']['tmp_name'], $ev_id."_t", $event_path);

    // 등록된 이벤트 상품 먼저 삭제
    $sql = " delete from {$g5['g5_shop_event_item_table']} where ev_id = '$ev_id' ";
    sql_query($sql);

    // 이벤트 상품등록
    $item = explode(',', $ev_item);
    $count = count($item);

    for($i=0; $i<$count; $i++) {
        $it_id = isset($item[$i]) ? $item[$i] : '';
        if($it_id) {
            $sql = " insert into {$g5['g5_shop_event_item_table']}
                        set ev_id = '$ev_id',
                            it_id = '$it_id' ";
            sql_query($sql);
        }
    }

    goto_url("./itemeventform.php?w=u&amp;ev_id=$ev_id");
}
else
{
    goto_url("./itemevent.php");
}