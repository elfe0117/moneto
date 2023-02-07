<?php
$sub_menu = "100610";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널 ID
$cn_id = isset($_GET['cn_id']) ? trim($_GET['cn_id']) : '';

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

$html_title = '채널관리';

$cn = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    // 해당 채널정보 가져오기
    $sql = "SELECT *
        FROM {$g5['channel_table']}
        WHERE cn_id = '{$cn_id}'
        LIMIT 0, 1 ";
    $cn = sql_fetch($sql);
} else {
    $html_title .= ' 입력';
}

$g5['title'] = $html_title;
require_once './admin.head.php';
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
                    <td><input type="text" id="cn_id" name="cn_id" value="<?php echo($cn['cn_id']); ?>" required class="frm_input required"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cg_id">채널 그룹<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <select id="cg_id" name="cg_id">
                            <?php
                            foreach($array_cg as $row_cg) {
                                echo(option_selected($row_cg['cg_id'], $cn['cg_id'], $row_cg['cg_name']));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cn_name">채널 명<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" id="cn_name" name="cn_name" value="<?php echo($cn['cn_name']); ?>" required class="frm_input required"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>

</form>

<script>
    function fchannelform_submit(f) {
        f.action = "./channel_form_update.php";
        return true;
    }
</script>

<?php
require_once './admin.tail.php';