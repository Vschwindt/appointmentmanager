-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2024 um 15:47
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `semesterprojekt2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `appointments`
--

CREATE TABLE `appointments` (
  `ap_id` int(11) NOT NULL,
  `ap_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vote_start` datetime NOT NULL DEFAULT current_timestamp(),
  `vote_end` datetime NOT NULL,
  `creator_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `appointments`
--

INSERT INTO `appointments` (`ap_id`, `ap_name`, `location`, `description`, `vote_start`, `vote_end`, `creator_name`) VALUES
(6, 'Treffen', 'FH Technikum', 'Kleines casual treffen oder so', '2024-04-01 11:11:00', '2024-04-02 11:11:00', 'Viktor'),
(7, 'Neues Treffen', 'Irgendwo', '\"Spontanes\" Treffen', '2024-04-29 11:11:00', '2024-05-05 11:11:00', 'Viktor'),
(8, 'Neues Treffen NEU', 'Irgendwo', '\"Spontanes\" Treffen', '2024-04-29 11:11:00', '2024-05-05 11:11:00', 'Viktor'),
(9, 'Neues Treffen NEU NEU', 'Neues Treffen NEU NEU', 'Neues Treffen NEU NEU', '2024-04-29 11:11:00', '2024-05-04 11:11:00', 'Neues Treffen NEU NEU'),
(10, 'Neues Treffen NEU NEU FIXED', 'Neues Treffen NEU NEU', 'Neues Treffen NEU NEU', '2024-04-29 11:11:00', '2024-05-04 11:11:00', 'Neues Treffen NEU NEU'),
(11, 'newtest', 'newtest', 'newtest', '2024-04-03 11:01:00', '2024-05-04 11:01:00', 'sfds'),
(12, 'aaaaaaaaa', 'newtaaaaaaaaaest', 'aaaaaaaaa', '2024-03-11 11:11:00', '2024-05-05 11:11:00', 'aaaaaaaaa');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`c_id`, `ap_id`, `author_name`, `comment_text`) VALUES
(2, 10, 'Viktor', 'Commit ohne auswahl'),
(3, 10, 'Viktor', 'Comment mit auswahl'),
(4, 10, 'Kohle', 'Test'),
(5, 10, 'Max', 'Kann nur zur letzten halaben stunde oder so');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `options`
--

CREATE TABLE `options` (
  `op_id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `op_start` datetime NOT NULL,
  `op_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `options`
--

INSERT INTO `options` (`op_id`, `ap_id`, `op_start`, `op_end`) VALUES
(3, 6, '2024-05-01 11:00:00', '2024-05-01 11:59:00'),
(4, 6, '2024-05-02 11:00:00', '2024-05-02 11:59:00'),
(5, 10, '2024-05-04 11:11:00', '2024-05-04 12:11:00'),
(6, 10, '2024-05-03 11:11:00', '2024-05-03 12:11:00'),
(7, 11, '2024-05-01 11:11:00', '2024-05-01 12:11:00'),
(8, 11, '2024-05-03 11:11:00', '2024-05-03 12:11:00'),
(9, 11, '2024-05-02 11:11:00', '2024-05-02 12:11:00'),
(10, 12, '2024-05-01 11:11:00', '2024-05-01 12:11:00'),
(11, 12, '2024-05-02 11:11:00', '2024-05-02 12:11:00'),
(12, 12, '2024-05-03 11:11:00', '2024-05-03 12:11:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `votings`
--

CREATE TABLE `votings` (
  `v_id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `op_id` int(11) NOT NULL,
  `voter_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `votings`
--

INSERT INTO `votings` (`v_id`, `ap_id`, `op_id`, `voter_name`) VALUES
(1, 10, 6, 'Viktor'),
(2, 10, 5, 'Kevin'),
(3, 10, 6, 'Kevin'),
(4, 10, 5, 'Kohle'),
(5, 10, 6, 'Kohle'),
(6, 10, 5, 'Max'),
(7, 10, 6, 'Max');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `appointments3` (`ap_id`);

--
-- Indizes für die Tabelle `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`op_id`),
  ADD KEY `appointment` (`ap_id`);

--
-- Indizes für die Tabelle `votings`
--
ALTER TABLE `votings`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `appiontments2` (`ap_id`),
  ADD KEY `options` (`op_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `options`
--
ALTER TABLE `options`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `votings`
--
ALTER TABLE `votings`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `appointments3` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`ap_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `appointment` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`ap_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `votings`
--
ALTER TABLE `votings`
  ADD CONSTRAINT `appiontments2` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`ap_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `options` FOREIGN KEY (`op_id`) REFERENCES `options` (`op_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
