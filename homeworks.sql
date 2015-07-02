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
-- Database: `homeworks`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `homeworks`
--

INSERT INTO `homeworks` (`UID`, `Date`, `Title`, `Data`, `Rank`) VALUES
(1, '2015-06-30', 'Напомняне', 'Час на класа в 10:00', 1),
(2, '2015-07-01', 'Проба', 'Някакво домашно', 2),
(3, '2015-06-30', 'Напомняне', 'Да дойдеш на училище', 3),
(4, '2015-07-01', 'Стаж в СОКИ', 'Да си там в 14:30', 4),
(5, '2015-07-01', 'Важно', 'Гледай да си водиш дневник', 3),
(15, '2015-06-30', 'Домашно', 'Да си гледаш Hell girl 12 ep', 2),
(16, '2015-06-30', 'Домашно1', 'Да си гледаш Hell girl 13 ep', 2),
(17, '2015-06-30', 'Домашно3', 'Да си гледаш Hell girl 14 ep', 2),
(18, '2015-06-30', 'Домашно4', 'Да си гледаш Hell girl 15 ep', 2),
(20, '2015-06-30', 'Напомняне', 'Отивай да ядеш бе!!!', 3),
(21, '0000-00-00', '', '', 0),
(22, '2015-06-30', '123', '123', 2),
(23, '2015-07-03', 'Отивай да учиш бе тъпак!', 'всичко да си научил щото ще те убия', 3),
(24, '2015-06-30', 'Домашно', 'хвърли боклука', 2),
(25, '2015-06-30', 'Домашно', 'отивай да простираш', 2),
(26, '2015-06-30', 'Напомняне', 'Кажи на Косьо да спре да се хили', 3);

-- --------------------------------------------------------

--
-- Структура на таблица `otherinfo`
--

CREATE TABLE IF NOT EXISTS `otherinfo` (
  `UID` int(10) unsigned NOT NULL,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `otherinfo`
--

INSERT INTO `otherinfo` (`UID`, `Title`, `Data`) VALUES
(11, 'Домашно', 'Отивай да простираш!'),
(12, 'Домашно', 'Хайде отивай да простираш че ми писна бе идиот!!!');

-- --------------------------------------------------------

--
-- Структура на таблица `uh`
--

CREATE TABLE IF NOT EXISTS `uh` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uh`
--

INSERT INTO `uh` (`UID`, `HWID`, `USERID`) VALUES
(1, 1, 1),
(2, 4, 1),
(3, 5, 1),
(6, 15, 1),
(7, 16, 1),
(8, 17, 1),
(9, 18, 1),
(10, 20, 1),
(13, 23, 1),
(14, 24, 1),
(15, 25, 3),
(16, 26, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `uoi`
--

CREATE TABLE IF NOT EXISTS `uoi` (
  `UID` int(10) unsigned NOT NULL,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uoi`
--

INSERT INTO `uoi` (`UID`, `OtherInfoID`, `UserID`) VALUES
(10, 11, 2),
(11, 12, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(10) unsigned NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`UID`, `Name`) VALUES
(1, 'David'),
(2, 'Ivan'),
(3, 'yoana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `otherinfo`
--
ALTER TABLE `otherinfo`
  ADD UNIQUE KEY `UID` (`UID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `otherinfo`
--
ALTER TABLE `otherinfo`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `uh`
--
ALTER TABLE `uh`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `uoi`
--
ALTER TABLE `uoi`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `uh`
--
ALTER TABLE `uh`
ADD CONSTRAINT `uh_ibfk_1` FOREIGN KEY (`HWID`) REFERENCES `homeworks` (`UID`),
ADD CONSTRAINT `uh_ibfk_2` FOREIGN KEY (`USERID`) REFERENCES `user` (`UID`);

--
-- Ограничения за таблица `uoi`
--
ALTER TABLE `uoi`
ADD CONSTRAINT `uoi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UID`),
ADD CONSTRAINT `uoi_ibfk_2` FOREIGN KEY (`OtherInfoID`) REFERENCES `otherinfo` (`UID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
