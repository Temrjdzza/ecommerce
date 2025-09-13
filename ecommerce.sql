-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 13 2025 г., 15:46
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ecommerce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(15,6) DEFAULT NULL,
  `change_percent` decimal(6,2) DEFAULT NULL,
  `volume` bigint(20) DEFAULT NULL,
  `total` decimal(20,8) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `symbol`, `name`, `price`, `change_percent`, `volume`, `total`, `updated_at`) VALUES
(1, 'BTS', 'BitShares', 0.051200, 1.75, 8500000, 290000000.00000000, '2025-09-07 23:22:00'),
(2, 'XRP', 'Ripple', 0.520000, 0.80, 50000000, 99000000.00000000, '2025-09-07 23:22:00'),
(3, 'ETH', 'Ethereum', 1800.750000, -1.20, 80000000, 120000000.00000000, '2025-09-07 23:22:00'),
(4, 'ZEC', 'Zcash', 32.750000, -2.10, 1500000, 16000000.00000000, '2025-09-07 23:22:00');

-- --------------------------------------------------------

--
-- Структура таблицы `currency_history`
--

CREATE TABLE `currency_history` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` decimal(15,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currency_history`
--

INSERT INTO `currency_history` (`id`, `currency_id`, `date`, `price`) VALUES
(1, 1, '2025-09-08', 0.051200),
(2, 1, '2025-09-07', 0.050500),
(3, 1, '2025-09-06', 0.050800),
(4, 1, '2025-09-05', 0.050100),
(5, 1, '2025-09-04', 0.049500),
(6, 2, '2025-09-08', 0.520000),
(7, 2, '2025-09-07', 0.510000),
(8, 2, '2025-09-06', 0.530000),
(9, 2, '2025-09-05', 0.500000),
(10, 2, '2025-09-04', 0.490000),
(11, 3, '2025-09-08', 1800.000000),
(12, 3, '2025-09-07', 1815.000000),
(13, 3, '2025-09-06', 1780.000000),
(14, 3, '2025-09-05', 1820.000000),
(15, 3, '2025-09-04', 1795.000000),
(16, 4, '2025-09-08', 32.750000),
(17, 4, '2025-09-07', 33.100000),
(18, 4, '2025-09-06', 32.900000),
(19, 4, '2025-09-05', 33.500000),
(20, 4, '2025-09-04', 33.200000);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `created_at`) VALUES
(8, 2, 1, 2, 3000.00, '2025-08-01 04:00:00'),
(9, 5, 2, 1, 25.99, '2025-08-01 05:30:00'),
(10, 1, 3, 3, 226.50, '2025-08-02 08:45:00'),
(11, 4, 4, 1, 12.50, '2025-08-03 03:15:00'),
(12, 3, 5, 2, 200.00, '2025-08-04 12:00:00'),
(13, 2, 6, 1, 50.00, '2025-08-05 06:20:00'),
(14, 5, 7, 4, 400.00, '2025-08-06 11:10:00'),
(15, 1, 8, 1, 999.00, '2025-08-07 05:00:00'),
(16, 4, 9, 2, 70.00, '2025-08-08 14:30:00'),
(17, 3, 10, 3, 89.70, '2025-08-09 03:40:00'),
(18, 2, 11, 1, 89.99, '2025-08-10 07:00:00'),
(19, 5, 12, 1, 15.00, '2025-08-11 10:55:00'),
(20, 1, 13, 2, 250.00, '2025-08-12 04:05:00'),
(21, 4, 14, 3, 60.00, '2025-08-13 08:15:00'),
(22, 3, 15, 1, 35.00, '2025-08-14 13:00:00'),
(23, 2, 1, 1, 1500.00, '2025-08-15 05:00:00'),
(24, 5, 2, 2, 51.98, '2025-08-16 06:30:00'),
(25, 1, 3, 1, 75.50, '2025-08-17 09:45:00'),
(26, 4, 4, 2, 25.00, '2025-08-18 03:00:00'),
(27, 3, 5, 1, 100.00, '2025-08-19 08:00:00'),
(28, 2, 6, 3, 150.00, '2025-08-20 12:30:00'),
(29, 5, 7, 2, 200.00, '2025-08-21 07:10:00'),
(30, 1, 8, 1, 999.00, '2025-08-22 11:00:00'),
(31, 4, 9, 1, 35.00, '2025-08-23 14:00:00'),
(32, 3, 10, 2, 59.80, '2025-08-24 04:25:00'),
(33, 2, 1, 1, 1500.00, '2025-09-01 04:00:00'),
(34, 5, 2, 2, 51.98, '2025-09-02 05:30:00'),
(35, 1, 3, 3, 226.50, '2025-09-03 08:45:00'),
(36, 4, 4, 1, 12.50, '2025-09-04 03:15:00'),
(37, 3, 5, 2, 200.00, '2025-09-05 12:00:00'),
(38, 2, 6, 1, 19.99, '2025-09-06 06:20:00'),
(39, 5, 7, 4, 199.96, '2025-09-07 11:10:00'),
(40, 1, 8, 1, 999.00, '2025-09-07 17:06:10'),
(41, 2, 9, 1, 599.00, '2025-09-07 17:06:10'),
(42, 3, 10, 3, 89.70, '2025-09-07 17:06:10'),
(43, 4, 11, 1, 89.99, '2025-09-07 17:06:10'),
(44, 5, 1, 1, 1500.00, '2025-09-07 17:06:10'),
(45, 1, 2, 1, 25.99, '2025-09-07 17:06:10'),
(46, 2, 3, 1, 75.50, '2025-09-07 17:06:10');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `total_sold` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `price`, `stock`, `sku`, `total_sold`) VALUES
(1, 1, 'Laptop Pro 15', 1500.00, 20, 'LTPR15', 120),
(2, 1, 'Wireless Mouse', 25.99, 200, 'WMOUSE', 340),
(3, 1, 'Gaming Keyboard', 75.50, 150, 'GKEY75', 210),
(4, 2, 'Bestseller Novel', 12.50, 100, 'BOOK123', 80),
(5, 2, 'Science Journal', 8.90, 60, 'BOOKSCI', 45),
(6, 3, 'Summer T-Shirt', 19.99, 150, 'TSHIRT1', 220),
(7, 3, 'Jeans Classic', 49.99, 80, 'JEANSCL', 160),
(8, 4, 'Smartphone X', 999.00, 50, 'SMRTX', 300),
(9, 4, 'Tablet Pro', 599.00, 40, 'TABPRO', 180),
(10, 5, 'Football Ball', 29.90, 70, 'BALLFB', 140),
(11, 5, 'Running Shoes', 89.99, 60, 'RUNSHOE', 95);

-- --------------------------------------------------------

--
-- Структура таблицы `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `report_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `referrals`
--

INSERT INTO `referrals` (`id`, `source`, `percentage`, `report_date`) VALUES
(1, 'Social Media', 45.50, '2025-09-08'),
(2, 'Marketplaces', 30.00, '2025-09-08'),
(3, 'Ads', 24.50, '2025-09-08');

-- --------------------------------------------------------

--
-- Структура таблицы `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `total_sales` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `category`, `rating`, `total_sales`) VALUES
(1, 'TechStore', 'Electronics', 5, 120000.50),
(2, 'BookWorld', 'Books', 4, 45000.75),
(3, 'FashionHub', 'Clothing', 3, 98000.20),
(4, 'GadgetKing', 'Electronics', 5, 220000.10),
(5, 'SportZone', 'Sports', 4, 76500.00);

-- --------------------------------------------------------

--
-- Структура таблицы `traffic_sources`
--

CREATE TABLE `traffic_sources` (
  `id` int(11) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL,
  `report_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `traffic_sources`
--

INSERT INTO `traffic_sources` (`id`, `source`, `visits`, `report_date`) VALUES
(1, 'Social', 1200, '2025-09-08'),
(2, 'Email', 800, '2025-09-08'),
(3, 'Direct', 600, '2025-09-08'),
(4, 'Referral', 400, '2025-09-08');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'admin', 'Temridzza', '$2y$10$adRA97PDaIok7HEIf8nP4.05V3YmQZVK6viZ0aZI/FII6yX5r3PQi', 'admin', '2025-09-08 01:24:04'),
(5, 'admin1', 'Temridzza1', '$2y$10$Trjel1zSqrXTZNTMLiVIe.78t7ibUW6aF1FdIKIvsdK8gIQZ19DoS', 'admin', '2025-09-08 01:42:54');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Индексы таблицы `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `traffic_sources`
--
ALTER TABLE `traffic_sources`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `traffic_sources`
--
ALTER TABLE `traffic_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
