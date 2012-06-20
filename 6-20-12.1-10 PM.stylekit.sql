# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.11)
# Database: stylekit
# Generation Time: 2012-06-20 17:10:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;

INSERT INTO `accounts` (`id`, `name`, `email`, `password`)
VALUES
	(1,'Ryan James','ryan.james@domain7.com','5200057f55e8208ebbef36f5d53e98f9');

/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table elements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `elements`;

CREATE TABLE `elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `markup` text NOT NULL,
  `css` text NOT NULL,
  `guide_id` int(11) NOT NULL,
  `unique_id` text NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `elements` WRITE;
/*!40000 ALTER TABLE `elements` DISABLE KEYS */;

INSERT INTO `elements` (`id`, `title`, `markup`, `css`, `guide_id`, `unique_id`, `order`)
VALUES
	(206,'Button','<button class=\"default-button\">Default Button</button>','button { \n	background-color: #ffffff;\n	background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(255, 255, 255)), to(rgb(240, 240, 240)));\n	background-image: -webkit-linear-gradient(top, rgb(255, 255, 255), rgb(240, 240, 240));\n	background-image: -moz-linear-gradient(top, rgb(255, 255, 255), rgb(240, 240, 240));\n	background-image: -o-linear-gradient(top, rgb(255, 255, 255), rgb(240, 240, 240));\n	background-image: -ms-linear-gradient(top, rgb(255, 255, 255), rgb(240, 240, 240));\n	background-image: linear-gradient(top, rgb(255, 255, 255), rgb(240, 240, 240));\n	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr=\'#ffffff\', EndColorStr=\'#f0f0f0\');\n	border-top: solid 1px #fff;\n  border-left: 0;\n  border-right: 0;\n  border-bottom: solid 1px #ddd;\n  font-family: Helvetica Neue, Helvetica;\n	font-size: 1.2em;\n  padding: 0.5em 1em;\n  border-radius: 3px;\n}',56,'uomfCdkyxfysnDo5lf068mrCEPvDNsw2hffDuGfl2nrmtDDlzgssDNFpfk88O',100000);

/*!40000 ALTER TABLE `elements` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guides
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guides`;

CREATE TABLE `guides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL DEFAULT '',
  `account_id` varchar(128) NOT NULL,
  `global_styles` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `guides` WRITE;
/*!40000 ALTER TABLE `guides` DISABLE KEYS */;

INSERT INTO `guides` (`id`, `title`, `account_id`, `global_styles`)
VALUES
	(56,'Desiring God','1','body {\n  background-color: #f5f5f5;\n	font-size: 62.5%;\n}');

/*!40000 ALTER TABLE `guides` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
