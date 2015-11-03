-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2011 at 01:26 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `textcycle`
--

-- --------------------------------------------------------

--
-- Table structure for table `booklist`
--

CREATE TABLE IF NOT EXISTS `booklist` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(100) NOT NULL,
  `edition` varchar(10) NOT NULL,
  `author` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `owners` varchar(200) NOT NULL,
  `needs` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booklist`
--

INSERT INTO `booklist` (`isbn`, `title`, `edition`, `author`, `category`, `picture`, `owners`, `needs`) VALUES
('12345', 'Intro to Bio', '1', 'Scott', 'Biology', '', '1', ''),
('54321', 'Intro to CS', '3', 'Moses', 'Technology', '', '1', ''),
('13567', 'English Composition', '2', '', 'English', '', '1', '2'),
('64321', 'Algorithm', '4', 'Dijkstra', 'Technology', '', '2', '1'),
('13579', 'data structure', '2', 'genius', 'CS', '', '2,3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `isbn` varchar(30) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `time` varchar(20) NOT NULL,
  `readtag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`isbn`, `from`, `to`, `message`, `time`, `readtag`) VALUES
('64321', 1, 2, 'test123', '12/23/11', 0),
('64321', 1, 2, 'test', '12/24/11', 0),
('13579', 1, 3, 'hi', '12/24/11', 0),
('13579', 1, 2, 'hio', '12/24/11', 0),
('13579', 1, 2, 'hio', '12/24/11', 0),
('13579', 1, 3, 'Hey, how are you?', '12/24/11', 0),
('64321', 1, 2, 'asd', '12/24/11', 0),
('13579', 1, 3, 'Hi, how are you?', '12/24/11', 0),
('13579', 1, 2, 'hi', '12/24/11', 0),
('13579', 1, 3, 'Hi, how are you doing?', '12/24/11', 0),
('64321', 1, 2, 'good', '12/24/11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `havelist` varchar(200) NOT NULL,
  `needlist` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `email`, `password`, `fname`, `lname`, `picture`, `havelist`, `needlist`) VALUES
(1, 'test@yahoo.com', 'a', 'test', 'person', '', '12345,54321,13567', '64321,13579'),
(2, 'test1@yahoo.com', 'b', 'test1', 'person', '', '64321,13579', '13567'),
(3, 'test2@yahoo.com', 'c', 'test2', 'person', '', '13579', ''),
(4, 'test3@yahoo.com', 'e', 'test3', 'person', '', '', ''),
(5, 'c', 'd', 'a', 'b', '', '', ''),
(6, '', '', '', '', '', '', ''),
(7, 'asd', 'few', 'sd', 'dsa', '', '', ''),
(8, 'sd', '', 'd', 'dsa', '', '', '');
