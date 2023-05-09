-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2023 г., 23:12
-- Версия сервера: 8.0.29
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Администратор системы');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`, `engname`) VALUES
(1, 'Онлайн', 'success'),
(2, 'Отошел', 'warning'),
(3, 'Не беспокоить', 'danger');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusnew` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `position`, `tel`, `address`, `img`, `tags`, `status`, `vk`, `telega`, `insta`, `statusnew`, `role`) VALUES
(9, 'oliver.kopyov@smartadminwebapp.com', '$2y$10$VwY7dNc21X4hJY6fy2QZauRS6J502Xt.H74uTWNFgaktsHV5enVQO', 'Oliver Kopyov12', 'IT Director, Gotbootstrap Inc.12', '+1317456256412', '15 Charist St, Detroit, MI, 48212, USA12', 'img/demo/avatars/avatar-b.png', 'oliver kopyov', 'success', NULL, NULL, NULL, '2', NULL),
(10, 'Alita@smartadminwebapp.com', '$2y$10$Bgd7qwfAFRnXTQgvYPL4SO3czVqkcza05EJENnFMLTKXvWatDKCOm', 'Alita Gray1', 'Project Manager, Gotbootstrap Inc.1', '+131346113471', '134 Hamtrammac, Detroit, MI, 48314, USA1', 'img/demo/avatars/63466b2700830.png', 'alita gray', 'warning', NULL, NULL, NULL, '2', '1'),
(11, 'john.cook@smartadminwebapp.com', '$2y$10$wiEWwldgySEr6HcQBBHF..HGjZxJaAF8W.mbnoaNpxFZB68.BUKZW', 'Dr. John Cook PhD1', 'Human Resources, Gotbootstrap Inc.1', '+131377913471', '55 Smyth Rd, Detroit, MI, 48341, USA1', 'img/demo/avatars/63451c68d6824.png', 'dr john cook', 'danger', NULL, NULL, NULL, '2', NULL),
(12, 'jim.ketty@smartadminwebapp.com', '$2y$10$RVqjQn6jT3vcORHWkUY4qeFqTtiVKA3JrNKuvwp3QvX/TznThjILK', 'Jim Ketty', 'Staff Orgnizer, Gotbootstrap Inc.', '+13137793314', '134 Tasy Rd, Detroit, MI, 48212, USA', 'img/demo/avatars/avatar-k.png', 'jim ketty', 'success', NULL, NULL, NULL, '', NULL),
(39, 'user1@mail.com', '$2y$10$zRJsDPXHGiNkjTXW81dzZ.jJIS9H6DDDpHEevBZEEWCKgPkruV.Yi', 'user1', 'microsoft', '81234567525', 'Astana 23', 'img/demo/avatars/63466da0f079f.png', NULL, 'warning', NULL, NULL, NULL, '2', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
