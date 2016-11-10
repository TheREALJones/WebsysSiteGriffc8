-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2016 at 08:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websyslab8`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

--Q2 included

CREATE TABLE `courses` (
  `crn` int(11) NOT NULL,
  `prefix` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `number` smallint(4) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` tinyint(2) NOT NULL,
  `year` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`) VALUES
(11445, 'MATH', 2210, 'The Exact Class Where Math Stops Being About Numbers', 1, 2016),
(37845, 'ARTS', 4020, 'Underwater Basket Weaving', 1, 2016),
(60903, 'ITWS', 1440, 'Infomative Technologies and Technological Information', 1, 2016),
(60904, 'ITWS', 1440, 'Infomative Technologies and Technological Information', 2, 2016),
(70894, 'COMM', 6430, 'Intro to Talking to the Opposite Sex', 1, 2016),
(84832, 'CSCI', 1001, 'So What Even are "Computers" Anyway?', 1, 2016),
(84834, 'CSCI', 1002, 'Advanced Cognitive Computing', 1, 2016),
(84835, 'CSCI', 1002, 'Advanced Cognitive Computing', 2, 2016),
(84836, 'CSCI', 1002, 'Advanced Cognitive Computing', 3, 2016),
(89532, 'ARTS', 4300, 'Drawing Conclusions', 1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

--Q3
CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `rin` int(9) NOT NULL,
  `grade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
-- Q1 included:
CREATE TABLE `students` (
  `rin` int(9) NOT NULL,
  `rcsID` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `apt` smallint(5) DEFAULT NULL,
  `building number` int(9) NOT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`rin`, `rcsID`, `first name`, `last name`, `alias`, `phone`, `apt`, `building number`, `street`, `city`, `state`, `zip`) VALUES
(661320225, 'winner', 'Roberta', 'Winnepeg', '', NULL, NULL, 9001, 'Long St.', 'Longton', 'NY', 23894),
(661439821, 'pinchp', 'Penelope', 'Pincher', 'Penny', NULL, 5, 5, 'Spendthrift Rd.', 'Cheaptown', 'RI', 67432),
(661506377, 'nuthoi4', 'Ivanna', 'Nuthorgoadette', '', NULL, NULL, 6, 'Road Rd.', 'Rhodes', 'TX', 40508),
(661508322, 'nuffe', 'Edward', 'Nuff', 'E', NULL, 1, 15, 'Road Pl.', 'Townsville', '', 23890),
(661543399, 'elk', 'Clark', 'Kent', 'Superman', NULL, 3, 410, '8th St.', 'Metropolis', 'NY', 40392),
(661589998, 'mariom', 'Mario', 'Mario', '', NULL, NULL, 5, 'Mushroom Ln.', 'New York City', 'NY', 12120),
(661589999, 'mariol3', 'Luigi', 'Mario', 'Mr. L', NULL, NULL, 5, 'Mushroom Ln.', 'New York City', 'NY', 12120),
(661708080, 'malcoi', 'Ian', 'Malcolm', '', NULL, NULL, 780, 'Poodle Ln.', 'Southburg', 'CA', 80949),
(661786344, 'obamab', 'Barrack', 'Obama', 'Barry', NULL, NULL, 1600, 'Pennsylvania Ave.', 'Washington, D.C.', NULL, 20500),
(661789654, 'freeli2', 'Ivan Pierre', 'Freely', 'IP', NULL, NULL, 4, 'Whiz St', 'Citytopolis', 'ND', 12008);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crn`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`rin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--Q4

--Q5

--Q6
INSERT INTO `grades` (`id`, `crn`, `rin`, `grade`) VALUES
(1, 11445, 661320225, 100),
(2, 37845, 661320225, 99),
(3, 11445, 661439821, 60),
(4, 37845, 661506377, 79),
(5, 84835, 661589999, 80),
(6, 84836, 661506377, 90),
(7, 60903, 661439821, 5),
(8, 60903, 661789654, 65),
(9, 84834, 661789654, 80),
(10, 60904, 661543399, 96),
(11, 60904, 661708080, 84),
(12, 70894, 661708080, 55),
(13, 70894, 661508322, 0),
(14, 84836, 661508322, 100),
(15, 84834, 661508322, 87),
(16, 37845, 661543399, 67),
(17, 84836, 661508322, 78),
(18, 84832, 661506377, 89),
(19, 84836, 661708080, 91),
(20, 37845, 661543399, 60);
--Q7 p1
SELECT * FROM `students` ORDER BY `rin` ASC
--Q7 p2
SELECT * FROM `students` ORDER BY `rin` ASC
--Q7 p3
SELECT * FROM `students` ORDER BY `rin` ASC
--Q7 p4
SELECT * FROM `students` ORDER BY `rin` ASC
--Q8
SELECT `first name`, `last name` FROM `students`
WHERE `rin` IN (
SELECT `rin` FROM `grades`
WHERE `grade` > 90
UNION
SELECT `rin` FROM `students`
)
--Q9
SELECT AVG(`grade`) FROM `grades`
--Q10
SELECT Count(`rin`) FROM `students`