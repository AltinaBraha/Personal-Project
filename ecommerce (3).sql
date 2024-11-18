-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `color` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `size`, `created_at`, `color`, `user_id`) VALUES
(50, 42, '39', '2024-11-17 23:28:48', '#8d6e63', 32),
(53, 36, '38', '2024-11-17 23:42:25', '#8d6e63', 33),
(54, 38, '37', '2024-11-17 23:48:52', '#00bcd4', 33),
(55, 37, '38', '2024-11-17 23:48:57', '#00bcd4', 33),
(58, 39, '38', '2024-11-18 00:13:22', '#00bcd4', 13),
(59, 38, '38', '2024-11-18 00:13:28', '#8d6e63', 13),
(63, 39, '38', '2024-11-18 10:18:56', '#8d6e63', 12),
(64, 42, '38', '2024-11-18 10:20:30', '#8d6e63', 12);

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

CREATE TABLE `contactform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`id`, `name`, `email`, `message`, `submission_date`) VALUES
(1, 'Altina Braha', 'altinabraha@gmail.com', 'I am interested in your products details.', '2024-10-27 22:32:19'),
(2, 'Era', 'era@gmail.com', 'this lipstick is so good?', '2024-10-27 22:32:19'),
(3, 'Aliena Gaa', 'alienaa@gaa.com', 'I have a question about my order.', '2024-10-27 22:32:19'),
(9, 'altina', 'al@fx.com', 'hjghn', '2024-11-04 12:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `reviews` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `reviews`, `img_url`, `user_id`) VALUES
(34, 'Vitamin C', 'vitamin C serum', 54.99, 6, 'images/serum1.webp', 12),
(36, 'Face Serum', 'Face Serum its so good', 56.00, 7, 'images/serum2.webp', 12),
(37, 'Makeup Primer', 'Makeup Primer', 36.00, 5, 'images/serum3.webp', 12),
(38, 'Concealer', 'Liquid Concealer', 29.00, 4, 'images/lipstick2.webp', 12),
(39, 'Lipstick', 'Liquid Lipstick', 65.00, 6, 'images/lipstick.webp', 12),
(42, 'lipstick', 'mascara', 34.20, 10, 'images/lipstick4.webp', 12),
(43, 'Lift Mascara', 'Clean Lash Lengthening Tubing Mascara', 26.00, 8, 'images/mascara3.webp', 12),
(44, 'Tatelette Mascara', 'tartelette™ XL tubing mascara', 32.00, 6, 'images/mascara2.webp', 12),
(48, 'Mascara', 'agag', 45.00, 45, 'images/mascara1.webp', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `is_admin` varchar(20) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(12, 'admin', 'admin', 'altina12al@gmail.com', '$2y$10$F8oDrhnYYKQa0m6BNTRgFuG7dlgK3128g/H.14RZLCI8551/GxUGG', '$2y$10$F8oDrhnYYKQa0m6BNTRgFuG7dlgK3128g/H.14RZLCI8551/GxUGG', 'true'),
(13, 'user', 'user', 'user@gmail.com', '$2y$10$JuErKQ7lPYVA2h6PRuZPVeTxCenB.VYfsEqVxCP2YEaf4jgnf7qLO', '$2y$10$JuErKQ7lPYVA2h6PRuZPVeTxCenB.VYfsEqVxCP2YEaf4jgnf7qLO', 'false'),
(32, 'altina', 'altinabrahah', 'altina@gmail.com', '$2y$10$GbboszG.agFPSfYy65gXGOqwwtw8oJyUAyo57bSl662P2C4yc4Mi.', '$2y$10$92Dhqxi8420JAdJUYPLlu.vk5H63tGVvow1OO31sTyXUtCEXdYHJC', 'false'),
(33, 'h', 'j', 'h@jkk.com', '$2y$10$ZSawIEzCiyaIY3gjk4qNgepGjHZS257EhYSPg6HS4C.Hd56zsWDEG', '$2y$10$AFO2CqNJLCY1GF0h3WmhdekijQXvJOOJ7vdJujK8ESL5y2c4Cu0q.', 'false'),
(36, 'admini', 'admini', 'altina@gmail.com', '$2y$10$PfgEVhFpENNDaAtnjZvh9uf4IBoCcvVt1HVHn02bch4QrzknMxPj2', '$2y$10$UjRxRhOsKy0xeXmfBVoxlOp4fgkBoAnTPC9nrzlD8bdHwipQjOiq.', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_1` (`product_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
