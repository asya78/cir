-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2019 at 05:27 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cir`
--

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seats` int(11) NOT NULL,
  `computers` int(11) NOT NULL,
  `laptop` tinyint(1) NOT NULL,
  `projector` tinyint(1) NOT NULL,
  `info` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `number`, `seats`, `computers`, `laptop`, `projector`, `info`, `image`, `userId`) VALUES
(3, '2204A', 12, 11, 0, 0, 'Test 3', '8d906cea90bfea7d2c24ce32e42c7b45.jpeg', 1),
(4, '214AA', 11, 3, 0, 1, 'asfasfasgdsadgsadg', 'ae38af70fdbdf0d17013cecc44c96763.jpeg', 1),
(5, '2121', 10, 10, 0, 0, 'Aaaaaaaaaaaaaa', 'e13382b82c7605abc2e157774da39733.jpeg', 1),
(8, '4112', 12, 11, 0, 0, 'Проба admin', '38dd870f5e14a07e0a909cc6ee630669.jpeg', 1),
(9, '12A3', 12, 11, 0, 0, 'adsa', 'b8d0783477c5894981df448b11b3af4b.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hall_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `timeStart` time DEFAULT NULL,
  `timeEnd` time DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hallId` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requesterId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `date`, `timeStart`, `timeEnd`, `description`, `hallId`, `status`, `requesterId`) VALUES
(7, '2018-12-19', '23:00:00', '23:59:00', 'Tema 2121', 5, 'Чакаща', 1),
(8, '2018-12-14', '02:04:00', '02:09:00', 'Tema 1', 3, 'Чакаща', 1),
(9, '2018-12-31', '03:00:00', '03:30:00', 'Заявка операотр 10', 8, 'Чакаща', 1),
(10, '2019-02-02', '01:00:00', '02:00:00', 'Оператор 10 - заявка 1', 9, 'Чакаща', 1),
(11, '2019-01-01', '01:00:00', '02:00:00', 'Оператор 10 - заявка 2', 8, 'Чакаща', 1),
(12, '2019-12-30', '01:00:00', '02:00:00', 'Заявка 1', 4, 'Чакаща', 1),
(13, '2019-01-01', '01:00:00', '02:01:00', 'Заявка 2', 3, 'Чакаща', 1),
(14, '2019-01-08', '01:00:00', '02:00:00', 'Nova zaqwka', 9, 'Чакаща', 1),
(15, '2019-01-08', '01:00:00', '03:00:00', 'Nova zaqvka', 9, 'Чакаща', 1),
(16, '2019-01-18', '01:00:00', '02:00:00', 'Ot zala', 3, 'Чакаща', 1),
(17, '2019-01-09', '13:00:00', '14:00:00', '1', 3, 'Чакаща', 1),
(18, '2019-01-09', '13:00:00', '14:00:00', '1', 3, 'Чакаща', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_hall`
--

CREATE TABLE `request_hall` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeStart` time NOT NULL,
  `timeEnd` time NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bgName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `bgName`) VALUES
(1, 'ROLE_ADMIN', 'Администратор'),
(2, 'ROLE_LECTOR', 'Преподавател'),
(3, 'ROLE_OPERATOR', 'Оператор'),
(4, 'ROLE_USER', 'Потребител');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullName`, `status`) VALUES
(1, 'asya@rainbowgrp.co.uk', '$2y$13$TmnD5Kh6vazbjRFmV4k5d.FvZrAoQHt.X6lE/KNm6/Ukg2Qqt5sKy', 'Ася Тотева', 1),
(5, 'lector@tu-sofia.bg', '$2y$13$7GFpuC9gc5nOGghzRynfOOjubSJufVZNnbCPhSsZueT9m17B/l8g.', 'Преподавател', 1),
(11, 'operator@tu-sofia.bg', '$2y$13$GmEGMR5xf.4HuY9ep3e32OZsbL5PP.KgJmOLq1H/V3jMcwLzM0Ejy', 'Оператор', 0),
(12, 'potrebitel@tu-sofia.bg', '$2y$13$6euYGifHXUCn.iv/2pbwwubkGSCFpSrlhQ9Dm9i8lrMBuFt0wXi56', 'Потребител', 0),
(13, 'potrebitel2@tu-sofia.bg', '$2y$13$GroEsAHUeUWUjCStsiq3wOAtp9IO6XVRV1X.ek3R9H.x/IW/cGlZ6', 'Потребител', 0),
(14, 'a@abv.bg', '$2y$13$8GsR9rtXkWTMF79Na3KL1uf8AXX2f0KBHxdslljZVlvv2iK4n31NO', 'safaf', 0),
(15, 'lector2@tu-sofia.bg', '$2y$13$d7UqUjlUeHs1Vh263XdNne1O10diQxxR44svapnAKt4Swr9uYtoQW', 'Преподавател 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(5, 2),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_AD736D9E96901F54` (`number`),
  ADD KEY `IDX_AD736D9E64B64DCC` (`userId`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8E66624552AFCFD6` (`hall_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B85D65191EC6DA8` (`requesterId`),
  ADD KEY `IDX_7B85D651AA6E599B` (`hallId`);

--
-- Indexes for table `request_hall`
--
ALTER TABLE `request_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `IDX_51498A8EA76ED395` (`user_id`),
  ADD KEY `IDX_51498A8ED60322AC` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `request_hall`
--
ALTER TABLE `request_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `FK_AD736D9E64B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `FK_8E66624552AFCFD6` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `FK_7B85D65191EC6DA8` FOREIGN KEY (`requesterId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_7B85D651AA6E599B` FOREIGN KEY (`hallId`) REFERENCES `halls` (`id`);

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
