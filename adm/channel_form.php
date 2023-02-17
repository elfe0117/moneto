<?php
$sub_menu = "100610";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// 채널그룹 목록 정보
$cg_list = get_channelgroup_list();

// 채널 ID
$cn_id = isset($_GET['cn_id']) && !is_array($_GET['cn_id']) && $_GET['cn_id'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_GET['cn_id'])) : '';

$html_title = '채널관리';

$cn = array();
$cf = array();
if ($w == 'u') {
    $html_title .= ' 수정';

    // 채널 정보 구하기
    $cn = get_channel($cn_id);

    // 기본환경설정 정보 구하기
    $cf = get_config(true, $cn_id);
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
                        <select id="cg_id" name="cg_id" required>
                            <?php
                            foreach($cg_list as $cg_row) {
                                echo(option_selected($cg_row['cg_id'], $cn['cg_id'], $cg_row['cg_name']));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cn_name">채널 명<strong class="sound_only"> 필수</strong></label></th>
                    <td><input type="text" id="cn_name" name="cn_name" value="<?php echo($cn['cn_name']); ?>" required class="frm_input required"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cf_admin">관리자<strong class="sound_only">필수</strong></label></th>
                    <td><?php echo get_member_id_select('cf_admin', 10, $cf['cf_admin'], 'required') ?></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cf_admin_email">관리자 메일 주소<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <?php echo help('관리자가 보내고 받는 용도로 사용하는 메일 주소를 입력합니다. (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)') ?>
                        <input type="text" name="cf_admin_email" value="<?php echo get_sanitize_input($cf['cf_admin_email']); ?>" id="cf_admin_email" required class="required email frm_input" size="40">
                        <?php if (function_exists('domain_mail_host') && $cf['cf_admin_email'] && stripos($cf['cf_admin_email'], domain_mail_host()) === false) { ?>
                        <?php echo help('외부메일설정이나 기타 설정을 하지 않았다면, 도메인과 다른 헤더로 여겨 스팸이나 차단될 가능성이 있습니다.<br>name'.domain_mail_host().' 과 같은 도메인 형식으로 설정할것을 권장합니다.') ?>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="cn_use">사용여부<strong class="sound_only"> 필수</strong></label></th>
                    <td>
                        <input type="checkbox" name="cn_use" value="1" id="cn_use" <?php echo ($cn['cn_use']) ? "checked" : ""; ?>> 예
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <a href="./channel_list.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
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