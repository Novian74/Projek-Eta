-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 02:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rest_etacatridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tgl_kirim_email` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telegram` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `tgl_kirim_email`, `email`, `telegram`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', '2023-08-01', 'hendrik@e-t-a.co.id', '762625211', 'superadmin', NULL, '2023-08-08 11:04:39'),
(2, 'ITADMIN', 'ADMIN', '', '', '', 'superadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `nomornota` varchar(255) NOT NULL,
  `iduser` varchar(255) NOT NULL,
  `idprint` varchar(255) NOT NULL,
  `idcatridge` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `batasW` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `histori_emails`
--

CREATE TABLE `histori_emails` (
  `id` int(11) NOT NULL,
  `email_penerima` varchar(255) NOT NULL,
  `tgl_kirim` varchar(255) NOT NULL,
  `pdf` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `histori_emails`
--

INSERT INTO `histori_emails` (`id`, `email_penerima`, `tgl_kirim`, `pdf`) VALUES
(42, 'hendrik@e-t-a.co.id', '01-08-2023', 0x255044462d312e370a312030206f626a0a3c3c202f54797065202f436174616c6f670a2f4f75746c696e65732032203020520a2f5061676573203320302052203e3e0a656e646f626a0a322030206f626a0a3c3c202f54797065202f4f75746c696e6573202f436f756e742030203e3e0a656e646f626a0a332030206f626a0a3c3c202f54797065202f50616765730a2f4b696473205b36203020520a5d0a2f436f756e7420310a2f5265736f7572636573203c3c0a2f50726f635365742034203020520a2f466f6e74203c3c200a2f46312038203020520a2f46322039203020520a3e3e0a3e3e0a2f4d65646961426f78205b302e30303020302e303030203834312e383930203539352e3238305d0a203e3e0a656e646f626a0a342030206f626a0a5b2f504446202f54657874205d0a656e646f626a0a352030206f626a0a3c3c0a2f50726f64756365722028feff0064006f006d00700064006600200032002e0030002e00330020002b00200043005000440046290a2f4372656174696f6e446174652028443a32303233303830313039323630372b303027303027290a2f4d6f64446174652028443a32303233303830313039323630372b303027303027290a2f5469746c652028feff00410064006d0069006e0020007c0020004b006900720069006d0020005200650070006f0072007400200032003000320033002d00300037002d003000310020002d00200032003000320033002d00300037002d00330031290a3e3e0a656e646f626a0a362030206f626a0a3c3c202f54797065202f506167650a2f4d65646961426f78205b302e30303020302e303030203834312e383930203539352e3238305d0a2f506172656e742033203020520a2f436f6e74656e74732037203020520a3e3e0a656e646f626a0a372030206f626a0a3c3c202f46696c746572202f466c6174654465636f64650a2f4c656e67746820333538203e3e0a73747265616d0a789c8d933d6fc2400c86777e85c776c0b5cff7911b8bfa21312044b32186540484940f94a6eadfef414a92a121591ce774efbdcfd9e7192111413f56c7d92206118f4c06b4b3e83443bc87a737054a23417c00d83e6cd27359d5b0f8ce9222291e77102fe135be6a2d078d80d682e4fc4dcbaad52a52322737278639dc7e84db4308bdf6d08f814a82375b90287cc582b7a82d8328b4464195c2613674990bc745e90d7aebfee15995b02aebe4be3f0ba176ae05089509e924000ed5bc4a8709927cc45e91c5e872e13f7b160ec67e92bf62d36807fd5fd27352d5699e16234d90088da2962232a855340942b46ba48310ebea54d469759f402b0969d4b5c1a1b86965d061d3553a481097c598bf214651dd3b64a3d179990460981aed3040521c8f4906ebf42b1969853516b9d70a3661ec8c990462ad69b4a320cff9e729eb814461773f6edec3a233f003044bd802ec42b2ef8655d086879743373dcd4a061fbf4aa6f8580a656e6473747265616d0a656e646f626a0a382030206f626a0a3c3c202f54797065202f466f6e740a2f53756274797065202f54797065310a2f4e616d65202f46310a2f42617365466f6e74202f48656c7665746963610a2f456e636f64696e67202f57696e416e7369456e636f64696e670a3e3e0a656e646f626a0a392030206f626a0a3c3c202f54797065202f466f6e740a2f53756274797065202f54797065310a2f4e616d65202f46320a2f42617365466f6e74202f48656c7665746963612d426f6c640a2f456e636f64696e67202f57696e416e7369456e636f64696e670a3e3e0a656e646f626a0a787265660a302031300a303030303030303030302036353533352066200a30303030303030303039203030303030206e200a30303030303030303734203030303030206e200a30303030303030313230203030303030206e200a30303030303030323834203030303030206e200a30303030303030333133203030303030206e200a30303030303030353632203030303030206e200a30303030303030363635203030303030206e200a30303030303031303935203030303030206e200a30303030303031323032203030303030206e200a747261696c65720a3c3c0a2f53697a652031300a2f526f6f742031203020520a2f496e666f2035203020520a2f49445b3c33343436396330623236393163393336326361616135343133326235373130303e3c33343436396330623236393163393336326361616135343133326235373130303e5d0a3e3e0a7374617274787265660a313331340a2525454f460a);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_16_011811_create_tintas_table', 1),
(6, '2023_05_16_011932_create_pelanggans_table', 1),
(7, '2023_05_16_071029_create_admins_table', 1),
(8, '2023_05_17_012226_create_printers_table', 1),
(9, '2023_05_22_043028_create_bookings_table', 1),
(10, '2023_05_31_015425_create_print_catridges_table', 1);

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
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `iduser` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gedung` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`iduser`, `nama`, `gedung`, `area`, `departemen`, `created_at`, `updated_at`) VALUES
('USER 110', 'novian', 'G5', 'Produksi', '201-3000', '2023-06-26 19:20:50', '2023-06-26 19:20:50');

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
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `idprint` varchar(255) NOT NULL,
  `printer_name` varchar(255) NOT NULL,
  `model_tinta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`idprint`, `printer_name`, `model_tinta`, `created_at`, `updated_at`) VALUES
('PR 003', 'HP LaserJet 1020', 1, '2023-06-22 01:12:19', '2023-06-22 01:12:19'),
('PR 101', 'HP Laser Jet Profesional P1102', 1, NULL, NULL),
('PR 102', 'HP LaserJet 1010', 1, '2023-06-22 01:09:34', '2023-06-22 01:09:34'),
('PR 105', 'HP Laserjet Pro M12w', 1, '2023-06-22 02:12:23', '2023-06-22 02:12:23'),
('PR 106', 'HP Laserjet P2015 Series', 1, '2023-06-22 23:20:16', '2023-06-22 23:20:16'),
('PR 108', 'HP Color Laserjet M153', 2, '2023-06-23 00:50:36', '2023-06-23 00:50:36'),
('PR 109', 'HP Laserjet P1606dn', 1, NULL, NULL),
('PR 110', 'Epson L310', 2, '2023-07-28 09:20:05', '2023-07-28 09:20:05'),
('PR 111', 'Epson L1210', 2, '2023-07-28 09:20:31', '2023-07-28 09:20:31'),
('PR 112', 'Epson L1110', 2, '2023-07-28 09:21:02', '2023-07-28 09:21:02'),
('PR 113', 'Epson EcoTank L3210', 2, '2023-07-28 13:08:45', '2023-07-28 13:08:45'),
('PR 114', 'HP CP1025', 2, '2023-07-28 14:11:44', '2023-07-28 14:11:44'),
('PR 115', 'HP LaserJet 107a', 1, '2023-08-09 13:25:04', '2023-08-09 13:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `print_catridges`
--

CREATE TABLE `print_catridges` (
  `PrCt` int(10) UNSIGNED NOT NULL,
  `idprint` varchar(255) NOT NULL,
  `idcatridge` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `print_catridges`
--

INSERT INTO `print_catridges` (`PrCt`, `idprint`, `idcatridge`, `created_at`, `updated_at`) VALUES
(13, 'PR 102', 'CT 102', '2023-06-22 01:12:34', '2023-06-22 01:12:34'),
(14, 'PR 103', 'CT 102', '2023-06-22 01:12:47', '2023-06-22 01:12:47'),
(16, 'PR 105', 'CT 117', '2023-06-22 02:13:43', '2023-06-22 02:13:43'),
(19, 'PR 108', 'CT 107', '2023-06-23 00:50:46', '2023-06-23 00:50:46'),
(20, 'PR 108', 'CT 108', '2023-06-23 00:51:01', '2023-06-23 00:51:01'),
(21, 'PR 108', 'CT 109', '2023-06-23 00:51:15', '2023-06-23 00:51:15'),
(22, 'PR 108', 'CT 110', '2023-06-23 00:51:32', '2023-06-23 00:51:32'),
(33, 'PR 109', 'CT 105', '2023-07-27 13:37:56', '2023-07-27 13:37:56'),
(34, 'PR 003', 'CT 102', '2023-07-27 13:46:46', '2023-07-27 13:46:46'),
(35, 'PR 101', 'CT 106', '2023-07-27 13:57:58', '2023-07-27 13:57:58'),
(36, 'PR 110', 'CT 118', '2023-07-28 09:27:55', '2023-07-28 09:27:55'),
(37, 'PR 110', 'CT 119', '2023-07-28 09:28:24', '2023-07-28 09:28:24'),
(38, 'PR 110', 'CT 125', '2023-07-28 09:28:42', '2023-07-28 09:28:42'),
(39, 'PR 110', 'CT 126', '2023-07-28 09:29:07', '2023-07-28 09:29:07'),
(40, 'PR 111', 'CT 120', '2023-07-28 09:29:43', '2023-07-28 09:29:43'),
(41, 'PR 111', 'CT 121', '2023-07-28 09:30:02', '2023-07-28 09:30:02'),
(42, 'PR 111', 'CT 122', '2023-07-28 09:30:31', '2023-07-28 09:30:31'),
(43, 'PR 111', 'CT 123', '2023-07-28 09:30:58', '2023-07-28 09:30:58'),
(44, 'PR 112', 'CT 120', '2023-07-28 09:31:18', '2023-07-28 09:31:18'),
(46, 'PR 112', 'CT 121', '2023-07-28 09:37:02', '2023-07-28 09:37:02'),
(48, 'PR 112', 'CT 123', '2023-07-28 09:38:27', '2023-07-28 09:38:27'),
(49, 'PR 112', 'CT 122', '2023-07-28 10:39:55', '2023-07-28 10:39:55'),
(50, 'PR 113', 'CT 120', '2023-07-28 13:11:02', '2023-07-28 13:11:02'),
(51, 'PR 113', 'CT 121', '2023-07-28 13:11:18', '2023-07-28 13:11:18'),
(52, 'PR 113', 'CT 122', '2023-07-28 13:11:35', '2023-07-28 13:11:35'),
(53, 'PR 113', 'CT 123', '2023-07-28 13:11:51', '2023-07-28 13:11:51'),
(54, 'PR 114', 'CT 127', '2023-07-28 14:23:56', '2023-07-28 14:23:56'),
(55, 'PR 114', 'CT 128', '2023-07-28 14:24:19', '2023-07-28 14:24:19'),
(56, 'PR 114', 'CT 129', '2023-07-28 14:24:51', '2023-07-28 14:24:51'),
(57, 'PR 114', 'CT 130', '2023-07-28 14:25:14', '2023-07-28 14:25:14'),
(58, 'PR 115', 'CT 131', '2023-08-09 13:26:37', '2023-08-09 13:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `tintas`
--

CREATE TABLE `tintas` (
  `idcatridge` varchar(255) NOT NULL,
  `catridge_name` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `TC` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tintas`
--

INSERT INTO `tintas` (`idcatridge`, `catridge_name`, `warna`, `qty`, `stok`, `TC`, `created_at`, `updated_at`) VALUES
('CT 101', 'HP Laserjet 76A', 'Black', 2, 1, 1, NULL, '2023-08-09 10:20:49'),
('CT 102', 'HP Laserjet 12A', 'Black', 2, 1, 1, '2023-06-22 01:08:44', '2023-08-09 10:19:29'),
('CT 103', 'HP Laserjet 35A', 'Black', 2, 0, 1, '2023-06-22 01:16:12', '2023-08-29 15:48:33'),
('CT 104', 'HP Laserjet 53A', 'Black', 2, 0, 1, '2023-06-22 01:17:41', '2023-08-10 15:14:44'),
('CT 105', 'HP Laserjet 78A', 'Black', 2, 1, 1, '2023-06-22 01:18:36', '2023-07-28 14:33:22'),
('CT 106', 'HP Laserjet 85A', 'Black', 2, 0, 1, '2023-06-22 01:19:42', '2023-08-30 16:32:10'),
('CT 107', 'HP 204A Black Laserjet CF510A', 'Cyan', 2, 1, 1, '2023-06-22 01:23:56', '2023-07-28 14:33:56'),
('CT 108', 'HP 204A Cyan Laserjet CF511A', 'Black', 2, 0, 1, '2023-06-22 01:27:45', '2023-07-28 14:35:41'),
('CT 109', 'HP 204A Yellow Laserjet CF512A', 'Yellow', 2, 1, 1, '2023-06-22 01:28:20', '2023-08-09 10:21:09'),
('CT 110', 'HP 204A Magenta Laserjet CF513A', 'Magenta', 2, 0, 1, '2023-06-22 01:29:02', '2023-07-28 14:36:04'),
('CT 113', 'HP 130A Black', 'Black', 2, 0, 1, '2023-06-22 01:47:49', '2023-07-28 14:36:20'),
('CT 114', 'HP 130A Cyan', 'Cyan', 2, 0, 1, '2023-06-22 01:48:35', '2023-07-28 14:36:27'),
('CT 115', 'HP 130A Yellow', 'Yellow', 2, 0, 1, '2023-06-22 01:49:05', '2023-07-28 14:36:35'),
('CT 116', 'HP 130A Magenta', 'Magenta', 2, 0, 1, '2023-06-22 01:49:23', '2023-07-28 14:36:42'),
('CT 117', 'HP Laserjet 79A', 'Black', 2, 1, 1, NULL, '2023-08-30 16:32:02'),
('CT 118', 'Epson 664 Cyan', 'Cyan', 1, 1, 2, '2023-07-28 08:50:11', '2023-07-28 08:50:11'),
('CT 119', 'Epson 664 Yellow', 'Yellow', 1, 0, 2, '2023-07-28 08:51:37', '2023-07-28 08:51:37'),
('CT 120', 'Epson 003 Black', 'Black', 1, 3, 2, '2023-07-28 08:53:27', '2023-07-28 08:53:27'),
('CT 121', 'Epson 003 Cyan', 'Cyan', 1, 3, 2, '2023-07-28 08:54:13', '2023-07-28 08:54:13'),
('CT 122', 'Epson 003 Yellow', 'Yellow', 1, 3, 2, '2023-07-28 08:54:47', '2023-07-28 08:54:47'),
('CT 123', 'Epson 003 Magenta', 'Magenta', 1, 2, 2, '2023-07-28 08:55:42', '2023-07-28 08:55:42'),
('CT 124', 'HP 46 Black', 'Black', 1, 1, 2, '2023-07-28 08:56:47', '2023-07-28 15:00:52'),
('CT 125', 'Epson 664 Magenta', 'Magenta', 1, 0, 2, '2023-07-28 09:24:20', '2023-07-28 09:24:20'),
('CT 126', 'Epson 664 Black', 'Black', 1, 0, 2, '2023-07-28 09:24:50', '2023-07-28 09:24:50'),
('CT 127', 'HP 126A Cyan CE311A', 'Cyan', 2, 1, 1, '2023-07-28 14:17:14', '2023-07-28 15:00:05'),
('CT 128', 'HP 126A Black CE310A', 'Black', 2, 1, 1, '2023-07-28 14:19:03', '2023-07-28 15:00:12'),
('CT 129', 'HP 126A Yellow CE312A', 'Yellow', 2, 1, 1, '2023-07-28 14:20:19', '2023-07-28 15:00:22'),
('CT 130', 'HP 126A Magenta CE313A', 'Magenta', 2, 0, 1, '2023-07-28 14:20:58', '2023-07-28 15:00:31'),
('CT 131', 'HP 107A', 'Black', 2, 1, 1, '2023-07-28 14:34:32', '2023-08-09 10:21:37');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`nomornota`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `histori_emails`
--
ALTER TABLE `histori_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`idprint`);

--
-- Indexes for table `print_catridges`
--
ALTER TABLE `print_catridges`
  ADD PRIMARY KEY (`PrCt`);

--
-- Indexes for table `tintas`
--
ALTER TABLE `tintas`
  ADD PRIMARY KEY (`idcatridge`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histori_emails`
--
ALTER TABLE `histori_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `print_catridges`
--
ALTER TABLE `print_catridges`
  MODIFY `PrCt` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
