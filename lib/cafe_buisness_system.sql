-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 01:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_buisness_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_member`
--

CREATE TABLE `account_member` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(512) DEFAULT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `roles` varchar(2) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `business_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_member`
--

INSERT INTO `account_member` (`user_id`, `first_name`, `last_name`, `email`, `password`, `roles`, `telephone`, `business_id`) VALUES
(1, 'Saran', 'Saeeung', 'saran.za097@gmail.com', '12345', 'us', '', ''),
(2, 'Ajcharee', '', 'gg@mail.com', 'gg1234', 'us', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE `business_info` (
  `business_id` int(11) NOT NULL,
  `business_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_member`
--
ALTER TABLE `account_member`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `business_info`
--
ALTER TABLE `business_info`
  ADD PRIMARY KEY (`business_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_member`
--
ALTER TABLE `account_member`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_info`
--
ALTER TABLE `business_info`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_info`
--
ALTER TABLE `business_info`
  ADD CONSTRAINT `business_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account_member` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
