-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2015 at 05:51 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `insite`
--
CREATE DATABASE IF NOT EXISTS insite;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` int(11) NOT NULL,
  `full_name` varchar(256) DEFAULT NULL,
  `email` varchar(512) DEFAULT NULL,
  `body_text` text NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `handler`
--

CREATE TABLE IF NOT EXISTS `handler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_name` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `location_name` varchar(256) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `image_path` varchar(512) DEFAULT NULL,
  `date_reported` date NOT NULL,
  `time_reported` time NOT NULL,
  `urgency_level` varchar(64) NOT NULL,
  `reporter_name` varchar(256) NOT NULL,
  `email` varchar(512) NOT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'Pending',
  `status_comment` varchar(1024) DEFAULT NULL,
  `handler_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `issue_name`, `description`, `location_name`, `latitude`, `longitude`, `image_path`, `date_reported`, `time_reported`, `urgency_level`, `reporter_name`, `email`, `contact`, `status`, `status_comment`, `handler_id`) VALUES
(1, 'Life broke down', 'The life black outs.', 'Lobby A', 0, 0, 'http://192.168.1.5/insite/web/image/issue/1.jpg', '2015-03-18', '13:15:20', 'Very high', 'Ah Seng', 'mun.seng@sit.singaporetech.edu.sg', '85331234', 'Resolved', NULL, NULL),
(2, 'Aircon broke down', 'Both computers and humans need to cool down.', 'Desktop Lab', 0, 0, NULL, '2015-03-21', '10:12:56', 'Very high', 'Tan Ah Chai', 'chai@example.com', '1234567891', 'Resolved', NULL, NULL),
(3, 'Broken chairs', 'The chairs broke its leg.', 'SR2B', 0, 0, '', '2015-03-20', '09:59:59', 'High', 'Tan Ah Chai', 'chai@example.com', '123456789', 'Pending', '', NULL),
(4, 'Expired food in vending machine', 'The auto-heating vending food taste sour.', 'Student Recreation Area', 0, 0, '', '2015-03-22', '20:34:04', 'Normal', 'Dr Who', 'drwho@example.com', NULL, 'Pending', NULL, NULL),
(5, 'ff', 'ccy', 'ddd', 0, 0, NULL, '2015-04-06', '05:20:08', 'Very Low', 'TAN YEONG CHAI (AH CHAI)', 'butchercai@gmail.com', NULL, 'Resolved', '', NULL),
(6, 'gggg', 'hhhhh\nggg', 'rrrr', 0, 0, '', '2015-04-07', '23:47:31', 'Very Low', 'ffff', 'fff', NULL, 'Resolved', '', NULL),
(7, 'ttt', 'ttttt', 'tttt', 0, 0, '', '2015-04-07', '05:42:22', 'Very Low', 'tttt', 'tttt', NULL, 'Pending', NULL, NULL),
(8, 'ttt', 'ttttt', 'tttt', 0, 0, '', '2015-04-07', '05:43:25', 'Very Low', 'ttttggggg', 'ttttgggg', NULL, 'Pending', NULL, NULL),
(9, 'ttttff', 'hhhh', 'fffff', 0, 0, '', '2015-04-07', '05:50:11', 'High', 'ghhj', 'fff@ccc.cin', NULL, 'Pending', NULL, NULL),
(10, 'ffff', 'cvhhh', 'ffggggg', 0, 0, '', '2015-04-07', '06:53:36', 'Normal', 'ggjjj', 'fffff', NULL, 'Pending', NULL, NULL),
(11, 'haha', 'haha', 'haha', 0, 0, 'inSITe_20150408_004149.jpg', '2015-04-08', '08:42:30', 'Very High', 'haha', 'haha', NULL, 'Pending', NULL, NULL),
(12, 'oooo', 'ooooo', 'oooo', 0, 0, 'inSITe_20150408_011410.jpg', '2015-04-08', '09:14:22', 'Normal', 'ffff', 'gggg', NULL, 'Pending', NULL, NULL),
(13, 'yy', 'yyyy', 'tyyy', 0, 0, 'inSITe_20150408_011746.jpg', '2015-04-08', '09:17:58', 'Very Low', 'yyyy', 'yyyyy', '', 'Pending', NULL, NULL),
(14, 'ggg', 'nnnnn', 'bnnnn', 0, 0, 'inSITe_20150408_012749.jpg', '2015-04-08', '09:27:56', 'High', 'bbbh', 'jjj', '', 'Pending', NULL, NULL),
(15, 'ggg', 'nnnnn', 'bnnnn', 0, 0, 'inSITe_20150408_012749.jpg', '2015-04-08', '09:28:07', 'High', 'bbbh', 'jjj', '', 'Pending', NULL, NULL),
(16, 'tttt', 'cccc', 'ssss', 0, 0, NULL, '2015-04-08', '09:43:12', 'Normal', 'xxxx', 'xxxx', '', 'Pending', NULL, NULL),
(17, 'hhh', 'mmmm', 'xccc', 0, 0, NULL, '2015-04-08', '09:54:42', 'Very Low', 'ggvv', 'vvv', '', 'Pending', NULL, NULL),
(18, 'ttt', 'gggg', 'ttt', 0, 0, 'inSITe_20150408_161203.jpg', '2015-04-08', '00:12:20', 'Low', 'point', 'plm', '00055555', 'Pending', NULL, NULL),
(19, 'same', 'hhhh', 'zzzzzz', 0, 0, 'http://192.168.1.50', '2015-04-08', '00:15:14', 'Low', 'point', 'plm', '00055555', 'Pending', NULL, NULL),
(20, 'npgss', 'vbbbv', 'zcccc', 0, 0, 'http://192.168.1.5/web/image/issue/inSITe_20150408_162134.jpg', '2015-04-08', '00:22:08', 'Normal', 'point', 'plm', '00055555', 'Pending', NULL, NULL),
(21, 'npgss', 'vbbbv', 'zcccc', 0, 0, 'http://192.168.1.5/web/image/issue/inSITe_20150408_162134.jpg', '2015-04-08', '00:22:08', 'Normal', 'point', 'plm', '00055555', 'Pending', NULL, NULL),
(22, 'vvv', 'bbbb', 'uuu', 0, 0, 'http://192.168.1.5insite/web/image/issue/inSITe_20150408_170707.jpg', '2015-04-08', '01:07:41', 'Normal', 'point', 'plm', '00055555', 'Pending', NULL, NULL),
(23, 'dddbdnnd', 'shsjnxnxnx\nxjjxnxnx\njjzjzjs', 'dnndnd', 0, 0, NULL, '2015-04-09', '01:18:10', 'Very High', 'bbbbbn', 'bbb', '5588655', 'Pending', NULL, NULL),
(24, 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', 'hbbbbb', 'test test test test test test test test test test test test test test test test test test test test test test test test ', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_011848.jpg', '2015-04-09', '01:19:20', 'Normal', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(25, 'you', 'you', 'yoy', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_012801.jpg', '2015-04-09', '01:28:17', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(26, 'gggg', 'hhhhhh', 'gggg', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_013101.jpg', '2015-04-09', '01:31:33', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(27, 'testing', 'tsstjbg', 'testubg', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_030541.jpg', '2015-04-09', '03:06:16', 'Normal', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(28, '1', '1', '1', 0, 0, NULL, '2015-04-09', '03:33:15', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(29, '2', 'w', 'w', 0, 0, NULL, '2015-04-09', '03:33:44', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(30, '3', 'rrr', 'rrr', 0, 0, NULL, '2015-04-09', '05:15:47', 'Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(31, '4', 'n', 't', 0, 0, NULL, '2015-04-09', '05:16:48', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(32, 'tttt', 'hbb', 'ttttg', 0, 0, NULL, '2015-04-09', '06:24:34', 'Very High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(33, 'gggg', 'vvbb', 'vvv', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_062632.jpg', '2015-04-09', '06:26:42', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(34, 'hhh', 'hhh', 'hhh', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_063856.jpg', '2015-04-09', '06:39:08', 'Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(35, 'zzzz', 'zzx', 'zzx', 0, 0, 'http://192.168.1.5/insite/web/image/issue/inSITe_20150409_064433.jpg', '2015-04-09', '06:45:13', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(36, 'yyyy', 'yyy', 'yyy', 0, 0, NULL, '2015-04-09', '06:49:51', 'High', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(37, '123', 'ggvbn', 'qedfg', 0, 0, NULL, '2015-04-09', '06:50:31', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(38, 'test test', 'ygh b', 'rrrrr', 0, 0, NULL, '2015-04-09', '06:51:31', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(39, 'oop', 'oop', 'oop', 0, 0, NULL, '2015-04-09', '06:51:59', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(40, 'yuo', 'you\nhbb', 'yuo', 0, 0, NULL, '2015-04-09', '06:52:34', 'Very Low', 'hhh', 'bbb', '5588655', 'Pending', NULL, NULL),
(41, 'test', 'bbb', 'test', 0, 0, NULL, '2015-04-09', '10:43:24', 'Very Low', 'Xing Yi', 'bbb', '5588655', 'Pending', NULL, NULL),
(42, 'ggg', 'ggg', 'bbbv', 0, 0, NULL, '2015-04-09', '10:46:00', 'Very Low', 'ghhh', 'gvbh', '5588655', 'Pending', 'This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. This is just a test comment. ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE IF NOT EXISTS `reporter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_name` varchar(512) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `mobile` int(8) DEFAULT NULL,
  `device_id` varchar(64) NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` text NOT NULL,
  `api_key` varchar(32) NOT NULL,
  `status` int(1) NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`, `api_key`, `status`, `datetime_created`) VALUES
(0, 'Lim Xing Yi', 'xingyi.lim_2014@sit.singaporetech.edu.sg', '$2a$10$e3fb6003e433f20550fc9OlKPJisQ7S8gkraJXuj.hTDq6xeW8IGa', '51d3b1d3beb959685da8fa662de3948a', 1, '2015-03-18 20:56:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
