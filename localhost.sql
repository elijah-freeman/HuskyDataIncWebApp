-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2020 at 06:05 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project3db`
--
CREATE DATABASE IF NOT EXISTS `project3db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project3db`;

-- --------------------------------------------------------

--
-- Table structure for table `HOSPITAL`
--

CREATE TABLE `HOSPITAL` (
  `hospital_name` varchar(256) NOT NULL,
  `total_bed` int(11) NOT NULL,
  `occupy_bed` int(11) DEFAULT '0',
  `availability_bed` int(11) DEFAULT NULL,
  `county` varchar(128) DEFAULT NULL,
  `covid_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HOSPITAL`
--

INSERT INTO `HOSPITAL` (`hospital_name`, `total_bed`, `occupy_bed`, `availability_bed`, `county`, `covid_test`) VALUES
('Multicare Good Samaritan Hospital', 286, 156, 80, 'Pierce', 1),
('Multicare Tacoma General Hospital', 567, 325, 242, 'Pierce', 1),
('Seattle Cancer Care Alliance', 20, 5, 15, 'King', 0),
('Seattle Children’s', 407, 200, 207, 'King', 0),
('Skyline Health', 25, 10, 15, 'Walla Walla', 1),
('Swedish Issaquah', 144, 44, 100, 'King', 0),
('UW Medicine/ University of Washington Medical Center', 413, 354, 59, 'King', 1),
('Virginia Mason Memorial Hospital', 226, 148, 78, 'Yakima', 1),
('Western State Hospital', 771, 685, 86, 'Pierce', 1),
('Willapa Harbor Hospital', 25, 6, 19, 'Pacific', 1);

-- --------------------------------------------------------

--
-- Table structure for table `INFECTION`
--

CREATE TABLE `INFECTION` (
  `infection_name` varchar(128) NOT NULL DEFAULT 'UNKNOWN',
  `infection_rate` float DEFAULT '0',
  `medication` varchar(128) DEFAULT NULL,
  `num_of_infections` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `INFECTION`
--

INSERT INTO `INFECTION` (`infection_name`, `infection_rate`, `medication`, `num_of_infections`) VALUES
('Chicken Pox', 0.00184, 'acyclovir', 33),
('Cholera', 0.047434, 'doxycycline', 11900),
('Covid-19', 0.011794, 'Dexamethasone', 27021),
('Ebola', 0.005684, 'Inmazeb', 264),
('HIV', 0.011123, 'Emtricitabine', 10228),
('Influenza', 0.010478, 'oseltamivir phosphate', 8787),
('Malaria', 0.025272, 'Resochin', 5275),
('Mers', 0.019141, 'Analgesic', 1163),
('SARs', 0.005233, 'Antiviral drug', 119),
('Zika', 0.009475, 'acetaminophen', 1256);

-- --------------------------------------------------------

--
-- Table structure for table `LOCATION`
--

CREATE TABLE `LOCATION` (
  `county` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `population` int(11) DEFAULT NULL,
  `num_of_hospital` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LOCATION`
--

INSERT INTO `LOCATION` (`county`, `state`, `population`, `num_of_hospital`) VALUES
('Benton', 'WA', 208725, 8),
('King', 'WA', 2291030, 15),
('Pacific', 'WA', 22740, 18),
('Pierce', 'WA', 919495, 20),
('San Juan', 'WA', 17934, 6),
('Skagit', 'WA', 132566, 11),
('Snohomish', 'WA', 838625, 17),
('Stevens', 'WA', 46446, 9),
('Walla Walla', 'WA', 60760, 8),
('Yakima', 'WA', 250873, 9);

-- --------------------------------------------------------

--
-- Table structure for table `PATIENT`
--

CREATE TABLE `PATIENT` (
  `patient_id` int(11) NOT NULL DEFAULT '0',
  `sickness_type` varchar(128) NOT NULL,
  `severity` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `age_range` int(11) NOT NULL,
  `hosp_name` varchar(128) DEFAULT NULL,
  `patient_email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PATIENT`
--

INSERT INTO `PATIENT` (`patient_id`, `sickness_type`, `severity`, `duration`, `age_range`, `hosp_name`, `patient_email`) VALUES
(1000, 'COVID-19', 1, 10, 20, 'Skyline Health', 'a1234@gmail.com'),
(1001, 'COVID-19', 3, 14, 40, 'Virginia Mason Memorial Hospital', 'k1234@yahoo.com'),
(1002, 'COVID-19', 5, 13, 50, 'Multicare Good Samaritan Hospital', 'x1234@gmail.com'),
(1003, 'COVID-19', 2, 9, 20, 'Multicare Tacoma General Hospital', 'e1234@highline.edu'),
(1004, 'SARs', 2, 5, 17, 'Skyline Health', 'u1234@uw.edu'),
(1005, 'COVID-19', 3, 7, 19, 'Multicare Tacoma General Hospital', 'i3151@tacoma.edu'),
(1006, 'Zika', 4, 12, 30, 'Skyline Health', 'if1245@gmail.com'),
(1007, 'Influenza', 4, 17, 35, 'Virginia Mason Memorial Hospital', 'k1234@uw.edu'),
(1008, 'COVID-19', 5, 3, 17, 'Skyline Health', 's1234@uw.edu'),
(1009, 'HIV', 3, 7, 23, 'Multicare Good Samaritan Hospital', 'f1234@uw.edu'),
(1010, 'Ebola', 4, 12, 30, 'Skyline Health', 'if1d45@gmail.com'),
(1011, 'Malaria', 4, 17, 35, 'Virginia Mason Memorial Hospital', 'k1dd4@uw.edu'),
(1012, 'Cholera', 5, 3, 17, 'Skyline Health', 's1af34@uw.edu'),
(1013, 'Chicken Pox', 3, 7, 23, 'Multicare Good Samaritan Hospital', 'f12as4@uw.edu');

-- --------------------------------------------------------

--
-- Table structure for table `SYMPTOM`
--

CREATE TABLE `SYMPTOM` (
  `symptom_id` int(11) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `severity` int(11) NOT NULL,
  `infection_name` varchar(128) DEFAULT 'UNKNOWN',
  `user_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SYMPTOM`
--

INSERT INTO `SYMPTOM` (`symptom_id`, `description`, `severity`, `infection_name`, `user_id`, `patient_id`) VALUES
(1, 'Fever', 2, 'COVID-19', 1, 1000),
(2, 'Cough', 3, 'Influenza', 2, 1001),
(3, 'Fatigue', 4, 'Malaria', 3, 1002),
(4, 'Muscle Ache', 3, 'COVID-19', 4, 1003),
(5, 'Fever', 5, 'HIV', 5, 1004),
(6, 'Fever', 3, 'COVID-19', 6, 1005),
(7, 'Sore Throat', 1, 'COVID-19', 7, 1006),
(8, 'Diarrhea', 1, 'Zika', 8, 1007),
(9, 'Headache', 5, 'COVID-19', 9, 1008),
(10, 'Headache', 4, 'COVID-19', 10, 1009),
(11, 'Fever', 3, 'zika', 11, 1010),
(12, 'Sore Throat', 1, 'Cholera', 12, 1011),
(13, 'Diarrhea', 1, 'Cholera', 13, 1012),
(14, 'Headache', 5, 'Cholera', 14, 1013);

-- --------------------------------------------------------

--
-- Table structure for table `USER_INFO`
--

CREATE TABLE `USER_INFO` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(30) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `county` varchar(20) DEFAULT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(11) NOT NULL,
  `Case_start_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USER_INFO`
--

INSERT INTO `USER_INFO` (`user_id`, `email`, `first_name`, `last_name`, `county`, `sex`, `age`, `Case_start_data`) VALUES
(1, 'a1234@gmail.com', 'Bob', 'weeks', 'Pierce', 'M', 20, '2020-03-20'),
(2, 'b1234@yahoo.com', 'Hob', 'Gates', 'King', 'M', 30, '2020-04-26'),
(3, 'c1234@hotmail.com', 'Steve', 'Jobs', 'Pacific', 'M', 40, '2020-05-01'),
(4, 'd1234@belleuvecollege.edu', 'Chris', 'Snomishi', 'Pierce', 'M', 17, '2020-05-04'),
(5, 'e1234@highline.edu', 'Tony', 'Stark', 'Pierce', 'M', 50, '2020-06-20'),
(6, 'f1234@greenriver.edu', 'Nat', 'Wood', 'Pierce', 'F', 30, '2020-05-11'),
(7, 'g1234@uw.edu', 'Bob', 'Mark', 'King', 'M', 35, '2020-04-15'),
(8, 'h1234@yahoo.com', 'Kevin', 'Heart', 'King', 'M', 55, '2020-03-31'),
(9, 'j1234@comcast.com', 'Tom', 'Xue', 'Pierce', 'F', 60, '2020-05-20'),
(10, 'k1234@yahoo.com', 'Jake', 'Tiger', 'Pierce', 'M', 19, '2020-04-20'),
(11, 'L1234@google.com', 'Tim', 'Tiger', 'King', 'M', 39, '2020-05-21'),
(12, 'M1234@yahoo.com', 'Monster', 'redbull', 'Yakima', 'M', 38, '2020-06-22'),
(13, 'O1234@harvard.edu', 'Rock', 'Star', 'Walla Walla', 'M', 29, '2020-07-23'),
(14, 'P1234@mit.edu', 'Baskin', 'Robins', 'Pacific', 'M', 28, '2020-08-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `HOSPITAL`
--
ALTER TABLE `HOSPITAL`
  ADD PRIMARY KEY (`hospital_name`),
  ADD KEY `county` (`county`);

--
-- Indexes for table `INFECTION`
--
ALTER TABLE `INFECTION`
  ADD PRIMARY KEY (`infection_name`);

--
-- Indexes for table `LOCATION`
--
ALTER TABLE `LOCATION`
  ADD PRIMARY KEY (`county`);

--
-- Indexes for table `PATIENT`
--
ALTER TABLE `PATIENT`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_email` (`patient_email`),
  ADD KEY `hosp_name` (`hosp_name`);

--
-- Indexes for table `SYMPTOM`
--
ALTER TABLE `SYMPTOM`
  ADD PRIMARY KEY (`symptom_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `county` (`county`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `HOSPITAL`
--
ALTER TABLE `HOSPITAL`
  ADD CONSTRAINT `HOSPITAL_ibfk_1` FOREIGN KEY (`county`) REFERENCES `LOCATION` (`county`) ON DELETE SET NULL;

--
-- Constraints for table `PATIENT`
--
ALTER TABLE `PATIENT`
  ADD CONSTRAINT `PATIENT_ibfk_1` FOREIGN KEY (`hosp_name`) REFERENCES `HOSPITAL` (`hospital_name`) ON DELETE SET NULL;

--
-- Constraints for table `SYMPTOM`
--
ALTER TABLE `SYMPTOM`
  ADD CONSTRAINT `SYMPTOM_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `PATIENT` (`patient_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `SYMPTOM_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `USER_INFO` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  ADD CONSTRAINT `USER_INFO_ibfk_1` FOREIGN KEY (`county`) REFERENCES `LOCATION` (`county`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
