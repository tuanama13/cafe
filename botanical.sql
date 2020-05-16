-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 05:33 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botanical`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cabang`
--

CREATE TABLE `tbl_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `alamat_cabang` text NOT NULL,
  `jumlah_meja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cabang`
--

INSERT INTO `tbl_cabang` (`id_cabang`, `nama_cabang`, `alamat_cabang`, `jumlah_meja`, `id_user`, `logs`) VALUES
(1, 'Botanical dr. Wahidin', 'Jl. dr. Wahidin .S. No 88', 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_detail_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_order` int(11) NOT NULL,
  `harga_produk` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id_detail_order`, `id_order`, `id_produk`, `jumlah_order`, `harga_produk`) VALUES
(25, 1, 23, 1, 20000),
(26, 1, 19, 1, 6000),
(27, 15, 21, 1, 4000),
(28, 16, 22, 1, 15000),
(29, 17, 21, 1, 4000),
(30, 18, 21, 1, 4000),
(31, 19, 19, 1, 6000),
(32, 19, 21, 1, 4000),
(33, 20, 21, 1, 4000),
(34, 21, 21, 1, 4000),
(35, 22, 19, 1, 6000),
(36, 23, 19, 1, 6000),
(37, 23, 21, 1, 4500),
(38, 23, 23, 1, 20000),
(39, 23, 22, 1, 15000),
(40, 23, 20, 1, 20000),
(41, 24, 19, 2, 6000),
(42, 24, 21, 1, 4500),
(43, 25, 21, 1, 4500),
(44, 26, 21, 1, 4500),
(45, 27, 19, 1, 6000),
(46, 28, 19, 1, 6000),
(47, 29, 19, 1, 6000),
(48, 30, 21, 1, 4500),
(49, 31, 19, 1, 6000),
(50, 32, 21, 1, 4500),
(51, 33, 21, 1, 4500),
(52, 34, 21, 1, 4500),
(53, 35, 19, 1, 6000),
(54, 36, 19, 1, 6000),
(55, 37, 19, 1, 6000),
(56, 38, 21, 1, 4500),
(57, 39, 21, 1, 4500),
(58, 40, 21, 1, 4500),
(59, 41, 21, 1, 4500),
(60, 42, 19, 1, 6000),
(61, 43, 21, 1, 4500),
(62, 44, 19, 1, 6000),
(63, 45, 19, 1, 6000),
(64, 46, 21, 1, 4500),
(65, 47, 19, 1, 6000),
(66, 48, 19, 1, 6000),
(67, 49, 19, 1, 6000),
(68, 50, 21, 1, 4500),
(69, 51, 21, 1, 4500),
(70, 52, 19, 1, 6000),
(71, 53, 19, 1, 6000),
(72, 54, 21, 1, 4500),
(73, 55, 19, 1, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kat` int(11) NOT NULL,
  `nama_kat` varchar(50) NOT NULL,
  `desc_kat` text NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kat`, `nama_kat`, `desc_kat`, `logs`) VALUES
(1, 'Makanan', 'This our database connection function. I prefixed it with db_, which I will do as well for the rest of the database functions later. If we were using OOP, we could have an even cleaner looking interface by creating a database class which has the operations as the method names (connect(), query(), etc.). An OOP version of this tutorial has been included at the end of the tutorial.', 1),
(2, 'Minuman', 'This our database connection function. I prefixed it with db_, which I will do as well for the rest of the database functions later. If we were using OOP, we could have an even cleaner looking interface by creating a database class which has the operations as the method names (connect(), query(), etc.). An OOP version of this tutorial has been included at the end of the tutorial.', 1),
(3, 'Snack', 'none', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id_logs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_logs` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ket_logs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id_logs`, `id_user`, `tgl_logs`, `ket_logs`) VALUES
(1, 1, '2019-03-05 09:20:12', 'Init Awal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id_order` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grandtotal` double NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id_order`, `no_meja`, `id_cabang`, `id_user`, `tgl_order`, `grandtotal`, `logs`) VALUES
(14, 1, 1, 1, '2019-06-28 09:51:01', 0, 1),
(15, 4, 1, 1, '2019-06-28 09:51:27', 4000, 1),
(16, 4, 1, 1, '2019-06-28 09:51:39', 15000, 1),
(17, 8, 1, 1, '2019-06-30 22:12:26', 0, 1),
(18, 8, 1, 1, '2019-06-30 22:13:01', 0, 1),
(19, 8, 1, 1, '2019-06-30 22:18:16', 0, 1),
(20, 8, 1, 1, '2019-06-30 22:21:19', 0, 1),
(21, 8, 1, 1, '2019-06-30 22:22:16', 0, 1),
(22, 5, 1, 1, '2019-06-30 22:50:55', 0, 1),
(23, 6, 1, 1, '2019-07-04 10:49:18', 65500, 1),
(24, 8, 1, 1, '2019-07-04 11:30:06', 16500, 1),
(25, 4, 1, 1, '2019-07-04 12:15:36', 0, 1),
(26, 4, 1, 1, '2019-07-04 12:27:02', 4500, 1),
(27, 4, 1, 1, '2019-07-04 12:27:28', 6000, 1),
(28, 6, 1, 1, '2019-07-04 12:30:06', 6000, 1),
(29, 6, 1, 1, '2019-07-04 12:31:07', 6000, 1),
(30, 8, 1, 1, '2019-07-04 12:31:58', 4500, 1),
(31, 8, 1, 1, '2019-07-04 12:33:03', 6000, 1),
(32, 8, 1, 1, '2019-07-04 12:34:24', 4500, 1),
(33, 8, 1, 1, '2019-07-04 12:34:47', 4500, 1),
(34, 8, 1, 1, '2019-07-04 12:40:57', 0, 1),
(35, 2, 1, 1, '2019-07-04 12:42:30', 6000, 1),
(36, 2, 1, 1, '2019-07-04 12:43:03', 6000, 1),
(37, 2, 1, 1, '2019-07-04 12:44:46', 6000, 1),
(38, 2, 1, 1, '2019-07-04 12:45:41', 4500, 1),
(39, 7, 1, 1, '2019-07-04 12:46:18', 4500, 1),
(40, 2, 1, 1, '2019-07-04 12:47:37', 4500, 1),
(41, 7, 1, 1, '2019-07-04 12:53:02', 4500, 1),
(42, 7, 1, 1, '2019-07-04 12:54:38', 6000, 1),
(43, 7, 1, 1, '2019-07-04 12:56:26', 4500, 1),
(44, 7, 1, 1, '2019-07-04 12:58:02', 6000, 1),
(45, 7, 1, 1, '2019-07-04 12:59:47', 6000, 1),
(46, 7, 1, 1, '2019-07-04 13:00:16', 4500, 1),
(47, 7, 1, 1, '2019-07-04 20:34:14', 0, 1),
(48, 4, 1, 1, '2019-07-04 20:37:03', 6000, 1),
(49, 1, 1, 1, '2019-07-04 20:37:29', 6000, 1),
(50, 1, 1, 1, '2019-07-04 20:42:10', 4500, 1),
(51, 1, 1, 1, '2019-07-04 20:46:23', 4500, 1),
(52, 10, 1, 1, '2019-07-04 20:47:10', 6000, 1),
(53, 6, 1, 1, '2019-07-04 20:48:22', 6000, 1),
(54, 1, 1, 1, '2019-11-10 16:48:56', 4500, 1),
(55, 1, 1, 1, '2020-05-16 10:32:38', 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat_pegawai` text NOT NULL,
  `kontak_pegawai` varchar(14) NOT NULL,
  `posisi_pegawai` varchar(50) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `kontak_pegawai`, `posisi_pegawai`, `logs`) VALUES
(1, 'Iron Man', 'Jl. Avengers', '080000000000', 'Kasir', 1),
(2, 'Black Widow', 'Jl. Avengers', '081111111111', 'Kasir', 1),
(3, 'Nick Fury', 'Jl. Avengers', '082222222222', 'Pimpinan', 1),
(5, 'Demi Levato', 'Pontianak', '089878675890', 'Admin', 1),
(6, 'Admin', 'Admin', '08000000000', 'Admin', 1),
(7, 'Kasir', 'kasir', '081111111111', 'Kasir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran`
--

CREATE TABLE `tbl_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pengeluaran` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ket_pengeluaran` text NOT NULL,
  `jumlah_pengeluaran` double NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengeluaran`
--

INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `id_user`, `tgl_pengeluaran`, `ket_pengeluaran`, `jumlah_pengeluaran`, `logs`) VALUES
(1, 1, '2019-06-14 00:00:00', 'Indomie 1 Dus', 120000, 1),
(2, 1, '2019-06-14 00:00:00', 'Bensin 2 Liter', 15000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kat` int(2) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `desc_produk` text NOT NULL,
  `image_produk` text NOT NULL,
  `harga_produk` double NOT NULL,
  `status_produk` int(2) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kat`, `nama_produk`, `desc_produk`, `image_produk`, `harga_produk`, `status_produk`, `logs`) VALUES
(19, 2, 'Kopi Saring', 'Kopi Enak dengan Biji Kopi pilihan', '/image/1/201906281561688872.jpeg', 6000, 1, 1),
(20, 1, 'Fried Chicken', 'None', '/image/1/201906281561688947.jpeg', 20000, 1, 1),
(21, 2, 'Es Teh', 'None', '/image/2/201906281561689129.jpeg', 4500, 1, 1),
(22, 1, 'Nasi Telor asin', 'None', '/image/1/201906281561689219.jpeg', 15000, 1, 1),
(23, 1, 'Nasi Wagyu', 'none', '/image/1/201906281561689265.jpeg', 20000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `role_user` varchar(10) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_pegawai`, `username_user`, `password_user`, `role_user`, `logs`) VALUES
(1, 1, 'ironkece', 'ambrosius13', 'Admin', 1),
(2, 2, 'cutewidow', 'ambrosius13', 'Kasir', 1),
(3, 3, 'furyeye', 'ambrosius13', 'Pimpinan', 1),
(4, 5, 'demiapa', '123456', 'Admin', 1),
(5, 6, 'admin', 'admin', 'Admin', 1),
(6, 7, 'kasir', 'kasir', 'Kasir', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id_logs`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
