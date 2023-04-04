<?php
$sub_menu = "200100";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'w');

$pf = array();

if ($w == '') {
    $html_title = '추가';
} else if ($w == 'u') {
    $html_title = '수정';
}

$g5['title'] .= '프로필 ' . $html_title;
require_once './admin.head.php';

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_pf_basic">프로필</a></li>
    <li><a href="#anc_pf_block">프로필 블록</a></li>
</ul>';
?>

<form name="fprofile" id="fprofile" action="./profile_form_update.php" onsubmit="return fprofile_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <section id="anc_pf_basic">
        <h2 class="h2_frm">프로필 설정</h2>
        <?php echo $pg_anchor ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th scope="row"><label for="pf_admin">프로필 관리자</label></th>
                        <td><input type="text" name="pf_admin" id="pf_admin" required class="frm_input required"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pf_name">프로필 명</label></th>
                        <td><input type="text" name="pf_name" id="pf_name" required class="frm_input required"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pf_summary">소개</label></th>
                        <td><textarea name="pf_summary" id="pf_summary" rows="3" required class="frm_input required"></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="anc_pf_block">
        <h2 class="h2_frm">프로필 블록 관리</h2>
        <?php echo $pg_anchor ?>

        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption>프로필 블록 목록</caption>
                <thead>
                    <tr>
                        <th scope="col">항목</th>
                        <th scope="col">관리</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="pb_type" id="pb_type">
                                <option value="link">링크</option>
                                <option value="text">텍스트</option>
                                <option value="image">이미지</option>
                                <option value="seperator">구분선</option>
                                <option value="movie">동영상</option>
                                <option value="calender">캘린더</option>
                                <option value="classroom">클래스룸</option>
                            </select>
                        </td>
                        <td>
                            설정
                            관리
                            삭제
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</form>

<?php
run_event('admin_profile_form_after', $pf, $w);

require_once './admin.tail.php';