<?php
// board_delete.php , boardgroup_delete.php 에서 include 하는 파일

// 개별 페이지 접근 불가
if (!defined('_GNUBOARD_')) {
    exit;
}
if (!defined('_BOARD_DELETE_')) {
    exit;
}

// $tmp_cn_id 에는 $cn_id 값을 넘겨주어야 함
if (!$tmp_cn_id) {
    return;
}

// $tmp_bo_table 에는 $bo_table 값을 넘겨주어야 함
if (!$tmp_bo_table) {
    return;
}

// 게시판 1개는 삭제 불가 (게시판 복사를 위해서)
//$row = sql_fetch(" select count(*) as cnt from $g5['board_table'] ");
//if ($row['cnt'] <= 1) { return; }

// 게시판 설정 삭제
sql_query(" delete from {$g5['board_table']} where cn_id = '{$tmp_cn_id}' AND bo_table = '{$tmp_bo_table}' ");

// 최신글 삭제
sql_query(" delete from {$g5['board_new_table']} where cn_id = '{$tmp_cn_id}' AND bo_table = '{$tmp_bo_table}' ");

// 스크랩 삭제
sql_query(" delete from {$g5['scrap_table']} where cn_id = '{$tmp_cn_id}' AND bo_table = '{$tmp_bo_table}' ");

// 파일 삭제
sql_query(" delete from {$g5['board_file_table']} where cn_id = '{$tmp_cn_id}' AND bo_table = '{$tmp_bo_table}' ");

// 게시판 테이블 DROP
sql_query(" drop table {$g5['write_prefix']}{$tmp_cn_id}_{$tmp_bo_table} ", false);

// 좋아요 테이블에서 기록 삭제
sql_query(" delete from {$g5['board_good_table']} where cn_id = '{$tmp_cn_id}' AND bo_table = '{$tmp_bo_table}' ");

delete_cache_latest($tmp_bo_table);

// 게시판 폴더 전체 삭제
rm_rf(G5_DATA_PATH . '/file/'.$tmp_cn_id.'/'. $tmp_bo_table);
