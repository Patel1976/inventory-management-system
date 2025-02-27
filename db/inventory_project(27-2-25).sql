-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 03:06 PM
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `image`, `updated_at`) VALUES
(1, 'Lenovo', 'Active', '1739357133_Lenovo_Logo.png', '2025-02-12 14:02:38'),
(2, 'Boat', 'Active', '1739357317_Boat_Logo.png', '2025-02-12 10:48:37'),
(7, 'Nike', 'Active', '1739426474_Nike-Logo.png', '2025-02-13 06:01:36'),
(8, 'Samsung', 'Active', '1739433045_samsung.png', '2025-02-13 07:50:45'),
(9, 'Adidas', 'Inactive', '1739433095_adidas.png', '2025-02-13 07:51:47'),
(12, 'Apple', 'Active', '1740395208_apple.png', '2025-02-24 11:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `image`, `updated_at`) VALUES
(2, 'Laptop', 'Active', '1739446372_Laptop.jpg', '2025-02-13 11:32:52'),
(3, 'Phone', 'Active', '1739446525_mobile.jpg', '2025-02-13 11:35:25'),
(4, 'Speaker', 'Inactive', '1739446719_speaker.jpg', '2025-02-13 11:39:38'),
(5, 'Watch', 'Active', '1740396416_watch.jpg', '2025-02-24 11:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency_name` varchar(100) NOT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `currency_symbol` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_code`, `currency_symbol`, `status`, `updated_at`) VALUES
(2, 'India Rupee', 'INR', '₹', 'Active', '2025-02-25 06:49:55'),
(3, 'US Dollar	', 'USD', '$	', 'Active', '2025-02-25 06:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `country`, `city`, `address`, `image`, `updated_at`) VALUES
(2, ' Benjamin', 'benjamin@exmple.com', '+15362789414', 'USA', 'Los Angeles', '1234 Elm Street', '1740404246_customer5.jpg', '2025-02-24 13:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `encryption` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `mail_host`, `mail_port`, `mail_address`, `mail_password`, `mail_from_name`, `encryption`, `updated_at`) VALUES
(1, 'smtp.gmail.com', 587, 'harshpatel120403@gmail.com', '$2y$10$9DCgv3CH66JCmKYlkjluUOxkr5yWtkOTxa1G7ZF0/UFuYNarTs6OG', 'Inventory', 'tls', '2025-02-27 04:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `time_zone` varchar(50) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `favicon_icon` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `company_name`, `company_email`, `phone_number`, `currency`, `time_zone`, `date_format`, `company_logo`, `favicon_icon`, `address`, `updated_at`) VALUES
(1, 'IMS', 'harshpatel120403@gmail.com', '6354177806', '2', 'Asia/Kolkata', 'd-m-Y', '1740658484_inventory-logo.png', '1740658494_favicon.png', '7 Street, Ahmedabad, Gujarat, 382481', '2025-02-27 12:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `payment_name`, `status`, `updated_at`) VALUES
(2, 'Paypal', 'Active', '2025-02-25 09:18:35'),
(3, 'Cash', 'Active', '2025-02-25 09:19:18'),
(4, 'Paytm', 'Active', '2025-02-25 09:19:50');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `unit_id`, `store_id`, `product_code`, `quantity_alert`, `quantity`, `description`, `tax_id`, `discount_type`, `discount_value`, `price`, `image`, `updated_at`) VALUES
(2, 'samsung s23', 3, 8, 4, 2, 'PT002', 2.00, 20.00, 'The Samsung Galaxy S23 is a flagship smartphone released in 2023, featuring a 6.1-inch Dynamic AMOLED 2X display, a 50MP triple-camera system, and the powerful Snapdragon 8 Gen 2 processor.', 3, 'Cash', 8.00, 25000.00, '1739950963_mobile.jpg', '2025-02-19 09:19:58'),
(3, ' Lenovo 3rd Generation', 2, 1, 4, 4, 'PT001', 5.00, 50.00, 'The Lenovo 3rd Generation refers to a series of Lenovo laptops or desktops equipped with third-generation technology, typically featuring Intel 3rd Gen processors (Ivy Bridge) or AMD equivalent, improved battery efficiency, and enhanced performance.', 3, 'Percentage', 10.00, 15000.00, '1739957081_Laptop.jpg', '0000-00-00 00:00:00'),
(4, 'Iphone 14 Pro', 3, 12, 4, 2, 'PT003', 5.00, 20.00, 'Display · Super Retina XDR display · 6.1‑inch (diagonal) all‑screen OLED display · 2556x1179-pixel resolution at 460 ppi · Dynamic Island · Always-On display.', 3, 'Percentage', 10.00, 100000.00, '1740396298_iphone 14 pro.jpg', '0000-00-00 00:00:00');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `user_name`, `password`, `phone`, `email`, `status`, `updated_at`) VALUES
(2, 'Fred john', 'fredj25', 'fredj25', '+1387694357', 'john@example.com', 'Active', '2025-02-18 07:15:41'),
(3, 'James', 'james25', 'james25', '+1416350987', 'james@example.com', 'Active', '2025-02-24 11:32:51'),
(4, 'Thomas', 'thomas25', 'thomas25', '+12163547758', 'thomas@example.com', 'Active', '2025-02-19 05:32:33'),
(5, 'Rasmussen', 'rasmussen25', 'rasmussen25', '+1216358690', 'rasmussen@example.com', 'Inactive', '2025-02-24 11:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `country`, `city`, `address`, `description`, `image`, `updated_at`) VALUES
(2, 'Upton Group', 'upton@example.com', '+12568749035', 'USA', 'New York', '5678 Oak Avenue', NULL, '1740404108_customer1.jpg', '2025-02-24 13:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_rate` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`id`, `tax_name`, `tax_rate`, `status`, `updated_at`) VALUES
(3, 'GST', '18%', 'Active', '2025-02-14 07:16:46'),
(4, 'CGST', '9%', 'Active', '2025-02-14 12:45:41'),
(5, 'SGST', '9%', 'Active', '2025-02-14 12:42:17'),
(6, 'Purchase tax', '10%', 'Inactive', '2025-02-24 11:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `short_name`, `status`, `updated_at`) VALUES
(2, 'Kilogram', 'kg', 'Active', '2025-02-14 11:30:25'),
(3, 'Meter', 'm', 'Active', '2025-02-14 12:35:41'),
(4, 'Piece', 'pc', 'Inactive', '2025-02-24 11:40:53'),
(5, 'Liter', 'L', 'Inactive', '2025-02-24 11:40:45');

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
  `phone` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `email_id`, `phone`, `role`, `image`) VALUES
(1, 'admin admin', 'inventory-admin', '$2y$10$6j2NTJBue4DSaT3WLSxzI.QU.6wJk4xQwHvEEahbVqvOYPn4PsdRu', 'pn441976@gmail.com', '6354177806', 'admin', '1740639994_customer5.jpg'),
(6, 'Ranucle', 'admin', '$2y$10$VEPvBoNPlDsCgEDq2s4dbu8tfe7GHt0vZYMxsdnd9lMzaQxkRnNEa', 'admin@gmail.com', '', 'user', NULL),
(7, 'Harsh Patel', 'harshpatel', 'harshpatel', 'harsh@example.com', '+1387694357', 'user', '1740664811_avatar-17.jpg');

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
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
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
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
