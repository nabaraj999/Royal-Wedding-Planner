-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 22, 2025 at 03:59 PM
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
-- Database: `r_wedding_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `groom_name` varchar(255) NOT NULL,
  `bride_father` varchar(255) NOT NULL,
  `bride_mother` varchar(255) NOT NULL,
  `groom_father` varchar(255) NOT NULL,
  `groom_mother` varchar(255) NOT NULL,
  `bride_photo` varchar(255) NOT NULL,
  `groom_photo` varchar(255) NOT NULL,
  `marriage_date` date NOT NULL,
  `catering_package` varchar(50) NOT NULL,
  `decoration_package` varchar(50) NOT NULL,
  `card_package` varchar(50) NOT NULL,
  `venue_package` varchar(50) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bride_name`, `groom_name`, `bride_father`, `bride_mother`, `groom_father`, `groom_mother`, `bride_photo`, `groom_photo`, `marriage_date`, `catering_package`, `decoration_package`, `card_package`, `venue_package`, `total_cost`, `created_at`, `status`, `phone_number`) VALUES
(1, 'Nirbhaya Dangol', 'Dristi Bajracharya', 'Nanda Maharjan', 'Bhuwan devi dangol', 'Debendra Bajraacharua', 'pabitra Bajracharya ', '../uploads/brides/1740216092_nir.jpg', '../uploads/grooms/1740216092_dristi.jpg', '2030-04-01', '1000000', '1000000', '50000', '1000000', 3050000.00, '2025-02-22 09:21:32', '', '9876543210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
