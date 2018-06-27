-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 27 2018 г., 21:46
-- Версия сервера: 10.0.35-MariaDB
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `codetoge_cabinet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `description`) VALUES
(1, 'Теперь у нас есть мобильное приложение', 'Отличная новость - теперь вы можете работать с личным кабинетом через мобильное приложение'),
(2, 'День рождения нашего генерального директора. Вот так', 'Завтра день рождения нашего ген.дира. Скидываемся по 10 рублей');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'iphone x', 75000),
(2, 'iphone 8s', 80000),
(3, 'Samsung galaxy s9', 70000),
(4, 'Google glass', 140000),
(5, 'macBook', 80000),
(6, 'ipad air', 23000),
(7, 'Чехол для iPad', 2000),
(8, 'Защитное стекло для iphone', 700),
(9, 'Nokia 3310', 1700),
(10, 'Товар 1', 10000),
(11, 'Товар 2', 11000),
(12, 'Товар 3', 12000),
(13, 'Товар 4', 13000),
(14, 'Товар 5', 14000),
(15, 'Товар 6', 15000),
(16, 'Товар 7', 16000),
(17, 'Товар 8', 17000),
(18, 'Товар 9', 18000),
(19, 'Товар 10', 19000),
(20, 'Товар 11', 20000),
(21, 'Iphone 11', 350000),
(22, 'klk', 10000),
(23, 'Товар 23', 10),
(24, 'Товар 24', 11),
(25, 'Товар 25', 12),
(26, 'Товар 26', 13),
(27, 'Товар 27', 14),
(28, 'Товар 28', 15),
(29, 'Товар 29', 16),
(30, 'Товар 30', 17),
(31, 'Товар 31', 18);

-- --------------------------------------------------------

--
-- Структура таблицы `productsInOrders`
--

CREATE TABLE `productsInOrders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Менеджер');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `fullName`, `email`, `password`, `role_id`) VALUES
(1, 'kam', 'Абзалов Камиль', 'mail@kamil-abzalov.ru', '93279e3308bdbbeed946fc965017f67a', 1),
(2, 'petr', 'Петр Петров', 'mail@kamil-abzalov.ru', 'e10adc3949ba59abbe56e057f20f883e', 2),
(3, 'ivan', 'Иванов Иван Иванович', 'ok_kam90@mail.ru', '93279e3308bdbbeed946fc965017f67a', 2),
(13, 'roman', 'Романов Роман Романович', 'ok_kam90@mail.ru', '93279e3308bdbbeed946fc965017f67a', 2),
(27, 'roman', 'Романов Степан', 'roman_stepan@gmail.com', 'ae5eb824ef87499f644c3f11a7176157', 2),
(28, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '168be531cac4b12983fe56d520495d7e', 2),
(29, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '168be531cac4b12983fe56d520495d7e', 2),
(30, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '168be531cac4b12983fe56d520495d7e', 2),
(31, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(32, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(33, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(34, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(35, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(36, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(37, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(38, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(39, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(40, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(41, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '81812c5ad6643a03f646027946a7a115', 1),
(42, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(43, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(44, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(45, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(46, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(47, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(48, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(49, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(50, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(51, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(52, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(53, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(54, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(55, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(56, 'ignat', 'Игнатьев Михаил', 'ignat@gmail.com', '424a25489e1a9f5abd57c4aeaa1ce71e', 2),
(66, 'kam', 'kam', 'ok_kam90@mail.ru', '96e79218965eb72c92a549dd5a330112', 1),
(67, 'wergutt', 'wergut', 'wergut@wergut.ru', 'b0486b477a1699cbfe7a7a19f2a60ee0', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productsInOrders`
--
ALTER TABLE `productsInOrders`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `productsInOrders`
--
ALTER TABLE `productsInOrders`
  ADD CONSTRAINT `productsInOrders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productsInOrders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
