-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2015 at 01:56 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `scout_data`
--

CREATE TABLE IF NOT EXISTS `scout_data` (
`id` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `match_number` int(11) NOT NULL,
  `comments` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scout_data`
--

INSERT INTO `scout_data` (`id`, `team`, `rating`, `match_number`, `comments`) VALUES
(1, 3506, 10, 1, NULL),
(2, 1225, 10, 2, 'good stacker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scout_data`
--
ALTER TABLE `scout_data`
 ADD PRIMARY KEY (`id`), ADD KEY `team` (`team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scout_data`
--
ALTER TABLE `scout_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
