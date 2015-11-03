-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2011 at 12:03 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Books`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookList`
--

CREATE TABLE IF NOT EXISTS `bookList` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `isbn` varchar(200) NOT NULL,
  `rent` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `bookList`
--

INSERT INTO `bookList` (`id`, `fname`, `lname`, `picture`, `user`, `name`, `author`, `isbn`, `rent`, `sell`) VALUES
(49, 'Moses ', 'Isang', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'mo@gatech.edu', 'Intro to Biology', 'Sanek Hansen', '1110111011101', 0, 0),
(50, 'Asad', 'Abdulla', '../upload/silhouette.png', 'asad@emory.edu', 'Intro to Chemistry', 'Sanek Hansen', '1110110111011', 0, 0),
(51, 'Sarah', 'Ortman', '../upload/silhouette.png', 'sarah@hotmail.com', 'Statics ', 'John Copeland', '11212313123123', 0, 0),
(52, 'Sarah', 'Ortman', '../upload/silhouette.png', 'sarah@hotmail.com', 'Intro to Chemistry', 'John Copeland', '11212313123123', 0, 0),
(53, 'Sarah', 'Ortman', '../upload/silhouette.png', 'sarah@hotmail.com', 'Intro to Biology', '', '', 0, 0),
(54, 'Moses', 'Isang', '../upload/t_hero.png', 'mosesisang@yahoo.com', 'Principles of Chemistry', '', '', 0, 0),
(55, 'Moses', 'Isang', '../upload/t_hero.png', 'mosesisang@yahoo.com', 'Principles of Biology', '', '', 0, 0),
(56, 'Moses', 'Isang', '../upload/t_hero.png', 'mosesisang@yahoo.com', 'Intro to Chemistry', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `haveList`
--

CREATE TABLE IF NOT EXISTS `haveList` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `rent` int(11) NOT NULL,
  `buy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `haveList`
--

INSERT INTO `haveList` (`id`, `fname`, `lname`, `user`, `picture`, `name`, `author`, `isbn`, `rent`, `buy`) VALUES
(12, 'Robert ', 'James', 'rob@aol.com', '../upload/silhouette.png', 'Intro to Biology', 'Sanek Hansen', '11010010101111', 0, 0),
(11, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Principles of Marketing', 'James Cross', '1101101010101011', 0, 0),
(13, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Intro to Chemistry', 'Ken Saladin', '101011113311', 0, 0),
(14, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Fundamentals of Java', 'Moses Isang', '11101100111', 0, 0),
(15, 'Robert ', 'James', 'rob@aol.com', '../upload/silhouette.png', 'Intro to Chemistry', 'Sanek Hansen', '1101101110011', 0, 0),
(16, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Programming in C#', 'James McCraken', '11010110111', 0, 0),
(31, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Always', '', '', 0, 1),
(32, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Recover', '', '', 1, 0),
(33, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Victory', '', '', 1, 1),
(34, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Confirmation', '', '', 0, 0),
(35, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'You are more!', '', '', 1, 0),
(36, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Tenth Avenue North', '', '', 0, 0),
(37, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Tenth Avenue North 1', '', '', 1, 1),
(38, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Tenth Avenue North 2', '', '', 0, 1),
(39, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', 'Tenth Avenue North 3', '', '', 1, 0),
(40, 'Sarah', 'Ortman', 'sarah@hotmail.com', '../upload/silhouette.png', 'Calculus 2', 'John Cash', '12221321311341', 1, 0);
