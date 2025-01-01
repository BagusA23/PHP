-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2025 at 11:33 AM
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
-- Database: `bank_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_sampah`
--

CREATE TABLE `kategori_sampah` (
  `id_kategori` int NOT NULL,
  `jenis` enum('organik','anorganik','b3') NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_sampah`
--

INSERT INTO `kategori_sampah` (`id_kategori`, `jenis`, `harga_per_kg`, `keterangan`) VALUES
(1, 'organik', '10000.00', 'sisa sayur, kulit pisang, buah busuk, dan kulit bawang DLL'),
(2, 'anorganik', '5000.00', 'Ban bekas, Aneka elektronik, Pembuangan pestisida, Kertas kaca DLL'),
(3, 'b3', '4000.00', 'Batu baterai bekas, Pestisida, Hairspray, Deterjen pakaian, Pembersih lantai DL');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `deskripsi` text,
  `status` enum('pending','in progress','resolved') DEFAULT NULL,
  `tanggal_laporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis` enum('sampah rumah tangga','sampah industri','sampah b3') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_user`, `deskripsi`, `status`, `tanggal_laporan`, `jenis`, `gambar`, `lokasi`) VALUES
(6, 2, 'ini ada sampah', 'resolved', '2024-12-06 10:40:13', 'sampah b3', '6752d48da54d6.png', 'palembang');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int NOT NULL,
  `id_user` int NOT NULL,
  `Nama_dana` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nomor_dana` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','selesai','batal') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_user`, `Nama_dana`, `Nomor_dana`, `jumlah`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 'baagus', '0289456146', '50000.00', '2024-12-28 12:43:30', 'selesai', '2024-12-28 05:43:30', '2024-12-28 05:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `setor_sampah`
--

CREATE TABLE `setor_sampah` (
  `id_setor` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `berat` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','proses','selesai') NOT NULL DEFAULT 'pending',
  `tanggal_setoran` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `setor_sampah`
--

INSERT INTO `setor_sampah` (`id_setor`, `id_user`, `id_kategori`, `berat`, `total_harga`, `status`, `tanggal_setoran`) VALUES
(17, 2, 2, '2.00', '10000.00', 'selesai', '2024-12-03 07:48:05'),
(19, 2, 2, '2.20', '11000.00', 'selesai', '2024-12-03 07:57:00'),
(20, 2, 1, '2.20', '22000.00', 'selesai', '2024-12-03 07:58:45'),
(35, 2, 2, '2.00', '10000.00', 'selesai', '2024-12-05 03:30:15'),
(36, 2, 3, '10.00', '30000.00', 'selesai', '2024-12-05 03:33:03'),
(38, 2, 2, '3.00', '15000.00', 'selesai', '2024-12-05 06:10:50'),
(39, 11, 2, '2.00', '10000.00', 'selesai', '2024-12-12 03:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `role`, `tanggal_daftar`) VALUES
(1, 'bagusanardiansyah@gmail.com', '$2y$12$drgCEAM16Ehh7y4oMq/DDeg02xB2r789FBJmZFf./sLQS8PQ3/en6', 'admin', '2024-12-02 04:09:21'),
(2, 'bagus@gmail.com', '$2y$12$Aed3PfP/anv8o3Q6CqY7wevJ6jlW9d9lmVmmCF7GsqGO2y7wYQ6EG', 'user', '2024-12-02 04:26:54'),
(3, 'fina608@gmail.com', '$2y$10$2yJlq9qaqVFJ/riZRwRhU.uUThh35lCi7f8upAvQEY50fhusucQCW', 'user', '2024-12-05 02:01:53'),
(4, 'fina12@gmail.com', '$2y$10$d.0KZB1.KUr4VioMQ9uOX.FQ1jp/MAo9io/Pu/Yw4TlSz4w4pBMra', 'user', '2024-12-05 02:05:22'),
(5, 'siap@gmail.com', '$2y$10$8/zC8EK4WpF2ktVRjbXz2OuVhZ37cunOUaWfdureNepdjss/n88Ja', 'user', '2024-12-05 06:14:48'),
(11, 'test@gmail.com', '$2y$10$7sbevZaA7z.QYL/3x8VRLuolcdm56iLUTO94bPWk12/Csl3ka2t9G', 'user', '2024-12-12 02:56:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fk_laporan_user` (`id_user`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD PRIMARY KEY (`id_setor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  MODIFY `id_setor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD CONSTRAINT `setor_sampah_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `setor_sampah_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_sampah` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
