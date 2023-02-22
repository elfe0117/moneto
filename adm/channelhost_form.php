<?php
$sub_menu = "100640";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$ch_id = isset($_GET['ch_id']) && $_GET['ch_id'] ? (int)$_GET['ch_id'] : 0;

$html_title = '채널호스트관리';

$ch = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    $sql = " SELECT *
        FROM {$g5['channel_host_table']}
        WHERE ch_id = '{$ch_id}'
        LIMIT 0, 1 ";
    $ch = sql_fetch($sql);

    $cn_id = $ch['cn_id'];
} else {
    $html_title .= ' 등록';

    // 채널 ID
    $cn_id = isset($_REQUEST['cn_id']) && !is_array($_REQUEST['cn_id']) && $_REQUEST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['cn_id'])) : '';    
    $cn = get_channel($cn_id);
    if (!(isset($cn['cn_id']) && $cn['cn_id'])) {
        alert('올바른 채널 ID를 입력하세요.');
    }

    $ch['cn_id'] = $cn_id;
}

$g5['title'] = $html_title;
require_once './admin.head.php';
?>

<form name="fchannelhostform" id="fchannelhostform" method="post" onsubmit="return fchannelhostform_submit(this);">
    <input type="hidden" name="ch_id" value="<?php echo($ch_id); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="" id="token">

    <div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
        <tr>
            <th scope="row"><label for="cn_id">채널 ID<strong class="sound_only"> 필수</strong></label></th>
            <td>
                <input type="hidden" name="cn_id" id="cn_id" value="<?php echo($ch['cn_id']); ?>">
                <?php echo($ch['cn_id']); ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="ch_host">호스트<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" id="ch_host" name="ch_host" value="<?php echo($ch['ch_host']); ?>" required class="frm_input required"></td>
        </tr>
    </tbody>
    </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <a href="./channelhost_list.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>
</form>

<script type="text/javascript" language="javascript">
function fchannelhostform_submit(f) {
    f.action = "./channelhost_form_update.php";
    return true;
}
</script>
<?php
require_once './admin.tail.php';
