<?php
$sub_menu = "100620";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널그룹 ID
$cg_id = isset($_GET['cg_id']) ? trim($_GET['cg_id']) : '';

$html_title = '채널그룹관리';

$channel_total_count = 0;
$cg = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    // 해당 채널그룹정보 가져오기
    $sql = "SELECT *
        FROM {$g5['channel_group_table']}
        WHERE cg_id = '{$cg_id}'
        LIMIT 0, 1 ";
    $cg = sql_fetch($sql);

    $sql = "SELECT COUNT(*) AS cnt
        FROM {$g5['channel_table']}
        WHERE cg_id = '{$cg_id}'
            AND cn_use = '1' ";
    $row = sql_fetch($sql);
    $channel_total_count = $row['cnt'];
} else {
    $html_title .= ' 입력';
}

$g5['title'] = $html_title;
require_once './admin.head.php';
?>

<form name="fchannelgroupform" id="fchannelgroupform" method="post" onsubmit="return fchannelgroupform_submit(this);">
    <input type="hidden" name="cg_id" value="<?php echo($cg_id); ?>">
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
                    <th scope="row"><label for="cg_name">채널그룹 명<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" id="cg_name" name="cg_name" value="<?php echo($cg['cg_name']); ?>" required class="frm_input required"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cg_admin">관리자<strong class="sound_only">필수</strong></label></th>
                    <td><?php echo get_member_id_select('cg_admin', 10, $cg['cg_admin'], 'required') ?></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cg_use">사용여부<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="checkbox" name="cg_use" value="1" id="cg_use" <?php echo ($cg['cg_use']) ? "checked" : ""; ?>> 예
                    </td>
                </tr>
                <?php if ($channel_total_count) { ?>
                <tr>
                    <th scope="row">채널 수</th>
                    <td><?php echo($channel_total_count); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <a href="./channelgroup_list.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>

</form>

<script>
    function fchannelgroupform_submit(f) {
        f.action = "./channelgroup_form_update.php";
        return true;
    }
</script>

<?php
require_once './admin.tail.php';