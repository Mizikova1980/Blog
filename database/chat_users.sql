-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: chat
-- ------------------------------------------------------
-- Server version	5.7.33-log

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'Dasha','123@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 19:06:30',NULL),(237,'Dasha','183@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 20:23:44',NULL),(277,'Vaniz','1834@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 20:28:08',NULL),(278,'Sasha','mail@mail.ru','7373cfd9425c55f038ccbf8774777eb519cf3943','2023-03-24 20:30:11',NULL),(309,'Dima','789@mail.ru','7373cfd9425c55f038ccbf8774777eb519cf3943','2023-03-24 20:32:00',NULL),(340,'Pasha','123456@mail.ru','7373cfd9425c55f038ccbf8774777eb519cf3943','2023-03-24 20:40:15',NULL),(341,'Yulia','123456@gmail.ru','7373cfd9425c55f038ccbf8774777eb519cf3943','2023-03-24 20:46:34',NULL),(342,'Юлия','sdfcsaf@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 22:59:06',NULL),(343,'Иван Иванович Иванови','mail123456@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 23:23:33',NULL),(344,'Юлия','gal123@bk.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-24 23:24:54',NULL),(345,'lkjdlkjwsd','ksjdhkjw@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-03-27 22:25:08',NULL),(346,'Иван Иванович Иванови','mail98795465464@mail.ru','86ef1d4b9541fb7266a4781d01c813d67f0a005f','2023-03-31 22:34:31',NULL),(347,'Yuliya Mizikova','galashina@bk.ru','86ef1d4b9541fb7266a4781d01c813d67f0a005f','2023-04-01 17:23:28',NULL),(348,'Юлия Евгеньевна','galashina123@bk.ru','86ef1d4b9541fb7266a4781d01c813d67f0a005f','2023-04-02 15:24:42',NULL),(349,'Иван','456456mail@mail.ru','86ef1d4b9541fb7266a4781d01c813d67f0a005f','2023-04-02 15:27:36',NULL),(350,'Юрий Яковлевич','ggalashina123456789@bk.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 15:29:33',NULL),(351,'Юлия Мизикова','456756789galashina@bk.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 19:39:33','1c73e9d0ec9f9b15272c33ac1ed20358c6d3a3a3.jpg'),(353,'Yuliya 123','galashina789@bk.ru','86ef1d4b9541fb7266a4781d01c813d67f0a005f','2023-04-02 19:38:54','bbccf317a737c2c12ea391f1855d14609b62a338.jpg'),(354,'Mizikova MIzikova','123456789987654321@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 19:36:58','554c517b6c8f6df3b0084c3343d9fc28c41a0a03.jpg'),(355,'Yuliya Mizikova','123456789ghj@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 17:02:56','c2bfdecb260cc368dfc1f3cce807f6a4d8394e4b.jpg'),(357,'Вася','ksdkfjshdkf@mail.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 17:08:31','909f692fa053e1287e089280b172833fa0577add.jpg'),(359,'Yuliya Mizikova 123','ksdfkswhfhklhsklfdh@kjsdfh.ru','62ce9d7e690bd0094b0600a13d6a715b48a37e55','2023-04-02 19:40:09','dd9da665098ed69ffa5b50e2f39add8a430c7024.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-02 19:41:02
