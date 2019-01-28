-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2019 at 12:19 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--
CREATE DATABASE IF NOT EXISTS `construction` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `construction`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` smallint(5) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(40) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Wheel Loaders'),
(2, ' Loader Backhoes'),
(3, 'Dozers'),
(4, 'Skid Steers'),
(5, 'Cranes'),
(6, 'Vibratory Rolers'),
(7, 'Excavators'),
(8, 'Asphalt Roler');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

DROP TABLE IF EXISTS `equipments`;
CREATE TABLE IF NOT EXISTS `equipments` (
  `equipId` int(11) NOT NULL AUTO_INCREMENT,
  `spid` int(50) NOT NULL,
  `equipName` varchar(40) NOT NULL,
  `equipDesc` text NOT NULL,
  `manufacId` smallint(6) NOT NULL,
  `equipEngineNumber` varchar(50) NOT NULL,
  `equipPrice` decimal(10,2) NOT NULL,
  `categoryId` smallint(6) NOT NULL,
  `equipStatus` enum('Available','Unavailable','Rented') NOT NULL,
  `equipimage` blob,
  PRIMARY KEY (`equipId`),
  KEY `manufacID` (`manufacId`),
  KEY `catId` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacId` smallint(6) NOT NULL AUTO_INCREMENT,
  `manufacCompany` varchar(40) DEFAULT NULL,
  `manufacEmail` varchar(40) DEFAULT NULL,
  `manufacAddress` varchar(150) DEFAULT NULL,
  `manufacContactNum` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`manufacId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `ratingId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `equipId` int(11) NOT NULL,
  `ratingDesc` varchar(225) NOT NULL,
  `stars` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`ratingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `rentalid` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `equipId` int(11) NOT NULL,
  `rental_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` enum('Pending','Renting','Finished','Cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`rentalid`),
  KEY `client_id` (`userId`),
  KEY `flower_id` (`equipId`),
  KEY `ordStatus` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaction`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
`userid` int(11)
,`rental_id` int(11)
,`totalPayment` varchar(22)
);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transactId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `equipId` int(11) NOT NULL,
  `rentalid` int(11) NOT NULL,
  `transactionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transactId`),
  KEY `userid` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `contactnum` bigint(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` enum('Client','Admin','Super_Admin') NOT NULL,
  `account_status` enum('Active','Disabled','Pending','Denied') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `date_created` (`date_created`,`user_type`,`account_status`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `fname`, `lname`, `contactnum`, `email`, `password`, `date_created`, `user_type`, `account_status`) VALUES
(43, 'admin', 'admin', 'admin', 12345678990, 'admin@gmail.com', '$2y$10$APC6k4WOzL80btAOQzcpN.29Bu5wmrUgRiYnQhPFKs4NJiWQ2YnSC', '2019-01-23 09:55:43', 'Super_Admin', 'Active');

-- --------------------------------------------------------

--
-- Structure for view `transaction`
--
DROP TABLE IF EXISTS `transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaction`  AS  select `rentals`.`userId` AS `userid`,`rentals`.`rentalid` AS `rental_id`,concat((`rentals`.`duration` * `equipments`.`equipPrice`)) AS `totalPayment` from (`equipments` join `rentals` on((`equipments`.`equipId` = `rentals`.`equipId`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `catId` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacID` FOREIGN KEY (`manufacId`) REFERENCES `manufacturers` (`manufacId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
