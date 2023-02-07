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
    ORDER BY cg_name ASC ";
$result = sql_query($sql);
if ($result) {
    while($row = sql_fetch_array($result)) {
        array_push($array_cg, $row);
    }
    unset($result);
}

// 채널 정보
$sql = " SELECT *
    FROM {$g5['channel_table']}
    ORDER BY cn_id ASC ";
$result = sql_query($sql);

$g5['title'] = "채널관리";
require_once './admin.head.php';

$colspan = 4;
?>
<form name="fchannellist" id="fchannellist" method="post" action="./channel_list_update.php" onsubmit="return fchannellist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="channellist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col">채널 ID</th>
                    <th scope="col">채널명</th>
                    <th scope="col">그룹</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td class="td_id"><?php echo(get_text($row['cn_id'])); ?></td>
                        <td class="td_left"><?php echo(get_text($row['cn_name'])); ?></td>
                        <td>
                            <select id="cg_id[<?php echo($i); ?>]" name="cg_id[<?php echo($i); ?>]">
                                <?php
                                foreach($array_cg as $row_cg) {
                                    echo(option_selected($row_cg['cg_id'], $row['cg_id'], $row_cg['cg_name']));
                                }
                                ?>
                            </select>
                        </td>
                        <td class="td_mng">
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
</form>

<script>
    function fchannellist_submit(f) {
        return true;
    }
</script>

<?php
require_once './admin.tail.php';
