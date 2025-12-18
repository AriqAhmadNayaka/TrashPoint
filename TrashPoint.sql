-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2025 at 01:16 PM
-- Server version: 8.4.5
-- PHP Version: 8.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trashpoint`
--
CREATE DATABASE IF NOT EXISTS `trashpoint` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `trashpoint`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` bigint UNSIGNED NOT NULL,
  `idUser` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `idUser`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-11-12 18:52:28', '2025-11-12 18:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_trash_schedule`
--

CREATE TABLE `detail_trash_schedule` (
  `idDetailTrashSchedule` bigint UNSIGNED NOT NULL,
  `idTrashSchedule` bigint UNSIGNED NOT NULL,
  `idTrash` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_trash_schedule`
--

INSERT INTO `detail_trash_schedule` (`idDetailTrashSchedule`, `idTrashSchedule`, `idTrash`, `created_at`, `updated_at`) VALUES
(2, 3, 3, '2025-11-12 19:57:50', '2025-11-12 19:57:50'),
(3, 3, 2, '2025-11-12 19:57:56', '2025-11-12 19:57:56'),
(4, 2, 1, NULL, NULL),
(5, 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_take_out_trash`
--

CREATE TABLE `history_take_out_trash` (
  `idHistoryTakeOutTrash` bigint UNSIGNED NOT NULL,
  `idMasyarakat` bigint UNSIGNED NOT NULL,
  `idTrash` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_take_out_trash`
--

INSERT INTO `history_take_out_trash` (`idHistoryTakeOutTrash`, `idMasyarakat`, `idTrash`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-12 06:06:29', '2025-11-12 06:06:29'),
(2, 1, 1, '2025-11-12 06:08:19', '2025-11-12 06:08:19'),
(3, 1, 1, '2025-11-12 06:08:23', '2025-11-12 06:08:23'),
(4, 1, 1, '2025-11-12 06:08:24', '2025-11-12 06:08:24'),
(5, 1, 1, '2025-11-12 06:08:25', '2025-11-12 06:08:25'),
(6, 1, 1, '2025-11-12 06:08:25', '2025-11-12 06:08:25'),
(7, 1, 1, '2025-11-12 06:08:26', '2025-11-12 06:08:26'),
(8, 1, 1, '2025-11-12 06:08:26', '2025-11-12 06:08:26'),
(9, 1, 1, '2025-11-12 06:09:01', '2025-11-12 06:09:01'),
(10, 1, 1, '2025-11-12 06:09:02', '2025-11-12 06:09:02'),
(11, 1, 1, '2025-11-12 06:09:03', '2025-11-12 06:09:03'),
(12, 1, 1, '2025-11-12 06:09:03', '2025-11-12 06:09:03'),
(13, 1, 1, '2025-11-12 06:09:03', '2025-11-12 06:09:03'),
(14, 1, 1, '2025-11-12 06:09:04', '2025-11-12 06:09:04'),
(15, 9, 4, '2025-12-06 05:16:40', '2025-12-06 05:16:40'),
(16, 9, 2, '2025-12-06 05:17:42', '2025-12-06 05:17:42'),
(17, 9, 2, '2025-12-06 05:20:52', '2025-12-06 05:20:52'),
(18, 9, 2, '2025-12-06 05:21:20', '2025-12-06 05:21:20'),
(19, 9, 2, '2025-12-06 05:21:43', '2025-12-06 05:21:43'),
(20, 9, 3, '2025-12-06 05:22:36', '2025-12-06 05:22:36'),
(21, 9, 3, '2025-12-06 05:24:35', '2025-12-06 05:24:35'),
(22, 9, 2, '2025-12-06 05:28:12', '2025-12-06 05:28:12'),
(23, 9, 4, '2025-12-06 05:29:10', '2025-12-06 05:29:10'),
(24, 9, 4, '2025-12-06 05:30:43', '2025-12-06 05:30:43'),
(25, 9, 4, '2025-12-06 05:31:38', '2025-12-06 05:31:38'),
(26, 9, 2, '2025-12-06 05:34:37', '2025-12-06 05:34:37'),
(27, 9, 2, '2025-12-06 05:36:13', '2025-12-06 05:36:13'),
(28, 9, 4, '2025-12-06 05:44:29', '2025-12-06 05:44:29'),
(29, 11, 3, '2025-12-09 01:01:59', '2025-12-09 01:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `history_voucher`
--

CREATE TABLE `history_voucher` (
  `idHistoryVoucher` bigint UNSIGNED NOT NULL,
  `idMasyarakat` bigint UNSIGNED NOT NULL,
  `idVoucher` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_voucher`
--

INSERT INTO `history_voucher` (`idHistoryVoucher`, `idMasyarakat`, `idVoucher`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-12 06:58:58', '2025-11-12 06:58:58'),
(2, 1, 1, '2025-11-12 18:49:10', '2025-11-12 18:49:10'),
(3, 9, 1, '2025-11-28 08:48:34', '2025-11-28 08:48:34'),
(4, 9, 1, '2025-11-28 08:49:39', '2025-11-28 08:49:39'),
(5, 9, 3, '2025-11-28 08:50:04', '2025-11-28 08:50:04'),
(6, 9, 1, '2025-11-28 19:25:50', '2025-11-28 19:25:50'),
(7, 9, 3, '2025-12-06 03:59:23', '2025-12-06 03:59:23'),
(8, 9, 2, '2025-12-06 04:00:38', '2025-12-06 04:00:38'),
(9, 9, 3, '2025-12-06 04:11:30', '2025-12-06 04:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `idMasyarakat` bigint UNSIGNED NOT NULL,
  `idUser` bigint UNSIGNED NOT NULL,
  `points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`idMasyarakat`, `idUser`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 50, '2025-11-12 05:47:15', '2025-11-12 18:49:10'),
(5, 7, 0, '2025-11-20 22:44:37', '2025-11-20 22:44:37'),
(7, 10, 0, '2025-11-27 05:16:25', '2025-11-27 05:16:25'),
(8, 11, 0, '2025-11-27 05:30:04', '2025-11-27 05:30:04'),
(9, 12, 998289, '2025-11-27 08:42:12', '2025-12-06 05:44:29'),
(11, 14, 10, '2025-12-09 01:01:43', '2025-12-09 01:01:59');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_07_103631_create_users_table', 1),
(5, '2025_11_07_104319_create_masyarakat_table', 1),
(6, '2025_11_07_104502_create_petugas_table', 1),
(7, '2025_11_07_104535_create_admin_table', 1),
(8, '2025_11_07_104653_create_voucher_table', 1),
(9, '2025_11_07_104936_create_history_voucher_table', 1),
(10, '2025_11_07_105437_create_trash_table', 1),
(11, '2025_11_07_105440_create_history_take_out_trash_table', 1),
(12, '2025_11_07_110236_create_trash_transportation_schedule_table', 1),
(13, '2025_11_07_110705_create_detail_trash_transportation_schedule_table', 1),
(14, '2025_11_07_141540_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 10, 'auth_token', '69624e96143b61689af1466af0f048e598dc2703c8b7b371da9fe071ca91c22a', '[\"*\"]', NULL, NULL, '2025-11-27 05:38:40', '2025-11-27 05:38:40'),
(2, 'App\\Models\\User', 12, 'auth_token', '2071c8284ef1662e7127ad1821375e93424724f58e11bb8ead67e7f02115208e', '[\"*\"]', NULL, NULL, '2025-11-27 08:44:31', '2025-11-27 08:44:31'),
(3, 'App\\Models\\User', 12, 'auth_token', 'b644a50bde25182db62f84195b0af9dad9ff0fa1f33eacf024ae77375b555c70', '[\"*\"]', NULL, NULL, '2025-11-27 08:44:37', '2025-11-27 08:44:37'),
(4, 'App\\Models\\User', 12, 'auth_token', '6686139bc67535d08e1443143a2d89f46d51ee8f3cf3bca46bc2bc62f5f813fe', '[\"*\"]', NULL, NULL, '2025-11-27 08:59:28', '2025-11-27 08:59:28'),
(5, 'App\\Models\\User', 12, 'auth_token', '154a62149775486f89b816a6423fb9e946e96bf9867ca558ca631959b60f1cd5', '[\"*\"]', NULL, NULL, '2025-11-27 09:22:31', '2025-11-27 09:22:31'),
(6, 'App\\Models\\User', 10, 'auth_token', '6a2b838a7e795d8d107bc4265b4742743f9b6d9325b9902d36fcda20487b80a8', '[\"*\"]', NULL, NULL, '2025-11-27 23:49:25', '2025-11-27 23:49:25'),
(7, 'App\\Models\\User', 12, 'auth_token', 'bd9ae818ff59bffba95107107e828a936a7d0e8bbef273ba4d43f635f7ce4ad3', '[\"*\"]', NULL, NULL, '2025-11-28 00:02:50', '2025-11-28 00:02:50'),
(8, 'App\\Models\\User', 12, 'auth_token', 'cf6f5f8758e456226953a1d74aafa1ec7cedef0b71e1de12cb2e95f677a1c8d4', '[\"*\"]', NULL, NULL, '2025-11-28 07:48:30', '2025-11-28 07:48:30'),
(9, 'App\\Models\\User', 12, 'auth_token', 'cee83d50030d35f1548b8e4498512c34d1862b6b3d32720b0864b292062e4e23', '[\"*\"]', NULL, NULL, '2025-11-28 08:07:51', '2025-11-28 08:07:51'),
(10, 'App\\Models\\User', 12, 'auth_token', 'f6c91216ae67778be1f17fcdb124b48a05b8aeb89181ba5b28e30f01bce19e93', '[\"*\"]', NULL, NULL, '2025-11-28 08:09:32', '2025-11-28 08:09:32'),
(11, 'App\\Models\\User', 12, 'auth_token', '8b18c6544b011f83896bf455f1f99c759269c4d2b5772cd676a913090be19833', '[\"*\"]', NULL, NULL, '2025-11-28 08:12:11', '2025-11-28 08:12:11'),
(12, 'App\\Models\\User', 12, 'auth_token', '0a397f11cefcb1887b1454ae17434ab4baf5505d2cfb0bf3b1672997d1f17a2e', '[\"*\"]', NULL, NULL, '2025-11-28 08:12:54', '2025-11-28 08:12:54'),
(13, 'App\\Models\\User', 12, 'auth_token', 'a3bcbb3792ec964fbe44d3cc3f650520a08b5038669e6c099ef413b6f9459267', '[\"*\"]', NULL, NULL, '2025-11-28 08:14:45', '2025-11-28 08:14:45'),
(14, 'App\\Models\\User', 12, 'auth_token', '50ed3c31c772fd156ea3a5b7fa5219e2d72ee3fc20e7efc3d6a85a1293efda0c', '[\"*\"]', NULL, NULL, '2025-11-28 08:21:56', '2025-11-28 08:21:56'),
(15, 'App\\Models\\User', 12, 'auth_token', 'ca90da7046ea590b40a7440995b28d3d40e193f2727dd7cd8df0a3cf5ac70453', '[\"*\"]', NULL, NULL, '2025-11-28 08:24:38', '2025-11-28 08:24:38'),
(16, 'App\\Models\\User', 12, 'auth_token', 'afd1997adde650222554275ff41b58c52c65d54dc05536e0502785d35202163c', '[\"*\"]', NULL, NULL, '2025-11-28 08:25:57', '2025-11-28 08:25:57'),
(17, 'App\\Models\\User', 12, 'auth_token', 'e464da3e611eb00ac70ff1d01522530b0df5b28c292491cc6000db09a01bd8cc', '[\"*\"]', NULL, NULL, '2025-11-28 08:44:37', '2025-11-28 08:44:37'),
(18, 'App\\Models\\User', 12, 'auth_token', '7d9b283a27b68381eef49c5b50ac77782c1e41295eaca564f683a4c264d1adde', '[\"*\"]', NULL, NULL, '2025-11-28 19:25:13', '2025-11-28 19:25:13'),
(19, 'App\\Models\\User', 12, 'auth_token', 'e9efac181fded34faee4a43df4b59f7d02b17efc84b24dbbe97c00b997607b3b', '[\"*\"]', NULL, NULL, '2025-12-06 03:54:25', '2025-12-06 03:54:25'),
(20, 'App\\Models\\User', 12, 'auth_token', 'df78fb54dd29077653fc1e2ca7acb2db1d31d749ba8e1317657df2ac26b664d8', '[\"*\"]', NULL, NULL, '2025-12-08 05:01:11', '2025-12-08 05:01:11'),
(21, 'App\\Models\\User', 12, 'auth_token', '949fa6152acfbb473bf52c46eb78e68212efcbb766ad4875a14f4e503179d298', '[\"*\"]', NULL, NULL, '2025-12-08 05:27:26', '2025-12-08 05:27:26'),
(22, 'App\\Models\\User', 12, 'auth_token', 'b1cb1b227ec32e71d1f6bae55a71354a3ce3e3e70b545bca64e7ff6588c80a3b', '[\"*\"]', NULL, NULL, '2025-12-08 07:00:34', '2025-12-08 07:00:34'),
(23, 'App\\Models\\User', 12, 'auth_token', 'a0df5e21a7b20297021872ba92d19fa5fc8e952ed3e28337bdcaa73bb4030be7', '[\"*\"]', NULL, NULL, '2025-12-09 00:43:07', '2025-12-09 00:43:07'),
(24, 'App\\Models\\User', 12, 'auth_token', 'ee18dfd460fa9ccb312ff56820461a09309a36ebbdab2883c04b8246baabdfcf', '[\"*\"]', NULL, NULL, '2025-12-09 00:57:05', '2025-12-09 00:57:05'),
(25, 'App\\Models\\User', 14, 'auth_token', 'a9a2ee9714b057bff46b195c5ac842c2357b98cf42a68853d1c277b4f3458d8b', '[\"*\"]', NULL, NULL, '2025-12-09 01:01:50', '2025-12-09 01:01:50'),
(26, 'App\\Models\\User', 15, 'auth_token', '71002a9c9033876a207e7af81a7d7a6667107de805795e05307d96a3764cc004', '[\"*\"]', NULL, NULL, '2025-12-09 04:48:56', '2025-12-09 04:48:56'),
(27, 'App\\Models\\User', 15, 'auth_token', '82f2d98c227cd91e378366f942056d3fa9e8bf332205c191f9227d8fb5e3f2fb', '[\"*\"]', NULL, NULL, '2025-12-09 04:49:25', '2025-12-09 04:49:25'),
(28, 'App\\Models\\User', 15, 'auth_token', '31651121915f453e79b4588f009c5d42661260d73fa6082ae19dd32f5736178a', '[\"*\"]', NULL, NULL, '2025-12-09 04:51:16', '2025-12-09 04:51:16'),
(29, 'App\\Models\\User', 15, 'auth_token', 'f8e10160aedb2898ef904477723753bcffe332706b302fed704d7a3b6a40387c', '[\"*\"]', NULL, NULL, '2025-12-09 04:51:38', '2025-12-09 04:51:38'),
(30, 'App\\Models\\User', 15, 'auth_token', '5e42bbc52b2462fda905a1d16786fa8ae512bd9cb9f68d409cd10ec21d37ae57', '[\"*\"]', NULL, NULL, '2025-12-09 04:52:03', '2025-12-09 04:52:03'),
(31, 'App\\Models\\User', 14, 'auth_token', '2735b17cd8892113f455c45452c702fd1c095d19edcd4e41f9b0b90ca8f66521', '[\"*\"]', NULL, NULL, '2025-12-09 04:52:31', '2025-12-09 04:52:31'),
(32, 'App\\Models\\User', 15, 'auth_token', 'd90fb43d4f8d99182d593da4ae5919993cc798127c177f62667ea87940b98935', '[\"*\"]', NULL, NULL, '2025-12-09 04:52:46', '2025-12-09 04:52:46'),
(33, 'App\\Models\\User', 15, 'auth_token', '1462ab1b789bc3787614d061ef05fa34d557ddae1309fe4d77c44a40e55ea2ef', '[\"*\"]', NULL, NULL, '2025-12-09 04:55:22', '2025-12-09 04:55:22'),
(34, 'App\\Models\\User', 15, 'auth_token', 'ec2daa0bfb3a479023cdbf67364a93c784c92c52b2b5e9679f1d2ded52b9210c', '[\"*\"]', NULL, NULL, '2025-12-09 04:55:42', '2025-12-09 04:55:42'),
(35, 'App\\Models\\User', 15, 'auth_token', '675f65c35c46dd5be497b88f22f4a5008d4ae60d56f675daa2f4a4cf6ed5c6c6', '[\"*\"]', NULL, NULL, '2025-12-09 04:55:49', '2025-12-09 04:55:49'),
(36, 'App\\Models\\User', 15, 'auth_token', '0e36b0f57155f5cfe9cabe1af247f94cfe10df091005524f566bebabde9d8cd1', '[\"*\"]', NULL, NULL, '2025-12-09 04:58:12', '2025-12-09 04:58:12'),
(37, 'App\\Models\\User', 15, 'auth_token', 'c3d7bf0caf098bf8e1a13c67a1a76b6cdce6f523dbe4684711984af7d2be2798', '[\"*\"]', NULL, NULL, '2025-12-09 04:58:22', '2025-12-09 04:58:22'),
(38, 'App\\Models\\User', 15, 'auth_token', 'b5e524cae2c1bcbfa18a00fe407e53258961996374daea869900f85dff88bd18', '[\"*\"]', NULL, NULL, '2025-12-10 11:26:31', '2025-12-10 11:26:31'),
(39, 'App\\Models\\User', 12, 'auth_token', '4a86d68d05efc4a8e9ea3855f660d0c1f9bfa1a472095c97347f3c86abaf969d', '[\"*\"]', NULL, NULL, '2025-12-10 11:27:07', '2025-12-10 11:27:07'),
(40, 'App\\Models\\User', 12, 'auth_token', '02949c74bf5361b5a8091623be68765d021b9b58a56df6c03e357b41992bf420', '[\"*\"]', NULL, NULL, '2025-12-10 11:32:15', '2025-12-10 11:32:15'),
(41, 'App\\Models\\User', 15, 'auth_token', '5b20242be4f41357e4bbae6583576fe882ac8cbda9964f3918dd4317449cb704', '[\"*\"]', NULL, NULL, '2025-12-10 11:41:17', '2025-12-10 11:41:17'),
(42, 'App\\Models\\User', 15, 'auth_token', '0461f91ee3674298b974027c4d062fce03e5f1140c3144dfaf2c92fac08d72fe', '[\"*\"]', NULL, NULL, '2025-12-10 11:58:38', '2025-12-10 11:58:38'),
(43, 'App\\Models\\User', 15, 'auth_token', '524461e7eb121d6149b0cc29eeaf2b32331b4cf0966ff276e5dca29daeb4a779', '[\"*\"]', NULL, NULL, '2025-12-12 05:16:34', '2025-12-12 05:16:34'),
(44, 'App\\Models\\User', 15, 'auth_token', '9ef523006ac291c79d11b6dcdc377908328a9dbd678b2dfd7d02e61df8bf0490', '[\"*\"]', NULL, NULL, '2025-12-12 05:46:01', '2025-12-12 05:46:01'),
(45, 'App\\Models\\User', 15, 'auth_token', '6dfdf3eefd3bb20ed3493713d22463e7a0d9c8b18e4d746bf985318585ed271a', '[\"*\"]', NULL, NULL, '2025-12-12 06:04:33', '2025-12-12 06:04:33'),
(46, 'App\\Models\\User', 15, 'auth_token', 'bdcb1d36e54469d8861184ea48764343669f1f8e10d3247557e1efa9cea7cdbb', '[\"*\"]', NULL, NULL, '2025-12-12 06:55:47', '2025-12-12 06:55:47'),
(47, 'App\\Models\\User', 15, 'auth_token', 'e826228d7e7c098c1b980d53bbdc5a0959ea17f21bdfd1d35569861fcb84ccc6', '[\"*\"]', NULL, NULL, '2025-12-12 07:00:57', '2025-12-12 07:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idPetugas` bigint UNSIGNED NOT NULL,
  `idUser` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idPetugas`, `idUser`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-11-12 18:53:21', '2025-11-12 18:53:21'),
(2, 15, '2025-12-09 04:48:32', '2025-12-09 04:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RRhDFRoGeLvUjv0Avs77JTIiA7DuyOfS4jkFxIgm', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGRZbGJ3UVF5S1ZKYmVHV2FYWWpxNFpPWDRTUVY2UVRQckFMeG53dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1764245810);

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `idTrash` bigint UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roadAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `status` enum('empty','full','inactive','dummy') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'empty',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`idTrash`, `province`, `city`, `roadAddress`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Barat', 'Bandung', 'Jl. Sukabirus', -6.234, 106.979, 'empty', '2025-11-12 06:02:18', '2025-12-12 06:17:33'),
(2, 'Jawa Barat', 'Bandung', 'Jl. Sukapura', -6.231, 106.977, 'empty', '2025-11-12 19:27:58', '2025-12-12 06:25:05'),
(3, 'Jawa Barat', 'Bandung', 'Jl. Batu Nunggal', -6.238, 106.983, 'empty', '2025-12-09 07:47:54', '2025-12-12 06:45:38'),
(4, 'Jawa Barat', 'Bandung', 'Ciganitri', -6.235, 106.985, 'empty', '2025-12-08 17:00:00', '2025-12-12 06:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `trash_schedule`
--

CREATE TABLE `trash_schedule` (
  `idTrashSchedule` bigint UNSIGNED NOT NULL,
  `idPetugas` bigint UNSIGNED NOT NULL,
  `idAdmin` bigint UNSIGNED NOT NULL,
  `scheduleDateTime` datetime NOT NULL,
  `status` enum('scheduled','completed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trash_schedule`
--

INSERT INTO `trash_schedule` (`idTrashSchedule`, `idPetugas`, `idAdmin`, `scheduleDateTime`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2025-11-13 02:35:30', 'completed', '2025-11-12 19:37:31', '2025-12-12 07:02:10'),
(3, 2, 1, '2025-11-13 02:35:30', 'completed', '2025-12-10 11:44:08', '2025-12-12 07:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','masyarakat','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masyarakat',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `password`, `phoneNumber`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rutbir', 'rutbir@gmail.com', 'rutbir', '08557639854', 'masyarakat', 'active', '2025-11-12 05:47:15', '2025-11-12 05:47:15'),
(2, 'ariqnayaka', 'ariqnayaka@gmail.com', 'ariqnayaka', '08557639854', 'admin', 'active', '2025-11-12 18:52:27', '2025-11-12 18:52:27'),
(3, 'ikan', 'ikan@gmail.com', 'ikan', '08557639854', 'petugas', 'active', '2025-11-12 18:53:21', '2025-11-12 18:53:21'),
(7, 'azfar', 'azfar@gmail.com', 'azfar', '083467634', 'masyarakat', 'active', '2025-11-20 22:44:37', '2025-11-20 22:44:37'),
(10, 'icecream', 'icecream@gmail.com', '$2y$12$BNeT3C1Gi4UtqoTxlVqxkuqRZFQjRekIHZfPv64nytlxPiKM/QgEu', '083826723', 'masyarakat', 'active', '2025-11-27 05:16:25', '2025-11-27 05:16:25'),
(11, 'masak', 'masak@gmail.com', '$2y$12$OAuZqbwO1zJmdjlPWOKhB.e1x95OAXU76MAVWuhPirAIqop3t9A/.', '08557639854', 'masyarakat', 'active', '2025-11-27 05:30:04', '2025-11-27 05:30:04'),
(12, 'moondrop', 'moondrop@gmail.com', '$2y$12$mKjYBZRvsA31uOPc3CnIXeOnfdwD/t4WZpfFyTQVKmbKF/lFJLUAW', '0834673', 'masyarakat', 'active', '2025-11-27 08:42:12', '2025-11-27 08:42:12'),
(14, 'xiao', 'xiao@gmail.com', '$2y$12$U01jFNnhyaB4BcbPGIQgj.TRyZHDn7rfNMTaF0Lo5sstSZAv9JOAW', '0865362265', 'masyarakat', 'active', '2025-12-09 01:01:43', '2025-12-09 01:01:43'),
(15, 'petugas', 'petugas@gmail.com', '$2y$12$z49xgH6IIV.KA5hK7wR12ebvHJCw5SZ/jWXwu4LVLsYO4QvqFvxR.', '08557639854', 'petugas', 'active', '2025-12-09 04:48:32', '2025-12-09 04:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `idVoucher` bigint UNSIGNED NOT NULL,
  `voucherName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`idVoucher`, `voucherName`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'XBOX GAMEPASS', 150, 'active', '2025-11-12 06:44:53', '2025-11-12 06:44:53'),
(2, 'Netflix 3 Month', 500, 'active', '2025-12-09 07:53:02', NULL),
(3, 'Chat GPT 1 Month', 300, 'active', '2025-12-08 17:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `admin_iduser_foreign` (`idUser`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_trash_schedule`
--
ALTER TABLE `detail_trash_schedule`
  ADD PRIMARY KEY (`idDetailTrashSchedule`),
  ADD KEY `detail_trash_schedule_idtrashschedule_foreign` (`idTrashSchedule`),
  ADD KEY `detail_trash_schedule_idtrash_foreign` (`idTrash`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_take_out_trash`
--
ALTER TABLE `history_take_out_trash`
  ADD PRIMARY KEY (`idHistoryTakeOutTrash`),
  ADD KEY `history_take_out_trash_idmasyarakat_foreign` (`idMasyarakat`),
  ADD KEY `history_take_out_trash_idtrash_foreign` (`idTrash`);

--
-- Indexes for table `history_voucher`
--
ALTER TABLE `history_voucher`
  ADD PRIMARY KEY (`idHistoryVoucher`),
  ADD KEY `history_voucher_idmasyarakat_foreign` (`idMasyarakat`),
  ADD KEY `history_voucher_idvoucher_foreign` (`idVoucher`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`idMasyarakat`),
  ADD KEY `masyarakat_iduser_foreign` (`idUser`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idPetugas`),
  ADD KEY `petugas_iduser_foreign` (`idUser`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`idTrash`);

--
-- Indexes for table `trash_schedule`
--
ALTER TABLE `trash_schedule`
  ADD PRIMARY KEY (`idTrashSchedule`),
  ADD KEY `trash_schedule_idpetugas_foreign` (`idPetugas`),
  ADD KEY `trash_schedule_idadmin_foreign` (`idAdmin`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`idVoucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_trash_schedule`
--
ALTER TABLE `detail_trash_schedule`
  MODIFY `idDetailTrashSchedule` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_take_out_trash`
--
ALTER TABLE `history_take_out_trash`
  MODIFY `idHistoryTakeOutTrash` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `history_voucher`
--
ALTER TABLE `history_voucher`
  MODIFY `idHistoryVoucher` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `idMasyarakat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idPetugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `idTrash` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trash_schedule`
--
ALTER TABLE `trash_schedule`
  MODIFY `idTrashSchedule` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `idVoucher` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `detail_trash_schedule`
--
ALTER TABLE `detail_trash_schedule`
  ADD CONSTRAINT `detail_trash_schedule_idtrash_foreign` FOREIGN KEY (`idTrash`) REFERENCES `trash` (`idTrash`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_trash_schedule_idtrashschedule_foreign` FOREIGN KEY (`idTrashSchedule`) REFERENCES `trash_schedule` (`idTrashSchedule`) ON DELETE CASCADE;

--
-- Constraints for table `history_take_out_trash`
--
ALTER TABLE `history_take_out_trash`
  ADD CONSTRAINT `history_take_out_trash_idmasyarakat_foreign` FOREIGN KEY (`idMasyarakat`) REFERENCES `masyarakat` (`idMasyarakat`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_take_out_trash_idtrash_foreign` FOREIGN KEY (`idTrash`) REFERENCES `trash` (`idTrash`) ON DELETE CASCADE;

--
-- Constraints for table `history_voucher`
--
ALTER TABLE `history_voucher`
  ADD CONSTRAINT `history_voucher_idmasyarakat_foreign` FOREIGN KEY (`idMasyarakat`) REFERENCES `masyarakat` (`idMasyarakat`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_voucher_idvoucher_foreign` FOREIGN KEY (`idVoucher`) REFERENCES `voucher` (`idVoucher`) ON DELETE CASCADE;

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `trash_schedule`
--
ALTER TABLE `trash_schedule`
  ADD CONSTRAINT `trash_schedule_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`) ON DELETE CASCADE,
  ADD CONSTRAINT `trash_schedule_idpetugas_foreign` FOREIGN KEY (`idPetugas`) REFERENCES `petugas` (`idPetugas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
