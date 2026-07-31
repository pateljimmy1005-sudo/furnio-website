-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2026 at 09:28 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
CREATE TABLE IF NOT EXISTS `abouts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Welcome Furnio', 'FURNIO provides premium furniture solutions with modern designs and exceptional comfort. From luxurious sofas to elegant dining tables, our products are carefully designed to bring style, functionality, and happiness to your living spaces.', 'about1.jpg', '2026-05-27 05:29:29', '2026-05-27 04:29:28'),
(2, 'Our Mission', 'Our mission is to deliver premium quality furniture with modern designs that make every home beautiful, comfortable, and elegant for families.', 'about.jpg', '2026-05-27 05:29:29', '2026-05-27 05:29:29'),
(3, 'Why Choose Us', 'We provide durable furniture, modern collections, affordable pricing, fast delivery, and excellent customer support for every customer.', 'chooseus.jpg', '2026-05-27 05:29:29', '2026-05-27 05:29:29'),
(4, 'Our Vision', 'Our vision is to become one of the leading furniture brands by offering innovative furniture solutions and customer satisfaction.', 'vision.jpg', '2026-05-27 05:29:29', '2026-05-27 05:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 10, 110, 1, '2026-07-29 04:40:44', '2026-07-29 04:40:44'),
(3, 10, 112, 1, '2026-07-29 04:42:49', '2026-07-29 04:42:49'),
(4, 10, 88, 2, '2026-07-29 05:38:17', '2026-07-29 05:40:37'),
(7, 11, 75, 1, '2026-07-31 00:11:43', '2026-07-31 00:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'patel jimmi', 'pateljimmy1005@gmail.com', '703452334', 'complan', 'dwefrgthyujikolikujyhtgrfedwdefrgthyujikujyhtgrfe', '2026-05-29 06:22:56', '2026-05-29 06:22:56'),
(2, 'patel jimmi', 'pateljimmy1005@gmail.com', '236788765', 'complan', 'binb ;QUIREH RHNFDUjdvnhjrefb', '2026-05-29 06:23:40', '2026-05-29 06:23:40'),
(3, 'Jimmy Patel', 'pateljimmy1005@gmail.com', '2346765432', 'wedfwweds', 'wdefrghnbg', '2026-07-30 23:31:10', '2026-07-30 23:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_08_094909_create_products_table', 1),
(5, '2026_05_06_090643_create_carts_table', 1),
(6, '2026_05_07_092145_create_orders_table', 2),
(7, '2026_05_21_090150_create_abouts_table', 2),
(8, '2026_05_25_061329_add_role_to_users_table', 3),
(9, '2026_05_26_120630_create_wishlists_table', 4),
(10, '2026_05_29_094103_create_contact_table', 5),
(11, '2026_04_08_094910_create_product_images_table', 6),
(12, '2026_06_01_054900_add_status_to_users_table', 6),
(13, '2026_06_01_115751_add_payment_status_to_orders_table', 6),
(14, '2026_06_03_063000_add_razorpay_fields_to_orders_table', 6),
(15, '2026_06_08_085553_add_last_login_to_users_table', 6),
(16, '2026_06_10_000000_update_order_statuses', 6),
(17, '2026_06_10_112639_add_profile_fields_to_users_table', 6),
(18, '2026_06_17_000001_create_products_legacy_table', 7),
(19, '2026_06_17_000002_add_sort_order_and_is_featured_to_product_images', 7),
(20, '2026_06_17_000003_remove_duplicate_columns_from_product_images', 7),
(21, '2026_06_26_094239_add_deleted_at_to_users_and_products_tables', 7),
(22, '2026_06_26_094411_add_indexes_and_foreign_keys_to_tables', 8),
(23, '2026_06_26_100517_create_user_addresses_table', 8),
(24, '2026_07_01_062052_reviews', 8),
(25, '2026_07_09_124533_refactor_orders_schema', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash On Delivery',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Created',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `razorpay_order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_status_index` (`status`),
  KEY `orders_payment_status_index` (`payment_status`),
  KEY `orders_payment_method_index` (`payment_method`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `shipping_fee`, `product_id`, `name`, `phone`, `address`, `quantity`, `total_price`, `payment_method`, `status`, `created_at`, `updated_at`, `payment_status`, `razorpay_order_id`, `razorpay_payment_id`, `razorpay_signature`) VALUES
(1, 4, NULL, 0.00, 12, 'User', '0000000000', 'N/A', 1, 25999.00, 'COD', 'Created', '2026-05-31 23:11:53', '2026-05-31 23:11:53', 'pending', NULL, NULL, NULL),
(2, 5, 18999.00, 0.00, NULL, 'Rahul Sharma', '9876548071', 'Station Road, City Center, Building #21', NULL, NULL, 'COD', 'Delivered', '2026-07-08 03:02:38', '2026-07-29 03:02:38', 'paid', NULL, NULL, NULL),
(3, 6, 18999.00, 0.00, NULL, 'Priya Patel', '9876553781', 'Station Road, City Center, Building #50', NULL, NULL, 'COD', 'Cancelled', '2026-06-15 03:02:38', '2026-07-29 03:02:38', 'paid', NULL, NULL, NULL),
(4, 7, 34997.00, 0.00, NULL, 'Amit Verma', '9876536621', 'Station Road, City Center, Building #52', NULL, NULL, 'Razorpay', 'Created', '2026-07-27 03:02:38', '2026-07-29 03:02:38', 'paid', NULL, NULL, NULL),
(5, 8, 65495.00, 499.00, NULL, 'Neha Gupta', '9876551600', 'Station Road, City Center, Building #90', NULL, NULL, 'COD', 'Delivered', '2026-06-22 03:02:38', '2026-07-29 03:02:38', 'paid', NULL, NULL, NULL),
(6, 9, 100996.00, 0.00, NULL, 'Vikram Singh', '9876553182', 'Station Road, City Center, Building #76', NULL, NULL, 'COD', 'Delivered', '2026-06-18 03:02:38', '2026-07-29 03:02:38', 'paid', NULL, NULL, NULL),
(7, 5, 17999.00, 0.00, NULL, 'Rahul Sharma', '9876548071', 'Station Road, City Center, Building #21', NULL, NULL, 'Razorpay', 'Cancelled', '2026-07-13 03:17:52', '2026-07-29 03:17:52', 'paid', NULL, NULL, NULL),
(8, 6, 19498.00, 499.00, NULL, 'Priya Patel', '9876553781', 'Station Road, City Center, Building #50', NULL, NULL, 'COD', 'Delivered', '2026-06-26 03:17:52', '2026-07-29 03:17:52', 'paid', NULL, NULL, NULL),
(9, 7, 25498.00, 499.00, NULL, 'Amit Verma', '9876536621', 'Station Road, City Center, Building #52', NULL, NULL, 'Razorpay', 'Delivered', '2026-07-05 03:17:52', '2026-07-29 03:17:52', 'paid', NULL, NULL, NULL),
(10, 8, 7998.00, 0.00, NULL, 'Neha Gupta', '9876551600', 'Station Road, City Center, Building #90', NULL, NULL, 'Razorpay', 'Delivered', '2026-07-22 03:17:52', '2026-07-29 03:17:52', 'paid', NULL, NULL, NULL),
(11, 9, 7998.00, 0.00, NULL, 'Vikram Singh', '9876553182', 'Station Road, City Center, Building #76', NULL, NULL, 'Razorpay', 'Delivered', '2026-07-11 03:17:52', '2026-07-29 03:17:52', 'paid', NULL, NULL, NULL),
(12, 5, 123995.00, 0.00, NULL, 'Rahul Sharma', '9876548071', 'Station Road, City Center, Building #21', NULL, NULL, 'Razorpay', 'Created', '2026-06-28 03:30:47', '2026-07-29 03:30:48', 'paid', NULL, NULL, NULL),
(13, 6, 14498.00, 499.00, NULL, 'Priya Patel', '9876553781', 'Station Road, City Center, Building #50', NULL, NULL, 'COD', 'Delivered', '2026-07-16 03:30:48', '2026-07-29 03:30:48', 'paid', NULL, NULL, NULL),
(14, 7, 10498.00, 499.00, NULL, 'Amit Verma', '9876536621', 'Station Road, City Center, Building #52', NULL, NULL, 'COD', 'Created', '2026-06-28 03:30:48', '2026-07-29 03:30:48', 'paid', NULL, NULL, NULL),
(15, 8, 100494.00, 499.00, NULL, 'Neha Gupta', '9876551600', 'Station Road, City Center, Building #90', NULL, NULL, 'COD', 'Delivered', '2026-07-10 03:30:48', '2026-07-29 03:30:48', 'paid', NULL, NULL, NULL),
(16, 9, 18497.00, 499.00, NULL, 'Vikram Singh', '9876553182', 'Station Road, City Center, Building #76', NULL, NULL, 'COD', 'Delivered', '2026-07-03 03:30:48', '2026-07-29 03:30:48', 'paid', NULL, NULL, NULL),
(17, 10, 5699.05, 99.00, NULL, 'Jimmy Patel', '9898321299', 'fghjk', NULL, NULL, 'online', 'Created', '2026-07-29 04:39:20', '2026-07-29 04:39:26', 'paid', 'order_mock_6a69d1503d674', 'pay_mock_9iqbk544w', 'sig_mock_jiq613y5g4q'),
(18, 11, 17099.10, 99.00, NULL, 'jensi patel', '9409064506', 'kjhgfdghj', NULL, NULL, 'cod', 'Created', '2026-07-30 23:35:43', '2026-07-30 23:35:43', 'pending', NULL, NULL, NULL),
(19, 11, 17099.10, 99.00, NULL, 'jensi patel', '9409064506', 'kjhgfdghj', NULL, NULL, 'online', 'Created', '2026-07-30 23:36:03', '2026-07-30 23:36:12', 'paid', 'order_mock_6a6c2d3b12a98', 'pay_mock_7p0j41vyg', 'sig_mock_tk5xkb2d3cc'),
(20, 11, 28049.15, 99.00, NULL, 'jensi patel', '9409064506', 'werg', NULL, NULL, 'online', 'Created', '2026-07-31 00:06:43', '2026-07-31 00:10:04', 'paid', 'order_mock_6a6c346b5f2b2', 'pay_mock_m4s0sw4z2', 'sig_mock_xqfe3dvd43'),
(21, 14, 8999.10, 99.00, NULL, 'jimmi', '6343233634', 'gkl;,ytrfew', NULL, NULL, 'cod', 'Created', '2026-07-31 03:49:02', '2026-07-31 03:49:02', 'pending', NULL, NULL, NULL),
(22, 14, 8999.10, 99.00, NULL, 'jimmi', '6343233634', 'gkl;,ytrfew', NULL, NULL, 'online', 'Created', '2026-07-31 03:49:38', '2026-07-31 03:49:44', 'paid', 'order_mock_6a6c68aa324a9', 'pay_mock_f9hg44tth', 'sig_mock_nchjmr1wdg'),
(23, 13, 22999.08, 99.00, NULL, 'Admin', '6343233634', 'gfbnhjmmjhngbfvdcsaxz', NULL, NULL, 'cod', 'Created', '2026-07-31 03:52:28', '2026-07-31 03:52:28', 'pending', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 18999.00, 18999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(2, 3, 2, 1, 18999.00, 18999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(3, 4, 3, 2, 5999.00, 11998.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(4, 4, 8, 1, 22999.00, 22999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(5, 5, 3, 1, 5999.00, 5999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(6, 5, 4, 1, 12999.00, 12999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(7, 5, 8, 2, 22999.00, 45998.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(8, 6, 5, 2, 34999.00, 69998.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(9, 6, 6, 1, 7999.00, 7999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(10, 6, 8, 1, 22999.00, 22999.00, '2026-07-29 03:02:38', '2026-07-29 03:02:38'),
(11, 7, 25, 1, 17999.00, 17999.00, '2026-07-29 03:17:52', '2026-07-29 03:17:52'),
(12, 8, 18, 1, 18999.00, 18999.00, '2026-07-29 03:17:52', '2026-07-29 03:17:52'),
(13, 9, 55, 1, 24999.00, 24999.00, '2026-07-29 03:17:52', '2026-07-29 03:17:52'),
(14, 10, 9, 2, 3999.00, 7998.00, '2026-07-29 03:17:52', '2026-07-29 03:17:52'),
(15, 11, 9, 2, 3999.00, 7998.00, '2026-07-29 03:17:52', '2026-07-29 03:17:52'),
(16, 12, 25, 1, 17999.00, 17999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(17, 12, 28, 2, 22999.00, 45998.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(18, 12, 88, 2, 29999.00, 59998.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(19, 13, 43, 1, 13999.00, 13999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(20, 14, 133, 1, 9999.00, 9999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(21, 15, 31, 2, 23999.00, 47998.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(22, 15, 122, 2, 17999.00, 35998.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(23, 15, 135, 1, 15999.00, 15999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(24, 16, 40, 1, 5999.00, 5999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(25, 16, 130, 1, 11999.00, 11999.00, '2026-07-29 03:30:48', '2026-07-29 03:30:48'),
(26, 17, 120, 1, 5699.05, 5699.05, '2026-07-29 04:39:20', '2026-07-29 04:39:20'),
(27, 18, 75, 1, 17099.10, 17099.10, '2026-07-30 23:35:43', '2026-07-30 23:35:43'),
(28, 19, 75, 1, 17099.10, 17099.10, '2026-07-30 23:36:03', '2026-07-30 23:36:03'),
(29, 20, 114, 1, 28049.15, 28049.15, '2026-07-31 00:06:43', '2026-07-31 00:06:43'),
(30, 21, 34, 1, 8999.10, 8999.10, '2026-07-31 03:49:02', '2026-07-31 03:49:02'),
(31, 22, 34, 1, 8999.10, 8999.10, '2026-07-31 03:49:38', '2026-07-31 03:49:38'),
(32, 23, 55, 1, 22999.08, 22999.08, '2026-07-31 03:52:28', '2026-07-31 03:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_index` (`category`(191))
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Modern Sofa', 'Sofa', 2599911.00, 'Comfortable modern sofa for living room', 'sofa1.jpg', 'Leather', 'Brown', 10, 5, '2026-05-27 09:38:54', '2026-05-28 06:55:20', NULL),
(2, 'Wooden Bed', 'Bed', 18999.00, 'Stylish wooden king size bed', 'bad1.jpg', 'Wood', 'Walnut', 7, 10, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(3, 'Office Chair', 'Chair', 5999.00, 'Ergonomic office chair with wheels', 'cha1.jpg', 'Mesh', 'Black', 15, 8, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(4, 'Dining Table', 'Table', 12999.00, '6-seater modern dining table', 'ta1.jpg', 'Wood', 'White', 5, 12, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(5, 'Luxury Sofa', 'Sofa', 34999.00, 'Premium luxury sofa set', 'sofa2.jpg', 'Velvet', 'Grey', 4, 15, '2026-05-27 09:38:54', '2026-05-27 09:38:54', NULL),
(6, 'Study Table', 'Table', 7999.00, 'Compact study table for students', 'study.jpg', 'Wood', 'Brown', 12, 5, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(7, 'Classic Chair', 'Chair', 55000.00, 'Classic wooden chair design', 'cha2.jpg', 'Wood', 'Cream', 20, 3, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(8, 'Double Bed', 'Bed', 22999.00, 'Modern double bed with storage', 'bad2.jpg', 'Engineered Wood', 'Brown', 6, 7, '2026-05-27 09:38:54', '2026-07-29 04:57:42', NULL),
(9, 'Classic Wardrobe', 'Wardrobe', 3999.00, 'Classic wooden wardrobe design', 'war2.jpg', 'Wood', 'Cream', 20, 3, '2026-05-27 09:38:54', '2026-05-27 09:38:54', NULL),
(13, 'Modern Sofa Deluxe', 'Sofa', 26999.00, 'Premium deluxe sofa with extra comfort and ergonomic support for modern living rooms.', 'images/sofa.jpg', 'Leather', 'Brown', 9, 5, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(14, 'Luxury Corner Sofa', 'Sofa', 32999.00, 'Stylish L-shaped corner sofa designed for spacious living spaces.', 'images/sofa1.jpg', 'Velvet', 'Grey', 8, 10, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(15, 'Classic Wooden Sofa', 'Sofa', 21999.00, 'Traditional solid wood frame sofa with plush cushions.', 'images/sofa2.jpg', 'Wood', 'Cream', 9, 7, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(16, 'Modern Fabric Sofa', 'Sofa', 24999.00, 'Soft linen fabric sofa with elegant design and durable frame.', 'images/sofa3.jpg', 'Fabric', 'Blue', 12, 6, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(17, 'Royal Leather Sofa', 'Sofa', 39999.00, 'Royal genuine leather sofa set for luxury home interiors.', 'images/sofa4.jpg', 'Leather', 'Black', 13, 15, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(18, 'Compact Apartment Sofa', 'Sofa', 18999.00, 'Space-saving compact sofa perfect for modern studio apartments.', 'images/sofa5.jpg', 'Fabric', 'Green', 20, 4, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(19, 'Designer Velvet Sofa', 'Sofa', 28999.00, 'Modern designer sofa crafted with soft velvet upholstery.', 'images/sofa6.jpg', 'Velvet', 'White', 12, 9, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(20, 'Premium Lounge Sofa', 'Sofa', 35999.00, 'Ultra-comfortable lounge sofa with adjustable headrests.', 'images/sofa10.jpg', 'Leather', 'Tan', 17, 12, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(21, 'Minimalist Sofa Set', 'Sofa', 22999.00, 'Minimalist design sofa set tailored for contemporary interiors.', 'images/sofa8.jpg', 'Fabric', 'Grey', 10, 5, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(22, 'Elegant Family Sofa', 'Sofa', 30999.00, 'Spacious 5-seater family sofa with high density foam cushioning.', 'images/sofa9.jpg', 'Leather', 'Brown', 20, 8, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(23, 'Wooden Bed Deluxe', 'Bed', 19999.00, 'Premium solid wooden bed with smooth walnut polish finish.', 'images/bad1.jpg', 'Wood', 'Walnut', 5, 10, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(24, 'Modern King Size Bed', 'Bed', 25999.00, 'King size wooden bed featuring spacious built-in hydraulic storage.', 'images/bad2.jpg', 'Teak Wood', 'Brown', 7, 12, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(25, 'Classic Wooden Bed', 'Bed', 17999.00, 'Classic handcrafted wooden bed suitable for traditional master bedrooms.', 'images/bad3.jpg', 'Wood', 'Cream', 19, 5, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(26, 'Luxury Velvet Bed Set', 'Bed', 34999.00, 'Luxury bed set featuring a cushioned velvet tufted headboard.', 'images/bad4.jpg', 'Engineered Wood', 'Black', 10, 15, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(27, 'Minimalist Wooden Bed', 'Bed', 16999.00, 'Sleek minimalist wooden bed frame with clean aesthetic lines.', 'images/bad5.jpg', 'Wood', 'White', 16, 6, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(28, 'Storage Hydraulic Bed', 'Bed', 22999.00, 'Wooden bed with heavy-duty hydraulic lifting mechanism.', 'images/bad6.jpg', 'Plywood', 'Brown', 19, 9, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(29, 'Double Bed Premium', 'Bed', 28999.00, 'Premium double bed crafted from 100% natural teak wood.', 'images/bad7.jpg', 'Teak Wood', 'Walnut', 16, 14, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(30, 'Family Size Bed', 'Bed', 31999.00, 'Generous family size bed with robust side support beams.', 'images/bad8.jpg', 'Wood', 'Grey', 9, 11, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(31, 'Elegant Bedroom Bed', 'Bed', 23999.00, 'Elegant bed frame designed for maximum durability and style.', 'images/bad9.jpg', 'Engineered Wood', 'Brown', 19, 8, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(32, 'Royal Solid Wood Bed', 'Bed', 39999.00, 'Royal solid wood king bed with intricate carved details.', 'images/bad10.jpg', 'Solid Wood', 'Dark Brown', 9, 18, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(33, 'Gaming Office Chair', 'Chair', 7999.00, 'Ergonomic gaming & office chair with lumbar support and 360 wheels.', 'images/cha1.jpg', 'Mesh', 'Black', 7, 8, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(34, 'Executive Leather Chair', 'Chair', 9999.00, 'High-back executive leather chair for home office setup.', 'images/cha2.jpg', 'Leather', 'Brown', 14, 10, '2026-07-29 03:17:39', '2026-07-31 03:49:38', NULL),
(35, 'Modern Study Chair', 'Chair', 5499.00, 'Lightweight study chair with comfortable ergonomic backrest.', 'images/cha3.jpg', 'Plastic', 'White', 16, 5, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(36, 'Luxury Office Chair', 'Chair', 11999.00, 'Premium luxury chair with pneumatic height adjustment.', 'images/cha4.jpg', 'Leather', 'Grey', 17, 12, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(37, 'Classic Wooden Chair', 'Chair', 4499.00, 'Handmade wooden chair built with solid Sheesham wood.', 'images/cha5.jpg', 'Wood', 'Brown', 18, 4, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(38, 'Soft Cushion Lounge Chair', 'Chair', 6999.00, 'Cozy lounge chair with extra soft padded cushion.', 'images/cha6.jpg', 'Fabric', 'Blue', 12, 7, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(39, 'Minimalist Accent Chair', 'Chair', 3999.00, 'Modern minimalist accent chair suitable for balconies & cafes.', 'images/cha7.jpg', 'Plastic', 'Black', 19, 3, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(40, 'Premium Dining Chair', 'Chair', 5999.00, 'Elegant wooden dining chair with fabric seat padding.', 'images/cha8.jpg', 'Wood', 'Cream', 6, 6, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(41, 'Computer Mesh Chair', 'Chair', 8499.00, 'Breathable mesh chair with headrest and tilt lock feature.', 'images/cha9.jpg', 'Mesh', 'Red', 13, 9, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(42, 'Royal Velvet Chair', 'Chair', 12999.00, 'Royal velvet armchair with gold-plated metal legs.', 'images/cha10.jpg', 'Velvet', 'Golden', 15, 15, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(43, 'Modern Dining Table', 'Table', 13999.00, '6-seater modern dining table with smooth wooden surface.', 'images/ta1.jpg', 'Wood', 'White', 5, 12, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(44, 'Luxury Teak Dining Table', 'Table', 24999.00, 'Luxury teak wood dining table with elegant gloss finish.', 'images/ta2.jpg', 'Teak Wood', 'Brown', 3, 15, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(45, 'Glass Coffee Table', 'Table', 8999.00, 'Tempered glass top coffee table for living room centers.', 'images/ta3.jpg', 'Glass', 'Black', 8, 7, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(46, 'Office Computer Table', 'Table', 10999.00, 'Computer desk with multi-tier storage shelves & cable hole.', 'images/ta11.jpg', 'Engineered Wood', 'Grey', 6, 9, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(47, 'Minimal Study Table', 'Table', 6999.00, 'Compact study desk ideal for students and work-from-home.', 'images/ta5.jpg', 'Wood', 'White', 10, 5, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(48, 'Round Wooden Dining Table', 'Dining Table', 22999.00, 'Elegant round dining table with central wooden pedestal base.', 'images/dini6.jpg', 'Teak Wood', 'Natural Brown', 20, 9, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(49, 'Classic Walnut Table', 'Table', 11999.00, 'Classic solid wood table with rich walnut stain.', 'images/ta7.jpg', 'Solid Wood', 'Walnut', 7, 6, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(50, 'Premium Office Desk', 'Table', 17999.00, 'Large executive office desk with lockable drawer unit.', 'images/ta8.jpg', 'Engineered Wood', 'Brown', 5, 11, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(51, 'Compact Coffee Table', 'Table', 5999.00, 'Space-saving coffee table with lower utility shelf.', 'images/ta9.jpg', 'Glass', 'White', 12, 4, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(52, 'Royal Dining Table Set', 'Table', 29999.00, 'Royal 8-seater dining table crafted from teak wood.', 'images/ta10.jpg', 'Teak Wood', 'Golden Brown', 2, 18, '2026-07-29 03:17:39', '2026-07-29 03:17:39', NULL),
(53, 'Modern Wardrobe Deluxe', 'Wardrobe', 28999.00, 'Modern 3-door wardrobe with ample hanging & shelf space.', 'images/war1.jpg', 'Wood', 'Brown', 12, 10, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(54, 'Sliding Door Mirror Wardrobe', 'Wardrobe', 35999.00, 'Smooth sliding door wardrobe with integrated full-length mirror.', 'images/war2.jpg', 'Engineered Wood', 'White', 15, 15, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(55, 'Classic Wooden Wardrobe', 'Wardrobe', 24999.00, 'Classic 2-door wooden wardrobe with internal drawers.', 'images/war3.jpg', 'Solid Wood', 'Walnut', 13, 8, '2026-07-29 03:17:39', '2026-07-31 03:52:28', NULL),
(56, 'Luxury Teak Wardrobe', 'Wardrobe', 42999.00, 'Premium teak wood wardrobe designed for luxury master bedrooms.', 'images/war4.jpg', 'Teak Wood', 'Black', 16, 18, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(57, 'Minimal 2-Door Wardrobe', 'Wardrobe', 21999.00, 'Minimalist 2-door wardrobe with key lock security.', 'images/war5.jpg', 'Wood', 'Grey', 18, 5, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(58, 'Full Mirror Storage Wardrobe', 'Wardrobe', 31999.00, 'Spacious wardrobe with full glass mirror panel on doors.', 'images/war6.jpg', 'Engineered Wood', 'Cream', 8, 12, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(59, 'Family Size Wardrobe', 'Wardrobe', 38999.00, 'Large 4-door wardrobe featuring multiple hanging rods and lockers.', 'images/war7.jpg', 'Wood', 'Brown', 11, 14, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(60, 'Premium Closet Wardrobe', 'Wardrobe', 46999.00, 'Walk-in style closet wardrobe with soft-close hinges.', 'images/war8.jpg', 'Solid Wood', 'Dark Brown', 7, 20, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(61, 'Compact Apartment Wardrobe', 'Wardrobe', 19999.00, 'Compact 2-door wardrobe designed for smaller bedrooms.', 'images/war9.jpg', 'Plywood', 'White', 17, 6, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(62, 'Royal 4-Door Wardrobe', 'Wardrobe', 54999.00, 'Grand royal 4-door wardrobe with premium finish and gold handles.', 'images/war10.jpg', 'Teak Wood', 'Golden Brown', 16, 25, '2026-07-29 03:17:39', '2026-07-29 03:30:26', NULL),
(63, 'Modern Coffee Table', 'Table', 7999.00, 'Sleek modern coffee table with smooth wooden finish.', 'images/ta1.jpg', 'Wood', 'White', 10, 5, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(64, 'Luxury Glass Coffee Table', 'Table', 10999.00, 'Tempered glass top coffee table with chrome legs.', 'images/ta2.jpg', 'Glass', 'Black', 8, 10, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(65, 'Classic Center Table', 'Table', 6999.00, 'Classic walnut center table for family living rooms.', 'images/ta3.jpg', 'Solid Wood', 'Walnut', 15, 6, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(66, 'Modular Study Table Desk', 'Table', 8999.00, 'Study table desk with drawers and shelf compartment.', 'images/ta11.jpg', 'Engineered Wood', 'Grey', 11, 8, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(67, 'Minimal Wooden Side Table', 'Table', 4999.00, 'Compact side table ideal for bedroom nightstands.', 'images/ta5.jpg', 'Wood', 'White', 11, 4, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(68, 'Round Living Room Table', 'Table', 9999.00, 'Round center table with solid tripod wooden legs.', 'images/ta6.jpg', 'Wood', 'Cream', 10, 7, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(69, 'Executive Office Desk Table', 'Table', 14999.00, 'Large executive desk table with cable routing.', 'images/ta7.jpg', 'Solid Wood', 'Brown', 16, 12, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(70, 'Designer Accent Table', 'Table', 11999.00, 'Designer accent table with marble pattern top.', 'images/ta8.jpg', 'Teak Wood', 'Golden', 13, 9, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(71, 'Compact Apartment Table', 'Table', 5499.00, 'Compact glass top table suitable for tight spaces.', 'images/ta9.jpg', 'Glass', 'Clear', 20, 5, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(72, 'Royal Teak Table Deluxe', 'Table', 17999.00, 'Royal teak wood table with rich hand polish.', 'images/ta10.jpg', 'Teak Wood', 'Dark Brown', 7, 15, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(73, 'Modern Kitchen Storage Unit', 'Kitchen Cabinet', 15999.00, 'Spacious kitchen cabinet with microwave shelf and multi-storage doors.', 'images/k1.jpg', 'Engineered Wood', 'White & Oak', 18, 8, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(74, 'Modular Kitchen Island Cabinet', 'Kitchen Cabinet', 22999.00, 'Modular kitchen storage island cabinet with countertop space.', 'images/k2.jpg', 'Plywood', 'Grey', 18, 12, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(75, 'Classic Wooden Pantry Cabinet', 'Kitchen Cabinet', 18999.00, 'Tall kitchen pantry storage cabinet with adjustable inner shelves.', 'images/k3.jpg', 'Solid Wood', 'Brown', 8, 10, '2026-07-29 03:30:26', '2026-07-30 23:36:03', NULL),
(76, 'Glass Door Crockery Cabinet', 'Kitchen Cabinet', 19999.00, 'Elegant kitchen crockery cabinet featuring tempered glass showcase doors.', 'images/k4.jpg', 'Glass & Wood', 'Cream', 13, 9, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(77, 'Luxury Kitchen Utility Unit', 'Kitchen Cabinet', 24999.00, 'High-end kitchen utility cabinet with soft close drawers.', 'images/k5.jpg', 'Teak Wood', 'Walnut', 15, 15, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(78, 'Compact Wall Kitchen Cabinet', 'Kitchen Cabinet', 11999.00, 'Wall-mounted compact kitchen storage cabinet for small kitchens.', 'images/k6.jpg', 'Engineered Wood', 'White', 16, 5, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(79, 'Multi-Tier Spice & Utensil Rack', 'Kitchen Cabinet', 13999.00, 'Multi-tier storage rack cabinet for organized kitchen utensils.', 'images/k7.jpg', 'Stainless Steel & Wood', 'Silver & Brown', 17, 7, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(80, 'Royal Kitchen Buffet Hutch', 'Kitchen Cabinet', 29999.00, 'Royal kitchen hutch cabinet with wine rack and drawer storage.', 'images/k8.jpg', 'Solid Wood', 'Mahogany', 17, 18, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(81, 'Minimalist Kitchen Trolley Cabinet', 'Kitchen Cabinet', 9999.00, 'Moveable kitchen trolley cabinet with lockable caster wheels.', 'images/k9.jpg', 'Metal & Wood', 'Black & Natural', 14, 6, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(82, 'Designer Kitchen Crockery Display', 'Kitchen Cabinet', 21999.00, 'Designer crockery display cabinet for modern kitchen dining areas.', 'images/k10.jpg', 'Teak Wood', 'Dark Walnut', 18, 11, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(83, 'Modern 6-Seater Dining Table', 'Dining Table', 24999.00, 'Premium 6-seater dining table set with cushioned chairs.', 'images/dini1.jpg', 'Teak Wood', 'Brown', 18, 10, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(84, 'Luxury Marble Top Dining Table', 'Dining Table', 38999.00, 'Luxury dining table featuring genuine marble top and solid wood legs.', 'images/dini2.jpg', 'Marble & Wood', 'White & Gold', 20, 15, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(85, 'Classic Wooden Dining Table', 'Dining Table', 19999.00, 'Traditional solid wood 4-seater dining table set.', 'images/dini3.jpg', 'Solid Wood', 'Walnut', 10, 8, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(86, 'Glass Top Modern Dining Table', 'Dining Table', 21999.00, 'Contemporary glass top dining table with ergonomic chairs.', 'images/dini4.jpg', 'Glass', 'Black', 10, 12, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(87, 'Compact 4-Seater Dining Set', 'Dining Table', 16999.00, 'Space-saving 4-seater dining table for compact family rooms.', 'images/dini5.jpg', 'Engineered Wood', 'Cream', 11, 6, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(88, 'Designer 6-Piece Dining Table', 'Dining Table', 29999.00, 'Designer 6-piece dining table with bench & cushioned chairs.', 'images/dini7.jpg', 'Wood & Fabric', 'Grey & Walnut', 13, 14, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(89, 'Royal Family Dining Table', 'Dining Table', 45999.00, 'Grand 8-seater family dining table set for formal dining rooms.', 'images/dini8.jpg', 'Solid Wood', 'Dark Walnut', 20, 20, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(90, 'Minimalist Dining Desk Table', 'Dining Table', 14999.00, 'Clean minimalist dining table suitable for modern interiors.', 'images/dini9.jpg', 'Wood', 'White', 8, 5, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(91, 'Executive Dining Table Set', 'Dining Table', 33999.00, 'Executive dining table crafted from selected teak wood.', 'images/dini10.jpg', 'Teak Wood', 'Espresso', 15, 16, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(92, 'Orthopedic Memory Foam Mattress', 'Mattress', 14999.00, 'High density orthopedic memory foam mattress for spine alignment.', 'images/mat1.jpg', 'Memory Foam', 'White', 7, 10, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(93, 'Pocket Spring Luxury Mattress', 'Mattress', 18999.00, 'Zero motion transfer pocket spring mattress with pillow top layer.', 'images/mat2.jpg', 'Pocket Spring', 'Grey & White', 13, 12, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(94, 'Natural Latex Foam Mattress', 'Mattress', 22999.00, '100% natural organic latex mattress for breathable cooling comfort.', 'images/mat3.jpg', 'Natural Latex', 'Cream', 9, 15, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(95, 'Dual Comfort Reversible Mattress', 'Mattress', 11999.00, 'Dual sided mattress with medium soft and medium firm options.', 'images/mat4.jpg', 'PU Foam', 'Blue & White', 11, 7, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(96, 'King Size Extra Plush Mattress', 'Mattress', 25999.00, 'King size plush mattress with multi-layer comfort quilting.', 'images/mat5.jpg', 'Memory Foam & Latex', 'White', 19, 18, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(97, 'Back Support Firm Mattress', 'Mattress', 13999.00, 'Natural bonded coir mattress providing firm spinal support.', 'images/mat6.jpg', 'Coir & Foam', 'Maroon & White', 18, 8, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(98, 'Queen Size Ergonomic Mattress', 'Mattress', 16999.00, 'Queen size ergonomic mattress for pressure point relief.', 'images/mat7.jpg', 'High Resilience Foam', 'White', 16, 11, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(99, 'Hotel Collection Plush Mattress', 'Mattress', 29999.00, '5-star hotel luxury mattress with plush euro top layer.', 'images/mat8.jpg', 'Pocket Spring & Foam', 'White & Gold', 14, 20, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(100, 'Rollable Memory Foam Mattress', 'Mattress', 9999.00, 'Convenient rollable memory foam mattress in a compact box.', 'images/mat9.jpg', 'Memory Foam', 'White', 14, 5, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(101, 'Royal Ortho Care Mattress', 'Mattress', 21999.00, 'Advanced orthopedic care mattress endorsed by spine specialists.', 'images/mat10.jpg', 'Latex & Spring', 'White & Blue', 20, 14, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(102, 'Modern Fabric Sofa Cum Bed', 'Sofa Cum Bed', 18999.00, 'Multi-functional 3-seater sofa that easily converts into a queen bed.', 'images/cum1.jpg', 'Fabric', 'Blue', 9, 10, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(103, 'Folding Wooden Sofa Cum Bed', 'Sofa Cum Bed', 22999.00, 'Solid wooden frame folding sofa cum bed with storage box.', 'images/cum2.jpg', 'Solid Wood', 'Walnut', 16, 12, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(104, 'Luxury Velvet Convertible Sofa Bed', 'Sofa Cum Bed', 26999.00, 'Plush velvet convertible sofa bed with adjustable reclining back.', 'images/cum3.jpg', 'Velvet', 'Grey', 8, 15, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(105, 'Compact Pull-Out Sofa Bed', 'Sofa Cum Bed', 16999.00, 'Smooth pull-out mechanism sofa cum bed for guest rooms.', 'images/cum4.jpg', 'Fabric', 'Brown', 7, 8, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(106, 'L-Shaped Sectional Sofa Cum Bed', 'Sofa Cum Bed', 31999.00, 'Spacious L-shaped sectional sofa with pop-up sleeper bed.', 'images/cum5.jpg', 'Leatherette', 'Black', 20, 18, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(107, 'Minimalist Futon Sofa Bed', 'Sofa Cum Bed', 14999.00, 'Sleek click-clack futon sofa bed for modern living rooms.', 'images/cum6.jpg', 'Metal & Fabric', 'Red', 16, 6, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(108, 'Designer Cushion Sofa Cum Bed', 'Sofa Cum Bed', 24999.00, 'Designer sofa bed with thick removable cushion covers.', 'images/cum7.jpg', 'Fabric', 'Teal', 18, 11, '2026-07-29 03:30:26', '2026-07-29 03:30:26', NULL),
(109, 'Royal Teak Frame Sofa Bed', 'Sofa Cum Bed', 34999.00, 'Handcrafted teak wood sofa cum bed built to last generations.', 'images/cum8.jpg', 'Teak Wood', 'Dark Walnut', 7, 20, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(110, 'Single Seater Chair Sofa Bed', 'Sofa Cum Bed', 11999.00, 'Single seater armchair that unfolds into a comfortable lounger bed.', 'images/cum9.jpg', 'Fabric', 'Yellow', 10, 5, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(111, 'Premium Leatherette Convertible Bed', 'Sofa Cum Bed', 28999.00, 'Premium leatherette sofa bed with armrest cup holders.', 'images/cum10.jpg', 'Leatherette', 'Tan', 13, 14, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(112, 'Executive Office Workstation', 'Office Furniture', 21999.00, 'Spacious executive workstation with drawers & lockable cabinet.', 'images/off1.jpg', 'Engineered Wood', 'Brown & Black', 10, 10, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(113, 'Ergonomic Office Mesh Chair', 'Office Furniture', 7999.00, 'Full mesh office chair with 3D armrests and lumbar support.', 'images/off2.jpg', 'Mesh', 'Black', 8, 8, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(114, 'Conference Room Table 8-Seater', 'Office Furniture', 32999.00, 'Large conference table with integrated power sockets & cable box.', 'images/off3.jpg', 'Wood & Metal', 'Walnut', 17, 15, '2026-07-29 03:30:27', '2026-07-31 00:06:43', NULL),
(115, 'Steel Office Storage Cabinet', 'Office Furniture', 12999.00, 'Heavy-duty steel office filing cabinet with key lock system.', 'images/off4.jpg', 'Steel', 'Grey', 5, 7, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(116, 'Modern Computer Desk Unit', 'Office Furniture', 9999.00, 'Compact computer desk unit with keyboard tray and monitor riser.', 'images/off5.jpg', 'Engineered Wood', 'White', 6, 6, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(117, 'Manager Executive Chair', 'Office Furniture', 11999.00, 'High back manager chair upholstered in genuine leather.', 'images/off6.jpg', 'Leather', 'Brown', 12, 12, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(118, 'Modular Office Partition Desk', 'Office Furniture', 18999.00, 'Dual workstation office desk with privacy divider screen.', 'images/off7.jpg', 'Aluminum & Wood', 'Silver & Blue', 17, 11, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(119, 'Reception Counter Table', 'Office Furniture', 25999.00, 'Professional office reception desk counter with LED accent light.', 'images/off8.jpg', 'Wood & Glass', 'White & Walnut', 7, 14, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(120, 'Mobile Office Drawer Pedestal', 'Office Furniture', 5999.00, '3-drawer mobile under-desk pedestal cabinet with wheels.', 'images/off9.jpg', 'Steel', 'Black', 13, 5, '2026-07-29 03:30:27', '2026-07-29 04:39:20', NULL),
(121, 'Royal Boardroom Table Set', 'Office Furniture', 48999.00, 'Premium 10-seater boardroom table set for executive office suites.', 'images/off10.jpg', 'Teak Wood', 'Dark Walnut', 20, 20, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(122, 'Modern Living Room Display Cabinet', 'Cabinet', 17999.00, 'Modern display cabinet with glass doors and internal LED lighting.', 'c1.jpg', 'Wood & Glass', 'White', 11, 10, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(123, 'Classic Wooden Shoe Cabinet', 'Cabinet', 8999.00, 'Multi-tier wooden shoe rack cabinet with ventilation louvers.', 'c2.jpg', 'Solid Wood', 'Walnut', 5, 8, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(124, 'TV Console Storage Cabinet', 'Cabinet', 14999.00, 'Low profile TV entertainment cabinet with open media shelves.', 'c3.jpg', 'Engineered Wood', 'Brown', 13, 12, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(125, 'Accent Sideboard Cabinet', 'Cabinet', 19999.00, 'Vibrant accent sideboard cabinet with patterned carved doors.', 'c4.jpg', 'Wood', 'Navy Blue', 12, 15, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(126, 'Bookshelf Display Cabinet', 'Cabinet', 12999.00, 'Open bookshelf cabinet for books, trophies and home decor.', 'c5.jpg', 'Wood', 'Cream', 15, 6, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(127, 'Tall Glass Showcase Cabinet', 'Cabinet', 22999.00, 'Tall glass showcase cabinet for collectibles and glassware.', 'cabinet.jpg', 'Glass & Metal', 'Black', 17, 14, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(128, 'Compact Entryway Console Cabinet', 'Cabinet', 10999.00, 'Slim entryway console cabinet with drawers for keys and essentials.', 'cabinet1.jpg', 'Engineered Wood', 'Grey', 15, 7, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(129, 'Royal Bar Cabinet Unit', 'Cabinet', 28999.00, 'Royal wooden bar cabinet unit with glass holder and bottle racks.', 'cabinet2.jpg', 'Teak Wood', 'Dark Walnut', 7, 18, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(130, 'Minimalist Storage Chest Cabinet', 'Cabinet', 11999.00, 'Multi-drawer chest cabinet for bedroom and living room storage.', 'c1.jpg', 'Plywood', 'Natural Wood', 20, 5, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(131, 'Designer Crockery Cabinet Deluxe', 'Cabinet', 25999.00, 'Deluxe crockery cabinet with brass handles and glass doors.', 'c2.jpg', 'Solid Wood', 'Espresso', 13, 16, '2026-07-29 03:30:27', '2026-07-29 05:17:34', NULL),
(132, 'Modern Student Study Table', 'Study Table', 7999.00, 'Ergonomic study table with bookshelves and pull-out drawer.', 'images/study.jpg', 'Wood', 'Brown', 19, 8, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(133, 'Wooden Bookshelf Unit', 'Study Table', 9999.00, '5-tier wooden bookshelf unit for home libraries and offices.', 'images/book.jpg', 'Solid Wood', 'Walnut', 20, 10, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(134, 'Executive Study Desk Table', 'Study Table', 13999.00, 'Spacious study desk with side storage cabinet.', 'images/studydesk.jpg', 'Engineered Wood', 'White & Oak', 11, 12, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(135, 'Tall Library Bookshelf Cabinet', 'Study Table', 15999.00, 'Tall library bookshelf with lower storage doors.', 'images/book1.jpg', 'Wood', 'Dark Brown', 19, 14, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(136, 'Compact Corner Study Table', 'Study Table', 6999.00, 'L-shaped corner study table suitable for small rooms.', 'images/studytable2.jpg', 'Engineered Wood', 'Grey', 19, 6, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(137, 'Modern Open Wall Bookshelf', 'Study Table', 8499.00, 'Industrial style open wall bookshelf with sturdy metal frame.', 'images/book2.jpg', 'Metal & Wood', 'Black & Natural', 14, 7, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(138, 'Height Adjustable Study Table', 'Study Table', 11999.00, 'Ergonomic height adjustable study table for growing children.', 'images/book4.jpg', 'Steel & Wood', 'White', 20, 9, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(139, 'Designer Ladder Bookshelf', 'Study Table', 7499.00, 'Trending ladder style bookshelf for books and planters.', 'images/book5.jpg', 'Wood', 'White', 10, 5, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(140, 'Royal Teak Study Table', 'Study Table', 19999.00, 'Handcrafted royal teak study table with brass lock drawers.', 'images/bookshelf2.jpg', 'Teak Wood', 'Natural Teak', 20, 16, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(141, 'Minimalist Computer Desk', 'Study Table', 6499.00, 'Simple minimalist computer desk with metal leg supports.', 'images/studydesk.jp.jpg', 'Wood', 'Natural', 14, 5, '2026-07-29 03:30:27', '2026-07-29 03:30:27', NULL),
(142, 'chair', 'Chair', 25000.00, 'simple chair', 'storage/products/1LWRdc1oxWDTAcjg1l6WWPfibtFeZXjOeRdRag4j.jpg', 'Engineered Wood', 'Black', 4, 12, '2026-07-31 00:39:43', '2026-07-31 00:40:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_legacy`
--

DROP TABLE IF EXISTS `products_legacy`;
CREATE TABLE IF NOT EXISTS `products_legacy` (
  `original_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `archived_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`original_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'sofa.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(2, 1, 'sofa1.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(3, 1, 'sofa2.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(4, 1, 'sofa3.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(5, 1, 'sofa4.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(6, 1, 'sofa5.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(7, 1, 'sofa6.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(8, 1, 'sofa10.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(9, 1, 'sofa8.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(10, 1, 'sofa9.jpg', 0, 0, '2026-05-27 04:53:23', '2026-05-27 04:53:23'),
(11, 2, 'bad1.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(12, 2, 'bad2.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(13, 2, 'bad3.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(14, 2, 'bad4.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(15, 2, 'bad5.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(16, 2, 'bad6.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(17, 2, 'bad7.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(18, 2, 'bad8.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(19, 2, 'bad9.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(20, 2, 'bad10.jpg', 0, 0, '2026-05-27 05:12:44', '2026-05-27 05:12:44'),
(21, 3, 'cha1.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(22, 3, 'cha2.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(23, 3, 'cha3.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(24, 3, 'cha4.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(25, 3, 'cha5.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(26, 3, 'cha6.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(27, 3, 'cha7.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(28, 3, 'cha8.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(29, 3, 'cha9.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(30, 3, 'cha10.jpg', 0, 0, '2026-05-27 05:15:55', '2026-05-27 05:15:55'),
(31, 4, 'ta1.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(32, 4, 'ta2.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(33, 4, 'ta3.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(34, 4, 'ta11.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(35, 4, 'ta5.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(36, 4, 'ta6.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(37, 4, 'ta7.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(38, 4, 'ta8.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(39, 4, 'ta9.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(40, 4, 'ta10.jpg', 0, 0, '2026-05-27 05:20:31', '2026-05-27 05:20:31'),
(41, 9, 'war1.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(42, 9, 'war2.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(43, 9, 'war3.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(44, 9, 'war4.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(45, 9, 'war5.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(46, 9, 'war6.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(47, 9, 'war7.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(48, 9, 'war8.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(49, 9, 'war9.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(50, 9, 'war10.jpg', 0, 0, '2026-05-27 05:24:51', '2026-05-27 05:24:51'),
(51, 13, 'images/sofa.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(52, 14, 'images/sofa1.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(53, 15, 'images/sofa2.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(54, 16, 'images/sofa3.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(55, 17, 'images/sofa4.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(56, 18, 'images/sofa5.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(57, 19, 'images/sofa6.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(58, 20, 'images/sofa10.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(59, 21, 'images/sofa8.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(60, 22, 'images/sofa9.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(61, 23, 'images/bad1.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(62, 24, 'images/bad2.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(63, 25, 'images/bad3.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(64, 26, 'images/bad4.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(65, 27, 'images/bad5.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(66, 28, 'images/bad6.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(67, 29, 'images/bad7.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(68, 30, 'images/bad8.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(69, 31, 'images/bad9.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(70, 32, 'images/bad10.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(71, 33, 'images/cha1.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(72, 34, 'images/cha2.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(73, 35, 'images/cha3.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(74, 36, 'images/cha4.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(75, 37, 'images/cha5.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(76, 38, 'images/cha6.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(77, 39, 'images/cha7.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(78, 40, 'images/cha8.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(79, 41, 'images/cha9.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(80, 42, 'images/cha10.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(81, 43, 'images/ta1.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(82, 44, 'images/ta2.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(83, 45, 'images/ta3.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(84, 46, 'images/ta11.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(85, 47, 'images/ta5.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(86, 48, 'images/ta6.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(87, 49, 'images/ta7.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(88, 50, 'images/ta8.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(89, 51, 'images/ta9.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(90, 52, 'images/ta10.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(91, 53, 'images/war1.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(92, 54, 'images/war2.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(93, 55, 'images/war3.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(94, 56, 'images/war4.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(95, 57, 'images/war5.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(96, 58, 'images/war6.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(97, 59, 'images/war7.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(98, 60, 'images/war8.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(99, 61, 'images/war9.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(100, 62, 'images/war10.jpg', 0, 1, '2026-07-29 03:17:39', '2026-07-29 03:17:39'),
(101, 63, 'images/ta1.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(102, 64, 'images/ta2.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(103, 65, 'images/ta3.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(104, 66, 'images/ta11.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(105, 67, 'images/ta5.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(106, 68, 'images/ta6.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(107, 69, 'images/ta7.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(108, 70, 'images/ta8.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(109, 71, 'images/ta9.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(110, 72, 'images/ta10.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(111, 73, 'images/k1.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(112, 74, 'images/k2.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(113, 75, 'images/k3.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(114, 76, 'images/k4.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(115, 77, 'images/k5.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(116, 78, 'images/k6.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(117, 79, 'images/k7.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(118, 80, 'images/k8.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(119, 81, 'images/k9.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(120, 82, 'images/k10.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(121, 83, 'images/dini1.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(122, 84, 'images/dini2.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(123, 85, 'images/dini3.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(124, 86, 'images/dini4.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(125, 87, 'images/dini5.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(126, 48, 'images/dini6.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(127, 88, 'images/dini7.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(128, 89, 'images/dini8.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(129, 90, 'images/dini9.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(130, 91, 'images/dini10.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(131, 92, 'images/mat1.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(132, 93, 'images/mat2.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(133, 94, 'images/mat3.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(134, 95, 'images/mat4.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(135, 96, 'images/mat5.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(136, 97, 'images/mat6.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(137, 98, 'images/mat7.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(138, 99, 'images/mat8.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(139, 100, 'images/mat9.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(140, 101, 'images/mat10.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(141, 102, 'images/cum1.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(142, 103, 'images/cum2.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(143, 104, 'images/cum3.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(144, 105, 'images/cum4.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(145, 106, 'images/cum5.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(146, 107, 'images/cum6.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(147, 108, 'images/cum7.jpg', 0, 1, '2026-07-29 03:30:26', '2026-07-29 03:30:26'),
(148, 109, 'images/cum8.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(149, 110, 'images/cum9.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(150, 111, 'images/cum10.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(151, 112, 'images/off1.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(152, 113, 'images/off2.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(153, 114, 'images/off3.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(154, 115, 'images/off4.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(155, 116, 'images/off5.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(156, 117, 'images/off6.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(157, 118, 'images/off7.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(158, 119, 'images/off8.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(159, 120, 'images/off9.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(160, 121, 'images/off10.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(161, 122, 'images/livi1.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(162, 123, 'images/livi2.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(163, 124, 'images/livi3.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(164, 125, 'images/livi4.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(165, 126, 'images/livi5.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(166, 127, 'images/livi6.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(167, 128, 'images/livi7.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(168, 129, 'images/livi8.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(169, 130, 'images/livi9.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(170, 131, 'images/livi10.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(171, 132, 'images/study.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(172, 133, 'images/book.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(173, 134, 'images/studydesk.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(174, 135, 'images/book1.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(175, 136, 'images/studytable2.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(176, 137, 'images/book2.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(177, 138, 'images/book4.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(178, 139, 'images/book5.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(179, 140, 'images/bookshelf2.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(180, 141, 'images/studydesk.jp.jpg', 0, 1, '2026-07-29 03:30:27', '2026-07-29 03:30:27'),
(181, 142, 'storage/products/1LWRdc1oxWDTAcjg1l6WWPfibtFeZXjOeRdRag4j.jpg', 0, 1, '2026-07-31 00:39:43', '2026-07-31 00:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=419 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 4, 'Very good value for money and solid wood build.', '2026-07-02 03:30:46', '2026-07-29 03:30:46'),
(2, 8, 1, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-04 03:30:46', '2026-07-29 03:30:46'),
(3, 9, 1, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-05 03:30:46', '2026-07-29 03:30:46'),
(4, 8, 2, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-26 03:30:46', '2026-07-29 03:30:46'),
(5, 9, 2, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(6, 5, 3, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-02 03:02:38', '2026-07-29 03:02:38'),
(7, 7, 3, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-09 03:17:52', '2026-07-29 03:17:52'),
(8, 9, 3, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-01 03:30:46', '2026-07-29 03:30:46'),
(9, 5, 4, 4, 'Very good value for money and solid wood build.', '2026-07-14 03:30:46', '2026-07-29 03:30:46'),
(10, 8, 4, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-06 03:02:38', '2026-07-29 03:02:38'),
(11, 9, 4, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(12, 5, 5, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-14 03:30:46', '2026-07-29 03:30:46'),
(13, 7, 5, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-20 03:17:52', '2026-07-29 03:17:52'),
(14, 8, 5, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(15, 6, 6, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-20 03:30:46', '2026-07-29 03:30:46'),
(16, 7, 6, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-19 03:30:46', '2026-07-29 03:30:46'),
(17, 5, 7, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(18, 7, 7, 4, 'Very good value for money and solid wood build.', '2026-07-10 03:17:52', '2026-07-29 03:17:52'),
(19, 6, 8, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(20, 9, 8, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-13 03:02:38', '2026-07-29 03:02:38'),
(21, 7, 9, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-24 03:30:46', '2026-07-29 03:30:46'),
(22, 8, 9, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-07 03:30:46', '2026-07-29 03:30:46'),
(23, 9, 9, 4, 'Very good value for money and solid wood build.', '2026-07-15 03:17:52', '2026-07-29 03:17:52'),
(24, 5, 1, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-24 03:17:52', '2026-07-29 03:17:52'),
(25, 6, 2, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-06-29 03:17:52', '2026-07-29 03:17:52'),
(26, 7, 2, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(27, 6, 3, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(28, 8, 3, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-02 03:17:52', '2026-07-29 03:17:52'),
(29, 6, 4, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-21 03:17:52', '2026-07-29 03:17:52'),
(30, 7, 4, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-26 03:17:52', '2026-07-29 03:17:52'),
(31, 6, 5, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-30 03:30:46', '2026-07-29 03:30:46'),
(32, 9, 5, 4, 'Very good value for money and solid wood build.', '2026-07-23 03:17:52', '2026-07-29 03:17:52'),
(33, 9, 6, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(34, 8, 7, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(35, 8, 8, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(36, 6, 9, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-07 03:30:46', '2026-07-29 03:30:46'),
(37, 7, 13, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-25 03:17:52', '2026-07-29 03:17:52'),
(38, 8, 13, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-06-29 03:17:52', '2026-07-29 03:17:52'),
(39, 5, 14, 4, 'Very good value for money and solid wood build.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(40, 7, 14, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-06-30 03:30:46', '2026-07-29 03:30:46'),
(41, 5, 15, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-18 03:17:52', '2026-07-29 03:17:52'),
(42, 8, 15, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-18 03:17:52', '2026-07-29 03:17:52'),
(43, 5, 16, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-04 03:17:52', '2026-07-29 03:17:52'),
(44, 6, 16, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-03 03:17:52', '2026-07-29 03:17:52'),
(45, 7, 16, 4, 'Very good value for money and solid wood build.', '2026-07-16 03:17:52', '2026-07-29 03:17:52'),
(46, 6, 17, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-21 03:17:52', '2026-07-29 03:17:52'),
(47, 7, 17, 4, 'Very good value for money and solid wood build.', '2026-07-06 03:30:46', '2026-07-29 03:30:46'),
(48, 6, 18, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(49, 8, 18, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-08 03:17:52', '2026-07-29 03:17:52'),
(50, 5, 19, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(51, 6, 19, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-27 03:30:46', '2026-07-29 03:30:46'),
(52, 9, 19, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-07 03:17:52', '2026-07-29 03:17:52'),
(53, 5, 20, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-08 03:17:52', '2026-07-29 03:17:52'),
(54, 7, 20, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-08 03:30:46', '2026-07-29 03:30:46'),
(55, 9, 20, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-04 03:30:46', '2026-07-29 03:30:46'),
(56, 6, 21, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(57, 7, 21, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-04 03:17:52', '2026-07-29 03:17:52'),
(58, 8, 21, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-07 03:17:52', '2026-07-29 03:17:52'),
(59, 6, 22, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-04 03:30:46', '2026-07-29 03:30:46'),
(60, 8, 22, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-02 03:30:46', '2026-07-29 03:30:46'),
(61, 5, 23, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-19 03:17:52', '2026-07-29 03:17:52'),
(62, 8, 23, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-13 03:17:52', '2026-07-29 03:17:52'),
(63, 6, 24, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:17:52', '2026-07-29 03:17:52'),
(64, 7, 24, 4, 'Very good value for money and solid wood build.', '2026-07-21 03:30:46', '2026-07-29 03:30:46'),
(65, 7, 25, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(66, 8, 25, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-02 03:30:46', '2026-07-29 03:30:46'),
(67, 9, 25, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:30:46', '2026-07-29 03:30:46'),
(68, 5, 26, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-06 03:17:52', '2026-07-29 03:17:52'),
(69, 7, 26, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(70, 6, 27, 4, 'Very good value for money and solid wood build.', '2026-07-26 03:30:46', '2026-07-29 03:30:46'),
(71, 7, 27, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(72, 5, 28, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-19 03:17:52', '2026-07-29 03:17:52'),
(73, 8, 28, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(74, 5, 29, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-15 03:17:52', '2026-07-29 03:17:52'),
(75, 8, 29, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-01 03:17:52', '2026-07-29 03:17:52'),
(76, 5, 30, 4, 'Very good value for money and solid wood build.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(77, 6, 30, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-28 03:17:52', '2026-07-29 03:17:52'),
(78, 8, 30, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-06 03:17:52', '2026-07-29 03:17:52'),
(79, 6, 31, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(80, 8, 31, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-04 03:17:52', '2026-07-29 03:17:52'),
(81, 5, 32, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-01 03:30:46', '2026-07-29 03:30:46'),
(82, 6, 32, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-20 03:17:52', '2026-07-29 03:17:52'),
(83, 5, 33, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-02 03:17:52', '2026-07-29 03:17:52'),
(84, 6, 33, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-03 03:30:46', '2026-07-29 03:30:46'),
(85, 9, 33, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-30 03:17:52', '2026-07-29 03:17:52'),
(86, 7, 34, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-16 03:17:52', '2026-07-29 03:17:52'),
(87, 8, 34, 4, 'Very good value for money and solid wood build.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(88, 5, 35, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(89, 8, 35, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-14 03:30:46', '2026-07-29 03:30:46'),
(90, 6, 36, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-21 03:30:46', '2026-07-29 03:30:46'),
(91, 8, 36, 4, 'Very good value for money and solid wood build.', '2026-06-30 03:17:52', '2026-07-29 03:17:52'),
(92, 9, 36, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-09 03:17:52', '2026-07-29 03:17:52'),
(93, 7, 37, 4, 'Very good value for money and solid wood build.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(94, 9, 37, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-20 03:17:52', '2026-07-29 03:17:52'),
(95, 6, 38, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:46', '2026-07-29 03:30:46'),
(96, 7, 38, 4, 'Very good value for money and solid wood build.', '2026-07-27 03:17:52', '2026-07-29 03:17:52'),
(97, 6, 39, 4, 'Very good value for money and solid wood build.', '2026-07-01 03:30:46', '2026-07-29 03:30:46'),
(98, 7, 39, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-28 03:30:46', '2026-07-29 03:30:46'),
(99, 6, 40, 4, 'Very good value for money and solid wood build.', '2026-07-08 03:30:46', '2026-07-29 03:30:46'),
(100, 7, 40, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-23 03:17:52', '2026-07-29 03:17:52'),
(101, 8, 41, 4, 'Very good value for money and solid wood build.', '2026-07-11 03:30:46', '2026-07-29 03:30:46'),
(102, 9, 41, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(103, 5, 42, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-09 03:17:52', '2026-07-29 03:17:52'),
(104, 6, 42, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-07 03:17:52', '2026-07-29 03:17:52'),
(105, 8, 42, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-25 03:17:52', '2026-07-29 03:17:52'),
(106, 7, 43, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-17 03:17:52', '2026-07-29 03:17:52'),
(107, 8, 43, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(108, 9, 43, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-18 03:17:52', '2026-07-29 03:17:52'),
(109, 6, 44, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-15 03:17:52', '2026-07-29 03:17:52'),
(110, 7, 44, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:17:52', '2026-07-29 03:17:52'),
(111, 8, 44, 4, 'Very good value for money and solid wood build.', '2026-07-03 03:30:46', '2026-07-29 03:30:46'),
(112, 7, 45, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-25 03:17:52', '2026-07-29 03:17:52'),
(113, 8, 45, 4, 'Very good value for money and solid wood build.', '2026-07-19 03:17:52', '2026-07-29 03:17:52'),
(114, 9, 45, 4, 'Very good value for money and solid wood build.', '2026-07-13 03:30:46', '2026-07-29 03:30:46'),
(115, 5, 46, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-03 03:30:46', '2026-07-29 03:30:46'),
(116, 6, 46, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-11 03:30:46', '2026-07-29 03:30:46'),
(117, 7, 46, 4, 'Very good value for money and solid wood build.', '2026-06-29 03:17:52', '2026-07-29 03:17:52'),
(118, 5, 47, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-19 03:30:46', '2026-07-29 03:30:46'),
(119, 9, 47, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(120, 5, 48, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-10 03:17:52', '2026-07-29 03:17:52'),
(121, 6, 48, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-03 03:30:46', '2026-07-29 03:30:46'),
(122, 7, 48, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:30:46', '2026-07-29 03:30:46'),
(123, 6, 49, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-15 03:17:52', '2026-07-29 03:17:52'),
(124, 9, 49, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(125, 6, 50, 4, 'Very good value for money and solid wood build.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(126, 7, 50, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(127, 8, 50, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-08 03:17:52', '2026-07-29 03:17:52'),
(128, 7, 51, 4, 'Very good value for money and solid wood build.', '2026-07-02 03:17:52', '2026-07-29 03:17:52'),
(129, 8, 51, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(130, 9, 51, 4, 'Very good value for money and solid wood build.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(131, 7, 52, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(132, 8, 52, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(133, 5, 53, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(134, 7, 53, 4, 'Very good value for money and solid wood build.', '2026-07-23 03:17:52', '2026-07-29 03:17:52'),
(135, 5, 54, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(136, 6, 54, 4, 'Great quality product, looks exact like the photos on website.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(137, 8, 54, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-04 03:30:47', '2026-07-29 03:30:47'),
(138, 5, 55, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-04 03:30:47', '2026-07-29 03:30:47'),
(139, 6, 55, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(140, 9, 55, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-18 03:17:52', '2026-07-29 03:17:52'),
(141, 5, 56, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-04 03:17:52', '2026-07-29 03:17:52'),
(142, 7, 56, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-07 03:17:52', '2026-07-29 03:17:52'),
(143, 8, 56, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(144, 5, 57, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(145, 7, 57, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(146, 8, 57, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(147, 5, 58, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-30 03:17:52', '2026-07-29 03:17:52'),
(148, 6, 58, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(149, 9, 58, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-28 03:30:47', '2026-07-29 03:30:47'),
(150, 5, 59, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-02 03:17:52', '2026-07-29 03:17:52'),
(151, 7, 59, 4, 'Very good value for money and solid wood build.', '2026-07-08 03:17:52', '2026-07-29 03:17:52'),
(152, 9, 59, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(153, 6, 60, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-07 03:17:52', '2026-07-29 03:17:52'),
(154, 7, 60, 4, 'Very good value for money and solid wood build.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(155, 8, 60, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-26 03:17:52', '2026-07-29 03:17:52'),
(156, 5, 61, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-04 03:17:52', '2026-07-29 03:17:52'),
(157, 6, 61, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-09 03:17:52', '2026-07-29 03:17:52'),
(158, 6, 62, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(159, 7, 62, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-23 03:17:52', '2026-07-29 03:17:52'),
(160, 8, 62, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-12 03:17:52', '2026-07-29 03:17:52'),
(161, 6, 7, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-28 03:30:46', '2026-07-29 03:30:46'),
(162, 5, 13, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(163, 9, 13, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-30 03:30:46', '2026-07-29 03:30:46'),
(164, 9, 14, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-25 03:30:46', '2026-07-29 03:30:46'),
(165, 6, 15, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:30:46', '2026-07-29 03:30:46'),
(166, 7, 15, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(167, 8, 16, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-14 03:30:46', '2026-07-29 03:30:46'),
(168, 9, 16, 4, 'Very good value for money and solid wood build.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(169, 5, 17, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-06-30 03:30:46', '2026-07-29 03:30:46'),
(170, 9, 17, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(171, 5, 18, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-17 03:30:46', '2026-07-29 03:30:46'),
(172, 7, 18, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-13 03:30:46', '2026-07-29 03:30:46'),
(173, 6, 20, 4, 'Very good value for money and solid wood build.', '2026-07-28 03:30:46', '2026-07-29 03:30:46'),
(174, 5, 21, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-01 03:30:46', '2026-07-29 03:30:46'),
(175, 9, 21, 4, 'Very good value for money and solid wood build.', '2026-07-12 03:30:46', '2026-07-29 03:30:46'),
(176, 5, 22, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(177, 6, 23, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-15 03:30:46', '2026-07-29 03:30:46'),
(178, 7, 23, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-08 03:30:46', '2026-07-29 03:30:46'),
(179, 8, 24, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:46', '2026-07-29 03:30:46'),
(180, 6, 26, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-14 03:30:46', '2026-07-29 03:30:46'),
(181, 9, 27, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(182, 9, 28, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-21 03:30:46', '2026-07-29 03:30:46'),
(183, 6, 29, 4, 'Great quality product, looks exact like the photos on website.', '2026-06-29 03:30:46', '2026-07-29 03:30:46'),
(184, 7, 29, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-25 03:30:46', '2026-07-29 03:30:46'),
(185, 9, 29, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-12 03:30:46', '2026-07-29 03:30:46'),
(186, 7, 30, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(187, 9, 30, 4, 'Very good value for money and solid wood build.', '2026-07-17 03:30:46', '2026-07-29 03:30:46'),
(188, 5, 31, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-16 03:30:46', '2026-07-29 03:30:46'),
(189, 9, 31, 4, 'Great quality product, looks exact like the photos on website.', '2026-06-29 03:30:46', '2026-07-29 03:30:46'),
(190, 8, 32, 4, 'Very good value for money and solid wood build.', '2026-07-17 03:30:46', '2026-07-29 03:30:46'),
(191, 8, 33, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-27 03:30:46', '2026-07-29 03:30:46'),
(192, 5, 34, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-05 03:30:46', '2026-07-29 03:30:46'),
(193, 9, 34, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:46', '2026-07-29 03:30:46'),
(194, 6, 35, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-18 03:30:46', '2026-07-29 03:30:46'),
(195, 5, 36, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-24 03:30:46', '2026-07-29 03:30:46'),
(196, 5, 37, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-25 03:30:46', '2026-07-29 03:30:46'),
(197, 8, 37, 4, 'Very good value for money and solid wood build.', '2026-07-19 03:30:46', '2026-07-29 03:30:46'),
(198, 5, 38, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:46', '2026-07-29 03:30:46'),
(199, 9, 38, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:46', '2026-07-29 03:30:46'),
(200, 9, 39, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-03 03:30:46', '2026-07-29 03:30:46'),
(201, 8, 40, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-26 03:30:46', '2026-07-29 03:30:46'),
(202, 9, 40, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-07 03:30:46', '2026-07-29 03:30:46'),
(203, 6, 41, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(204, 7, 42, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-25 03:30:46', '2026-07-29 03:30:46'),
(205, 9, 42, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-07 03:30:46', '2026-07-29 03:30:46'),
(206, 5, 43, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(207, 6, 43, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-30 03:30:46', '2026-07-29 03:30:46'),
(208, 9, 44, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-08 03:30:46', '2026-07-29 03:30:46'),
(209, 5, 45, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-09 03:30:46', '2026-07-29 03:30:46'),
(210, 6, 45, 4, 'Very good value for money and solid wood build.', '2026-07-22 03:30:46', '2026-07-29 03:30:46'),
(211, 9, 46, 4, 'Very good value for money and solid wood build.', '2026-07-23 03:30:46', '2026-07-29 03:30:46'),
(212, 8, 47, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-29 03:30:46', '2026-07-29 03:30:46'),
(213, 9, 48, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(214, 5, 49, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(215, 7, 49, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(216, 5, 51, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(217, 8, 53, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-05 03:30:47', '2026-07-29 03:30:47'),
(218, 9, 53, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(219, 9, 56, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(220, 7, 58, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(221, 6, 59, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(222, 5, 60, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(223, 9, 60, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(224, 7, 61, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(225, 8, 61, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(226, 9, 62, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(227, 7, 63, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(228, 9, 63, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(229, 7, 64, 4, 'Very good value for money and solid wood build.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(230, 8, 64, 4, 'Very good value for money and solid wood build.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(231, 9, 64, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-13 03:30:47', '2026-07-29 03:30:47'),
(232, 8, 65, 4, 'Very good value for money and solid wood build.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(233, 9, 65, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(234, 6, 66, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(235, 7, 66, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(236, 9, 66, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(237, 6, 67, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(238, 7, 67, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(239, 8, 67, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(240, 6, 68, 4, 'Very good value for money and solid wood build.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(241, 9, 68, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(242, 5, 69, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(243, 7, 69, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-28 03:30:47', '2026-07-29 03:30:47'),
(244, 9, 69, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(245, 5, 70, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(246, 6, 70, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(247, 7, 70, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(248, 6, 71, 4, 'Very good value for money and solid wood build.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(249, 8, 71, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(250, 9, 71, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(251, 5, 72, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(252, 8, 72, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(253, 9, 72, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(254, 8, 73, 4, 'Very good value for money and solid wood build.', '2026-07-04 03:30:47', '2026-07-29 03:30:47'),
(255, 9, 73, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(256, 6, 74, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(257, 8, 74, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(258, 5, 75, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(259, 9, 75, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(260, 5, 76, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-28 03:30:47', '2026-07-29 03:30:47'),
(261, 6, 76, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(262, 8, 76, 4, 'Very good value for money and solid wood build.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(263, 5, 77, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(264, 6, 77, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(265, 7, 77, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(266, 5, 78, 4, 'Very good value for money and solid wood build.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(267, 8, 78, 4, 'Very good value for money and solid wood build.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(268, 9, 78, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(269, 6, 79, 4, 'Very good value for money and solid wood build.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(270, 7, 79, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(271, 5, 80, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(272, 9, 80, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(273, 8, 81, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(274, 9, 81, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-13 03:30:47', '2026-07-29 03:30:47'),
(275, 5, 82, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(276, 6, 82, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(277, 6, 83, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(278, 8, 83, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(279, 6, 84, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(280, 7, 84, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(281, 5, 85, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(282, 8, 85, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(283, 9, 85, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(284, 6, 86, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(285, 7, 86, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(286, 9, 86, 4, 'Very good value for money and solid wood build.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(287, 5, 87, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(288, 8, 87, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(289, 6, 88, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-01 03:30:47', '2026-07-29 03:30:47'),
(290, 7, 88, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-26 03:30:47', '2026-07-29 03:30:47'),
(291, 7, 89, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-13 03:30:47', '2026-07-29 03:30:47'),
(292, 8, 89, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(293, 5, 90, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(294, 6, 90, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(295, 5, 91, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(296, 6, 91, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(297, 7, 91, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-04 03:30:47', '2026-07-29 03:30:47'),
(298, 6, 92, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(299, 7, 92, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(300, 8, 92, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(301, 5, 93, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-04 03:30:47', '2026-07-29 03:30:47'),
(302, 8, 93, 4, 'Very good value for money and solid wood build.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(303, 9, 93, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(304, 6, 94, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(305, 7, 94, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(306, 9, 94, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(307, 5, 95, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(308, 6, 95, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(309, 9, 95, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(310, 6, 96, 4, 'Very good value for money and solid wood build.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(311, 9, 96, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(312, 8, 97, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(313, 9, 97, 4, 'Very good value for money and solid wood build.', '2026-07-13 03:30:47', '2026-07-29 03:30:47'),
(314, 5, 98, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(315, 7, 98, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(316, 6, 99, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(317, 7, 99, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(318, 9, 99, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(319, 7, 100, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(320, 8, 100, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(321, 9, 100, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(322, 7, 101, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(323, 8, 101, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(324, 9, 101, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(325, 6, 102, 4, 'Very good value for money and solid wood build.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(326, 8, 102, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(327, 8, 103, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(328, 9, 103, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(329, 6, 104, 4, 'Very good value for money and solid wood build.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(330, 7, 104, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(331, 5, 105, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(332, 9, 105, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-13 03:30:47', '2026-07-29 03:30:47'),
(333, 5, 106, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(334, 8, 106, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(335, 5, 107, 4, 'Very good value for money and solid wood build.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(336, 6, 107, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-01 03:30:47', '2026-07-29 03:30:47'),
(337, 9, 107, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(338, 8, 108, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(339, 9, 108, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(340, 5, 109, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(341, 7, 109, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-05 03:30:47', '2026-07-29 03:30:47'),
(342, 9, 109, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(343, 5, 110, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-28 03:30:47', '2026-07-29 03:30:47'),
(344, 7, 110, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(345, 6, 111, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(346, 8, 111, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(347, 6, 112, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-01 03:30:47', '2026-07-29 03:30:47'),
(348, 8, 112, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(349, 6, 113, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-28 03:30:47', '2026-07-29 03:30:47'),
(350, 7, 113, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(351, 9, 113, 4, 'Very good value for money and solid wood build.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(352, 5, 114, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(353, 7, 114, 4, 'Very good value for money and solid wood build.', '2026-07-26 03:30:47', '2026-07-29 03:30:47'),
(354, 9, 114, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-26 03:30:47', '2026-07-29 03:30:47'),
(355, 5, 115, 4, 'Very good value for money and solid wood build.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(356, 7, 115, 4, 'Very good value for money and solid wood build.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(357, 9, 115, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(358, 7, 116, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(359, 9, 116, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(360, 5, 117, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(361, 6, 117, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(362, 6, 118, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(363, 7, 118, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(364, 8, 119, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-11 03:30:47', '2026-07-29 03:30:47'),
(365, 9, 119, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(366, 5, 120, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(367, 7, 120, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(368, 8, 121, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(369, 9, 121, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(370, 6, 122, 4, 'Very good value for money and solid wood build.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(371, 8, 122, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(372, 9, 122, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(373, 5, 123, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(374, 7, 123, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-26 03:30:47', '2026-07-29 03:30:47'),
(375, 9, 123, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(376, 8, 124, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-01 03:30:47', '2026-07-29 03:30:47'),
(377, 9, 124, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-01 03:30:47', '2026-07-29 03:30:47'),
(378, 7, 125, 4, 'Very good value for money and solid wood build.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(379, 9, 125, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(380, 5, 126, 4, 'Very good value for money and solid wood build.', '2026-07-17 03:30:47', '2026-07-29 03:30:47'),
(381, 9, 126, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(382, 6, 127, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-08 03:30:47', '2026-07-29 03:30:47'),
(383, 8, 127, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(384, 5, 128, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(385, 7, 128, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-06-30 03:30:47', '2026-07-29 03:30:47'),
(386, 8, 128, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(387, 5, 129, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-05 03:30:47', '2026-07-29 03:30:47'),
(388, 6, 129, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-10 03:30:47', '2026-07-29 03:30:47'),
(389, 9, 129, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(390, 5, 130, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-06 03:30:47', '2026-07-29 03:30:47'),
(391, 9, 130, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-18 03:30:47', '2026-07-29 03:30:47'),
(392, 7, 131, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(393, 8, 131, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(394, 5, 132, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-27 03:30:47', '2026-07-29 03:30:47'),
(395, 7, 132, 4, 'Very good value for money and solid wood build.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(396, 8, 132, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-08 03:30:47', '2026-07-29 03:30:47');
INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(397, 6, 133, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(398, 9, 133, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(399, 5, 134, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(400, 9, 134, 5, 'Super comfortable, looks very luxurious and delivery was fast.', '2026-07-16 03:30:47', '2026-07-29 03:30:47'),
(401, 5, 135, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-25 03:30:47', '2026-07-29 03:30:47'),
(402, 6, 135, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(403, 6, 136, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-02 03:30:47', '2026-07-29 03:30:47'),
(404, 8, 136, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-09 03:30:47', '2026-07-29 03:30:47'),
(405, 9, 136, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-03 03:30:47', '2026-07-29 03:30:47'),
(406, 7, 137, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-14 03:30:47', '2026-07-29 03:30:47'),
(407, 8, 137, 4, 'Very good value for money and solid wood build.', '2026-07-12 03:30:47', '2026-07-29 03:30:47'),
(408, 5, 138, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-15 03:30:47', '2026-07-29 03:30:47'),
(409, 6, 138, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-07 03:30:47', '2026-07-29 03:30:47'),
(410, 8, 138, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-05 03:30:47', '2026-07-29 03:30:47'),
(411, 6, 139, 5, 'Best furniture purchase ever! Highly recommended for modern homes.', '2026-07-20 03:30:47', '2026-07-29 03:30:47'),
(412, 8, 139, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-19 03:30:47', '2026-07-29 03:30:47'),
(413, 5, 140, 4, 'Comfortable seating and smooth delivery experience.', '2026-06-29 03:30:47', '2026-07-29 03:30:47'),
(414, 7, 140, 5, 'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.', '2026-07-22 03:30:47', '2026-07-29 03:30:47'),
(415, 8, 140, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-24 03:30:47', '2026-07-29 03:30:47'),
(416, 5, 141, 5, 'Extremely satisfied with the build quality and premium finish.', '2026-07-21 03:30:47', '2026-07-29 03:30:47'),
(417, 6, 141, 4, 'Comfortable seating and smooth delivery experience.', '2026-07-23 03:30:47', '2026-07-29 03:30:47'),
(418, 7, 141, 4, 'Great quality product, looks exact like the photos on website.', '2026-07-24 03:30:47', '2026-07-29 03:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0LUlpbrbwZPxvFd62kzR0KnvYw2apkB91n7l2SBR', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmtXQkR5RERrNW83YzhDa1hNRnJwbjAwZW1hZ1ozU0U2NEVJWElVUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1780029958);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_photo`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status`, `last_login`, `deleted_at`) VALUES
(14, 'jimmi', 'jimmipatel10@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$6wREoNBGZflkPe8o1bP3dubdBvttwsV5Kx6vnMZyKnmZu7.F51uTK', NULL, '2026-07-31 03:46:01', '2026-07-31 03:46:01', 'user', 'active', NULL, NULL),
(11, 'jensi patel', 'pateljensi2012@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$20loqMSu8UqBwf2CCGOqI.5K2kWoqVKzrijTOM9WNneXwnf7RSDnC', NULL, '2026-07-30 23:30:19', '2026-07-31 01:10:17', 'admin', 'active', NULL, NULL),
(13, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$mYZmok4aFDwZSFbK6Dgn3enN4UzLKt0Z60CADIiOntxzvm0elfleK', NULL, '2026-07-31 00:25:27', '2026-07-31 00:25:27', 'admin', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlist_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 10, 110, 1, '2026-07-29 04:40:28', '2026-07-29 04:40:28'),
(2, 10, 111, 1, '2026-07-29 04:40:31', '2026-07-29 04:40:31'),
(3, 11, 76, 1, '2026-07-31 00:10:26', '2026-07-31 00:10:26'),
(4, 11, 75, 1, '2026-07-31 00:10:35', '2026-07-31 00:10:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
