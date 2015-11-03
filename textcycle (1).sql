-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2011 at 04:10 AM
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
('13567', 'English Composition', '2', '', 'English', '', '1', ''),
('64321', 'Algorithm', '4', 'Dijkstra', 'Technology', '', '2', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `email`, `password`, `fname`, `lname`, `picture`, `havelist`, `needlist`) VALUES
(1, 'test@yahoo.com', 'a', 'test', 'person', '', '12345,54321,13567', '64321'),
(2, 'test1@yahoo.com', 'b', 'test1', 'person', '', '64321', '');
