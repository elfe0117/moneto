<?php
$sub_menu = '400380';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$sql_common = " FROM {$g5['g5_shop_brand_table']} ";

$sql_search = " WHERE (1) ";

if (!$sst) {
    $sst = "br_no";
    $sod = "ASC";
}

$sql_order = " ORDER BY {$sst} {$sod} ";

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " SELECT *
    {$sql_common}
    {$sql_search}
    {$sql_order}
    LIMIT {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '브랜드관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$colspan = 4;
?>

<form name="fbrandlistupdate" method="post" action="./brand_list_update.php" onsubmit="return fbrandlist_submit(this);" autocomplete="off" id="fbrandlistupdate">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">상품 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col">채널</th>
                <th scope="col">브랜드 명</th>
                <th scope="col">관리</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if ($result) {
                while($row = sql_fetch_array($result)) {
                    $bg = 'bg' . ($i % 2);
            ?>
            <tr class="<?php echo($bg); ?>">
                <td class="td_chk">
                    <input type="hidden" name="br_no[<?php echo($i); ?>]" value="<?php echo($row['br_no']); ?>" id="br_no_<?php echo($i); ?>">
                    <label for="chk_<?php echo($i); ?>" class="sound_only"><?php echo(get_text($row['br_name'])); ?></label>
                    <input type="checkbox" name="chk[]" value="<?php echo($i); ?>" id="chk_<?php echo($i); ?>">
                </td>
                <td class="td_id"><?php echo($row['cn_id']); ?></td>
                <td class="td_left"><?php echo($row['br_name']); ?></td>
                <td class="td_mng">
                    <a href="./brand_form.php?<?php echo($qstr); ?>&amp;w=u&amp;br_no=<?php echo($row['br_no']); ?>" class="btn btn_03">수정</a>
                </td>
            </tr>
            <?php
                    $i++;
                }
                unset($result);
            }

            if ($i == 0) {
                echo('<tr id="empty_menu_list"><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>');
            }
            ?>
        </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="../channel_check.php?url=<?php echo(urlencode('./shop_admin/brand_form.php')); ?>" id="brand_add" class="btn btn_01">브랜드추가</a>
    <?php } ?>
</div>

</form>

<script type="text/javascript" language="javascript">
function fbrandlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if (document.pressed == "선택삭제") {
        if (!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');