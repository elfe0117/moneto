<?php
$sub_menu = "100610";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$g5['title'] = "채널선택";
require_once './admin.head.php';
?>

<form name="fchannelform" id="fchannelform" method="post" onsubmit="return fchannelform_submit(this);" action="<?php echo($url); ?>">
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>채널정보 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="cn_id">채널 ID</label></th>
            <td><input type="text" name="cn_id" id="cn_id" required  class="required frm_input"></td>
        </tr>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <a href="javascript:window.history.go(-1);" class="btn btn_02">이전</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>
</form>

<script type="text/javascript" language="javascript">
function fchannelform_submit(f) {
    if (!f.cn_id.value) {
        alert("채널ID를 입력하세요.");
        f.cn_id.focus();
        return false;
    }

    var error = "";
    $.ajax({
        url: "./ajax.cn_id.php",
        type: "POST",
        data: {
            "cn_id": f.cn_id.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            error = data.error;
        }

    });

    if (error) {
        alert(error);
        return false;
    }

    return true;
}
</script>

<?php
require_once './admin.tail.php';