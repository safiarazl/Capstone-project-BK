-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 05:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_rs`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `email`, `password`, `role`) VALUES
(7, 'kampoengbola6@gmail.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'pasien'),
(8, 'admin@email.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'admin'),
(9, 'safiardemak@kalijaga.com', '$2y$10$.f0SAjUUGuKSvxn2yeiiHOKA5kNDzmcztk8kTzXPe2k7c8MKJZKZu', 'pasien'),
(10, 'DemakDemak@gmail.com', '$2y$12$QVK0q0AmPD/aO7tU5b0iTOGcSglkHHH35noArpYmu5MTp2a8OdDva', 'pasien');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED DEFAULT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) UNSIGNED NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_nopad_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status`) VALUES
(8, 18, NULL, 'sakit untu', 1, 'selesai'),
(9, 18, NULL, 'sakit umum 1', 1, 'selesai'),
(11, 19, NULL, 'ga sakit, mau ke poli umum aja', 2, 'selesai'),
(12, 19, NULL, 'ga sakit gigi', 2, 'selesai'),
(13, 18, 6, 'Susah tidur', 1, 'selesai'),
(18, 21, NULL, 'gigi', 3, 'selesai'),
(19, 21, NULL, 'gigi lagi', 4, 'selesai'),
(20, 18, NULL, 'cekccek', 5, 'selesai'),
(21, 19, 7, 'turuu', 1, 'selesai'),
(22, 19, NULL, 'Sakit gigi', 6, 'selesai'),
(23, 18, NULL, 'sakit gigi dimalam sabtu', 7, 'selesai'),
(24, 18, NULL, 'jatuh sakit', 1, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(22, 11, 1),
(23, 11, 4),
(24, 12, 2),
(25, 12, 3),
(26, 12, 4),
(27, 12, 5),
(28, 13, 1),
(29, 13, 4),
(30, 14, 1),
(31, 14, 4),
(32, 15, 1),
(33, 15, 2),
(34, 15, 3),
(35, 15, 4),
(36, 15, 5),
(37, 16, 1),
(38, 16, 2),
(39, 16, 3),
(40, 16, 4),
(41, 16, 5),
(42, 17, 1),
(43, 17, 2),
(44, 17, 3),
(45, 17, 4),
(46, 17, 5),
(47, 18, 2),
(48, 18, 4),
(49, 19, 1),
(50, 19, 4),
(51, 20, 3),
(52, 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `id_poli` int(11) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `id_akun`, `id_poli`, `nama`, `alamat`, `no_hp`) VALUES
(10, 23, 6, 'Deo A', 'pemalang', '08887278634'),
(12, 25, 5, 'Nantalira', 'Batang', '088872786342'),
(13, 29, 6, 'Ardi', 'Sorong', '08887278634'),
(15, 32, 7, 'Safiar Azalia', 'Demak', '088872786342'),
(16, 33, 6, 'Gigi', 'gigi tua', '08887278634'),
(17, 36, 7, 'Dian', 'purwodadi', '0812097341289');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `aktif` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `aktif`) VALUES
(6, 15, 'Senin', '15:00:00', '18:00:00', 'Y'),
(7, 17, 'Jumat', '12:12:00', '21:57:00', 'Y'),
(14, 10, 'Jumat', '03:23:00', '06:25:00', 'N'),
(16, 10, 'Sabtu', '00:47:00', '14:47:00', 'Y'),
(18, 10, 'Senin', '10:44:00', '22:44:00', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'Ampicillin syrup kering 125 mg/5 ml', 'btl 60 ml', 6000),
(2, 'Antasida DOEN I tablet kunyah kombinasi : Aluminiu', 'btl(10 x 10 tablet)', 14000),
(3, 'Antasida DOEN II suspensi kombinasi: Aluminium hid', 'btl 60 ml', 4800),
(4, 'Anti Haemorroiden salep kombinasi : Bismut subgall', 'pkt(25 tube @ 5 g)', 83000),
(5, 'Anti Haemorroiden Zalf “Roosan” & “Assa” Salep kom', 'pkt(24 pot @30 g)', 55000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `id_akun`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(17, 27, 'Nanta ler', 'Batang', '12934128', '0882736473', '202312-2'),
(18, 28, 'Deo', 'pemalang', '33211328732291', '08887278634', '202312-3'),
(19, 31, 'Safiar', 'Demak', '3321132873229114', '0882736473', '202312-3'),
(20, 34, 'Yudis Pasien', 'SMG', '09127838129', '082398223', '202401-4'),
(21, 35, 'Ardi', 'Sorong', '9123419024', '081293827', '202401-5');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(11, 8, '2024-01-01 22:23:05', 'cobacoba', 239000),
(12, 12, '2024-01-01 22:23:27', 'lagi coba', 306800),
(13, 13, '2024-01-03 12:31:20', 'dikasi obat tidur', 239000),
(14, 18, '2024-01-03 18:14:36', 'berhasil', 239000),
(15, 19, '2024-01-03 18:25:57', 'lagilagi gigi', 312800),
(16, 20, '2024-01-04 23:22:28', 'asdasdasdasdasdasdas', 312800),
(17, 21, '2024-01-05 21:54:05', 'sembuh', 312800),
(18, 22, '2024-01-06 14:00:34', 'Sudah sembuh', 247000),
(19, 24, '2024-01-08 09:52:33', 'sembuh totall', 239000),
(20, 23, '2024-01-08 10:19:43', 'sudah sembughhh', 237800);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(5, 'Poli Umum', 'Dokter Umum'),
(6, 'Poli Gigi', 'Dokter Gigi'),
(7, 'Poli Tidur', 'turu'),
(10, 'Poli Atraksi', 'stuntmen banget');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(5, 'admin', 'admin@gmail.com', NULL, '$2y$12$hAbH2mZIOxQHQ68b7g6.CO4MBbMhT.cSKSKlre49d5RqJdup93E2u', NULL, '2023-12-28 03:01:05', '2023-12-28 03:01:05', 'admin'),
(23, 'Deo A', 'DeoDokter@gmail.com', NULL, '$2y$12$h/CrH9YIm40W01Iq/9QE0Oo8xT8o7AsHM5pTSjRr.gnv0eyS0C1zS', NULL, '2023-12-29 10:37:57', '2023-12-30 04:50:48', 'dokter'),
(25, 'Nantalira', 'NantaDokter@gmail.com', NULL, '$2y$12$BYviXs8J0yyZpYo7eAuYMOC69Kp53yZQ.04Lpc7JJuPXuEx3p4OG2', NULL, '2023-12-29 10:43:21', '2023-12-29 11:25:06', 'dokter'),
(27, 'Nanta ler', 'NantaPasien@gmail.com', NULL, '$2y$12$ixRe4LgSEtYCTEOmXh1iwOLKkcnOf9wGscA.ZtOusOchKpooziMii', NULL, '2023-12-29 11:27:04', '2023-12-29 22:52:35', 'pasien'),
(28, 'Deo', 'DeoPasien@gmail.com', NULL, '$2y$12$diT/BXkgXvp8vSb5IHbq5OIDf7NTeEmZJnzGQrqT5K853jmwaBUzO', NULL, '2023-12-29 11:27:23', '2023-12-29 22:52:50', 'pasien'),
(29, 'Ardi', 'ArdiDokter@gmial.com', NULL, '$2y$12$IVYqQLqyrQMmQPBpfbuIYu/IIS6ko0/uWNeWBl0lHgir4j1b0bKMe', NULL, '2023-12-29 21:37:48', '2023-12-29 21:37:48', 'dokter'),
(31, 'Safiar', 'SafiarPasien@gmail.com', NULL, '$2y$12$Ydfm6TS.YaxIy6eRTyGoa.nTnohaWm16//uZP1huhMq2FFosQw2eC', NULL, '2023-12-31 05:07:24', '2023-12-31 05:07:24', 'pasien'),
(32, 'Safiar Azalia', 'SafiarDokter@gmail.com', NULL, '$2y$12$9kAudGZBS0kpdTCj87BD3uPNMYH9z0dth8zwqt0JRgdVIKHchQeme', NULL, '2023-12-31 05:21:15', '2023-12-31 05:21:15', 'dokter'),
(33, 'Gigi', 'GigiDokter@gmail.com', NULL, '$2y$12$OOeOav4EaG0X1KuJxhT/ke6iJRnWrr62aKGgZm5qBvxyMQflqjr.S', NULL, '2023-12-31 05:24:10', '2024-01-05 07:39:09', 'dokter'),
(34, 'Yudis Pasien', 'YudisPasien@gmail.com', NULL, '$2y$12$hQVplbFgJp3//iYOcqLZsOfiQhBPNCPWuHkKeZtvyXzdiuk8ig5iy', NULL, '2024-01-02 22:29:08', '2024-01-02 22:29:08', 'pasien'),
(35, 'Ardi', 'ArdiPasien@gmail.com', NULL, '$2y$12$fLilhZu9FrUfpgWqxWMu1.r/sOF36ReCj7QpXTa8WMMh7KJnSAoX6', NULL, '2024-01-03 03:31:12', '2024-01-03 03:31:12', 'pasien'),
(36, 'Dian', 'DianDokter@gmail.com', NULL, '$2y$12$/UQaL6tG/uZzf6C5pXxWYu2GagVJ6AlTTcQ/GfJb1byUXfQnVO3Ru', NULL, '2024-01-05 03:26:32', '2024-01-05 04:49:00', 'dokter'),
(44, 'Raha P', 'RahaPasien@gmail.com', NULL, '$2y$12$TLuI2jvISe.5ZNfkkaDaN.Jvc3cyscc5swfmR7oecl2fAazOxhxSW', NULL, '2024-01-07 20:20:24', '2024-01-07 20:20:24', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
