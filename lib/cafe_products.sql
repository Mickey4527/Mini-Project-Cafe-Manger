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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(128) NOT NULL,
  `product_img` varchar(64) DEFAULT NULL,
  `product_desc` varchar(256) DEFAULT NULL,
  `product_type` int DEFAULT NULL,
  `product_stock` int NOT NULL,
  `product_price` int NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_type` (`product_type`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type`) REFERENCES `categories` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (5,'อเมริกาโน่น้ำผึ้ง','Black Coffee.png','',3,141,75,'2023-10-30'),(6,'มอคค่า','Mocha.png','',3,105,60,'2023-10-30'),(7,'ชาเขียว','greentea.png','',7,177,65,'2023-10-30'),(8,'ชานม','chanom.png','',7,192,65,'2023-10-30'),(9,'น้ำลิ้นจี่','ลิ้นจี่.png','',8,97,80,'2023-10-30'),(10,'น้ำสตอเบอรี่ปั่น','สตอเบอร์รี่ปั่น.png','',8,95,80,'2023-10-30'),(13,'ชามะนาว','ชามะนาว.png','ชามะนาว',7,149,60,'2023-10-31');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-01 13:52:29
