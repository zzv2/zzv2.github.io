-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2015 at 11:57 PM
-- Server version: 5.0.95
-- PHP Version: 5.3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `info230_SP15_vavo`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL auto_increment,
  `line_1` varchar(256) NOT NULL,
  `line_2` text,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipcode` text NOT NULL,
  `lat` double default NULL,
  `lng` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `line_1`, `line_2`, `city`, `state`, `zipcode`, `lat`, `lng`) VALUES
(26, '531 Esty St', 'Apt A.', 'Ithaca', 'NY', '14850', NULL, NULL),
(27, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(28, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(29, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(30, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(31, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(32, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(33, '500 S Meadow St', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(34, '112 Sage Pl', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(35, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(36, '64 Wheeler Ave', '', 'Cortland', 'NY', '13045', NULL, NULL),
(37, '40 Catherwood Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(38, '654 Spencer Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(39, '3rd St', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(40, '', '', '', '', '', NULL, NULL),
(41, '654 Spencer Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(42, '635 W State St', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(43, '903 Hanshaw Rd', '', 'Ithaca', 'NY', '14850', NULL, NULL),
(44, '618 Stewart Ave.', 'Apt. A', 'Ithaca', 'NY', '14853', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE IF NOT EXISTS `availability` (
  `id` int(11) NOT NULL auto_increment,
  `provider_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `11:00 PM` int(1) NOT NULL,
  `10:45 PM` int(1) NOT NULL,
  `10:30 PM` int(1) NOT NULL,
  `10:15 PM` int(1) NOT NULL,
  `10:00 PM` int(1) NOT NULL,
  `9:45 PM` int(1) NOT NULL,
  `9:30 PM` int(1) NOT NULL,
  `9:15 PM` int(1) NOT NULL,
  `9:00 PM` int(1) NOT NULL,
  `8:45 PM` int(1) NOT NULL,
  `8:30 PM` int(1) NOT NULL,
  `8:15 PM` int(1) NOT NULL,
  `8:00 PM` int(1) NOT NULL,
  `7:45 PM` int(1) NOT NULL,
  `7:30 PM` int(1) NOT NULL,
  `7:15 PM` int(1) NOT NULL,
  `7:00 PM` int(1) NOT NULL,
  `6:45 PM` int(1) NOT NULL,
  `6:30 PM` int(1) NOT NULL,
  `6:15 PM` int(1) NOT NULL,
  `6:00 PM` int(1) NOT NULL,
  `5:45 PM` int(1) NOT NULL,
  `5:30 PM` int(1) NOT NULL,
  `5:15 PM` int(1) NOT NULL,
  `5:00 PM` int(1) NOT NULL,
  `4:45 PM` int(1) NOT NULL,
  `4:30 PM` int(1) NOT NULL,
  `4:15 PM` int(1) NOT NULL,
  `4:00 PM` int(1) NOT NULL,
  `3:45 PM` int(1) NOT NULL,
  `3:30 PM` int(1) NOT NULL,
  `3:15 PM` int(1) NOT NULL,
  `3:00 PM` int(1) NOT NULL,
  `2:45 PM` int(1) NOT NULL,
  `2:30 PM` int(1) NOT NULL,
  `2:15 PM` int(1) NOT NULL,
  `2:00 PM` int(1) NOT NULL,
  `1:45 PM` int(1) NOT NULL,
  `1:30 PM` int(1) NOT NULL,
  `1:15 PM` int(1) NOT NULL,
  `1:00 PM` int(1) NOT NULL,
  `12:45 PM` int(1) NOT NULL,
  `12:30 PM` int(1) NOT NULL,
  `12:15 PM` int(1) NOT NULL,
  `12:00 PM` int(1) NOT NULL,
  `11:45 AM` int(1) NOT NULL,
  `11:30 AM` int(1) NOT NULL,
  `11:15 AM` int(1) NOT NULL,
  `11:00 AM` int(1) NOT NULL,
  `10:45 AM` int(1) NOT NULL,
  `10:30 AM` int(1) NOT NULL,
  `10:15 AM` int(1) NOT NULL,
  `10:00 AM` int(1) NOT NULL,
  `9:45 AM` int(1) NOT NULL,
  `9:30 AM` int(1) NOT NULL,
  `9:15 AM` int(1) NOT NULL,
  `9:00 AM` int(1) NOT NULL,
  `8:45 AM` int(1) NOT NULL,
  `8:30 AM` int(1) NOT NULL,
  `8:15 AM` int(1) NOT NULL,
  `8:00 AM` int(1) NOT NULL,
  `7:45 AM` int(1) NOT NULL,
  `7:30 AM` int(1) NOT NULL,
  `7:15 AM` int(1) NOT NULL,
  `7:00 AM` int(1) NOT NULL,
  `6:45 AM` int(1) NOT NULL,
  `6:30 AM` int(1) NOT NULL,
  `6:15 AM` int(1) NOT NULL,
  `6:00 AM` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `provider_id`, `date`, `11:00 PM`, `10:45 PM`, `10:30 PM`, `10:15 PM`, `10:00 PM`, `9:45 PM`, `9:30 PM`, `9:15 PM`, `9:00 PM`, `8:45 PM`, `8:30 PM`, `8:15 PM`, `8:00 PM`, `7:45 PM`, `7:30 PM`, `7:15 PM`, `7:00 PM`, `6:45 PM`, `6:30 PM`, `6:15 PM`, `6:00 PM`, `5:45 PM`, `5:30 PM`, `5:15 PM`, `5:00 PM`, `4:45 PM`, `4:30 PM`, `4:15 PM`, `4:00 PM`, `3:45 PM`, `3:30 PM`, `3:15 PM`, `3:00 PM`, `2:45 PM`, `2:30 PM`, `2:15 PM`, `2:00 PM`, `1:45 PM`, `1:30 PM`, `1:15 PM`, `1:00 PM`, `12:45 PM`, `12:30 PM`, `12:15 PM`, `12:00 PM`, `11:45 AM`, `11:30 AM`, `11:15 AM`, `11:00 AM`, `10:45 AM`, `10:30 AM`, `10:15 AM`, `10:00 AM`, `9:45 AM`, `9:30 AM`, `9:15 AM`, `9:00 AM`, `8:45 AM`, `8:30 AM`, `8:15 AM`, `8:00 AM`, `7:45 AM`, `7:30 AM`, `7:15 AM`, `7:00 AM`, `6:45 AM`, `6:30 AM`, `6:15 AM`, `6:00 AM`) VALUES
(1, 5, '2015-05-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 6, '2015-05-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 7, '2015-05-07', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(6, 7, '2015-05-08', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(7, 7, '2015-05-13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0),
(8, 7, '2015-05-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 7, '2015-05-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 7, '2015-05-15', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(11, 7, '2015-05-16', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 7, '2015-05-11', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 7, '2015-05-17', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(14, 7, '2015-05-12', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(15, 7, '2015-05-13', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(16, 7, '2015-05-14', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 7, '2015-05-15', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(18, 7, '2015-05-16', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(19, 7, '2015-05-17', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(20, 7, '2015-05-18', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(21, 7, '2015-05-19', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(22, 7, '2015-05-20', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(23, 7, '2015-05-21', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(24, 5, '2015-05-12', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(25, 5, '2015-05-13', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(26, 5, '2015-05-14', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 5, '2015-05-15', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(28, 5, '2015-05-16', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(29, 5, '2015-05-17', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(30, 5, '2015-05-18', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(31, 5, '2015-05-19', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(32, 5, '2015-05-20', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(33, 5, '2015-05-21', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(34, 6, '2015-05-12', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(35, 6, '2015-05-13', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(36, 6, '2015-05-14', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 6, '2015-05-15', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(38, 6, '2015-05-16', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(39, 6, '2015-05-17', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(40, 6, '2015-05-18', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(41, 6, '2015-05-19', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(42, 6, '2015-05-20', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(43, 6, '2015-05-21', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(64) default NULL,
  `picture` varchar(256) NOT NULL default 'uploads/default.png',
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `password`, `salt`, `name`, `phone`, `picture`, `created_at`) VALUES
(6, 'keshavdv@gmail.com', 'f44c33162c8ef409f6183f85708bf7b961090e1345e4a2665c0252cbaf3c4634', '5548b951d6f3e', 'Keshav Varma', '(408) 306-7255', 'uploads/default.png', '2015-05-05 12:36:33'),
(8, 'test2@test.com', '2bc1eff989b2d9aca4671e9543b665438e585609c77ee8190f7b108a923d9d7c', '554a03d1b253e', 'Nick Fury', '(999) 911-0001', 'uploads/55522cc9a2119.jpg', '2015-05-06 12:06:41'),
(9, 'cat@hat.com', '1b83dc51bfb05c696dc146bc529efe92c99eb5701b3a740f274f36d9185a86b8', '55521bf85b2d0', 'The Cat in the Hat', '(012) 345-6789', 'uploads/55521c185f2a9.jpg', '2015-05-12 15:27:52'),
(10, 'peterg@familyguy.com', 'a1dadf5d0ce4aaca27d9544a5c1e1677c20b79d66ca2bbd93e956af906ce307b', '55521dbfe85c1', 'Peter Griffin', '(342) 312-3452', 'uploads/55521e988f635.jpg', '2015-05-12 15:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `name` varchar(256) default NULL,
  `phone` varchar(256) NOT NULL,
  `address_id` int(11) default NULL,
  `description` text,
  `picture` varchar(256) NOT NULL default 'uploads/default.png',
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `address_id` (`address_id`),
  KEY `address_id_2` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `email`, `password`, `salt`, `name`, `phone`, `address_id`, `description`, `picture`, `created_at`) VALUES
(5, 'provider@test.com', '028cc216a4be19ce3c432e092535e742ee34ccd551728e5bea0ed4b5ea91c22b', '553ec4f037db3', 'Iron Man', '(303) 198-4234', 3, NULL, 'uploads/ironman.jpg', '2015-04-27 23:23:28'),
(6, 'hello@test.com', '9b74761b8113a0898322cad7166fabe3a6c87765dc7f03566741f42d7f1f38f2', '553eca965b88c', 'Donut Boy', '(987) 345-2342', 2, NULL, 'uploads/simpson.png', '2015-04-27 23:47:34'),
(7, 'test1@test.com', '16350f49e4cf039094ef62dc632e777cde4fb3b092222723cbaac75953013416', '553ed34494b78', 'Black Widow', '(408) 306-7244', 44, NULL, 'uploads/55510ef6ee540.jpg', '2015-04-28 00:24:36'),
(11, 'test@test.com', 'f48925bdb7fee9c194feef5e1456f3c86dc63b33c81b28590bf1d3700a1f7eed', '553d9b067bfae', 'Test', '(988) 888-3322', 4, NULL, 'uploads/default.png', '2015-04-27 02:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `comments` text,
  `token` varchar(256) NOT NULL,
  `payment_token` varchar(256) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `customer_id` (`customer_id`,`provider_id`,`address_id`),
  KEY `requests_ibfk_1` (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `customer_id`, `provider_id`, `address_id`, `start_time`, `end_time`, `comments`, `token`, `payment_token`, `status`, `created_at`) VALUES
(1, 8, 5, 28, '2015-05-07 08:00:00', '1969-12-31 19:00:00', 'I have a dog, so hopefully you aren''t allergic', '554a069c5846b', 'tok_15zRTzAQZt8v57mc6hRUyVOy', 1, '2015-05-06 12:18:36'),
(7, 8, 6, 34, '2015-05-07 14:35:00', '1969-12-31 19:00:00', 'I have this really dirty rug', '554a5f53ab9f4', 'tok_15zXOJAQZt8v57mcxFHFrVgS', 4, '2015-05-06 18:37:07'),
(8, 8, 7, 35, '2015-05-07 16:00:00', '1969-12-31 19:00:00', 'my place is dirty', '554a60c62dff8', 'tok_15zXUHAQZt8v57mcbFyGhTVY', 2, '2015-05-06 18:43:18'),
(9, 8, 7, 36, '2015-05-12 16:00:00', '1969-12-31 19:00:00', 'dirty walls and bathrooms need to be cleansed', '555100d1365f8', 'tok_161MRBAQZt8v57mcePJqGXAD', 4, '2015-05-11 19:19:45'),
(10, 9, 5, 37, '2015-05-13 12:00:00', '1969-12-31 19:00:00', 'I have two kids who want me to clean up their place. I made a huge mess and I need your help.', '55521cb3a9962', 'tok_161fLTAQZt8v57mcebaPbiYz', 1, '2015-05-12 15:30:59'),
(11, 10, 6, 38, '2015-05-16 13:00:00', '1969-12-31 19:00:00', 'Lois is really mad at me, needs to be done quietly', '55521e05a256e', 'tok_161fQvAQZt8v57mc4kjJ1xNs', 1, '2015-05-12 15:36:37'),
(12, 10, 7, 39, '2015-05-17 11:37:00', '1969-12-31 19:00:00', 'The Cornell boathouse needs serious cleaning after the championship race this weekend. Prepare to get wet.', '55521e6822bc2', 'tok_161fSVAQZt8v57mcLquivOtD', 5, '2015-05-12 15:38:16'),
(13, 8, 7, 40, '2015-05-13 12:30:00', '1969-12-31 19:00:00', 'Come over to Iron Man''s place. He made a big mess with his party last night.', '555227abbe96a', 'tok_161g4lAQZt8v57mcdzgpCtFI', 1, '2015-05-12 16:17:47'),
(14, 8, 7, 41, '2015-08-12 12:45:00', '1969-12-31 19:00:00', 'Bring a mop.', '555228300899f', 'tok_161g6tAQZt8v57mcpHV15eCO', 4, '2015-05-12 16:20:00'),
(15, 9, 7, 42, '2015-05-26 13:45:00', '1969-12-31 19:00:00', 'I have a cat, just be aware.', '55522d54b521e', 'tok_161gS8AQZt8v57mcghoQUWwg', 1, '2015-05-12 16:41:56'),
(16, 9, 7, 43, '2015-05-18 12:42:00', '1969-12-31 19:00:00', 'My place is located around back.', '55522dba02f08', 'tok_161gTlAQZt8v57mckr5Ppvc9', 1, '2015-05-12 16:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL auto_increment,
  `transaction_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `provider_id` (`provider_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `transaction_id`, `provider_id`, `customer_id`, `rating`, `comments`) VALUES
(1, 0, 5, 7, 4, ''),
(2, 0, 6, 7, 2, ''),
(3, 0, 7, 7, 5, ''),
(4, 0, 11, 7, 5, ''),
(5, 0, 11, 7, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `stringaddr`
--

CREATE TABLE IF NOT EXISTS `stringaddr` (
  `id` int(11) NOT NULL auto_increment,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `stringaddr`
--

INSERT INTO `stringaddr` (`id`, `address`) VALUES
(1, '102 Brook Lane, Ithaca, NY, United States'),
(2, '119 The Knoll Road, Ithaca, NY, United States'),
(3, '62 W Main St, Dryden, NY, United States'),
(4, '50 Graham Rd W, Ithaca, NY, United States'),
(5, '424 Dryden Road, Ithaca, NY, United States');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
