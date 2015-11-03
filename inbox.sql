-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2011 at 05:01 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `inbox_1`
--

CREATE TABLE IF NOT EXISTS `inbox_1` (
  `from` double NOT NULL,
  `msg_ids` varchar(500) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox_1`
--

INSERT INTO `inbox_1` (`from`, `msg_ids`, `isbn`) VALUES
(2, '4,5,6', '13567'),
(2, '7', '64321');

-- --------------------------------------------------------

--
-- Table structure for table `inbox_2`
--

CREATE TABLE IF NOT EXISTS `inbox_2` (
  `from` double NOT NULL,
  `msg_ids` varchar(500) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox_2`
--

INSERT INTO `inbox_2` (`from`, `msg_ids`, `isbn`) VALUES
(1, '1,2,3', '64321');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` double NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL,
  `read` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `message`, `read`, `time`) VALUES
(1, 'hi', 0, '12/24/11 21:37:13'),
(2, 'how are you', 0, '12/24/11 21:37:40'),
(3, 'hello', 0, '12/24/11 23:26:28'),
(4, 'good', 1, '12/24/11 23:27:02'),
(5, 'how much is it?', 0, '12/24/11 23:27:21'),
(6, 'how much is it?fef', 1, '12/24/11 23:36:35'),
(7, 'finally fixed', 0, '12/24/11 23:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `outbox_1`
--

CREATE TABLE IF NOT EXISTS `outbox_1` (
  `to` double NOT NULL,
  `msg_ids` varchar(500) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outbox_1`
--

INSERT INTO `outbox_1` (`to`, `msg_ids`, `isbn`) VALUES
(2, '1,2,3', '64321');

-- --------------------------------------------------------

--
-- Table structure for table `outbox_2`
--

CREATE TABLE IF NOT EXISTS `outbox_2` (
  `to` int(11) NOT NULL,
  `msg_ids` varchar(100) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outbox_2`
--

INSERT INTO `outbox_2` (`to`, `msg_ids`, `isbn`) VALUES
(1, '4,5,6', '13567'),
(1, '7', '64321');
