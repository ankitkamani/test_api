-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2024 at 06:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_train`
--

-- --------------------------------------------------------

--
-- Table structure for table `train_booking`
--

CREATE TABLE `train_booking` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `train_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_booking`
--

INSERT INTO `train_booking` (`id`, `user_id`, `train_id`) VALUES
(1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `train_class`
--

CREATE TABLE `train_class` (
  `id` int(11) NOT NULL,
  `train_id` int(100) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_class`
--

INSERT INTO `train_class` (`id`, `train_id`, `class`) VALUES
(2, 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `train_details`
--

CREATE TABLE `train_details` (
  `train_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_details`
--

INSERT INTO `train_details` (`train_id`, `name`, `path`, `status`) VALUES
(2, 'train 1', 'Rajkot - Ahemdabad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `train_fare`
--

CREATE TABLE `train_fare` (
  `id` int(11) NOT NULL,
  `train_id` int(100) NOT NULL,
  `class_id` int(100) NOT NULL,
  `fare` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_fare`
--

INSERT INTO `train_fare` (`id`, `train_id`, `class_id`, `fare`) VALUES
(1, 2, 2, '150');

-- --------------------------------------------------------

--
-- Table structure for table `train_refund`
--

CREATE TABLE `train_refund` (
  `id` int(11) NOT NULL,
  `train_id` int(50) NOT NULL,
  `refund` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train_refund`
--

INSERT INTO `train_refund` (`id`, `train_id`, `refund`) VALUES
(1, 2, 90);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'demo user1', 'demouser1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `train_booking`
--
ALTER TABLE `train_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `train_class`
--
ALTER TABLE `train_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `train_details`
--
ALTER TABLE `train_details`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `train_fare`
--
ALTER TABLE `train_fare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `train_refund`
--
ALTER TABLE `train_refund`
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
-- AUTO_INCREMENT for table `train_booking`
--
ALTER TABLE `train_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `train_class`
--
ALTER TABLE `train_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `train_details`
--
ALTER TABLE `train_details`
  MODIFY `train_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `train_fare`
--
ALTER TABLE `train_fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `train_refund`
--
ALTER TABLE `train_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
