-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2025 at 02:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trashpoint`
--
CREATE DATABASE IF NOT EXISTS `trashpoint` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trashpoint`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `idUser`) VALUES
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `detailpengangkutan`
--

CREATE TABLE `detailpengangkutan` (
  `idDetailPengangkutan` int NOT NULL,
  `idJadwalPengangkutan` int NOT NULL,
  `idTempatSampah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpengangkutan`
--

INSERT INTO `detailpengangkutan` (`idDetailPengangkutan`, `idJadwalPengangkutan`, `idTempatSampah`) VALUES
(1, 1, 7),
(2, 1, 6),
(4, 5, 4),
(5, 5, 5),
(6, 6, 4),
(7, 6, 6),
(8, 7, 5),
(9, 7, 7),
(10, 8, 2),
(11, 8, 5),
(12, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `historybuangsampah`
--

CREATE TABLE `historybuangsampah` (
  `idHistoryBuangSampah` int NOT NULL,
  `idMasyarakat` int NOT NULL,
  `idTempatSampah` int NOT NULL,
  `tglBuangSampah` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historybuangsampah`
--

INSERT INTO `historybuangsampah` (`idHistoryBuangSampah`, `idMasyarakat`, `idTempatSampah`, `tglBuangSampah`) VALUES
(1, 4, 1, '2025-05-15 09:21:08'),
(2, 4, 3, '2025-05-15 09:32:08'),
(3, 4, 4, '2025-05-15 09:33:19'),
(4, 6, 1, '2025-05-15 19:13:03'),
(5, 6, 1, '2025-05-15 21:49:22'),
(6, 7, 3, '2025-05-15 22:19:28'),
(7, 7, 2, '2025-05-15 22:30:39'),
(8, 3, 4, '2025-05-16 13:40:00'),
(9, 5, 4, '2025-05-20 10:52:47'),
(10, 3, 3, '2025-05-20 14:30:14'),
(11, 7, 4, '2025-05-22 18:57:15'),
(12, 1, 3, '2025-05-24 19:12:34'),
(13, 1, 4, '2025-05-24 19:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `historyvoucher`
--

CREATE TABLE `historyvoucher` (
  `idHistoryVoucher` int NOT NULL,
  `idMasyarakat` int NOT NULL,
  `idVoucher` int NOT NULL,
  `tglPenukaran` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historyvoucher`
--

INSERT INTO `historyvoucher` (`idHistoryVoucher`, `idMasyarakat`, `idVoucher`, `tglPenukaran`) VALUES
(1, 6, 1, '2025-05-15 19:56:43'),
(2, 6, 2, '2025-05-15 20:06:05'),
(3, 6, 2, '2025-05-15 20:07:28'),
(4, 6, 1, '2025-05-15 20:19:28'),
(5, 6, 1, '2025-05-15 20:22:50'),
(6, 6, 1, '2025-05-15 20:26:42'),
(7, 6, 1, '2025-05-15 20:27:49'),
(8, 6, 2, '2025-05-15 20:30:21'),
(9, 6, 1, '2025-05-15 21:50:45'),
(11, 5, 2, '2025-05-24 19:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalpengangkutan`
--

CREATE TABLE `jadwalpengangkutan` (
  `idJadwalPengangkutan` int NOT NULL,
  `idPetugas` int NOT NULL,
  `idAdmin` int NOT NULL,
  `tglJadwalPengangkutan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusJadwalPengangkutan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwalpengangkutan`
--

INSERT INTO `jadwalpengangkutan` (`idJadwalPengangkutan`, `idPetugas`, `idAdmin`, `tglJadwalPengangkutan`, `statusJadwalPengangkutan`) VALUES
(1, 1, 1, '2025-05-20 13:08:27', 'accept'),
(5, 1, 1, '2025-05-20 22:20:13', 'reject'),
(6, 1, 1, '2025-05-20 22:23:40', 'accept'),
(7, 1, 1, '2025-05-21 18:46:52', 'accept'),
(8, 1, 1, '2025-05-21 19:42:27', 'accept'),
(9, 1, 1, '2025-05-21 19:46:09', 'on progress');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `idMasyarakat` int NOT NULL,
  `idUser` int NOT NULL,
  `point` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`idMasyarakat`, `idUser`, `point`) VALUES
(1, 1, 0),
(3, 4, 2),
(4, 5, 900),
(5, 6, 0),
(6, 7, 100),
(7, 8, 2),
(8, 10, 0),
(9, 16, 0),
(10, 17, 0),
(11, 18, 0),
(12, 20, 0),
(13, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idPetugas` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idPetugas`, `idUser`) VALUES
(1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tempatsampah`
--

CREATE TABLE `tempatsampah` (
  `idTempatSampah` int NOT NULL,
  `kotaTempatSampah` varchar(30) NOT NULL,
  `jalanTempatSampah` text NOT NULL,
  `statusTempatSampah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempatsampah`
--

INSERT INTO `tempatsampah` (`idTempatSampah`, `kotaTempatSampah`, `jalanTempatSampah`, `statusTempatSampah`) VALUES
(1, 'Depok', 'Jl Sukatani', 'active'),
(2, 'Depok', 'Jl Margonda', 'active'),
(3, 'Bekasi', 'Jl Sudirman', 'active'),
(4, 'Bekasi', 'Jl Merdeka', 'collecting'),
(5, 'Bogor', 'Jl. Pustaka', 'active'),
(6, 'Bandung', 'Jl. Telkom', 'active'),
(7, 'Jakarta', 'Jl. Hatta', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `password`, `phoneNumber`, `role`, `status`) VALUES
(1, 'masyarakat', 'masyarakat@gmail.com', 'masyarakat123', '087362764', 'masyarakat', 'active'),
(4, 'rudi', 'rudi@gmail.com', 'rudi123', '08557639854', 'masyarakat', 'active'),
(5, 'imam', 'imam@gmail.com', 'imam123', '08462354', 'masyarakat', 'active'),
(6, 'rutbir', 'rutbir@gmail.com', 'rutbir123', '084352743', 'masyarakat', 'active'),
(7, 'ilham', 'ilham@gmial.com', 'ilham123', '083724674', 'masyarakat', 'active'),
(8, 'dimas', 'dimas@gmail.com', 'dimas123', '0843767343', 'masyarakat', 'active'),
(9, 'admin', 'admin@gmail.com', 'admin123', '087374374', 'admin', 'active'),
(10, 'mahmud', 'mahmud@gmail.com', 'mahmud123', '086437624', 'masyarakat', 'active'),
(16, 'denis', 'denis@gmail.com', '[C@3b81b7c2', '08347377', 'masyarakat', 'active'),
(17, 'ariq', 'ariq@gmail.com', '[C@6f7367d3', '0836467367', 'masyarakat', 'active'),
(18, 'demam', 'demam', '[C@423ce319', '0384736', 'masyarakat', 'active'),
(19, 'pandu', 'pandu@gmail.com', 'pandu123', '0855763274', 'petugas', 'active'),
(20, 'ahmad', 'ahmad@gmail.com', 'ahmad123', '0834672463', 'masyarakat', 'active'),
(21, 'juned', 'juned@gmail.com', 'juned123', '083476347', 'masyarakat', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `idVoucher` int NOT NULL,
  `namaVoucher` varchar(30) NOT NULL,
  `hargaVoucher` int NOT NULL,
  `statusVoucher` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`idVoucher`, `namaVoucher`, `hargaVoucher`, `statusVoucher`) VALUES
(1, 'XBOX Gamepass 1 month', 100, 'active'),
(2, 'Netflix 1 month', 200, 'active'),
(3, 'Chat GPT 2 Month', 100, 'deleted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `detailpengangkutan`
--
ALTER TABLE `detailpengangkutan`
  ADD PRIMARY KEY (`idDetailPengangkutan`),
  ADD KEY `idJadwalPengangkutan` (`idJadwalPengangkutan`),
  ADD KEY `idTempatSampah` (`idTempatSampah`);

--
-- Indexes for table `historybuangsampah`
--
ALTER TABLE `historybuangsampah`
  ADD PRIMARY KEY (`idHistoryBuangSampah`),
  ADD KEY `idMasyarakat` (`idMasyarakat`),
  ADD KEY `idTempatSampah` (`idTempatSampah`);

--
-- Indexes for table `historyvoucher`
--
ALTER TABLE `historyvoucher`
  ADD PRIMARY KEY (`idHistoryVoucher`),
  ADD KEY `idMasyarakat` (`idMasyarakat`),
  ADD KEY `idVoucher` (`idVoucher`);

--
-- Indexes for table `jadwalpengangkutan`
--
ALTER TABLE `jadwalpengangkutan`
  ADD PRIMARY KEY (`idJadwalPengangkutan`),
  ADD KEY `idPetugas` (`idPetugas`),
  ADD KEY `idAdmin` (`idAdmin`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`idMasyarakat`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idPetugas`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tempatsampah`
--
ALTER TABLE `tempatsampah`
  ADD PRIMARY KEY (`idTempatSampah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`idVoucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detailpengangkutan`
--
ALTER TABLE `detailpengangkutan`
  MODIFY `idDetailPengangkutan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `historybuangsampah`
--
ALTER TABLE `historybuangsampah`
  MODIFY `idHistoryBuangSampah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `historyvoucher`
--
ALTER TABLE `historyvoucher`
  MODIFY `idHistoryVoucher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jadwalpengangkutan`
--
ALTER TABLE `jadwalpengangkutan`
  MODIFY `idJadwalPengangkutan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `idMasyarakat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idPetugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tempatsampah`
--
ALTER TABLE `tempatsampah`
  MODIFY `idTempatSampah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `idVoucher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `detailpengangkutan`
--
ALTER TABLE `detailpengangkutan`
  ADD CONSTRAINT `detailpengangkutan_ibfk_1` FOREIGN KEY (`idJadwalPengangkutan`) REFERENCES `jadwalpengangkutan` (`idJadwalPengangkutan`),
  ADD CONSTRAINT `detailpengangkutan_ibfk_2` FOREIGN KEY (`idTempatSampah`) REFERENCES `tempatsampah` (`idTempatSampah`);

--
-- Constraints for table `historybuangsampah`
--
ALTER TABLE `historybuangsampah`
  ADD CONSTRAINT `historybuangsampah_ibfk_1` FOREIGN KEY (`idTempatSampah`) REFERENCES `tempatsampah` (`idTempatSampah`),
  ADD CONSTRAINT `historybuangsampah_ibfk_2` FOREIGN KEY (`idMasyarakat`) REFERENCES `masyarakat` (`idMasyarakat`);

--
-- Constraints for table `historyvoucher`
--
ALTER TABLE `historyvoucher`
  ADD CONSTRAINT `historyvoucher_ibfk_1` FOREIGN KEY (`idMasyarakat`) REFERENCES `masyarakat` (`idMasyarakat`),
  ADD CONSTRAINT `historyvoucher_ibfk_2` FOREIGN KEY (`idVoucher`) REFERENCES `voucher` (`idVoucher`);

--
-- Constraints for table `jadwalpengangkutan`
--
ALTER TABLE `jadwalpengangkutan`
  ADD CONSTRAINT `jadwalpengangkutan_ibfk_1` FOREIGN KEY (`idPetugas`) REFERENCES `petugas` (`idPetugas`),
  ADD CONSTRAINT `jadwalpengangkutan_ibfk_2` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`);

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
