-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2014 at 08:36 PM
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
  `cleared` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `servicetime` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `barbills`
--

INSERT INTO `barbills` (`id`, `guestid`, `drinks`, `paymentmode`, `amount`, `added_by`, `remain`, `overpay`, `created_at`, `updated_at`, `cleared`, `servicetime`, `date`) VALUES
(1, 1, 'Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,Selengeti,', '', 0, '18', 0, 0, '2014-04-17 08:44:29', '2014-04-17 13:47:47', '', 1, '2014-04-17'),
(2, 1, 'Selengeti,ndovu,', '', 0, '18', 0, 0, '2014-04-17 13:46:48', '2014-04-17 13:48:53', '', 4, '2014-04-17'),
(3, 3, 'Selengeti,ndovu,', 'mkopo', 0, '18', 0, 0, '2014-04-17 13:50:40', '2014-04-17 14:01:04', '', 1, '2014-04-17'),
(4, 1, 'konyagi,', '', 1450, '18', 550, 0, '2014-04-17 13:52:32', '2014-04-17 14:28:10', '', 2, '2014-04-17'),
(5, 3, 'ndovu,', '', 2000, '18', 0, 0, '2014-04-17 13:53:38', '2014-04-17 14:26:56', '', 4, '2014-04-17'),
(6, 1, 'Selengeti,', 'mkopo', 2000, '18', 0, 0, '2014-04-17 14:23:42', '2014-04-17 14:24:10', '', 3, '2014-04-17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

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
(50, 'ugali', 2, '2014-04-16', 17, '2014-04-16 05:18:11', '2014-04-16 05:18:11');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `lastname`, `firstname`, `nationality`, `address`, `passport_number`, `country`, `id_number`, `professional`, `company`, `telephone`, `fax`, `job`, `mobile`, `email`, `room_number`, `rate`, `adults`, `children`, `arrival_date`, `departure_date`, `reservation_number`, `mode`, `created_at`, `updated_at`, `discount`, `allegy`, `checked`, `reserved`, `released`, `confirm`) VALUES
(1, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '1', '', 0, 0, '2014-04-07', '2014-04-12', '', 'Cash', '2014-04-07 07:45:38', '2014-04-09 08:32:43', 0, '', 'no', 'no', 'yes', 'no'),
(2, 'Kimaro', 'Philipo', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '1', '', 0, 0, '2014-04-09', '2014-04-12', '', 'Cash', '2014-04-07 08:26:49', '2014-04-09 08:31:45', 0, '', 'no', 'no', 'no', 'no'),
(3, 'Nangala', 'Jimmy', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315840', '', '2', '', 0, 0, '2014-04-08', '2014-04-12', '', 'Cash', '2014-04-08 02:52:32', '2014-04-08 05:30:27', 0, '', 'no', 'no', 'no', 'no'),
(4, 'Nangala', 'Jimmy', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315840', '', '3', '', 0, 0, '2014-04-10', '2014-04-12', '', 'Cash', '2014-04-08 07:25:49', '2014-04-08 07:25:49', 0, '', 'no', 'no', 'no', 'no'),
(5, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315840', '', '4', '', 0, 0, '2014-04-08', '2014-05-03', '', 'Cash', '2014-04-08 07:28:22', '2014-04-17 14:45:44', 0, '', 'no', 'no', 'no', 'no'),
(6, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '5', '', 0, 0, '2014-04-10', '2014-04-14', '7', 'Cash', '2014-04-09 13:02:30', '2014-04-09 13:30:06', 0, '', 'no', 'no', 'no', 'no'),
(7, 'Kimata', 'Joram', '', '', '', 'Tanzania', '', '', '', '', '', '', '0712315841', '', '6', '', 0, 0, '2014-04-09', '2014-04-11', '', 'Other', '2014-04-09 13:27:35', '2014-04-17 14:46:53', 0, '', 'no', 'no', 'no', 'no');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `laundries`
--

INSERT INTO `laundries` (`id`, `name`, `cost`, `category`, `created_at`, `updated_at`) VALUES
(3, 'Suity', 2000, 1, '2014-03-24 10:22:30', '2014-03-24 10:28:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

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
(11, 'room controller', 'manager', 'bomba', 'Emmanuel wewe noma', 'no', '2014-04-13 13:59:31', '2014-04-17 14:48:55', 'room repair', 'yes', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `cost`, `created_at`, `updated_at`, `status`, `checkin`, `checkout`) VALUES
(1, 'GL 6000', 6000, '2014-04-07 07:43:57', '2014-04-09 08:32:43', 'occupied', '2014-04-07', '2014-04-17'),
(2, 'GL 111', 20000, '2014-04-08 02:51:30', '2014-04-08 05:30:27', 'occupied', '2014-04-08', '2014-04-12'),
(3, 'gl 200', 50000, '2014-04-08 07:11:47', '2014-04-08 07:25:49', 'occupied', '2014-04-10', '2014-04-12'),
(4, 'GL 600', 50000, '2014-04-08 07:12:10', '2014-04-17 14:45:44', 'occupied', '2014-04-08', '2014-05-03'),
(5, 'gl 900', 50000, '2014-04-09 12:59:06', '2014-04-09 13:30:06', 'occupied', '2014-04-10', '2014-04-14'),
(6, 'gl 788', 6000, '2014-04-09 12:59:24', '2014-04-09 13:29:31', 'occupied', '2014-04-09', '2014-04-11');

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
('8466cfaf240c1606ecadc5b5e01f08427091097c', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNlJmRlh2a0Q2T0JWY3FyWmI1QTNBODVaYjZLWU9NeHZsQ3NKSDNTSSI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L2dsX3YyL3B1YmxpYy9ub3RpZnkiO31zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTM5Nzc1OTYxNTtzOjE6ImMiO2k6MTM5Nzc1MDI5NDtzOjE6ImwiO3M6MToiMCI7fX0=', 1397759615);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `profile_pic`, `username`, `password`, `role`, `status`, `default`, `created_at`, `updated_at`) VALUES
(2, '', '', '', '', '', 'admin', '$2y$10$gg0Fbux.tHwRNqzL/P7TJOe3q/KyUA41Ef.HmFI.dtw6wguC3bhxK', 1, 'active', 'no', '0000-00-00 00:00:00', '2014-04-17 14:34:41'),
(13, 'Joram', 'John', 'kimata', 'M', '', 'biggo', '$2y$10$ctbdr6m6DJpXhkijqiejMeL90gCoHjNHN6QZcBmPd7ULTEeY1bZEm', 2, 'active', 'no', '2014-03-29 15:33:49', '2014-04-17 14:35:37'),
(15, 'Joram', 'Kimata', 'Kimata', 'M', '', 'roomcontroller', '$2y$10$vbx/c0lyZmSeaRXRh74o5Oo.1icjLQAKoeZ2FFeC7qGzwM4M2Qukm', 10, 'active', 'no', '2014-04-07 06:47:41', '2014-04-17 14:51:02'),
(17, 'Joram', 'John', 'Kimata', 'M', '', 'jot', '$2y$10$Ni62YZKhwtK/o1/RKkiV6OE.MwzUtt/tRhR.ZxspqmR7SfJapZ4wS', 7, 'active', 'no', '2014-04-08 11:33:26', '2014-04-17 14:51:41'),
(18, 'Jotty', 'Kimata', 'Kimata', 'M', '', 'bar', '$2y$10$U61TMqqf9B4UgzQOBIOpYuYONPXwWeBdR.PFVzgu3Q9gg9ZnYZAEa', 6, 'active', 'no', '2014-04-17 07:10:37', '2014-04-17 15:04:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
