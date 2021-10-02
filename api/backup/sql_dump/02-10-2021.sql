-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: debtorbook
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.14-MariaDB
-- Date: Sat, 02 Oct 2021 14:31:14 +0200

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `debtors`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debtors` (
  `DEBTOR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEBTOR_NAME` varchar(256) NOT NULL,
  `DEBTOR_MOBILE` varchar(20) NOT NULL,
  `DEBTOR_EMAIL` varchar(90) NOT NULL,
  `DEBTOR_ADDRESS` text NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `DEBTOR_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `DEBTOR_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DEBTOR_STATUS` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`DEBTOR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debtors`
--

LOCK TABLES `debtors` WRITE;
/*!40000 ALTER TABLE `debtors` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `debtors` VALUES (1,'Test','9876543210','test@gmail.com','testing',1,'2020-07-22 11:48:01','2020-07-22 11:48:01',1),(2,'Test','9466067763','skaran921@gmail.com','Testing',1,'2021-05-25 07:38:06','2021-05-25 07:38:06',1),(5,'Karan Soni','1234567888','skaran921@gmail.com','Testing Address',1,'2021-05-25 12:34:11','2021-05-25 12:34:11',1),(6,'TEST','4854335456','Test@gmail.com','testing',1,'2021-05-30 06:44:36','2021-05-30 06:44:36',1),(7,'TESTER','5678912345','Tester@gmail.com','',1,'2021-05-30 08:09:27','2021-05-30 08:09:27',1),(8,'Monu','8222816420','','',1,'2021-06-12 05:37:53','2021-06-12 05:37:53',1);
/*!40000 ALTER TABLE `debtors` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `debtors` with 6 row(s)
--

--
-- Table structure for table `reminders`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `REMINDER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REMINDER_DATE` varchar(20) NOT NULL,
  `REMINDER` text NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `REMINDER_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `REMINDER_UPDATE_DATE` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `REMINDER_STATUS` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`REMINDER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `reminders` with 0 row(s)
--

--
-- Table structure for table `transaction`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRANSACTION_DATE` varchar(20) NOT NULL,
  `DEBTOR_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PAY_AMOUNT` decimal(10,2) NOT NULL DEFAULT 0.00,
  `RECEIVED_AMOUNT` decimal(10,2) NOT NULL DEFAULT 0.00,
  `TRANSACTION_REMARK` text NOT NULL,
  `TRANSACTION_TYPE` varchar(10) NOT NULL DEFAULT 'R',
  `TRANSACTION_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `TRANSACTION_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TRANSACTION_STATUS` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`TRANSACTION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `transaction` VALUES (1,'16-04-2021',1,1,0.00,1000.00,'Cash Received','R','2020-07-22 11:48:38','2021-05-13 11:51:12',1),(2,'12-05-2021',1,1,600.00,0.00,'Cash Paid','P','2020-07-22 11:49:29','2021-05-13 11:52:25',1),(3,'22-04-2021',1,1,123453.00,0.00,'test','P','2021-04-11 14:12:23','2021-05-13 11:52:38',1);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `transaction` with 3 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_FIRST_NAME` varchar(90) NOT NULL,
  `USER_LAST_NAME` varchar(90) NOT NULL,
  `USER_EMAIL` varchar(90) NOT NULL,
  `USER_MOBILE` varchar(20) NOT NULL,
  `USER_PASSWORD` varchar(90) NOT NULL,
  `USER_ADDRESS` text NOT NULL,
  `USER_CREATE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `USER_UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `USER_STATUS` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Karan','Soni','skaran921@gmail.com','9466067763','5facbc1aedb69afddcd65a765116f527','Ward No. Mameran road Ellenabad','2020-07-22 11:45:41','2020-09-21 05:41:44',1),(2,'Karan','Soni','skaran92145@yahoo.com','9466067763','5facbc1aedb69afddcd65a765116f527','Ward No. 7 mameran Road Ellenabad','2020-08-04 07:07:52','2020-09-21 05:41:44',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sat, 02 Oct 2021 14:31:14 +0200
