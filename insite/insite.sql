-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2015 at 05:07 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `insite`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `full_name` varchar(256) DEFAULT NULL,
  `email` varchar(512) DEFAULT NULL,
  `body_text` text NOT NULL,
  `datetime_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `handler`
--

CREATE TABLE IF NOT EXISTS `handler` (
`id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `datetime_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
`id` int(11) NOT NULL,
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
  `mobile` int(8) DEFAULT NULL,
  `status` varchar(64) NOT NULL,
  `status_comment` varchar(1024) DEFAULT NULL,
  `handler_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `issue_name`, `description`, `location_name`, `latitude`, `longitude`, `image_path`, `date_reported`, `time_reported`, `urgency_level`, `reporter_name`, `email`, `mobile`, `status`, `status_comment`, `handler_id`) VALUES
(1, 'Life broke down', 'The life black outs.', 'Lobby A', 0, 0, 'web/issue-image/issue-1.jpg', '2015-03-18', '13:15:20', 'Very high', 'Ah Seng', 'mun.seng@sit.singaporetech.edu.sg', 85331234, 'Resolved', NULL, NULL),
(2, 'Aircon broke down', 'Both computers and humans need to cool down.', 'Desktop Lab', 0, 0, NULL, '2015-03-21', '10:12:56', 'Very high', 'Tan Ah Chai', 'chai@example.com', 1234567891, '', NULL, NULL),
(3, 'Broken chairs', 'The chairs broke its leg.', 'SR2B', 0, 0, '', '2015-03-20', '09:59:59', 'High', 'Tan Ah Chai', 'chai@example.com', 123456789, '', NULL, NULL),
(4, 'Expired food in vending machine', 'The auto-heating vending food taste sour.', 'Student Recreation Area', 0, 0, '', '2015-03-22', '20:34:04', 'Normal', 'Dr Who', 'drwho@example.com', NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE IF NOT EXISTS `reporter` (
`id` int(11) NOT NULL,
  `reporter_name` varchar(512) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `mobile` int(8) DEFAULT NULL,
  `device_id` varchar(64) NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `datetime_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`, `api_key`, `status`, `datetime_created`) VALUES
(0, 'Lim Xing Yi', 'xingyi.lim_2014@sit.singaporetech.edu.sg', '$2a$10$e3fb6003e433f20550fc9OlKPJisQ7S8gkraJXuj.hTDq6xeW8IGa', '51d3b1d3beb959685da8fa662de3948a', 1, '2015-03-18 20:56:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handler`
--
ALTER TABLE `handler`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporter`
--
ALTER TABLE `reporter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `handler`
--
ALTER TABLE `handler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reporter`
--
ALTER TABLE `reporter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
