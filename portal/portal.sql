-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2020 at 07:31 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
CREATE TABLE IF NOT EXISTS `employers` (
  `emp_id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `companytype` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(150) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`emp_id`, `firstname`, `lastname`, `age`, `gender`, `email`, `companyname`, `companytype`, `address`, `password`, `blocked`) VALUES
(19, 'Rohan', 'Hussain', 21, 0, 'rohanhussain1@yahoo.com', 'LUMS', 'Technology', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0),
(20, 'Alishba', 'Azam', 21, 1, 'alishbazam24@gmail.com', 'FMH', 'Healthcare', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

DROP TABLE IF EXISTS `jobseekers`;
CREATE TABLE IF NOT EXISTS `jobseekers` (
  `js_id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(150) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`js_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`js_id`, `firstname`, `lastname`, `age`, `gender`, `email`, `profession`, `address`, `password`, `blocked`) VALUES
(21, 'Rohan', 'Hussain', 21, 0, 'rohanhussain1@yahoo.com', 'Graphics Designer', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0),
(22, 'Aliyan', 'Hussain', 19, 0, 'aliyan@email.com', 'Graphics Designer', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
