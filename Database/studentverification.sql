-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 06:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentverification`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isOnline` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `isOnline`) VALUES
(1, 'gayares@gmail.com', '$2y$10$jXn6soHXTScfaEnnRtTVyeSt8wSVfj3foJkyTzTget0PWIYs1DkpS', 0),
(2, 'thirdy@gmail.com', '$2y$10$T6OdNGGGCOCe5Ptg9FwfhOzcgXaMAPkJGy7CNNDwiFhVyuNyTQp7S', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scanverification`
--

CREATE TABLE `scanverification` (
  `id` int(11) NOT NULL,
  `studentId` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scanverification`
--

INSERT INTO `scanverification` (`id`, `studentId`, `date`, `status`) VALUES
(1, 'A12034879', '2023-10-11 02:55:07', NULL),
(2, 'A12327434', '2023-10-11 03:00:20', NULL),
(3, 'A12327434', '2023-10-11 03:00:42', NULL),
(4, 'A12327434', '2023-10-11 04:14:28', NULL),
(5, 'A12327434', '2023-10-11 04:19:58', NULL),
(6, 'A12327434', '2023-10-11 04:23:41', NULL),
(7, 'A12034879', '2023-10-11 04:23:49', NULL),
(8, 'A12327434', '2023-10-11 04:24:23', NULL),
(9, 'A12034879', '2023-10-11 04:24:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `name`, `image`, `college`, `status`) VALUES
('A12034879', 'Jose Gayares III', 'https://firebasestorage.googleapis.com/v0/b/student-verification-5b296.appspot.com/o/StudentImage%2Fthirdy.jpg?alt=media&token=3977f86e-e2fc-4238-9a6e-a1e5d85e2242', 'CCIS', 0),
('A12327434', 'John Alex Robles', 'https://firebasestorage.googleapis.com/v0/b/student-verification-5b296.appspot.com/o/StudentImage%2Falex.jpg?alt=media&token=12834e72-f018-4518-9363-8be2cb1d71a5', 'CCIS', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scanverification`
--
ALTER TABLE `scanverification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scanverification`
--
ALTER TABLE `scanverification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scanverification`
--
ALTER TABLE `scanverification`
  ADD CONSTRAINT `scanverification_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
