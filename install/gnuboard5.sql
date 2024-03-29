-- --------------------------------------------------------

--
-- Table structure for table `g5_channel`
--

DROP TABLE IF EXISTS `g5_channel`;
CREATE TABLE IF NOT EXISTS `g5_channel` (
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `cg_id` int(11) NOT NULL default '0' COMMENT '채널그룹 ID',
  `cn_name` varchar(255) NOT NULL default '' COMMENT '채널 명',
  `cn_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '채널 등록일시',
  PRIMARY KEY  (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_channel_group`
--

DROP TABLE IF EXISTS `g5_channel_group`;
CREATE TABLE IF NOT EXISTS `g5_channel_group` (
  `cg_id` int(11) NOT NULL auto_increment COMMENT '채널그룹 ID',
  `cg_name` varchar(255) NOT NULL default '' COMMENT '채널그룹 명',
  `cg_admin` varchar(20) NOT NULL default '' COMMENT '채널그룹 관리자',
  `cg_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '채널그룹 등록일시',
  PRIMARY KEY  (`cg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_channel_host`
--

DROP TABLE IF EXISTS `g5_channel_host`;
CREATE TABLE IF NOT EXISTS `g5_channel_host` (
  `ch_id` int(11) NOT NULL auto_increment COMMENT '채널호스트 ID',
  `ch_host` varchar(255) NOT NULL default '' COMMENT '채널 호스트',
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `ch_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '채널호스트 등록일시',
  PRIMARY KEY  (`ch_id`),
  UNIQUE KEY `ch_host` (`ch_host`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_auth`
--

DROP TABLE IF EXISTS `g5_auth`;
CREATE TABLE IF NOT EXISTS `g5_auth` (
  `cn_id` varchar(20) NOT NULL default '',
  `mb_id` varchar(20) NOT NULL default '',
  `au_menu` varchar(20) NOT NULL default '',
  `au_auth` set('r','w','d') NOT NULL default '',
  PRIMARY KEY  (`cn_id`, `mb_id`,`au_menu`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_board`
--

DROP TABLE IF EXISTS `g5_board`;
CREATE TABLE IF NOT EXISTS `g5_board` (
  `bo_id` int(11) NOT NULL auto_increment COMMENT '게시판 ID',
  `cn_id` varchar(20) NOT NULL COMMENT '채널 ID',
  `bo_table` varchar(20) NOT NULL DEFAULT '게시판 TABLE',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint NOT NULL DEFAULT '0',
  `bo_read_level` tinyint NOT NULL DEFAULT '0',
  `bo_write_level` tinyint NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint NOT NULL DEFAULT '0',
  `bo_download_level` tinyint NOT NULL DEFAULT '0',
  `bo_html_level` tinyint NOT NULL DEFAULT '0',
  `bo_link_level` tinyint NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint NOT NULL DEFAULT '0',
  `bo_category_list` mediumtext NOT NULL,
  `bo_use_sideview` tinyint NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint NOT NULL DEFAULT '0',
  `bo_select_editor` varchar(50) NOT NULL DEFAULT '',
  `bo_use_rss_view` tinyint NOT NULL DEFAULT '0',
  `bo_use_good` tinyint NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint NOT NULL DEFAULT '0',
  `bo_use_name` tinyint NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint NOT NULL DEFAULT '0',
  `bo_use_list_file` tinyint NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` mediumtext NOT NULL,
  `bo_mobile_content_head` mediumtext NOT NULL,
  `bo_content_tail` mediumtext NOT NULL,
  `bo_mobile_content_tail` mediumtext NOT NULL,
  `bo_insert_content` mediumtext NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint NOT NULL DEFAULT '0',
  `bo_use_search` tinyint NOT NULL DEFAULT '0',
  `bo_order` int NOT NULL DEFAULT '0',
  `bo_count_write` int NOT NULL DEFAULT '0',
  `bo_count_comment` int NOT NULL DEFAULT '0',
  `bo_write_min` int NOT NULL DEFAULT '0',
  `bo_write_max` int NOT NULL DEFAULT '0',
  `bo_comment_min` int NOT NULL DEFAULT '0',
  `bo_comment_max` int NOT NULL DEFAULT '0',
  `bo_notice` mediumtext NOT NULL,
  `bo_upload_count` tinyint NOT NULL DEFAULT '0',
  `bo_use_email` tinyint NOT NULL DEFAULT '0',
  `bo_use_cert` enum('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '',
  `bo_use_sns` tinyint NOT NULL DEFAULT '0',
  `bo_use_captcha` tinyint NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bo_id`),
  UNIQUE KEY `fkey1` (`cn_id`, `bo_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_board_file`
--

DROP TABLE IF EXISTS `g5_board_file`;
CREATE TABLE IF NOT EXISTS `g5_board_file` (
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `bo_table` varchar(20) NOT NULL DEFAULT '' COMMENT '게시판 TABLE',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `bf_no` int(11) NOT NULL DEFAULT '0',
  `bf_source` varchar(255) NOT NULL DEFAULT '',
  `bf_file` varchar(255) NOT NULL DEFAULT '',
  `bf_download` int(11) NOT NULL,
  `bf_content` mediumtext NOT NULL,
  `bf_fileurl` varchar(255) NOT NULL DEFAULT '',
  `bf_thumburl` varchar(255) NOT NULL DEFAULT '',
  `bf_storage` varchar(50) NOT NULL DEFAULT '',
  `bf_filesize` int(11) NOT NULL DEFAULT '0',
  `bf_width` int(11) NOT NULL DEFAULT '0',
  `bf_height` smallint NOT NULL DEFAULT '0',
  `bf_type` tinyint NOT NULL DEFAULT '0',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`cn_id`,`bo_table`,`wr_id`,`bf_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_board_good`
--

DROP TABLE IF EXISTS `g5_board_good`;
CREATE TABLE IF NOT EXISTS `g5_board_good` (
  `bg_id` int(11) NOT NULL auto_increment,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bg_flag` varchar(255) NOT NULL DEFAULT '',
  `bg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bg_id`),
  UNIQUE KEY `fkey1` (`cn_id`,`bo_table`,`wr_id`,`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_board_new`
--

DROP TABLE IF EXISTS `g5_board_new`;
CREATE TABLE IF NOT EXISTS `g5_board_new` (
  `bn_id` int(11) NOT NULL auto_increment,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` int(11) NOT NULL default '0',
  `wr_parent` int(11) NOT NULL default '0',
  `bn_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`bn_id`),
  KEY `cn_id` (`cn_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_config`
--

DROP TABLE IF EXISTS `g5_config`;
CREATE TABLE IF NOT EXISTS `g5_config` (
  `cf_id` int(11) NOT NULL auto_increment COMMENT '환경설정 ID',
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `cf_title` varchar(255) NOT NULL DEFAULT '' COMMENT '홈페이지 제목',
  `cf_theme` varchar(100) NOT NULL DEFAULT '' COMMENT '설정 테마',
  `cf_admin` varchar(100) NOT NULL DEFAULT '' COMMENT '최고관리자',
  `cf_admin_email` varchar(100) NOT NULL DEFAULT '' COMMENT '관리자 이메일',
  `cf_admin_email_name` varchar(100) NOT NULL DEFAULT '' COMMENT '관리자 이메일 발송명',
  `cf_add_script` text NOT NULL COMMENT '추가 SCRIPT/CSS',
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0' COMMENT '포인트 사용',
  `cf_point_term` int(11) NOT NULL DEFAULT '0' COMMENT '포인트 유효기간',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0' COMMENT '복사/이동시 로그',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0' COMMENT '메일인증 사용',
  `cf_login_point` int(11) NOT NULL DEFAULT '0' COMMENT '로그인시 포인트',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0' COMMENT '이름(닉네임) 표시',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0' COMMENT '닉네임 수정',
  `cf_new_skin` varchar(50) NOT NULL DEFAULT '' COMMENT '최근게시물 스킨',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0' COMMENT '최근게시물 라인수',
  `cf_search_skin` varchar(50) NOT NULL DEFAULT '' COMMENT '검색 스킨',
  `cf_connect_skin` varchar(50) NOT NULL DEFAULT '' COMMENT '접속자 스킨',
  `cf_faq_skin` varchar(50) NOT NULL DEFAULT '' COMMENT 'FAQ 스킨',
  `cf_read_point` int(11) NOT NULL DEFAULT '0' COMMENT '글읽기 포인트',
  `cf_write_point` int(11) NOT NULL DEFAULT '0' COMMENT '글쓰기 포인트',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0' COMMENT '댓글쓰기 포인트',
  `cf_download_point` int(11) NOT NULL DEFAULT '0' COMMENT '다운로드 포인트',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0' COMMENT '페이지 표시 수',
  `cf_mobile_pages` int(11) NOT NULL DEFAULT '0' COMMENT '페이지 표시 수',
  `cf_link_target` varchar(50) NOT NULL DEFAULT '' COMMENT '새창 링크',
  `cf_bbs_rewrite` tinyint(4) NOT NULL DEFAULT '0',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0' COMMENT '글쓰기 간격',
  `cf_filter` text NOT NULL COMMENT '단어 필터링',
  `cf_possible_ip` text NOT NULL COMMENT '접근가능 IP',
  `cf_intercept_ip` text NOT NULL COMMENT '접근불가 IP',
  `cf_analytics` text NOT NULL COMMENT '방문자분석 스크립트',
  `cf_add_meta` text NOT NULL COMMENT '추가 메타태그',
  `cf_syndi_token` varchar(255) NOT NULL DEFAULT '',
  `cf_syndi_except` mediumtext NOT NULL,
  `cf_member_skin` varchar(50) NOT NULL DEFAULT '' COMMENT '회원 스킨',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0' COMMENT '홈페이지 입력 보이기',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0' COMMENT '홈페이지 필수입력',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '전화번호 입력 보이기',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '전화번호 필수입력',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0' COMMENT '휴대전화번호 입력 보이기',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0' COMMENT '휴대전화번호 필수입력',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0' COMMENT '주소 입력 보이기',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0' COMMENT '주소 필수입력',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0' COMMENT '서명 입력 보이기',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0' COMMENT '서명 필수입력',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0' COMMENT '자기소개 입력 보이기',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0' COMMENT '자기소개 필수입력',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '회원가입시 권한',
  `cf_register_point` int(11) NOT NULL DEFAULT '0' COMMENT '회원가입시 포인트',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '아이콘 업로드 권한',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '추천인제도 사용',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0' COMMENT '추천인 포인트',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0' COMMENT '회원탈퇴후 삭제일자',
  `cf_search_part` int(11) NOT NULL DEFAULT '0' COMMENT '검색 단위',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '이메일발송 사용',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '게시글 작성 최고관리자 발송',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '게시글 작성 그룹관리자 발송',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '게시글 작성 게시판관리자 발송',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0' COMMENT '게시글 작성 원글작성자 발송',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0' COMMENT '게시글 작성 댓글작성자 발송',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '회원가입 최고관리자 발송',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0' COMMENT '회원가입 회원 발송',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '투표 기타의견 최고관리자 발송',
  `cf_prohibit_id` text NOT NULL COMMENT '아이디, 닉네임 금지단어',
  `cf_prohibit_email` text NOT NULL COMMENT '입력 금지 메일',
  `cf_new_del` int(11) NOT NULL DEFAULT '0' COMMENT '최근게시물 삭제',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0' COMMENT '쪽지 삭제',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0' COMMENT '접속자로그 삭제',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0' COMMENT '인기검색어 삭제',
  `cf_optimize_date` date NOT NULL default '0000-00-00' COMMENT '설정 실행일',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0' COMMENT '회원아이콘 사용',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0' COMMENT '회원아이콘 용량',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0' COMMENT '회원아이콘 폭',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0' COMMENT '회원아이콘 높이',
  `cf_member_img_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0' COMMENT '현재접속자',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '' COMMENT '이미지화일 업로드 확장자',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '' COMMENT '플래쉬 업로드 확장자',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '' COMMENT '동영상 업로드 확장자',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0' COMMENT '폼메일 사용여부',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0' COMMENT '한페이지당 라인수',
  `cf_mobile_page_rows` int(11) NOT NULL DEFAULT '0' COMMENT '모바일 한페이지당 라인수',
  `cf_visit` varchar(255) NOT NULL DEFAULT '' COMMENT '방문자수',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0' COMMENT '가장 큰 투표번호',
  `cf_stipulation` text NOT NULL COMMENT '회원가입약관',
  `cf_privacy` text NOT NULL COMMENT '개인정보처리방침',
  `cf_open_modify` int(11) NOT NULL DEFAULT '0' COMMENT '정보공개 수정',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0' COMMENT '쪽지전송 차감포인트',
  `cf_mobile_new_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_search_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_connect_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_faq_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_member_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_captcha_mp3` varchar(255) NOT NULL DEFAULT '',
  `cf_editor` varchar(50) NOT NULL DEFAULT '',
  `cf_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_find` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_ipin` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_hp` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_simple` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kg_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kg_mid` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcb_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcp_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_lg_mid` varchar(100) NOT NULL DEFAULT '',
  `cf_lg_mert_key` varchar(100) NOT NULL DEFAULT '',
  `cf_cert_limit` int(11) NOT NULL DEFAULT '0',
  `cf_cert_req` tinyint(4) NOT NULL DEFAULT '0',
  `cf_sms_use` varchar(255) NOT NULL DEFAULT '',
  `cf_sms_type` varchar(10) NOT NULL DEFAULT '',
  `cf_icode_id` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_pw` varchar(255) NOT NULL DEFAULT '',  
  `cf_icode_server_ip` varchar(50) NOT NULL DEFAULT '',
  `cf_icode_server_port` varchar(50) NOT NULL DEFAULT '',
  `cf_icode_token_key` varchar(100) NOT NULL DEFAULT '',
  `cf_googl_shorturl_apikey` varchar(50) NOT NULL DEFAULT '',
  `cf_social_login_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_social_servicelist` varchar(255) NOT NULL DEFAULT '',
  `cf_payco_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_payco_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_facebook_appid` varchar(100) NOT NULL,
  `cf_facebook_secret` varchar(100) NOT NULL,
  `cf_twitter_key` varchar(100) NOT NULL,
  `cf_twitter_secret` varchar(100) NOT NULL,
  `cf_google_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_google_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_rest_key` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_client_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_js_apikey` varchar(100) NOT NULL,
  `cf_captcha` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_site_key` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_secret_key` varchar(100) NOT NULL DEFAULT '',
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`cf_id`),
  UNIQUE KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_cert_history`
--

DROP TABLE IF EXISTS `g5_cert_history`;
CREATE TABLE IF NOT EXISTS `g5_cert_history` (
  `cr_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `cr_company` varchar(255) NOT NULL DEFAULT '',
  `cr_method` varchar(255) NOT NULL DEFAULT '',
  `cr_ip` varchar(255) NOT NULL DEFAULT '',
  `cr_date` date NOT NULL DEFAULT '0000-00-00',
  `cr_time` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`cr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_cert_history`
--

DROP TABLE IF EXISTS `g5_member_cert_history`;
CREATE TABLE IF NOT EXISTS `g5_member_cert_history` (
  `ch_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `ch_name` varchar(255) NOT NULL DEFAULT '',
  `ch_hp` varchar(255) NOT NULL DEFAULT '',
  `ch_birth` varchar(255) NOT NULL DEFAULT '',
  `ch_type` varchar(20) NOT NULL DEFAULT '',
  `ch_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`ch_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_group`
--

DROP TABLE IF EXISTS `g5_group`;
CREATE TABLE IF NOT EXISTS `g5_group` (
  `gr_no` int(11) NOT NULL auto_increment COMMENT '게시판 그룹 번호',
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `gr_id` varchar(10) NOT NULL default '',
  `gr_subject` varchar(255) NOT NULL default '',
  `gr_device` ENUM('both','pc','mobile') NOT NULL DEFAULT 'both',
  `gr_admin` varchar(255) NOT NULL default '',
  `gr_use_access` tinyint(4) NOT NULL default '0',
  `gr_order` int(11) NOT NULL default '0',
  `gr_1_subj` varchar(255) NOT NULL default '',
  `gr_2_subj` varchar(255) NOT NULL default '',
  `gr_3_subj` varchar(255) NOT NULL default '',
  `gr_4_subj` varchar(255) NOT NULL default '',
  `gr_5_subj` varchar(255) NOT NULL default '',
  `gr_6_subj` varchar(255) NOT NULL default '',
  `gr_7_subj` varchar(255) NOT NULL default '',
  `gr_8_subj` varchar(255) NOT NULL default '',
  `gr_9_subj` varchar(255) NOT NULL default '',
  `gr_10_subj` varchar(255) NOT NULL default '',
  `gr_1` varchar(255) NOT NULL default '',
  `gr_2` varchar(255) NOT NULL default '',
  `gr_3` varchar(255) NOT NULL default '',
  `gr_4` varchar(255) NOT NULL default '',
  `gr_5` varchar(255) NOT NULL default '',
  `gr_6` varchar(255) NOT NULL default '',
  `gr_7` varchar(255) NOT NULL default '',
  `gr_8` varchar(255) NOT NULL default '',
  `gr_9` varchar(255) NOT NULL default '',
  `gr_10` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`gr_no`),
  UNIQUE KEY `fkey1` (`cn_id`,`gr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_group_member`
--

DROP TABLE IF EXISTS `g5_group_member`;
CREATE TABLE IF NOT EXISTS `g5_group_member` (
  `gm_id` int(11) NOT NULL auto_increment,
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `gr_id` varchar(255) NOT NULL default '',
  `mb_id` varchar(20) NOT NULL default '',
  `gm_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`gm_id`),
  KEY `cn_id` (`cn_id`),
  KEY `gr_id` (`gr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_login`
--

DROP TABLE IF EXISTS `g5_login`;
CREATE TABLE IF NOT EXISTS `g5_login` (
  `lo_ip` varchar(100) NOT NULL default '',
  `mb_id` varchar(20) NOT NULL default '',
  `lo_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL,
  PRIMARY KEY  (`lo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_mail`
--

DROP TABLE IF EXISTS `g5_mail`;
CREATE TABLE IF NOT EXISTS `g5_mail` (
  `ma_id` int(11) NOT NULL auto_increment,
  `ma_subject` varchar(255) NOT NULL default '',
  `ma_content` mediumtext NOT NULL,
  `ma_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ma_ip` varchar(255) NOT NULL default '',
  `ma_last_option` text NOT NULL,
  PRIMARY KEY  (`ma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_member`
--

DROP TABLE IF EXISTS `g5_member`;
CREATE TABLE IF NOT EXISTS `g5_member` (
  `mb_no` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL default '',
  `mb_password` varchar(255) NOT NULL default '',
  `mb_name` varchar(255) NOT NULL default '',
  `mb_nick` varchar(255) NOT NULL default '',
  `mb_nick_date` date NOT NULL default '0000-00-00',
  `mb_email` varchar(255) NOT NULL default '',
  `mb_homepage` varchar(255) NOT NULL default '',
  `mb_level` tinyint(4) NOT NULL default '0',
  `mb_sex` char(1) NOT NULL default '',
  `mb_birth` varchar(255) NOT NULL default '',
  `mb_tel` varchar(255) NOT NULL default '',
  `mb_hp` varchar(255) NOT NULL default '',
  `mb_certify` varchar(20) NOT NULL default '',
  `mb_adult` tinyint(4) NOT NULL default '0',
  `mb_dupinfo` varchar(255) NOT NULL default '',
  `mb_zip1` char(3) NOT NULL default '',
  `mb_zip2` char(3) NOT NULL default '',
  `mb_addr1` varchar(255) NOT NULL default '',
  `mb_addr2` varchar(255) NOT NULL default '',
  `mb_addr3` varchar(255) NOT NULL default '',
  `mb_addr_jibeon` varchar(255) NOT NULL default '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL default '',
  `mb_point` int(11) NOT NULL default '0',
  `mb_today_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL default '',
  `mb_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL default '',
  `mb_leave_date` varchar(8) NOT NULL default '',
  `mb_intercept_date` varchar(8) NOT NULL default '',
  `mb_email_certify` datetime NOT NULL default '0000-00-00 00:00:00',
  `mb_email_certify2` varchar(255) NOT NULL default '',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL default '0',
  `mb_sms` tinyint(4) NOT NULL default '0',
  `mb_open` tinyint(4) NOT NULL default '0',
  `mb_open_date` date NOT NULL default '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL default '',
  `mb_memo_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_scrap_cnt` int(11) NOT NULL default '0',
  `mb_1` varchar(255) NOT NULL default '',
  `mb_2` varchar(255) NOT NULL default '',
  `mb_3` varchar(255) NOT NULL default '',
  `mb_4` varchar(255) NOT NULL default '',
  `mb_5` varchar(255) NOT NULL default '',
  `mb_6` varchar(255) NOT NULL default '',
  `mb_7` varchar(255) NOT NULL default '',
  `mb_8` varchar(255) NOT NULL default '',
  `mb_9` varchar(255) NOT NULL default '',
  `mb_10` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_memo`
--

DROP TABLE IF EXISTS `g5_memo`;
CREATE TABLE IF NOT EXISTS `g5_memo` (
  `me_id` INT(11) NOT NULL AUTO_INCREMENT,
  `me_recv_mb_id` varchar(20) NOT NULL default '',
  `me_send_mb_id` varchar(20) NOT NULL default '',
  `me_send_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  `me_send_id` INT(11) NOT NULL DEFAULT '0',
  `me_type` ENUM('send','recv') NOT NULL DEFAULT 'recv',
  `me_send_ip` VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY  (`me_id`),
  KEY `me_recv_mb_id` (`me_recv_mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_menu`
--

DROP TABLE IF EXISTS `g5_menu`;
CREATE TABLE IF NOT EXISTS `g5_menu` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '메뉴 ID',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `me_code` varchar(255) NOT NULL DEFAULT '' COMMENT '메뉴 코드',
  `me_name` varchar(255) NOT NULL DEFAULT '' COMMENT '메뉴 명',
  `me_link` varchar(255) NOT NULL DEFAULT '' COMMENT '메뉴 링크',
  `me_target` varchar(255) NOT NULL DEFAULT '0' COMMENT '새창',
  `me_order` int(11) NOT NULL DEFAULT '0' COMMENT '출력 순서',
  `me_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '메뉴 사용여부(PC)',
  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '메뉴 사용여부(MOBILE)',
  PRIMARY KEY (`me_id`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_point`
--

DROP TABLE IF EXISTS `g5_point`;
CREATE TABLE IF NOT EXISTS `g5_point` (
  `po_id` int(11) NOT NULL auto_increment,
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `mb_id` varchar(20) NOT NULL default '',
  `po_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL default '',
  `po_point` int(11) NOT NULL default '0',
  `po_use_point` int(11) NOT NULL default '0',
  `po_expired` tinyint(4) NOT NULL default '0',
  `po_expire_date` date NOT NULL default '0000-00-00',
  `po_mb_point` int(11) NOT NULL default '0',
  `po_rel_table` varchar(20) NOT NULL default '',
  `po_rel_id` varchar(20) NOT NULL default '',
  `po_rel_action` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`po_id`),
  KEY `index1` (`cn_id`,`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`),
  KEY `index2` (`po_expire_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_poll`
--

DROP TABLE IF EXISTS `g5_poll`;
CREATE TABLE IF NOT EXISTS `g5_poll` (
  `po_id` int(11) NOT NULL auto_increment,
  `po_subject` varchar(255) NOT NULL default '',
  `po_poll1` varchar(255) NOT NULL default '',
  `po_poll2` varchar(255) NOT NULL default '',
  `po_poll3` varchar(255) NOT NULL default '',
  `po_poll4` varchar(255) NOT NULL default '',
  `po_poll5` varchar(255) NOT NULL default '',
  `po_poll6` varchar(255) NOT NULL default '',
  `po_poll7` varchar(255) NOT NULL default '',
  `po_poll8` varchar(255) NOT NULL default '',
  `po_poll9` varchar(255) NOT NULL default '',
  `po_cnt1` int(11) NOT NULL default '0',
  `po_cnt2` int(11) NOT NULL default '0',
  `po_cnt3` int(11) NOT NULL default '0',
  `po_cnt4` int(11) NOT NULL default '0',
  `po_cnt5` int(11) NOT NULL default '0',
  `po_cnt6` int(11) NOT NULL default '0',
  `po_cnt7` int(11) NOT NULL default '0',
  `po_cnt8` int(11) NOT NULL default '0',
  `po_cnt9` int(11) NOT NULL default '0',
  `po_etc` varchar(255) NOT NULL default '',
  `po_level` tinyint(4) NOT NULL default '0',
  `po_point` int(11) NOT NULL default '0',
  `po_date` date NOT NULL default '0000-00-00',
  `po_ips` mediumtext NOT NULL,
  `mb_ids` text NOT NULL,
  `po_use` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_poll_etc`
--

DROP TABLE IF EXISTS `g5_poll_etc`;
CREATE TABLE IF NOT EXISTS `g5_poll_etc` (
  `pc_id` int(11) NOT NULL default '0',
  `po_id` int(11) NOT NULL default '0',
  `mb_id` varchar(20) NOT NULL default '',
  `pc_name` varchar(255) NOT NULL default '',
  `pc_idea` varchar(255) NOT NULL default '',
  `pc_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`pc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_popular`
--

DROP TABLE IF EXISTS `g5_popular`;
CREATE TABLE IF NOT EXISTS `g5_popular` (
  `pp_id` int(11) NOT NULL auto_increment,
  `pp_word` varchar(50) NOT NULL default '',
  `pp_date` date NOT NULL default '0000-00-00',
  `pp_ip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`pp_id`),
  UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_scrap`
--

DROP TABLE IF EXISTS `g5_scrap`;
CREATE TABLE IF NOT EXISTS `g5_scrap` (
  `ms_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL default '',
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` varchar(15) NOT NULL default '',
  `ms_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ms_id`),
  KEY `cn_id` (`cn_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_visit`
--

DROP TABLE IF EXISTS `g5_visit`;
CREATE TABLE IF NOT EXISTS `g5_visit` (
  `vi_id` int(11) NOT NULL default '0',
  `vi_ip` varchar(100) NOT NULL default '',
  `vi_date` date NOT NULL default '0000-00-00',
  `vi_time` time NOT NULL default '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(200) NOT NULL default '',
  `vi_browser` varchar(255) NOT NULL DEFAULT '',
  `vi_os` varchar(255) NOT NULL DEFAULT '',
  `vi_device` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_visit_sum`
--

DROP TABLE IF EXISTS `g5_visit_sum`;
CREATE TABLE IF NOT EXISTS `g5_visit_sum` (
  `vs_date` date NOT NULL default '0000-00-00',
  `vs_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_unique`
--

DROP TABLE IF EXISTS `g5_uniqid`;
CREATE TABLE IF NOT EXISTS `g5_uniqid` (
  `uq_id` bigint(20) unsigned NOT NULL,
  `uq_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`uq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_autosave`
--

DROP TABLE IF EXISTS `g5_autosave`;
CREATE TABLE IF NOT EXISTS `g5_autosave` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `as_uid` bigint(20) unsigned NOT NULL,
  `as_subject` varchar(255) NOT NULL,
  `as_content` text NOT NULL,
  `as_datetime` datetime NOT NULL,
  PRIMARY KEY (`as_id`),
  UNIQUE KEY `as_uid` (`as_uid`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_qa_config`
--

DROP TABLE IF EXISTS `g5_qa_config`;
CREATE TABLE IF NOT EXISTS `g5_qa_config` (
  `qa_no` int NOT NULL auto_increment COMMENT '1:1문의설정 번호',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `qa_title` varchar(255) NOT NULL DEFAULT '',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_use_email` tinyint NOT NULL DEFAULT '0',
  `qa_req_email` tinyint NOT NULL DEFAULT '0',
  `qa_use_hp` tinyint NOT NULL DEFAULT '0',
  `qa_req_hp` tinyint NOT NULL DEFAULT '0',
  `qa_use_sms` tinyint NOT NULL DEFAULT '0',
  `qa_send_number` varchar(255) NOT NULL DEFAULT '0',
  `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_admin_email` varchar(255) NOT NULL DEFAULT '',
  `qa_use_editor` tinyint NOT NULL DEFAULT '0',
  `qa_subject_len` int NOT NULL DEFAULT '0',
  `qa_mobile_subject_len` int NOT NULL DEFAULT '0',
  `qa_page_rows` int NOT NULL DEFAULT '0',
  `qa_mobile_page_rows` int NOT NULL DEFAULT '0',
  `qa_image_width` int NOT NULL DEFAULT '0',
  `qa_upload_size` int NOT NULL DEFAULT '0',
  `qa_insert_content` mediumtext NOT NULL,
  `qa_include_head` varchar(255) NOT NULL DEFAULT '',
  `qa_include_tail` varchar(255) NOT NULL DEFAULT '',
  `qa_content_head` mediumtext NOT NULL,
  `qa_content_tail` mediumtext NOT NULL,
  `qa_mobile_content_head` mediumtext NOT NULL,
  `qa_mobile_content_tail` mediumtext NOT NULL,
  `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`qa_no`),
  UNIQUE KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_qa_content`
--

DROP TABLE IF EXISTS `g5_qa_content`;
CREATE TABLE IF NOT EXISTS `g5_qa_content` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `qa_num` int(11) NOT NULL DEFAULT '0',  
  `qa_parent` int(11) NOT NULL DEFAULT '0',
  `qa_related` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `qa_name` varchar(255) NOT NULL DEFAULT '',
  `qa_email` varchar(255) NOT NULL DEFAULT '',
  `qa_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_type` tinyint(4) NOT NULL DEFAULT '0',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_html` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject` varchar(255) NOT NULL DEFAULT '',
  `qa_content` text NOT NULL,
  `qa_status` tinyint(4) NOT NULL DEFAULT '0',
  `qa_file1` varchar(255) NOT NULL DEFAULT '',
  `qa_source1` varchar(255) NOT NULL DEFAULT '',
  `qa_file2` varchar(255) NOT NULL DEFAULT '',
  `qa_source2` varchar(255) NOT NULL DEFAULT '',
  `qa_ip` varchar(255) NOT NULL DEFAULT '',
  `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`qa_id`),
  KEY `cn_id` (`cn_id`),
  KEY `qa_num_parent` (`qa_num`,`qa_parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_content`
--

DROP TABLE IF EXISTS `g5_content`;
CREATE TABLE IF NOT EXISTS `g5_content` (
  `co_no` int NOT NULL auto_increment COMMENT '콘텐츠 번호',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `co_id` varchar(20) NOT NULL DEFAULT '' COMMENT '콘텐츠 ID',
  `co_html` tinyint NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_seo_title` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_content` longtext NOT NULL,
  `co_skin` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `co_tag_filter_use` tinyint NOT NULL DEFAULT '0',
  `co_hit` int NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL,
  PRIMARY KEY  (`co_no`),
  UNIQUE KEY `fkey1` (`cn_id`,`co_id`),
  KEY `co_seo_title` (`co_seo_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_faq`
--

DROP TABLE IF EXISTS `g5_faq`;
CREATE TABLE IF NOT EXISTS `g5_faq` (
  `fa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fa_id`),
  KEY `fm_id` (`fm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_faq_master`
--

DROP TABLE IF EXISTS `g5_faq_master`;
CREATE TABLE IF NOT EXISTS `g5_faq_master` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_mobile_head_html` text NOT NULL,
  `fm_mobile_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_member_social_profiles`
--

DROP TABLE IF EXISTS `g5_member_social_profiles`;
CREATE TABLE IF NOT EXISTS `g5_member_social_profiles` (
  `mp_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `provider` varchar(50) NOT NULL DEFAULT '',
  `object_sha` varchar(45) NOT NULL DEFAULT '',
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `profileurl` varchar(255) NOT NULL DEFAULT '',
  `photourl` varchar(255) NOT NULL DEFAULT '',
  `displayname` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `mp_register_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mp_latest_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `mp_no` (`mp_no`),
  KEY `mb_id` (`mb_id`),
  KEY `provider` (`provider`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_new_win`
--

DROP TABLE IF EXISTS `g5_new_win`;
CREATE TABLE IF NOT EXISTS `g5_new_win` (
  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
  `nw_division` varchar(10) NOT NULL DEFAULT 'both',
  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
  `nw_left` int(11) NOT NULL DEFAULT '0',
  `nw_top` int(11) NOT NULL DEFAULT '0',
  `nw_height` int(11) NOT NULL DEFAULT '0',
  `nw_width` int(11) NOT NULL DEFAULT '0',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_menu`
--

DROP TABLE IF EXISTS `g5_menu`;
CREATE TABLE IF NOT EXISTS `g5_menu` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT,
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `me_name` varchar(255) NOT NULL DEFAULT '',
  `me_link` varchar(255) NOT NULL DEFAULT '',
  `me_target` varchar(255) NOT NULL DEFAULT '',
  `me_order` int(11) NOT NULL DEFAULT '0',
  `me_use` tinyint(4) NOT NULL DEFAULT '0',
  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`me_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
