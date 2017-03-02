-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: yii-basic
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1487929467,1487929467),('/admin/*',2,NULL,NULL,NULL,1487929467,1487929467),('/admon/',2,NULL,NULL,NULL,NULL,NULL),('/admon/*',2,NULL,NULL,NULL,1487929467,1487929467),('/site/*',2,NULL,NULL,NULL,1487937905,1487937905),('/site/about/',2,NULL,NULL,NULL,1487953898,1487953898),('/site/contact/',2,NULL,NULL,NULL,1487953912,1487953912),('/site/index',2,NULL,NULL,NULL,1487929467,1487929467),('/user/login/',2,NULL,NULL,NULL,1487953927,1487953927),('/user/register/',2,NULL,NULL,NULL,1487953938,1487953938),('admin',1,'Administrador',NULL,NULL,1487929081,1487929081),('createPost',2,'Create a post',NULL,NULL,1488010451,1488010451),('invitado',1,'invitado',NULL,NULL,1487937874,1487937874),('permisos_admin',2,'permisos_admin',NULL,NULL,1487934160,1487934526),('permisos_invitado',2,'permisos_invitado',NULL,NULL,1487937939,1487937939),('permisos_premium',2,'permisos_premium',NULL,NULL,1488008389,1488008389),('permisos_usuario',2,'permisos_usuario',NULL,NULL,1487934555,1487934555),('updateOwnPost',2,'Update own post','isAuthor',NULL,1488010920,1488010920),('updatePost',2,'Update post',NULL,NULL,1488010451,1488010451),('usuario',1,'Usuario normal',NULL,NULL,1487929467,1487930802),('usuario_premium',1,'usuario_premium',NULL,NULL,1488008442,1488010053);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-25  9:53:19
