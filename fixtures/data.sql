-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: db    Database: thedatabase
-- ------------------------------------------------------
-- Server version	5.7.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `reccuring_event`
--

LOCK TABLES `reccuring_event` WRITE;
/*!40000 ALTER TABLE `reccuring_event` DISABLE KEYS */;
INSERT INTO `reccuring_event` (`id`, `name`, `default_timestamp`, `reccurence_type`) VALUES (1,'Chodov','2023-06-12 00:00:00','8:30'),(4,'Sokolov','2023-06-19 00:00:00','9:00'),(5,'Ostrov','2023-06-26 00:00:00','8:30'),(6,'Stará Role','2023-07-02 00:00:00','9:30'),(7,'Nové Sedlo','2023-07-09 00:00:00','9:00'),(8,'Karlovy Vary','2023-07-16 00:00:00','10:00'),(9,'Svatava','2023-07-23 00:00:00','8:00'),(10,'Dalovice','2023-07-30 00:00:00','9:30');
/*!40000 ALTER TABLE `reccuring_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `reccuring_event_occurence`
--

LOCK TABLES `reccuring_event_occurence` WRITE;
/*!40000 ALTER TABLE `reccuring_event_occurence` DISABLE KEYS */;
INSERT INTO `reccuring_event_occurence` (`id`, `reccuring_event_id`, `timestamp`, `duration`) VALUES (1,NULL,'2023-06-07 00:00:00',2),(2,NULL,'2023-06-14 00:00:00',1),(3,NULL,'2023-06-21 00:00:00',2),(4,NULL,'2023-06-28 00:00:00',2),(5,NULL,'2023-07-04 00:00:00',1),(6,NULL,'2023-07-11 00:00:00',1),(7,NULL,'2023-07-18 00:00:00',1),(8,NULL,'2023-07-25 00:00:00',2);
/*!40000 ALTER TABLE `reccuring_event_occurence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES (1,'marek','[]','dykpassword'),(3,'dominik','[]','$2y$13$j1VJm2Cl/6c7g7PJ2ZACx.Q2z48/u3Y9B1cFSlWAj9i3XuXHjLPZi ');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_reccuring_event`
--

LOCK TABLES `user_reccuring_event` WRITE;
/*!40000 ALTER TABLE `user_reccuring_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_reccuring_event` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-19 10:44:21
