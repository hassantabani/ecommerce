-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 04:42 PM
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
-- Database: `hopeui`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_11_09_064224_create_user_profiles_table', 1),
(5, '2021_11_11_110731_create_permission_tables', 1),
(6, '2021_11_16_114009_create_media_table', 1),
(7, '2025_03_11_175748_create_products_table', 2),
(8, '2025_04_14_091604_create_orders_table', 3),
(9, '2025_04_14_100508_create_shipping_methods_table', 4),
(10, '2025_04_15_090517_create_q_rcodes_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_fname` varchar(255) DEFAULT NULL,
  `customer_lname` varchar(255) DEFAULT NULL,
  `customer_number` varchar(255) DEFAULT NULL,
  `customer_address1` longtext DEFAULT NULL,
  `customer_address2` longtext DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `customer_city` varchar(255) DEFAULT NULL,
  `customer_province` varchar(255) DEFAULT NULL,
  `customer_country` varchar(255) DEFAULT NULL,
  `extra_customer_details` longtext DEFAULT NULL,
  `shipping_gateway` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `extra_shipping_details` longtext DEFAULT NULL,
  `shipping_cost` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `total_items` varchar(255) DEFAULT NULL,
  `qrcode_id` varchar(255) DEFAULT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cart_items`)),
  `user_profit` varchar(255) DEFAULT NULL,
  `admin_cost` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_fname`, `customer_lname`, `customer_number`, `customer_address1`, `customer_address2`, `postal_code`, `customer_city`, `customer_province`, `customer_country`, `extra_customer_details`, `shipping_gateway`, `payment_method`, `extra_shipping_details`, `shipping_cost`, `total_price`, `total_items`, `qrcode_id`, `cart_items`, `user_profit`, `admin_cost`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:08:32', '2025-04-14 08:08:32'),
(2, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:51:50', '2025-04-14 08:51:50'),
(3, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:54:48', '2025-04-14 08:54:48'),
(4, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:57:57', '2025-04-14 08:57:57'),
(5, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:58:02', '2025-04-14 08:58:02'),
(6, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 08:58:07', '2025-04-14 08:58:07'),
(7, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:06:30', '2025-04-14 09:06:30'),
(8, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:20:06', '2025-04-14 09:20:06'),
(9, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:20:15', '2025-04-14 09:20:15'),
(10, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:38:23', '2025-04-14 09:38:23'),
(11, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:38:28', '2025-04-14 09:38:28'),
(12, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:39:13', '2025-04-14 09:39:13'),
(13, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:39:17', '2025-04-14 09:39:17'),
(14, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:43:11', '2025-04-14 09:43:11'),
(15, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:47:18', '2025-04-14 09:47:18'),
(16, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', NULL, '250', '3350', '1', NULL, '[{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"1500\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1500', '1600', 'pending', '1', '2025-04-14 09:48:31', '2025-04-14 09:48:31'),
(17, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', 'okay', '250', '3850', '1', NULL, '[{\"product_name\":\"Rolex Clock\",\"product_id\":1,\"price\":1500,\"quantity\":\"2\",\"profit\":\"600\",\"image\":\"storage\\/main_image\\/67f50140ae36e.jpg\"}]', '600', '3000', 'pending', '1', '2025-04-15 04:19:12', '2025-04-15 04:19:12'),
(18, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', 'okay', '250', '3850', '1', '1', '[{\"product_name\":\"Rolex Clock\",\"product_id\":1,\"price\":1500,\"quantity\":\"2\",\"profit\":\"600\",\"image\":\"storage\\/main_image\\/67f50140ae36e.jpg\"}]', '600', '3000', 'pending', '1', '2025-04-15 04:19:34', '2025-04-15 04:19:35'),
(19, 'Hassan', 'Tabani', '03360381966', 'Karachi', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'nothing', 'FedEx', 'COD', 'okay', '250', '3850', '1', '2', '[{\"product_name\":\"Rolex Clock\",\"product_id\":1,\"price\":1500,\"quantity\":\"2\",\"profit\":\"600\",\"image\":\"storage\\/main_image\\/67f50140ae36e.jpg\"}]', '600', '3000', 'pending', '1', '2025-04-15 04:21:32', '2025-04-15 04:21:33'),
(20, 'New', 'Customer', '03322545455', 'AR Avennue, flat 302 , 4 Minaar Chorangi, Bahadrabad', '2', '74500', 'Karachi', 'Sindh', 'Pakistan', 'Rider Must call to customer when reach to customer location', 'FedEx', 'COD', NULL, '250', '4750', '2', '3', '[{\"product_name\":\"Rolex Clock\",\"product_id\":1,\"price\":1500,\"quantity\":\"1\",\"profit\":\"600\",\"image\":\"storage\\/main_image\\/67f50140ae36e.jpg\"},{\"product_name\":\"Metal Handmade Vintage Motor Bike\",\"product_id\":2,\"price\":800,\"quantity\":\"2\",\"profit\":\"800\",\"image\":\"storage\\/main_image\\/67f507bee14cd.jpg\"}]', '1400', '3100', 'pending', '3', '2025-04-17 09:35:56', '2025-04-18 07:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `title`, `guard_name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'role', 'Role', 'web', NULL, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(2, 'role-add', 'Role Add', 'web', 1, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(3, 'role-list', 'Role List', 'web', 1, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(4, 'permission', 'Permission', 'web', NULL, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(5, 'permission-add', 'Permission Add', 'web', 4, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(6, 'permission-list', 'Permission List', 'web', 4, '2025-03-10 14:46:46', '2025-03-10 14:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `points` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`points`)),
  `stock` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `purchase_price` varchar(255) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `is_sale` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `attribute` enum('1','0') NOT NULL,
  `category` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `more_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `points`, `stock`, `price`, `purchase_price`, `discount`, `is_sale`, `status`, `attribute`, `category`, `main_image`, `more_media`, `created_at`, `updated_at`) VALUES
(1, 'Rolex Clock', 'Rolex Metal Wall Watch', '[\"Wall clock\",\"Metallic Body\",\"4 Colors\",\"Imported\"]', '49', '1500', '1000', NULL, '0', '1', '1', 'Electronics', 'storage/main_image/67f50140ae36e.jpg', '[\"storage\\/more_image\\/67f5014139e8b.jpg\",\"storage\\/more_image\\/67f501413a3a0.jpg\",\"storage\\/more_image\\/67f501413a77c.jpg\"]', '2025-04-08 05:58:09', '2025-04-17 09:35:56'),
(2, 'Metal Handmade Vintage Motor Bike', 'Metal Handmade Vintage Motor Bike', '[\"Metallic Body\",\"Vintage\",\"New\",\"Imported\"]', '98', '800', '500', NULL, '0', '1', '0', 'Sports', 'storage/main_image/67f507bee14cd.jpg', '[\"storage\\/more_image\\/67f507bee33b1.jpg\",\"storage\\/more_image\\/67f507bee3ba8.jpg\",\"storage\\/more_image\\/67f507bee421b.jpg\"]', '2025-04-08 06:25:50', '2025-04-17 09:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `q_rcodes`
--

CREATE TABLE `q_rcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `q_rcodes`
--

INSERT INTO `q_rcodes` (`id`, `order_id`, `image`, `tracking_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '18', 'storage/qrcodes/order_18.png', NULL, '1', '2025-04-15 04:19:35', '2025-04-15 04:19:35'),
(2, '19', 'storage/qrcodes/order_19.png', NULL, '1', '2025-04-15 04:21:33', '2025-04-15 04:21:33'),
(3, '20', 'storage/qrcodes/order_20.png', NULL, '3', '2025-04-17 09:35:57', '2025-04-17 09:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `guard_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'web', 1, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(2, 'demo_admin', 'Demo Admin', 'web', 1, '2025-03-10 14:46:46', '2025-03-10 14:46:46'),
(3, 'user', 'User', 'web', 1, '2025-03-10 14:46:47', '2025-03-10 14:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `api_id` varchar(255) DEFAULT NULL,
  `charges` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `api_id`, `charges`, `created_at`, `updated_at`) VALUES
(1, 'DHL', '1', '250', '2025-04-14 10:08:07', '2025-04-14 10:08:07'),
(2, 'FedEx', '2', '250', '2025-04-14 10:08:07', '2025-04-14 10:08:07'),
(3, 'TCS', '3', '250', '2025-04-14 10:08:40', '2025-04-14 10:08:40'),
(4, 'Leopards', '4', '250', '2025-04-14 10:08:40', '2025-04-14 10:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone_number`, `email_verified_at`, `user_type`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'systemadmin', 'System', 'Admin', 'admin@example.com', '+12398190255', '2025-03-10 14:46:47', 'admin', '$2y$10$WwMaPlkI7LVzPK0MmKyhaOhknSxPjv3KvPKavdk2ObvLfmnhxF3Gm', 'active', NULL, '2025-03-10 14:46:47', '2025-03-10 14:46:47'),
(2, 'demoadmin', 'Demo', 'Admin', 'demo@example.com', '+12398190255', '2025-03-10 14:46:47', 'demo_admin', '$2y$10$s8JAki7SNqOuvXxDqzuOYexh5T05jPKr.QVFfsUIK0B4Six6SA6ty', 'pending', NULL, '2025-03-10 14:46:47', '2025-03-10 14:46:47'),
(3, 'user', 'John', 'User', 'user@example.com', '+12398190255', '2025-03-10 14:46:47', 'user', '$2y$10$Y9vbtn5AtXO2JctGcU8vyO8ohqUYqf3Dr1fYm6Bi4TmqEzSD0cxiW', 'inactive', NULL, '2025-03-10 14:46:47', '2025-03-10 14:46:47'),
(4, 'wainostreich', 'Waino', 'Streich', 'mona.jerde@example.com', '+1 (321) 350-6086', '2025-03-10 14:46:47', 'user', '$2y$10$ORJU.6KZyjdYdPY30R9mqOSDIB2O9C3l7ZtIDSS6YLVwBWD59LV0u', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(5, 'abelwiza', 'Abel', 'Wiza', 'seth.hoeger@example.com', '+1-346-247-3479', '2025-03-10 14:46:47', 'user', '$2y$10$u7uvdILG30.9wRU2H86FcuQvVikEEg/HM4o9IMVi12oshC.bCWN4.', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(6, 'hayleymoen', 'Hayley', 'Moen', 'wolf.winfield@example.org', '1-603-636-6906', '2025-03-10 14:46:47', 'user', '$2y$10$KwhBq2tRYpPjAk0gjhM1Lur2JuWM7.LKc1ve/DebSvNNQM4atg212', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(7, 'aureliadonnelly', 'Aurelia', 'Donnelly', 'rick.hettinger@example.org', '+1-216-973-1024', '2025-03-10 14:46:47', 'user', '$2y$10$bMe0es6bjzYP6gT2J3FGae9LoGk5nUV.YxMMrNUT5XVrAvSIBYqui', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(8, 'marlenehauck', 'Marlene', 'Hauck', 'astrid.kassulke@example.net', '+1.484.208.4566', '2025-03-10 14:46:47', 'user', '$2y$10$t2uRByvAr2gt4mh6JvxHjeMl5TsQW7pINXAMWVT9ISOtQxPxMFNom', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(9, 'sigridkessler', 'Sigrid', 'Kessler', 'misty93@example.org', '+1 (248) 555-5208', '2025-03-10 14:46:47', 'user', '$2y$10$K/5rZSsoQVXUUnalC.E3aOh3oGeybO4RXxFr7yaZ8ofWEbm3uHeYu', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(10, 'nannieo\'connell', 'Nannie', 'O\'Connell', 'smuller@example.org', '580.475.0178', '2025-03-10 14:46:47', 'user', '$2y$10$LjsoIQihUh4YI1XWVflmmOeWB7pi2RDn8NyLcuqwTGLKPs.C/3zhu', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(11, 'armandohoeger', 'Armando', 'Hoeger', 'elmer.cruickshank@example.org', '754-369-2492', '2025-03-10 14:46:47', 'user', '$2y$10$E2vRPw9wOS5jBQSyVlTfAuHnqPteKNU4nBVM0v3Dz./NYDEYPnFM2', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(12, 'heathrempel', 'Heath', 'Rempel', 'alverta98@example.org', '+1-217-459-4592', '2025-03-10 14:46:47', 'user', '$2y$10$EGxVEZCNX1U6QNZf0D8J5.6m/LAU5xkpsB3sJUD7nlRE.lpGye1ya', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(13, 'turnerhand', 'Turner', 'Hand', 'ubotsford@example.net', '1-458-387-8400', '2025-03-10 14:46:47', 'user', '$2y$10$3wC.BlzJKbFq6w2xIyGqmeMvEPO/OMVx7X03wtPOnW49P75RxeUoy', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(14, 'bellquigley', 'Bell', 'Quigley', 'nannie.emard@example.org', '+1-740-671-7180', '2025-03-10 14:46:47', 'user', '$2y$10$7/RXHzhWMIZ3CgMIHOzrXOLEcVoWwdxYtVAhBp6OZSihqJT9r5oL2', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(15, 'elliottcollier', 'Elliott', 'Collier', 'larson.jeanette@example.org', '+1-561-554-8908', '2025-03-10 14:46:47', 'user', '$2y$10$qZt1fSrNQVNwiqRY0yrT4eXllUo.suShaQzh0wxA6Ep42PPM.gIlG', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(16, 'cletusjohnston', 'Cletus', 'Johnston', 'ewalter@example.com', '573.417.6033', '2025-03-10 14:46:47', 'user', '$2y$10$k5n.4dLbVdQBCpNQoTGKUuGFF/KcDwnaF9.r4XbKCdfEVl3XFLSq2', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(17, 'quinnwehner', 'Quinn', 'Wehner', 'cleta.daugherty@example.com', '1-530-795-9794', '2025-03-10 14:46:47', 'user', '$2y$10$YcVn4lUt6FVrSsKiGGR32eH3RsqUH6pXGIBNaNYJ89Onoea1SlSZi', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(18, 'gregsanford', 'Greg', 'Sanford', 'zsporer@example.net', '1-689-808-9825', '2025-03-10 14:46:47', 'user', '$2y$10$l8koeZnqXyWmPhZ.BMJMZ.j8DZooFyYzVwuZSMsjCx0Qu.mHC/5.K', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(19, 'yvonnelabadie', 'Yvonne', 'Labadie', 'everardo77@example.com', '1-720-596-6269', '2025-03-10 14:46:47', 'user', '$2y$10$P5aVUXyiRadhcW1Ve.65Xe4rIl31qgeu6Wrok7kIUrE3VFHCCXtYy', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(20, 'abbigailking', 'Abbigail', 'King', 'brown.lemuel@example.net', '(570) 367-2654', '2025-03-10 14:46:47', 'user', '$2y$10$U5Em7CjHryq0ANmnZz7uYeIN2fz1ZJRocKizBdrRl883jk3bx4I/6', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(21, 'cloydhackett', 'Cloyd', 'Hackett', 'ryundt@example.com', '(518) 597-0514', '2025-03-10 14:46:48', 'user', '$2y$10$A9MMZ7My.YFn3N1Al1KTzedA/ZaJSe3vlVYpGby7n.vFX7v/CgiyC', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(22, 'gladysgutkowski', 'Gladys', 'Gutkowski', 'owatsica@example.com', '+1.712.624.3544', '2025-03-10 14:46:48', 'user', '$2y$10$DHQEhlWFUmtRCoMDN3saAOvR58gw3iyTdqOKieqg5terlTVFYRrRq', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(23, 'loycelesch', 'Loyce', 'Lesch', 'bbogan@example.org', '(364) 294-1340', '2025-03-10 14:46:48', 'user', '$2y$10$vj2X6K7VUzz59PJo3pAiO.TSvic7YCInqjk7wxbnvS0jgYvxemRvu', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(24, 'maevespencer', 'Maeve', 'Spencer', 'brekke.korbin@example.net', '1-254-638-8621', '2025-03-10 14:46:48', 'user', '$2y$10$1rcCITKSPWNtV7oYwuQ42eCq3OH1ERScnwVY5d3SYYnfDIly/4Wfm', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(25, 'fionabauch', 'Fiona', 'Bauch', 'cassin.micaela@example.org', '678.643.4680', '2025-03-10 14:46:48', 'user', '$2y$10$ez3oYnEVD1nkz7vg8/zhu.onVPm0f5KK6iK/RE58tRSS2Wzbv0RKK', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(26, 'adahpowlowski', 'Adah', 'Powlowski', 'shayes@example.com', '+1-501-524-4344', '2025-03-10 14:46:48', 'user', '$2y$10$jcBKUegpqOvL5kQHrP/t3uO.N2axubVmHYB4gdxvgavTaAy58iaTS', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(27, 'lisawisoky', 'Lisa', 'Wisoky', 'kelvin12@example.org', '726.557.5473', '2025-03-10 14:46:48', 'user', '$2y$10$gT4oVd1wCgJUyLpDI.sMrOGnrRdZN0kr9HxAgvw61RhXjq21yaX3G', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(28, 'karliesmitham', 'Karlie', 'Smitham', 'elinor.wolff@example.org', '805-690-4018', '2025-03-10 14:46:48', 'user', '$2y$10$y3aleu1ZIdHOLnFJgkUD4eCGPj6R4xK9..hd9FA1vUyaWv8GtIaBa', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(29, 'arnulforomaguera', 'Arnulfo', 'Romaguera', 'rahsaan.ryan@example.org', '386-662-5053', '2025-03-10 14:46:48', 'user', '$2y$10$Novnoam6k2VajQ6n18tAYeXP7f5j727rwizk6vyFxW.fCaakvUuii', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(30, 'margaretfarrell', 'Margaret', 'Farrell', 'ucormier@example.com', '+14586509719', '2025-03-10 14:46:48', 'user', '$2y$10$SE2MYncCUuXSgjKGr3qwT.Zm6bVme9MrAXXlsp9na8FNlVZzELXMe', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(31, 'ralphbins', 'Ralph', 'Bins', 'xrippin@example.org', '1-762-319-9926', '2025-03-10 14:46:48', 'user', '$2y$10$SEkijvwGtvQdeAx16UFQYeK4Qggi8pGCme4WHT7PZgKZCphW8NcD.', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(32, 'brookcollins', 'Brook', 'Collins', 'stanton.lenny@example.net', '+19208629915', '2025-03-10 14:46:48', 'user', '$2y$10$w1omgoNZV1Iika47SNO...Tq8LBXa9/zqzR4vLH9BUwuUG6LqxE6S', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(33, 'gerhardharber', 'Gerhard', 'Harber', 'allene.predovic@example.com', '914-980-4975', '2025-03-10 14:46:48', 'user', '$2y$10$z38pOWzDxWGD4BghwC8n6uwGpa0zYf36dfRgbEgPk1gwZ2eaHdC.y', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(34, 'melissahessel', 'Melissa', 'Hessel', 'chelsea.jacobs@example.com', '(678) 412-9887', '2025-03-10 14:46:48', 'user', '$2y$10$bCuEe/JJqbmLh04iydf3sOoNa9lk/Rz9aLxmENlzIsCzgjStBKLSq', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(35, 'cassieschneider', 'Cassie', 'Schneider', 'stephany25@example.net', '+16788514326', '2025-03-10 14:46:48', 'user', '$2y$10$5z6t5yIr7/expQZ8YSG89Oqi8WP6o11v1cBA1Cnfxm9SUB6BmPM6m', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(36, 'ephraimpadberg', 'Ephraim', 'Padberg', 'retha.kiehn@example.com', '+1 (351) 658-4115', '2025-03-10 14:46:48', 'user', '$2y$10$PPbBz2MZgqCSMvPz7gtIAeNiXczp8r.VEHOw6OgRD4fQAv8F41lzW', 'inactive', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(37, 'obiesauer', 'Obie', 'Sauer', 'pattie.sipes@example.org', '1-779-798-7025', '2025-03-10 14:46:48', 'user', '$2y$10$MU9HRCxaJ5AibAVHj4dYHO0pXgjzancR6sIMls8IDqZXsI1vtbIkS', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(38, 'mariannagreenfelder', 'Marianna', 'Greenfelder', 'alek.casper@example.com', '283-745-8502', '2025-03-10 14:46:48', 'user', '$2y$10$HkRRhUVWeQJW9RWhC3rZSu.AxzjsqXtA22wT0yu9ksVnSTpeYijCi', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(39, 'marilouskiles', 'Marilou', 'Skiles', 'yhowell@example.net', '301-875-9169', '2025-03-10 14:46:48', 'user', '$2y$10$vfvzE3uw/yE2p9cRacF4DOJnORUULGHIZDU/PX4KCysHFY4gDzB1S', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(40, 'kieracarter', 'Kiera', 'Carter', 'kpfeffer@example.org', '820.575.7836', '2025-03-10 14:46:48', 'user', '$2y$10$MwKMybYloJgbR6ILXH7BuudrzsWfwmZMsKsr07etUeeFMuKEPgDuy', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(41, 'rubenleannon', 'Ruben', 'Leannon', 'hilma.rogahn@example.com', '843.241.0425', '2025-03-10 14:46:49', 'user', '$2y$10$MDIy8pYZKpiX.iZ4mSKRC.CI/loTUuCDnvtdBwMDGht2umbV9v5uG', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(42, 'fidelquitzon', 'Fidel', 'Quitzon', 'rjohns@example.net', '859.202.3432', '2025-03-10 14:46:49', 'user', '$2y$10$FVJTBiO6fcg4lOR/vtwcWOtcenX2LkwPza0gYoF1QreaLZTuQ4FXi', 'active', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(43, 'bradfordkshlerin', 'Bradford', 'Kshlerin', 'schimmel.annabel@example.com', '+1-281-719-4906', '2025-03-10 14:46:49', 'user', '$2y$10$AlayLSYkTF9TT1bV4LUchOAEhPVpllk3sEWVc3QVsoQIR.mi0Y4Qi', 'pending', NULL, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(44, 'scanner', 'scanner', 'user', 'scanner@gmail.com', NULL, '2025-03-10 14:46:49', 'scanner', '$2y$10$WwMaPlkI7LVzPK0MmKyhaOhknSxPjv3KvPKavdk2ObvLfmnhxF3Gm', 'active', NULL, '2025-04-18 12:55:18', '2025-04-18 12:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `street_addr_1` varchar(255) DEFAULT NULL,
  `street_addr_2` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `alt_phone_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pin_code` bigint(20) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `linkdin_url` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `company_name`, `street_addr_1`, `street_addr_2`, `phone_number`, `alt_phone_number`, `country`, `state`, `city`, `pin_code`, `facebook_url`, `instagram_url`, `twitter_url`, `linkdin_url`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'recusandae rem', NULL, NULL, NULL, NULL, 'Mali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(2, 'autem eligendi', NULL, NULL, NULL, NULL, 'Jordan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(3, 'aut quia', NULL, NULL, NULL, NULL, 'Angola', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(4, 'rerum veniam', NULL, NULL, NULL, NULL, 'Dominica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(5, 'sint temporibus', NULL, NULL, NULL, NULL, 'Tajikistan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(6, 'et repudiandae', NULL, NULL, NULL, NULL, 'Antigua and Barbuda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(7, 'nesciunt nihil', NULL, NULL, NULL, NULL, 'Tonga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(8, 'officiis mollitia', NULL, NULL, NULL, NULL, 'Tajikistan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(9, 'ratione vel', NULL, NULL, NULL, NULL, 'Montenegro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(10, 'rerum ratione', NULL, NULL, NULL, NULL, 'Portugal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(11, 'et quidem', NULL, NULL, NULL, NULL, 'Macao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(12, 'alias tempora', NULL, NULL, NULL, NULL, 'Guinea-Bissau', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(13, 'accusamus neque', NULL, NULL, NULL, NULL, 'Bulgaria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(14, 'autem et', NULL, NULL, NULL, NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(15, 'temporibus accusamus', NULL, NULL, NULL, NULL, 'Palau', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(16, 'aliquid quo', NULL, NULL, NULL, NULL, 'Pakistan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(17, 'corporis saepe', NULL, NULL, NULL, NULL, 'Guinea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(18, 'quibusdam est', NULL, NULL, NULL, NULL, 'Svalbard & Jan Mayen Islands', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(19, 'neque provident', NULL, NULL, NULL, NULL, 'Sudan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(20, 'nobis voluptatem', NULL, NULL, NULL, NULL, 'Italy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(21, 'minus veniam', NULL, NULL, NULL, NULL, 'Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(22, 'nisi tempora', NULL, NULL, NULL, NULL, 'Ireland', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(23, 'consequatur dignissimos', NULL, NULL, NULL, NULL, 'Marshall Islands', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(24, 'molestias tempora', NULL, NULL, NULL, NULL, 'Malawi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(25, 'porro iusto', NULL, NULL, NULL, NULL, 'South Africa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(26, 'sed minima', NULL, NULL, NULL, NULL, 'Bosnia and Herzegovina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(27, 'omnis commodi', NULL, NULL, NULL, NULL, 'Ghana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(28, 'dolore rem', NULL, NULL, NULL, NULL, 'Latvia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(29, 'ut delectus', NULL, NULL, NULL, NULL, 'Kiribati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(30, 'est omnis', NULL, NULL, NULL, NULL, 'Botswana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(31, 'vero sunt', NULL, NULL, NULL, NULL, 'Lesotho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(32, 'et possimus', NULL, NULL, NULL, NULL, 'Uganda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(33, 'recusandae neque', NULL, NULL, NULL, NULL, 'Romania', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(34, 'molestiae est', NULL, NULL, NULL, NULL, 'Lebanon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(35, 'magnam facere', NULL, NULL, NULL, NULL, 'Costa Rica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(36, 'aliquid optio', NULL, NULL, NULL, NULL, 'Taiwan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(37, 'voluptatem dolores', NULL, NULL, NULL, NULL, 'Saint Lucia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(38, 'quis veniam', NULL, NULL, NULL, NULL, 'Saint Lucia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(39, 'officiis eligendi', NULL, NULL, NULL, NULL, 'Ukraine', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(40, 'ullam tempora', NULL, NULL, NULL, NULL, 'Papua New Guinea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(41, 'quia nihil', NULL, NULL, NULL, NULL, 'Mayotte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(42, 'autem corrupti', NULL, NULL, NULL, NULL, 'Korea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, '2025-03-10 14:46:49', '2025-03-10 14:46:49'),
(43, 'veritatis quis', NULL, NULL, NULL, NULL, 'New Zealand', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, '2025-03-10 14:46:49', '2025-03-10 14:46:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `q_rcodes`
--
ALTER TABLE `q_rcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `q_rcodes`
--
ALTER TABLE `q_rcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
