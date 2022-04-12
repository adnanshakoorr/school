-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 02:56 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_course_students`
--

CREATE TABLE `assign_course_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_course_students`
--

INSERT INTO `assign_course_students` (`id`, `course_id`, `user_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 4, 10, 6, '2022-04-11 19:51:18', '2022-04-11 19:51:18'),
(2, 4, 9, 7, '2022-04-11 19:51:27', '2022-04-11 19:51:27'),
(3, 2, 10, 5, '2022-04-11 19:55:41', '2022-04-11 19:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `assign_course_teachers`
--

CREATE TABLE `assign_course_teachers` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_course_teachers`
--

INSERT INTO `assign_course_teachers` (`id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 7, '2022-04-11 19:50:09', '2022-04-11 19:50:09'),
(2, 4, 6, '2022-04-11 19:50:24', '2022-04-11 19:50:24'),
(3, 2, 5, '2022-04-11 19:51:00', '2022-04-11 19:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Php', '2022-04-11 19:49:48', '2022-04-11 19:49:48'),
(2, 'Java', '2022-04-11 19:49:53', '2022-04-11 19:49:53'),
(3, 'Html', '2022-04-11 19:49:59', '2022-04-11 19:49:59'),
(4, 'Css', '2022-04-11 19:50:02', '2022-04-11 19:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Teacher','Student') DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `verify_token` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `role`, `status`, `created_at`, `verify_token`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'Male', 'admin@gmail.com', '$2y$10$soVB8jXiKbShDmFie3L0ZexMDAnRIx.AHx.rHhCVv3GlOdeg2kPSq', 'Admin', 'enabled', '2022-04-07 22:08:10', NULL, NULL),
(4, 'Clare', 'Whitaker', 'Female', 'dihicibere@mailinator.com', '$2y$10$5UO32zBlYjgSZDU4KFhIBeU6gDML2cp/h3KzWnxW.uB6LXavm4qr2', 'Teacher', 'disabled', '2022-04-11 19:46:58', '16497244183096', '2022-04-11 19:46:58'),
(5, 'Teacher', '1', 'Male', 'teacher1@gmail.com', '$2y$10$8mbQX3golhJD5DLGUgNCheOlucQgbLCT1ZN9JlSlWZZWr1O4ZlYT2', 'Teacher', 'disabled', '2022-04-11 19:47:45', '16497244659842', '2022-04-11 19:47:45'),
(6, 'Teacher', '2', 'Male', 'teacher2@gmail.com', '$2y$10$R5l.7gP8ck0q6s85H46l.OAf72vBFO4vloBXjZWhNpFo88cajTebG', 'Teacher', 'disabled', '2022-04-11 19:48:08', '16497244886362', '2022-04-11 19:48:08'),
(7, 'Teacher', '3', 'Male', 'teacher3@gmail.com', '$2y$10$/8L5sXhlPpUy9V/CwtFF6.2vKnW/14AUqhLdKFmuPmZRScLGlpzx6', 'Teacher', 'disabled', '2022-04-11 19:48:24', '16497245049528', '2022-04-11 19:48:24'),
(8, 'Student', '1', 'Male', 'student1@gmail.com', '$2y$10$GDsatdNGb6vT9PHPIf8Gk.0Zdx/QG/Vul5Ml4TjP.uqzGmyRWRQ.G', 'Student', 'disabled', '2022-04-11 19:48:45', '16497245252919', '2022-04-11 19:48:45'),
(9, 'Student', '2', 'Male', 'student2@gmail.com', '$2y$10$d61XDVCxKVYVKIRc4w3TXeWPNcaxoRD3KZQyC8eD.z0lqBKRRksVG', 'Student', 'disabled', '2022-04-11 19:49:01', '16497245411038', '2022-04-11 19:49:01'),
(10, 'Student', '3', 'Male', 'student3@gmail.com', '$2y$10$.ImnTkSdVlXpqPj1qeInsuxxgdowNuaO6XEyI4Hav2PR0x3xWyuEK', 'Student', 'disabled', '2022-04-11 19:49:23', '16497245638409', '2022-04-11 19:49:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_course_students`
--
ALTER TABLE `assign_course_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_course_teachers`
--
ALTER TABLE `assign_course_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_course_students`
--
ALTER TABLE `assign_course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assign_course_teachers`
--
ALTER TABLE `assign_course_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
