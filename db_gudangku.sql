-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_gudangku
DROP DATABASE IF EXISTS `db_gudangku`;
CREATE DATABASE IF NOT EXISTS `db_gudangku` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_gudangku`;

-- Dumping structure for table db_gudangku.tb_categories
DROP TABLE IF EXISTS `tb_categories`;
CREATE TABLE IF NOT EXISTS `tb_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_categories: ~2 rows (approximately)
DELETE FROM `tb_categories`;
INSERT INTO `tb_categories` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(3, 'K001', '2024-12-19 19:54:19', 12345, '2025-01-11 19:05:41', 12345),
	(4, 'K002', '2025-01-11 19:15:58', 12345, '2025-01-11 19:15:58', 0);

-- Dumping structure for table db_gudangku.tb_employees
DROP TABLE IF EXISTS `tb_employees`;
CREATE TABLE IF NOT EXISTS `tb_employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` int NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level_id` int DEFAULT '0',
  `address` text COLLATE utf8mb4_general_ci,
  `phone` bigint DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'default : 12345678',
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `level_id` (`level_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_employees: ~2 rows (approximately)
DELETE FROM `tb_employees`;
INSERT INTO `tb_employees` (`id`, `nik`, `name`, `gender`, `level_id`, `address`, `phone`, `password`, `remember_token`, `ip_address`, `login_at`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 12345, 'Mahdian', 'Laki-Laki', 1, NULL, NULL, '$2y$12$ZAGm4XKSOQNhm9j4fK/fBeA.i5sxrsZwyi2sjj0mmueGTGDurKmBm', NULL, '127.0.0.1', '2025-05-18 03:55:20', NULL, 0, '2025-05-19 10:43:53', 12345),
	(2, 67890, 'Mamat', 'Laki-Laki', 3, NULL, NULL, '$2y$12$ZAGm4XKSOQNhm9j4fK/fBeA.i5sxrsZwyi2sjj0mmueGTGDurKmBm', NULL, NULL, NULL, '2024-12-21 16:06:38', 12345, '2025-05-19 10:43:41', 0);

-- Dumping structure for table db_gudangku.tb_levels
DROP TABLE IF EXISTS `tb_levels`;
CREATE TABLE IF NOT EXISTS `tb_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_levels: ~4 rows (approximately)
DELETE FROM `tb_levels`;
INSERT INTO `tb_levels` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 'administrator', NULL, 0, '2024-12-18 18:04:44', 0),
	(2, 'cashier', NULL, 0, '2024-12-18 18:04:44', 0),
	(3, 'supplier', NULL, 0, '2024-12-18 18:04:44', 0),
	(4, 'warehouse', NULL, 0, '2024-12-18 18:04:44', 0);

-- Dumping structure for table db_gudangku.tb_products
DROP TABLE IF EXISTS `tb_products`;
CREATE TABLE IF NOT EXISTS `tb_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL DEFAULT '0',
  `code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int DEFAULT '0',
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purchase_price` bigint DEFAULT '0',
  `selling_price` bigint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `category_id` (`category_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_products: ~2 rows (approximately)
DELETE FROM `tb_products`;
INSERT INTO `tb_products` (`id`, `category_id`, `code`, `name`, `quantity`, `unit`, `purchase_price`, `selling_price`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(2, 3, 'B001', 'Buku', 10, 'Pcs', 15000, 16500, '2024-12-19 20:23:15', 12345, '2025-01-11 19:05:51', 12345),
	(3, 4, 'ATK001', 'Pulpen', 20, 'Pcs', 1250, 2000, '2025-01-11 19:20:34', 12345, '2025-01-11 19:20:34', 0);

-- Dumping structure for table db_gudangku.tb_purchases
DROP TABLE IF EXISTS `tb_purchases`;
CREATE TABLE IF NOT EXISTS `tb_purchases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `total_amount` bigint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_purchases: ~0 rows (approximately)
DELETE FROM `tb_purchases`;

-- Dumping structure for table db_gudangku.tb_purchase_items
DROP TABLE IF EXISTS `tb_purchase_items`;
CREATE TABLE IF NOT EXISTS `tb_purchase_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int DEFAULT '0',
  `product_id` int DEFAULT '0',
  `quantity` int DEFAULT '0',
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` bigint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_purchase_items: ~0 rows (approximately)
DELETE FROM `tb_purchase_items`;

-- Dumping structure for table db_gudangku.tb_receipts
DROP TABLE IF EXISTS `tb_receipts`;
CREATE TABLE IF NOT EXISTS `tb_receipts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_date` datetime DEFAULT NULL,
  `total_items` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_receipts: ~0 rows (approximately)
DELETE FROM `tb_receipts`;

-- Dumping structure for table db_gudangku.tb_receipt_items
DROP TABLE IF EXISTS `tb_receipt_items`;
CREATE TABLE IF NOT EXISTS `tb_receipt_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT '0' COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT '0' COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `receipt_id` (`receipt_id`),
  KEY `product_id` (`product_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_gudangku.tb_receipt_items: ~0 rows (approximately)
DELETE FROM `tb_receipt_items`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
