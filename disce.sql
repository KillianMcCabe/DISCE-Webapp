-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2014 at 05:18 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `canvas_id`, `type`, `name`) VALUES
(8, 0, 'physical', 'physical2');

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
  `persona_name` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `family_size` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_persona`
--

INSERT INTO `customer_persona` (`id`, `customer_segments_id`, `name`, `persona_name`, `image_name`, `location`, `age`, `gender`, `family_size`, `income`, `occupation`, `education`) VALUES
(1, 1, 'graduate entrepreneur', 'Start-up Sam', 'default', 'dublin', 30, 'male', 2, 30000, 'IT entrepreneur', 'post-grad');

-- --------------------------------------------------------

--
-- Table structure for table `customer_relationships`
--

CREATE TABLE IF NOT EXISTS `customer_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `customer_relationships`
--

INSERT INTO `customer_relationships` (`id`, `canvas_id`, `type`, `name`) VALUES
(2, 0, 'keep', 'keep'),
(3, 0, 'earned', 'earned'),
(4, 0, 'grow', 'grow1'),
(5, 0, 'paid', 'paid1'),
(6, 0, 'earned', 'earned1'),
(18, 0, 'keep', 'keep2');

-- --------------------------------------------------------

--
-- Table structure for table `customer_segments`
--

CREATE TABLE IF NOT EXISTS `customer_segments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_segments`
--

INSERT INTO `customer_segments` (`id`, `canvas_id`, `name`) VALUES
(1, 0, 'Start-ups'),
(2, 0, 'new business');

-- --------------------------------------------------------

--
-- Table structure for table `key_activities`
--

CREATE TABLE IF NOT EXISTS `key_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `key_activities`
--

INSERT INTO `key_activities` (`id`, `canvas_id`, `type`, `name`) VALUES
(1, 0, 'Product/Service Development', 'Business Model Development'),
(8, 0, 'raising capital', 'rais');

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
-- Table structure for table `key_resources`
--

CREATE TABLE IF NOT EXISTS `key_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `key_resources`
--

INSERT INTO `key_resources` (`id`, `canvas_id`, `type`, `name`) VALUES
(1, 0, 'capital', 'Government Grants'),
(2, 0, 'assets', 'IT Infrastructure'),
(3, 0, 'human', 'Advisors'),
(4, 0, 'intellectual', 'Disce prototype');

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
