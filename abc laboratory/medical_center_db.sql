-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 05:16 PM
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
-- Database: `medical_center_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel_access`
--

CREATE TABLE `admin_panel_access` (
  `access_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_type`
--

CREATE TABLE `appoinment_type` (
  `app_id` int(11) NOT NULL,
  `appoinment_type` varchar(20) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appoinment_type`
--

INSERT INTO `appoinment_type` (`app_id`, `appoinment_type`, `price`) VALUES
(1, 'Blood', 1200),
(2, 'xray', 20000),
(3, 'mri', 30000),
(4, 'CT', 15000),
(5, 'presure', 3000),
(6, 'Sugar', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` enum('scheduled','cancelled','confirm','paid') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `app_id` int(11) NOT NULL,
  `remark` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `appointment_date`, `status`, `created_at`, `app_id`, `remark`) VALUES
(1, 5, '2030-03-19 15:34:00', 'scheduled', '2024-03-19 06:32:56', 0, ''),
(2, 5, '2060-03-19 19:18:00', 'scheduled', '2024-03-19 06:37:59', 0, ''),
(3, 5, '2089-03-19 20:12:00', 'cancelled', '2024-03-19 06:39:54', 0, ''),
(4, 5, '2099-03-19 12:13:00', 'scheduled', '2024-03-19 06:40:24', 0, ''),
(5, 5, '2027-10-19 19:31:00', 'cancelled', '2024-03-19 07:36:50', 0, ''),
(6, 17, '2024-03-20 20:53:00', 'scheduled', '2024-03-19 15:23:48', 0, ''),
(7, 17, '2024-03-13 16:25:00', 'paid', '2024-03-20 17:24:50', 1, 'test'),
(8, 17, '2024-03-27 23:03:00', 'paid', '2024-03-20 17:33:19', 5, ''),
(9, 17, '2024-03-21 00:15:00', 'paid', '2024-03-20 18:49:44', 1, ''),
(10, 17, '2024-03-23 14:00:00', 'paid', '2024-03-22 07:30:37', 1, ''),
(11, 17, '2024-03-24 13:05:00', 'paid', '2024-03-22 07:35:20', 5, ''),
(12, 17, '2024-03-22 17:43:00', 'scheduled', '2024-03-22 08:10:09', 1, ''),
(13, 17, '2024-03-29 17:43:00', 'confirm', '2024-03-22 08:10:25', 6, ''),
(14, 17, '2024-03-31 13:40:00', 'paid', '2024-03-22 08:10:37', 4, ''),
(15, 17, '2024-03-28 13:40:00', 'paid', '2024-03-22 08:10:46', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('credit_card','debit_card') NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `patient_id`, `amount`, `payment_date`, `payment_method`, `payment_status`) VALUES
(10, 17, 3000.00, '2024-03-22 07:24:54', 'debit_card', 'pending'),
(11, 17, 1200.00, '2024-03-22 07:26:39', 'debit_card', 'pending'),
(12, 17, 1200.00, '2024-03-22 07:31:17', 'debit_card', 'pending'),
(13, 17, 3000.00, '2024-03-22 07:44:25', 'debit_card', 'pending'),
(14, 17, 15000.00, '2024-03-22 08:11:45', 'debit_card', 'pending'),
(15, 17, 30000.00, '2024-03-22 09:21:37', 'debit_card', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `test_reports`
--

CREATE TABLE `test_reports` (
  `report_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `report_file_path` varchar(255) DEFAULT NULL,
  `report_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_reports`
--

INSERT INTO `test_reports` (`report_id`, `patient_id`, `report_name`, `report_file_path`, `report_date`, `created_at`) VALUES
(1, 17, 'test', 'uploads/reports/1711122623Sample-filled-in-MR.pdf', '2024-03-22 00:00:00', '2024-03-22 15:50:23'),
(2, 17, 'test2', 'uploads/reports/1711122722Sample-filled-in-MR.pdf', '2024-03-22 00:00:00', '2024-03-22 15:52:02'),
(3, 17, 'test', 'uploads/reports/1711122956Sample-filled-in-MR.pdf', '2024-03-22 00:00:00', '2024-03-22 15:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','technician','receptionist','patient') NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `full_name`, `email`, `phone_number`, `date_of_birth`, `created_at`) VALUES
(2, 'chanaka', '$2y$10$KBXYedZ8IMOst.r4yCRDbuWaFBq5oe3XvqW.9qp3H7kC2MprqmhIe', 'technician', 'wilwara', 'chanaka@gmail.com', '1234567890', '1992-11-17', '2024-03-17 12:28:40'),
(4, 'wilwara', '$2y$10$NcrayCCGs9ZRx4MtYbbfRuf.bNofNaRLau9.aeG/5/ojhh1D8/Lri', 'admin', 'isuru wilwara', 'wilwara@gmail.com', '0715278176', '2024-03-01', '2024-03-17 13:20:59'),
(5, 'amarasinghe', '$2y$10$jHrV23NtSCFP56F60q1ivuGE8K1G0ILP9pOcl/.ZV5cJwZXmnOd2S', 'patient', 'lahiru', 'lahiru@gmail.com', '0701234567890', '2000-06-17', '2024-03-17 13:24:44'),
(14, 'adminssss', '$2y$10$pVkdkikgFytIjphMKWJcBenhs5jxjxKrsU.QRSaTsXNf3Wkfv5oqq', 'receptionist', 'ssssssss', 'ssss@sds.com', 'qqqqqqqq', '2024-03-17', '2024-03-17 17:32:42'),
(17, 'abc', '$2y$10$Z6TRKJMa71.bLNnDlQmHa.jGIjhYCjsEsMxSDYSxDZeKTHpCZGWuS', 'patient', 'abcdef', 'abc@gmail.com', '1234567980', '2024-03-19', '2024-03-19 11:01:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel_access`
--
ALTER TABLE `admin_panel_access`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `appoinment_type`
--
ALTER TABLE `appoinment_type`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `idx_patient_id` (`patient_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `idx_patient_id_payments` (`patient_id`);

--
-- Indexes for table `test_reports`
--
ALTER TABLE `test_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `idx_patient_id_reports` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel_access`
--
ALTER TABLE `admin_panel_access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appoinment_type`
--
ALTER TABLE `appoinment_type`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `test_reports`
--
ALTER TABLE `test_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_panel_access`
--
ALTER TABLE `admin_panel_access`
  ADD CONSTRAINT `admin_panel_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `test_reports`
--
ALTER TABLE `test_reports`
  ADD CONSTRAINT `test_reports_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
