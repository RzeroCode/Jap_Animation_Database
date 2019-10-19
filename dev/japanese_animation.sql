-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 03:50 PM
-- Server version: 10.1.37-MariaDB
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
-- Database: `japanese_animation`
--
CREATE DATABASE IF NOT EXISTS `japanese_animation` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `japanese_animation`;

-- --------------------------------------------------------

--
-- Table structure for table `aaaa`
--

CREATE TABLE `aaaa` (
  `Post` varchar(2000) COLLATE utf8_bin NOT NULL,
  `Date` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `animation`
--

CREATE TABLE `animation` (
  `StudioID` int(100) NOT NULL,
  `AnimationID` int(20) NOT NULL,
  `Animation Name` varchar(3000) COLLATE utf8_bin NOT NULL,
  `Prequel` int(20) DEFAULT NULL,
  `Sequel` int(20) DEFAULT NULL,
  `Number of episodes` int(5) NOT NULL,
  `Airing season` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `Rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `animation`
--

INSERT INTO `animation` (`StudioID`, `AnimationID`, `Animation Name`, `Prequel`, `Sequel`, `Number of episodes`, `Airing season`, `Rating`) VALUES
(1, 2, 'Competitive pen spinning', NULL, NULL, 12, 'Summer 2007', 7),
(1, 3, 'åŒ–ç‰©èªž', NULL, 4, 12, 'Summer 2009', 9),
(1, 4, 'å½ç‰©èªž', 3, NULL, 12, 'Winter 2012', 7),
(2, 13, 'ãƒªãƒˆãƒ«ãƒã‚¹ã‚¿ãƒ¼ã‚º', NULL, NULL, 12, 'Fall - 2012', 7),
(1, 2345, 'ãƒ¡ã‚«ã‚¯ã‚·ãƒ†ã‚£ã‚¢ã‚¯ã‚¿ãƒ¼ã‚º ', NULL, NULL, 12, 'Spring 2004', 4),
(1, 2918, 'ã²ã ã¾ã‚Šã‚¹ã‚±ãƒƒãƒ', NULL, NULL, 12, 'Summer 2077', 2),
(1, 5487, 'é­”æ³•å°‘å¥³ã¾ã©ã‹â˜…ãƒžã‚®ã‚« (OVA) ', NULL, NULL, 1, 'Summer 1999', 10),
(1, 6790, 'Manga adaptation', NULL, NULL, 12, '', 10),
(2, 54781, 'Turning into a magical girl to teach a high schooler english!', NULL, NULL, 12, 'Spring - 2007', 10),
(2, 201837, 'aaaa', NULL, NULL, 12, 'Summer 2001', 5);

-- --------------------------------------------------------

--
-- Table structure for table `animator`
--

CREATE TABLE `animator` (
  `EmployeeID` int(50) NOT NULL,
  `Rating` int(2) DEFAULT NULL,
  `Age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `animator`
--
DELIMITER $$
CREATE TRIGGER `check_voice_actor` BEFORE INSERT ON `animator` FOR EACH ROW BEGIN  
    DECLARE dummy INT;   
    IF EXISTS (SELECT * 
               FROM `voice_actor`
               WHERE NEW.`EmployeeID` = `voice_actor`.`EmployeeID`)
        THEN 
        SELECT CONCAT('Cant insert contract employee ',NEW.`EmployeeID`,'. Already exists in hourly employee.' )  
        INTO dummy FROM information_schema.tables;
        
    END IF;  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `busa`
--

CREATE TABLE `busa` (
  `Post` varchar(2000) COLLATE utf8_bin NOT NULL,
  `Date` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(50) NOT NULL,
  `StudioID` int(100) NOT NULL,
  `EmployeeName` varchar(20) CHARACTER SET sjis COLLATE sjis_bin NOT NULL,
  `Pay` int(20) NOT NULL,
  `Job` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `StudioID`, `EmployeeName`, `Pay`, `Job`) VALUES
(1, 1, 'A', 213, 'Animator'),
(2, 2, 'Honda', 132, 'Animator'),
(3, 2, 'Tarou', 4000, 'Seiyuu'),
(4, 2, 'Tarou Toyota', 10, 'Janitor');

-- --------------------------------------------------------

--
-- Table structure for table `hayasaka`
--

CREATE TABLE `hayasaka` (
  `Post` varchar(2000) COLLATE utf8_bin NOT NULL,
  `Date` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `Name` varchar(20) COLLATE ascii_bin NOT NULL,
  `Password` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `Admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`Name`, `Password`, `Admin`) VALUES
('hunter1', '6b1b36cbb04b41490bfc0ab2bfa26f86', 1),
('a', '0cc175b9c0f1b6a831c399e269772661', 1),
('aaaa', '74b87337454200d4d33f80c4663dc5e5', NULL),
('hayasaka', '341d5d8103f8812812cc3b268777006d', 1),
('busa', '32b953b3b0e2df80112e0bbe190d736d', NULL),
('test', '098f6bcd4621d373cade4e832627b4f6', NULL),
('test2', '098f6bcd4621d373cade4e832627b4f6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `StudioName` varchar(50) CHARACTER SET sjis COLLATE sjis_bin NOT NULL,
  `StudioID` int(100) NOT NULL,
  `rating` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table for Studios';

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`StudioName`, `StudioID`, `rating`) VALUES
('SHAFT', 1, 10),
('J.C. Staff', 2, 7),
('Doga Kobo', 3, 10),
('Kyoto Animation', 4, 9),
('A-1 Pictures', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `Post` varchar(2000) COLLATE utf8_bin NOT NULL,
  `Date` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `test2`
--

CREATE TABLE `test2` (
  `Post` varchar(2000) COLLATE utf8_bin NOT NULL,
  `Date` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `voice_actor`
--

CREATE TABLE `voice_actor` (
  `EmployeeID` int(50) NOT NULL,
  `Rating` int(2) DEFAULT NULL,
  `Age` int(3) NOT NULL,
  `Gender` char(20) CHARACTER SET sjis COLLATE sjis_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `voice_actor`
--
DELIMITER $$
CREATE TRIGGER `check_animator` BEFORE INSERT ON `voice_actor` FOR EACH ROW BEGIN  
    DECLARE dummy INT;   
    IF EXISTS (SELECT * 
               FROM `animator`
               WHERE NEW.`EmployeeID` = `animator`.`EmployeeID`)
        THEN 
        SELECT CONCAT('Cant insert contract employee ',NEW.`EmployeeID`,'. Already exists in hourly employee.' )  
        INTO dummy FROM information_schema.tables;
        
    END IF;  
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animation`
--
ALTER TABLE `animation`
  ADD PRIMARY KEY (`AnimationID`),
  ADD KEY `Animation / Studio Relation` (`StudioID`),
  ADD KEY `Prequel Relation` (`Prequel`),
  ADD KEY `Sequel Relation` (`Sequel`);

--
-- Indexes for table `animator`
--
ALTER TABLE `animator`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `StudioID` (`StudioID`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`StudioID`);

--
-- Indexes for table `voice_actor`
--
ALTER TABLE `voice_actor`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animation`
--
ALTER TABLE `animation`
  ADD CONSTRAINT `Animation / Studio Relation` FOREIGN KEY (`StudioID`) REFERENCES `studio` (`StudioID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Prequel Relation` FOREIGN KEY (`Prequel`) REFERENCES `animation` (`AnimationID`) ON DELETE SET NULL,
  ADD CONSTRAINT `Sequel Relation` FOREIGN KEY (`Sequel`) REFERENCES `animation` (`AnimationID`) ON DELETE SET NULL;

--
-- Constraints for table `animator`
--
ALTER TABLE `animator`
  ADD CONSTRAINT `isa animator` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `Employee / Studio Relation` FOREIGN KEY (`StudioID`) REFERENCES `studio` (`StudioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `voice_actor`
--
ALTER TABLE `voice_actor`
  ADD CONSTRAINT `isa voice_actor` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
