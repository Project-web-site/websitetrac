-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Sep 2022 pada 06.41
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` varchar(10) NOT NULL DEFAULT '',
  `USERNAME` varchar(128) DEFAULT NULL,
  `PASSWORD` mediumtext,
  `ROLE` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_sales`
--

CREATE TABLE IF NOT EXISTS `id_sales` (
  `id_Reservasi` int(11) NOT NULL,
  `PIC_SALES` varchar(11) NOT NULL,
  `Profit_center` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_mobil`
--

CREATE TABLE IF NOT EXISTS `jenis_mobil` (
  `Spesifikasi` varchar(64) NOT NULL,
  `Source_Data` varchar(64) NOT NULL,
  `Type_unit` varchar(64) NOT NULL,
  `Kategori` varchar(64) NOT NULL,
  `Invoice` varchar(64) NOT NULL,
  `Maksud_sewa` varchar(64) NOT NULL,
  `Rute_Tujuan` varchar(64) NOT NULL,
  `Provinsi` varchar(64) NOT NULL,
  `ID_Reservasi` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
