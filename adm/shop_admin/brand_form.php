<?php
$sub_menu = '400380';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$br_no = isset($_GET['br_no']) && $_GET['br_no'] ? (int)$_GET['br_no'] : 0;

$html_title = '브랜드관리';

$br = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    

    $sql = " SELECT *
        FROM {$g5['g5_shop_brand_table']}
        WHERE br_no = '{$br_no}'
        LIMIT 0, 1 ";
    $br = sql_fetch($sql);
} else {
    $html_title .= ' 입력';
}

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fbrandform" id="fbrandform" method="post" autocomplete="off" onsubmit="return fbrandform_submit(this);">
    <input type="hidden" name="br_no" value="<?php echo($br_no); ?>">
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
                    <th scope="row"><label for="br_name">브랜드 명<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" id="br_name" name="br_name" value="<?php echo($br['br_name']); ?>" required class="frm_input required"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <a href="./brand_list.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>
</form>

<script type="text/javascript" language="javascript">
function fbrandform_submit(f) {
    f.action = "./brand_form_update.php";
    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');