-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Mai 2024 um 17:49
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

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
(13, 'Cool Appointment which is NOT yet closed', 'Somewhere', 'This is an example appointment to demonstrate functionality, this voten should NOT be closed by the time this gets presented (or the next month)', '2024-05-01 11:11:00', '2024-06-09 11:11:00', 'Viktor Schwindt'),
(14, 'Cool Appointment which is closed', 'Closed anyway', 'This is an example appointment to demonstrate functionality, this voten should be closed by the time this gets presented', '2024-05-02 11:11:00', '2024-05-02 12:11:00', 'Viktor Schwindt');

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
(6, 13, '123', '123123123');

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
(13, 13, '2024-05-03 08:20:00', '2024-05-03 08:30:00'),
(14, 13, '2024-05-03 08:30:00', '2024-05-03 08:40:00'),
(15, 14, '2024-05-18 11:12:00', '2024-05-18 11:12:00'),
(16, 14, '2024-05-17 11:12:00', '2024-05-17 11:12:00');

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
(8, 13, 13, 'Viktor Schwindt'),
(9, 13, 14, 'Viktor Schwindt'),
(10, 13, 13, 'Test'),
(11, 13, 14, 'Test'),
(12, 13, 13, 'Viktor'),
(13, 13, 14, 'Viktor'),
(14, 13, 13, 'wewse'),
(15, 13, 14, 'wewse'),
(16, 13, 13, ''),
(17, 13, 14, ''),
(18, 13, 13, 'dfdfd'),
(19, 13, 14, 'dfdfd'),
(20, 13, 13, '123'),
(21, 13, 14, '123');

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
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `options`
--
ALTER TABLE `options`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `votings`
--
ALTER TABLE `votings`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
