-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for invest
CREATE DATABASE IF NOT EXISTS `invest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `invest`;

-- Dumping structure for table invest.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `login` text NOT NULL,
  `wallet` int(250) NOT NULL,
  `password` text NOT NULL,
  `ref` int(250) NOT NULL,
  `refBalance` int(250) NOT NULL,
  `token` text NOT NULL,
  `status` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table invest.accounts: ~2 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `email`, `login`, `wallet`, `password`, `ref`, `refBalance`, `token`, `status`) VALUES
	(4, 'test@test.com', 'test', 123, '$2y$10$KsF0Z.nwmpmNENgTLfIwj.07zhvltVgZYmi2WCAj0HJechTiB6NJS', 0, 0, 'h4gsorzvw2ty3kukgk4e0uoicd3lak', 1),
	(5, 'test2@test.com', 'test2', 123, '$2y$10$XwT3nqxEX.fvrclaetG5Guu3RyORv2I12oaUD7ZLzDVrHGIqWfsIS', 4, 0, 'uanr22wcl71ft9gbs7de4cih5pr692', 1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table invest.history
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `uid` int(250) NOT NULL,
  `unixTime` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table invest.history: ~3 rows (approximately)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` (`id`, `uid`, `unixTime`, `description`) VALUES
	(1, 4, '1561483373', 'Withdrawal. Amount: 500 $'),
	(2, 4, '1561483449', 'Invest withdrawal complete. Amount: 1000 $'),
	(3, 4, '1561483457', 'Referral withdrawal complete. Amount: 500 $');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;

-- Dumping structure for table invest.ref_withdrawals
CREATE TABLE IF NOT EXISTS `ref_withdrawals` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `uid` int(250) NOT NULL,
  `unixTime` int(250) NOT NULL,
  `amount` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table invest.ref_withdrawals: ~0 rows (approximately)
/*!40000 ALTER TABLE `ref_withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_withdrawals` ENABLE KEYS */;

-- Dumping structure for table invest.tariffs
CREATE TABLE IF NOT EXISTS `tariffs` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `uid` int(250) NOT NULL,
  `sumIn` int(250) NOT NULL,
  `sumOut` int(250) NOT NULL,
  `percent` int(250) NOT NULL,
  `unixTimeStart` int(250) NOT NULL,
  `unixTimeFinish` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table invest.tariffs: ~2 rows (approximately)
/*!40000 ALTER TABLE `tariffs` DISABLE KEYS */;
INSERT INTO `tariffs` (`id`, `uid`, `sumIn`, `sumOut`, `percent`, `unixTimeStart`, `unixTimeFinish`) VALUES
	(1, 4, 5001, 0, 50, 1561443223, 1561444555),
	(2, 5, 5000, 7500, 50, 1561483567, 1561484555);
/*!40000 ALTER TABLE `tariffs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
