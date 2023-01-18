-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 18 jan 2023 om 10:41
-- Serverversie: 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- PHP-versie: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DungeonsAndDates`
--
CREATE DATABASE IF NOT EXISTS `DungeonsAndDates` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `DungeonsAndDates`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userid` int(255) NOT NULL COMMENT 'id to identify the user',
  `username` varchar(64) NOT NULL COMMENT 'name of the user',
  `email` varchar(512) NOT NULL COMMENT 'email user will be contacted on',
  `password` varchar(255) NOT NULL COMMENT 'users password',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'when user was created',
  `type` tinyint(1) NOT NULL COMMENT '0=player,\r\n1=dungeon-master',
  `availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'json file with user availability'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `email`, `password`, `created_at`, `type`, `availability`) VALUES
(1, 'luke', 'luke.huisman@yahoo.nl', 'password1', '2023-01-11 11:47:42', 1, NULL),
(2, 'luka', 'lukaotte@gmail.com', 'password2', '2023-01-11 11:47:42', 0, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT COMMENT 'id to identify the user', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
