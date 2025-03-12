-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 02:57 PM
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
  `name` varchar(100) NOT NULL,
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
  `name` varchar(100) NOT NULL,
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
(2, 'India Rupee', 'INR', '₹', 'Active', '2025-03-06 09:42:30'),
(3, 'US Dollar', 'USD', '$', 'Inactive', '2025-03-06 09:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
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
  `mail_host` varchar(100) NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_address` varchar(100) NOT NULL,
  `mail_password` text NOT NULL,
  `mail_from_name` varchar(100) NOT NULL,
  `encryption` enum('None','SSL','TLS') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `mail_host`, `mail_port`, `mail_address`, `mail_password`, `mail_from_name`, `encryption`, `updated_at`) VALUES
(1, 'smtp.gmail.com', 587, 'harshpatel120403@gmail.com', '$2y$10$9DCgv3CH66JCm', 'Inventory', 'TLS', '2025-02-27 04:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
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
  `payment_name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `payment_name`, `status`, `updated_at`) VALUES
(2, 'Paypal', 'Inactive', '2025-03-06 09:21:06'),
(3, 'Cash', 'Active', '2025-02-25 09:19:18'),
(4, 'Paytm', 'Active', '2025-02-25 09:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `quantity_alert` int(11) DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `discount_type` enum('Percentage','Cash') DEFAULT 'Percentage',
  `discount_value` int(11) DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `unit_id`, `store_id`, `product_code`, `quantity_alert`, `quantity`, `description`, `tax_id`, `discount_type`, `discount_value`, `price`, `image`, `updated_at`) VALUES
(2, 'samsung s23', 3, 8, 4, 2, 'PT002', 2, 15, 'The Samsung Galaxy S23 is a flagship smartphone released in 2023, featuring a 6.1-inch Dynamic AMOLED 2X display, a 50MP triple-camera system, and the powerful Snapdragon 8 Gen 2 processor.', 3, 'Cash', 8, 25000.00, '1739950963_mobile.jpg', '2025-03-11 11:02:32'),
(3, 'Lenovo 3rd Generation', 2, 1, 4, 4, 'PT001', 5, 50, 'The Lenovo 3rd Generation refers to a series of Lenovo laptops or desktops equipped with third-generation technology, typically featuring Intel 3rd Gen processors (Ivy Bridge) or AMD equivalent, improved battery efficiency, and enhanced performance.', 3, 'Percentage', 10, 15000.00, '1739957081_Laptop.jpg', '2025-03-11 11:03:10'),
(4, 'Iphone 14 Pro', 3, 12, 4, 2, 'PT003', 5, 20, 'Display · Super Retina XDR display · 6.1‑inch (diagonal) all‑screen OLED display · 2556x1179-pixel resolution at 460 ppi · Dynamic Island · Always-On display.', 3, 'Percentage', 10, 100000.00, '1740396298_iphone 14 pro.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `purchase_invoice` varchar(50) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `purchase_date` text NOT NULL,
  `ptotal_amount` decimal(10,2) NOT NULL,
  `ptax_id` int(11) DEFAULT NULL,
  `pdiscount` decimal(10,2) DEFAULT 0.00,
  `pshipping` decimal(10,2) DEFAULT 0.00,
  `status` enum('Received','Pending') NOT NULL,
  `ppaid_payment` decimal(10,2) DEFAULT 0.00,
  `ppayment_type` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_invoice`, `supplier_id`, `purchase_date`, `ptotal_amount`, `ptax_id`, `pdiscount`, `pshipping`, `status`, `ppaid_payment`, `ppayment_type`, `updated_at`) VALUES
(1, 'IMS-0001', 2, '10-03-2025', 0.00, 3, 36000.00, 100.00, 'Received', 150000.00, 4, '2025-03-10 13:55:25'),
(2, 'IMS-0002', 2, '11-03-2025', 78600.00, 3, 10000.00, 100.00, 'Received', 70000.00, 4, '2025-03-11 04:49:36'),
(3, 'IMS-0003', 2, '12-03-2025', 216500.00, 3, 20000.00, 500.00, 'Pending', 175000.00, 3, '2025-03-11 05:07:02'),
(4, 'IMS-0004', 2, '13-03-2025', 149050.00, 4, 10000.00, 1000.00, 'Pending', 149050.00, 4, '2025-03-11 06:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `p_price` decimal(10,2) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_name`, `p_price`, `p_qty`, `p_subtotal`) VALUES
(1, 4, 'samsung s23', 25000.00, 4, 100000.00),
(2, 4, 'Lenovo 3rd Generation', 15000.00, 3, 45000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` text NOT NULL,
  `order_tax_id` int(11) DEFAULT 0,
  `discount` decimal(10,2) DEFAULT 0.00,
  `shipping` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `status` enum('Completed','Inprogress') NOT NULL DEFAULT 'Inprogress',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_number`, `customer_id`, `order_date`, `order_tax_id`, `discount`, `shipping`, `total_amount`, `paid_amount`, `payment_type`, `status`, `updated_at`) VALUES
(11, 'INV-0010', 2, '0000-00-00', 5, 500.00, 100.00, 0.00, 17250.00, '3', 'Completed', '2025-03-07 05:38:09'),
(12, 'INV-0011', 2, '0000-00-00', 3, 1000.00, 100.00, 0.00, 100000.00, '3', 'Inprogress', '2025-03-07 05:44:15'),
(13, 'INV-0012', 2, '0000-00-00', 3, 1000.00, 100.00, 117100.00, 100000.00, '3', 'Inprogress', '2025-03-07 05:44:49'),
(15, 'INV-0014', 2, '07-03-2025', 5, 500.00, 100.00, 108600.00, 17250.00, '4', 'Inprogress', '2025-03-07 10:01:47'),
(16, 'INV-0015', 2, '07-03-2025', 3, 5000.00, 100.00, 42300.00, 30000.00, '4', 'Completed', '2025-03-10 06:52:41'),
(17, 'INV-0016', 2, '10-03-2025', 3, 2500.00, 50.00, 56550.00, 27050.00, '4', 'Inprogress', '2025-03-12 13:28:44'),
(18, 'INV-0017', 2, '11-03-2025', 3, 1000.00, 100.00, 117100.00, 100000.00, '3', 'Inprogress', '2025-03-11 06:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_name`, `price`, `qty`, `subtotal`, `updated_at`) VALUES
(2, 15, 'Iphone 14 Pro', 100000.00, 1, 100000.00, '2025-03-07 10:01:47'),
(3, 16, 'samsung s23', 25000.00, 1, 25000.00, '2025-03-07 11:44:58'),
(4, 16, 'Lenovo 3rd Generation', 15000.00, 1, 15000.00, '2025-03-07 11:44:58'),
(5, 17, 'samsung s23', 25000.00, 2, 50000.00, '2025-03-10 06:54:24'),
(6, 18, 'Iphone 14 Pro', 100000.00, 1, 100000.00, '2025-03-11 04:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return`
--

CREATE TABLE `sale_return` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_payment` decimal(10,2) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_items`
--

CREATE TABLE `sale_return_items` (
  `id` int(11) NOT NULL,
  `sale_return_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `tax` decimal(10,2) DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `ad_quantity` int(11) NOT NULL,
  `status` enum('Add','Subtract') NOT NULL,
  `notes` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`id`, `product_id`, `product_name`, `current_stock`, `ad_quantity`, `status`, `notes`, `updated_at`) VALUES
(1, 3, 'Lenovo 3rd Generation', 50, 20, 'Add', 'Add new Quantity.', '2025-03-11 09:16:12'),
(4, 3, 'Lenovo 3rd Generation', 75, 25, 'Add', 'Add new Quantity.', '2025-03-11 09:44:42'),
(6, 3, 'Lenovo 3rd Generation', 100, 25, 'Add', 'Add new Quantity.', '2025-03-11 09:50:17'),
(8, 2, 'samsung s23', 20, 10, 'Add', 'Add New Stock.', '2025-03-11 10:00:35'),
(9, 2, 'samsung s23', 30, 5, 'Subtract', 'Add New Stock.', '2025-03-11 10:01:13'),
(10, 2, 'samsung s23', 25, 5, 'Subtract', 'Add New Stock.22234234\r\n', '2025-03-11 11:02:11'),
(11, 2, 'samsung s23', 20, 5, 'Subtract', 'Add New Stock.22234234\r\n', '2025-03-11 11:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
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
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `country`, `city`, `address`, `image`, `updated_at`) VALUES
(2, 'Upton Group', 'upton@example.com', '+12568749035', 'USA', 'New York', '5678 Oak Avenue', '1741159680_customer1.jpg', '2025-03-05 07:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
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
  `unit_name` varchar(100) NOT NULL,
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
(4, 'Piece', 'pc', 'Active', '2025-02-28 06:25:21'),
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
  `role` enum('admin','user') NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `email_id`, `phone`, `role`, `image`) VALUES
(1, 'admin admin', 'inventory-admin', '$2y$10$6j2NTJBue4DSaT3WLSxzI.QU.6wJk4xQwHvEEahbVqvOYPn4PsdRu', 'pn441976@gmail.com', '6354177806', 'admin', '1740639994_customer5.jpg'),
(6, 'Ranucle admin', 'admin', '$2y$10$VEPvBoNPlDsCgEDq2s4dbu8tfe7GHt0vZYMxsdnd9lMzaQxkRnNEa', 'admin@gmail.com', '+15362789414', 'user', '1740722343_avatar-17.jpg'),
(9, 'Harsh Patel', 'harshpatel', '$2y$10$PLnniCXbe4Hu.NA/pSkS2.GBniGIcBJTbNXbpjxaI51V4Eve6a/Lm', 'harsh@example.com', '+12568749035', 'user', '1740722537_profile2.jpg');

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
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `ptax_id` (`ptax_id`),
  ADD KEY `ppayment_type` (`ppayment_type`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `sale_return`
--
ALTER TABLE `sale_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_type` (`payment_type`);

--
-- Indexes for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_return_id` (`sale_return_id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_return`
--
ALTER TABLE `sale_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`ptax_id`) REFERENCES `tax_rates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchases_ibfk_3` FOREIGN KEY (`ppayment_type`) REFERENCES `payment_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_return`
--
ALTER TABLE `sale_return`
  ADD CONSTRAINT `sale_return_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_return_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_return_ibfk_3` FOREIGN KEY (`payment_type`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  ADD CONSTRAINT `sale_return_items_ibfk_1` FOREIGN KEY (`sale_return_id`) REFERENCES `sale_return` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
