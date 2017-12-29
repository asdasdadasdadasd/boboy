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
	(14, 'SleepNot', 1, 1),
	(15, 'Starbucks', 1, 1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL DEFAULT '0',
  `item_qty` int(2) NOT NULL DEFAULT '0',
  `subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000271 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.cart: 0 rows
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `convo_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `brand_id` int(8) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`convo_id`),
  KEY `usr_id` (`usr_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.conversations: ~1 rows (approximately)
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` (`convo_id`, `usr_id`, `brand_id`, `created_at`) VALUES
	(16, 1, 14, '2017-12-29 20:05:51');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.fees
CREATE TABLE IF NOT EXISTS `fees` (
  `fee_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(255) NOT NULL DEFAULT '',
  `fee_price` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.fees: ~0 rows (approximately)
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` (`fee_id`, `fee_name`, `fee_price`) VALUES
	(1, 'Service Fee', 50.00);
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;

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
  PRIMARY KEY (`item_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.items: ~7 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`item_id`, `brand_id`, `item_name`, `item_description`, `item_size`, `item_price`, `item_img`, `item_status`, `created_at`) VALUES
	(17, 14, 'Iced Coffee', 'Iced coffee is cold coffee with ice. The iced latte and iced mocha are examples. There are various brewing methods, with the fundamental division being cold brew.', '', 45.00, 'sleepnot.jpg', 1, '2017-12-07 11:05:59'),
	(18, 14, 'Coffee Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 55.00, 'tomncinno.jpg', 1, '2017-12-07 11:09:28'),
	(19, 14, 'Brewed Coffee w/ Milk', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 30.00, 'brewed coffee.jpg', 1, '2017-12-07 11:10:59'),
	(20, 14, 'Caramel Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 70.00, 'caramel_flan_latte.jpg', 0, '2017-12-07 11:12:58'),
	(26, 14, 'White Coffee', 'Lorem ipsuma', '', 100.00, 'hot choco.jpg', 0, '2017-12-07 16:44:46'),
	(30, 15, 'White Hot Mocha Latte', 'Lorem ipsum dolor sit amet jud pud pud ba kana ba', '', 145.00, 'mocha latte.jpg', 1, '2017-12-08 17:34:19'),
	(31, 14, 'Espresso', 'Espresso is coffee brewed by forcing a small amount of nearly boiling water under pressure through finely ground coffee beans.', '', 180.00, 'espresso_830x550.jpg', 1, '2017-12-09 13:57:48');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `convo_id` bigint(11) NOT NULL DEFAULT '0',
  `msg` longtext NOT NULL,
  `sender_id` int(8) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_notif` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `convo_id` (`convo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.messages: ~4 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`msg_id`, `convo_id`, `msg`, `sender_id`, `created_at`, `show_notif`) VALUES
	(192, 16, 'sir', 14, '2017-12-29 20:05:51', 0),
	(193, 16, 'hi', 14, '2017-12-29 20:06:11', 0),
	(194, 16, 'musta?', 14, '2017-12-29 21:06:20', 0),
	(195, 16, 'asd', 14, '2017-12-29 21:06:36', 0),
	(196, 16, 'pst', 14, '2017-12-29 21:07:58', 0),
	(197, 16, 'as', 14, '2017-12-29 21:09:13', 0),
	(198, 16, 'asd', 14, '2017-12-29 21:11:39', 0),
	(199, 16, 'yow', 14, '2017-12-29 21:13:27', 0),
	(200, 16, 'asdasd', 14, '2017-12-29 21:13:49', 0),
	(201, 16, 'ad', 14, '2017-12-29 21:13:49', 0),
	(202, 16, 'as', 14, '2017-12-29 21:13:50', 0),
	(203, 16, 'asd', 14, '2017-12-29 21:14:14', 0),
	(204, 16, 'yow', 14, '2017-12-29 21:14:40', 0),
	(205, 16, 'asd', 14, '2017-12-29 21:15:11', 0),
	(206, 16, 'yow', 14, '2017-12-29 21:26:08', 0),
	(207, 16, 'pst', 14, '2017-12-29 21:26:27', 0),
	(208, 16, 'sir ', 14, '2017-12-29 21:26:40', 0),
	(209, 16, 'ang imo kape', 14, '2017-12-29 21:26:42', 0),
	(210, 16, 'wala ', 14, '2017-12-29 21:26:44', 0),
	(211, 16, 'hoy', 14, '2017-12-29 21:28:09', 0),
	(212, 16, 'abno', 14, '2017-12-29 21:28:19', 0),
	(213, 16, 'boss wala kami kape', 14, '2017-12-29 21:32:51', 0),
	(214, 16, 'hoy', 14, '2017-12-29 21:33:00', 0),
	(215, 16, 'gago', 14, '2017-12-29 21:33:01', 0),
	(216, 16, 'butwa', 14, '2017-12-29 21:33:02', 0),
	(217, 16, 'asd', 14, '2017-12-29 21:33:05', 0),
	(218, 16, 'asd', 14, '2017-12-29 21:33:06', 0),
	(219, 16, 'asd', 14, '2017-12-29 21:33:06', 0),
	(220, 16, 'as', 14, '2017-12-29 21:33:06', 0),
	(221, 16, 'as', 14, '2017-12-29 21:33:06', 0),
	(222, 16, 'sad', 14, '2017-12-29 21:33:06', 0),
	(223, 16, 'asdasd', 14, '2017-12-29 21:39:03', 0),
	(224, 16, 'asdasd', 14, '2017-12-29 21:39:25', 0),
	(225, 16, 'as', 14, '2017-12-29 21:39:30', 0),
	(226, 16, 'asd', 14, '2017-12-29 21:39:31', 0),
	(227, 16, 'asd', 14, '2017-12-29 21:39:31', 0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.oitem
CREATE TABLE IF NOT EXISTS `oitem` (
  `oi_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(8) NOT NULL DEFAULT '0',
  `item_id` int(8) NOT NULL DEFAULT '0',
  `oi_qty` int(2) NOT NULL DEFAULT '0',
  `oi_subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `oi_status` int(1) NOT NULL DEFAULT '0',
  `oi_delivery` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oi_id`),
  KEY `item_id` (`item_id`,`order_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50000210 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.oitem: 5 rows
/*!40000 ALTER TABLE `oitem` DISABLE KEYS */;
INSERT INTO `oitem` (`oi_id`, `order_id`, `item_id`, `oi_qty`, `oi_subtotal`, `usr_id`, `oi_status`, `oi_delivery`) VALUES
	(50000209, 20000121, 17, 1, 45.00, 1, 1, 2),
	(50000207, 20000120, 19, 1, 30.00, 31, 2, 0),
	(50000208, 20000120, 17, 1, 45.00, 31, 2, 0),
	(50000206, 20000120, 18, 1, 55.00, 31, 2, 0),
	(50000205, 20000120, 30, 1, 145.00, 31, 2, 0);
/*!40000 ALTER TABLE `oitem` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_total` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_status` int(1) NOT NULL DEFAULT '0',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `delivery_address` longtext NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `service_fee` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20000122 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.orders: 2 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `order_total`, `created_at`, `order_status`, `usr_id`, `delivery_address`, `contact_number`, `service_fee`) VALUES
	(20000121, 45.00, '2017-12-27 19:33:42', 3, 1, '', '', 0.00),
	(20000120, 145.00, '2017-12-27 18:47:54', 5, 31, '', '', 0.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.users
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(255) NOT NULL DEFAULT '',
  `usr_email` varchar(255) NOT NULL DEFAULT '',
  `usr_password` varchar(255) NOT NULL DEFAULT '',
  `usr_auth` int(1) NOT NULL DEFAULT '0',
  `usr_status` int(11) NOT NULL DEFAULT '0',
  `usr_img` varchar(255) NOT NULL DEFAULT '',
  `brand_id` int(1) NOT NULL DEFAULT '0',
  `usr_address` varchar(255) NOT NULL DEFAULT '',
  `usr_contact` varchar(50) NOT NULL DEFAULT 'N/A',
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.users: ~7 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`, `usr_status`, `usr_img`, `brand_id`, `usr_address`, `usr_contact`) VALUES
	(1, 'John Carlo Octabio', 'jacotabio@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '', 0, 'Ubiquity Global Services, Negros First Cybercentre, Bacolod City', '09437095893'),
	(26, 'SleepNot', 'sleepnot@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 1, 'img/logo.png', 14, '', 'N/A'),
	(27, 'Starbucks', 'coffee@starbucks.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, '', 15, '', 'N/A'),
	(28, 'Ron Guanzon', 'ronguanzon@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, '', 0, 'N/A', 'N/A'),
	(29, 'Jeland Quinamot', 'jelandquinamot@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, '', 0, '', 'N/A'),
	(30, 'Rafael Davis', 'rd0_0@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, '', 0, '', 'N/A'),
	(31, 'John Brix Arrobang', 'johnbarrobang@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 0, '', 0, '', 'N/A');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
