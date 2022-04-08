-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 08:48 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_khs`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kode_prodi` varchar(50) NOT NULL,
  `kode_mk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `nip`, `alamat`, `email`, `no_telp`, `username`, `password`, `status`, `kode_prodi`, `kode_mk`) VALUES
(4, 'Dr. Jafar', '1333281019', 'Cirebon', 'veridetta@gmail.com', '09209840982041', '1333281019', '1333281019', 'dosen', 'RPL', 'RPL3'),
(6, 'Nama Satu', '1333281019', 'Cirebon', 'veridetta@gmail.com', '09209840982041', '1333281019', '1333281019', 'dosen', 'RPL', 'RPL1'),
(7, 'Nama Dua', '1333281019', 'Cirebon', 'it.bagjacollege@gmail.com', '09209840982041', '1333281019', '1333281019', 'dosen', 'MM', 'RPL1');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `kelas`, `jurusan`) VALUES
(1, '123456789', 'Nama 1', 'XI RPL 1', 'RPL'),
(2, '123456788', 'Nama 2', 'XI RPL 2', 'RPL'),
(3, '123456786', 'Nama 3', 'XI RPL 3', 'RPL'),
(4, '123456785', 'Nama 4', 'XI RPL 4', 'RPL'),
(5, '123456784', 'Nama 5', 'XI RPL 5', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(255) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `kode_prodi`, `kode_mk`, `nama`, `semester`, `sks`) VALUES
(1, 'RPL', 'RPL1', 'Rekayasa Perangkat Lunak 1', '1', 3),
(2, 'RPL', 'RPL2', 'Rekayasa Perangkat Lunak 2', '1', 3),
(3, 'RPL', 'RPL3', 'Rekayasa Perangkat Lunak 3', '1', 3),
(4, 'RPL', 'RPL4', 'Rekayasa Perangkat Lunak 4', '1', 3),
(5, 'RPL', 'RPL5', 'Rekayasa Perangkat Lunak 5', '1', 3),
(6, 'TKJ', 'TKJ1', 'Teknik Komputer Jaringan 1', '1', 3),
(7, 'TKJ', 'TKJ2', 'Teknik Komputer Jaringan 2', '1', 3),
(8, 'TKJ', 'TKJ3', 'Teknik Komputer Jaringan 3', '1', 3),
(9, 'TKJ', 'TKJ4', 'Teknik Komputer Jaringan 4', '1', 3),
(10, 'TKJ', 'TKJ5', 'Teknik Komputer Jaringan 5', '1', 3),
(11, 'MM', 'MM1', 'Multimedia 1', '1', 3),
(12, 'MM', 'MM2', 'Multimedia 2', '1', 3),
(13, 'MM', 'MM3', 'Multimedia 3', '1', 3),
(14, 'MM', 'MM4', 'Multimedia 4', '1', 3),
(15, 'MM', 'MM5', 'Multimedia 5', '1', 3),
(16, 'TPM', 'TPM1', 'Teknik Pemesinan 1', '1', 3),
(17, 'TPM', 'TPM2', 'Teknik Pemesinan 2', '1', 3),
(18, 'TPM', 'TPM3', 'Teknik Pemesinan 3', '1', 3),
(19, 'TPM', 'TPM4', 'Teknik Pemesinan 4', '1', 3),
(20, 'TPM', 'TPM5', 'Teknik Pemesinan 5', '1', 3),
(21, 'TKR', 'TKR1', 'Teknik Kendaraan Ringan 1', '1', 3),
(22, 'TKR', 'TKR2', 'Teknik Kendaraan Ringan 2', '1', 3),
(23, 'TKR', 'TKR3', 'Teknik Kendaraan Ringan 3', '1', 3),
(24, 'TKR', 'TKR4', 'Teknik Kendaraan Ringan 4', '1', 3),
(25, 'TKR', 'TKR5', 'Teknik Kendaraan Ringan 5', '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(255) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai_huruf` varchar(255) NOT NULL,
  `nilai_angka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `kode_prodi`, `kode_mk`, `tahun_ajaran`, `semester`, `nim`, `nama`, `nilai_huruf`, `nilai_angka`) VALUES
(1, 'RPL', 'RPL1', '2018/2019', '1', '123456789', 'Nama 1', 'A', '3.8'),
(2, 'RPL', 'RPL2', '2018/2019', '1', '123456789', 'Nama 1', 'A', '3.8'),
(3, 'RPL', 'RPL2', '2018/2019', '1', '123456789', 'Nama 1', 'A', '3.8'),
(4, 'MM', 'MM5', '2018/2019', '1', '123456788', 'Nama 2', 'A', '3.8'),
(5, 'RPL', 'RPL3', '2018/2019', '1', '123456786', 'Nama 3', 'A', '3.8'),
(59, 'TKJ', 'TKJ3', '2019/2020', '1', '123456786', 'Nama 3', 'A', '4');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode_prodi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode_prodi`, `nama`) VALUES
(1, 'RPL', 'Rekayasa Perangkat Lunak'),
(2, 'TKJ', 'Teknik Komputer Jaringan'),
(3, 'MM', 'Multimedia'),
(4, 'TPM', 'Teknik Pemesinan'),
(6, 'TKR', 'Teknik Kendaraan Ringan ');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`) VALUES
(1, '1'),
(3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`) VALUES
(3, '2018/2019'),
(4, '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin'),
(2, 'user', 'user', 'User', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
