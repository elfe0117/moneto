<?php
$sub_menu = "100100";
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$sql = " SELECT *
    FROM {$g5['config_table']}
    ORDER BY cn_id ASC ";
$result = sql_query($sql);

$g5['title'] = "환경설정";
require_once './admin.head.php';

$colspan = 5;
?>
<form name="fconfiglist" id="fconfiglist" method="post" action="./config_list_update.php" onsubmit="return fconfiglist_submit(this);">
    <input type="hidden" name="token" value="">
    <div id="configlist" class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col">채널 ID</th>
                    <th scope="col">홈페이지 제목</th>
                    <th scope="col">관리자</th>
                    <th scope="col">관리자 이메일</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                ?>
                    <tr class="<?php echo $bg; ?>">
                        <td class="td_category<?php echo $sub_menu_class; ?>">
                            <input type="hidden" name="code[]" value="<?php echo substr($row['me_code'], 0, 2) ?>">
                            <label for="me_name_<?php echo $i; ?>" class="sound_only"><?php echo $sub_menu_info; ?> 메뉴<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="me_name[]" value="<?php echo get_sanitize_input($me_name); ?>" id="me_name_<?php echo $i; ?>" required class="required tbl_input full_input">
                        </td>
                        <td>
                            <label for="me_link_<?php echo $i; ?>" class="sound_only">링크<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="me_link[]" value="<?php echo $row['me_link'] ?>" id="me_link_<?php echo $i; ?>" required class="required tbl_input full_input">
                        </td>
                        <td class="td_mng">
                            <label for="me_target_<?php echo $i; ?>" class="sound_only">새창</label>
                            <select name="me_target[]" id="me_target_<?php echo $i; ?>">
                                <option value="self" <?php echo get_selected($row['me_target'], 'self', true); ?>>사용안함</option>
                                <option value="blank" <?php echo get_selected($row['me_target'], 'blank', true); ?>>사용함</option>
                            </select>
                        </td>
                        <td class="td_num">
                            <label for="me_order_<?php echo $i; ?>" class="sound_only">순서</label>
                            <input type="text" name="me_order[]" value="<?php echo $row['me_order'] ?>" id="me_order_<?php echo $i; ?>" class="tbl_input" size="5">
                        </td>
                        <td class="td_mng">
                            <?php if (strlen($row['me_code']) == 2) { ?>
                                <button type="button" class="btn_add_submenu btn_03 ">추가</button>
                            <?php } ?>
                            <button type="button" class="btn_del_menu btn_02">삭제</button>
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
        <button type="button" onclick="return add_menu();" class="btn btn_02">메뉴추가<span class="sound_only"> 새창</span></button>
        <input type="submit" name="act_button" value="확인" class="btn_submit btn ">
    </div>

</form>

<script>
    $(function() {
        $(document).on("click", ".btn_add_submenu", function() {
            var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
            add_submenu(code);
        });

        $(document).on("click", ".btn_del_menu", function() {
            if (!confirm("메뉴를 삭제하시겠습니까?\n메뉴 삭제후 메뉴설정의 확인 버튼을 눌러 메뉴를 저장해 주세요."))
                return false;

            var $tr = $(this).closest("tr");
            if ($tr.find("td.sub_menu_class").length > 0) {
                $tr.remove();
            } else {
                var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
                $("tr.menu_group_" + code).remove();
            }

            if ($("#menulist tr.menu_list").length < 1) {
                var list = "<tr id=\"empty_menu_list\"><td colspan=\"<?php echo $colspan; ?>\" class=\"empty_table\">자료가 없습니다.</td></tr>\n";
                $("#menulist table tbody").append(list);
            } else {
                $("#menulist tr.menu_list").each(function(index) {
                    $(this).removeClass("bg0 bg1")
                        .addClass("bg" + (index % 2));
                });
            }
        });
    });

    function add_menu() {
        var max_code = base_convert(0, 10, 36);
        $("#menulist tr.menu_list").each(function() {
            var me_code = $(this).find("input[name='code[]']").val().substr(0, 2);
            if (max_code < me_code)
                max_code = me_code;
        });

        var url = "./menu_form.php?code=" + max_code + "&new=new";
        window.open(url, "add_menu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
        return false;
    }

    function add_submenu(code) {
        var url = "./menu_form.php?code=" + code;
        window.open(url, "add_menu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
        return false;
    }

    function base_convert(number, frombase, tobase) {
        //  discuss at: http://phpjs.org/functions/base_convert/
        // original by: Philippe Baumann
        // improved by: Rafał Kukawski (http://blog.kukawski.pl)
        //   example 1: base_convert('A37334', 16, 2);
        //   returns 1: '101000110111001100110100'

        return parseInt(number + '', frombase | 0)
            .toString(tobase | 0);
    }

    function fmenulist_submit(f) {

        var me_links = document.getElementsByName('me_link[]');
        var reg = /^javascript/;

        for (i = 0; i < me_links.length; i++) {

            if (reg.test(me_links[i].value)) {

                alert('링크에 자바스크립트문을 입력할수 없습니다.');
                me_links[i].focus();
                return false;
            }
        }

        return true;
    }
</script>

<?php
require_once './admin.tail.php';
