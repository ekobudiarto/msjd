# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.25)
# Database: msjd
# Generation Time: 2015-10-12 07:44:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table table_banned_report
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_banned_report`;

CREATE TABLE `table_banned_report` (
  `banned_report_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_by` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `users_dest` int(11) NOT NULL,
  `banned_report_message` text NOT NULL,
  PRIMARY KEY (`banned_report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_content`;

CREATE TABLE `table_content` (
  `content_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_title` text,
  `content_headline` text,
  `content_detail` text,
  `content_media_id` text,
  `content_users_uploader` int(11) DEFAULT NULL,
  `content_last_editor` int(11) DEFAULT NULL,
  `content_date_insert` datetime DEFAULT NULL,
  `content_date_update` datetime DEFAULT NULL,
  `content_date_expired` datetime DEFAULT NULL,
  `content_publish` varchar(50) DEFAULT NULL,
  `content_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_content_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_content_category`;

CREATE TABLE `table_content_category` (
  `content_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_category_title` varchar(150) NOT NULL DEFAULT '',
  `content_category_description` text NOT NULL,
  `media_manager_id` int(11) NOT NULL,
  PRIMARY KEY (`content_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_media_manager
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_media_manager`;

CREATE TABLE `table_media_manager` (
  `media_manager_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `media_manager_title` varchar(200) NOT NULL DEFAULT '',
  `media_manager_type` varchar(10) NOT NULL DEFAULT '',
  `media_manager_filename` text NOT NULL,
  `media_manager_publish` char(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`media_manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_schedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_schedule`;

CREATE TABLE `table_schedule` (
  `schedule_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_title` text NOT NULL,
  `schedule_type_id` int(11) NOT NULL,
  `schedule_users_creator` int(11) NOT NULL,
  `schedule_users_source` int(11) NOT NULL,
  `schedule_date_start` datetime NOT NULL,
  `schedule_date_end` datetime NOT NULL,
  `schedule_description` text NOT NULL,
  `schedule_headline` text NOT NULL,
  `schedule_media_id` text NOT NULL,
  `schedule_publish` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_schedule_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_schedule_type`;

CREATE TABLE `table_schedule_type` (
  `schedule_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_type_name` varchar(200) NOT NULL DEFAULT '',
  `schedule_type_desc` text NOT NULL,
  `media_manager_id` text NOT NULL,
  PRIMARY KEY (`schedule_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_users`;

CREATE TABLE `table_users` (
  `users_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_name` varchar(200) NOT NULL DEFAULT '',
  `users_fullname` varchar(50) NOT NULL DEFAULT '',
  `users_password` text NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `users_email` tinytext NOT NULL,
  `users_json_following` text NOT NULL,
  `users_description` text NOT NULL,
  `media_manager_id` text NOT NULL,
  `users_avatar` int(11) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_users_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_users_group`;

CREATE TABLE `table_users_group` (
  `users_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_group_name` varchar(100) NOT NULL DEFAULT '',
  `users_group_description` text NOT NULL,
  PRIMARY KEY (`users_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
