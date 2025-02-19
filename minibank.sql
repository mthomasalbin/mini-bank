-- Adminer 4.8.1 MySQL 8.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `password`, `balance`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Test User',	'test@test.com',	'1234567890',	'$2y$10$P1mwExavNrWr3G/b87s4.eCUqgSPyAHHQdGuTUv83qnjjUkGqOO.u',	150.00,	'active',	'2025-02-18 14:26:10',	'2025-02-18 17:08:27',	NULL),
(3,	'Albin M Thomas',	'testing@test.com',	'9605199721',	'$2y$10$p7tsGDY1Ghz3l4rZy5IWvOML4UeCZ4TVlSkhlw1SD/s0RBfAPhoUu',	0.00,	'active',	'2025-02-18 15:02:17',	'2025-02-18 15:02:17',	NULL),
(4,	'Teshjdnk',	'hshdfh@afjsnf.com',	'6294809402',	'$2y$10$dWKDwuJplHqaIbsvGk0fZOPXyUeHr7UWbVwMg4zcuVdtHwlXzJWQi',	0.00,	'active',	'2025-02-18 15:18:21',	'2025-02-18 15:18:21',	NULL),
(5,	'Tetsinfff',	'ffehsdhh@adnkk.com',	'2684238599',	'$2y$10$BRn8kMtb4.QoJ0C0e8Csq.4ppoCGnP.0Xeq.psWZ9ufH.oOCuetLy',	0.00,	'active',	'2025-02-18 15:19:10',	'2025-02-18 15:19:10',	NULL),
(6,	'here',	'hey@gmail.com',	'1234568790',	'$2y$10$uEqvAUKtYS0yIXMd9FP.lO6y5TIOJoBNJ4uSSjLbsCEf4nK05Jvqm',	0.00,	'active',	'2025-02-18 16:29:54',	'2025-02-18 16:29:54',	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2025_02_18_154956_create_customers_table',	1),
(6,	'2025_02_18_155003_create_transactions_table',	1);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\Customer',	6,	'authToken',	'7fa3a465d20115b1176a2fe9e3169427daadaf0b03ef7bf205befe23dccc5086',	'[\"*\"]',	'2025-02-18 16:41:44',	NULL,	'2025-02-18 16:32:49',	'2025-02-18 16:41:44'),
(9,	'App\\Models\\Customer',	1,	'authToken',	'35b16b2661549cb328abe3c7b638fa563d4473708100e7e3b5f805575316bf01',	'[\"*\"]',	'2025-02-18 17:09:17',	NULL,	'2025-02-18 16:58:18',	'2025-02-18 17:09:17');

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `transaction_type` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit',
  `amount` decimal(10,2) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transactions` (`id`, `customer_id`, `transaction_type`, `amount`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'credit',	100.00,	'123.66.23.44',	'2025-02-18 15:59:37',	'2025-02-18 15:59:37',	NULL),
(2,	1,	'credit',	100.00,	'123.66.23.44',	'2025-02-18 16:01:37',	'2025-02-18 16:01:37',	NULL),
(3,	1,	'credit',	500.00,	'192.168.1.72',	'2025-02-18 16:50:52',	'2025-02-18 16:50:52',	NULL),
(4,	1,	'credit',	500.00,	'192.168.1.117',	'2025-02-18 16:58:44',	'2025-02-18 16:58:44',	NULL),
(5,	1,	'credit',	100.00,	'192.168.1.48',	'2025-02-18 17:01:27',	'2025-02-18 17:01:27',	NULL),
(6,	1,	'debit',	50.00,	'192.168.1.183',	'2025-02-18 17:05:36',	'2025-02-18 17:05:36',	NULL),
(7,	1,	'debit',	50.00,	'192.168.1.204',	'2025-02-18 17:05:55',	'2025-02-18 17:05:55',	NULL),
(8,	1,	'debit',	500.00,	'192.168.1.24',	'2025-02-18 17:06:19',	'2025-02-18 17:06:19',	NULL),
(9,	1,	'debit',	500.00,	'192.168.1.194',	'2025-02-18 17:08:10',	'2025-02-18 17:08:10',	NULL),
(10,	1,	'debit',	50.00,	'192.168.1.70',	'2025-02-18 17:08:27',	'2025-02-18 17:08:27',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `slug`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Super Admin',	'admin@minibank.com',	'2025-02-18 15:57:26',	'$2y$10$PtU6GlVhDO/Kj3FtHw.3xOZlJrmlnMX0E/dXSvKBgMFQx4Zuj0Sqm',	'active',	'super-admin',	'PkAamqoYiH',	'2025-02-18 15:57:26',	'2025-02-18 15:57:26',	NULL);

-- 2025-02-19 04:16:31
