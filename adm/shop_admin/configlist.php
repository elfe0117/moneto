<?php
$sub_menu = "400100";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$sql_common = " FROM {$g5['g5_shop_default_table']} ";

$sql_search = " WHERE (1) ";

if (!$sst) {
    $sst = "cn_id";
    $sod = "ASC";
}

$sql_order = " ORDER BY {$sst} {$sod} ";

$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " SELECT COUNT(*) as cnt " . $sql_common;
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

$g5['title'] = "쇼핑몰설정";
include_once (G5_ADMIN_PATH.'/admin.head.php');

$colspan = 7;
?>
<form name="fconfiglist" id="fconfiglist" method="post" action="./configlist_update.php" onsubmit="return fconfiglist_submit(this);">
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
                    <th scope="col">채널 ID</th>
                    <th scope="col">대표자명</th>
                    <th scope="col">회사명</th>
                    <th scope="col">사업자등록번호</th>
                    <th scope="col">대표전화번호</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td class="td_chk">
                            <input type="hidden" name="cn_id[<?php echo $i ?>]" value="<?php echo $row['cn_id'] ?>" id="cn_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['de_admin_company_name']); ?></label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td class="td_id"><?php echo(get_text($row['cn_id'])); ?></td>
                        <td class="td_left"><input type="text" id="de_admin_company_owner[<?php echo($i); ?>]" name="de_admin_company_owner[<?php echo($i); ?>]" value="<?php echo(get_text($row['de_admin_company_owner'])); ?>" class="tbl_input"></td>
                        <td class="td_left"><input type="text" id="de_admin_company_name[<?php echo($i); ?>]" name="de_admin_company_name[<?php echo($i); ?>]" value="<?php echo(get_text($row['de_admin_company_name'])); ?>" class="tbl_input"></td>
                        <td class="td_left"><input type="text" id="de_admin_company_saupja_no[<?php echo($i); ?>]" name="de_admin_company_saupja_no[<?php echo($i); ?>]" value="<?php echo(get_text($row['de_admin_company_saupja_no'])); ?>" class="tbl_input"></td>
                        <td class="td_left"><input type="text" id="de_admin_company_tel[<?php echo($i); ?>]" name="de_admin_company_tel[<?php echo($i); ?>]" value="<?php echo(get_text($row['de_admin_company_tel'])); ?>" class="tbl_input"></td>
                        <td class="td_mng">
                            <a href="./configform.php?<?php echo($qstr); ?>&amp;w=u&amp;de_id=<?php echo($row['de_id']); ?>&amp;cn_id=<?php echo($row['cn_id']); ?>" class="btn btn_03">수정</a>
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
include_once (G5_ADMIN_PATH.'/admin.tail.php');