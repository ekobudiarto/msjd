-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2015 at 04:48 AM
-- Server version: 5.5.25a
-- PHP Version: 5.6.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msjd_2015-10-12`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rheza.boge@gmail.com', 'e87360f738bd6d13d92eee0dd983d8d963fdcf83c4a50d455ad82418ad9ed5fe', '2015-10-15 08:34:07'),
('admin@admin.com', 'a8d190f51efbb377ef357d04ac6cfc09fdb5024e05cc6b4317edcd3818be7b83', '2015-10-21 02:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `table_banned_report`
--

CREATE TABLE IF NOT EXISTS `table_banned_report` (
  `banned_report_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_by` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `users_dest` int(11) NOT NULL,
  `banned_report_message` text NOT NULL,
  PRIMARY KEY (`banned_report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `table_banned_report`
--

INSERT INTO `table_banned_report` (`banned_report_id`, `users_by`, `content_id`, `users_dest`, `banned_report_message`) VALUES
(1, 26, 2, 0, '3'),
(2, 1, 2, 4, '3'),
(10, 27, 1, 26, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_content`
--

CREATE TABLE IF NOT EXISTS `table_content` (
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
  `hashtag_id` text NOT NULL,
  `content_repost_from` int(11) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `table_content`
--

INSERT INTO `table_content` (`content_id`, `content_title`, `content_headline`, `content_detail`, `content_media_id`, `content_users_uploader`, `content_last_editor`, `content_date_insert`, `content_date_update`, `content_date_expired`, `content_publish`, `content_category_id`, `hashtag_id`, `content_repost_from`) VALUES
(1, 'Content 1', '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_content_category`
--

CREATE TABLE IF NOT EXISTS `table_content_category` (
  `content_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_category_title` varchar(150) NOT NULL DEFAULT '',
  `content_category_description` text NOT NULL,
  `media_manager_id` int(11) NOT NULL,
  PRIMARY KEY (`content_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `table_content_category`
--

INSERT INTO `table_content_category` (`content_category_id`, `content_category_title`, `content_category_description`, `media_manager_id`) VALUES
(1, 'Content Category 1', 'Deskripsi content category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_hashtag`
--

CREATE TABLE IF NOT EXISTS `table_hashtag` (
  `hashtag_id` int(11) NOT NULL AUTO_INCREMENT,
  `hashtag_title` char(255) NOT NULL,
  PRIMARY KEY (`hashtag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `table_hashtag`
--

INSERT INTO `table_hashtag` (`hashtag_id`, `hashtag_title`) VALUES
(2, '#contoh');

-- --------------------------------------------------------

--
-- Table structure for table `table_media_manager`
--

CREATE TABLE IF NOT EXISTS `table_media_manager` (
  `media_manager_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `media_manager_title` varchar(200) NOT NULL DEFAULT '',
  `media_manager_type` varchar(10) NOT NULL DEFAULT '',
  `media_manager_filename` text NOT NULL,
  `media_manager_publish` char(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`media_manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_media_manager`
--

INSERT INTO `table_media_manager` (`media_manager_id`, `media_manager_title`, `media_manager_type`, `media_manager_filename`, `media_manager_publish`) VALUES
(1, 'Media Manager 1', '', '', '1'),
(2, 'Media Manager 2', '', '', '1'),
(4, 'Media manager 3', 'blabla', 'blabla', '1');

-- --------------------------------------------------------

--
-- Table structure for table `table_schedule`
--

CREATE TABLE IF NOT EXISTS `table_schedule` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `table_schedule`
--

INSERT INTO `table_schedule` (`schedule_id`, `schedule_title`, `schedule_type_id`, `schedule_users_creator`, `schedule_users_source`, `schedule_date_start`, `schedule_date_end`, `schedule_description`, `schedule_headline`, `schedule_media_id`, `schedule_publish`) VALUES
(1, 'Testing schedule', 1, 26, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'blablabla', 'blablabla', '1,2,3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `table_schedule_type`
--

CREATE TABLE IF NOT EXISTS `table_schedule_type` (
  `schedule_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_type_name` varchar(200) NOT NULL DEFAULT '',
  `schedule_type_desc` text NOT NULL,
  `media_manager_id` text NOT NULL,
  PRIMARY KEY (`schedule_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `table_schedule_type`
--

INSERT INTO `table_schedule_type` (`schedule_type_id`, `schedule_type_name`, `schedule_type_desc`, `media_manager_id`) VALUES
(1, 'Schedule type 1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_users_detail`
--

CREATE TABLE IF NOT EXISTS `table_users_detail` (
  `users_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `users_name` varchar(200) NOT NULL DEFAULT '',
  `users_fullname` varchar(50) NOT NULL DEFAULT '',
  `users_password` text NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `users_email` tinytext NOT NULL,
  `users_telp` char(13) NOT NULL,
  `users_json_following` text NOT NULL,
  `users_description` text NOT NULL,
  `media_manager_id` text NOT NULL,
  `users_avatar` int(11) NOT NULL,
  `users_status_id` int(11) NOT NULL,
  `users_password_recovery` text NOT NULL,
  PRIMARY KEY (`users_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `table_users_detail`
--

INSERT INTO `table_users_detail` (`users_detail_id`, `users_id`, `users_name`, `users_fullname`, `users_password`, `users_group_id`, `users_email`, `users_telp`, `users_json_following`, `users_description`, `media_manager_id`, `users_avatar`, `users_status_id`, `users_password_recovery`) VALUES
(2, 26, 'ubay', 'bayu', '', 6, 'sdfsfddffsfata@data.com', '', '', '', '', 0, 0, ''),
(3, 27, 'ubayu', 'bayu', '', 6, 'data@data.com', '', '26,25,', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_users_group`
--

CREATE TABLE IF NOT EXISTS `table_users_group` (
  `users_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_group_name` varchar(100) NOT NULL DEFAULT '',
  `users_group_description` text NOT NULL,
  `users_group_is_public` int(11) NOT NULL,
  PRIMARY KEY (`users_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `table_users_group`
--

INSERT INTO `table_users_group` (`users_group_id`, `users_group_name`, `users_group_description`, `users_group_is_public`) VALUES
(1, 'Superadmin', '', 0),
(2, 'Administrator', '', 0),
(3, 'Content Writer', '', 0),
(4, 'Jamaah', '', 0),
(5, 'Ustadz', '', 0),
(6, 'Masjid', 'Masjid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_users_status`
--

CREATE TABLE IF NOT EXISTS `table_users_status` (
  `users_status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_status_title` varchar(100) NOT NULL DEFAULT '',
  `users_status_desc` text NOT NULL,
  PRIMARY KEY (`users_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_users_status`
--

INSERT INTO `table_users_status` (`users_status_id`, `users_status_title`, `users_status_desc`) VALUES
(1, 'Pending', 'pending users'),
(2, 'Active', ''),
(3, 'Banned', ''),
(4, 'Reported', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Rheza2', 'admin@admin.com', '$2y$10$jE84xQoX/HjmXa5lCOKb5OTMOXoINK/QcBanjXF6NYc9bOPnend4i', 'n7aXJrTRqpeLeQFnRtyyi4lHTLslUXgSfvyxPZs0wJeoQt9U8A1gmTxqlMPl', '2015-10-15 09:37:38', '2015-10-15 09:44:29'),
(27, 'ubay', 'data@data.com', '$2y$10$nipTEi5yPMPtJiWBdHxidONj6CItXq2KyGhNwA7ihisYqM6vNqiL6', NULL, '2015-10-21 06:49:57', '2015-10-21 06:49:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
