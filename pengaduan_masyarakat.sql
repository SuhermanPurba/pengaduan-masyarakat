-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 05:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `verif` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `nama`, `username`, `email`, `password`, `telp`, `verif`, `created_at`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kabupaten`) VALUES
(1, '1234567890123456', 'jenni', 'jenni1', 'jenni@gmail.com', '$2y$10$Y6BlYoafdikNMurqfK5rxutHLz75gvk9QklB316ELvq0OyHQGPpjm', NULL, 0, '2025-05-21 19:39:52', '01', '02', 'Kelurahan A', 'Kecamatan B', 'Kabupaten C'),
(2, '2345678901234567', 'cinta', 'cinta12', 'cinta12@gmail.com', '103f51b75acf0a2382db01eba18d4253', NULL, 1, '2025-05-21 19:46:13', NULL, NULL, NULL, NULL, NULL),
(3, '0987654321123456', 'jejen', 'jejen22', 'jejen22@gmail.com', 'a86e0e69051e2127c71b77fb2572c854', NULL, 1, '2025-06-05 11:52:30', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` varchar(16) NOT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kabupaten`, `alamat`) VALUES
('0987654321123456', '01', '02', 'Kelurahan A', 'Kecamatan B', 'Kabupaten C', 'Kabupaten d'),
('1234567890123456', '01', '02', 'Kelurahan A', 'Kecamatan B', 'Kabupaten C', 'Jl. Mawar No. 1'),
('2345678901234567', '03', '04ccc', 'Kelurahan Xxxxxxxxxxxxxxxxx', 'Kecamatan Y', 'Kabupaten Z', 'Jl. Melati No. 5'),
('3456789012345678', '05', '06444', 'Kelurahan M', 'Kecamatan N', 'Kabupaten Ooo', 'Jl. Kenanga No. 1011');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` varchar(16) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'noImage.png',
  `status` varchar(100) DEFAULT 'laporan anda akan ditindaklanjuti'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `judul`, `isi_laporan`, `foto`, `status`) VALUES
(2, '2025-06-07', '0987654321123456', 'wwwwwww', 'wwwwwww', '07062025055609_mobiljd.jpeg', 'laporan anda ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(5) NOT NULL,
  `nama_petugas` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp_petugas` varchar(13) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `email`, `username`, `password`, `telp_petugas`, `level`) VALUES
(1, 'Aqil Rahman', 'admin@gmail.com', 'adminnnnn', '21232f297a57a5a743894a0e4a801fc3', '081215951492', 'petugas'),
(2, 'RANI', 'petugas@gmail.com', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', '081215951492', 'petugas'),
(3, 'TheKingTermux', 'tkt@gmail.com', 'tkt', '7b57f31bea0ae2e9c8e2985a285b922d', '85964357965', 'admin'),
(6, 'Dam', 'dam@gmail.com', 'dam', '76ca1ef9eac7ebceeb9267daffd7fe48', '081232432356', 'petugas'),
(7, 'ferdian', 'ferwdaaw@gmail.com', 'ferdii', '202cb962ac59075b964b07152d234b70', '123', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(5) NOT NULL,
  `id_pengaduan` int(5) NOT NULL,
  `tgl_tanggapan` varchar(20) NOT NULL,
  `tanggapan` text NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `id_petugas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `bukti`, `id_petugas`) VALUES
(3, 3, '2023-02-25', 'siap', '', 2),
(4, 4, '2023-03-01', 'siap mank', '', 3),
(5, 8, '2023-03-07', 'siap ditunggu', '', 3),
(12, 13, '2023-03-14', 'ok', '140320231815register.png', 3),
(13, 14, '2023-03-14', 'qSKQSKQks', '140320232733login.png', 3),
(15, 10, '2023-03-15', 'oke', 'noImage.png', 7),
(16, 16, '2023-03-16', '234569', 'noImage.png', 6),
(17, 17, '2023-03-16', 'ssssss', '160320235058140320230526register.png', 3),
(24, 2, '2025-06-07', 'nnnnnnnnn', '070620255707mobiljd.jpeg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD UNIQUE KEY `id_pengaduan` (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `masyarakat` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
