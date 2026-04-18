-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2026 pada 18.44
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
-- Database: `pustakakita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `ukuran_buku` varchar(50) NOT NULL,
  `halaman` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `isbn`, `judul`, `kategori`, `penulis`, `penerbit`, `tahun_terbit`, `ukuran_buku`, `halaman`, `stok`, `deskripsi`, `cover`, `create_at`, `update_at`) VALUES
(12, '978-623-8371-04-4', 'The Psychology Of Money', 'Sains', 'Morgan Housel', 'N Ratih Suhart', '2024', '14×20 cm', 150, 8, '', '1776445115_5efa0375e62b2e84d99f.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, ' 978-623-10-3692-6', 'Biografi Pahlawan Nasional: Dewi Sartika', 'Sejarah', 'Hanugrah R.M.', 'Silda Impika', '2024', '13×19', 64, 8, '', '1776483982_9b5ab68a9a24442fa586.jpeg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '978-623-02-1394-6', 'Pengantar Dasar Matematika', 'Matematika', 'Sri Suryanti, S.Pd., M.Si ', 'Dr. Irwani Zawawi, M.Kes.', '2020', '14×20 cm', 165, 14, '', '1776485414_29eb7781834e4ea9da3b.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '978–602–03–1258–3', 'Cantik Itu Luka', 'Sastra', 'Eka Kurniawan', 'Gramedia Pustaka Utama', '2015', '14×20 cm', 150, 8, '', '1776485509_d0432481a7d2abbcd094.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '978-602-475-022-0', 'Aljabar Linear Elementer', 'Matematika', 'Gandung Sugita', 'Anggraini', '2018', '15.5×23 cm', 285, 11, '', '1776485626_b1221efed3bf225ee4ef.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '978-623-7022-30-5', 'Geometri Elektrik', 'Matematika', 'Mahsup ', 'Abdillah books', '2018', '14×20 cm', 62, 8, '', '1776485695_64048b8435f8da8f2ce3.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '978-602-51195-0-7', 'History Of The World War, Sejarah Perang Dunia', 'Sejarah', 'Saut Pasaribu', 'Alexander Books', '2020', ' 14×21 cm', 146, 17, '', '1776486540_73b1b6482e99f3cbaff7.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, ' 978-623-10-3963-7', 'Biografi Pahlawan Nasional: H.O.S. Tjokroaminoto', 'Sains', 'Hanugrah R.M.', 'Silda Impika', '2024', '13×19', 64, 10, '', '1776529800_193979a5ef3116b80b65.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('dipinjam','dikembalikan','ditolak','pending') NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_buku`, `id_user`, `denda`, `status`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(39, 7, 4, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 7, 3, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 7, 4, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 7, 4, 0, 'dikembalikan', '2026-04-16 06:03:56', '2026-04-16 06:04:01'),
(43, 7, 4, 0, 'dikembalikan', '2026-04-16 05:59:15', '2026-04-16 06:03:59'),
(44, 7, 4, 0, 'dipinjam', '2026-04-17 06:48:33', '0000-00-00 00:00:00'),
(45, 11, 4, 0, 'dipinjam', '2026-04-17 07:24:14', '0000-00-00 00:00:00'),
(46, 8, 4, 0, 'dipinjam', '2026-04-17 15:36:24', '0000-00-00 00:00:00'),
(47, 10, 4, 0, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 9, 4, 0, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 12, 4, 0, 'dikembalikan', '2026-04-18 05:38:38', '2026-04-18 05:38:41'),
(50, 13, 4, 5, 'dikembalikan', '2026-04-18 16:30:24', '2026-04-18 16:36:40'),
(51, 12, 4, 5, 'dikembalikan', '2026-04-18 16:08:31', '2026-04-18 16:36:54'),
(52, 15, 4, 5000, 'dikembalikan', '2026-04-18 16:39:16', '2026-04-18 16:39:26'),
(53, 17, 4, 0, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `role`, `status`, `password`, `foto`, `create_at`) VALUES
(3, 'Rezza Asrafal Huda', '', 'zaasfaldaa_', 'admin', 'aktif', '$2y$10$Il06BNABST4/up03AvbMLut5qfSEkGWes/Z9T.sem/lYDKo8CwHGu', '1762910583_d5dcb61730bf118bfa90.png', '2026-04-11 16:35:57'),
(4, 'kojoyyy', '', 'ezott', 'user', 'aktif', '$2y$10$GyMpQ0BsAHRlsecHpdoJLO1hMOzjbYCpx8utNRlo/ncy5LTDB0vuq', '1762910614_53bc634a68d8353955bf.jpg', '2026-04-11 16:35:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
