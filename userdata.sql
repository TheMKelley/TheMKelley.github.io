-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 05:21 PM
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
-- Database: `userdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `FName`, `LName`, `Email`, `Password`, `isAdmin`) VALUES
(3, 'Chase', 'Boucher', 'chaseboucher@email.com', '$2y$10$QAOYPRuvqjwKik6T7eiX8un/93iiZMNfvDVjqJa0eQpJRcFhVBn06', 0),
(4, 'Michael', 'Kelley2', 'michaelhkelley@cox.net', '$2y$10$1ekbYjLLt7W4uYGhC49fuO99lHHh2MWAuaj0Nun5Q9UDTjaYmx05O', 0),
(7, 'John', 'Doe', 'johndoeADMINISTRATOR@email.com', '$2y$10$iOEjT8ri6FZQjZllfYoUDOlGv8M0Hf08mp/CF25H.nlarH3HN3qdi', 1),
(8, 'Michael', 'Kelley', 'michaelhkelley@cox.net', '$2y$10$HTjUA.TsYemaRDJjRobPPOlX2VSO1AlB8aE85e2kOi2bSRfw0rBvy', 0),
(9, 'Test', 'User2', 'testuser@email.com', '$2y$10$htra.lOtATfH64Uk4EbEXOJ7GB3cg/wHrHiUFFtpW2ttYL//37fEK', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
