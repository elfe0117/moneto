-- --------------------------------------------------------

--
-- Table structure for table `g5_profile`
--

DROP TABLE IF EXISTS `g5_profile`;
CREATE TABLE IF NOT EXISTS `g5_profile` (
  `pf_no` int NOT NULL auto_increment COMMENT '프로필 번호',
  `pf_id` varchar(20) NOT NULL default '' COMMENT '프로필 ID',
  `pf_admin` varchar(20) NOT NULL default '' COMMENT '프로필 관리자',
  `pf_name` mediumtext NOT NULL COMMENT '프로필 명',
  `pf_summary` mediumtext NOT NULL COMMENT '프로필 소개',
  `pf_img` varchar(255) NOT NULL default '' COMMENT '프로필 이미지',
  `pf_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '프로필 등록일시',
  PRIMARY KEY  (`pf_no`),
  UNIQUE KEY `pf_id` (`pf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_profile_block`
--

DROP TABLE IF EXISTS `g5_profile_block`;
CREATE TABLE IF NOT EXISTS `g5_profile_block` (
  `pb_no` int NOT NULL auto_increment COMMENT '프로필블록 번호',
  `pf_id` varchar(20) NOT NULL default '' COMMENT '프로필 ID',
  `ft_id` varchar(20) NOT NULL default '' COMMENT '기능 ID',
  `pb_data` mediumtext NOT NULL default '' COMMENT '프로필블록 데이터',
  `pb_order` int NOT NULL default '0' COMMENT '프로필블록 순번',
  PRIMARY KEY  (`pb_no`),
  KEY `pf_id` (`pf_id`),
  KEY `pb_order` (`pb_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_function`
--

DROP TABLE IF EXISTS `g5_function`;
CREATE TABLE IF NOT EXISTS `g5_function` (
  `ft_no` int NOT NULL auto_increment COMMENT '기능 번호',
  `ft_id` varchar(20) NOT NULL default '' COMMENT '기능 ID',
  `ft_name` varchar(255) NOT NULL default '' COMMENT '기능 명',
  `ft_summary` mediumtext NOT NULL COMMENT '기능 소개',
  `ft_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '기능 등록일시',
  PRIMARY KEY  (`ft_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;