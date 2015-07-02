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
-- Структура на таблица `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `UID` int(10) unsigned NOT NULL,
  `time` time NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

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
(209, '00:00:00', '', ''),
(231, '00:00:00', '', ''),
(232, '14:30:00', 'Информационни технологии', '36'),
(233, '15:00:00', 'Информационни технологии', '36'),
(234, '16:50:00', 'Български език', '27'),
(235, '16:50:00', 'Български език', '27'),
(236, '17:30:00', 'Български език', '27'),
(237, '18:40:00', 'Математика', '41'),
(238, '19:30:00', 'Математика', '41'),
(239, '00:00:00', '', ''),
(240, '00:00:00', '', ''),
(241, '00:00:00', '', ''),
(242, '14:30:00', 'Информационни технологии', '36'),
(243, '15:00:00', 'Информационни технологии', '36'),
(244, '16:50:00', 'Български език', '27'),
(245, '16:50:00', 'Български език', '27'),
(246, '17:30:00', 'Български език', '27'),
(247, '18:40:00', 'Математика', '41'),
(248, '19:30:00', 'Математика', '41'),
(249, '00:00:00', '', ''),
(250, '00:00:00', '', ''),
(251, '00:00:00', '', ''),
(252, '14:30:00', 'Информационни технологии', '36'),
(253, '15:00:00', 'Информационни технологии', '36'),
(254, '16:50:00', 'Български език', '27'),
(255, '16:50:00', 'Български език', '27'),
(256, '17:30:00', 'Български език', '27'),
(257, '18:40:00', 'Математика', '41'),
(258, '19:30:00', 'Математика', '41'),
(259, '00:00:00', '', ''),
(260, '00:00:00', '', ''),
(261, '00:00:00', '', ''),
(262, '14:30:00', 'Информационни технологии', '36'),
(263, '15:00:00', 'Информационни технологии', '36'),
(264, '16:50:00', 'Български език', '27'),
(265, '16:50:00', 'Български език', '27'),
(266, '17:30:00', 'Български език', '27'),
(267, '18:40:00', 'Математика', '41'),
(268, '19:30:00', 'Математика', '41'),
(269, '00:00:00', '', ''),
(270, '00:00:00', '', ''),
(271, '00:00:00', '', ''),
(272, '14:30:00', 'Информационни технологии', '36'),
(273, '15:00:00', 'Информационни технологии', '36'),
(274, '16:50:00', 'Български език', '27'),
(275, '16:50:00', 'Български език', '27'),
(276, '17:30:00', 'Български език', '27'),
(277, '18:40:00', 'Математика', '41'),
(278, '19:30:00', 'Математика', '41'),
(279, '00:00:00', '', ''),
(280, '00:00:00', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `day`
--

INSERT INTO `day` (`UID`, `class1ID`, `class2ID`, `class3ID`, `class4ID`, `class5ID`, `class6ID`, `class7ID`, `class8ID`, `class9ID`) VALUES
(13, 201, 202, 203, 204, 205, 206, 207, 208, 209),
(19, 231, 232, 233, 234, 235, 236, 237, 238, 239),
(20, 241, 242, 243, 244, 245, 246, 247, 248, 249),
(21, 251, 252, 253, 254, 255, 256, 257, 258, 259),
(22, 261, 262, 263, 264, 265, 266, 267, 268, 269),
(23, 271, 272, 273, 274, 275, 276, 277, 278, 279);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `homeworks`
--

INSERT INTO `homeworks` (`UID`, `Date`, `Title`, `Data`, `Rank`) VALUES
(31, '2015-07-01', 'Напомняне', 'Отивай да закусваш!', 3),
(32, '2015-07-01', 'Напомняне', 'Автобус в 13:20', 3),
(33, '2015-07-01', 'Напомняне', 'Автобус в 13:20', 4),
(34, '2015-07-01', 'Напомняне', 'Лицеви и коремни', 2),
(35, '2015-07-01', 'Напомняне', 'Краен срок за заявление за стажа до 16:00 ч. (да се прати и по e-mail-а на Чорбаджиев - pdf,docx,odt) - Образеца на заявлението - doc, odt Разпечатани и подписани заявления се предават в 24 кабинет. Заявленията в електронен вид се предават на email: lchorbadjiev@elsys-bg.org', 4),
(36, '2015-07-01', 'Домашно', 'отвори <a href = "http://11b-16.free.bg/">това</a>', 1),
(37, '2015-07-01', 'Напомняне', 'Да се представи служебната бележка (издадена от фирмата) и отчета (самоотчет, дневник - трябва да съдържа какво сме правили повреме на стажа, поне 2 страници - хронологично)', 3),
(38, '2015-06-30', 'Домашно', 'Да си гледаш Hell girl 12 ep', 2),
(39, '2015-07-04', 'Напомняне', 'Да се представи служебната бележка (издадена от фирмата) и отчета (самоотчет, дневник - трябва да съдържа какво сме правили повреме на стажа, поне 2 страници - хронологично)', 3),
(40, '2015-07-07', 'Домашно - БЕЛ', 'Да прочетем Градушка на Яворов и да отговорим на следните въпроси.   1. На колко части е разделено стихотворението?  2. Кой и за какво говори в отделните части? 3. В коя част гласът на героя и лирическия говорител се сливат в едно? 4. Каква част от стихотворението е отделена за описание на градушката? 5. Какво чувство поражда стихотворението?', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `otherinfo`
--

CREATE TABLE IF NOT EXISTS `otherinfo` (
  `UID` int(10) unsigned NOT NULL,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `otherinfo`
--

INSERT INTO `otherinfo` (`UID`, `Title`, `Data`) VALUES
(15, 'Напомняне', 'Да си в Национален студентски дом в 14:30'),
(16, 'Напомняне', 'Да си гледаш работата идиот такъв!');

-- --------------------------------------------------------

--
-- Структура на таблица `twoweeks`
--

CREATE TABLE IF NOT EXISTS `twoweeks` (
  `UID` int(10) unsigned NOT NULL,
  `EvenWeekID` int(10) unsigned NOT NULL,
  `OddWeekID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `twoweeks`
--

INSERT INTO `twoweeks` (`UID`, `EvenWeekID`, `OddWeekID`) VALUES
(7, 9, 9),
(8, 9, 9),
(9, 12, 9),
(10, 13, 9),
(11, 14, 9),
(12, 15, 9);

-- --------------------------------------------------------

--
-- Структура на таблица `uh`
--

CREATE TABLE IF NOT EXISTS `uh` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `uoi`
--

CREATE TABLE IF NOT EXISTS `uoi` (
  `UID` int(10) unsigned NOT NULL,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(10) unsigned NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`UID`, `Name`) VALUES
(26, 'David');

-- --------------------------------------------------------

--
-- Структура на таблица `uw`
--

CREATE TABLE IF NOT EXISTS `uw` (
  `UID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `TwoWeeksID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uw`
--

INSERT INTO `uw` (`UID`, `UserID`, `TwoWeeksID`) VALUES
(7, 26, 8),
(8, 26, 8),
(9, 26, 9),
(10, 26, 10),
(11, 26, 11),
(12, 26, 12);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `weeks`
--

INSERT INTO `weeks` (`UID`, `MondayID`, `TuesdayID`, `WednesdayID`, `ThursdayID`, `FridayID`, `SaturdayID`, `SundayID`) VALUES
(9, 13, 13, 13, 13, 13, 13, 13),
(12, 20, 13, 13, 13, 13, 13, 13),
(13, 13, 21, 13, 13, 13, 13, 13),
(14, 22, 13, 13, 13, 13, 13, 13),
(15, 22, 23, 13, 13, 13, 13, 13);

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
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=281;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `otherinfo`
--
ALTER TABLE `otherinfo`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `twoweeks`
--
ALTER TABLE `twoweeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `uh`
--
ALTER TABLE `uh`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `uoi`
--
ALTER TABLE `uoi`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `uw`
--
ALTER TABLE `uw`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `day`
--
ALTER TABLE `day`
ADD CONSTRAINT `day_ibfk_1` FOREIGN KEY (`class1ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_2` FOREIGN KEY (`class2ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_3` FOREIGN KEY (`class3ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_4` FOREIGN KEY (`class4ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_5` FOREIGN KEY (`class5ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_6` FOREIGN KEY (`class6ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_7` FOREIGN KEY (`class7ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_8` FOREIGN KEY (`class8ID`) REFERENCES `class` (`UID`),
ADD CONSTRAINT `day_ibfk_9` FOREIGN KEY (`class9ID`) REFERENCES `class` (`UID`);

--
-- Ограничения за таблица `twoweeks`
--
ALTER TABLE `twoweeks`
ADD CONSTRAINT `twoweeks_ibfk_1` FOREIGN KEY (`EvenWeekID`) REFERENCES `weeks` (`UID`),
ADD CONSTRAINT `twoweeks_ibfk_2` FOREIGN KEY (`OddWeekID`) REFERENCES `weeks` (`UID`);

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

--
-- Ограничения за таблица `uw`
--
ALTER TABLE `uw`
ADD CONSTRAINT `uw_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UID`),
ADD CONSTRAINT `uw_ibfk_2` FOREIGN KEY (`TwoWeeksID`) REFERENCES `twoweeks` (`UID`);

--
-- Ограничения за таблица `weeks`
--
ALTER TABLE `weeks`
ADD CONSTRAINT `weeks_ibfk_1` FOREIGN KEY (`MondayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_2` FOREIGN KEY (`TuesdayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_3` FOREIGN KEY (`WednesdayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_4` FOREIGN KEY (`ThursdayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_5` FOREIGN KEY (`FridayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_6` FOREIGN KEY (`SaturdayID`) REFERENCES `day` (`UID`),
ADD CONSTRAINT `weeks_ibfk_7` FOREIGN KEY (`SundayID`) REFERENCES `day` (`UID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
