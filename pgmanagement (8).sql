-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2024 at 12:21 PM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentFor` varchar(250) NOT NULL,
  `ForID` int(11) NOT NULL,
  `DocumentName` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`ID`, `DocumentFor`, `ForID`, `DocumentName`) VALUES
(1, 'tenant', 1, 'men10.jpg'),
(2, 'tenant', 2, 'men10.jpg'),
(3, 'tenant', 3, 'men10.jpg'),
(4, 'tenant', 4, 'pg1.jpg'),
(5, 'tenant', 5, 'pg1.jpg'),
(6, 'tenant', 6, 'pg1.jpg'),
(7, 'tenant', 7, 'pg1.jpg'),
(8, 'tenant', 8, 'pg1.jpg'),
(9, 'tenant', 9, 'pg1.jpg'),
(10, 'tenant', 10, 'pg1.jpg'),
(11, 'tenant', 11, 'pg1.jpg'),
(12, 'tenant', 12, 'pg1.jpg'),
(13, 'tenant', 13, 'pg1.jpg'),
(14, 'tenant', 14, '5sharing.jpg'),
(15, 'tenant', 15, 'pg1.jpg'),
(16, 'tenant', 16, '5sharing.jpg'),
(17, 'tenant', 17, '5sharing.jpg'),
(18, 'tenant', 18, '5sharing.jpg'),
(19, 'tenant', 19, 'men10.jpg'),
(20, 'tenant', 20, 'men10.jpg'),
(21, 'tenant', 24, 'Dhanush resume.pdf'),
(22, 'tenant', 25, '2024-08-24-06-46-10.png'),
(23, 'tenant', 26, '2024-08-24-06-46-10.png'),
(24, 'tenant', 27, '2024-08-24-06-46-10.png'),
(25, 'tenant', 28, '2024-08-24-06-46-10.png'),
(26, 'tenant', 29, '2024-08-24-06-46-10.png'),
(27, 'tenant', 30, '2024-08-24-06-46-10.png'),
(28, 'tenant', 31, '2024-08-24-06-46-10.png'),
(29, 'tenant', 32, '2024-08-24-06-46-10.png'),
(30, 'tenant', 33, '2024-08-24-06-46-10.png'),
(31, 'tenant', 34, '2024-08-24-06-46-10.png'),
(32, 'tenant', 35, '2024-08-24-06-46-10.png'),
(33, 'tenant', 36, '2024-08-24-06-46-10.png'),
(34, 'tenant', 37, '2024-08-24-06-46-10.png'),
(35, 'tenant', 38, '2024-08-24-06-46-10.png'),
(36, 'tenant', 39, '2024-08-24-06-46-10.png'),
(37, 'tenant', 40, '2024-08-24-06-46-10.png'),
(38, 'tenant', 41, '2024-08-24-06-46-10.png'),
(39, 'tenant', 42, 'LeaseTemplate.csv'),
(40, 'tenant', 43, 'Shamdesigan Resume.pdf'),
(41, 'tenant', 44, 'men3.jpg'),
(42, 'tenant', 45, 'men8.jpg'),
(43, 'tenant', 46, 'men4.jpg'),
(44, 'tenant', 47, 'batmobile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `FeatureID` int(11) NOT NULL AUTO_INCREMENT,
  `FeatureFor` varchar(50) DEFAULT NULL,
  `ForID` int(11) DEFAULT NULL,
  `Feature` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`FeatureID`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`FeatureID`, `FeatureFor`, `ForID`, `Feature`) VALUES
(1, 'PG', 1, 'Fridge'),
(2, 'PG', 1, 'WashingMachine'),
(3, 'PG', 1, 'Kettle'),
(4, 'PG', 1, 'Wifi'),
(5, 'PG', 6, 'Fridge'),
(6, 'PG', 6, 'Washing Machine'),
(7, 'PG', 6, 'Kettle'),
(8, 'PG', 6, 'Wifi'),
(9, 'PG', 7, 'Fridge'),
(10, 'PG', 7, 'Kettle'),
(11, 'PG', 7, 'Wifi'),
(12, 'PG', 8, 'Fridge'),
(13, 'PG', 8, 'Kettle'),
(14, 'PG', 8, 'Wifi'),
(15, 'PG', 9, 'Fridge'),
(16, 'PG', 9, 'Wifi'),
(17, 'PG', 76, 'Fridge'),
(18, 'PG', 76, 'Washing Machine'),
(19, 'PG', 77, 'Fridge'),
(20, 'PG', 77, 'Washing Machine'),
(21, 'PG', 77, 'Kettle'),
(22, 'PG', 78, 'Fridge'),
(23, 'PG', 78, 'Washing Machine'),
(24, 'PG', 78, 'Wifi'),
(25, 'PG', 79, 'Washing Machine'),
(26, 'PG', 79, 'Kettle'),
(27, 'PG', 79, 'Wifi'),
(28, 'PG', 82, 'Fridge'),
(29, 'PG', 82, 'WashingMachine'),
(30, 'PG', 82, 'Wifi'),
(31, 'PG', 83, 'Fridge'),
(32, 'PG', 83, 'WashingMachine'),
(33, 'PG', 83, 'Kettle'),
(34, 'PG', 84, 'Fridge'),
(35, 'PG', 84, 'WashingMachine'),
(36, 'PG', 84, 'Wifi'),
(37, 'PG', 85, 'Fridge'),
(38, 'PG', 85, 'WashingMachine'),
(39, 'PG', 85, 'Kettle'),
(40, 'PG', 85, 'Wifi'),
(41, 'PG', 86, 'Fridge'),
(42, 'PG', 86, 'Wifi');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `pgID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID`, `userID`, `pgID`, `roomID`, `amount`, `status`, `date`, `comment`) VALUES
(0, 43, 0, 0, '5000', 1, '2024-10-17', 'this is for test');

-- --------------------------------------------------------

--
-- Table structure for table `pg`
--

DROP TABLE IF EXISTS `pg`;
CREATE TABLE IF NOT EXISTS `pg` (
  `PGID` int(11) NOT NULL AUTO_INCREMENT,
  `PGName` varchar(100) DEFAULT NULL,
  `PGAddress` text,
  `PGMobile` varchar(15) DEFAULT NULL,
  `PGMail` varchar(100) DEFAULT NULL,
  `PGImage` varchar(255) DEFAULT NULL,
  `Advance` decimal(10,2) DEFAULT NULL,
  `PGGender` enum('Men','Women') NOT NULL DEFAULT 'Men',
  PRIMARY KEY (`PGID`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg`
--

INSERT INTO `pg` (`PGID`, `PGName`, `PGAddress`, `PGMobile`, `PGMail`, `PGImage`, `Advance`, `PGGender`) VALUES
(1, 'DK Mens PG', '54,Duraisamy street,Ekaduthangal', '8789784585', 'dkpg@gmail.com', 'pgphoto.jpg', '5000.00', 'Men'),
(2, 'Dhanush PG', '45M,Peter street,Chennai', '7848798647', 'dhanushpg@gmail.com', 'pgphoto.jpg', '2000.00', 'Men'),
(3, 'MensJoyPG', 'Vyasarbadi', '7845976274', 'mensjoypg@gmail.com', 'pg2.jpg', '3000.00', 'Men'),
(60, 'Victrory Mens PG', '17/8 ekatuthangal,Chennai', '6478794562', 'victorymenspg@gmail.com', 'pg3.jpg', '2000.00', 'Men'),
(6, 'Jayanthi Womens pg', '14b,North cross street', '7894561258', 'jayanthiwomenspg@gmail.com', 'pg7.jpg', '3000.00', 'Women'),
(7, 'VTS Girls Pg', 'Ekaduthangal', '7845976274', 'vtsgirlspg@gmail.com', 'pg4.jpg', '4000.00', 'Women'),
(76, 'ShaliniPG', '78/jason street chennai', '9874563215', 'shalinipg@gmail.com', 'pgphoto.jpg', '6000.00', 'Women'),
(9, 'Rooba PG', '14/8 new colony,Chennai', '652418794', 'roobapgchennai@gmail.com', 'pg7.jpg', '7000.00', 'Women'),
(10, 'NEW PG', '78/98,Rayapuram,Chennai', '789456123', 'newpg@gmail.com', 'pg3.jpg', '3000.00', 'Women'),
(59, 'Victrory Mens PG', '17/8 ekatuthangal,Chennai', '6478794562', 'victorymenspg@gmail.com', 'pg3.jpg', '2000.00', 'Men'),
(86, 'Karthikeyan PG', 'indigo park backside,4th street, chennai', '9874562286', 'karthikeyanpg@gmail.com', 'pg7.jpg', '24000.00', 'Men'),
(84, 'Lavanya PG', '65,Cross street,Chennai', '789456125', 'lavanyagirlspg@gmail.com', '1729244747_pg8.jpg', '2400.00', 'Men'),
(85, 'Deepa PG', '98,K8 block ,park avenue,Chennai', '9874587456', 'deepapg@gmail.com', 'pg2.jpg', '2000.00', 'Men'),
(83, 'Haricharan PG', '98, Ramanadhan street, chennai', '9456874136', 'haricharan@gmail.com', '1729244231_pg1.jpg', '2500.00', 'Men'),
(82, 'Fransico womens pg', 'north east rainbow nagar chennai', '7878954862', 'fransicowomenspg@gmail.com', '1729239095_pg3.jpg', '3000.00', 'Women'),
(81, 'JKR PG', '45,Kesavan street,chennai', '987458745', 'jkrpg@gmail.com', 'uploads/pg9.jpg', '3000.00', 'Men'),
(80, 'JKR PG', '45,Kesavan street,chennai', '987458745', 'jkrpg@gmail.com', 'uploads/pg9.jpg', '3000.00', 'Men'),
(79, 'Jayalatha PG', '78/92 anna nagar chennai', '9874561235', 'jayalathapg@gmail.com', 'pg9.jpg', '2500.00', 'Women'),
(78, 'arunpg', '78,chrompet ,chennai', '9874561235', 'arunpg@gmail.com', 'pg1.jpg', '5000.00', 'Men'),
(73, 'Enrich PG', '14,98 chennai ,poonthamli', '3698741256', 'enrichpg@gmail.com', 'pg8.jpg', '3000.00', 'Men'),
(77, 'Venus PG', '67/89 anna nagar chennai', '9874561238', 'venuspgmail@gmail.com', 'pg12.jfif', '5000.00', 'Men'),
(75, 'Brightss PG', 'Chepaakam ,Chennai', '9874569874', 'brightpg@gmail.com', 'pg7.jpg', '5000.00', 'Women'),
(74, 'Brightss PG', 'Chepaakam ,Chennai', '9874569874', 'brightpg@gmail.com', 'pg7.jpg', '5000.00', 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomName` varchar(100) DEFAULT NULL,
  `Sharing` int(11) DEFAULT NULL,
  `RoomImage` varchar(255) DEFAULT NULL,
  `RoomRent` decimal(10,2) DEFAULT NULL,
  `ACNonAC` varchar(10) DEFAULT NULL,
  `PGID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RoomID`),
  KEY `PGID` (`PGID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomName`, `Sharing`, `RoomImage`, `RoomRent`, `ACNonAC`, `PGID`) VALUES
(1, '1A', 2, '2sharedk.jpeg', '8000.00', NULL, 1),
(2, '1A', 2, '2sharedk.jpeg', '4500.00', 'Non-AC', 2),
(3, '1B', 4, 'roomphotos/4sharing.jpg', '6000.00', 'Non-AC', 6),
(4, '8D', 5, 'roomphotos/pg2.jpg', '5000.00', 'Non-AC', 6),
(5, 'A1', 3, 'roomphotos/4sharing.jpg', '6400.00', 'AC', 7),
(6, '1B', 4, 'roomphotos/4sharing.jpg', '5800.00', 'AC', 7),
(7, 'A1', 3, 'roomphotos/4sharing.jpg', '6400.00', 'AC', 8),
(8, '1A', 2, NULL, '4500.00', 'Non-AC', 38),
(9, '1A', 2, NULL, '8000.00', 'AC', 40),
(10, '1B', 6, NULL, '6000.00', 'AC', 42),
(11, '1B', 6, NULL, '6000.00', 'AC', 44),
(12, '1B', 6, NULL, '6000.00', 'AC', 46),
(13, '1B', 6, NULL, '6000.00', 'AC', 48),
(14, '1B', 6, NULL, '6000.00', 'AC', 50),
(15, '1B', 6, NULL, '6000.00', 'AC', 52),
(16, '1B', 6, NULL, '6000.00', 'AC', 54),
(17, '1B', 6, NULL, '6000.00', 'AC', 56),
(18, '1B', 6, NULL, '6000.00', 'AC', 58),
(19, '1B', 6, NULL, '6000.00', 'AC', 60),
(20, '1B', 6, NULL, '6000.00', 'AC', 62),
(21, '1B', 6, NULL, '6000.00', 'AC', 64),
(22, 'k8', 6, NULL, '4500.00', 'Non-AC', 64),
(23, '1B', 6, NULL, '6000.00', 'AC', 66),
(24, 'k8', 6, NULL, '4500.00', 'Non-AC', 66),
(25, '1B', 6, NULL, '6000.00', 'AC', 68),
(26, 'k8', 6, NULL, '4500.00', 'Non-AC', 68),
(27, '12', 6, NULL, '4500.00', 'AC', 70),
(28, '12', 6, NULL, '4500.00', 'AC', 72),
(29, 'k9', 3, NULL, '4500.00', 'AC', 74),
(30, 'Floor1 hall ', 5, 'roomphotos/2sharedk.jpeg', '6000.00', 'Non-AC', 76),
(31, '1st floor hall', 4, 'roomphotos/room14.jfif', '4500.00', 'AC', 77),
(32, 'ground room1', 2, 'roomphotos/.jpg', '5000.00', 'AC', 78),
(33, '1B', 2, 'roomphotos/room6.jpg', '5000.00', 'AC', 79),
(34, '1st f corner room', 3, '1729239095_room9.jpg', '7000.00', 'AC', 82),
(35, '2nd f right room', 4, '1729239095_room1.jpg', '6000.00', 'AC', 82),
(36, 'L6', 3, '1729244231_room1.jpg', '4500.00', 'AC', 83),
(37, 'k8', 6, '1729244747_room12.jpg', '4500.00', 'AC', 84),
(38, 'Hall centre room', 6, 'room5.jpg', '4500.00', 'AC', 85),
(39, 'Corner block terrace  room', 3, 'room1.jpg', '6000.00', 'AC', 85),
(40, 'k8', 6, 'room4.jpg', '4500.00', 'AC', 86);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(250) NOT NULL,
  `rights` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `pgID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `gender`, `mail`, `phone`, `address`, `status`, `rights`, `username`, `password`, `pgID`, `RoomID`) VALUES
(1, 'karthi', 'male', 'karthi@gmail.com', '78985462', '', '1', 'norights', '', '', 0, 0),
(2, 'Ramkumar', 'male', 'ramkumar@gmail.com', '7875645253', '', '2', 'norights', '', '', 0, 0),
(3, 'karthickraj', 'male', 'karthickraj@gmail.com', '787984662', '', '1', 'norights', '', '', 0, 0),
(4, 'vasu', 'male', 'vasu@gmail.com', '7894655213', '', '0', 'norights', '', '', 0, 0),
(5, 'Krithick', 'male', 'krithiclk@gmail.com', '7894655213', '', '0', 'norights', '', '', 0, 0),
(6, 'mayilsamy', 'male', 'mayilsamynn@gmail.com', '7894655213', '', '0', 'norights', '', '', 0, 0),
(12, 'Ramkumar', 'male', 'marlin@gmail.com', '7894655213', '', '0', 'norights', '', '', 0, 0),
(14, 'Pragadeesh', 'male', 'ramkumar@gmail.com', '7894655213', '', '0', 'norights', '', '', 0, 0),
(16, 'Farry', 'male', 'farry@gmail.com', '9878978565', '', '0', 'norights', 'farry@12345', '$2y$10$.QGupoZpYVHTUG7dAkA0meYmocCr0Kuh4M/xVClBYtwx8XDF0rqti', 0, 0),
(19, 'Renuga', 'female', 'renuga@gmail.com', '789456124', '', '0', 'norights', 'Renuga', '$2y$10$KKsMQZgca23eeI4oImWwQObqshvTNGiF5HyAeLpJDu3.A7LVYNKHG', 0, 0),
(20, 'priya', 'female', 'priya@gmail.com', '7894561235', '', '0', 'norights', 'Priya', '$2y$10$C/02aefydvusxQANk5I8FO1UQWVKjccGcMffl63dL475LoPjPsBwi', 0, 0),
(21, 'dhanush', 'male', 'dfir8krlot0kimgi8ki8@gmail.com', '1234567899', '', '0', 'norights', 'olt', '$2y$10$IdjEzyBzfhRT9DstQr/sKemsWzHMgmHDCUR8DPPhWO3VdEFMO2Ylm', 0, 0),
(22, 'admin', 'admin', '', '', '', '', '', 'admin', 'admin', 0, 0),
(24, 'kamali', 'female', 'kamali@gmail.com', '7894561235', '', '0', 'norights', 'KAMALI', '$2y$10$GwP3c0G3ra1SLhm5eb.PtOAT4vZ6pnNBUWg9nBj4W0T2uWOW5NkMC', 0, 0),
(25, 'harisudhan', 'male', 'harisudhan@gmail.com', '7894561235', '', '0', 'norights', 'hari', '$2y$10$4Shou1WqVPZZxnf2iD8AE.zFB64cAyIcMGQddDvYltMW4A.hj9moO', 0, 0),
(47, 'harini', 'female', 'harini@gmail.com', '987456321', '', '1', 'norights', 'HARINI', 'harini', 6, 4),
(42, 'gOKUL', 'male', 'gokul@gmail.com', '7894561238', '', '1', 'norights', 'GOKUL', '$2y$10$suAn81HFrLlXOvMMkNcB1OenUgeqgQNsVzcj5Zbq3mFxCplzfhWui', 0, 0),
(43, 'Sesha', 'female', 'sesha@gmail.com', '8779879754', '', '1', 'norights', 'sesha', 'sesha', 0, 0),
(45, 'Jayanthi', 'female', 'jayanthi@gmail.com', '7894561235', '', '0', 'norights', 'JAYANTHI', 'JAYANTHI', 0, 0),
(44, 'sangami', 'female', 'sangami@gmail.com', '6547894568', '', '1', 'norights', 'Sangami', '$2y$10$7xmr.NwJvIf3RIqXfFJEZuTSK8LeFm6Agcqb9bDwZbKlqQ9Ohk91q', 0, 0),
(46, 'kamalesh', 'male', 'kamalesh@gmali.com', '4578457849', '', '0', 'norights', 'Kamalesh', 'Kamalesh', 8, 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
