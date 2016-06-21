-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 06 Maj 2011, 16:05
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `baza8760`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `label` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET utf8 DEFAULT NULL,
  `exist` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=64 ;

--
-- Zrzut danych tabeli `cms`
--

INSERT INTO `cms` (`id`, `name`, `label`, `description`, `exist`, `active`) VALUES

(1, 'Strona gÅ‚Ã³wna', NULL, 'Firma budowlana lasota', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
