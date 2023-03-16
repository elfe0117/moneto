-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_brand`
--

DROP TABLE IF EXISTS `g5_shop_brand`;
CREATE TABLE IF NOT EXISTS `g5_shop_brand` (
  `br_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '브랜드 번호',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `br_name` varchar(255) NOT NULL DEFAULT '' COMMENT '브랜드 명',
  `br_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`br_no`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_banner`
--

DROP TABLE IF EXISTS `g5_shop_banner`;
CREATE TABLE IF NOT EXISTS `g5_shop_banner` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bn_alt` varchar(255) NOT NULL DEFAULT '',
  `bn_url` varchar(255) NOT NULL DEFAULT '',
  `bn_device` varchar(10) NOT NULL DEFAULT '',
  `bn_position` varchar(255) NOT NULL DEFAULT '',
  `bn_border` tinyint(4) NOT NULL DEFAULT '0',
  `bn_new_win` tinyint(4) NOT NULL DEFAULT '0',
  `bn_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_hit` int(11) NOT NULL DEFAULT '0',
  `bn_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_cart`
--

DROP TABLE IF EXISTS `g5_shop_cart`;
CREATE TABLE IF NOT EXISTS `g5_shop_cart` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `od_id` bigint(20) unsigned NOT NULL,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_sc_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_method` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_price` int(11) NOT NULL DEFAULT '0',
  `it_sc_minimum` int(11) NOT NULL DEFAULT '0',
  `it_sc_qty` int(11) NOT NULL DEFAULT '0',
  `ct_status` varchar(255) NOT NULL DEFAULT '',
  `ct_history` text NOT NULL,
  `ct_price` int(11) NOT NULL DEFAULT '0',
  `ct_point` int(11) NOT NULL DEFAULT '0',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `ct_point_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_stock_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_option` varchar(255) NOT NULL DEFAULT '',
  `ct_qty` int(11) NOT NULL DEFAULT '0',
  `ct_notax` tinyint(4) NOT NULL DEFAULT '0',
  `io_id` varchar(255) NOT NULL DEFAULT '',
  `io_type` tinyint(4) NOT NULL DEFAULT '0',
  `io_price` int(11) NOT NULL DEFAULT '0',
  `ct_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ct_ip` varchar(25) NOT NULL DEFAULT '',
  `ct_send_cost` tinyint(4) NOT NULL DEFAULT '0',
  `ct_direct` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `od_id` (`od_id`),
  KEY `cn_id` (`cn_id`),
  KEY `it_id` (`it_id`),
  KEY `ct_status` (`ct_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_category`
--

DROP TABLE IF EXISTS `g5_shop_category`;
CREATE TABLE IF NOT EXISTS `g5_shop_category` (
  `ca_no` int NOT NULL AUTO_INCREMENT COMMENT '카테고리 번호',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_name` varchar(255) NOT NULL DEFAULT '',
  `ca_order` int NOT NULL DEFAULT '0',
  `ca_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_img_width` int NOT NULL DEFAULT '0',
  `ca_img_height` int NOT NULL DEFAULT '0',
  `ca_mobile_img_width` int NOT NULL DEFAULT '0',
  `ca_mobile_img_height` int NOT NULL DEFAULT '0',
  `ca_sell_email` varchar(255) NOT NULL DEFAULT '',
  `ca_use` tinyint NOT NULL DEFAULT '0',
  `ca_stock_qty` int NOT NULL DEFAULT '0',
  `ca_explan_html` tinyint NOT NULL DEFAULT '0',
  `ca_head_html` mediumtext NOT NULL,
  `ca_tail_html` mediumtext NOT NULL,
  `ca_mobile_head_html` mediumtext NOT NULL,
  `ca_mobile_tail_html` mediumtext NOT NULL,
  `ca_list_mod` int NOT NULL DEFAULT '0',
  `ca_list_row` int NOT NULL DEFAULT '0',
  `ca_mobile_list_mod` int NOT NULL DEFAULT '0',
  `ca_mobile_list_row` int NOT NULL DEFAULT '0',
  `ca_include_head` varchar(255) NOT NULL DEFAULT '',
  `ca_include_tail` varchar(255) NOT NULL DEFAULT '',
  `ca_mb_id` varchar(255) NOT NULL DEFAULT '',
  `ca_cert_use` tinyint NOT NULL DEFAULT '0',
  `ca_adult_use` tinyint NOT NULL DEFAULT '0',
  `ca_nocoupon` tinyint NOT NULL DEFAULT '0',
  `ca_1_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_2_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_3_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_4_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_5_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_6_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_7_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_8_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_9_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_10_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_1` varchar(255) NOT NULL DEFAULT '',
  `ca_2` varchar(255) NOT NULL DEFAULT '',
  `ca_3` varchar(255) NOT NULL DEFAULT '',
  `ca_4` varchar(255) NOT NULL DEFAULT '',
  `ca_5` varchar(255) NOT NULL DEFAULT '',
  `ca_6` varchar(255) NOT NULL DEFAULT '',
  `ca_7` varchar(255) NOT NULL DEFAULT '',
  `ca_8` varchar(255) NOT NULL DEFAULT '',
  `ca_9` varchar(255) NOT NULL DEFAULT '',
  `ca_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ca_no`),
  UNIQUE KEY `fkey1` (`cn_id`, `ca_id`),
  KEY `ca_order` (`ca_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_coupon`
--

DROP TABLE IF EXISTS `g5_shop_coupon`;
CREATE TABLE IF NOT EXISTS `g5_shop_coupon` (
  `cp_no` int NOT NULL AUTO_INCREMENT,
  `cn_id` varchar(20) NOT NULL COMMENT '채널 ID',
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `cp_subject` varchar(255) NOT NULL DEFAULT '',
  `cp_method` tinyint NOT NULL DEFAULT '0',
  `cp_target` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `cz_id` int NOT NULL DEFAULT '0',
  `cp_start` date NOT NULL DEFAULT '0000-00-00',
  `cp_end` date NOT NULL DEFAULT '0000-00-00',
  `cp_price` int NOT NULL DEFAULT '0',
  `cp_type` tinyint NOT NULL DEFAULT '0',
  `cp_trunc` int NOT NULL DEFAULT '0',
  `cp_minimum` int NOT NULL DEFAULT '0',
  `cp_maximum` int NOT NULL DEFAULT '0',
  `od_id` bigint UNSIGNED NOT NULL,
  `cp_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cp_no`),
  UNIQUE KEY `fkey1` (`cn_id`, `cp_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_coupon_log`
--

DROP TABLE IF EXISTS `g5_shop_coupon_log`;
CREATE TABLE IF NOT EXISTS `g5_shop_coupon_log` (
  `cl_id` int NOT NULL AUTO_INCREMENT,
  `cn_id` varchar(100) NOT NULL DEFAULT '',
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `mb_id` varchar(100) NOT NULL DEFAULT '',
  `od_id` bigint NOT NULL,
  `cp_price` int NOT NULL DEFAULT '0',
  `cl_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cl_id`),
  KEY `fkey1` (`cn_id`, `cp_id`),
  KEY `mb_id` (`mb_id`),
  KEY `od_id` (`od_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_coupon_zone`
--

DROP TABLE IF EXISTS `g5_shop_coupon_zone`;
CREATE TABLE IF NOT EXISTS `g5_shop_coupon_zone` (
  `cz_id` int(11) NOT NULL AUTO_INCREMENT,
  `cz_type` tinyint(4) NOT NULL DEFAULT '0',
  `cz_subject` varchar(255) NOT NULL DEFAULT '',
  `cz_start` DATE NOT NULL DEFAULT '0000-00-00',
  `cz_end` DATE NOT NULL DEFAULT '0000-00-00',
  `cz_file` varchar(255) NOT NULL DEFAULT '',
  `cz_period` int(11) NOT NULL DEFAULT '0',
  `cz_point` INT(11) NOT NULL DEFAULT '0',
  `cp_method` TINYINT(4) NOT NULL DEFAULT '0',
  `cp_target` VARCHAR(255) NOT NULL DEFAULT '',
  `cp_price` INT(11) NOT NULL DEFAULT '0',
  `cp_type` TINYINT(4) NOT NULL DEFAULT '0',
  `cp_trunc` INT(11) NOT NULL DEFAULT '0',
  `cp_minimum` INT(11) NOT NULL DEFAULT '0',
  `cp_maximum` INT(11) NOT NULL DEFAULT '0',
  `cz_download` int(11) NOT NULL DEFAULT '0',
  `cz_datetime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_default`
--

DROP TABLE IF EXISTS `g5_shop_default`;
CREATE TABLE IF NOT EXISTS `g5_shop_default` (
  `de_id` int NOT NULL  AUTO_INCREMENT COMMENT '쇼핑몰설정 ID',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `de_admin_company_owner` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_saupja_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_tel` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_fax` varchar(255) NOT NULL DEFAULT '',
  `de_admin_tongsin_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_zip` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_addr` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_email` varchar(255) NOT NULL DEFAULT '',
  `de_shop_skin` varchar(255) NOT NULL DEFAULT '',
  `de_shop_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_use` tinyint NOT NULL DEFAULT '0',
  `de_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_mod` int NOT NULL DEFAULT '0',
  `de_type1_list_row` int NOT NULL DEFAULT '0',
  `de_type1_img_width` int NOT NULL DEFAULT '0',
  `de_type1_img_height` int NOT NULL DEFAULT '0',
  `de_type2_list_use` tinyint NOT NULL DEFAULT '0',
  `de_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type2_list_mod` int NOT NULL DEFAULT '0',
  `de_type2_list_row` int NOT NULL DEFAULT '0',
  `de_type2_img_width` int NOT NULL DEFAULT '0',
  `de_type2_img_height` int NOT NULL DEFAULT '0',
  `de_type3_list_use` tinyint NOT NULL DEFAULT '0',
  `de_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type3_list_mod` int NOT NULL DEFAULT '0',
  `de_type3_list_row` int NOT NULL DEFAULT '0',
  `de_type3_img_width` int NOT NULL DEFAULT '0',
  `de_type3_img_height` int NOT NULL DEFAULT '0',
  `de_type4_list_use` tinyint NOT NULL DEFAULT '0',
  `de_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type4_list_mod` int NOT NULL DEFAULT '0',
  `de_type4_list_row` int NOT NULL DEFAULT '0',
  `de_type4_img_width` int NOT NULL DEFAULT '0',
  `de_type4_img_height` int NOT NULL DEFAULT '0',
  `de_type5_list_use` tinyint NOT NULL DEFAULT '0',
  `de_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type5_list_mod` int NOT NULL DEFAULT '0',
  `de_type5_list_row` int NOT NULL DEFAULT '0',
  `de_type5_img_width` int NOT NULL DEFAULT '0',
  `de_type5_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_type1_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type1_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_type1_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_type1_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_type1_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_type2_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type2_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_type2_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_type2_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_type2_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_type3_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type3_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_type3_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_type3_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_type3_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_type4_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type4_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_type4_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_type4_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_type4_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_type5_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type5_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_type5_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_type5_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_type5_img_height` int NOT NULL DEFAULT '0',
  `de_rel_list_use` tinyint NOT NULL DEFAULT '0',
  `de_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_rel_list_mod` int NOT NULL DEFAULT '0',
  `de_rel_img_width` int NOT NULL DEFAULT '0',
  `de_rel_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_rel_list_use` tinyint NOT NULL DEFAULT '0',
  `de_mobile_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_rel_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_rel_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_rel_img_height` int NOT NULL DEFAULT '0',
  `de_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_search_list_mod` int NOT NULL DEFAULT '0',
  `de_search_list_row` int NOT NULL DEFAULT '0',
  `de_search_img_width` int NOT NULL DEFAULT '0',
  `de_search_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_search_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_search_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_search_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_search_img_height` int NOT NULL DEFAULT '0',
  `de_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_listtype_list_mod` int NOT NULL DEFAULT '0',
  `de_listtype_list_row` int NOT NULL DEFAULT '0',
  `de_listtype_img_width` int NOT NULL DEFAULT '0',
  `de_listtype_img_height` int NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_listtype_list_mod` int NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_row` int NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_width` int NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_height` int NOT NULL DEFAULT '0',
  `de_bank_use` int NOT NULL DEFAULT '0',
  `de_bank_account` mediumtext NOT NULL,
  `de_card_test` int NOT NULL DEFAULT '0',
  `de_card_use` int NOT NULL DEFAULT '0',
  `de_card_noint_use` tinyint NOT NULL DEFAULT '0',
  `de_card_point` int NOT NULL DEFAULT '0',
  `de_settle_min_point` int NOT NULL DEFAULT '0',
  `de_settle_max_point` int NOT NULL DEFAULT '0',
  `de_settle_point_unit` int NOT NULL DEFAULT '0',
  `de_level_sell` int NOT NULL DEFAULT '0',
  `de_delivery_company` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_case` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_limit` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_list` varchar(255) NOT NULL DEFAULT '',
  `de_hope_date_use` int NOT NULL DEFAULT '0',
  `de_hope_date_after` int NOT NULL DEFAULT '0',
  `de_baesong_content` mediumtext NOT NULL,
  `de_change_content` mediumtext NOT NULL,
  `de_point_days` int NOT NULL DEFAULT '0',
  `de_simg_width` int NOT NULL DEFAULT '0',
  `de_simg_height` int NOT NULL DEFAULT '0',
  `de_mimg_width` int NOT NULL DEFAULT '0',
  `de_mimg_height` int NOT NULL DEFAULT '0',
  `de_sms_cont1` mediumtext NOT NULL,
  `de_sms_cont2` mediumtext NOT NULL,
  `de_sms_cont3` mediumtext NOT NULL,
  `de_sms_cont4` mediumtext NOT NULL,
  `de_sms_cont5` mediumtext NOT NULL,
  `de_sms_use1` tinyint NOT NULL DEFAULT '0',
  `de_sms_use2` tinyint NOT NULL DEFAULT '0',
  `de_sms_use3` tinyint NOT NULL DEFAULT '0',
  `de_sms_use4` tinyint NOT NULL DEFAULT '0',
  `de_sms_use5` tinyint NOT NULL DEFAULT '0',
  `de_sms_hp` varchar(255) NOT NULL DEFAULT '',
  `de_pg_service` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_site_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_mid` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_admin_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_sign_key` varchar(255) NOT NULL DEFAULT '',
  `de_iche_use` tinyint NOT NULL DEFAULT '0',
  `de_easy_pay_use` tinyint NOT NULL DEFAULT '0',
  `de_easy_pay_services` varchar(255) NOT NULL DEFAULT '',
  `de_samsung_pay_use` tinyint NOT NULL DEFAULT '0',
  `de_inicis_lpay_use` tinyint NOT NULL DEFAULT '0',
  `de_inicis_kakaopay_use` tinyint NOT NULL DEFAULT '0',
  `de_inicis_cartpoint_use` tinyint NOT NULL DEFAULT '0',
  `de_item_use_use` tinyint NOT NULL DEFAULT '0',
  `de_item_use_write` tinyint NOT NULL DEFAULT '0',
  `de_code_dup_use` tinyint NOT NULL DEFAULT '0',
  `de_cart_keep_term` int NOT NULL DEFAULT '0',
  `de_guest_cart_use` tinyint NOT NULL DEFAULT '0',
  `de_admin_buga_no` varchar(255) NOT NULL DEFAULT '',
  `de_vbank_use` varchar(255) NOT NULL DEFAULT '',
  `de_taxsave_use` tinyint NOT NULL,
  `de_taxsave_types` set('account','vbank','transfer') NOT NULL DEFAULT 'account',
  `de_guest_privacy` mediumtext NOT NULL,
  `de_hp_use` tinyint NOT NULL DEFAULT '0',
  `de_escrow_use` tinyint NOT NULL DEFAULT '0',
  `de_tax_flag_use` tinyint NOT NULL DEFAULT '0',
  `de_kakaopay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_key` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_enckey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_hashkey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_cancelpwd` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_cert_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_button_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_test` tinyint NOT NULL DEFAULT '0',
  `de_naverpay_mb_id` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_sendcost` varchar(255) NOT NULL DEFAULT '',
  `de_member_reg_coupon_use` tinyint NOT NULL DEFAULT '0',
  `de_member_reg_coupon_term` int NOT NULL DEFAULT '0',
  `de_member_reg_coupon_price` int NOT NULL DEFAULT '0',
  `de_member_reg_coupon_minimum` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`de_id`),
  UNIQUE KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_event`
--

DROP TABLE IF EXISTS `g5_shop_event`;
CREATE TABLE IF NOT EXISTS `g5_shop_event` (
  `ev_id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_subject` varchar(255) NOT NULL DEFAULT '',
  `ev_subject_strong` tinyint(4) NOT NULL DEFAULT '0',
  `ev_head_html` text NOT NULL,
  `ev_tail_html` text NOT NULL,
  `ev_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ev_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_event_item`
--

DROP TABLE IF EXISTS `g5_shop_event_item`;
CREATE TABLE IF NOT EXISTS `g5_shop_event_item` (
  `ev_id` int(11) NOT NULL DEFAULT '0',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ev_id`,`it_id`),
  KEY `it_id` (`it_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item`
--

DROP TABLE IF EXISTS `g5_shop_item`;
CREATE TABLE IF NOT EXISTS `g5_shop_item` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `it_parent` varchar(20) NOT NULL DEFAULT '' COMMENT '부모 ID (부모없음 : 상품 ID와 동일)',
  `it_owner` varchar(20) NOT NULL DEFAULT '' COMMENT '상품 소유자',
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_id2` varchar(255) NOT NULL DEFAULT '',
  `ca_id3` varchar(255) NOT NULL DEFAULT '',
  `it_skin` varchar(255) NOT NULL DEFAULT '',
  `it_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_seo_title` varchar(200) NOT NULL DEFAULT '',
  `it_maker` varchar(255) NOT NULL DEFAULT '',
  `it_origin` varchar(255) NOT NULL DEFAULT '',
  `it_brand` varchar(255) NOT NULL DEFAULT '',
  `it_model` varchar(255) NOT NULL DEFAULT '',
  `it_option_subject` varchar(255) NOT NULL DEFAULT '',
  `it_supply_subject` varchar(255) NOT NULL DEFAULT '',
  `it_type1` tinyint NOT NULL DEFAULT '0',
  `it_type2` tinyint NOT NULL DEFAULT '0',
  `it_type3` tinyint NOT NULL DEFAULT '0',
  `it_type4` tinyint NOT NULL DEFAULT '0',
  `it_type5` tinyint NOT NULL DEFAULT '0',
  `it_basic` mediumtext NOT NULL,
  `it_explan` longtext NOT NULL,
  `it_explan2` longtext NOT NULL,
  `it_mobile_explan` longtext NOT NULL,
  `it_cust_price` int NOT NULL DEFAULT '0',
  `it_price` int NOT NULL DEFAULT '0',
  `it_point` int NOT NULL DEFAULT '0',
  `it_point_type` tinyint NOT NULL DEFAULT '0',
  `it_supply_point` int NOT NULL DEFAULT '0',
  `it_notax` tinyint NOT NULL DEFAULT '0',
  `it_sell_email` varchar(255) NOT NULL DEFAULT '',
  `it_use` tinyint NOT NULL DEFAULT '0',
  `it_nocoupon` tinyint NOT NULL DEFAULT '0',
  `it_soldout` tinyint NOT NULL DEFAULT '0',
  `it_stock_qty` int NOT NULL DEFAULT '0',
  `it_stock_sms` tinyint NOT NULL DEFAULT '0',
  `it_noti_qty` int NOT NULL DEFAULT '0',
  `it_sc_type` tinyint NOT NULL DEFAULT '0',
  `it_sc_method` tinyint NOT NULL DEFAULT '0',
  `it_sc_price` int NOT NULL DEFAULT '0',
  `it_sc_minimum` int NOT NULL DEFAULT '0',
  `it_sc_qty` int NOT NULL DEFAULT '0',
  `it_buy_min_qty` int NOT NULL DEFAULT '0',
  `it_buy_max_qty` int NOT NULL DEFAULT '0',
  `it_head_html` mediumtext NOT NULL,
  `it_tail_html` mediumtext NOT NULL,
  `it_mobile_head_html` mediumtext NOT NULL,
  `it_mobile_tail_html` mediumtext NOT NULL,
  `it_hit` int NOT NULL DEFAULT '0',
  `it_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL DEFAULT '',
  `it_order` int NOT NULL DEFAULT '0',
  `it_tel_inq` tinyint NOT NULL DEFAULT '0',
  `it_info_gubun` varchar(50) NOT NULL DEFAULT '',
  `it_info_value` mediumtext NOT NULL,
  `it_sum_qty` int NOT NULL DEFAULT '0',
  `it_use_cnt` int NOT NULL DEFAULT '0',
  `it_use_avg` decimal(2,1) NOT NULL,
  `it_shop_memo` mediumtext NOT NULL,
  `ec_mall_pid` varchar(255) NOT NULL DEFAULT '',
  `it_img1` varchar(255) NOT NULL DEFAULT '',
  `it_img2` varchar(255) NOT NULL DEFAULT '',
  `it_img3` varchar(255) NOT NULL DEFAULT '',
  `it_img4` varchar(255) NOT NULL DEFAULT '',
  `it_img5` varchar(255) NOT NULL DEFAULT '',
  `it_img6` varchar(255) NOT NULL DEFAULT '',
  `it_img7` varchar(255) NOT NULL DEFAULT '',
  `it_img8` varchar(255) NOT NULL DEFAULT '',
  `it_img9` varchar(255) NOT NULL DEFAULT '',
  `it_img10` varchar(255) NOT NULL DEFAULT '',
  `it_1_subj` varchar(255) NOT NULL DEFAULT '',
  `it_2_subj` varchar(255) NOT NULL DEFAULT '',
  `it_3_subj` varchar(255) NOT NULL DEFAULT '',
  `it_4_subj` varchar(255) NOT NULL DEFAULT '',
  `it_5_subj` varchar(255) NOT NULL DEFAULT '',
  `it_6_subj` varchar(255) NOT NULL DEFAULT '',
  `it_7_subj` varchar(255) NOT NULL DEFAULT '',
  `it_8_subj` varchar(255) NOT NULL DEFAULT '',
  `it_9_subj` varchar(255) NOT NULL DEFAULT '',
  `it_10_subj` varchar(255) NOT NULL DEFAULT '',
  `it_1` varchar(255) NOT NULL DEFAULT '',
  `it_2` varchar(255) NOT NULL DEFAULT '',
  `it_3` varchar(255) NOT NULL DEFAULT '',
  `it_4` varchar(255) NOT NULL DEFAULT '',
  `it_5` varchar(255) NOT NULL DEFAULT '',
  `it_6` varchar(255) NOT NULL DEFAULT '',
  `it_7` varchar(255) NOT NULL DEFAULT '',
  `it_8` varchar(255) NOT NULL DEFAULT '',
  `it_9` varchar(255) NOT NULL DEFAULT '',
  `it_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`it_id`),
  KEY `cn_id` (`cn_id`),
  KEY `ca_id` (`ca_id`),
  KEY `it_name` (`it_name`),
  KEY `it_seo_title` (`it_seo_title`),
  KEY `it_order` (`it_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item_option`
--

DROP TABLE IF EXISTS `g5_shop_item_option`;
CREATE TABLE IF NOT EXISTS `g5_shop_item_option` (
  `io_no` INT(11) NOT NULL AUTO_INCREMENT,
  `io_id` VARCHAR(255) NOT NULL DEFAULT '0',
  `io_type` TINYINT(4) NOT NULL DEFAULT '0',                    
  `it_id` VARCHAR(20) NOT NULL DEFAULT '',
  `io_price` INT(11) NOT NULL DEFAULT '0',
  `io_stock_qty` INT(11) NOT NULL DEFAULT '0',
  `io_noti_qty` INT(11) NOT NULL DEFAULT '0',
  `io_use` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`io_no`),
  KEY `io_id` (`io_id`),
  KEY `it_id` (`it_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item_use`
--

DROP TABLE IF EXISTS `g5_shop_item_use`;
CREATE TABLE IF NOT EXISTS `g5_shop_item_use` (
  `is_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `is_name` varchar(255) NOT NULL DEFAULT '',
  `is_password` varchar(255) NOT NULL DEFAULT '',
  `is_score` tinyint(4) NOT NULL DEFAULT '0',
  `is_subject` varchar(255) NOT NULL DEFAULT '',
  `is_content` text NOT NULL,
  `is_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_ip` varchar(25) NOT NULL DEFAULT '',
  `is_confirm` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`is_id`),
  KEY `index1` (`it_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item_qa`
--

DROP TABLE IF EXISTS `g5_shop_item_qa`;
CREATE TABLE IF NOT EXISTS `g5_shop_item_qa` (
  `iq_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `iq_secret` tinyint(4) NOT NULL DEFAULT '0',
  `iq_name` varchar(255) NOT NULL DEFAULT '',
  `iq_email` varchar(255) NOT NULL DEFAULT '',
  `iq_hp` varchar(255) NOT NULL DEFAULT '',
  `iq_password` varchar(255) NOT NULL DEFAULT '',
  `iq_subject` varchar(255) NOT NULL DEFAULT '',
  `iq_question` text NOT NULL,
  `iq_answer` text NOT NULL,
  `iq_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iq_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`iq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item_relation`
--

DROP TABLE IF EXISTS `g5_shop_item_relation`;
CREATE TABLE IF NOT EXISTS `g5_shop_item_relation` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_id2` varchar(20) NOT NULL DEFAULT '',
  `ir_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`it_id`,`it_id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_order`
--

DROP TABLE IF EXISTS `g5_shop_order`;
CREATE TABLE IF NOT EXISTS `g5_shop_order` (
  `od_id` bigint(20) unsigned NOT NULL,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID', 
  `mb_id` varchar(255) NOT NULL DEFAULT '',  
  `od_name` varchar(20) NOT NULL DEFAULT '',
  `od_email` varchar(100) NOT NULL DEFAULT '',
  `od_tel` varchar(20) NOT NULL DEFAULT '',
  `od_hp` varchar(20) NOT NULL DEFAULT '',
  `od_zip1` char(3) NOT NULL DEFAULT '',
  `od_zip2` char(3) NOT NULL DEFAULT '',
  `od_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_deposit_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_tel` varchar(20) NOT NULL DEFAULT '',
  `od_b_hp` varchar(20) NOT NULL DEFAULT '',
  `od_b_zip1` char(3) NOT NULL DEFAULT '',
  `od_b_zip2` char(3) NOT NULL DEFAULT '',
  `od_b_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_b_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_memo` text NOT NULL,
  `od_cart_count` int(11) NOT NULL DEFAULT '0',
  `od_cart_price` int(11) NOT NULL DEFAULT '0',
  `od_cart_coupon` int(11) NOT NULL DEFAULT '0',
  `od_send_cost` int(11) NOT NULL DEFAULT '0',
  `od_send_cost2` int(11) NOT NULL DEFAULT '0',
  `od_send_coupon` int(11) NOT NULL DEFAULT '0',  
  `od_receipt_price` int(11) NOT NULL DEFAULT '0',
  `od_cancel_price` int(11) NOT NULL DEFAULT '0',
  `od_receipt_point` int(11) NOT NULL DEFAULT '0',
  `od_refund_price` int(11) NOT NULL DEFAULT '0',
  `od_bank_account` varchar(255) NOT NULL DEFAULT '',
  `od_receipt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_coupon` int(11) NOT NULL DEFAULT '0',
  `od_misu` int(11) NOT NULL DEFAULT '0',
  `od_shop_memo` text NOT NULL,
  `od_mod_history` text NOT NULL,
  `od_status` varchar(255) NOT NULL DEFAULT '',  
  `od_fixed_flag` tinyint NOT NULL DEFAULT '0' COMMENT '주문 확정여부(0-미확정, 1-확정)',  
  `od_fixed_price` int NOT NULL DEFAULT '0' COMMENT '주문 확정금액',
  `od_hope_date` date NOT NULL DEFAULT '0000-00-00',  
  `od_settle_case` varchar(255) NOT NULL DEFAULT '',
  `od_other_pay_type` varchar(100) NOT NULL DEFAULT '',
  `od_test` tinyint(4) NOT NULL DEFAULT '0',
  `od_mobile` tinyint(4) NOT NULL DEFAULT '0',
  `od_pg` varchar(255) NOT NULL DEFAULT '',
  `od_tno` varchar(255) NOT NULL DEFAULT '',
  `od_app_no` varchar(20) NOT NULL DEFAULT '',
  `od_escrow` tinyint(4) NOT NULL DEFAULT '0',
  `od_casseqno` varchar(255) NOT NULL DEFAULT '',
  `od_tax_flag` tinyint(4) NOT NULL DEFAULT '0',
  `od_tax_mny` int(11) NOT NULL DEFAULT '0',
  `od_vat_mny` int(11) NOT NULL DEFAULT '0',
  `od_free_mny` int(11) NOT NULL DEFAULT '0',
  `od_delivery_company` varchar(255) NOT NULL DEFAULT '0',
  `od_invoice` varchar(255) NOT NULL DEFAULT '',
  `od_invoice_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_cash` tinyint(4) NOT NULL,
  `od_cash_no` varchar(255) NOT NULL,
  `od_cash_info` text NOT NULL, 
  `od_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  
  `od_pwd` varchar(255) NOT NULL DEFAULT '',
  `od_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`od_id`),
  KEY `cn_id` (`cn_id`),
  KEY `index2` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_order_address`
--

DROP TABLE IF EXISTS `g5_shop_order_address`;
CREATE TABLE IF NOT EXISTS `g5_shop_order_address` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `ad_subject` varchar(255) NOT NULL DEFAULT '',
  `ad_default` tinyint(4) NOT NULL DEFAULT '0',
  `ad_name` varchar(255) NOT NULL DEFAULT '',
  `ad_tel` varchar(255) NOT NULL DEFAULT '',
  `ad_hp` varchar(255) NOT NULL DEFAULT '',
  `ad_zip1` char(3) NOT NULL DEFAULT '',
  `ad_zip2` char(3) NOT NULL DEFAULT '',
  `ad_addr1` varchar(255) NOT NULL DEFAULT '',
  `ad_addr2` varchar(255) NOT NULL DEFAULT '',
  `ad_addr3` varchar(255) NOT NULL DEFAULT '',
  `ad_jibeon` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ad_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_order_data`
--

DROP TABLE IF EXISTS `g5_shop_order_data`;
CREATE TABLE IF NOT EXISTS `g5_shop_order_data` (
  `od_id` bigint(20) unsigned NOT NULL,
  `cart_id` bigint(20) unsigned NOT NULL,
  `cn_id` varchar(20) NOT NULL DEFAULT '' COMMENT '채널 ID',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `dt_pg` varchar(255) NOT NULL DEFAULT '',
  `dt_data` text NOT NULL,
  `dt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `od_id` (`od_id`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_order_delete`
--

DROP TABLE IF EXISTS `g5_shop_order_delete`;
CREATE TABLE IF NOT EXISTS `g5_shop_order_delete` (
  `de_id` int(11) NOT NULL AUTO_INCREMENT,
  `de_key` varchar(255) NOT NULL DEFAULT '',
  `de_data` longtext NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `de_ip` varchar(255) NOT NULL DEFAULT '',
  `de_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`de_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Table structure for table `g5_shop_personalpay`
--

DROP TABLE IF EXISTS `g5_shop_personalpay`;
CREATE TABLE IF NOT EXISTS `g5_shop_personalpay` (
  `pp_id` BIGINT(20) unsigned NOT NULL,
  `od_id` BIGINT(20) unsigned NOT NULL,  
  `pp_name` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_email` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_hp` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_content` TEXT NOT NULL,
  `pp_use` TINYINT(4) NOT NULL DEFAULT '0',
  `pp_price` INT(11) NOT NULL DEFAULT '0',
  `pp_pg` varchar(255) NOT NULL DEFAULT '',
  `pp_tno` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_app_no` VARCHAR(20) NOT NULL DEFAULT '',
  `pp_casseqno` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_receipt_price` INT(11) NOT NULL DEFAULT '0',
  `pp_settle_case` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_bank_account` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_deposit_name` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_receipt_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pp_receipt_ip` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_shop_memo` TEXT NOT NULL,
  `pp_cash` TINYINT(4) NOT NULL DEFAULT '0',
  `pp_cash_no` varchar(255) NOT NULL DEFAULT '',
  `pp_cash_info` TEXT NOT NULL,
  `pp_ip` VARCHAR(255) NOT NULL DEFAULT '',
  `pp_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pp_id`),
  KEY `od_id` (`od_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_sendcost`
--

DROP TABLE IF EXISTS `g5_shop_sendcost`;
CREATE TABLE IF NOT EXISTS `g5_shop_sendcost` (
  `sc_id` INT(11) NOT NULL AUTO_INCREMENT,
  `sc_name` VARCHAR(255) NOT NULL DEFAULT '',
  `sc_zip1` VARCHAR(10) NOT NULL DEFAULT '',
  `sc_zip2` VARCHAR(10) NOT NULL DEFAULT '',
  `sc_price` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sc_id`),
  KEY `sc_zip1` (`sc_zip1`),
  KEY `sc_zip2` (`sc_zip2`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_wish`
--

DROP TABLE IF EXISTS `g5_shop_wish`;
CREATE TABLE IF NOT EXISTS `g5_shop_wish` (
  `wi_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `wi_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wi_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`wi_id`),
  KEY `index1` (`mb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_item_stocksms`
--

DROP TABLE IF EXISTS `g5_shop_item_stocksms`;
CREATE TABLE IF NOT EXISTS `g5_shop_item_stocksms` (
  `ss_id` int(11) NOT NULL AUTO_INCREMENT,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `ss_hp` varchar(255) NOT NULL DEFAULT '',
  `ss_send` tinyint(4) NOT NULL DEFAULT '0',
  `ss_send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`ss_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_order_post_log`
--

DROP TABLE IF EXISTS `g5_shop_order_post_log`;
CREATE TABLE IF NOT EXISTS `g5_shop_order_post_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` bigint(20) unsigned NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `ol_code` varchar(255) NOT NULL DEFAULT '',
  `ol_msg` text NOT NULL,
  `ol_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ol_ip` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_shop_inicis_log`
--

DROP TABLE IF EXISTS `g5_shop_inicis_log`;
CREATE TABLE IF NOT EXISTS `g5_shop_inicis_log` (
  `oid` bigint(20) unsigned NOT NULL,
  `P_TID` varchar(255) NOT NULL DEFAULT '',
  `P_MID` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_DT` varchar(255) NOT NULL DEFAULT '',
  `P_STATUS` varchar(255) NOT NULL DEFAULT '',
  `P_TYPE` varchar(255) NOT NULL DEFAULT '',
  `P_OID` varchar(255) NOT NULL DEFAULT '',
  `P_FN_NM` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_NO` varchar(255) NOT NULL DEFAULT '',
  `P_AMT` int(11) NOT NULL DEFAULT '0',
  `P_RMESG1` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `is_mail_send` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
