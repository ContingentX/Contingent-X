-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 06. Jun 2016 um 17:24
-- Server-Version: 5.5.42
-- PHP-Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `f3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `key` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `messages`
--

INSERT INTO `messages` (`id`, `key`, `message`) VALUES
(1, 'helloworld', 'Willkommen bei mir auf der Seite'),
(3, 'Second message', 'This is the second message inserted from code'),
(4, 'Second message', 'This is the second message inserted from code'),
(5, 'Second message', 'This is the second message inserted from code');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `month` varchar(2) NOT NULL,
  `day` varchar(2) NOT NULL,
  `hour` varchar(2) NOT NULL,
  `min` varchar(2) NOT NULL,
  `sec` varchar(4) NOT NULL,
  `userIDmail` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `time`
--

INSERT INTO `time` (`id`, `year`, `month`, `day`, `hour`, `min`, `sec`, `userIDmail`) VALUES
(1, '2017', '05', '28', '17', '30', '00', 'test@wikibyte.org'),
(2, '2017', '05', '28', '15', '50', '00', 'hubert@wikibyte.org');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group` varchar(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `subname` varchar(30) NOT NULL,
  `time` varchar(21) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `group`, `name`, `subname`, `time`) VALUES
(1, 'test@wikibyte.org', '$2y$10$ya2Ld1Ii8SfRHhkTlBgJKuZpzHgLG1NFYfnMvymD71ZrhhDa0aXAm', 'admins', 'Michael', 'McCouman', '06 28, 2016 03:59:00'),
(2, 'hubert@wikibyte.org', '$2y$10$c/iJ4M0MD.QyPBsEtbdmherlnyYov8dgvxK3HWmhpTThzGgvW9t1u', '', 'Hubert', 'Wasist', 'Jun 27, 2016 19:28:22'),
(10, 'olaf@wikibyte.org', '$2y$10$ya2Ld1Ii8SfRHhkTlBgJKuZpzHgLG1NFYfnMvymD71ZrhhDa0aXAm', 'viewer', 'Olaf', 'wasweisich', ''),
(12, 'herbert@wikibyte.org', '123', '', 'Herbert', 'Nocheiner', ''),
(13, 'inge@wikibyte.org', '123', '', 'Inge', 'Nocheiner', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
