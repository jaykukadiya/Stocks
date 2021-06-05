-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 01:30 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(2) NOT NULL,
  `acc_number` varchar(8) NOT NULL,
  `person_name` varchar(20) NOT NULL,
  `balance` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_buy`
--

CREATE TABLE `stock_buy` (
  `id` int(5) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `buy_price` varchar(10) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `buy_date` date NOT NULL,
  `acc_id` varchar(8) NOT NULL,
  `total_buy_price` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_sold`
--

CREATE TABLE `stock_sold` (
  `id` int(11) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `buy_price` varchar(6) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `buy_date` date NOT NULL,
  `acc_id` varchar(3) NOT NULL,
  `total_price` varchar(7) NOT NULL,
  `sell_price` varchar(10) NOT NULL,
  `total_sell_price` varchar(7) NOT NULL,
  `sell_date` date NOT NULL,
  `majuri` varchar(5) NOT NULL,
  `profit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `stock_buy`
--
ALTER TABLE `stock_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_sold`
--
ALTER TABLE `stock_sold`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_buy`
--
ALTER TABLE `stock_buy`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `stock_sold`
--
ALTER TABLE `stock_sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
