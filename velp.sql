-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: velp
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `uname`, `email`, `passwd`) VALUES (21001,'Tugume Peter','simontugume2@gmail.com','avelp');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `grp` varchar(20) DEFAULT NULL,
  `announcement` varchar(450) NOT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5604 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` (`id`, `title`, `grp`, `announcement`, `created`) VALUES (5601,'Festive Season','all','Hello Team.\nAs we are approaching the festive period in December, I want you to know that we shall have a one week\'s break from December 24th 2022 to January 3rd 2023. Let\'s keep doing what we do to the best of our abilities to hit the our target.\nThanks.','2022-11-16'),(5602,'World cup','IT','Hello Team.\nThe board of directors had a meeting and we discussed the aspect of world cup. We decided to approve watching of the evening games. In the longue is where you shall watch the games. We found that the afternoon games would affect the performance should you watch them.','2022-11-16');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deps`
--

DROP TABLE IF EXISTS `deps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1513 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deps`
--

LOCK TABLES `deps` WRITE;
/*!40000 ALTER TABLE `deps` DISABLE KEYS */;
INSERT INTO `deps` (`id`, `department`) VALUES (1501,'IT'),(1502,'Procurement'),(1507,'Sales'),(1508,'Marketing'),(1509,'Accounting'),(1512,'Security');
/*!40000 ALTER TABLE `deps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(5) DEFAULT NULL,
  `fullname` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `address` varchar(20) DEFAULT NULL,
  `department` int DEFAULT NULL,
  `telephone` varchar(16) DEFAULT NULL,
  `salary` int NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=678008 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `title`, `fullname`, `dob`, `gender`, `email`, `address`, `department`, `telephone`, `salary`, `password`) VALUES (678001,'Mr.','Kisitu Wilson','1997-06-18','male','kisituwilson@gmail.com','Ntinda',1501,'0788763521',850000,'$2y$10$RELn3mHUvHHLHXbxvYxrcOAqMYSOhLzLUTZ2sTFyfVh9OonisrJiq'),(678002,'Miss.','Namubiru Jackline','1998-03-12','female','namubirujackline@gmail.com','Mukono town',1507,'0706458932',700000,'$2y$10$P0VjlzeWpiRqYl1l8iT90eq18y68vo/s3oKAsPimbGn8lfR5eN6Li'),(678003,'Mrs.','Ssemanda Mary','1995-09-17','female','namatamary@gmail.com','Kasangati',1502,'0763538221',1500000,'$2y$10$RIywwt/20T3MUvb.1yjkzu.Q2q40Athkv95N/FlbT6xFc0ZQGXBAm'),(678004,'Mr.','Masaka Robert','1996-05-26','male','masakarobert@gmail.com','Matugga',1501,'0754789634',1200000,'$2y$10$qDdnqUMERJJJ8HefyhLo8uIo1XBuZd46EdTReuuxdDDIs7ux1kEhi');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(32) NOT NULL,
  `message` varchar(450) NOT NULL,
  `person` int NOT NULL,
  `sent` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `subject`, `message`, `person`, `sent`) VALUES (501,'Request for leave','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis distinctio perspiciatis architecto perferendis fugiat provident odit nam vel quidem, laborum hic ratione assumenda laboriosam? Mollitia, necessitatibus aperiam. Aspernatur id veritatis quod sit. Dolore aliquam aspernatur necessitatibus quaerat non nam earum fugit exercitationem, quidem est vel voluptates laborum. Veritatis quasi rerum ab unde, nobis id delectus maxime.',678001,'2022-11-17');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-17  1:00:48
