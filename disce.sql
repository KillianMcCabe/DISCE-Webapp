-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 11:27 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `disce`
--

-- --------------------------------------------------------

--
-- Table structure for table `canvas`
--

CREATE TABLE IF NOT EXISTS `canvas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `public_permissions` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channels_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cost_structure`
--

CREATE TABLE IF NOT EXISTS `cost_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `salaries` int(11) NOT NULL,
  `equipment` int(11) NOT NULL,
  `marketing` int(11) NOT NULL,
  `legal` int(11) NOT NULL,
  `accounting` int(11) NOT NULL,
  `premises_and_bills` int(11) NOT NULL,
  `expenses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cost_structure`
--

INSERT INTO `cost_structure` (`id`, `canvas_id`, `salaries`, `equipment`, `marketing`, `legal`, `accounting`, `premises_and_bills`, `expenses`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_persona`
--

CREATE TABLE IF NOT EXISTS `customer_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_segments_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `persona_name` varchar(225) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `family_size` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_persona`
--

INSERT INTO `customer_persona` (`id`, `customer_segments_id`, `name`, `persona_name`, `image_name`, `location`, `age`, `gender`, `family_size`, `income`, `occupation`, `education`) VALUES
(1, 0, 'graduate entrepreneur', 'Start-up Sam', 'default', 'dublin', 30, 'male', 2, 30000, 'IT entrepreneur', 'post-grad'),
(2, 0, '', '0', 'default', '', 0, '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_relationships`
--

CREATE TABLE IF NOT EXISTS `customer_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer_relationships`
--

INSERT INTO `customer_relationships` (`id`, `canvas_id`, `type`, `name`, `cost`) VALUES
(1, 0, 'paid', 'test', 5),
(2, 0, 'keep', 'keep', 0),
(3, 0, 'earned', 'earned', 20),
(4, 0, 'grow', '', 0),
(5, 0, 'paid', '', 0),
(6, 0, 'earned', '', 0),
(7, 0, 'keep', '', 0),
(8, 0, 'grow', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_segments`
--

CREATE TABLE IF NOT EXISTS `customer_segments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer_segments`
--

INSERT INTO `customer_segments` (`id`, `canvas_id`, `name`) VALUES
(1, 0, 'start-ups'),
(2, 0, 'new business'),
(3, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `key_partners`
--

CREATE TABLE IF NOT EXISTS `key_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `partners` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `key_partners`
--

INSERT INTO `key_partners` (`id`, `canvas_id`, `partners`) VALUES
(10, 0, 'ITs'),
(11, 0, 'ITs');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_streams`
--

CREATE TABLE IF NOT EXISTS `revenue_streams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `market_type` varchar(256) NOT NULL,
  `value_driven_strategy` varchar(256) NOT NULL,
  `subscriptions` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `revenue_streams`
--

INSERT INTO `revenue_streams` (`id`, `canvas_id`, `market_type`, `value_driven_strategy`, `subscriptions`) VALUES
(1, 0, '', '', 0),
(2, 0, 'Segmented', '', 0),
(3, 0, '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;