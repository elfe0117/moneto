<?php
$sub_menu = '200200';
require_once './_common.php';

check_demo();

auth_check_menu($auth, $sub_menu, 'd');

check_admin_token();

$count = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
if (!$count) {
    alert($_POST['act_button'] . ' 하실 항목을 하나 이상 체크하세요.');
}

for ($i = 0; $i < $count; $i++) {
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];
    $po_id = (int) $_POST['po_id'][$k];
    $str_mb_id = sql_real_escape_string($_POST['mb_id'][$k]);

    // 포인트 내역정보
    $sql = " select * from {$g5['point_table']} where cn_id = '{$config['cn_id']}' AND po_id = '{$po_id}' ";
    $row = sql_fetch($sql);

    if (!$row['po_id']) {
        continue;
    }

    if ($row['po_point'] < 0) {
        $mb_id = $row['mb_id'];
        $po_point = abs($row['po_point']);

        if ($row['po_rel_table'] == '@expire') {
            delete_expire_point($row['po_type'], $mb_id, $po_point);
        } else {
            delete_use_point($row['po_type'], $mb_id, $po_point);
        }
    } else {
        if ($row['po_use_point'] > 0) {
            insert_use_point($row['po_type'], $row['mb_id'], $row['po_use_point'], $row['po_id']);
        }
    }

    // 포인트 내역삭제
    $sql = " delete from {$g5['point_table']} where cn_id = '{$config['cn_id']}' AND po_id = '{$po_id}' ";
    sql_query($sql);

    // po_mb_point에 반영
    $sql = " update {$g5['point_table']}
                set po_mb_point = po_mb_point - '{$row['po_point']}'
                where cn_id = '{$config['cn_id']}'
                    AND po_type = '{$row['po_type']}'
                    AND mb_id = '{$str_mb_id}'
                  and po_id > '{$po_id}' ";
    sql_query($sql);

    // 포인트 UPDATE
    $sum_point = get_point_sum($_POST['cn_id'][$k], $row['po_type'], $_POST['mb_id'][$k]);
    if ($row['po_type'] == 'basic') {
        $sql = " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$str_mb_id}' ";
    } else {
        $sql = " update {$g5['member_table']} set mb_{$row['po_type']}_point = '$sum_point' where mb_id = '{$str_mb_id}' ";
    }
    
    sql_query($sql);
}

goto_url('./point_list.php?' . $qstr);
