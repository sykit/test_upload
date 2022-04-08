/*
SQLyog Community
MySQL - 10.4.17-MariaDB : Database - database_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`database_test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `database_test`;

/*Table structure for table `data_berkas` */

CREATE TABLE `data_berkas` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `harga_barang` int(100) DEFAULT NULL,
  `harga_jual` int(100) DEFAULT NULL,
  `stok` varchar(100) DEFAULT NULL,
  `tgl_input` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`nama_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `data_berkas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
