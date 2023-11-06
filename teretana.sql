-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 12:13 PM
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
-- Database: `teretana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$NPGPrezqJE3ijcbritkaA.p7yNokKfYTb3uo2vBtueVA3kNmCpOMa', '2023-10-29'),
(2, 'ivan', '$2y$10$dytib7HRzU296Shd/LzBjeTG/KHlYe2YJRtUuKBefjQLDQl1kapiO', '2023-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `training_plan_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `access_card_pdf_path` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `email`, `phone_number`, `photo_path`, `training_plan_id`, `trainer_id`, `access_card_pdf_path`, `created_at`) VALUES
(5, 'Nikola', 'Jokic', 'asd@g.com', '123125123', '0', 3, 5, '', '2023-10-30'),
(6, 'Sanja', 'Despotovic', 'aaaaaaaa@a.com', '123125124', '0', 1, 0, '', '2023-10-30'),
(7, 'Aleksandar', 'Vucic', 'av@gmail.com', '+381 61123124', '0', 0, 3, '', '2023-11-03'),
(8, 'Ana', 'Brnabic', 'ab@gmail.com', '+381-124123333', '0', 3, 2, '', '2023-11-03'),
(9, 'Majmun1', 'Majmun', 'majmun@yahoo.com', '+3190231321', '0', 3, 0, '', '2023-11-03'),
(10, 'Majmun2', 'Majmun', 'majmun2@yahoo.com', '1231231231245', '0', 0, 4, 'access_cards/access_card_10.pdf', '2023-11-03'),
(15, 'asd', 'd', 'as@g', 'd123', '0', 1, 4, 'access_cards/access_card_15.pdf', '2023-11-03'),
(16, 'e', 'w', '2@CS', 'ASD', '0', 1, 4, 'access_cards/access_card_16.pdf', '2023-11-03'),
(17, 'Donald', 'Trump', 'doland@trump.com', '+381 63-252-498', '0', 3, 2, 'access_cards/access_card_17.pdf', '2023-11-03'),
(18, 'Donald', 'Trump', 'nidzulinac@gmail.com', '+381 63 252498', '0', 0, 5, 'access_cards/access_card_18.pdf', '2023-11-03'),
(20, 'Donald', 'Trump', 'nikolacupic555@gmail.com', '001231245123', '0', 0, 0, 'access_cards/access_card_20.pdf', '2023-11-03'),
(27, 'Donald', 'Trump', 'donald@trump.com', '001231245123', 'member_photos/images.jpeg', 0, 0, 'access_cards/access_card_27.pdf', '2023-11-03'),
(28, 'Viktor', 'Rasic', 'viktor@rasic.com', '001231245123', 'member_photos/moze_li_se_majmun_smatrati_autorom_fotografije_aps_329792500.jpeg', 3, 3, 'access_cards/access_card_28.pdf', '2023-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `first_name`, `last_name`, `email`, `phone_number`, `created_at`) VALUES
(2, 'Jane', 'Smith', 'jane.smith@example.com', '555-555-5556', '2023-11-05'),
(3, 'Mike', 'Johnson', 'mike.johnson@example.com', '555-555-5557', '2023-11-05'),
(4, 'Sarah', 'Brown', 'sarah.brown@example.com', '555-555-5558', '2023-11-05'),
(5, 'David', 'Wilson', 'david.wilson@example.com', '555-555-5559', '2023-11-05'),
(8, 'Vladimir', 'Vrv', 'vladimir@vrhovski.com', '123124213', '2023-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `training_plans`
--

CREATE TABLE `training_plans` (
  `plan_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sessions` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_plans`
--

INSERT INTO `training_plans` (`plan_id`, `name`, `sessions`, `price`, `created_at`) VALUES
(1, '12 sessions plan', 12, '2200', '2023-10-28'),
(3, '16 sessions plan', 16, '2600', '2023-10-28'),
(5, '30 sessions plan', 30, '3000', '2023-11-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `training_plans`
--
ALTER TABLE `training_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `training_plans`
--
ALTER TABLE `training_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
