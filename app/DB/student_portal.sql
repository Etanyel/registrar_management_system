-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 01:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_portal`
--
CREATE DATABASE IF NOT EXISTS `student_portal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `student_portal`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `user_agent`, `ip_address`, `created_at`) VALUES
(1, 1, 'Logged In', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-19 21:51:13'),
(2, 1, 'Enrolled student ID no.: (2026-080002)', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-19 22:19:22'),
(3, 1, 'Logged In', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-25 20:09:15'),
(4, 1, 'Enrolled student ID no.: (2026-080003)', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-25 20:23:27'),
(5, 1, 'Logged In', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-26 09:09:22'),
(6, 1, 'Logged In', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-26 16:36:20'),
(7, 1, 'Logged In', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '::1', '2026-08-30 20:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `removed_by` int(11) UNSIGNED DEFAULT NULL,
  `is_removed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `section` varchar(90) NOT NULL DEFAULT 'BLOCK-A',
  `student_type` enum('new','transferee','returning') NOT NULL DEFAULT 'new',
  `year_level` tinyint(1) UNSIGNED NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `semester` enum('1st','2nd') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `enrolled_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `section`, `student_type`, `year_level`, `academic_year`, `semester`, `created_at`, `enrolled_by`) VALUES
(1, '2026-080001', 1, 'BLOCK-A', 'new', 1, '2026-2027', '1st', '2026-08-19 22:14:47', 1),
(2, '2026-080002', 1, 'BLOCK-A', 'new', 1, '2026-2027', '1st', '2026-08-19 22:19:22', 1),
(3, '2026-080001', 1, 'BLOCK-A', 'returning', 1, '2026-2027', '2nd', '2026-08-25 20:20:30', 1),
(4, '2026-080003', 3, 'BLOCK-A', 'new', 1, '2026-2027', '1st', '2026-08-25 20:23:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-08-15-051310', 'App\\Database\\Migrations\\Users', 'default', 'App', 1786772110, 1),
(2, '2026-08-17-122209', 'App\\Database\\Migrations\\Students', 'default', 'App', 1786970431, 2),
(3, '2026-08-17-124351', 'App\\Database\\Migrations\\Course', 'default', 'App', 1786971444, 3),
(5, '2026-08-17-135106', 'App\\Database\\Migrations\\Enrollments', 'default', 'App', 1786975709, 4),
(6, '2026-08-19-121636', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', 1787142764, 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `middlename` varchar(150) DEFAULT '',
  `suffix` varchar(10) DEFAULT '',
  `sex` varchar(6) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `course` int(2) NOT NULL,
  `photo` text DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `firstname`, `lastname`, `middlename`, `suffix`, `sex`, `birthdate`, `email`, `contact_no`, `contact_person`, `address`, `course`, `photo`, `status`, `updated_at`, `updated_by`, `created_at`) VALUES
(1, '2026-080001', 'Jose', 'Chan', 'Mare', '', 'Male', '2000-01-13', '', '0934545455', '', 'Polanco City, Zamboanga del Norte', 1, NULL, 'active', NULL, NULL, '2026-08-19 22:14:47'),
(2, '2026-080002', 'Juan', 'Tamad', '', '', 'Male', '2000-01-13', '', '0934545455', '', 'Polanco City, Zamboanga del Norte', 1, NULL, 'active', NULL, NULL, '2026-08-19 22:19:22'),
(3, '2026-080003', 'Eghan ', 'Esmeringhoy', 'John', '', 'Male', '2005-01-01', 'esmeringhoy@g.com', '09234234222', '', 'Purok Parpagayo, Olingan, Dipolog City', 3, NULL, 'active', NULL, NULL, '2026-08-25 20:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL,
  `role` enum('registrar','instructor','student','admin') NOT NULL DEFAULT 'student',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `avatar`, `role`, `is_active`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, 'qweqwe', '$2y$10$7ZLinIaxsuqzZmywm3Vs0OlsqLBQUjlt8l65q.jq/GgUa0Db6GW1q', NULL, 'registrar', 1, 0, '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
