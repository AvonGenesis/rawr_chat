-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2012 at 10:35 PM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatlog`
--

CREATE TABLE IF NOT EXISTS `chatlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `color` varchar(6) NOT NULL,
  `picture` int(11) NOT NULL DEFAULT '0',
  `text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `chatlog`
--

INSERT INTO `chatlog` (`id`, `roomID`, `userID`, `nickname`, `color`, `picture`, `text`, `timestamp`) VALUES
(1, 1, 0, 'SYSTEM', '', 0, 'Admin has left the chatroom.', '2012-11-03 21:29:03'),
(2, 1, 0, 'SYSTEM', '', 0, 'Admin has entered the chatroom.', '2012-11-03 21:29:06'),
(3, 1, 1, 'Admin', '289480', 1, 'Test', '2012-11-03 21:29:11'),
(4, 1, 1, 'Admin', '289480', 1, 'Works!', '2012-11-03 21:29:18'),
(5, 1, 0, 'SYSTEM', '', 0, 'The room creator has deleted this chatroom.', '2012-11-03 21:31:24'),
(6, 1, 0, 'SYSTEM', '', 0, 'Admin has entered the chatroom.', '2012-11-03 21:31:24'),
(7, 1, 0, 'SYSTEM', '', 0, 'Admin has left the chatroom.', '2012-11-03 21:31:25'),
(8, 0, 0, 'SYSTEM', '', 0, 'Admin has left the chatroom.', '2012-11-03 21:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE IF NOT EXISTS `chatrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomCreatorID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `users` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `roomCreatorID`, `name`, `users`, `deleted`) VALUES
(1, 1, 'Test', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(128) NOT NULL,
  `roomID` int(11) DEFAULT NULL,
  `picture` int(11) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roomID`, `picture`, `nickname`, `color`) VALUES
(1, 'admin', 'e3297908fc307602b596c6d2574d4e1e', 0, 1, 'Admin', '289480');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
