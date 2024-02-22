-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: posdb.mysql.database.azure.com    Database: cafe
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `employees_account`
--

DROP TABLE IF EXISTS `employees_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees_account` (
  `user_id` varchar(6) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `roles` enum('employee','manager') NOT NULL DEFAULT 'employee',
  `telephone` varchar(11) DEFAULT NULL,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees_account`
--

LOCK TABLES `employees_account` WRITE;
/*!40000 ALTER TABLE `employees_account` DISABLE KEYS */;
INSERT INTO `employees_account` VALUES ('230020','ศรัณย์','แซ่อึ้ง','saran.za097@gmail.com','12345','manager',NULL,'2023-10-29'),('230030','Toon','02','toonjtw01@gmail.com','426513','manager',NULL,'2023-10-30'),('230040','มิก','สรัน','test@gmail.com','123456','employee','0650654444','2023-10-31'),('230050','Mick','Saran','mix_za06@outlook.com','12345','employee','','2023-10-31'),('230070','thanawat','na','toon1073@hotmail.com','426513','employee',NULL,'2023-10-31'),('230090','Saran','Saeeung','mix_za03@outlook.co.th','12345','employee',NULL,'2023-11-01'),('230100','Saran','Saeeung','mix@mail.com','12345','employee',NULL,'2023-11-01'),('230110','Saran','Saeeung','mix_za031@outlook.co.th','12345','employee',NULL,'2023-11-01'),('230120','ศรัณย์','แซ่อึ้ง','mix08@mail.com','12345','employee',NULL,'2023-11-01'),('230130','Saran','Saeeung','mix.za0971@gmail.com','12345','employee',NULL,'2023-11-01'),('230140','toon','jtw','toon1072@hotmail.com','426513','employee',NULL,'2023-11-01'),('230150','toon','jtw','toon10722@hotmail.com','426513','employee',NULL,'2023-11-01'),('230160','tttt','ttttt','eeee@mail.com','123','employee',NULL,'2023-11-01');
/*!40000 ALTER TABLE `employees_account` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-01 13:54:20
