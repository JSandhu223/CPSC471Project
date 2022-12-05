-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: gameplatform
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `added_to`
--

DROP TABLE IF EXISTS `added_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `added_to` (
  `CartID` int NOT NULL,
  `GameID` int NOT NULL,
  PRIMARY KEY (`CartID`,`GameID`),
  KEY `ADDEDTOGAME_FK` (`GameID`),
  CONSTRAINT `ADDEDTOCART_FK` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
  CONSTRAINT `ADDEDTOGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `added_to`
--

LOCK TABLES `added_to` WRITE;
/*!40000 ALTER TABLE `added_to` DISABLE KEYS */;
INSERT INTO `added_to` VALUES (1007,1),(1008,1),(1007,2),(1008,2),(1007,3),(1008,3),(1007,4),(1008,4),(1008,5);
/*!40000 ALTER TABLE `added_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrator` (
  `AdminID` int NOT NULL AUTO_INCREMENT,
  `Fname` varchar(64) NOT NULL,
  `Lname` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  PRIMARY KEY (`AdminID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'Bage','Oldell','admin.bageoldell@mistsoftware.com','LoomyWTF');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `belong_to`
--

DROP TABLE IF EXISTS `belong_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `belong_to` (
  `LibraryID` int NOT NULL,
  `GameID` int NOT NULL,
  PRIMARY KEY (`LibraryID`,`GameID`),
  KEY `BELONGTOGAME_FK` (`GameID`),
  CONSTRAINT `BELONGTOGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`),
  CONSTRAINT `BELONGTOLIBRARY_FK` FOREIGN KEY (`LibraryID`) REFERENCES `library` (`LibraryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belong_to`
--

LOCK TABLES `belong_to` WRITE;
/*!40000 ALTER TABLE `belong_to` DISABLE KEYS */;
INSERT INTO `belong_to` VALUES (1002,6),(1003,6),(1004,6);
/*!40000 ALTER TABLE `belong_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `CartID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `NumItems` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`CartID`,`UserID`),
  KEY `CARTUSER_FK` (`UserID`),
  CONSTRAINT `CARTUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1011 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1006,1,0),(1007,2,0),(1008,7,0),(1009,4,0),(1010,5,0);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_group`
--

DROP TABLE IF EXISTS `community_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_group` (
  `Gname` varchar(64) NOT NULL,
  `MemCount` int NOT NULL DEFAULT '0',
  `GameID` int NOT NULL,
  PRIMARY KEY (`Gname`),
  UNIQUE KEY `GameID` (`GameID`),
  CONSTRAINT `GROUPGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_group`
--

LOCK TABLES `community_group` WRITE;
/*!40000 ALTER TABLE `community_group` DISABLE KEYS */;
INSERT INTO `community_group` VALUES ('Awake Dogs - Group',0,2),('Call off Duty - Group',0,4),('Full-Death - Group',0,3),('Gerry\'s Mod - Group',0,6),('Sleeping Simulator - Group',0,1),('STEINS;CRACK - Group',0,5);
/*!40000 ALTER TABLE `community_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developer`
--

DROP TABLE IF EXISTS `developer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developer` (
  `Dname` varchar(64) NOT NULL,
  `StartDate` date NOT NULL,
  PRIMARY KEY (`Dname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developer`
--

LOCK TABLES `developer` WRITE;
/*!40000 ALTER TABLE `developer` DISABLE KEYS */;
INSERT INTO `developer` VALUES ('FaceKick Studios','2021-05-05'),('GAMES INC.','2021-04-04'),('Hogwash','2018-01-01'),('Lazy Games','2022-03-03'),('Ynos Studios','2020-02-02');
/*!40000 ALTER TABLE `developer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluates`
--

DROP TABLE IF EXISTS `evaluates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluates` (
  `AdminID` int NOT NULL,
  `GameID` int NOT NULL,
  `Is_approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`AdminID`,`GameID`),
  KEY `EVALUATEGAME_FK` (`GameID`),
  CONSTRAINT `EVALUATEADMIN_FK` FOREIGN KEY (`AdminID`) REFERENCES `administrator` (`AdminID`),
  CONSTRAINT `EVALUATEGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluates`
--

LOCK TABLES `evaluates` WRITE;
/*!40000 ALTER TABLE `evaluates` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends_with`
--

DROP TABLE IF EXISTS `friends_with`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friends_with` (
  `UserA` int NOT NULL,
  `UserB` int NOT NULL,
  PRIMARY KEY (`UserA`,`UserB`),
  KEY `USERB_FK` (`UserB`),
  CONSTRAINT `USERA_FK` FOREIGN KEY (`UserA`) REFERENCES `user` (`UserID`),
  CONSTRAINT `USERB_FK` FOREIGN KEY (`UserB`) REFERENCES `user` (`UserID`),
  CONSTRAINT `friends_with_chk_1` CHECK ((`UserA` <> `UserB`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends_with`
--

LOCK TABLES `friends_with` WRITE;
/*!40000 ALTER TABLE `friends_with` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends_with` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `GameID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(64) NOT NULL,
  `AgeRating` char(1) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `Dname` varchar(64) NOT NULL,
  PRIMARY KEY (`GameID`),
  UNIQUE KEY `Title` (`Title`),
  KEY `GAMEDEV_FK` (`Dname`),
  CONSTRAINT `GAMEDEV_FK` FOREIGN KEY (`Dname`) REFERENCES `developer` (`Dname`),
  CONSTRAINT `RATING_CHECK` CHECK (((`AgeRating` like _utf8mb4'E') or (`AgeRating` like _utf8mb4'T') or (`AgeRating` like _utf8mb4'M')))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Sleeping Simulator','E','2022-09-30',19.99,'Hogwash'),(2,'Awake Dogs','M','2021-08-28',19.99,'Ynos Studios'),(3,'Full-Death','M','2022-08-09',19.99,'Lazy Games'),(4,'Call off Duty','M','2022-06-15',9.99,'Hogwash'),(5,'STEINS;CRACK','T','2022-02-02',29.99,'GAMES INC.'),(6,'Gerry\'s Mod','T','2022-03-19',9.99,'FaceKick Studios');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library`
--

DROP TABLE IF EXISTS `library`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `library` (
  `LibraryID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `GameCount` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`LibraryID`,`UserID`),
  KEY `LIBRARYUSER_FK` (`UserID`),
  CONSTRAINT `LIBRARYUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library`
--

LOCK TABLES `library` WRITE;
/*!40000 ALTER TABLE `library` DISABLE KEYS */;
INSERT INTO `library` VALUES (1002,7,1),(1003,1,1),(1004,2,1),(1005,4,0),(1006,5,0);
/*!40000 ALTER TABLE `library` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `UserID` int NOT NULL,
  `Gname` varchar(64) NOT NULL,
  PRIMARY KEY (`UserID`,`Gname`),
  KEY `MEMBERGNAME_FK` (`Gname`),
  CONSTRAINT `MEMBERGNAME_FK` FOREIGN KEY (`Gname`) REFERENCES `community_group` (`Gname`),
  CONSTRAINT `MEMBERUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `DisplayName` varchar(64) NOT NULL,
  `UserID` int NOT NULL,
  `FriendCount` int DEFAULT '0',
  PRIMARY KEY (`DisplayName`,`UserID`),
  KEY `PROFILEUSER_FK` (`UserID`),
  CONSTRAINT `PROFILEUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES ('janedoe456',2,0),('johndoe123',1,0),('meow',4,0);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `UserID` int NOT NULL,
  `GameID` int NOT NULL,
  PRIMARY KEY (`UserID`,`GameID`),
  KEY `PURCHASEGAME_FK` (`GameID`),
  CONSTRAINT `PURCHASEGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`),
  CONSTRAINT `PURCHASEUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating` (
  `RatingID` int NOT NULL AUTO_INCREMENT,
  `Score` int DEFAULT NULL,
  `UserID` int NOT NULL,
  `GameID` int NOT NULL,
  PRIMARY KEY (`RatingID`),
  UNIQUE KEY `UQ_UserID_GameID` (`UserID`,`GameID`),
  KEY `REVIEWGAME_FK` (`GameID`),
  CONSTRAINT `REVIEWGAME_FK` FOREIGN KEY (`GameID`) REFERENCES `game` (`GameID`),
  CONSTRAINT `REVIEWUSER_FK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `rating_chk_1` CHECK (((`Score` >= 1) and (`Score` <= 10)))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'johndoe123','johndoe@hotmail.com','qwertyuiop'),(2,'janedoe456','janedoe@gmail.com','qwertyuiop'),(4,'meow','meow@gmail.com','meowmeow1234'),(5,'johnjones1999','johnjones@gmail.com','qwertyuiop'),(7,'weirdoe789','weirdoe@gmail.com','qwertyuiop');
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

-- Dump completed on 2022-12-05  4:37:01
