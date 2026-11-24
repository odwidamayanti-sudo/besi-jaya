-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2026 pada 14.01
-- Versi server: 10.11.16-MariaDB
-- Versi PHP: 8.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `besitua_3602`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `berat` decimal(10,2) NOT NULL,
  `harga_per_kg` decimal(12,2) NOT NULL,
  `kondisi` enum('Layak','Tidak Layak') NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `deskripsi`, `berat`, `harga_per_kg`, `kondisi`, `tanggal_masuk`, `foto`) VALUES
(1, 1, 'Besi Beton Bekas', 'Besi beton hasil pembelian pelanggan', 150.00, 6500.00, 'Layak', '2026-11-24', '1795523694_Tumpukan Besi Beton Bekas Berkarat.png'),
(2, 1, 'Besi Campuran', 'Besi tua berbagai ukuran', 200.00, 5000.00, 'Layak', '2026-11-24', '1795523747_Tumpukan Besi Campuran Berkarat.png'),
(3, 2, 'Aluminium Bekas', 'Aluminium bekas rumah tangga', 50.00, 18000.00, 'Layak', '2026-11-24', '1795523802_Tumpukan Rongsokan Aluminium Industri.png'),
(4, 3, 'Tembaga Bekas', 'Kabel tembaga bekas', 20.00, 85000.00, 'Layak', '2026-11-24', '1795523821_Tumpukan Rongsokan Tembaga Berkilau.png'),
(5, 4, 'Stainless Bekas', 'Potongan stainless steel bekas', 35.00, 15000.00, 'Layak', '2026-11-24', '1795523903_Tumpukan Besi Stainless di Bengkel.png'),
(7, 1, 'Besi Hollow Bekas Premium', 'Besi hollow bekas bangunan', 25.00, 6000.00, 'Layak', '2026-11-24', '1795522814_Tumpukan Baja Hollow Berkarat.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Besi Tua'),
(2, 'Aluminium'),
(3, 'Tembaga'),
(4, 'Stainless'),
(5, 'Kuningan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis_transaksi` enum('Pembelian','Penjualan') NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `jenis_transaksi`, `nama_pelanggan`, `berat`, `total_harga`, `tanggal_transaksi`) VALUES
(1, 1, 'Pembelian', 'Budi Santoso', 50.00, 325000.00, '2026-11-24'),
(2, 2, 'Pembelian', 'Andi Saputra', 75.00, 375000.00, '2026-11-24'),
(3, 3, 'Penjualan', 'CV Maju Jaya', 20.00, 360000.00, '2026-11-24'),
(4, 4, 'Penjualan', 'Toko Logam Jaya', 10.00, 850000.00, '2026-11-24'),
(5, 5, 'Pembelian', 'Rudi Hartono', 15.00, 225000.00, '2026-11-24');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
