-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 09:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangrapat1`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `layout_identifier` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `layout_id`, `file_path`, `layout_identifier`) VALUES
(14, 8, '20241212/1733984826_e5ee5b19af67cd71d868.png', 'A'),
(15, 8, '20241212/1733984826_743d7f65f6da2e15b7f7.png', 'B'),
(17, 10, '20241212/1733986294_ef917d849420b3de83fb.png', 'A'),
(18, 11, '20241212/1733993470_fed598ab31c8d491ec32.png', 'A'),
(19, 11, '20241212/1733993470_37cf290a370a742fd874.png', 'B'),
(20, 11, '20241212/1733993470_625d826fc48cdb4fdad8.png', 'C'),
(21, 11, '20241212/1733993470_c9892f01f1513b32e65d.png', 'D'),
(22, 11, '20241212/1733993470_ac97d8f581fd0f36de31.png', 'E'),
(23, 11, '20241212/1733993470_ef6cd5a5ef0fa7e15c61.png', 'F'),
(24, 11, '20241212/1733993470_de45904915a15acf8a3b.png', 'G'),
(26, 13, '20241215/1734265828_e6a703edd45e0832111d.png', 'A'),
(27, 11, '1734268092_b7379744c0cce75931bf.png', 'H'),
(28, 11, '1734268123_a80a6a724a3024ede01c.png', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `input_layout`
--

CREATE TABLE `input_layout` (
  `id` int(11) NOT NULL,
  `nama_layout` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_layout`
--

INSERT INTO `input_layout` (`id`, `nama_layout`, `image_path`, `created_at`) VALUES
(13, 'Persegi', 'Persegi.png', '2024-12-27 02:33:40'),
(14, 'Persegi Panjang', 'Persegi Panjang.png', '2024-12-27 02:40:02'),
(18, 'Lingkaran', 'Lingkaran.png', '2024-12-27 04:03:00'),
(19, 'Persegi Berhadapan', 'Persegi Berhadapan.png', '2024-12-27 04:08:57'),
(20, 'Sejajar 3', 'Sejajar 3.png', '2024-12-27 04:23:29'),
(22, 'Classroom Sitting', 'Classroom Sitting.png', '2025-01-20 08:00:50'),
(23, 'Business Meeting', 'Business Meeting.png', '2025-01-28 04:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `jumlah_layout` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `nama_ruangan`, `jumlah_layout`, `created_at`) VALUES
(8, 'cave', 2, '2024-12-12 06:27:06'),
(10, 'exo', 1, '2024-12-12 06:51:34'),
(11, 'pink', 7, '2024-12-12 08:51:10'),
(13, 'lab', 1, '2024-12-15 12:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `ruang_rapat_id` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `acara` enum('internal','eksternal') NOT NULL,
  `keterangan_acara` text DEFAULT NULL,
  `konsumsi` text DEFAULT NULL,
  `layout_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan`
--

CREATE TABLE `perlengkapan` (
  `id` int(11) NOT NULL,
  `ruang_rapat_id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perlengkapan`
--

INSERT INTO `perlengkapan` (`id`, `ruang_rapat_id`, `nama_barang`, `jumlah`) VALUES
(7, 28, 'Whiteboard', 2),
(8, 31, 'Whiteboard', 1),
(9, 31, 'Mic', 3),
(10, 31, 'Proyektor', 2),
(11, 31, 'Tv', 2),
(12, 30, 'Whiteboard', 2),
(13, 29, 'Mic', 2),
(14, 29, 'Tv', 1),
(15, 29, 'Whiteboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruang_rapat`
--

CREATE TABLE `ruang_rapat` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang_rapat`
--

INSERT INTO `ruang_rapat` (`id`, `nama_ruangan`, `kapasitas`) VALUES
(28, 'Cave', 25),
(29, 'Creovation', 20),
(30, 'Lab', 10),
(31, 'Afee', 60),
(32, 'White Room', 30);

-- --------------------------------------------------------

--
-- Table structure for table `ruang_rapat_layout`
--

CREATE TABLE `ruang_rapat_layout` (
  `id` int(11) NOT NULL,
  `ruang_rapat_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang_rapat_layout`
--

INSERT INTO `ruang_rapat_layout` (`id`, `ruang_rapat_id`, `layout_id`) VALUES
(14, 28, 14),
(15, 28, 20),
(16, 28, 19),
(17, 28, 22),
(18, 29, 19),
(19, 29, 14),
(20, 30, 18),
(21, 30, 13),
(22, 31, 22),
(23, 31, 14),
(24, 31, 20),
(25, 32, 19),
(26, 32, 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `password`, `company`) VALUES
(1, '123456', '482c811da5d5b4bc6d497ffa98491e38', 'Company 1'),
(2, '654321', '96b33694c4bb7dbd07391e0be54745fb', 'Company 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `input_layout`
--
ALTER TABLE `input_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_rapat_id` (`ruang_rapat_id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_rapat_id` (`ruang_rapat_id`);

--
-- Indexes for table `ruang_rapat`
--
ALTER TABLE `ruang_rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang_rapat_layout`
--
ALTER TABLE `ruang_rapat_layout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_rapat_id` (`ruang_rapat_id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `input_layout`
--
ALTER TABLE `input_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ruang_rapat`
--
ALTER TABLE `ruang_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ruang_rapat_layout`
--
ALTER TABLE `ruang_rapat_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`ruang_rapat_id`) REFERENCES `ruang_rapat` (`id`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`layout_id`) REFERENCES `input_layout` (`id`);

--
-- Constraints for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD CONSTRAINT `perlengkapan_ibfk_1` FOREIGN KEY (`ruang_rapat_id`) REFERENCES `ruang_rapat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ruang_rapat_layout`
--
ALTER TABLE `ruang_rapat_layout`
  ADD CONSTRAINT `ruang_rapat_layout_ibfk_1` FOREIGN KEY (`ruang_rapat_id`) REFERENCES `ruang_rapat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruang_rapat_layout_ibfk_2` FOREIGN KEY (`layout_id`) REFERENCES `input_layout` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
