-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 03:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mahasiswa`, `alamat`, `telp`) VALUES
('07012007', 'Keisha ', 'Tegalsari', '098723'),
('22670142', 'Lucy Nurianti', 'Tlogosari', '09381'),
('22670152', 'Fadhil Raihan', 'JL Tegalsari Barat II No 18', '08221132');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `iddaftar` int(11) NOT NULL,
  `tgldaftar` date DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `pendapatan_ortu` int(11) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  `jml_saudara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`iddaftar`, `tgldaftar`, `tahun`, `nim`, `pendapatan_ortu`, `ipk`, `jml_saudara`) VALUES
(709, '2024-07-04', '2024', '22670152', 7000000, 3.95, 1),
(711, '2024-07-05', '2024', '22670142', 1000000, 1.09, 1),
(712, '2024-07-05', '2023', '07012007', 7000000, 3.78, 1),
(713, '2024-07-05', '2023', '22670152', 900000, 3.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perangkingan`
--

CREATE TABLE `perangkingan` (
  `idperangkingan` int(11) NOT NULL,
  `iddaftar` int(11) DEFAULT NULL,
  `n_pendapatan` decimal(4,3) DEFAULT NULL,
  `n_ipk` decimal(4,3) DEFAULT NULL,
  `n_saudara` decimal(4,3) DEFAULT NULL,
  `preferensi` decimal(4,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `perangkingan`
--

INSERT INTO `perangkingan` (`idperangkingan`, `iddaftar`, `n_pendapatan`, `n_ipk`, `n_saudara`, `preferensi`) VALUES
(56, 712, 0.129, 0.947, 1.000, 0.548),
(57, 713, 1.000, 1.000, 1.000, 1.000),
(60, 709, 0.143, 1.000, 1.000, 0.571),
(61, 711, 1.000, 0.276, 1.000, 0.783);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `level`) VALUES
(4, 'agus', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`) USING BTREE;

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`iddaftar`) USING BTREE;

--
-- Indexes for table `perangkingan`
--
ALTER TABLE `perangkingan`
  ADD PRIMARY KEY (`idperangkingan`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `iddaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;

--
-- AUTO_INCREMENT for table `perangkingan`
--
ALTER TABLE `perangkingan`
  MODIFY `idperangkingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
