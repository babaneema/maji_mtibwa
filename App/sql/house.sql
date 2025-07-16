-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: house
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
-- Dumping data for table `Price`
--

LOCK TABLES `Price` WRITE;
/*!40000 ALTER TABLE `Price` DISABLE KEYS */;
/*!40000 ALTER TABLE `Price` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `Task`
--

LOCK TABLES `Task` WRITE;
/*!40000 ALTER TABLE `Task` DISABLE KEYS */;
/*!40000 ALTER TABLE `Task` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=37682 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (37681,'67b6ce81b174f',1914,1808,12,'0','0','2025-02-20');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (7,'67a8d45a41ec6','Mwang&#039;onga','2025-02-09');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `checkin`
--

LOCK TABLES `checkin` WRITE;
/*!40000 ALTER TABLE `checkin` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkin` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=1924 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1828,'67a8d5d499e44',7,'riziki','Male','255717593237','misikiti','09','2025-02-09'),(1834,'67a9c9ec22dfe',7,'Kiruke','Male','255676937579','Tenk','152','2025-02-10'),(1835,'67a9cd8e3494e',7,'mohd abdallah','Male','255652593949','Tenk','167','2025-02-10'),(1836,'67aa031d12271',7,'Juma mulla hassan','Male','255685718849','Kiwanda cha kamba','56','2025-02-10'),(1837,'67aa05d6eb1fa',7,'Ohaa','Male','255785860661','Kiwanda cha kamba','46','2025-02-10'),(1838,'67aa07c1d69a1',7,'Hemed Mkama Ndumvalimwe','Male','255627406540','kiwanda cha kamba','23','2025-02-10'),(1840,'67aa09681b561',7,'mpemba','Male','255788068215','kiwanda cha kamba','8','2025-02-10'),(1841,'67aa0b540b02e',7,'Eriass shirima','Male','255785637738','kiwanda cha kamba','66','2025-02-10'),(1842,'67aa0e116d12e',7,'Ramazani mtahuka','Male','255655345434','Tank','159','2025-02-10'),(1843,'67aa1122dc39b',7,'mama irin','Male','255719576457','Tank','151','2025-02-10'),(1844,'67aa13906080e',7,'iliasa s shamte','Male','255685925071','Tank','009','2025-02-10'),(1845,'67aa15a3411ac',7,'Said Osoman','Male','255627280711','Tank','333','2025-02-10'),(1847,'67ac2c9f7a67a',7,'Davdi moses mwambigija','Male','255746110051','Tank bondeni','47','2025-02-12'),(1848,'67ac2e0050b85',7,'Ramadhani','Male','255688205200','Tank nondeni','50','2025-02-12'),(1849,'67ac300cc5920',7,'Fanuel kahwili','Male','255759820011','mzee habasi','5','2025-02-12'),(1850,'67ac31ec7eee9',7,'Said Juma Zanda','Male','255719110619','Mzee habasi','051','2025-02-12'),(1851,'67ac339300f79',7,'Goodrack mchaki','Male','255717999004','Mzee habasi','52','2025-02-12'),(1852,'67ac34ffef045',7,'Asha Makingo','Female','255683927049','Mzee habasi','57','2025-02-12'),(1853,'67ac365065e55',7,'Semani mzee yusufu','Male','255718233262','makaburini','45','2025-02-12'),(1854,'67ac3970e6748',7,'Mwajuma bakari','Female','255787451564','Makaburini','55','2025-02-12'),(1855,'67ac3a798b44f',7,'George Dominick marandu','Male','255713311192','Makaburi','45','2025-02-12'),(1856,'67ac3c7c125ca',7,'Nasra abushee','Female','255749938360','shamba la nyanya','44','2025-02-12'),(1857,'67ac3de4081ee',7,'Emmanuel elineema mshana','Male','255685614647','mzee habasi','22','2025-02-12'),(1858,'67ac42d948102',7,'Jacki','Female','255659332531','kiwanda cha kamba','66','2025-02-12'),(1859,'67ac4c9485f60',7,'Diana Iddy','Female','255675887584','mabata','44','2025-02-12'),(1860,'67ac9ca612862',7,'Mama Aziza','Male','255625442367','makaburin','33','2025-02-12'),(1861,'67ac9e874d108',7,'Mama haziwaya ','Male','255656893126','makaburini','33','2025-02-12'),(1862,'67aca143a2e3f',7,'Shabani juma shomari','Male','255755257768','Tank','55','2025-02-12'),(1863,'67aca36cddb27',7,'Pita','Male','255785358046','Tank','46','2025-02-12'),(1864,'67aca785e3e3d',7,'Salumu mussa mkwawa','Male','255652259208','Tank','123','2025-02-12'),(1866,'67aca8a20681d',7,'Ally juma','Male','255712618242','Msikitini','54','2025-02-12'),(1867,'67acaa6ce59f4',7,'Hamisi Hasani Mdoe','Male','255753630225','misikiti','33','2025-02-12'),(1868,'67acac5cb8a7a',7,'Rishedy kapilima','Male','255685307437','misikiti','33','2025-02-12'),(1869,'67acade7eed0b',7,'Joseph john','Male','255673315566','Nec','44','2025-02-12'),(1870,'67acb1c44db2d',7,'Sarum mussa','Male','255682589133','Nec','33','2025-02-12'),(1871,'67acbba7d48d0',7,'Jamari','Male','255782084926','makaburini','33','2025-02-12'),(1872,'67ad86b74c9e4',7,'Khamissi amad','Male','25573286835','misikiti','55','2025-02-13'),(1873,'67ad87c76d1e2',7,'Iddy Marick mshindo','Male','255782785822','misikiti','44','2025-02-13'),(1874,'67ad8ca38632c',7,'Agost','Male','255683695554','kwa kimicha','07','2025-02-13'),(1875,'67ad8e8f01e75',7,'Fibety','Male','255682413368','kwa kimicha','33','2025-02-13'),(1876,'67ad8f94d790f',7,'Mzee waziri','Male','255745748442','kwa kimicha','688','2025-02-13'),(1877,'67ad90b78308e',7,'Ostaz Ally','Male','255772413073','kwa kimicha','8','2025-02-13'),(1878,'67ad918b645b4',7,'Kufa kunoga','Male','255743929133','kwa kimicha','13','2025-02-13'),(1879,'67ad92e043935',7,'Mbonde','Male','255653070160','kwa kimicha','3','2025-02-13'),(1880,'67ad94d1cc60e',7,'Hafidhali bakari msagati','Male','255744890694','kwa kimicha','25','2025-02-13'),(1882,'67ad96512f1f2',7,'Fadhiri shusha','Male','255765936141','kwa wasambaa','34','2025-02-13'),(1883,'67ad98c639aca',7,'Mtangi','Male','25578199189','wasambaa','44','2025-02-13'),(1884,'67ad99d745d5b',7,'yujin koloneli michaeli','Male','255781697532','kwa wasambaa','44','2025-02-13'),(1885,'67ad9b77c7868',7,'Ossen Abibu','Male','255783729492','kwa wasambaa','33','2025-02-13'),(1886,'67ad9e21e412b',7,'Twaha said mbaruku','Male','255676761912','kwa wasabaa','33','2025-02-13'),(1887,'67ada069717a5',7,'Abubakari ramdhan kongolelo','Male','255713279380','kwa wasambaa','48','2025-02-13'),(1888,'67ada25c96c22',7,'Msafiri shasha','Male','255783441920','kwa wasambaa','44','2025-02-13'),(1889,'67ada383d7a90',7,'Methe','Female','255712502020','Nec','58','2025-02-13'),(1890,'67ada54ab5ec5',7,'Baba baraka','Male','255748708963','Nec','55','2025-02-13'),(1891,'67adef4fc56ed',7,'Amiri','Male','255694879428','kwa wasambaa','550','2025-02-13'),(1892,'67ae07666f912',7,'Awaz,hassan,','Male','255625564146','Ruzando','06','2025-02-13'),(1893,'67ae0a56aa9fc',7,'Abeidi adam mkongo','Male','255715787635','Ruzando','8','2025-02-13'),(1894,'67ae13451a372',7,'Amina','Female','255713992907','wasambaa','55','2025-02-13'),(1895,'67ae151840652',7,'Baba tatu','Male','255744949486','kwa wasambaa','33','2025-02-13'),(1896,'67ae1790c2d3c',7,'Jafari','Male','255787440111','kiwanda cha kamba','45','2025-02-13'),(1897,'67ae19374d2cf',7,'Mohamed kassim','Male','255712130122','Nec','55','2025-02-13'),(1899,'67aedb7c1d560',7,'Tumsifu masawe','Male','255711775765','kwa kimicha','2','2025-02-14'),(1900,'67aedca081195',7,'Mussa asumani','Male','255684909492','kwa wasambaa','44','2025-02-14'),(1901,'67af0d19647b9',7,'Mama enjo','Male','255787177560','kwa wasambaa','33','2025-02-14'),(1902,'67af3e6cda592',7,'Michael Francis Gustafu','Male','255719222772','Nec','22','2025-02-14'),(1903,'67af48a39afd2',7,'Mohamed mohamed minda','Male','255756700166','kwa wasambaa ','34','2025-02-14'),(1904,'67b01d6e2baaa',7,'Mohamed kitindi','Male','255785129401','habasi','55','2025-02-15'),(1905,'67b09941a9438',7,'Shoma Sengo','Male','255659680244','Tank','166','2025-02-15'),(1906,'67b09d56ca62f',7,'Mjumbe','Male','255712100028','Tank','56','2025-02-15'),(1907,'67b0b192e1ef2',7,'Ramadhan Ndege','Male','255655572073','Bondeni','46','2025-02-15'),(1908,'67b18c293d4ad',7,'Shaban Ally Ramadhan','Male','255786474330','kwa wasambaa','45','2025-02-16'),(1909,'67b18d2d97413',7,'instumai seremani said','Female','255654460775','kwa wasambaa','6','2025-02-16'),(1910,'67b18e5c5ed7e',7,'Islami hamza shebuge','Male','255712186966','kwa kimicha','34','2025-02-16'),(1911,'67b1e07f8517f',7,'Said s Jahira','Male','255767161945','Tank','139','2025-02-16'),(1912,'67b1e2393b016',7,'Assah devis kapungu','Male','255743594461','Tank','333','2025-02-16'),(1913,'67b1e42767583',7,'Omari katungunya','Male','255712528238','Tank','190','2025-02-16'),(1914,'67b1e97be4af4',7,'Abdalah Bakari Kitwana1','Male','255693043049','kwa wasambaa','56','2025-02-16'),(1915,'67b1f991374ce',7,'Rafaeli elibaliki','Male','255766500952','kwa wasambaa','46','2025-02-16'),(1916,'67b1fbdfe8fbb',7,'Rehema rajabu jumanne','Female','255654735783','kwa mpemba','24','2025-02-16'),(1917,'67b2c1735fd52',7,'Seremani zaharani sembe','Male','255712201039','kwa wasambaa','57','2025-02-17'),(1918,'67b2d03b491bb',7,'Nasra Daudi Mnyeu','Female','25574090564','kiwanda cha kamba','055','2025-02-17'),(1919,'67b2d172a302c',7,'Emmanuel kiriani nyoni','Male','255712882773','kiwanda cha kamba','500','2025-02-17'),(1920,'67b2d2e6df2c8',7,'Adelina herman adriano','Male','255768188290','Kiwanda cha kamba','34','2025-02-17'),(1921,'67b2d3f31b921',7,'Jemsi mdede','Male','255684958009','kiwanda cha kamba','45','2025-02-17'),(1922,'67b7534ed4d80',7,'mama hawa ','Female','255672775991','kwa Nec ','46','2025-02-20'),(1923,'67b9451818661',7,'Testing Sunday ','Male','255763096136','Mbagala','1212','2025-02-22');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `expenditure`
--

LOCK TABLES `expenditure` WRITE;
/*!40000 ALTER TABLE `expenditure` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenditure` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=1819 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meter`
--

LOCK TABLES `meter` WRITE;
/*!40000 ALTER TABLE `meter` DISABLE KEYS */;
INSERT INTO `meter` VALUES (1730,'67a8d750dcecb',1828,'Customer','001','10','15000','No','No','2025-02-09'),(1736,'67a9ca75ab04d',1834,'Customer','0021','5','30000','No','No','2025-02-10'),(1737,'67a9d04517c6b',1835,'Customer','250026','13','3000','No','No','2025-02-10'),(1738,'67aa03e970fca',1836,'Customer','58','57','5000','No','No','2025-02-10'),(1739,'67aa08394b67c',1838,'Customer','240315420','1','0000','No','No','2025-02-10'),(1740,'67aa09ee764c6',1840,'Customer','240800518','0000','0000','No','No','2025-02-10'),(1741,'67aa0bb84e4ee',1841,'Customer','567','47','0000','No','No','2025-02-10'),(1742,'67aa0f21bd30b',1842,'Customer','120','114','4000','No','No','2025-02-10'),(1743,'67aa11f713d16',1843,'Customer','223','56','5000','No','No','2025-02-10'),(1744,'67aa13fc41b3e',1844,'Customer','346','07','6000','No','No','2025-02-10'),(1745,'67aa1779b5271',1845,'Customer','65','78','49000','No','No','2025-02-10'),(1746,'67ac2d11a20f0',1847,'Customer','15762','85','5000','No','No','2025-02-12'),(1747,'67ac2ede8703f',1848,'Customer','01295','94','4000','No','No','2025-02-12'),(1748,'67ac30f3786ff',1849,'Customer','6857','5','5000','No','No','2025-02-12'),(1749,'67ac32bce1f37',1850,'Customer','04320','101','22000','No','No','2025-02-12'),(1750,'67ac33e5bd02e',1851,'Customer','45','50','50000','No','No','2025-02-12'),(1751,'67ac354ab684c',1852,'Customer','468','5','4000','No','No','2025-02-12'),(1752,'67ac37a6e8826',1853,'Customer','55','125','55','No','No','2025-02-12'),(1753,'67ac39ba46416',1854,'Customer','55','40','55000','No','No','2025-02-12'),(1754,'67ac3ac9df877',1855,'Customer','22','29','5000','No','No','2025-02-12'),(1755,'67ac3cea839fe',1856,'Customer','02461','13','0000','No','No','2025-02-12'),(1756,'67ac3e5a822be',1857,'Customer','240401972','1','44','No','No','2025-02-12'),(1757,'67ac434c120b1',1858,'Customer','344','96','40000','No','No','2025-02-12'),(1758,'67ac4d3d768e0',1859,'Customer','446','77','6000','No','No','2025-02-12'),(1759,'67ac9d6d70b3c',1860,'Customer','00366','19','5000','No','No','2025-02-12'),(1760,'67ac9f6d46ab5',1861,'Customer','03085','51','5000','No','No','2025-02-12'),(1761,'67aca19dbda99',1862,'Customer','00331','1','5000','No','No','2025-02-12'),(1762,'67aca39aacc65',1863,'Customer','446','12','4000','No','No','2025-02-12'),(1763,'67aca8d809014',1866,'Customer','444','20','5000','No','No','2025-02-12'),(1764,'67acaad5498a8',1867,'Customer','33','27','35500','No','No','2025-02-12'),(1765,'67acacbd4c165',1868,'Customer','55','32','5500','No','No','2025-02-12'),(1766,'67acaeba84c04',1869,'Customer','55','18','3000','No','No','2025-02-12'),(1767,'67acb21a316c7',1870,'Customer','33','101','13300','No','No','2025-02-12'),(1768,'67acbc7dbdb75',1871,'Customer','44','24','34000','No','No','2025-02-12'),(1769,'67ad871f3ff36',1872,'Customer','33','125','5500','No','No','2025-02-13'),(1770,'67ad886e1d230',1873,'Customer','2312cc917','29','5000','No','No','2025-02-13'),(1772,'67ad8d1c87927',1874,'Customer','44','42','5090','No','No','2025-02-13'),(1773,'67ad8ed0a8e21',1875,'Customer','44','47','5000','No','No','2025-02-13'),(1774,'67ad8fe614285',1876,'Customer','4444','214','5000','No','No','2025-02-13'),(1775,'67ad910ae55ff',1877,'Customer','22','18','58000','No','No','2025-02-13'),(1776,'67ad9208b3cc0',1878,'Customer','55','7','5000','No','No','2025-02-13'),(1777,'67ad9389c62cf',1879,'Customer','44','58','5000','No','No','2025-02-13'),(1778,'67ad95626e007',1880,'Customer','00141','0000','5000','No','No','2025-02-13'),(1779,'67ad96a6427db',1882,'Customer','55','46','44000','No','No','2025-02-13'),(1780,'67ad9905d733c',1883,'Customer','4638','96','88000','No','No','2025-02-13'),(1781,'67ad9a66a0e34',1884,'Customer','3574','10','55000','No','No','2025-02-13'),(1782,'67ad9bc620863',1885,'Customer','01378','51','5000','No','No','2025-02-13'),(1783,'67ad9e5536ffd',1886,'Customer','22','25','44000','No','No','2025-02-13'),(1784,'67ada0a4b4061',1887,'Customer','02692','32','50000','No','No','2025-02-13'),(1785,'67ada2e34b107',1888,'Customer','556','75','5000','No','No','2025-02-13'),(1786,'67ada3ee1a262',1889,'Customer','4555','106','5000','No','No','2025-02-13'),(1787,'67ada5d6a6807',1890,'Customer','87','177','55000','No','No','2025-02-13'),(1788,'67adeff1a34e2',1891,'Customer','44','14','39900','No','No','2025-02-13'),(1789,'67ae07b475670',1892,'Customer','23','2','5000','No','No','2025-02-13'),(1790,'67ae0a8857358',1893,'Customer','55','1','5000','No','No','2025-02-13'),(1791,'67ae147f6ef9d',1894,'Customer','445','68','40000','No','No','2025-02-13'),(1792,'67ae1558c287b',1895,'Customer','44','3','3300','No','No','2025-02-13'),(1793,'67ae17d4b4c9b',1896,'Customer','33','51','2600','No','No','2025-02-13'),(1794,'67ae1a3e639f1',1897,'Customer','33','146','33500','No','No','2025-02-13'),(1795,'67aedbe3d23fc',1899,'Customer','33','26','5500','No','No','2025-02-14'),(1796,'67aedd28751f0',1900,'Customer','556','24','4000','No','No','2025-02-14'),(1797,'67af19bec760d',1901,'Customer','55','61','5000','No','No','2025-02-14'),(1798,'67af3ecc94224',1902,'Customer','67','00000','48000','No','No','2025-02-14'),(1799,'67af490110d66',1903,'Customer','240904655','1','10000','No','No','2025-02-14'),(1800,'67b01ddfbce97',1904,'Customer','02343','5','4000','No','No','2025-02-15'),(1801,'67b09998631ef',1905,'Customer','78','28','5000','No','No','2025-02-15'),(1802,'67b09dbb3e978',1906,'Customer','556','84','500','No','No','2025-02-15'),(1803,'67b0b55b6f2df',1907,'Customer','34','0000','49900','No','No','2025-02-15'),(1804,'67b18c866ed02',1908,'Customer','00184','10','5000','No','No','2025-02-16'),(1805,'67b18d57e0ee3',1909,'Customer','46','0000','5000','No','No','2025-02-16'),(1806,'67b1e0d84796a',1911,'Customer','2402352','0000','5000','No','No','2025-02-16'),(1807,'67b1e2978eeee',1912,'Customer','15812','71','30000','No','No','2025-02-16'),(1808,'67b1f789ef177',1914,'Customer','556','40','5000','No','No','2025-02-16'),(1809,'67b1f812c9fa5',1913,'Customer','466','21','4909','No','No','2025-02-16'),(1810,'67b1f85463de5',1913,'Customer','466','21','4909','No','No','2025-02-16'),(1811,'67b1fa1ba7746',1915,'Customer','33','88','34','No','No','2025-02-16'),(1812,'67b1fa835882e',1910,'Customer','35','47','46','No','No','2025-02-16'),(1813,'67b1fc21c45f5',1916,'Customer','46','89','453','No','No','2025-02-16'),(1814,'67b2c2601b9da',1917,'Customer','68','33','500','No','No','2025-02-17'),(1815,'67b2d08e8ae25',1856,'Customer','567','34','50000','No','No','2025-02-17'),(1816,'67b2d1d68e63e',1919,'Customer','567','80','50000','No','No','2025-02-17'),(1817,'67b2d309b901c',1920,'Customer','45','71','5000','No','No','2025-02-17'),(1818,'67b2d427d4760',1921,'Customer','56888','133','3500','No','No','2025-02-17');
/*!40000 ALTER TABLE `meter` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=46812 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `purchasement`
--

LOCK TABLES `purchasement` WRITE;
/*!40000 ALTER TABLE `purchasement` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchasement` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (12,'67a8d4f95f222',7,'2000','2025-02-09');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `work`
--

LOCK TABLES `work` WRITE;
/*!40000 ALTER TABLE `work` DISABLE KEYS */;
/*!40000 ALTER TABLE `work` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `work_equiment`
--

LOCK TABLES `work_equiment` WRITE;
/*!40000 ALTER TABLE `work_equiment` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_equiment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-22  4:09:59
