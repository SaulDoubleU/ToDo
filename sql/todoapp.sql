-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 aug 2019 om 10:21
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
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `task_id`, `date`) VALUES
(183, 'this is a comment', 66, '2019-08-18 21:09:05'),
(184, 'this is a comment', 66, '2019-08-18 21:09:13'),
(185, 'test test', 66, '2019-08-18 21:09:22'),
(186, 'this is a comment', 67, '2019-08-18 21:09:30'),
(187, 'blablablablabla', 67, '2019-08-18 21:09:35'),
(188, 'this is a comment', 67, '2019-08-18 21:11:14'),
(189, 'sfgadfg', 67, '2019-08-18 21:11:16'),
(190, 'this is a comment', 67, '2019-08-18 21:11:19'),
(191, 'sfgadfg', 67, '2019-08-18 21:11:21'),
(192, 'this is a comment', 67, '2019-08-18 21:13:11'),
(193, 'this is a comment', 67, '2019-08-18 21:16:50'),
(194, 'this is a comment', 69, '2019-08-18 21:22:44'),
(195, 'this is also a comment', 69, '2019-08-19 11:46:18'),
(196, 'this is a comment', 70, '2019-08-19 14:37:21'),
(197, 'this is a comment', 83, '2019-08-19 18:12:56'),
(198, 'this is a comment', 85, '2019-08-19 18:29:53'),
(199, 'this is also a comment', 85, '2019-08-19 18:30:00'),
(200, 'this is a comment', 116, '2019-08-20 22:25:26'),
(201, 'this is a comment', 116, '2019-08-20 22:47:56'),
(202, '', 116, '2019-08-20 22:47:57'),
(203, '', 116, '2019-08-20 22:47:57'),
(204, 'this is a comment', 116, '2019-08-20 22:48:42'),
(205, 'blablablablabla', 116, '2019-08-20 22:48:51'),
(206, 'gjcgg', 116, '2019-08-20 23:22:20');

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
(62, 'this is a test', 4),
(108, 'this is a test', 5),
(111, 'This is the first List', 5),
(123, 'this is a test', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_deadline` date DEFAULT NULL,
  `task_pressure` time NOT NULL,
  `list_id` int(11) NOT NULL,
  `task_done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `task`
--

INSERT INTO `task` (`id`, `task_name`, `task_deadline`, `task_pressure`, `list_id`, `task_done`) VALUES
(96, 'first task', '0000-00-00', '03:00:00', 62, 1),
(97, 'first test', '2019-08-21', '01:00:00', 62, 1),
(98, 'first test', '2019-08-24', '01:00:00', 62, 1),
(114, 'first test', '2019-08-31', '00:00:00', 108, 1),
(115, 'second task', '2019-08-23', '00:00:00', 108, 1),
(116, 'first test', '2019-08-31', '00:00:00', 62, 0),
(117, 'first test', '2019-11-29', '01:00:00', 108, 0);

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
(7, 'Saul@test.com', '$2y$12$u1/GGHKZcBh60QUXsF.bHewiyAVWGqRpEe4OB2MTve4Ga7.ghOZE2'),
(8, 'testtest@test.com', '$2y$12$MgL1sD2ThtT0VF.gA3iYoe7i2y4rvZqxT/oX8KcsQDWgYMQkvlu/q'),
(9, 'testuser@gmail.com', '$2y$12$i7DeZDcJfe1C8kZ8Au0pWuhy/jkd2F96VtunEr0F4COSQP7HVOWiC'),
(10, 'test2@test.com', '$2y$12$2ddssgUgs2B5Y9bHUtqJN.jYb/GLP/DjEokE.fa2JtBHZd7A7ia2u'),
(11, 'test123@test.com', '$2y$12$9o4eoQqz5pUcP8lj6uuIAuPtgq3cqc0Ym/27gN4Qn/4bFOZYvkSxC');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT voor een tabel `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT voor een tabel `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
