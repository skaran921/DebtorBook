-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: debtorbook
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.17-MariaDB
-- Date: Fri, 29 Oct 2021 16:07:39 +0200

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debtors`
--

LOCK TABLES `debtors` WRITE;
/*!40000 ALTER TABLE `debtors` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `debtors` VALUES (1,'naveen','9999999999','xfgfhgjkl@gmail.com','vpo dhani majra',1,'2021-02-27 10:40:23','2021-02-27 14:10:35',0),(2,'aman','8888888889','aaa@gmail.com','VPO DHANI MAJRA,FATEHABAD HARYANA',1,'2021-02-27 15:20:52','2021-02-27 15:55:08',1);
/*!40000 ALTER TABLE `debtors` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `debtors` with 2 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `transaction` VALUES (2,'25-02-2021',1,1,5000.00,0.00,'fdsghj','P','2021-02-27 10:45:40','2021-02-27 14:10:35',0),(3,'11-02-2021',2,1,0.00,4500.00,'jhgjkjm','R','2021-02-27 15:21:23','2021-02-27 15:21:23',1),(4,'25-02-2021',2,1,2000.00,0.00,'jhfgjkhn','P','2021-02-27 15:22:14','2021-02-27 15:22:14',1),(5,'27-02-2021',2,1,50000.00,0.00,'jhfgjhkljm','P','2021-02-27 15:51:33','2021-02-27 15:51:33',1);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `transaction` with 4 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Aman','Kumar','aman@gamil.com','8295716429','41b3f4745c20f20686510313c80be553','VPO Dhani Majra,Fatehabad','2021-02-27 10:38:56','2021-02-27 16:30:05',1),(2,'Aman','Kumar','aman@gmail.com','8295716429','73b25522615dac9cfd289ee35faef4ef','VPO Dhani Majra,Fatehabad','2021-03-27 16:00:29','2021-03-27 16:00:29',1),(3,'kaker','kaker','kaker@gmail.com','8295716420','73b25522615dac9cfd289ee35faef4ef','aman ,andcmm','2021-10-29 13:53:51','2021-10-29 13:53:51',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 3 row(s)
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

-- Dump completed on: Fri, 29 Oct 2021 16:07:39 +0200
