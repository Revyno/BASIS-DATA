-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 10:58 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`) VALUES
(1, 'Devina Almirah firadus'),
(2, 'Janet Gloria puspitasari'),
(3, 'Yelena Theresia Sibuea'),
(4, 'Revellio');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `Waktu_pembayaran` time DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_penjualan`, `metode_pembayaran`, `jumlah_bayar`, `tanggal_pembayaran`, `Waktu_pembayaran`, `id_pelanggan`) VALUES
(1, 1, 'Kartu Kredit', 10.00, '2024-07-01', '14:30:00', NULL),
(3, 3, 'Dompet Digital', 9.00, '2024-07-03', '16:00:00', NULL),
(4, 4, 'Kartu Kredit', 60.00, '2024-07-04', '17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_penjualan` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_produk`, `id_pelanggan`, `jumlah`, `tanggal_penjualan`) VALUES
(1, 1, 1, 2, '2024-06-30 17:00:00'),
(3, 3, 2, 5, '2024-07-02 17:00:00'),
(4, 4, 3, 3, '2024-07-03 17:00:00'),
(7, 1, 4, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`) VALUES
(1, 'coca cola', 5.00),
(2, 'sprite', 7.00),
(3, 'indomie', 3.00),
(4, 'rinso', 15.00),
(5, 'ultra', 7.00);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penjualan_detail`
-- (See below for the actual view)
--
CREATE TABLE `v_penjualan_detail` (
`id_penjualan` int(11)
,`tanggal_penjualan` timestamp
,`nama_produk` varchar(255)
,`nama_pelanggan` varchar(255)
,`jumlah` int(11)
,`harga` decimal(10,2)
,`metode_pembayaran` varchar(255)
,`jumlah_bayar` decimal(10,2)
,`tanggal_pembayaran` date
,`waktu_pembayaran` time
,`total_harga` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v_penjualan_detail`
--
DROP TABLE IF EXISTS `v_penjualan_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan_detail`  AS SELECT `penjualan`.`id_penjualan` AS `id_penjualan`, `penjualan`.`tanggal_penjualan` AS `tanggal_penjualan`, `produk`.`nama` AS `nama_produk`, `pelanggan`.`nama` AS `nama_pelanggan`, `penjualan`.`jumlah` AS `jumlah`, `produk`.`harga` AS `harga`, `pembayaran`.`metode_pembayaran` AS `metode_pembayaran`, `pembayaran`.`jumlah_bayar` AS `jumlah_bayar`, `pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran`, `pembayaran`.`Waktu_pembayaran` AS `waktu_pembayaran`, `penjualan`.`jumlah`* `produk`.`harga` AS `total_harga` FROM (((`penjualan` join `produk` on(`penjualan`.`id_produk` = `produk`.`id_produk`)) join `pelanggan` on(`penjualan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) join `pembayaran` on(`penjualan`.`id_penjualan` = `pembayaran`.`id_penjualan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `FK_id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
