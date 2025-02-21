-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 06:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', 'Active', '1739357133_Lenovo_Logo.png', '2025-02-12 10:45:33', '2025-02-12 14:02:38'),
(2, 'Boat', 'Active', '1739357317_Boat_Logo.png', '2025-02-12 10:48:37', '2025-02-12 10:48:37'),
(7, 'Nike', 'Active', '1739426474_Nike-Logo.png', '2025-02-13 06:01:14', '2025-02-13 06:01:36'),
(8, 'Samsung', 'Active', '1739433045_samsung.png', '2025-02-13 07:50:45', '2025-02-13 07:50:45'),
(9, 'Adidas', 'Inactive', '1739433095_adidas.png', '2025-02-13 07:51:35', '2025-02-13 07:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Laptop', 'Active', '1739446372_Laptop.jpg', '2025-02-13 11:32:52', '2025-02-13 11:32:52'),
(3, 'Phone', 'Active', '1739446525_mobile.jpg', '2025-02-13 11:35:25', '2025-02-13 11:35:25'),
(4, 'Speaker', 'Inactive', '1739446719_speaker.jpg', '2025-02-13 11:38:39', '2025-02-13 11:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity_alert` decimal(10,2) DEFAULT 0.00,
  `quantity` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `discount_type` enum('Percentage','Cash') DEFAULT 'Percentage',
  `discount_value` decimal(10,2) DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `unit_id`, `store_id`, `product_code`, `quantity_alert`, `quantity`, `description`, `tax_id`, `discount_type`, `discount_value`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 'samsung s23', 3, 8, 4, 2, 'PT002', 2.00, 20.00, 'The Samsung Galaxy S23 is a flagship smartphone released in 2023, featuring a 6.1-inch Dynamic AMOLED 2X display, a 50MP triple-camera system, and the powerful Snapdragon 8 Gen 2 processor.', 3, 'Cash', 8.00, 25000.00, '1739950963_mobile.jpg', '0000-00-00 00:00:00', '2025-02-19 09:19:58'),
(3, ' Lenovo 3rd Generation', 2, 1, 4, 4, 'PT001', 5.00, 50.00, 'The Lenovo 3rd Generation refers to a series of Lenovo laptops or desktops equipped with third-generation technology, typically featuring Intel 3rd Gen processors (Ivy Bridge) or AMD equivalent, improved battery efficiency, and enhanced performance.', 3, 'Percentage', 10.00, 15000.00, '1739957081_Laptop.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `user_name`, `password`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Fred john', 'fredj25', 'fredj25', '+1387694357', 'john@example.com', 'Active', '2025-02-18 07:15:41', '2025-02-18 07:15:41'),
(3, 'James', 'james25', 'james25', '+1416350987', 'james@example.com', 'Inactive', '2025-02-18 07:16:44', '2025-02-18 07:16:44'),
(4, 'Thomas', 'thomas25', 'thomas25', '+12163547758', 'thomas@example.com', 'Active', '2025-02-19 05:32:33', '2025-02-19 05:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_rate` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`id`, `tax_name`, `tax_rate`, `status`, `created_at`, `updated_at`) VALUES
(3, 'GST', '18%', 'Active', '2025-02-14 07:16:46', '2025-02-14 07:16:46'),
(4, 'CGST', '9%', 'Active', '2025-02-14 10:20:35', '2025-02-14 12:45:41'),
(5, 'SGST', '9%', 'Active', '2025-02-14 11:52:09', '2025-02-14 12:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `short_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Kilogram', 'kg', 'Active', '2025-02-14 11:30:25', '2025-02-14 11:30:25'),
(3, 'Meter', 'm', 'Active', '2025-02-14 11:30:41', '2025-02-14 12:35:41'),
(4, 'Piece', 'pc', 'Active', '2025-02-14 12:43:52', '2025-02-14 12:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email_id` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `email_id`, `role`) VALUES
(1, 'admin', 'inventory-admin', '$2y$10$6j2NTJBue4DSaT3WLSxzI.QU.6wJk4xQwHvEEahbVqvOYPn4PsdRu', 'pn441976@gmail.com', 'admin'),
(6, 'Ranucle', 'admin', '$2y$10$VEPvBoNPlDsCgEDq2s4dbu8tfe7GHt0vZYMxsdnd9lMzaQxkRnNEa', 'admin@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `fk_products_category` (`category_id`),
  ADD KEY `fk_products_brand` (`brand_id`),
  ADD KEY `fk_products_unit` (`unit_id`),
  ADD KEY `fk_products_store` (`store_id`),
  ADD KEY `fk_products_tax` (`tax_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_products_store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_products_tax` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_products_unit` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
