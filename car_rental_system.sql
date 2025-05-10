-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 11:04 AM
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
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `status` enum('Available','Damaged','Unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `company_id`, `model`, `brand`, `year`, `status`) VALUES
(30, 1, 'Honda Civic', 'Honda', 2016, 'Available'),
(31, 1, 'Tesla', 'Tesla', 2020, 'Unavailable'),
(32, 1, 'Honda Civic', 'Honda', 2020, 'Available'),
(33, 1, 'Honda Civic', 'Honda', 2020, 'Available'),
(34, 2, 'Toyota Supra', 'Toyota', 2009, 'Unavailable'),
(35, 2, 'Maruti Suzuki', 'Suzuki', 2010, 'Unavailable'),
(36, 1, 'Maruti Suzuki', 'Suzuki', 2010, 'Available'),
(37, 58, 'mustang', 'ford', 2025, 'Available'),
(38, 61, 'BYD', 'CHEVROLET', 2024, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `year_established` year(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `user_id`, `company_name`, `address`, `year_established`, `email`, `status`) VALUES
(26, 78, 'shiducars', 'japan', '2004', 'shidu@gmail.com', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `company_cars`
--

CREATE TABLE `company_cars` (
  `company_id` int(50) NOT NULL,
  `car_id` int(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_cars`
--

INSERT INTO `company_cars` (`company_id`, `car_id`, `status`) VALUES
(0, 33, 'Avalaible');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `renter_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_submitted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `status` enum('Paid','Unpaid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renters`
--

CREATE TABLE `renters` (
  `id` int(11) NOT NULL,
  `car_model` varchar(255) DEFAULT NULL,
  `plate_no` varchar(50) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `dropoff_date` date DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `rental_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renters`
--

INSERT INTO `renters` (`id`, `car_model`, `plate_no`, `pickup_date`, `dropoff_date`, `pickup_location`, `dropoff_location`, `rental_price`, `total_price`, `status`) VALUES
(2, 'Honda Civic', 'KBB 345', '2025-03-02', '2025-03-31', 'Balingasag', 'Cagayan de Oro City', 4.00, 8.00, 'ongoing'),
(3, 'Honda Civic', 'KBB 345', '2025-03-02', '2025-03-31', 'Balingasag', 'Cagayan de Oro City', 2.00, 20.00, 'Ongoing'),
(4, 'Honda Civic', 'KBB 345', '2025-03-26', '2025-03-31', 'Davao', 'CDO', 400.00, 800.00, 'Ongoing'),
(5, 'Honda Civic', 'KBB 345', '2025-03-26', '2025-03-31', 'Davao', 'CDO', 400.00, 800.00, 'Ongoing'),
(6, 'Toyota Corolla', 'ABC-123', '2025-03-25', '2025-03-28', 'Downtown', 'Uptown', 4000.00, 12000.00, 'Ongoing'),
(7, 'Honda City', 'KBB 345', '2025-03-26', '2025-03-31', 'Cagayan de Oro City', 'Carmen ', 400.00, 800.00, 'Ongoing'),
(8, 'Honda Civic', 'KBB 345', '2025-03-26', '2025-03-31', 'Cagayan de Oro City ', 'Cugman ', 400.00, 800.00, 'Ongoing'),
(9, 'Honda Civic', 'KBB 345', '2025-03-26', '2025-03-31', 'Cagayan de Oro City ', 'Bugo ', 400.00, 800.00, 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `renter_details`
--

CREATE TABLE `renter_details` (
  `renter_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `license_no` varchar(50) NOT NULL,
  `status` enum('pending','approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renter_details`
--

INSERT INTO `renter_details` (`renter_id`, `user_id`, `name`, `birthdate`, `gender`, `email`, `phone`, `address`, `license_no`, `status`) VALUES
(5, 79, 'vortex', '2004-03-06', 'male', 'vortex@gmail.com', '0987654321', 'opols', '568741', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `speed_monitoring`
--

CREATE TABLE `speed_monitoring` (
  `tracking_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `speed` decimal(5,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','company','Renter') NOT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `session_id`) VALUES
(1, 'mia', 'mia@gmail.com', '$2y$10$w55L5TuO.7oWW9s/gzXTIOIQrlW509o9sOpRz3cystr2UtFKjKJJW', 'Admin', NULL),
(2, 'john', 'john@gmail.com', '$2y$10$OKPYcJqcEystWn8PnGNmXuldlCsbgsps8wLryqjZJG7WBe0/R.a4K', 'Renter', NULL),
(77, 'Admin', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', NULL),
(78, 'shiducars', 'shidu@gmail.com', '$2y$10$kw7G5JOOt.v0aYBlnJHI0..L2iwyOlo7FRsAXjJecZyU3XA9ti0VO', 'company', NULL),
(79, 'vortex', 'vortex@gmail.com', '$2y$10$.vYE./7o0oNJJP4RvagOX.BZQoomwT5Gr.dCxaUt9wgm94rIyJU6G', 'Renter', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `company_cars`
--
ALTER TABLE `company_cars`
  ADD KEY `company_id` (`company_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `renter_id` (`renter_id`),
  ADD KEY `rental_id` (`rental_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `rental_id` (`rental_id`);

--
-- Indexes for table `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renter_details`
--
ALTER TABLE `renter_details`
  ADD PRIMARY KEY (`renter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `speed_monitoring`
--
ALTER TABLE `speed_monitoring`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `rental_id` (`rental_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `renter_details`
--
ALTER TABLE `renter_details`
  MODIFY `renter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `speed_monitoring`
--
ALTER TABLE `speed_monitoring`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
