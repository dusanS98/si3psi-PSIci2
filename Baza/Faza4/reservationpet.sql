-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 01, 2020 at 07:26 PM
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

--
-- Dumping data for table `reservationpet`
--

INSERT INTO `reservationpet` (`username`, `petId`, `dateTime`) VALUES
('eucc', 1, '2020-06-01 08:00:00'),
('eucc', 2, '2020-06-01 09:00:00'),
('eucc', 3, '2020-06-01 10:00:00'),
('eucc', 4, '2020-06-01 11:00:00'),
('mitztetrebic', 2, '2020-06-02 08:00:00'),
('mitztetrebic', 6, '2020-06-01 12:00:00'),
('mitztetrebic', 9, '2020-06-26 08:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservationpet`
--
ALTER TABLE `reservationpet`
  ADD CONSTRAINT `R_11` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_12` FOREIGN KEY (`petId`) REFERENCES `pet` (`petId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
