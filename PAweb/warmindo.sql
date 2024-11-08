-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2024 pada 04.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warmindo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`id`, `nama`, `harga`, `gambar`) VALUES
(8, 'mie kuah', 10000, 'mie kuah.jpg'),
(9, 'mie kuah', 10000, 'mie kuah.jpg'),
(10, 'mie kuah', 10000, 'mie kuah.jpg'),
(11, 'mie kuah', 10000, 'mie kuah.jpg'),
(12, 'Mie rendang', 15000, 'mie rendang.jpeg'),
(13, 'Mie rendang', 15000, 'mie rendang.jpeg'),
(14, 'Mie geprek', 15000, 'mie geprek.jpeg'),
(15, 'Mie geprek', 15000, 'mie geprek.jpeg'),
(16, 'mie aceh', 15000, 'mie aceh.jpeg'),
(17, 'mie aceh', 15000, 'mie aceh.jpeg'),
(18, 'mie goreng', 15000, 'mie goreng.jpeg'),
(19, 'mie goreng', 15000, 'mie goreng.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `minuman`
--

CREATE TABLE `minuman` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `minuman`
--

INSERT INTO `minuman` (`id`, `nama`, `harga`, `gambar`) VALUES
(1, 'es teh', 3000, 'minuman.jpg'),
(2, 'kopi hitam', 3000, 'kopi.jpg'),
(4, 'kopi hitam', 3000, 'kopi.jpg'),
(5, 'kopi hitam', 3000, 'kopi.jpg'),
(8, 'cappucino', 10000, 'cappucino.jpeg'),
(9, 'cappucino', 10000, 'cappucino.jpeg'),
(10, 'lemon tea', 8000, 'lemon tea.jpeg'),
(11, 'lemon tea', 8000, 'lemon tea.jpeg'),
(12, 'teh panas', 2000, 'teh panas.jpeg'),
(13, 'teh panas', 2000, 'teh panas.jpeg'),
(14, 'teh tarik', 8000, 'teh tarik.jpeg'),
(15, 'teh tarik', 8000, 'teh tarik.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'bale', '$2y$10$pds3BMoQbkN2M81gh3hJjuosTvjIiS72IpaU//2F11VhR1EXAPdMK', 'User'),
(2, 'admin', '$2y$10$n6uQcxCKqvFeYLu54uLPi.CcTkbnJaoZbiC5ACPfVQqPIam7y0PHK', 'Admin'),
(3, 'asep', '$2y$10$6KkmygseVNQhrfuHbpX1cuALxGyiSSfS.8qmSfh/pam2elpkEbB26', 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `minuman`
--
ALTER TABLE `minuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
