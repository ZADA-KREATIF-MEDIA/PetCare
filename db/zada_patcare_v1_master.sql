-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2020 pada 17.34
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_anteranter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT '3',
  `status` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpn` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referal_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_bergabung` datetime DEFAULT NULL,
  `level` enum('customer','member','B2B') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `status` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `diskon` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ganti_driver`
--

CREATE TABLE `ganti_driver` (
  `id_orderan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `koordinat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak_tempuh_driver_lama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak_tempuh_driver_baru` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_driver_lama` bigint(20) NOT NULL,
  `id_driver_baru` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id_iklan` int(11) NOT NULL,
  `gambar_iklan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_customer`
--

CREATE TABLE `order_customer` (
  `id_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `id_rider` bigint(20) DEFAULT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpn_penerima` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpn_pengirim` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `koordinat_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `koordinat_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_asal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `patokan_asal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `patokan_tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak` float NOT NULL,
  `status_order` enum('order','proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `status_pembayaran` enum('lunas','belum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `referal_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi_driver` enum('sudah','belum') COLLATE utf8mb4_unicode_ci DEFAULT 'belum',
  `ongkir` bigint(20) NOT NULL,
  `subtotal` bigint(20) DEFAULT NULL,
  `diskon` decimal(20,2) DEFAULT NULL,
  `harga_cod` bigint(20) DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `verifikasi_customer` enum('sudah','belum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `paid_by` enum('pengirim','penerima') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail_customer`
--

CREATE TABLE `order_detail_customer` (
  `id_barang` bigint(20) NOT NULL,
  `id_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `volume_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_barang` decimal(20,2) NOT NULL,
  `status_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `charge` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail_customer_tmp`
--

CREATE TABLE `order_detail_customer_tmp` (
  `id_barang` int(11) NOT NULL,
  `id_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `volume_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_barang` decimal(20,2) NOT NULL,
  `status_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_driver`
--

CREATE TABLE `order_driver` (
  `id_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_pengambilan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_pengantaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_barang` decimal(20,2) NOT NULL,
  `status_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_diterima` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rider`
--

CREATE TABLE `rider` (
  `id_rider` int(11) NOT NULL,
  `nama_rider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpn` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat_nomor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_bergabung` datetime NOT NULL,
  `status` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `status_driver` enum('freelancer','reguler') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reguler'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif_barang`
--

CREATE TABLE `tarif_barang` (
  `id` int(11) NOT NULL,
  `harga_overweight` bigint(20) NOT NULL,
  `harga_oversize` bigint(20) NOT NULL,
  `harga_normal` bigint(20) NOT NULL,
  `kategori` enum('customer','member','B2B') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif_ongkir`
--

CREATE TABLE `tarif_ongkir` (
  `id` bigint(20) NOT NULL,
  `jarak_minimal` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_jarak_minimal` enum('aktif','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jarak_minimal` bigint(20) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `kategori_harga` enum('customer','member','B2B') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id_iklan`);

--
-- Indeks untuk tabel `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `order_detail_customer_tmp`
--
ALTER TABLE `order_detail_customer_tmp`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`id_rider`);

--
-- Indeks untuk tabel `tarif_barang`
--
ALTER TABLE `tarif_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tarif_ongkir`
--
ALTER TABLE `tarif_ongkir`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id_iklan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_detail_customer_tmp`
--
ALTER TABLE `order_detail_customer_tmp`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rider`
--
ALTER TABLE `rider`
  MODIFY `id_rider` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tarif_barang`
--
ALTER TABLE `tarif_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tarif_ongkir`
--
ALTER TABLE `tarif_ongkir`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
