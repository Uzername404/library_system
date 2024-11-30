-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 02:54 PM
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
-- Database: `library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `status` enum('Available','Borrowed','','') NOT NULL DEFAULT 'Available',
  `borrowed_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `status`, `borrowed_by`) VALUES
(13, 'jollibee', 'mcdo', 'Available', ''),
(14, '321', '654', 'Available', ''),
(15, 'it115', 'jethro maza', 'Available', ''),
(16, 'it116', 'ash', 'Available', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Librarian','','') NOT NULL,
  `time_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `time_created`) VALUES
(1, 'a', 'b', 'Admin', '2024-11-30 09:21:37'),
(2, 'c', 'd', 'Librarian', '2024-11-30 09:21:37'),
(4, 'eugene', '$2y$10$nrN5QSqV6QlNk64xiisRz.AsD.ZWjftmTSSL6SmfeirbIMYMk07sO', 'Admin', '2024-11-30 10:00:09'),
(5, 'gwen', '$2y$10$oo2e1BZPtGQvlDSH54posOg56gL3YkcZlnu6vTBuVViTbf9qroqxm', 'Librarian', '2024-11-30 13:52:05'),
(6, 'yurwin', '$2y$10$K4YVgnb54LmweGM0rvDLse7FjT3Eksg5xV7vix1nEi194rIG5WOLu', 'Librarian', '2024-11-30 17:32:31'),
(7, 'yujin', '$2y$10$T.T7s5BolRDZVMRxDDnt1.Os9ATssL7CaggowwFDPbQqEXQrMhX2a', 'Admin', '2024-11-30 19:48:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
