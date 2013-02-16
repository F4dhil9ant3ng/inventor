-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.66-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-02-16 13:52:53
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for inventor
DROP DATABASE IF EXISTS `inventor`;
CREATE DATABASE IF NOT EXISTS `inventor` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventor`;


-- Dumping structure for table inventor.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.admins: 9 rows
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'tdi.setiawan@gmail.com', '085223619529', 'admin', 'N', 'd41d8cd98f00b204e9800998ecf8427f'),
	('', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', 'user', 'N', 'd41d8cd98f00b204e9800998ecf8427e'),
	('user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user', 'tdi.setiawan@gmail.com', '56756756', 'user', 'N', '24c9e15e52afc47c225b757e7bee1f9d'),
	('dadan', 'fd68e8922a6705a916b19669fb356cce', 'dadan', 'dadan', '2121', 'user', 'N', 'fd68e8922a6705a916b19669fb356cce'),
	('34534', '52746115ed4579e191e8a82c2c6682b5', '4534', '345343', '34534', 'user', 'N', '52746115ed4579e191e8a82c2c6682b5'),
	('23432', 'f2fc990265c712c49d51a18a32b39f0c', '234', '324', '32432', 'user', 'N', 'f2fc990265c712c49d51a18a32b39f0c'),
	('234', '289dff07669d7a23de0ef88d2f7129e7', '234', '234', '234', 'user', 'N', '289dff07669d7a23de0ef88d2f7129e7'),
	('23432432432', '3f571ab24d54baf70b44bb4ce6c88214', '32432', '2423', '234324', 'Admin', 'N', '3f571ab24d54baf70b44bb4ce6c88214'),
	('111', '6512bd43d9caa6e02c990b0a82652dca', '11', '11', '11', 'admin', 'N', '6512bd43d9caa6e02c990b0a82652dca');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;


-- Dumping structure for table inventor.banner
DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.banner: 1 rows
DELETE FROM `banner`;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
	(10, 'katalaya', 'http://katalaya.sytes.net', 'banner2.jpg', '2010-07-30');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;


-- Dumping structure for table inventor.download
DROP TABLE IF EXISTS `download`;
CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table inventor.download: 1 rows
DELETE FROM `download`;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` (`id_download`, `judul`, `nama_file`) VALUES
	(3, 'kumpulan serial number', 'kumpulan serial number.docx');
/*!40000 ALTER TABLE `download` ENABLE KEYS */;


-- Dumping structure for table inventor.hubungi
DROP TABLE IF EXISTS `hubungi`;
CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.hubungi: 1 rows
DELETE FROM `hubungi`;
/*!40000 ALTER TABLE `hubungi` DISABLE KEYS */;
INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`) VALUES
	(4, 'nur', 'nur.iskandar.s@gmail.com', 'Request Code', 'Tolong dunk ..', '2009-02-25');
/*!40000 ALTER TABLE `hubungi` ENABLE KEYS */;


-- Dumping structure for table inventor.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.kategori: 4 rows
DELETE FROM `kategori`;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`) VALUES
	(15, 'telco', 'telco'),
	(12, 'alat ukur', 'alat-ukur'),
	(13, 'comsumable port', 'comsumable-port'),
	(14, 'support', 'support');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;


-- Dumping structure for table inventor.kota
DROP TABLE IF EXISTS `kota`;
CREATE TABLE IF NOT EXISTS `kota` (
  `id_kota` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(100) NOT NULL,
  `ongkos_kirim` int(10) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table inventor.kota: 11 rows
DELETE FROM `kota`;
/*!40000 ALTER TABLE `kota` DISABLE KEYS */;
INSERT INTO `kota` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
	(1, 'Jakarta', 13000),
	(2, 'Bandung', 13500),
	(3, 'Semarang', 10000),
	(4, 'Medan', 20000),
	(5, 'Aceh', 25000),
	(6, 'Banjarmasin', 17500),
	(7, 'Balikpapan', 18500),
	(8, 'Samarinda', 19500),
	(9, 'Lainnya', 10000),
	(10, 'Palembang', 23000),
	(11, 'Surabaya', 13000);
/*!40000 ALTER TABLE `kota` ENABLE KEYS */;


-- Dumping structure for table inventor.kustomer
DROP TABLE IF EXISTS `kustomer`;
CREATE TABLE IF NOT EXISTS `kustomer` (
  `nik` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci,
  `email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `telpon` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `id_kota` int(5) DEFAULT NULL,
  `divisi` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `unit_kerja_lantai` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_manajer` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `lokasi_kerja` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.kustomer: 9 rows
DELETE FROM `kustomer`;
/*!40000 ALTER TABLE `kustomer` DISABLE KEYS */;
INSERT INTO `kustomer` (`nik`, `password`, `nama_lengkap`, `alamat`, `email`, `telpon`, `id_kota`, `divisi`, `unit_kerja_lantai`, `nama_manajer`, `lokasi_kerja`) VALUES
	('534534', 'f356355c1634839cf42769e7f30905a3', '345', NULL, '34534', '345', NULL, '345', '345', '345', NULL),
	('2', '827ccb0eea8a706c4c34a16891f84e7b', 'tris', 'bank kesawan', 'tristaozzora@yahoo.com', '99898', 5, NULL, NULL, NULL, NULL),
	('3', 'eeafb716f93fa090d7716749a6eefa72', 'sukma', 'bank mega', 'sukma@indosat.co.id', '1231', 5, NULL, NULL, NULL, NULL),
	('4', '81dc9bdb52d04dc20036dbd8313ed055', 'tri', 'bank mandiri', 'nur.iskandar.s@gmail.com', '12334324', 11, NULL, NULL, NULL, NULL),
	('5', '827ccb0eea8a706c4c34a16891f84e7b', 'tedi', 'dsada', 'nur@kejaksaan.go.id', '321321', 5, NULL, NULL, NULL, NULL),
	('6', 'e10adc3949ba59abbe56e057f20f883e', 'kucluk', 'jll', 'kolong_meza@yahoo.com', '9887878', 5, NULL, NULL, NULL, NULL),
	('7', 'e10adc3949ba59abbe56e057f20f883e', 'tedi', 'www.perbendaharaan.go.id', 'tdi.setiawan@gmail.com', '9887878', 5, NULL, NULL, NULL, NULL),
	('8', '827ccb0eea8a706c4c34a16891f84e7b', 'kucluk', NULL, 'tdi.setiawan@gmail.com', '3456', NULL, 'a', 'a', '909', NULL),
	('11', '827ccb0eea8a706c4c34a16891f84e7b', 'kucluk', NULL, 'tdi.setiawan@gmail.com', '3456', NULL, 'a', 'a', '909', NULL);
/*!40000 ALTER TABLE `kustomer` ENABLE KEYS */;


-- Dumping structure for table inventor.modul
DROP TABLE IF EXISTS `modul`;
CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `static_content` text COLLATE latin1_general_ci,
  `gambar` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('user','admin') COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci DEFAULT NULL,
  `urutan` int(5) DEFAULT NULL,
  `nama_toko` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_deskripsi` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_keyword` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `email_pengelola` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nomor_rekening` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nomor_hp` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.modul: 19 rows
DELETE FROM `modul`;
/*!40000 ALTER TABLE `modul` DISABLE KEYS */;
INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `status`, `aktif`, `urutan`, `nama_toko`, `meta_deskripsi`, `meta_keyword`, `email_pengelola`, `nomor_rekening`, `nomor_hp`) VALUES
	(18, 'Perangkat', '?module=produk', '', '', 'admin', 'Y', 5, '', '', '', '', '', ''),
	(42, 'Order', '?module=order', '', '', 'admin', 'Y', 6, '', '', '', '', '', ''),
	(10, 'Manajemen Modul', '?module=modul', '', '', 'admin', 'Y', 3, '', '', '', '', '', ''),
	(31, 'Kategori Perangkat', '?module=kategori', '', '', 'admin', 'Y', 4, '', '', '', '', '', ''),
	(43, 'Profil Web Inventori', '?module=profil', '<strong>inventori</strong>\r\n', 'indosat.jpg', 'admin', 'Y', 2, 'inventori', 'inventori', 'inventori', 'inventori', '121212121', '088802110514'),
	(60, 'grafik', '?module=grafik', '', '', 'user', 'Y', 15, '', '', '', '', '', ''),
	(44, 'Hubungi Kami', '?module=hubungi', '', '', 'admin', 'Y', 9, '', '', '', '', '', ''),
	(45, 'Cara ORDER', '?module=carabeli', '<ol>\r\n	<li>Klik pada tombol <span style="font-weight: bold">Order</span> pada produk yang ingin Anda pesan.</li>\r\n	<li>Produk yang Anda pesan akan masuk ke dalam <span style="font-weight: bold">Keranjang Order</span>. Anda dapat melakukan perubahan jumlah produk yang diinginkan dengan mengganti angka di kolom <span style="font-weight: bold">Jumlah</span>, kemudian klik tombol <span style="font-weight: bold">Update</span>. Sedangkan untuk menghapus sebuah produk dari Keranjang Belanja, klik tombol Kali yang berada di kolom paling kanan.</li>\r\n	<li>Jika sudah selesai, klik tombol <span style="font-weight: bold">Submit Order</span>, maka akan tampil form untuk pengisian data kustomer/pembeli.</li>\r\n	<li>Setelah data pembeli selesai diisikan, klik tombol <span style="font-weight: bold">Proses</span>, maka akan tampil data pembeli beserta produk yang dipesannya (jika diperlukan catat nomor ordersnya). dan konfirm order melalui email dan chatting<br />\r\n	</li>\r\n</ol>\r\n', 'gedung.jpg', 'admin', 'Y', 8, '', '', '', '', '', ''),
	(59, 'statistik', '?module=statistik', '', '', 'user', 'Y', 14, '', '', '', '', '', ''),
	(47, 'Banner', '?module=banner', '', '', 'user', 'Y', 10, '', '', '', '', '', ''),
	(48, 'Ongkos Kirim', '?module=ongkoskirim', '', '', 'user', 'N', 7, '', '', '', '', '', ''),
	(49, 'Ganti Password', '?module=password', '', '', 'user', 'N', 17, '', '', '', '', '', ''),
	(53, 'Modul YM', '?module=ym', '', '', 'user', 'Y', 12, '', '', '', '', '', ''),
	(52, 'Laporan', '?module=laporan', '', '', 'user', 'Y', 11, '', '', '', '', '', ''),
	(57, 'Download Katalog', '?module=download', '', '', 'user', 'Y', 13, '', '', '', '', '', ''),
	(58, 'list keseluruhan perangkat', '?module=listkategori', '', '', 'user', 'Y', 8, '', '', '', '', '', ''),
	(61, 'Manajemen Admin', '?module=admin', '', '', 'admin', 'Y', 16, '', '', '', '', '', ''),
	(63, 'Manajemen Member', '?module=user', NULL, NULL, 'admin', 'Y', 18, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, 'Sub Kategori', '?module=subkategori', NULL, NULL, 'admin', 'Y', 19, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `modul` ENABLE KEYS */;


-- Dumping structure for table inventor.mod_ym
DROP TABLE IF EXISTS `mod_ym`;
CREATE TABLE IF NOT EXISTS `mod_ym` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.mod_ym: 1 rows
DELETE FROM `mod_ym`;
/*!40000 ALTER TABLE `mod_ym` DISABLE KEYS */;
INSERT INTO `mod_ym` (`id`, `nama`, `username`) VALUES
	(1, 'nur', 'rada_cakep');
/*!40000 ALTER TABLE `mod_ym` ENABLE KEYS */;


-- Dumping structure for table inventor.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_orders` int(5) NOT NULL AUTO_INCREMENT,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Booking',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `nik` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `tgl_pengambilan` date DEFAULT NULL,
  `jam_pengambilan` time DEFAULT NULL,
  `tgl_pembatalan` date DEFAULT NULL,
  `jam_pembatalan` time DEFAULT NULL,
  `pic_penerima` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pic_penyerah_barang` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `id_wo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_pelanggan` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pic_pelanggan` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `alamat_pelanggan` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `no_hp_pelanggan` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `email_pelanggan` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `use_for` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `kode_awb` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `file_awb` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_orders`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.orders: 244 rows
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id_orders`, `status_order`, `tgl_order`, `jam_order`, `nik`, `tgl_pengambilan`, `jam_pengambilan`, `tgl_pembatalan`, `jam_pembatalan`, `pic_penerima`, `pic_penyerah_barang`, `nama_file`, `id_wo`, `nama_pelanggan`, `pic_pelanggan`, `alamat_pelanggan`, `no_hp_pelanggan`, `email_pelanggan`, `use_for`, `kode_awb`, `file_awb`) VALUES
	(1, 'Lunas', '2011-05-28', '11:52:25', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Lunas', '2013-01-25', '05:07:16', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'Lunas', '2013-02-01', '03:57:23', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'Lunas', '2013-02-06', '09:10:04', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'Lunas', '2013-02-07', '03:41:00', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'Approve', '2013-02-07', '14:00:28', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'Approve', '2013-02-07', '14:00:44', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'Approve', '2013-02-07', '14:01:15', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 'Approve', '2013-02-07', '14:01:41', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 'Booking', '2013-02-07', '14:02:25', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 'Pengambilan', '2013-02-07', '14:02:37', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 'Approve', '2013-02-07', '14:02:51', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 'Approve', '2013-02-07', '17:14:32', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'Approve', '2013-02-07', '17:14:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 'Approve', '2013-02-07', '17:16:57', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 'Approve', '2013-02-07', '17:17:15', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 'Approve', '2013-02-07', '17:20:51', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 'Approve', '2013-02-08', '16:27:14', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 'Approve', '2013-02-08', '16:27:59', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 'Approve', '2013-02-09', '12:31:45', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 'Baru', '2013-02-09', '12:35:04', '11', '2013-02-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 'Baru', '2013-02-09', '12:44:30', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 'Baru', '2013-02-09', '12:45:37', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 'Baru', '2013-02-09', '12:46:45', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 'Baru', '2013-02-09', '12:47:46', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 'Baru', '2013-02-09', '12:48:16', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 'Baru', '2013-02-09', '12:51:17', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 'Baru', '2013-02-09', '12:52:29', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 'Baru', '2013-02-09', '12:57:09', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 'Baru', '2013-02-09', '12:57:53', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 'Baru', '2013-02-09', '12:58:24', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 'Baru', '2013-02-09', '13:03:10', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 'Baru', '2013-02-09', '13:05:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 'Baru', '2013-02-09', '13:13:26', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, 'Baru', '2013-02-10', '08:52:16', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, 'Baru', '2013-02-10', '09:02:37', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 'Baru', '2013-02-10', '09:07:38', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 'Baru', '2013-02-10', '09:10:20', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 'Baru', '2013-02-10', '09:11:38', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 'Baru', '2013-02-10', '09:12:24', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 'Baru', '2013-02-10', '09:13:16', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, 'Baru', '2013-02-10', '09:13:45', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 'Baru', '2013-02-10', '09:14:00', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, 'Baru', '2013-02-10', '09:14:14', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(45, 'Baru', '2013-02-10', '09:14:38', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(46, 'Baru', '2013-02-10', '09:15:26', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(47, 'Baru', '2013-02-10', '09:16:17', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(48, 'Baru', '2013-02-10', '10:32:46', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(49, 'Baru', '2013-02-10', '10:34:54', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, 'Baru', '2013-02-10', '10:35:24', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(51, 'Baru', '2013-02-10', '10:36:02', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(52, 'Baru', '2013-02-10', '10:36:57', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(53, 'Baru', '2013-02-10', '10:39:13', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(54, 'Baru', '2013-02-10', '10:40:19', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(55, 'Baru', '2013-02-10', '10:48:03', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(56, 'Baru', '2013-02-10', '10:54:06', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, 'Baru', '2013-02-10', '10:54:38', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(58, 'Booking', '2013-02-10', '10:59:54', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, 'Baru', '2013-02-10', '11:00:31', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, '', '2013-02-10', '11:09:56', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 'Baru', '2013-02-10', '11:11:44', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 'Approve', '2013-02-10', '11:12:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(63, 'Approve', '2013-02-10', '11:15:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, 'Booking', '2013-02-10', '11:23:43', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, 'Booking', '2013-02-10', '11:23:57', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(66, 'Booking', '2013-02-10', '11:24:02', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, 'Booking', '2013-02-10', '12:41:43', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(68, 'Booking', '2013-02-10', '12:47:40', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, 'Booking', '2013-02-10', '12:47:58', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, 'Booking', '2013-02-10', '12:48:41', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(71, 'Booking', '2013-02-10', '12:56:04', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(72, 'Booking', '2013-02-10', '12:56:38', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(73, 'Booking', '2013-02-10', '12:57:11', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(74, 'Booking', '2013-02-10', '12:57:29', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(75, 'Booking', '2013-02-10', '12:58:23', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(76, 'Booking', '2013-02-10', '13:02:12', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, 'Booking', '2013-02-10', '13:04:37', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(78, 'Booking', '2013-02-10', '13:06:37', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(79, 'Booking', '2013-02-10', '13:07:37', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, 'Booking', '2013-02-10', '13:09:14', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(81, 'Booking', '2013-02-10', '13:11:13', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(82, 'Booking', '2013-02-10', '13:14:01', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(83, 'Booking', '2013-02-10', '13:27:35', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(84, 'Booking', '2013-02-10', '13:33:46', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(85, 'Booking', '2013-02-10', '13:35:41', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(86, 'Booking', '2013-02-10', '13:40:42', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(87, 'Booking', '2013-02-10', '13:54:51', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(88, 'Booking', '2013-02-10', '14:00:42', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(89, 'Booking', '2013-02-10', '14:06:42', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(90, 'Booking', '2013-02-10', '14:22:48', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(91, 'Booking', '2013-02-10', '14:28:10', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(92, 'Booking', '2013-02-10', '14:33:10', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(93, 'Booking', '2013-02-10', '14:34:16', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(94, 'Booking', '2013-02-10', '15:05:58', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(95, 'Booking', '2013-02-10', '15:05:59', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(96, 'Booking', '2013-02-10', '15:06:20', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(97, 'Booking', '2013-02-10', '15:07:00', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(98, 'Booking', '2013-02-10', '15:08:16', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(99, 'Booking', '2013-02-10', '15:08:22', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(100, 'Booking', '2013-02-10', '15:10:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(101, 'Booking', '2013-02-10', '15:12:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(102, 'Booking', '2013-02-10', '15:12:51', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(103, 'Booking', '2013-02-10', '15:17:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(104, 'Booking', '2013-02-10', '15:20:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(105, 'Booking', '2013-02-10', '15:24:03', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(116, 'Booking', '2013-02-10', '16:30:28', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(115, 'Booking', '2013-02-10', '16:29:39', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(114, 'Booking', '2013-02-10', '16:28:30', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(113, 'Booking', '2013-02-10', '16:28:02', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(112, 'Booking', '2013-02-10', '16:24:24', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(117, 'Booking', '2013-02-10', '16:30:35', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(118, 'Booking', '2013-02-10', '16:30:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(119, 'Booking', '2013-02-10', '16:32:22', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(120, 'Booking', '2013-02-10', '16:32:50', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(121, 'Booking', '2013-02-10', '16:38:35', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(122, 'Booking', '2013-02-10', '16:39:17', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(123, 'Booking', '2013-02-10', '16:39:55', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(124, 'Booking', '2013-02-10', '16:40:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(125, 'Booking', '2013-02-10', '16:40:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(126, 'Booking', '2013-02-10', '16:41:05', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(127, 'Booking', '2013-02-10', '16:41:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(128, 'Booking', '2013-02-10', '16:41:39', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(129, 'Booking', '2013-02-10', '16:41:44', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(130, 'Booking', '2013-02-10', '16:42:15', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(131, 'Booking', '2013-02-10', '16:42:50', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(132, 'Booking', '2013-02-10', '16:43:22', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(133, 'Booking', '2013-02-10', '16:43:31', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(134, 'Booking', '2013-02-10', '16:43:37', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(135, 'Booking', '2013-02-10', '16:43:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(136, 'Booking', '2013-02-10', '16:44:21', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(137, 'Booking', '2013-02-10', '16:44:50', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(138, 'Booking', '2013-02-10', '16:45:35', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(139, 'Booking', '2013-02-10', '16:46:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(140, 'Booking', '2013-02-10', '16:49:12', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(141, 'Booking', '2013-02-10', '16:50:58', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(142, 'Booking', '2013-02-10', '16:51:18', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(143, 'Booking', '2013-02-10', '16:55:04', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(144, 'Booking', '2013-02-10', '16:55:22', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(145, 'Booking', '2013-02-10', '16:55:40', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(146, 'Booking', '2013-02-10', '16:55:46', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(147, 'Booking', '2013-02-10', '16:55:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(148, 'Booking', '2013-02-10', '16:55:55', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(149, 'Booking', '2013-02-10', '16:55:58', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(150, 'Booking', '2013-02-10', '16:56:01', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(151, 'Booking', '2013-02-10', '16:56:03', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(152, 'Booking', '2013-02-10', '16:56:05', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(153, 'Booking', '2013-02-10', '16:56:11', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(154, 'Booking', '2013-02-10', '16:56:34', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(155, 'Booking', '2013-02-10', '16:56:42', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(156, 'Booking', '2013-02-10', '16:56:44', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(157, 'Booking', '2013-02-10', '16:56:46', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(158, 'Booking', '2013-02-10', '16:56:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(159, 'Booking', '2013-02-10', '16:56:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(160, 'Booking', '2013-02-10', '16:56:51', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(161, 'Booking', '2013-02-10', '16:58:20', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(162, 'Booking', '2013-02-10', '16:58:24', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(163, 'Booking', '2013-02-10', '16:58:31', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(164, 'Booking', '2013-02-10', '16:58:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(165, 'Booking', '2013-02-10', '16:58:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(166, 'Booking', '2013-02-10', '16:58:51', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(167, 'Booking', '2013-02-10', '16:59:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(168, 'Booking', '2013-02-10', '17:00:03', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(169, 'Booking', '2013-02-10', '17:00:07', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(170, 'Booking', '2013-02-10', '17:00:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(171, 'Booking', '2013-02-10', '17:00:17', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(172, 'Booking', '2013-02-10', '17:00:45', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(173, 'Booking', '2013-02-10', '17:00:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(174, 'Booking', '2013-02-10', '17:00:51', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(175, 'Booking', '2013-02-10', '17:00:58', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(176, 'Booking', '2013-02-10', '17:01:41', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(177, 'Booking', '2013-02-10', '17:05:58', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(178, 'Booking', '2013-02-10', '17:07:08', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(179, 'Booking', '2013-02-10', '17:08:01', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(180, 'Booking', '2013-02-10', '17:08:57', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(181, 'Booking', '2013-02-10', '17:23:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(182, 'Booking', '2013-02-10', '17:24:02', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(183, 'Booking', '2013-02-10', '17:24:07', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(184, 'Booking', '2013-02-10', '17:24:19', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(185, 'Booking', '2013-02-10', '17:24:55', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(186, 'Booking', '2013-02-10', '17:25:11', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(187, 'Booking', '2013-02-10', '17:25:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(188, 'Booking', '2013-02-10', '17:25:26', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(189, 'Booking', '2013-02-10', '17:25:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(190, 'Booking', '2013-02-10', '17:25:40', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(191, 'Booking', '2013-02-10', '17:25:43', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(192, 'Booking', '2013-02-10', '17:25:45', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(193, 'Booking', '2013-02-10', '17:25:48', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(194, 'Booking', '2013-02-10', '17:26:12', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(195, 'Booking', '2013-02-10', '17:26:16', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(196, 'Booking', '2013-02-10', '17:26:19', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(197, 'Booking', '2013-02-10', '17:26:21', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(198, 'Booking', '2013-02-10', '17:30:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(199, 'Booking', '2013-02-10', '17:31:31', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(200, 'Booking', '2013-02-10', '17:32:42', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(201, 'Booking', '2013-02-10', '17:32:47', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(202, 'Booking', '2013-02-10', '17:33:25', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(203, 'Booking', '2013-02-10', '17:34:18', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(204, 'Booking', '2013-02-10', '17:34:24', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(205, 'Booking', '2013-02-10', '17:35:33', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(206, 'Booking', '2013-02-10', '17:38:17', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(207, 'Booking', '2013-02-10', '17:39:29', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(208, 'Booking', '2013-02-10', '17:39:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(209, 'Booking', '2013-02-10', '17:41:48', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(210, 'Booking', '2013-02-10', '17:49:07', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(211, 'Booking', '2013-02-10', '17:49:14', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(212, 'Booking', '2013-02-10', '17:50:27', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(213, 'Booking', '2013-02-10', '17:50:30', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(214, 'Booking', '2013-02-10', '17:54:56', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(215, 'Booking', '2013-02-10', '17:55:00', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(216, 'Booking', '2013-02-10', '17:55:53', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(217, 'Booking', '2013-02-10', '17:56:15', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(218, 'Booking', '2013-02-10', '17:56:59', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(219, 'Booking', '2013-02-10', '20:27:17', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(220, 'Booking', '2013-02-10', '20:33:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(221, 'Batal', '2013-02-10', '20:34:13', '11', '2013-02-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(222, 'Booking', '2013-02-13', '21:13:35', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(223, 'Pengambilan', '2013-02-13', '21:24:55', '11', '2013-02-15', '22:38:13', NULL, NULL, 'tssss', 'ggggggggggggg', 'FormatSiswa.xls', '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(224, 'Pengambilan', '2013-02-13', '21:37:35', '11', '2013-02-13', '23:07:17', NULL, NULL, 'Tedi', 'Kuculk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(225, 'Batal', '2013-02-13', '21:39:35', '11', NULL, NULL, '2013-02-13', '23:35:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(226, 'Pengambilan', '2013-02-13', '21:41:05', '11', '2013-02-14', '15:19:59', NULL, NULL, '23432', '234324', 'translate.docx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(227, 'Pengambilan', '2013-02-13', '21:41:31', '11', '2013-02-15', '22:35:55', NULL, NULL, '345343', '345', 'data.xls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(228, 'Pengambilan', '2013-02-13', '21:42:54', '11', '2013-02-14', '15:19:40', NULL, NULL, '23432', '234324', 'data wali kelas.xlsx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(229, 'Pengambilan', '2013-02-13', '21:44:37', '11', '2013-02-13', '23:46:16', NULL, NULL, 'dida', 'dodo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(230, 'Batal', '2013-02-13', '21:46:03', '11', NULL, NULL, '2013-02-13', '21:46:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(231, 'Pengambilan', '2013-02-13', '22:19:11', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(232, 'Batal', '2013-02-13', '22:49:37', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(233, 'Batal', '2013-02-13', '22:50:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(234, 'Booking', '2013-02-15', '22:54:31', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(235, 'Booking', '2013-02-15', '23:40:29', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(236, 'Booking', '2013-02-15', '23:43:20', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(237, 'Booking', '2013-02-15', '23:43:36', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(238, 'Booking', '2013-02-15', '23:45:30', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(239, 'Booking', '2013-02-15', '23:45:43', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(240, 'Booking', '2013-02-15', '23:47:44', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(241, 'Booking', '2013-02-15', '23:48:48', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(242, 'Booking', '2013-02-15', '23:53:26', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(243, 'Booking', '2013-02-16', '00:05:49', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(244, 'Pengambilan', '2013-02-16', '00:06:04', '11', '2013-02-16', '13:44:34', NULL, NULL, '654', '45', '', '4645', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(245, 'Booking', '2013-02-16', '00:06:04', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ableh', 'sdf', 'dgdfg', 'sdf', 'jgh', NULL, NULL, NULL),
	(246, 'Booking', '2013-02-16', '00:45:52', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34534', '345', '345', '34', '345', NULL, NULL, NULL),
	(247, 'Booking', '2013-02-16', '01:47:38', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '345', '345', '5', '34', '34', NULL, NULL, NULL),
	(248, 'Pengambilan', '2013-02-16', '01:48:27', '11', '2013-02-16', '10:15:29', NULL, NULL, '', '', 'photo.jpg', '', '', '', '', '', '', NULL, NULL, NULL),
	(249, 'Pengambilan', '2013-02-16', '10:19:18', '11', '2013-02-16', '13:47:36', NULL, NULL, 'ableh', 'adkjak', 'BaplieDischarge_KM. LAGOA 4311.xls', '123123', '', '', '', '', '', NULL, '234234', '01022012.xlsx'),
	(250, 'Pengambilan', '2013-02-16', '13:28:22', '11', '2013-02-16', '13:45:07', NULL, NULL, '6666666666', '666666', '', '6666666666666', '', '', '', '', '', 'TROUBLE HANDLING', NULL, NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Dumping structure for table inventor.orders_detail
DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `nama_project` varchar(250) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.orders_detail: 89 rows
DELETE FROM `orders_detail`;
/*!40000 ALTER TABLE `orders_detail` DISABLE KEYS */;
INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`, `nama_project`) VALUES
	(1, 23, 1, 'INDOSAT'),
	(1, 25, 2, 'INDOSAT'),
	(2, 24, 1, 'INDOSAT'),
	(2, 17, 1, 'INDOSAT'),
	(2, 14, 1, 'INDOSAT'),
	(3, 25, 1, 'INDOSAT'),
	(4, 25, 1, 'INDOSAT'),
	(4, 34, 2, 'INDOSAT'),
	(4, 29, 6, 'INDOSAT'),
	(4, 27, 1, 'INDOSAT'),
	(4, 23, 6, 'INDOSAT'),
	(5, 34, 1, 'INDOSAT'),
	(5, 33, 1, 'INDOSAT'),
	(6, 33, 1, 'INDOSAT'),
	(8, 33, 1, 'INDOSAT'),
	(10, 33, 1, 'INDOSAT'),
	(13, 33, 1, 'INDOSAT'),
	(27, 49, 1, 'INDOSAT'),
	(28, 34, 2, 'INDOSAT'),
	(68, 49, 1, 'INDOSAT'),
	(69, 47, 1, 'INDOSAT'),
	(76, 29, 2, 'INDOSAT'),
	(76, 34, 4, 'INDOSAT'),
	(76, 25, 1, 'INDOSAT'),
	(82, 48, 1, 'INDOSAT'),
	(84, 48, 1, 'INDOSAT'),
	(87, 47, 1, 'INDOSAT'),
	(89, 49, 1, 'INDOSAT'),
	(90, 47, 1, 'INDOSAT'),
	(91, 48, 1, 'INDOSAT'),
	(92, 48, 1, 'INDOSAT'),
	(93, 48, 1, 'INDOSAT'),
	(0, 49, 1, 'INDOSAT'),
	(0, 48, 1, 'INDOSAT'),
	(100, 48, 2, 'INDOSAT'),
	(103, 48, 1, 'INDOSAT'),
	(104, 49, 1, 'INDOSAT'),
	(105, 47, 1, 'INDOSAT'),
	(112, 34, 1, 'INDOSAT'),
	(114, 45, 1, 'INDOSAT'),
	(115, 24, 1, 'INDOSAT'),
	(117, 47, 1, 'INDOSAT'),
	(118, 32, 1, 'INDOSAT'),
	(131, 33, 1, 'INDOSAT'),
	(137, 29, 2, 'INDOSAT'),
	(138, 44, 1, 'INDOSAT'),
	(176, 25, 1, 'INDOSAT'),
	(176, 24, 1, 'INDOSAT'),
	(176, 46, 1, 'INDOSAT'),
	(177, 23, 1, 'INDOSAT'),
	(177, 18, 1, 'INDOSAT'),
	(209, 47, 1, 'INDOSAT'),
	(211, 49, 1, 'INDOSAT'),
	(213, 49, 1, 'INDOSAT'),
	(215, 47, 1, 'INDOSAT'),
	(217, 49, 1, 'INDOSAT'),
	(218, 49, 1, 'INDOSAT'),
	(219, 34, 2, 'INDOSAT'),
	(219, 47, 1, 'INDOSAT'),
	(219, 48, 1, 'INDOSAT'),
	(221, 48, 1, 'INDOSAT'),
	(221, 49, 1, 'INDOSAT'),
	(222, 49, 2, 'INDOSAT'),
	(224, 49, 5, 'INDOSAT'),
	(223, 49, 5, 'INDOSAT'),
	(227, 47, 1, 'INDOSAT'),
	(229, 47, 1, 'INDOSAT'),
	(230, 45, 1, 'INDOSAT'),
	(231, 49, 1, 'INDOSAT'),
	(232, 48, 1, ''),
	(233, 47, 1, 'hhhhhhhhhhhhhh'),
	(234, 49, 1, 'gh'),
	(235, 49, 1, 'Unknown'),
	(237, 48, 1, 'Unknown'),
	(239, 48, 1, 'Unknown'),
	(241, 47, 1, 'Unknown'),
	(242, 45, 1, 'Unknown'),
	(0, 48, 1, 'Unknown'),
	(0, 47, 1, 'Unknown'),
	(0, 32, 1, 'Unknown'),
	(246, 34, 1, 'Unknown'),
	(247, 49, 1, 'Unknown'),
	(248, 47, 1, 'PROVISIONING REGULER'),
	(249, 48, 1, 'PROVISIONING'),
	(249, 44, 5, 'PROVISIONING'),
	(0, 48, 3, '34534'),
	(0, 45, 4, '34534'),
	(0, 49, 1, 'PROVISIONING REGULER'),
	(250, 48, 1, 'PROVISIONING REGULER');
/*!40000 ALTER TABLE `orders_detail` ENABLE KEYS */;


-- Dumping structure for table inventor.orders_temp
DROP TABLE IF EXISTS `orders_temp`;
CREATE TABLE IF NOT EXISTS `orders_temp` (
  `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL,
  `nama_project` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT 'PROVISIONING REGULER',
  PRIMARY KEY (`id_orders_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=238 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.orders_temp: 5 rows
DELETE FROM `orders_temp`;
/*!40000 ALTER TABLE `orders_temp` DISABLE KEYS */;
INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `tgl_order_temp`, `jam_order_temp`, `stok_temp`, `nama_project`) VALUES
	(229, 32, 'gqnna4vbhlj6qveag46a9emoc3', 18, '2013-02-16', '01:51:07', 33, '45654'),
	(221, 49, 'nb9g5e9c08p57u857ftjtfh614', 1, '2013-02-16', '00:16:23', 9, 'Unknown'),
	(228, 45, 'gqnna4vbhlj6qveag46a9emoc3', 2, '2013-02-16', '01:48:48', 4, '45654'),
	(233, 46, 'shqdm5lbrrpeqsj9a3p65oh230', 1, '2013-02-16', '10:19:37', 7, 'yu'),
	(232, 45, 'shqdm5lbrrpeqsj9a3p65oh230', 3, '2013-02-16', '10:19:26', 4, 'yu');
/*!40000 ALTER TABLE `orders_temp` ENABLE KEYS */;


-- Dumping structure for table inventor.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `model` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `serial_number` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `part_number` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `merk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `vendor` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `warehouse_location` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `jenis` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `produk_seo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE latin1_general_ci,
  `spesification` text COLLATE latin1_general_ci,
  `harga` int(20) DEFAULT NULL,
  `no_po` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `berat` decimal(5,2) unsigned DEFAULT '0.00',
  `tgl_masuk` date DEFAULT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `dibeli` int(5) DEFAULT '1',
  `diskon` int(5) DEFAULT NULL,
  `buffer` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table inventor.produk: 24 rows
DELETE FROM `produk`;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `model`, `serial_number`, `part_number`, `merk`, `vendor`, `warehouse_location`, `jenis`, `produk_seo`, `deskripsi`, `spesification`, `harga`, `no_po`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`, `diskon`, `buffer`) VALUES
	(14, 4, 'Motorola RAZR V3m Red', '', '', '', 'Motorola RAZR V3m Red', '', '', NULL, 'motorola-razr-v3m-red', 'The Motorola Red RAZR V3m for Sprint combines powerful technology and chic style with social activism in a cell phone that makes a strong statement to the world.<br />\r\nFeatures: Bluetooth Wireless Technology, 1.3 Megapixel Digital Camera Takes Print-quality Stills or Video Clips, Less Than 1/2-inch Thick With Feather-touch Precision Crafted Keypad,&nbsp; Built-in Music Player With Removable, Expandable Memory Card Slot, Stunning Red Shell Is Made From Aircraft-grade Aluminum, Motorola Will Contribute A Portion Of The Red Razr Proceeds To Help Fight Aids In Africa, Watch On-demand Sprint TV or Listen To Streaming Music With Sprint Music Store.<br />\r\n', '', 1000, '', 23, 0.50, '2009-05-25', '9motorola_razr.jpg', 29, 0, NULL),
	(15, 5, 'LG Chocolate VX8550 Blue', '', '', '', 'LG Chocolate VX8550 Blue', '', '', NULL, 'lg-chocolate-vx8550-blue', 'The LG Chocolate VX8550 for Verizon Wireless - now available with a chic &quot;blue ice&quot; color scheme - is the first Verizon Wireless phone with a soft-touch keypad, external graphic equalizer, streaming or downloadable music from VCAST, and the capability to transfer music to and from your PC (USB cable required).<br />\r\n<br />\r\nFeatures:<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; * Advanced Voice Dialing Lets Your Operate Your Phone Without Pre-training<br />\r\n&nbsp;&nbsp;&nbsp; * 1.3 Megapixel Camera Takes Print-quality Photo And Hour-long Video Clips<br />\r\n&nbsp;&nbsp;&nbsp; * High-speed Data Downloads Let You Watch TV Or Listen To Streaming Music<br />\r\n&nbsp;&nbsp;&nbsp; * First Phone To Play Either Downloaded V CAST Music or PC-transferred Music Files<br />\r\n&nbsp;&nbsp;&nbsp; * Stylish Slider Design With Soft-touch External Controls<br />\r\n&nbsp;&nbsp;&nbsp; * Huge, Vibrant Color Display<br />\r\n&nbsp;&nbsp;&nbsp; * Wirelessly Stream Music To A Stereo Bluetooth Headset\r\n', '', 1000, '', 43, 1.00, '2009-06-02', '39lg_vx8550.jpg', 16, 0, NULL),
	(16, 2, 'Samsung FlipShot SCH-U900', '0', 'dsfad12321', '0', 'Samsung FlipShot SCH-U900', '', '', NULL, 'samsung-flipshot-schu900', 'The Samsung U900 for Verizon Wireless is the update to the flagship Samsung A990. Features: Advanced Voice Activated Dialing Requires No Phone Pre-training, Advanced Bluetooth Wireless Technology With Streaming Stereo Music Support, Huge Color Main Display and Color External Display, Built-in Music Player Lets You Download From V CAST Music Service, One of the Best Digital Camera/Camcorders In A Mobile Phone Today, Next Generation (EV-DO) Technology Gives You Downloads At Near-Broadband Speeds, Watch On-demand TV or Listen to Music Via Verizon V CAST, Take Extra-long Video Clips With Very Good Resolution.\r\n', '', 1000, '', 28, 0.00, '2013-02-06', '85bertest.jpg', 38, 0, NULL),
	(18, 2, 'Sony Ericsson W200i', '0', '4324', '0', 'Sony Ericsson W200i', '', '', NULL, 'sony-ericsson-w200i', 'The Sony Ericsson specially Phone for Walkman - now available with a chic &quot;blue ice&quot; color scheme - is the first Verizon Wireless phone with a soft-touch keypad, external graphic equalizer, streaming or downloadable music from VCAST, and the capability to transfer music to and from your PC (USB cable required).<br />\r\n<br />\r\nFeatures:<br />\r\n<br />\r\n* Advanced Voice Dialing Lets Your Operate Your Phone Without Pre-training<br />\r\n* 1.3 Megapixel Camera Takes Print-quality Photo And Hour-long Video Clips<br />\r\n* High-speed Data Downloads Let You Watch TV Or Listen To Streaming Music<br />\r\n* First Phone To Play Either Downloaded V CAST Music or PC-transferred Music Files<br />\r\n* Stylish Slider Design With Soft-touch External Controls<br />\r\n* Huge, Vibrant Color Display<br />\r\n* Wirelessly Stream Music To A Stereo Bluetooth Headset<br />\r\n', '', 1000, '', 44, 0.00, '2013-02-06', '88alatukur8.jpg', 16, 0, NULL),
	(17, 3, 'Sony Ericsson W880', '0', '324', '0', 'Sony Ericsson W880', '', '', NULL, 'sony-ericsson-w880', 'The Sony Ericsson w880 specially Phone for Walkman and Business - now available with a chic &quot;blue ice&quot; color scheme - is the first Verizon Wireless phone with a soft-touch keypad, external graphic equalizer, streaming or downloadable music from VCAST, and the capability to transfer music to and from your PC (USB cable required).<br />\r\n<br />\r\nFeatures:<br />\r\n<br />\r\n* Advanced Voice Dialing Lets Your Operate Your Phone Without Pre-training<br />\r\n* 1.3 Megapixel Camera Takes Print-quality Photo And Hour-long Video Clips<br />\r\n* High-speed Data Downloads Let You Watch TV Or Listen To Streaming Music<br />\r\n* First Phone To Play Either Downloaded V CAST Music or PC-transferred Music Files<br />\r\n* Stylish Slider Design With Soft-touch External Controls<br />\r\n* Huge, Vibrant Color Display<br />\r\n* Wirelessly Stream Music To A Stereo Bluetooth Headset<br />\r\n', '', 1000, '', 34, 0.00, '2013-02-06', '17alatukur9.jpg', 15, 0, NULL),
	(19, 3, 'Sony Ericsson w910', '0', 'sadsa', '0', 'Sony Ericsson w910', '', '', NULL, 'sony-ericsson-w910', 'The Sony Ericsson w910 specially Phone for Walkman and Business - now\r\navailable with a chic &quot;blue ice&quot; color scheme - is the first Verizon\r\nWireless phone with a soft-touch keypad, external graphic equalizer,\r\nstreaming or downloadable music from VCAST, and the capability to\r\ntransfer music to and from your PC (USB cable required).<br />\r\n<br />\r\nFeatures:<br />\r\n<br />\r\n* Advanced Voice Dialing Lets Your Operate Your Phone Without Pre-training<br />\r\n* 1.3 Megapixel Camera Takes Print-quality Photo And Hour-long Video Clips<br />\r\n* High-speed Data Downloads Let You Watch TV Or Listen To Streaming Music<br />\r\n* First Phone To Play Either Downloaded V CAST Music or PC-transferred Music Files<br />\r\n* Stylish Slider Design With Soft-touch External Controls<br />\r\n* Huge, Vibrant Color Display<br />\r\n* Wirelessly Stream Music To A Stereo Bluetooth Headset\r\n', '', 1000, '', 0, 0.00, '2013-02-06', '8alatukur7.jpg', 22, 0, NULL),
	(23, 4, 'Blackberry 8820', '0', '453', '0', 'Blackberry 8820', '', '', NULL, 'blackberry-8820', '<p>\r\nResearch In Motion memperkenalkan BlackBerry terbaru yang mampu sediakan akses suara dan data nirkabel melalui jaringan seluler dan Wi-Fi. Presiden dan Co-CEO RIM, Mike Lazaridis, menyebutkan perhatian chief executive Apple Inc., Steve Jobs, dan produk iPhone Apple yang telah membawa keuntungan bagi RIM.\r\n</p>\r\n<p>\r\nBlackBerry baru ini bertajuk 8820 dan merupakan smartphone blackberry pertama yang memiliki kemampuan dual mode dengan desain tipis dan full keyboard. Push email RIM juga memungkinkan pelanggan untuk mengakses surat elektronik mereka langsung ke perangkat secara realtime.\r\n</p>\r\n<p>\r\n8820 juga dilengkapi dengan navigasi satelit GPS, hiburan multimedia musik dan video. Sayangnya kemunculan RIM baru mencakup Amerika saja dengan kerja sama operator AT&amp;T. \r\n</p>\r\n', '', 1000, '', 13, 0.00, '2013-02-06', '21alatukur6.jpg', 8, 0, NULL),
	(24, 4, 'Iphone 3GS', '', '321321', '', 'Iphone 3GS', '', '', NULL, 'iphone-3gs', '<p>\r\nThe iPhone 3GS is the third generation of iPhone designed and marketed by Apple Inc. It was introduced on June 8, 2009 at the WWDC 2009 which took place at the Moscone Center, San Francisco.\r\n</p>\r\n<p>\r\nIts features primarily consist of faster performance, a camera with higher resolution and video capability, voice control,[7] and support for 7.2 Mbit/s HSDPA downloading (but remains limited to 384 kbps uploading as Apple had not implemented the HSUPA protocol).[8] It was released in the U.S., Canada and six European countries on June 19, 2009,[2] in Australia and Japan on June 26, and internationally in July and August 2009.\r\n</p>\r\n<p>\r\nThe iPhone 3GS runs Apple&#39;s iOS operating system, as is used on the iPad and the iPod touch. It is primarily controlled by a user&#39;s fingertips on a multi-touch display.\r\n</p>\r\n', '', 1000, '', 14, 1.00, '2011-05-27', '73iPhone_3GS.jpg', 2, 10, NULL),
	(25, 4, 'Sony Ericsson C903', '0', '32132', '0', 'Sony Ericsson C903', '', '', NULL, 'sony-ericsson-c903', '<p>\r\nJadilah pembidik jitu dengan kamera 5 megapiksel mengesankan dari Sony Ericsson C903 Cyber-shot&trade;. Dengan deteksi wajah, lampu kilat foto yang cerah dan teknologi khas kami, Smile Shutter&trade;, Anda tidak lagi akan meluputkan bidikan sempurna dengan telepon kamera yang gaya ini.\r\n</p>\r\n<p>\r\nGunakan aGPS untuk menemukan arah dan tandai foto Anda menurut tempat pengambilannya. Aktifkan kamera dan nikmati kemampuan layanan berbasis lokasi pada telepon Anda. Mengambil gambar di mana saja dan memberi label informasi tentang lokasi Anda.\r\n</p>\r\n', '', 1000, '', 1, 0.00, '2013-02-06', '86alatukur5.jpg', 5, 0, NULL),
	(26, 5, 'nama produk2', '0', '12', '0', 'nama produk2', '', '', NULL, 'nama-produk2', 'jdjsajdas dsa;jdlas\r\n', '', 1000, '', 3, 0.00, '2013-02-06', '', 1, 0, NULL),
	(27, 5, 'nama produk lagi', '0', '543', '0', 'nama produk lagi', '', '', NULL, 'nama-produk-lagi', 'deskripsi\r\n', '', 1000, '', 11, 0.00, '2013-02-06', '76alatukur3.jpg', 2, 0, NULL),
	(28, 5, 'nama produk lagi2', '0', '132', '0', 'nama produk lagi2', '', '', NULL, 'nama-produk-lagi2', 'dsad\r\n', '', 1000, '', 12, 0.00, '2013-02-06', '81multiflexser.jpg', 1, 0, NULL),
	(29, 2, 'tes', '0', '212121', '0', 'tes', '', '', NULL, 'tes', 'tes\r\n', '', 1000, '', 6, 0.00, '2013-02-06', '72alatukur2.jpg', 7, 0, NULL),
	(30, 2, 'media gateway', '0', '121212', '0', 'media gateway', '', '', NULL, 'media-gateway', 'media\r\n', '', 1000, '', 12, 0.00, '2013-02-06', '12media gateway.jpg', 1, 0, NULL),
	(31, 3, 'radio', '0', '4343', '0', 'radio', '', '', NULL, 'radio', 'tes<span style="white-space: pre" class="Apple-tab-span">	</span>\r\n', '', 1000, '', 13, 0.00, '2013-02-06', '44radio.jpg', 1, 0, NULL),
	(32, 2, 'kabel', '0', '3132', '0', 'kabel', '', '', NULL, 'kabel', 'kabel\r\n', '', 1000, '', 33, 0.00, '2013-02-06', '90kabel.jpg', 1, 0, NULL),
	(33, 3, 'nambah', '0', '123132', '0', 'nambah', '', '', NULL, 'nambah', 'nambah\r\n', '', 1000, '', 11, 0.00, '2013-01-31', '', 2, 0, NULL),
	(34, 4, 'konverter', '0', '898989', '0', 'konverter', '', '', NULL, 'konverter', 'konver\r\n', '', 1000, '', 8, 0.00, '2013-02-06', '73konverter1.jpg', 4, 0, NULL),
	(48, 6, NULL, '', '', NULL, 'test', '', '', '', 'test', NULL, '', 1000, '', 1, 7.00, NULL, NULL, -6, NULL, NULL),
	(49, 6, NULL, 'test', '', NULL, 'test', '', '', '', 'test', NULL, '', 1000, '', 7, 7.00, NULL, '46ikan pindang kuah.jpg', -1, NULL, NULL),
	(47, 8, NULL, 'test', '65767', NULL, 'test', 'test', '', 'test', 'test', NULL, '', 1000, 'tets', 1, 7.00, NULL, '35satya.jpg', 3, NULL, NULL),
	(44, 4, NULL, '565', '', NULL, 'test', '', '', '', '', NULL, '', 1000, '', 0, 5.00, NULL, NULL, 6, NULL, NULL),
	(45, 4, NULL, '565', '', NULL, 'test', '', '', '', '', NULL, '', 1000, '', 0, 5.00, NULL, NULL, 0, NULL, NULL),
	(46, 3, NULL, 'test', '', NULL, 'test', '', '', 'test', 'test', NULL, 'erjhgfdsfggf\r\n', 1000, '', 7, 7.00, NULL, '90satya.jpg', 1, NULL, NULL);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;


-- Dumping structure for table inventor.statistik
DROP TABLE IF EXISTS `statistik`;
CREATE TABLE IF NOT EXISTS `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table inventor.statistik: 100 rows
DELETE FROM `statistik`;
/*!40000 ALTER TABLE `statistik` DISABLE KEYS */;
INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
	('127.0.0.2', '2009-09-11', 1, '1252681630'),
	('127.0.0.1', '2009-09-11', 17, '1252734209'),
	('127.0.0.3', '2009-09-12', 8, '1252817594'),
	('127.0.0.1', '2009-10-24', 8, '1256381921'),
	('127.0.0.1', '2009-10-26', 108, '1256620074'),
	('127.0.0.1', '2009-10-27', 52, '1256686769'),
	('127.0.0.1', '2009-10-28', 124, '1256792223'),
	('127.0.0.1', '2009-10-29', 9, '1256828032'),
	('127.0.0.1', '2009-10-31', 3, '1257047101'),
	('127.0.0.1', '2009-11-01', 85, '1257113554'),
	('127.0.0.1', '2009-11-02', 11, '1257207543'),
	('127.0.0.1', '2009-11-03', 165, '1257292312'),
	('127.0.0.1', '2009-11-04', 59, '1257403499'),
	('127.0.0.1', '2009-11-05', 10, '1257433172'),
	('127.0.0.1', '2009-11-11', 13, '1258006911'),
	('127.0.0.1', '2009-11-12', 10, '1258048069'),
	('127.0.0.1', '2009-11-14', 14, '1258222519'),
	('127.0.0.1', '2009-11-17', 2, '1258473856'),
	('127.0.0.1', '2009-11-19', 16, '1258635469'),
	('127.0.0.1', '2009-11-21', 4, '1258863505'),
	('127.0.0.1', '2009-11-25', 3, '1259216216'),
	('127.0.0.1', '2009-11-26', 1, '1259222467'),
	('127.0.0.1', '2009-11-30', 11, '1259651841'),
	('127.0.0.1', '2009-12-02', 9, '1259746407'),
	('127.0.0.1', '2009-12-03', 17, '1259906128'),
	('127.0.0.1', '2009-12-10', 69, '1260423794'),
	('127.0.0.1', '2009-12-12', 26, '1260560082'),
	('127.0.0.1', '2009-12-11', 5, '1260508621'),
	('127.0.0.1', '2009-12-13', 8, '1260716786'),
	('127.0.0.1', '2009-12-14', 9, '1260772698'),
	('127.0.0.1', '2009-12-15', 9, '1260837158'),
	('127.0.0.1', '2009-12-16', 7, '1260905627'),
	('127.0.0.1', '2009-12-17', 48, '1261026791'),
	('127.0.0.1', '2009-12-18', 11, '1261088534'),
	('127.0.0.1', '2009-12-22', 3, '1261477278'),
	('127.0.0.1', '2009-12-25', 2, '1261686043'),
	('127.0.0.1', '2009-12-26', 29, '1261835507'),
	('127.0.0.1', '2009-12-27', 7, '1261920445'),
	('127.0.0.1', '2009-12-28', 3, '1261965611'),
	('127.0.0.1', '2009-12-29', 21, '1262024011'),
	('127.0.0.1', '2009-12-30', 24, '1262146708'),
	('127.0.0.1', '2010-01-01', 12, '1262286131'),
	('127.0.0.1', '2010-01-03', 38, '1262529325'),
	('127.0.0.1', '2010-01-12', 89, '1263264291'),
	('127.0.0.1', '2010-01-14', 54, '1263482540'),
	('127.0.0.1', '2010-01-15', 57, '1263506901'),
	('127.0.0.1', '2010-02-11', 30, '1265831568'),
	('127.0.0.1', '2010-02-13', 2, '1266032303'),
	('127.0.0.1', '2010-02-14', 3, '1266115347'),
	('127.0.0.1', '2010-02-15', 15, '1266195235'),
	('127.0.0.1', '2010-02-18', 1, '1266499945'),
	('127.0.0.1', '2010-02-22', 5, '1266856332'),
	('127.0.0.1', '2010-02-25', 46, '1267103145'),
	('127.0.0.1', '2010-05-12', 10, '1273654648'),
	('127.0.0.1', '2010-05-16', 195, '1274026185'),
	('127.0.0.1', '2010-05-17', 2, '1274029517'),
	('127.0.0.1', '2010-05-19', 1, '1274279374'),
	('127.0.0.1', '2010-05-27', 16, '1274967085'),
	('127.0.0.1', '2010-05-30', 4, '1275192045'),
	('127.0.0.1', '2010-05-31', 13, '1275271939'),
	('127.0.0.1', '2010-06-05', 1, '1275676869'),
	('127.0.0.1', '2010-06-06', 2, '1275842170'),
	('127.0.0.1', '2010-06-15', 3, '1276572924'),
	('127.0.0.1', '2010-06-22', 206, '1277221605'),
	('127.0.0.1', '2010-08-02', 17, '1280754660'),
	('127.0.0.1', '2010-08-20', 7, '1282285305'),
	('127.0.0.1', '2010-08-30', 21, '1283185430'),
	('127.0.0.1', '2010-08-31', 53, '1283207455'),
	('127.0.0.1', '2010-09-02', 133, '1283402651'),
	('127.0.0.1', '2010-09-05', 35, '1283702206'),
	('127.0.0.1', '2010-09-13', 10, '1284370291'),
	('127.0.0.1', '2010-09-17', 12, '1284662303'),
	('127.0.0.1', '2010-09-22', 2, '1285091212'),
	('127.0.0.1', '2010-09-23', 47, '1285254071'),
	('127.0.0.1', '2010-09-26', 32, '1285512806'),
	('127.0.0.1', '2010-09-27', 51, '1285532379'),
	('127.0.0.1', '2010-10-14', 10, '1287074605'),
	('127.0.0.1', '2010-10-15', 6, '1287150179'),
	('127.0.0.1', '2010-10-16', 2, '1287170167'),
	('127.0.0.1', '2010-10-20', 145, '1287636778'),
	('127.0.0.1', '2010-10-21', 177, '1287721183'),
	('127.0.0.1', '2010-10-22', 63, '1287752692'),
	('127.0.0.1', '2011-04-02', 7, '1301680774'),
	('127.0.0.1', '2011-04-03', 8, '1301801389'),
	('127.0.0.1', '2011-04-05', 16, '1301977471'),
	('127.0.0.1', '2011-04-09', 44, '1302288659'),
	('127.0.0.1', '2011-04-10', 129, '1302370890'),
	('127.0.0.1', '2011-04-11', 34, '1302488765'),
	('127.0.0.1', '2011-04-17', 8, '1302998534'),
	('127.0.0.1', '2011-04-22', 5, '1303479879'),
	('127.0.0.1', '2011-04-23', 36, '1303534207'),
	('127.0.0.1', '2011-05-26', 144, '1306423419'),
	('127.0.0.1', '2011-05-27', 59, '1306467737'),
	('127.0.0.1', '2011-05-28', 57, '1306588828'),
	('127.0.0.1', '2011-05-29', 8, '1306649171'),
	('127.0.0.1', '2011-05-30', 18, '1306736260'),
	('192.168.254.1', '2013-01-25', 104, '1359106272'),
	('192.168.254.1', '2013-01-28', 10, '1359352628'),
	('192.168.254.1', '2013-01-29', 25, '1359442462'),
	('192.168.254.1', '2013-01-30', 51, '1359538441');
/*!40000 ALTER TABLE `statistik` ENABLE KEYS */;


-- Dumping structure for table inventor.sub_kategori
DROP TABLE IF EXISTS `sub_kategori`;
CREATE TABLE IF NOT EXISTS `sub_kategori` (
  `id_sub_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub_kategori` varchar(100) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  PRIMARY KEY (`id_sub_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table inventor.sub_kategori: ~7 rows (approximately)
DELETE FROM `sub_kategori`;
/*!40000 ALTER TABLE `sub_kategori` DISABLE KEYS */;
INSERT INTO `sub_kategori` (`id_sub_kategori`, `nama_sub_kategori`, `id_kategori`) VALUES
	(2, 'hiji', 12),
	(3, 'dua', 14),
	(4, 'tilu', 15),
	(5, 'opat', 13),
	(6, 'genep', 12),
	(7, 'tujuh', 12),
	(8, 'dalapan', 14);
/*!40000 ALTER TABLE `sub_kategori` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
