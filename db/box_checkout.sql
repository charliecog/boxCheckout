# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: box_checkout
# Generation Time: 2020-01-19 12:10:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_line` varchar(1000) NOT NULL DEFAULT '',
  `second_line` varchar(1000) NOT NULL DEFAULT '',
  `town` varchar(255) NOT NULL DEFAULT '',
  `post_code` varchar(10) NOT NULL DEFAULT '',
  `county` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;

INSERT INTO `addresses` (`id`, `first_line`, `second_line`, `town`, `post_code`, `county`, `country`)
VALUES
	(1,'52 Taylor Ave','Kew Gardens','Richmond','TW9 4ED','Surrey','United Kingdom');

/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table boxes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boxes`;

CREATE TABLE `boxes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `size` enum('small','medium','large') NOT NULL,
  `strength` enum('standard','strong','extra_strong') NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `boxes` WRITE;
/*!40000 ALTER TABLE `boxes` DISABLE KEYS */;

INSERT INTO `boxes` (`id`, `size`, `strength`, `price`, `deleted`)
VALUES
	(1,'small','standard',2.99,0),
	(2,'small','strong',3.29,0),
	(3,'small','extra_strong',3.74,0),
	(4,'medium','standard',4.99,0),
	(5,'medium','strong',5.49,0),
	(6,'medium','extra_strong',6.24,0),
	(7,'large','standard',7.99,0),
	(8,'large','strong',8.79,0),
	(9,'large','extra_strong',9.99,0);

/*!40000 ALTER TABLE `boxes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL,
  `box_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;

INSERT INTO `order_details` (`id`, `order_id`, `box_id`, `quantity`)
VALUES
	(1,1,2,6),
	(2,1,5,2),
	(3,1,9,1);

/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `delivery_address_id` int(255) NOT NULL,
  `payment_transaction_id` int(255) NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `discount_applied` int(2) NOT NULL DEFAULT '0',
  `total_charged_price` decimal(6,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `user_id`, `delivery_address_id`, `payment_transaction_id`, `total_price`, `discount_applied`, `total_charged_price`, `date`)
VALUES
	(1,1,1,8368,40.71,0,40.71,'2020-01-19 11:58:29');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` enum('mr','mrs','miss','master','mx') NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `business_name` varchar(255) DEFAULT NULL,
  `email` varchar(320) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `secondary_phone` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `title`, `first_name`, `last_name`, `business_name`, `email`, `phone`, `secondary_phone`)
VALUES
	(1,'mr','Bob','Barker',NULL,'bobby@bob.com','07900398786','02083320998');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
