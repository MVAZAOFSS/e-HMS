-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2014 at 11:57 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `green`
--

-- --------------------------------------------------------

--
-- Table structure for table `barbills`
--

CREATE TABLE IF NOT EXISTS `barbills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guestid` int(11) NOT NULL,
  `drinks` text COLLATE utf8_unicode_ci NOT NULL,
  `paymentmode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remain` double NOT NULL,
  `overpay` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cleared` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `servicetime` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `barbills`
--

INSERT INTO `barbills` (`id`, `guestid`, `drinks`, `paymentmode`, `amount`, `added_by`, `remain`, `overpay`, `created_at`, `updated_at`, `cleared`, `servicetime`, `date`) VALUES
(1, 1, 'Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,', '', 0, '18', 0, 0, '2014-04-17 08:44:29', '2014-04-17 13:47:47', '', 1, '2014-04-17'),
(2, 1, 'Selengeti,ndovu,', '', 0, '18', 0, 0, '2014-04-17 13:46:48', '2014-04-17 13:48:53', '', 4, '2014-04-17'),
(3, 3, 'Selengeti,ndovu,', 'mkopo', 0, '18', 0, 0, '2014-04-17 13:50:40', '2014-04-17 14:01:04', '', 1, '2014-04-17'),
(4, 1, 'konyagi,', '', 1450, '18', 550, 0, '2014-04-17 13:52:32', '2014-04-17 14:28:10', '', 2, '2014-04-17'),
(5, 3, 'ndovu,', '', 2000, '18', 0, 0, '2014-04-17 13:53:38', '2014-04-17 14:26:56', '', 4, '2014-04-17'),
(6, 1, 'Selengeti,', 'mkopo', 2000, '18', 0, 0, '2014-04-17 14:23:42', '2014-04-17 14:24:10', '', 3, '2014-04-17'),
(7, 1, 'Selengeti,konyagi,', '', 0, '8', 0, 0, '2014-05-07 10:52:24', '2014-05-07 10:52:49', '', 2, '2014-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `bars`
--

CREATE TABLE IF NOT EXISTS `bars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bars`
--

INSERT INTO `bars` (`id`, `name`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'Selengeti', 2000, '2014-04-17 07:52:18', '2014-04-17 07:52:18'),
(2, 'konyagi', 2000, '2014-04-17 07:52:29', '2014-04-17 07:52:29'),
(3, 'ndovu', 2000, '2014-04-17 07:52:40', '2014-04-17 07:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `drinksales`
--

CREATE TABLE IF NOT EXISTS `drinksales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drink` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `drinksales`
--

INSERT INTO `drinksales` (`id`, `drink`, `service`, `date`, `added_by`, `updated_at`, `created_at`) VALUES
(1, 'Selengeti', 1, '2014-04-17', 18, '2014-04-17 18:19:27', '2014-04-17 18:19:27'),
(2, 'konyagi', 1, '2014-04-17', 18, '2014-04-17 18:22:24', '2014-04-17 18:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `foodbills`
--

CREATE TABLE IF NOT EXISTS `foodbills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guestid` int(11) NOT NULL,
  `foods` text COLLATE utf8_unicode_ci NOT NULL,
  `paymentmode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `added_by` int(11) NOT NULL,
  `remain` double NOT NULL,
  `overpay` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cleared` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `servicetime` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `foodbills`
--

INSERT INTO `foodbills` (`id`, `guestid`, `foods`, `paymentmode`, `amount`, `added_by`, `remain`, `overpay`, `created_at`, `updated_at`, `cleared`, `servicetime`, `date`) VALUES
(4, 1, 'ugali,ugali,maini,', '', 0, 17, 0, 0, '2014-04-19 06:09:58', '2014-04-19 06:10:17', 'no', 2, '2014-04-19'),
(5, 1, 'maini,magimbi,wali nyama,magimbi,', 'mkopo', 0, 17, 0, 0, '2014-04-19 06:11:22', '2014-04-19 06:13:08', 'no', 3, '2014-04-19'),
(6, 1, 'ugali,magimbi,wali nyama,maini,magimbi,', 'mkopo', 64000, 17, 401000, 0, '2014-04-19 06:44:05', '2014-04-20 08:29:24', 'no', 1, '2014-04-19'),
(7, 1, 'ugali,', 'mkopo', 20000, 17, 0, 0, '2014-04-20 08:25:48', '2014-04-20 08:26:30', 'no', 1, '2014-04-20'),
(8, 1, 'ugali,', 'mkopo', 0, 17, 0, 0, '2014-04-22 09:42:18', '2014-04-22 09:42:45', 'no', 1, '2014-04-22'),
(9, 1, 'chipsi kuku,', 'cash', 7000, 10, 59993000, 0, '2014-05-07 07:18:17', '2014-05-07 07:19:37', 'no', 1, '2014-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `foodsales`
--

CREATE TABLE IF NOT EXISTS `foodsales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `foodsales`
--

INSERT INTO `foodsales` (`id`, `food`, `service`, `date`, `added_by`, `updated_at`, `created_at`) VALUES
(1, 'ugali', 1, '2014-04-15', 17, '2014-04-15 16:48:18', '2014-04-15 16:48:18'),
(2, 'ugali', 1, '2014-04-15', 17, '2014-04-15 16:53:12', '2014-04-15 16:53:12'),
(3, 'ugali', 1, '2014-04-15', 17, '2014-04-15 16:53:50', '2014-04-15 16:53:50'),
(4, 'ugali', 1, '2014-04-15', 17, '2014-04-15 16:57:41', '2014-04-15 16:57:41'),
(5, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:05:34', '2014-04-15 17:05:34'),
(6, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:07:05', '2014-04-15 17:07:05'),
(7, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:07:59', '2014-04-15 17:07:59'),
(8, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:17:12', '2014-04-15 17:17:12'),
(9, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:25:18', '2014-04-15 17:25:18'),
(10, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:26:28', '2014-04-15 17:26:28'),
(11, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:27:48', '2014-04-15 17:27:48'),
(12, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:29:27', '2014-04-15 17:29:27'),
(13, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:29:56', '2014-04-15 17:29:56'),
(14, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:31:38', '2014-04-15 17:31:38'),
(15, 'wali nyama', 1, '2014-04-15', 17, '2014-04-15 17:32:58', '2014-04-15 17:32:58'),
(16, 'chipsi kuku', 1, '2014-04-15', 17, '2014-04-15 17:34:18', '2014-04-15 17:34:18'),
(17, 'ugali', 1, '2014-04-15', 17, '2014-04-15 17:37:25', '2014-04-15 17:37:25'),
(18, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:17:16', '2014-04-16 04:17:16'),
(19, 'wali nyama', 2, '2014-04-16', 17, '2014-04-16 04:17:31', '2014-04-16 04:17:31'),
(20, 'maini', 2, '2014-04-16', 17, '2014-04-16 04:17:47', '2014-04-16 04:17:47'),
(21, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:18:35', '2014-04-16 04:18:35'),
(22, 'wali nyama', 2, '2014-04-16', 17, '2014-04-16 04:20:27', '2014-04-16 04:20:27'),
(23, 'magimbi', 2, '2014-04-16', 17, '2014-04-16 04:21:04', '2014-04-16 04:21:04'),
(24, 'magimbi', 2, '2014-04-16', 17, '2014-04-16 04:21:44', '2014-04-16 04:21:44'),
(25, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:22:48', '2014-04-16 04:22:48'),
(26, 'chipsi kuku', 2, '2014-04-16', 17, '2014-04-16 04:23:43', '2014-04-16 04:23:43'),
(27, 'magimbi', 2, '2014-04-16', 17, '2014-04-16 04:28:49', '2014-04-16 04:28:49'),
(28, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:29:14', '2014-04-16 04:29:14'),
(29, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:31:32', '2014-04-16 04:31:32'),
(30, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:33:01', '2014-04-16 04:33:01'),
(31, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:34:50', '2014-04-16 04:34:50'),
(32, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:36:43', '2014-04-16 04:36:43'),
(33, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:37:02', '2014-04-16 04:37:02'),
(34, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:37:45', '2014-04-16 04:37:45'),
(35, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:39:05', '2014-04-16 04:39:05'),
(36, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:41:24', '2014-04-16 04:41:24'),
(37, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:42:01', '2014-04-16 04:42:01'),
(38, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:42:53', '2014-04-16 04:42:53'),
(39, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:43:41', '2014-04-16 04:43:41'),
(40, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:46:58', '2014-04-16 04:46:58'),
(41, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:48:15', '2014-04-16 04:48:15'),
(42, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:51:38', '2014-04-16 04:51:38'),
(43, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:52:16', '2014-04-16 04:52:16'),
(44, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:54:03', '2014-04-16 04:54:03'),
(45, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:58:17', '2014-04-16 04:58:17'),
(46, 'ugali', 2, '2014-04-16', 17, '2014-04-16 04:59:23', '2014-04-16 04:59:23'),
(47, 'ugali', 2, '2014-04-16', 17, '2014-04-16 05:00:25', '2014-04-16 05:00:25'),
(48, 'magimbi', 2, '2014-04-16', 17, '2014-04-16 05:00:42', '2014-04-16 05:00:42'),
(49, 'ugali', 2, '2014-04-16', 17, '2014-04-16 05:17:05', '2014-04-16 05:17:05'),
(50, 'ugali', 2, '2014-04-16', 17, '2014-04-16 05:18:11', '2014-04-16 05:18:11'),
(51, 'chipsi kuku', 1, '2014-04-19', 17, '2014-04-19 09:55:32', '2014-04-19 09:55:32'),
(52, 'ugali', 2, '2014-04-19', 17, '2014-04-19 09:55:53', '2014-04-19 09:55:53'),
(53, 'chipsi kuku', 2, '2014-04-19', 17, '2014-04-19 09:57:14', '2014-04-19 09:57:14'),
(54, 'ugali', 2, '2014-04-19', 17, '2014-04-19 09:57:22', '2014-04-19 09:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE IF NOT EXISTS `guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passport_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `professional` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `reservation_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount` double NOT NULL,
  `allegy` text COLLATE utf8_unicode_ci NOT NULL,
  `checked` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `reserved` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `released` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `confirm` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `llist` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `lastname`, `firstname`, `nationality`, `address`, `passport_number`, `country`, `id_number`, `professional`, `company`, `telephone`, `fax`, `job`, `mobile`, `email`, `room_number`, `rate`, `adults`, `children`, `arrival_date`, `departure_date`, `reservation_number`, `mode`, `created_at`, `updated_at`, `discount`, `allegy`, `checked`, `reserved`, `released`, `confirm`, `llist`) VALUES
(1, 'Kimaro', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '1', '', 0, 0, '2014-05-03', '2014-05-04', '', 'Cash', '2014-05-03 08:07:52', '2014-05-07 14:05:04', 0, '', 'no', 'no', 'no', 'no', 'no'),
(2, 'Nzoa', 'Jotty', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '2', '', 0, 0, '2014-05-06', '2014-05-15', '1', 'Cash', '2014-05-04 08:39:01', '2014-05-05 08:00:26', 0, '', 'no', 'no', 'no', 'yes', 'no'),
(3, 'Kimaro', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '3', '', 0, 0, '2014-05-05', '2014-05-10', '', 'Cash', '2014-05-05 07:56:30', '2014-05-05 07:56:30', 0, '', 'no', 'no', 'no', 'no', 'no'),
(4, 'John', 'Jotty', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '2', '', 0, 0, '2014-05-05', '2014-05-05', '', 'Cash', '2014-05-05 07:57:19', '2014-05-05 11:35:14', 0, '', 'no', 'no', 'yes', 'no', 'no'),
(5, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315840', '', '2', '', 0, 0, '2014-05-07', '2014-05-13', '', 'Cash', '2014-05-07 06:39:15', '2014-05-09 06:46:34', 0, '', 'no', 'no', 'no', 'no', 'no'),
(6, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '4', '', 0, 0, '2014-05-09', '2014-05-17', '8', 'Cash', '2014-05-07 11:01:26', '2014-05-09 06:47:10', 0, '', 'no', 'no', 'no', 'yes', 'no'),
(7, 'Mrisho', 'Zubeda', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '4', '', 0, 0, '2014-05-07', '2014-05-21', '', 'Cash', '2014-05-07 14:01:44', '2014-05-07 14:20:30', 0, '', 'no', 'no', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `hotellogs`
--

CREATE TABLE IF NOT EXISTS `hotellogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guestid` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `hotellogs`
--

INSERT INTO `hotellogs` (`id`, `guestid`, `date`) VALUES
(6, 1, '2014-05-03'),
(7, 2, '2014-05-06'),
(8, 2, '2014-05-07'),
(9, 2, '2014-05-08'),
(10, 2, '2014-05-09'),
(11, 2, '2014-05-10'),
(12, 2, '2014-05-11'),
(13, 2, '2014-05-12'),
(14, 2, '2014-05-13'),
(15, 2, '2014-05-14'),
(16, 2, '2014-05-15'),
(17, 3, '2014-05-05'),
(18, 3, '2014-05-06'),
(19, 3, '2014-05-07'),
(20, 3, '2014-05-08'),
(21, 3, '2014-05-09'),
(22, 3, '2014-05-10'),
(23, 4, '2014-05-05'),
(24, 5, '2014-05-07'),
(25, 6, '2014-05-09'),
(26, 6, '2014-05-10'),
(27, 6, '2014-05-11'),
(28, 6, '2014-05-12'),
(29, 6, '2014-05-13'),
(30, 6, '2014-05-14'),
(31, 6, '2014-05-15'),
(32, 6, '2014-05-16'),
(33, 6, '2014-05-17'),
(34, 7, '2014-05-07'),
(35, 7, '2014-05-08'),
(36, 7, '2014-05-09'),
(37, 7, '2014-05-10'),
(38, 7, '2014-05-11'),
(39, 7, '2014-05-12'),
(40, 7, '2014-05-13'),
(41, 7, '2014-05-14'),
(42, 7, '2014-05-15'),
(43, 7, '2014-05-16'),
(44, 7, '2014-05-17'),
(45, 7, '2014-05-18'),
(46, 7, '2014-05-19'),
(47, 7, '2014-05-20'),
(48, 7, '2014-05-21'),
(49, 5, '2014-05-08'),
(50, 5, '2014-05-09'),
(51, 5, '2014-05-10'),
(52, 5, '2014-05-11'),
(53, 5, '2014-05-12'),
(54, 5, '2014-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `laundries`
--

CREATE TABLE IF NOT EXISTS `laundries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `laundries`
--

INSERT INTO `laundries` (`id`, `name`, `cost`, `category`, `created_at`, `updated_at`) VALUES
(3, 'Suity', 2000, 1, '2014-03-24 10:22:30', '2014-03-24 10:28:58'),
(4, 'Suity', 4000, 2, '2014-04-19 05:35:50', '2014-04-19 05:35:50'),
(5, 'Suity', 6000, 3, '2014-04-19 05:36:09', '2014-04-19 05:36:09'),
(6, 'Trousers', 3000, 1, '2014-04-19 06:23:26', '2014-04-19 06:23:26'),
(7, 'Trousers', 4000, 2, '2014-04-19 06:23:38', '2014-04-19 06:23:38'),
(8, 'Trousers', 2000, 3, '2014-04-19 06:23:54', '2014-04-19 06:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `laundrylist`
--

CREATE TABLE IF NOT EXISTS `laundrylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `timespent` varchar(255) NOT NULL,
  `totalprice` double NOT NULL,
  `choose` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `laundrylist`
--

INSERT INTO `laundrylist` (`id`, `gid`, `timespent`, `totalprice`, `choose`, `updated_at`, `created_at`, `date`) VALUES
(1, 4, '2', 40000, 'starch', '2014-04-24 05:23:46', '2014-04-24 05:23:46', ''),
(2, 3, '2', 40000, 'nostarch', '2014-04-24 05:23:46', '2014-04-24 05:23:46', ''),
(3, 1, '2', 40000, 'starch', '2014-04-24 05:27:14', '2014-04-24 05:27:14', ''),
(4, 5, '2', 40000, 'starch', '2014-04-24 05:28:15', '2014-04-24 05:28:15', ''),
(5, 8, '2', 333, 'nostarch', '2014-04-24 05:55:53', '2014-04-24 05:55:53', '2014-04-24'),
(6, 7, '3', 50000, 'starch', '2014-04-24 06:00:52', '2014-04-24 06:00:52', '2014-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `laundrylists`
--

CREATE TABLE IF NOT EXISTS `laundrylists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `counttype` varchar(5) NOT NULL,
  `category` int(11) NOT NULL,
  `cvalue` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `laundrylists`
--

INSERT INTO `laundrylists` (`id`, `gid`, `item`, `counttype`, `category`, `cvalue`, `created_at`, `updated_at`) VALUES
(1, 1, 'Suity', 'g', 1, 2, '2014-04-20 13:57:06', '2014-05-01 14:54:37'),
(2, 1, 'Suity', 'h', 1, 4, '2014-04-20 14:03:17', '2014-05-01 14:54:44'),
(3, 1, 'Suity', 'g', 2, 1, '2014-04-20 14:03:25', '2014-04-24 05:27:03'),
(4, 1, 'Suity', 'h', 2, 1, '2014-04-20 14:03:56', '2014-04-24 05:27:04'),
(5, 1, 'Suity', 'g', 3, 1, '2014-04-20 14:03:58', '2014-04-24 05:27:09'),
(6, 1, 'Suity', 'h', 3, 1, '2014-04-20 14:04:01', '2014-04-24 05:27:10'),
(7, 1, 'Trousers', 'g', 1, 1, '2014-04-20 14:04:04', '2014-04-24 05:27:05'),
(8, 1, 'Trousers', 'h', 1, 1, '2014-04-20 14:04:05', '2014-04-24 05:27:06'),
(9, 1, 'Trousers', 'g', 2, 1, '2014-04-20 14:04:08', '2014-04-24 05:27:07'),
(10, 1, 'Trousers', 'h', 2, 1, '2014-04-20 14:04:09', '2014-04-24 05:27:08'),
(11, 1, 'Trousers', 'g', 3, 1, '2014-04-20 14:04:11', '2014-04-24 05:27:11'),
(12, 1, 'Trousers', 'h', 3, 1, '2014-04-20 14:04:14', '2014-04-24 05:27:12'),
(13, 3, 'Suity', 'h', 2, 4, '2014-04-24 05:13:12', '2014-04-24 05:17:04'),
(14, 3, 'Suity', 'g', 1, 1, '2014-04-24 05:13:17', '2014-04-24 05:59:23'),
(15, 3, 'Suity', 'h', 1, 3, '2014-04-24 05:13:22', '2014-04-24 05:45:51'),
(16, 3, 'Trousers', 'g', 1, 5, '2014-04-24 05:13:34', '2014-04-24 05:17:08'),
(17, 3, 'Suity', 'g', 2, 1, '2014-04-24 05:17:01', '2014-04-24 05:17:01'),
(18, 3, 'Suity', 'g', 3, 2, '2014-04-24 05:17:05', '2014-04-24 05:17:05'),
(19, 3, 'Suity', 'h', 3, 2, '2014-04-24 05:17:07', '2014-04-24 05:17:07'),
(20, 3, 'Trousers', 'h', 1, 7, '2014-04-24 05:17:09', '2014-04-24 05:17:09'),
(21, 3, 'Trousers', 'g', 2, 3, '2014-04-24 05:17:11', '2014-04-24 05:17:11'),
(22, 3, 'Trousers', 'h', 2, 4, '2014-04-24 05:17:12', '2014-04-24 05:17:12'),
(23, 3, 'Trousers', 'g', 3, 2, '2014-04-24 05:17:14', '2014-04-24 05:17:14'),
(24, 3, 'Trousers', 'h', 3, 2, '2014-04-24 05:17:36', '2014-04-24 05:17:36'),
(25, 4, 'Suity', 'g', 1, 1, '2014-04-24 05:22:29', '2014-04-24 05:22:29'),
(26, 4, 'Suity', 'h', 1, 1, '2014-04-24 05:22:31', '2014-04-24 05:22:31'),
(27, 4, 'Suity', 'g', 2, 1, '2014-04-24 05:22:33', '2014-04-24 05:22:33'),
(28, 4, 'Suity', 'h', 2, 1, '2014-04-24 05:22:33', '2014-04-24 05:22:33'),
(29, 4, 'Trousers', 'g', 1, 1, '2014-04-24 05:22:35', '2014-04-24 05:22:35'),
(30, 4, 'Trousers', 'h', 1, 1, '2014-04-24 05:22:37', '2014-04-24 05:22:37'),
(31, 4, 'Trousers', 'g', 2, 1, '2014-04-24 05:22:38', '2014-04-24 05:22:38'),
(32, 4, 'Trousers', 'h', 2, 1, '2014-04-24 05:22:39', '2014-04-24 05:22:39'),
(33, 4, 'Suity', 'g', 3, 1, '2014-04-24 05:22:40', '2014-04-24 05:22:40'),
(34, 4, 'Trousers', 'g', 3, 1, '2014-04-24 05:22:42', '2014-04-24 05:22:42'),
(35, 4, 'Suity', 'h', 3, 1, '2014-04-24 05:22:43', '2014-04-24 05:22:43'),
(36, 4, 'Trousers', 'h', 3, 1, '2014-04-24 05:22:44', '2014-04-24 05:22:44'),
(37, 5, 'Suity', 'g', 1, 1, '2014-04-24 05:28:04', '2014-04-24 05:28:04'),
(38, 5, 'Suity', 'h', 1, 1, '2014-04-24 05:28:05', '2014-04-24 05:28:05'),
(39, 5, 'Trousers', 'g', 1, 1, '2014-04-24 05:28:06', '2014-04-24 05:28:06'),
(40, 5, 'Trousers', 'h', 1, 1, '2014-04-24 05:28:07', '2014-04-24 05:28:07'),
(41, 5, 'Suity', 'g', 2, 1, '2014-04-24 05:28:07', '2014-04-24 05:28:07'),
(42, 5, 'Suity', 'h', 2, 1, '2014-04-24 05:28:08', '2014-04-24 05:28:08'),
(43, 5, 'Trousers', 'g', 2, 1, '2014-04-24 05:28:09', '2014-04-24 05:28:09'),
(44, 5, 'Trousers', 'h', 2, 1, '2014-04-24 05:28:10', '2014-04-24 05:28:10'),
(45, 5, 'Suity', 'g', 3, 1, '2014-04-24 05:28:10', '2014-04-24 05:28:10'),
(46, 5, 'Suity', 'h', 3, 1, '2014-04-24 05:28:11', '2014-04-24 05:28:11'),
(47, 5, 'Trousers', 'g', 3, 1, '2014-04-24 05:28:13', '2014-04-24 05:28:13'),
(48, 5, 'Trousers', 'h', 3, 1, '2014-04-24 05:28:14', '2014-04-24 05:28:14'),
(49, 6, 'Suity', 'g', 1, 1, '2014-04-24 05:31:05', '2014-04-24 05:32:14'),
(50, 8, 'Suity', 'g', 1, 1, '2014-04-24 05:55:53', '2014-04-24 05:55:53'),
(51, 7, 'Suity', 'g', 1, 1, '2014-04-24 06:00:51', '2014-04-24 06:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_03_22_163137_create_users_table', 1),
('2014_03_22_163213_create_rooms_table', 1),
('2014_03_22_163244_create_restaurants_table', 1),
('2014_03_22_163318_create_laundries_table', 2),
('2014_03_22_163349_create_bars_table', 2),
('2014_03_22_163429_create_session_table', 2),
('2014_03_25_145446_create_guests_table', 3),
('2014_03_26_094829_add_discount_field_to_guests_table', 3),
('2014_03_26_124940_add_status_to_rooms_table', 4),
('2014_03_26_175820_add_checkin_to_rooms_table', 5),
('2014_03_26_180130_add_checkout_to_rooms_table', 5),
('2014_04_08_060606_create_notifications_table', 6),
('2014_04_09_172331_create_foodbills_table', 7),
('2014_04_09_172415_create_barbills_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nfrom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `read` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ntype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `removed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `nid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `nfrom`, `to`, `title`, `body`, `read`, `created_at`, `updated_at`, `ntype`, `removed`, `nid`) VALUES
(1, 'room controller', 'secretary', 'Add days request ( 2 days)', 'Room number: GL 600 arrival date: 2014-04-08departure date: 2014-04-09 request to add 2 days ', 'yes', '2014-04-09 13:10:26', '2014-04-09 13:28:37', 'add days', 'yes', 5),
(2, 'room controller', 'secretary', 'bomba', 'jhjghghjvhjvhjvj hvhjhjjh hjjgjbhhjgjhgjhhjgjhgghgjhghjgj ghjghjgjhghjghghjghjh hgjhghghjghjghghjghjghgjhghghj hgjhgjhghjgghj ghjhghjghjghghjg hjghjghjghjg hghjghjghghjghj ghjghjghjghj', 'yes', '2014-04-09 13:24:00', '2014-04-17 14:48:18', 'room repair', 'yes', 1),
(3, 'room controller', 'manager', 'bomba', 'jhjghghjvhjvhjvj hvhjhjjh hjjgjbhhjgjhgjhhjgjhgghgjhghjgj ghjghjgjhghjghghjghjh hgjhghghjghjghghjghjghgjhghghj hgjhgjhghjgghj ghjhghjghjghghjg hjghjghjghjg hghjghjghghjghj ghjghjghjghj', 'no', '2014-04-09 13:24:00', '2014-04-17 14:48:29', 'room repair', 'yes', 1),
(4, 'room controller', 'secretary', 'Add days request ( 2 days)', 'Room number: gl 788 arrival date: 2014-04-09departure date: 2014-04-09 request to add 2 days ', 'yes', '2014-04-09 13:28:20', '2014-04-09 13:29:31', 'add days', 'no', 7),
(5, 'room controller', 'secretary', 'bomba', 'vghfghcghcg', 'yes', '2014-04-10 07:42:17', '2014-04-17 14:48:37', 'room repair', 'yes', 3),
(6, 'room controller', 'manager', 'bomba', 'vghfghcghcg', 'no', '2014-04-10 07:42:17', '2014-04-17 14:48:44', 'room repair', 'yes', 3),
(7, 'room controller', 'secretary', 'booo', 'jhdjgfjds', 'yes', '2014-04-10 07:45:28', '2014-04-17 14:50:35', 'room repair', 'yes', 5),
(8, 'room controller', 'manager', 'booo', 'jhdjgfjds', 'yes', '2014-04-10 07:45:28', '2014-04-17 14:49:00', 'room repair', 'yes', 5),
(9, 'room controller', 'secretary', '3 days', 'Room number: GL 600 arrival date: (2014-04-08) departure date: (2014-04-13) request to add 3 days ', 'yes', '2014-04-13 13:57:16', '2014-04-17 14:45:44', 'add days', 'no', 5),
(10, 'room controller', 'secretary', 'bomba', 'Emmanuel wewe noma', 'yes', '2014-04-13 13:59:31', '2014-04-17 14:48:50', 'room repair', 'yes', 1),
(11, 'room controller', 'manager', 'bomba', 'Emmanuel wewe noma', 'no', '2014-04-13 13:59:31', '2014-04-17 14:48:55', 'room repair', 'yes', 1),
(12, 'room controller', 'secretary', 'bomba', 'ngvvnmn,', 'yes', '2014-05-05 11:36:29', '2014-05-05 11:38:23', 'room repair', 'no', 2),
(13, 'room controller', 'manager', 'bomba', 'ngvvnmn,', 'no', '2014-05-05 11:36:29', '2014-05-05 11:36:29', 'room repair', 'no', 2),
(14, 'room controller', 'secretary', 'bomba', 'ngvvnmn,', 'yes', '2014-05-05 11:37:12', '2014-05-05 11:38:31', 'room repair', 'no', 2),
(15, 'room controller', 'manager', 'bomba', 'ngvvnmn,', 'no', '2014-05-05 11:37:12', '2014-05-05 11:37:12', 'room repair', 'no', 2),
(16, 'room controller', 'secretary', 'bomba', 'hjghdfgdhghvghfgdtgf', 'yes', '2014-05-05 11:37:46', '2014-05-05 11:38:37', 'room repair', 'no', 2),
(17, 'room controller', 'manager', 'bomba', 'hjghdfgdhghvghfgdtgf', 'no', '2014-05-05 11:37:46', '2014-05-05 11:37:46', 'room repair', 'no', 2),
(18, 'room controller', 'secretary', '4 days', 'Room number: gl 200 arrival date: (2014-05-07) departure date: (2014-05-07) request to add 4 days ', 'yes', '2014-05-07 11:08:39', '2014-05-09 06:46:34', 'add days', 'no', 5);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'ugali', 20000, '2014-04-10 11:09:39', '2014-04-10 11:09:39'),
(2, 'maini', 5000, '2014-04-10 11:09:49', '2014-04-10 11:09:49'),
(3, 'magimbi', 20000, '2014-04-11 16:04:30', '2014-04-11 16:04:30'),
(4, 'chipsi kuku', 60000000, '2014-04-11 16:04:46', '2014-04-11 16:04:46'),
(5, 'wali nyama', 400000, '2014-04-11 16:05:04', '2014-04-11 16:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'available',
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `cost`, `created_at`, `updated_at`, `status`, `checkin`, `checkout`) VALUES
(1, 'GL 6000', 2000, '2014-05-03 08:04:51', '2014-05-07 14:05:04', 'occupied', '2014-05-03', '2014-05-04'),
(2, 'gl 200', 6000, '2014-05-03 08:05:11', '2014-05-09 06:46:34', 'occupied', '2014-05-07', '2014-05-13'),
(3, 'GL 6005', 3000, '2014-05-03 08:05:26', '2014-05-05 07:56:29', 'occupied', '2014-05-05', '2014-05-10'),
(4, 'gl 4009', 6000, '2014-05-07 10:59:59', '2014-05-07 14:20:30', 'occupied', '2014-05-07', '2014-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('bd428580306ba67c8143b4ddd589236c68178fd8', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiczNlTThwTHF1Mzh1OVNmckJQbEF4TElHZ0IyWllFZ2RJZHRKdnNXeSI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjQ0OiJodHRwOi8vbG9jYWxob3N0L2dsX3YyL3B1YmxpYy9yZXBvcnRzL25vdGlmeSI7fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtpOjQ7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjEzOTk2Mjk0NDU7czoxOiJjIjtpOjEzOTk2MTI1NTM7czoxOiJsIjtzOjE6IjAiO319', 1399629446);

-- --------------------------------------------------------

--
-- Table structure for table `storegoodsdaily`
--

CREATE TABLE IF NOT EXISTS `storegoodsdaily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gId` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `added` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `saved` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `storegoodsinfo`
--

CREATE TABLE IF NOT EXISTS `storegoodsinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gId` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `added` int(11) NOT NULL,
  `date` varchar(32) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `storegoodsinfo`
--

INSERT INTO `storegoodsinfo` (`id`, `gId`, `used`, `added`, `date`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 0, '2014-04-25', '2014-04-25 13:16:58', '2014-04-25 13:16:58'),
(2, 2, 1, 0, '2014-04-25', '2014-04-25 13:16:58', '2014-04-25 13:16:58'),
(3, 3, 1, 0, '2014-04-25', '2014-04-25 13:16:58', '2014-04-25 13:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `storegoodstotal`
--

CREATE TABLE IF NOT EXISTS `storegoodstotal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods` varchar(255) NOT NULL,
  `tno` int(11) NOT NULL,
  `filled` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `storegoodstotal`
--

INSERT INTO `storegoodstotal` (`id`, `goods`, `tno`, `filled`, `date`, `updated_at`, `created_at`) VALUES
(1, 'mchele', 2, '', '2014-04-25 04:53:18', '2014-04-25 13:16:58', '2014-04-25 04:53:18'),
(2, 'mafuta', 4, '', '2014-04-25 05:26:34', '2014-04-25 13:16:58', '2014-04-25 05:26:34'),
(3, 'chumvi', 26, '', '2014-04-25 05:26:49', '2014-04-25 13:16:58', '2014-04-25 05:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `default` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `profile_pic`, `username`, `password`, `role`, `status`, `default`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '', 'admin', '$2y$10$mknDFi/RHcj4LRnSQZyV9Og6cEDmmS8ZNs37EKodChUajxjv0WZ0q', 1, 'active', 'no', '0000-00-00 00:00:00', '2014-05-09 02:15:57'),
(2, 'Joram', 'John', 'Nangala', 'M', '', 'lau', '$2y$10$bEOu.BtlEVYAgGchKthFQu1m6vRxF8/LJMJwjEJLSoiRXNr6nhIu2', 5, 'active', 'no', '2014-04-23 02:09:40', '2014-05-07 06:14:48'),
(3, 'Jimmy', 'John', 'Kimata', 'M', '', 'storekeeper', '$2y$10$QWi37izpEys.quQCPpzjMeYZu1IuTwNXHXvoEXx8JJ1VXuK2dBKre', 4, 'active', 'no', '2014-04-25 01:20:43', '2014-04-29 08:18:55'),
(4, 'Joram', 'John', 'Kimata', 'M', '', 'manager', '$2y$10$tjnzg0jPOyFTWchS9hsr5uqwEPUmAhIck4pvVN98xmDhJWlF1FbMq', 9, 'active', 'no', '2014-04-26 12:37:40', '2014-05-09 06:49:43'),
(6, 'Juma', 'Kimata', 'Nzoa', 'M', '', 'biggo', '$2y$10$.lP5oiMoUnp5THmaaBg0j.iDepp57iU1mMahXB8g6rM8C0gBMW.ci', 2, 'active', 'no', '2014-04-28 08:37:17', '2014-05-09 06:21:45'),
(7, 'Joram', 'Kimata', 'Kimata', 'M', '', 'og', '$2y$10$7zDT4FqIRS0UW0HhYz9vpeZIjQ.ASVChTwcobhq0FnZ2ezKvvyp4e', 2, 'active', 'no', '2014-04-29 08:13:28', '2014-04-29 08:14:19'),
(8, 'Joram', 'Kimata', 'Kimata', 'M', '', 'bar', '$2y$10$pzEzZyaG14g57j6jKW20SOK5RKdkb844M0pE.m33vWw2F//MJqLr.', 6, 'active', 'no', '2014-04-29 08:23:54', '2014-05-07 10:51:45'),
(9, 'Joram', 'Kimata', 'Kimata', 'M', '', 'rc', '$2y$10$lGBTpPQ0FlTqoGWKL/6fgeii0gFBvPf.S40zoNkk.SueNqm7YYMii', 10, 'active', 'no', '2014-05-05 11:32:50', '2014-05-07 11:06:08'),
(10, 'Joram', 'John', 'Kimata', 'M', '', 'menu', '$2y$10$zltSWjWthCAHfeHTrRuov.I1X0uQwclKdChNhsIKBrkd5GyJi0c9m', 7, 'active', 'no', '2014-05-07 07:12:14', '2014-05-07 07:20:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
