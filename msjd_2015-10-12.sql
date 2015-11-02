-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2015 at 04:21 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `table_banned_report`
--

INSERT INTO `table_banned_report` (`banned_report_id`, `users_by`, `content_id`, `users_dest`, `banned_report_message`) VALUES
(1, 26, 2, 0, '3'),
(2, 1, 2, 4, '3'),
(10, 27, 1, 26, ''),
(11, 26, 1, 27, 'test4'),
(12, 26, 2, 27, 'test5'),
(13, 26, 1, 27, 'test6'),
(14, 27, 1, 26, 'test7'),
(15, 27, 2, 26, 'test8'),
(16, 27, 2, 26, 'test9'),
(17, 26, 1, 27, 'test10'),
(18, 27, 1, 1, '\r\n'),
(19, 26, 1, 27, ''),
(20, 27, 2, 26, ''),
(21, 26, 2, 27, ''),
(22, 27, 1, 26, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `table_content`
--

INSERT INTO `table_content` (`content_id`, `content_title`, `content_headline`, `content_detail`, `content_media_id`, `content_users_uploader`, `content_last_editor`, `content_date_insert`, `content_date_update`, `content_date_expired`, `content_publish`, `content_category_id`, `hashtag_id`, `content_repost_from`) VALUES
(1, 'Allah turunkan hujan sesaat setelah rakyat, ulama dan aparat shalat Istisqa di Bogor', 'Allah subhanahu wa Ta’ala menurunkan hujan lebat di Kota Bogor sesaat setelah ratusan umat Islam bersama ulama dan aparat pemerintah sipil dan militer melaksakan Shalat Istisqa, minta hujan di Lapangan Sempur Kota Bogor, Jumat (30/10/2015). - See more at: http://www.arrahmah.com/news/2015/10/30/allah-turunkan-hujan-sesaat-setelah-rakyat-ulama-dan-aparat-shalat-istisqa-di-bogor.html#sthash.i8NqyJgs.dpuf', 'Hujan turun jam 15.30 sementara rangkaian ibadah shalat Istisqa yang terdiri dari Shalat dua rakaat, Khutbah dan doa serta zikir selesai jam 14.50. Hujan sedang hingga lebat berlangsung selama 1 jam. Pantauan Arrahmah.com dari lokasi shalat Istisqa hingga jalur kereta menuju Jakarta, hujan turun hingga stasiun Cilebut.  Jamaah satu persatu mendatangi Lapangan Sempur tempat dilaksakannya shalat Istisqa ba’da shalat Jumat. Shalat dimulai pukul 14.00 dengan imam Drs. Lukmanul Hakim dari Kemenag kota Bogor sedangkan khotib DR. Badruddin H Subki.  Khotib mengajak jamaah beristighfar, mohon ampun dan bertaubat kepada Allah atas segala dosa. Saat itu langit mulai gelap.  Khotbah selesai, jamaah diajak untuk berdzikir dan berdoa kepada Allah Ta’ala hingga datangnya waktu Ashar.Kemudian dilaksanakan Shalat Ashar berjamaah di lapangan. - See more at: http://www.arrahmah.com/news/2015/10/30/allah-turunkan-hujan-sesaat-setelah-rakyat-ulama-dan-aparat-shalat-istisqa-di-bogor.html#sthash.i8NqyJgs.dpuf', '1', 26, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 1, '', 1),
(2, 'Raja Salman Perintahkan Seluruh Rakyat Saudi Shalat Istisqo’', 'Content 2', 'Content 2', '1', 26, 26, '2015-10-27 05:05:24', '2015-10-27 05:05:24', '2015-10-30 05:05:24', '1', 1, '', 1),
(6, 'Raja Arab Saudi Salman bin Abdul Aziz Alu Saud ajak rakyatnya shalat Istisqo''', 'Content 3', 'Content 3', '1', 26, 26, '2015-10-27 05:05:24', '2015-10-27 05:05:24', '2015-10-30 05:05:24', '1', 1, '', 1),
(7, 'Ini Pidato Terbaru Pastor Terry Jones Soal Islam', 'Content 4', 'Content 4', '1', 26, 26, '2015-10-27 05:05:24', '2015-10-27 05:05:24', '2015-10-30 05:05:24', '1', 1, '', 1),
(8, 'Myanmar Gunakan Cara Nazi Untuk Habisi Muslim Rohingya', 'Content 5', 'Content 5', '2', 27, 27, '2015-10-28 04:05:12', '2015-10-28 04:05:12', '2015-10-31 04:05:12', '1', 2, '', 2),
(9, 'Content 6', 'Content 6', 'Content 6', '4', 26, 26, '2015-10-28 04:08:34', '2015-10-28 04:08:34', '2015-10-31 04:08:34', '1', 2, '', 2),
(10, 'Content 7', 'Content 7', 'Content 7', '4', 26, 26, '2015-10-28 04:08:34', '2015-10-28 04:08:34', '2015-10-31 04:08:34', '1', 1, '', 7),
(11, 'Content 8', 'Content 8', 'Content 8', '2', 27, 27, '2015-10-28 04:12:21', '2015-10-28 04:12:21', '2015-10-31 04:12:21', '0', 2, '', 5),
(12, 'Content 9', 'Content 9', 'Content 9', '2', 27, 27, '2015-10-28 04:12:21', '2015-10-28 04:12:21', '2015-10-31 04:12:21', '0', 2, '', 5),
(13, 'Content 10', 'Content 10', 'Content 10', '2', 27, 27, '2015-10-27 05:05:24', '2015-10-27 05:05:24', '2015-10-30 05:05:24', '1', 1, '', 1),
(14, 'Content 11', 'Content 11', 'Content 11', '4', 27, 27, '2015-10-28 04:08:34', '2015-10-28 04:08:34', '2015-10-31 04:08:34', '1', 2, '', 2),
(15, 'Content 12', 'Content 12', 'Content 12', '4', 26, 26, '2015-10-28 04:08:34', '2015-10-28 04:08:34', '2015-10-31 04:08:34', '1', 1, '', 7),
(16, 'Content 13', 'Content 13', 'Content 13', '1', 26, 26, '2015-10-27 05:05:24', '2015-10-27 05:05:24', '2015-10-30 05:05:24', '1', 1, '', 1),
(17, 'Content 14', 'Content 14', 'Content 14', '2', 27, 27, '2015-10-28 04:12:21', '2015-10-28 04:12:21', '2015-10-31 04:12:21', '0', 2, '', 5),
(18, 'Content 15', 'Content 15', 'Content 15', '2', 27, 27, '2015-10-28 04:12:21', '2015-10-28 04:12:21', '2015-10-31 04:12:21', '0', 2, '', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `table_content_category`
--

INSERT INTO `table_content_category` (`content_category_id`, `content_category_title`, `content_category_description`, `media_manager_id`) VALUES
(1, 'Content Category 1', 'Deskripsi content category', 1),
(2, 'Content Category 2', 'Deskripsi content category', 1),
(3, 'Content Category 3', 'Deskripsi content category', 1),
(4, 'Content Category 4', 'Deskripsi content category', 1),
(5, 'Content Category 5', 'Deskripsi content category', 1),
(6, 'Content Category 6', 'Deskripsi content category', 1),
(7, 'Content Category 7', 'Deskripsi content category', 1),
(8, 'Content Category 8', 'Deskripsi content category', 1),
(9, 'Content Category 9', 'Deskripsi content category', 1),
(10, 'Content Category 10', 'Deskripsi content category', 1),
(11, 'Content Category 11', 'Deskripsi content category', 1),
(12, 'Content Category 12', 'Deskripsi content category', 1),
(13, 'Content Category 13', 'Deskripsi content category', 1),
(14, 'Content Category 14', 'Deskripsi content category', 1),
(15, 'Content Category 15', 'Deskripsi content category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_hashtag`
--

CREATE TABLE IF NOT EXISTS `table_hashtag` (
  `hashtag_id` int(11) NOT NULL AUTO_INCREMENT,
  `hashtag_title` char(255) NOT NULL,
  PRIMARY KEY (`hashtag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `table_hashtag`
--

INSERT INTO `table_hashtag` (`hashtag_id`, `hashtag_title`) VALUES
(2, '#contoh'),
(3, 'muslim'),
(4, 'merdeka'),
(5, 'allahuakbar'),
(6, 'alhamdulillah'),
(7, 'wasyukurillah'),
(8, 'subhanallah'),
(9, 'sholat'),
(10, 'jamaahbaik'),
(11, 'cupslicemasukislam'),
(12, 'noisis'),
(13, 'islamindah'),
(14, 'ustadzgaul'),
(15, 'bersabar'),
(16, 'latahzan'),
(17, 'astaghfirullah');

-- --------------------------------------------------------

--
-- Table structure for table `table_last_login`
--

CREATE TABLE IF NOT EXISTS `table_last_login` (
  `last_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `regional` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  PRIMARY KEY (`last_login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `table_last_login`
--

INSERT INTO `table_last_login` (`last_login_id`, `users_id`, `datetime`, `regional`, `long`, `lat`) VALUES
(2, 28, '2015-10-30 02:46:22', 'Bogor', '106.806039', '-6.597147');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `table_media_manager`
--

INSERT INTO `table_media_manager` (`media_manager_id`, `media_manager_title`, `media_manager_type`, `media_manager_filename`, `media_manager_publish`) VALUES
(1, 'Media Manager 1', '', '', '1'),
(2, 'Media Manager 2', '', '', '1'),
(4, 'Media manager 3', 'blabla', 'blabla', '1'),
(5, 'Media manager 4', 'test 4', 'test 4', '1'),
(6, 'Media manager 5', 'test 5', 'test 5', '1'),
(7, 'Media manager 6', 'test 6', 'test 6', '1'),
(8, 'Media manager 7', 'test 7', 'test 7', '0'),
(9, 'Media manager 8', 'test 8', 'test 8', '0'),
(10, 'Media manager 9', 'test 9', 'test 9', '1'),
(11, 'Media manager 10', 'test 10', 'test 10', '1'),
(12, 'Media manager 11', 'test 11', 'test 11', '0'),
(13, 'Media manager 12', 'test 12', 'test 12', '0'),
(14, 'Media manager 13', 'test 13', 'test 13', '1'),
(15, 'Media manager 14', 'test 14', 'test 14', '0'),
(16, 'Media manager 15', 'test 15', 'test 15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `table_notification`
--

CREATE TABLE IF NOT EXISTS `table_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_notification`
--

INSERT INTO `table_notification` (`notification_id`, `users_id`, `datetime`, `status`) VALUES
(2, 28, '2015-10-29 05:05:08', 'send'),
(3, 27, '2015-10-30 01:48:20', ''),
(4, 27, '2015-10-30 01:48:20', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `table_schedule`
--

INSERT INTO `table_schedule` (`schedule_id`, `schedule_title`, `schedule_type_id`, `schedule_users_creator`, `schedule_users_source`, `schedule_date_start`, `schedule_date_end`, `schedule_description`, `schedule_headline`, `schedule_media_id`, `schedule_publish`) VALUES
(1, 'Testing schedule', 1, 26, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'blablabla', 'blablabla', '1,2,3', '0'),
(2, 'Testing schedule2', 2, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule2', 'schedule2', '1,2,3', '0'),
(3, 'Testing schedule3', 2, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule3', 'schedule3', '1', '0'),
(4, 'Testing schedule4', 1, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule4', 'schedule4', '1,3,4,5', '0'),
(5, 'Testing schedule5', 3, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule5', 'schedule5', '1,3,4', '0'),
(6, 'Testing schedule6', 4, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule6', 'schedule6', '1,3', '0'),
(7, 'Testing schedule7', 4, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule7', 'schedule7', '3,4,5', '0'),
(8, 'Testing schedule8', 5, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule8', 'schedule8', '1,3,4', '0'),
(9, 'Testing schedule9', 9, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule9', 'schedule9', '3', '0'),
(10, 'Testing schedule10', 9, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule10', 'schedule10', '3', '0'),
(11, 'Testing schedule11', 7, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule11', 'schedule11', '5', '0'),
(12, 'Testing schedule12', 7, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule12', 'schedule12', '5', '0'),
(13, 'Testing schedule13', 7, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule13', 'schedule13', '5', '0'),
(14, 'Testing schedule14', 6, 27, 27, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule14', 'schedule14', '5', '0'),
(15, 'Testing schedule15', 8, 26, 26, '2015-10-29 00:00:00', '2015-10-29 00:00:00', 'schedule15', 'schedule15', '6', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `table_schedule_type`
--

INSERT INTO `table_schedule_type` (`schedule_type_id`, `schedule_type_name`, `schedule_type_desc`, `media_manager_id`) VALUES
(1, 'Schedule type 1', '', '1'),
(2, 'Schedule type 2', '', '2'),
(3, 'Schedule type 3', '', '3'),
(4, 'Schedule type 4', '', '4'),
(5, 'Schedule type 5', '', '5'),
(6, 'Schedule type 6', '', '6'),
(7, 'Schedule type 7', '', '7'),
(8, 'Schedule type 8', '', '8'),
(9, 'Schedule type 9', '', '9'),
(10, 'Schedule type 10', '', '10'),
(11, 'Schedule type 11', '', '11'),
(12, 'Schedule type 12', '', '12'),
(13, 'Schedule type 13', '', '13'),
(14, 'Schedule type 14', '', '14'),
(15, 'Schedule type 15', '', '15');

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
  `deviceID` varchar(100) DEFAULT NULL,
  `providerID` varchar(150) DEFAULT NULL,
  `deviceVersion` varchar(100) DEFAULT NULL,
  `deviceBrand` varchar(100) DEFAULT NULL,
  `long` varchar(100) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`users_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_users_detail`
--

INSERT INTO `table_users_detail` (`users_detail_id`, `users_id`, `users_name`, `users_fullname`, `users_password`, `users_group_id`, `users_email`, `users_telp`, `users_json_following`, `users_description`, `media_manager_id`, `users_avatar`, `users_status_id`, `users_password_recovery`, `deviceID`, `providerID`, `deviceVersion`, `deviceBrand`, `long`, `lat`) VALUES
(2, 26, 'ubay', 'bayu', '', 6, 'sdfsfddffsfata@data.com', '', '', '', '', 0, 0, '', NULL, 'IM3', '3.0', 'Samsung', NULL, NULL),
(3, 28, 'robbi', 'robbi', '', 6, 'data@data.com', '', '26,25,', '', '', 0, 0, '', NULL, 'IM3', '4.0', 'Xiaomi', NULL, NULL),
(4, 28, 'robbi', 'robbi', '', 6, 'data@data.com', '', '26,25,', '', '', 0, 0, '', NULL, 'Simpati', '4.0', 'Xiaomi', NULL, NULL);

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
(6, 'Masjid', 'Masjid', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Rheza2', 'admin@admin.com', '$2y$10$jE84xQoX/HjmXa5lCOKb5OTMOXoINK/QcBanjXF6NYc9bOPnend4i', 'n7aXJrTRqpeLeQFnRtyyi4lHTLslUXgSfvyxPZs0wJeoQt9U8A1gmTxqlMPl', '2015-10-15 09:37:38', '2015-10-15 09:44:29'),
(27, 'ubay', 'data@data.com', '$2y$10$nipTEi5yPMPtJiWBdHxidONj6CItXq2KyGhNwA7ihisYqM6vNqiL6', NULL, '2015-10-21 06:49:57', '2015-10-21 06:49:57'),
(28, 'test', 'test@test.com', '$2y$10$TGEB4ESQ4uJZvT1K18Zdoe6DU67DsHaJ1nUKkcRcFAWyhx5C2hCIC', 'N4gdZSLYKsqfq6lNcGTNCCnqcJVBSFm5yU8PGzxyQ933MCRJhZfwPEmsTz3L', '2015-11-27 10:30:13', '2015-10-28 06:19:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
