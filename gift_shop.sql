-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2024 at 08:34 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gift_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin1@admin.com', 'passwordhash1', 1, 1, '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(2, 'manager1', 'manager1@admin.com', 'passwordhash2', 2, 1, '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(3, 'support1', 'support1@admin.com', 'passwordhash3', 3, 1, '2024-10-28 14:10:52', '2024-10-28 14:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Flowers', 'Flowers', 'flower01.jpg', '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(2, 'Plants', 'Plants', '1730584541_banner-style-4-img-2.jpg', '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(3, 'Chocolates', 'A variety of delicious chocolates perfect for indulgence and gifting.', '1730498285_chocolate.jpg', '2024-11-01 18:38:39', '2024-11-01 18:38:39'),
(4, 'Packages', 'Special packages that include curated selections for any occasion.', 'package8.jpg', '2024-11-01 18:38:39', '2024-11-01 18:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user_id`, `name`, `email`, `phone_number`, `message`, `submitted_at`) VALUES
(1, 1, 'John Doe', 'john@example.com', '1234567890', 'Hello, I need help with my order.', '2024-10-28 14:10:52'),
(2, 2, 'Jane Smith', 'jane@example.com', '0987654321', 'Can you assist with product details?', '2024-10-28 14:10:52'),
(3, NULL, 'leen', 'leen@gmail.com', '07777777', 'test', '2024-11-03 01:14:14'),
(4, NULL, 'leen', 'leen@gmail.com', '07777777', 'test2', '2024-11-03 01:17:57'),
(5, NULL, 'leen', 'leen@gmail.com', '07777777', 'test2', '2024-11-03 01:17:57'),
(6, NULL, 'leen', 'leen@gmail.com', '07777777', 'test3', '2024-11-03 01:18:16'),
(7, NULL, 'leen', 'leen@gmail.com', '07777777', 'test3', '2024-11-03 01:18:16'),
(8, NULL, 'leen', 'leen@gmail.com', '07777777', 'test4', '2024-11-03 01:20:29'),
(9, NULL, 'leen', 'leen@gmail.com', '07777777', 'test4', '2024-11-03 01:20:29'),
(10, NULL, 'leen', 'leen@gmail.com', '07777777', 'test5', '2024-11-03 01:21:42'),
(11, NULL, 'Gray Gould', 'xetusicu@mailinator.com', '+1 (153) 871-6463', 'Qui atque vitae enim', '2024-11-03 02:52:18'),
(12, NULL, 'Matthew Saunders', 'nepinoti@mailinator.com', '+1 (449) 397-6925', 'Adipisicing inventor', '2024-11-03 03:02:32'),
(13, NULL, 'leen', 'leen@gmail.com', '07777777', 'test', '2024-11-03 08:43:14'),
(14, NULL, 'leen', 'leen@gmail.com', '07777777', 'test', '2024-11-03 08:56:06'),
(15, NULL, 'leen', 'leen@gmail.com', '07777777', 'TEST', '2024-11-03 09:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `discount_value` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_value`, `expiration_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SAVE20', '20', '2024-12-31', 1, '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(2, 'FLAT50', '50%', '2024-11-30', 1, '2024-10-28 14:10:52', '2024-10-28 14:10:52'),
(4, 'SAVE22', '8', '0000-00-00', 0, '2024-11-03 07:08:54', '2024-11-03 07:08:54'),
(5, 'GET30', '30', '2021-09-15', 0, '2024-11-03 07:42:55', '2024-11-03 07:42:55'),
(6, 'TEST', '30', '0000-00-00', 1, '2024-11-03 09:45:16', '2024-11-03 09:45:16'),
(9, 'TEST1', '40', '2025-03-13', 1, '2024-11-03 09:46:18', '2024-11-03 09:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `total_price` decimal(10,2) NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `payment_method` enum('Cash on Delivery') COLLATE utf8mb4_general_ci DEFAULT 'Cash on Delivery',
  `shipping_address` text COLLATE utf8mb4_general_ci,
  `city` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `coupon_id` (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `total_price`, `coupon_id`, `payment_method`, `shipping_address`, `city`, `postal_code`, `country`) VALUES
(1, 1, '2024-10-28 14:10:52', 'Delivered', 100.00, 1, 'Cash on Delivery', '123 Main St', 'Amman', '11118', 'Jordan'),
(2, 2, '2024-10-28 14:10:52', 'Processing', 150.00, NULL, 'Cash on Delivery', '456 Elm St', 'New York', '10001', 'USA'),
(3, 7, '2024-11-03 02:28:46', 'Pending', 106.97, NULL, 'Cash on Delivery', 'Quis id recusandae', 'Quia blanditiis et c', 'Fugiat velit nulla e', 'Odit ullamco velit '),
(4, 7, '2024-11-03 02:45:42', 'Pending', 122.97, NULL, 'Cash on Delivery', 'Minus eu Nam deserun', 'Quas voluptas anim o', 'Voluptas quam perspi', 'Voluptates fugiat om'),
(5, 7, '2024-11-03 02:49:58', 'Pending', 68.99, NULL, 'Cash on Delivery', 'Sapiente ut cum susc', 'Non tempore fugiat ', 'Autem voluptatibus l', 'Mollitia incidunt m'),
(8, 7, '2024-11-03 08:39:36', 'Pending', 73.99, NULL, 'Cash on Delivery', 'Minus in quis cum mi', 'Ex voluptate id nem', 'Laudantium quisquam', 'Quis quo veniam par'),
(9, 7, '2024-11-03 08:42:19', 'Pending', 68.99, NULL, 'Cash on Delivery', 'Atque enim labore fu', 'Quis voluptatem quis', 'Est similique occaec', 'Nisi temporibus labo'),
(10, 7, '2024-11-03 08:59:59', 'Pending', 99.49, NULL, 'Cash on Delivery', 'Maxime non debitis a', 'Aliqua Est consect', 'Vel quia laborum Op', 'Possimus ratione ma'),
(11, 7, '2024-11-03 09:35:17', 'Pending', 97.49, NULL, 'Cash on Delivery', 'Numquam vel proident', 'Iusto dolorem et con', 'Natus eum sed qui ut', 'Voluptas illo alias '),
(12, 7, '2024-11-03 10:00:34', 'Pending', 84.98, NULL, 'Cash on Delivery', 'Ullamco ad sint adip', 'Fugit eveniet sint', 'Nihil earum consequa', 'Deleniti perferendis'),
(13, 7, '2024-11-03 16:08:43', 'Pending', 179.92, NULL, 'Cash on Delivery', 'Natus in elit rerum', 'Voluptas soluta volu', 'Velit omnis eaque so', 'Sit maxime dolor ea');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 50.00),
(2, 2, 2, 1, 150.00),
(4, NULL, 9, 3, 18.99),
(5, NULL, 10, 1, 22.99),
(6, NULL, 15, 1, 16.99),
(7, NULL, 76, 1, 32.99),
(8, 5, 9, 1, 18.99),
(9, 6, 10, 1, 22.99),
(10, 6, 62, 3, 28.99),
(11, 7, 12, 1, 17.99),
(12, 8, 8, 3, 15.99),
(13, 9, 9, 1, 18.99),
(14, 10, 64, 3, 32.99),
(15, 11, 84, 1, 30.99),
(16, 11, 24, 1, 31.99),
(17, 11, 65, 1, 31.99),
(18, 12, 9, 1, 18.99),
(19, 12, 8, 1, 15.99),
(20, 13, 8, 6, 15.99),
(21, 13, 9, 1, 18.99),
(22, 13, 11, 1, 14.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `price`, `stock_quantity`, `category_id`, `image_url`, `created_at`, `updated_at`) VALUES
(8, 'Blooming Delight', 'A delightful bloom to brighten any day', 15.99, 15, 1, 'flower02.jpg', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(9, 'Petal Perfection', 'Perfectly petaled flowers for any occasion', 18.99, 20, 1, 'flower03.jpg', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(10, 'Floral Symphony', 'A symphony of colors in a flower bouquet', 22.99, 25, 1, 'flower04.jpg', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(11, 'Nature’s Bouquet', 'A natural bouquet of wildflowers', 14.99, 12, 1, 'flower05.jpg', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(12, 'Garden Bliss', 'A blissful addition to your garden', 17.99, 18, 1, 'flower06.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(13, 'Serene Blooms', 'Serene blooms for a peaceful atmosphere', 19.99, 14, 1, 'flower07.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(14, 'Sunshine Bouquet', 'A bright bouquet to uplift your spirits', 24.99, 10, 1, 'flower08.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(15, 'Lavender Dreams', 'Dreamy lavender flowers for relaxation', 16.99, 22, 1, 'flower09.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(16, 'Charming Blossoms', 'Charming blossoms for any special moment', 21.99, 13, 1, 'flower10.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(17, 'Daisy Delight', 'A delightful daisy bouquet for cheer', 13.99, 11, 1, 'flower11.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(18, 'Rose Elegance', 'Elegant roses for any occasion', 20.99, 16, 1, 'flower12.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(19, 'Wildflower Mix', 'A mixed bouquet of wildflowers', 23.99, 15, 1, 'flower13.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(20, 'Orchid Beauty', 'A beautiful orchid for any setting', 25.99, 12, 1, 'flower14.jpg', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(21, 'Floral Fantasy', 'A fantasy of flowers in full bloom', 28.99, 9, 1, 'flower15.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(22, 'Green Haven', 'A lush plant to bring greenery to any space', 30.99, 8, 2, 'plant01.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(23, 'Nature’s Breath', 'A refreshing plant that purifies the air', 32.99, 10, 2, 'plant02.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(24, 'Leafy Delight', 'A vibrant plant with lush foliage', 31.99, 15, 2, 'plant03.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(25, 'Verdant Oasis', 'An oasis of greenery for any room', 29.99, 12, 2, 'plant04.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(26, 'Indoor Freshness', 'A perfect indoor plant to freshen up your space', 34.99, 10, 2, 'plant05.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(27, 'Botanical Beauty', 'A plant that adds beauty and charm', 33.99, 14, 2, 'plant06.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(28, 'Green Charm', 'A charming plant that’s easy to care for', 28.99, 18, 2, 'plant07.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(29, 'Leafy Friend', 'A friendly plant that livens up any room', 30.99, 20, 2, 'plant08.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(30, 'Evergreen Joy', 'An evergreen plant that brings year-round joy', 27.99, 16, 2, 'plant09.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(31, 'Peaceful Greenery', 'A calming plant perfect for relaxation', 35.99, 12, 2, 'plant10.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(32, 'Serenity Plant', 'A serene addition to your green collection', 26.99, 9, 2, 'plant11.webp', '2024-11-01 18:35:37', '2024-11-01 18:35:37'),
(48, 'Flower Arrangement', 'A beautiful arrangement of fresh flowers', 12.99, 10, 1, 'flower01.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(49, 'Blooming Delight', 'A delightful bloom to brighten any day', 15.99, 15, 1, 'flower02.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(50, 'Petal Perfection', 'Perfectly petaled flowers for any occasion', 18.99, 20, 1, 'flower03.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(51, 'Floral Symphony', 'A symphony of colors in a flower bouquet', 22.99, 25, 1, 'flower04.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(52, 'Nature’s Bouquet', 'A natural bouquet of wildflowers', 14.99, 12, 1, 'flower05.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(53, 'Garden Bliss', 'A blissful addition to your garden', 17.99, 18, 1, 'flower06.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(54, 'Serene Blooms', 'Serene blooms for a peaceful atmosphere', 19.99, 14, 1, 'flower07.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(55, 'Sunshine Bouquet', 'A bright bouquet to uplift your spirits', 24.99, 10, 1, 'flower08.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(56, 'Lavender Dreams', 'Dreamy lavender flowers for relaxation', 16.99, 22, 1, 'flower09.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(57, 'Charming Blossoms', 'Charming blossoms for any special moment', 21.99, 13, 1, 'flower10.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(58, 'Daisy Delight', 'A delightful daisy bouquet for cheer', 13.99, 11, 1, 'flower11.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(59, 'Rose Elegance', 'Elegant roses for any occasion', 20.99, 16, 1, 'flower12.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(60, 'Wildflower Mix', 'A mixed bouquet of wildflowers', 23.99, 15, 1, 'flower13.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(61, 'Orchid Beauty', 'A beautiful orchid for any setting', 25.99, 12, 1, 'flower14.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(62, 'Floral Fantasy', 'A fantasy of flowers in full bloom', 28.99, 9, 1, 'flower15.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(63, 'Green Haven', 'A lush plant to bring greenery to any space', 30.99, 8, 2, 'plant01.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(64, 'Nature’s Breath', 'A refreshing plant that purifies the air', 32.99, 10, 2, 'plant02.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(65, 'Leafy Delight', 'A vibrant plant with lush foliage', 31.99, 15, 2, 'plant03.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(66, 'Verdant Oasis', 'An oasis of greenery for any room', 29.99, 12, 2, 'plant04.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(67, 'Indoor Freshness', 'A perfect indoor plant to freshen up your space', 34.99, 10, 2, 'plant05.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(68, 'Botanical Beauty', 'A plant that adds beauty and charm', 33.99, 14, 2, 'plant06.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(69, 'Green Charm', 'A charming plant that’s easy to care for', 28.99, 18, 2, 'plant07.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(70, 'Leafy Friend', 'A friendly plant that livens up any room', 30.99, 20, 2, 'plant08.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(71, 'Evergreen Joy', 'An evergreen plant that brings year-round joy', 27.99, 16, 2, 'plant09.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(72, 'Peaceful Greenery', 'A calming plant perfect for relaxation', 35.99, 12, 2, 'plant10.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(73, 'Serenity Plant', 'A serene addition to your green collection', 26.99, 9, 2, 'plant11.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(74, 'Sweet Delight', 'A delicious chocolate treat for any occasion', 30.99, 10, 3, 'chocolate01.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(75, 'Cocoa Bliss', 'Smooth and rich chocolate perfect for indulgence', 31.99, 12, 3, 'chocolate02.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(76, 'Chocolate Dream', 'A dream come true for chocolate lovers', 32.99, 15, 3, 'chocolate03.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(77, 'Velvet Bites', 'Velvety chocolate for a smooth taste experience', 33.99, 20, 3, 'chocolate04.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(78, 'Sweet Escape', 'Indulge in a sweet escape with this chocolate', 34.99, 25, 3, 'chocolate05.png', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(79, 'Cocoa Crunch', 'A perfect blend of crunch and chocolate', 30.99, 18, 3, 'chocolate06.png', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(80, 'Meltaway Magic', 'Chocolate that melts in your mouth', 31.99, 22, 3, 'chocolate07.png', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(81, 'Cocoa Classic', 'A classic chocolate with timeless flavor', 32.99, 14, 3, 'chocolate08.png', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(82, 'Heavenly Bites', 'Heavenly chocolate with a rich taste', 33.99, 16, 3, 'chocolate09.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(83, 'Cocoa Bliss', 'Rich chocolate that’s hard to resist', 34.99, 19, 3, 'chocolate10.jpeg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(84, 'Truffle Treat', 'A decadent chocolate truffle experience', 30.99, 12, 3, 'chocolate11.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(85, 'Pure Indulgence', 'Pure indulgence in every bite', 31.99, 15, 3, 'chocolate12.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(86, 'Sweet Temptation', 'Tempting chocolate treat for any moment', 32.99, 18, 3, 'chocolate13.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(87, 'Blissful Bites', 'Small bites packed with chocolate bliss', 33.99, 20, 3, 'chocolate14.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(88, 'Cocoa Joy', 'Joyful chocolate that brightens any day', 34.99, 12, 3, 'chocolate15.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(89, 'Gift Bundle', 'A thoughtfully curated package perfect for gifting', 50.99, 10, 4, 'package1.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(90, 'Celebration Set', 'A festive package to enhance any celebration', 52.99, 15, 4, 'package2.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(91, 'Premium Pack', 'A premium selection for special occasions', 55.99, 20, 4, 'package3.png', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(92, 'Surprise Box', 'A delightful package with hand-picked items', 53.99, 25, 4, 'package4.webp', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(93, 'Luxury Collection', 'An elegant package filled with quality items', 57.99, 10, 4, 'package5.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(94, 'Gift Assortment', 'A charming assortment perfect for any recipient', 58.99, 12, 4, 'package6.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(95, 'Event Special', 'A package designed to make every event memorable', 59.99, 14, 4, 'package7.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(96, 'Handpicked Hamper', 'A handpicked hamper for any occasion', 61.99, 8, 4, 'package8.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(97, 'Exclusive Set', 'An exclusive package with premium selections', 65.99, 10, 4, 'package9.jpg', '2024-11-01 18:39:04', '2024-11-01 18:39:04'),
(99, 'Holmes Contreras', 'Repellendus Facere ', 305.00, 618, 1, '1730624578_plant.png', '2024-11-03 09:02:58', '2024-11-03 09:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `review_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 'Excellent quality, very satisfied!', 1, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(2, 2, 2, 4, 'Looks great, but could be more durable.', 0, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(3, 3, 1, 3, 'Average product, works fine.', 1, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(4, 4, 2, 5, 'Fantastic design and sturdy!', 1, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(5, 5, 1, 4, 'Good value for the price.', 1, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(6, 6, 2, 5, 'Perfect addition to my collection!', 1, '2024-10-28 18:37:52', '2024-10-28 18:37:52'),
(7, 7, 8, 2, 'test', NULL, '2024-11-02 23:08:08', '2024-11-02 23:08:08'),
(8, 7, 8, 2, 'test', NULL, '2024-11-02 23:09:43', '2024-11-02 23:09:43'),
(9, 7, 8, 2, 'test', NULL, '2024-11-02 23:10:45', '2024-11-02 23:10:45'),
(10, 7, 8, 2, 'test', NULL, '2024-11-02 23:12:16', '2024-11-02 23:12:16'),
(11, 7, 8, 2, 'test', NULL, '2024-11-02 23:13:26', '2024-11-02 23:13:26'),
(12, 7, 8, 2, 'test', NULL, '2024-11-02 23:15:52', '2024-11-02 23:15:52'),
(13, 7, 8, 2, 'test', NULL, '2024-11-02 23:17:10', '2024-11-02 23:17:10'),
(14, 7, 8, 1, 'test', NULL, '2024-11-02 23:20:09', '2024-11-02 23:20:09'),
(15, 7, 9, 1, 'ttttt', NULL, '2024-11-02 23:23:20', '2024-11-02 23:23:20'),
(16, 7, 9, 1, 'jjj', NULL, '2024-11-02 23:24:40', '2024-11-02 23:24:40'),
(17, 7, 8, 1, 'oo', NULL, '2024-11-03 00:05:40', '2024-11-03 00:05:40'),
(18, 7, 9, 1, 'Voluptate debitis fu', NULL, '2024-11-03 02:50:51', '2024-11-03 02:50:51'),
(19, 7, 9, 1, 'VERY BAD QUALITY', 1, '2024-11-03 09:43:40', '2024-11-03 09:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `city` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `address`, `city`, `postal_code`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ahmad26', 'ahmad28@gmail.com', '12345678', 'ahmad', 'alfaraj', '089787708797', 'amman', 'amman', '8798', 'jordan', 0, '2024-10-26 11:57:54', '2024-10-26 11:57:54'),
(2, 'ahma7', 'ahmadalfara@gmail.com', '12345678', 'ahmad2', 'alfaraj', '089787708797', 'amman', 'amman', '8798', 'jordan', 1, '2024-10-26 13:22:40', '2024-10-26 13:22:40'),
(3, 'ahma67', 'ahmadahjjglfara@gmail.com', 'rytfhgcb', 'ahmad2', 'alfaraj', '089787708797', 'amman', 'amman', '8798', 'jordan', 1, '2024-10-27 09:17:40', '2024-10-27 09:17:40'),
(4, 'john_doe', 'john@example.com', 'password123', 'John', 'Doe', '1234567890', '123 Main St', 'New York', '10001', 'USA', 1, '2024-10-27 17:21:13', '2024-10-27 17:21:13'),
(5, 'jane_smith', 'jane@example.com', 'password123', 'Jane', 'Smith', '0987654321', '456 Elm St', 'Los Angeles', '90001', 'USA', 1, '2024-10-27 17:21:13', '2024-10-27 17:21:13'),
(6, 'ahmad99', 'amsadafayra5936@gmail.com', 'jhgwdjhgdfgj', 'ahmad', 'Hunter', '0790601497', 'amman', 'amman', '11623', 'Jordan', 1, '2024-10-28 06:57:03', '2024-10-28 06:57:03'),
(7, 'leen', 'leen@gmail.com', '$2y$10$3pKnhSDcQtQ8Fe3jjqkc/OalVz1d/Gt6DvRj/nKcGo/Z14htc4IGq', 'leenn', 'test', '07777777777', 'test', 'test', '1234', 'test12', 1, '2024-11-02 21:07:30', '2024-11-02 21:07:30'),
(8, 'leen1', 'test@gmail.com', '$2y$10$DR.gNevBHu4BuOu7sICc0emU3Hlnv9u9zBv3ncI4N05tElfuBb86S', 'test', 'test', '07777777777', 'test', 'test', '1234', 'test', 0, '2024-11-02 21:44:07', '2024-11-02 21:44:07'),
(9, 'hudovep', 'jebube@mailinator.com', 'Pa$$w0rd!', 'Ramona', 'Dennis', '+1 (392) 464-6764', 'Rem sapiente ut ut a', 'Excepturi non volupt', 'Officiis itaque magn', 'Dolores aliquam id p', 1, '2024-11-03 07:06:25', '2024-11-03 07:06:25'),
(10, 'befycex', 'nohehody@mailinator.com', 'Pa$$w0rd!', 'Heidi', 'Pollard', '+1 (737) 974-3141', 'Voluptatem Anim eum', 'Accusamus minim odit', 'Voluptas quia corrup', 'Id aut aut in labor', 1, '2024-11-03 07:21:37', '2024-11-03 07:21:37'),
(11, 'cuzova', 'dybegizy@mailinator.com', '$2y$10$FNSAH4QEJJ18qMXOe9hqHe7tyhTz7VJp3mOOIRUHjiA8xJuHxSHvy', 'Melanie', 'Dorsey', '157', 'Quod provident aliq', 'Consectetur sint nis', 'Consequatur dolor la', 'Omnis odit magni dic', 1, '2024-11-03 07:46:18', '2024-11-03 07:46:18'),
(12, 'lozeliz', 'kynekevogo@mailinator.com', 'Pa$$w0rd!', 'Kelly', 'Humphrey', '+1 (805) 697-2835', 'Quis beatae et exerc', 'Esse aliquid placeat', 'Amet sed illum aut', 'Nihil voluptatem Ad', NULL, '2024-11-03 09:02:00', '2024-11-03 09:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_at`) VALUES
(7, NULL, 8, '2024-11-03 00:47:28'),
(9, NULL, 8, '2024-11-03 05:38:17'),
(10, 7, 20, '2024-11-03 05:47:06'),
(11, NULL, 9, '2024-11-03 05:57:42'),
(12, NULL, 8, '2024-11-03 06:30:55'),
(13, NULL, 8, '2024-11-03 06:31:10'),
(14, NULL, 61, '2024-11-04 03:20:09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`);

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
