-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2011 at 12:04 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `UserProfiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `fName` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `fName`, `Lname`, `email`, `picture`, `password`) VALUES
(112, 'Moses', 'Isang', 'mosesisang@yahoo.com', '../upload/t_hero.png', '0cc175b9c0f1b6a831c399e269772661'),
(111, 'Sarah', 'Ortman', 'sarah@hotmail.com', '../upload/silhouette.png', '1d8d5e912302108b5e88c3e77fcad378'),
(110, 'Asad', 'Abdulla', 'asad@emory.edu', '../upload/silhouette.png', '1d8d5e912302108b5e88c3e77fcad378'),
(109, 'Robert ', 'James', 'rob@aol.com', '../upload/silhouette.png', '1d8d5e912302108b5e88c3e77fcad378'),
(108, 'Moses ', 'Isang', 'mo@gatech.edu', '../upload/Photo on 2011-08-01 at 18.29.jpg', '1d8d5e912302108b5e88c3e77fcad378');
