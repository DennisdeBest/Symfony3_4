-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: symfony
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76D17F50A6` (`uuid`),
  CONSTRAINT `FK_880E0D76BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (127,'2017-11-07 15:32:00','2017-11-07 15:32:00','6f59d8fa-155d-4c44-830f-c68cfcd6e7be');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isEnabled` tinyint(1) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B8EE3872D17F50A6` (`uuid`),
  KEY `IDX_B8EE38729395C3F3` (`customer_id`),
  CONSTRAINT `FK_B8EE38729395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `isEnabled` tinyint(1) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81398E09D17F50A6` (`uuid`),
  CONSTRAINT `FK_81398E09BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (128,'John','Doe','2017-11-07 15:32:00','2017-11-07 15:32:00','b68bc2a0-1383-4e38-bc48-672e79c2fd98',1,'Troll Burger, Via di Val Favara, Rome, Metropolitan City of Rome, Italy','ChIJ6zcUBzheLxMRnH6uFN2zqKw'),(129,'Stéphanie','Weber','2017-11-07 15:32:00','2017-11-07 15:32:00','d44ebe1c-e0cd-4f5b-9729-62d5578fdb59',1,NULL,NULL),(130,'Chantal','Rousseau','2017-11-07 15:32:00','2017-11-07 15:32:00','d67827f7-98a3-4c2f-8907-9ededc4d99fb',1,NULL,NULL),(131,'Claire','Renard','2017-11-07 15:32:00','2017-11-07 15:32:00','3a199e65-e91d-4ad0-b58e-c0362b262090',1,NULL,NULL),(132,'Arthur','Schmitt','2017-11-07 15:32:00','2017-11-07 15:32:00','585f3739-df06-4f69-8632-f48db0670c6f',1,NULL,NULL),(133,'Laure','Nguyen','2017-11-07 15:32:00','2017-11-07 15:32:00','c3310edb-272d-474e-829e-540e50f0bd94',1,NULL,NULL),(134,'Sébastien','Jacques','2017-11-07 15:32:00','2017-11-07 15:32:00','4746d162-33a6-406e-82b4-89e0bf87c4d9',1,NULL,NULL),(135,'Marc','Joseph','2017-11-07 15:32:00','2017-11-07 15:32:00','f2528ce9-b3b1-4d62-856f-5cae659bc890',1,NULL,NULL),(136,'Margot','Descamps','2017-11-07 15:32:00','2017-11-07 15:32:00','baa15290-6aa9-41ed-ab10-7628144d66df',1,NULL,NULL),(137,'Sébastien','Didier','2017-11-07 15:32:00','2017-11-07 15:32:00','4e0ce492-9632-4095-84fa-5401aa6ffa19',1,NULL,NULL),(138,'Adrien','Dias','2017-11-07 15:32:00','2017-11-07 15:32:00','a98e27bc-7a35-4828-a592-29ee8e1ca4f0',1,NULL,NULL),(139,'Aimée','Boulay','2017-11-07 15:32:00','2017-11-07 15:32:00','77243cc7-2b42-4e93-9ee5-e8819c30b23c',1,NULL,NULL);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (127,'admin','admin','admin','admin@symfony.com','admin@symfony.com',1,'KH9I4E8VF7BuFrp18i8KxF.oLRyyy9yOTmbAe/YJfjc','IbQh96AmhHK45gLOXuJrgJhDQJhzgN8HSmV9TJ+D7cm1bcJzy2/ZV920YzX+yDY/1QbHyZHV/ycvY8sCVXbVwQ==',NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}'),(128,'customer','customer@symfony.com','customer@symfony.com','customer@symfony.com','customer@symfony.com',0,'ahF5wsB/t6jN499c0I57y.MMJk2W5HrGMlyUFFHOpSs','LG0jMsBoh2Ral7JsTylUje89bI4t1XzqbaPdcP9uviVjeou2+LPZX7khPJcZ8a3DwJnqBvKQHWqogvLGwUFaLw==',NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),(129,'customer','dlemaitre@rodriguez.net','dlemaitre@rodriguez.net','dlemaitre@rodriguez.net','dlemaitre@rodriguez.net',0,'TxDYr.URP4aJMui1UEqjxkL1DMCc6EmNZpKqmmznJxc','6W9pl01rucj9hMhqhHayMJOWJXogALiXtMavmKSXT5Z3qR9o/Tr0fnT3zQzoH8TpCNKcvbny02/+TLmzjFgwuA==',NULL,NULL,NULL,'a:0:{}'),(130,'customer','couturier.roger@colin.fr','couturier.roger@colin.fr','couturier.roger@colin.fr','couturier.roger@colin.fr',0,'hj/YD2eOLMUSCnBtq0/1juCIOKMYnM/Et5UNF7Ro6qE','7k0xZawE0xqVHzUajyoh90zy2iWEASFZaP2dSpXg4RnCW1iXbU5f+Q9rCrOIq3LAkbEeQvXMHnXIyJuH+jRNKQ==',NULL,NULL,NULL,'a:0:{}'),(131,'customer','sylvie60@brun.fr','sylvie60@brun.fr','sylvie60@brun.fr','sylvie60@brun.fr',0,'1PsA8qbWFivzB.cAtBeBe7BWSLDp1XgoacrpdPQUDpo','+9JL8W7qBS4WyzkBTHlKhOr//6vSJgPzKV1ZVRYhiTUtR74l3XoxrMMTTjsUnhbAB9hPFJ9BZxuRu00BiDsprw==',NULL,NULL,NULL,'a:0:{}'),(132,'customer','leon23@dbmail.com','leon23@dbmail.com','leon23@dbmail.com','leon23@dbmail.com',0,'BgY5CalxpuQ2PmqLyHecUxL4ALrwwwK.OZTP4UrhAwg','bKQf8LrmyoU+VPGXNfbIp9pOSUrRo/Lv5AOnTROfExcbkKQzF77wqE9DVQgeVGCR4ZeqVpJ3LmLP001f5sdAUQ==',NULL,NULL,NULL,'a:0:{}'),(133,'customer','grondin.guillaume@pasquier.fr','grondin.guillaume@pasquier.fr','grondin.guillaume@pasquier.fr','grondin.guillaume@pasquier.fr',0,'uuBtRU1q6lBl.i7x8Jd7KIZYuMHfEv79z1NX/KN2SH4','R4nRbi9P6t/9E257Ql658StcSeN44PIz5T1nFgvPJLNgut4bQVYq8iRL0VhzvcmWdtlBkxU9zXDVmqh5WwaEpQ==',NULL,NULL,NULL,'a:0:{}'),(134,'customer','brigitte59@yahoo.fr','brigitte59@yahoo.fr','brigitte59@yahoo.fr','brigitte59@yahoo.fr',0,'reCOQHBDgljXPM.QpOaefzmBr5pg2BRD4tFeKZm9Ey8','m4dLSvpeyEdMJrbILjDRhhbLLgwnOwCB4oWdLSMZJtmJTW+9NojXqLiymh2yQH07x41vWWO7rBc6fLhmZ5BjZA==',NULL,NULL,NULL,'a:0:{}'),(135,'customer','sdevaux@perrier.com','sdevaux@perrier.com','sdevaux@perrier.com','sdevaux@perrier.com',0,'QHntvtrcTwQtsOjsgMhnZeU.p/rj7x269ckOcHj4P.o','b1pAhGU6ABfGRXMwiualL3mR4wEL4fX1+EjRNMEO+CJdAuIGwZkGFbfvMYaenz3Jxh328sYs/bdBtrEHALvtUQ==',NULL,NULL,NULL,'a:0:{}'),(136,'customer','gguillon@robert.com','gguillon@robert.com','gguillon@robert.com','gguillon@robert.com',0,'nDXX1GPPJ/DFPD.KpOPWAygHV/RGsjZ8oRfBL83CY7k','1HoOC9z1OfnGFY01BWhWS2I+yvVCI6+crK80jhJWA5Dy/ymozYz7NKNBLFZbd0uoml0RatuZS+GXgUqzWJaxJQ==',NULL,NULL,NULL,'a:0:{}'),(137,'customer','chretien.benjamin@gosselin.fr','chretien.benjamin@gosselin.fr','chretien.benjamin@gosselin.fr','chretien.benjamin@gosselin.fr',0,'CCsB2CSBdxrVVqHljKnO/QDGiWMAVE4t0VOp6QoYriY','FPQvX5JTX278Ai/nrrBQlTi0zMPAkqQBR6sCXt3yIQHnWxdmJhvCr1LdLDyK7YEegS4PKF3yhzdXrYr6GBQ+eQ==',NULL,NULL,NULL,'a:0:{}'),(138,'customer','luce.marion@gmail.com','luce.marion@gmail.com','luce.marion@gmail.com','luce.marion@gmail.com',0,'eJuEHeIJFfDhVfBuDCxyKiFdIEPDm7PfiZMu4CIab5I','YWTAiPWcPN+HnNw77OVcfqaTSRE+acCvsbRPUUTNw1EHoxb191JYSJlnY2Lp2SGxMJ/Elmio+OaYMKhmfQSFeA==',NULL,NULL,NULL,'a:0:{}'),(139,'customer','guyot.thibaut@guillou.fr','guyot.thibaut@guillou.fr','guyot.thibaut@guillou.fr','guyot.thibaut@guillou.fr',0,'0n5Hjazo2x/MGJldO3l23qZR1RygC.mpJ47Q32KNVZ8','arx1sKHlkMz2TBmKEOFID8ht0wcuuKXrAssEqzzv9+A9AghoM1ShcwwLzw6dy0YIH9MRHJaWEe3u+Lk1l75MEQ==',NULL,NULL,NULL,'a:0:{}');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-07 15:53:03
