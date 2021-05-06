-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for args
CREATE DATABASE IF NOT EXISTS `args` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `args`;

-- Dumping structure for table args.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.admins: ~1 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
REPLACE INTO `admins` (`id`, `name`, `email`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'super@admin.com', '$2y$10$yNo1myoMmwHFK/ghQEX6/./Xch1DHWITtdAh3pwmTlUs2YmZoO5dm', 1, NULL, '2020-11-15 12:07:53', '2020-11-15 12:07:53');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table args.admin_permission
CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permission_admin_id_permission_id_unique` (`admin_id`,`permission_id`),
  KEY `admin_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `admin_permission_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.admin_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_permission` ENABLE KEYS */;

-- Dumping structure for table args.admin_role
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_admin_id_foreign` (`admin_id`),
  CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.admin_role: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
REPLACE INTO `admin_role` (`id`, `role_id`, `admin_id`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;

-- Dumping structure for table args.antagonists
CREATE TABLE IF NOT EXISTS `antagonists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '2',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.antagonists: ~3 rows (approximately)
/*!40000 ALTER TABLE `antagonists` DISABLE KEYS */;
REPLACE INTO `antagonists` (`id`, `title`, `image`, `amount`, `energy`, `qty`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Robokit', '1619943337antagonist.svg', 3.00, 100.00, 2, NULL, 'show', '2021-05-02 15:02:06', '2021-05-02 15:50:04'),
	(2, 'Alience', '1619942534antagonist.svg', 3.00, 500.00, 2, NULL, 'show', '2021-05-02 15:02:14', '2021-05-02 15:50:10'),
	(3, 'Megatron', '1619943482antagonist.svg', 5.00, 1000.00, 2, NULL, 'show', '2021-05-02 15:03:51', '2021-05-02 15:50:24');
/*!40000 ALTER TABLE `antagonists` ENABLE KEYS */;

-- Dumping structure for table args.antagonist_attacks
CREATE TABLE IF NOT EXISTS `antagonist_attacks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `antagonist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.antagonist_attacks: ~0 rows (approximately)
/*!40000 ALTER TABLE `antagonist_attacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `antagonist_attacks` ENABLE KEYS */;

-- Dumping structure for table args.coins
CREATE TABLE IF NOT EXISTS `coins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '2',
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.coins: ~14 rows (approximately)
/*!40000 ALTER TABLE `coins` DISABLE KEYS */;
REPLACE INTO `coins` (`id`, `image`, `amount`, `energy`, `qty`, `status`, `created_at`, `updated_at`) VALUES
	(1, '1620051646image.png', 0.01, 1.00, 2, 'show', '2021-05-04 10:00:40', '2021-05-03 21:20:46'),
	(2, 'coingast2.svg', 0.02, 2.00, 2, 'show', '2021-04-25 17:44:44', '2021-04-25 17:44:44'),
	(3, 'coingast3.svg', 0.03, 3.00, 2, 'show', '2021-04-25 17:44:50', '2021-04-25 17:47:54'),
	(4, 'coingast4.svg', 0.04, 4.00, 2, 'show', '2021-04-28 14:48:26', '2021-04-28 14:48:26'),
	(5, 'coingast5.svg', 0.05, 5.00, 2, 'show', '2021-05-01 07:57:13', '2021-05-01 07:57:13'),
	(6, 'coingast10.svg', 0.10, 10.00, 2, 'show', '2021-05-02 01:40:52', NULL),
	(7, 'coingast15.svg', 0.15, 15.00, 2, 'show', '2021-05-02 01:40:53', NULL),
	(8, 'coingast20.svg', 0.20, 20.00, 2, 'show', '2021-05-02 01:40:53', NULL),
	(9, 'coingast25.svg', 0.25, 25.00, 2, 'show', '2021-05-02 01:40:55', NULL),
	(10, 'coingast30.svg', 0.30, 30.00, 2, 'show', '2021-05-02 01:40:54', NULL),
	(11, 'coingast35.svg', 0.35, 35.00, 2, 'show', '2021-05-02 01:40:54', NULL),
	(12, 'coingast40.svg', 0.40, 40.00, 2, 'show', '2021-05-02 01:40:56', NULL),
	(13, 'coingast50.svg', 0.50, 50.00, 2, 'show', '2021-05-02 01:40:55', NULL),
	(14, 'coingast1.svg', 1.00, 100.00, 2, 'show', '2021-05-02 01:40:56', NULL);
/*!40000 ALTER TABLE `coins` ENABLE KEYS */;

-- Dumping structure for table args.coin_claims
CREATE TABLE IF NOT EXISTS `coin_claims` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.coin_claims: ~0 rows (approximately)
/*!40000 ALTER TABLE `coin_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_claims` ENABLE KEYS */;

-- Dumping structure for table args.coin_collects
CREATE TABLE IF NOT EXISTS `coin_collects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `coin_id` int(11) NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.coin_collects: ~0 rows (approximately)
/*!40000 ALTER TABLE `coin_collects` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_collects` ENABLE KEYS */;

-- Dumping structure for table args.energy_boosts
CREATE TABLE IF NOT EXISTS `energy_boosts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.energy_boosts: ~0 rows (approximately)
/*!40000 ALTER TABLE `energy_boosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `energy_boosts` ENABLE KEYS */;

-- Dumping structure for table args.generals
CREATE TABLE IF NOT EXISTS `generals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_sm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_light` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_dark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_gast` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_ttg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_args` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_tax` double(15,2) NOT NULL DEFAULT '0.00',
  `transfer_ttg` double(15,2) NOT NULL DEFAULT '0.00',
  `topUp_tax` double(15,2) NOT NULL DEFAULT '0.00',
  `payout_tax` double(15,2) NOT NULL DEFAULT '0.00',
  `energy_exchange` double(15,2) NOT NULL DEFAULT '0.00',
  `energy_exchange_coin_gast` double(15,2) NOT NULL DEFAULT '0.00',
  `boost_percentage` double(15,2) NOT NULL DEFAULT '0.00',
  `collection_hour` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.generals: ~1 rows (approximately)
/*!40000 ALTER TABLE `generals` DISABLE KEYS */;
REPLACE INTO `generals` (`id`, `title`, `social`, `description`, `favicon`, `logo_sm`, `logo_light`, `logo_dark`, `coin_gast`, `coin_ttg`, `coin_args`, `transfer_tax`, `transfer_ttg`, `topUp_tax`, `payout_tax`, `energy_exchange`, `energy_exchange_coin_gast`, `boost_percentage`, `collection_hour`, `created_at`, `updated_at`) VALUES
	(1, 'ARGS', 'https://api.whatsapp.com/send/?phone=62', NULL, NULL, '1620051452logo_sm.png', '1619462486logo_light.png', '1620055627logo_dark.svg', 'coin_gast.svg', '1620051590coin_ttg.png', '1620051535coin_args.png', 0.00, 0.10, 0.00, 0.00, 10.00, 0.00, 1.00, 1, '2020-11-15 19:08:50', '2021-05-03 22:27:07');
/*!40000 ALTER TABLE `generals` ENABLE KEYS */;

-- Dumping structure for table args.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.migrations: ~37 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_03_06_023521_create_admins_table', 1),
	(4, '2017_03_06_053834_create_admin_role_table', 1),
	(5, '2018_03_06_023523_create_roles_table', 1),
	(6, '2019_12_01_120121_create_permissions_table', 1),
	(7, '2019_12_01_163205_create_permission_role_table', 1),
	(8, '2019_12_01_163233_create_admin_permission_table', 1),
	(10, '2020_11_14_171116_create_generals_table', 1),
	(36, '2021_04_24_044803_create_payouts_table', 2),
	(37, '2021_04_24_044907_create_top_ups_table', 2),
	(38, '2021_04_24_200713_create_coins_table', 3),
	(39, '2021_04_24_200740_create_coin_collects_table', 3),
	(40, '2021_04_24_200753_create_puzzle_collects_table', 3),
	(41, '2021_04_24_200828_create_puzzle_piece_collects_table', 3),
	(42, '2021_04_24_200841_create_puzzles_table', 3),
	(43, '2021_04_24_200852_create_puzzle_pieces_table', 3),
	(44, '2021_04_24_211653_create_rewards_table', 3),
	(45, '2021_04_24_211706_create_reward_collects_table', 3),
	(46, '2021_04_25_184316_create_transfers_table', 4),
	(47, '2021_04_25_184506_create_weapons_table', 4),
	(48, '2021_04_25_184527_create_weapon_collects_table', 4),
	(49, '2021_04_27_020215_create_antagonists_table', 5),
	(51, '2021_04_27_021328_create_weapon_attacks_table', 5),
	(52, '2021_04_27_051256_create_reward_collect_histories_table', 6),
	(53, '2021_04_27_055024_create_reward_claims_table', 7),
	(54, '2021_04_27_055648_create_reward_sells_table', 7),
	(55, '2021_04_27_065924_create_reward_buys_table', 8),
	(56, '2021_04_27_090551_create_coin_claims_table', 9),
	(57, '2021_04_27_090740_create_puzzle_claims_table', 9),
	(58, '2021_04_27_100515_create_puzzle_collect_histories_table', 10),
	(59, '2021_04_27_101329_create_puzzle_piece_collect_histories_table', 11),
	(60, '2021_04_27_125342_create_puzzle_piece_buys_table', 12),
	(61, '2021_04_27_125352_create_puzzle_piece_sells_table', 12),
	(62, '2021_04_27_152500_create_energy_boosts_table', 13),
	(63, '2021_05_02_015106_create_weapon_buys_table', 14),
	(64, '2021_05_02_050821_create_antagonist_attacks_table', 15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table args.payouts
CREATE TABLE IF NOT EXISTS `payouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `proof_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `tax` double(15,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','declined','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.payouts: ~0 rows (approximately)
/*!40000 ALTER TABLE `payouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `payouts` ENABLE KEYS */;

-- Dumping structure for table args.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.permissions: ~8 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
	(1, 'CreateAdmin', 'Admin', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(2, 'CreateRole', 'Role', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(3, 'ReadAdmin', 'Admin', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(4, 'ReadRole', 'Role', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(5, 'UpdateAdmin', 'Admin', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(6, 'UpdateRole', 'Role', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(7, 'DeleteAdmin', 'Admin', '2020-11-15 12:07:53', '2020-11-15 12:07:53'),
	(8, 'DeleteRole', 'Role', '2020-11-15 12:07:53', '2020-11-15 12:07:53');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table args.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_role_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.permission_role: ~8 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
REPLACE INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(2, 1, 2, NULL, NULL),
	(3, 1, 3, NULL, NULL),
	(4, 1, 4, NULL, NULL),
	(5, 1, 5, NULL, NULL),
	(6, 1, 6, NULL, NULL),
	(7, 1, 7, NULL, NULL),
	(8, 1, 8, NULL, NULL);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping structure for table args.puzzles
CREATE TABLE IF NOT EXISTS `puzzles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `amount_combine` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `pieces` int(11) NOT NULL DEFAULT '0',
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzles: ~2 rows (approximately)
/*!40000 ALTER TABLE `puzzles` DISABLE KEYS */;
REPLACE INTO `puzzles` (`id`, `title`, `image`, `amount`, `amount_combine`, `energy`, `pieces`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Puzzle 1', 'full.svg', 10.00, 3.00, 1.00, 12, '', '2021-04-25 18:05:26', '2021-05-05 18:18:43'),
	(2, 'Puzle Two', 'piecetwo.svg', 1.00, 5.00, 5.00, 16, 'show', '2021-04-26 22:39:55', '2021-04-27 02:37:24');
/*!40000 ALTER TABLE `puzzles` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_claims
CREATE TABLE IF NOT EXISTS `puzzle_claims` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puzzle_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puzzle_collect_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_claims: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_claims` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_collects
CREATE TABLE IF NOT EXISTS `puzzle_collects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_collects: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_collects` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_collects` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_collect_histories
CREATE TABLE IF NOT EXISTS `puzzle_collect_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_id` int(11) NOT NULL,
  `puzzle_collect_id` int(11) NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_collect_histories: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_collect_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_collect_histories` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_pieces
CREATE TABLE IF NOT EXISTS `puzzle_pieces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `puzzle_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '2',
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_pieces: ~28 rows (approximately)
/*!40000 ALTER TABLE `puzzle_pieces` DISABLE KEYS */;
REPLACE INTO `puzzle_pieces` (`id`, `puzzle_id`, `position`, `title`, `image`, `amount`, `energy`, `qty`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Piece #1', '1.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(2, 1, 2, 'Piece #2', '2.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(3, 1, 3, 'Piece #3', '3.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(4, 1, 4, 'Piece #4', '4.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(5, 1, 5, 'Piece #5', '5.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(6, 1, 6, 'Piece #6', '6.svg', 2.00, 10.00, 2, '', '2021-04-25 18:38:33', '2021-05-02 04:00:05'),
	(7, 1, 7, 'Piece #7', '7.svg', 2.00, 5.00, 2, 'hide', '2021-04-25 18:38:33', '2021-05-02 04:05:24'),
	(8, 1, 8, 'Piece #8', '8.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(9, 1, 9, 'Piece #9', '9.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(10, 1, 10, 'Piece #10', '10.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(11, 1, 11, 'Piece #11', '11.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(12, 1, 12, 'Piece #12', '12.svg', 2.00, 4.00, 2, 'show', '2021-04-25 18:38:33', '2021-04-25 18:38:33'),
	(13, 2, 1, 'Puzle Two Piece #1', 'piecetwo1.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(14, 2, 2, 'Puzle Two Piece #2', 'piecetwo2.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(15, 2, 3, 'Puzle Two Piece #3', 'piecetwo3.svg', 1.00, 5.00, 2, 'hide', '2021-04-26 22:39:55', '2021-05-02 04:08:17'),
	(16, 2, 4, 'Puzle Two Piece #4', 'piecetwo4.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(17, 2, 5, 'Puzle Two Piece #5', 'piecetwo5.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(18, 2, 6, 'Puzle Two Piece #6', 'piecetwo6.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(19, 2, 7, 'Puzle Two Piece #7', 'piecetwo7.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(20, 2, 8, 'Puzle Two Piece #8', 'piecetwo8.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(21, 2, 9, 'Puzle Two Piece #9', 'piecetwo9.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(22, 2, 10, 'Puzle Two Piece #10', 'piecetwo10.svg', 1.00, 5.00, 2, 'hide', '2021-04-26 22:39:55', '2021-05-02 04:07:33'),
	(23, 2, 11, 'Puzle Two Piece #11', 'piecetwo11.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(24, 2, 12, 'Puzle Two Piece #12', 'piecetwo12.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(25, 2, 13, 'Puzle Two Piece #13', 'piecetwo13.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(26, 2, 14, 'Puzle Two Piece #14', 'piecetwo14.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(27, 2, 15, 'Puzle Two Piece #15', 'piecetwo15.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55'),
	(28, 2, 16, 'Puzle Two Piece #16', 'piecetwo16.svg', 1.00, 5.00, 2, 'show', '2021-04-26 22:39:55', '2021-04-26 22:39:55');
/*!40000 ALTER TABLE `puzzle_pieces` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_piece_buys
CREATE TABLE IF NOT EXISTS `puzzle_piece_buys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_piece_id` int(11) NOT NULL,
  `puzzle_piece_collect_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `puzzle_piece_sell_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_piece_buys: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_piece_buys` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_piece_buys` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_piece_collects
CREATE TABLE IF NOT EXISTS `puzzle_piece_collects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_id` int(11) NOT NULL,
  `puzzle_piece_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_piece_collects: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_piece_collects` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_piece_collects` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_piece_collect_histories
CREATE TABLE IF NOT EXISTS `puzzle_piece_collect_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_piece_id` int(11) NOT NULL,
  `puzzle_piece_collect_id` int(11) NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_piece_collect_histories: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_piece_collect_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_piece_collect_histories` ENABLE KEYS */;

-- Dumping structure for table args.puzzle_piece_sells
CREATE TABLE IF NOT EXISTS `puzzle_piece_sells` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `puzzle_piece_id` int(11) NOT NULL,
  `puzzle_piece_collect_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.puzzle_piece_sells: ~0 rows (approximately)
/*!40000 ALTER TABLE `puzzle_piece_sells` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle_piece_sells` ENABLE KEYS */;

-- Dumping structure for table args.rewards
CREATE TABLE IF NOT EXISTS `rewards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.rewards: ~2 rows (approximately)
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
REPLACE INTO `rewards` (`id`, `title`, `image`, `amount`, `energy`, `qty`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Mercedes Benz', '1619463063reward.webp', 50000.00, 10.00, 2, NULL, 'show', '2021-04-25 17:57:06', '2021-04-27 01:51:09'),
	(2, 'Ninja Kawasaki', '1619463035reward.jpg', 100.00, 5.00, 2, NULL, 'show', '2021-04-25 17:58:32', '2021-04-27 01:50:35');
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;

-- Dumping structure for table args.reward_buys
CREATE TABLE IF NOT EXISTS `reward_buys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `reward_collect_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `reward_sell_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.reward_buys: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_buys` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_buys` ENABLE KEYS */;

-- Dumping structure for table args.reward_claims
CREATE TABLE IF NOT EXISTS `reward_claims` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reward_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reward_collect_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_address` longtext COLLATE utf8mb4_unicode_ci,
  `recipient_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.reward_claims: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_claims` ENABLE KEYS */;

-- Dumping structure for table args.reward_collects
CREATE TABLE IF NOT EXISTS `reward_collects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `qty` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.reward_collects: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_collects` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_collects` ENABLE KEYS */;

-- Dumping structure for table args.reward_collect_histories
CREATE TABLE IF NOT EXISTS `reward_collect_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `reward_collect_id` int(11) NOT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.reward_collect_histories: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_collect_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_collect_histories` ENABLE KEYS */;

-- Dumping structure for table args.reward_sells
CREATE TABLE IF NOT EXISTS `reward_sells` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `reward_id` int(11) NOT NULL DEFAULT '0',
  `reward_collect_id` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.reward_sells: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_sells` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_sells` ENABLE KEYS */;

-- Dumping structure for table args.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'super', '2020-11-15 12:07:53', '2020-11-15 12:07:53');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table args.top_ups
CREATE TABLE IF NOT EXISTS `top_ups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `proof_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `tax` double(15,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','declined','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.top_ups: ~0 rows (approximately)
/*!40000 ALTER TABLE `top_ups` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_ups` ENABLE KEYS */;

-- Dumping structure for table args.transfers
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `tax` double(15,2) NOT NULL DEFAULT '0.00',
  `ttg` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('ARGS','GAST','TTG') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.transfers: ~0 rows (approximately)
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;

-- Dumping structure for table args.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double(15,2) NOT NULL DEFAULT '0.00',
  `coin_gast` double(15,2) NOT NULL DEFAULT '0.00',
  `coin_ttg` double(15,2) NOT NULL DEFAULT '0.00',
  `energy` double(15,2) NOT NULL DEFAULT '0.00',
  `energy_quota` double(15,2) NOT NULL DEFAULT '0.00',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `image`, `address`, `city`, `country`, `zipcode`, `phone`, `birth`, `balance`, `coin_gast`, `coin_ttg`, `energy`, `energy_quota`, `remember_token`, `google_id`, `created_at`, `updated_at`) VALUES
	(1, 'user', 'user', 'user@gmail.com', NULL, '$2y$10$SK10IcF6r9G3uM3vxbe7AeL/kSxXh0fcqD9XbPIy4Opv.skjlFZ4y', 'default.png', NULL, 'Aceh Jaya', NULL, NULL, NULL, NULL, 1078.00, 1094.68, 9699740.86, 95.00, 1900.00, NULL, NULL, '2021-04-24 06:19:21', '2021-05-05 19:15:10'),
	(2, 'user2', 'user2', 'user2@gmail.com', NULL, '$2y$10$SK10IcF6r9G3uM3vxbe7AeL/kSxXh0fcqD9XbPIy4Opv.skjlFZ4y', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, 1010.00, 1001.00, 10000001.00, 1188.00, 1100.00, NULL, NULL, '2021-05-01 08:26:28', '2021-05-05 19:15:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table args.weapons
CREATE TABLE IF NOT EXISTS `weapons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `antagonist_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.weapons: ~2 rows (approximately)
/*!40000 ALTER TABLE `weapons` DISABLE KEYS */;
REPLACE INTO `weapons` (`id`, `antagonist_id`, `title`, `image`, `amount`, `status`, `created_at`, `updated_at`) VALUES
	(2, NULL, 'Riffle', '1619943225weapon.svg', 50.00, 'show', '2021-05-02 14:55:13', '2021-05-02 15:13:45'),
	(3, 1, 'Gun', '1619943238weapon.svg', 10.00, 'hide', '2021-05-02 15:12:19', '2021-05-04 16:58:32');
/*!40000 ALTER TABLE `weapons` ENABLE KEYS */;

-- Dumping structure for table args.weapon_attacks
CREATE TABLE IF NOT EXISTS `weapon_attacks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weapon_id` int(11) NOT NULL,
  `weapon_collect_id` int(11) NOT NULL,
  `antagonist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.weapon_attacks: ~0 rows (approximately)
/*!40000 ALTER TABLE `weapon_attacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `weapon_attacks` ENABLE KEYS */;

-- Dumping structure for table args.weapon_buys
CREATE TABLE IF NOT EXISTS `weapon_buys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `weapon_id` int(11) NOT NULL,
  `weapon_collect_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `total` double(15,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.weapon_buys: ~0 rows (approximately)
/*!40000 ALTER TABLE `weapon_buys` DISABLE KEYS */;
/*!40000 ALTER TABLE `weapon_buys` ENABLE KEYS */;

-- Dumping structure for table args.weapon_collects
CREATE TABLE IF NOT EXISTS `weapon_collects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `weapon_id` int(11) NOT NULL,
  `qty` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table args.weapon_collects: ~0 rows (approximately)
/*!40000 ALTER TABLE `weapon_collects` DISABLE KEYS */;
/*!40000 ALTER TABLE `weapon_collects` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
