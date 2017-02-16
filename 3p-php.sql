-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2017 at 04:10 PM
-- Server version: 5.7.17
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `3p-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs`
--

CREATE TABLE IF NOT EXISTS `tbl_blogs` (
  `blog_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=inactice,1=active,2=removed',
  `when_created` datetime NOT NULL,
  `when_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_blogs`
--

INSERT INTO `tbl_blogs` (`blog_id`, `route_id`, `title`, `content`, `status`, `when_created`, `when_updated`) VALUES
(1, 4, 'Welcome to blog', 'Test BLog', '1', '2017-02-16 03:33:00', '2017-02-16 10:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `page_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `status` enum('0','1','2') DEFAULT '1' COMMENT '0=inactice,1=active,2=removed',
  `when_created` datetime NOT NULL,
  `when_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `route_id`, `title`, `content`, `status`, `when_created`, `when_updated`) VALUES
(1, 1, 'Welcome to sh', 'Welcome to sh framework', '1', '2017-02-16 11:52:00', '2017-02-16 06:23:02'),
(2, 2, 'Welcome', 'Welcome content', '1', '2017-02-16 12:28:00', '2017-02-16 06:58:19'),
(3, 6, 'Test Admin', 'Welcome to test admin page', '1', '2017-02-16 16:03:21', '2017-02-16 10:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_routes`
--

CREATE TABLE IF NOT EXISTS `tbl_routes` (
  `route_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL COMMENT 'Service,Page,Blog',
  `route` varchar(300) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=inactice,1=active,2=removed',
  `when_created` datetime NOT NULL,
  `when_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_routes`
--

INSERT INTO `tbl_routes` (`route_id`, `type`, `route`, `status`, `when_created`, `when_updated`) VALUES
(1, 'page', 'welcome-sh', '1', '2017-02-16 11:52:00', '2017-02-16 08:44:30'),
(2, 'page', 'welcome', '1', '2017-02-16 12:27:00', '2017-02-16 06:57:51'),
(3, 'service', 'cms-json', '1', '2017-02-16 12:57:00', '2017-02-16 07:27:20'),
(4, 'blog', 'blog', '1', '2017-02-16 03:32:00', '2017-02-16 10:03:07'),
(6, 'page', 'test-admin', '1', '2017-02-16 16:03:21', '2017-02-16 10:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `service_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=inactice,1=active,2=removed',
  `when_created` datetime NOT NULL,
  `when_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `route_id`, `title`, `content`, `status`, `when_created`, `when_updated`) VALUES
(1, 3, 'CMS - JSON', 'Welcome to CMS JSON', '1', '2017-02-16 12:58:00', '2017-02-16 07:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '{0=>inactive,1=>active}',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `username` (`username`),
  KEY `phone` (`phone`),
  KEY `email` (`email`),
  KEY `address` (`address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `username`, `phone`, `email`, `dob`, `address`, `status`, `created_date`) VALUES
(1, 'Shaban', 'banu', 'Banu', '923793274786', 'Banu@gmail.com', '2016-10-19', 'chennai', 1, '2016-10-26 05:40:53'),
(2, 'bala', 'sundar', 'bala', '98724423893', 'bala@kutung.com', '2016-10-01', 'chennai', 1, '2016-10-26 05:40:53'),
(3, 'Ragav', 'Khan', 'Ragavkhan', '98347598437', 'ragavkhan@gmail.com', '2016-10-01', 'Adyar', 1, '2016-10-26 05:42:58'),
(4, 'Prabha1', 'Karan', 'prabha', '34985743877', 'prabha@gmail.com', '2016-10-15', 'Chennai', 1, '2016-10-26 05:42:58');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
