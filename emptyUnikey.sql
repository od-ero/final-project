-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 11:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unikey`
--

-- --------------------------------------------------------

--
-- Table structure for table `doors`
--

CREATE TABLE `doors` (
  `id` int(10) UNSIGNED NOT NULL,
  `door_name` varchar(255) DEFAULT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_ips`
--

CREATE TABLE `door_ips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `door_id` int(10) UNSIGNED NOT NULL,
  `device_serial_number` varchar(255) DEFAULT NULL,
  `door_ip_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_schedules`
--

CREATE TABLE `door_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `door_schedule_permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_schedule_counters`
--

CREATE TABLE `door_schedule_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `door_schedule_door_id` int(10) UNSIGNED NOT NULL,
  `open_in` int(11) DEFAULT NULL,
  `close_in` int(11) DEFAULT NULL,
  `open_out` int(11) DEFAULT NULL,
  `close_out` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_schedule_doors`
--

CREATE TABLE `door_schedule_doors` (
  `id` int(10) UNSIGNED NOT NULL,
  `door_schedule_id` int(10) UNSIGNED NOT NULL,
  `door_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_schedule_permissions`
--

CREATE TABLE `door_schedule_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `open_in` varchar(255) DEFAULT NULL,
  `close_in` varchar(255) DEFAULT NULL,
  `open_out` varchar(255) DEFAULT NULL,
  `close_out` varchar(255) DEFAULT NULL,
  `open_in_fre` varchar(255) DEFAULT NULL,
  `close_in_fre` varchar(255) DEFAULT NULL,
  `open_out_fre` varchar(255) DEFAULT NULL,
  `close_out_fre` varchar(255) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_statuses`
--

CREATE TABLE `door_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `door_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_setter` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door_status_setters`
--

CREATE TABLE `door_status_setters` (
  `id` int(10) UNSIGNED NOT NULL,
  `door_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `door_schedule_id` int(10) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `my_permission_id` int(10) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `kenyas`
--

CREATE TABLE `kenyas` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2024_01_16_084102_create_kenyas_table', 2),
(11, '2024_01_16_093935_create_units_table', 3),
(12, '2024_01_16_094010_create_roles_table', 3),
(13, '2024_01_16_094011_create_my_units_table', 3),
(14, '2024_01_16_095022_create_door_statuses_table', 4),
(15, '2024_01_16_095118_create_door_status_setters_table', 5),
(16, '2024_01_16_100059_create_door_sechedule_permissions_table', 5),
(17, '2024_01_16_100060_create_door_sechedules_table', 5),
(18, '2024_01_16_100130_create_door_sechedule_counters_table', 5),
(19, '2024_01_16_100131_create_permissions_table', 5),
(20, '2024_01_16_100132_create_my_permissions_table', 5),
(21, '2024_01_16_134859_create_my_permission_counters_table', 5),
(22, '2024_01_16_134861_create_roles_table', 6),
(23, '2024_01_16_134866_create_roles_table', 7),
(24, '2024_01_16_134867_create_my_units_table', 7),
(25, '2024_01_28_015147_create_my_permission_doors_table', 8),
(26, '2024_01_28_021140_create_my_permission_doors_table', 9),
(27, '2024_02_01_122524_create_door_schedule_permissions_table', 10),
(28, '2024_02_01_123930_create_door_schedules_table', 10),
(29, '2024_02_01_125648_create_door_schedule_doors_table', 11),
(30, '2024_02_02_130859_create_my_permissions_table', 12),
(31, '2024_02_02_133100_my_permissions', 13),
(32, '2024_02_02_133227_create_my_permissions_table', 13),
(33, '2024_02_20_130011_create_door_schedule_counters_table', 14),
(34, '2024_02_22_125734_create_door_ips_table', 15),
(35, '2024_04_11_201629_door_ips', 16),
(36, '2024_04_15_205727_create_user_types_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `my_permissions`
--

CREATE TABLE `my_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `permission_group_id` int(10) UNSIGNED NOT NULL,
  `permissioner_id` int(10) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `my_permission_counters`
--

CREATE TABLE `my_permission_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `my_permission_id` int(10) UNSIGNED NOT NULL,
  `door_id` int(11) NOT NULL,
  `give_permission` int(11) DEFAULT 0,
  `open` int(11) NOT NULL DEFAULT 0,
  `close` int(11) NOT NULL DEFAULT 0,
  `schedule` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_permission_counters`
--

INSERT INTO `my_permission_counters` (`id`, `my_permission_id`, `door_id`, `give_permission`, `open`, `close`, `schedule`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 17, 9, 0, 0, 0, 0, '2024-03-28 19:43:55', '2024-03-28 19:43:55', NULL),
(29, 18, 10, 0, 0, 0, 0, '2024-03-28 19:47:08', '2024-03-28 19:47:08', NULL),
(31, 20, 22, 0, 0, 0, 0, '2024-03-31 18:28:00', '2024-03-31 18:28:00', NULL),
(32, 24, 26, 0, 0, 0, 0, '2024-03-31 18:55:58', '2024-03-31 18:55:58', NULL),
(33, 25, 27, 0, 0, 0, 0, '2024-03-31 19:06:26', '2024-03-31 19:06:26', NULL),
(34, 25, 28, 0, 0, 0, 0, '2024-03-31 19:06:26', '2024-03-31 19:06:26', NULL),
(35, 26, 29, 0, 0, 0, 0, '2024-04-01 14:21:38', '2024-04-01 14:21:38', NULL),
(36, 27, 30, 0, 0, 0, 0, '2024-04-01 16:45:17', '2024-04-01 16:45:17', NULL),
(37, 28, 31, 0, 0, 0, 0, '2024-04-01 20:19:40', '2024-04-01 20:19:40', NULL),
(38, 28, 32, 0, 0, 0, 0, '2024-04-01 20:19:40', '2024-04-01 20:19:40', NULL),
(39, 29, 33, 0, 0, 0, 0, '2024-04-01 20:22:19', '2024-04-01 20:22:19', NULL),
(40, 30, 34, 0, 18, 18, 4, '2024-04-02 11:49:19', '2024-04-17 19:31:54', NULL),
(41, 30, 35, 0, 7, 7, 3, '2024-04-02 11:49:19', '2024-04-17 20:08:33', NULL),
(42, 31, 36, 2, 3, 2, 4, '2024-04-17 20:29:49', '2024-04-18 08:49:50', NULL),
(43, 32, 36, 0, 0, 0, 0, '2024-04-17 22:49:48', '2024-04-17 22:49:48', NULL),
(44, 33, 36, 0, 0, 1, 0, '2024-04-18 07:23:58', '2024-04-18 08:48:54', NULL),
(45, 35, 37, 0, 2, 2, 1, '2024-04-18 08:53:40', '2024-04-18 10:47:39', NULL),
(46, 46, 38, 0, 0, 0, 0, '2024-04-18 19:06:07', '2024-04-18 19:06:07', NULL),
(47, 46, 39, 0, 0, 0, 0, '2024-04-18 19:06:07', '2024-04-18 19:06:07', NULL),
(48, 47, 40, 0, 0, 0, 0, '2024-04-18 19:08:35', '2024-04-18 19:08:35', NULL),
(49, 47, 41, 0, 0, 0, 0, '2024-04-18 19:08:35', '2024-04-18 19:08:35', NULL),
(50, 47, 42, 0, 0, 0, 0, '2024-04-18 19:08:35', '2024-04-18 19:08:35', NULL),
(51, 47, 43, 0, 0, 0, 0, '2024-04-18 19:08:35', '2024-04-18 19:08:35', NULL),
(52, 48, 44, 0, 0, 0, 0, '2024-04-18 19:23:26', '2024-04-18 19:23:26', NULL),
(53, 48, 45, 0, 0, 0, 0, '2024-04-18 19:23:26', '2024-04-18 19:23:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `my_permission_doors`
--

CREATE TABLE `my_permission_doors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `door_id` int(10) UNSIGNED NOT NULL,
  `my_permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_permission_doors`
--

INSERT INTO `my_permission_doors` (`id`, `door_id`, `my_permission_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 9, 13, '2024-03-04 09:18:23', '2024-03-04 09:18:23', NULL),
(31, 10, 13, '2024-03-04 09:18:24', '2024-03-04 09:18:24', NULL),
(32, 9, 14, '2024-03-04 09:19:31', '2024-03-04 09:19:31', NULL),
(33, 10, 14, '2024-03-04 09:19:31', '2024-03-04 09:19:31', NULL),
(34, 9, 15, '2024-03-14 08:24:21', '2024-03-14 08:24:21', NULL),
(35, 10, 15, '2024-03-14 08:24:22', '2024-03-14 08:24:22', NULL),
(36, 9, 16, '2024-03-14 08:26:19', '2024-03-14 08:26:19', NULL),
(37, 10, 16, '2024-03-14 08:26:19', '2024-03-14 08:26:19', NULL),
(38, 9, 17, '2024-03-28 19:43:55', '2024-03-28 19:43:55', NULL),
(39, 10, 18, '2024-03-28 19:47:08', '2024-03-28 19:47:08', NULL),
(41, 22, 20, '2024-03-31 18:28:00', '2024-03-31 18:28:00', NULL),
(42, 26, 24, '2024-03-31 18:55:58', '2024-03-31 18:55:58', NULL),
(43, 27, 25, '2024-03-31 19:06:26', '2024-03-31 19:06:26', NULL),
(44, 28, 25, '2024-03-31 19:06:26', '2024-03-31 19:06:26', NULL),
(45, 29, 26, '2024-04-01 14:21:38', '2024-04-01 14:21:38', NULL),
(46, 30, 27, '2024-04-01 16:45:17', '2024-04-02 10:54:20', '2024-04-02 10:54:20'),
(47, 31, 28, '2024-04-01 20:19:40', '2024-04-01 20:19:40', NULL),
(48, 32, 28, '2024-04-01 20:19:40', '2024-04-01 20:19:40', NULL),
(49, 33, 29, '2024-04-01 20:22:19', '2024-04-01 20:22:19', NULL),
(50, 34, 30, '2024-04-02 11:49:19', '2024-04-18 19:21:20', '2024-04-18 19:21:20'),
(51, 35, 30, '2024-04-02 11:49:19', '2024-04-18 19:21:20', '2024-04-18 19:21:20'),
(53, 9, 1, '2024-04-06 17:55:22', '2024-04-06 17:55:58', '2024-04-06 17:55:58'),
(54, 10, 1, '2024-04-06 17:55:22', '2024-04-06 17:55:58', '2024-04-06 17:55:58'),
(55, 10, 1, '2024-04-06 17:55:58', '2024-04-06 17:56:29', '2024-04-06 17:56:29'),
(56, 10, 1, '2024-04-06 17:56:29', '2024-04-13 15:11:36', '2024-04-13 15:11:36'),
(57, 9, 8, '2024-04-06 17:57:32', '2024-04-06 17:57:32', NULL),
(58, 36, 31, '2024-04-17 20:29:49', '2024-04-17 20:29:49', NULL),
(59, 36, 32, '2024-04-17 22:49:48', '2024-04-17 22:54:18', '2024-04-17 22:54:18'),
(60, 36, 32, '2024-04-17 22:54:18', '2024-04-17 22:54:27', '2024-04-17 22:54:27'),
(61, 36, 33, '2024-04-18 07:23:58', '2024-04-18 07:23:58', NULL),
(62, 37, 35, '2024-04-18 08:53:40', '2024-04-18 19:21:03', '2024-04-18 19:21:03'),
(63, 38, 46, '2024-04-18 19:06:07', '2024-04-18 19:20:54', '2024-04-18 19:20:54'),
(64, 39, 46, '2024-04-18 19:06:07', '2024-04-18 19:20:54', '2024-04-18 19:20:54'),
(65, 40, 47, '2024-04-18 19:08:35', '2024-04-18 19:22:22', '2024-04-18 19:22:22'),
(66, 41, 47, '2024-04-18 19:08:35', '2024-04-18 19:22:22', '2024-04-18 19:22:22'),
(67, 42, 47, '2024-04-18 19:08:35', '2024-04-18 19:22:22', '2024-04-18 19:22:22'),
(68, 43, 47, '2024-04-18 19:08:35', '2024-04-18 19:22:22', '2024-04-18 19:22:22'),
(69, 44, 48, '2024-04-18 19:23:26', '2024-04-18 19:23:26', NULL),
(70, 45, 48, '2024-04-18 19:23:26', '2024-04-18 19:23:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `my_units`
--

CREATE TABLE `my_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL DEFAULT '2024-01-16',
  `end_date` date NOT NULL DEFAULT '2024-01-16',
  `permissioner_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('671de475ddec35d3a87cc7112f9af5bd69b0f2d67756d7942051043ad337343d36c4e9052133eb8e', 3, 3, 'appToken', '[]', 0, '2023-12-20 12:20:10', '2023-12-20 12:20:11', '2024-12-20 15:20:10'),
('b3452c2d7a0020e6f3a92f35dc068139012e6a9c273ec94b614fe72426b31024f8532a7d029e0e65', 4, 3, 'appToken', '[]', 0, '2024-01-18 08:43:47', '2024-01-18 08:43:47', '2025-01-18 11:43:47'),
('d1751c2a75bb8454e51c26641c4979d69ddb82c0c4d277883aac563c99b679128774e06d77a52a12', 3, 3, 'appToken', '[]', 0, '2023-12-20 12:37:16', '2023-12-20 12:37:17', '2024-12-20 15:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 't9laAvXYTmjg4tNuz0GE9YTu3uu5xvHKR5zZb8Ii', NULL, 'http://localhost', 1, 0, 0, '2023-12-18 15:40:21', '2023-12-18 15:40:21'),
(2, NULL, 'Laravel Password Grant Client', 'rPATxodszKLMgaJszdU8dOX6GhPv6GDWGlCLq0aR', 'users', 'http://localhost', 0, 1, 0, '2023-12-18 15:40:21', '2023-12-18 15:40:21'),
(3, NULL, 'Laravel Personal Access Client', 'sh8CUJGoGNpPU3kT6S1WNzlV7DlNJkzlcPyEvoXD', NULL, 'http://localhost', 1, 0, 0, '2023-12-18 18:42:35', '2023-12-18 18:42:35'),
(4, NULL, 'Laravel Password Grant Client', 'ZS1DBRZKbpt3WYnEJdQb0gnGtzhj8S1XPuwmPJCt', 'users', 'http://localhost', 0, 1, 0, '2023-12-18 18:42:35', '2023-12-18 18:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-12-18 15:40:21', '2023-12-18 15:40:21'),
(2, 3, '2023-12-18 18:42:35', '2023-12-18 18:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_group_id` int(10) UNSIGNED NOT NULL,
  `give_permission` varchar(255) DEFAULT NULL,
  `open` varchar(255) DEFAULT NULL,
  `close` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) DEFAULT NULL,
  `give_permission_fre` int(11) NOT NULL,
  `open_fre` int(11) NOT NULL,
  `close_fre` int(11) NOT NULL,
  `schedule_fre` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_group_id`, `give_permission`, `open`, `close`, `schedule`, `give_permission_fre`, `open_fre`, `close_fre`, `schedule_fre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'yes', 'yes', 'yes', 'yes', 100000, 100000, 100000, 100000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `creator_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'House Owners', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nomal User', NULL, NULL, NULL),
(2, 'Admin', NULL, NULL, NULL),
(3, 'Super Admin', NULL, NULL, NULL),
(4, 'Systerm Owner', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `premises_name` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `google_location` varchar(255) DEFAULT NULL,
  `doors` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'unikey', 'web', '111111', 'unikey.web@admin.unikey.odero.ke', 3, '2023-12-18 22:33:16', 'www', 'wwww', '2023-12-18 22:33:16', '2023-12-18 22:33:16', NULL),
(2, 'Unikey Button', 'Access In', '2222', 'button.in@admin.unikey.odero.ke\r\n', 3, NULL, 'wqwew', NULL, NULL, NULL, NULL),
(3, 'Unikey Button', 'Access Out', '333333', 'button.out@admin.unikey.ke', 3, NULL, '$2y$12$3LMPBkm7okKDIB/0LjrQGOyvisqoAEWJTyU6chzDf3wHA9GfTYvhW', NULL, '2023-12-20 12:20:08', '2023-12-20 12:20:08', NULL),
(4, 'Chief', 'Admin', '444444', 'chiefadmin@admin.unikey.odero.ke', 4, NULL, '$2y$12$3LMPBkm7okKDIB/0LjrQGOyvisqoAEWJTyU6chzDf3wHA9GfTYvhW', NULL, '2024-01-18 08:43:46', '2024-01-18 08:43:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doors`
--
ALTER TABLE `doors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `door_ips`
--
ALTER TABLE `door_ips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `door_ips_ip_address_unique` (`ip_address`),
  ADD UNIQUE KEY `door_ips_device_serial_number_unique` (`device_serial_number`),
  ADD KEY `door_ips_door_id_foreign` (`door_id`);

--
-- Indexes for table `door_schedules`
--
ALTER TABLE `door_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_schedules_user_id_foreign` (`user_id`),
  ADD KEY `door_schedules_door_schedule_permission_id_foreign` (`door_schedule_permission_id`);

--
-- Indexes for table `door_schedule_counters`
--
ALTER TABLE `door_schedule_counters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_schedule_counters_door_schedule_door_id_foreign` (`door_schedule_door_id`);

--
-- Indexes for table `door_schedule_doors`
--
ALTER TABLE `door_schedule_doors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_schedule_doors_door_schedule_id_foreign` (`door_schedule_id`),
  ADD KEY `door_schedule_doors_door_id_foreign` (`door_id`);

--
-- Indexes for table `door_schedule_permissions`
--
ALTER TABLE `door_schedule_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_schedule_permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `door_statuses`
--
ALTER TABLE `door_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_statuses_door_id_foreign` (`door_id`);

--
-- Indexes for table `door_status_setters`
--
ALTER TABLE `door_status_setters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `door_status_setters_door_id_foreign` (`door_id`),
  ADD KEY `door_status_setters_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kenyas`
--
ALTER TABLE `kenyas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_permissions`
--
ALTER TABLE `my_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_permissions_user_id_foreign` (`user_id`),
  ADD KEY `my_permissions_unit_id_foreign` (`unit_id`),
  ADD KEY `my_permissions_permission_group_id_foreign` (`permission_group_id`),
  ADD KEY `my_permissions_permissioner_id_foreign` (`permissioner_id`);

--
-- Indexes for table `my_permission_counters`
--
ALTER TABLE `my_permission_counters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_permission_counters_my_permission_id_foreign` (`my_permission_id`);

--
-- Indexes for table `my_permission_doors`
--
ALTER TABLE `my_permission_doors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_permission_doors_door_id_foreign` (`door_id`),
  ADD KEY `my_permission_doors_my_permission_id_foreign` (`my_permission_id`);

--
-- Indexes for table `my_units`
--
ALTER TABLE `my_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_units_user_id_foreign` (`user_id`),
  ADD KEY `my_units_unit_id_foreign` (`unit_id`),
  ADD KEY `my_units_role_id_foreign` (`role_id`),
  ADD KEY `my_units_permissioner_id_foreign` (`permissioner_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_permission_group_id_foreign` (`permission_group_id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doors`
--
ALTER TABLE `doors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `door_ips`
--
ALTER TABLE `door_ips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `door_schedules`
--
ALTER TABLE `door_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `door_schedule_counters`
--
ALTER TABLE `door_schedule_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `door_schedule_doors`
--
ALTER TABLE `door_schedule_doors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `door_schedule_permissions`
--
ALTER TABLE `door_schedule_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `door_statuses`
--
ALTER TABLE `door_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `door_status_setters`
--
ALTER TABLE `door_status_setters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=865;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kenyas`
--
ALTER TABLE `kenyas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `my_permissions`
--
ALTER TABLE `my_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `my_permission_counters`
--
ALTER TABLE `my_permission_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `my_permission_doors`
--
ALTER TABLE `my_permission_doors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `my_units`
--
ALTER TABLE `my_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `door_ips`
--
ALTER TABLE `door_ips`
  ADD CONSTRAINT `door_ips_door_id_foreign` FOREIGN KEY (`door_id`) REFERENCES `doors` (`id`);

--
-- Constraints for table `door_schedules`
--
ALTER TABLE `door_schedules`
  ADD CONSTRAINT `door_schedules_door_schedule_permission_id_foreign` FOREIGN KEY (`door_schedule_permission_id`) REFERENCES `door_schedule_permissions` (`id`),
  ADD CONSTRAINT `door_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `door_schedule_counters`
--
ALTER TABLE `door_schedule_counters`
  ADD CONSTRAINT `door_schedule_counters_door_schedule_door_id_foreign` FOREIGN KEY (`door_schedule_door_id`) REFERENCES `door_schedule_doors` (`id`);

--
-- Constraints for table `door_schedule_doors`
--
ALTER TABLE `door_schedule_doors`
  ADD CONSTRAINT `door_schedule_doors_door_id_foreign` FOREIGN KEY (`door_id`) REFERENCES `doors` (`id`),
  ADD CONSTRAINT `door_schedule_doors_door_schedule_id_foreign` FOREIGN KEY (`door_schedule_id`) REFERENCES `door_schedules` (`id`);

--
-- Constraints for table `door_schedule_permissions`
--
ALTER TABLE `door_schedule_permissions`
  ADD CONSTRAINT `door_schedule_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `door_statuses`
--
ALTER TABLE `door_statuses`
  ADD CONSTRAINT `door_statuses_door_id_foreign` FOREIGN KEY (`door_id`) REFERENCES `doors` (`id`);

--
-- Constraints for table `door_status_setters`
--
ALTER TABLE `door_status_setters`
  ADD CONSTRAINT `door_status_setters_door_id_foreign` FOREIGN KEY (`door_id`) REFERENCES `doors` (`id`),
  ADD CONSTRAINT `door_status_setters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `my_permissions`
--
ALTER TABLE `my_permissions`
  ADD CONSTRAINT `my_permissions_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`),
  ADD CONSTRAINT `my_permissions_permissioner_id_foreign` FOREIGN KEY (`permissioner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `my_permissions_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `my_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `my_permission_counters`
--
ALTER TABLE `my_permission_counters`
  ADD CONSTRAINT `my_permission_counters_my_permission_id_foreign` FOREIGN KEY (`my_permission_id`) REFERENCES `my_permissions` (`id`);

--
-- Constraints for table `my_permission_doors`
--
ALTER TABLE `my_permission_doors`
  ADD CONSTRAINT `my_permission_doors_door_id_foreign` FOREIGN KEY (`door_id`) REFERENCES `doors` (`id`),
  ADD CONSTRAINT `my_permission_doors_my_permission_id_foreign` FOREIGN KEY (`my_permission_id`) REFERENCES `my_permissions` (`id`);

--
-- Constraints for table `my_units`
--
ALTER TABLE `my_units`
  ADD CONSTRAINT `my_units_permissioner_id_foreign` FOREIGN KEY (`permissioner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `my_units_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `my_units_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `my_units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
