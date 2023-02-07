<?php
$sub_menu = "100610";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널그룹 목록 정보
$array_cg = array();
$sql = "SELECT *
    FROM {$g5['channel_group_table']}
    WHERE cg_use = '1'
    ORDER BY cg_name ASC ";
$result = sql_query($sql);
if ($result) {
    while($row = sql_fetch_array($result)) {
        array_push($array_cg, $row);
    }
    unset($result);
}

// 채널 정보
$sql_common = " FROM {$g5['channel_table']} ";

$sql_search = " WHERE (1) ";

if (!$sst) {
    $sst = "cn_id";
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


$sql = " SELECT *
    {$sql_common}
    {$sql_search}
    {$sql_order}
    LIMIT {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = "채널관리";
require_once './admin.head.php';

$colspan = 6;
?>
<form name="fchannellist" id="fchannellist" method="post" action="./channel_list_update.php" onsubmit="return fchannellist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="channellist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col" id="cn_list_chk">
                        <label for="chkall" class="sound_only">전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col" id="cn_list_id">채널 ID</th>
                    <th scope="col" id="cn_list_name">채널명</th>
                    <th scope="col" id="cg_list_id">그룹</th>
                    <th scope="col" id="cn_list_use">사용여부</th>
                    <th scope="col" id="cn_list_mng">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td headers="cn_list_chk" class="td_chk">
                            <input type="hidden" name="cn_id[<?php echo $i ?>]" value="<?php echo $row['cn_id'] ?>" id="cn_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['cn_name']); ?></label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td headers="cn_list_id" class="td_id"><?php echo(get_text($row['cn_id'])); ?></td>
                        <td headers="cn_list_name" class="td_left"><input type="text" id="cn_name[<?php echo($i); ?>]" name="cn_name[<?php echo($i); ?>]" value="<?php echo(get_text($row['cn_name'])); ?>" class="tbl_input"></td>
                        <td headers="cg_list_id">
                            <select id="cg_id[<?php echo($i); ?>]" name="cg_id[<?php echo($i); ?>]">
                                <?php
                                foreach($array_cg as $row_cg) {
                                    echo(option_selected($row_cg['cg_id'], $row['cg_id'], $row_cg['cg_name']));
                                }
                                ?>
                            </select>
                        </td>
                        <td headers="cn_list_use"><?php echo($row['cn_use'] ? '사용함' : '사용안함'); ?></td>
                        <td headers="cn_list_mng" class="td_mng">
                            <a href="./channel_form.php?<?php echo($qstr); ?>&amp;w=u&amp;cn_id=<?php echo($row['cn_id']); ?>" class="btn btn_03">수정</a>
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
            <a href="./channel_form.php" id="channel_add" class="btn btn_01">채널추가</a>
        <?php } ?>
    </div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>

<script>
    function fchannellist_submit(f) {
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
