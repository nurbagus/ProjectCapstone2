-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2026 pada 05.36
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
-- Database: `lab_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bhp_items`
--

CREATE TABLE `bhp_items` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `minimal_stok` int(11) DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bhp_items`
--

INSERT INTO `bhp_items` (`id`, `nama_barang`, `stok`, `satuan`, `harga`, `minimal_stok`, `created_at`) VALUES
(1, 'Alkohol', 50, 'Botol', 25000.00, 10, '2026-06-03 12:43:50'),
(2, 'bensin', 88, '4500', 450000.00, 10, '2026-06-03 15:07:29'),
(3, 'ayam', 2, '1000', 2000.00, 1, '2026-06-03 15:46:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bhp_stock_logs`
--

CREATE TABLE `bhp_stock_logs` (
  `id` int(11) NOT NULL,
  `bhp_id` int(11) NOT NULL,
  `jenis` enum('masuk','keluar','maintenance') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bhp_stock_logs`
--

INSERT INTO `bhp_stock_logs` (`id`, `bhp_id`, `jenis`, `jumlah`, `keterangan`, `created_at`) VALUES
(1, 1, 'masuk', 20, 'Pembelian bulan Januari', '2026-06-03 12:44:25'),
(2, 1, 'keluar', 5, 'Praktikum jaringan', '2026-06-03 12:44:38'),
(3, 1, 'maintenance', 2, 'Maintenance #1', '2026-06-03 12:51:30'),
(4, 1, 'maintenance', 3, 'Maintenance #2', '2026-06-03 12:52:08'),
(5, 1, 'keluar', 15, 'pake', '2026-06-03 15:06:40'),
(6, 1, 'masuk', 5, 'beli', '2026-06-03 15:07:37'),
(7, 2, 'maintenance', 5, 'Maintenance #3', '2026-06-03 15:16:39'),
(8, 3, 'keluar', 1, 'sembelih', '2026-06-03 15:47:07'),
(9, 3, 'masuk', 2, 'beli', '2026-06-03 15:48:33'),
(10, 3, 'maintenance', 1, 'Maintenance #4', '2026-06-03 15:54:00'),
(11, 2, 'keluar', 5, 'abis', '2026-06-04 04:45:38'),
(12, 2, 'maintenance', 2, 'Maintenance #5', '2026-06-04 04:46:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `kode_inventaris` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `tanggal_penerimaan` date DEFAULT NULL,
  `kondisi` enum('baik','rusak_ringan','rusak_berat') DEFAULT 'baik',
  `foto` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `status` enum('aktif','rusak','hilang','dihapus') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventories`
--

INSERT INTO `inventories` (`id`, `kode_inventaris`, `nama_barang`, `jumlah`, `harga`, `room_id`, `tanggal_pembelian`, `tanggal_penerimaan`, `kondisi`, `foto`, `barcode`, `status`, `created_at`) VALUES
(1, 'INV-2026-0001', 'Laptop Asus', 5, 12000000.00, 1, '2026-01-10', '2026-01-15', 'baik', NULL, 'uploads/qr/INV-2026-0001.png', 'aktif', '2026-06-03 12:29:29'),
(2, 'INV-2026-0002', 'cisco', 3, 12400000.00, 1, '2026-06-01', '2026-06-05', '', '1780501362989.png', 'uploads/qr/INV-2026-0002.png', 'aktif', '2026-06-03 14:51:51'),
(3, 'INV-2026-0003', 'tes', 2, NULL, 3, '0000-00-00', '2020-02-20', 'baik', NULL, 'uploads/qr/INV-2026-0003.png', 'aktif', '2026-06-04 03:32:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenance_logs`
--

CREATE TABLE `maintenance_logs` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kondisi_sebelum` varchar(100) DEFAULT NULL,
  `kondisi_sesudah` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maintenance_logs`
--

INSERT INTO `maintenance_logs` (`id`, `inventory_id`, `user_id`, `tanggal`, `kondisi_sebelum`, `kondisi_sesudah`, `catatan`, `created_at`) VALUES
(1, 1, 4, '2026-06-01', 'rusak_ringan', 'baik', 'Maintenance rutin', '2026-06-03 12:51:30'),
(2, 1, 4, '2026-06-01', 'rusak_ringan', 'baik', 'Maintenance rutin', '2026-06-03 12:52:08'),
(3, 2, 4, '2025-02-01', 'kotor', 'bersih', 'dibersihkan', '2026-06-03 15:16:39'),
(4, 2, 4, '2002-02-12', 'ayam', 'bakar', 'bakr', '2026-06-03 15:54:00'),
(5, 3, 4, '2000-11-11', 'baik', 'baik', NULL, '2026-06-04 04:46:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenance_materials`
--

CREATE TABLE `maintenance_materials` (
  `id` int(11) NOT NULL,
  `maintenance_id` int(11) NOT NULL,
  `bhp_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maintenance_materials`
--

INSERT INTO `maintenance_materials` (`id`, `maintenance_id`, `bhp_id`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 3),
(3, 3, 2, 5),
(4, 4, 3, 1),
(5, 5, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `procurement_drafts`
--

CREATE TABLE `procurement_drafts` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `status` enum('draft','review','approved','rejected','locked') DEFAULT 'draft',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `procurement_drafts`
--

INSERT INTO `procurement_drafts` (`id`, `judul`, `tahun`, `status`, `created_by`, `created_at`) VALUES
(1, 'Pengadaan Lab 2026', 2026, 'locked', 5, '2026-06-03 12:11:04'),
(2, 'pengayaan', 2026, 'locked', 5, '2026-06-03 13:39:36'),
(3, 'tes', 2025, 'locked', 5, '2026-06-03 14:24:02'),
(4, 'ayam', 2026, 'locked', 5, '2026-06-03 15:49:20'),
(5, 'tes123', 2026, 'review', 5, '2026-06-04 04:30:28'),
(6, '123', 2026, 'review', 5, '2026-06-10 03:52:23'),
(7, 'testestes', 2026, 'draft', 5, '2026-06-11 03:12:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `procurement_items`
--

CREATE TABLE `procurement_items` (
  `id` int(11) NOT NULL,
  `draft_id` int(11) NOT NULL,
  `jenis_barang` enum('inventaris','bhp') DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` decimal(15,2) DEFAULT NULL,
  `link_pembelian` text DEFAULT NULL,
  `replace_inventory_id` int(11) DEFAULT NULL,
  `status_review` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `procurement_items`
--

INSERT INTO `procurement_items` (`id`, `draft_id`, `jenis_barang`, `nama_barang`, `jumlah`, `harga_satuan`, `link_pembelian`, `replace_inventory_id`, `status_review`, `created_at`) VALUES
(1, 1, 'inventaris', 'Laptop Asus', 5, 12000000.00, 'https://tokopedia.com/xxx', NULL, 'approved', '2026-06-03 12:11:55'),
(2, 2, NULL, 'alkohol', 100, NULL, 'shopee', NULL, 'pending', '2026-06-03 14:00:56'),
(3, 2, NULL, 'tes', 12, NULL, '123', NULL, 'pending', '2026-06-03 14:03:28'),
(4, 2, NULL, 'alkohol', 2, 2999.00, '1', NULL, 'pending', '2026-06-03 14:11:46'),
(5, 2, NULL, 'switch', 5, 5000000.00, 'tokped', NULL, 'pending', '2026-06-03 14:13:01'),
(6, 3, NULL, 'ayam', 2, 5000.00, 'ujang', NULL, 'approved', '2026-06-03 14:24:29'),
(7, 2, NULL, 'ayam', 2, 1000.00, NULL, NULL, 'pending', '2026-06-03 15:51:01'),
(8, 5, NULL, 'tes1', 2, 1000.00, NULL, NULL, 'pending', '2026-06-04 04:31:35'),
(9, 5, NULL, 'tes2', 200, 10.00, 'qwe', NULL, 'pending', '2026-06-04 04:32:27'),
(10, 4, NULL, 'tes23', 2, 20.00, NULL, NULL, 'approved', '2026-06-04 04:33:32'),
(12, 6, NULL, 'tes', 12, 12.00, NULL, NULL, 'pending', '2026-06-10 03:59:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `nama_ruangan`, `lokasi`, `keterangan`) VALUES
(1, 'Lab Jaringan', 'Gedung A Lantai 2', 'Praktikum jaringan komputer'),
(3, 'ADV 3', 'GWM lt 8', 'Lap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('administrator','kepala_lab','kaprodi','staf_admin','staf_lab') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(2, 'Admin', 'admin@gmail.com', '$2b$10$pUqAs9Ckmr7bU/TyPtnmAelKMLB3Jlwewuwvd/IS83b9C0hr3IJrO', 'administrator'),
(3, 'Kaprodi', 'kaprodi@gmail.com', '$2b$10$HBW3O38RwbVaWfMWR89vT.i9Pa1PUnZKnRnZsy75mzrhoS9PEMC9.', 'kaprodi'),
(4, 'Staf Laboratorium', 'staflab@gmail.com', '$2b$10$K1yLVU7I/dPlBnQ2RvDIJOyXCEO6LnMuly8ek5CaNmVA2QDCCsr1u', 'staf_lab'),
(5, 'Kepala Lab', 'kepalalab@gmail.com', '$2b$10$NSNg5JPI9XRhc/nRyo0v.ekKWSqyk4nGcWsuQ3a4w1oJhaUZyP34a', 'kepala_lab'),
(6, 'Staff Admin', 'stafadmin@gmail.com', '$2b$10$OCDtSr1PjagWvI2s/4LrDesd1sJmtn5whx6MWcGox5ao1T56bRkgi', 'staf_admin'),
(8, 'tes', 'tes@email.com', '$2b$10$ciAbKPeSw9V/Yy.E3SqEx./zXjudN/glMxv7ZtFjZRTfVYKdGitp2', 'kepala_lab'),
(10, 'ayam', 'ayam@email.com', '$2b$10$DR668eRFj0I6Xn/ZLtZT2ucplEh3KdPpG2QRPYy.ojbkHLABSOzEu', 'kaprodi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bhp_items`
--
ALTER TABLE `bhp_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bhp_stock_logs`
--
ALTER TABLE `bhp_stock_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bhp_id` (`bhp_id`);

--
-- Indeks untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_inventaris` (`kode_inventaris`),
  ADD KEY `room_id` (`room_id`);

--
-- Indeks untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_id` (`inventory_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `maintenance_materials`
--
ALTER TABLE `maintenance_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_id` (`maintenance_id`),
  ADD KEY `bhp_id` (`bhp_id`);

--
-- Indeks untuk tabel `procurement_drafts`
--
ALTER TABLE `procurement_drafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `procurement_items`
--
ALTER TABLE `procurement_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `draft_id` (`draft_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bhp_items`
--
ALTER TABLE `bhp_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bhp_stock_logs`
--
ALTER TABLE `bhp_stock_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `maintenance_materials`
--
ALTER TABLE `maintenance_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `procurement_drafts`
--
ALTER TABLE `procurement_drafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `procurement_items`
--
ALTER TABLE `procurement_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bhp_stock_logs`
--
ALTER TABLE `bhp_stock_logs`
  ADD CONSTRAINT `bhp_stock_logs_ibfk_1` FOREIGN KEY (`bhp_id`) REFERENCES `bhp_items` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD CONSTRAINT `maintenance_logs_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`),
  ADD CONSTRAINT `maintenance_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `maintenance_materials`
--
ALTER TABLE `maintenance_materials`
  ADD CONSTRAINT `maintenance_materials_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance_logs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_materials_ibfk_2` FOREIGN KEY (`bhp_id`) REFERENCES `bhp_items` (`id`);

--
-- Ketidakleluasaan untuk tabel `procurement_drafts`
--
ALTER TABLE `procurement_drafts`
  ADD CONSTRAINT `procurement_drafts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `procurement_items`
--
ALTER TABLE `procurement_items`
  ADD CONSTRAINT `procurement_items_ibfk_1` FOREIGN KEY (`draft_id`) REFERENCES `procurement_drafts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
