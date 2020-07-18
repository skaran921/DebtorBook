-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 07:04 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `debtorbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `debtors`
--

CREATE TABLE `debtors` (
  `DEBTOR_ID` int(11) NOT NULL,
  `DEBTOR_NAME` varchar(256) NOT NULL,
  `DEBTOR_MOBILE` varchar(20) NOT NULL,
  `DEBTOR_EMAIL` varchar(90) NOT NULL,
  `DEBTOR_ADDRESS` text NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `DEBTOR_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `DEBTOR_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DEBTOR_STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `REMINDER_ID` int(11) NOT NULL,
  `REMINDER_DATE` varchar(20) NOT NULL,
  `REMINDER` text NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `REMINDER_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `REMINDER_UPDATE_DATE` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `REMINDER_STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TRANSACTION_ID` int(11) NOT NULL,
  `TRANSACTION_DATE` varchar(20) NOT NULL,
  `DEBTOR_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PAY_AMOUNT` decimal(10,2) NOT NULL DEFAULT 0.00,
  `RECEIVED_AMOUNT` decimal(10,2) NOT NULL DEFAULT 0.00,
  `TRANSACTION_REMARK` text NOT NULL,
  `TRANSACTION_TYPE` varchar(10) NOT NULL DEFAULT 'R',
  `TRANSACTION_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `TRANSACTION_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TRANSACTION_STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_FIRST_NAME` varchar(90) NOT NULL,
  `USER_LAST_NAME` varchar(90) NOT NULL,
  `USER_EMAIL` varchar(90) NOT NULL,
  `USER_MOBILE` varchar(20) NOT NULL,
  `USER_PASSWORD` varchar(90) NOT NULL,
  `USER_ADDRESS` text NOT NULL,
  `USER_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `USER_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `USER_STATUS` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debtors`
--
ALTER TABLE `debtors`
  ADD PRIMARY KEY (`DEBTOR_ID`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`REMINDER_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TRANSACTION_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debtors`
--
ALTER TABLE `debtors`
  MODIFY `DEBTOR_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `REMINDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
