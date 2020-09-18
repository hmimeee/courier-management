-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table courier.invoice
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table courier.invoice: ~1 rows (approximately)
DELETE FROM `invoice`;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` (`id`, `order_id`, `user_id`) VALUES
	(15, 3, 38),
	(16, 4, 39);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Dumping structure for table courier.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0',
  `recipient` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `recipient_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `amount` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status_id` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table courier.orders: ~3 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `item_name`, `store_id`, `recipient`, `recipient_number`, `recipient_address`, `amount`, `fee`, `payment_status`, `status_id`, `delivery_time`, `created_at`, `user_id`) VALUES
	(3, 'Imran', 15, 'HMI', '01782448244', 'Dhaka', 500, 20, 'Unpaid', 1, '12 Hours', '26-03-2020', 38),
	(4, 'Order Name', 17, 'HMI', '01782448244', 'Dhaka', 500, 20, 'Paid', 1, '12 Hours', '27-03-2020', 39),
	(5, 'New Order', 17, 'HMI Me', '01782448244', 'Dhaka', 500, 20, 'Paid', 5, '12 Hours', '27-03-2020', 39);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table courier.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table courier.status: ~5 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `name`, `description`) VALUES
	(1, 'Pending', 'Pending for Confirmation'),
	(2, 'Ready', 'Ready to Deliver'),
	(3, 'Delivered', 'Delivery Confirmed'),
	(4, 'Returned', 'Product Returned'),
	(5, 'Cancelled', 'Delivery Cancelled');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table courier.stores
DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table courier.stores: ~2 rows (approximately)
DELETE FROM `stores`;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` (`id`, `name`, `address`, `user_id`) VALUES
	(15, 'Store', '', NULL),
	(16, 'HMI Store', 'Dhaka', 38),
	(17, 'Raul Lacy', 'Dhaka', 39);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;

-- Dumping structure for table courier.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table courier.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role`) VALUES
	(38, 'Admin', 'admin@example.com', '09887885657', 'Dhaka', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
	(39, 'Imran', 'bfihelp@gmail.com', '', '', 'e10adc3949ba59abbe56e057f20f883e', 'marchant');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
