-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Jan 2022 pada 19.12
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan-iqbal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_pengeluaran`
--

CREATE TABLE `category_pengeluaran` (
  `id_category_pengeluaran` int(11) NOT NULL,
  `code_akun` varchar(50) DEFAULT NULL,
  `nama_category` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category_pengeluaran`
--

INSERT INTO `category_pengeluaran` (`id_category_pengeluaran`, `code_akun`, `nama_category`, `created_by`, `created_date`) VALUES
(1, '0000-06', 'Keluarga', 'alwan', '2021-07-10 02:57:49'),
(2, '0000-05', 'PPN (10%)', 'alwan', '2021-07-10 02:57:38'),
(3, '6116-03', 'Beban Telephone', 'alwan', '2021-07-10 02:55:09'),
(4, '6116-13', 'Beban Admin Bank', 'alwan', '2021-07-10 02:56:59'),
(5, '6111-17', 'Beban Pelatihan dan Pengembangan', 'alwan', '2021-07-10 02:51:50'),
(6, '6116-11', 'Beban Jasa Perawatan & Pemeliaharaan', 'alwan', '2021-07-10 02:56:40'),
(7, '6116-05', 'Beban Perlengkapan Kantor', 'alwan', '2021-07-10 02:55:30'),
(8, '6116-04', 'Biaya Internet', 'alwan', '2021-07-10 02:55:19'),
(9, '6116-02', 'Beban Air', 'alwan', '2021-07-10 02:54:28'),
(10, '0000-02', 'Mekanikal Electrik', 'alwan', '2021-07-10 02:57:08'),
(11, '0000-01', 'Kas Kecil', 'alwan', '2021-07-10 02:58:05'),
(12, '6116-01', 'Beban Listrik', 'alwan', '2021-07-10 02:54:17'),
(13, '6116-08', 'Beban Rumah Tangga Keluarga', 'alwan', '2021-07-10 02:56:10'),
(14, '6116-06', 'Beban Alat Tulis Kantor (ATK)', 'alwan', '2021-07-10 02:55:41'),
(15, '6113-01', 'Beban Konsultan dan Perijinan', 'alwan', '2021-07-10 02:53:56'),
(16, '0000-03', 'Furniture', 'alwan', '2021-07-10 02:57:16'),
(17, '6116-07', 'Beban Pengiriman Barang', 'alwan', '2021-07-10 02:56:01'),
(18, '6116-10', 'Beban Transportasi dan Akomodasi', 'alwan', '2021-07-10 02:56:30'),
(19, '0000-04', 'Komputer', 'alwan', '2021-07-10 02:57:30'),
(20, '6116-12', 'Beban Jasa Keamanan & Kebersihan', 'alwan', '2021-07-10 02:56:49'),
(21, '6116-09', 'Beban Meterai', 'alwan', '2021-07-10 02:56:20'),
(22, '0000-00', 'Penerimaan', 'alwan', '2021-07-10 02:57:57'),
(23, '6113-02', 'Beban Entertain', 'alwan', '2021-07-10 02:54:07'),
(24, '9288-1992', 'Kebutuhan Pribadi, Dll', 'alwan', '2021-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `aktifitas` varchar(168) NOT NULL,
  `keterangan` longtext DEFAULT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `tanggal`, `jam`, `aktifitas`, `keterangan`, `admin`) VALUES
(3, '2020-06-08', '16:46:00', 'Login', 'Login', 3),
(4, '2020-06-08', '16:47:00', 'Logout', 'Logout', 3),
(5, '2020-06-08', '16:47:00', 'Login', 'Login', 3),
(6, '2020-07-15', '13:26:00', 'Login', 'Login', 3),
(7, '2020-07-15', '13:29:00', 'Login', 'Login', 3),
(8, '2020-07-15', '16:00:00', 'Login', 'Login', 3),
(9, '2020-08-06', '10:10:00', 'Login', 'Login', 3),
(10, '2020-08-06', '11:18:00', 'Login', 'Login', 3),
(11, '2020-08-06', '13:45:00', 'Login', 'Login', 3),
(12, '2020-08-07', '10:36:00', 'Login', 'Login', 3),
(13, '2020-08-07', '17:28:00', 'Login', 'Login', 3),
(14, '2020-08-10', '10:17:00', 'Login', 'Login', 3),
(15, '2020-08-11', '10:46:00', 'Login', 'Login', 3),
(16, '2020-08-13', '11:50:00', 'Login', 'Login', 3),
(17, '2020-08-13', '12:09:00', 'Login', 'Login', 3),
(18, '2020-08-13', '12:57:00', 'Login', 'Login', 3),
(19, '2020-08-13', '14:27:00', 'Login', 'Login', 3),
(20, '2020-08-17', '16:32:00', 'Login', 'Login', 3),
(21, '2020-08-17', '16:33:00', 'Login', 'Login', 3),
(22, '2020-08-18', '10:02:00', 'Login', 'Login', 3),
(23, '2020-08-18', '16:24:00', 'Login', 'Login', 3),
(24, '2020-08-18', '16:32:00', 'Login', 'Login', 6),
(25, '2020-08-18', '16:43:00', 'Login', 'Login', 3),
(26, '2020-08-18', '16:43:00', 'Login', 'Login', 6),
(27, '2020-08-18', '16:44:00', 'Login', 'Login', 6),
(28, '2020-08-18', '16:44:00', 'Login', 'Login', 6),
(29, '2020-08-18', '16:45:00', 'Login', 'Login', 6),
(30, '2020-08-18', '16:51:00', 'Login', 'Login', 6),
(31, '2020-08-18', '16:52:00', 'Login', 'Login', 6),
(32, '2020-08-18', '16:54:00', 'Login', 'Login', 3),
(33, '2020-08-18', '16:54:00', 'Login', 'Login', 6),
(34, '2020-08-18', '16:55:00', 'Login', 'Login', 6),
(35, '2020-08-18', '16:55:00', 'Login', 'Login', 6),
(36, '2020-08-18', '16:55:00', 'Login', 'Login', 6),
(37, '2020-08-19', '11:08:00', 'Login', 'Login', 6),
(38, '2020-08-19', '11:08:00', 'Login', 'Login', 3),
(39, '2020-08-19', '14:11:00', 'Login', 'Login', 7),
(40, '2020-08-19', '14:12:00', 'Login', 'Login', 7),
(41, '2020-08-19', '14:12:00', 'Login', 'Login', 7),
(42, '2020-08-19', '14:12:00', 'Login', 'Login', 7),
(43, '2020-08-19', '14:12:00', 'Login', 'Login', 7),
(44, '2020-08-19', '14:12:00', 'Login', 'Login', 7),
(45, '2020-08-19', '14:13:00', 'Login', 'Login', 3),
(46, '2020-08-19', '14:13:00', 'Login', 'Login', 7),
(47, '2020-08-19', '15:19:00', 'Login', 'Login', 6),
(48, '2020-08-19', '15:22:00', 'Login', 'Login', 6),
(49, '2020-08-19', '15:22:00', 'Login', 'Login', 6),
(50, '2020-08-19', '15:22:00', 'Login', 'Login', 6),
(51, '2020-08-19', '15:22:00', 'Login', 'Login', 7),
(52, '2020-08-19', '15:22:00', 'Login', 'Login', 3),
(53, '2020-08-19', '15:23:00', 'Login', 'Login', 6),
(54, '2020-08-19', '15:23:00', 'Login', 'Login', 6),
(55, '2020-08-19', '15:23:00', 'Login', 'Login', 3),
(56, '2020-08-19', '15:25:00', 'Login', 'Login', 7),
(57, '2020-08-19', '15:25:00', 'Login', 'Login', 6),
(58, '2020-08-19', '15:25:00', 'Login', 'Login', 6),
(59, '2020-08-19', '15:26:00', 'Login', 'Login', 3),
(60, '2020-08-19', '15:26:00', 'Login', 'Login', 6),
(61, '2020-08-19', '15:26:00', 'Login', 'Login', 6),
(62, '2020-08-19', '15:27:00', 'Login', 'Login', 3),
(63, '2020-08-19', '15:27:00', 'Login', 'Login', 6),
(64, '2020-08-19', '15:27:00', 'Login', 'Login', 7),
(65, '2020-08-19', '15:28:00', 'Login', 'Login', 3),
(66, '2020-08-19', '15:29:00', 'Login', 'Login', 6),
(67, '2020-08-19', '15:29:00', 'Login', 'Login', 6),
(68, '2020-08-19', '15:30:00', 'Login', 'Login', 3),
(69, '2020-08-19', '15:31:00', 'Login', 'Login', 6),
(70, '2020-08-19', '15:32:00', 'Login', 'Login', 6),
(71, '2020-08-19', '15:33:00', 'Login', 'Login', 6),
(72, '2020-08-19', '15:34:00', 'Login', 'Login', 7),
(73, '2020-08-19', '15:35:00', 'Login', 'Login', 6),
(74, '2020-08-19', '15:36:00', 'Login', 'Login', 7),
(75, '2020-08-19', '15:37:00', 'Login', 'Login', 6),
(76, '2020-08-19', '15:37:00', 'Login', 'Login', 7),
(77, '2020-08-19', '19:46:00', 'Login', 'Login', 7),
(78, '2020-08-21', '05:06:00', 'Login', 'Login', 6),
(79, '2020-08-21', '10:46:00', 'Login', 'Login', 6),
(80, '2020-08-21', '10:50:00', 'Login', 'Login', 6),
(81, '2020-08-21', '14:17:00', 'Login', 'Login', 3),
(82, '2020-08-21', '14:35:00', 'Login', 'Login', 3),
(83, '2020-08-21', '15:30:00', 'Login', 'Login', 3),
(84, '2020-08-21', '22:50:00', 'Login', 'Login', 6),
(85, '2020-08-23', '23:58:00', 'Login', 'Login', 3),
(86, '2020-08-25', '03:36:00', 'Login', 'Login', 6),
(87, '2020-09-23', '17:06:00', 'Login', 'Login', 3),
(88, '2020-09-24', '11:41:00', 'Login', 'Login', 3),
(89, '2020-09-25', '01:01:00', 'Login', 'Login', 6),
(90, '2020-09-25', '11:37:00', 'Login', 'Login', 3),
(91, '2020-09-25', '15:42:00', 'Login', 'Login', 3),
(92, '2020-09-25', '17:08:00', 'Login', 'Login', 6),
(93, '2020-10-05', '12:02:00', 'Login', 'Login', 6),
(94, '2020-10-05', '19:12:00', 'Login', 'Login', 6),
(95, '2020-10-10', '01:21:00', 'Login', 'Login', 3),
(96, '2020-10-12', '21:51:00', 'Login', 'Login', 3),
(97, '2020-10-13', '14:10:00', 'Login', 'Login', 3),
(98, '2020-10-14', '14:02:00', 'Login', 'Login', 3),
(99, '2020-10-16', '13:57:00', 'Login', 'Login', 3),
(100, '2020-10-20', '13:30:00', 'Login', 'Login', 3),
(101, '2020-10-23', '11:18:00', 'Login', 'Login', 3),
(102, '2020-10-23', '14:13:00', 'Login', 'Login', 3),
(103, '2020-10-24', '13:09:00', 'Login', 'Login', 3),
(104, '2020-10-25', '20:59:00', 'Login', 'Login', 3),
(105, '2020-10-26', '01:53:00', 'Login', 'Login', 3),
(106, '2020-11-12', '16:23:00', 'Login', 'Login', 6),
(107, '2020-11-12', '23:48:00', 'Login', 'Login', 6),
(108, '2020-11-14', '02:26:00', 'Login', 'Login', 6),
(109, '2020-11-25', '13:37:00', 'Login', 'Login', 6),
(110, '2020-11-25', '14:29:00', 'Login', 'Login', 6),
(111, '2020-11-25', '14:38:00', 'Login', 'Login', 6),
(112, '2020-11-25', '14:51:00', 'Login', 'Login', 6),
(113, '2020-11-25', '15:00:00', 'Login', 'Login', 6),
(114, '2020-11-25', '16:08:00', 'Login', 'Login', 6),
(115, '2020-11-26', '13:14:00', 'Login', 'Login', 6),
(116, '2020-11-26', '13:18:00', 'Login', 'Login', 6),
(117, '2020-12-02', '12:27:00', 'Login', 'Login', 6),
(118, '2020-12-08', '09:29:00', 'Login', 'Login', 6),
(119, '2020-12-09', '01:05:00', 'Login', 'Login', 6),
(120, '2020-12-09', '02:34:00', 'Login', 'Login', 6),
(121, '2020-12-10', '00:01:00', 'Login', 'Login', 6),
(122, '2020-12-18', '14:27:00', 'Login', 'Login', 6),
(123, '2020-12-19', '00:31:00', 'Login', 'Login', 6),
(124, '2020-12-19', '21:53:00', 'Login', 'Login', 6),
(125, '2020-12-23', '22:07:00', 'Login', 'Login', 6),
(126, '2020-12-25', '04:00:00', 'Login', 'Login', 6),
(127, '2020-12-28', '01:52:00', 'Login', 'Login', 6),
(128, '2021-01-06', '23:04:00', 'Login', 'Login', 6),
(129, '2021-01-08', '18:35:00', 'Login', 'Login', 6),
(130, '2021-01-09', '00:51:00', 'Login', 'Login', 6),
(131, '2021-01-09', '01:44:00', 'Login', 'Login', 6),
(132, '2021-01-09', '01:48:00', 'Login', 'Login', 6),
(133, '2021-01-12', '14:59:00', 'Login', 'Login', 6),
(134, '2021-01-16', '00:57:00', 'Login', 'Login', 6),
(135, '2021-01-19', '16:04:00', 'Login', 'Login', 7),
(136, '2021-01-19', '16:13:00', 'Login', 'Login', 7),
(137, '2021-01-19', '16:18:00', 'Login', 'Login', 6),
(138, '2021-01-19', '16:21:00', 'Login', 'Login', 8),
(139, '2021-01-19', '16:21:00', 'Login', 'Login', 8),
(140, '2021-01-19', '16:21:00', 'Login', 'Login', 8),
(141, '2021-01-19', '16:49:00', 'Login', 'Login', 7),
(142, '2021-01-19', '16:56:00', 'Login', 'Login', 6),
(143, '2021-01-25', '05:53:00', 'Login', 'Login', 6),
(144, '2021-01-26', '19:21:00', 'Login', 'Login', 6),
(145, '2021-01-26', '22:44:00', 'Login', 'Login', 6),
(146, '2021-01-27', '13:50:00', 'Login', 'Login', 6),
(147, '2021-01-27', '18:19:00', 'Login', 'Login', 6),
(148, '2021-01-31', '12:51:00', 'Login', 'Login', 8),
(149, '2021-01-31', '14:33:00', 'Login', 'Login', 7),
(150, '2021-01-31', '14:36:00', 'Login', 'Login', 5),
(151, '2021-01-31', '14:37:00', 'Login', 'Login', 6),
(152, '2021-01-31', '14:37:00', 'Login', 'Login', 5),
(153, '2021-01-31', '14:38:00', 'Login', 'Login', 7),
(154, '2021-01-31', '14:38:00', 'Login', 'Login', 8),
(155, '2021-02-01', '18:31:00', 'Login', 'Login', 6),
(156, '2021-02-10', '01:26:00', 'Login', 'Login', 6),
(157, '2021-02-11', '03:13:00', 'Login', 'Login', 6),
(158, '2021-02-12', '01:03:00', 'Login', 'Login', 6),
(159, '2021-03-01', '15:19:00', 'Login', 'Login', 6),
(160, '2021-03-01', '16:27:00', 'Logout', 'Logout', 6),
(161, '2021-03-01', '16:28:00', 'Login', 'Login', 6),
(162, '2021-03-09', '12:28:00', 'Login', 'Login', 6),
(163, '2021-03-10', '04:55:00', 'Login', 'Login', 6),
(164, '2021-03-11', '17:14:00', 'Login', 'Login', 6),
(165, '2021-03-12', '22:11:00', 'Login', 'Login', 6),
(166, '2021-03-12', '23:04:00', 'Login', 'Login', 6),
(167, '2021-03-30', '19:46:00', 'Login', 'Login', 6),
(168, '2021-03-31', '17:29:00', 'Login', 'Login', 6),
(169, '2021-04-01', '02:57:00', 'Login', 'Login', 6),
(170, '2021-04-02', '03:23:00', 'Login', 'Login', 6),
(171, '2021-04-04', '05:15:00', 'Login', 'Login', 6),
(172, '2021-04-04', '10:22:00', 'Login', 'Login', 6),
(173, '2021-04-05', '04:11:00', 'Login', 'Login', 6),
(174, '2021-04-06', '15:52:00', 'Login', 'Login', 6),
(175, '2021-04-09', '06:01:00', 'Login', 'Login', 6),
(176, '2021-04-09', '18:03:00', 'Login', 'Login', 6),
(177, '2021-04-11', '10:47:00', 'Login', 'Login', 6),
(178, '2021-04-14', '07:09:00', 'Login', 'Login', 6),
(179, '2021-04-14', '10:14:00', 'Login', 'Login', 6),
(180, '2021-04-14', '10:21:00', 'Login', 'Login', 6),
(181, '2021-04-17', '07:29:00', 'Login', 'Login', 6),
(182, '2021-04-18', '13:41:00', 'Login', 'Login', 6),
(183, '2021-04-18', '23:22:00', 'Login', 'Login', 6),
(184, '2021-04-20', '06:54:00', 'Login', 'Login', 6),
(185, '2021-04-22', '06:21:00', 'Login', 'Login', 6),
(186, '2021-04-22', '20:55:00', 'Login', 'Login', 6),
(187, '2021-04-24', '10:48:00', 'Login', 'Login', 6),
(188, '2021-04-25', '23:11:00', 'Login', 'Login', 6),
(189, '2021-04-28', '01:01:00', 'Login', 'Login', 6),
(190, '2021-04-29', '19:09:00', 'Login', 'Login', 6),
(191, '2021-05-01', '05:28:00', 'Login', 'Login', 6),
(192, '2021-05-09', '14:00:00', 'Login', 'Login', 6),
(193, '2021-05-14', '18:14:00', 'Login', 'Login', 6),
(194, '2021-05-19', '01:01:00', 'Login', 'Login', 6),
(195, '2021-05-19', '11:57:00', 'Login', 'Login', 7),
(196, '2021-05-19', '11:57:00', 'Login', 'Login', 6),
(197, '2021-05-19', '23:31:00', 'Login', 'Login', 6),
(198, '2021-05-21', '00:38:00', 'Login', 'Login', 6),
(199, '2021-05-22', '15:07:00', 'Login', 'Login', 6),
(200, '2021-05-24', '09:39:00', 'Login', 'Login', 6),
(201, '2021-06-07', '01:13:00', 'Login', 'Login', 6),
(202, '2021-12-28', '21:31:00', 'Login', 'Login', 6),
(203, '2021-12-29', '18:45:00', 'Login', 'Login', 6),
(204, '2021-12-29', '18:47:00', 'Login', 'Login', 6),
(205, '2021-12-29', '18:48:00', 'Login', 'Login', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `nama`, `username`, `password`, `role`, `status`) VALUES
(3, 'owner', 'owner', '0a659aac1778efd4c118b3ca051d8a42', '1', 1),
(5, 'ricky', 'ricky', '56ea8b83122449e814e0fd7bfb5f220a', '2', 1),
(6, 'alwan', 'alwan', '5a1d365841386335862599302dedb9a1', '1', 1),
(7, 'dina', 'dina', 'e274648aed611371cf5c30a30bbe1d65', '4', 1),
(8, 'fahmi', 'fahmi', 'f11d50d63d3891a44c332e46d6d7d561', '3', 1),
(9, 'iqbal', 'iqba', 'eedae20fc3c7a6e9c5b1102098771c70', '4', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(255) NOT NULL,
  `id_category_pengeluaran` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `name_pengeluaran` varchar(255) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_category_pengeluaran`, `id_user`, `total`, `name_pengeluaran`, `keterangan`, `image`, `tanggal`, `is_delete`, `created_date`, `created_by`) VALUES
(1, '5', '6', '360000', 'Beli Mikrotik', 'Pelengkapan mikrotik untuk pembelajaran', NULL, '2021-11-24', 0, '2021-12-30 13:50:47', 'alwan'),
(2, '6', '6', '100000', 'Service AC', 'Service AC KOST', NULL, '2021-12-09', 0, '2021-12-30 10:56:15', 'alwan'),
(3, '13', '6', '500000', 'Emas Tokopedia', 'Emas Tokopedia', NULL, '2021-12-02', 0, '2021-12-30 13:39:47', 'alwan'),
(4, '6', '6', '65000', 'Radmin Server', 'Pemebelian Radmin Server', NULL, '2021-12-06', 0, '2021-12-30 13:57:46', 'alwan'),
(5, '1', '6', '500000', 'Kebutuhan Keluarga ( Desember )', 'Kebutuhan Keluarga ( Desember )', NULL, '2021-12-08', 0, '2021-12-30 13:29:46', 'alwan'),
(6, '1', '6', '1000000', 'Kebutuhan Keluarga ( November )', 'Kebutuhan Keluarga Bulan November', NULL, '2021-11-10', 0, '2021-12-30 13:00:48', 'alwan'),
(7, '1', '6', '200000', 'Penarikan Uang', 'Penarikan Uang', NULL, '2021-12-03', 0, '2021-12-30 13:09:47', 'alwan'),
(8, '24', '6', '250000', 'Kebutuhan Pribadi, Dll', 'Kebutuhan Pribadi, Dll', NULL, '2021-12-08', 0, '2021-12-30 13:22:49', 'alwan'),
(9, '24', '6', '300000', 'Kebutuhan Pribadi, Dll', 'Kebutuhan Pribadi, Dll', NULL, '2021-11-11', 0, '2021-12-30 13:02:50', 'alwan'),
(10, '24', '6', '2715000', 'Kebutuhan Pribadi, Dll, Kost, Team, Mendadak', 'Kebutuhan Pribadi, Dll, Kost, Team', NULL, '2021-12-30', 0, '2021-12-30 13:07:51', 'alwan'),
(11, '5', '6', '20000000', 'asdsadsa', 'asdasdsa', 'KUY-2022-01-02-7JK9JVZYVG2E4X3.png', '2022-01-02', 1, '2022-01-02 00:57:39', 'alwan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id_transaksi` int(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `jumlah_pemasukan` varchar(255) DEFAULT NULL,
  `name_pemasukan` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ket_pemasukan` varchar(255) DEFAULT NULL,
  `id_kategori` int(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_transaksi` varchar(255) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_masuk`
--

INSERT INTO `transaksi_masuk` (`id_transaksi`, `id_user`, `jumlah_pemasukan`, `name_pemasukan`, `image`, `ket_pemasukan`, `id_kategori`, `tanggal`, `jenis_transaksi`, `is_delete`) VALUES
(1, 6, '2170000', 'Gaji Indocoll November', NULL, 'Gaji Indocoll November', NULL, '2021-12-10', 'transfer', 0),
(3, 6, '1000000', 'Hobikoe Timeline 1', NULL, 'Pengerjaan ngoding hobikoe', NULL, '2021-11-25', 'transfer', 0),
(4, 6, '500000', 'Bonus Hobikoe Dari Putra', NULL, 'Bonus dari pak putra pt indotechpren', NULL, '2021-12-22', 'transfer', 0),
(5, 6, '2380000', 'Gaji Indocoll Oktober', NULL, 'Gaji Indocoll Oktober', NULL, '2021-11-10', 'transfer', 0),
(6, 6, '2222222', 'testing', NULL, 'asdsa', NULL, '2022-01-01', 'transfer', 1),
(9, 6, '100000', 'Tabungan Tokped', 'KUY-2022-01-01-SK230B3AKAV0087.png', 'Tabungan Tokped', NULL, '2022-01-01', 'transfer', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category_pengeluaran`
--
ALTER TABLE `category_pengeluaran`
  ADD PRIMARY KEY (`id_category_pengeluaran`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category_pengeluaran`
--
ALTER TABLE `category_pengeluaran`
  MODIFY `id_category_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
