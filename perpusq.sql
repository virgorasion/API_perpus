-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 10:26 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u187093969_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `tenggat_booking` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_user`, `id_buku`, `tanggal_booking`, `tenggat_booking`) VALUES
(6, 1, 1, '2019-11-14', '2019-11-15'),
(7, 1, 1, '2019-11-14', '2019-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(20) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `jumlah` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `penerbit`, `pengarang`, `tahun`, `id_kategori`, `jumlah`) VALUES
(1, 'Sistem Recognition', 'PT. Virgorasion', 'M Nur Fauzan W', 2018, 1, 2),
(2, 'Sistem E-Tilang', 'PT. Virgorasion', 'Nur Hidayatul Mustafit', 2018, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(72) NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `alamat`, `username`, `password`, `token`) VALUES
(1, 'SMKN 2 Surabaya', 'Jl. Tentara Genie Pelajar', 'admin', '$2y$10$w8oeWl/WLyds5nJ6tIi5ped0YK2vpczQjPKa5ldb0XI6u/45ixQXO', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(2) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `nis_siswa` varchar(10) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_status` binary(1) NOT NULL DEFAULT '\0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_pinjaman`
--

CREATE TABLE `status_pinjaman` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_pinjaman`
--

INSERT INTO `status_pinjaman` (`id`, `status`) VALUES
(1, 'Tersedia'),
(2, 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `password` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `nis`, `nisn`, `kelas`, `alamat`, `token`, `created_at`, `updated_at`, `password`) VALUES
(1, 'Moch Nur Fauzan Widyanto', '13236', '0008096617', '12RPL-1', 'Kapas Madya 3i Nomor 4', 'c4ca4238a0b923820dcc509a6f75849b', '2019-11-14 08:42:53', '2019-11-14 08:42:53', '$2y$10$w8oeWl/WLyds5nJ6tIi5ped0YK2vpczQjPKa5ldb0XI6u/45ixQXO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis_siswa` (`nis_siswa`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `status_pinjaman`
--
ALTER TABLE `status_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `nis_2` (`nis`),
  ADD KEY `nisn_2` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status_pinjaman`
--
ALTER TABLE `status_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
