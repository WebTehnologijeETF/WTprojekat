-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2015 at 04:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dekordb`
--
CREATE DATABASE IF NOT EXISTS `dekordb` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `dekordb`;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novostid` int(11) NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `datum` timestamp NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(60) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `novostid` (`novostid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `novostid`, `autor`, `datum`, `tekst`, `mail`) VALUES
(1, 1, 'Rocky', '2015-08-27 12:33:40', 'Vozdra rambooo', 'aduzan2@etf.unsa.ba'),
(2, 1, 'Emrah', '2015-08-27 12:33:40', 'Komentar na novost 1', 'aduzan2@etf.unsa.ba');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(60) COLLATE utf8_slovenian_ci NOT NULL,
  `tip` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `mail`, `tip`) VALUES
(1, 'emrah', '4468d7aab92f910f7b3ce92d57a86bc2', 'emrah@etf.unsa.ba', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `novost`
--

CREATE TABLE IF NOT EXISTS `novost` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL,
  `slika` varchar(250) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `novost`
--

INSERT INTO `novost` (`id`, `naslov`, `tekst`, `autor`, `vrijeme`, `slika`) VALUES
(1, 'Naslvo1 Naslvo1 Naslvo1 Naslvo1 ', 'Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 Novost 1 ', 'Emrah', '2015-08-27 12:31:51', 'Novosti/slike/dekoram.jpg'),
(2, 'Naslov2 Naslov2', 'Uredjenja novost 2\r\n', 'Rambo', '2015-08-27 12:33:00', 'Novosti/slike/dekoram.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`novostid`) REFERENCES `novost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
