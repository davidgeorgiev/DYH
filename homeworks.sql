-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2015 at 05:37 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a4726517_dyh`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `UID` (`UID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=503 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` VALUES(201, '00:00:00', '', '');
INSERT INTO `class` VALUES(202, '00:00:00', '', '');
INSERT INTO `class` VALUES(203, '00:00:00', '', '');
INSERT INTO `class` VALUES(204, '00:00:00', '', '');
INSERT INTO `class` VALUES(205, '00:00:00', '', '');
INSERT INTO `class` VALUES(206, '00:00:00', '', '');
INSERT INTO `class` VALUES(207, '00:00:00', '', '');
INSERT INTO `class` VALUES(208, '00:00:00', '', '');
INSERT INTO `class` VALUES(209, '00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class1ID` int(10) unsigned NOT NULL,
  `class2ID` int(10) unsigned NOT NULL,
  `class3ID` int(10) unsigned NOT NULL,
  `class4ID` int(10) unsigned NOT NULL,
  `class5ID` int(10) unsigned NOT NULL,
  `class6ID` int(10) unsigned NOT NULL,
  `class7ID` int(10) unsigned NOT NULL,
  `class8ID` int(10) unsigned NOT NULL,
  `class9ID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `class1ID` (`class1ID`),
  KEY `class2ID` (`class2ID`),
  KEY `class3ID` (`class3ID`),
  KEY `class4ID` (`class4ID`),
  KEY `class5ID` (`class5ID`),
  KEY `class6ID` (`class6ID`),
  KEY `class7ID` (`class7ID`),
  KEY `class8ID` (`class8ID`),
  KEY `class9ID` (`class9ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `day`
--

INSERT INTO `day` VALUES(13, 201, 202, 203, 204, 205, 206, 207, 208, 209);

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Rank` int(11) NOT NULL,
  UNIQUE KEY `UID` (`UID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `homeworks`
--


-- --------------------------------------------------------

--
-- Table structure for table `otherinfo`
--

CREATE TABLE `otherinfo` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Data` text COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `UID` (`UID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `otherinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `twoweeks`
--

CREATE TABLE `twoweeks` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EvenWeekID` int(10) unsigned NOT NULL,
  `OddWeekID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `EvenWeekID` (`EvenWeekID`),
  KEY `OddWeekID` (`OddWeekID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `twoweeks`
--


-- --------------------------------------------------------

--
-- Table structure for table `uh`
--

CREATE TABLE `uh` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `HWID` (`HWID`),
  KEY `USERID` (`USERID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `uh`
--


-- --------------------------------------------------------

--
-- Table structure for table `uoi`
--

CREATE TABLE `uoi` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `OtherInfoID` (`OtherInfoID`),
  KEY `UserID` (`UserID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `uoi`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `UID` (`UID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Table structure for table `uw`
--

CREATE TABLE `uw` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `TwoWeeksID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `UserID` (`UserID`),
  KEY `TwoWeeksID` (`TwoWeeksID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `uw`
--


-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MondayID` int(10) unsigned NOT NULL,
  `TuesdayID` int(10) unsigned NOT NULL,
  `WednesdayID` int(10) unsigned NOT NULL,
  `ThursdayID` int(10) unsigned NOT NULL,
  `FridayID` int(10) unsigned NOT NULL,
  `SaturdayID` int(10) unsigned NOT NULL,
  `SundayID` int(10) unsigned NOT NULL,
  UNIQUE KEY `UID` (`UID`),
  KEY `MondayID` (`MondayID`),
  KEY `TuesdayID` (`TuesdayID`),
  KEY `WednesdayID` (`WednesdayID`),
  KEY `ThursdayID` (`ThursdayID`),
  KEY `FridayID` (`FridayID`),
  KEY `SaturdayID` (`SaturdayID`),
  KEY `SundayID` (`SundayID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` VALUES(9, 13, 13, 13, 13, 13, 13, 13);
