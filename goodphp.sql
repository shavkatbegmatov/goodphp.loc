-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2025 г., 13:12
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
-- Структура таблицы `answeroption`
--

CREATE TABLE `answeroption` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `answeroption`
--

INSERT INTO `answeroption` (`id`, `question_id`, `option_text`, `display_order`, `active`) VALUES
(1, 3, 'sdf', 1, 1),
(7, 6, 'q1', 3, 1),
(8, 6, 'q2', 2, 1),
(9, 6, 'q3', 1, 1),
(10, 6, 'q4', 5, 1),
(11, 6, 'q5', 4, 1);

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
(7, 'question'),
(8, 'questionnaire'),
(4, 'role'),
(9, 'surveyresponse'),
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
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` enum('multiple_choice','text') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `text`, `question_type`, `created_at`) VALUES
(1, 'Вам предлагали взятку?', 'multiple_choice', '2025-04-08 08:49:19'),
(2, 'sdfsdfsdfsdf', 'text', '2025-04-08 10:45:21'),
(3, 'sdfsdfsdf', 'multiple_choice', '2025-04-08 10:45:24'),
(4, 'asdasdasdasd', 'multiple_choice', '2025-04-08 13:21:56'),
(5, 'sdfsdfsd', 'multiple_choice', '2025-04-08 13:23:40'),
(6, 'wwwww', 'multiple_choice', '2025-04-08 14:40:46');

-- --------------------------------------------------------

--
-- Структура таблицы `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `name`, `description`, `created_by`, `created_at`) VALUES
(1, 'Название анкеты #1', 'Описание анкеты #1321', 1, '2025-04-09 13:23:09'),
(2, 'Проверка филиала ___ Корпус #3', 'Вопросы для проверки филиала ___ Корпус #3', 1, '2025-04-10 10:09:16');

-- --------------------------------------------------------

--
-- Структура таблицы `questionnairequestion`
--

CREATE TABLE `questionnairequestion` (
  `id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questionnairequestion`
--

INSERT INTO `questionnairequestion` (`id`, `questionnaire_id`, `question_id`, `display_order`) VALUES
(5, 1, 1, 1),
(6, 1, 6, 2),
(7, 2, 1, 1),
(8, 2, 1, 2),
(9, 2, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `responseanswer`
--

CREATE TABLE `responseanswer` (
  `id` int(11) NOT NULL,
  `survey_response_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_option_id` int(11) DEFAULT NULL,
  `text_answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(127, 2, 7, 1),
(128, 2, 7, 2),
(129, 2, 7, 3),
(130, 2, 7, 4),
(131, 2, 8, 1),
(132, 2, 8, 2),
(133, 2, 8, 3),
(134, 2, 8, 4),
(135, 2, 9, 4),
(136, 3, 9, 1),
(137, 1, 1, 1),
(138, 1, 1, 2),
(139, 1, 1, 3),
(140, 1, 1, 4),
(141, 1, 1, 5),
(142, 1, 2, 1),
(143, 1, 2, 2),
(144, 1, 2, 3),
(145, 1, 2, 4),
(146, 1, 3, 1),
(147, 1, 3, 2),
(148, 1, 3, 3),
(149, 1, 3, 4),
(150, 1, 4, 1),
(151, 1, 4, 2),
(152, 1, 4, 3),
(153, 1, 4, 4),
(154, 1, 4, 6),
(155, 1, 7, 1),
(156, 1, 7, 2),
(157, 1, 7, 3),
(158, 1, 7, 4),
(159, 1, 8, 1),
(160, 1, 8, 2),
(161, 1, 8, 3),
(162, 1, 8, 4),
(163, 1, 9, 1),
(164, 1, 9, 2),
(165, 1, 9, 3),
(166, 1, 9, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `surveyresponse`
--

CREATE TABLE `surveyresponse` (
  `id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submitted_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Индексы таблицы `answeroption`
--
ALTER TABLE `answeroption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

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
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Индексы таблицы `questionnairequestion`
--
ALTER TABLE `questionnairequestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Индексы таблицы `responseanswer`
--
ALTER TABLE `responseanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_response_id` (`survey_response_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_option_id` (`answer_option_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `rolepermission_ibfk_1` (`role_id`),
  ADD KEY `rolepermission_ibfk_2` (`module_id`),
  ADD KEY `rolepermission_ibfk_3` (`permission_id`);

--
-- Индексы таблицы `surveyresponse`
--
ALTER TABLE `surveyresponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userrole_ibfk_1` (`user_id`),
  ADD KEY `userrole_ibfk_2` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answeroption`
--
ALTER TABLE `answeroption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `questionnairequestion`
--
ALTER TABLE `questionnairequestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `responseanswer`
--
ALTER TABLE `responseanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `rolepermission`
--
ALTER TABLE `rolepermission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT для таблицы `surveyresponse`
--
ALTER TABLE `surveyresponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
