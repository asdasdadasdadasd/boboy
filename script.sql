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
  `update_checker` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.brands: ~2 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_status`, `update_checker`) VALUES
	(14, 'SleepNot', 0, 1),
	(15, 'Starbucks', 0, 1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL DEFAULT '0',
  `item_qty` int(2) NOT NULL DEFAULT '0',
  `subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000104 DEFAULT CHARSET=latin1;

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

-- Dumping data for table db_sleepnotgo.items: ~7 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`item_id`, `brand_id`, `item_name`, `item_description`, `item_size`, `item_price`, `item_img`, `item_status`, `created_at`) VALUES
	(16, 14, 'Hot Choco', 'Hot chocolate, also known as hot cocoa, drinking chocolate or just cocoa is a heated beverage consisting of shaved chocolate, melted chocolate or cocoa powder, heated milk or water, and usually a sweetener.', '', 65.00, 'hot choco.jpg', 1, '2017-12-07 10:49:10'),
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
) ENGINE=MyISAM AUTO_INCREMENT=50000051 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.oitem: 8 rows
/*!40000 ALTER TABLE `oitem` DISABLE KEYS */;
INSERT INTO `oitem` (`oi_id`, `order_id`, `item_id`, `oi_qty`, `oi_subtotal`, `usr_id`) VALUES
	(50000044, 20000040, 17, 1, 45.00, 1),
	(50000045, 20000040, 30, 1, 145.00, 1),
	(50000046, 20000041, 17, 10, 450.00, 1),
	(50000047, 20000042, 17, 1, 45.00, 1),
	(50000048, 20000043, 18, 1, 55.00, 1),
	(50000049, 20000044, 17, 1, 45.00, 1),
	(50000050, 20000045, 17, 1, 45.00, 1),
	(50000043, 20000039, 18, 1, 55.00, 30);
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
) ENGINE=MyISAM AUTO_INCREMENT=20000046 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.orders: 7 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `order_total`, `created_at`, `order_status`, `approved_by`, `usr_id`) VALUES
	(20000045, 45.00, '2017-12-15 13:56:17', 0, 0, 1),
	(20000044, 45.00, '2017-12-13 18:36:20', 0, 0, 1),
	(20000043, 55.00, '2017-12-13 18:36:06', 0, 0, 1),
	(20000042, 45.00, '2017-12-13 18:35:40', 0, 0, 1),
	(20000041, 450.00, '2017-12-13 18:30:01', 0, 0, 1),
	(20000040, 190.00, '2017-12-13 15:00:11', 0, 0, 1),
	(20000039, 55.00, '2017-12-13 11:29:38', 0, 0, 30);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`, `usr_status`, `brand_id`, `usr_address`, `usr_contact`) VALUES
	(1, 'John Carlo Octabio', 'jacotabio@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 0, 'Ubiquity Global Services, Negros First Cybercentre, Bacolod City', '09437095893'),
	(26, 'SleepNot', 'sleepnot@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 1, 14, '', 'N/A'),
	(27, 'Starbucks', 'coffee@starbucks.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 15, '', 'N/A'),
	(28, 'Ron Guanzon', 'ronguanzon@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, 0, '', 'N/A'),
	(29, 'Jeland Quinamot', 'jelandquinamot@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, 0, '', 'N/A'),
	(30, 'Rafael Davis', 'rd0_0@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 0, '', 'N/A');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
