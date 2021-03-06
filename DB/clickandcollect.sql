-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 27 mai 2022 à 19:06
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clickandcollect`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_featured`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Homme', 0, 'Category_1653259419.png', '2022-05-22 20:43:39', '2022-05-24 22:16:53'),
(2, 'Femme', 1, 'Category_1653259459.png', '2022-05-22 20:44:19', '2022-05-22 20:44:19');

-- --------------------------------------------------------

--
-- Structure de la table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 8, NULL, NULL),
(8, 2, 9, NULL, NULL),
(9, 2, 7, NULL, NULL),
(10, 1, 12, NULL, NULL),
(11, 2, 10, NULL, NULL),
(12, 2, 11, NULL, NULL),
(13, 2, 15, NULL, NULL),
(14, 2, 14, NULL, NULL),
(15, 2, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_03_27_205629_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_03_16_100412_create_categories_table', 1),
(7, '2022_03_21_111342_create_products_table', 1),
(8, '2022_03_21_211025_create_product_availables_table', 1),
(9, '2022_03_23_103415_create_category_product_table', 1),
(10, '2022_03_27_153744_create_reservations_table', 1),
(11, '2022_04_04_044000_create_product_lines_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(12, 'App\\Models\\User', 3, 'Access_token', 'd2f4d3efe40a36b0f26c828373524281bdb1c2973f8829e992e24d6a19bb6bd1', '[\"*\"]', '2022-05-24 20:59:49', '2022-05-24 05:45:54', '2022-05-24 20:59:49'),
(3, 'App\\Models\\User', 4, 'Access_token', 'd9f74aa9d8f5472bf9728af28ddad0b9d1f898058d4418f2ffacf6d365220c21', '[\"*\"]', '2022-05-22 20:39:10', '2022-05-22 20:39:09', '2022-05-22 20:39:10'),
(32, 'App\\Models\\User', 2, 'Access_token', 'a7df2d75d06c179db3a0ed6e5ffc5e4d686fbf7a7f73b93b2c48ab806d0bf2cd', '[\"*\"]', '2022-05-27 08:01:44', '2022-05-27 08:01:44', '2022-05-27 08:01:44'),
(5, 'App\\Models\\User', 5, 'Access_token', 'c53124183364b2d8e0b0893c30f68802e19bd7f69494a896a1e831f4e523d42b', '[\"*\"]', '2022-05-22 21:14:35', '2022-05-22 21:14:34', '2022-05-22 21:14:35'),
(6, 'App\\Models\\User', 6, 'Access_token', 'e66d3d5f3ccb6ee97131c53b8a2b62a8353034c8b7e245e890154aa508353cc0', '[\"*\"]', '2022-05-22 21:15:35', '2022-05-22 21:15:35', '2022-05-22 21:15:35'),
(17, 'App\\Models\\User', 7, 'Access_token', 'f5b1bea419ae1db2f277601bb820d5100abf166bac3fb988a884878edd91d6ae', '[\"*\"]', '2022-05-25 00:44:48', '2022-05-24 23:46:48', '2022-05-25 00:44:48'),
(19, 'App\\Models\\User', 8, 'Access_token', 'aba2c3d29abcb98e8c3c504cca550eca0f7a1d377d97adfa0152e3565952781f', '[\"*\"]', '2022-05-25 00:58:23', '2022-05-25 00:58:23', '2022-05-25 00:58:23'),
(20, 'App\\Models\\User', 9, 'Access_token', '8e6747cd81ae586bd717e20061b92e6f5f5e38cc47d57c2f38a8a38ddc92226e', '[\"*\"]', '2022-05-25 00:59:48', '2022-05-25 00:59:48', '2022-05-25 00:59:48'),
(21, 'App\\Models\\User', 10, 'Access_token', '8fc0b84be577b3baf32dd146e3dfd0dfdb6e683d3e5bc36f86cfa4b0d249161e', '[\"*\"]', '2022-05-25 01:01:27', '2022-05-25 01:01:27', '2022-05-25 01:01:27'),
(22, 'App\\Models\\User', 11, 'Access_token', '59574faeca582bcc7027641a0af2276db5dee518d5d45ce0db41a2fbe410b02e', '[\"*\"]', '2022-05-25 01:02:16', '2022-05-25 01:02:16', '2022-05-25 01:02:16'),
(33, 'App\\Models\\User', 13, 'Access_token', '4e070ecc02065242c45963b804c9363322ec17f39ab2f94f823a3f7608213306', '[\"*\"]', '2022-05-27 08:03:37', '2022-05-27 08:03:37', '2022-05-27 08:03:37'),
(35, 'App\\Models\\User', 15, 'Access_token', '5af82babc9985711fe09744e9c5fc86ede3fccdd483ada94b1b7d5fb358879ec', '[\"*\"]', NULL, '2022-05-27 11:37:34', '2022-05-27 11:37:34');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `price` decimal(8,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `is_featured`, `price`, `discount`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Wedding dress', 1, '500.00', 50, 'Product_1653259631.png', 'A weddingpanjabi. It is usually long and marron.', '2022-05-22 20:47:11', '2022-05-22 20:47:11'),
(2, 'T-shirt', 1, '100.00', 50, 'Product_1653259779.png', 'Short sleeves and no collar on a loose-fitting cotton shirt. It is most typically used throughout the summer.', '2022-05-22 20:49:39', '2022-05-22 20:49:39'),
(3, 'Suit', 0, '200.00', 20, 'Product_1653259918.png', '– This suit is perfect for me.', '2022-05-22 20:51:58', '2022-05-22 20:51:58'),
(4, 'Formal suit', 1, '500.00', 20, 'Product_1653260014.png', '– This suit is perfect for me.', '2022-05-22 20:53:35', '2022-05-23 14:38:14'),
(5, 'Female Weeding dress', 0, '500.00', 20, 'Product_1653260140.png', 'A wedding gown worn by the bride. It is usually long and white.', '2022-05-22 20:55:41', '2022-05-22 20:55:41'),
(6, 'Indian\'s Shari', 1, '300.00', 30, 'Product_1653260190.png', 'Being fashionable is one of the essential things for a woman.', '2022-05-22 20:56:31', '2022-05-22 20:56:31'),
(7, 'Shari', 1, '300.00', 30, 'Product_1653260262.png', 'South Handloom Saree | kalamkari sari | Indian sarees |', '2022-05-22 20:57:43', '2022-05-22 20:57:43'),
(8, 'South Handloom Saree', 1, '300.00', 30, 'Product_1653260348.png', 'The dressing style for women varies from person to person, and to have a perfect look, they must know the clothes’ names.', '2022-05-22 20:59:08', '2022-05-22 20:59:08'),
(9, 'Jacket', 0, '200.00', 20, 'Product_1653260457.png', 'A jacket is an example of a short coat. It only reaches the hips or the waist. Long sleeves and a button down at the front complete the look.', '2022-05-22 21:00:57', '2022-05-22 21:00:57'),
(10, 'Formal suit femme', 1, '300.00', 30, 'Product_1653263767.png', 'For perfact Girl.', '2022-05-22 21:56:07', '2022-05-22 21:56:07'),
(11, 'New Product', 0, '400.00', 20, 'Product_1653341729.png', 'This is new arrival cloth.', '2022-05-23 19:35:30', '2022-05-23 19:35:30'),
(12, 'white T-shirt', 0, '50.00', 10, 'Product_1653447331.png', 'This is new arrival t shirt', '2022-05-25 00:55:31', '2022-05-25 00:55:31'),
(13, 'pant pour femme', 0, '100.00', 10, 'Product_1653598486.png', 'skin tight pant', '2022-05-26 18:54:46', '2022-05-26 18:54:46'),
(14, 'Black court', 0, '200.00', 20, 'Product_1653598528.png', 'Black cout for nice weather', '2022-05-26 18:55:28', '2022-05-26 18:55:28'),
(15, 'cream color Shari', 0, '300.00', 30, 'Product_1653598660.png', 'very comfortable shari', '2022-05-26 18:57:40', '2022-05-26 18:57:40');

-- --------------------------------------------------------

--
-- Structure de la table `product_availables`
--

DROP TABLE IF EXISTS `product_availables`;
CREATE TABLE IF NOT EXISTS `product_availables` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `colour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_availables_product_id_index` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_availables`
--

INSERT INTO `product_availables` (`id`, `product_id`, `colour`, `quantity`, `size`, `created_at`, `updated_at`) VALUES
(1, 1, 'maroon', 8, 'M', '2022-05-22 21:01:35', '2022-05-26 18:51:12'),
(2, 2, 'White', 10, 'L', '2022-05-22 21:01:58', '2022-05-26 17:14:41'),
(3, 3, 'blue', 48, 'S', '2022-05-22 21:02:30', '2022-05-26 15:20:47'),
(4, 4, 'White', 10, 'M, L', '2022-05-22 21:02:52', '2022-05-22 21:02:52'),
(5, 5, 'Gry', 30, 'L,M', '2022-05-22 21:04:38', '2022-05-22 21:04:38'),
(6, 6, 'maroon', 50, 'L', '2022-05-22 21:04:59', '2022-05-26 16:31:24'),
(7, 7, 'green', 50, 'L', '2022-05-22 21:05:19', '2022-05-22 21:05:19'),
(8, 8, 'maroon', 46, 'L', '2022-05-22 21:05:33', '2022-05-26 16:31:42'),
(9, 9, 'maroon', 50, 'M', '2022-05-22 21:05:53', '2022-05-22 21:05:53'),
(10, 12, 'White', 50, 'M', '2022-05-25 00:56:11', '2022-05-25 00:56:11');

-- --------------------------------------------------------

--
-- Structure de la table `product_lines`
--

DROP TABLE IF EXISTS `product_lines`;
CREATE TABLE IF NOT EXISTS `product_lines` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `product_available_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_lines_reservation_id_index` (`reservation_id`),
  KEY `product_lines_product_available_id_index` (`product_available_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_lines`
--

INSERT INTO `product_lines` (`id`, `reservation_id`, `product_available_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 1, 8, 4, '2022-05-26 16:31:36', '2022-05-26 16:31:42'),
(8, 1, 2, 2, '2022-05-26 17:14:41', '2022-05-26 17:14:41'),
(3, 2, 3, 2, '2022-05-22 21:18:25', '2022-05-22 21:18:25'),
(5, 3, 2, 2, '2022-05-24 05:46:09', '2022-05-24 05:46:09'),
(6, 2, 2, 2, '2022-05-25 00:44:48', '2022-05-25 00:44:48'),
(9, 1, 1, 2, '2022-05-26 18:51:12', '2022-05-26 18:51:12');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `reference`, `status`, `expire_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'CNC_1653260787', 'Active', '2022-05-25 23:06:27', '2022-05-22 21:06:27', '2022-05-22 21:06:27'),
(2, 7, 'CNC_1653261505', 'Active', '2022-05-25 23:18:25', '2022-05-22 21:18:25', '2022-05-22 21:18:25'),
(3, 3, 'CNC_1653378369', 'Active', '2022-05-27 07:46:09', '2022-05-24 05:46:09', '2022-05-24 05:46:09');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, NULL),
(2, 'Amin', NULL, NULL),
(3, 'Customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_index` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `role_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jahanara', 'Haque', 1, 'jahanara@gmail.com', '$2y$10$us5g9TzOVhKmT5aDZ7L6hO9qDcUN5hNwWYERHZO1ScU7DDhGvaEPa', NULL, NULL, NULL),
(2, 'Lina', 'Haque', 2, 'lina@gmail.com', '$2y$10$us5g9TzOVhKmT5aDZ7L6hO9qDcUN5hNwWYERHZO1ScU7DDhGvaEPa', NULL, NULL, NULL),
(3, 'ships', 'Haque', 3, 'ships@gmail.com', '$2y$10$us5g9TzOVhKmT5aDZ7L6hO9qDcUN5hNwWYERHZO1ScU7DDhGvaEPa', NULL, '2022-05-22 20:35:47', '2022-05-22 20:35:47'),
(4, 'Kazul', 'Sayed', 3, 'kazul@gmail.com', '$2y$10$us5g9TzOVhKmT5aDZ7L6hO9qDcUN5hNwWYERHZO1ScU7DDhGvaEPa', NULL, '2022-05-22 20:39:09', '2022-05-22 20:39:09'),
(5, 'Kashif', 'Sayed', 3, 'kashif@gmail.com', '$2y$10$HOkESjjYiwgPSQuP2CTMP.pKDYRT/6oTvdhWtMwWO7oPoC6vL1q7e', NULL, '2022-05-22 21:14:34', '2022-05-22 21:14:34'),
(6, 'Kaisan', 'Sayed', 3, 'kaisan@gmail.com', '$2y$10$FpNyh82xh2uRw21rlZM45.vJSkxctv21AOu5pMqPP4owqbruDOktO', NULL, '2022-05-22 21:15:35', '2022-05-22 21:15:35'),
(7, 'Imram', 'Ali', 3, 'Imran@gmail.com', '$2y$10$a0i0SdIVjGEWjr/Oecaqmu8jjGR0Rn6mxvqECD1uvnsZDJDloHxv2', NULL, '2022-05-22 21:16:58', '2022-05-22 21:16:58'),
(8, 'Timothée', 'Moulin', 3, 'timomoulin@msn.com', '$2y$10$f3z79N71hue.F.TUvlXcrONzuPIoFIJTAbJkcF6D495dRQqVuww1S', NULL, '2022-05-25 00:58:23', '2022-05-25 00:58:23'),
(9, 'Ludovic', 'Hanon', 3, 'ludovic.hanon@gmail.com', '$2y$10$NFzBZkiz08kMfiYF7qyJ2uCwBw1LDNUlPrg02FON8mFtdgNs3zrGC', NULL, '2022-05-25 00:59:48', '2022-05-25 00:59:48'),
(10, 'Louis', 'Trane', 3, 'louis@gmail.com', '$2y$10$EqeAH2mz17Vy1kt3iaG7wuZtTlpQxAQyKSTbBLdeaTuuDF3/kLLwy', NULL, '2022-05-25 01:01:27', '2022-05-25 01:01:27'),
(11, 'Souad', 'TRINIB', 3, 'Souad.trinib@hotmail.com', '$2y$10$Vj1MvwoQ0/KRzBuYNRKrE./bJ3WdbSGm2eIgCfhkzRaXJ64N5mDBm', NULL, '2022-05-25 01:02:16', '2022-05-25 01:02:16'),
(13, 'haque', 'name', 3, 'haq@gmail.com', '$2y$10$4OoDyarxaGSAusf4dKvALOxe9ZzkFV1YOL/jtbT6k8LsmfTT/6Br6', NULL, '2022-05-27 08:03:37', '2022-05-27 08:03:37'),
(14, 'helo', 'name', 3, 'helo@gmail.com', 'helo@gmail.com1', NULL, NULL, NULL),
(15, 'Kaisan22', 'Sayed', 3, 'Kaisan22@gmail.com', '$2y$10$6HW/aV7VO/XlJSnBmX93F.bQrhCZEDr1hEO7cEHmYJtL878Kf1NQK', NULL, '2022-05-27 11:23:49', '2022-05-27 11:23:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
