-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2015 at 08:44 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scouting`
--
CREATE DATABASE IF NOT EXISTS `scouting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scouting`;

-- --------------------------------------------------------

--
-- Table structure for table `scout_data`
--

DROP TABLE IF EXISTS `scout_data`;
CREATE TABLE IF NOT EXISTS `scout_data` (
`scout_data_id` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `match_number` int(11) DEFAULT NULL,
  `comments` text,
  `robot_moved` tinyint(1) NOT NULL,
  `totes_auto` int(11) NOT NULL,
  `cans_auto` int(11) NOT NULL,
  `coopertition` tinyint(1) NOT NULL,
  `coopertition_totes` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scout_data`
--

INSERT INTO `scout_data` (`scout_data_id`, `team`, `match_number`, `comments`, `robot_moved`, `totes_auto`, `cans_auto`, `coopertition`, `coopertition_totes`, `score`) VALUES
(1, 3506, 4, NULL, 1, 3, 3, 0, 0, 200),
(2, 3506, 1, NULL, 1, 3, 3, 0, 1, 200),
(6, 3506, 6, NULL, 1, 3, 3, 0, 2, 120),
(7, 3506, 98, NULL, 1, 3, 3, 0, 2, 500),
(8, 1111, 1, NULL, 1, 2, 3, 0, 2, 105),
(9, 1111, 2, NULL, 0, 3, 3, 0, 0, 120),
(10, 1337, 1, NULL, 1, 0, 1, 0, 1, 76),
(11, 1337, 2, NULL, 1, 0, 1, 0, 2, 175),
(12, 1111, 3, NULL, 1, 0, 0, 0, 3, 130),
(13, 1337, 3, NULL, 1, 1, 0, 0, 0, 111),
(14, 1337, 4, NULL, 1, 0, 2, 0, 3, 132),
(15, 1111, 4, NULL, 1, 0, 0, 0, 2, 150);

-- --------------------------------------------------------

--
-- Table structure for table `stacks`
--

DROP TABLE IF EXISTS `stacks`;
CREATE TABLE IF NOT EXISTS `stacks` (
  `scout_data_id` int(11) NOT NULL,
  `totes` int(11) NOT NULL,
  `cap_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stacks`
--

INSERT INTO `stacks` (`scout_data_id`, `totes`, `cap_state`) VALUES
(2, 3, 1),
(6, 5, 1),
(6, 2, 2),
(7, 1, 1),
(7, 2, 0),
(7, 5, 0),
(7, 6, 2),
(8, 2, 1),
(8, 6, 0),
(9, 3, 2),
(9, 1, 1),
(9, 5, 0),
(10, 1, 0),
(10, 2, 1),
(10, 3, 2),
(11, 2, 2),
(11, 4, 2),
(12, 1, 0),
(12, 4, 0),
(12, 4, 2),
(13, 3, 1),
(13, 3, 0),
(13, 1, 2),
(14, 1, 2),
(14, 1, 2),
(14, 1, 2),
(14, 3, 0),
(15, 3, 0),
(15, 4, 2),
(15, 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scout_data`
--
ALTER TABLE `scout_data`
 ADD PRIMARY KEY (`scout_data_id`), ADD KEY `team` (`team`);

--
-- Indexes for table `stacks`
--
ALTER TABLE `stacks`
 ADD KEY `scout_data_id` (`scout_data_id`), ADD KEY `scout_data_id_2` (`scout_data_id`), ADD KEY `scout_data_id_3` (`scout_data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scout_data`
--
ALTER TABLE `scout_data`
MODIFY `scout_data_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
