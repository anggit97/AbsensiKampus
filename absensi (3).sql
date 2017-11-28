-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2016 at 01:42 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_dosen`
--

CREATE TABLE `absen_dosen` (
  `id_absendsn` int(11) NOT NULL,
  `tgl_absen` date NOT NULL DEFAULT '0000-00-00',
  `id_matkul` char(5) NOT NULL DEFAULT '',
  `jam_datang` time NOT NULL DEFAULT '00:00:00',
  `jam_plg` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(20) NOT NULL DEFAULT '',
  `pertemuan` varchar(20) NOT NULL DEFAULT '',
  `judul` varchar(50) NOT NULL,
  `topik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen_dosen`
--

INSERT INTO `absen_dosen` (`id_absendsn`, `tgl_absen`, `id_matkul`, `jam_datang`, `jam_plg`, `status`, `pertemuan`, `judul`, `topik`) VALUES
(1, '2016-07-21', 'KP001', '13:25:00', '16:15:00', 'Hadir', '1', 'OOP', 'Pengenalan OOP');

-- --------------------------------------------------------

--
-- Table structure for table `absen_kelas`
--

CREATE TABLE `absen_kelas` (
  `id_absen` int(11) NOT NULL,
  `nim` char(10) NOT NULL DEFAULT '',
  `tgl_absen` date NOT NULL DEFAULT '0000-00-00',
  `id_matkul` char(5) NOT NULL DEFAULT '',
  `jam_mulai` time NOT NULL DEFAULT '00:00:00',
  `pertemuan` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen_kelas`
--

INSERT INTO `absen_kelas` (`id_absen`, `nim`, `tgl_absen`, `id_matkul`, `jam_mulai`, `pertemuan`, `status`) VALUES
(1, '1411502482', '2016-07-21', 'KP001', '13:25:00', '1', 'Hadir'),
(2, '1411502483', '2016-07-21', 'KP001', '13:25:00', '1', 'Hadir'),
(3, '1411502490', '2016-07-21', 'KP001', '13:25:00', '1', 'Hadir'),
(4, '1411502492', '2016-07-21', 'KP001', '13:25:00', '1', 'Hadir'),
(5, '1411502493', '2016-07-21', 'KP001', '13:25:00', '1', 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `nama_admin` varchar(30) NOT NULL DEFAULT '',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_admin`, `foto`) VALUES
('admin1', '$2y$10$DvssY57q.doSu8vHls9gjOIz6B3lptophyaoQUt.c8XrgnmdaaFrm', 'Rusli', '1119f6eg1jh7aejydlovnzoqzo24qijf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detil_matkul`
--

CREATE TABLE `detil_matkul` (
  `id_detil` int(11) NOT NULL,
  `id_matkul` char(5) NOT NULL,
  `nim` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_matkul`
--

INSERT INTO `detil_matkul` (`id_detil`, `id_matkul`, `nim`) VALUES
(1, 'KP001', '1411502482'),
(2, 'KP001', '1411502483'),
(3, 'KP001', '1411502490'),
(4, 'KP001', '1411502492'),
(5, 'KP001', '1411502493');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nid` char(10) NOT NULL DEFAULT '',
  `nm_dosen` varchar(50) NOT NULL DEFAULT '',
  `jk` varchar(6) NOT NULL,
  `alamat` text NOT NULL,
  `telp_dosen` varchar(12) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nid`, `nm_dosen`, `jk`, `alamat`, `telp_dosen`, `password`, `email`, `foto`) VALUES
('1411100100', 'Ali Akbar', 'Pria', 'Ciledug Raya, Jakarta Selatan', '087182123131', '$2y$10$kV/AQxr0h8quv5V4lwltFeuZUeEmuTYf4NNQDIJ7e2beo3/hEiA3S', 'aliakbar@gmail.com', '11wmbeycey9w9z57rtt1hu5nm0svji82.jpg'),
('1411100101', 'Muhammad Ali', 'Pria', 'Ciledug Raya', '082132224144', '$2y$10$cKQ3AuGJ/NBd.KPEgmGdGukhsn4mkIFxwVsDEBiFi7347XDNjF00.', 'ali@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(10) NOT NULL DEFAULT '',
  `nm_mhs` varchar(50) NOT NULL DEFAULT '',
  `jk` varchar(6) NOT NULL,
  `alamat_mhs` text NOT NULL,
  `telp_mhs` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nm_mhs`, `jk`, `alamat_mhs`, `telp_mhs`, `email`) VALUES
('1411502482', 'Ryfan Aditya', 'Pria', 'Tangerang', '0881212188', 'ryfan@gmail.com'),
('1411502483', 'Amran', 'Pria', 'ciledug', '082132224144', 'ama@gmail.com'),
('1411502490', 'Anita', 'Wanita', 'ciledug', '09871361831', 'anita@gmail.com'),
('1411502492', 'Agus Santoso', 'Pria', 'Ciledug', '082132224144', 'agus@gmail.com'),
('1411502493', 'Anggit Prayogo', 'Pria', 'Tangerang', '082132224144', 'anggitprayogo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` char(5) NOT NULL DEFAULT '',
  `nm_matkul` varchar(50) NOT NULL DEFAULT '',
  `hari` varchar(20) NOT NULL DEFAULT '',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` varchar(20) NOT NULL DEFAULT '',
  `nid` char(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nm_matkul`, `hari`, `jam_mulai`, `jam_selesai`, `ruangan`, `nid`) VALUES
('KP001', 'Pemrograman Berorientasi Objek', 'Kamis', '13:25:00', '16:15:00', '7.5.1', '1411100100'),
('KP002', 'Pemrograman Web', 'Selasa', '08:00:00', '10:40:00', 'Lab Kom 10', '1411100100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_dosen`
--
ALTER TABLE `absen_dosen`
  ADD PRIMARY KEY (`id_absendsn`),
  ADD KEY `nid` (`id_matkul`);

--
-- Indexes for table `absen_kelas`
--
ALTER TABLE `absen_kelas`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `nim` (`nim`,`id_matkul`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `detil_matkul`
--
ALTER TABLE `detil_matkul`
  ADD PRIMARY KEY (`id_detil`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD KEY `nid` (`nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_dosen`
--
ALTER TABLE `absen_dosen`
  MODIFY `id_absendsn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `absen_kelas`
--
ALTER TABLE `absen_kelas`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detil_matkul`
--
ALTER TABLE `detil_matkul`
  MODIFY `id_detil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
