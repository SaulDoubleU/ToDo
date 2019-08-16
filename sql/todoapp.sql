-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 aug 2019 om 15:58
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoapp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `list_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `list`
--

INSERT INTO `list` (`id`, `list_name`, `user_id`) VALUES
(1, 'this is a test', 5),
(2, 'blablabla', 6),
(3, 'ertertert', 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(4, 'test@test.com', '$2y$12$sjhiXbyxBGgue3P2Cyt5tuipdx9Y9GgK4sgNOdoaiEMcnwtWMVJ9m'),
(5, 'saul.wauters98@gmail.com', '$2y$12$crQU2Gfd9CfKGzH/CxbUz.8MODp3B2Wt4NSGc7WR/gvOAdtbUUsa.'),
(6, 'tes@gmail.com', '$2y$12$O7zzzExTYt99Y0.2OaHVQeJ.07wyJNbsx9dGlljHGI3ifLRMiMGk.'),
(7, 'Saul@test.com', '$2y$12$u1/GGHKZcBh60QUXsF.bHewiyAVWGqRpEe4OB2MTve4Ga7.ghOZE2');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
