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
                        <td class="td_id"><?php echo(get_text($row['cn_id'])); ?></td>
                        <td class="td_left"><?php echo(get_text($row['cf_title'])); ?></td>
                        <td><?php echo(get_text($row['cf_admin'])); ?></td>
                        <td><?php echo(get_text($row['cf_admin_email'])); ?></td>
                        <td class="td_mng">
                            <a href="./config_form.php?<?php echo($qstr); ?>&amp;w=u&amp;cf_id=<?php echo($row['cf_id']); ?>&amp;cn_id=<?php echo($row['cn_id']); ?>" class="btn btn_03">수정</a>
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
