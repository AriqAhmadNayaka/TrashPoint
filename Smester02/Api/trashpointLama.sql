-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2025 at 03:14 AM
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
-- Database: `trashpointlama`
--
CREATE DATABASE IF NOT EXISTS `trashpointlama` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trashpointlama`;

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
(12, 9, 4),
(13, 10, 1),
(14, 10, 2),
(15, 10, 3),
(16, 10, 4),
(17, 10, 7),
(18, 11, 6),
(19, 12, 2),
(20, 12, 7),
(21, 13, 8),
(22, 14, 1),
(23, 14, 2),
(24, 14, 4),
(25, 15, 4),
(26, 15, 5),
(27, 16, 7),
(28, 16, 8),
(29, 17, 6),
(30, 18, 6),
(31, 18, 7),
(32, 19, 1),
(33, 19, 2),
(34, 20, 3),
(35, 20, 4),
(36, 21, 1),
(37, 21, 2),
(38, 21, 3),
(39, 21, 4),
(40, 22, 6),
(41, 22, 7),
(42, 22, 8),
(43, 23, 1),
(44, 23, 2),
(45, 24, 1),
(46, 24, 2),
(47, 24, 3),
(48, 25, 4),
(49, 25, 5);

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
(13, 1, 4, '2025-05-24 19:17:31'),
(14, 3, 6, '2025-05-29 00:09:53'),
(116, 3, 3, '2025-05-29 00:33:58'),
(117, 3, 3, '2025-05-29 00:58:22'),
(118, 14, 3, '2025-05-29 22:58:46'),
(119, 14, 2, '2025-05-29 23:01:56'),
(120, 15, 8, '2025-06-01 13:31:40'),
(121, 15, 7, '2025-06-01 13:31:43'),
(122, 15, 8, '2025-06-01 14:40:11'),
(123, 3, 2, '2025-06-01 15:11:35'),
(124, 3, 9, '2025-06-01 15:17:23'),
(125, 3, 5, '2025-06-01 15:19:44'),
(126, 16, 5, '2025-06-01 20:16:44'),
(127, 3, 6, '2025-06-02 10:30:02'),
(128, 17, 5, '2025-06-02 11:04:48'),
(129, 17, 5, '2025-06-02 11:30:40'),
(130, 17, 8, '2025-06-02 11:42:18'),
(131, 17, 5, '2025-06-02 11:42:36'),
(132, 19, 2, '2025-06-03 11:48:10'),
(133, 20, 8, '2025-06-04 15:59:28');

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
(11, 5, 2, '2025-05-24 19:21:23'),
(12, 5, 1, '2025-05-27 09:50:12'),
(13, 3, 5, '2025-05-29 00:52:46'),
(14, 3, 5, '2025-05-29 00:53:41'),
(15, 3, 5, '2025-05-29 19:47:59'),
(16, 3, 5, '2025-05-29 19:53:33'),
(17, 4, 2, '2025-05-30 15:14:46'),
(18, 15, 5, '2025-06-01 14:40:19'),
(19, 3, 1, '2025-06-01 15:19:25'),
(20, 3, 5, '2025-06-01 15:19:46'),
(21, 16, 5, '2025-06-01 20:17:07'),
(22, 5, 1, '2025-06-01 20:18:13'),
(23, 5, 5, '2025-06-02 00:33:39'),
(24, 5, 1, '2025-06-02 00:33:51'),
(25, 17, 5, '2025-06-02 11:05:07'),
(26, 17, 5, '2025-06-02 11:31:00'),
(27, 17, 1, '2025-06-02 11:42:51'),
(28, 19, 5, '2025-06-03 11:48:24'),
(29, 20, 5, '2025-06-04 15:59:35'),
(30, 5, 5, '2025-06-04 23:30:10');

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
(9, 1, 1, '2025-05-21 19:46:09', 'accept'),
(10, 1, 1, '2025-05-30 15:43:19', 'accept'),
(11, 1, 1, '2025-05-30 15:43:32', 'accept'),
(12, 1, 1, '2025-06-01 12:07:39', 'accept'),
(13, 1, 1, '2025-06-01 12:36:00', 'reject'),
(14, 1, 1, '2025-06-01 13:05:35', 'accept'),
(15, 1, 1, '2025-06-01 14:21:21', 'accept'),
(16, 1, 1, '2025-06-01 14:21:26', 'reject'),
(17, 1, 1, '2025-06-01 14:21:29', 'accept'),
(18, 1, 1, '2025-06-01 14:53:02', 'accept'),
(19, 2, 1, '2025-06-01 14:56:22', 'accept'),
(20, 1, 1, '2025-06-01 14:56:59', 'accept'),
(21, 2, 1, '2025-06-01 15:30:45', 'on progress'),
(22, 2, 1, '2025-06-01 15:35:17', 'on progress'),
(23, 1, 1, '2025-06-02 11:46:59', 'on progress'),
(24, 1, 1, '2025-06-02 11:51:20', 'on progress'),
(25, 1, 1, '2025-06-04 16:02:09', 'accept');

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
(3, 4, 51),
(4, 5, 595),
(5, 6, 0),
(6, 7, 100),
(7, 8, 2),
(8, 10, 0),
(9, 16, 0),
(10, 17, 0),
(11, 18, 0),
(12, 20, 0),
(13, 21, 0),
(14, 22, 2),
(15, 23, 2),
(16, 25, 0),
(17, 26, 0),
(18, 27, 0),
(19, 28, 0),
(20, 29, 0);

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
(1, 19),
(2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tempatsampah`
--

CREATE TABLE `tempatsampah` (
  `idTempatSampah` int NOT NULL,
  `kotaTempatSampah` varchar(30) NOT NULL,
  `jalanTempatSampah` text NOT NULL,
  `statusTempatSampah` varchar(30) NOT NULL,
  `lat` double(9,6) NOT NULL,
  `lon` double(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempatsampah`
--

INSERT INTO `tempatsampah` (`idTempatSampah`, `kotaTempatSampah`, `jalanTempatSampah`, `statusTempatSampah`, `lat`, `lon`) VALUES
(1, 'Bekasi', 'Jl. Raya Bekasi No.1', 'collecting', -6.234000, 106.979000),
(2, 'Bekasi', 'Jl. Mitra No.2', 'collecting', -6.238000, 106.974000),
(3, 'Bekasi', 'Jl. Wibawa Mukti No.3', 'collecting', -6.239000, 106.981000),
(4, 'Bekasi', 'Jl. Sultan Agung No.4', 'active', -6.230000, 106.975000),
(5, 'Bekasi', 'Jl. Taman No.5', 'active', -6.232000, 106.983000),
(6, 'Bekasi', 'Jl. Pejuang No.6', 'collecting', -6.225000, 106.976000),
(7, 'Bekasi', 'Jl. Harapan Indah No.7', 'collecting', -6.227000, 106.980000),
(8, 'Bekasi', 'Jl. Ahmad Yan', 'collecting', -6.226574, 106.997086),
(9, 'Bekasi', 'Jl. Kali Rawatembaga', 'deleted', -6.242567, 106.994722),
(10, 'Bekas', 'Jl. Kh. Masturo', 'active', -6.242258, 107.000784);

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
(21, 'juned', 'juned@gmail.com', 'juned123', '083476347', 'masyarakat', 'active'),
(22, 'yanto', 'yanto@gmail.com', 'yanto123', '08363663', 'masyarakat', 'active'),
(23, 'masjuki', 'masjuki@gmail.com', 'masjuki123', '084376473', 'masyarakat', 'active'),
(24, 'momo', 'momo@gmail.com', 'momo123', '0834673674', 'petugas', 'active'),
(25, 'ariqnayaka', 'ariqnayaka@gmail.com', 'ariqnayaka123', '03498384783', 'masyarakat', 'active'),
(26, 'kipa', 'akhivajeven1@gmail.com', 'Mazmur12345', '082273892607', 'masyarakat', 'active'),
(27, 'Ghazy', 'ghazy234@gmail.com', 'ghazy12', '08912536899', 'masyarakat', 'active'),
(28, 'dimas', 'yesus@gmail.com', 'yesuskeren12', '0843767343', 'masyarakat', 'active'),
(29, 'asfar', 'asfar@gmail.com', 'asfar123', '086365243', 'masyarakat', 'active');

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
(3, 'Chat GPT 2 Month', 100, 'deleted'),
(4, 'Spotify 1 month', 100, 'active'),
(5, 'Webtoon 1 month', 50, 'active'),
(6, 'Deep seek 1 month', 300, 'deleted');

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
  MODIFY `idDetailPengangkutan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `historybuangsampah`
--
ALTER TABLE `historybuangsampah`
  MODIFY `idHistoryBuangSampah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `historyvoucher`
--
ALTER TABLE `historyvoucher`
  MODIFY `idHistoryVoucher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jadwalpengangkutan`
--
ALTER TABLE `jadwalpengangkutan`
  MODIFY `idJadwalPengangkutan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `idMasyarakat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idPetugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tempatsampah`
--
ALTER TABLE `tempatsampah`
  MODIFY `idTempatSampah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `idVoucher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
