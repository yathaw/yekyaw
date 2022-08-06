-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2022 at 06:15 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ymi`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `enddate` date NOT NULL,
  `coursework_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `name`, `file`, `description`, `enddate`, `coursework_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'CP5154', 'upload/file/cdb48ab41c418f572a58c1dbe9791a70.pdf', '', '2022-05-07', 1, 1, '2022-04-24 16:29:09', '0000-00-00 00:00:00'),
(2, 'CP5158', 'upload/file/aeba8e105e7859cc4468e89aa272c2ea.pdf', '', '2022-05-09', 1, 1, '2022-04-25 11:06:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_grading`
--

CREATE TABLE `assignment_grading` (
  `id` int(11) NOT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `assignment_submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignment_grading`
--

INSERT INTO `assignment_grading` (`id`, `mark`, `note`, `assignment_submission_id`, `assignment_id`, `student_id`, `staff_id`, `created_at`, `updated_at`) VALUES
(1, '88', 'asdfasd', 1, 1, 1, 1, '2022-04-25 15:48:42', '0000-00-00 00:00:00'),
(2, '90', 'asdfasdfaf', 2, 1, 2, 1, '2022-04-25 15:37:02', '0000-00-00 00:00:00'),
(3, '95', 'asdfasdfadsf', 3, 1, 3, 1, '2022-04-25 15:37:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submission`
--

CREATE TABLE `assignment_submission` (
  `id` int(11) NOT NULL,
  `uploaddate` date NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `coursework_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignment_submission`
--

INSERT INTO `assignment_submission` (`id`, `uploaddate`, `file`, `student_id`, `assignment_id`, `coursework_id`, `created_at`, `updated_at`) VALUES
(1, '2022-04-25', 'upload/zip/83188d770c365dcd9915953220447149.zip', 1, 1, 1, '2022-04-25 10:53:14', '0000-00-00 00:00:00'),
(2, '2022-04-25', 'upload/zip/83188d770c365dcd9915953220447149.zip', 2, 1, 1, '2022-04-25 15:05:58', '0000-00-00 00:00:00'),
(3, '2022-04-25', 'upload/zip/83188d770c365dcd9915953220447149.zip', 3, 1, 1, '2022-04-25 15:05:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `status`, `note`, `student_id`, `batch_id`) VALUES
(1, '2022-04-25', 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `type` int(11) NOT NULL,
  `teamlink` text COLLATE utf8_unicode_ci,
  `course_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `startdate`, `enddate`, `starttime`, `endtime`, `type`, `teamlink`, `course_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Batch - 1', '2022-04-25', '2022-06-23', '09:00:00', '12:00:00', 0, 'https://teams.microsoft.com/l/team/19%3aCbEgxSgyJ5RCJVL9JQOQccDz15Bf-HcSna1K-UBu9bg1%40thread.tacv2/conversations?groupId=f3fd2d2d-fb4f-46b5-ac15-14291ae1e815&tenantId=a26a140f-b29c-4fb4-8747-67d7f1d21e08', 1, 1, '2022-04-25 13:31:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `batch_coursework`
--

CREATE TABLE `batch_coursework` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `coursework_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `batch_coursework`
--

INSERT INTO `batch_coursework` (`id`, `batch_id`, `coursework_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch_staff`
--

CREATE TABLE `batch_staff` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `batch_staff`
--

INSERT INTO `batch_staff` (`id`, `batch_id`, `staff_id`) VALUES
(1, 1, 6),
(2, 1, 8),
(3, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Development', '2022-04-04 14:40:43', '0000-00-00 00:00:00'),
(2, 'Business', '2022-04-04 14:40:43', '0000-00-00 00:00:00'),
(3, 'Marketing', '2022-04-04 14:40:43', '0000-00-00 00:00:00'),
(4, 'Language', '2022-04-04 14:40:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `codeno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `video` text COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `studylevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `totalclass` int(11) NOT NULL,
  `totalcoursework` int(11) NOT NULL,
  `totalstudent` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `codeno`, `title`, `description`, `image`, `video`, `price`, `duration`, `subcategory_id`, `studylevel`, `totalclass`, `totalcoursework`, `totalstudent`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'TDT4242', 'Advanced Software Engineering', 'This course focuses on software engineering for smart, critical, and complex software-intensive systems. The course contains four modules. 1) Requirements specification module focuses on methods to transit from user requirements to high-quality technical requirements; 2) Testing management model focuses on testing strategies; 3) Code quality module focuses on code analysis, code review, and code refactoring; 4) Complex system module focuses on verification and validation of complex software systems.\r\n\r\nStudents will apply the requirement specification, testing techniques, and code review and refactoring to homework assignments and group projects throughout the course.', 'upload/img/90669a2bccd2735b214b2117cc46aad9.jpg', 'upload/video/ea0023303f4e4b406e43b2a48a106d7e.mp4', '200', '3 Months', 17, 'Second degree level', 3, 2, 12, 1, '2022-04-23 14:42:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coursework`
--

CREATE TABLE `coursework` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coursework`
--

INSERT INTO `coursework` (`id`, `title`, `semester`, `course_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Term No:1', 'Spring 2022', 1, 1, '2022-04-25 14:18:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id` int(11) NOT NULL,
  `registerdate` date NOT NULL,
  `paymentstatus` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `registerdate`, `paymentstatus`, `student_id`, `batch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-04-24', 1, 1, 1, 1, '2022-04-24 13:43:10', '0000-00-00 00:00:00'),
(2, '2022-04-24', 1, 2, 1, 1, '2022-04-24 08:27:10', '0000-00-00 00:00:00'),
(3, '2022-04-24', 0, 3, 1, 1, '2022-04-24 08:30:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `title`, `file`, `type`, `size`, `course_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'What is Software Engineering', 'upload/file/f387ddddfabb68bdff718ecd9eaa7afd.mp4', 'video/mp4', '6626766', 1, 1, '2022-04-23 13:07:57', '0000-00-00 00:00:00'),
(2, 'Definitions of Software Engineering', 'upload/file/9f142aaf0cd11fa537bcb8440ecfc5ee.mp4', 'video/mp4', '5962834', 1, 1, '2022-04-22 13:06:15', '0000-00-00 00:00:00'),
(3, 'E-type of Software Evolution', 'upload/file/d429edd99053813d6041445c7436c5bc.mp4', 'video/mp4', '8221305', 1, 1, '2022-04-22 13:06:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transferfile` text COLLATE utf8_unicode_ci,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `date`, `type`, `amount`, `transaction`, `transferfile`, `student_id`, `course_id`, `batch_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2022-04-24', 0, '100', NULL, NULL, 1, 1, 1, 1, '2022-04-24 08:17:29', '0000-00-00 00:00:00'),
(2, '2022-04-24', 0, '200', NULL, NULL, 2, 1, 1, 1, '2022-04-24 08:26:28', '0000-00-00 00:00:00'),
(3, '2022-04-24', 1, '161.21', '199999', 'upload/file/635ccdc9e8cfd488a43381f5c5b02b24.png', 3, 1, 1, 1, '2022-04-24 08:31:00', '0000-00-00 00:00:00'),
(6, '2022-04-24', 0, '100', NULL, NULL, 1, 0, 1, 1, '2022-04-24 13:35:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Senior Leadership Team', '2022-04-04 15:34:50', '0000-00-00 00:00:00'),
(2, 'Administration Staff', '2022-04-04 15:34:50', '0000-00-00 00:00:00'),
(3, 'Teacher', '2022-04-04 15:34:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_event` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `day`, `time_event`, `color`, `staff_id`, `batch_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Identify and correct typical requirements quality issues', 'Monday', '09:00-10:30', '#0179f9', 7, 1, 1, '2022-04-24 06:59:59', '0000-00-00 00:00:00'),
(2, 'Explain industrial state of the practice methods of verifying and validating high-assurance software-intensive system', 'Monday', '10:30-12:00', '#ffbb00', 8, 1, 1, '2022-04-24 04:49:01', '0000-00-00 00:00:00'),
(3, 'Apply different testing, code review, code analysis, and code refactoring approaches', 'Tuesday', '09:00-12:00', '#ff00d0', 6, 1, 1, '2022-04-24 04:49:16', '0000-00-00 00:00:00'),
(4, 'Explain industrial state of the practice methods of verifying and validating high-assurance software-intensive system', 'Wednesday', '09:00-10:30', '#ffbb00', 8, 1, 1, '2022-04-24 04:49:13', '0000-00-00 00:00:00'),
(5, 'Identify and correct typical requirements quality issues', 'Wednesday', '10:30-12:00', '#0179f9', 7, 1, 1, '2022-04-24 04:48:59', '0000-00-00 00:00:00'),
(6, 'Apply different testing, code review, code analysis, and code refactoring approaches', 'Thursday', '09:00-12:00', '#ff00d0', 6, 1, 1, '2022-04-24 04:48:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `profile`, `dob`, `address`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Gennaro Leannon', 'upload/img/user17.png', '1977-04-06', '609 Aimee Mountain\r\nNikitamouth, WA 21904-2067', 'rebekah35@hotmail.com', '12345', '2022-04-21 11:39:22', '0000-00-00 00:00:00'),
(2, 'Prof. Verona Bogisich', 'upload/img/user10.png', '1998-08-13', '1044 Ursula Keys Apt. 246\nDareport, ME 80705-0248', 'ubotsford@gmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(3, 'Anika Kessler', 'upload/img/user5.png', '1984-06-19', '73135 Ryan Harbors Apt. 900\nNew Hardyland, KS 33710', 'abergstrom@yahoo.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(4, 'Evelyn Leuschke', 'upload/img/user19.png', '1995-01-26', '2673 Kris Skyway Apt. 375\nO\'Connerchester, MI 59571-9408', 'schowalter.adolf@shields.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(5, 'Ashton Wunsch', 'upload/img/user3.png', '1987-07-27', '467 Edmond Alley\nWeissnatburgh, MA 71387', 'oconnell.ora@yahoo.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(6, 'Walter Williamson', 'upload/img/user10.png', '2002-04-11', '5405 Gianni Hill\nDillonberg, ND 46435', 'augustus.boyer@abshire.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(7, 'Reggie Kuvalis', 'upload/img/user18.png', '1971-01-21', '49852 Zboncak Villages\nLake Meagan, TN 10450', 'kyler02@gmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(8, 'Miss Rossie Herman', 'upload/img/user17.png', '1983-07-08', '5693 Senger Ports\nNorth Dorothy, TN 61300-8045', 'verna71@gleason.info', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(9, 'Vidal Batz', 'upload/img/user8.png', '2009-07-16', '17229 Hauck River\nWest Nelsonland, HI 63938', 'fboehm@reinger.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(10, 'Ray Schmeler V', 'upload/img/user9.png', '2020-05-01', '88633 Brisa Hollow Suite 737\nSouth Carleyside, OH 56538', 'isaiah.torphy@ziemann.info', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(11, 'Juliet Boehm', 'upload/img/user8.png', '1972-07-18', '57932 Johann Shore\nPort Carolynehaven, NV 90001', 'eparisian@wilderman.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(12, 'Caitlyn Bruen Sr.', 'upload/img/user19.png', '2007-06-13', '494 Yost Gateway\nNorth Lindsey, VT 59949', 'ralph.sawayn@hotmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(13, 'Bill Dicki', 'upload/img/user15.png', '1989-07-01', '788 Murphy Cliffs\nRandybury, NE 91204', 'gleichner.mateo@schroeder.biz', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(14, 'Ms. Violet Cronin', 'upload/img/user4.png', '2000-12-18', '55818 Willms Rapids Apt. 356\nJessyland, VT 64242-2798', 'raynor.francis@wunsch.org', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(15, 'Eda O\'Kon', 'upload/img/user14.png', '2020-06-12', '8360 Waelchi Shore Apt. 086\nEast Noe, CA 43399', 'hudson05@kilback.net', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(16, 'Erich Towne', 'upload/img/user13.png', '1975-09-14', '86324 Sylvia Lakes Apt. 230\nWatersshire, DE 23685', 'hassan.mills@mcglynn.org', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(17, 'Ottis Trantow', 'upload/img/user5.png', '2013-03-04', '1140 Wilburn View Suite 211\nKeeblerville, OH 38314-2612', 'damian.padberg@beier.net', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(18, 'Ladarius Luettgen', 'upload/img/user16.png', '1970-03-22', '221 Elva Brooks\nNew Jamaalbury, MN 80485', 'gage74@lemke.org', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(19, 'Jean Gusikowski II', 'upload/img/user14.png', '1970-02-03', '7245 Xzavier Walks\nGleichnerburgh, VT 99214', 'kerluke.hettie@yahoo.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(20, 'Haven Goodwin', 'upload/img/user1.png', '1971-07-26', '89634 Renner Estate\nNew Ethel, AR 35980-4365', 'david94@will.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(21, 'Stacey Rogahn', 'upload/img/user5.png', '1994-07-23', '2170 Erdman Well Apt. 787\nSouth Manuelabury, UT 72442-1296', 'ebahringer@hotmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(22, 'Marguerite Bartoletti', 'upload/img/user9.png', '1994-10-14', '351 Brent Plaza Apt. 871\nSouth Jacinthefurt, SD 74954', 'hardy.adams@hotmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(23, 'Vergie Legros', 'upload/img/user9.png', '1978-03-14', '8077 Elisabeth Mountains Apt. 413\nVestachester, AL 00425', 'jalon.glover@hotmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(24, 'Prof. Cornell Grimes DVM', 'upload/img/user21.png', '2000-09-26', '87134 Harris Lake\nPort Doloreschester, LA 16060', 'jbode@hotmail.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(25, 'Prof. Alec Thompson V', 'upload/img/user3.png', '1981-12-27', '49282 Joesph Point\nNorth Merlview, PA 55198-0647', 'ruecker.lia@cole.com', '12345', '2022-04-21 10:52:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_position`
--

CREATE TABLE `staff_position` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_position`
--

INSERT INTO `staff_position` (`id`, `staff_id`, `position_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(2, 2, 1, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(3, 3, 2, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(4, 4, 2, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(5, 5, 1, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(6, 6, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(7, 7, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(8, 8, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(9, 9, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(10, 10, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(11, 11, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(12, 12, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(13, 13, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(14, 14, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(15, 15, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(16, 16, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(17, 17, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(18, 18, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(19, 19, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(20, 20, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(21, 21, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(22, 22, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(23, 23, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(24, 24, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00'),
(25, 25, 3, '2022-04-21 10:52:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `profile`, `dob`, `phone`, `address`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Alex', 'upload/img/867e896885edc6fe27b60857fa61e947.jpg', '2000-02-01', '0987654321', 'Yangon', 'alex@gmail.com', '222', '2022-04-25 12:41:35', '0000-00-00 00:00:00'),
(2, 'John', 'upload/img/user.png', '1991-10-01', '0987654321', 'Mandalay', 'john@gmail.com', '123', '2022-04-24 08:26:28', '0000-00-00 00:00:00'),
(3, 'Crystal', 'upload/img/user.png', '2005-01-11', '0987654321', 'Yangon', 'crystal@gmail.com', '123', '2022-04-24 08:30:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'PHP Web Development', 1, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(2, 'Mobile Development', 1, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(3, 'Programming Fundamental', 1, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(4, 'Java Basic', 1, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(5, 'Business Management', 2, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(6, 'Operations Management', 2, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(7, 'Event Management', 2, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(8, 'Warehouse Management', 2, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(9, 'Digital Marketing', 3, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(10, 'Social Media Marketing', 3, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(11, 'Marketing Fundamental', 3, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(12, 'Branding', 3, '2022-04-04 14:42:42', '0000-00-00 00:00:00'),
(13, 'English', 4, '2022-04-04 14:43:09', '0000-00-00 00:00:00'),
(14, 'Japan', 4, '2022-04-04 14:43:09', '0000-00-00 00:00:00'),
(15, 'Chinese', 4, '2022-04-04 14:43:09', '0000-00-00 00:00:00'),
(16, 'Thailand', 4, '2022-04-04 14:43:09', '0000-00-00 00:00:00'),
(17, 'Software Engineering', 1, '2022-04-21 10:32:05', '0000-00-00 00:00:00'),
(18, 'Internet Systems', 1, '2022-04-21 10:32:05', '0000-00-00 00:00:00'),
(19, 'Computer Security', 1, '2022-04-21 10:32:05', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_grading`
--
ALTER TABLE `assignment_grading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_coursework`
--
ALTER TABLE `batch_coursework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_staff`
--
ALTER TABLE `batch_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursework`
--
ALTER TABLE `coursework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_position`
--
ALTER TABLE `staff_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignment_grading`
--
ALTER TABLE `assignment_grading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch_coursework`
--
ALTER TABLE `batch_coursework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch_staff`
--
ALTER TABLE `batch_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coursework`
--
ALTER TABLE `coursework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staff_position`
--
ALTER TABLE `staff_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
