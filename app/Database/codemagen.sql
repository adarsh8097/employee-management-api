-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2025 at 06:20 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codemagen`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `status` tinyint NOT NULL COMMENT '1:active,0:Inactive,-1:delete',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 1, '2025-06-25 15:02:44', '0000-00-00 00:00:00'),
(2, 'Cook', -1, '2025-06-25 15:03:32', '2025-06-25 18:05:23'),
(3, 'Sells', 1, '2025-06-25 15:04:09', '0000-00-00 00:00:00'),
(4, 'Finance', 1, '2025-06-25 15:04:41', '0000-00-00 00:00:00'),
(5, 'Marketing', 1, '2025-06-25 15:04:56', '0000-00-00 00:00:00'),
(6, 'Operations', 1, '2025-06-25 16:05:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint NOT NULL COMMENT '1:active,-1:delete,0:inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `department_id`, `name`, `email`, `phone_number`, `designation`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rohan Mehta', 'rohan.mehta@example.com', '9876543210', 'Software Engineer', '14, Residency Road, Bengaluru', 1, '2025-06-26 02:33:15', '2025-06-26 03:41:03'),
(2, 2, 'Priya Singh', 'priya.singh@example.com', '9123456789', 'HR Manager', '88, Park Street, Kolkata', -1, '2025-06-26 02:36:07', '2025-06-26 03:45:06'),
(3, 4, 'Amitabh Das', 'amitabh.das@example.com', '9012345678', 'Finance Analyst', '3B, Ashok Nagar, Mumbai', 1, '2025-06-26 02:37:23', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
