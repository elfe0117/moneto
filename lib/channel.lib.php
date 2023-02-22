<?php
if (!defined('_GNUBOARD_')) exit;

// URI to HOST 
function get_uritohost($url) {
    preg_match("/^(http|https|ftp|ftps):\/\/?([^\/]+)/i",$url,$matches);
    return $matches[2];
}

// 파라메터 채널 구하기
function get_channel_id_parameter() {
    return isset($_REQUEST['cid']) && !is_array($_REQUEST['cid']) && $_REQUEST['cid'] ? preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['cid'])) : '';
}

// 세션 채널 ID 구하기
function get_channel_id_session() {
    return (isset($_SESSION['ss_cid']) && $_SESSION['ss_cid']) ? $_SESSION['ss_cid'] : '';
}

// 채널 ID 구하기
function get_channel_id() {
    $cid = get_channel_id_parameter();
    $cid = $cid ? $cid : get_channel_id_session();
    return $cid ? $cid : G5_DEFAULT_CHANNEL;
}

// 채널 구하기
function get_channel($cid='') {
    global $g5;

    if (!$cid) {
        $cid = get_channel_id();
    }

    $sql = "SELECT *
        FROM {$g5['channel_table']}
        WHERE cn_id = '{$cid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}

// 채널 데이터 경로 구하기
function get_channel_data_path($cid) {
    $data_path = G5_CHANNEL_PATH.'/'.$cid.'/'.G5_STORAGE_DIR;
    return $data_path;
}

// 채널 데이터 URL 구하기
function get_channel_data_url($cid, $is_channel=true) {
    $data_url = '';

    if ($is_channel) {
        $data_url = G5_URL.'/data';
    } else {
        $data_url = G5_CHANNEL_URL.'/'.$cid.'/'.G5_STORAGE_DIR;
    }
    return $data_url;
}

// 채널 디렉토리 생성
function crt_channel_directory($cid) {
    // 채널 디렉토리 생성
    $channel_path = G5_CHANNEL_PATH.'/'.$cid;

    @mkdir($channel_path, G5_DIR_PERMISSION);
    @chmod($channel_path, G5_DIR_PERMISSION);

    // 채널 데이터 디렉토리 생성
    $channel_data_path = $channel_path.'/'.G5_STORAGE_DIR;
    @mkdir($channel_data_path, G5_DIR_PERMISSION);
    @chmod($channel_data_path, G5_DIR_PERMISSION);

    // 채널 데이터 하위 디렉토리 생성
    $sub_dir = array ('cache','editor','file','log','member','member_image','content','faq','tmp','banner','common','event');
    foreach($sub_dir as $dir_name) {
        $channel_data_sub_path = $channel_data_path.'/'.$dir_name;
        @mkdir($channel_data_sub_path, G5_DIR_PERMISSION);
        @chmod($channel_data_sub_path, G5_DIR_PERMISSION);
    }

    // 채널 데이터 하위 링크 생성
    $sub_ln = array ('session','item');
    foreach($sub_ln as $ln_name) {
        $channel_data_sub_path = $channel_data_path.'/'.$ln_name;
        @symlink(G5_STORAGE_PATH.'/'.$ln_name, $channel_data_sub_path);
    }
}

// 채널 삭제
function del_channel($cid) {
    global $g5;

    $sql = "UPDATE {$g5['channel_table']}
        SET cn_use = 0
        WHERE cn_id = '{$cid}' ";
    sql_query($sql);

    // 폴더 전체 삭제
    $channel_path = G5_CHANNEL_PATH.'/'.$cid;
    //rm_rf($channel_path);
}

// 채널그룹 구하기
function get_channelgroup($cgid) {
    global $g5;

    $sql = "SELECT *
        FROM {$g5['channel_group_table']}
        WHERE cg_id = '{$cgid}'
        LIMIT 0, 1 ";
    return sql_fetch($sql);
}

// 채널그룹 목록 구하기
function get_channelgroup_list() {
    global $g5;

    $array_result = array();

    $sql = "SELECT *
        FROM {$g5['channel_group_table']}
        WHERE cg_use = '1'
        ORDER BY cg_name ASC ";
    $result = sql_query($sql);
    if ($result) {
        while($row = sql_fetch_array($result)) {
            array_push($array_result, $row);
        }
        unset($result);
    }

    return count($array_result) ? $array_result : NULL;
}

function sql_channel_config_insert($cid, $cf_title, $cf_admin, $cf_admin_email) {
    global $g5;

    // 기본환경설정 등록
    $sql = " INSERT INTO `{$g5['config_table']}`
        SET `cn_id` = '{$cid}',
            `cf_title` = '{$cf_title}',
            `cf_theme` = 'basic',
            `cf_admin` = '{$cf_admin}',
            `cf_admin_email` = '{$cf_admin_email}',
            `cf_admin_email_name` = '{$cf_title}',
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
            `cf_visit` = '오늘:0,어제:0,최대:0,전체:0',
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
            `cf_icode_id` = '',
            `cf_icode_pw` = '',
            `cf_icode_server_ip` = '',
            `cf_icode_server_port` = '',
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
            `cf_1_subj` = '',
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
    sql_query($sql);

    // 쇼핑몰설정 등록
    $sql = " INSERT INTO `g5_shop_default`
        SET `cn_id` = '{$cid}',
            `de_admin_company_owner` = '대표자명',
            `de_admin_company_name` = '회사명',
            `de_admin_company_saupja_no` = '123-45-67890',
            `de_admin_company_tel` = '02-123-4567',
            `de_admin_company_fax` = '02-123-4568',
            `de_admin_tongsin_no` = '제 OO구 - 123호',
            `de_admin_company_zip` = '123-456',
            `de_admin_company_addr` = 'OO도 OO시 OO구 OO동 123-45',
            `de_admin_info_name` = '정보책임자명',
            `de_admin_info_email` = '정보책임자 E-mail',
            `de_shop_skin` = 'basic',
            `de_shop_mobile_skin` = 'basic',
            `de_type1_list_use` = 1,
            `de_type1_list_skin` = 'main.10.skin.php',
            `de_type1_list_mod` = 5,
            `de_type1_list_row` = 1,
            `de_type1_img_width` = 160,
            `de_type1_img_height` = 160,
            `de_type2_list_use` = 1,
            `de_type2_list_skin` = 'main.20.skin.php',
            `de_type2_list_mod` = 4,
            `de_type2_list_row` = 1,
            `de_type2_img_width` = 215,
            `de_type2_img_height` = 215,
            `de_type3_list_use` = 1,
            `de_type3_list_skin` = 'main.40.skin.php',
            `de_type3_list_mod` = 4,
            `de_type3_list_row` = 1,
            `de_type3_img_width` = 215,
            `de_type3_img_height` = 215,
            `de_type4_list_use` = 1,
            `de_type4_list_skin` = 'main.50.skin.php',
            `de_type4_list_mod` = 5,
            `de_type4_list_row` = 1,
            `de_type4_img_width` = 215,
            `de_type4_img_height` = 215,
            `de_type5_list_use` = 1,
            `de_type5_list_skin` = 'main.30.skin.php',
            `de_type5_list_mod` = 4,
            `de_type5_list_row` = 1,
            `de_type5_img_width` = 215,
            `de_type5_img_height` = 215,
            `de_mobile_type1_list_use` = 1,
            `de_mobile_type1_list_skin` = 'main.30.skin.php',
            `de_mobile_type1_list_mod` = 2,
            `de_mobile_type1_list_row` = 4,
            `de_mobile_type1_img_width` = 230,
            `de_mobile_type1_img_height` = 230,
            `de_mobile_type2_list_use` = 1,
            `de_mobile_type2_list_skin` = 'main.10.skin.php',
            `de_mobile_type2_list_mod` = 2,
            `de_mobile_type2_list_row` = 2,
            `de_mobile_type2_img_width` = 230,
            `de_mobile_type2_img_height` = 230,
            `de_mobile_type3_list_use` = 1,
            `de_mobile_type3_list_skin` = 'main.10.skin.php',
            `de_mobile_type3_list_mod` = 2,
            `de_mobile_type3_list_row` = 4,
            `de_mobile_type3_img_width` = 300,
            `de_mobile_type3_img_height` = 300,
            `de_mobile_type4_list_use` = 1,
            `de_mobile_type4_list_skin` = 'main.20.skin.php',
            `de_mobile_type4_list_mod` = 2,
            `de_mobile_type4_list_row` = 2,
            `de_mobile_type4_img_width` = 80,
            `de_mobile_type4_img_height` = 80,
            `de_mobile_type5_list_use` = 1,
            `de_mobile_type5_list_skin` = 'main.10.skin.php',
            `de_mobile_type5_list_mod` = 2,
            `de_mobile_type5_list_row` = 2,
            `de_mobile_type5_img_width` = 230,
            `de_mobile_type5_img_height` = 230,
            `de_rel_list_use` = 1,
            `de_rel_list_skin` = 'relation.10.skin.php',
            `de_rel_list_mod` = 5,
            `de_rel_img_width` = 215,
            `de_rel_img_height` = 215,
            `de_mobile_rel_list_use` = 1,
            `de_mobile_rel_list_skin` = 'relation.10.skin.php',
            `de_mobile_rel_list_mod` = 3,
            `de_mobile_rel_img_width` = 230,
            `de_mobile_rel_img_height` = 230,
            `de_search_list_skin` = 'list.10.skin.php',
            `de_search_list_mod` = 5,
            `de_search_list_row` = 5,
            `de_search_img_width` = 225,
            `de_search_img_height` = 225,
            `de_mobile_search_list_skin` = 'list.10.skin.php',
            `de_mobile_search_list_mod` = 2,
            `de_mobile_search_list_row` = 5,
            `de_mobile_search_img_width` = 230,
            `de_mobile_search_img_height` = 230,
            `de_listtype_list_skin` = 'list.10.skin.php',
            `de_listtype_list_mod` = 5,
            `de_listtype_list_row` = 5,
            `de_listtype_img_width` = 225,
            `de_listtype_img_height` = 225,
            `de_mobile_listtype_list_skin` = 'list.10.skin.php',
            `de_mobile_listtype_list_mod` = 2,
            `de_mobile_listtype_list_row` = 5,
            `de_mobile_listtype_img_width` = 230,
            `de_mobile_listtype_img_height` = 230,
            `de_bank_use` = 1,
            `de_bank_account` = 'OO은행 12345-67-89012 예금주명',
            `de_card_test` = 1,
            `de_card_use` = 0,
            `de_card_noint_use` = 0,
            `de_card_point` = 0,
            `de_settle_min_point` = 5000,
            `de_settle_max_point` = 50000,
            `de_settle_point_unit` = 100,
            `de_level_sell` = 1,
            `de_delivery_company` = '',
            `de_send_cost_case` = '차등',
            `de_send_cost_limit` = '20000;30000;40000',
            `de_send_cost_list` = '4000;3000;2000',
            `de_hope_date_use` = 0,
            `de_hope_date_after` = 3,
            `de_baesong_content` = '배송 안내 입력전입니다.',
            `de_change_content` = '교환/반품 안내 입력전입니다.',
            `de_point_days` = 7,
            `de_simg_width` = 230,
            `de_simg_height` = 230,
            `de_mimg_width` = 300,
            `de_mimg_height` = 300,
            `de_sms_cont1` = '{이름}님의 회원가입을 축하드립니다.\nID:{회원아이디}\n{회사명}',
            `de_sms_cont2` = '{이름}님 주문해주셔서 고맙습니다.\n{주문번호}\n{주문금액}원\n{회사명}',
            `de_sms_cont3` = '{이름}님께서 주문하셨습니다.\n{주문번호}\n{주문금액}원\n{회사명}',
            `de_sms_cont4` = '{이름}님 입금 감사합니다.\n{입금액}원\n주문번호:\n{주문번호}\n{회사명}',
            `de_sms_cont5` = '{이름}님 배송합니다.\n택배:{택배회사}\n운송장번호:\n{운송장번호}\n{회사명}',
            `de_sms_use1` = 0,
            `de_sms_use2` = 0,
            `de_sms_use3` = 0,
            `de_sms_use4` = 0,
            `de_sms_use5` = 0,
            `de_sms_hp` = '',
            `de_pg_service` = 'kcp',
            `de_kcp_mid` = '',
            `de_kcp_site_key` = '',
            `de_inicis_mid` = '',
            `de_inicis_admin_key` = '',
            `de_inicis_sign_key` = '',
            `de_iche_use` = 0,
            `de_easy_pay_use` = 0,
            `de_easy_pay_services` = '',
            `de_samsung_pay_use` = 0,
            `de_inicis_lpay_use` = 0,
            `de_inicis_kakaopay_use` = 0,
            `de_inicis_cartpoint_use` = 0,
            `de_item_use_use` = 1,
            `de_item_use_write` = 0,
            `de_code_dup_use` = 1,
            `de_cart_keep_term` = 15,
            `de_guest_cart_use` = 0,
            `de_admin_buga_no` = '12345호',
            `de_vbank_use` = '0',
            `de_taxsave_use` = 0,
            `de_taxsave_types` = 'account',
            `de_guest_privacy` = '',
            `de_hp_use` = 0,
            `de_escrow_use` = 0,
            `de_tax_flag_use` = 0,
            `de_kakaopay_mid` = '',
            `de_kakaopay_key` = '',
            `de_kakaopay_enckey` = '',
            `de_kakaopay_hashkey` = '',
            `de_kakaopay_cancelpwd` = '',
            `de_naverpay_mid` = '',
            `de_naverpay_cert_key` = '',
            `de_naverpay_button_key` = '',
            `de_naverpay_test` = 0,
            `de_naverpay_mb_id` = '',
            `de_naverpay_sendcost` = '',
            `de_member_reg_coupon_use` = 0,
            `de_member_reg_coupon_term` = 0,
            `de_member_reg_coupon_price` = 0,
            `de_member_reg_coupon_minimum` =  0 ";
    sql_query($sql);
}