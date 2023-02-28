<?php
include_once('./_common.php');

if (!(isset($pf_id) && $pf_id)) {
    $pf_id = $member['mb_id'];
}

$sql = " SELECT *
    FROM {$g5['profile_table']}
    WHERE pf_id = '{$pf_id}'
        AND pf_admin = '{$member['mb_id']}'
    LIMIT 0, 1 ";
$pf = sql_fetch($sql);
if (!(isset($pf['pf_id']) && $pf['pf_id'])) {
    alert('프로필 정보가 없습니다.');
}
?>
<table>
    <tr>
        <th>프로필 ID</th>
        <td>
            <input type="hidden" name="pf_id" id="pf_id" value="<?php echo($pf['pf_id']); ?>">
            @<?php echo($pf['pf_id']); ?>
        </td>
    </tr>
    <tr>
        <th>관리자</th>
        <td><?php echo($pf['pf_admin']); ?></td>
    </tr>
    <tr>
        <th>이름</th>
        <td><input type="text" name="pf_name" id="pf_name" value="<?php echo($pf['pf_name']); ?>"></td>
    </tr>
    <tr>
        <th>소개</th>
        <td><textarea rows="1" name="pf_summary" id="pf_summary"><?php echo($pf['pf_summary']); ?></textarea></td>
    </tr>
    <tr>
        <th>이미지</th>
        <td>
            <input type="file">
            <?php echo($pf['pf_img']); ?></td>
    </tr>
    <tr>
        <th>등록일시</th>
        <td><?php echo($pf['pf_datetime']); ?></td>
    </tr>
</table>
