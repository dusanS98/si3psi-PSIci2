CREATE DATABASE  IF NOT EXISTS `pethotel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pethotel`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: pethotel
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article` (
  `name` varchar(32) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL,
  `articleId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`articleId`),
  UNIQUE KEY `articleId_UNIQUE` (`articleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderarticle`
--

DROP TABLE IF EXISTS `orderarticle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderarticle` (
  `articlePrice` float NOT NULL,
  `orderId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`orderId`,`articleId`),
  KEY `R_24` (`articleId`),
  CONSTRAINT `R_22` FOREIGN KEY (`orderId`) REFERENCES `userorder` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_24` FOREIGN KEY (`articleId`) REFERENCES `article` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderarticle`
--

LOCK TABLES `orderarticle` WRITE;
/*!40000 ALTER TABLE `orderarticle` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderarticle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pet` (
  `name` varchar(32) NOT NULL,
  `breed` varchar(32) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `petId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`petId`),
  UNIQUE KEY `petId_UNIQUE` (`petId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservationpet`
--

DROP TABLE IF EXISTS `reservationpet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservationpet` (
  `username` varchar(16) NOT NULL,
  `petId` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL,
  PRIMARY KEY (`username`,`petId`),
  KEY `R_12` (`petId`),
  CONSTRAINT `R_11` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_12` FOREIGN KEY (`petId`) REFERENCES `pet` (`petId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservationpet`
--

LOCK TABLES `reservationpet` WRITE;
/*!40000 ALTER TABLE `reservationpet` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservationpet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservationroom`
--

DROP TABLE IF EXISTS `reservationroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservationroom` (
  `username` varchar(16) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `roomId` int(11) NOT NULL,
  PRIMARY KEY (`username`,`roomId`),
  KEY `R_10` (`roomId`),
  CONSTRAINT `R_10` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_8` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservationroom`
--

LOCK TABLES `reservationroom` WRITE;
/*!40000 ALTER TABLE `reservationroom` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservationroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `type` varchar(16) NOT NULL,
  `roomId` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roomId`),
  UNIQUE KEY `roomId_UNIQUE` (`roomId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','Admin$1234','Admin','Admin','admin@mail.com','01234567','admin'),('dusan','dusan123','Dušan','Stanivuković','dusan@mail.com','01234567','admin'),('jovan','jovan123','Jovan','Penezić','jovan@mail.com','01234567','admin'),('milicaJ','milicaj123','Milica','Janković','milicaj@mail.com','01234567','admin'),('milicaK','milicak123','Milica','Kaitović','milicak@mail.com','01234567','admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userorder`
--

DROP TABLE IF EXISTS `userorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userorder` (
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
  KEY `R_21` (`username`),
  CONSTRAINT `R_21` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userorder`
--

LOCK TABLES `userorder` WRITE;
/*!40000 ALTER TABLE `userorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `userorder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-03 14:01:32
