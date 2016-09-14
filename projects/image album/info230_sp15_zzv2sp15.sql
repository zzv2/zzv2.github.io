-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2015 at 06:02 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `info230_sp15_zzv2sp15`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
`album_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `cover_image_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_last_modified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `title`, `owner_id`, `cover_image_id`, `description`, `date_created`, `date_last_modified`) VALUES
(8, 'myalbum2', 0, NULL, 'my album desc 2', '2015-03-17 09:48:46', '2015-03-17 09:48:46'),
(9, 'myalbum3', 0, NULL, 'test desc 3', '2015-03-17 15:23:22', '2015-03-17 15:23:22'),
(10, 'myalbum4', 0, NULL, 'my desc 4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'myalbum5', 0, NULL, 'newest test of album adding', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`image_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date_taken` datetime NOT NULL,
  `URL` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `caption` text COLLATE latin1_general_ci
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `owner_id`, `date_taken`, `URL`, `caption`) VALUES
(38, 1, '2011-01-21 15:58:20', '2011-01-21_10-58-21_968.jpg', 'test caption 4'),
(39, 1, '2011-01-21 16:00:33', '2011-01-21_11-00-35_343.jpg', '2011-01-21_11-00-35_343.jpg Actual size: width="2592" height="1456"'),
(40, 1, '2011-01-21 16:00:08', '2011-01-21_11-00-10_577.jpg', '2011-01-21_11-00-10_577.jpg Actual size: width="2592" height="1456"'),
(41, 1, '2010-12-24 22:33:33', '2010-12-24_17-33-34_817.jpg', '2010-12-24_17-33-34_817.jpg Actual size: width="2592" height="1456"'),
(42, 1, '2010-12-24 22:34:09', '2010-12-24_17-34-10_694.jpg', '2010-12-24_17-34-10_694.jpg Actual size: width="2592" height="1456"'),
(43, 1, '0000-00-00 00:00:00', 'IMG_20120620_202724.jpg', 'IMG_20120620_202724.jpg Actual size: width="3264" height="2448"'),
(45, 1, '2010-12-24 22:30:51', '2010-12-24_17-30-52_615.jpg', '2010-12-24_17-30-52_615.jpg Actual size: width="2592" height="1456" 2010:12:24 22:30:51'),
(47, 1, '2011-01-21 15:43:24', '2011-01-21_10-43-26_448.jpg', '2011-01-21_10-43-26_448.jpg Actual size: width="2592" height="1456" 2011:01:21 15:43:24'),
(48, 1, '2011-01-21 15:43:52', '2011-01-21_10-43-54_808.jpg', '2011-01-21_10-43-54_808.jpg Actual size: width="2592" height="1456" 2011:01:21 15:43:52'),
(49, 1, '2011-01-21 16:18:06', '2011-01-21_11-18-08_253.jpg', '2011-01-21_11-18-08_253.jpg Actual size: width="2592" height="1456" 2011:01:21 16:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
`relation_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`relation_id`, `image_id`, `album_id`) VALUES
(31, 41, 8),
(32, 42, 8),
(33, 43, 8),
(34, 45, 8),
(35, 47, 8),
(36, 48, 8),
(37, 49, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hashpassword` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `hashpassword`, `name`, `admin`) VALUES
(1, 'zzv2', 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646', 'Zach', 1),
(2, 'test_user', 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646', 'John Doe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
 ADD PRIMARY KEY (`album_id`), ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`image_id`), ADD UNIQUE KEY `URL` (`URL`), ADD UNIQUE KEY `URL_2` (`URL`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
 ADD PRIMARY KEY (`relation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `idx_unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
