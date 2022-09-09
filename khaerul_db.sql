-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for khaerul
CREATE DATABASE IF NOT EXISTS `khaerul` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `khaerul`;

-- Dumping structure for table khaerul.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `nip` varchar(150) NOT NULL DEFAULT '',
  `nama` varchar(150) NOT NULL DEFAULT '',
  `jkl` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(150) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`nip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table khaerul.accounts: ~3 rows (approximately)
INSERT INTO `accounts` (`nip`, `nama`, `jkl`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
	('1234', 'Admin Default', 'L', 'admin@admin.com', '$2y$10$RdNpenTQ4vbOZV69UcQRAeRR/ZtP04JN8jJ3EmwFMloImYtKljC.G', 1, 1, '2022-08-24 23:22:20'),
	('13001', 'Rhadi Indrawan', 'L', 'rhadi.indrawankkpi@gmail.com', '$2y$10$gCg68iXCBVgJDokyctwwRej3km18xONn5w6xPsKrvf50M04n77Ldm', 2, 1, '2022-08-27 07:46:35'),
	('13002', 'Indrawan Rhadi', 'L', 'indrawanrhadi@gmail.com', '$2y$10$mAF8yL/myNNwm99cJQ3UWOukCK2INvOMsGxoIKVVz./j08iOhz.DS', 2, 1, '2022-08-28 02:20:26');

-- Dumping structure for table khaerul.lokasi_kantor
CREATE TABLE IF NOT EXISTS `lokasi_kantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table khaerul.lokasi_kantor: ~0 rows (approximately)
INSERT INTO `lokasi_kantor` (`id`, `lat`, `lon`, `jarak`) VALUES
	(1, -5.1239408, 119.4319032, 100);

-- Dumping structure for table khaerul.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table khaerul.role: ~3 rows (approximately)
INSERT INTO `role` (`id`, `role`) VALUES
	(1, 'admin'),
	(2, 'pegawai'),
	(3, 'siswa');

-- Dumping structure for table khaerul.tb_absensi
CREATE TABLE IF NOT EXISTS `tb_absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(150) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table khaerul.tb_absensi: ~4 rows (approximately)
INSERT INTO `tb_absensi` (`id`, `nip`, `lat`, `lon`, `time`) VALUES
	(9, '13001', -5.1239303, 119.4318961, '2022-08-27 02:18:57'),
	(10, '13001', -5.1239303, 119.4318961, '2022-08-28 02:18:57'),
	(11, '13002', -5.1239303, 119.4318961, '2022-08-28 02:21:15'),
	(12, '13002', -5.1239303, 119.4318961, '2022-08-27 02:21:15'),
	(13, '13001', -5.1239303, 119.4318961, '2022-08-29 01:39:44');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
