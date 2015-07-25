-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 25. Jun 2015 um 02:23
-- Server-Version: 5.5.43-0ubuntu0.12.04.1
-- PHP-Version: 5.5.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `smart_light`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `channels`
--

IF OBJECT_ID(N'channels', N'U') IS NOT NULL
	DROP TABLE channels;


CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL,
  `channel` int(11) NOT NULL COMMENT 'dmx kanal',
  `value` int(11) NOT NULL DEFAULT '0' COMMENT 'dmx kanal value',
  `min` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '255',
  `visible_name` varchar(64) NOT NULL DEFAULT '[ DEVICE NAME ]' COMMENT 'name in der webinteface',
  `icon_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'alle ch mit der selben group_id gehören zu einem device',
  `is_switch` tinyint(1) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `channels`
--



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `devices`
--
IF OBJECT_ID(N'devices', N'U') IS NOT NULL
	DROP TABLE devices;

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL,
  `visible_name` text NOT NULL,
  `zone_id` int(11) NOT NULL,
  `icon_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `devices`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `icons`
--
IF OBJECT_ID(N'icons', N'U') IS NOT NULL
	DROP TABLE icons;
	
CREATE TABLE IF NOT EXISTS `icons` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `desc` text NOT NULL,
  `is_color_icon` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `icons`
--

INSERT INTO `icons` (`id`, `path`, `desc`, `is_color_icon`) VALUES
(0, '/colors/color_transparent.png', 'Color : transparent', 1),
(1, 'symbols/bell.png', 'Glocke', 0),
(2, 'symbols/charger.png', 'Ladegeraet', 0),
(3, 'symbols/fan.png', 'Ventilator', 0),
(4, 'symbols/house.png', 'Haus', 0),
(5, 'symbols/lamp_1.png', 'Schreibtischlampe', 0),
(6, 'symbols/lamp_5.png', 'Energiesparlampe', 0),
(7, 'symbols/pc.png', 'PC', 0),
(8, 'symbols/ps4.png', 'Spielekonsole', 0),
(9, 'symbols/radio.png', 'Radio', 0),
(10, 'symbols/tv.png', 'TV', 0),
(11, 'symbols/lamp_2.png', 'Stehlampe', 0),
(12, 'symbols/lamp_3.png', 'Haengelmape', 0),
(13, 'symbols/lamp_4.png', 'Gluehbirne', 0),
(15, 'symbols/pool.png', 'Pool', 0),
(16, 'symbols/power.png', 'Powersymbol', 0),
(17, 'symbols/flower.png', 'Blume', 0),
(18, 'symbols/bed.png', 'Bett', 0),
(19, 'symbols/kitchen.png', 'Kueche', 0),
(20, 'symbols/bath.png', 'Badezimmer', 0),
(22, '/colors/color_white.png', 'Color : weiss', 1),
(23, '/colors/color_orange.png', 'Color : orange', 1),
(24, '/colors/color_yellow.png', 'Color : yellow', 1),
(25, '/colors/color_cyan.png', 'Color : cyan', 1),
(26, '/colors/color_pink.png', 'Color : pink', 1),
(27, '/colors/color_green.png', 'Color : green', 1),
(28, '/colors/color_blue.png', 'Color : blue', 1),
(29, '/colors/color_red.png', 'Color : red', 1),
(30, '/colors/color_black.png', 'Color : black', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log`
--
IF OBJECT_ID(N'log', N'U') IS NOT NULL
	DROP TABLE log;

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` varchar(1024) NOT NULL DEFAULT '[ ERR NO LOG MESSAGE ]',
  `can_delete` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7549 DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodes`
--
IF OBJECT_ID(N'nodes', N'U') IS NOT NULL
	DROP TABLE nodes;
	
CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(11) NOT NULL,
  `visible_name` varchar(64) NOT NULL DEFAULT '[DEFAULT NODE]',
  `ip` varchar(64) NOT NULL DEFAULT '0.0.0.0',
  `port` int(11) NOT NULL DEFAULT '5000',
  `token` varchar(64) NOT NULL DEFAULT '0000',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `nodes`
--

INSERT INTO `nodes` (`id`, `visible_name`, `ip`, `port`, `token`, `active`) VALUES
(11, 'local node', '127.0.0.1', 5000, '0000', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `scenes`
--
IF OBJECT_ID(N'scenes', N'U') IS NOT NULL
	DROP TABLE scenes;
	
CREATE TABLE IF NOT EXISTS `scenes` (
  `id` int(11) NOT NULL,
  `visible_name` varchar(64) NOT NULL DEFAULT '[SCENE NAME]',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `show_in_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `add_as_home_kit_dev` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `scenes`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `scene_states`
--
IF OBJECT_ID(N'scene_states', N'U') IS NOT NULL
	DROP TABLE scene_states;
	
CREATE TABLE IF NOT EXISTS `scene_states` (
  `id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `channel_value` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `scene_states`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedule`
--
IF OBJECT_ID(N'schedule', N'U') IS NOT NULL
	DROP TABLE schedule;
	
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL,
  `visible_name` varchar(64) NOT NULL DEFAULT '[SCHEDULE NAME]',
  `toggle_time` varchar(5) NOT NULL DEFAULT '00:00',
  `scene_to_toggle` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `toggled` int(11) NOT NULL DEFAULT '0',
  `monday` tinyint(1) DEFAULT '0',
  `tuesday` tinyint(1) NOT NULL DEFAULT '0',
  `wednesday` tinyint(1) NOT NULL DEFAULT '0',
  `thursday` tinyint(1) NOT NULL DEFAULT '0',
  `friday` tinyint(1) NOT NULL DEFAULT '0',
  `saturday` tinyint(1) NOT NULL DEFAULT '0',
  `sunday` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `schedule`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zones`
--
IF OBJECT_ID(N'zones', N'U') IS NOT NULL
	DROP TABLE zones;
	
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(11) NOT NULL,
  `visible_name` varchar(64) NOT NULL DEFAULT '[ZONE NAME]',
  `icon_id` int(11) NOT NULL DEFAULT '0',
  `show_in_sidebar` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zones`
--



--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `nodes`
--
ALTER TABLE `nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `scenes`
--
ALTER TABLE `scenes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `scene_states`
--
ALTER TABLE `scene_states`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT für Tabelle `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7549;
--
-- AUTO_INCREMENT für Tabelle `nodes`
--
ALTER TABLE `nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `scenes`
--
ALTER TABLE `scenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `scene_states`
--
ALTER TABLE `scene_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT für Tabelle `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT für Tabelle `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
