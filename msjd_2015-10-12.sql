# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: msjd_2015-10-12
# Generation Time: 2015-10-21 04:01:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;

INSERT INTO `password_resets` (`email`, `token`, `created_at`)
VALUES
	('rheza.boge@gmail.com','e87360f738bd6d13d92eee0dd983d8d963fdcf83c4a50d455ad82418ad9ed5fe','2015-10-15 15:34:07');

/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;


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
  `content_title` text NOT NULL,
  `content_headline` text NOT NULL,
  `content_detail` text NOT NULL,
  `content_media_id` text NOT NULL,
  `content_users_uploader` int(11) NOT NULL,
  `content_last_editor` int(11) NOT NULL,
  `content_date_insert` datetime NOT NULL,
  `content_date_update` datetime NOT NULL,
  `content_date_expired` datetime NOT NULL,
  `content_publish` varchar(50) NOT NULL DEFAULT '',
  `content_category_id` int(11) NOT NULL,
  `content_repost_from` int(11) NOT NULL,
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
  `users_status_id` int(11) NOT NULL,
  `users_password_recovery` text NOT NULL,
  `users_phone` varchar(50) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table table_users_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_users_group`;

CREATE TABLE `table_users_group` (
  `users_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_group_name` varchar(100) NOT NULL DEFAULT '',
  `users_group_description` text NOT NULL,
  `users_group_is_public` int(11) NOT NULL,
  PRIMARY KEY (`users_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `table_users_group` WRITE;
/*!40000 ALTER TABLE `table_users_group` DISABLE KEYS */;

INSERT INTO `table_users_group` (`users_group_id`, `users_group_name`, `users_group_description`, `users_group_is_public`)
VALUES
	(1,'Superadmin','',0),
	(2,'Administrator','',0),
	(3,'Content Writer','',0),
	(4,'Jamaah','',0),
	(5,'Ustadz','',0),
	(6,'Masjid','Masjid',1);

/*!40000 ALTER TABLE `table_users_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table table_users_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `table_users_status`;

CREATE TABLE `table_users_status` (
  `users_status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_status_title` varchar(100) NOT NULL DEFAULT '',
  `users_status_desc` text NOT NULL,
  PRIMARY KEY (`users_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `table_users_status` WRITE;
/*!40000 ALTER TABLE `table_users_status` DISABLE KEYS */;

INSERT INTO `table_users_status` (`users_status_id`, `users_status_title`, `users_status_desc`)
VALUES
	(1,'Pending','pending users'),
	(2,'Active',''),
	(3,'Banned',''),
	(4,'Reported','');

/*!40000 ALTER TABLE `table_users_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Rheza','rheza.boge@gmail.com','$2y$10$vGj70E.njYVm1Zm8lu10g.0cT9Vz9ag1XY9CyxpJN.uklOr4rKZ82','vgW5VWnmj73dpLcrgBkhaqUBXHOslwiAhUFw5rI9eOXi2saytMmSUVbmH05X','2015-10-15 15:30:14','2015-10-15 17:25:36'),
	(2,'Rheza2','rheza2.boge@gmail.com','$2y$10$jE84xQoX/HjmXa5lCOKb5OTMOXoINK/QcBanjXF6NYc9bOPnend4i','n7aXJrTRqpeLeQFnRtyyi4lHTLslUXgSfvyxPZs0wJeoQt9U8A1gmTxqlMPl','2015-10-15 16:37:38','2015-10-15 16:44:29'),
	(3,'budiartoy','eko@hotmail.com','8c7d5676fb7a672cd7d9a2e566f54bd9',NULL,'2015-10-20 14:40:12','2015-10-20 14:40:12');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
