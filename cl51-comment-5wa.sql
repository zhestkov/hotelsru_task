-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2017 at 03:38 PM
-- Server version: 5.5.54
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cl51-comment-5wa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` text NOT NULL,
  `comment` text NOT NULL,
  `level` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `author`, `comment`, `level`, `parentId`, `datetime`) VALUES
(2, 'Jack', 'This is post #2', 1, 0, '2016-09-08 20:21:58'),
(3, 'Test user', 'This is post #3', 1, 0, '2016-09-08 20:22:46'),
(4, 'Andrew', 'This is comment to post #3', 2, 3, '2016-09-08 20:23:10'),
(6, 'root', 'Nested comment to comment', 3, 4, '2016-09-08 20:24:34'),
(8, 'Willy', 'Hey-ho', 1, 0, '2016-09-08 20:25:39'),
(11, 'FIX', 'PRIVET ROMAN', 1, 0, '2016-09-09 17:32:05'),
(12, 'NE ROMAN', 'PRIVET UGIN', 2, 11, '2016-09-09 17:32:13'),
(13, 'Me', 'Little test here', 1, 0, '2016-09-09 17:45:33'),
(14, 'Me', 'And second one', 2, 13, '2016-09-09 17:45:47'),
(15, 'Me', 'It''s OK.', 3, 14, '2016-09-09 17:46:26'),
(17, 'ajestkov@gmail.com', 'Ð¢ÐµÑÑ‚ Ñ€ÑƒÑÑÐºÐ¾Ð³Ð¾ ÑÐ·Ñ‹ÐºÐ°', 1, 0, '2016-09-13 16:54:59'),
(18, 'Ð”Ð¸Ð¼Ð°', 'Ñ…ÐµÑ€Ð½Ñ', 1, 0, '2016-10-12 19:34:11'),
(19, 'Ð´Ð¸Ð¼Ð°', '???', 2, 2, '2016-10-12 19:34:41'),
(20, 'ÐÐ½Ð´Ñ€ÐµÐ¹', 'Ð° Ð²Ð¾Ñ‚ Ð¸ Ð½ÐµÑ‚!', 2, 18, '2016-10-12 19:35:22'),
(21, '@andrew', 'Hello again', 1, 0, '2016-11-18 12:48:06'),
(22, '@andrew', 'and again', 2, 21, '2016-11-18 12:56:00'),
(23, '123asd', 'test comment', 1, 0, '2016-11-20 16:44:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
