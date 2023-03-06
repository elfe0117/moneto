<?php
$sub_menu = '400380';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널 ID
$cn_id = isset($_GET['cn_id']) && !is_array($_GET['cn_id']) && $_GET['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_GET['cn_id'])) : '';

$html_title = '브랜드관리';

$br = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    $br_no = isset($_GET['br_no']) && $_GET['br_no'] ? (int)$_GET['br_no'] : 0;

    $sql = " SELECT *
        FROM {$g5['g5_shop_brand_table']}
        WHERE br_id = '{$br_id}'
        LIMIT 0, 1 ";
    $br = sql_fetch($sql);
} else {
    $html_title .= ' 입력';
}

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fchannelform" id="fchannelform" method="post" onsubmit="return fchannelform_submit(this);">
    <input type="hidden" name="cn_id" value="<?php echo($cn_id); ?>">
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
                    <td><input type="text" id="cn_id" name="cn_id" value="<?php echo($br['cn_id']); ?>" required class="frm_input required"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="br_name">브랜드 명<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" id="br_name" name="br_name" value="<?php echo($br['br_name']); ?>" required class="frm_input required"></td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');