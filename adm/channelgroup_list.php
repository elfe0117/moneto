<?php
$sub_menu = "100620";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널그룹 목록 정보
$array_cg = array();
$sql = "SELECT *
    FROM {$g5['channel_group_table']}
    ORDER BY cg_name ASC ";
$result = sql_query($sql);

$g5['title'] = "채널그룹관리";
require_once './admin.head.php';

$colspan = 3;
?>
<form name="fchannelgrouplist" id="fchannelgrouplist" method="post" action="./channelgroup_list_update.php" onsubmit="return fchannelgrouplist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="channelgrouplist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col">채널그룹 명</th>
                    <th scope="col">관리자</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td class="td_left"><?php echo(get_text($row['cg_name'])); ?></td>
                        <td class="td_left"><?php echo(get_text($row['cg_admin'])); ?></td>
                        <td class="td_mng">
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
</form>

<script>
    function fchannelgrouplist_submit(f) {
        return true;
    }
</script>

<?php
require_once './admin.tail.php';