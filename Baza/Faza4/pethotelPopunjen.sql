-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2020 at 10:21 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pethotel`
--
CREATE DATABASE IF NOT EXISTS `pethotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pethotel`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `name` varchar(32) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL,
  `articleId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`articleId`),
  UNIQUE KEY `articleId_UNIQUE` (`articleId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`name`, `price`, `amount`, `articleId`, `image`, `description`) VALUES
('Posude za hranu', 500, 12, 1, 'item1.jfif', 'psi#Pozude za hranu za pse'),
('Okovratnik', 300, 15, 2, 'item2.jfif', 'psi#Okovratnik za pse'),
('Hrana za pse', 500, 20, 3, 'item3.jpg', 'psi#Hrana za pse 5kg'),
('Hrana za pse', 800, 30, 4, 'item4.jfif', 'psi#Hrana za pse u konzervi'),
('Hrana za pse', 1000, 7, 5, 'item5.jfif', 'psi#Hrana za pse 10kg'),
('Hrana za mačke', 600, 22, 6, 'item6.jpg', 'macke#Hrana za mačke 3kg'),
('Hrana za mačke', 900, 17, 7, 'item7.jfif', 'macke#Hrana za mačke u konzervi'),
('Posuda za hranu', 400, 9, 8, 'item8.jfif', 'macke#Posuda za hranu za mačke'),
('Posude za hranu', 200, 10, 9, 'item9.jfif', 'psi#Posude za hranu za pse'),
('Okovratnik', 700, 23, 10, 'item10.jfif', 'psi#Okovratnik za pse'),
('Hrana za pse', 500, 20, 11, 'item11.jpg', 'psi#Hrana za pse 5kg'),
('Hrana za pse', 800, 30, 12, 'item12.jfif', 'psi#Hrana za pse u konzervi'),
('Hrana za pse', 1000, 7, 13, 'item13.jfif', 'psi#Hrana za pse 10kg'),
('Hrana za mačke', 600, 22, 14, 'item14.jpg', 'macke#Hrana za mačke 3kg'),
('Hrana za mačke', 900, 17, 15, 'item15.jfif', 'macke#Hrana za mačke u konzervi'),
('Posuda za hranu', 400, 9, 16, 'item16.jfif', 'macke#Posuda za hranu za mačke'),
('Posuda za hranu', 400, 9, 21, 'item17.jfif', 'macke#Posuda za hranu za mačke'),
('Hrana za mačke', 900, 17, 22, 'item18.jfif', 'macke#Hrana za mačke u konzervi'),
('Hrana za mačke', 600, 22, 23, 'item19.jpg', 'macke#Hrana za mačke 3kg'),
('Hrana za pse', 1000, 7, 24, 'item20.jfif', 'psi#Hrana za pse 10kg'),
('Hrana za pse', 800, 30, 25, 'item21.jfif', 'psi#Hrana za pse u konzervi'),
('Hrana za pse', 500, 20, 26, 'item22.jpg', 'psi#Hrana za pse 5kg'),
('Okovratnik', 300, 15, 27, 'item23.jfif', 'psi#Okovratnik za pse'),
('Posude za hranu', 500, 12, 28, 'item24.jfif', 'psi#Posude za hranu za pse');

-- --------------------------------------------------------

--
-- Table structure for table `orderarticle`
--

DROP TABLE IF EXISTS `orderarticle`;
CREATE TABLE IF NOT EXISTS `orderarticle` (
  `articlePrice` float NOT NULL,
  `orderId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`orderId`,`articleId`),
  KEY `R_24` (`articleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `name` varchar(32) NOT NULL,
  `breed` varchar(32) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `petId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`petId`),
  UNIQUE KEY `petId_UNIQUE` (`petId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservationpet`
--

DROP TABLE IF EXISTS `reservationpet`;
CREATE TABLE IF NOT EXISTS `reservationpet` (
  `username` varchar(16) NOT NULL,
  `petId` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL,
  PRIMARY KEY (`username`,`petId`),
  KEY `R_12` (`petId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservationroom`
--

DROP TABLE IF EXISTS `reservationroom`;
CREATE TABLE IF NOT EXISTS `reservationroom` (
  `username` varchar(16) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `roomId` int(11) NOT NULL,
  PRIMARY KEY (`username`,`roomId`),
  KEY `R_10` (`roomId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `type` varchar(16) NOT NULL,
  `roomId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roomId`),
  UNIQUE KEY `roomId_UNIQUE` (`roomId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `type` varchar(16) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`, `phone`, `type`) VALUES
('admin', 'Admin$1234', 'Admin', 'Admin', 'admin@mail.com', '01234567', 'admin'),
('dusan', 'dusan123', 'Dušan', 'Stanivuković', 'dusan@mail.com', '01234567', 'admin'),
('jovan', 'jovan123', 'Jovan', 'Penezić', 'jovan@mail.com', '01234567', 'admin'),
('milicaJ', 'milicaj123', 'Milica', 'Janković', 'milicaj@mail.com', '01234567', 'admin'),
('milicaK', 'milicak123', 'Milica', 'Kaitović', 'milicak@mail.com', '01234567', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

DROP TABLE IF EXISTS `userorder`;
CREATE TABLE IF NOT EXISTS `userorder` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `dateTime` timestamp NOT NULL,
  `status` varchar(16) NOT NULL,
  `recipientAddress` varchar(32) DEFAULT NULL,
  `recipientCity` varchar(32) DEFAULT NULL,
  `recipientState` varchar(32) DEFAULT NULL,
  `recipientPostalCode` varchar(16) DEFAULT NULL,
  `orderPrice` float DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  UNIQUE KEY `orderId_UNIQUE` (`orderId`),
  KEY `R_21` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderarticle`
--
ALTER TABLE `orderarticle`
  ADD CONSTRAINT `R_22` FOREIGN KEY (`orderId`) REFERENCES `userorder` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_24` FOREIGN KEY (`articleId`) REFERENCES `article` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservationpet`
--
ALTER TABLE `reservationpet`
  ADD CONSTRAINT `R_11` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_12` FOREIGN KEY (`petId`) REFERENCES `pet` (`petId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservationroom`
--
ALTER TABLE `reservationroom`
  ADD CONSTRAINT `R_10` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_8` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `R_21` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
