-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.15
-- Generation Time: Jul 28, 2018 at 04:49 AM
-- Server version: 5.5.51
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `GolfBooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `BookingLock`
--

CREATE TABLE `BookingLock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BookingDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `BookingLock`
--

INSERT INTO `BookingLock` VALUES(9, '2018-05-23');
INSERT INTO `BookingLock` VALUES(7, '2018-05-19');
INSERT INTO `BookingLock` VALUES(8, '2018-05-23');
INSERT INTO `BookingLock` VALUES(10, '2018-05-26');
INSERT INTO `BookingLock` VALUES(11, '2018-05-26');
INSERT INTO `BookingLock` VALUES(12, '2018-06-02');
INSERT INTO `BookingLock` VALUES(13, '2018-06-13');
INSERT INTO `BookingLock` VALUES(14, '2018-06-09');
INSERT INTO `BookingLock` VALUES(15, '2018-06-16');
INSERT INTO `BookingLock` VALUES(16, '2018-06-16');
INSERT INTO `BookingLock` VALUES(17, '2018-06-23');
INSERT INTO `BookingLock` VALUES(18, '2018-06-27');
INSERT INTO `BookingLock` VALUES(19, '2018-06-30');
INSERT INTO `BookingLock` VALUES(20, '2018-07-04');
INSERT INTO `BookingLock` VALUES(21, '2018-07-07');
INSERT INTO `BookingLock` VALUES(22, '2018-07-07');
INSERT INTO `BookingLock` VALUES(23, '2018-07-07');
INSERT INTO `BookingLock` VALUES(24, '2018-07-07');
INSERT INTO `BookingLock` VALUES(25, '2018-07-07');
INSERT INTO `BookingLock` VALUES(26, '2018-07-07');
INSERT INTO `BookingLock` VALUES(27, '2018-07-07');
INSERT INTO `BookingLock` VALUES(28, '2018-07-07');
INSERT INTO `BookingLock` VALUES(29, '2018-07-07');
INSERT INTO `BookingLock` VALUES(30, '2018-07-07');
INSERT INTO `BookingLock` VALUES(31, '2018-07-07');
INSERT INTO `BookingLock` VALUES(32, '2018-07-07');
INSERT INTO `BookingLock` VALUES(33, '2018-07-07');
INSERT INTO `BookingLock` VALUES(34, '2018-07-07');
INSERT INTO `BookingLock` VALUES(35, '2018-07-07');
INSERT INTO `BookingLock` VALUES(36, '2018-07-07');
INSERT INTO `BookingLock` VALUES(37, '2018-07-07');
INSERT INTO `BookingLock` VALUES(38, '2018-07-07');
INSERT INTO `BookingLock` VALUES(39, '2018-07-07');
INSERT INTO `BookingLock` VALUES(40, '2018-07-07');
INSERT INTO `BookingLock` VALUES(41, '2018-07-07');
INSERT INTO `BookingLock` VALUES(42, '2018-07-07');
INSERT INTO `BookingLock` VALUES(43, '2018-07-07');
INSERT INTO `BookingLock` VALUES(44, '2018-07-11');
INSERT INTO `BookingLock` VALUES(46, '2018-07-14');
INSERT INTO `BookingLock` VALUES(47, '2018-07-18');
INSERT INTO `BookingLock` VALUES(48, '2018-07-21');
INSERT INTO `BookingLock` VALUES(49, '2018-07-25');
INSERT INTO `BookingLock` VALUES(50, '2018-07-28');
INSERT INTO `BookingLock` VALUES(51, '2018-08-01');
INSERT INTO `BookingLock` VALUES(52, '2018-08-04');
INSERT INTO `BookingLock` VALUES(53, '2018-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `BookingDate` date NOT NULL,
  `GroupNo` tinyint(4) NOT NULL,
  `PlayerID1` int(5) DEFAULT NULL,
  `PlayerID2` int(5) DEFAULT NULL,
  `PlayerID3` int(5) DEFAULT NULL,
  `PlayerID4` int(5) DEFAULT NULL,
  `Spare` varchar(50) NOT NULL,
  PRIMARY KEY (`BookingDate`,`GroupNo`),
  KEY `Player1` (`PlayerID1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Booking Groups';

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` VALUES('2018-05-30', 1, 18, 5, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-23', 2, 12, 17, 0, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-26', 4, 8, 27, 25, 18, '');
INSERT INTO `Bookings` VALUES('2018-05-26', 3, 16, 5, 21, 17, '');
INSERT INTO `Bookings` VALUES('2018-05-26', 2, 24, 12, 28, 11, '');
INSERT INTO `Bookings` VALUES('2018-05-30', 2, 17, 10, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 6, 21, 9, 10, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 5, 20, 26, 11, 27, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 4, 19, 4, 12, 5, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 3, 18, 6, 13, 14, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 1, 2, 28, 15, 7, '');
INSERT INTO `Bookings` VALUES('2018-05-19', 2, 17, 24, 16, 25, '');
INSERT INTO `Bookings` VALUES('2018-06-16', 3, 18, 28, 21, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-26', 5, 14, 10, 20, 26, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 6, 6, 24, 9, 19, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 5, 21, 18, 7, 13, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 4, 3, 10, 2, 26, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 3, 28, 4, 8, 15, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 2, 27, 11, 14, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 1, 20, 5, 17, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 6, 25, 15, 14, 7, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 5, 11, 12, 17, 24, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 4, 10, 18, 27, 13, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 3, 2, 3, 28, 19, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 2, 8, 4, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 1, 23, 16, 21, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 6, 5, 15, 8, 25, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 5, 4, 10, 2, 12, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 4, 9, 23, 17, 13, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 3, 24, 11, 18, 26, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 2, 28, 14, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 1, 27, 7, 19, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 6, 19, 4, 5, 24, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 5, 17, 14, 12, 11, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 4, 7, 6, 26, 10, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 3, 25, 28, 8, 9, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 2, 16, 18, 3, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 1, 21, 27, 20, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 6, 12, 4, 11, 7, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 5, 3, 28, 17, 27, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 4, 6, 10, 23, 16, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 3, 26, 20, 2, 15, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 2, 13, 9, 19, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 1, 14, 25, 8, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-26', 1, 15, 9, 6, 13, '');
INSERT INTO `Bookings` VALUES('2018-06-09', 1, 6, 10, 21, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-09', 2, 12, 20, 5, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-09', 3, 8, 18, 16, 27, '');
INSERT INTO `Bookings` VALUES('2018-06-09', 4, 17, 13, 26, 25, '');
INSERT INTO `Bookings` VALUES('2018-06-16', 1, 13, 2, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-06', 2, 5, 12, 18, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-06', 1, 6, 10, 17, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-13', 1, 17, 5, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-13', 2, 12, 10, 0, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-23', 1, 5, 18, 10, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-02', 1, 10, 6, 16, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-02', 2, 5, 20, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-02', 3, 9, 27, 24, 8, '');
INSERT INTO `Bookings` VALUES('2018-06-02', 4, 13, 15, 28, 18, '');
INSERT INTO `Bookings` VALUES('2018-06-02', 5, 26, 25, 17, 14, '');
INSERT INTO `Bookings` VALUES('2018-06-16', 2, 5, 20, 9, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-11', 1, 17, 2, 18, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-11', 2, 6, 3, 5, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-11', 3, 23, 10, 12, 7, '');
INSERT INTO `Bookings` VALUES('2018-04-18', 1, 5, 17, 7, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-18', 2, 10, 6, 3, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-18', 3, 2, 12, 18, 23, '');
INSERT INTO `Bookings` VALUES('2018-04-25', 1, 7, 17, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-25', 2, 18, 12, 5, 0, '');
INSERT INTO `Bookings` VALUES('2018-04-25', 3, 3, 10, 23, 2, '');
INSERT INTO `Bookings` VALUES('2018-05-02', 1, 12, 2, 23, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-02', 2, 17, 6, 7, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-02', 3, 10, 3, 5, 18, '');
INSERT INTO `Bookings` VALUES('2018-05-09', 1, 6, 23, 10, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-09', 2, 7, 18, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-05-09', 3, 3, 5, 2, 17, '');
INSERT INTO `Bookings` VALUES('2018-05-16', 1, 2, 10, 12, 3, '');
INSERT INTO `Bookings` VALUES('2018-05-16', 2, 18, 6, 5, 17, '');
INSERT INTO `Bookings` VALUES('2018-04-14', 7, 18, 21, 5, 24, '');
INSERT INTO `Bookings` VALUES('2018-04-21', 7, 15, 2, 23, 13, '');
INSERT INTO `Bookings` VALUES('2018-04-28', 7, 20, 16, 21, 3, '');
INSERT INTO `Bookings` VALUES('2018-05-05', 7, 26, 20, 9, 5, '');
INSERT INTO `Bookings` VALUES('2018-05-12', 7, 12, 23, 25, 16, '');
INSERT INTO `Bookings` VALUES('2018-07-07', 2, 9, 23, 5, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-07', 1, 15, 17, 6, 21, '');
INSERT INTO `Bookings` VALUES('2018-06-30', 5, 21, 28, 15, 10, '');
INSERT INTO `Bookings` VALUES('2018-06-30', 4, 5, 18, 25, 26, '');
INSERT INTO `Bookings` VALUES('2018-06-30', 3, 27, 20, 9, 8, '');
INSERT INTO `Bookings` VALUES('2018-06-30', 2, 16, 13, 3, 24, '');
INSERT INTO `Bookings` VALUES('2018-06-30', 1, 4, 2, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-20', 1, 3, 5, 2, 6, '');
INSERT INTO `Bookings` VALUES('2018-06-20', 2, 10, 12, 17, 18, '');
INSERT INTO `Bookings` VALUES('2018-06-16', 4, 10, 7, 24, 8, '');
INSERT INTO `Bookings` VALUES('2018-06-16', 5, 26, 16, 6, 14, '');
INSERT INTO `Bookings` VALUES('2018-06-23', 4, 2, 10, 3, 16, '');
INSERT INTO `Bookings` VALUES('2018-06-23', 3, 14, 5, 18, 8, '');
INSERT INTO `Bookings` VALUES('2018-06-23', 2, 24, 17, 13, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-23', 1, 28, 27, 26, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-23', 5, 25, 4, 21, 6, '');
INSERT INTO `Bookings` VALUES('2018-06-27', 1, 18, 17, 2, 0, '');
INSERT INTO `Bookings` VALUES('2018-06-27', 2, 12, 3, 10, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-07', 3, 24, 2, 27, 16, '');
INSERT INTO `Bookings` VALUES('2018-07-07', 4, 12, 28, 7, 13, '');
INSERT INTO `Bookings` VALUES('2018-07-07', 5, 20, 26, 4, 25, '');
INSERT INTO `Bookings` VALUES('2018-07-04', 1, 2, 5, 7, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-04', 2, 3, 12, 17, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-14', 3, 2, 12, 14, 21, '');
INSERT INTO `Bookings` VALUES('2018-07-14', 2, 28, 6, 20, 13, '');
INSERT INTO `Bookings` VALUES('2018-07-14', 1, 4, 17, 24, 16, '');
INSERT INTO `Bookings` VALUES('2018-07-11', 1, 5, 2, 6, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-11', 2, 12, 17, 0, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-18', 1, 2, 5, 12, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-14', 4, 25, 5, 15, 26, '');
INSERT INTO `Bookings` VALUES('2018-07-18', 2, 17, 3, 0, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-21', 1, 14, 17, 3, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-21', 2, 16, 20, 12, 21, '');
INSERT INTO `Bookings` VALUES('2018-07-21', 3, 13, 9, 6, 2, '');
INSERT INTO `Bookings` VALUES('2018-07-21', 4, 15, 10, 5, 4, '');
INSERT INTO `Bookings` VALUES('2018-07-25', 1, 3, 6, 2, 17, '');
INSERT INTO `Bookings` VALUES('2018-07-25', 2, 5, 12, 10, 18, '');
INSERT INTO `Bookings` VALUES('2018-07-28', 1, 3, 21, 14, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-28', 2, 17, 24, 4, 0, '');
INSERT INTO `Bookings` VALUES('2018-07-28', 3, 10, 12, 15, 5, '');
INSERT INTO `Bookings` VALUES('2018-07-28', 4, 6, 27, 18, 20, '');
INSERT INTO `Bookings` VALUES('2018-07-28', 5, 9, 16, 13, 2, '');
INSERT INTO `Bookings` VALUES('2018-08-01', 1, 10, 5, 18, 0, '');
INSERT INTO `Bookings` VALUES('2018-08-01', 2, 2, 12, 3, 0, '');
INSERT INTO `Bookings` VALUES('2018-08-04', 1, 18, 10, 9, 6, '');
INSERT INTO `Bookings` VALUES('2018-08-04', 2, 27, 12, 20, 3, '');
INSERT INTO `Bookings` VALUES('2018-08-04', 3, 4, 2, 16, 25, '');
INSERT INTO `Bookings` VALUES('2018-08-04', 4, 5, 26, 21, 24, '');
INSERT INTO `Bookings` VALUES('2018-08-04', 5, 13, 15, 14, 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `PlayerNotAvailable`
--

CREATE TABLE `PlayerNotAvailable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(5) NOT NULL,
  `BookingDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=401 ;

--
-- Dumping data for table `PlayerNotAvailable`
--

INSERT INTO `PlayerNotAvailable` VALUES(15, 3, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(42, 3, '2018-05-23');
INSERT INTO `PlayerNotAvailable` VALUES(68, 7, '2018-07-11');
INSERT INTO `PlayerNotAvailable` VALUES(85, 2, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(88, 2, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(39, 4, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(16, 3, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(17, 2, '2018-05-23');
INSERT INTO `PlayerNotAvailable` VALUES(18, 2, '2018-05-30');
INSERT INTO `PlayerNotAvailable` VALUES(19, 2, '2018-06-06');
INSERT INTO `PlayerNotAvailable` VALUES(20, 2, '2018-06-13');
INSERT INTO `PlayerNotAvailable` VALUES(21, 7, '2018-05-16');
INSERT INTO `PlayerNotAvailable` VALUES(22, 7, '2018-05-23');
INSERT INTO `PlayerNotAvailable` VALUES(23, 7, '2018-05-30');
INSERT INTO `PlayerNotAvailable` VALUES(24, 7, '2018-06-06');
INSERT INTO `PlayerNotAvailable` VALUES(25, 7, '2018-06-13');
INSERT INTO `PlayerNotAvailable` VALUES(26, 7, '2018-06-20');
INSERT INTO `PlayerNotAvailable` VALUES(109, 23, '2018-05-16');
INSERT INTO `PlayerNotAvailable` VALUES(110, 23, '2018-05-23');
INSERT INTO `PlayerNotAvailable` VALUES(111, 23, '2018-05-30');
INSERT INTO `PlayerNotAvailable` VALUES(30, 23, '2018-06-06');
INSERT INTO `PlayerNotAvailable` VALUES(31, 23, '2018-06-13');
INSERT INTO `PlayerNotAvailable` VALUES(32, 23, '2018-06-20');
INSERT INTO `PlayerNotAvailable` VALUES(33, 23, '2018-06-27');
INSERT INTO `PlayerNotAvailable` VALUES(34, 23, '2018-07-04');
INSERT INTO `PlayerNotAvailable` VALUES(35, 23, '2018-07-11');
INSERT INTO `PlayerNotAvailable` VALUES(132, 2, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(38, 3, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(156, 4, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(47, 4, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(43, 3, '2018-05-30');
INSERT INTO `PlayerNotAvailable` VALUES(44, 3, '2018-06-06');
INSERT INTO `PlayerNotAvailable` VALUES(69, 7, '2018-07-18');
INSERT INTO `PlayerNotAvailable` VALUES(50, 7, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(51, 7, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(52, 7, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(53, 7, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(56, 6, '2018-05-23');
INSERT INTO `PlayerNotAvailable` VALUES(57, 23, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(58, 23, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(59, 23, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(60, 23, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(61, 23, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(62, 23, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(163, 6, '2018-07-04');
INSERT INTO `PlayerNotAvailable` VALUES(71, 7, '2018-07-25');
INSERT INTO `PlayerNotAvailable` VALUES(72, 7, '2018-08-01');
INSERT INTO `PlayerNotAvailable` VALUES(93, 2, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(95, 10, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(136, 17, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(190, 17, '2018-06-13');
INSERT INTO `PlayerNotAvailable` VALUES(102, 7, '2018-06-27');
INSERT INTO `PlayerNotAvailable` VALUES(280, 5, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(112, 18, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(115, 19, '2018-05-19');
INSERT INTO `PlayerNotAvailable` VALUES(116, 19, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(117, 19, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(118, 19, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(119, 19, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(120, 19, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(121, 19, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(122, 19, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(123, 19, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(124, 19, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(125, 19, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(126, 19, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(128, 11, '2018-05-26');
INSERT INTO `PlayerNotAvailable` VALUES(129, 21, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(133, 11, '2018-06-02');
INSERT INTO `PlayerNotAvailable` VALUES(246, 17, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(138, 17, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(142, 28, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(143, 8, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(144, 8, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(145, 8, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(146, 8, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(147, 8, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(148, 8, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(152, 6, '2018-06-13');
INSERT INTO `PlayerNotAvailable` VALUES(154, 6, '2018-06-20');
INSERT INTO `PlayerNotAvailable` VALUES(157, 10, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(253, 5, '2018-06-27');
INSERT INTO `PlayerNotAvailable` VALUES(189, 11, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(166, 11, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(254, 27, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(168, 11, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(169, 11, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(170, 11, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(171, 11, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(172, 11, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(173, 11, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(174, 11, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(176, 8, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(177, 10, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(178, 6, '2018-07-18');
INSERT INTO `PlayerNotAvailable` VALUES(180, 6, '2018-08-01');
INSERT INTO `PlayerNotAvailable` VALUES(181, 6, '2018-08-15');
INSERT INTO `PlayerNotAvailable` VALUES(239, 7, '2018-08-22');
INSERT INTO `PlayerNotAvailable` VALUES(183, 4, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(184, 4, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(185, 9, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(186, 15, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(187, 14, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(188, 24, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(248, 2, '2018-06-20');
INSERT INTO `PlayerNotAvailable` VALUES(193, 12, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(194, 14, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(197, 16, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(198, 18, '2018-07-04');
INSERT INTO `PlayerNotAvailable` VALUES(199, 18, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(200, 18, '2018-07-11');
INSERT INTO `PlayerNotAvailable` VALUES(201, 18, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(202, 18, '2018-07-18');
INSERT INTO `PlayerNotAvailable` VALUES(203, 18, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(204, 18, '2018-09-05');
INSERT INTO `PlayerNotAvailable` VALUES(205, 18, '2018-09-08');
INSERT INTO `PlayerNotAvailable` VALUES(206, 18, '2018-09-12');
INSERT INTO `PlayerNotAvailable` VALUES(207, 18, '2018-09-15');
INSERT INTO `PlayerNotAvailable` VALUES(208, 18, '2018-09-19');
INSERT INTO `PlayerNotAvailable` VALUES(209, 18, '2018-09-22');
INSERT INTO `PlayerNotAvailable` VALUES(210, 18, '2018-09-26');
INSERT INTO `PlayerNotAvailable` VALUES(211, 18, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(212, 18, '2018-10-03');
INSERT INTO `PlayerNotAvailable` VALUES(213, 18, '2018-10-06');
INSERT INTO `PlayerNotAvailable` VALUES(214, 18, '2018-10-10');
INSERT INTO `PlayerNotAvailable` VALUES(215, 18, '2018-10-13');
INSERT INTO `PlayerNotAvailable` VALUES(216, 18, '2018-10-17');
INSERT INTO `PlayerNotAvailable` VALUES(217, 9, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(329, 24, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(315, 23, '2018-08-08');
INSERT INTO `PlayerNotAvailable` VALUES(221, 7, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(233, 27, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(240, 10, '2018-07-04');
INSERT INTO `PlayerNotAvailable` VALUES(224, 14, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(225, 14, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(226, 26, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(227, 26, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(249, 25, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(250, 25, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(231, 24, '2018-10-20');
INSERT INTO `PlayerNotAvailable` VALUES(235, 15, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(236, 15, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(237, 6, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(238, 6, '2018-06-27');
INSERT INTO `PlayerNotAvailable` VALUES(241, 10, '2018-07-11');
INSERT INTO `PlayerNotAvailable` VALUES(242, 10, '2018-07-18');
INSERT INTO `PlayerNotAvailable` VALUES(244, 20, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(251, 9, '2018-06-16');
INSERT INTO `PlayerNotAvailable` VALUES(247, 17, '2018-06-06');
INSERT INTO `PlayerNotAvailable` VALUES(252, 9, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(255, 27, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(256, 26, '2018-06-09');
INSERT INTO `PlayerNotAvailable` VALUES(261, 3, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(258, 11, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(259, 7, '2018-06-23');
INSERT INTO `PlayerNotAvailable` VALUES(262, 3, '2018-07-11');
INSERT INTO `PlayerNotAvailable` VALUES(330, 24, '2018-12-29');
INSERT INTO `PlayerNotAvailable` VALUES(264, 3, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(265, 3, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(266, 15, '2018-09-15');
INSERT INTO `PlayerNotAvailable` VALUES(267, 15, '2018-09-22');
INSERT INTO `PlayerNotAvailable` VALUES(268, 15, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(269, 15, '2018-10-06');
INSERT INTO `PlayerNotAvailable` VALUES(270, 15, '2018-10-13');
INSERT INTO `PlayerNotAvailable` VALUES(271, 11, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(272, 11, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(273, 11, '2018-09-01');
INSERT INTO `PlayerNotAvailable` VALUES(274, 11, '2018-09-08');
INSERT INTO `PlayerNotAvailable` VALUES(279, 7, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(285, 7, '2018-07-04');
INSERT INTO `PlayerNotAvailable` VALUES(277, 23, '2018-06-30');
INSERT INTO `PlayerNotAvailable` VALUES(331, 3, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(281, 5, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(319, 5, '2018-08-08');
INSERT INTO `PlayerNotAvailable` VALUES(324, 5, '2018-09-01');
INSERT INTO `PlayerNotAvailable` VALUES(284, 5, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(286, 7, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(287, 7, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(288, 7, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(289, 7, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(290, 7, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(291, 7, '2018-08-08');
INSERT INTO `PlayerNotAvailable` VALUES(292, 7, '2018-08-15');
INSERT INTO `PlayerNotAvailable` VALUES(293, 7, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(294, 7, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(295, 7, '2018-08-29');
INSERT INTO `PlayerNotAvailable` VALUES(296, 7, '2018-09-01');
INSERT INTO `PlayerNotAvailable` VALUES(297, 7, '2018-09-05');
INSERT INTO `PlayerNotAvailable` VALUES(298, 7, '2018-09-08');
INSERT INTO `PlayerNotAvailable` VALUES(299, 7, '2018-09-12');
INSERT INTO `PlayerNotAvailable` VALUES(300, 7, '2018-09-15');
INSERT INTO `PlayerNotAvailable` VALUES(301, 7, '2018-09-19');
INSERT INTO `PlayerNotAvailable` VALUES(302, 7, '2018-09-22');
INSERT INTO `PlayerNotAvailable` VALUES(303, 7, '2018-09-26');
INSERT INTO `PlayerNotAvailable` VALUES(304, 7, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(305, 7, '2018-10-03');
INSERT INTO `PlayerNotAvailable` VALUES(306, 23, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(307, 23, '2018-07-18');
INSERT INTO `PlayerNotAvailable` VALUES(308, 23, '2018-07-25');
INSERT INTO `PlayerNotAvailable` VALUES(309, 23, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(310, 23, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(312, 9, '2018-11-03');
INSERT INTO `PlayerNotAvailable` VALUES(313, 23, '2018-08-01');
INSERT INTO `PlayerNotAvailable` VALUES(314, 23, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(316, 23, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(397, 5, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(320, 5, '2018-08-15');
INSERT INTO `PlayerNotAvailable` VALUES(321, 5, '2018-08-22');
INSERT INTO `PlayerNotAvailable` VALUES(323, 5, '2018-08-29');
INSERT INTO `PlayerNotAvailable` VALUES(327, 9, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(328, 9, '2018-07-07');
INSERT INTO `PlayerNotAvailable` VALUES(332, 3, '2018-10-03');
INSERT INTO `PlayerNotAvailable` VALUES(383, 12, '2018-08-08');
INSERT INTO `PlayerNotAvailable` VALUES(382, 21, '2018-10-13');
INSERT INTO `PlayerNotAvailable` VALUES(381, 21, '2018-10-06');
INSERT INTO `PlayerNotAvailable` VALUES(380, 21, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(400, 21, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(378, 9, '2019-01-05');
INSERT INTO `PlayerNotAvailable` VALUES(377, 9, '2018-12-29');
INSERT INTO `PlayerNotAvailable` VALUES(374, 28, '2018-10-20');
INSERT INTO `PlayerNotAvailable` VALUES(376, 9, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(375, 28, '2018-10-27');
INSERT INTO `PlayerNotAvailable` VALUES(373, 28, '2018-10-13');
INSERT INTO `PlayerNotAvailable` VALUES(372, 28, '2018-10-06');
INSERT INTO `PlayerNotAvailable` VALUES(371, 28, '2018-09-29');
INSERT INTO `PlayerNotAvailable` VALUES(370, 28, '2018-09-22');
INSERT INTO `PlayerNotAvailable` VALUES(369, 28, '2018-09-15');
INSERT INTO `PlayerNotAvailable` VALUES(368, 28, '2018-09-08');
INSERT INTO `PlayerNotAvailable` VALUES(367, 28, '2018-09-01');
INSERT INTO `PlayerNotAvailable` VALUES(366, 28, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(365, 28, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(364, 28, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(363, 28, '2018-08-04');
INSERT INTO `PlayerNotAvailable` VALUES(362, 28, '2018-07-28');
INSERT INTO `PlayerNotAvailable` VALUES(359, 28, '2018-12-15');
INSERT INTO `PlayerNotAvailable` VALUES(384, 12, '2018-08-11');
INSERT INTO `PlayerNotAvailable` VALUES(361, 28, '2018-07-21');
INSERT INTO `PlayerNotAvailable` VALUES(360, 28, '2018-07-14');
INSERT INTO `PlayerNotAvailable` VALUES(385, 12, '2018-08-15');
INSERT INTO `PlayerNotAvailable` VALUES(386, 12, '2018-08-18');
INSERT INTO `PlayerNotAvailable` VALUES(387, 12, '2018-08-22');
INSERT INTO `PlayerNotAvailable` VALUES(388, 6, '2018-08-29');
INSERT INTO `PlayerNotAvailable` VALUES(389, 6, '2018-09-12');
INSERT INTO `PlayerNotAvailable` VALUES(390, 6, '2018-09-26');
INSERT INTO `PlayerNotAvailable` VALUES(391, 17, '2018-08-01');
INSERT INTO `PlayerNotAvailable` VALUES(394, 10, '2018-08-15');
INSERT INTO `PlayerNotAvailable` VALUES(395, 10, '2018-08-25');
INSERT INTO `PlayerNotAvailable` VALUES(396, 10, '2018-09-19');
INSERT INTO `PlayerNotAvailable` VALUES(398, 2, '2018-12-01');
INSERT INTO `PlayerNotAvailable` VALUES(399, 2, '2018-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `MemberNo` int(5) NOT NULL,
  `Given` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Saturday` int(11) DEFAULT '1',
  `username` varchar(50) DEFAULT NULL,
  `Wednesday` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `Players`
--

INSERT INTO `Players` VALUES(2, 1411, 'Brian', 'Ackland', 'Brian Ackland', 'brian.ackland@me.com', 1, 'BAC', 1);
INSERT INTO `Players` VALUES(3, 9516, 'Robert', 'Ackland', 'Bob Ackland', 'bob1_ackland@hotmail.com', 1, 'RAC', 1);
INSERT INTO `Players` VALUES(4, 35, 'Roger', 'Ballantine', 'Roger Ballantine', 'roger@mastaustralia.com.au', 1, 'RBA', 0);
INSERT INTO `Players` VALUES(5, 71, 'Edmund', 'Bienias', 'Eddie (the Spot) Bienias', 'eddyandrobyn@bigpond.com', 1, 'EBI', 1);
INSERT INTO `Players` VALUES(6, 9469, 'Darryl', 'Bretherton', 'Darryl Bretherton', 'dbreth@hotmail.com', 1, 'DBR', 1);
INSERT INTO `Players` VALUES(7, 161, 'Michael', 'Corcoran', 'Michael Corcoran', 'michael.jan@bigpond.com', 1, 'MCO', 1);
INSERT INTO `Players` VALUES(8, 186, 'Tim', 'Daly', 'Tim Daly', 'timdaly44@bigpond.com', 1, 'TDA', 0);
INSERT INTO `Players` VALUES(9, 297, 'John', 'Fyffe', 'John Fyffe', 'jfyffe@bigpond.net.au', 1, 'JFY', 0);
INSERT INTO `Players` VALUES(10, 312, 'Steve', 'Gilbee', 'Steve Gilbee', 'steve.gilbee@gmail.com', 1, 'SGI', 1);
INSERT INTO `Players` VALUES(11, 2714, 'Brad', 'Jamieson', 'Brad Jamieson', 'bradja@harrythehirer.com.au', 1, 'BJA', 0);
INSERT INTO `Players` VALUES(12, 506, 'Kevin', 'Krahe', 'Kevin  (OldCodger) Krahe', 'kkrahe57@gmail.com', 1, 'KKR', 1);
INSERT INTO `Players` VALUES(13, 2172, 'Italo', 'Marcantonio', 'Italo Marcantonio', 'melnitalo@iprimus.com.au', 1, 'IMA', 0);
INSERT INTO `Players` VALUES(14, 9458, 'Terry', 'McGann', 'Terry McGann', 'teemacgee@gmail.com', 1, 'TMC', 0);
INSERT INTO `Players` VALUES(15, 2374, 'Robert', 'Meates', 'Robert Meates', 'robbiem4@bigpond.com', 1, 'RME', 0);
INSERT INTO `Players` VALUES(16, 1685, 'Ken', 'Milne', 'Ken Milne', 'ken-maz@bigpond.net.au', 1, 'KMI', 0);
INSERT INTO `Players` VALUES(17, 2421, 'Ian', 'Nicolle', 'Ian Nicolle', 'inicolle@icloud.com', 1, 'INI', 1);
INSERT INTO `Players` VALUES(18, 686, 'Kevin', 'OHehir', 'Kevin OHehir', 'kohr@iprimus.com.au', 1, 'KOH', 1);
INSERT INTO `Players` VALUES(19, 707, 'Dave', 'Pearson', 'Dave Pearson', 'lynne.pearson@hotmail.com', 1, 'DPE', 0);
INSERT INTO `Players` VALUES(20, 1657, 'Stephen', 'Peasnell', 'Steve Peasnell', 'sspeasnell@optusnet.com.au', 1, 'SPE', 0);
INSERT INTO `Players` VALUES(21, 747, 'David', 'Raymond', 'David (Bloke) Raymond', 'draymo8351@hotmail.com', 1, 'DRA', 0);
INSERT INTO `Players` VALUES(23, 2266, 'Kevin', 'Storan', 'Kevin Storan', 'kstoran@bigpond.net.au', 1, 'KST', 1);
INSERT INTO `Players` VALUES(24, 9496, 'Dean', 'Stuart', 'Dean Stuart', 'dean@needtools.com.au', 1, 'DST', 0);
INSERT INTO `Players` VALUES(25, 1475, 'Don', 'Todorov', 'Don Todorov', 'dontodorov@live.com.au', 1, 'DTO', 0);
INSERT INTO `Players` VALUES(26, 2156, 'Neil', 'Walker', 'Neil Walker (The Phantom)', 'neilwalker15@telstra.com', 1, 'NWA', 0);
INSERT INTO `Players` VALUES(27, 973, 'Brett', 'Williams', 'Brett Williams', 'brett.williams@live.com.au', 1, 'BWI', 0);
INSERT INTO `Players` VALUES(28, 2131, 'Trevor', 'Williams', 'Trevor Williams', 'trevor@tjshaircompany.com.au', 1, 'TWI', 0);
INSERT INTO `Players` VALUES(29, 1158, 'Alex', 'Constantinos', 'Alex Constantinos', 'alex_constantinos@hotmail.com', 0, 'ACO', 0);
