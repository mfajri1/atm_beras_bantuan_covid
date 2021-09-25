-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2021 pada 08.23
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenrfid`
--
CREATE DATABASE IF NOT EXISTS `absenrfid` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `absenrfid`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `mode` int(11) NOT NULL,
  PRIMARY KEY (`mode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`mode`) VALUES
(1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_masyarakat`
--

DROP TABLE IF EXISTS `tb_masyarakat`;
CREATE TABLE IF NOT EXISTS `tb_masyarakat` (
  `masyarakat_id` int(11) NOT NULL AUTO_INCREMENT,
  `masyarakat_nik` varchar(225) NOT NULL,
  `masyarakat_name` varchar(225) NOT NULL,
  `jenis_kelamin` enum('L','W') NOT NULL,
  `alamat` text NOT NULL,
  `masyarakat_jumlah` int(11) NOT NULL,
  `masyarakat_status` enum('A','H') NOT NULL,
  PRIMARY KEY (`masyarakat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`masyarakat_id`, `masyarakat_nik`, `masyarakat_name`, `jenis_kelamin`, `alamat`, `masyarakat_jumlah`, `masyarakat_status`) VALUES
(2, '14721017024', 'Fedry Mahayasa', 'L', 'padang', 4, 'H');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfid`
--

DROP TABLE IF EXISTS `tmprfid`;
CREATE TABLE IF NOT EXISTS `tmprfid` (
  `nokartu` varchar(20) NOT NULL,
  PRIMARY KEY (`nokartu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transaksi`
--

DROP TABLE IF EXISTS `t_transaksi`;
CREATE TABLE IF NOT EXISTS `t_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `masyarkat_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_transaksi`
--

INSERT INTO `t_transaksi` (`id_transaksi`, `masyarkat_id`, `tanggal`) VALUES
(1, 1, '2021-08-14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
