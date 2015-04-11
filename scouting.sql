-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2015 at 06:18 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stacks`
--

CREATE TABLE IF NOT EXISTS `stacks` (
  `scout_data_id` int(11) NOT NULL,
  `totes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
MODIFY `scout_data_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
