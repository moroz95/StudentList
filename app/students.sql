-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 04 2016 г., 00:28
-- Версия сервера: 5.7.13-0ubuntu0.16.04.2
-- Версия PHP: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `StudentList`
--

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `groupNumber` tinytext,
  `birthDate` date NOT NULL,
  `email` char(255) NOT NULL,
  `mark` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `location` enum('local','nonresident') NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`firstName`, `lastName`, `groupNumber`, `birthDate`, `email`, `mark`, `id`, `location`, `sex`, `password`) VALUES
('Мария', 'Забошкина', '100-561', '1994-05-07', '123@emal.com', 300, 33, 'local', 'female', NULL),
('Никита', 'Долгоусов', '123', '1977-10-06', 'eey@gmail.com', 230, 30, 'nonresident', 'male', NULL),
('Никита', 'Белоусов', '12345', '1977-10-06', 'eey@gmail.con', 247, 5, 'nonresident', 'male', NULL),
('Анастасия', 'Янковская', '100-51', '1998-05-07', 'h@email.com', 210, 9, 'nonresident', 'female', NULL),
('Мария', 'Янковская', '100-561', '1999-05-07', 'her@email.com', 220, 2, 'nonresident', 'female', NULL),
('Гульчата', 'Нашенская', '100-551', '1995-05-07', 'her@emaily.com', 132, 32, 'nonresident', 'female', NULL),
('Мария', 'Антошина', '100-561', '1999-05-07', 'her@emal.com', 220, 11, 'local', 'female', NULL),
('Максим', 'Харитонов', '101-456', '1995-08-09', 'his@email.com', 199, 3, 'nonresident', 'male', NULL),
('Максим', 'Давнович', '101-456', '1996-08-11', 'hiss@email.com', 196, 34, 'nonresident', 'male', NULL),
('Студент', 'Новый', '1245', '1994-03-12', 'lacos@mail.ru', 299, 43, 'nonresident', 'male', NULL),
('Алексей', 'Батурин', '141-322', '1998-01-01', 'my@email.com', 200, 1, 'local', 'male', NULL),
('Зинаида', 'Аркадьевна', '0011s', '1979-06-04', 'n@oulook.cmru', 199, 44, 'nonresident', 'female', '2UNY12ZGP2Si8hiUv0eJ9hGhxLNKvWB5pT92pY9DXoSa4ednzBUFfQ'),
('Анастасия', 'Фомкина', '24', '1999-07-21', 'Nastaia21@yandex.ru', 299, 45, 'nonresident', 'female', 'DZlIx4UWKKtqmtkpQPh6aXAFfHRQ9uuDfS2XPngnVA8H3jgnJQfXsA'),
('Алексей', 'Замутин', '141-323', '1997-01-01', 'nice@email.com', 133, 35, 'local', 'male', NULL),
('Имя', 'Новое', '1346', '1111-11-11', 'njt@com.ru', 217, 6, 'nonresident', 'female', NULL),
('Ктото', 'Там', '1347', '1111-11-11', 'njtr@com.ru', 217, 36, 'nonresident', 'female', NULL),
('Имя', 'фАНТА', '789', '1997-05-12', 'noon@hul.com', 300, 41, 'local', 'male', NULL),
('Никита', 'Локтионов', '239-afs', '1999-12-10', 'nuiki@nak.ri', 299, 4, 'nonresident', 'male', NULL),
('Владимир', 'Локтионов', '239-afs', '1996-12-10', 'nuikri@nak.ri', 250, 37, 'nonresident', 'male', NULL),
('Костя', 'Костянский', 'пппп', '2017-02-24', 'sada@mi.sff', -3293, 39, 'local', 'male', NULL),
('Аркадий', 'Новоюткин', '100-51', '1998-04-07', 'ser@email.com', 156, 10, 'local', 'male', NULL),
('Аркадий', 'Укупник', '100-51', '1995-04-07', 'sesr@email.com', 166, 38, 'local', 'male', NULL),
('Найсный', 'Алексей', '1234', '1996-07-07', 'shiftiam@gmail.com', 199, 40, 'local', 'male', NULL),
('Апдейта', 'Проверка', '23435', '1996-05-05', 'shiftiam@gmam.lko', 245, 42, 'nonresident', 'male', NULL),
('Валерия', 'Грибоедова', '100-51', '1998-04-07', 'tata@email.com', 200, 31, 'local', 'female', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
