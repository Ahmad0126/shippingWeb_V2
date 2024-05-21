-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 04:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `kode_cabang` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `fasilitas` enum('Warehouse','Office','Sorting Center','Gateway') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengiriman`
--

CREATE TABLE `detail_pengiriman` (
  `id_detail` int(11) NOT NULL,
  `kode_pengiriman` varchar(20) NOT NULL,
  `tanggal_dikirim` datetime NOT NULL,
  `nama_penerima` varchar(60) NOT NULL,
  `no_hp_penerima` varchar(15) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `berat` int(11) NOT NULL,
  `koli` int(11) NOT NULL,
  `instruksi_khusus` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `kode_pengiriman` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `status` enum('registered','checkout','forwarded','received_sort','received_origin','received_warehouse','delivery','delivered') NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_cabang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(20) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `waktu` varchar(11) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `nama_pengirim` varchar(60) NOT NULL,
  `alamat_pengirim` varchar(200) NOT NULL,
  `no_hp_pengirim` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `pembayaran` enum('Tunai','Kredit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `kode_pengiriman` varchar(20) NOT NULL,
  `alamat_tujuan` varchar(200) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `estimasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('Kasir','Officer','Kurir','Admin') NOT NULL,
  `nama` varchar(60) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`, `telp`, `kota`) VALUES
(1, 'admin', '1d5a51389eab7a976d3572e9db25fe78', 'Admin', 'Administrator', '08976543821', 'Karanganyar'),
(4, 'tamu1', '25d55ad283aa400af464c76d713c07ad', 'Kurir', 'Kurir1', '09876543212', 'Karanganyar'),
(5, 'AZ_778B', '25d55ad283aa400af464c76d713c07ad', 'Officer', 'Officer1', '08123456780', 'Karanganyar'),
(7, 'kasir', '25d55ad283aa400af464c76d713c07ad', 'Kasir', 'kasir1', '087234623456', 'Karanganyar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
