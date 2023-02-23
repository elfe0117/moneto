-- --------------------------------------------------------

--
-- Table structure for table `md_pass`
--

DROP TABLE IF EXISTS `md_pass`;
CREATE TABLE IF NOT EXISTS `md_pass` (
  `ps_no` int NOT NULL auto_increment COMMENT '패스 번호',
  `ps_id` varchar(20) NOT NULL default '' COMMENT '패스 ID',
  `cn_id` varchar(20) NOT NULL default '' COMMENT '채널 ID',
  `ps_admin` varchar(20) NOT NULL default '' COMMENT '패스 관리자',
  `ps_layout` varchar(255) NOT NULL default '' COMMENT '패스 레이아웃',
  `ps_bgcolor` varchar(255) NOT NULL default '' COMMENT '패스 배경색',
  `ps_profile_img` varchar(255) NOT NULL default '' COMMENT '패스 프로필 이미지',
  `ps_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '패스 등록일시',
  PRIMARY KEY  (`ps_no`),
  UNIQUE KEY `ps_id` (`ps_id`),
  KEY `cn_id` (`cn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `md_pass_block`
--

DROP TABLE IF EXISTS `md_pass_block`;
CREATE TABLE IF NOT EXISTS `md_pass_block` (
  `pb_no` int NOT NULL auto_increment COMMENT '패스블록 번호',
  `ps_no` int NOT NULL default '0' COMMENT '패스 번호',
  `pb_type` varchar(20) NOT NULL default '' COMMENT '패스블록 유형(link-링크, text-텍스트, image-이미지, seperator-구분선, movie-동영상, calender-캘린더)',
  `pb_order` int NOT NULL default '0' COMMENT '패스블록 순번',
  `ps_data` mediumtext NOT NULL COMMENT '패스블록 데이터',
  `pb_share` tinyint NOT NULL default '0' COMMENT '패스블록 공개(0-즉시공개, 1-예약공개)',
  `pb_begin_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '패스블록 시작 일시',
  `pb_end_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '패스블록 종료 일시',
  PRIMARY KEY  (`pb_no`),
  KEY `ps_no` (`ps_no`),
  KEY `pb_order` (`pb_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;