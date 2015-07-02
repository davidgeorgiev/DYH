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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `uh`
--

CREATE TABLE IF NOT EXISTS `uh` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uh`
--

INSERT INTO `uh` (`UID`, `HWID`, `USERID`) VALUES
(23, 33, 24),
(24, 34, 14),
(25, 35, 14),
(26, 36, 14),
(27, 37, 14),
(28, 38, 14),
(29, 39, 14),
(30, 40, 14);

-- --------------------------------------------------------

--
-- Структура на таблица `uoi`
--

CREATE TABLE IF NOT EXISTS `uoi` (
  `UID` int(10) unsigned NOT NULL,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uoi`
--

INSERT INTO `uoi` (`UID`, `OtherInfoID`, `UserID`) VALUES
(16, 16, 14);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(10) unsigned NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`UID`, `Name`) VALUES
(14, 'David'),
(24, 'Давид');

-- --------------------------------------------------------

--
-- Структура на таблица `uw`
--

CREATE TABLE IF NOT EXISTS `uw` (
  `UID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `TwoWeeksID` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `uw`
--
ALTER TABLE `uw`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
