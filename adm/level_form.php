<?php
$sub_menu = "200190";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널 ID
$cn_id = isset($_REQUEST['cn_id']) && !is_array($_REQUEST['cn_id']) && $_REQUEST['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['cn_id'])) : '';
$lv_type = 'member';

$lv_list = array();

$sql = " SELECT *
    FROM {$g5['level_table']}
    WHERE cn_id = '{$cn_id}'
        AND lv_type = '{$lv_type}'
    ORDER BY lv_value ASC ";
$result = sql_query($sql);
if ($result) {
    while($row = sql_fetch_array($result)) {
        $lv_list[$row['lv_value']] = $row;
    }
    unset($result);
}

$g5['title'] = "회원등급관리";
require_once './admin.head.php';
?>

<form name="flevelform" id="flevelform" method="post" onsubmit="return flevelform_submit(this);">
    <input type="hidden" name="cn_id" value="<?php echo($cn_id); ?>">
    <input type="hidden" name="lv_type" value="<?php echo($lv_type); ?>">
    <input type="hidden" name="token" value="" id="token">

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>회원 등급 설정</caption>
            <tbody>
                <thead>
                    <tr>
                        <th>레벨</th>
                        <th>명칭</th>
                    </tr>
                </thead>
                <?php
                for($i = 0; $i < 10; $i++) {
                    $lv_value = $i + 1;
                    $lv_name = isset($lv_list[$lv_value]['lv_name']) && $lv_list[$lv_value]['lv_name'] ? $lv_list[$lv_value]['lv_name'] : '레벨'.$lv_value;
                ?>
                <tr>
                    <td>
                        <input type="hidden" name="lv_value[<?php echo($i); ?>]" id="lv_value[<?php echo($i); ?>]" value="<?php echo($lv_value); ?>" required class="frm_input required">
                        레벨<?php echo($lv_value); ?>
                    </td>
                    <td><input type="text" name="lv_name[<?php echo($i); ?>]" id="lv_name[<?php echo($i); ?>]" value="<?php echo($lv_name); ?>" required class="frm_input required"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>
</form>

<script>
    function flevelform_submit(f) {
        f.action = "./level_form_update.php";
        return true;
    }
</script>

<?php
require_once './admin.tail.php';