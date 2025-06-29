-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 01:18 AM
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
-- Database: `emergency_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'Virginia Nyirenda', 'virginianyirenda5@gmail.com', 'Hello there!', '2025-06-12 12:38:49'),
(2, 'Virginia Nyirenda', 'virginianyirenda5@gmail.com', 'Hello', '2025-06-12 12:42:55'),
(3, 'Virginia Nyirenda', 'virginianyirenda5@gmail.com', 'Hello', '2025-06-14 08:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_cases`
--

CREATE TABLE `dashboard_cases` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `responder` varchar(100) DEFAULT 'Unassigned',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard_cases`
--

INSERT INTO `dashboard_cases` (`id`, `type`, `location`, `description`, `status`, `responder`, `created_at`) VALUES
(1, 'Police', 'Matero', 'Type: Domestic Violence. Details: we are near matero young phiroz', 'Pending', 'Unassigned', '2025-06-20 15:40:22'),
(2, 'Police', 'Zingalume', 'Name: Naomi phiri | Phone: 07740555775 | Emergency: Theft | Details: hie', 'Pending', 'Unassigned', '2025-06-20 16:14:13'),
(3, 'Police', 'Zingalume', 'Name: Naomi phiri | Phone: 07740555775 | Emergency: Theft | Details: hie', 'Pending', 'Unassigned', '2025-06-20 17:00:02'),
(4, 'Police', 'Eden university, barlastone', 'Name: John Banda | Phone: 56677098787 | Emergency: Suspicious Activity | Details: Its near king George', 'Pending', 'Unassigned', '2025-06-20 17:04:16'),
(5, 'Police', 'Eden university, barlastone', 'Name: John Banda | Phone: 56677098787 | Emergency: Domestic Violence | Details: Please help', 'Pending', 'Unassigned', '2025-06-29 20:45:02'),
(6, 'Medical', 'Eden university, barlastone', 'Name: John Banda | Phone: 56677098787 | Emergency: Heart Attack | Details: please help', 'Pending', 'Unassigned', '2025-06-29 21:41:02'),
(7, 'Fire', 'zingalume', 'Name: Virginia Nyirenda | Phone: 07740555775 | Emergency: Vehicle Fire | Details: Hey,please help', 'Pending', 'Unassigned', '2025-06-29 21:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `fire_requests`
--

CREATE TABLE `fire_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `emergency_type` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fire_requests`
--

INSERT INTO `fire_requests` (`id`, `full_name`, `phone_number`, `emergency_type`, `location`, `additional_details`, `file_path`, `request_time`) VALUES
(1, 'Virginia Nyirenda', '07740555775', 'Vehicle Fire', 'zingalume', 'Hey,please help', '', '2025-06-29 21:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `medical_requests`
--

CREATE TABLE `medical_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `emergency_type` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_requests`
--

INSERT INTO `medical_requests` (`id`, `full_name`, `phone_number`, `emergency_type`, `location`, `additional_details`, `file_path`, `request_time`) VALUES
(1, 'John Banda', '56677098787', 'Heart Attack', 'Eden university, barlastone', 'please help', '', '2025-06-29 21:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `police_requests`
--

CREATE TABLE `police_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `emergency_type` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `additional_details` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_requests`
--

INSERT INTO `police_requests` (`id`, `full_name`, `phone_number`, `emergency_type`, `location`, `additional_details`, `file_path`, `submitted_at`) VALUES
(1, 'virgi', '097645678', '', 'Zingalume', 'Muchinga ground', '', '2025-06-07 03:01:25'),
(4, 'Gift banda', '0875424578', 'Theft', 'Zingalume', 'Twikatane mall', '', '2025-06-07 03:37:40'),
(5, 'virgie', '0875424578', 'Other', 'Eden university, barlastone', 'Eden campus', '', '2025-06-07 03:41:29'),
(6, 'virgie', '0875424578', 'Theft', 'Eden university, barlastone', '', '', '2025-06-08 22:02:22'),
(7, 'John Banda', '0875424578', 'Domestic Violence', 'Zingalume', 'I need help please at muchinga ground', '', '2025-06-11 13:21:16'),
(8, 'John Banda', '0774065579', 'Domestic Violence', 'Matero', '', '', '2025-06-18 12:28:32'),
(9, 'virgie', '0774065579', 'Domestic Violence', 'Matero', 'we are near matero young phiroz', '', '2025-06-20 15:40:22'),
(10, 'Naomi phiri', '07740555775', 'Theft', 'Zingalume', 'hie', '', '2025-06-20 16:14:13'),
(11, 'Naomi phiri', '07740555775', 'Theft', 'Zingalume', 'hie', '', '2025-06-20 17:00:02'),
(12, 'John Banda', '56677098787', 'Suspicious Activity', 'Eden university, barlastone', 'Its near king George', '', '2025-06-20 17:04:16'),
(13, 'John Banda', '56677098787', 'Domestic Violence', 'Eden university, barlastone', 'Please help', '', '2025-06-29 20:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL CHECK (`age` >= 0),
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Victim','Admin','Dispatcher','Responder') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `first_name`, `last_name`, `age`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'virginia n', 'Virginia', 'Nyirenda', 29, 'virginianyirenda5@gmail.com', '0774065579', '$2y$10$I9b6CrrhfM6iQCsNNnN7MeNOMbNjVhM4Qz1g1K29BAwfJx4qoYHli', 'Admin', '2025-06-04 22:42:16'),
(2, 'Russel n', 'Russel', 'Ngosi', 30, 'russelngosi3@gmail.com', '0993910891', '$2y$10$F1kRVBaJoHK4Dv4Cl8OENOlXUiumgMzEdFflBIE0kA2DfglQX02zi', 'Dispatcher', '2025-06-04 22:46:08'),
(6, 'virginia ', 'Virginia', 'Nyirenda', 20, 'virginianyirenda7@gmail.com', '0774065570', '$2y$10$xdlRUBnRv5fgDCvZCnYll.407sqwN.RJT1lKgOAORqWmPPM49bD4y', 'Victim', '2025-06-04 23:10:04'),
(8, 'Mary b', 'Mary', 'Banda', 21, 'marybanda4@gmail.com', '0888567903', '$2y$10$54v1FiTF2.RJm5iWp8.KZur19QkgzHxjAqtPKEHquYCEacGpZ7aNq', 'Victim', '2025-06-04 23:12:59'),
(9, 'Anthony n', 'Anthony', 'Nyirenda', 26, 'nyirendaanthony@gmail.com', '0774065321', '$2y$10$YnMbrdRpHg.iDaOxZvJxUu7MRT94oeJ2H5lG7BO11GnugUqLyf4ia', 'Responder', '2025-06-06 11:22:05'),
(10, 'Glyn n', 'Glyn', 'Nyirenda', 22, 'Nnyirendaglyn@gmail.com', '08885632', '$2y$10$ibtPNYO3o5PF9toDV3JdIe0H6h/NXojwqgMlrZClmlPYx9RImNXiG', 'Dispatcher', '2025-06-06 11:24:08'),
(11, 'Evans n', 'Evans', 'Nyirenda', 18, 'Nnyirendaevans@gmail.com', '0888563212', '$2y$10$waSajVqxLqaPN8Gbs0ST3uylCf9XQ/OT7p.2mDh5POQvQhYcwFZQy', 'Responder', '2025-06-06 11:26:12'),
(12, 'Gracious N', 'Gracious', 'Nyirenda', 15, 'Nnyirendagracious@gmail.com', '0888563212', '$2y$10$5mSkTdzuCd9Yr4.h6a53C.oDWH/yWNVPtD6sBA6GY7LbC6KZ4kD4C', 'Dispatcher', '2025-06-06 11:27:18'),
(13, 'Pamela M', 'Pamela', 'Mutawali', 40, 'pamelamtawali@gmail.com', '0884003438', '$2y$10$xjUJIl0r6J3aHpIaZYQ9He5nV0lU98AEEX947aQ9xwJiSsO6adxKS', 'Dispatcher', '2025-06-06 13:14:09'),
(15, 'virginia m', 'virgie', 'Ngosi', 20, 'virginiangosi@gmail', '0884003463', '$2y$10$B2sVO2.iKvJC2usTG1FqZetPQvuLt4pMWh9lOwUKBPOgnLI/kEyS.', 'Dispatcher', '2025-06-07 00:21:15'),
(16, 'Mwagala c', 'Mwangala', 'Chatiwa', 30, 'mwangala@gmail.com', '07685687847894', '$2y$10$TY7j3DwCxHsB80NM7720HOIHzXF.FX2dq4rp2MFAO6UovTI7lzwaW', 'Victim', '2025-06-07 11:15:54'),
(17, 'Funny n', 'Funny', 'Nyirenda', 32, 'funnynyirenda5@gmail.com', '0774065656', '$2y$10$bhvaKQhFE0Po4R07k8boROvxAecqnKk7goQwCfS/oszShRO3Hd8Ze', 'Victim', '2025-06-07 12:41:28'),
(18, 'virg', 'virgi', 'Nyirenda', 20, 'virginianyirenda6@gmail.com', '077406557', '$2y$10$/9FZXqHIX7OTJJJZGUkc3eWYB42wCfXUty9lZiJebyxKS7eMMrqOi', 'Victim', '2025-06-07 23:56:39'),
(20, 'Vanessa M', 'Vanessa', 'Mungoma', 16, 'vanessa3@gmail.com', '0772345', '$2y$10$.kOB1eBX/rqg3zBKJ2.AxeDolqGjoseNXROnnzIrOS8lLY9g7d6m.', 'Responder', '2025-06-08 00:14:40'),
(21, 'Nancy k', 'Nancy ', 'Kayoya', 21, 'nancy@gmail.com', '0774065656', '$2y$10$Xh2MLi7l/hDY2O1q7fY0d.MzgLXSmWXBqBIAwWnfuvHVjrsg16hSm', 'Victim', '2025-06-08 23:40:37'),
(22, 'James k', 'James', 'Kamanga', 12, 'james@gmail.com', '07748754589', '$2y$10$pqmB4J0TNAhLovjrI1aJgOAbvy3BuRUAR3Gihg8TiaF8fCw8B639a', 'Victim', '2025-06-11 13:13:36'),
(23, 'Ben b', 'ben', 'banda', 21, 'benbanda@gmail.com', '077406456', '$2y$10$S7ylevVJSEtDv4SxCjPYDe2y6rlYBQDPyAWm0jkSXvTg91K/T7JIa', 'Responder', '2025-06-12 12:18:49'),
(24, 'Mercy m', 'Mercy', 'manda', 21, 'mercy@gmail.com', '077406456', '$2y$10$x8iQvR43cabVv0uCTykiaOKdJmlOceNWlyKtZ7wQnsfo7JJgbkJgO', 'Victim', '2025-06-12 12:58:59'),
(27, 'Caro b', 'Caro', 'banda', 21, 'carobanda@gmail.com', '077406567312', '$2y$10$PLyVAhuZkzfh37MdZENzAuIVNTOY5QdvXwYTOgDzfc3AWpwGOBGTa', 'Victim', '2025-06-14 08:46:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_cases`
--
ALTER TABLE `dashboard_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fire_requests`
--
ALTER TABLE `fire_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_requests`
--
ALTER TABLE `medical_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police_requests`
--
ALTER TABLE `police_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dashboard_cases`
--
ALTER TABLE `dashboard_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fire_requests`
--
ALTER TABLE `fire_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_requests`
--
ALTER TABLE `medical_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `police_requests`
--
ALTER TABLE `police_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
