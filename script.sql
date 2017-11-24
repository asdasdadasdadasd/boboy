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
  `brand_email` varchar(255) NOT NULL DEFAULT '',
  `brand_password` varchar(255) NOT NULL DEFAULT '',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.brands: ~3 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_email`, `brand_password`, `brand_status`) VALUES
	(1, 'SleepNot', '', '', 0),
	(2, 'Starbucks', '', '', 0),
	(3, 'TomNtoms', '', '', 0);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

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
  KEY `id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.items: ~3 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`item_id`, `brand_id`, `item_name`, `item_description`, `item_size`, `item_price`, `item_img`, `item_status`) VALUES
	(1, 2, 'White Hot Mocha Latte', 'A delicate float of house-made vanilla sweet cream that cascades throughout the cup.', 'Grande', 60.00, 'http://static4.businessinsider.com/image/5509a9685afbd3705e8b4568-1190-625/starbucks-says-tingyi-to-make-starbuks-drink-products-in-china.jpg', 0),
	(2, 1, 'Iced Coffee', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet, ligula in sollicitudin euismod, ipsum dui bibendum eros, porttitor g', 'Grande', 60.00, 'http://static4.businessinsider.com/image/5509a9685afbd3705e8b4568-1190-625/starbucks-says-tingyi-to-make-starbuks-drink-products-in-china.jpg', 0),
	(3, 3, 'Tomicinno Coffee', 'A delicate float of house-made vanilla sweet cream that cascades throughout the cup.', 'Grande', 60.00, 'http://static4.businessinsider.com/image/5509a9685afbd3705e8b4568-1190-625/starbucks-says-tingyi-to-make-starbuks-drink-products-in-china.jpg', 0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table db_sleepnotgo.users
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(255) NOT NULL DEFAULT '',
  `usr_email` varchar(255) NOT NULL DEFAULT '',
  `usr_password` varchar(255) NOT NULL DEFAULT '',
  `usr_auth` int(1) NOT NULL DEFAULT '0',
  `usr_status` int(11) NOT NULL DEFAULT '0',
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sleepnotgo.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`, `usr_status`) VALUES
	(1, 'John Carlo Octabio', 'jacotabio@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
	(3, 'Mary Loisse Guilot', 'loisseguilot@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
	(10, 'Denmark Contrevida', 'denmarkcontrevida@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
