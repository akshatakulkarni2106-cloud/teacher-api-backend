-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 12:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacher_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `email`, `first_name`, `last_name`, `password`, `token`, `created_at`) VALUES
(1, 'test@gmail.com', 'John', 'Doe', '$2y$10$8AojpnpVpexNRYDzaAXJu.HjdpBRLVT84tcldEwRslEFhX0s3lf8m', '15cc035dcfadfe491e0fb5ebc96c17c71b84ba5226493aa53cf0faf0df08832a', '2026-03-26 12:41:57'),
(2, 'akshu@gmail.com', 'akshata', 'kulkarni', '$2y$10$K7Dr5xivO8468upe5XlDh.icx.cqLUUMJqOBSFxosxXr03EoCM7ei', 'ac6ef5bed05d38aa614c5699f038450490a709aba2acb88c16f48b5d178a71a1', '2026-03-28 07:44:40'),
(3, 'sdcsefs@gmail.com', 'adsce', 'dseddfe', '$2y$10$/yELbZy0zg3GVaKRWaXcLOMFeFAe5uB97Uu4qPMleeuvXr0R.a4oG', NULL, '2026-03-28 07:47:54'),
(4, 'akshata@gmail.com', 'akshu', 'kulkarni', '$2y$10$AfmHVFyceF5Lju5pCtRLmO0iQQKV55u.gNdvGI3ISPozilrxeLUnC', NULL, '2026-03-28 07:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `university_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `year_joined` year(4) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `university_name`, `gender`, `year_joined`, `subject`, `created_at`) VALUES
(1, 1, 'Mumbai University', 'Male', '2020', 'Computer Science', '2026-03-26 15:52:35'),
(2, 2, 'aksha', 'Female', '2020', 'programming in c', '2026-03-28 11:12:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
