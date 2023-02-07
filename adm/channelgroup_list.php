<?php
$sub_menu = "100620";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널그룹 목록 정보
$sql_common = " FROM {$g5['channel_group_table']} ";

$sql_search = " WHERE (1) ";

if (!$sst) {
    $sst = "cg_name";
    $sod = "ASC";
}

$sql_order = " ORDER BY {$sst} {$sod} ";

$sql = " SELECT COUNT(*) AS cnt
    {$sql_common}
    {$sql_search}
    {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "SELECT *
    {$sql_common}
    {$sql_search}
    {$sql_order}
    LIMIT {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = "채널그룹관리";
require_once './admin.head.php';

$colspan = 5;
?>
<form name="fchannelgrouplist" id="fchannelgrouplist" method="post" action="./channelgroup_list_update.php" onsubmit="return fchannelgrouplist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="channelgrouplist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col" id="cg_list_chk">
                        <label for="chkall" class="sound_only">전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col" id="cg_list_name">채널그룹 명</th>
                    <th scope="col" id="cg_list_admin">관리자</th>
                    <th scope="col" id="cg_list_use">사용여부</th>
                    <th scope="col" id="cg_list_mng">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td headers="cg_list_chk" class="td_chk">
                            <input type="hidden" name="cg_id[<?php echo $i ?>]" value="<?php echo $row['cg_id'] ?>" id="cg_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['cg_name']); ?></label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td headers="cg_list_name" class="td_left"><input type="text" id="cg_name[<?php echo($i); ?>]" name="cg_name[<?php echo($i); ?>]" value="<?php echo(get_text($row['cg_name'])); ?>" class="tbl_input"></td>
                        <td headers="cg_list_admin" class="td_left"><?php echo(get_text($row['cg_admin'])); ?></td>
                        <td headers="cg_list_use"><?php echo($row['cg_use'] ? '사용함' : '사용안함'); ?></td>
                        <td headers="cg_list_mng" class="td_mng">
                            <a href="./channelgroup_form.php?<?php echo($qstr); ?>&amp;w=u&amp;cg_id=<?php echo($row['cg_id']); ?>" class="btn btn_03">수정</a>
                        </td>
                    </tr>
                <?php
                }

                if ($i == 0) {
                    echo '<tr id="empty_menu_list"><td colspan="' . $colspan . '" class="empty_table">자료가 없습니다.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
        <?php if ($is_admin == 'super') { ?>
            <a href="./channelgroup_form.php" id="channelgroup_add" class="btn btn_01">채널추가</a>
        <?php } ?>
    </div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>

<script>
    function fchannelgrouplist_submit(f) {
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
require_once './admin.tail.php';