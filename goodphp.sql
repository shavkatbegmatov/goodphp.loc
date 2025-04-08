-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 07 2025 г., 08:30
-- Версия сервера: 10.6.7-MariaDB
-- Версия PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `goodphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `module`
--

INSERT INTO `module` (`id`, `name`) VALUES
(2, 'module'),
(3, 'permission'),
(4, 'role'),
(1, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(6, 'assign_permissions'),
(5, 'assign_roles'),
(1, 'create'),
(3, 'delete'),
(4, 'read'),
(2, 'update');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'auditor'),
(3, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `rolepermission`
--

CREATE TABLE `rolepermission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rolepermission`
--

INSERT INTO `rolepermission` (`id`, `role_id`, `module_id`, `permission_id`) VALUES
(79, 1, 1, 1),
(80, 1, 1, 2),
(81, 1, 1, 3),
(82, 1, 1, 4),
(83, 1, 1, 5),
(84, 1, 2, 1),
(85, 1, 2, 2),
(86, 1, 2, 3),
(87, 1, 2, 4),
(88, 1, 3, 1),
(89, 1, 3, 2),
(90, 1, 3, 3),
(91, 1, 3, 4),
(92, 1, 4, 1),
(93, 1, 4, 2),
(94, 1, 4, 3),
(95, 1, 4, 4),
(96, 1, 4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'goodphp', '25f9e794323b453885f5181f1b624d0b', '2025-04-06 21:56:20', '2025-04-06 21:56:20'),
(2, 'test_user', '25f9e794323b453885f5181f1b624d0b', '2025-04-07 06:40:13', '2025-04-07 06:40:13');

-- --------------------------------------------------------

--
-- Структура таблицы `userrole`
--

CREATE TABLE `userrole` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `userrole`
--

INSERT INTO `userrole` (`id`, `user_id`, `role_id`) VALUES
(7, 1, 1),
(20, 2, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique Name` (`name`);

--
-- Индексы таблицы `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique Name` (`name`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique Name` (`name`);

--
-- Индексы таблицы `rolepermission`
--
ALTER TABLE `rolepermission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique Name` (`name`);

--
-- Индексы таблицы `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `rolepermission`
--
ALTER TABLE `rolepermission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `userrole`
--
ALTER TABLE `userrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
