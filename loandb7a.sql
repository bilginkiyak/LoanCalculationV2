-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 at 10:33 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loandb7a`
--

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `interestID` int(11) NOT NULL AUTO_INCREMENT,
  `currencytype` varchar(4) NOT NULL DEFAULT '',
  `interest` float(6,3) NOT NULL DEFAULT '0.000',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
UNIQUE INDEX curendt (currencytype,dt),
 PRIMARY KEY (`interestID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`interestID`, `currencytype`, `interest`, `dt`) VALUES
(1, 'USD', 2.000, '2016-03-16 06:00:00'),
(2, 'EURO', 1.500, '2016-03-23 06:00:00'),
(3, 'LEVS', 1.800, '2016-03-30 06:00:00'),
(4, 'USD', 2.000, '2016-04-07 06:00:00'),
(5, 'USD', 2.000, '2016-04-14 06:00:00'),
(6, 'USD', 2.000, '2016-04-21 06:00:00');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
