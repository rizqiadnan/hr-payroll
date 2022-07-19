-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 1, 2022 at 04:16 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE IF NOT EXISTS `gaji` (
  `id_gaji` int(5) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(15) NOT NULL,
  `tahun` int(4) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `id_karyawan` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `uang_transport` int(11) NOT NULL,
  `hari_kerja` int(2) NOT NULL,
  `kehadiran` int(5) NOT NULL,
  `bonus` int(10) NOT NULL,
  `jumlah_lembur` int(2) NOT NULL,
  `telat1` int(12) NOT NULL,
  `telat2` int(11) NOT NULL,
  `telat3` int(11) NOT NULL,
  `total_gaji` int(10) NOT NULL,
  PRIMARY KEY (`id_gaji`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `bulan`, `tahun`, `tanggal_transfer`, `id_karyawan`, `id_jabatan`, `gaji_pokok`, `uang_transport`, `hari_kerja`, `kehadiran`, `bonus`, `jumlah_lembur`, `telat1`, `telat2`, `telat3`, `total_gaji`) VALUES
(11, 'November', 2018, '2018-11-05', 2222, 2, 3000000, 200000, 20, 20, 100000, 3, 0, 0, 0, 4960000),
(15, 'Juli', 2022, '2022-07-17', 2147483647, 1, 5000000, 200000, 14, 14, 100000, 5, 0, 0, 0, 6520000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `uang_transport` int(10) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `uang_transport`) VALUES
(1, 'Manager', 5000000, 200000),
(2, 'HRD', 3000000, 200000),
(3, 'Admin', 2000000, 200000),
(4, 'Teknisi', 2500000, 200000),
(5, 'Staff Admin', 1800000, 200000),
(6, 'Marketing', 1500000, 250000),
(7, 'IT', 6500000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `uang_transport` int(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `status` varchar(15) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `foto`, `nama_karyawan`, `id_jabatan`, `gaji_pokok`, `uang_transport`, `alamat`, `no_telepon`, `status`, `awal`, `akhir`) VALUES
(2147483647, 'mrap.jpg', 'Rizqi Adnan P', 1, 5000000, 200000, 'JL. SMPN 211 No. 76B', '02178889337', 'Karyawan Tetap', '2022-06-01', '2023-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
