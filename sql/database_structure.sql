-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: sql_mzingamaji_c
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.20.04.1

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
-- Table structure for table `Price`
--

DROP TABLE IF EXISTS `Price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Price` (
  `price_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price_unique` text NOT NULL,
  `price_item` text NOT NULL,
  `price_amount` text NOT NULL,
  `price_reg_date` text NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Task`
--

DROP TABLE IF EXISTS `Task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Task` (
  `task_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_unique` text NOT NULL,
  `task_employee` bigint unsigned DEFAULT NULL,
  `task_item` text NOT NULL,
  `task_amount` text NOT NULL,
  `task_start` text NOT NULL,
  `task_end` text NOT NULL,
  `task_reg_date` text NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bill` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `bill_unique` varchar(60) NOT NULL,
  `bill_customer` int NOT NULL,
  `bill_meter` int NOT NULL,
  `bill_unit` int NOT NULL,
  `bill_unit_used` varchar(20) NOT NULL,
  `bill_cost` varchar(20) NOT NULL,
  `bill_reg_date` date NOT NULL,
  PRIMARY KEY (`bill_id`),
  UNIQUE KEY `bill_unique` (`bill_unique`),
  KEY `bill_customer` (`bill_customer`),
  KEY `bill_meter` (`bill_meter`),
  KEY `bill_unit` (`bill_unit`),
  CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`bill_customer`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`bill_meter`) REFERENCES `meter` (`meter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`bill_unit`) REFERENCES `unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37668 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch` (
  `branch_id` int NOT NULL AUTO_INCREMENT,
  `branch_unique` varchar(60) NOT NULL,
  `branch_name` varchar(20) NOT NULL,
  `branch_reg_date` date NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `catgory_id` int NOT NULL AUTO_INCREMENT,
  `category_unique` varchar(120) NOT NULL,
  `category_name` varchar(60) NOT NULL,
  `category_reg_date` varchar(20) NOT NULL,
  PRIMARY KEY (`catgory_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `checkin`
--

DROP TABLE IF EXISTS `checkin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checkin` (
  `checkin_id` int NOT NULL AUTO_INCREMENT,
  `checkin_unique` varchar(120) NOT NULL,
  `checkin_employee` int NOT NULL,
  `checkin_in` varchar(60) NOT NULL,
  `checkin_out` varchar(60) DEFAULT NULL,
  `checkin_reg_date` varchar(40) NOT NULL,
  PRIMARY KEY (`checkin_id`),
  KEY `checkin_employee` (`checkin_employee`),
  CONSTRAINT `checkin_ibfk_1` FOREIGN KEY (`checkin_employee`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_unique` varchar(60) NOT NULL,
  `customer_branch` int NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `customer_gender` varchar(6) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_address` varchar(60) NOT NULL,
  `customer_house_number` varchar(254) DEFAULT NULL,
  `customer_reg_date` date NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_contact` (`customer_contact`),
  UNIQUE KEY `customer_unique` (`customer_unique`),
  KEY `customer_branch` (`customer_branch`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customer_branch`) REFERENCES `branch` (`branch_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1828 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `employee_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_branch` int unsigned NOT NULL,
  `employee_unique` text NOT NULL,
  `employee_name` text NOT NULL,
  `employee_gender` text NOT NULL,
  `employee_contact` text NOT NULL,
  `employee_address` text NOT NULL,
  `employee_administrative` text NOT NULL,
  `employee_reg_date` text NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `employee_unique` varchar(60) NOT NULL,
  `employee_name` varchar(60) NOT NULL,
  `employee_gender` varchar(6) NOT NULL,
  `employee_contact` varchar(20) NOT NULL,
  `employee_address` varchar(60) NOT NULL,
  `employee_department` varchar(20) NOT NULL,
  `employee_authority` varchar(40) NOT NULL,
  `employee_password` varchar(120) NOT NULL,
  `employee_reg_date` date NOT NULL,
  `employee_branch` bigint unsigned NOT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_unique` (`employee_unique`),
  UNIQUE KEY `employee_name` (`employee_name`),
  UNIQUE KEY `employee_contact` (`employee_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment` (
  `equipment_id` int NOT NULL AUTO_INCREMENT,
  `equipment_unique` varchar(120) NOT NULL,
  `equipment_name` varchar(60) NOT NULL,
  `equipment_type` varchar(60) NOT NULL,
  `equipment_company` varchar(60) NOT NULL,
  `equipment_reg_date` varchar(20) NOT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expenditure`
--

DROP TABLE IF EXISTS `expenditure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenditure` (
  `expenditure_id` int NOT NULL AUTO_INCREMENT,
  `expenditure_unique` varchar(60) NOT NULL,
  `expenditure_title` varchar(60) NOT NULL,
  `expenditure_amount` varchar(20) NOT NULL,
  `expenditure_authorized` varchar(60) NOT NULL,
  `expenditure_supplier_name` varchar(60) NOT NULL,
  `expenditure_supplier_contact` varchar(20) NOT NULL,
  `expenditure_reg_date` date NOT NULL,
  PRIMARY KEY (`expenditure_id`),
  UNIQUE KEY `expenditure_unique` (`expenditure_unique`)
) ENGINE=InnoDB AUTO_INCREMENT=1288 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meter`
--

DROP TABLE IF EXISTS `meter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meter` (
  `meter_id` int NOT NULL AUTO_INCREMENT,
  `meter_unique` varchar(60) NOT NULL,
  `meter_customer` int NOT NULL,
  `meter_owner` varchar(60) NOT NULL,
  `meter_number` varchar(30) NOT NULL,
  `meter_intital_unit` varchar(30) NOT NULL,
  `meter_joinging_price` varchar(30) NOT NULL,
  `meter_lock` enum('No','Yes') DEFAULT 'No',
  `meter_in_service` varchar(12) NOT NULL DEFAULT 'No',
  `meter_reg_date` date NOT NULL,
  PRIMARY KEY (`meter_id`),
  KEY `meter_customer` (`meter_customer`),
  CONSTRAINT `meter_ibfk_1` FOREIGN KEY (`meter_customer`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1730 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `pay_id` int NOT NULL AUTO_INCREMENT,
  `pay_unique` varchar(60) NOT NULL,
  `pay_bill` int NOT NULL,
  `pay_customer` int NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `pay_reg_date` date NOT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `pay_unique` (`pay_unique`),
  KEY `pay_customer` (`pay_customer`),
  KEY `pay_bill` (`pay_bill`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`pay_customer`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`pay_bill`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46806 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchasement`
--

DROP TABLE IF EXISTS `purchasement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchasement` (
  `purchasement_id` int NOT NULL AUTO_INCREMENT,
  `purchasement_unique` varchar(60) NOT NULL,
  `purchasement_equipment` int NOT NULL,
  `purchasement_category` int NOT NULL,
  `purchasement_measurement` varchar(50) NOT NULL,
  `purchasement_price` varchar(20) NOT NULL,
  `purchasement_quantity` varchar(20) NOT NULL,
  `purchasement_reg_date` varchar(20) NOT NULL,
  PRIMARY KEY (`purchasement_id`),
  KEY `purchasement_equipment` (`purchasement_equipment`),
  KEY `purchasement_category` (`purchasement_category`),
  CONSTRAINT `purchasement_ibfk_1` FOREIGN KEY (`purchasement_equipment`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchasement_ibfk_2` FOREIGN KEY (`purchasement_category`) REFERENCES `category` (`catgory_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `stock_unique` varchar(60) NOT NULL,
  `stock_equipment` int NOT NULL,
  `stock_amount` varchar(12) NOT NULL,
  `stock_reg_date` varchar(12) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `stock_equipment` (`stock_equipment`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`stock_equipment`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `unit_id` int NOT NULL AUTO_INCREMENT,
  `unit_unique` varchar(60) NOT NULL,
  `unit_branch` int NOT NULL,
  `unit_price` varchar(20) NOT NULL,
  `unit_reg_date` date NOT NULL,
  PRIMARY KEY (`unit_id`),
  UNIQUE KEY `unit_unique` (`unit_unique`),
  KEY `unit_branch` (`unit_branch`),
  CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`unit_branch`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work` (
  `work_id` int NOT NULL AUTO_INCREMENT,
  `work_unique` varchar(60) NOT NULL,
  `work_title` varchar(60) NOT NULL,
  `work_description` text NOT NULL,
  `work_location` varchar(60) NOT NULL,
  `work_technicians` varchar(100) NOT NULL,
  `work_start_time` varchar(60) DEFAULT NULL,
  `work_finish_time` varchar(60) DEFAULT NULL,
  `work_reg_date` varchar(20) NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_equiment`
--

DROP TABLE IF EXISTS `work_equiment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_equiment` (
  `work_equiment_id` int NOT NULL AUTO_INCREMENT,
  `work_equiment_unique` varchar(60) NOT NULL,
  `work_equiment_equipment` varchar(254) NOT NULL,
  `work_equiment_work` int NOT NULL,
  `work_equiment_quatinty` varchar(12) NOT NULL,
  `work_equiment_other` varchar(254) DEFAULT NULL,
  `work_equiment_reg_date` varchar(12) NOT NULL,
  PRIMARY KEY (`work_equiment_id`),
  KEY `work_equiment_work` (`work_equiment_work`),
  CONSTRAINT `work_equiment_ibfk_1` FOREIGN KEY (`work_equiment_work`) REFERENCES `work` (`work_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-22 12:42:16
