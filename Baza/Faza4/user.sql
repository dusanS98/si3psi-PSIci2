-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 01, 2020 at 07:22 PM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
