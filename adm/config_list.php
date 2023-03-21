<?php
$sub_menu = "100100";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$sql_common = " FROM {$g5['config_table']} ";

$sql_search = " WHERE (1) ";
if ($master['ma_admin'] != $member['mb_id']) {
    $sql_search .= " AND cn_id = '{$config['cn_id']}' ";
}

if (!$sst) {
    $sst = "cn_id";
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

$g5['title'] = "환경설정";
require_once './admin.head.php';

$colspan = 6;
?>
<form name="fconfiglist" id="fconfiglist" method="post" action="./config_list_update.php" onsubmit="return fconfiglist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="configlist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col" id="cf_list_chk">
                        <label for="chkall" class="sound_only">전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col" id="cn_list_id">채널 ID</th>
                    <th scope="col" id="cf_list_title">홈페이지 제목</th>
                    <th scope="col" id="cf_list_admin">관리자</th>
                    <th scope="col" id="cf_list_admin_email">관리자 이메일</th>
                    <th scope="col" id="cf_list_mng">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td headers="cf_list_chk" class="td_chk">
                            <input type="hidden" name="cn_id[<?php echo $i ?>]" value="<?php echo $row['cn_id'] ?>" id="cn_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['cf_title']); ?></label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td headers="cn_list_id" class="td_id"><?php echo(get_text($row['cn_id'])); ?></td>
                        <td headers="cf_list_title" class="td_left"><input type="text" id="cf_title[<?php echo($i); ?>]" name="cf_title[<?php echo($i); ?>]" value="<?php echo(get_text($row['cf_title'])); ?>" class="tbl_input"></td>
                        <td headers="cf_list_admin"><?php echo(get_text($row['cf_admin'])); ?></td>
                        <td headers="cf_list_admin_email" class="td_left"><input type="text" id="cf_admin_email[<?php echo($i); ?>]" name="cf_admin_email[<?php echo($i); ?>]" value="<?php echo(get_text($row['cf_admin_email'])); ?>" class="tbl_input"></td>
                        <td headers="cf_list_mng" class="td_mng">
                            <a href="./config_form.php?<?php echo($qstr); ?>&amp;w=u&amp;cf_id=<?php echo($row['cf_id']); ?>&amp;cn_id=<?php echo($row['cn_id']); ?>" class="btn btn_03">수정</a>
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
    </div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>

<script>
    function fconfiglist_submit(f) {
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
