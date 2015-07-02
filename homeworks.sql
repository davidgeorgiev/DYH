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
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;

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
(280, '00:00:00', '', ''),
(281, '00:00:00', '', ''),
(282, '14:30:00', 'Информационни технологии', '36'),
(283, '15:00:00', 'Информационни технологии', '36'),
(284, '16:50:00', 'Български език', '27'),
(285, '16:50:00', 'Български език', '27'),
(286, '17:30:00', 'Български език', '27'),
(287, '18:40:00', 'Математика', '41'),
(288, '19:30:00', 'Математика', '41'),
(289, '00:00:00', '', ''),
(290, '00:00:00', '', ''),
(291, '00:00:00', '', ''),
(292, '14:30:00', 'Информационни технологии', '36'),
(293, '15:00:00', 'Информационни технологии', '36'),
(294, '16:50:00', 'Български език', '27'),
(295, '16:50:00', 'Български език', '27'),
(296, '17:30:00', 'Български език', '27'),
(297, '18:40:00', 'Математика', '41'),
(298, '19:30:00', 'Математика', '41'),
(299, '00:00:00', '', ''),
(300, '00:00:00', '', ''),
(301, '00:00:00', '', ''),
(302, '14:30:00', 'Информационни технологии', '36'),
(303, '15:00:00', 'Информационни технологии', '36'),
(304, '00:00:00', '', ''),
(305, '00:00:00', '', ''),
(306, '00:00:00', '', ''),
(307, '00:00:00', '', ''),
(308, '00:00:00', '', ''),
(309, '00:00:00', '', ''),
(310, '00:00:00', '', ''),
(311, '00:00:00', '', ''),
(312, '14:30:00', 'Информационни технологии', '36'),
(313, '00:00:00', '', ''),
(314, '00:00:00', '', ''),
(315, '00:00:00', '', ''),
(316, '00:00:00', '', ''),
(317, '00:00:00', '', ''),
(318, '00:00:00', '', ''),
(319, '00:00:00', '', ''),
(320, '00:00:00', '', ''),
(321, '00:00:00', '', ''),
(322, '00:00:00', '', ''),
(323, '00:00:00', '', ''),
(324, '00:00:00', '', ''),
(325, '00:00:00', '', ''),
(326, '00:00:00', 'Български език', ''),
(327, '00:00:00', '', ''),
(328, '00:00:00', '', ''),
(329, '00:00:00', '', ''),
(330, '00:00:00', '', ''),
(331, '00:00:00', '', ''),
(332, '00:00:00', 'Информационни технологии', ''),
(333, '00:00:00', '', ''),
(334, '00:00:00', '', ''),
(335, '00:00:00', '', ''),
(336, '00:00:00', '', ''),
(337, '00:00:00', '', ''),
(338, '00:00:00', 'Математика', ''),
(339, '00:00:00', '', ''),
(340, '00:00:00', '', ''),
(341, '00:00:00', '', ''),
(342, '00:00:00', '', ''),
(343, '00:00:00', '', ''),
(344, '00:00:00', '', ''),
(345, '00:00:00', '', ''),
(346, '00:00:00', 'Български език', ''),
(347, '00:00:00', '', ''),
(348, '00:00:00', '', ''),
(349, '00:00:00', '', ''),
(350, '00:00:00', '', ''),
(351, '00:00:00', '', ''),
(352, '00:00:00', '', ''),
(353, '00:00:00', '', ''),
(354, '00:00:00', '', ''),
(355, '00:00:00', '', ''),
(356, '00:00:00', 'Български език', ''),
(357, '00:00:00', '', ''),
(358, '00:00:00', '', ''),
(359, '00:00:00', '', ''),
(360, '00:00:00', '', ''),
(361, '00:00:00', '', ''),
(362, '00:00:00', '', ''),
(363, '00:00:00', '', ''),
(364, '00:00:00', '', ''),
(365, '00:00:00', '', ''),
(366, '17:30:00', 'Български език', ''),
(367, '00:00:00', '', ''),
(368, '00:00:00', '', ''),
(369, '00:00:00', '', ''),
(370, '00:00:00', '', ''),
(371, '00:00:00', '', ''),
(372, '00:00:00', '', ''),
(373, '00:00:00', '', ''),
(374, '00:00:00', '', ''),
(375, '00:00:00', '', ''),
(376, '00:00:00', '', ''),
(377, '00:00:00', 'Математика', ''),
(378, '00:00:00', '', ''),
(379, '00:00:00', '', ''),
(380, '00:00:00', '', ''),
(381, '00:00:00', '', ''),
(382, '00:00:00', '', ''),
(383, '00:00:00', '', ''),
(384, '00:00:00', '', ''),
(385, '00:00:00', '', ''),
(386, '00:00:00', 'Български език', ''),
(387, '00:00:00', '', ''),
(388, '00:00:00', '', ''),
(389, '00:00:00', '', ''),
(390, '00:00:00', '', ''),
(391, '00:00:00', '', ''),
(392, '00:00:00', '', ''),
(393, '00:00:00', '', ''),
(394, '00:00:00', '', ''),
(395, '00:00:00', '', ''),
(396, '00:00:00', '', ''),
(397, '00:00:00', 'Математика', ''),
(398, '00:00:00', '', ''),
(399, '00:00:00', '', ''),
(400, '00:00:00', '', ''),
(401, '00:00:00', '', ''),
(402, '00:00:00', '', ''),
(403, '00:00:00', '', ''),
(404, '00:00:00', '', ''),
(405, '00:00:00', '', ''),
(406, '00:00:00', '', ''),
(407, '00:00:00', 'Математика', ''),
(408, '00:00:00', '', ''),
(409, '00:00:00', '', ''),
(410, '00:00:00', '', ''),
(411, '14:30:00', 'Компютърни архитектури', '36'),
(412, '15:10:00', 'Компютърни архитектури', '36'),
(413, '16:10:00', 'Български език и литература', '27'),
(414, '16:50:00', 'Български език и литература', '27'),
(415, '16:50:00', 'Български език и литература', '27'),
(416, '17:40:00', 'Операционни системи', '31'),
(417, '18:20:00', 'Операционни системи', '31'),
(418, '00:00:00', '', ''),
(419, '00:00:00', '', ''),
(420, '00:00:00', '', ''),
(421, '00:00:00', '1', ''),
(422, '00:00:00', '2', ''),
(423, '00:00:00', '3', ''),
(424, '00:00:00', '4', ''),
(425, '00:00:00', '4', ''),
(426, '00:00:00', '5', ''),
(427, '00:00:00', '6', ''),
(428, '00:00:00', '7', ''),
(429, '00:00:00', '8', ''),
(430, '00:00:00', '9', ''),
(431, '14:30:00', 'Компютърни архитектури', '36'),
(432, '15:10:00', 'Компютърни архитектури', '36'),
(433, '16:10:00', 'Български език и литература', '27'),
(434, '16:50:00', 'Български език и литература', '27'),
(435, '17:40:00', 'Операционни системи', '31'),
(436, '18:20:00', 'Операционни системи', '31'),
(437, '00:00:00', '', ''),
(438, '00:00:00', '', ''),
(439, '00:00:00', '', ''),
(440, '00:00:00', '', ''),
(441, '00:00:00', 'Компютърни архитектури', ''),
(442, '00:00:00', '', ''),
(443, '00:00:00', '', ''),
(444, '00:00:00', '', ''),
(445, '00:00:00', '', ''),
(446, '00:00:00', '', ''),
(447, '00:00:00', '', ''),
(448, '00:00:00', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `day`
--

INSERT INTO `day` (`UID`, `class1ID`, `class2ID`, `class3ID`, `class4ID`, `class5ID`, `class6ID`, `class7ID`, `class8ID`, `class9ID`) VALUES
(13, 201, 202, 203, 204, 205, 206, 207, 208, 209),
(19, 231, 232, 233, 234, 235, 236, 237, 238, 239),
(20, 241, 242, 243, 244, 245, 246, 247, 248, 249),
(21, 251, 252, 253, 254, 255, 256, 257, 258, 259),
(22, 261, 262, 263, 264, 265, 266, 267, 268, 269),
(23, 271, 272, 273, 274, 275, 276, 277, 278, 279),
(24, 281, 282, 283, 284, 285, 286, 287, 288, 289),
(25, 291, 292, 293, 294, 295, 296, 297, 298, 299),
(26, 301, 302, 303, 304, 305, 306, 307, 308, 309),
(27, 311, 312, 313, 314, 315, 316, 317, 318, 319),
(28, 321, 322, 323, 324, 325, 326, 327, 328, 329),
(29, 331, 332, 333, 334, 335, 336, 337, 338, 339),
(30, 341, 342, 343, 344, 345, 346, 347, 348, 349),
(31, 351, 352, 353, 354, 355, 356, 357, 358, 359),
(32, 361, 362, 363, 364, 365, 366, 367, 368, 369),
(33, 371, 372, 373, 374, 375, 376, 377, 378, 379),
(34, 381, 382, 383, 384, 385, 386, 387, 388, 389),
(35, 391, 392, 393, 394, 395, 396, 397, 398, 399),
(36, 401, 402, 403, 404, 405, 406, 407, 408, 409),
(37, 411, 412, 413, 414, 415, 416, 417, 418, 419),
(38, 421, 422, 423, 424, 425, 426, 427, 428, 429),
(39, 431, 432, 433, 434, 435, 436, 437, 438, 439),
(40, 440, 441, 442, 443, 444, 445, 446, 447, 448);

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

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
(40, '2015-07-07', 'Домашно - БЕЛ', 'Да прочетем Градушка на Яворов и да отговорим на следните въпроси.   1. На колко части е разделено стихотворението?  2. Кой и за какво говори в отделните части? 3. В коя част гласът на героя и лирическия говорител се сливат в едно? 4. Каква част от стихотворението е отделена за описание на градушката? 5. Какво чувство поражда стихотворението?', 2),
(41, '2015-07-02', 'СОКИ', 'Погледни следните сайтове: <a href = "http://mgames-youth.org/">http://mgames-youth.org/</a>, <a href = "http://computerspace.org/">http://computerspace.org/</a>, <a href = "http://invisibleserdica.org/index.php/bg/">http://invisibleserdica.org/index.php/bg/</a>, <a href = "http://qycguidance.org/index.php/en/">http://qycguidance.org/index.php/en/</a>, ', 3),
(42, '2015-07-01', 'Домашно', 'Да се представи служебната бележка (издадена от фирмата) и отчета (самоотчет, дневник - трябва да съдържа какво сме правили повреме на стажа, поне 2 страници - хронологично)', 4),
(43, '2015-07-02', 'Напомняне', 'Да си гледаш Hell girl 12 ep', 3),
(44, '2015-07-02', 'Домашно', 'Да се представи служебната бележка (издадена от фирмата) и отчета (самоотчет, дневник - трябва да съдържа какво сме правили повреме на стажа, поне 2 страници - хронологично)', 3);

-- --------------------------------------------------------

--
-- Структура на таблица `otherinfo`
--

CREATE TABLE IF NOT EXISTS `otherinfo` (
  `UID` int(10) unsigned NOT NULL,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `otherinfo`
--

INSERT INTO `otherinfo` (`UID`, `Title`, `Data`) VALUES
(15, 'Напомняне', 'Да си в Национален студентски дом в 14:30'),
(16, 'Напомняне', 'Да си гледаш работата идиот такъв!'),
(17, 'Напомняне', 'Да си в Национален студентски дом в 14:30'),
(18, 'Напомняне', 'Да си в Национален студентски дом в 14:30');

-- --------------------------------------------------------

--
-- Структура на таблица `twoweeks`
--

CREATE TABLE IF NOT EXISTS `twoweeks` (
  `UID` int(10) unsigned NOT NULL,
  `EvenWeekID` int(10) unsigned NOT NULL,
  `OddWeekID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `twoweeks`
--

INSERT INTO `twoweeks` (`UID`, `EvenWeekID`, `OddWeekID`) VALUES
(7, 9, 9),
(8, 9, 9),
(9, 12, 9),
(10, 13, 9),
(11, 14, 9),
(12, 15, 9),
(13, 15, 17),
(14, 15, 18),
(15, 15, 19),
(16, 9, 9),
(17, 9, 20),
(18, 21, 20),
(19, 21, 22),
(20, 21, 23),
(21, 21, 24),
(22, 21, 25),
(23, 21, 26),
(24, 21, 27),
(25, 28, 27),
(26, 9, 9),
(27, 9, 29),
(28, 9, 30),
(29, 9, 31),
(30, 9, 32);

-- --------------------------------------------------------

--
-- Структура на таблица `uh`
--

CREATE TABLE IF NOT EXISTS `uh` (
  `UID` int(10) unsigned NOT NULL,
  `HWID` int(10) unsigned NOT NULL,
  `USERID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uh`
--

INSERT INTO `uh` (`UID`, `HWID`, `USERID`) VALUES
(31, 41, 26),
(34, 44, 28);

-- --------------------------------------------------------

--
-- Структура на таблица `uoi`
--

CREATE TABLE IF NOT EXISTS `uoi` (
  `UID` int(10) unsigned NOT NULL,
  `OtherInfoID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(10) unsigned NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`UID`, `Name`) VALUES
(26, 'David'),
(27, 'Yoana'),
(28, '11b');

-- --------------------------------------------------------

--
-- Структура на таблица `uw`
--

CREATE TABLE IF NOT EXISTS `uw` (
  `UID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `TwoWeeksID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `uw`
--

INSERT INTO `uw` (`UID`, `UserID`, `TwoWeeksID`) VALUES
(7, 26, 8),
(8, 26, 8),
(9, 26, 9),
(10, 26, 10),
(11, 26, 11),
(12, 26, 12),
(13, 26, 12),
(14, 26, 13),
(15, 26, 14),
(16, 26, 15),
(17, 27, 16),
(18, 27, 17),
(19, 27, 18),
(20, 27, 19),
(21, 27, 20),
(22, 27, 21),
(23, 27, 22),
(24, 27, 23),
(25, 27, 24),
(26, 27, 25),
(27, 28, 26),
(28, 28, 27),
(29, 28, 28),
(30, 28, 29),
(31, 28, 30);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `weeks`
--

INSERT INTO `weeks` (`UID`, `MondayID`, `TuesdayID`, `WednesdayID`, `ThursdayID`, `FridayID`, `SaturdayID`, `SundayID`) VALUES
(9, 13, 13, 13, 13, 13, 13, 13),
(12, 20, 13, 13, 13, 13, 13, 13),
(13, 13, 21, 13, 13, 13, 13, 13),
(14, 22, 13, 13, 13, 13, 13, 13),
(15, 22, 23, 13, 13, 13, 13, 13),
(16, 24, 13, 13, 13, 13, 13, 13),
(17, 13, 25, 13, 13, 13, 13, 13),
(18, 26, 25, 13, 13, 13, 13, 13),
(19, 26, 27, 13, 13, 13, 13, 13),
(20, 28, 13, 13, 13, 13, 13, 13),
(21, 13, 13, 13, 13, 13, 29, 13),
(22, 28, 13, 13, 13, 13, 13, 30),
(23, 28, 31, 13, 13, 13, 13, 30),
(24, 28, 31, 32, 13, 13, 13, 30),
(25, 28, 31, 32, 33, 13, 13, 30),
(26, 28, 31, 32, 33, 34, 13, 30),
(27, 28, 31, 32, 33, 34, 35, 30),
(28, 13, 13, 13, 13, 13, 36, 13),
(29, 37, 13, 13, 13, 13, 13, 13),
(30, 38, 13, 13, 13, 13, 13, 13),
(31, 39, 13, 13, 13, 13, 13, 13),
(32, 39, 13, 13, 13, 13, 40, 13);

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
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=449;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `otherinfo`
--
ALTER TABLE `otherinfo`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `twoweeks`
--
ALTER TABLE `twoweeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `uh`
--
ALTER TABLE `uh`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `uoi`
--
ALTER TABLE `uoi`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `uw`
--
ALTER TABLE `uw`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
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
