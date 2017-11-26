-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: LibrarySystem
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','admin','admin','1990-10-10','admin@gmail.com'),('mross','mross123','Mross Pudone','1985-05-15','mross123@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `ISBN` varchar(30) NOT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Edition` varchar(10) DEFAULT NULL,
  `Publisher` varchar(100) DEFAULT NULL,
  `Author` varchar(200) DEFAULT NULL,
  `Dept` varchar(100) DEFAULT NULL,
  `Cost` decimal(6,2) DEFAULT '0.00',
  `IsReserved` varchar(10) DEFAULT NULL,
  `NoOfCopy` int(4) DEFAULT NULL,
  `AvailableCopy` int(4) DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES ('201','Algorithm','5','MGraw Hills','Praveen, Pradeep, Nabeel','Computer Science & Engineering',510.00,'no',10,7),('202','Data Structure','10','MGraw Hills','Dhaked, Pradeep, Nabeel','Computer Science & Engineering',1063.00,'no',80,76),('203','Database Design','11','International Publications','Praveen, Avinash, Sutten','Computer Science & Engineering',807.00,'no',50,46),('204','Basic Mechanics','5','MGraw Hills','Sinku, Pradeep, Sahbaz','Mechanical Engineering',806.00,'no',45,43),('205','Monalisa Art Design','2','Fancy Publication','Skand, Ajay, Sinku','Fictional Books',1100.00,'yes',2,2),('206','One Day in Woods','1','Fancy Publication','Skand, Ajay, Singh','Biography',150.00,'yes',3,3),('207','Database Manipulation','12','Tata Indian Publication','Gonawale, Haripare, Funzit','Computer Science & Engineering',480.00,'yes',4,4),('208','Basic C Learning','6','Tata Indian Publication','Skand, Ajay, Sinku','Computer Science & Engineering',452.00,'no',90,89),('209','House Architecture','13','MGraw Hills','Praveen, Avinash, Sutten','Civil Engineering',1358.00,'no',56,53),('210','Advanced Algebra','9','MGraw Hills','Praveen, Pradeep, Nabeel','Mathematics',1700.00,'no',50,44),('211','Quantum Physics','12','Tata Indian Publication','Avinash, Abhinam, Hiratrew','Physics',1005.00,'no',84,80);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue`
--

DROP TABLE IF EXISTS `issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue` (
  `Username` varchar(30) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `IssueDate` date DEFAULT NULL,
  `ReturnDate` date DEFAULT NULL,
  `NoOfExtention` int(11) DEFAULT '0',
  `ExtRequest` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Username`,`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue`
--

LOCK TABLES `issue` WRITE;
/*!40000 ALTER TABLE `issue` DISABLE KEYS */;
INSERT INTO `issue` VALUES ('aalok','201','2017-11-26','2018-01-25',3,'approved'),('aalok','202','2017-11-26','2017-12-11',0,'requested'),('aalok','203','2017-11-26','2018-01-10',2,'approved'),('aalok','210','2017-11-26','2017-12-26',1,'requested'),('aalok','211','2017-11-26','2017-12-11',0,NULL),('kriti','202','2017-11-26','2017-12-26',1,'approved'),('kriti','203','2017-11-26','2017-12-11',0,'requested'),('kriti','209','2017-11-26','2017-12-11',0,NULL),('kriti','210','2017-11-26','2017-12-26',1,'approved'),('kriti','211','2017-11-26','2017-12-11',0,'requested'),('mridul','202','2017-11-26','2017-12-11',0,NULL),('mridul','210','2017-11-26','2017-12-11',0,'requested'),('mridul','211','2017-11-26','2018-01-10',2,'requested'),('sinku','209','2017-11-26','2017-12-11',0,NULL),('sinku','210','2017-11-26','2017-12-11',0,NULL),('sinku','211','2017-11-26','2017-12-11',0,NULL),('skand','201','2017-11-26','2017-12-26',1,'requested'),('skand','202','2017-11-26','2017-12-26',1,'requested'),('skand','203','2017-11-26','2017-12-11',0,'requested'),('taylor','201','2017-11-26','2018-01-10',2,'requested'),('taylor','203','2017-11-26','2017-12-26',1,'approved'),('taylor','204','2017-11-26','2017-12-11',0,'requested'),('taylor','210','2017-11-26','2017-12-11',0,'requested'),('zyan','204','2017-11-26','2017-12-11',0,NULL),('zyan','208','2017-11-26','2017-12-11',0,NULL),('zyan','209','2017-11-26','2017-12-11',0,NULL),('zyan','210','2017-11-26','2017-12-11',0,NULL);
/*!40000 ALTER TABLE `issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stud_fac_emp`
--

DROP TABLE IF EXISTS `stud_fac_emp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud_fac_emp` (
  `Username` varchar(30) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Gender` varchar(2) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `UserType` varchar(30) DEFAULT NULL,
  `Dept` varchar(100) DEFAULT NULL,
  `Penalty` decimal(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stud_fac_emp`
--

LOCK TABLES `stud_fac_emp` WRITE;
/*!40000 ALTER TABLE `stud_fac_emp` DISABLE KEYS */;
INSERT INTO `stud_fac_emp` VALUES ('aalok','Aalok Mridul','1996-05-17','aalok@gmail.com','M','A-103, Bihta, Patna','student','Computer Science & Engineering',0.00),('abhishek','Abhishek Kumar','1998-11-06','abhishek@gmail.com','M','A-105, Boys Hostel, Patna','faculty','Computer Science & Engineering',0.00),('ajay','Ajay Kumar','1997-12-10','ajay@gmail.com','M','D-108, Faculty Quarter, Patna','faculty','Mathematics',0.00),('avinash','Avinash Karnik','1995-04-18','avinash@gmail.com','M','A-104, Staff Quarter, Patna','faculty','Electrical Engineering',0.00),('devina','Devina Ranjan','1997-12-10','devina@gmail.com','F','D-107, Faculty Quarter, Patna','faculty','Computer Science & Engineering',0.00),('himanshu','Himanshu Barua','1998-11-26','himanshu@gmail.com','M','A-111, Boys Hostel, Patna','student','Mechanical Engineering',0.00),('kriti','Kriti Kumari','1997-12-10','kriti@gmail.com','F','C-108, Girls Hostel, Patna','student','Mechanical Engineering',0.00),('mridul','Mridul Kumar','1995-04-18','mridul@gmail.com','M','A-104, Boys Hostel, Patna','student','Computer Science & Engineering',0.00),('pradeep','Pradeep Kumar','1998-11-06','pradeep@gmail.com','M','A-111, Boys Hostel, Patna','student','Mathematics',0.00),('priya','Priya Shing','1998-11-26','priya@gmail.com','F','C-106, Staff Quarter, Patna','faculty','Mathematics & Computing',0.00),('sinku','Sinku Yadav','1997-12-10','sinku@gmail.com','M','A-106, Boys Hostel, Patna','student','Electrical Engineering',0.00),('skand','Skand Gupta','1996-05-17','skand@gmail.com','M','A-121, Boys Hostel, Patna','student','Electrical Engineering',0.00),('taylor','Taylor Swift','1997-12-10','taylor@gmail.com','F','D-510, Staff Quarter, Patna','faculty','Computer Science & Engineering',0.00),('zyan','Zyan Malik','1996-05-17','zyan@gmail.com','M','A-109, Boys Hostel, Patna','student','Mechanical Engineering',0.00);
/*!40000 ALTER TABLE `stud_fac_emp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('aalok','aalok'),('abhishek','abhishek'),('ajay','ajay'),('avinash','avinash'),('devina','devina'),('himanshu','himanshu'),('kriti','kriti'),('mridul','mridul'),('pradeep','pradeep'),('priya','priya'),('sinku','sinku'),('skand','skand'),('taylor','taylor'),('zyan','zyan');
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

-- Dump completed on 2017-11-26 14:26:47
