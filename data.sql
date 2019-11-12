-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: qapps
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.19.04.1

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
-- Table structure for table `additional_attachments`
--

DROP TABLE IF EXISTS `additional_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `additional_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `name_attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional_attachments`
--

LOCK TABLES `additional_attachments` WRITE;
/*!40000 ALTER TABLE `additional_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `additional_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_authorized_personels`
--

DROP TABLE IF EXISTS `aircraft_authorized_personels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_authorized_personels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amel_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ex_date_ame` date DEFAULT NULL,
  `gmf_auth_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ex_date_company` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `license_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amel_scope` json DEFAULT NULL,
  `gmf_scope` json DEFAULT NULL,
  `stamp_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_authorized_personels`
--

LOCK TABLES `aircraft_authorized_personels` WRITE;
/*!40000 ALTER TABLE `aircraft_authorized_personels` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_authorized_personels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_documents`
--

DROP TABLE IF EXISTS `aircraft_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `document_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_document` text COLLATE utf8mb4_unicode_ci,
  `manufacture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effective_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_documents`
--

LOCK TABLES `aircraft_documents` WRITE;
/*!40000 ALTER TABLE `aircraft_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_facilities`
--

DROP TABLE IF EXISTS `aircraft_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `description_main` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_facilities`
--

LOCK TABLES `aircraft_facilities` WRITE;
/*!40000 ALTER TABLE `aircraft_facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_materials`
--

DROP TABLE IF EXISTS `aircraft_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `description_material` text COLLATE utf8mb4_unicode_ci,
  `pn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `camp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobcard_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpd_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_materials`
--

LOCK TABLES `aircraft_materials` WRITE;
/*!40000 ALTER TABLE `aircraft_materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_requests`
--

DROP TABLE IF EXISTS `aircraft_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_submittion_id` int(11) NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_area_value` text COLLATE utf8mb4_unicode_ci,
  `ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ability_other_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facilities` tinyint(1) DEFAULT NULL,
  `certifying_staff` tinyint(1) DEFAULT NULL,
  `approved_data` tinyint(1) DEFAULT NULL,
  `qualified_personel` tinyint(1) DEFAULT NULL,
  `special_tools` tinyint(1) DEFAULT NULL,
  `consumable` tinyint(1) DEFAULT NULL,
  `other_main_value` tinyint(1) DEFAULT NULL,
  `limitation` text COLLATE utf8mb4_unicode_ci,
  `special_work` text COLLATE utf8mb4_unicode_ci,
  `engine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_requests`
--

LOCK TABLES `aircraft_requests` WRITE;
/*!40000 ALTER TABLE `aircraft_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_tool_equipments`
--

DROP TABLE IF EXISTS `aircraft_tool_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_tool_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `description_tools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `camp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobcard_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpd_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_tool_equipments`
--

LOCK TABLES `aircraft_tool_equipments` WRITE;
/*!40000 ALTER TABLE `aircraft_tool_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `aircraft_tool_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aircraft_types`
--

DROP TABLE IF EXISTS `aircraft_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aircraft_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `engine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aircraft_types`
--

LOCK TABLES `aircraft_types` WRITE;
/*!40000 ALTER TABLE `aircraft_types` DISABLE KEYS */;
INSERT INTO `aircraft_types` VALUES (1,'A320-100','AIRBUS',NULL,'2019-08-12 09:28:51',NULL,NULL,NULL),(2,'A320-200','AIRBUS',NULL,'2019-08-12 09:28:40',NULL,NULL,NULL),(3,'A330-200','AIRBUS',NULL,'2019-08-12 09:28:32',NULL,NULL,NULL),(4,'A330-300','AIRBUS',NULL,'2019-08-12 09:28:16',NULL,NULL,NULL),(5,'A330-900','AIRBUS',NULL,'2019-08-12 09:28:25',NULL,NULL,NULL),(6,'B737-200/300/400/500','BOEING',NULL,'2019-08-16 10:39:08',NULL,NULL,'CFM56-3'),(7,'737-300M3','BOEING',NULL,'2019-08-12 09:30:13','2019-08-12 09:30:13',NULL,NULL),(8,'737-3M3-SJ','BOEING',NULL,'2019-08-12 09:30:17','2019-08-12 09:30:17',NULL,NULL),(9,'737-400','BOEING',NULL,'2019-08-12 09:30:22','2019-08-12 09:30:22',NULL,NULL),(10,'737-500','BOEING',NULL,'2019-08-12 09:30:25','2019-08-12 09:30:25',NULL,NULL),(11,'737-5M3-IN','BOEING',NULL,'2019-08-12 09:30:29','2019-08-12 09:30:29',NULL,NULL),(12,'737-5M3-SJ','BOEING',NULL,'2019-08-12 09:30:41','2019-08-12 09:30:41',NULL,NULL),(13,'737-600','BOEING',NULL,'2019-08-16 10:38:35','2019-08-16 10:38:35',NULL,NULL),(14,'737-700','BOEING',NULL,'2019-08-16 10:38:38','2019-08-16 10:38:38',NULL,NULL),(15,'737-800','BOEING',NULL,NULL,NULL,NULL,NULL),(16,'737-800-SJ','BOEING',NULL,'2019-08-16 10:38:27','2019-08-16 10:38:27',NULL,NULL),(17,'737-900','BOEING',NULL,NULL,NULL,NULL,NULL),(18,'737-900-SJ','BOEING',NULL,NULL,NULL,NULL,NULL),(19,'737-MAX','BOEING',NULL,NULL,NULL,NULL,NULL),(20,'B737-6/7/8/9','BOEING',NULL,'2019-08-12 09:31:45',NULL,NULL,NULL),(21,'B747-200','BOEING',NULL,'2019-08-12 09:30:54',NULL,NULL,NULL),(22,'747-300','BOEING',NULL,NULL,NULL,NULL,NULL),(23,'747-400','BOEING',NULL,NULL,NULL,NULL,NULL),(24,'B777-300ER','BOEING',NULL,'2019-08-16 10:37:54',NULL,NULL,'GE90'),(25,'A310','AIRBUS',NULL,'2019-08-16 10:36:12','2019-08-16 10:36:12',NULL,NULL),(26,'A318','AIRBUS',NULL,'2019-08-16 10:36:15','2019-08-16 10:36:15',NULL,NULL),(27,'A319','AIRBUS',NULL,'2019-08-16 10:36:08','2019-08-16 10:36:08',NULL,NULL),(28,'B727','BOEING',NULL,'2019-08-16 10:36:21','2019-08-16 10:36:21',NULL,NULL),(29,'MD-11','BOEING',NULL,NULL,NULL,NULL,NULL),(30,'MD-80','BOEING',NULL,NULL,NULL,NULL,NULL),(31,'ATR72-600','AEREI Da Transporto Regionale','2019-05-14 14:10:28','2019-08-16 10:35:54',NULL,1,'PW-100 Series'),(32,'B747-400','BOEING','2019-08-12 09:31:07','2019-08-21 10:24:15',NULL,1,'CF6-80, PW4000, JT9D-7/-59A/-70A'),(33,'A320/A321 Neo','Airbus','2019-08-21 10:04:56','2019-08-21 10:18:53',NULL,1,'PW1100G, CFM LEAP 1A'),(34,'A320-271N','Airbus','2019-08-21 10:05:38','2019-08-21 10:05:38',NULL,1,'PW1100G'),(35,'A321-271N','Airbus','2019-08-21 10:06:00','2019-08-21 10:06:14',NULL,1,'PW1100G'),(36,'A320/A321 Neo','Airbus','2019-08-21 10:07:12','2019-08-21 10:18:46','2019-08-21 10:18:46',1,'CFM LEAP 1A'),(37,'A320-251N','Airbus','2019-08-21 10:07:35','2019-08-21 10:07:35',NULL,1,'CFM LEAP-1A26'),(38,'A321-251N','Airbus','2019-08-21 10:08:01','2019-08-21 10:08:01',NULL,1,'CFM LEAP-1A32'),(39,'A321-253N','Airbus','2019-08-21 10:08:34','2019-08-21 10:08:43',NULL,1,'CFM LEAP-1A33'),(40,'CRJ1000','Bombardier','2019-08-21 10:22:31','2019-08-21 10:22:31',NULL,1,'CF34');
/*!40000 ALTER TABLE `aircraft_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apps`
--

DROP TABLE IF EXISTS `apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_box` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apps`
--

LOCK TABLES `apps` WRITE;
/*!40000 ALTER TABLE `apps` DISABLE KEYS */;
INSERT INTO `apps` VALUES (1,'GMF AEROASIA','gmf.png','1569385886background.jpg','Soekarno Hatta International Airport','Cengkareng','Indonesia','1303','19100','+62 21 550 2489','+62 21 550 8609','marketing@gmf-aeroasia.co.id','2019-05-02 12:05:22','2019-08-14 09:46:30');
/*!40000 ALTER TABLE `apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachment_resubmit_vendors`
--

DROP TABLE IF EXISTS `attachment_resubmit_vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment_resubmit_vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_management_id` int(11) NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment_resubmit_vendors`
--

LOCK TABLES `attachment_resubmit_vendors` WRITE;
/*!40000 ALTER TABLE `attachment_resubmit_vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment_resubmit_vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachment_resubmits`
--

DROP TABLE IF EXISTS `attachment_resubmits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment_resubmits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment_resubmits`
--

LOCK TABLES `attachment_resubmits` WRITE;
/*!40000 ALTER TABLE `attachment_resubmits` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachment_resubmits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capability_lists`
--

DROP TABLE IF EXISTS `capability_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capability_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_capability_list` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `form_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capability_lists`
--

LOCK TABLES `capability_lists` WRITE;
/*!40000 ALTER TABLE `capability_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `capability_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capability_ratings`
--

DROP TABLE IF EXISTS `capability_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capability_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `component_capability_list_id` int(11) NOT NULL,
  `revision` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capability_ratings`
--

LOCK TABLES `capability_ratings` WRITE;
/*!40000 ALTER TABLE `capability_ratings` DISABLE KEYS */;
INSERT INTO `capability_ratings` VALUES (1,1,1,'DGCA RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(2,1,1,'FAA RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(3,1,1,'EASA RATING',' Landing Gear Components','2019-08-02 16:26:53','2019-08-02 16:26:53'),(4,1,1,'CAAM RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(5,2,1,'DGCA RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(6,2,1,'FAA RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(7,2,1,'EASA RATING',' Landing Gear Components','2019-08-02 16:26:53','2019-08-02 16:26:53'),(8,2,1,'CAAM RATING',' Emergency Equipment','2019-08-02 16:26:53','2019-08-02 16:26:53'),(9,3,1,'DGCA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(10,3,1,'FAA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(11,3,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(12,3,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(13,3,1,'CAAC RATING','ATA 23','2019-08-21 14:31:22','2019-08-21 14:31:22'),(14,4,1,'DGCA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(15,4,1,'FAA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(16,4,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(17,4,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(18,4,1,'CAAC RATING','ATA 23','2019-08-21 14:31:22','2019-08-21 14:31:22'),(19,5,1,'DGCA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(20,5,1,'FAA RATING','Radio','2019-08-21 14:31:22','2019-08-21 14:31:22'),(21,5,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(22,5,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:22','2019-08-21 14:31:22'),(23,5,1,'CAAC RATING','ATA 23','2019-08-21 14:31:22','2019-08-21 14:31:22'),(24,6,1,'DGCA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(25,6,1,'FAA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(26,6,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(27,6,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(28,6,1,'CAAC RATING','ATA 22','2019-08-21 14:31:22','2019-08-21 14:31:22'),(29,7,1,'DGCA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(30,7,1,'FAA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(31,7,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(32,7,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(33,7,1,'CAAC RATING','ATA 22','2019-08-21 14:31:22','2019-08-21 14:31:22'),(34,8,1,'DGCA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(35,8,1,'FAA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(36,8,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(37,8,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(38,8,1,'CAAC RATING','ATA 22','2019-08-21 14:31:22','2019-08-21 14:31:22'),(39,9,1,'DGCA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(40,9,1,'FAA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(41,9,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(42,9,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(43,9,1,'CAAC RATING','ATA 22','2019-08-21 14:31:22','2019-08-21 14:31:22'),(44,10,1,'DGCA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(45,10,1,'FAA RATING',' Accessories','2019-08-21 14:31:22','2019-08-21 14:31:22'),(46,10,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(47,10,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:22','2019-08-21 14:31:22'),(48,10,1,'CAAC RATING','ATA 22','2019-08-21 14:31:22','2019-08-21 14:31:22'),(49,11,2,'DGCA RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(50,11,2,'FAA RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(51,11,2,'EASA RATING',' Landing Gear Components','2019-08-21 14:31:48','2019-08-21 14:31:48'),(52,11,2,'CAAM RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(53,12,2,'DGCA RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(54,12,2,'FAA RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(55,12,2,'EASA RATING',' Landing Gear Components','2019-08-21 14:31:48','2019-08-21 14:31:48'),(56,12,2,'CAAM RATING',' Emergency Equipment','2019-08-21 14:31:48','2019-08-21 14:31:48'),(57,13,2,'DGCA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(58,13,2,'FAA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(59,13,2,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(60,13,2,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(61,13,2,'CAAC RATING','ATA 23','2019-08-21 14:31:49','2019-08-21 14:31:49'),(62,14,2,'DGCA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(63,14,2,'FAA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(64,14,2,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(65,14,2,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(66,14,2,'CAAC RATING','ATA 23','2019-08-21 14:31:49','2019-08-21 14:31:49'),(67,15,2,'DGCA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(68,15,2,'FAA RATING','Radio','2019-08-21 14:31:49','2019-08-21 14:31:49'),(69,15,2,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(70,15,2,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:31:49','2019-08-21 14:31:49'),(71,15,2,'CAAC RATING','ATA 23','2019-08-21 14:31:49','2019-08-21 14:31:49'),(72,16,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(73,16,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(74,16,2,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(75,16,2,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(76,16,2,'CAAC RATING','ATA 22','2019-08-21 14:31:49','2019-08-21 14:31:49'),(77,17,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(78,17,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(79,17,2,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(80,17,2,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(81,17,2,'CAAC RATING','ATA 22','2019-08-21 14:31:49','2019-08-21 14:31:49'),(82,18,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(83,18,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(84,18,2,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(85,18,2,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(86,18,2,'CAAC RATING','ATA 22','2019-08-21 14:31:49','2019-08-21 14:31:49'),(87,19,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(88,19,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(89,19,2,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(90,19,2,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(91,19,2,'CAAC RATING','ATA 22','2019-08-21 14:31:49','2019-08-21 14:31:49'),(92,20,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(93,20,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(94,20,2,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(95,20,2,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:31:49','2019-08-21 14:31:49'),(96,20,2,'CAAC RATING','ATA 22','2019-08-21 14:31:49','2019-08-21 14:31:49'),(97,21,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(98,21,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(99,21,2,'EASA RATING','C7 - Engine & APU','2019-08-21 14:31:49','2019-08-21 14:31:49'),(100,21,2,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:31:49','2019-08-21 14:31:49'),(101,22,2,'DGCA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(102,22,2,'FAA RATING',' Accessories','2019-08-21 14:31:49','2019-08-21 14:31:49'),(103,22,2,'EASA RATING','C7 - Engine & APU','2019-08-21 14:31:49','2019-08-21 14:31:49'),(104,22,2,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:31:49','2019-08-21 14:31:49'),(105,23,1,'DGCA RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(106,23,1,'FAA RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(107,23,1,'EASA RATING',' Landing Gear Components','2019-08-21 14:38:20','2019-08-21 14:38:20'),(108,23,1,'CAAM RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(109,24,1,'DGCA RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(110,24,1,'FAA RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(111,24,1,'EASA RATING',' Landing Gear Components','2019-08-21 14:38:20','2019-08-21 14:38:20'),(112,24,1,'CAAM RATING',' Emergency Equipment','2019-08-21 14:38:20','2019-08-21 14:38:20'),(113,25,1,'DGCA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(114,25,1,'FAA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(115,25,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(116,25,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(117,25,1,'CAAC RATING','ATA 23','2019-08-21 14:38:20','2019-08-21 14:38:20'),(118,26,1,'DGCA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(119,26,1,'FAA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(120,26,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(121,26,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(122,26,1,'CAAC RATING','ATA 23','2019-08-21 14:38:20','2019-08-21 14:38:20'),(123,27,1,'DGCA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(124,27,1,'FAA RATING','Radio','2019-08-21 14:38:20','2019-08-21 14:38:20'),(125,27,1,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(126,27,1,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:38:20','2019-08-21 14:38:20'),(127,27,1,'CAAC RATING','ATA 23','2019-08-21 14:38:20','2019-08-21 14:38:20'),(128,28,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(129,28,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(130,28,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(131,28,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(132,28,1,'CAAC RATING','ATA 22','2019-08-21 14:38:20','2019-08-21 14:38:20'),(133,29,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(134,29,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(135,29,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(136,29,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(137,29,1,'CAAC RATING','ATA 22','2019-08-21 14:38:20','2019-08-21 14:38:20'),(138,30,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(139,30,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(140,30,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(141,30,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(142,30,1,'CAAC RATING','ATA 22','2019-08-21 14:38:20','2019-08-21 14:38:20'),(143,31,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(144,31,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(145,31,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(146,31,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(147,31,1,'CAAC RATING','ATA 22','2019-08-21 14:38:20','2019-08-21 14:38:20'),(148,32,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(149,32,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(150,32,1,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(151,32,1,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:38:20','2019-08-21 14:38:20'),(152,32,1,'CAAC RATING','ATA 22','2019-08-21 14:38:20','2019-08-21 14:38:20'),(153,33,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(154,33,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(155,33,1,'EASA RATING','C7 - Engine & APU','2019-08-21 14:38:20','2019-08-21 14:38:20'),(156,33,1,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:38:20','2019-08-21 14:38:20'),(157,34,1,'DGCA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(158,34,1,'FAA RATING',' Accessories','2019-08-21 14:38:20','2019-08-21 14:38:20'),(159,34,1,'EASA RATING','C7 - Engine & APU','2019-08-21 14:38:20','2019-08-21 14:38:20'),(160,34,1,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:38:20','2019-08-21 14:38:20'),(161,35,3,'DGCA RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(162,35,3,'FAA RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(163,35,3,'EASA RATING',' Landing Gear Components','2019-08-21 14:42:08','2019-08-21 14:42:08'),(164,35,3,'CAAM RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(165,36,3,'DGCA RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(166,36,3,'FAA RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(167,36,3,'EASA RATING',' Landing Gear Components','2019-08-21 14:42:08','2019-08-21 14:42:08'),(168,36,3,'CAAM RATING',' Emergency Equipment','2019-08-21 14:42:08','2019-08-21 14:42:08'),(169,37,3,'DGCA RATING','Radio','2019-08-21 14:42:08','2019-08-21 14:42:08'),(170,37,3,'FAA RATING','Radio','2019-08-21 14:42:08','2019-08-21 14:42:08'),(171,37,3,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:08','2019-08-21 14:42:08'),(172,37,3,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:08','2019-08-21 14:42:08'),(173,37,3,'CAAC RATING','ATA 23','2019-08-21 14:42:08','2019-08-21 14:42:08'),(174,38,3,'DGCA RATING','Radio','2019-08-21 14:42:08','2019-08-21 14:42:08'),(175,38,3,'FAA RATING','Radio','2019-08-21 14:42:08','2019-08-21 14:42:08'),(176,38,3,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:08','2019-08-21 14:42:08'),(177,38,3,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:08','2019-08-21 14:42:08'),(178,38,3,'CAAC RATING','ATA 23','2019-08-21 14:42:08','2019-08-21 14:42:08'),(179,39,3,'DGCA RATING','Radio','2019-08-21 14:42:09','2019-08-21 14:42:09'),(180,39,3,'FAA RATING','Radio','2019-08-21 14:42:09','2019-08-21 14:42:09'),(181,39,3,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:09','2019-08-21 14:42:09'),(182,39,3,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:42:09','2019-08-21 14:42:09'),(183,39,3,'CAAC RATING','ATA 23','2019-08-21 14:42:09','2019-08-21 14:42:09'),(184,40,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(185,40,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(186,40,3,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(187,40,3,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(188,40,3,'CAAC RATING','ATA 22','2019-08-21 14:42:09','2019-08-21 14:42:09'),(189,41,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(190,41,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(191,41,3,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(192,41,3,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(193,41,3,'CAAC RATING','ATA 22','2019-08-21 14:42:09','2019-08-21 14:42:09'),(194,42,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(195,42,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(196,42,3,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(197,42,3,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(198,42,3,'CAAC RATING','ATA 22','2019-08-21 14:42:09','2019-08-21 14:42:09'),(199,43,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(200,43,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(201,43,3,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(202,43,3,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(203,43,3,'CAAC RATING','ATA 22','2019-08-21 14:42:09','2019-08-21 14:42:09'),(204,44,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(205,44,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(206,44,3,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(207,44,3,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:42:09','2019-08-21 14:42:09'),(208,44,3,'CAAC RATING','ATA 22','2019-08-21 14:42:09','2019-08-21 14:42:09'),(209,45,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(210,45,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(211,45,3,'EASA RATING','C7 - Engine & APU','2019-08-21 14:42:09','2019-08-21 14:42:09'),(212,45,3,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:42:09','2019-08-21 14:42:09'),(213,46,3,'DGCA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(214,46,3,'FAA RATING',' Accessories','2019-08-21 14:42:09','2019-08-21 14:42:09'),(215,46,3,'EASA RATING','C7 - Engine & APU','2019-08-21 14:42:09','2019-08-21 14:42:09'),(216,46,3,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:42:09','2019-08-21 14:42:09'),(217,47,4,'DGCA RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(218,47,4,'FAA RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(219,47,4,'EASA RATING',' Landing Gear Components','2019-08-21 14:45:53','2019-08-21 14:45:53'),(220,47,4,'CAAM RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(221,48,4,'DGCA RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(222,48,4,'FAA RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(223,48,4,'EASA RATING',' Landing Gear Components','2019-08-21 14:45:53','2019-08-21 14:45:53'),(224,48,4,'CAAM RATING',' Emergency Equipment','2019-08-21 14:45:53','2019-08-21 14:45:53'),(225,49,4,'DGCA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(226,49,4,'FAA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(227,49,4,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(228,49,4,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(229,49,4,'CAAC RATING','ATA 23','2019-08-21 14:45:53','2019-08-21 14:45:53'),(230,50,4,'DGCA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(231,50,4,'FAA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(232,50,4,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(233,50,4,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(234,50,4,'CAAC RATING','ATA 23','2019-08-21 14:45:53','2019-08-21 14:45:53'),(235,51,4,'DGCA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(236,51,4,'FAA RATING','Radio','2019-08-21 14:45:53','2019-08-21 14:45:53'),(237,51,4,'EASA RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(238,51,4,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-21 14:45:53','2019-08-21 14:45:53'),(239,51,4,'CAAC RATING','ATA 23','2019-08-21 14:45:53','2019-08-21 14:45:53'),(240,52,4,'DGCA RATING',' Accessories','2019-08-21 14:45:53','2019-08-21 14:45:53'),(241,52,4,'FAA RATING',' Accessories','2019-08-21 14:45:53','2019-08-21 14:45:53'),(242,52,4,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:53','2019-08-21 14:45:53'),(243,52,4,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:53','2019-08-21 14:45:53'),(244,52,4,'CAAC RATING','ATA 22','2019-08-21 14:45:53','2019-08-21 14:45:53'),(245,53,4,'DGCA RATING',' Accessories','2019-08-21 14:45:53','2019-08-21 14:45:53'),(246,53,4,'FAA RATING',' Accessories','2019-08-21 14:45:53','2019-08-21 14:45:53'),(247,53,4,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:53','2019-08-21 14:45:53'),(248,53,4,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:53','2019-08-21 14:45:53'),(249,53,4,'CAAC RATING','ATA 22','2019-08-21 14:45:53','2019-08-21 14:45:53'),(250,54,4,'DGCA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(251,54,4,'FAA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(252,54,4,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(253,54,4,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(254,54,4,'CAAC RATING','ATA 22','2019-08-21 14:45:54','2019-08-21 14:45:54'),(255,55,4,'DGCA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(256,55,4,'FAA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(257,55,4,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(258,55,4,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(259,55,4,'CAAC RATING','ATA 22','2019-08-21 14:45:54','2019-08-21 14:45:54'),(260,56,4,'DGCA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(261,56,4,'FAA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(262,56,4,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(263,56,4,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-21 14:45:54','2019-08-21 14:45:54'),(264,56,4,'CAAC RATING','ATA 22','2019-08-21 14:45:54','2019-08-21 14:45:54'),(265,57,4,'DGCA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(266,57,4,'FAA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(267,57,4,'EASA RATING','C7 - Engine & APU','2019-08-21 14:45:54','2019-08-21 14:45:54'),(268,57,4,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:45:54','2019-08-21 14:45:54'),(269,58,4,'DGCA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(270,58,4,'FAA RATING',' Accessories','2019-08-21 14:45:54','2019-08-21 14:45:54'),(271,58,4,'EASA RATING','C7 - Engine & APU','2019-08-21 14:45:54','2019-08-21 14:45:54'),(272,58,4,'CAAM RATING','C7 - Engine & APU','2019-08-21 14:45:54','2019-08-21 14:45:54'),(273,59,5,'DGCA RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(274,59,5,'FAA RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(275,59,5,'EASA RATING',' Landing Gear Components','2019-08-22 16:46:04','2019-08-22 16:46:04'),(276,59,5,'CAAM RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(277,60,5,'DGCA RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(278,60,5,'FAA RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(279,60,5,'EASA RATING',' Landing Gear Components','2019-08-22 16:46:04','2019-08-22 16:46:04'),(280,60,5,'CAAM RATING',' Emergency Equipment','2019-08-22 16:46:04','2019-08-22 16:46:04'),(281,61,5,'DGCA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(282,61,5,'FAA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(283,61,5,'EASA RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(284,61,5,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(285,61,5,'CAAC RATING','ATA 23','2019-08-22 16:46:04','2019-08-22 16:46:04'),(286,62,5,'DGCA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(287,62,5,'FAA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(288,62,5,'EASA RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(289,62,5,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(290,62,5,'CAAC RATING','ATA 23','2019-08-22 16:46:04','2019-08-22 16:46:04'),(291,63,5,'DGCA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(292,63,5,'FAA RATING','Radio','2019-08-22 16:46:04','2019-08-22 16:46:04'),(293,63,5,'EASA RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(294,63,5,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-22 16:46:04','2019-08-22 16:46:04'),(295,63,5,'CAAC RATING','ATA 23','2019-08-22 16:46:04','2019-08-22 16:46:04'),(296,64,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(297,64,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(298,64,5,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(299,64,5,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(300,64,5,'CAAC RATING','ATA 22','2019-08-22 16:46:04','2019-08-22 16:46:04'),(301,65,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(302,65,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(303,65,5,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(304,65,5,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(305,65,5,'CAAC RATING','ATA 22','2019-08-22 16:46:04','2019-08-22 16:46:04'),(306,66,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(307,66,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(308,66,5,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(309,66,5,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(310,66,5,'CAAC RATING','ATA 22','2019-08-22 16:46:04','2019-08-22 16:46:04'),(311,67,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(312,67,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(313,67,5,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(314,67,5,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(315,67,5,'CAAC RATING','ATA 22','2019-08-22 16:46:04','2019-08-22 16:46:04'),(316,68,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(317,68,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(318,68,5,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(319,68,5,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-22 16:46:04','2019-08-22 16:46:04'),(320,68,5,'CAAC RATING','ATA 22','2019-08-22 16:46:04','2019-08-22 16:46:04'),(321,69,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(322,69,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(323,69,5,'EASA RATING','C7 - Engine & APU','2019-08-22 16:46:04','2019-08-22 16:46:04'),(324,69,5,'CAAM RATING','C7 - Engine & APU','2019-08-22 16:46:04','2019-08-22 16:46:04'),(325,70,5,'DGCA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(326,70,5,'FAA RATING',' Accessories','2019-08-22 16:46:04','2019-08-22 16:46:04'),(327,70,5,'EASA RATING','C7 - Engine & APU','2019-08-22 16:46:04','2019-08-22 16:46:04'),(328,70,5,'CAAM RATING','C7 - Engine & APU','2019-08-22 16:46:04','2019-08-22 16:46:04'),(329,71,6,'DGCA RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(330,71,6,'FAA RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(331,71,6,'EASA RATING',' Landing Gear Components','2019-08-23 15:39:49','2019-08-23 15:39:49'),(332,71,6,'CAAM RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(333,72,6,'DGCA RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(334,72,6,'FAA RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(335,72,6,'EASA RATING',' Landing Gear Components','2019-08-23 15:39:49','2019-08-23 15:39:49'),(336,72,6,'CAAM RATING',' Emergency Equipment','2019-08-23 15:39:49','2019-08-23 15:39:49'),(337,73,6,'DGCA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(338,73,6,'FAA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(339,73,6,'EASA RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(340,73,6,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(341,73,6,'CAAC RATING','ATA 23','2019-08-23 15:39:49','2019-08-23 15:39:49'),(342,74,6,'DGCA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(343,74,6,'FAA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(344,74,6,'EASA RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(345,74,6,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(346,74,6,'CAAC RATING','ATA 23','2019-08-23 15:39:49','2019-08-23 15:39:49'),(347,75,6,'DGCA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(348,75,6,'FAA RATING','Radio','2019-08-23 15:39:49','2019-08-23 15:39:49'),(349,75,6,'EASA RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(350,75,6,'CAAM RATING','C5 - Electrical Power & Lights','2019-08-23 15:39:49','2019-08-23 15:39:49'),(351,75,6,'CAAC RATING','ATA 23','2019-08-23 15:39:49','2019-08-23 15:39:49'),(352,76,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(353,76,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(354,76,6,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(355,76,6,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(356,76,6,'CAAC RATING','ATA 22','2019-08-23 15:39:49','2019-08-23 15:39:49'),(357,77,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(358,77,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(359,77,6,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(360,77,6,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(361,77,6,'CAAC RATING','ATA 22','2019-08-23 15:39:49','2019-08-23 15:39:49'),(362,78,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(363,78,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(364,78,6,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(365,78,6,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(366,78,6,'CAAC RATING','ATA 22','2019-08-23 15:39:49','2019-08-23 15:39:49'),(367,79,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(368,79,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(369,79,6,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(370,79,6,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(371,79,6,'CAAC RATING','ATA 22','2019-08-23 15:39:49','2019-08-23 15:39:49'),(372,80,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(373,80,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(374,80,6,'EASA RATING','C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(375,80,6,'CAAM RATING',' C18 - Protection Ice/Rain/Fire','2019-08-23 15:39:49','2019-08-23 15:39:49'),(376,80,6,'CAAC RATING','ATA 22','2019-08-23 15:39:49','2019-08-23 15:39:49'),(377,81,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(378,81,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(379,81,6,'EASA RATING','C7 - Engine & APU','2019-08-23 15:39:49','2019-08-23 15:39:49'),(380,81,6,'CAAM RATING','C7 - Engine & APU','2019-08-23 15:39:49','2019-08-23 15:39:49'),(381,82,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(382,82,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(383,82,6,'EASA RATING','C7 - Engine & APU','2019-08-23 15:39:49','2019-08-23 15:39:49'),(384,82,6,'CAAM RATING','C7 - Engine & APU','2019-08-23 15:39:49','2019-08-23 15:39:49'),(385,83,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(386,83,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(387,84,6,'DGCA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49'),(388,84,6,'FAA RATING',' Accessories','2019-08-23 15:39:49','2019-08-23 15:39:49');
/*!40000 ALTER TABLE `capability_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_attachments`
--

DROP TABLE IF EXISTS `component_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `manual_status_confirmation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_maintenance_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_pd_sheet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_statement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simple_component_evaluation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_similarity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_record` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_component_relase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_attachments`
--

LOCK TABLES `component_attachments` WRITE;
/*!40000 ALTER TABLE `component_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_capability_lists`
--

DROP TABLE IF EXISTS `component_capability_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_capability_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `capability_list_id` int(11) DEFAULT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_manufacture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ata_chapter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capability_level` json DEFAULT NULL,
  `workshop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_rating` json DEFAULT NULL,
  `date_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_shop_ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` json DEFAULT NULL,
  `manhours_planning` json DEFAULT NULL,
  `personel` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `technical_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major_equipment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_approve` date DEFAULT NULL,
  `status_of_application` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_capability_lists`
--

LOCK TABLES `component_capability_lists` WRITE;
/*!40000 ALTER TABLE `component_capability_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_capability_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_documents`
--

DROP TABLE IF EXISTS `component_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `no_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_date` date DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_status_confirmation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_maintenance_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_pd_sheet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_documents`
--

LOCK TABLES `component_documents` WRITE;
/*!40000 ALTER TABLE `component_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_equivalents`
--

DROP TABLE IF EXISTS `component_equivalents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_equivalents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `component_test_equipment_id` int(11) NOT NULL,
  `equivalent_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tool_category` json DEFAULT NULL,
  `original_issued` date DEFAULT NULL,
  `rev_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued` date DEFAULT NULL,
  `distribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `efectifity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_issuance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effect_maintenance_procedure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ability` json DEFAULT NULL,
  `reason_of_revision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recomended_tool` json DEFAULT NULL,
  `alternate_tool` json DEFAULT NULL,
  `maintenance_task` json DEFAULT NULL,
  `recomended` json DEFAULT NULL,
  `alternate` json DEFAULT NULL,
  `related_maintenance` json DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_equivalents`
--

LOCK TABLES `component_equivalents` WRITE;
/*!40000 ALTER TABLE `component_equivalents` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_equivalents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_manhours_plannings`
--

DROP TABLE IF EXISTS `component_manhours_plannings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_manhours_plannings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_hour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_power` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_manhours_plannings`
--

LOCK TABLES `component_manhours_plannings` WRITE;
/*!40000 ALTER TABLE `component_manhours_plannings` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_manhours_plannings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_material_plannings`
--

DROP TABLE IF EXISTS `component_material_plannings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_material_plannings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_material_plannings`
--

LOCK TABLES `component_material_plannings` WRITE;
/*!40000 ALTER TABLE `component_material_plannings` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_material_plannings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_personels`
--

DROP TABLE IF EXISTS `component_personels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_personels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_authorization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_competence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_personels`
--

LOCK TABLES `component_personels` WRITE;
/*!40000 ALTER TABLE `component_personels` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_personels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_requests`
--

DROP TABLE IF EXISTS `component_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_submittion_id` int(11) NOT NULL,
  `component_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ata_chapter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workshop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_rating` json DEFAULT NULL,
  `aproval_request_carry_out` json DEFAULT NULL,
  `manager_statement` json DEFAULT NULL,
  `part_number` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `equivalent_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tool_category` json DEFAULT NULL,
  `original_issued` date DEFAULT NULL,
  `rev_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued` date DEFAULT NULL,
  `distribution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `efectifity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_issuance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effect_maintenance_procedure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ability` json DEFAULT NULL,
  `reason_of_revision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recomended_tool` json DEFAULT NULL,
  `alternate_tool` json DEFAULT NULL,
  `maintenance_task` json DEFAULT NULL,
  `recomended` json DEFAULT NULL,
  `alternate` json DEFAULT NULL,
  `related_maintenance` json DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limitation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number_new` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_requests`
--

LOCK TABLES `component_requests` WRITE;
/*!40000 ALTER TABLE `component_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_shop_abilities`
--

DROP TABLE IF EXISTS `component_shop_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_shop_abilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `shop_maintenance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_maintenance_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary_of_maintenance` json DEFAULT NULL,
  `test_equipment` json DEFAULT NULL,
  `special_tool` json DEFAULT NULL,
  `capability_level` json DEFAULT NULL,
  `qualified_personel` json DEFAULT NULL,
  `material_planning` json DEFAULT NULL,
  `manhours_planning` json DEFAULT NULL,
  `consumable_material` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `test_condition` json DEFAULT NULL,
  `storage_condition` json DEFAULT NULL,
  `manufacture_documentation_drawing` text COLLATE utf8mb4_unicode_ci,
  `inspection` text COLLATE utf8mb4_unicode_ci,
  `tool_equipment` text COLLATE utf8mb4_unicode_ci,
  `special_work` text COLLATE utf8mb4_unicode_ci,
  `particular` text COLLATE utf8mb4_unicode_ci,
  `available_qualified` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_shop_abilities`
--

LOCK TABLES `component_shop_abilities` WRITE;
/*!40000 ALTER TABLE `component_shop_abilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_shop_abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_special_tools`
--

DROP TABLE IF EXISTS `component_special_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_special_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_pn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equivalent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_special_tools`
--

LOCK TABLES `component_special_tools` WRITE;
/*!40000 ALTER TABLE `component_special_tools` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_special_tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component_test_equipments`
--

DROP TABLE IF EXISTS `component_test_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component_test_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_pn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equivalent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component_test_equipments`
--

LOCK TABLES `component_test_equipments` WRITE;
/*!40000 ALTER TABLE `component_test_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `component_test_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_consumable_materials`
--

DROP TABLE IF EXISTS `engine_consumable_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_consumable_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_consumable_materials`
--

LOCK TABLES `engine_consumable_materials` WRITE;
/*!40000 ALTER TABLE `engine_consumable_materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_consumable_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_documents`
--

DROP TABLE IF EXISTS `engine_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `no_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_date` date DEFAULT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_status_confirmation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_maintenance_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_pd_sheet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_documents`
--

LOCK TABLES `engine_documents` WRITE;
/*!40000 ALTER TABLE `engine_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_personels`
--

DROP TABLE IF EXISTS `engine_personels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_personels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_no_stamp_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope_competency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nominate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_competence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_authorization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_personels`
--

LOCK TABLES `engine_personels` WRITE;
/*!40000 ALTER TABLE `engine_personels` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_personels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_requests`
--

DROP TABLE IF EXISTS `engine_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` text COLLATE utf8mb4_unicode_ci,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ata_chapter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workshop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dgca_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faa_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `easa_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facilities` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_tools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spescial_equipment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualified_personel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appropriate_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approval_request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci,
  `for_rating` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_requests`
--

LOCK TABLES `engine_requests` WRITE;
/*!40000 ALTER TABLE `engine_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_shop_abilities`
--

DROP TABLE IF EXISTS `engine_shop_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_shop_abilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `shop_maintenance` text COLLATE utf8mb4_unicode_ci,
  `number_ability` text COLLATE utf8mb4_unicode_ci,
  `summary_of_maintenance` json DEFAULT NULL,
  `document_requirement` text COLLATE utf8mb4_unicode_ci,
  `test_equipment_part_number` text COLLATE utf8mb4_unicode_ci,
  `test_equipment_part_name` text COLLATE utf8mb4_unicode_ci,
  `special_tool_part_number` text COLLATE utf8mb4_unicode_ci,
  `special_tool_part_name` text COLLATE utf8mb4_unicode_ci,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `manufacture_documentation_drawing` text COLLATE utf8mb4_unicode_ci,
  `inspection` text COLLATE utf8mb4_unicode_ci,
  `tool_equipment` text COLLATE utf8mb4_unicode_ci,
  `special_work` text COLLATE utf8mb4_unicode_ci,
  `particular` text COLLATE utf8mb4_unicode_ci,
  `available_qualified` text COLLATE utf8mb4_unicode_ci,
  `ablity` json DEFAULT NULL,
  `ability_inspection` tinyint(1) DEFAULT '0',
  `ability_testing` tinyint(1) DEFAULT '0',
  `ability_repair` tinyint(1) DEFAULT '0',
  `ability_modification` tinyint(4) DEFAULT '0',
  `ability_overhauled` tinyint(1) DEFAULT '0',
  `consumable_material` json DEFAULT NULL,
  `shop_ability` text COLLATE utf8mb4_unicode_ci,
  `part_name` text COLLATE utf8mb4_unicode_ci,
  `part_number` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_shop_abilities`
--

LOCK TABLES `engine_shop_abilities` WRITE;
/*!40000 ALTER TABLE `engine_shop_abilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_shop_abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_special_tools`
--

DROP TABLE IF EXISTS `engine_special_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_special_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_special_tools`
--

LOCK TABLES `engine_special_tools` WRITE;
/*!40000 ALTER TABLE `engine_special_tools` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_special_tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_tasklist_numbers`
--

DROP TABLE IF EXISTS `engine_tasklist_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_tasklist_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `no_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_tasklist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_tasklist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_tasklist_numbers`
--

LOCK TABLES `engine_tasklist_numbers` WRITE;
/*!40000 ALTER TABLE `engine_tasklist_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_tasklist_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_test_equipments`
--

DROP TABLE IF EXISTS `engine_test_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_test_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_test_equipments`
--

LOCK TABLES `engine_test_equipments` WRITE;
/*!40000 ALTER TABLE `engine_test_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_test_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_tools`
--

DROP TABLE IF EXISTS `engine_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `special_tool` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_pn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tool_desciption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `est_arrival` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_tools`
--

LOCK TABLES `engine_tools` WRITE;
/*!40000 ALTER TABLE `engine_tools` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engine_vendor_lists`
--

DROP TABLE IF EXISTS `engine_vendor_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_vendor_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `ata` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_vendorlist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engine_vendor_lists`
--

LOCK TABLES `engine_vendor_lists` WRITE;
/*!40000 ALTER TABLE `engine_vendor_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_vendor_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `for_ratings`
--

DROP TABLE IF EXISTS `for_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `for_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_of_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desciption` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `form_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `for_ratings`
--

LOCK TABLES `for_ratings` WRITE;
/*!40000 ALTER TABLE `for_ratings` DISABLE KEYS */;
INSERT INTO `for_ratings` VALUES (1,'DGCA RATING','Radio, Instrument, Accessories, Emergency Equipment, Landing Gear Components, Engine, Non Destructive Testing',NULL,'2019-08-21 14:40:03','1',NULL),(2,'FAA RATING','Radio, Instrument, Accessories, Emergency Equipment, Landing Gear Components, Powerplant, APU, Non Destructive Testing',NULL,'2019-08-21 14:40:42','2',NULL),(3,'EASA RATING','C1 - Air Conditioning & Pressurization, C2 - Auto Flight,C3 - Communication and Navigation,C4 - Doors & Hatches,C5 - Electrical Power & Lights,C6 - Emergency Equipment,C7 - Engine & APU,C8 - Flight Control,C9 - Fuel,C12 - Hydraulic Power,C13 - Indicating / Recording System,C14 - Landing Gear,Wheel & Brake,C15 - Oxygen,C17 - Pneumatic & Vacuum,C18 - Protection Ice/Rain/Fire,C19 - Windows, Non Destructive Testing',NULL,'2019-08-21 14:40:45','3',NULL),(4,'CAAM RATING','C1 - Air Conditioning & Pressurization,C4 - Doors & Hatches,C5 - Electrical Power & Lights,C6 - Emergency Equipment,C7 - Engine & APU,C8 - Flight Control,C14 - Landing Gear,C15 - Oxygen,C17 - Pneumatic & Vacuum, C18 - Protection Ice/Rain/Fire, Non Destructive Testing',NULL,'2019-08-21 14:40:53','4',NULL),(5,'CAAC RATING','ATA 22,ATA 23,ATA 24,ATA 25,ATA 26,ATA 31,ATA 32,ATA 33,ATA 34,ATA 35,ATA 36,ATA 45, Non Destructive Testing',NULL,'2019-08-21 14:40:59','5',NULL),(6,'CAAP RATING','Radio, Instrument, Accessories, Emergency Equipment, Landing Gear Components, Powerplant, APU, Non Destructive Testing',NULL,'2019-10-03 07:50:27','7',NULL),(7,'CAAS RATING','C1 - Air Conditioning & Pressurization, C2 - Auto Flight,C3 - Communication and Navigation,C4 - Doors & Hatches,C5 - Electrical Power & Lights,C6 - Emergency Equipment,C7 - Engine & APU,C8 - Flight Control,C9 - Fuel,C12 - Hydraulic Power,C13 - Indicating / Recording System,C14 - Landing Gear,Wheel & Brake,C15 - Oxygen,C17 - Pneumatic & Vacuum,C18 - Protection Ice/Rain/Fire,C19 - Windows, Non Destructive Testing',NULL,'2019-10-03 07:54:25','6',NULL);
/*!40000 ALTER TABLE `for_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hangars`
--

DROP TABLE IF EXISTS `hangars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hangars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hangar_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hangars`
--

LOCK TABLES `hangars` WRITE;
/*!40000 ALTER TABLE `hangars` DISABLE KEYS */;
INSERT INTO `hangars` VALUES (1,'Hangar 1',NULL,NULL),(2,'Hangar 2',NULL,NULL),(3,'Hangar 3',NULL,NULL),(4,'Hangar 4',NULL,NULL);
/*!40000 ALTER TABLE `hangars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,'A',NULL,NULL),(2,'B',NULL,NULL),(3,'C',NULL,NULL),(4,'D',NULL,NULL),(5,'E',NULL,NULL),(6,'F',NULL,NULL),(7,'G',NULL,NULL),(8,'H',NULL,NULL),(9,'I',NULL,NULL),(10,'J',NULL,NULL),(11,'K',NULL,NULL),(12,'L',NULL,NULL),(13,'M',NULL,NULL),(14,'N',NULL,NULL),(15,'O',NULL,NULL),(16,'P',NULL,NULL),(17,'Q',NULL,NULL),(18,'R',NULL,NULL),(19,'S',NULL,NULL),(20,'T',NULL,NULL),(21,'U',NULL,NULL),(22,'V',NULL,NULL),(23,'W',NULL,NULL),(24,'X',NULL,NULL),(25,'Y',NULL,NULL),(26,'Z',NULL,NULL),(27,'AA',NULL,NULL),(28,'AB',NULL,NULL),(29,'AC',NULL,NULL),(30,'AD',NULL,NULL),(31,'AE',NULL,NULL),(32,'AF',NULL,NULL),(33,'AG',NULL,NULL),(34,'AH',NULL,NULL),(35,'AI',NULL,NULL),(36,'AJ',NULL,NULL),(37,'AK',NULL,NULL),(38,'AL',NULL,NULL),(39,'AM',NULL,NULL),(40,'AN',NULL,NULL),(41,'AO',NULL,NULL),(42,'AP',NULL,NULL),(43,'AQ',NULL,NULL),(44,'AR',NULL,NULL),(45,'AS',NULL,NULL),(46,'AT',NULL,NULL),(47,'AU',NULL,NULL),(48,'AV',NULL,NULL),(49,'AW',NULL,NULL),(50,'AX',NULL,NULL),(51,'AY',NULL,NULL),(52,'AZ',NULL,NULL);
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_fns`
--

DROP TABLE IF EXISTS `main_fns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main_fns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_fns`
--

LOCK TABLES `main_fns` WRITE;
/*!40000 ALTER TABLE `main_fns` DISABLE KEYS */;
INSERT INTO `main_fns` VALUES (1,'[WE]-Welding',NULL,NULL),(2,'[PE]-Short Peening',NULL,NULL),(3,'[NDI]-Non Destructive Inpection',NULL,NULL),(4,'[SP]-belum tau',NULL,NULL),(6,'[MC]-Machining','2019-07-16 08:59:35','2019-07-16 08:59:35'),(7,'[CL]-Cleaning','2019-07-16 09:03:58','2019-07-16 09:03:58');
/*!40000 ALTER TABLE `main_fns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_areas`
--

DROP TABLE IF EXISTS `maintenance_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance_areas`
--

LOCK TABLES `maintenance_areas` WRITE;
/*!40000 ALTER TABLE `maintenance_areas` DISABLE KEYS */;
INSERT INTO `maintenance_areas` VALUES (1,'1000','GMF Planning Plant','Line Station',NULL,NULL,NULL,NULL),(2,'AMD1','Sardar Vallabhai Patel Airport','Line Station',NULL,NULL,NULL,NULL),(3,'AMQ1','Pattimura LMS Ambon','Line Station',NULL,NULL,NULL,NULL),(4,'AMS1','Schiphol LMS Amsterdam','Line Station',NULL,NULL,NULL,NULL),(5,'ATH1','Athena LMS','Line Station',NULL,NULL,NULL,NULL),(6,'AUH1','Abu Dhabi LMS','Line Station',NULL,NULL,NULL,NULL),(7,'BDJ1','Sjamsudin Noor LMS Banjarmasin','Line Station',NULL,NULL,NULL,NULL),(8,'BDO1','Husein S Negara LMS Bandung','Line Station',NULL,NULL,NULL,NULL),(9,'BEJ1','LMS Kalimarau Airport','Line Station',NULL,NULL,NULL,NULL),(10,'BIK1','Frans Kaisiepo  LMS Biak','Line Station',NULL,NULL,NULL,NULL),(11,'BJW1','LMS Soa Bajawa Airport','Line Station',NULL,NULL,NULL,NULL),(12,'BKK1','Suvarnabhumi LMS Bangkok','Line Station',NULL,NULL,NULL,NULL),(13,'BKS1','LMS Fatmawati Soekarno Airport','Line Station',NULL,NULL,NULL,NULL),(14,'BMU1','LMS SultanM.Salahuddin Airport','Line Station',NULL,NULL,NULL,NULL),(15,'BNE1','LMS Brisbane Airport','Line Station',NULL,NULL,NULL,NULL),(16,'BOM1','CHATRAPATI SHIVAJI INTERNATIONAL AIRPORT','Line Station',NULL,NULL,NULL,NULL),(17,'BPN1','Sepinggan LMS Balikpapan','Line Station',NULL,NULL,NULL,NULL),(18,'BTH1','Hang Nadim LMS Batam','Line Station',NULL,NULL,NULL,NULL),(19,'BTJ1','S Iskandar Muda LMS Banda Aceh','Line Station',NULL,NULL,NULL,NULL),(20,'BUA1','LMS Bua Luwu Airport','Line Station',NULL,NULL,NULL,NULL),(21,'BUW1','LMS BetoAmbari(Baubau) Airport','Line Station',NULL,NULL,NULL,NULL),(22,'BWX1','LMS Blimbingsari Airport','Line Station',NULL,NULL,NULL,NULL),(23,'CAN1','Baiyun LMS Guangzhou','Line Station',NULL,NULL,NULL,NULL),(24,'CDG1','Paris C de Gaulle LMS Paris','Line Station',NULL,NULL,NULL,NULL),(25,'CGK1','Cengkareng Terminal 1','Line Station',NULL,NULL,NULL,NULL),(26,'CGK2','Cengkareng Terminal 2','Line Station',NULL,NULL,NULL,NULL),(27,'CGK3','Cengkareng Terminal 3','Line Station',NULL,NULL,NULL,NULL),(28,'CGO1','Xinzheng Zhengzhou Airport','Line Station',NULL,NULL,NULL,NULL),(29,'CKG1','LMS Chongqing Airport','Line Station',NULL,NULL,NULL,NULL),(30,'CSX1','LMS Changsha Huanghua Airport','Line Station',NULL,NULL,NULL,NULL),(31,'CTU1','Shuangliu Chengdu Airport','Line Station',NULL,NULL,NULL,NULL),(32,'DEK1','LMS Dekai Airport','Line Station',NULL,NULL,NULL,NULL),(33,'DIL1','LMS Presidente Nicolau Airport','Line Station',NULL,NULL,NULL,NULL),(34,'DJB1','S Taha Syarifudin LMS Jambi','Line Station',NULL,NULL,NULL,NULL),(35,'DJJ1','Sentani LMS Jayapura','Line Station',NULL,NULL,NULL,NULL),(36,'DME1','Domodedovo LMS Moscow','Line Station',NULL,NULL,NULL,NULL),(37,'DPS1','Ngurah Rai LMS Denpasar','Line Station',NULL,NULL,NULL,NULL),(38,'DRW1','LMS Darwin Airport, Australia','Line Station',NULL,NULL,NULL,NULL),(39,'DTB1','LMS Silangit Airport','Line Station',NULL,NULL,NULL,NULL),(40,'DUM1','Pinang Kampai Airport','Line Station',NULL,NULL,NULL,NULL),(41,'DVO1','LMS Francisco Bangoy Airport','Line Station',NULL,NULL,NULL,NULL),(42,'DWC1','DUBAI AL-MAKTOUM AIRPORT','Line Station',NULL,NULL,NULL,NULL),(43,'DXB1','DUBAI INTERNATIONAL AIRPORT','Line Station',NULL,NULL,NULL,NULL),(44,'ENE1','LMS H.HasanAroeboesman Airport','Line Station',NULL,NULL,NULL,NULL),(45,'ENG1','ENGINEERING SERVICES','Line Station',NULL,NULL,NULL,NULL),(46,'FCLT','GMF Corporate Affair','Line Station',NULL,NULL,NULL,NULL),(47,'FCO1','Rome Fiumicino LMS Rome','Line Station',NULL,NULL,NULL,NULL),(48,'FLZ1','LMS Ferdinand Lumban T Airport','Line Station',NULL,NULL,NULL,NULL),(49,'GADC','GMF Aeroasia Distribution Centre','Line Station',NULL,NULL,NULL,NULL),(50,'GAEM','Engine Maintenance Shop','Line Station',NULL,NULL,NULL,NULL),(51,'GAH1','HANGAR 1','Hangar',NULL,NULL,NULL,NULL),(52,'GAH2','HANGAR 2','Hangar',NULL,NULL,NULL,NULL),(53,'GAH3','HANGAR 3','Hangar',NULL,NULL,NULL,NULL),(54,'GAH4','HANGAR 4','Hangar',NULL,NULL,NULL,NULL),(55,'GAH5','HANGAR 5','Hangar',NULL,NULL,NULL,NULL),(56,'GAHS','GMF Aeroasia Hangar Surabaya','Hangar',NULL,NULL,NULL,NULL),(57,'GASS','GMF Aircraft Support Services','Line Station',NULL,NULL,NULL,NULL),(58,'GNS1','LMS BinakaGunungsitoli Airport','Line Station',NULL,NULL,NULL,NULL),(59,'GTO1','Jalaluddin LMS Gorontalo','Line Station',NULL,NULL,NULL,NULL),(60,'HBIK','HANGAR BIAK','Line Station',NULL,NULL,NULL,NULL),(61,'HBPN','HANGAR BALIKPAPAN','Line Station',NULL,NULL,NULL,NULL),(62,'HDPS','HANGAR DENPASAR','Line Station',NULL,NULL,NULL,NULL),(63,'HFJR','HANGAR FUJAIRAH','Line Station',NULL,NULL,NULL,NULL),(64,'HKG1','Hongkong LMS','Line Station',NULL,NULL,NULL,NULL),(65,'HLP1','Halim P Kusuma LMS Jakarta','Line Station',NULL,NULL,NULL,NULL),(66,'HMDC','HANGAR MANADO','Line Station',NULL,NULL,NULL,NULL),(67,'HND1','Haneda LMS Tokyo','Line Station',NULL,NULL,NULL,NULL),(68,'HSUB','HANGAR SURABAYA','Line Station',NULL,NULL,NULL,NULL),(69,'ICN1','Incheon International Airport','Line Station',NULL,NULL,NULL,NULL),(70,'IGTE','Industrial Gas Turbine n Engine','Line Station',NULL,NULL,NULL,NULL),(71,'JBB1','LMS Jember Airport','Line Station',NULL,NULL,NULL,NULL),(72,'JED1','King Abdul Azis LMS Jeddah','Line Station',NULL,NULL,NULL,NULL),(73,'JFK1','PT.Garuda Maintenance Facility AeroAsia','Line Station',NULL,NULL,NULL,NULL),(74,'JHB1','LMS Senai Int.l Airport','Line Station',NULL,NULL,NULL,NULL),(75,'JOG1','Adi Sucipto LMS Yogyakarta','Line Station',NULL,NULL,NULL,NULL),(76,'KAZ1','LMS Kuabang Kau Airport','Line Station',NULL,NULL,NULL,NULL),(77,'KDI1','Wolter Monginsidi LMS Kendari','Line Station',NULL,NULL,NULL,NULL),(78,'KIX1','LMS Kansai Airport','Line Station',NULL,NULL,NULL,NULL),(79,'KJT1','Kertajati LMS','Line Station',NULL,NULL,NULL,NULL),(80,'KMG1','Kunming Changshui Int Airport','Line Station',NULL,NULL,NULL,NULL),(81,'KNG1','LMS Kaimana Airport','Line Station',NULL,NULL,NULL,NULL),(82,'KNO1','LMS Kuala Namu Airport','Line Station',NULL,NULL,NULL,NULL),(83,'KOE1','Eltari LMS Kupang','Line Station',NULL,NULL,NULL,NULL),(84,'KSR1','H.AEROPPALA AIRPORT','Line Station',NULL,NULL,NULL,NULL),(85,'KTG1','LMS Rahadi Oesman Airport','Line Station',NULL,NULL,NULL,NULL),(86,'KUL1','Kuala Lumpur LMS','Line Station',NULL,NULL,NULL,NULL),(87,'KWE1','Longdongbao Airport','Line Station',NULL,NULL,NULL,NULL),(88,'LAX1','Los Angeles LMS','Line Station',NULL,NULL,NULL,NULL),(89,'LBJ1','LMS Komodo Airport','Line Station',NULL,NULL,NULL,NULL),(90,'LGW1','LMS London Gatwick Airport','Line Station',NULL,NULL,NULL,NULL),(91,'LHR1','London LMS','Line Station',NULL,NULL,NULL,NULL),(92,'LLG1','LUBUKLINGGAU AIRPORT','Line Station',NULL,NULL,NULL,NULL),(93,'LLO1','LMS Palopo Airport','Line Station',NULL,NULL,NULL,NULL),(94,'LOP1','Lombok LMS','Line Station',NULL,NULL,NULL,NULL),(95,'LSW1','LMS Malikus Saleh Airport','Line Station',NULL,NULL,NULL,NULL),(96,'LUV1','LMS Langgur Airport','Line Station',NULL,NULL,NULL,NULL),(97,'LUW1','LMS Syukuran Aminudin Airport','Line Station',NULL,NULL,NULL,NULL),(98,'MAJ1','Amata Kabua Int Airport','Line Station',NULL,NULL,NULL,NULL),(99,'MAN1','Manchester LMS','Line Station',NULL,NULL,NULL,NULL),(100,'MCT1','Muscat LMS','Line Station',NULL,NULL,NULL,NULL),(101,'MDC1','Sam ratulangi LMS Manado','Line Station',NULL,NULL,NULL,NULL),(102,'MDN1','Madison Municipal Airport','Line Station',NULL,NULL,NULL,NULL),(103,'MED1','LMS PMBA Madinah Airport','Line Station',NULL,NULL,NULL,NULL),(104,'MEL1','Meulborne LMS','Line Station',NULL,NULL,NULL,NULL),(105,'MEQ1','LMS Cut Nyak Dhien Airport','Line Station',NULL,NULL,NULL,NULL),(106,'MES1','Polonia LMS Medan','Line Station',NULL,NULL,NULL,NULL),(107,'MJU1','LMS TampaPadang-Mamuju Airport','Line Station',NULL,NULL,NULL,NULL),(108,'MKQ1','LMS Mopah Airport','Line Station',NULL,NULL,NULL,NULL),(109,'MKW1','LMS Rendani-Manokwari Airport','Line Station',NULL,NULL,NULL,NULL),(110,'MLG1','Abdul Rahman Saleh LMS Malang','Line Station',NULL,NULL,NULL,NULL),(111,'MNA1','LMS Melongguane Airport','Line Station',NULL,NULL,NULL,NULL),(112,'MNL1','LMS Manila Ninoy Aquino Airpor','Line Station',NULL,NULL,NULL,NULL),(113,'MOF1','Wai Oti Airport','Line Station',NULL,NULL,NULL,NULL),(114,'MRG1','Mareeba Airport','Line Station',NULL,NULL,NULL,NULL),(115,'NBX1','LMS Douw Aturure Airport','Line Station',NULL,NULL,NULL,NULL),(116,'NGB1','Ningbo Lishe Int Airport','Line Station',NULL,NULL,NULL,NULL),(117,'NGO1','Chubu Centrair Int Airport','Line Station',NULL,NULL,NULL,NULL),(118,'NHL1','Honolulu International Airport','Line Station',NULL,NULL,NULL,NULL),(119,'NKG1','Nanjing Lukou Airport','Line Station',NULL,NULL,NULL,NULL),(120,'NNG1','Nanning Wuxu Airport','Line Station',NULL,NULL,NULL,NULL),(121,'NRT1','Narita LMS Tokyo','Line Station',NULL,NULL,NULL,NULL),(122,'NTX1','Ranai Airport','Line Station',NULL,NULL,NULL,NULL),(123,'OKL1','LMS Oksibil Airport','Line Station',NULL,NULL,NULL,NULL),(124,'PCB1','LMS Pondok Cabe Airport','Line Station',NULL,NULL,NULL,NULL),(125,'PDG1','Minangkabau LMS Padang','Line Station',NULL,NULL,NULL,NULL),(126,'PEK1','Beijing LMS','Line Station',NULL,NULL,NULL,NULL),(127,'PEN1','Penang International Airport','Line Station',NULL,NULL,NULL,NULL),(128,'PER1','Perth LMS','Line Station',NULL,NULL,NULL,NULL),(129,'PGDC','PLB Central Distribution','Line Station',NULL,NULL,NULL,NULL),(130,'PGK1','Depati Amir LMS Pangkalpinang','Line Station',NULL,NULL,NULL,NULL),(131,'PKN1','LMS Iskandar  Airport','Line Station',NULL,NULL,NULL,NULL),(132,'PKU1','S Syarif Kasim LMS Pekan Baru','Line Station',NULL,NULL,NULL,NULL),(133,'PKY1','Tjilik Riwut LMS Palangkaraya','Line Station',NULL,NULL,NULL,NULL),(134,'PLM1','S Badaruddin II LMS Palembang','Line Station',NULL,NULL,NULL,NULL),(135,'PLW1','Mutiara LMS Palu','Line Station',NULL,NULL,NULL,NULL),(136,'PMA1','GMF Product Manufacturing','Line Station',NULL,NULL,NULL,NULL),(137,'PNK1','Supadio Airport (Pontianak)','Line Station',NULL,NULL,NULL,NULL),(138,'PSJ1','LMS Kasiguncu (Poso) Airport','Line Station',NULL,NULL,NULL,NULL),(139,'PSU1','LMS Pangsuma-Putusibau Airport','Line Station',NULL,NULL,NULL,NULL),(140,'PUM1','LMS Pomala Airport','Line Station',NULL,NULL,NULL,NULL),(141,'PVG1','Pudong LMS Shang Hai','Line Station',NULL,NULL,NULL,NULL),(142,'RAQ1','SUGIMANURU AIRPORT','Line Station',NULL,NULL,NULL,NULL),(143,'RUH1','King Khaled Int Airport','Line Station',NULL,NULL,NULL,NULL),(144,'SBG1','LMS Maimun Saleh Airport','Line Station',NULL,NULL,NULL,NULL),(145,'SEL1','Incheon LMS Seoul','Line Station',NULL,NULL,NULL,NULL),(146,'SGN1','Tan Son Nhat Int Airport','Line Station',NULL,NULL,NULL,NULL),(147,'SHE1','Taoxian Airport','Line Station',NULL,NULL,NULL,NULL),(148,'SHJ1','SHARJAH INTERNATIONAL AIRPORT','Line Station',NULL,NULL,NULL,NULL),(149,'SIN1','Changi LMS Singapore','Line Station',NULL,'2019-08-12 15:42:03','2019-08-12 15:42:03',NULL),(150,'SOC1','Adi Sumarno LMS Solo','Line Station',NULL,'2019-08-12 15:42:03','2019-08-12 15:42:03',NULL),(151,'SOQ1','LMS Domine Eduard Osok Airport','Line Station',NULL,'2019-08-12 15:42:02','2019-08-12 15:42:02',NULL),(152,'SQG1','LMS Susilo Airport','Line Station',NULL,'2019-08-12 15:42:01','2019-08-12 15:42:01',NULL),(153,'SRG1','Achmad Yani LMS Semarang','Line Station',NULL,'2019-08-12 15:41:59','2019-08-12 15:41:59',NULL),(154,'SRI1','SAMARINDA AIRPORT','Line Station',NULL,'2019-08-12 15:41:59','2019-08-12 15:41:59',NULL),(155,'STOR','GMF Repository Centre','Line Station',NULL,'2019-08-12 15:41:57','2019-08-12 15:41:57',NULL),(156,'SUB1','Juanda LMS Surabaya','Line Station',NULL,'2019-08-12 15:41:57','2019-08-12 15:41:57',NULL),(157,'SUB2','LMS Juanda Terminal 2','Line Station',NULL,'2019-08-12 15:41:55','2019-08-12 15:41:55',NULL),(158,'SWQ1','LMS Sultan Muhammad Kaharuddin','Line Station',NULL,'2019-08-12 15:41:53','2019-08-12 15:41:53',NULL),(159,'SXK1','LMS Olilit (Saumlaki) Airport','Line Station',NULL,'2019-08-12 15:41:52','2019-08-12 15:41:52',NULL),(160,'SYD1','Sydney LMS','Line Station',NULL,'2019-08-12 15:41:51','2019-08-12 15:41:51',NULL),(161,'TIM1','Mozes Kilangin LMS Timika','Line Station',NULL,'2019-08-12 15:41:50','2019-08-12 15:41:50',NULL),(162,'TJQ1','LMS HAS. Hanandjoeddin Airport','Line Station',NULL,'2019-08-12 15:41:49','2019-08-12 15:41:49',NULL),(163,'TKG1','R Inten II LMS Tanjung Karang','Line Station',NULL,'2019-08-12 15:41:48','2019-08-12 15:41:48',NULL),(164,'TMC1','LMS Tambolaka Airport','Line Station',NULL,'2019-08-12 15:41:47','2019-08-12 15:41:47',NULL),(165,'TNJ1','LMS Haji Fisabilillah Airport','Line Station',NULL,'2019-08-12 15:41:46','2019-08-12 15:41:46',NULL),(166,'TPE1','Taiwan Taoyuan LMS Taipei','Line Station',NULL,'2019-08-12 15:41:44','2019-08-12 15:41:44',NULL),(167,'TQQ1','Maranggo Airport','Line Station',NULL,'2019-08-12 15:41:44','2019-08-12 15:41:44',NULL),(168,'TRK1','Juwata LMS Tarakan','Line Station',NULL,'2019-08-12 15:41:43','2019-08-12 15:41:43',NULL),(169,'TTE1','Sultan Babullah LMS Ternate','Line Station',NULL,'2019-08-12 15:41:42','2019-08-12 15:41:42',NULL),(170,'TWLC','GMF Learning Center','Line Station',NULL,'2019-08-12 15:41:42','2019-08-12 15:41:42',NULL),(171,'TYN1','Taiyuan Wusu Airport','Line Station',NULL,'2019-08-12 15:41:40','2019-08-12 15:41:40',NULL),(172,'UPG1','Sultan Hasanuddin LMS Makassar','Line Station',NULL,'2019-08-12 15:41:39','2019-08-12 15:41:39',NULL),(173,'WAI1','LMS Maumere AlokTimur  Airport','Workshop',NULL,'2019-08-12 15:41:39','2019-08-12 15:41:39',NULL),(174,'WBPN','Workshop Remote Balikpapan','Workshop',NULL,'2019-08-12 15:41:38','2019-08-12 15:41:38',NULL),(175,'WDPS','Workshop Remote Denpasar','Workshop',NULL,'2019-08-12 15:41:37','2019-08-12 15:41:37',NULL),(176,'WFJR','WORKSHOP HANGAR FUJAIRAH','Workshop',NULL,'2019-08-12 15:41:36','2019-08-12 15:41:36',NULL),(177,'WGP1','LMS Umbu Mehang Kunda Airport','Workshop',NULL,'2019-08-12 15:41:36','2019-08-12 15:41:36',NULL),(178,'WMES','Workshop Remote Medan','Workshop',NULL,'2019-08-12 15:41:35','2019-08-12 15:41:35',NULL),(179,'WMX1','LMS Wamena Airport','Workshop',NULL,'2019-08-12 15:41:33','2019-08-12 15:41:33',NULL),(180,'WNG1','LMS Wangi-Wangi Airport','Workshop',NULL,'2019-08-12 15:41:32','2019-08-12 15:41:32',NULL),(181,'WNI1','LMS Wakatobi Airport','Workshop',NULL,'2019-08-12 15:41:31','2019-08-12 15:41:31',NULL),(182,'WSAV','Avionic Workshop','Workshop',NULL,'2019-08-12 15:41:30','2019-08-12 15:41:30',NULL),(183,'WSCA','WS H5 - CABIN MONUMENT WORKSHOP','Workshop',NULL,'2019-08-12 15:41:29','2019-08-12 15:41:29',NULL),(184,'WSCB','Cabin Furnishing Workshop','Workshop',NULL,'2019-08-12 15:41:28','2019-08-12 15:41:28',NULL),(185,'WSCN','WS H4 - Cabin Monument Shop','Workshop',NULL,'2019-08-12 15:41:28','2019-08-12 15:41:28',NULL),(186,'WSEM','Electro Mechanical Workshop','Workshop',NULL,'2019-08-12 15:41:27','2019-08-12 15:41:27',NULL),(187,'WSHJ','WORKSHOP HANGAR SHARJAH','Workshop',NULL,'2019-08-12 15:41:26','2019-08-12 15:41:26',NULL),(188,'WSHS','WORKSHOP HANGAR SURABAYA','Workshop',NULL,'2019-08-12 15:41:25','2019-08-12 15:41:25',NULL),(189,'WSI1','LMS Raja Ampat Airport','Workshop',NULL,'2019-08-12 15:41:19','2019-08-12 15:41:19',NULL),(190,'WSLS','Loundry Workshop','Workshop',NULL,'2019-08-12 15:41:22','2019-08-12 15:41:22',NULL),(191,'WSNC','NDT & Callibration Workshop','Workshop',NULL,'2019-08-12 15:41:17','2019-08-12 15:41:17',NULL),(192,'WSPT','Painting Workshop','Workshop',NULL,'2019-08-12 15:41:02','2019-08-12 15:41:02',NULL),(193,'WSRE','WS H5 - Structure Repair Shop','Workshop',NULL,'2019-08-12 15:41:00','2019-08-12 15:41:00',NULL),(194,'WSSE','WS H4 - Seat Shop','Workshop',NULL,'2019-08-12 15:40:57','2019-08-12 15:40:57',NULL),(195,'WSSO','WS H5 - SEAT SHOP','Workshop',NULL,'2019-08-12 15:40:55','2019-08-12 15:40:55',NULL),(196,'WSSR','WS H4 - Structure Repair Shop','Workshop',NULL,'2019-08-12 15:40:53','2019-08-12 15:40:53',NULL),(197,'WSSS','Seat Workshop','Workshop',NULL,'2019-08-12 15:40:51','2019-08-12 15:40:51',NULL),(198,'WSST','Structure Repair Workshop','Workshop',NULL,'2019-08-12 15:40:48','2019-08-12 15:40:48',NULL),(199,'WSSW','Sewing Workshop','Workshop',NULL,'2019-08-12 15:40:46','2019-08-12 15:40:46',NULL),(200,'WSUB','Workshop Remote Surabaya','Workshop',NULL,'2019-08-12 15:40:44','2019-08-12 15:40:44',NULL),(201,'WSWB','WB & L/G Workshop','Workshop',NULL,'2019-08-12 15:40:41','2019-08-12 15:40:41',NULL),(202,'WUH1','LMS Tianhe (Wuhan) Airport','Workshop',NULL,'2019-08-12 15:40:39','2019-08-12 15:40:39',NULL),(203,'WUPG','Workshop Remote Ujungpandang','Workshop',NULL,'2019-08-12 15:40:36','2019-08-12 15:40:36',NULL),(204,'WUX1','Sunan Shuofang Int Airport','Workshop',NULL,'2019-08-12 15:40:35','2019-08-12 15:40:35',NULL),(205,'XCH1','Christmas Island Airport','Line Station',NULL,'2019-08-12 15:40:32','2019-08-12 15:40:32',NULL),(206,'XIY1','Xi\'an Xianyang Int Airport','Line Station',NULL,'2019-08-12 15:40:30','2019-08-12 15:40:30',NULL),(207,'YMX1','Mirabel International Airport','Workshop',NULL,'2019-08-12 15:40:27','2019-08-12 15:40:27',NULL),(208,'AAP','Samarinda','Line Maintenance Station',NULL,NULL,NULL,NULL),(209,'AMQ','Ambon ','Line Maintenance Station',NULL,NULL,NULL,NULL),(210,'BDJ','Banjarmasin ','Line Maintenance Station',NULL,NULL,NULL,NULL),(211,'BDO','Bandung ','Line Maintenance Station',NULL,NULL,NULL,NULL),(212,'BEJ','Berau ','Line Maintenance Station',NULL,NULL,NULL,NULL),(213,'ENE','Ende','Line Maintenance Station',NULL,NULL,NULL,NULL),(214,'BIK','Biak ','Line Maintenance Station',NULL,NULL,NULL,NULL),(215,'BKS','Bengkulu ','Line Maintenance Station',NULL,NULL,NULL,NULL),(216,'JED','Jeddah ','Line Maintenance Station',NULL,NULL,NULL,NULL),(217,'BMU','Bima','Line Maintenance Station',NULL,NULL,NULL,NULL),(218,'BPN','Balikpapan ','Line Maintenance Station',NULL,NULL,NULL,NULL),(219,'KUL','Kuala Lumpur','Line Maintenance Station',NULL,NULL,NULL,NULL),(220,'BTH','Batam ','Line Maintenance Station',NULL,NULL,NULL,NULL),(221,'LUV','Langgur','Line Maintenance Station',NULL,NULL,NULL,NULL),(222,'MED','Madinah','Line Maintenance Station',NULL,NULL,NULL,NULL),(223,'BTJ','Banda Aceh ','Line Maintenance Station',NULL,NULL,NULL,NULL),(224,'MJU','Mamuju','Line Maintenance Station',NULL,NULL,NULL,NULL),(225,'RTU','Maratua','Line Maintenance Station',NULL,NULL,NULL,NULL),(226,'BUW','Baubau','Line Maintenance Station',NULL,NULL,NULL,NULL),(227,'BWX','Banyuwangi','Line Maintenance Station',NULL,NULL,NULL,NULL),(228,'CGK','Cengkareng','Line Maintenance Station',NULL,NULL,NULL,NULL),(229,'LLO','Palopo','Line Maintenance Station',NULL,NULL,NULL,NULL),(230,'DJB','Jambi ','Line Maintenance Station',NULL,NULL,NULL,NULL),(231,'DJJ','Jayapura ','Line Maintenance Station',NULL,NULL,NULL,NULL),(232,'SXK','Saumlaki','Line Maintenance Station',NULL,NULL,NULL,NULL),(233,'DPS','Denpasar ','Line Maintenance Station',NULL,NULL,NULL,NULL),(234,'SIN','Singapura ','Line Maintenance Station',NULL,NULL,NULL,NULL),(235,'SWQ','Sumbawa','Line Maintenance Station',NULL,NULL,NULL,NULL),(236,'DTB','Silangit','Line Maintenance Station',NULL,NULL,NULL,NULL),(237,'FLZ','Pinangsori','Line Maintenance Station',NULL,NULL,NULL,NULL),(238,'GNS','Gunung Sitoli','Line Maintenance Station',NULL,NULL,NULL,NULL),(239,'GTO','Gorontalo','Line Maintenance Station',NULL,NULL,NULL,NULL),(240,'HLP','Halim Perdana Kusuma ','Line Maintenance Station',NULL,NULL,NULL,NULL),(241,'AEG','Aek Godang','Line Maintenance Station',NULL,NULL,NULL,NULL),(242,'JBB','Jember ','Line Maintenance Station',NULL,NULL,NULL,NULL),(243,'JOG','Jogjakarta ','Line Maintenance Station',NULL,NULL,NULL,NULL),(244,'KDI','Kendari','Line Maintenance Station',NULL,NULL,NULL,NULL),(245,'KJT','Kertajati','Line Maintenance Station',NULL,NULL,NULL,NULL),(246,'KNO','Kualanamu ','Line Maintenance Station',NULL,NULL,NULL,NULL),(247,'KOE','Kupang ','Line Maintenance Station',NULL,NULL,NULL,NULL),(248,'KSR','Selayar','Line Maintenance Station',NULL,NULL,NULL,NULL),(249,'YIA','Kulon Progo','Line Maintenance Station',NULL,NULL,NULL,NULL),(250,'KTG','Ketapang','Line Maintenance Station',NULL,NULL,NULL,NULL),(251,'LSW','Lhoksemauwe','Line Maintenance Station',NULL,NULL,NULL,NULL),(252,'LBJ','Labuan Bajo','Line Maintenance Station',NULL,NULL,NULL,NULL),(253,'LOP','Lombok Praya ','Line Maintenance Station',NULL,NULL,NULL,NULL),(254,'LUW','Luwuk','Line Maintenance Station',NULL,NULL,NULL,NULL),(255,'MDC','Manado ','Line Maintenance Station',NULL,NULL,NULL,NULL),(256,'PUM','Sangia','Line Maintenance Station',NULL,NULL,NULL,NULL),(257,'MKQ','Merauke ','Line Maintenance Station',NULL,NULL,NULL,NULL),(258,'MKW','Manokwari ','Line Maintenance Station',NULL,NULL,NULL,NULL),(259,'MLG','Malang ','Line Maintenance Station',NULL,NULL,NULL,NULL),(260,'MOF','Maumere','Line Maintenance Station',NULL,NULL,NULL,NULL),(261,'WYK','Wippo','Line Maintenance Station',NULL,NULL,NULL,NULL),(262,'NBX','Nabire','Line Maintenance Station',NULL,NULL,NULL,NULL),(263,'PDG','Padang ','Line Maintenance Station',NULL,NULL,NULL,NULL),(264,'PGK','Pangkal Pinang ','Line Maintenance Station',NULL,NULL,NULL,NULL),(265,'PKU','Pekanbaru ','Line Maintenance Station',NULL,NULL,NULL,NULL),(266,'PKY','Palangkaraya ','Line Maintenance Station',NULL,NULL,NULL,NULL),(267,'PLM','Palembang','Line Maintenance Station',NULL,NULL,NULL,NULL),(268,'KAZ','Kuabang','Line Maintenance Station',NULL,NULL,NULL,NULL),(269,'PLW','Palu ','Line Maintenance Station',NULL,NULL,NULL,NULL),(270,'PNK','Pontianak ','Line Maintenance Station',NULL,NULL,NULL,NULL),(271,'MRB','Muarabungo','Line Maintenance Station',NULL,NULL,NULL,NULL),(272,'NTX','Natuna','Line Maintenance Station',NULL,NULL,NULL,NULL),(273,'PSU','Putussibau','Line Maintenance Station',NULL,NULL,NULL,NULL),(274,'RAQ','Raha','Line Maintenance Station',NULL,NULL,NULL,NULL),(275,'SOC','Solo ','Line Maintenance Station',NULL,NULL,NULL,NULL),(276,'SOQ','Sorong ','Line Maintenance Station',NULL,NULL,NULL,NULL),(277,'SQG','Sintang','Line Maintenance Station',NULL,NULL,NULL,NULL),(278,'SRG','Semarang ','Line Maintenance Station',NULL,NULL,NULL,NULL),(279,'SUB','Surabaya ','Line Maintenance Station',NULL,NULL,NULL,NULL),(280,'BTW','Batu Licin','Line Maintenance Station',NULL,NULL,NULL,NULL),(281,'TIM','Timika ','Line Maintenance Station',NULL,NULL,NULL,NULL),(282,'DIL','Dili','Line Maintenance Station',NULL,NULL,NULL,NULL),(283,'TJQ','Tanjung Pandan ','Line Maintenance Station',NULL,NULL,NULL,NULL),(284,'KBU','Kotabaru','Line Maintenance Station',NULL,NULL,NULL,NULL),(285,'TKG','Tanjung Karang','Line Maintenance Station',NULL,NULL,NULL,NULL),(286,'LLJ','Lubuk Linggau','Line Maintenance Station',NULL,NULL,NULL,NULL),(287,'TMC','Tambolaka','Line Maintenance Station',NULL,NULL,NULL,NULL),(288,'TNJ','Tanjung Pinang','Line Maintenance Station',NULL,NULL,NULL,NULL),(289,'TRK','Tarakan ','Line Maintenance Station',NULL,NULL,NULL,NULL),(290,'PKN','Pangkalanbun','Line Maintenance Station',NULL,NULL,NULL,NULL),(291,'TSY','Tasikmalaya','Line Maintenance Station',NULL,NULL,NULL,NULL),(292,'SMQ','Sampit','Line Maintenance Station',NULL,NULL,NULL,NULL),(293,'TTE','Ternate ','Line Maintenance Station',NULL,NULL,NULL,NULL),(294,'UPG','Makassar ','Line Maintenance Station',NULL,NULL,NULL,NULL),(295,'WNI','Wangi-wangi','Line Maintenance Station',NULL,NULL,NULL,NULL),(296,'WGP','Waingapu','Line Maintenance Station',NULL,NULL,NULL,NULL),(297,'WMX','Wamena','Line Maintenance Station',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `maintenance_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_aircraft_customers`
--

DROP TABLE IF EXISTS `master_aircraft_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_aircraft_customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_aircraft_customers`
--

LOCK TABLES `master_aircraft_customers` WRITE;
/*!40000 ALTER TABLE `master_aircraft_customers` DISABLE KEYS */;
INSERT INTO `master_aircraft_customers` VALUES (1,'Garuda Indonesia (GA)','2019-08-16 09:22:06','2019-08-16 09:23:05'),(2,'Citilink (QG)','2019-08-16 09:22:17','2019-08-16 09:22:56'),(3,'Sriwijaya Air (SJ)','2019-08-16 09:22:29','2019-08-16 09:22:50'),(4,'Nam Air (IN)','2019-08-16 09:22:43','2019-08-16 09:22:43');
/*!40000 ALTER TABLE `master_aircraft_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_config_authorities`
--

DROP TABLE IF EXISTS `master_config_authorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_config_authorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_config_id` int(11) NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_of_application` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_config_authorities`
--

LOCK TABLES `master_config_authorities` WRITE;
/*!40000 ALTER TABLE `master_config_authorities` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_config_authorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_configs`
--

DROP TABLE IF EXISTS `master_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_area_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `engine_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `master_request_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority` json DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_approve` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_configs`
--

LOCK TABLES `master_configs` WRITE;
/*!40000 ALTER TABLE `master_configs` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_facilities`
--

DROP TABLE IF EXISTS `master_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_facilities`
--

LOCK TABLES `master_facilities` WRITE;
/*!40000 ALTER TABLE `master_facilities` DISABLE KEYS */;
INSERT INTO `master_facilities` VALUES (1,'ddd','2019-07-23 09:24:53','2019-07-23 09:24:53'),(2,'Stair','2019-07-23 09:28:24','2019-07-23 09:28:24'),(3,'Dock','2019-07-25 15:13:57','2019-07-25 15:13:57'),(4,'Fire Alarm','2019-08-03 18:20:24','2019-08-03 18:20:24');
/*!40000 ALTER TABLE `master_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_personels`
--

DROP TABLE IF EXISTS `master_personels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_personels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nopeg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passduedate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amel` json DEFAULT NULL,
  `gmf_auth` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_personels`
--

LOCK TABLES `master_personels` WRITE;
/*!40000 ALTER TABLE `master_personels` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_personels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_requests`
--

DROP TABLE IF EXISTS `master_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_requests`
--

LOCK TABLES `master_requests` WRITE;
/*!40000 ALTER TABLE `master_requests` DISABLE KEYS */;
INSERT INTO `master_requests` VALUES (1,'AIRCRAFT','A/C Capability Evaluation Request','1565228971Aircraft_2.jpg',NULL,'2019-08-08 08:49:35','form_aircraft'),(2,'COMPONENT','Component Capability Evaluation Request','1565228986Component.jpg',NULL,'2019-08-08 08:49:49','form_component'),(3,'ENGINE','Engine Capability Evaluation Request','1565229168Engine.jpg',NULL,'2019-08-08 08:52:50','form_engine'),(4,'SPECIAL PROCESS','Special Process Capability Evaluation Request','1565229178NDT.jpg',NULL,'2019-08-08 08:52:59','form_special');
/*!40000 ALTER TABLE `master_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_02_26_034821_create_master_requests_table',1),(4,'2019_02_26_034907_create_request_submittions_table',1),(5,'2019_02_26_072244_create_maintenance_areas_table',1),(6,'2019_02_26_072336_create_aircraft_requests_table',1),(7,'2019_02_26_080650_create_aircraft_authorized_personels_table',1),(8,'2019_02_26_080711_create_aircraft_documents_table',1),(9,'2019_02_26_080723_create_aircraft_materials_table',1),(10,'2019_02_26_080746_create_aircraft_tool_equipments_table',1),(11,'2019_03_01_033156_create_request_histories_table',1),(12,'2019_03_01_082230_add_field_link_tble_master_request',1),(13,'2019_03_05_034854_add_manager_statement_choised',1),(14,'2019_03_05_064557_add_maintenance_area_field',1),(15,'2019_03_07_082448_add_delete_at_tb_request_submittions',1),(16,'2019_03_08_092805_create_aircraft_types_table',1),(17,'2019_03_08_092859_create_unit_of_measures_table',1),(18,'2019_03_08_092917_create_part_numbers_table',1),(19,'2019_03_11_024921_create_engine_requests_table',1),(20,'2019_03_11_033930_create_engine_personels_table',1),(21,'2019_03_11_034233_create_engine_tasklist_numbers_table',1),(22,'2019_03_11_034258_create_engine_vendor_lists_table',1),(23,'2019_03_11_034310_create_engine_consumable_materials_table',1),(24,'2019_03_12_030957_create_engine_shop_abilities_table',1),(25,'2019_03_12_081442_create_master_configs_table',1),(26,'2019_03_15_032222_add_field_limitation_and_maintenance_area_value',1),(27,'2019_03_15_081418_add_fiel_attacment_table_aircraft_doc',1),(28,'2019_03_15_092255_add_field_status_read',1),(29,'2019_03_17_074047_add_softdelete_tb_mainarea_partnum_unitofmea_aricrafttype',1),(30,'2019_03_17_075248_add_uid_tb_mainarea_partnum_unitofmea_aricrafttype',1),(31,'2019_03_18_014755_add_field_signature',1),(32,'2019_03_18_031556_add_field_in_tb_aircraft_material_document_and_tools',1),(33,'2019_03_18_084109_create_engine_tools_table',1),(34,'2019_03_19_070808_addfieldattachment_and_aproval_request_type',1),(35,'2019_03_20_024405_add_role_request',1),(36,'2019_03_20_024557_add_checked_and_approve_name',1),(37,'2019_03_20_100659_create_for_ratings_table',1),(38,'2019_03_20_101151_add_fiel_for_ratting',1),(39,'2019_03_21_041924_add_field_other_ability_value',1),(40,'2019_03_21_050335_add_engine_name_tbl_master_config',1),(41,'2019_03_21_093506_create_special_requests_table',1),(42,'2019_03_21_093858_create_special_shop_abilities_table',1),(43,'2019_03_21_094000_create_special_personels_table',1),(44,'2019_03_22_023000_create_special_sheet_lists_table',1),(45,'2019_03_22_023031_create_special_tools_table',1),(46,'2019_03_22_023042_create_special_part_lists_table',1),(47,'2019_03_25_052129_add_field_in_table_user',1),(48,'2019_03_26_071900_create_vendor_managements_table',1),(49,'2019_03_27_044336_add_field_qa_avaluation',1),(50,'2019_03_28_060725_create_vendor_management_histories_table',1),(51,'2019_03_28_095710_add_manual_revision_tb_special_request',1),(52,'2019_04_01_045136_create_component_requests_table',1),(53,'2019_04_01_095519_add_field_for_equivalent_tb__component_request',1),(54,'2019_04_02_015728_create_component_shop_abilities_table',1),(55,'2019_04_02_095405_add_field_condition',1),(56,'2019_04_08_023240_change_field_become_part_number_all_request',1),(57,'2019_04_08_065440_add_token_field_in_tble_vendor',1),(58,'2019_04_09_031821_add_atachment_table_vendor_managements',1),(59,'2019_04_10_021733_add_uom_table_part_number',1),(60,'2019_04_12_033432_create_component_personels_table',1),(61,'2019_04_12_083459_create_component_documents_table',1),(62,'2019_04_12_083714_create_component_test_equipments_table',1),(63,'2019_04_12_083739_create_component_special_tools_table',1),(64,'2019_04_12_084006_create_component_material_plannings_table',1),(65,'2019_04_12_084026_create_component_manhours_plannings_table',1),(66,'2019_04_15_041336_add_tb_read_and_status_vendor',1),(67,'2019_04_15_061847_add_table_component_type',1),(68,'2019_04_16_021614_create_component_equivalents_table',1),(69,'2019_04_19_111128_create_hangars_table',1),(70,'2019_04_22_083832_create_component_attachments_table',1),(71,'2019_04_22_084327_create_apps_table',1),(72,'2019_04_22_084449_add_field_document_type_and_data_history',1),(73,'2019_04_23_070822_add_request_submition_id_in_equivalent',1),(74,'2019_04_29_022459_add_fiel_data_in_vendor_histories',1),(75,'2019_05_03_034529_create_workshops_table',1),(76,'2019_05_03_044058_create_type_suppliers_table',1),(77,'2019_05_03_044335_create_vendor_attachments_table',1),(78,'2019_05_06_014949_add_fiel_decision_and_score_in__req_submittions',1),(79,'2019_05_21_134547_add_field_type_and_attachment',1),(80,'2019_05_23_114828_create_questionnaires_table',1),(81,'2019_05_23_162102_add_decision_and_score',1),(82,'2019_06_26_153634_change_colum_aproval_be_user_id',1),(83,'2019_07_01_093524_create_attachment_resubmits_table',1),(84,'2019_07_01_093620_add_pn_and_data_json_tb_ms_config',1),(85,'2019_07_01_114527_add_step_request_tbl_request_sbmttn',1),(86,'2019_07_01_150027_create_attachment_resubmit_vendors_table',1),(87,'2019_07_01_150418_add_step_request_tbl_vendor_management',1),(88,'2019_07_03_113409_add_type_masterconfig',1),(89,'2019_07_03_141119_add_field_special_shop__ability_and_change',1),(90,'2019_07_05_091922_create_capability_lists_table',1),(91,'2019_07_05_092024_create_vendor_capablity_list_details_table',1),(92,'2019_07_08_092717_change_name_column_component_manhours_plannings',1),(93,'2019_07_09_141219_create_master_personels_table',1),(94,'2019_07_10_110535_add_license_type_auth_pesonel',1),(95,'2019_07_10_113656_add_req_number_all_capability',1),(96,'2019_07_10_163623_tb_auth_personel_gmf_scope_amel_scope',1),(97,'2019_07_11_135959_create_component_capability_lists_table',1),(98,'2019_07_12_103051_create_master_facilities_table',1),(99,'2019_07_12_103109_create_aircraft_facilities_table',1),(100,'2019_07_15_094322_add_field_qsa_part_approve',1),(101,'2019_07_15_114259_create_capability_ratings_table',1),(102,'2019_07_16_135256_add_field_no_request_and_another',1),(103,'2019_07_16_143154_create_main_fns_table',1),(104,'2019_07_16_164602_add_fiel_questinare_exp_date',1),(105,'2019_07_22_093936_create_additional_attachments_table',1),(106,'2019_07_22_105639_change_update_plus_add_rev_date',1),(107,'2019_07_22_163448_add_fiel_qsa_cek',1),(108,'2019_07_23_105325_add_location_table_aircraft_tool',1),(109,'2019_07_23_154933_add_field_engine',1),(110,'2019_07_25_112707_add_field_ata_tbl_part_number',1),(111,'2019_07_25_135458_add_fiel_doucment_evidence_other_value_and__calibration_certificate_value',1),(112,'2019_07_28_134936_create_special_test_equipments_table',1),(113,'2019_07_28_135023_create_special_documents_table',1),(114,'2019_07_28_135105_create_ndt_methods_table',1),(115,'2019_07_28_135921_create_special_materials_table',1),(116,'2019_07_28_163841_add_field_in_special_personel',1),(117,'2019_07_28_184939_create_engine_documents_table',1),(118,'2019_07_28_185000_create_engine_test_equipments_table',1),(119,'2019_07_28_185125_add_and_edit_field_table_material',1),(120,'2019_07_28_185310_create_engine_special_tools_table',1),(121,'2019_07_28_201939_add_fiel_limitation_tbl_component_request',1),(122,'2019_07_29_101948_add_field_qty_tb_engine_cons_material',1),(123,'2019_07_29_154112_add_field_engine_tbl_shop_abilily_component',1),(124,'2019_07_31_111417_add_field_capability_list_component',1),(125,'2019_07_31_125651_add_field_submit_date',1),(126,'2019_07_31_140347_add_field_attachment_egine_personels',1),(127,'2019_08_01_092827_create_tabel_apis_table',1),(128,'2019_08_05_100450_create_master_config_authorities_table',1),(129,'2019_08_15_133724_create_master_aircraft_customers_table',1),(130,'2019_08_15_143650_add_autority_and_customer_aircrat_request_table',1),(131,'2019_08_15_144423_add_field_form_type_for_rating',1),(132,'2019_08_19_114118_add_field_form_type_table_capability_list',1),(133,'2019_08_19_154747_add_field_customer_and_aircraft_rating',1),(134,'2019_08_23_160928_add_remark_deletion_tb_req_submittions',1),(135,'2019_08_23_161136_add_field_location_location_tbl_aircraft_tool_equipments',1),(136,'2019_08_26_084706_add_field_authority_value_table_component_capability_list',1),(137,'2019_08_26_085121_add_status_of_aplication_table_master_config_authority',1),(138,'2019_08_26_085202_add_date_approve_table_master_config',1),(139,'2019_08_26_121411_add_field_new_issue_table_capability_list',1),(140,'2019_08_26_135624_create_issues_table',1),(141,'2019_10_03_144131_add_field_soft_delete_table_for_rating',2),(143,'2019_10_17_115625_add_field_issue_and_revision_ontabel_masterconfigs',3),(144,'2019_10_17_165013_add_stamp_no_tb_aircraft_personel',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ndt_methods`
--

DROP TABLE IF EXISTS `ndt_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ndt_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ndt_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ndt_methods`
--

LOCK TABLES `ndt_methods` WRITE;
/*!40000 ALTER TABLE `ndt_methods` DISABLE KEYS */;
INSERT INTO `ndt_methods` VALUES (1,'Ultrasonic Inspection',NULL,'2019-08-12 13:15:02','2019-08-12 13:15:02'),(2,'Radiography Inspection',NULL,'2019-08-12 13:15:14','2019-08-12 13:17:49'),(3,'Magnetic Particle Inspection',NULL,'2019-08-12 13:15:25','2019-08-12 13:15:46'),(4,'Fluorescent Penetrant Inpection',NULL,'2019-08-12 13:16:35','2019-08-12 13:16:35'),(5,'Eddy Current Inspection',NULL,'2019-08-12 13:16:52','2019-08-12 13:17:05'),(6,'Thermographic Inspection',NULL,'2019-08-12 13:17:29','2019-08-12 13:17:29');
/*!40000 ALTER TABLE `ndt_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_numbers`
--

DROP TABLE IF EXISTS `part_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ata_chapter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_numbers`
--

LOCK TABLES `part_numbers` WRITE;
/*!40000 ALTER TABLE `part_numbers` DISABLE KEYS */;
INSERT INTO `part_numbers` VALUES (1,'4101054','LAVATORY/GALLEY VENT FAN','21-20-04',NULL,'2019-07-25 14:16:37',NULL,NULL),(2,'605457-2','MOTOR DRIVEN CENTRIFUGAL FAN','21-20-10',NULL,'2019-07-25 14:16:37',NULL,NULL),(3,'605457-3','MOTOR DRIVEN CENTRIFUGAL FAN','21-20-10',NULL,'2019-07-25 14:16:37',NULL,NULL),(4,'605457-8','MOTOR DRIVEN CENTRIFUGAL FAN','21-20-10',NULL,'2019-07-25 14:16:37',NULL,NULL),(5,'10-62009-1','CABIN AIR RECIRCULATION','21-20-18',NULL,'2019-07-25 14:16:37',NULL,NULL),(6,'645405-1','CABIN AIR RECIRCULATION','21-20-18',NULL,'2019-07-25 14:16:37',NULL,NULL),(7,'645405-2','CABIN AIR RECIRCULATION','21-20-18',NULL,'2019-07-25 14:16:37',NULL,NULL),(8,'605457-7','MOTOR DRIVEN CENTRIFUGAL FAN','21-24-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(9,'711003-2','OUTFLOW VALVE','21-33-00',NULL,'2019-07-25 14:16:37',NULL,NULL),(10,'711003-3','OUTFLOW VALVE','21-33-00',NULL,'2019-07-25 14:16:37',NULL,NULL),(11,'711003-5','OUTFLOW VALVE','21-33-00',NULL,'2019-07-25 14:16:37',NULL,NULL),(12,'10-62231-3','OUTFLOW VALVE','21-33-30',NULL,'2019-07-25 14:16:37',NULL,NULL),(13,'4063-19972-01AA','OUTFLOW VALVE','21-33-30',NULL,'2019-07-25 14:16:37',NULL,NULL),(14,'645055-2','MOTOR DRIVEN FAN','21-58-04',NULL,'2019-07-25 14:16:37',NULL,NULL),(15,'645055-3','MOTOR DRIVEN FAN','21-58-04',NULL,'2019-07-25 14:16:37',NULL,NULL),(16,'541962-1-1','ELECTROMECHANICAL ROTARY ACTUATOR','21-60-36',NULL,'2019-07-25 14:16:37',NULL,NULL),(17,'541962-4','ELECTROMECHANICAL ROTARY ACTUATOR','21-60-36',NULL,'2019-07-25 14:16:37',NULL,NULL),(18,'541962-5','ELECTROMECHANICAL ROTARY ACTUATOR','21-60-36',NULL,'2019-07-25 14:16:37',NULL,NULL),(19,'541962-6','ELECTROMECHANICAL ROTARY ACTUATOR','21-60-36',NULL,'2019-07-25 14:16:37',NULL,NULL),(20,'541932-1-1','ROTARY ACTUATOR','21-60-54',NULL,'2019-07-25 14:16:37',NULL,NULL),(21,'10-61472-10','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(22,'10-61472-8','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(23,'AR6460M1MOD2','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(24,'AR6460M2MOD1','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(25,'AR6460M2MOD2','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(26,'AR6460M2MOD3','ROTARY ACTUATOR','22-11-01',NULL,'2019-07-25 14:16:37',NULL,NULL),(27,'111RAA3','ACTUATOR ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(28,'102842LX','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(29,'106788A103','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(30,'106788A128','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(31,'106788A131','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(32,'106788A140','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(33,'106788A205','ACTUATOR',NULL,NULL,NULL,NULL,NULL),(34,'700842','CONSTANT SPEED DRIVE',NULL,NULL,NULL,NULL,NULL),(35,'731753','CONSTANT SPEED DRIVE',NULL,NULL,NULL,NULL,NULL),(36,'735511A','CONSTANT SPEED DRIVE',NULL,NULL,NULL,NULL,NULL),(37,'948F458-1','GENERATOR  CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(38,'948F458-2','GENERATOR  CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(39,'948F458-3','GENERATOR  CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(40,'948F458-4','GENERATOR  CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(41,'948F458-5','GENERATOR  CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(42,'915F213-3','BUS PROTECTION PANEL',NULL,NULL,NULL,NULL,NULL),(43,'915F213-4','BUS PROTECTION PANEL',NULL,NULL,NULL,NULL,NULL),(44,'915F213-2','BUS PROTECTION PANEL',NULL,NULL,NULL,NULL,NULL),(45,'941D335-2','CIRCUIT BREAKER',NULL,NULL,NULL,NULL,NULL),(46,'65B46101-5','GEN. CONTROL MODULEN  ASSY',NULL,NULL,NULL,NULL,NULL),(47,'65B46101-7','GEN. CONTROL MODULEN  ASSY',NULL,NULL,NULL,NULL,NULL),(48,'915F212-4','GENERATOR CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(49,'915F212-5','GENERATOR CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(50,'915F212-6','GENERATOR CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(51,'915F212-7','GENERATOR CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(52,'915F212-8','GENERATOR CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(53,'2-792-01','BATTERY CHARGER',NULL,NULL,NULL,NULL,NULL),(54,'2-792-02','BATTERY CHARGER',NULL,NULL,NULL,NULL,NULL),(55,'BFS24','BATTERY AND CHARGER SYSTEM',NULL,NULL,NULL,NULL,NULL),(56,'S283W008-3','BATTERY AND CHARGER SYSTEM',NULL,NULL,NULL,NULL,NULL),(57,'4-254-02','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(58,'4-254-03','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(59,'4-254-04','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(60,'S282T002-2','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(61,'S282T002-4','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(62,'S282T002-5','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(63,'S282T002-6','BATTRERY CHARGER',NULL,NULL,NULL,NULL,NULL),(64,'40179-7','AIRCRAFT BATTERY',NULL,NULL,NULL,NULL,NULL),(65,'1151952-10','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(66,'1151952-11','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(67,'1151952-12','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(68,'1151952-13','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(69,'1151952-14','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(70,'1151952-5','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(71,'1151952-6','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(72,'1151952-7','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(73,'1151952-8','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(74,'1151952-9','M1720 STANDBY POWER CONTROL UNIT',NULL,NULL,NULL,NULL,NULL),(75,'2021-2-000-1','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(76,'022-1-000','HOT WATER BOILER',NULL,NULL,NULL,NULL,NULL),(77,'022-1-000-1','HOT WATER BOILER',NULL,NULL,NULL,NULL,NULL),(78,'416-0001-1','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(79,'416-0001-1P','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(80,'416-0001-3','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(81,'416-0001-5','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(82,'416-0001-7','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(83,'416-0001-9','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(84,'416-0001-13','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(85,'416-0001-15','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(86,'416-0001-17','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(87,'416-0001-19','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(88,'416-0001-21','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(89,'416-0001-23','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(90,'416-0001-25','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(91,'416-0001-29','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(92,'416-0001-35','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(93,'416-0001-39','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(94,'416-0001-41','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(95,'416-0001-45','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(96,'416-0001-47','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(97,'416-0001-49','COFFEE MAKER',NULL,NULL,NULL,NULL,NULL),(98,'65-52810-19','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(99,'65-52810-25','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(100,'65-52810-28','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(101,'65-52810-57','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(102,'65-52810-59','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(103,'65-52810-6','AIR CONDITIONING ACCESSORY UNIT','21-09-02',NULL,'2019-07-25 14:16:37',NULL,NULL),(104,'763810-1','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(105,'763810-2','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(106,'763810-3','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(107,'763810-4','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(108,'763810-5','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(109,'763810-6','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(110,'763810-7','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(111,'763810-8','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(112,'763960-1','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:37',NULL,NULL),(113,'763960-2','CABIN PRESSURE CONTROLLER','21-31-11',NULL,'2019-07-25 14:16:38',NULL,NULL),(114,'607518-2 SERIES 2','TEMPERATURE CONTROL','21-60-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(115,'607518-2 SERIES 3','TEMPERATURE CONTROL   ','21-60-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(116,'607518-2 SERIES 4','TEMPERATURE CONTROL','21-60-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(117,'10-60498-13','CABIN TEMPERATURE CONTROL','21-60-56',NULL,'2019-07-25 14:16:38',NULL,NULL),(118,'548376-6 SERIES 3','CABIN TEMPERATURE CONTROL','21-60-56',NULL,'2019-07-25 14:16:38',NULL,NULL),(119,'607510-2 SERIES 3','TEMPERATURE CONTROL','21-60-57',NULL,'2019-07-25 14:16:38',NULL,NULL),(120,'607510-3 SERIES 2','TEMPERATURE CONTROL','21-60-59',NULL,'2019-07-25 14:16:38',NULL,NULL),(121,'607510-3 SERIES 3','TEMPERATURE CONTROL','21-60-59',NULL,'2019-07-25 14:16:38',NULL,NULL),(122,'622814-2 SESIES 1','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(123,'622814-2 SERIES 2','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(124,'622814-3 SERIES 1','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(125,'622814-3 SERIES 2','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(126,'622814-3 SERIES 3','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(127,'622814-4 SERIES 1','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(128,'622814-4 Series 2 Mod 5','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(129,'622814-4 Series 3 Mod 5','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(130,'622814-5 SERIES 1','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(131,'622814-5 SERIES 2','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(132,'622814-5 SERIES 3','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(133,'622814-5 SERIES 4','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(134,'622814-5 SERIES 5','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(135,'622814-5 SERIES 6','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(136,'622814-5 SERIES 7','PACK/ZONE TEMPERATURE CONTROLLER','21-61-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(137,'548376-5 SERIES 1','CABIN TEMPERATURE CONTROL','21-61-39',NULL,'2019-07-25 14:16:38',NULL,NULL),(138,'65-52820-1','INTEGRATED FLIGHT SYSTEM ACCESS. UNIT','22-10-40',NULL,'2019-07-25 14:16:38',NULL,NULL),(139,'65-52820-2','INTEGRATED FLIGHT SYSTEM ACCESS. UNIT','22-10-40',NULL,'2019-07-25 14:16:38',NULL,NULL),(140,'65-52817-5','AUTOMATIC FLIGHT CONT. ACCESS.','22-10-50',NULL,'2019-07-25 14:16:38',NULL,NULL),(141,'65-52817-17','AUTOMATIC FLIGHT CONT. ACCESS.','22-10-51',NULL,'2019-07-25 14:16:38',NULL,NULL),(142,'65-52817-9','AUTOMATIC FLIGHT CONT. ACCESS.','22-10-51',NULL,'2019-07-25 14:16:38',NULL,NULL),(143,'69-37399-1','IRS MASTER CAUTION','22-10-55',NULL,'2019-07-25 14:16:38',NULL,NULL),(144,'69-37399-7','IRS MASTER CAUTION','22-10-55',NULL,'2019-07-25 14:16:38',NULL,NULL),(145,'69-37399-9','IRS MASTER CAUTION','22-10-55',NULL,'2019-07-25 14:16:38',NULL,NULL),(146,'2590623-911','ROLL COMPUTER',NULL,NULL,NULL,NULL,NULL),(147,'4051600-913','FLIGTH CONTROL COMPUTER',NULL,NULL,NULL,NULL,NULL),(148,'4051600-914','FLIGTH CONTROL COMPUTER',NULL,NULL,NULL,NULL,NULL),(149,'4051600-923','FLIGTH CONTROL COMPUTER',NULL,NULL,NULL,NULL,NULL),(150,'4051601-932','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(151,'4051601-935','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(152,'4051601-936','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(153,'4051601-937','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(154,'4051601-939','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(155,'4051601-938','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(156,'4051601-940','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(157,'2591415-902','AUTO STAB TRIM UNIT',NULL,NULL,NULL,NULL,NULL),(158,'60B00013-702','AUTO STAB TRIM UNIT',NULL,NULL,NULL,NULL,NULL),(159,'2590622-932','PITCH COMPUTER',NULL,NULL,NULL,NULL,NULL),(160,'3757202-1','YAW DAMPER COMPUTER',NULL,NULL,NULL,NULL,NULL),(161,'10-62038-239','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(162,'10-62038-237','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(163,'4082260-937','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(164,'4082260-939','MODE CONTROL PANEL',NULL,NULL,NULL,NULL,NULL),(165,'755SUE2-4','AUTOTHROTTLE COMPUTER',NULL,NULL,NULL,NULL,NULL),(166,'233U3207-19','MISCELLANEOUS  SWITCHING  CONT.',NULL,NULL,NULL,NULL,NULL),(167,'65-52804-42','AUDIO ACCESSORY UNIT',NULL,NULL,NULL,NULL,NULL),(168,'65-52804-42 MOD A','AUDIO ACCESSORY UNIT',NULL,NULL,NULL,NULL,NULL),(169,'65-52804-61','AUDIO ACCESSORY UNIT',NULL,NULL,NULL,NULL,NULL),(170,'65-52804-61 MOD A','AUDIO ACCESSORY UNIT',NULL,NULL,NULL,NULL,NULL),(171,'65-52806-110','MISC. SOLID STATE ACC. UNIT',NULL,NULL,NULL,NULL,NULL),(172,'65-52806-291','MISC. SOLID STATE ACC. UNIT',NULL,NULL,NULL,NULL,NULL),(173,'65-52806-344','MISC. SOLID STATE ACC. UNIT',NULL,NULL,NULL,NULL,NULL),(174,'65-52806-344 MOD A','MISC. SOLID STATE ACC. UNIT',NULL,NULL,NULL,NULL,NULL),(175,'65-52806-346','MISC. SOLID STATE ACC. UNIT',NULL,NULL,NULL,NULL,NULL),(176,'65-52806-359','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(177,'65-52806-359MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(178,'65-52806-361','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(179,'65-52806-361 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(180,'65-52806-363','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(181,'65-52806-363 MODA','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(182,'65-52806-365','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(183,'65-52806-365 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(184,'65-52806-367','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(185,'65-52806-367 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(186,'65-52806-369','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(187,'65-52806-371','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(188,'65-52806-371 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(189,'65-52806-373','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(190,'65-52806-373 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(191,'65-52806-375','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(192,'65-52806-375 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(193,'65-52806-377','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(194,'65-52806-378','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(195,'65-52806-381','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(196,'65-52806-382','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(197,'65-52806-383','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(198,'65-52806-384','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(199,'65-52806-385','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(200,'65-52806-386','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(201,'65-52806-387','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(202,'65-52806-388','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(203,'65-52806-402','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(204,'65-52806-402 MOD A','MISC.SOLID-STATE SWITCHING ACCESSORY UNIT ASSEMBLY, M278',NULL,NULL,NULL,NULL,NULL),(205,'1466M14G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(206,'1466M14G02','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(207,'1466M14G03','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(208,'1466M73G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(209,'1466M74G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(210,'1466M77G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(211,'1466M88G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(212,'2046M50G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(213,'2046M51G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(214,'2046M52G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(215,'9335M34G07','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(216,'9386M83G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(217,'9386M83G02','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(218,'9386M83G03','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(219,'9386M85G01','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(220,'9386M85G02','LOW PRESS. TURBINE COOLING AIR TUBE','72-09-00',NULL,'2019-07-25 14:16:38',NULL,NULL),(221,'335-002-304-0','BOOSTER BLADES STAGE 2','72-21-02',NULL,'2019-07-25 14:16:38',NULL,NULL),(222,'335-002-305-0','BOOSTER BLADES STAGE 2','72-21-02',NULL,'2019-07-25 14:16:38',NULL,NULL),(223,'335-002-405-0','BOOSTER BLADES STAGE 3','72-21-02',NULL,'2019-07-25 14:16:38',NULL,NULL),(224,'335-002-407-0','BOOSTER BLADES STAGE 3','72-21-02',NULL,'2019-07-25 14:16:38',NULL,NULL),(225,'335-002-505-0','BOOSTER BLADES STAGE 4','72-21-02',NULL,'2019-07-25 14:16:38',NULL,NULL),(226,'335-009-306-0','SPOOL BOOSTER','72-21-04',NULL,'2019-07-25 14:16:38',NULL,NULL),(227,'335-106-402-0','SPINNER FRONT CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(228,'335-106-405-0','SPINNER FRONT CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(229,'335-106-403-0','SPINNER FRONT CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(230,'335-106-404-0','SPINNER FRONT CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(231,'335-011-205-0','SPINNER REAR CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(232,'335-011-207-0','SPINNER REAR CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(233,'335-011-208-0','SPINNER REAR CONE','72-21-05',NULL,'2019-07-25 14:16:38',NULL,NULL),(234,'335-010-002-0','BOOSTER BLADE INTERSTAGE SPACERS','72-21-07',NULL,'2019-07-25 14:16:38',NULL,NULL),(235,'335-009-804-0','FORWARD ROTATING AIRSEAL','72-21-08',NULL,'2019-07-25 14:16:38',NULL,NULL),(236,'335-009-805-0','FORWARD ROTATING AIRSEAL','72-21-08',NULL,'2019-07-25 14:16:38',NULL,NULL),(237,'335-009-806-0','FORWARD ROTATING AIRSEAL','72-21-08',NULL,'2019-07-25 14:16:38',NULL,NULL),(238,'335-009-903-0','FORWARD ROTATING AIRSEAL','72-21-08',NULL,'2019-07-25 14:16:38',NULL,NULL),(239,'335-006-607-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(240,'335-006-615-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(241,'335-006-623-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(242,'335-006-630-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(243,'335-006-609-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(244,'335-006-616-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(245,'335-006-624-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(246,'335-006-631-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(247,'335-006-610-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(248,'335-006-617-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(249,'335-006-625-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(250,'335-006-632-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(251,'335-006-611-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(252,'335-006-619-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(253,'335-006-626-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(254,'335-006-633-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(255,'335-006-612-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(256,'335-006-620-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(257,'335-006-627-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:38',NULL,NULL),(258,'335-006-634-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(259,'335-006-613-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(260,'335-006-621-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(261,'335-006-628-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(262,'335-006-614-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(263,'335-006-622-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(264,'335-006-629-0','BOOSTER VANE STAGE 3','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(265,'335-006-708-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(266,'335-006-718-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(267,'335-006-724-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(268,'335-006-730-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(269,'335-006-709-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(270,'335-006-719-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(271,'335-006-725-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(272,'335-006-731-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(273,'335-006-710-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(274,'335-006-720-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(275,'335-006-726-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(276,'335-006-732-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(277,'335-006-711-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(278,'335-006-721-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(279,'335-006-727-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(280,'335-006-733-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(281,'335-006-714-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(282,'335-006-722-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(283,'335-006-728-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(284,'335-006-734-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(285,'335-006-716-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(286,'335-006-723-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(287,'335-006-729-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(288,'335-006-717-0','BOOSTER VANE STAGE 4','72-21-09',NULL,'2019-07-25 14:16:39',NULL,NULL),(289,'335-105-305-0','DAMPER ASSEMBLY','72-21-16',NULL,'2019-07-25 14:16:39',NULL,NULL),(290,'335-006-405-0','FAN SHAFT','72-22-01',NULL,'2019-07-25 14:16:39',NULL,NULL),(291,'335-006-407-0','FAN SHAFT','72-22-01',NULL,'2019-07-25 14:16:39',NULL,NULL),(292,'335-003-304-0','NO.1 BEARING SUPPORT ASSY','72-22-02',NULL,'2019-07-25 14:16:39',NULL,NULL),(293,'335-003-305-0','NO.1 BEARING SUPPORT ASSY','72-22-02',NULL,'2019-07-25 14:16:39',NULL,NULL),(294,'335-003-308-0','NO.1 BEARING SUPPORT ASSY','72-22-02',NULL,'2019-07-25 14:16:39',NULL,NULL),(295,'335-010-102-0','NO.2 BEARING SUPPORT ASSY','72-22-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(296,'335-010-104-0','NO.2 BEARING SUPPORT ASSY','72-22-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(297,'301-298-208-0','REAR ROTATING AIR / OIL SEAL','72-22-06',NULL,'2019-07-25 14:16:39',NULL,NULL),(298,'301-287-119-0','STATIONARY AIR OIL SEAL','72-22-11',NULL,'2019-07-25 14:16:39',NULL,NULL),(299,'305-439-401-0','STATIONARY AIR OIL SEAL','72-22-11',NULL,'2019-07-25 14:16:39',NULL,NULL),(300,'305-439-402-0','STATIONARY AIR OIL SEAL','72-22-11',NULL,'2019-07-25 14:16:39',NULL,NULL),(301,'301-537-905-0','NO.1 BEARING INNER RACE RETAINING NUT','72-22-13',NULL,'2019-07-25 14:16:39',NULL,NULL),(302,'335-034-501-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(303,'335-034-622-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(304,'335-034-502-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(305,'335-034-623-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(306,'335-034-503-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(307,'335-034-624-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(308,'335-034-604-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(309,'335-034-701-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(310,'335-034-605-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(311,'335-034-702-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(312,'335-034-606-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(313,'335-034-703-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(314,'335-034-621-0','FAN OUTLET GUIDE VANE (ALUMINUM)','72-23-03',NULL,'2019-07-25 14:16:39',NULL,NULL),(315,'334-007-110-0','HOUSING INNER RADIAL DRIVE SHAFT','72-23-05',NULL,'2019-07-25 14:16:39',NULL,NULL),(316,'335-030-602-0','HOUSING INNER RADIAL DRIVE SHAFT','72-23-05',NULL,'2019-07-25 14:16:39',NULL,NULL),(317,'335-030-701-0','HOUSING INNER RADIAL DRIVE SHAFT','72-23-05',NULL,'2019-07-25 14:16:39',NULL,NULL),(318,'301-473-720-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(319,'335-031-311-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(320,'335-034-101-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(321,'301-473-725-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(322,'335-031-501-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(323,'335-034-111-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(324,'305-082-809-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(325,'335-031-502-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(326,'335-034-201-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(327,'305-082-812-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(328,'335-031-601-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(329,'335-034-209-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(330,'335-031-201-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(331,'335-031-611-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(332,'335-085-003-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(333,'335-031-211-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(334,'335-084-803-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(335,'335-085-103-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(336,'335-031-301-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(337,'335-084-903-0','FAN DUCT PANEL','72-23-07',NULL,'2019-07-25 14:16:39',NULL,NULL),(338,'C23102-001','LAVATORY UNITS',NULL,NULL,NULL,NULL,NULL),(339,'C23502-001','LAVATORY UNITS',NULL,NULL,NULL,NULL,NULL),(340,'C23602-001','LAVATORY UNITS',NULL,NULL,NULL,NULL,NULL),(341,'149A7151','WING TO BODY FAIRING-UPPER FWD FAIRING',NULL,NULL,NULL,NULL,NULL),(342,'65-73294-SERIES','NOSE RADOME',NULL,NULL,NULL,NULL,NULL),(343,'113A2700-1','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(344,'113A2700-15','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(345,'113A2700-16','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(346,'113A2700-17','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(347,'113A2700-18','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(348,'113A2700-2','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(349,'113A2700-21','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(350,'113A2700-22','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(351,'113A2700-23','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(352,'113A2700-24','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(353,'113A2700-25','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(354,'113A2700-26','AFT INBOARD FLAP ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(355,'113A4200-4','NO.1 & 2 OUTBOARD GND. SPOILER ASSY.',NULL,NULL,NULL,NULL,NULL),(356,'113A4300-1','FLIGHT SPOILER ASSY NO.3 & 10',NULL,NULL,NULL,NULL,NULL),(357,'113A4300-2','FLIGHT SPOILER ASSY NO.3 & 10',NULL,NULL,NULL,NULL,NULL),(358,'113A4300-3','FLIGHT SPOILER ASSY NO.3 & 10',NULL,NULL,NULL,NULL,NULL),(359,'113A4300-4','FLIGHT SPOILER ASSY NO.3 & 10',NULL,NULL,NULL,NULL,NULL),(360,'113A4400-1','FLIGHT SPOILER ASSY NO.4 & 9',NULL,NULL,NULL,NULL,NULL),(361,'113A4400-2','FLIGHT SPOILER ASSY NO.4 & 9',NULL,NULL,NULL,NULL,NULL),(362,'113A4400-3','FLIGHT SPOILER ASSY NO.4 & 9',NULL,NULL,NULL,NULL,NULL),(363,'113A4400-4','FLIGHT SPOILER ASSY NO.4 & 9',NULL,NULL,NULL,NULL,NULL),(364,'113A4500-1','FLIGHT SPOILER ASSY NO.5 & 8',NULL,NULL,NULL,NULL,NULL),(365,'113A4500-2','FLIGHT SPOILER ASSY NO.5 & 8',NULL,NULL,NULL,NULL,NULL),(366,'113A4500-3','FLIGHT SPOILER ASSY NO.5 & 8',NULL,NULL,NULL,NULL,NULL),(367,'113A4500-4','FLIGHT SPOILER ASSY NO.5 & 8',NULL,NULL,NULL,NULL,NULL),(368,'113A4100-1','NO.1 & 2 OUTBOARD GND. SPOILER ASSY.',NULL,NULL,NULL,NULL,NULL),(369,'113A4100-2','NO.1 & 2 OUTBOARD GND. SPOILER ASSY.',NULL,NULL,NULL,NULL,NULL),(370,'113A4100-3','NO.1 & 2 OUTBOARD GND. SPOILER ASSY.',NULL,NULL,NULL,NULL,NULL),(371,'113A4600-1','FLIGHT SPOILER ASSY NO.6 & 7',NULL,NULL,NULL,NULL,NULL),(372,'113A4600-2','FLIGHT SPOILER ASSY NO.6 & 7',NULL,NULL,NULL,NULL,NULL),(373,'113A4600-3','FLIGHT SPOILER ASSY NO.6 & 7',NULL,NULL,NULL,NULL,NULL),(374,'113A4600-4','FLIGHT SPOILER ASSY NO.6 & 7',NULL,NULL,NULL,NULL,NULL),(375,'65B02300-1','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(376,'65B02300-48','INBOARD SPOILER PANEL ASSY. NO. 5 AND 8',NULL,NULL,NULL,NULL,NULL),(377,'65B02300-50','INBOARD SPOILER PANEL ASSY. NO. 5 AND 8',NULL,NULL,NULL,NULL,NULL),(378,'65B02300-51','INBOARD SPOILER PANEL ASSY. NO. 5 AND 8',NULL,NULL,NULL,NULL,NULL),(379,'65B02300-52','INBOARD SPOILER PANEL ASSY. NO. 5 AND 8',NULL,NULL,NULL,NULL,NULL),(380,'65B02300-53','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(381,'65B02300-56','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(382,'65B02300-65','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(383,'65B02300-66','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(384,'65B02300-67','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(385,'65B02300-68','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(386,'65B02300-70','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(387,'65B02300-71','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(388,'65B02300-75','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(389,'65B02300-76','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(390,'65B02300-77','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(391,'65B02300-79','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(392,'65B02300-81','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(393,'65B02300-83','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(394,'65B02300-85','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(395,'65B02300-87','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(396,'65B02300-89','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(397,'65B02300-91SP','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(398,'65B02300-92','INBOARD SPOILER PANEL ASSY. NO. 5 & 8',NULL,NULL,NULL,NULL,NULL),(399,'65B02310-1','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(400,'65B02310-37','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(401,'65B02310-39','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(402,'65B02310-40','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(403,'65B02310-41','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(404,'65B02310-42','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(405,'65B02310-50','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(406,'65B02310-51','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(407,'65B02310-52','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(408,'65B02310-53','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(409,'65B02310-55','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(410,'65B02310-56','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(411,'65B02310-58','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(412,'65B02310-59','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(413,'65B02310-60','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(414,'65B02310-61','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(415,'65B02310-63','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(416,'65B02310-65','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(417,'65B02310-67','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(418,'65B02310-69','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(419,'65B02310-71','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(420,'65B02310-73A','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(421,'65B02310-73B','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(422,'65B02310-73C','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(423,'65B02310-73D','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(424,'65B02310-73E','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(425,'65B02310-73G','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(426,'65B02310-74','INBOARD SPOILER PANEL ASSY. NO. 6 & 7',NULL,NULL,NULL,NULL,NULL),(427,'65B02250-1','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(428,'65B02250-36','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(429,'65B02250-38','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(430,'65B02250-41','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(431,'65B02250-43','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(432,'65B02250-49','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(433,'65B02250-51','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(434,'65B02250-52','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(435,'65B02250-53','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(436,'65B02250-54','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(437,'65B02250-55','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(438,'65B02250-58','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(439,'65B02250-59','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(440,'65B02250-60','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(441,'65B02250-61','INBOARD SPOILER PANEL ASSEMBLY',NULL,NULL,NULL,NULL,NULL),(442,'335-011-303-0','FORWARD ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(443,'335-011-305-0','FORWARD ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(444,'335-011-307-0','FORWARD ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(445,'335-011-903-0','MID ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(446,'335-011-904-0','MID ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(447,'335-017-202-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(448,'335-017-315-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(449,'335-022-806-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(450,'335-022-914-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(451,'335-038-109-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(452,'335-038-215-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(453,'335-063-104-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(454,'335-063-611-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(455,'335-017-207-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(456,'335-017-403-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(457,'335-022-808-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(458,'335-038-003-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(459,'335-038-110-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(460,'335-038-217-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(461,'335-063-109-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(462,'335-063-613-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(463,'335-017-209-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(464,'335-017-409-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(465,'335-022-811-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(466,'335-038-009-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(467,'335-038-112-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(468,'335-038-303-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(469,'335-063-111-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(470,'335-063-616-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(471,'335-017-212-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(472,'335-017-410-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(473,'335-022-903-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(474,'335-038-010-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(475,'335-038-115-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(476,'335-038-310-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(477,'335-063-113-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(478,'335-017-303-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:38','2019-07-25 14:19:38',NULL,NULL),(479,'335-017-413-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(480,'335-022-908-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(481,'335-038-012-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(482,'335-038-203-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(483,'335-038-311-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(484,'335-063-115-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(485,'335-017-310-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(486,'335-017-416-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(487,'335-022-909-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(488,'335-038-015-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(489,'335-038-210-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(490,'335-038-313-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(491,'335-063-606-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(492,'335-017-312-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(493,'335-022-802-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(494,'335-022-911-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(495,'335-038-103-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(496,'335-038-212-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(497,'335-038-316-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(498,'335-063-610-0','AFT ACOUSTIC PANEL','72-23-08','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(499,'9336M78G01','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(500,'9339M40G01','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(501,'9339M40G02','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(502,'9339M40G03','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(503,'9339M40G04','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(504,'9339M40G05','NO.3 BRG FWD STATIONARY OIL SEAL','72-23-19','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(505,'1278M61G02','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(506,'1663M19G05','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(507,'1663M90G08','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(508,'1663M90G19','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(509,'1960M96G03','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(510,'1960M96G10','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(511,'1960M96G20','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(512,'1960M96G30','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(513,'1960M96G40','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(514,'1960M96G49','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(515,'1279M52G03','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(516,'1663M19G07','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(517,'1663M90G09','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(518,'1663M90G20','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(519,'1960M96G04','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(520,'1960M96G12','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(521,'1960M96G22','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(522,'1960M96G31','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(523,'1960M96G41','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(524,'1960M96G51','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(525,'1279M52G05','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(526,'1663M19G08','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(527,'1663M90G10','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(528,'1663M91G01','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(529,'1960M96G05','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(530,'1960M96G14','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(531,'1960M96G23','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(532,'1960M96G32','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(533,'1960M96G42','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(534,'1960M96G53','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(535,'1279M52G06','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(536,'1663M19G10','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(537,'1663M90G11','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL),(538,'1663M91G03','NO.3 BRG AFT STATIONARY SEAL','72-23-20','2019-07-25 14:19:39','2019-07-25 14:19:39',NULL,NULL);
/*!40000 ALTER TABLE `part_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaires`
--

DROP TABLE IF EXISTS `questionnaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionnaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_request_id` int(11) NOT NULL,
  `questionare` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaires`
--

LOCK TABLES `questionnaires` WRITE;
/*!40000 ALTER TABLE `questionnaires` DISABLE KEYS */;
INSERT INTO `questionnaires` VALUES (1,1,'[{\"answer\": \"\", \"remark\": \"\", \"question\": \"Is GMF Form No. GMF/Q-268 use the current revision?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is GMF Form No. GMF/Q-267 use the current revision?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the Aircraft Data complete?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the maintenance area ticked?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the maintenance ability tracking number duplicates ?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the approval request is complete?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the Authorithy capability request mentioned in the approval request?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is all requirements ticked?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is maintenance area correct?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Aircraft type and manufacturer correct?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is manufacturer\'s document available?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the tools and equipment available?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is material available?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is qualified personnel available? As per scope rating request?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the ability ticked?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is any special work to be order outside filled?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is limitation filled?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is AMEL holder personnel expiration date valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is AMEL holder personnel training completed and valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is AMEL holder personnel could work for Unit mentioned?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is AMEL Holder has applicable and valid authorization?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Cof C of AMEL Holder current?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Certifying Staff personnel expiration date valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Certifying Staff\'s training completed and still valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Certifying Staff has applicable and valid authorization?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Cof C of Certifying Staff current?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is aircraft document use the current revison ?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is material available in SWIFT?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Special Tools and equipment available?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is Facility complete? Is Equipment  available (jack, dock)?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the facility/hangar capable for maintain that Aircraft?\", \"max_score\": \"\"}]',NULL,'2019-08-21 14:13:32'),(2,2,'[{\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah document Manual Status Confirmation (GMF/Q-324) atau screenshoot dari tech pub available dan current?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah file maintenance manual sudah available?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah PD Sheet sudah didevelop secara proper mengacu ke manual? (Reference, Doc. No. , Rev & Date, Content, Tool & Equipment, Value of measurement, etc)\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah PD Sheet sudah mencantumkan aspek critical item (misal FOD Prevention)?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah document equivalent tool sudah dibuat untuk tools equivalent mengacu ke list of test equipment & special tools di shop ability?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah document Equivalent Tools/ Equipment Analysis Report sudah mengacu kepada procedure dan ada document pendukung nya (if required, seperti drawing dsb)?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah nominated Certifying Staff memiliki training component yang proper sesuai dengan component yang diajukan?\\nBisa dari:    \\na). OEM, atau\\nb). OEM recognized training organization (147 yang di approved OEM), atau c).Appropriately MRO dengan syarat:\\n- Pengajar sudah mendapatkan training dengan level dan P/N yang related\\n- Pengajar sudah mendapatkan otorisasi dari MRO dan dapat menunjukkan experience sesuai P/N component tsb.\\n- Training syllabus sudah approved by Engineering & Quality Manager\\n- Ada component untuk practical training purpose\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Engineering Information (EI) yang menyatakan proposed P/N adalah simple component\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Statement dari manufacture/vendor “no training needed”\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Certificate training untuk reference component similarity\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Sample 3 maintenance record untuk referenced component similarity released by nominated CS (at least pelaksanaan 6 bulan terakhir)\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Record pelaksanaan demo untuk component yang diproposed.\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Untuk component yang memiliki test bench equipment atau special tools, apakah Certifying Staff memiliki training Test bench atau special tools tsb (if required)?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah nominated Certifying Staff memiliki authorization yang applicable dan valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah nominated Certifying Staff dan technicians memiliki C of C yang valid?\", \"max_score\": \"\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"Apakah nominated Certifying Staff dan technicians memiliki PAL (Personnal Ability List) yang applicable sesuai P/N yang diajukan?\", \"max_score\": \"\"}]',NULL,'2019-05-24 13:05:28'),(3,3,'[{\"answer\": \"\", \"remark\": \"\", \"question\": \"Is the certificate of competence complete?\"}]',NULL,'2019-08-21 13:49:29'),(4,4,'[{\"answer\": \"\", \"remark\": \"\", \"question\": \"ABCD\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"DEF\"}]',NULL,'2019-08-16 15:50:49'),(5,5,'[{\"answer\": \"\", \"remark\": \"\", \"question\": \"apakah certificate valid?\", \"max_score\": \"30\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"apakah vendor jelas?\", \"max_score\": \"30\"}, {\"answer\": \"\", \"remark\": \"\", \"question\": \"approval lengkap?\", \"max_score\": \"40\"}]',NULL,'2019-07-24 15:11:09');
/*!40000 ALTER TABLE `questionnaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_histories`
--

DROP TABLE IF EXISTS `request_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_histories`
--

LOCK TABLES `request_histories` WRITE;
/*!40000 ALTER TABLE `request_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_submittions`
--

DROP TABLE IF EXISTS `request_submittions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_submittions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `master_request_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `aproval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_read` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` json DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step_request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qsa_part_approve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `remark_deletion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_approve` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_submittions`
--

LOCK TABLES `request_submittions` WRITE;
/*!40000 ALTER TABLE `request_submittions` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_submittions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_documents`
--

DROP TABLE IF EXISTS `special_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `no_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_date` date DEFAULT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_status_confirmation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_maintenance_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_pd_sheet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_documents`
--

LOCK TABLES `special_documents` WRITE;
/*!40000 ALTER TABLE `special_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_materials`
--

DROP TABLE IF EXISTS `special_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_materials`
--

LOCK TABLES `special_materials` WRITE;
/*!40000 ALTER TABLE `special_materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_part_lists`
--

DROP TABLE IF EXISTS `special_part_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_part_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `example_part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_part_lists`
--

LOCK TABLES `special_part_lists` WRITE;
/*!40000 ALTER TABLE `special_part_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_part_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_personels`
--

DROP TABLE IF EXISTS `special_personels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_personels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` text COLLATE utf8mb4_unicode_ci,
  `auth_no_stamp_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope_competency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nominate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_competence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_authorization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_personels`
--

LOCK TABLES `special_personels` WRITE;
/*!40000 ALTER TABLE `special_personels` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_personels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_requests`
--

DROP TABLE IF EXISTS `special_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_submittion_id` int(11) NOT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` text COLLATE utf8mb4_unicode_ci,
  `engine_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aircraft_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ata_chapter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workshop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_rating` json DEFAULT NULL,
  `facilities` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_tools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_equipment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualified_personel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appropriate_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manual_revision` json DEFAULT NULL,
  `aproval_request_carry_out` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_requests`
--

LOCK TABLES `special_requests` WRITE;
/*!40000 ALTER TABLE `special_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_sheet_lists`
--

DROP TABLE IF EXISTS `special_sheet_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_sheet_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pd_sheet_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_sheet_lists`
--

LOCK TABLES `special_sheet_lists` WRITE;
/*!40000 ALTER TABLE `special_sheet_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_sheet_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_shop_abilities`
--

DROP TABLE IF EXISTS `special_shop_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_shop_abilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `shop_maintenance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_ability_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary_of_maintenance` json DEFAULT NULL,
  `document_required` text COLLATE utf8mb4_unicode_ci,
  `test_equipment_part_number` text COLLATE utf8mb4_unicode_ci,
  `test_equipment_part_name` text COLLATE utf8mb4_unicode_ci,
  `special_tool_part_number` text COLLATE utf8mb4_unicode_ci,
  `special_tool_part_name` text COLLATE utf8mb4_unicode_ci,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `manufacture_documentation_drawing` text COLLATE utf8mb4_unicode_ci,
  `inspection` text COLLATE utf8mb4_unicode_ci,
  `tool_equipment` text COLLATE utf8mb4_unicode_ci,
  `special_work` text COLLATE utf8mb4_unicode_ci,
  `particular` text COLLATE utf8mb4_unicode_ci,
  `available_qualified` text COLLATE utf8mb4_unicode_ci,
  `ability_inspection` tinyint(1) DEFAULT NULL,
  `ability_testing` tinyint(1) DEFAULT NULL,
  `ability_modification` tinyint(1) DEFAULT NULL,
  `ability_repair` tinyint(1) DEFAULT NULL,
  `ability_overhauled` tinyint(1) DEFAULT NULL,
  `consumable_material` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ndt_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_facility` text COLLATE utf8mb4_unicode_ci,
  `qualified_personel` json DEFAULT NULL,
  `equipment_tools` json DEFAULT NULL,
  `ability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_shop_abilities`
--

LOCK TABLES `special_shop_abilities` WRITE;
/*!40000 ALTER TABLE `special_shop_abilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_shop_abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_test_equipments`
--

DROP TABLE IF EXISTS `special_test_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_test_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_test_equipments`
--

LOCK TABLES `special_test_equipments` WRITE;
/*!40000 ALTER TABLE `special_test_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_test_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_tools`
--

DROP TABLE IF EXISTS `special_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_submittion_id` int(11) NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tool_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_tools`
--

LOCK TABLES `special_tools` WRITE;
/*!40000 ALTER TABLE `special_tools` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_apis`
--

DROP TABLE IF EXISTS `tabel_apis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabel_apis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_apis`
--

LOCK TABLES `tabel_apis` WRITE;
/*!40000 ALTER TABLE `tabel_apis` DISABLE KEYS */;
INSERT INTO `tabel_apis` VALUES (1,'soe','http://172.16.40.238/codeigniter-restserver/Employee_amel_gmfauth?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4','api untuk user soe',NULL,NULL),(2,'scope_soe','http://172.16.40.238/codeigniter-restserver/licence?nopeg={id}&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa2lrLmRldkBnbWFpbC5jb20ifQ.SnRhtd9P6A9zpvUAv0yE5aNlTMleB6NgOd90DurstZk','api untuk mengambil scope dll per id number soe ada paramemter $id di nopeg',NULL,NULL),(3,'techpub','https://etechpub.gmf-aeroasia.co.id/index.php/api/documents/{search_type}/{search}/token/o84ok8go04ckc008scs0wc0g40g884sockck84ks','api untuk techpub ada parameter {search_type} dan {search }',NULL,NULL),(4,'tools_all','http://172.16.40.238/codeigniter-restserver/imte?rn=&pn=&sn=&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa2lrLmRldkBnbWFpbC5jb20ifQ.SnRhtd9P6A9zpvUAv0yE5aNlTMleB6NgOd90DurstZk','api untuk menampilkan semua tool',NULL,NULL),(5,'tools_sn','http://172.16.40.238/codeigniter-restserver/imte?rn=&pn=&sn={search}&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa2lrLmRldkBnbWFpbC5jb20ifQ.SnRhtd9P6A9zpvUAv0yE5aNlTMleB6NgOd90DurstZk','untuk menampikan tool search berdasarkan serial number ada parameter {search} di pn',NULL,NULL),(6,'tools_pn','http://172.16.40.238/codeigniter-restserver/imte?rn=&pn={search}&sn=&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa2lrLmRldkBnbWFpbC5jb20ifQ.SnRhtd9P6A9zpvUAv0yE5aNlTMleB6NgOd90DurstZk','untuk menampikan tool search berdasarkan part number ada parameter {search} di pn=',NULL,NULL),(7,'tools_rn','http://172.16.40.238/codeigniter-restserver/imte?rn={search}&pn=&sn=&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa2lrLmRldkBnbWFpbC5jb20ifQ.SnRhtd9P6A9zpvUAv0yE5aNlTMleB6NgOd90DurstZk','untuk menampikan tool search berdasarkan request number ada parameter {search} di rn=',NULL,NULL);
/*!40000 ALTER TABLE `tabel_apis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_suppliers`
--

DROP TABLE IF EXISTS `type_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_lenght` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_suppliers`
--

LOCK TABLES `type_suppliers` WRITE;
/*!40000 ALTER TABLE `type_suppliers` DISABLE KEYS */;
INSERT INTO `type_suppliers` VALUES (1,'Repair Station','Certificate 1, Certificate 2, Certificate 3, Quality Manual, Capability List',NULL,'2019-07-24 11:35:41'),(2,'Material Supplier','Certificate 1, Certificate 2, Certificate 3, Quality Manual, Capability List/Parts Catalogue',NULL,'2019-07-24 11:38:20'),(3,'Calibration','Certificate 1, Certificate 2, Quality Manual, Capability List',NULL,'2019-07-24 11:40:44'),(4,'Maintenance Function','Certificate 1, Certificate 2, Certificate 2, Quality Manual, Capability List',NULL,'2019-08-04 11:48:08');
/*!40000 ALTER TABLE `type_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_of_measures`
--

DROP TABLE IF EXISTS `unit_of_measures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_of_measures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_of_measures`
--

LOCK TABLES `unit_of_measures` WRITE;
/*!40000 ALTER TABLE `unit_of_measures` DISABLE KEYS */;
INSERT INTO `unit_of_measures` VALUES (1,'%','Percentage',NULL,NULL,NULL,NULL),(2,'%O','Per mille',NULL,NULL,NULL,NULL),(3,'ONE','One',NULL,NULL,NULL,NULL),(4,'D','Days',NULL,NULL,NULL,NULL),(5,'22S','Square millimeter/second',NULL,NULL,NULL,NULL),(6,'CMS','Centimeter/second',NULL,NULL,NULL,NULL),(7,'0','Meter/Minute',NULL,NULL,NULL,NULL),(8,'µL','Microliter',NULL,NULL,NULL,NULL),(9,'µF','Microfarad',NULL,NULL,NULL,NULL),(10,'IB','Pikofarad',NULL,NULL,NULL,NULL),(11,'A','Ampere',NULL,NULL,NULL,NULL),(12,'GOH','Gigaohm',NULL,NULL,NULL,NULL),(13,'GM3','Gram/Cubic meter',NULL,NULL,NULL,NULL),(14,'ACR','Acre',NULL,NULL,NULL,NULL),(15,'KD3','Kilogram/cubic decimeter',NULL,NULL,NULL,NULL),(16,'QML','Kilomol',NULL,NULL,NULL,NULL),(17,'NI','Kilonewton',NULL,NULL,NULL,NULL),(18,'MN','Meganewton',NULL,NULL,NULL,NULL),(19,'MGO','Megohm',NULL,NULL,NULL,NULL),(20,'MHV','Megavolt',NULL,NULL,NULL,NULL),(21,'µA','Microampere',NULL,NULL,NULL,NULL),(22,'BAG','Bag',NULL,NULL,NULL,NULL),(23,'BAR','bar',NULL,NULL,NULL,NULL),(24,'BLD','Brake Landings',NULL,NULL,NULL,NULL),(25,'BT','Bottle',NULL,NULL,NULL,NULL),(26,'BOX','BOX',NULL,NULL,NULL,NULL),(27,'BQK','Becquerel/kilogram',NULL,NULL,NULL,NULL),(28,'RF','Millifarad',NULL,NULL,NULL,NULL),(29,'M/M','Mol per cubic meter',NULL,NULL,NULL,NULL),(30,'M/L','Mol per liter',NULL,NULL,NULL,NULL),(31,'NA','Nanoampere',NULL,NULL,NULL,NULL),(32,'C3S','Cubic centimeter/second',NULL,NULL,NULL,NULL),(33,'R-U','Nanofarad',NULL,NULL,NULL,NULL),(34,'NMM','Newton/Square millimeter',NULL,NULL,NULL,NULL),(35,'CCM','Cubic centimeter',NULL,NULL,NULL,NULL),(36,'CD','Candela',NULL,NULL,NULL,NULL),(37,'CD3','Cubic decimeter',NULL,NULL,NULL,NULL),(38,'CM','Centimeter',NULL,NULL,NULL,NULL),(39,'CM2','Square centimeter',NULL,NULL,NULL,NULL),(40,'CMH','Centimeter/hour',NULL,NULL,NULL,NULL),(41,'CV','Case',NULL,NULL,NULL,NULL),(42,'CL','Centiliter',NULL,NULL,NULL,NULL),(43,'CYC','CYCLES',NULL,NULL,NULL,NULL),(44,'S/M','Siemens per meter',NULL,NULL,NULL,NULL),(45,'TOM','Ton/Cubic meter',NULL,NULL,NULL,NULL),(46,'VAM','Voltampere',NULL,NULL,NULL,NULL),(47,'DB','Decibel',NULL,NULL,NULL,NULL),(48,'DEG','Degree',NULL,NULL,NULL,NULL),(49,'DM','Decimeter',NULL,NULL,NULL,NULL),(50,'DR','Drum',NULL,NULL,NULL,NULL),(51,'DZ','Dozen',NULL,NULL,NULL,NULL),(52,'EA','each',NULL,NULL,NULL,NULL),(53,'EU','Enzyme Units',NULL,NULL,NULL,NULL),(54,'EML','Enzyme Units / Milliliter',NULL,NULL,NULL,NULL),(55,'F','Farad',NULL,NULL,NULL,NULL),(56,'°F','Fahrenheit',NULL,NULL,NULL,NULL),(57,'FT','Foot',NULL,NULL,NULL,NULL),(58,'FT2','Square foot',NULL,NULL,NULL,NULL),(59,'FT3','Cubic foot',NULL,NULL,NULL,NULL),(60,'G','Gram',NULL,NULL,NULL,NULL),(61,'G/L','gram act.ingrd / liter',NULL,NULL,NULL,NULL),(62,'GAU','Gram Gold',NULL,NULL,NULL,NULL),(63,'°C','Degrees Celsius',NULL,NULL,NULL,NULL),(64,'GHG','Gram/hectogram',NULL,NULL,NULL,NULL),(65,'GJ','Gigajoule',NULL,NULL,NULL,NULL),(66,'GKG','Gram/kilogram',NULL,NULL,NULL,NULL),(67,'GLI','Gram/liter',NULL,NULL,NULL,NULL),(68,'GAL','US gallon',NULL,NULL,NULL,NULL),(69,'GPM','Gallons per mile (US)',NULL,NULL,NULL,NULL),(70,'GM','Gram/Mol',NULL,NULL,NULL,NULL),(71,'GM2','Gram/square meter',NULL,NULL,NULL,NULL),(72,'GPH','Gallons per hour (US)',NULL,NULL,NULL,NULL),(73,'µGQ','Microgram/cubic meter',NULL,NULL,NULL,NULL),(74,'GRO','Gross',NULL,NULL,NULL,NULL),(75,'GAI','Gram act. ingrd.',NULL,NULL,NULL,NULL),(76,'H','Hour',NULL,NULL,NULL,NULL),(77,'HA','Hectare',NULL,NULL,NULL,NULL),(78,'HL','Hectoliter',NULL,NULL,NULL,NULL),(79,'HPA','Hectopascal',NULL,NULL,NULL,NULL),(80,'HRS','Hours',NULL,NULL,NULL,NULL),(81,'HZ','Hertz (1/second)',NULL,NULL,NULL,NULL),(82,'	','',NULL,NULL,NULL,NULL),(83,'2	Inch2	Squar.inch	Square inch_x000D_\n3','Cubic inch',NULL,NULL,NULL,NULL),(84,'J','Joule',NULL,NULL,NULL,NULL),(85,'YR','Years',NULL,NULL,NULL,NULL),(86,'JKG','Joule/Kilogram',NULL,NULL,NULL,NULL),(87,'JKK','Spec. Heat Capacity',NULL,NULL,NULL,NULL),(88,'JMO','Joule/Mol',NULL,NULL,NULL,NULL),(89,'K','Kelvin',NULL,NULL,NULL,NULL),(90,'KA','Kiloampere',NULL,NULL,NULL,NULL),(91,'CAN','Canister',NULL,NULL,NULL,NULL),(92,'CAR','Carton',NULL,NULL,NULL,NULL),(93,'KBK','Kilobecquerel/kilogram',NULL,NULL,NULL,NULL),(94,'KG','Kilogram',NULL,NULL,NULL,NULL),(95,'KGF','Kilogram/Square meter',NULL,NULL,NULL,NULL),(96,'KGK','Kilogram/Kilogram',NULL,NULL,NULL,NULL),(97,'KGM','Kilogram/Mol',NULL,NULL,NULL,NULL),(98,'KGS','Kilogram/second',NULL,NULL,NULL,NULL),(99,'KGV','Kilogram/cubic meter',NULL,NULL,NULL,NULL),(100,'KAI','Kilogram act. ingrd.',NULL,NULL,NULL,NULL),(101,'KHZ','Kilohertz',NULL,NULL,NULL,NULL),(102,'CRT','Crate',NULL,NULL,NULL,NULL),(103,'KIT','KIT',NULL,NULL,NULL,NULL),(104,'KJ','Kilojoule',NULL,NULL,NULL,NULL),(105,'KJK','Kilojoule/kilogram',NULL,NULL,NULL,NULL),(106,'KJM','Kilojoule/Mol',NULL,NULL,NULL,NULL),(107,'KM','Kilometer',NULL,NULL,NULL,NULL),(108,'KM2','Square kilometer',NULL,NULL,NULL,NULL),(109,'KMH','Kilometer/hour',NULL,NULL,NULL,NULL),(110,'KMK','Cubic meter/Cubic meter',NULL,NULL,NULL,NULL),(111,'KMN','Kelvin/Minute',NULL,NULL,NULL,NULL),(112,'KMS','Kelvin/Second',NULL,NULL,NULL,NULL),(113,'KOH','Kiloohm',NULL,NULL,NULL,NULL),(114,'KPA','Kilopascal',NULL,NULL,NULL,NULL),(115,'KT','Kilotonne',NULL,NULL,NULL,NULL),(116,'KV','Kilovolt',NULL,NULL,NULL,NULL),(117,'KVA','Kilovoltampere',NULL,NULL,NULL,NULL),(118,'KW','Kilowatt',NULL,NULL,NULL,NULL),(119,'KWH','Kilowatt hours',NULL,NULL,NULL,NULL),(120,'KIK','kg act.ingrd. / kg',NULL,NULL,NULL,NULL),(121,'L','Liter',NULL,NULL,NULL,NULL),(122,'LMI','Liter/Minute',NULL,NULL,NULL,NULL),(123,'LB','US pound',NULL,NULL,NULL,NULL),(124,'LDG','LANDINGS',NULL,NULL,NULL,NULL),(125,'AU','Activity unit',NULL,NULL,NULL,NULL),(126,'LHK','Liter per 100 km',NULL,NULL,NULL,NULL),(127,'LMS','Liter/Molsecond',NULL,NULL,NULL,NULL),(128,'LOT','lot',NULL,NULL,NULL,NULL),(129,'LPH','Liter per hour',NULL,NULL,NULL,NULL),(130,'M','Meter',NULL,NULL,NULL,NULL),(131,'M%','Percent mass',NULL,NULL,NULL,NULL),(132,'M%O','Permille mass',NULL,NULL,NULL,NULL),(133,'M/S','Meter/second',NULL,NULL,NULL,NULL),(134,'M2','Square meter',NULL,NULL,NULL,NULL),(135,'M-2','1 / square meter',NULL,NULL,NULL,NULL),(136,'M2S','Square meter/second',NULL,NULL,NULL,NULL),(137,'M3','Cubic meter',NULL,NULL,NULL,NULL),(138,'M3S','Cubic meter/second',NULL,NULL,NULL,NULL),(139,'MA','Milliampere',NULL,NULL,NULL,NULL),(140,'MBA','Millibar',NULL,NULL,NULL,NULL),(141,'MBZ','Meterbar/second',NULL,NULL,NULL,NULL),(142,'MEJ','Megajoule',NULL,NULL,NULL,NULL),(143,'MG','Milligram',NULL,NULL,NULL,NULL),(144,'MGE','Milligram/Square centimeter',NULL,NULL,NULL,NULL),(145,'MGG','Milligram/gram',NULL,NULL,NULL,NULL),(146,'MGK','Milligram/kilogram',NULL,NULL,NULL,NULL),(147,'MGL','Milligram/liter',NULL,NULL,NULL,NULL),(148,'MGQ','Milligram/cubic meter',NULL,NULL,NULL,NULL),(149,'MGW','Megawatt',NULL,NULL,NULL,NULL),(150,'MHZ','Megahertz',NULL,NULL,NULL,NULL),(151,'MI','Mile',NULL,NULL,NULL,NULL),(152,'MI2','Square mile',NULL,NULL,NULL,NULL),(153,'µM','Micrometer',NULL,NULL,NULL,NULL),(154,'MIN','Minute',NULL,NULL,NULL,NULL),(155,'MIS','Microsecond',NULL,NULL,NULL,NULL),(156,'MIJ','Millijoule',NULL,NULL,NULL,NULL),(157,'ML','Milliliter',NULL,NULL,NULL,NULL),(158,'MLK','Milliliter/cubic meter',NULL,NULL,NULL,NULL),(159,'MLI','Milliliter act. ingr.',NULL,NULL,NULL,NULL),(160,'MM','Millimeter',NULL,NULL,NULL,NULL),(161,'MM2','Square millimeter',NULL,NULL,NULL,NULL),(162,'MMA','Millimeter/year',NULL,NULL,NULL,NULL),(163,'MMG','Millimol/gram',NULL,NULL,NULL,NULL),(164,'MMH','Millimeter/hour',NULL,NULL,NULL,NULL),(165,'MMK','Millimol/kilogram',NULL,NULL,NULL,NULL),(166,'MMO','Millimol',NULL,NULL,NULL,NULL),(167,'MM3','Cubic millimeter',NULL,NULL,NULL,NULL),(168,'MMS','Millimeter/second',NULL,NULL,NULL,NULL),(169,'MNM','Millinewton/meter',NULL,NULL,NULL,NULL),(170,'MOK','Mol/kilogram',NULL,NULL,NULL,NULL),(171,'MOL','Mol',NULL,NULL,NULL,NULL),(172,'MON','Months',NULL,NULL,NULL,NULL),(173,'MPA','Megapascal',NULL,NULL,NULL,NULL),(174,'MPB','Mass parts per billion',NULL,NULL,NULL,NULL),(175,'MPG','Miles per gallon (US)',NULL,NULL,NULL,NULL),(176,'MPM','Mass parts per million',NULL,NULL,NULL,NULL),(177,'MPS','Millipascal seconds',NULL,NULL,NULL,NULL),(178,'MPT','Mass parts per trillion',NULL,NULL,NULL,NULL),(179,'MPZ','Meterpascal/second',NULL,NULL,NULL,NULL),(180,'M3H','Cubic meter/Hour',NULL,NULL,NULL,NULL),(181,'MSE','Millisecond',NULL,NULL,NULL,NULL),(182,'MS2','Meter/second squared',NULL,NULL,NULL,NULL),(183,'MTE','Millitesla',NULL,NULL,NULL,NULL),(184,'M/H','Meter/Hour',NULL,NULL,NULL,NULL),(185,'MV','Millivolt',NULL,NULL,NULL,NULL),(186,'MVA','Megavoltampere',NULL,NULL,NULL,NULL),(187,'MW','Milliwatt',NULL,NULL,NULL,NULL),(188,'MWH','Megawatt hour',NULL,NULL,NULL,NULL),(189,'N','Newton',NULL,NULL,NULL,NULL),(190,'NAM','Nanometer',NULL,NULL,NULL,NULL),(191,'NM','Newton/meter',NULL,NULL,NULL,NULL),(192,'NS','Nanosecond',NULL,NULL,NULL,NULL),(193,'OCM','Spec. Elec. Resistance',NULL,NULL,NULL,NULL),(194,'OHM','Ohm',NULL,NULL,NULL,NULL),(195,'OM','Spec. Elec. Resistance',NULL,NULL,NULL,NULL),(196,'OZ','Ounce',NULL,NULL,NULL,NULL),(197,'FOZ','Fluid Ounce US',NULL,NULL,NULL,NULL),(198,'P','Points',NULL,NULL,NULL,NULL),(199,'PA','Pascal',NULL,NULL,NULL,NULL),(200,'PAA','Pair',NULL,NULL,NULL,NULL),(201,'PAC','Pack',NULL,NULL,NULL,NULL),(202,'PAL','Pallet',NULL,NULL,NULL,NULL),(203,'PAS','Pascal second',NULL,NULL,NULL,NULL),(204,'PRC','Group proportion',NULL,NULL,NULL,NULL),(205,'PL','PAIL',NULL,NULL,NULL,NULL),(206,'PMI','1/minute',NULL,NULL,NULL,NULL),(207,'PMR','Permeation Rate SI',NULL,NULL,NULL,NULL),(208,'PPB','Parts per billion',NULL,NULL,NULL,NULL),(209,'PPM','Parts per million',NULL,NULL,NULL,NULL),(210,'PPT','Parts per trillion',NULL,NULL,NULL,NULL),(211,'PRM','Permeation Rate',NULL,NULL,NULL,NULL),(212,'PRS','Number of Persons',NULL,NULL,NULL,NULL),(213,'PS','Picosecond',NULL,NULL,NULL,NULL),(214,'PT','Pint, US liquid',NULL,NULL,NULL,NULL),(215,'QT','Quart, US liquid',NULL,NULL,NULL,NULL),(216,'RHO','Gram/cubic centimeter',NULL,NULL,NULL,NULL),(217,'RIM','rim',NULL,NULL,NULL,NULL),(218,'ROL','Role',NULL,NULL,NULL,NULL),(219,'S','Second',NULL,NULL,NULL,NULL),(220,'SET','set',NULL,NULL,NULL,NULL),(221,'SH','SHEET',NULL,NULL,NULL,NULL),(222,'ST','items',NULL,NULL,NULL,NULL),(223,'HR','Hours',NULL,NULL,NULL,NULL),(224,'DAY','Days',NULL,NULL,NULL,NULL),(225,'TC3','1/cubic centimeter',NULL,NULL,NULL,NULL),(226,'TES','Tesla',NULL,NULL,NULL,NULL),(227,'TS','Thousands',NULL,NULL,NULL,NULL),(228,'TM3','1/cubic meter',NULL,NULL,NULL,NULL),(229,'TO','Tonne',NULL,NULL,NULL,NULL),(230,'TON','US ton',NULL,NULL,NULL,NULL),(231,'1','',NULL,NULL,NULL,NULL),(232,'TUB','',NULL,NULL,NULL,NULL),(233,'µGL','Microgram/liter',NULL,NULL,NULL,NULL),(234,'V','Volt',NULL,NULL,NULL,NULL),(235,'V%','Percent volume',NULL,NULL,NULL,NULL),(236,'V%O','Permille volume',NULL,NULL,NULL,NULL),(237,'MSC','Microsiemens per centimeter',NULL,NULL,NULL,NULL),(238,'MPL','Millimol per liter',NULL,NULL,NULL,NULL),(239,'VAL','Value-only material',NULL,NULL,NULL,NULL),(240,'VPB','Volume parts per billion',NULL,NULL,NULL,NULL),(241,'VPM','Volume parts per million',NULL,NULL,NULL,NULL),(242,'VPT','Volume parts per trillion',NULL,NULL,NULL,NULL),(243,'W','Watt',NULL,NULL,NULL,NULL),(244,'WK','Weeks',NULL,NULL,NULL,NULL),(245,'WMK','Heat Conductivity',NULL,NULL,NULL,NULL),(246,'WKY','Evaporation Rate',NULL,NULL,NULL,NULL),(247,'YD','Yards',NULL,NULL,NULL,NULL),(248,'YD2','Square Yard',NULL,NULL,NULL,NULL),(249,'YD3','Cubic yard',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `unit_of_measures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_request` int(11) DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com',NULL,'$2y$10$zFMRh4LhBi6TwWCArBhLfuIhgl0jIE9TT8tGubRWT9.7ATWoOjM/K',1,'8P24ZXytpL5UPB4z1oYpIKzLhRuYaqCOaf4ZwpBw2F1Rh6KgXM2HtKRPbMcm','2019-05-02 12:05:22','2019-05-02 12:05:22',NULL,NULL,NULL,'admin',NULL,NULL,NULL),(2,'HENDRI RAHMAN','achsya.vc@gmail.com',NULL,'$2y$10$kejTR/o7MRbf8A3KnkRavO5LwpduiskMsYjn/f1w5mlUPlojOfh1C',2,'3x8nsyfNIZ0D8pAbSQvLo6JL3mnzhCeSRZ7TeoxWzWo6QnIpqm5eP92GahjX','2019-05-02 12:07:46','2019-07-25 10:01:18',NULL,'2019-07-25 10:01:18',1,'aircraftuser','AIRCRAFT MAINTENANCE ENGINEER','JKTTFN-2',NULL),(3,'HERU WIBOWO','achsya.handsome@gmail.com',NULL,'$2y$10$ZqXoQnOLXr78bs9.zOawnOXGGfijRHlHtYoZjY7RRjaDv0wGdu1FG',3,'O0EUPIkeTuGPCdkmtTx3k62TwyWNVVtXfQYhNmNtf3KAEAObz7QsFH3Xcgfv','2019-05-02 12:07:56','2019-07-18 13:38:52',NULL,NULL,1,'aircraftmanager','AIRCRAFT MAINTENANCE ENGINEER','JKTTQA-3',NULL),(4,'IRWAN GUNANTO','achsyavencie@gmail.com',NULL,'$2y$10$X.fAmD2uwg/iumKP81aaS.bQozaNPmyHN.hc0vYmn/4KRVSebY5Z.',4,'uOGOMVqfa5LyeNyX834zAc4L8kROzK73KbVeCpdPKQKgrIwSSUsQgN6jfGTz','2019-05-02 12:08:12','2019-07-18 13:39:09',NULL,NULL,1,'aircraftgm','SENIOR AIRCRAFT MAINTENANCE TECHNICIAN','JKTTLM-3',NULL),(5,'MUHAMAD RIZKI FADILAH','componenuser@gmail.com',NULL,'$2y$10$FmUpe00Twagy5QsR660kius0JUJbWUIlYfp2ud1wduOqqqtR69/K2',2,'YO4lncrzIc9WLAwRU9XRyYmCINP1Yw5OLDi00oYwzNVbrCk5rYCicBKSnjJj','2019-05-02 12:08:40','2019-07-25 10:04:49',NULL,NULL,2,'componentusertce','AIRCRAFT CABIN TECHNICIAN','JKTTNO-2','TCE'),(6,'KUNCARA ADI WINAHYU','componentprod@gmail.com',NULL,'$2y$10$beoqrnyFW1gmGv.25W2htuBxfbUy3zghURLO36C6cWhoI2vFv4pRe',3,'PCUDgAONy4qGoyl28YA8z3KcuBtbuACz10Wd8MLau66vRiVhlyk8CN2YfNKx','2019-05-02 12:09:00','2019-07-25 10:05:08',NULL,NULL,2,'componentmanagertce','AIRCRAFT MAINTENANCE ENGINEER','JKTTLS-1','TCE'),(7,'HADI SAMPURNO','componentss@gmail.com',NULL,'$2y$10$QXMF/zJG9tYo9FgtUXxRYOiloQ42NhpEwYuRd5nDAujO6Q2jFkzL.',4,'vwGGILUwKj3jhs0geGIGkuErnh4SZQiQKOW2umGdXQTfcC7Tx6OwCXlQ3jLc','2019-05-02 12:09:20','2019-07-25 10:05:31',NULL,NULL,2,'componentgmtce','PROJECT MANAGER CITILINK','JKTTFS','TCE'),(8,'MUHAMMAD APRIZAL','engineuser@gmail.com',NULL,'$2y$10$7ZADEUyiOMT6nMmUkXIYyeLci8gXGZoGjHQQTX.53PD2aAKDctiSq',2,'MWizhhkLfcoaVEGCuqnEDY6JHVT7LqSKc9NUfUxHs8mUJdHkIREHuzyo2B8L','2019-05-02 12:09:38','2019-08-21 13:07:02',NULL,NULL,3,'engineuser','CUSTOMER SUPPORT & SALES MANAGER','JKTTPG','Engine'),(9,'ANANDITA SULISTYA PRIYATAMA','engineprod@gmail.com',NULL,'$2y$10$/IK1N8ovOFgsRauhbTU6..FpzXbvaMhvYp9Ak.Q9F1gXb.6Otteqm',3,'tBXEy5AWPtDJZN6FvWG0B8AE9IFcS3syVDt63VbZ4b03iq9cmotZTKHTHrWs','2019-05-02 12:10:03','2019-08-21 11:09:47',NULL,NULL,3,'enginemanager','ACCOUNT MANAGER & SALES','JKTTPX','Engine'),(10,'ARYO BAGUS SAMUDRO','enginegm@gmail.com',NULL,'$2y$10$Hi24ss7rQWTk3VBXK71TxOKWVB37vz7Yxc8Q3vxhLavjamjB542b2',4,'KKRq22Lp7gJEnibOgrb38KLhKAWfeChtXrvS7i4N6XiXSGbm4to762rrpBNQ','2019-05-02 12:10:17','2019-08-21 11:18:11',NULL,NULL,3,'enginegm','MGR CAPACITY PLANNING & PERFORMANCE ANALYSIS','JKTTNP-3','Engine'),(11,'EKI WIDIYANTO','specialuser@gmail.com',NULL,'$2y$10$iz/4JRCQNaXojqb0bDeZMuJIrBruEHslx/qPZy0BY3ol81WgPyj9m',2,'8BXqPz30AX3WfAkfTGT5TL8domNqLC1LKBS1I6LQDfYsuFGibv331x9UqAi5','2019-05-02 12:10:32','2019-05-02 12:10:32',NULL,NULL,4,'specialuser','SENIOR AIRCRAFT MAINTENANCE TECHNICIAN','JKTTLM-1',NULL),(12,'DEKI WARMAN','spcialprod@gmail.com',NULL,'$2y$10$vl9OESN9neXoG.mlHLbPPOvupgae4U5BSuB60OdPRLBWmeVBDk0GK',3,'m4jFayosVMvdP7wSNRfrynVslDQAuESxbaw8RRiRvem6Mi9lez6W9NndORpW','2019-05-02 12:10:41','2019-05-02 12:10:41',NULL,NULL,4,'specialproduction','AIRCRAFT PAINTER (I)','JKTTBP-2',NULL),(15,'EDI BRAMANTA','spcialqsa@gmail.com',NULL,'$2y$10$wpDcPmQuvwUtHpRx/AMOL.Qqzu.NONb1TtqJwBSvziiNVURvJT1ta',4,'cQK0imA3jUh7I5xWRualWybUXHrVMcu2o4RcmNXeIcqHQHk1DFkVaq4OagBR','2019-05-02 12:12:44','2019-05-02 12:12:44',NULL,NULL,4,'specialqsa','AIRCRAFT MAINTENANCE EXPERT','JKTTF',NULL),(16,'BAYU KUSUMANTO','vendoruser@gmail.com',NULL,'$2y$10$jzJ9ZpyuYXa0HI0n5seiger.gFs9mdVEv/AejwKNqHBx1vbyV4Faq',2,'UtcQyY4ruFkNxnJaaVxo2DJVW0dazwyfdx5gWCGVRVyu1SARN2DBRGo3O17L','2019-05-02 12:12:57','2019-05-02 12:12:57',NULL,NULL,5,'vendoruser','AIRCRAFT MAINTENANCE ENGINEER','JKTTFD-7',NULL),(17,'FERI HERIYANTO','vendorprod@gmail.com',NULL,'$2y$10$N65J4/ZiDkW4FXpUVhsjPOqQDevaXQ6wZSlaJUKFanHmMXWvl7zKa',3,'kYfw2xEsXN62j6altsyVLD8z1iIkr66k5QpUbD8RIcX9YHv9d1Sz23LuvIhQ','2019-05-02 12:13:10','2019-05-02 12:13:10',NULL,NULL,5,'vendormanager','AIRCRAFT MAINTENANCE ENGINEER','JKTTFN-2',NULL),(18,'BAGUS REZANDY GUSTHAFIANTO A.','vendorqsa@gmail.com',NULL,'$2y$10$A8lSlTVhLsh/9pJDE.WNyuX8.wcQ8PG.0SstYAylfVmPB0e4KCrEe',4,'tbSrdlHfPP4B7wsuKhXykLSxW2yNasRVd1XZKE2Mov8N0nf40VbYBFzFmcgv','2019-05-02 12:13:22','2019-05-02 12:13:22',NULL,NULL,5,'vendorgm','AIRCRAFT MAINTENANCE ENGINEER','JKTTFN-1',NULL),(19,'WILDA QONITA','WILDA.QONITA@GMF-AEROASIA.CO.ID',NULL,'$2y$10$aK.KOAMCBCGlunwtpU/j1.02cajoJCg8r40rmofvUYS9yfKGDVguO',2,NULL,'2019-05-13 13:51:02','2019-05-13 13:55:12',NULL,'2019-05-13 13:55:12',1,'581522','QUALITY SYSTEM ENGINEER','JKTTQL',NULL),(20,'HARRY GUNAWAN','harry_harry@gmf-aeroasia.co.id',NULL,'$2y$10$K0.K8sL5U43RCKF5PQ9qqe7K9p4WHS0/cs8DemjmiGU2AtDC5PtgG',3,NULL,'2019-05-13 13:52:37','2019-05-13 13:55:18',NULL,'2019-05-13 13:55:18',1,'521786','CERTIFIED QUALITY AUDITOR','JKTTQL',NULL),(21,'RENY NAZAR','engineuser@gmf-aeroasia.co.id',NULL,'$2y$10$ZAu3QjmpYBYjOFbn.v3ha.I6vAKOkcbiUsn7QOF1/aHJy/ITH7rXK',2,NULL,'2019-05-13 13:53:37','2019-07-26 09:09:28',NULL,NULL,3,'engineuser','CERTIFIED QUALITY AUDITOR','JKTTQL',NULL),(22,'DIANI FERLIA ISKANDAR','enginemanager@gmf-aeroasia.co.id',NULL,'$2y$10$UIX2/yMG74qAPmq28NRCleeHlFE5oPIcoR7sGe5dAtxqcx1HBg.8C',3,'DuLGSSoGjdNKDSNNls6BregrwI0aedcIrsjYh7pF8n8ZYbuNn69kxqoWnPzF','2019-05-13 13:56:54','2019-08-21 11:09:18',NULL,'2019-08-21 11:09:18',3,'enginemanager','MGR CAPACITY PLANNING & PERFORMANCE ANALYSIS (CARETAKER)','JKTTLP-3',NULL),(23,'OKI AGUNG SETIYANTO','componentgmtbr@gmf-aeroasia.co.id',NULL,'$2y$10$SIO.yf.N/rZvNkHxqTCQGet89mfQwFfxxR6t4TbQdvpuXPPtL4zKC',4,'S0EcCrtlQkGabK99TGGSxBsIcs8Becyx9QqQHrd6ts26fh3mrqfzPATwqfW3','2019-05-13 13:57:32','2019-07-25 10:31:59',NULL,NULL,2,'componentgmtbr','GM LINE MAINTENANCE PLANNING & CONTROL','JKTTLP','TBR'),(24,'AHMAD ARIF ASROR','sekuy@gmf-aeroasia.co.id',NULL,'$2y$10$F3ZzutBbnE3cHrscNxaKQuFMpPs2FQ1ougxbt86s2gK1G//g9SDOC',3,'0rIJnqWbYUs71cxhpiYlLAhpe0z0jfgFwSjEHrU5DKXSfjchW9JIX6v0WHLJ','2019-05-13 13:58:52','2019-07-25 10:04:22',NULL,NULL,2,'componentmanagertca','MGR PRODUCTION ENGINEERING AVIONIC','JKTTCA-4','TCA'),(25,'JOHAN DOERLAKSONO','sekut@gmf-aeroasia.co.id',NULL,'$2y$10$dKyQsFhfM7xw/pjFz0HxcuGm9l6gsB3954emOE34UY2R5tZXGLIYi',4,'Gm3cBwiWoiEAEsvMCBAL8pxm31rTrkFW95jLd8qLJLMp5OFewGXDEqNK6Fvg','2019-05-13 13:59:53','2019-07-25 10:03:44',NULL,NULL,2,'componentgmtca','GM AVIONIC','JKTTCA','TCA'),(26,'MOCHAMAD ZAINUDIN','m.zainudin@gmf-aeroasia.co.id',NULL,'$2y$10$ZOkH0fnVX7ok1E8ruQG4XOJQ9lYIvhjrLJ3jm7g5Ecjc2ugSic6em',2,'csMtnjHBTo2xq3M3IsSqsYskE2bvRJuxqaSx33jElMDXXwHbgvXMZCSjh19p','2019-05-13 14:00:29','2019-07-25 10:02:44',NULL,NULL,2,'componentusertca','ASSOCIATE QUALITY AUDITOR','JKTTQC','TCA'),(27,'SITI ALIFAH','enginegm@gmf-aeroasia.co.id',NULL,'$2y$10$DFP9OnM4R5T9BHoPlz0/jOxdwmwq5X.81/8WpxJfhL0WmaS0u1G..',4,'Hb24TjPbCDa7XB6NLDAgo3j3IiEX5etBHCXrMbyM5rT2ldiFG1QXMMzoNEFb','2019-05-13 14:01:33','2019-08-12 13:20:54',NULL,'2019-08-12 13:20:54',3,'enginegm','MGR CONTINUOUS IMPROVEMENT','JKTTVQ-3',NULL),(28,'DEDEN IWAN SETIAWAN','deden@gmf-aeroasia.co.id',NULL,'$2y$10$ywVzZ.KgeJa6mxecxyTi3e1fk14nMRjK5FgNC7tqzmHQ4HhcmgkbW',3,NULL,'2019-05-13 14:02:14','2019-08-12 13:20:57',NULL,'2019-08-12 13:20:57',3,'520749','GM ENGINE','JKTTVP',NULL),(29,'RIKI NINDYA ANANDA','RIKI.NINDYA@GMF-AEROASIA.CO.ID',NULL,'$2y$10$9koilw4YqJzY5uUp9tGqneZNuOCsZSV/9NDmesjfsztv43Jjw8iQ.',4,NULL,'2019-05-13 14:02:54','2019-08-12 13:20:59',NULL,'2019-08-12 13:20:59',3,'580747','ASSOCIATE QUALITY AUDITOR','JKTTQR',NULL),(30,'MOHAMMAD ANDITO BUDHI RAMADIAN','m.andito@gmf-aeroasia.co.id',NULL,'$2y$10$6rZ9FoGdwR08mKFJU9kJmebVzrNJl.2hB1eFujMwrxtHr0uNbmu3S',2,NULL,'2019-05-13 14:04:47','2019-08-12 13:21:03',NULL,'2019-08-12 13:21:03',4,'532006','MGR ENGINEERING','JKTTVE-2',NULL),(31,'SUHERMANTO','s.manto@gmf-aeroasia.co.id',NULL,'$2y$10$YfyO4OBAjSkx0j0qmGTGoeg.dJSzEHE4drweZYgbNOZpOEWecl6Ua',3,NULL,'2019-05-13 14:05:18','2019-08-12 13:21:05',NULL,'2019-08-12 13:21:05',4,'530609','GM QUALITY MANAGEMENT','JKTTVQ',NULL),(32,'SAIFUL ANHAM','s.anham@gmf-aeroasia.co.id',NULL,'$2y$10$KCY6nHFYxJ7ezW4AjKMQcuflpYwbWYOnDpBXGBUhUrvpq8NdBqWyu',4,NULL,'2019-05-13 14:05:44','2019-08-12 13:21:13',NULL,'2019-08-12 13:21:13',4,'580453','ASSOCIATE QUALITY AUDITOR','JKTTQR',NULL),(33,'NASRUL NABIL SANGADJI','n.nabil.s@gmf-aeroasia.co.id',NULL,'$2y$10$Hdjnd6HHWX6vc4jIn/aTnuGR1rf.ncF6iSH9dmrgns16xZYhIAS8m',2,'H6WBBK85fdi47ZDaH0xBBLI750MdGrb0Xanoiy7f2SE3SBSwiETWzxU2Xx9p','2019-05-13 14:06:49','2019-08-12 13:21:20',NULL,'2019-08-12 13:21:20',5,'580473','MGR SPECIFIC MATERIAL & SERVICE MANAGEMENT','JKTTME-2',NULL),(34,'R. FISHER A. MANALU','Fisher@gmf-aeroasia.co.id',NULL,'$2y$10$DKAs24DjhQA6TyYt54f8cO9JTqqxQxXFeWi1UrUPzxKqstb/CBcHS',3,'Br3J8aaKf8lFIdMmJcYpq9rMipQ8wvoviKIDKPHvvSxyWWrK8ClgyQDjlbsL','2019-05-13 14:07:26','2019-08-12 13:21:22',NULL,'2019-08-12 13:21:22',5,'531980','SUBSIDIARY ASSIGNMENT','GELK',NULL),(35,'JOSARI DAMERIA HUTAGALUNG','josari@gmf-aeroasia.co.id',NULL,'$2y$10$GmdHjyPAZVQqcOv9CWK3XuHq0nDBiQcUvLH9hc7mpuLlDk.PTL5la',4,'ZYiRVasZyeSrTsEgmtUjmWbEXCOrSfMNnnKNxizo7KayXWz9MdGAXKdeYoOC','2019-05-13 14:08:04','2019-08-12 13:21:25',NULL,'2019-08-12 13:21:25',5,'532133','ASSOCIATE QUALITY AUDITOR','JKTTQM',NULL),(36,'SEBASTIANUS WENDRA','componentusertcw@gmf-aeroasia.co.id',NULL,'$2y$10$ZCCzHLIZCNazAgxihDF12up6av/Q2GWjOcm9pR.UmKdyaNKY5RpuG',2,NULL,'2019-05-14 14:03:02','2019-07-25 10:06:45',NULL,NULL,2,'componentusertcw','PROJECT MANAGER','JKTTNP-1','TCW'),(37,'ANDY LESMANA','componentmanagertcw@gmf-aeroasia.co.id',NULL,'$2y$10$l35nML0MEDiKFjHa97RpbOhxfeQVaAL4MqqqvG0Fa15j4XDNZqmsm',3,NULL,'2019-05-14 14:03:39','2019-07-25 10:07:19',NULL,NULL,2,'componentmanagertcw','GM CABIN WORKSHOP','JKTTNO','TCW'),(38,'DANA SISWANA','dana@gmf-aeroasia.co.id',NULL,'$2y$10$32R3HhKA5rDPeQitjdu0jONfoAaFHTclO04JxFSv5vZg53qFjjhrK',3,NULL,'2019-05-14 14:37:35','2019-05-28 12:38:51',NULL,NULL,1,'527618','CERTIFIED QUALITY AUDITOR','JKTTQB',NULL),(39,'MICKY VIRGO RISTI MULYA','componentgmtcw@gmf-aeroasia.co.id',NULL,'$2y$10$NSPddnUX0u1GccZP3rnu1uNvP4jeyl2R2g4bhvmxsnM4SPYEzwyp6',4,'6KDH8VEZXiKS6DZWmlVEdtFiyra9VuUAHAat8niBsDInaXQ7qnehW5vzOCSZ','2019-05-20 14:08:18','2019-07-25 10:11:20',NULL,NULL,2,'componentgmtcw','AIRCRAFT MAINTENANCE PLANNING ENGINEER','JKTTCE-5','TCW'),(40,'IQBAL FARAZ DASRIL','componentusertno@gmf-aeroasia.co.id',NULL,'$2y$10$jQcEfZr8cZ.yBXuzgm/s5.xMjHRKRpDr7/oe8fexnabdlsD2jVkpy',2,'uuJyKUcDmRL68BCttxLDY6imoT6iDbjTwaFjDdXEP8XRSHnNABrCVOoygNpH','2019-05-20 14:08:45','2019-07-25 10:16:23',NULL,NULL,2,'componentusertno','GM ELECTRO MECHANICAL','JKTTCE','TNO'),(41,'YAN RINALDI','componentmanagertno@gmf-aeroasia.co.id',NULL,'$2y$10$sH/OByotqkVh9ygEw4h5M.ZyUYvxrjnFjHj2u98.quo7Jqr6lYNZu',3,'RGGHH6qSFnCZu1pjCq0MLbLAEqRlzOeIyeZsnvwvS0kjjSbLsH7mrtpHK1TJ','2019-05-20 14:09:18','2019-07-25 10:18:49',NULL,NULL,2,'componentmanagertno','CERTIFIED QUALITY AUDITOR','JKTTQC','TNO'),(42,'FAJAR KURNIAWAN','FAJAR.KURNIAWANtest@GMF-AEROASIA.CO.ID',NULL,'$2y$10$GFI4VXbFfb0n/g8KGQFmtuWx4NC1ggzlyb3HcL/mASKkmE/uVhpgq',2,'33zxPvMXqNjeKXm9HbIFaYPHynFscjExY0lqPNjmOhy6aAOpKRH9ng1dq9tX','2019-05-22 08:21:02','2019-08-03 18:13:55',NULL,NULL,1,'aircraftuser','AIRCRAFT MAINTENANCE PLANNING ENGINEER','JKTTCE-5',NULL),(43,'ANGRA FIRMAN FELANI','componentgmtno@gmf-aeroasia.co.id',NULL,'$2y$10$hiaFKreVbU7kvp6zhyPEgOy/k6wQaLj6Hi8WKe5.eJGMS2OvmEqNC',4,'tsH4fi0Mtr6FJxfFzS9HlptOvABBNNVN3jEql377tphm7wqE6AY4DcwZH2r5','2019-05-27 10:53:19','2019-07-25 10:23:07',NULL,NULL,2,'componentgmtno','MGR PLANNING & ENGINEERING PRODUCTION','JKTTBR-1','TNO'),(44,'IRVAN PRIBADI','componentusertbr@gmf-aeroasia.co.id',NULL,'$2y$10$Zo.z7QtAGc/hKLO0CJpMVebcvKCWu6EJQ33mWuLlOFVX93jgSrrt.',2,'jEAPGqNxKO8on7biSFOLKkLEZJ5ezh5xtybmbHoyvCn2lgPGNZzm77IVHvrn','2019-05-27 10:53:46','2019-07-25 10:20:02',NULL,NULL,2,'componentusertbr','GM STRUCTURE WORKSHOP','JKTTBR','TBR'),(46,'qsa','as.vote3@gmail.com',NULL,'$2y$10$oFcR.cP6DdIoWhcFuN7jiewU4D6C0url57xe8jSEc/reNs77OMDzC',5,'NbGlT6FdJWmooVdnUuaP5CVW9MUDm4pikU8ZrRQwMfLrB1XaTcl8WjwEdxYe',NULL,'2019-07-18 15:57:03',NULL,NULL,NULL,'qsa',NULL,NULL,NULL),(47,'gmqsa','as.vote2@gmail.com',NULL,'$2y$10$mxqDSHxFrYqquDMBGL1iyesaJ653tMrH6h9tITRgPofcFqLOVuCEa',6,'m82yVaXlimMoEP1HvNVo6gcicow0dl1AS0WFUwOSpSK17KV2s5oyjk6Nz4fV',NULL,'2019-07-18 15:56:43',NULL,NULL,NULL,'gmqsa',NULL,NULL,NULL),(50,'HENDRI RAHMAN','componentmanagertbr@gmf-aeroasia.co.id',NULL,'$2y$10$Eth.sjuZWK6HwWIiPJOsGeoDIxX6GgymbYyi0qISA2VVU0tKEXP76',3,'asz7U9c2caOEocTzVAW1yI6PM4VyBWEz0JPknbibzRveK2NM7nxcZ9EzhgPG','2019-07-25 10:01:05','2019-07-25 10:21:05',NULL,NULL,2,'componentmanagertbr','AIRCRAFT MAINTENANCE ENGINEER','JKTTFN-2','TBR'),(51,'NAFI AHMAD SYARIF','nafi@gmf-aeroasia.co.id',NULL,'$2y$10$GgDc78iLvaB4WdU5Fm8hEOYcvcM3ndUB84JdHDBpMdTSChttfUnnC',2,'kq15U7AbFy2ZghEL2GKHlEB8L7JOr6qcD5hMPbKOkwHptIVO2lzZfjq6rDo0','2019-07-25 14:40:02','2019-07-25 14:40:02',NULL,NULL,1,'580435','ASSOCIATE QUALITY AUDITOR','JKTTQL',NULL),(52,'ARIF LESTARI','specialprocessuser@gmf-aeroasia.co.id',NULL,'$2y$10$NYv/AL8SnAvgMh751K9.QumaD3SQCDXZtD67SoUMpcKX.lCtbS2VK',2,'zLFcg8RIuJtuQWxBQst7o8egs7sq6uPhvRFpW63RCQt02iqNzP6F6tEFnRbd','2019-07-26 14:17:00','2019-07-26 14:17:00',NULL,NULL,4,'specialprocessuser','SENIOR AIRCRAFT MAINTENANCE ENGINEER','JKTTLS-1',NULL),(53,'IRTAN SAFARI','specialprocessmanager@gmf-aeroasia.co.id',NULL,'$2y$10$XMjEGAj1cphgf/XSTWJ8muTeUFNfynZlgaTfXEPYy9nbj.Vy4U1OG',3,'7o0AbmnepkRJKtXlTxJcoaDwgCANQ5UFsFjVlGH0MwDDtTpgZUSVL5ZEPQZy','2019-07-26 14:17:42','2019-07-26 14:17:42',NULL,NULL,4,'specialprocessmanager','GM APU','JKTTVU',NULL),(54,'RUSLI SUANDI','specialprocessgm@gmf-aeroasia.co.id',NULL,'$2y$10$k8nIe7UctnHYc9p4Ec34vuQjyGnx0wypN1O4Z6xGrz3jDH.rexTu6',4,'CX40keAAvm0NRXxPdzQuLErg4PEBAZyus3dT4EtujqWwcOijR2SCVDxV2JZx','2019-07-26 14:18:14','2019-07-26 14:18:14',NULL,NULL,4,'specialprocessgm','MGR LINE MAINTENANCE STATION PALEMBANG','PLMMM',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_attachments`
--

DROP TABLE IF EXISTS `vendor_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_management_id` int(11) NOT NULL,
  `name_attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_attachments`
--

LOCK TABLES `vendor_attachments` WRITE;
/*!40000 ALTER TABLE `vendor_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_capablity_list_details`
--

DROP TABLE IF EXISTS `vendor_capablity_list_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_capablity_list_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `capability_list_id` int(11) NOT NULL,
  `type_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `maint_fn` text COLLATE utf8mb4_unicode_ci,
  `product_service` text COLLATE utf8mb4_unicode_ci,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `dgca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `easa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `questionnaire_exp_date` date DEFAULT NULL,
  `document_evidence` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_capablity_list_details`
--

LOCK TABLES `vendor_capablity_list_details` WRITE;
/*!40000 ALTER TABLE `vendor_capablity_list_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_capablity_list_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_management_histories`
--

DROP TABLE IF EXISTS `vendor_management_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_management_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_management_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` json DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_management_histories`
--

LOCK TABLES `vendor_management_histories` WRITE;
/*!40000 ALTER TABLE `vendor_management_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_management_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_managements`
--

DROP TABLE IF EXISTS `vendor_managements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_managements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplication_drawing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_proposed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_bussines` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_employee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_supervisors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_inspectors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_personel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `list_name_aproval` json DEFAULT NULL,
  `list_customers` json DEFAULT NULL,
  `list_curent_capability` json DEFAULT NULL,
  `representative_indonesia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_evidence` json DEFAULT NULL,
  `other_document_evidence_value` json DEFAULT NULL,
  `calibration_lab_certificate_value` json DEFAULT NULL,
  `date_audit` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evaluation_organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_quality_assurance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_qa_system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_indicate_supply` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_part_inspection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_maintain_quality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_program_recertify` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_control_policies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_trace_ability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_for_usa_only` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_provide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evaluation_implement_sms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `attachment` text COLLATE utf8mb4_unicode_ci,
  `status_vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `read` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` json DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step_request_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maint_fn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `questionnaire_exp_date` date DEFAULT NULL,
  `product_service` text COLLATE utf8mb4_unicode_ci,
  `qsa_part_approve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_managements`
--

LOCK TABLES `vendor_managements` WRITE;
/*!40000 ALTER TABLE `vendor_managements` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_managements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workshops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workshop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
INSERT INTO `workshops` VALUES (1,'Cabin',NULL,NULL),(2,'Electrical',NULL,NULL),(3,'Electronic',NULL,NULL),(4,'Emergency',NULL,NULL),(5,'Engine/APU',NULL,NULL),(6,'Fuel',NULL,NULL),(7,'Gas',NULL,NULL),(8,'Hydraulic',NULL,NULL),(9,'Instrument',NULL,NULL),(10,'Landing Gear',NULL,NULL),(11,'Pneumatic',NULL,NULL),(12,'Radio',NULL,NULL),(13,'Structure',NULL,NULL),(14,'Sheet Metal','2019-07-26 09:28:52','2019-07-26 09:28:52'),(15,'NDT','2019-08-12 13:32:18','2019-08-12 13:32:18');
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-18 15:09:35
