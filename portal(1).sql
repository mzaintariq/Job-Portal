-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2020 at 01:27 PM
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
CREATE DATABASE IF NOT EXISTS `portal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `portal`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--
-- Creation: Nov 25, 2020 at 01:18 PM
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(10000) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--
-- Creation: Nov 25, 2020 at 01:19 PM
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `app_id` int(255) NOT NULL AUTO_INCREMENT,
  `js_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `statement` varchar(20000) NOT NULL,
  `answers` varchar(20000) DEFAULT NULL,
  PRIMARY KEY (`app_id`),
  KEY `job_id` (`job_id`),
  KEY `js_id` (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--
-- Creation: Nov 19, 2020 at 10:24 AM
-- Last update: Nov 25, 2020 at 01:08 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`emp_id`, `firstname`, `lastname`, `age`, `gender`, `email`, `companyname`, `companytype`, `address`, `password`, `blocked`) VALUES
(19, 'Rohan', 'Hussain', 21, 0, 'rohanhussain1@yahoo.com', 'LUMS', 'Technology', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0),
(20, 'Alishba', 'Azam', 21, 1, 'alishbazam24@gmail.com', 'FMH', 'Healthcare', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--
-- Creation: Nov 25, 2020 at 01:13 PM
--

DROP TABLE IF EXISTS `employments`;
CREATE TABLE IF NOT EXISTS `employments` (
  `employment_id` int(255) NOT NULL AUTO_INCREMENT,
  `js_id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`employment_id`),
  KEY `emp_id` (`emp_id`),
  KEY `job_id` (`job_id`),
  KEY `js_id` (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--
-- Creation: Nov 25, 2020 at 01:06 PM
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(255) NOT NULL AUTO_INCREMENT,
  `emp_id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(20000) NOT NULL,
  `type` varchar(2) NOT NULL COMMENT 'type is part time or full time. Store "pt" for part time and "ft" for full time. Max length of this field is 2. You can''t store longer strings in it.',
  `mode` varchar(10) NOT NULL COMMENT 'Mode is "online" or "offline" or "hybrid"',
  `location` varchar(20000) NOT NULL,
  `salary` int(255) NOT NULL,
  `min_age_req` int(100) DEFAULT NULL,
  `min_edu_req` int(100) DEFAULT NULL,
  `min_exp_req` int(100) DEFAULT NULL,
  `questions` varchar(20000) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Default value is 0, meaning this job is not blocked by an admin',
  `js_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Default status is 1, meaning that the job is active. Employer can deactivate this job and this field will change to 0.',
  PRIMARY KEY (`job_id`),
  KEY `emp_id` (`emp_id`),
  KEY `js_id` (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--
-- Creation: Nov 25, 2020 at 01:23 PM
-- Last update: Nov 25, 2020 at 01:20 PM
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
  `experience_months` int(100) DEFAULT '0',
  `experience_details` varchar(20000) DEFAULT NULL,
  `education_months` int(100) DEFAULT '0',
  `education_details` varchar(20000) DEFAULT NULL,
  `employment_status` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`js_id`, `firstname`, `lastname`, `age`, `gender`, `email`, `profession`, `address`, `password`, `experience_months`, `experience_details`, `education_months`, `education_details`, `employment_status`, `blocked`) VALUES
(21, 'Rohan', 'Hussain', 21, 0, 'rohanhussain1@yahoo.com', 'Graphics Designer', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', NULL, NULL, NULL, NULL, 0, 0),
(22, 'Aliyan', 'Hussain', 19, 0, 'aliyan@email.com', 'Graphics Designer', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts_log`
--
-- Creation: Nov 25, 2020 at 01:22 PM
--

DROP TABLE IF EXISTS `login_attempts_log`;
CREATE TABLE IF NOT EXISTS `login_attempts_log` (
  `attempt_id` int(255) NOT NULL AUTO_INCREMENT,
  `js_id` int(255) DEFAULT NULL,
  `emp_id` int(255) DEFAULT NULL,
  `admin_id` int(255) DEFAULT NULL,
  `last_attempt` timestamp NULL DEFAULT NULL,
  `attempt_no` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attempt_id`),
  KEY `admin_id` (`admin_id`),
  KEY `emp_id` (`emp_id`),
  KEY `js_id` (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--
-- Creation: Nov 25, 2020 at 01:16 PM
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` int(255) NOT NULL AUTO_INCREMENT,
  `js_id` int(255) DEFAULT NULL,
  `emp_id` int(255) DEFAULT NULL,
  `app_id` int(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(20000) NOT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `emp_id` (`emp_id`),
  KEY `js_id` (`js_id`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`js_id`) REFERENCES `jobseekers` (`js_id`) ON UPDATE CASCADE;

--
-- Constraints for table `employments`
--
ALTER TABLE `employments`
  ADD CONSTRAINT `employments_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employers` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employments_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employments_ibfk_3` FOREIGN KEY (`js_id`) REFERENCES `jobseekers` (`js_id`) ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employers` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`js_id`) REFERENCES `jobseekers` (`js_id`) ON UPDATE CASCADE;

--
-- Constraints for table `login_attempts_log`
--
ALTER TABLE `login_attempts_log`
  ADD CONSTRAINT `login_attempts_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `login_attempts_log_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employers` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `login_attempts_log_ibfk_3` FOREIGN KEY (`js_id`) REFERENCES `jobseekers` (`js_id`) ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employers` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`js_id`) REFERENCES `jobseekers` (`js_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`app_id`) REFERENCES `applications` (`app_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
