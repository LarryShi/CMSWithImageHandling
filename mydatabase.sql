-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-06-05 09:13:58
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- 表的结构 `mytable`
--

CREATE TABLE IF NOT EXISTS `mytable` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `like` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image_uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 表的结构 `sys_image`
--

CREATE TABLE IF NOT EXISTS `sys_image` (
  `image_uid` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(1024) DEFAULT NULL,
  `image_desc` varchar(1024) DEFAULT NULL,
  `image_location` varchar(1024) DEFAULT NULL,
  `imagetype_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2269 ;


-- --------------------------------------------------------

--
-- 表的结构 `sys_image_type`
--

CREATE TABLE IF NOT EXISTS `sys_image_type` (
  `image_type_uid` int(11) NOT NULL,
  `image_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`image_type_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sys_param`
--

CREATE TABLE IF NOT EXISTS `sys_param` (
  `param_uid` int(11) NOT NULL,
  `upload_img_path` varchar(1024) NOT NULL,
  PRIMARY KEY (`param_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_param`
--

INSERT INTO `sys_param` (`param_uid`, `upload_img_path`) VALUES
(1, '/uploaded_image/img/');

-- --------------------------------------------------------

--
-- 表的结构 `sys_uid_gen`
--

CREATE TABLE IF NOT EXISTS `sys_uid_gen` (
  `uid_gen_table_name` varchar(128) NOT NULL,
  `uid_gen_current_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid_gen_table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_uid_gen`
--

INSERT INTO `sys_uid_gen` (`uid_gen_table_name`, `uid_gen_current_uid`) VALUES
('mkt_ad', 1027),
('mytable', 23),
('sys_image', 2268),
('usr_role', 1010),
('usr_user', 1327),
('usr_userrole', 1256);

-- --------------------------------------------------------

--
-- 表的结构 `usr_role`
--

CREATE TABLE IF NOT EXISTS `usr_role` (
  `role_uid` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  `role_desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1002 ;

--
-- 转存表中的数据 `usr_role`
--

INSERT INTO `usr_role` (`role_uid`, `role_name`, `role_desc`) VALUES
(1000, 'SALON', NULL),
(1001, 'STYLIST', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `usr_user`
--

CREATE TABLE IF NOT EXISTS `usr_user` (
  `user_uid` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(45) DEFAULT NULL,
  `user_last_name` varchar(45) DEFAULT NULL,
  `user_nick_name` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_tel` varchar(45) DEFAULT NULL,
  `user_gender` varchar(45) DEFAULT NULL,
  `user_login_id` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_verified` int(1) DEFAULT '0',
  `user_last_login` varchar(45) DEFAULT NULL,
  `last_update_user` varchar(45) DEFAULT NULL,
  `last_update_date` timestamp NULL DEFAULT NULL,
  `create_user` varchar(45) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1328 ;


-- --------------------------------------------------------

--
-- 表的结构 `usr_userrole`
--

CREATE TABLE IF NOT EXISTS `usr_userrole` (
  `usr_userrole_uid` int(11) NOT NULL,
  `user_uid` int(11) NOT NULL,
  `role_uid` int(11) NOT NULL,
  PRIMARY KEY (`usr_userrole_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
