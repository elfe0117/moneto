<?php
$sub_menu = "100630";
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.", G5_URL);

// SQL 파일 실행
function sql_file($filename) {
    $file = implode('', file($filename));

    $file = preg_replace('/^--.*$/m', '', $file); // 주석 제거
    $querys = explode(';', $file);
    foreach($querys as $sql) {
        if (trim($sql)) {
            if (in_array(strtolower(G5_DB_ENGINE), array('innodb', 'myisam'))) {
                $sql = preg_replace('/ENGINE=MyISAM/', 'ENGINE='.G5_DB_ENGINE, $sql);
            } else {
                $sql = preg_replace('/ENGINE=MyISAM/', '', $sql);
            }

            if (G5_DB_CHARSET !== 'utf8') {
                $sql = preg_replace('/CHARSET=utf8/', 'CHARSET='.run_replace('get_db_charset', G5_DB_CHARSET === 'utf8mb4' ? G5_DB_CHARSET.' COLLATE=utf8mb4_unicode_ci' : G5_DB_CHARSET, G5_DB_CHARSET), $sql);
            }

            if (preg_match('/CREATE TABLE IF NOT EXISTS `(.*?)`/', $sql, $sql_tmp)) {
                flush();
                echo('<li>'.$sql_tmp[1].'</li>'.PHP_EOL);
            }

            //sql_query($sql, true);
        }
    }
}

$g5['title'] = "데이터베이스 재설치";
include_once("./admin.head.php");
?>

<div class="local_desc02 local_desc">
    <p>완료 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.</p>
</div>

<?php

flush();

echo('<ul>'.PHP_EOL);

sql_file(G5_PATH.'/install/gnuboard5.sql');
sql_file(G5_PATH.'/install/gnuboard5shop.sql');

echo('</ul>'.PHP_EOL);

// 기본 채널그룹 등록
$sql = "
    INSERT INTO `g5_channel_group`
        SET `cg_id` = 1,
            `cg_name` = '모네토',
            `cg_admin` = 'moneto',
            `cg_use` = 1,
            `cg_datetime` = '".G5_TIME_YMDHIS."' ";
//sql_query($sql);

// 기본 채널 등록
$sql = "
    INSERT INTO `g5_channel`
        SET `cn_id` = 'moneto',
            `cg_id` = 1,
            `cn_name` = '모네토',
            `cn_use` = 1,
            `cn_datetime` = '".G5_TIME_YMDHIS."' ";
//sql_query($sql);

// 기본 채널호스트 등록
$sql = "
    INSERT INTO `g5_channel_host`
        SET `ch_host` = '*',
            `cn_id` = 'moneto',
            `ch_datetime` = '".G5_TIME_YMDHIS."' ";
//sql_query($sql);

// 기본 환경설정 등록
$sql = "
    INSERT INTO `g5_config`
        SET `cf_id` = '1',
            `cn_id` = 'moneto',
            `cf_title` = '큐밥',
            `cf_theme` = 'basic',
            `cf_admin` = 'moneto',
            `cf_admin_email` = 'moneto@domain.com',
            `cf_admin_email_name` = '큐밥',
            `cf_add_script` = '',
            `cf_use_point` = 1,
            `cf_point_term` = 0,
            `cf_use_copy_log` = 1,
            `cf_use_email_certify` = 0,
            `cf_login_point` = 100,
            `cf_cut_name` = 15,
            `cf_nick_modify` = 60,
            `cf_new_skin` = 'basic',
            `cf_new_rows` = 15,
            `cf_search_skin` = 'basic',
            `cf_connect_skin` = 'basic',
            `cf_faq_skin` = 'basic',
            `cf_read_point` = 0,
            `cf_write_point` = 0,
            `cf_comment_point` = 0,
            `cf_download_point` = 0,
            `cf_write_pages` = 10,
            `cf_mobile_pages` = 5,
            `cf_link_target` = '_blank',
            `cf_bbs_rewrite` = 0,
            `cf_delay_sec` = 30,
            `cf_filter` = '18아,18놈,18새끼,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,뒈져라,뒈진다,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ',
            `cf_possible_ip` = '',
            `cf_intercept_ip` = '',
            `cf_analytics` = '',
            `cf_add_meta` = '',
            `cf_syndi_token` = '',
            `cf_syndi_except` = '',
            `cf_member_skin` = 'basic',
            `cf_use_homepage` = 0,
            `cf_req_homepage` = 0,
            `cf_use_tel` = 0,
            `cf_req_tel` = 0,
            `cf_use_hp` = 0,
            `cf_req_hp` = 0,
            `cf_use_addr` = 0,
            `cf_req_addr` = 0,
            `cf_use_signature` = 0,
            `cf_req_signature` = 0,
            `cf_use_profile` = 0,
            `cf_req_profile` = 0,
            `cf_register_level` = 2,
            `cf_register_point` = 1000,
            `cf_icon_level` = 2,
            `cf_use_recommend` = 0,
            `cf_recommend_point` = 0,
            `cf_leave_day` = 30,
            `cf_search_part` = 10000,
            `cf_email_use` = 1,
            `cf_email_wr_super_admin` = 0,
            `cf_email_wr_group_admin` = 0,
            `cf_email_wr_board_admin` = 0,
            `cf_email_wr_write` = 0,
            `cf_email_wr_comment_all` = 0,
            `cf_email_mb_super_admin` = 0,
            `cf_email_mb_member` = 0,
            `cf_email_po_super_admin` = 0,
            `cf_prohibit_id` = 'admin,administrator,관리자,운영자,어드민,주인장,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객',
            `cf_prohibit_email` = '',
            `cf_new_del` = 30,
            `cf_memo_del` = 180,
            `cf_visit_del` = 180,
            `cf_popular_del` = 180,
            `cf_optimize_date` = '2023-02-16',
            `cf_use_member_icon` = 2,
            `cf_member_icon_size` = 5000,
            `cf_member_icon_width` = 22,
            `cf_member_icon_height` = 22,
            `cf_member_img_size` = 50000,
            `cf_member_img_width` = 60,
            `cf_member_img_height` = 60,
            `cf_login_minutes` = 10,
            `cf_image_extension` = 'gif|jpg|jpeg|png',
            `cf_flash_extension` = 'swf',
            `cf_movie_extension` = 'asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3',
            `cf_formmail_is_member` = 1,
            `cf_page_rows` = 15,
            `cf_mobile_page_rows` = 15,
            `cf_visit` = '오늘:1,어제:1,최대:1,전체:11',
            `cf_max_po_id` = 0,
            `cf_stipulation` = '해당 홈페이지에 맞는 회원가입약관을 입력합니다.',
            `cf_privacy` = '해당 홈페이지에 맞는 개인정보처리방침을 입력합니다.',
            `cf_open_modify` = 0,
            `cf_memo_send_point` = 500,
            `cf_mobile_new_skin` = 'basic',
            `cf_mobile_search_skin` = 'basic',
            `cf_mobile_connect_skin` = 'basic',
            `cf_mobile_faq_skin` = 'basic',
            `cf_mobile_member_skin` = 'basic',
            `cf_captcha_mp3` = 'basic',
            `cf_editor` = 'smarteditor2',
            `cf_cert_use` = 0,
            `cf_cert_find` = 0,
            `cf_cert_ipin` = '',
            `cf_cert_hp` = '',
            `cf_cert_simple` = '',
            `cf_cert_kg_cd` = '',
            `cf_cert_kg_mid` = '',
            `cf_cert_kcb_cd` = '',
            `cf_cert_kcp_cd` = '',
            `cf_lg_mid` = '',
            `cf_lg_mert_key` = '',
            `cf_cert_limit` = 2,
            `cf_cert_req` = 0,
            `cf_sms_use` = '',
            `cf_sms_type` = '',
            `cf_icode_id` = 'moneto',
            `cf_icode_pw` = 'Moneto12@!',
            `cf_icode_server_ip` = '211.172.232.124',
            `cf_icode_server_port` = '7295',
            `cf_icode_token_key` = '',
            `cf_googl_shorturl_apikey` = '',
            `cf_social_login_use` = 0,
            `cf_social_servicelist` = '',
            `cf_payco_clientid` = '',
            `cf_payco_secret` = '',
            `cf_facebook_appid` = '',
            `cf_facebook_secret` = '',
            `cf_twitter_key` = '',
            `cf_twitter_secret` = '',
            `cf_google_clientid` = '',
            `cf_google_secret` = '',
            `cf_naver_clientid` = '',
            `cf_naver_secret` = '',
            `cf_kakao_rest_key` = '',
            `cf_kakao_client_secret` = '',
            `cf_kakao_js_apikey` = '',
            `cf_captcha` = 'kcaptcha',
            `cf_recaptcha_site_key` = '',
            `cf_recaptcha_secret_key` = '',
            `cf_1_subj` = ''
            `cf_2_subj` = '',
            `cf_3_subj` = '',
            `cf_4_subj` = '',
            `cf_5_subj` = '',
            `cf_6_subj` = '',
            `cf_7_subj` = '',
            `cf_8_subj` = '',
            `cf_9_subj` = '',
            `cf_10_subj` = '',
            `cf_1` = '',
            `cf_2` = '',
            `cf_3` = '',
            `cf_4` = '',
            `cf_5` = '',
            `cf_6` = '',
            `cf_7` = '',
            `cf_8` = '',
            `cf_9` = '',
            `cf_10` = '' ";
//sql_query($sql);

$sql = "
    INSERT INTO `g5_member`
        SET `mb_no` = 1,
        `mb_id` = 'moneto',
        `mb_password` = 'sha256:12000:qOD0ZqSSmCAe2rPWOn6ZDm+p9v2za7su:EjPAAUdLWeH5b2/ObktZIgTF6Bhhxc8x',
        `mb_name` = '모네토',
        `mb_nick` = '모네토',
        `mb_nick_date` = '".G5_TIME_YMD."',
        `mb_email` = 'admin@domain.com',
        `mb_homepage` = '',
        `mb_level` = 10,
        `mb_sex` = '',
        `mb_birth` = '',
        `mb_tel` = '',
        `mb_hp` = '',
        `mb_certify` = '',
        `mb_adult` = 0,
        `mb_dupinfo` = '',
        `mb_zip1` = '',
        `mb_zip2` = '',
        `mb_addr1` = '',
        `mb_addr2` = '',
        `mb_addr3` = '',
        `mb_addr_jibeon` = '',
        `mb_signature` = '',
        `mb_recommend` = '',
        `mb_point` = 1000,
        `mb_today_login` = '".G5_TIME_YMDHIS."',
        `mb_login_ip` = '172.17.0.1',
        `mb_datetime` = '".G5_TIME_YMDHIS."',
        `mb_ip` = '172.17.0.1',
        `mb_leave_date` = '',
        `mb_intercept_date` = '',
        `mb_email_certify` = '".G5_TIME_YMDHIS."',
        `mb_email_certify2` = '',
        `mb_memo` = '',
        `mb_lost_certify` = '',
        `mb_mailling` = 1,
        `mb_sms` = 0,
        `mb_open` = 1,
        `mb_open_date` = '0000-00-00',
        `mb_profile` = '',
        `mb_memo_call` = '',
        `mb_memo_cnt` = 0,
        `mb_scrap_cnt` = 0,
        `mb_1` = '',
        `mb_2` = '',
        `mb_3` = '',
        `mb_4` = '',
        `mb_5` = '',
        `mb_6` = '',
        `mb_7` = '',
        `mb_8` = '',
        `mb_9` = '',
        `mb_10`= '' ";
//sql_query($sql);

echo('<div class="local_desc01 local_desc"><p><strong>쿼리 실행이 완료됐습니다.</strong><br>프로그램의 실행을 끝마치셔도 좋습니다.</p></div>'.PHP_EOL);

include_once("./admin.tail.php");