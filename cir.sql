-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time:  9 яну 2019 в 16:14
-- Версия на сървъра: 10.0.17-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Структура на таблица `halls`
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
-- Схема на данните от таблица `halls`
--

INSERT INTO `halls` (`id`, `number`, `seats`, `computers`, `laptop`, `projector`, `info`, `image`, `userId`) VALUES
(1, '2101A', 12, 12, 0, 0, 'Залата не се ползва от външни лица.', 'c1de78c9e5fc67a93fd8ac4428c22467.jpeg', 1),
(2, '2101В', 12, 12, 0, 0, 'Залата може да се ползва и от външни лица.', 'fd1fda28350c95d1a2f32143965a811e.jpeg', 1),
(3, '2101Г', 12, 12, 0, 0, 'Залата не се ползва от външни лица.', '42eb32abf5568d68681c3ee6aa89b2f6.jpeg', 1),
(4, '2108А', 20, 20, 1, 1, 'Залата може да се ползва и от външни лица.', '13beef192ea070a172a4dce1a0927dcb.jpeg', 1),
(5, '2108Б', 20, 20, 1, 1, 'Залата може да се ползва и от външни лица.', '1e3edc08f59e113247cf027d9d7eba74.jpeg', 1),
(6, '4130А', 15, 15, 1, 1, 'Залата може да се ползва и от външни лица.', '75c2063fe44a6b8b0e53797f8b412f65.jpeg', 1),
(7, '4130Б', 15, 15, 0, 0, 'Залата не се ползва от външни лица.', '10b0334596d8304d3949416aac068bfe.jpeg', 1),
(8, '4132', 12, 12, 0, 0, 'Залата не се ползва от външни лица.', '8907a5e4ccbe74afbf43f1a3fed9303f.jpeg', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hallId` int(11) NOT NULL,
  `requesterId` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `problems`
--

INSERT INTO `problems` (`id`, `description`, `hallId`, `requesterId`, `status`) VALUES
(2, 'Прозорецът не се отваря, дръжката е счупена!', 8, 5, 'Неизпълнена'),
(3, 'Мишката на компютър N не работи!', 2, 6, 'Неизпълнена');

-- --------------------------------------------------------

--
-- Структура на таблица `requests`
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
-- Схема на данните от таблица `requests`
--

INSERT INTO `requests` (`id`, `date`, `timeStart`, `timeEnd`, `description`, `hallId`, `status`, `requesterId`) VALUES
(1, '2019-01-01', '08:00:00', '09:00:00', 'Тема: Автоматизирани производствени системи\r\nСпециалност: Автоматика, информационна и управляваща техника', 4, 'Чакаща', 2),
(2, '2019-01-17', '14:00:00', '16:00:00', 'Тема: Компютърно моделиране на полета и процеси \r\nСпециалност: Електрически машини', 1, 'Чакаща', 5),
(3, '2019-01-25', '10:00:00', '11:00:00', 'Тема: Компютърно конструиране на електрически машини \r\nСпециалност: Електрически машини', 5, 'Чакаща', 5),
(4, '2019-01-21', '09:00:00', '10:00:00', 'Тема: Компютърно проектиране ;\r\nСпециалност: Инженерен дизайн', 7, 'Чакаща', 6),
(5, '2019-01-29', '17:00:00', '18:30:00', 'Тема: Информатика I ;\r\nСпециалност: Мехатроника', 3, 'Чакаща', 6),
(6, '2019-01-24', '15:00:00', '16:00:00', 'Тема: Информационни технологии в телекомуникациите; Специалност: Телекомуникации', 1, 'Чакаща', 7),
(7, '2019-01-01', '08:00:00', '10:00:00', 'Тема: Мултимедийни мрежи; Специалност: Телекомуникации', 8, 'Чакаща', 7),
(8, '2019-02-05', '09:00:00', '11:00:00', 'Тема: Измерване, контрол и комуникации в електроенергетични системи ; Специалност: Електроснабдяване, електрообзавеждане и електротранспорт', 6, 'Чакаща', 5),
(9, '2019-01-21', '16:00:00', '17:00:00', 'Тема: Компютърно симулиране на електрически системи ; Специалност: Електрически апарати', 2, 'Чакаща', 5);

-- --------------------------------------------------------

--
-- Структура на таблица `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bgName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `roles`
--

INSERT INTO `roles` (`id`, `name`, `bgName`) VALUES
(1, 'ROLE_ADMIN', 'Администратор'),
(2, 'ROLE_LECTOR', 'Преподавател'),
(3, 'ROLE_OPERATOR', 'Оператор'),
(4, 'ROLE_USER', 'Потребител');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullName`, `status`) VALUES
(1, 'admin@tu-sofia.bg', '$2y$13$MywZoX.4aQwilIml4Sg9Ce4mAOpb24tfDUA9NCjU3mFQGr0cx8gRu', 'Администратор', 1),
(2, 'lectorFA@tu-sofia.bg', '$2y$13$oHL40OjTRElOLL69jh/iLeLlmbSJHrejCsbVmRBZNbsUjFCM6P7cG', 'Преподавател ФА', 1),
(3, 'operator@tu-sofia.bg', '$2y$13$WsBGnaXEtv9VJYMVdpo/De.fR59W/SNH2CsLHCFeOXBcEaIbfDBam', 'Оператор', 1),
(4, 'user@tu-sofia.bg', '$2y$13$rhoYirRKyqHA.3ACO.vbJ.5GiX7vXA876E7XDLy9KHd8RAw.hXjl6', 'Потребител', 1),
(5, 'lectorEF@tu-sofia.bg', '$2y$13$vcogRVsrWz/SsJ0YFvTA5OEvOrz.bNx/GF3yAvsE/PrP3aCn8Q4QG', 'Преподавател ЕФ', 1),
(6, 'lectorMF@tu-sofia.bg', '$2y$13$FdCprNz5mQQ7OV.HHlkYEeOINH5c/fX3AoNyKYl7OH3Dtj6PTQhgq', 'Преподавател МФ', 1),
(7, 'lectorFT@tu-sofia.bg', '$2y$13$757yjVUXgo6XC5ViD4ZLkex8mqH8c8puMVKkinAZiHij/qNgoDA1a', 'Преподавател ФТ', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(6, 2),
(7, 2);

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
  ADD KEY `IDX_8E666245AA6E599B` (`hallId`),
  ADD KEY `IDX_8E66624591EC6DA8` (`requesterId`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B85D65191EC6DA8` (`requesterId`),
  ADD KEY `IDX_7B85D651AA6E599B` (`hallId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `FK_AD736D9E64B64DCC` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Ограничения за таблица `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `FK_8E66624591EC6DA8` FOREIGN KEY (`requesterId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_8E666245AA6E599B` FOREIGN KEY (`hallId`) REFERENCES `halls` (`id`);

--
-- Ограничения за таблица `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `FK_7B85D65191EC6DA8` FOREIGN KEY (`requesterId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_7B85D651AA6E599B` FOREIGN KEY (`hallId`) REFERENCES `halls` (`id`);

--
-- Ограничения за таблица `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
