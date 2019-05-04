-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 05:34 AM
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
  `id_user` int(11) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cabang`
--

INSERT INTO `tbl_cabang` (`id_cabang`, `nama_cabang`, `alamat_cabang`, `id_user`, `logs`) VALUES
(1, 'Botanical dr. Wahidin', 'Jl. dr. Wahidin .S. No 88', 1, 1);

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
(2, 'Minuman', 'This our database connection function. I prefixed it with db_, which I will do as well for the rest of the database functions later. If we were using OOP, we could have an even cleaner looking interface by creating a database class which has the operations as the method names (connect(), query(), etc.). An OOP version of this tutorial has been included at the end of the tutorial.', 1);

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
  `id_cabang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `grandtotal` double NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Iron Man', 'Jl. Avengers', '080000000000', 'Admin', 1),
(2, 'Black Widow', 'Jl. Avengers', '081111111111', 'Kasir', 1),
(3, 'Nick Fury', 'Jl. Avengers', '082222222222', 'Pimpinan', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
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
(1, 1, 'Mac and Cheese', 'This diagram shows Address Types, which are an example of Reference Data.\r\nThis kind of data has the following characteristics :-\r\n\r\n    it doesn\'t change very much\r\n    it has a relatively small number of values, usually less than a few dozen and never more than a few hundred.\r\n    Therefore we can show it with a Code as a Primary Key.\r\n    Data in Reference Data Tables can be used to populate drop-down lists for Users to select from.\r\n    In this way, it is used to ensure that all new data is valid. \r\n\r\n', '/image/1/1.jpg', 15000, 0, 1),
(2, 2, 'Ice Tea', 'This diagram shows Address Types, which are an example of Reference Data.\r\nThis kind of data has the following characteristics :-\r\n\r\n    it doesn\'t change very much\r\n    it has a relatively small number of values, usually less than a few dozen and never more than a few hundred.\r\n    Therefore we can show it with a Code as a Primary Key.\r\n    Data in Reference Data Tables can be used to populate drop-down lists for Users to select from.\r\n    In this way, it is used to ensure that all new data is valid. \r\n\r\n', '/image/2/1.jpg', 5000, 0, 1),
(5, 1, 'Indomie Gokil', 'Semangkuk Indomie-nya hadir dengan daging kikil dan sambal cabe hijau-nya. Sensasi rasa kenyal pada kikil-nya, serta Indomie-nya yang gurih dan pedas memang nagih banget. Mantap! ', '/image/1/2.jpg', 15500, 1, 1),
(6, 1, 'Nasi Wagyu Slice Saus Mushroom', 'Yang satu ini juga nggak boleh ketinggalan buat kamu cicipi. Ngelihat fotonya saja sudah bisa bikin ngiler. Nasi putih hangat dengan irisan daging wagyu dengan saus mushroom-nya yang gurih, creamy, dan manis juara banget memang rasanya. Nggak ketinggalan telur mata sapinya. Hmmm, siap-siap di bikin jatuh cinta ya sama kelezatannya! ', '/image/1/3.jpg', 25500, 1, 1),
(7, 1, 'Cireng Pandawa', 'Tekstur garing dan crunchy pada bagian luarnya, serta dalamnya yang kenyal dan rasanya yang gurih memang nggak bakalan bisa di tolak. Apalagi kalau dicocol dengan sambalnya yang pedas manis', '/image/1/4.jpg', 24000, 1, 1),
(8, 2, 'Caffe Latte', 'Menu minuman yang nggak boleh ketinggalan ketika nongkrong, yaa kopi.', '/image/2/2.jpg', 25000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `role_user` int(2) NOT NULL,
  `logs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_pegawai`, `username_user`, `password_user`, `role_user`, `logs`) VALUES
(1, 1, 'ironkece', 'ambrosius13', 1, 1),
(2, 2, 'cutewidow', 'ambrosius13', 2, 1),
(3, 3, 'furyeye', 'ambrosius13', 3, 1);

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
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
