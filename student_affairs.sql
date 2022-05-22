-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 02:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_affairs`
--
CREATE DATABASE IF NOT EXISTS `student_affairs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `student_affairs`;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'Jasmine'),
(2, 'Obour');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Cairo'),
(2, 'Giza');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` bigint(20) UNSIGNED NOT NULL,
  `className` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `grade`, `className`) VALUES
(1, 1, '1A'),
(2, 1, '1B');

-- --------------------------------------------------------

--
-- Table structure for table `governante`
--

DROP TABLE IF EXISTS `governante`;
CREATE TABLE `governante` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `governante`
--

INSERT INTO `governante` (`id`, `name`) VALUES
(1, 'Cairo'),
(2, 'Giza');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`) VALUES
(1, 'Gr1'),
(2, 'Gr2');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

DROP TABLE IF EXISTS `nationality`;
CREATE TABLE `nationality` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id`, `name`) VALUES
(1, 'Egyptian'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

DROP TABLE IF EXISTS `parents`;
CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `typ` tinyint(1) NOT NULL,
  `english_name` varchar(100) DEFAULT NULL,
  `arabic_name` varchar(100) DEFAULT NULL,
  `nid` char(14) NOT NULL,
  `mobilephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `job` varchar(50) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `spoken_language` tinyint(4) NOT NULL,
  `nationality` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `typ`, `english_name`, `arabic_name`, `nid`, `mobilephone`, `email`, `job`, `qualification`, `spoken_language`, `nationality`) VALUES
(36, 0, 'a', 'b', 'a', 'a', 'a', 'a', 'a', 1, 1),
(38, 0, 'a', 'b', 'a', 'a', 'a', 'a', 'a', 1, 1),
(40, 0, 'a', 'b', 'a', 'a', 'a', 'a', 'a', 1, 1),
(42, 0, 'a', 'b', 'a', 'a', 'a', 'a', 'a', 1, 1),
(44, 0, 'a', 'b', 'a', 'a', 'a', 'a', 'a', 1, 1),
(47, 1, NULL, NULL, 'a', 'a', 'a', 'a', 'a', 1, 1),
(48, 0, 'a', 'qwe', 'a', 'a', 'a', 'a', 'a', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` bigint(20) UNSIGNED NOT NULL,
  `grade` bigint(20) UNSIGNED NOT NULL,
  `class` bigint(20) UNSIGNED NOT NULL,
  `student_code` int(11) NOT NULL,
  `student_nid` char(14) NOT NULL,
  `nationality` bigint(20) UNSIGNED NOT NULL,
  `student_status` bigint(20) UNSIGNED NOT NULL,
  `join_year` tinyint(4) NOT NULL,
  `staff_son` tinyint(1) NOT NULL DEFAULT 0,
  `legal_guardian` tinyint(4) NOT NULL,
  `parents_separated` tinyint(1) NOT NULL,
  `school_abreviation` varchar(10) NOT NULL,
  `updat` varchar(10) NOT NULL,
  `arabic_first_name` varchar(20) NOT NULL,
  `arabic_middle_name` varchar(20) NOT NULL,
  `arabic_last_name` varchar(20) NOT NULL,
  `arabic_family_name` varchar(20) NOT NULL,
  `english_first_name` varchar(20) NOT NULL,
  `english_middle_name` varchar(20) NOT NULL,
  `english_last_name` varchar(20) NOT NULL,
  `english_family_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `religon` tinyint(4) NOT NULL,
  `city` bigint(20) UNSIGNED NOT NULL,
  `adress` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `student_affairs1` varchar(50) NOT NULL,
  `student_affairs2` varchar(50) NOT NULL,
  `birth_code` varchar(50) NOT NULL,
  `address_Gov` bigint(20) UNSIGNED NOT NULL,
  `emergency_contact` varchar(50) NOT NULL,
  `emergency_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `school_name`, `grade`, `class`, `student_code`, `student_nid`, `nationality`, `student_status`, `join_year`, `staff_son`, `legal_guardian`, `parents_separated`, `school_abreviation`, `updat`, `arabic_first_name`, `arabic_middle_name`, `arabic_last_name`, `arabic_family_name`, `english_first_name`, `english_middle_name`, `english_last_name`, `english_family_name`, `dob`, `birth_place`, `gender`, `religon`, `city`, `adress`, `email`, `pwd`, `student_affairs1`, `student_affairs2`, `birth_code`, `address_Gov`, `emergency_contact`, `emergency_phone`) VALUES
(24, 1, 1, 1, 1, 'a', 1, 1, 6, 0, 1, 0, '1', '0', 'a', 'q', 'q', 'a', 'ko', 'a', 'a', 'a', '2022-05-09', 'a', 0, 0, 1, 'a', 'a', 'a', 'a', 'a', 'a', 1, 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `student_parent`
--

DROP TABLE IF EXISTS `student_parent`;
CREATE TABLE `student_parent` (
  `parent` bigint(20) UNSIGNED NOT NULL,
  `student` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_parent`
--

INSERT INTO `student_parent` (`parent`, `student`) VALUES
(47, 24),
(48, 24);

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

DROP TABLE IF EXISTS `student_status`;
CREATE TABLE `student_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`id`, `name`) VALUES
(1, 'active'),
(2, 'in-active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `grade_fk` (`grade`);

--
-- Indexes for table `governante`
--
ALTER TABLE `governante`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `Parent_nationality_id_fk` (`nationality`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `grade_student_fk` (`grade`),
  ADD KEY `branch_student_fk` (`school_name`),
  ADD KEY `class_student_fk` (`class`),
  ADD KEY `student_nationality_id_fk` (`nationality`),
  ADD KEY `student_status_id_fk` (`student_status`),
  ADD KEY `student_city_id_fk` (`city`),
  ADD KEY `student_gov_id_fk` (`address_Gov`);

--
-- Indexes for table `student_parent`
--
ALTER TABLE `student_parent`
  ADD PRIMARY KEY (`parent`,`student`),
  ADD KEY `student_parent_id_fk` (`student`);

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `governante`
--
ALTER TABLE `governante`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `grade_fk` FOREIGN KEY (`grade`) REFERENCES `grades` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `Parent_nationality_id_fk` FOREIGN KEY (`nationality`) REFERENCES `nationality` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `branch_student_fk` FOREIGN KEY (`school_name`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `class_student_fk` FOREIGN KEY (`class`) REFERENCES `classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_student_fk` FOREIGN KEY (`grade`) REFERENCES `grades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_city_id_fk` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_gov_id_fk` FOREIGN KEY (`address_Gov`) REFERENCES `governante` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_nationality_id_fk` FOREIGN KEY (`nationality`) REFERENCES `nationality` (`id`),
  ADD CONSTRAINT `student_status_id_fk` FOREIGN KEY (`student_status`) REFERENCES `student_status` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `student_parent`
--
ALTER TABLE `student_parent`
  ADD CONSTRAINT `parent_id_fk` FOREIGN KEY (`parent`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_parent_id_fk` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
