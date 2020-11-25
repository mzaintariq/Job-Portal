-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2020 at 04:19 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `app_id` int(255) NOT NULL,
  `js_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `statement` varchar(20000) NOT NULL,
  `answers` varchar(20000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `emp_id` int(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `companytype` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(150) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`emp_id`, `firstname`, `lastname`, `age`, `gender`, `email`, `companyname`, `companytype`, `address`, `password`, `blocked`) VALUES
(19, 'Rohan', 'Hussain', 21, 0, 'rohanhussain1@yahoo.com', 'LUMS', 'Technology', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0),
(20, 'Alishba', 'Azam', 21, 1, 'alishbazam24@gmail.com', 'FMH', 'Healthcare', 'Street 12, House 3, Sahowarwi', '250deaf1cdd5387ba66bfc7d8f84824e41becd445afae48a0d01d32ddf2472e8', 0),
(21, 'Zain', 'Tariq', 22, 0, 'mzaintariq@gmail.com', 'LUMS', 'Education', '317-B, DHA Phase XII (EME), Multan Road', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `employment_id` int(255) NOT NULL,
  `js_id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(255) NOT NULL,
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
  `js_id` int(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Default status is 1, meaning that the job is active. Employer can deactivate this job and this field will change to 0.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `emp_id`, `title`, `description`, `type`, `mode`, `location`, `salary`, `min_age_req`, `min_edu_req`, `min_exp_req`, `questions`, `blocked`, `js_id`, `status`) VALUES
(21, 21, 'Job', 'This is a Job', 'ft', 'offline', 'Lahore', 50000, 22, 13, 2, '1. Why do you want this job?\r\n2. What experience do you have?', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `js_id` int(255) NOT NULL,
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
  `blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `login_attempts_log` (
  `attempt_id` int(255) NOT NULL,
  `js_id` int(255) DEFAULT NULL,
  `emp_id` int(255) DEFAULT NULL,
  `admin_id` int(255) DEFAULT NULL,
  `last_attempt` timestamp NULL DEFAULT NULL,
  `attempt_no` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(255) NOT NULL,
  `js_id` int(255) DEFAULT NULL,
  `emp_id` int(255) DEFAULT NULL,
  `app_id` int(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `js_id` (`js_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`employment_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `js_id` (`js_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `js_id` (`js_id`);

--
-- Indexes for table `jobseekers`
--
ALTER TABLE `jobseekers`
  ADD PRIMARY KEY (`js_id`);

--
-- Indexes for table `login_attempts_log`
--
ALTER TABLE `login_attempts_log`
  ADD PRIMARY KEY (`attempt_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `js_id` (`js_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `js_id` (`js_id`),
  ADD KEY `app_id` (`app_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `app_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `emp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `employment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `js_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login_attempts_log`
--
ALTER TABLE `login_attempts_log`
  MODIFY `attempt_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(255) NOT NULL AUTO_INCREMENT;

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
