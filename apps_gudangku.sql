-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for apps_gudangku
CREATE DATABASE IF NOT EXISTS `apps_gudangku` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `apps_gudangku`;

-- Dumping structure for table apps_gudangku.tb_categories
CREATE TABLE IF NOT EXISTS `tb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_categories: ~2 rows (approximately)
DELETE FROM `tb_categories`;
INSERT INTO `tb_categories` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(3, 'K001', '2024-12-19 19:54:19', 12345, '2025-01-11 19:05:41', 12345),
	(4, 'K002', '2025-01-11 19:15:58', 12345, '2025-01-11 19:15:58', 0);

-- Dumping structure for table apps_gudangku.tb_employees
CREATE TABLE IF NOT EXISTS `tb_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `gender` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `level_id` int(11) DEFAULT 0,
  `address` text DEFAULT NULL,
  `phone` bigint(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `level_id` (`level_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_employees: ~2 rows (approximately)
DELETE FROM `tb_employees`;
INSERT INTO `tb_employees` (`id`, `nik`, `name`, `gender`, `level_id`, `address`, `phone`, `password`, `remember_token`, `ip_address`, `login_at`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 12345, 'Mahdian', 'Laki-Laki', 1, NULL, 85156717117, '$2y$12$Pforu.OcbXmKqFvrapRED.8BWP7oPLzm20HhgGl7mAisY.JWYlDE2', 'ab3cUJPfnMlV3sdWyG4LrlNEyx9hIFbFueVUs4v0PSNdD4u9fqL8TWvxiqTV', '127.0.0.1', '2025-01-11 19:04:54', NULL, 0, '2025-01-11 19:04:54', 12345),
	(2, 67890, 'Mamat', 'Laki-Laki', 3, NULL, 88888888, '$2y$12$SetL.ayOgqigPML4/uNmJeljmvbgAU5XMkyk5j0Sg.r7/4v0XEujG', NULL, NULL, NULL, '2024-12-21 16:06:38', 12345, '2024-12-21 16:06:38', 0);

-- Dumping structure for table apps_gudangku.tb_levels
CREATE TABLE IF NOT EXISTS `tb_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_levels: ~5 rows (approximately)
DELETE FROM `tb_levels`;
INSERT INTO `tb_levels` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, 'administrator', NULL, 0, '2024-12-18 18:04:44', 0),
	(2, 'cashier', NULL, 0, '2024-12-18 18:04:44', 0),
	(3, 'supplier', NULL, 0, '2024-12-18 18:04:44', 0),
	(4, 'warehouse', NULL, 0, '2024-12-18 18:04:44', 0);

-- Dumping structure for table apps_gudangku.tb_products
CREATE TABLE IF NOT EXISTS `tb_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `unit` varchar(50) DEFAULT NULL,
  `purchase_price` bigint(20) DEFAULT 0,
  `selling_price` bigint(20) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `category_id` (`category_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_products: ~2 rows (approximately)
DELETE FROM `tb_products`;
INSERT INTO `tb_products` (`id`, `category_id`, `code`, `name`, `quantity`, `unit`, `purchase_price`, `selling_price`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(2, 3, 'B001', 'Buku', 10, 'Pcs', 15000, 16500, '2024-12-19 20:23:15', 12345, '2025-01-11 19:05:51', 12345),
	(3, 4, 'ATK001', 'Pulpen', 20, 'Pcs', 1250, 2000, '2025-01-11 19:20:34', 12345, '2025-01-11 19:20:34', 0);

-- Dumping structure for table apps_gudangku.tb_purchases
CREATE TABLE IF NOT EXISTS `tb_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `total_amount` bigint(20) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_purchases: ~0 rows (approximately)
DELETE FROM `tb_purchases`;

-- Dumping structure for table apps_gudangku.tb_purchase_items
CREATE TABLE IF NOT EXISTS `tb_purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT 0,
  `product_id` int(11) DEFAULT 0,
  `quantity` int(11) DEFAULT 0,
  `unit` varchar(50) DEFAULT NULL,
  `price` bigint(20) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_purchase_items: ~0 rows (approximately)
DELETE FROM `tb_purchase_items`;

-- Dumping structure for table apps_gudangku.tb_receipts
CREATE TABLE IF NOT EXISTS `tb_receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_date` datetime DEFAULT NULL,
  `total_items` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_receipts: ~0 rows (approximately)
DELETE FROM `tb_receipts`;

-- Dumping structure for table apps_gudangku.tb_receipt_items
CREATE TABLE IF NOT EXISTS `tb_receipt_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT 0 COMMENT 'employee_nik',
  PRIMARY KEY (`id`),
  KEY `receipt_id` (`receipt_id`),
  KEY `product_id` (`product_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table apps_gudangku.tb_receipt_items: ~0 rows (approximately)
DELETE FROM `tb_receipt_items`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
