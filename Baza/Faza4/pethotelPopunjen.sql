-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2020 at 09:28 PM
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
DROP DATABASE IF EXISTS `pethotel`;
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`name`, `price`, `amount`, `articleId`, `image`, `description`) VALUES
('Posude za hranu', 500, 131, 1, 'item1.jfif', 'psi#Pozude za hranu za pse'),
('Okovratnik', 300, 96, 2, 'item2.jfif', 'psi#Okovratnik za pse'),
('Hrana za pse', 800, 26, 4, 'item4.jfif', 'psi#Hrana za pse u konzervi'),
('Hrana za pse', 1000, 29, 5, 'item5.jfif', 'psi#Hrana za pse 10kg'),
('Hrana za mačke', 600, 11, 6, 'item6.jpg', 'macke#Hrana za mačke 3kg'),
('Hrana za mačke', 900, 14, 7, 'item7.jfif', 'macke#Hrana za mačke u konzervi'),
('Posuda za hranu', 400, 8, 8, 'item8.jfif', 'macke#Posuda za hranu za mačke'),
('Posude za hranu', 200, 5, 9, 'item9.jfif', 'psi#Posude za hranu za pse'),
('Hrana za pse', 500, 13, 11, 'item11.jpg', 'psi#Hrana za pse 5kg'),
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
('Okovratnik', 400, 15, 27, 'item23.jfif', 'psi#Okovratnik za pse                        '),
('Hrana za hrčke', 250, 1, 29, 'photo.jpg', 'maleZivotinje#Hrana za male životinje                                                                                                                                    '),
('Hrana za ribe', 320, 1, 30, 'photo_1.jpg', 'ribe#Hrana za ribe'),
('Hrana za ptice', 150, 9, 32, 'ptice1.jpg', 'ptice#Hrana za ptice 800g                                    '),
('Hrana za ptice', 450, 6, 33, 'ptice2.jpg', 'ptice#Hrana za ptice 1kg          '),
('Hrana za ribe', 800, 9, 34, 'ribe1.jpg', 'ribe#Hrana namenjena ribicama biljojedima. Namenjena je somićima, živorotkama i cilidima biljojedima                       '),
('Hrana za ribe', 900, 8, 35, 'ribe2.jpg', 'ribe#Hrana za morske ribe                                 '),
('Hrana za zečeve', 450, 9, 36, 'zecevi1.jpg', 'maleZivotinje#Classic Cuni 500gr je klasična mešavina semenki, žitarica, presovanih žitarica, peleta i ekstrudiranih peleta namenjena svakodnevnoj ishrani kunića i patuljastih kunića.                       '),
('Hrana za ribe', 500, 3, 37, 'ribe3.jpg', 'ribe#Balance briketi za ribe                        ');

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

--
-- Dumping data for table `orderarticle`
--

INSERT INTO `orderarticle` (`articlePrice`, `orderId`, `articleId`, `amount`) VALUES
(500, 61, 1, 6),
(200, 61, 9, 5),
(500, 64, 1, 2),
(500, 65, 1, 3),
(800, 65, 4, 2),
(500, 66, 1, 4),
(500, 66, 11, 6),
(250, 66, 29, 1),
(400, 67, 8, 1),
(320, 67, 30, 2),
(500, 68, 1, 11),
(500, 69, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`name`, `breed`, `dateOfBirth`, `petId`, `image`, `description`) VALUES
('Astor', 'Pas', '2020-05-12', 1, 'dog.jpg', 'Opis nekog psa                                                '),
('Vuki', 'Pas', '2020-05-05', 2, 'puppy.jpeg', 'Opis psa'),
('Keti', 'Macka', '2020-05-07', 3, 'cat.jpg', 'Opis macke'),
('Jole', 'Macak', '2020-05-03', 4, 'catM.jfif', 'Opis macke'),
('Kikica', 'Pas', '2020-05-02', 5, 'f1.jpg', 'Opis psa'),
('Gile', 'Hrcak', '2020-05-03', 6, 'h1.jpg', 'Opis hrcka'),
('Sara', 'Kornjaca', '2020-05-07', 7, 'k1.jpg', 'Opis kornjace'),
('Petronije', 'Kornjaca', '2020-05-05', 8, 'k2.jpg', 'Opis kornjace'),
('Mimi', 'Lasica', '2020-05-09', 9, 'l1.jpg', 'Opis lasice'),
('Koko Sanel', 'Lasica', '2020-05-14', 10, 'l2.jpg', 'Opis lasice'),
('Napoleon', 'Ptica', '2020-05-16', 11, 'p1.jpg', 'Opis papagaja'),
('Hrvoje', 'Ptica', '2020-05-11', 12, 'p2.jpg', 'Opis papagaja'),
('Mudja', 'Ptica', '2020-04-13', 13, 'p3.jpg', 'Opis papagaja'),
('Bubi', 'Ptica', '2020-05-05', 14, 'p4.jpg', 'Opis papagaja'),
('Nata', 'Zeka', '2020-05-01', 15, 'z1.jpg', 'Opis zeke'),
('Tutko', 'Zeka', '2020-05-04', 16, 'z2.jpg', 'Opis zeke'),
('Masa', 'Ribica', '2020-05-05', 17, 'r1.jpg', 'Opis ribice'),
('Meda', 'Ptica', '2020-05-07', 18, 'meda.jpg', 'Bla bla'),
('Astor1', 'Pas', '2020-05-12', 29, 'dog-Copy.jpg', 'Opis nekog psa                                                                                                ');

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
('eucc', 1, '2020-06-01 06:00:00'),
('eucc', 2, '2020-06-01 07:00:00'),
('eucc', 3, '2020-06-01 08:00:00'),
('eucc', 4, '2020-06-01 09:00:00'),
('mitztetrebic', 2, '2020-06-02 06:00:00'),
('mitztetrebic', 6, '2020-06-01 10:00:00'),
('mitztetrebic', 9, '2020-06-26 06:00:00'),
('user123', 2, '2020-06-01 12:00:00'),
('user123', 6, '2020-06-12 08:00:00');

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

--
-- Dumping data for table `reservationroom`
--

INSERT INTO `reservationroom` (`username`, `dateFrom`, `dateTo`, `roomId`) VALUES
('admin', '2020-06-23', '2020-06-25', 11),
('dusan', '2020-06-09', '2020-06-09', 10),
('dusan', '2020-07-14', '2020-07-17', 18),
('moderator123', '2020-06-17', '2020-06-20', 10),
('user123', '2020-06-03', '2020-06-05', 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`type`, `roomId`, `image`, `description`) VALUES
('maleZivotinje', 9, 'room2.jpg', 'Uzivanje      '),
('maleZivotinje', 10, 'room4_1.jpg', 'Smestaj za male zivotinje      '),
('maleZivotinje', 11, 'room4.jpg', 'Kornjacin san'),
('psi', 17, 'box1.jpg', 'Za aktivne pse             '),
('maleZivotinje', 18, 'box2.jpg', 'Lasicji duh'),
('maleZivotinje', 19, 'box3.jpg', 'Lukava koliba'),
('ribe', 20, 'box4.jpg', '88 Rooms'),
('psi', 23, 'room.jpg', 'Smestaj u kom ce Vasi psi uzivati'),
('maleZivotinje', 24, 'room3.jpg', 'Opustena sreda'),
('macke', 28, 'room5.jpg', 'Smestaj za macke        '),
('ptice', 29, 'room6.jpg', 'Smestaj za ptice');

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
('asdasd', 'mmmmmmm', 'Milica', 'Kaitovic', 'mmm@gmail.m', '0643974584', 'standard'),
('bla', 'kameleon', 'mala', 'maca', 'mkaitovic@gmail.commm', '0643756544', 'standard'),
('djuriceva', 'mrzimmacke', 'Ana', 'Djuric', 'jamrzimmacke@gmail.com', '0645558884', 'standard'),
('dusan', 'dusan123', 'Dušan', 'Stanivuković', 'dusan@mail.com', '01234567', 'admin'),
('eucc', 'misica', 'Nikola', 'Antonic', 'misica123@gmail.com', '062778899', 'standard'),
('greska', '$2y$10$Jbd8ui7xQ', 'Katarina', 'Grujic', 'kg@gmail.com', '064444444', 'standard'),
('jovan', 'jovan123', 'Jovan', 'Penezić', 'jovan@mail.com', '01234567', 'admin'),
('mic', 'micmic', 'Milica', 'ASDasd', 'mkasm@gmail.com', '098675843', 'standard'),
('milicaJ', 'milicaj123', 'Milica', 'Janković', 'milicaj@mail.com', '01234567', 'admin'),
('milicaK', 'milicak123', 'Milica', 'Kaitović', 'milicak@mail.com', '01234567', 'admin'),
('mitztetrebic', 'micatrepavica', 'Milica', 'Kaitovic', 'mkaitovic@gmail.com', '0643434345', 'standard'),
('moderator123', 'sifra123', 'Marko', 'Marković', 'marko@gmail.com', '239168', 'moderator'),
('pera', 'sifra123', 'Petar', 'Petrović', 'petar.petrovic@gmail.com', '0602498321', 'standard'),
('slonica', 'flasica', 'Milica', 'Kaitovic', 'km@etf.bg.rs', '0645554443', 'standard'),
('takomlada', 'kobalada', 'Tanja', 'Savic', 'tanja@gmail.vom', '0645558884', 'standard'),
('user123', 'sifra123', 'Pera', 'Perić', 'pera@gmail.com', '123412', 'standard');

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`orderId`, `username`, `dateTime`, `status`, `recipientAddress`, `recipientCity`, `recipientState`, `recipientPostalCode`, `orderPrice`) VALUES
(61, 'dusan', '2020-05-17 14:59:14', 'closed', 'Ulica 123', 'Beograd', 'Srbija', '11000', 4000),
(64, 'admin', '2020-05-17 16:34:36', 'closed', 'Ulica 77', 'Krusevac', 'Srbija', '37000', 1000),
(65, 'admin', '2020-05-17 17:47:22', 'open', NULL, NULL, NULL, NULL, 3100),
(66, 'user123', '2020-05-17 18:26:21', 'closed', 'Ulica 75', 'Beograd', 'Srbija', '11000', 5250),
(67, 'user123', '2020-05-17 18:29:56', 'closed', 'Ulica 23', 'Beograd', 'Srbija', '11000', 1040),
(68, 'user123', '2020-05-17 18:57:51', 'closed', 'Ulica 12', 'Beograd', 'Srbija', '11000', 5500),
(69, 'moderator123', '2020-05-31 13:29:40', 'open', NULL, NULL, NULL, NULL, 500);

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
