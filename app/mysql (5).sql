-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 22 jan 2023 om 22:58
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
-- Database: `developmentdb`
--
CREATE DATABASE IF NOT EXISTS `developmentdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `developmentdb`;
--
-- Database: `DungeonsAndDates`
--
CREATE DATABASE IF NOT EXISTS `DungeonsAndDates` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `DungeonsAndDates`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Campaign`
--

CREATE TABLE `Campaign` (
  `Campaign_ID` int(255) NOT NULL,
  `Session_ID` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `Campaign`
--

INSERT INTO `Campaign` (`Campaign_ID`, `Session_ID`, `name`) VALUES
(1, NULL, 'Lost Mines of Phandelver');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Date`
--

CREATE TABLE `Date` (
  `Date_ID` int(255) NOT NULL,
  `date` date DEFAULT NULL,
  `Timeblock_ID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `Date`
--

INSERT INTO `Date` (`Date_ID`, `date`, `Timeblock_ID`) VALUES
(9, '2023-01-25', 2),
(10, '2023-01-25', 3),
(11, '2023-01-25', 4),
(12, '2023-01-25', 5),
(13, '2023-01-25', 6),
(14, '2023-01-25', 7),
(15, '2023-01-25', 8),
(16, '2023-01-25', 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Session`
--

CREATE TABLE `Session` (
  `Session_ID` int(255) NOT NULL,
  `date` date NOT NULL,
  `timeblock` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Timeblock`
--

CREATE TABLE `Timeblock` (
  `Timeblock_ID` int(255) NOT NULL,
  `time` int(255) DEFAULT NULL,
  `User_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `Timeblock`
--

INSERT INTO `Timeblock` (`Timeblock_ID`, `time`, `User_ID`) VALUES
(2, 13, 2),
(3, 14, 2),
(4, 15, 2),
(5, 16, 2),
(6, 13, 2),
(7, 14, 2),
(8, 15, 2),
(9, 16, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User`
--

CREATE TABLE `User` (
  `User_ID` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `Campaign_ID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `User`
--

INSERT INTO `User` (`User_ID`, `username`, `email`, `password`, `type`, `Campaign_ID`) VALUES
(1, 'Luke', 'luke.huisman@yahoo.nl', '$2y$10$3oxY3VV7ZbK8uqKVy5ohf.2jdGIRW4ZGo2x8BOeLWAGSkOSsQOTFq', 1, 1),
(2, 'Luka', 'lukaotte@gmail.com', '$2y$10$jUS1eAHuoMVlJ1WB139zn.hvBBd3amwR3Qrb2YompRj07GBzTPtEa', 0, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Campaign`
--
ALTER TABLE `Campaign`
  ADD PRIMARY KEY (`Campaign_ID`),
  ADD KEY `Session_ID` (`Session_ID`);

--
-- Indexen voor tabel `Date`
--
ALTER TABLE `Date`
  ADD PRIMARY KEY (`Date_ID`),
  ADD KEY `Timeblock_ID` (`Timeblock_ID`);

--
-- Indexen voor tabel `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`Session_ID`);

--
-- Indexen voor tabel `Timeblock`
--
ALTER TABLE `Timeblock`
  ADD PRIMARY KEY (`Timeblock_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexen voor tabel `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Campaign_ID` (`Campaign_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Campaign`
--
ALTER TABLE `Campaign`
  MODIFY `Campaign_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `Date`
--
ALTER TABLE `Date`
  MODIFY `Date_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `Session`
--
ALTER TABLE `Session`
  MODIFY `Session_ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Timeblock`
--
ALTER TABLE `Timeblock`
  MODIFY `Timeblock_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `User`
--
ALTER TABLE `User`
  MODIFY `User_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Campaign`
--
ALTER TABLE `Campaign`
  ADD CONSTRAINT `Campaign_ibfk_1` FOREIGN KEY (`Session_ID`) REFERENCES `Session` (`Session_ID`);

--
-- Beperkingen voor tabel `Date`
--
ALTER TABLE `Date`
  ADD CONSTRAINT `Date_ibfk_1` FOREIGN KEY (`Timeblock_ID`) REFERENCES `Timeblock` (`Timeblock_ID`);

--
-- Beperkingen voor tabel `Timeblock`
--
ALTER TABLE `Timeblock`
  ADD CONSTRAINT `Timeblock_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Beperkingen voor tabel `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`Campaign_ID`) REFERENCES `Campaign` (`Campaign_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
