-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2018. Már 05. 15:00
-- Kiszolgáló verziója: 5.7.19
-- PHP verzió: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `voter`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `response`
--

DROP TABLE IF EXISTS `response`;
CREATE TABLE IF NOT EXISTS `response` (
  `response_id` int(5) NOT NULL AUTO_INCREMENT,
  `voting_id` int(5) NOT NULL,
  `resp` varchar(500) NOT NULL,
  PRIMARY KEY (`response_id`)
) ENGINE=MyISAM AUTO_INCREMENT=287 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `voter`
--

DROP TABLE IF EXISTS `voter`;
CREATE TABLE IF NOT EXISTS `voter` (
  `voter_id` int(5) NOT NULL AUTO_INCREMENT,
  `voting_id` int(5) NOT NULL,
  `response_id` int(5) NOT NULL,
  `voter_name` varchar(100) NOT NULL,
  `voting_date` datetime DEFAULT NULL,
  `voter_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`voter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `votings`
--

DROP TABLE IF EXISTS `votings`;
CREATE TABLE IF NOT EXISTS `votings` (
  `voting_id` int(5) NOT NULL AUTO_INCREMENT,
  `stat` int(2) NOT NULL DEFAULT '0',
  `title` varchar(500) NOT NULL,
  `descr` varchar(2000) DEFAULT NULL,
  `quest` varchar(1000) NOT NULL,
  `voting_start` date NOT NULL,
  `voting_stop` date NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`voting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
