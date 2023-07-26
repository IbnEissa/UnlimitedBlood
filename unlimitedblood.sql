-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 04:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unlimitedblood`
--

-- --------------------------------------------------------

--
-- Table structure for table `usersdetails`
--

CREATE TABLE `usersdetails` (
  `id` int(11) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `mName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bloodGroup` varchar(5) DEFAULT NULL,
  `birthDate` date NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersdetails`
--

INSERT INTO `usersdetails` (`id`, `fName`, `mName`, `lName`, `gender`, `email`, `bloodGroup`, `birthDate`, `phoneNumber`, `password`) VALUES
(1, 'mohammed', 'hamoud', 'Essa', 'male', 'mohammed@gmail.com', 'o+', '2013-07-17', '1234567890', '1234567890'),
(2, 'osama', 'nabeel', 'jaja', 'male', 'osama@gmail.com', 'A+', '2023-07-12', '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usersdetails`
--
ALTER TABLE `usersdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usersdetails`
--
ALTER TABLE `usersdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
