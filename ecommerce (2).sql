-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 01:06 PM
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
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `size`, `created_at`, `color`) VALUES
(15, 36, '37', '2024-11-04 10:17:14', '#00bcd4'),
(16, 37, '37', '2024-11-04 10:17:18', '#f57c00'),
(17, 37, '37', '2024-11-04 11:04:38', '#f57c00'),
(19, 37, '38', '2024-11-04 11:47:33', '#8d6e63');

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
(40, 'Lipstick', 'Lipstick Matt', 72.00, 7, 'images/lipstick4.webp', 12),
(42, 'Lenghtening Mascara', 'mascara', 34.20, 10, 'images/mascara1.webp', 12),
(43, 'Lift Mascara', 'Clean Lash Lengthening Tubing Mascara', 26.00, 8, 'images/mascara3.webp', 12),
(44, 'Tatelette Mascara', 'tartelette™ XL tubing mascara', 32.00, 6, 'images/mascara2.webp', 12);

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
  `is_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(12, 'admin', 'admin', 'altina@gmail.com', '$2y$10$F8oDrhnYYKQa0m6BNTRgFuG7dlgK3128g/H.14RZLCI8551/GxUGG', '$2y$10$F8oDrhnYYKQa0m6BNTRgFuG7dlgK3128g/H.14RZLCI8551/GxUGG', 'true'),
(13, 'user', 'user', 'user@gmail.com', '$2y$10$JuErKQ7lPYVA2h6PRuZPVeTxCenB.VYfsEqVxCP2YEaf4jgnf7qLO', '$2y$10$JuErKQ7lPYVA2h6PRuZPVeTxCenB.VYfsEqVxCP2YEaf4jgnf7qLO', 'false'),
(20, 'altina', 'altina', 'tina12@gmail.com', '$2y$10$tKHhUQiGgYGVbKyzxhtv8OlYdRQKVr7h17RKTuQA/G46LvTj.W6va', '$2y$10$v3izrF5oJ8E8B/wBsN5mp.ktmZGiMJj5bFxw5/u1sHPncQtU1FIl6', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_1` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
