-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2025 at 04:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripnepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `trip_bookings`
--

CREATE TABLE `trip_bookings` (
  `id` int(11) NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `trip_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `airport_pickup` enum('yes','no') DEFAULT NULL,
  `message` text DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `payment_status` enum('paid','not paid') DEFAULT 'not paid',
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_bookings`
--

INSERT INTO `trip_bookings` (`id`, `user_id`, `trip_id`, `trip_name`, `full_name`, `email`, `address`, `phone_number`, `city`, `country`, `adults`, `children`, `arrival_date`, `departure_date`, `arrival_time`, `airport_pickup`, `message`, `payment_mode`, `payment_status`, `booked_at`, `start_date`) VALUES
(3, 'user_67eac0a91ea95', 1, 'dsaf', 'suresh Tamang', 'sureshjimba3333@gmail.com', 'dfasasdf', '9741847684', 'dfasasdf', 'asdfasd', 13, 3, '2025-04-25', '2025-05-01', '02:40:00', 'no', 'adsf', 'Paypal', 'not paid', '2025-04-15 16:54:37', ''),
(4, 'user_67eac0a91ea95', 2, 'asdfasdf', 'suresh Tamang', 'sureshjimba3333@gmail.com', 'dfasasdf', '9741847684', 'dfasasdf', 'asdfasd', 9, 4, '2025-04-10', '2025-04-30', '12:01:00', 'yes', 'sddsd', 'Paypal', 'not paid', '2025-04-16 04:49:54', ''),
(5, 'user_67eac0a91ea95', 2, 'asdfasdf', 'suresh Tamang', 'sureshjimba3333@gmail.com', 'dfasasdf', '9741847684', 'dfasasdf', 'asdfasd', 8, 1, '2025-04-02', '2025-04-24', '12:31:00', 'no', 'asdfasdf', 'Bank Transfer', 'not paid', '2025-04-16 13:36:35', 'not selected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trip_bookings`
--
ALTER TABLE `trip_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trip_bookings`
--
ALTER TABLE `trip_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trip_bookings`
--
ALTER TABLE `trip_bookings`
  ADD CONSTRAINT `trip_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_bookings_ibfk_2` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`tripid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
