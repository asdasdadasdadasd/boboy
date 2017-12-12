-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_sleepnotgo
CREATE DATABASE IF NOT EXISTS `db_sleepnotgo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_sleepnotgo`;

-- Dumping structure for table db_sleepnotgo.auth
CREATE TABLE IF NOT EXISTS `auth` (
  `auth_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.auth: ~2 rows (approximately)
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` (`auth_id`, `auth_name`) VALUES
	(1, 'User'),
	(2, 'Partnership Brand');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL DEFAULT '',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.brands: ~2 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_status`) VALUES
	(14, 'SleepNot', 0),
	(15, 'Starbucks', 0);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL DEFAULT '0',
  `item_qty` int(2) NOT NULL DEFAULT '0',
  `subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000075 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.cart: 0 rows
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.items
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(3) NOT NULL DEFAULT '0',
  `item_name` varchar(255) NOT NULL DEFAULT '',
  `item_description` varchar(255) NOT NULL DEFAULT '',
  `item_size` varchar(255) NOT NULL DEFAULT '',
  `item_price` float(10,2) NOT NULL DEFAULT '0.00',
  `item_img` varchar(255) NOT NULL DEFAULT '',
  `item_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.items: ~8 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`item_id`, `brand_id`, `item_name`, `item_description`, `item_size`, `item_price`, `item_img`, `item_status`, `created_at`) VALUES
	(16, 14, 'Hot Choco', 'Hot chocolate, also known as hot cocoa, drinking chocolate or just cocoa is a heated beverage consisting of shaved chocolate, melted chocolate or cocoa powder, heated milk or water, and usually a sweetener.', '', 65.00, 'R_Roasted_Coffee_Bean_Close_Up_1024x1024_c66b88fe-3fa7-4146-aa12-d7c2e5c1f3d4_grande.jpg', 1, '2017-12-07 10:49:10'),
	(17, 14, 'Iced Coffee', 'Iced coffee is cold coffee with ice. The iced latte and iced mocha are examples. There are various brewing methods, with the fundamental division being cold brew.', '', 45.00, 'sleepnot.jpg', 1, '2017-12-07 11:05:59'),
	(18, 14, 'Coffee Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 55.00, 'tomncinno.jpg', 1, '2017-12-07 11:09:28'),
	(19, 14, 'Brewed Coffee w/ Milk', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 30.00, 'brewed coffee.jpg', 1, '2017-12-07 11:10:59'),
	(20, 14, 'Caramel Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 70.00, 'caramel_flan_latte.jpg', 1, '2017-12-07 11:12:58'),
	(26, 14, 'White Coffee', 'Lorem ipsum', '', 100.00, 'hot choco.jpg', 1, '2017-12-07 16:44:46'),
	(30, 15, 'White Hot Mocha Latte', 'Lorem ipsum dolor sit amet jud pud pud ba kana ba', '', 145.00, 'mocha latte.jpg', 1, '2017-12-08 17:34:19'),
	(31, 14, 'Espresso', 'Espresso is coffee brewed by forcing a small amount of nearly boiling water under pressure through finely ground coffee beans.', '', 180.00, 'espresso_830x550.jpg', 1, '2017-12-09 13:57:48');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.oitem
CREATE TABLE IF NOT EXISTS `oitem` (
  `oi_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(8) NOT NULL DEFAULT '0',
  `item_id` int(8) NOT NULL DEFAULT '0',
  `oi_qty` int(2) NOT NULL DEFAULT '0',
  `oi_subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oi_id`),
  KEY `item_id` (`item_id`,`order_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50000032 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.oitem: 8 rows
/*!40000 ALTER TABLE `oitem` DISABLE KEYS */;
INSERT INTO `oitem` (`oi_id`, `order_id`, `item_id`, `oi_qty`, `oi_subtotal`, `usr_id`) VALUES
	(50000029, 20000025, 30, 1, 145.00, 1),
	(50000028, 20000024, 17, 6, 270.00, 1),
	(50000026, 20000022, 30, 1, 145.00, 28),
	(50000025, 20000021, 30, 1, 145.00, 28),
	(50000027, 20000023, 17, 3, 135.00, 29),
	(50000023, 20000020, 16, 2, 130.00, 28),
	(50000030, 20000026, 16, 1, 65.00, 1),
	(50000031, 20000026, 30, 1, 145.00, 1);
/*!40000 ALTER TABLE `oitem` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_total` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_status` int(1) NOT NULL DEFAULT '0',
  `approved_by` int(1) NOT NULL DEFAULT '0',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20000027 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.orders: 7 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `order_total`, `created_at`, `order_status`, `approved_by`, `usr_id`) VALUES
	(20000024, 270.00, '2017-12-11 12:58:12', 0, 0, 1),
	(20000023, 135.00, '2017-12-11 11:28:27', 0, 0, 29),
	(20000022, 145.00, '2017-12-09 18:15:38', 0, 0, 28),
	(20000021, 175.00, '2017-12-09 18:15:29', 0, 0, 28),
	(20000020, 130.00, '2017-12-09 18:15:14', 0, 0, 28),
	(20000025, 145.00, '2017-12-12 14:55:32', 0, 0, 1),
	(20000026, 210.00, '2017-12-12 14:55:59', 0, 0, 1);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.users
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(255) NOT NULL DEFAULT '',
  `usr_email` varchar(255) NOT NULL DEFAULT '',
  `usr_password` varchar(255) NOT NULL DEFAULT '',
  `usr_auth` int(1) NOT NULL DEFAULT '0',
  `usr_status` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(1) NOT NULL DEFAULT '0',
  `usr_address` varchar(255) NOT NULL DEFAULT '',
  `usr_contact` varchar(50) NOT NULL DEFAULT 'N/A',
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`, `usr_status`, `brand_id`, `usr_address`, `usr_contact`) VALUES
	(1, 'John Carlo Octabio', 'jacotabio@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 0, 'Ubiquity Global Services, Negros First Cybercentre, Bacolod City', '09437095893'),
	(26, 'SleepNot', 'sleepnot@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 1, 14, '', 'N/A'),
	(27, 'Starbucks', 'coffee@starbucks.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 15, '', 'N/A'),
	(28, 'Ron Guanzon', 'ronguanzon@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, 0, '', 'N/A'),
	(29, 'Jeland Quinamot', 'jelandquinamot@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, 0, '', 'N/A');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
