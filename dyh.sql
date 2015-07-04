-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dyh`
--

-- --------------------------------------------------------

--
-- Структура на таблица `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `UID` int(10) unsigned NOT NULL,
  `time` time NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=647 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `class`
--

INSERT INTO `class` (`UID`, `time`, `subject`, `info`) VALUES
(201, '00:00:00', '', ''),
(202, '00:00:00', '', ''),
(203, '00:00:00', '', ''),
(204, '00:00:00', '', ''),
(205, '00:00:00', '', ''),
(206, '00:00:00', '', ''),
(207, '00:00:00', '', ''),
(208, '00:00:00', '', ''),
(209, '00:00:00', '', '');

-- --------------------------------------------------------

--
-- Структура на таблица `day`
--

CREATE TABLE IF NOT EXISTS `day` (
  `UID` int(10) unsigned NOT NULL,
  `class1ID` int(10) unsigned NOT NULL,
  `class2ID` int(10) unsigned NOT NULL,
  `class3ID` int(10) unsigned NOT NULL,
  `class4ID` int(10) unsigned NOT NULL,
  `class5ID` int(10) unsigned NOT NULL,
  `class6ID` int(10) unsigned NOT NULL,
  `class7ID` int(10) unsigned NOT NULL,
  `class8ID` int(10) unsigned NOT NULL,
  `class9ID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `day`
--

INSERT INTO `day` (`UID`, `class1ID`, `class2ID`, `class3ID`, `class4ID`, `class5ID`, `class6ID`, `class7ID`, `class8ID`, `class9ID`) VALUES
(13, 201, 202, 203, 204, 205, 206, 207, 208, 209);

-- --------------------------------------------------------

--
-- Структура на таблица `homeworks`
--

CREATE TABLE IF NOT EXISTS `homeworks` (
  `UID` int(10) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Data` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Rank` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `hwimg`
--

CREATE TABLE IF NOT EXISTS `hwimg` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `IMGURLID` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `imgurl`
--

CREATE TABLE IF NOT EXISTS `imgurl` (
  `UID` int(10) unsigned NOT NULL,
  `URL` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `otherinfo`
--

CREATE TABLE IF NOT EXISTS `otherinfo` (
  `UID` int(10) unsigned NOT NULL,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `twoweeks`
--

CREATE TABLE IF NOT EXISTS `twoweeks` (
  `UID` int(10) unsigned NOT NULL,
  `EvenWeekID` int(10) unsigned NOT NULL,
  `OddWeekID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `uh`
--

CREATE TABLE IF NOT EXISTS `uh` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `uoi`
--

CREATE TABLE IF NOT EXISTS `uoi` (
  `UID` int(10) unsigned NOT NULL,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(10) unsigned NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `uw`
--

CREATE TABLE IF NOT EXISTS `uw` (
  `UID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `TwoWeeksID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `weeks`
--

CREATE TABLE IF NOT EXISTS `weeks` (
  `UID` int(10) unsigned NOT NULL,
  `MondayID` int(10) unsigned NOT NULL,
  `TuesdayID` int(10) unsigned NOT NULL,
  `WednesdayID` int(10) unsigned NOT NULL,
  `ThursdayID` int(10) unsigned NOT NULL,
  `FridayID` int(10) unsigned NOT NULL,
  `SaturdayID` int(10) unsigned NOT NULL,
  `SundayID` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `weeks`
--

INSERT INTO `weeks` (`UID`, `MondayID`, `TuesdayID`, `WednesdayID`, `ThursdayID`, `FridayID`, `SaturdayID`, `SundayID`) VALUES
(9, 13, 13, 13, 13, 13, 13, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `class1ID` (`class1ID`), ADD KEY `class2ID` (`class2ID`), ADD KEY `class3ID` (`class3ID`), ADD KEY `class4ID` (`class4ID`), ADD KEY `class5ID` (`class5ID`), ADD KEY `class6ID` (`class6ID`), ADD KEY `class7ID` (`class7ID`), ADD KEY `class8ID` (`class8ID`), ADD KEY `class9ID` (`class9ID`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `hwimg`
--
ALTER TABLE `hwimg`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `HWID` (`HWID`), ADD KEY `IMGURLID` (`IMGURLID`);

--
-- Indexes for table `imgurl`
--
ALTER TABLE `imgurl`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `otherinfo`
--
ALTER TABLE `otherinfo`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `twoweeks`
--
ALTER TABLE `twoweeks`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `EvenWeekID` (`EvenWeekID`), ADD KEY `OddWeekID` (`OddWeekID`);

--
-- Indexes for table `uh`
--
ALTER TABLE `uh`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `HWID` (`HWID`), ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `uoi`
--
ALTER TABLE `uoi`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `OtherInfoID` (`OtherInfoID`), ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `uw`
--
ALTER TABLE `uw`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `UserID` (`UserID`), ADD KEY `TwoWeeksID` (`TwoWeeksID`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD UNIQUE KEY `UID` (`UID`), ADD KEY `MondayID` (`MondayID`), ADD KEY `TuesdayID` (`TuesdayID`), ADD KEY `WednesdayID` (`WednesdayID`), ADD KEY `ThursdayID` (`ThursdayID`), ADD KEY `FridayID` (`FridayID`), ADD KEY `SaturdayID` (`SaturdayID`), ADD KEY `SundayID` (`SundayID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=647;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `hwimg`
--
ALTER TABLE `hwimg`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `imgurl`
--
ALTER TABLE `imgurl`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `otherinfo`
--
ALTER TABLE `otherinfo`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `twoweeks`
--
ALTER TABLE `twoweeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `uh`
--
ALTER TABLE `uh`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `uoi`
--
ALTER TABLE `uoi`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `uw`
--
ALTER TABLE `uw`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
