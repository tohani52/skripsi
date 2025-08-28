-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Agu 2025 pada 18.57
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pudcatk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_user`
--

CREATE TABLE `level_user` (
  `id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `level_user`
--

INSERT INTO `level_user` (`id`, `level_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admnistrator', '2025-05-05 16:01:04', '2025-07-05 10:13:46', NULL),
(2, 'Purchasing', '2025-06-02 04:26:26', '2025-06-02 04:26:26', NULL),
(3, 'Manager', '2025-06-02 04:28:17', '2025-06-02 04:28:17', NULL),
(4, 'admin', '2025-08-12 10:25:18', '2025-08-12 10:25:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_product_out`
--

CREATE TABLE `list_product_out` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `stock_before` int(6) NOT NULL,
  `request_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `list_product_out`
--

INSERT INTO `list_product_out` (`id`, `id_product`, `qty`, `stock_before`, `request_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 100, 1550, 'hIZXyN91iF', '2025-06-02 07:08:13', '2025-06-02 07:20:41', NULL),
(2, 1, 1, 1550, 'hIZXyN91iF', '2025-06-02 07:20:48', '2025-06-02 07:20:48', NULL),
(3, 1, 3, 1449, 'Whz3d5n2lN', '2025-06-03 09:58:02', '2025-06-03 09:58:02', NULL),
(4, 2, 12, 12, 'yVrPQ7Q8Dy', '2025-06-14 08:57:36', '2025-06-14 08:57:36', NULL),
(5, 3, 20, 0, 'wNEIc6Yhwp', '2025-07-17 03:17:53', '2025-07-17 03:17:53', NULL),
(6, 1, 1, 409, 'prP2rxRbzf', '2025-07-25 07:32:42', '2025-07-25 07:32:42', NULL),
(7, 4, 30, 80, '5q5jLFdXPR', '2025-07-30 00:07:21', '2025-07-30 00:07:21', NULL),
(8, 4, 10, 80, '1baZIm3zEl', '2025-08-03 13:05:52', '2025-08-03 13:05:52', NULL),
(9, 5, 10, 50, 'N2FfNDM38P', '2025-08-12 11:23:42', '2025-08-12 11:23:42', NULL),
(10, 6, 50, 140, 'N2FfNDM38P', '2025-08-12 11:24:57', '2025-08-12 11:24:57', NULL),
(11, 1, 50, 1499, 'GlkaU78Q7q', '2025-08-13 09:32:28', '2025-08-13 09:32:58', NULL),
(12, 2, 10, 200, 'GlkaU78Q7q', '2025-08-13 09:32:48', '2025-08-13 09:32:48', NULL),
(13, 8, 20, 60, 'jilmQbzOcN', '2025-08-13 10:08:03', '2025-08-13 10:11:54', NULL),
(14, 7, 5, 20, 'z82eNOP2ag', '2025-08-13 10:09:51', '2025-08-13 10:09:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_approval`
--

CREATE TABLE `master_approval` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_approval`
--

INSERT INTO `master_approval` (`id`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '2025-06-02 05:30:27', '2025-06-02 05:30:27', NULL),
(2, 3, '2025-06-02 05:30:49', '2025-06-02 05:30:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(12) NOT NULL,
  `stock_product` int(6) NOT NULL,
  `unit_product` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `stock_product`, `unit_product`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kertas A3', 55000, 1509, 'Rim', '2025-06-02 05:06:31', '2025-08-26 10:54:34', NULL),
(2, 'Pulpen Joyko', 3500, 200, 'Pcs', '2025-06-14 08:53:09', '2025-07-26 10:41:41', NULL),
(3, 'Spidol Besar', 5500, 0, 'Pcs', '2025-07-17 03:15:36', '2025-07-25 19:56:51', NULL),
(4, 'Pensil', 3500, 80, 'Pcs', '2025-07-30 00:04:24', '2025-08-12 11:15:20', NULL),
(5, 'Karter Kecil', 8500, 40, 'Pcs', '2025-08-12 11:03:07', '2025-08-12 12:13:43', NULL),
(6, 'Isi Karter Kecil', 15000, 90, 'Pak', '2025-08-12 11:05:38', '2025-08-12 12:13:43', NULL),
(7, 'Tip-X', 6000, 20, 'Pcs', '2025-08-12 11:06:51', '2025-08-13 10:02:09', NULL),
(8, 'Magic Tape', 6500, 40, 'Pcs', '2025-08-12 11:08:15', '2025-08-13 10:15:36', NULL),
(9, 'Papan Jalan Kayu', 15000, 0, 'Pcs', '2025-08-12 11:09:40', '2025-08-12 11:09:40', NULL),
(10, 'Gunting Besar', 13000, 0, 'Pcs', '2025-08-12 11:10:17', '2025-08-12 11:10:17', NULL),
(11, 'Lakban Coklat', 4500, 0, 'Pcs', '2025-08-12 11:12:08', '2025-08-12 11:12:08', NULL),
(12, 'Penggaris 30cm', 3000, 30, 'Pcs', '2025-08-12 11:13:30', '2025-08-13 10:07:09', NULL),
(13, 'Lakban Hitam', 5000, 0, 'Pcs', '2025-08-26 10:44:40', '2025-08-26 10:44:40', NULL),
(14, 'Hetter Besar', 9000, 0, 'Pcs', '2025-08-26 10:45:14', '2025-08-26 10:45:14', NULL),
(15, 'Hetter Kecil', 6000, 0, 'Pcs', '2025-08-26 10:45:34', '2025-08-26 10:45:34', NULL),
(16, 'Double Tape', 3000, 0, 'Pcs', '2025-08-26 10:46:53', '2025-08-26 10:46:53', NULL),
(17, 'Isolasi Besar', 7000, 0, 'Pcs', '2025-08-26 10:47:21', '2025-08-26 10:47:21', NULL),
(18, 'Isolasi Kecil', 4000, 0, 'Pcs', '2025-08-26 10:47:53', '2025-08-26 10:47:53', NULL),
(19, 'Lakban Kertas', 5000, 0, 'Pcs', '2025-08-26 10:48:36', '2025-08-26 10:48:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_in`
--

CREATE TABLE `product_in` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(12) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_in`
--

INSERT INTO `product_in` (`id`, `id_product`, `qty`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1500, 'Pembelian Baru', 50000, '2025-06-02 05:52:00', '2025-07-26 10:39:18', NULL),
(2, 1, 100, 'Tambahan', 55000, '2025-06-02 05:57:49', '2025-07-26 10:40:05', NULL),
(3, 1, 200, 'tambahan lagi', 55000, '2025-06-02 05:59:13', '2025-06-02 06:02:34', '2025-06-02 06:02:34'),
(4, 2, 200, 'Pembelian Baru', 3500, '2025-06-14 08:56:10', '2025-07-26 10:41:41', NULL),
(5, 4, 90, 'Pembelian Baru', 3500, '2025-07-30 00:06:41', '2025-08-12 11:15:20', NULL),
(6, 5, 50, 'Pembelian Baru', 8500, '2025-08-12 11:19:00', '2025-08-12 11:19:00', NULL),
(7, 6, 100, 'Pembelian Baru', 17000, '2025-08-12 11:21:12', '2025-08-12 11:21:51', NULL),
(8, 6, 40, 'Tambahan', 15000, '2025-08-12 11:22:45', '2025-08-12 11:22:45', NULL),
(9, 7, 20, 'Pembelian Baru', 6000, '2025-08-13 10:02:09', '2025-08-13 10:02:09', NULL),
(10, 1, 60, 'Pembelian Baru', 6500, '2025-08-13 10:04:40', '2025-08-13 10:05:00', '2025-08-13 10:05:00'),
(11, 8, 60, 'Pembelian Baru', 6500, '2025-08-13 10:06:26', '2025-08-13 10:06:26', NULL),
(12, 12, 30, 'Pembelian Baru', 3000, '2025-08-13 10:07:09', '2025-08-13 10:07:09', NULL),
(13, 1, 10, 'Pembelian Bulan Agustus', 55000, '2025-08-26 10:54:34', '2025-08-26 10:54:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_out`
--

CREATE TABLE `product_out` (
  `id` int(11) NOT NULL,
  `request_code` varchar(50) NOT NULL,
  `request_date` date NOT NULL,
  `id_request` int(11) NOT NULL,
  `approval` varchar(20) NOT NULL,
  `proccess` int(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  `approval_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_out`
--

INSERT INTO `product_out` (`id`, `request_code`, `request_date`, `id_request`, `approval`, `proccess`, `description`, `approval_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hIZXyN91iF', '2025-06-02', 1, '2,3', 3, 'Pengajuan Baru', NULL, '2025-06-02 07:24:17', '2025-06-02 07:54:49', NULL),
(2, 'Whz3d5n2lN', '2025-06-03', 1, '2,3', 999, 'Pengajuan ATK Pengganti', NULL, '2025-06-03 09:58:10', '2025-08-13 09:36:27', NULL),
(3, 'Whz3d5n2lN', '2025-06-03', 1, '', 0, 'Pengajuan ATK Baru', NULL, '2025-06-03 10:10:04', '2025-06-03 10:12:19', '2025-06-03 10:12:19'),
(4, 'yVrPQ7Q8Dy', '2025-06-14', 1, '2,3', 999, 'Pembelian Baru', NULL, '2025-06-14 08:57:52', '2025-07-17 09:45:33', NULL),
(5, 'wNEIc6Yhwp', '2025-07-17', 1, '2,3', 999, 'Pengajuan Baru ', NULL, '2025-07-17 03:18:34', '2025-08-13 09:34:13', NULL),
(6, '5q5jLFdXPR', '2025-07-30', 1, '2,3', 999, 'Pengajuan Baru', NULL, '2025-07-30 00:07:33', '2025-08-12 12:09:57', NULL),
(7, '1baZIm3zEl', '2025-08-03', 1, '2,3', 3, 'test', NULL, '2025-08-03 13:06:04', '2025-08-03 13:28:50', NULL),
(8, 'N2FfNDM38P', '2025-08-12', 4, '2,3', 4, 'Pengajuan Baru', NULL, '2025-08-12 11:25:20', '2025-08-12 12:13:43', NULL),
(9, 'GlkaU78Q7q', '2025-08-13', 4, '2,3', 3, 'Pengajuan Bulan Agusus', NULL, '2025-08-13 09:32:13', '2025-08-13 09:33:58', NULL),
(10, 'jilmQbzOcN', '2025-08-13', 4, '2,3', 3, 'Pengajuan Tim Dokumen', NULL, '2025-08-13 10:09:01', '2025-08-13 10:15:36', NULL),
(11, 'z82eNOP2ag', '2025-08-13', 4, '', 0, 'Pengajuan Tim Sample', NULL, '2025-08-13 10:11:17', '2025-08-13 10:11:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_level` int(11) NOT NULL,
  `photo_profile` varchar(100) NOT NULL,
  `photo_ttd` varchar(255) NOT NULL,
  `is_login` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `display_name`, `user_name`, `password`, `id_level`, `photo_profile`, `photo_ttd`, `is_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'administrator', '875cd5b7c87336850dc6acf3e76273466cdfb2a6281ef0deb04b04169595052684a3f1e17f30f317747e8db62ba870dc715142f6ec9a6a7d13cdf9cbf4db399f', 1, 'profileAdministrator', 'signature_1755094729.png', 1, '2025-04-02 16:22:46', '2025-08-26 10:02:22', NULL),
(2, 'Vonny', 'purchasing', '875cd5b7c87336850dc6acf3e76273466cdfb2a6281ef0deb04b04169595052684a3f1e17f30f317747e8db62ba870dc715142f6ec9a6a7d13cdf9cbf4db399f', 2, 'profileVonny', 'signature_1755017860.png', 1, '2025-06-02 04:28:03', '2025-08-13 10:14:19', NULL),
(3, 'Budiono', 'manager', '875cd5b7c87336850dc6acf3e76273466cdfb2a6281ef0deb04b04169595052684a3f1e17f30f317747e8db62ba870dc715142f6ec9a6a7d13cdf9cbf4db399f', 3, 'profileBudiono', 'signature_1755018004.png', 1, '2025-06-02 05:30:01', '2025-08-26 11:29:03', NULL),
(4, 'Admin', 'admin', '875cd5b7c87336850dc6acf3e76273466cdfb2a6281ef0deb04b04169595052684a3f1e17f30f317747e8db62ba870dc715142f6ec9a6a7d13cdf9cbf4db399f', 4, 'profileAdmin', 'signature_1755094454.png', 1, '2025-08-12 10:25:39', '2025-08-26 10:43:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_product_out`
--
ALTER TABLE `list_product_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `master_approval`
--
ALTER TABLE `master_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_in`
--
ALTER TABLE `product_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `product_out`
--
ALTER TABLE `product_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_request` (`id_request`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `list_product_out`
--
ALTER TABLE `list_product_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `master_approval`
--
ALTER TABLE `master_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `product_in`
--
ALTER TABLE `product_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `product_out`
--
ALTER TABLE `product_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `list_product_out`
--
ALTER TABLE `list_product_out`
  ADD CONSTRAINT `list_product_out_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Ketidakleluasaan untuk tabel `master_approval`
--
ALTER TABLE `master_approval`
  ADD CONSTRAINT `master_approval_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_in`
--
ALTER TABLE `product_in`
  ADD CONSTRAINT `product_in_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_out`
--
ALTER TABLE `product_out`
  ADD CONSTRAINT `product_out_ibfk_2` FOREIGN KEY (`id_request`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
