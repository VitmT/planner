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
INSERT INTO `reccuring_event` (`id`, `name`, `default_timestamp`, `reccurence_type`) VALUES (1,'Chodov','2023-06-12 08:30:00','weekly'),(4,'Sokolov','2023-06-19 08:30:00','weekly'),(5,'Ostrov','2023-06-26 08:30:00','weekly'),(6,'Stará Role','2023-07-02 08:30:00','weekly'),(7,'Nové Sedlo','2023-07-09 08:30:00','weekly'),(8,'Karlovy Vary','2023-07-16 08:30:00','weekly'),(9,'Svatava','2023-07-23 08:30:00','weekly'),(10,'Dalovice','2023-07-30 08:30:00','weekly');
/*!40000 ALTER TABLE `reccuring_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `reccuring_event_occurence`
--

LOCK TABLES `reccuring_event_occurence` WRITE;
/*!40000 ALTER TABLE `reccuring_event_occurence` DISABLE KEYS */;
INSERT INTO `reccuring_event_occurence` (`id`, `reccuring_event_id`, `timestamp`, `duration`) VALUES (1,1,'2023-06-07 08:30:00',2),(2,1,'2023-06-14 08:30:00',1),(3,1,'2023-06-21 08:30:00',2),(4,1,'2023-06-28 08:30:00',2),(5,1,'2023-07-04 08:30:00',1),(6,1,'2023-07-11 08:30:00',1),(7,1,'2023-07-18 08:30:00',1),(8,1,'2023-07-25 08:30:00',2);
/*!40000 ALTER TABLE `reccuring_event_occurence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES (1,'marek','[\"ROLE_ALLEVENTS\"]','$2y$13$wuIsvuu9bf5qXdNSJP2tWOGy.V0caO3h5aiJJJhU6pdSY077eqEU6'),(2,'vitek','[\"\"]','$2y$13$I32l6kNVLiLPCmDMNCeaR.eO1qE0cHFgW/cLSI5XLpQd54WZWdDrG');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_reccuring_event`
--

LOCK TABLES `user_reccuring_event` WRITE;
/*!40000 ALTER TABLE `user_reccuring_event` DISABLE KEYS */;
INSERT INTO `user_reccuring_event` (`user_id`, `reccuring_event_id`) VALUES (2,4);
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

-- Dump completed on 2023-06-15  7:19:50
