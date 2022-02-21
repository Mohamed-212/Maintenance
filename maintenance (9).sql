-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2020 at 12:26 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maintenance`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name_en`, `name_ar`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'nasr city', 'مدينة نصر', 1, '2020-12-13 07:05:17', '2020-12-13 07:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint UNSIGNED NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `year` int NOT NULL,
  `motor_no` bigint NOT NULL,
  `kms` bigint NOT NULL,
  `type` enum('suv','hatchback','sedan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `license_number`, `color`, `comments`, `year`, `motor_no`, `kms`, `type`, `model_id`, `customer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 's12345678', 'red', 'hj', 2017, 12345678, 2000, 'hatchback', 1, 1, 1, '2020-11-30 10:46:23', '2020-11-30 10:46:23'),
(2, 's123456789', 'black', 'fj', 1957, 123456786, 2000, 'hatchback', 1, 2, 1, '2020-11-30 10:48:00', '2020-11-30 10:48:00'),
(3, 's123456789', 'red', 'fdh', 1920, 12345678888, 2000, 'hatchback', 1, 5, 1, '2020-12-08 09:03:11', '2020-12-08 09:03:11'),
(4, 's12345678', 'black', 'f', 1941, 12345678, 2000, 'hatchback', 1, 1, 1, '2020-12-13 13:01:52', '2020-12-13 13:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kia', '2020-11-30 10:43:31', '2020-11-30 10:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

CREATE TABLE `car_models` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_models`
--

INSERT INTO `car_models` (`id`, `name`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Picanto', 1, '2020-11-30 10:43:46', '2020-11-30 10:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `tax_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Oil', 1, 1, '2020-11-30 08:04:06', '2020-11-30 08:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_en`, `name_ar`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 'القاهرة', '2020-12-13 06:13:02', '2020-12-13 06:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `city_id`, `area_id`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Esraa', '01113265985', NULL, NULL, NULL, NULL, '2020-11-30 10:36:27', '2020-11-30 10:36:27'),
(2, 'Menna', '01116523478', NULL, NULL, NULL, NULL, '2020-11-30 10:37:35', '2020-11-30 10:37:35'),
(3, 'test', '01112365849', NULL, NULL, NULL, NULL, '2020-12-02 12:13:00', '2020-12-02 12:13:00'),
(4, 'A', '01112569852', NULL, NULL, NULL, NULL, '2020-12-02 12:20:15', '2020-12-02 12:20:15'),
(5, 'ui', '01113659745', NULL, NULL, NULL, NULL, '2020-12-02 13:51:44', '2020-12-02 13:51:44'),
(6, 'sc', '01112365984', NULL, NULL, NULL, NULL, '2020-12-08 08:52:25', '2020-12-08 08:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_id` bigint UNSIGNED NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `job_id`, `salary`, `start_date`, `created_at`, `updated_at`) VALUES
(1, 'Esraa', 1, '7.00', '2020-11-26', '2020-11-30 10:13:52', '2020-11-30 10:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `trans_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` enum('cash','visa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `file_attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `trans_id`, `total_amount`, `type_id`, `comments`, `payment_type`, `user_id`, `file_attachment`, `created_at`, `updated_at`) VALUES
(1, 833536, '100.00', 1, 'gg', 'cash', 1, NULL, '2020-12-02 14:42:41', '2020-12-02 14:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'rent', '2020-12-02 14:39:40', '2020-12-02 14:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint UNSIGNED NOT NULL,
  `trans_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` enum('cash','visa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_types`
--

CREATE TABLE `income_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `address`, `tel_no`, `emp_id`, `created_at`, `updated_at`) VALUES
(1, 'Inventory', 'Korba St', '0223655489', 1, '2020-11-30 10:14:26', '2020-11-30 10:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE `inventory_item` (
  `id` bigint UNSIGNED NOT NULL,
  `inventory_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `av_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`id`, `inventory_id`, `item_id`, `unit`, `quantity`, `av_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'liter', 401, '12.56', NULL, NULL),
(2, 1, 3, 'liter', 992, '20.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `taxed_price` decimal(10,2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `serial_number`, `description`, `price`, `taxed_price`, `active`, `unit`, `user_id`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(1, 'shell 5000', '123456789', 'sgdsg djkfh', '1000.00', '1020.00', 1, 'liter', 1, 1, 1, '2020-11-30 08:39:50', '2020-12-08 07:24:37'),
(2, 'test', '12345672', 'fdsf', '100.00', '102.00', 1, 'liter', 1, 1, 1, '2020-12-02 14:35:05', '2020-12-08 07:24:37'),
(3, 'serial', '6223000495032', 'dgdg', '100.00', '102.00', 1, 'liter', 1, 1, 1, '2020-12-08 08:08:37', '2020-12-08 08:08:37'),
(4, 'sdfds', '2669584', 'dsaf', '200.00', '204.00', 1, 'liter', 1, 1, 1, '2020-12-08 08:49:05', '2020-12-08 08:49:05'),
(5, 'فف', '123654987', NULL, '100.00', '102.00', 1, 'liter', 1, 1, 1, '2020-12-13 07:06:27', '2020-12-13 07:06:27'),
(6, 'dg', '12345678', NULL, '20.00', '20.40', 1, 'liter', 1, 1, 1, '2020-12-13 09:40:25', '2020-12-13 09:40:25'),
(7, 'hh', '123456578', NULL, '20.00', '20.40', 1, 'liter', 1, 1, 1, '2020-12-13 13:26:15', '2020-12-13 13:26:15'),
(8, 'test', '1234567899', NULL, '10.00', '10.20', 1, 'liter', 1, 1, 1, '2020-12-14 06:41:40', '2020-12-14 06:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `item_purchase_order`
--

CREATE TABLE `item_purchase_order` (
  `id` bigint UNSIGNED NOT NULL,
  `po_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_purchase_order`
--

INSERT INTO `item_purchase_order` (`id`, `po_id`, `item_id`, `quantity`, `cost`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 108, '15.00', NULL, NULL),
(2, 1, 1, 100, '10.00', NULL, NULL),
(3, 2, 1, 108, '15.00', NULL, NULL),
(4, 2, 1, 100, '10.00', NULL, NULL),
(5, 3, 3, 998, '20.00', NULL, NULL),
(6, 4, 1, -2, '20.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_sales_order`
--

CREATE TABLE `item_sales_order` (
  `id` bigint UNSIGNED NOT NULL,
  `so_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_sales_order`
--

INSERT INTO `item_sales_order` (`id`, `so_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 1, NULL, NULL),
(2, 13, 1, 1, NULL, NULL),
(3, 14, 1, 1, NULL, NULL),
(4, 15, 1, 1, NULL, NULL),
(5, 16, 1, 1, NULL, NULL),
(6, 17, 1, 1, NULL, NULL),
(7, 18, 1, 1, NULL, NULL),
(8, 19, 1, 1, NULL, NULL),
(9, 20, 3, 1, NULL, NULL),
(10, 21, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Developer', '2020-11-30 10:13:32', '2020-11-30 10:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `entrance_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `duration` int NOT NULL,
  `kms` bigint NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`id`, `car_id`, `user_id`, `entrance_date`, `delivery_date`, `duration`, `kms`, `comments`, `subtotal`, `taxes`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-02', '2020-12-04', 3, 1000, 'ewf', '1000.00', '50.00', '1050.00', '2020-11-30 11:51:03', '2020-11-30 11:51:03'),
(2, 2, 1, '2020-11-20', '2020-11-25', 2, 2000, 'gsrg', '1000.00', '50.00', '1050.00', '2020-11-30 11:53:00', '2020-11-30 11:53:00'),
(3, 2, 1, '2020-11-20', '2020-11-25', 2, 2000, 'gsrg', '1000.00', '50.00', '1050.00', '2020-11-30 11:53:28', '2020-11-30 11:53:28'),
(4, 2, 1, '2020-11-20', '2020-11-25', 2, 2000, 'gsrg', '4000.00', '200.00', '4200.00', '2020-11-30 11:55:03', '2020-11-30 11:55:04'),
(5, 2, 1, '2020-11-20', '2020-11-25', 2, 2000, 'gsrg', '4000.00', '200.00', '4200.00', '2020-11-30 11:55:41', '2020-11-30 11:55:41'),
(6, 1, 1, '2020-11-28', '2020-11-24', 1, 2000, 'deg', '2000.00', '100.00', '2100.00', '2020-11-30 13:39:35', '2020-11-30 13:39:36'),
(7, 2, 1, '2020-11-27', '2020-10-29', 3, 50000, 'vbn', '2000.00', '100.00', '2100.00', '2020-12-02 14:25:35', '2020-12-02 14:25:35'),
(8, 1, 1, '2021-01-02', '2020-12-29', 3, 2000, 'retre', '2000.00', '100.00', '2100.00', '2020-12-07 15:08:15', '2020-12-07 15:08:15'),
(9, 2, 1, '2021-01-09', '2021-01-06', 4, 20000, 'kl', '2000.00', '100.00', '2100.00', '2020-12-08 06:35:03', '2020-12-08 06:35:03'),
(10, 1, 1, '2021-01-02', '2020-12-26', 2, 2000, ',', '2000.00', '70.00', '2070.00', '2020-12-08 07:25:23', '2020-12-08 07:25:23'),
(11, 1, 1, '2021-01-02', '2020-12-30', 3, 20000, 'jhjk', '1000.00', '50.00', '1050.00', '2020-12-08 08:18:32', '2020-12-08 08:18:32'),
(12, 2, 1, '2021-01-08', '2020-12-15', 500, 200, 'kgukj', '1100.00', '52.00', '1152.00', '2020-12-08 08:27:02', '2020-12-08 08:27:02'),
(13, 1, 1, '2020-12-12', '2020-10-29', 2, 2000, 'k', '1200.00', '54.00', '1254.00', '2020-12-08 08:29:33', '2020-12-08 08:29:34'),
(14, 1, 1, '2020-12-30', '2020-12-24', 55, 2000, 'hjkh', '1200.00', '54.00', '1254.00', '2020-12-08 08:50:03', '2020-12-08 08:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_services`
--

CREATE TABLE `maintenance_services` (
  `id` bigint UNSIGNED NOT NULL,
  `maintenance_id` bigint UNSIGNED NOT NULL,
  `entity_id` bigint UNSIGNED NOT NULL,
  `maintenanceKMs` int DEFAULT NULL,
  `next_maintenanceKMs` int DEFAULT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenance_services`
--

INSERT INTO `maintenance_services` (`id`, `maintenance_id`, `entity_id`, `maintenanceKMs`, `next_maintenanceKMs`, `entity`, `quantity`, `subtotal`, `taxes`, `total`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2000, 4000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(2, 5, 1, 2000, 4000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(3, 5, 1, NULL, NULL, 'item', 3, '3000.00', '150.00', '3150.00', NULL, NULL),
(4, 6, 1, 1000, 3000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(5, 6, 1, NULL, NULL, 'item', 1, '1000.00', '50.00', '1050.00', NULL, NULL),
(6, 7, 1, 1000, 51000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(7, 7, 1, NULL, NULL, 'item', 1, '1000.00', '50.00', '1050.00', NULL, NULL),
(8, 8, 1, NULL, 2000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(9, 8, 1, NULL, NULL, 'item', 1, '1000.00', '50.00', '1050.00', NULL, NULL),
(10, 9, 1, 2000, 22000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(11, 9, 1, NULL, NULL, 'item', 1, '1000.00', '50.00', '1050.00', NULL, NULL),
(12, 10, 1, 1000, 3000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(13, 10, 1, NULL, NULL, 'item', 1, '1000.00', '20.00', '1020.00', NULL, NULL),
(14, 11, 1, 1000, 21000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(15, 12, 1, 100, 300, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(16, 12, 3, NULL, NULL, 'item', 1, '100.00', '2.00', '102.00', NULL, NULL),
(17, 13, 1, 1000, 3000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(18, 13, 3, NULL, NULL, 'item', 1, '100.00', '2.00', '102.00', NULL, NULL),
(19, 13, 3, NULL, NULL, 'item', 1, '100.00', '2.00', '102.00', NULL, NULL),
(20, 14, 1, 2000, 4000, 'service', NULL, '1000.00', '50.00', '1050.00', NULL, NULL),
(21, 14, 3, NULL, NULL, 'item', 1, '100.00', '2.00', '102.00', NULL, NULL),
(22, 14, 3, NULL, NULL, 'item', 1, '100.00', '2.00', '102.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_04_072951_create_items_table', 1),
(5, '2020_11_04_073119_create_taxes_table', 1),
(6, '2020_11_04_073141_create_payments_table', 1),
(7, '2020_11_04_073202_create_inventories_table', 1),
(8, '2020_11_04_073308_create_suppliers_table', 1),
(9, '2020_11_04_073319_create_incomes_table', 1),
(10, '2020_11_04_073402_create_expenses_table', 1),
(11, '2020_11_04_073419_create_employees_table', 1),
(12, '2020_11_04_073428_create_customers_table', 1),
(13, '2020_11_04_073511_create_jobs_table', 1),
(14, '2020_11_04_073521_create_salaries_table', 1),
(15, '2020_11_04_083535_create_purchase_orders_table', 1),
(16, '2020_11_04_083627_create_inventory_item_table', 1),
(17, '2020_11_04_083729_create_sales_orders_table', 1),
(18, '2020_11_04_083905_create_cities_table', 1),
(19, '2020_11_04_083910_create_areas_table', 1),
(20, '2020_11_04_084118_create_tax_types_table', 1),
(21, '2020_11_04_084142_create_income_types_table', 1),
(22, '2020_11_04_084213_create_expense_types_table', 1),
(23, '2020_11_04_093248_create_item_sales_order_table', 1),
(24, '2020_11_04_122637_create_categories_table', 1),
(25, '2020_11_04_122658_create_offers_table', 1),
(26, '2020_11_04_180944_create_item_purchase_order_table', 1),
(27, '2020_11_15_073007_create_permission_tables', 1),
(28, '2020_11_19_091700_create_reports_table', 1),
(29, '2020_11_25_084352_create_car_brands_table', 1),
(30, '2020_11_25_084517_create_car_models_table', 1),
(31, '2020_11_25_085903_create_cars_table', 1),
(32, '2020_11_25_092237_create_services_table', 1),
(33, '2020_11_25_092956_create_maintenances_table', 1),
(34, '2020_11_25_093746_create_maintenance_services_table', 1),
(35, '2020_11_26_112403_create_years_table', 1),
(36, '2020_11_30_085505_create_sub_categories_table', 1),
(37, '2021_08_09_113123_create_foreign_key_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `price_after_discount` decimal(10,2) NOT NULL,
  `discount_type` enum('precentage','amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `po_id` bigint UNSIGNED DEFAULT NULL,
  `paid` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `file_attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_type` enum('cash','visa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `po_id`, `paid`, `remaining`, `file_attachment`, `comments`, `user_id`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 2, '1000.00', '1620.00', NULL, 'hfdh', 1, 'cash', '2020-11-30 10:16:52', '2020-11-30 10:16:52'),
(2, 3, '19920.00', '40.00', NULL, 'dsf', 1, 'cash', '2020-12-08 08:28:18', '2020-12-08 08:28:18'),
(3, 4, '20.00', '-60.00', NULL, 'vbv', 1, 'cash', '2020-12-13 11:02:25', '2020-12-13 11:02:25'),
(5, 4, '-100.00', '40.00', NULL, NULL, 1, 'cash', '2020-12-14 07:59:54', '2020-12-14 07:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `expected_on` date NOT NULL,
  `inventory_id` bigint UNSIGNED NOT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paid` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_type` enum('cash','visa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `supplier_id`, `expected_on`, `inventory_id`, `comments`, `paid`, `remaining`, `total_amount`, `user_id`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-12-03', 1, 'hfdh', '1000.00', '1620.00', '2620.00', 1, 'cash', '2020-11-30 10:15:28', '2020-11-30 10:15:28'),
(2, 1, '2020-12-03', 1, 'hfdh', '1000.00', '1620.00', '2620.00', 1, 'cash', '2020-11-30 10:16:51', '2020-11-30 10:16:51'),
(3, 1, '2020-12-19', 1, 'dsf', '19920.00', '40.00', '19960.00', 1, 'cash', '2020-12-08 08:28:18', '2020-12-08 08:28:18'),
(4, 1, '2020-12-24', 1, 'vbv', '20.00', '-60.00', '-40.00', 1, 'cash', '2020-12-13 11:02:25', '2020-12-13 11:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `entity_id` bigint NOT NULL,
  `payment_type` enum('cash','visa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('in','out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('sales_order','purchase_order','salary','expense','payment','maintenance','sales_payment') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `amount`, `entity_id`, `payment_type`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, '1000.00', 1, 'cash', 'out', 'payment', '2020-11-30 10:16:52', '2020-11-30 10:16:52'),
(2, '2620.00', 2, 'cash', 'out', 'purchase_order', '2020-11-30 10:16:52', '2020-11-30 10:16:52'),
(3, '1050.00', 12, 'cash', 'in', 'sales_order', '2020-11-30 10:36:27', '2020-11-30 10:36:27'),
(4, '1050.00', 13, 'cash', 'in', 'sales_order', '2020-11-30 10:37:36', '2020-11-30 10:37:36'),
(5, '1050.00', 14, 'cash', 'in', 'sales_order', '2020-11-30 10:39:51', '2020-11-30 10:39:51'),
(6, '4200.00', 5, 'cash', 'in', 'maintenance', '2020-11-30 11:55:42', '2020-11-30 11:55:42'),
(7, '2100.00', 6, 'cash', 'in', 'maintenance', '2020-11-30 13:39:36', '2020-11-30 13:39:36'),
(8, '1050.00', 5, 'cash', 'in', 'sales_payment', '2020-12-02 12:15:16', '2020-12-02 12:15:16'),
(9, '1050.00', 16, 'cash', 'in', 'sales_order', '2020-12-02 12:15:17', '2020-12-02 12:15:17'),
(10, '1050.00', 6, 'cash', 'in', 'sales_payment', '2020-12-02 12:20:16', '2020-12-02 12:20:16'),
(11, '1050.00', 17, 'cash', 'in', 'sales_order', '2020-12-02 12:20:16', '2020-12-02 12:20:16'),
(12, '1000.00', 7, 'cash', 'in', 'sales_payment', '2020-12-02 13:50:18', '2020-12-02 13:50:18'),
(13, '1050.00', 18, 'cash', 'in', 'sales_order', '2020-12-02 13:50:18', '2020-12-02 13:50:18'),
(14, '1050.00', 8, 'cash', 'in', 'sales_payment', '2020-12-02 13:51:45', '2020-12-02 13:51:45'),
(15, '1050.00', 19, 'cash', 'in', 'sales_order', '2020-12-02 13:51:45', '2020-12-02 13:51:45'),
(16, '2100.00', 7, 'cash', 'in', 'maintenance', '2020-12-02 14:25:36', '2020-12-02 14:25:36'),
(17, '100.00', 1, 'cash', 'out', 'expense', '2020-12-02 14:42:42', '2020-12-02 14:42:42'),
(18, '2100.00', 8, 'cash', 'in', 'maintenance', '2020-12-07 15:08:16', '2020-12-07 15:08:16'),
(19, '2100.00', 9, 'cash', 'in', 'maintenance', '2020-12-08 06:35:04', '2020-12-08 06:35:04'),
(20, '2070.00', 10, 'cash', 'in', 'maintenance', '2020-12-08 07:25:24', '2020-12-08 07:25:24'),
(21, '1050.00', 11, 'cash', 'in', 'maintenance', '2020-12-08 08:18:32', '2020-12-08 08:18:32'),
(22, '19920.00', 2, 'cash', 'out', 'payment', '2020-12-08 08:28:18', '2020-12-08 08:28:18'),
(23, '19960.00', 3, 'cash', 'out', 'purchase_order', '2020-12-08 08:28:18', '2020-12-08 08:28:18'),
(24, '1254.00', 13, 'cash', 'in', 'maintenance', '2020-12-08 08:29:35', '2020-12-08 08:29:35'),
(25, '102.00', 9, 'cash', 'in', 'sales_payment', '2020-12-08 08:31:56', '2020-12-08 08:31:56'),
(26, '102.00', 20, 'cash', 'in', 'sales_order', '2020-12-08 08:31:56', '2020-12-08 08:31:56'),
(27, '1254.00', 14, 'cash', 'in', 'maintenance', '2020-12-08 08:50:04', '2020-12-08 08:50:04'),
(28, '102.00', 10, 'cash', 'in', 'sales_payment', '2020-12-08 08:52:26', '2020-12-08 08:52:26'),
(29, '102.00', 21, 'cash', 'in', 'sales_order', '2020-12-08 08:52:26', '2020-12-08 08:52:26'),
(30, '17.00', 1, 'cash', 'out', 'salary', '2020-12-13 09:42:05', '2020-12-13 09:42:05'),
(31, '20.00', 3, 'cash', 'out', 'payment', '2020-12-13 11:02:25', '2020-12-13 11:02:25'),
(32, '-40.00', 4, 'cash', 'out', 'purchase_order', '2020-12-13 11:02:26', '2020-12-13 11:02:26'),
(33, '50.00', 4, 'cash', 'out', 'payment', '2020-12-14 07:43:26', '2020-12-14 07:43:26'),
(34, '50.00', 7, 'cash', 'out', 'purchase_order', '2020-12-14 07:43:26', '2020-12-14 07:43:26'),
(35, '-100.00', 5, 'cash', 'out', 'payment', '2020-12-14 07:59:54', '2020-12-14 07:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-12-14 07:52:38', '2020-12-14 07:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `emp_id` bigint UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_date` date NOT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deduction` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `emp_id`, `month`, `salary_date`, `bonus`, `deduction`, `total`, `comments`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'December', '2020-12-25', '10.00', '0.00', '17.00', NULL, 1, '2020-12-13 09:42:05', '2020-12-13 09:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `sub_total_amount` decimal(10,2) NOT NULL,
  `total_taxes` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `remaining` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_type` enum('cash','visa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `customer_id`, `sub_total_amount`, `total_taxes`, `paid`, `remaining`, `total_amount`, `user_id`, `payment_type`, `created_at`, `updated_at`) VALUES
(12, 1, '1000.00', '50.00', '1000.00', '50.00', '1050.00', 1, 'cash', '2020-11-30 10:36:27', '2020-11-30 10:36:27'),
(13, 2, '1000.00', '50.00', '100.00', '950.00', '1050.00', 1, 'cash', '2020-11-30 10:37:35', '2020-11-30 10:37:35'),
(14, 1, '1000.00', '50.00', '1002.00', '48.00', '1050.00', 1, 'cash', '2020-11-30 10:39:50', '2020-11-30 10:39:50'),
(15, 3, '1000.00', '50.00', '1000.00', '50.00', '1050.00', 1, 'cash', '2020-12-02 12:13:00', '2020-12-02 12:13:00'),
(16, NULL, '1000.00', '50.00', '1050.00', '0.00', '1050.00', 1, 'cash', '2020-12-02 12:15:16', '2020-12-02 12:15:16'),
(17, 4, '1000.00', '50.00', '1050.00', '0.00', '1050.00', 1, 'cash', '2020-12-02 12:20:15', '2020-12-02 12:20:15'),
(18, 1, '1000.00', '50.00', '1000.00', '50.00', '1050.00', 1, 'cash', '2020-12-02 13:50:17', '2020-12-02 13:50:17'),
(19, 5, '1000.00', '50.00', '1050.00', '0.00', '1050.00', 1, 'cash', '2020-12-02 13:51:44', '2020-12-02 13:51:44'),
(20, 1, '100.00', '2.00', '102.00', '0.00', '102.00', 1, 'cash', '2020-12-08 08:31:55', '2020-12-08 08:31:55'),
(21, 6, '100.00', '2.00', '102.00', '0.00', '102.00', 1, 'cash', '2020-12-08 08:52:25', '2020-12-08 08:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `sales_payments`
--

CREATE TABLE `sales_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `so_id` bigint UNSIGNED DEFAULT NULL,
  `paid` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `file_attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_type` enum('cash','visa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_payments`
--

INSERT INTO `sales_payments` (`id`, `so_id`, `paid`, `remaining`, `file_attachment`, `comments`, `user_id`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 12, '10.00', '12.00', NULL, NULL, 1, 'cash', '2020-11-30 09:14:11', '2020-11-30 09:14:11'),
(2, 12, '1.00', '11.00', NULL, NULL, 1, 'cash', '2020-11-30 09:33:34', '2020-11-30 09:33:34'),
(3, 12, '5.00', '6.00', NULL, NULL, 1, 'cash', '2020-11-30 09:33:59', '2020-11-30 09:33:59'),
(4, 15, '1000.00', '50.00', NULL, NULL, 1, 'cash', '2020-12-02 12:13:01', '2020-12-02 12:13:01'),
(5, 16, '1050.00', '0.00', NULL, NULL, 1, 'cash', '2020-12-02 12:15:16', '2020-12-02 12:15:16'),
(6, 17, '1050.00', '0.00', NULL, NULL, 1, 'cash', '2020-12-02 12:20:15', '2020-12-02 12:20:15'),
(7, 18, '1000.00', '50.00', NULL, NULL, 1, 'cash', '2020-12-02 13:50:18', '2020-12-02 13:50:18'),
(8, 19, '1050.00', '0.00', NULL, NULL, 1, 'cash', '2020-12-02 13:51:45', '2020-12-02 13:51:45'),
(9, 20, '102.00', '0.00', NULL, NULL, 1, 'cash', '2020-12-08 08:31:56', '2020-12-08 08:31:56'),
(10, 21, '102.00', '0.00', NULL, NULL, 1, 'cash', '2020-12-08 08:52:25', '2020-12-08 08:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `cost`, `tax`, `created_at`, `updated_at`) VALUES
(1, 'Oil Replacement', '1000.00', '5.00', '2020-11-30 11:50:31', '2020-11-30 11:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Shell Oil', 1, 1, '2020-11-30 08:07:05', '2020-11-30 08:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_tel_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `address`, `company_tel_no`, `email`, `contact_person_name`, `contact_person_mobile`, `contact_person_email`, `created_at`, `updated_at`) VALUES
(1, 'company', 'Salah Salem St', '0223699854', 'ee@c.com', 'Esraa Mostafa', '01115698752', 'admin@esraa.com', '2020-11-30 10:12:29', '2020-11-30 10:12:29'),
(2, 'company2', 'address', '0223655489', 's@s.com', 'Esraa Mostafa', '01112365489', 'dd@d.com', '2020-12-08 09:06:27', '2020-12-08 09:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `type_id`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 1, '2.00', '2020-11-30 08:03:24', '2020-12-08 07:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE `tax_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Test', '2020-11-30 08:03:12', '2020-11-30 08:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Esraa', 'admin@admin.com', NULL, '$2y$10$G/kuNj9WkCQVD1WUer9ebev5p4QJIcX1yB0RhVdqfzROKK2Fww1JO', NULL, '2020-11-30 07:35:18', '2020-11-30 07:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint UNSIGNED NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `created_at`, `updated_at`) VALUES
(1, '1920', NULL, NULL),
(2, '1921', NULL, NULL),
(3, '1922', NULL, NULL),
(4, '1923', NULL, NULL),
(5, '1924', NULL, NULL),
(6, '1925', NULL, NULL),
(7, '1926', NULL, NULL),
(8, '1927', NULL, NULL),
(9, '1928', NULL, NULL),
(10, '1929', NULL, NULL),
(11, '1930', NULL, NULL),
(12, '1931', NULL, NULL),
(13, '1932', NULL, NULL),
(14, '1933', NULL, NULL),
(15, '1934', NULL, NULL),
(16, '1935', NULL, NULL),
(17, '1936', NULL, NULL),
(18, '1937', NULL, NULL),
(19, '1938', NULL, NULL),
(20, '1939', NULL, NULL),
(21, '1940', NULL, NULL),
(22, '1941', NULL, NULL),
(23, '1942', NULL, NULL),
(24, '1943', NULL, NULL),
(25, '1944', NULL, NULL),
(26, '1945', NULL, NULL),
(27, '1946', NULL, NULL),
(28, '1947', NULL, NULL),
(29, '1948', NULL, NULL),
(30, '1949', NULL, NULL),
(31, '1950', NULL, NULL),
(32, '1951', NULL, NULL),
(33, '1952', NULL, NULL),
(34, '1953', NULL, NULL),
(35, '1954', NULL, NULL),
(36, '1955', NULL, NULL),
(37, '1956', NULL, NULL),
(38, '1957', NULL, NULL),
(39, '1958', NULL, NULL),
(40, '1959', NULL, NULL),
(41, '1960', NULL, NULL),
(42, '1961', NULL, NULL),
(43, '1962', NULL, NULL),
(44, '1963', NULL, NULL),
(45, '1964', NULL, NULL),
(46, '1965', NULL, NULL),
(47, '1966', NULL, NULL),
(48, '1967', NULL, NULL),
(49, '1968', NULL, NULL),
(50, '1969', NULL, NULL),
(51, '1970', NULL, NULL),
(52, '1971', NULL, NULL),
(53, '1972', NULL, NULL),
(54, '1973', NULL, NULL),
(55, '1974', NULL, NULL),
(56, '1975', NULL, NULL),
(57, '1976', NULL, NULL),
(58, '1977', NULL, NULL),
(59, '1978', NULL, NULL),
(60, '1979', NULL, NULL),
(61, '1980', NULL, NULL),
(62, '1981', NULL, NULL),
(63, '1982', NULL, NULL),
(64, '1983', NULL, NULL),
(65, '1984', NULL, NULL),
(66, '1985', NULL, NULL),
(67, '1986', NULL, NULL),
(68, '1987', NULL, NULL),
(69, '1988', NULL, NULL),
(70, '1989', NULL, NULL),
(71, '1990', NULL, NULL),
(72, '1991', NULL, NULL),
(73, '1992', NULL, NULL),
(74, '1993', NULL, NULL),
(75, '1994', NULL, NULL),
(76, '1995', NULL, NULL),
(77, '1996', NULL, NULL),
(78, '1997', NULL, NULL),
(79, '1998', NULL, NULL),
(80, '1999', NULL, NULL),
(81, '2000', NULL, NULL),
(82, '2001', NULL, NULL),
(83, '2002', NULL, NULL),
(84, '2003', NULL, NULL),
(85, '2004', NULL, NULL),
(86, '2005', NULL, NULL),
(87, '2006', NULL, NULL),
(88, '2007', NULL, NULL),
(89, '2008', NULL, NULL),
(90, '2009', NULL, NULL),
(91, '2010', NULL, NULL),
(92, '2011', NULL, NULL),
(93, '2012', NULL, NULL),
(94, '2013', NULL, NULL),
(95, '2014', NULL, NULL),
(96, '2015', NULL, NULL),
(97, '2016', NULL, NULL),
(98, '2017', NULL, NULL),
(99, '2018', NULL, NULL),
(100, '2019', NULL, NULL),
(101, '2020', NULL, NULL),
(102, '2021', NULL, NULL),
(103, '2022', NULL, NULL),
(104, '2023', NULL, NULL),
(105, '2024', NULL, NULL),
(106, '2025', NULL, NULL),
(107, '2026', NULL, NULL),
(108, '2027', NULL, NULL),
(109, '2028', NULL, NULL),
(110, '2029', NULL, NULL),
(111, '2030', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cars_model_id_foreign` (`model_id`),
  ADD KEY `cars_customer_id_foreign` (`customer_id`),
  ADD KEY `cars_user_id_foreign` (`user_id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_models_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_tax_id_foreign` (`tax_id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_city_id_foreign` (`city_id`),
  ADD KEY `customers_area_id_foreign` (`area_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_job_id_foreign` (`job_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_type_id_foreign` (`type_id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_type_id_foreign` (`type_id`);

--
-- Indexes for table `income_types`
--
ALTER TABLE `income_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventories_name_unique` (`name`),
  ADD KEY `inventories_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_item_inventory_id_foreign` (`inventory_id`),
  ADD KEY `inventory_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `items_user_id_foreign` (`user_id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `item_purchase_order`
--
ALTER TABLE `item_purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_purchase_order_po_id_foreign` (`po_id`),
  ADD KEY `item_purchase_order_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_sales_order`
--
ALTER TABLE `item_sales_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sales_order_so_id_foreign` (`so_id`),
  ADD KEY `item_sales_order_item_id_foreign` (`item_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_car_id_foreign` (`car_id`),
  ADD KEY `maintenances_user_id_foreign` (`user_id`);

--
-- Indexes for table `maintenance_services`
--
ALTER TABLE `maintenance_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_services_maintenance_id_foreign` (`maintenance_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_category_id_foreign` (`category_id`),
  ADD KEY `offers_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_po_id_foreign` (`po_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_orders_inventory_id_foreign` (`inventory_id`),
  ADD KEY `purchase_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_emp_id_foreign` (`emp_id`),
  ADD KEY `salaries_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_payments`
--
ALTER TABLE `sales_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`),
  ADD KEY `sub_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_type_id_foreign` (`type_id`);

--
-- Indexes for table `tax_types`
--
ALTER TABLE `tax_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_types`
--
ALTER TABLE `income_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_purchase_order`
--
ALTER TABLE `item_purchase_order`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_sales_order`
--
ALTER TABLE `item_sales_order`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `maintenance_services`
--
ALTER TABLE `maintenance_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales_payments`
--
ALTER TABLE `sales_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_types`
--
ALTER TABLE `tax_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `car_models`
--
ALTER TABLE `car_models`
  ADD CONSTRAINT `car_models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `expense_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `income_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD CONSTRAINT `inventory_item_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventory_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_purchase_order`
--
ALTER TABLE `item_purchase_order`
  ADD CONSTRAINT `item_purchase_order_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_purchase_order_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_sales_order`
--
ALTER TABLE `item_sales_order`
  ADD CONSTRAINT `item_sales_order_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sales_order_so_id_foreign` FOREIGN KEY (`so_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_services`
--
ALTER TABLE `maintenance_services`
  ADD CONSTRAINT `maintenance_services_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `tax_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
