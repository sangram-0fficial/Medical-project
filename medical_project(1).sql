-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2016 at 07:47 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medical_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_admin`
--

CREATE TABLE IF NOT EXISTS `new_admin` (
  `aid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `disc` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointment`
--

CREATE TABLE IF NOT EXISTS `patient_appointment` (
  `pid` int(11) NOT NULL DEFAULT '0',
  `aid` int(11) NOT NULL,
  `arrival_day` int(11) DEFAULT NULL,
  `arrival_moth` int(11) DEFAULT NULL,
  `arrival_year` int(11) DEFAULT NULL,
  `next_day` int(11) DEFAULT NULL,
  `next_month` int(11) DEFAULT NULL,
  `next_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_master`
--

CREATE TABLE IF NOT EXISTS `patient_master` (
  `pid` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE IF NOT EXISTS `patient_record` (
  `pid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `chief_problem` varchar(255) DEFAULT NULL,
  `medical_history` varchar(255) DEFAULT NULL,
  `present_problem` varchar(255) DEFAULT NULL,
  `symptoms` varchar(255) DEFAULT NULL,
  `treatment` varchar(255) DEFAULT NULL,
  `imagename` varchar(255) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_appointment`
--
ALTER TABLE `patient_appointment`
  ADD CONSTRAINT `patient_appointment_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `patient_master` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_master`
--
ALTER TABLE `patient_master`
  ADD CONSTRAINT `patient_master_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `new_admin` (`aid`),
  ADD CONSTRAINT `patient_master_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `new_admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD CONSTRAINT `patient_record_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `patient_master` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_record_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `patient_appointment` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
