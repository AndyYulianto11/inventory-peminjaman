-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2024 at 03:32 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv_peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuks`
--

CREATE TABLE `barangmasuks` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_nota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `ppn_angka` double DEFAULT '0',
  `ppn_persen` double DEFAULT '0',
  `diskon_angka` double DEFAULT '0',
  `diskon_persen` double DEFAULT '0',
  `total_bayar` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangmasuks`
--

INSERT INTO `barangmasuks` (`id`, `kode_nota`, `tanggal_pembelian`, `supplier_id`, `ppn_angka`, `ppn_persen`, `diskon_angka`, `diskon_persen`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, '1', '2024-02-26', 1, 0, 0, 0, 0, 100000, '2024-02-26 09:43:28', '2024-02-26 09:43:28'),
(2, '2', '2024-02-14', 1, 0, 0, 0, 0, 100000, '2024-02-27 02:00:18', '2024-02-27 02:00:18'),
(3, '3', '2024-02-09', 2, 0, 0, 0, 0, 25000, '2024-02-27 02:01:49', '2024-02-27 02:01:49'),
(4, '9', '2024-02-10', 2, 0, 0, 0, 0, 50000, '2024-02-27 03:03:49', '2024-02-27 03:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `barang_lainnyas`
--

CREATE TABLE `barang_lainnyas` (
  `id` bigint UNSIGNED NOT NULL,
  `data_pengaju_id` bigint UNSIGNED NOT NULL,
  `code_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `databarangs`
--

CREATE TABLE `databarangs` (
  `id` bigint UNSIGNED NOT NULL,
  `code_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL,
  `satuan_id` bigint UNSIGNED NOT NULL,
  `harga` double NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `databarangs`
--

INSERT INTO `databarangs` (`id`, `code_barang`, `nama_barang`, `jenis_id`, `stok`, `satuan_id`, `harga`, `slug`, `created_at`, `updated_at`) VALUES
(1, '10001', 'Kursi', 3, 16, 1, 50000, 'Kursi', '2024-02-26 09:10:14', '2024-02-27 03:04:49'),
(2, '3531501939213', 'Meja', 4, 20, 1, 500000, 'meja', '2024-02-28 03:46:47', '2024-02-28 03:46:47'),
(3, '1820088952577', 'Detergen Soklin', 5, 20, 3, 5000, 'detergen-soklin', '2024-02-28 03:47:28', '2024-02-28 03:47:28'),
(4, '8131516994619', 'Mouse', 6, 20, 3, 200000, 'mouse', '2024-02-28 03:47:58', '2024-02-28 03:47:58'),
(5, '3807009258931', 'Keyboard', 6, 20, 3, 200000, 'keyboard', '2024-02-28 03:49:20', '2024-02-28 03:49:20'),
(6, '1699981307173', 'Monitor', 6, 20, 1, 1000000, 'monitor', '2024-02-28 03:49:42', '2024-02-28 03:49:42'),
(7, '1213202921601', 'CPU', 6, 20, 1, 3000000, 'cpu', '2024-02-28 03:50:04', '2024-02-28 03:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `datapengajus`
--

CREATE TABLE `datapengajus` (
  `id` bigint UNSIGNED NOT NULL,
  `code_pengajuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_setujuatasan` enum('1','2','3','4','5') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status_setujuadmin` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_pengajuan` tinyint(1) NOT NULL DEFAULT '0',
  `status_submit` tinyint(1) DEFAULT NULL,
  `upload_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datapengajus`
--

INSERT INTO `datapengajus` (`id`, `code_pengajuan`, `tgl_pengajuan`, `user_id`, `status_setujuatasan`, `status_setujuadmin`, `status_pengajuan`, `status_submit`, `upload_dokumen`, `created_at`, `updated_at`) VALUES
(1, '2402260000001', '2024-02-26', 4, '3', '3', 1, 1, 'Beginners-Guide-to-Blender.pdf', '2024-02-26 09:29:41', '2024-02-27 03:04:49'),
(2, '2402270000002', '2024-02-16', 4, '1', '0', 0, NULL, NULL, '2024-02-27 03:32:21', NULL),
(3, '2402280000003', '2024-02-28', 4, '1', '0', 0, NULL, NULL, '2024-02-28 03:51:37', NULL),
(4, '2402280000004', '2024-02-28', 8, '5', '0', 1, NULL, NULL, '2024-02-28 04:25:04', '2024-02-28 04:34:15'),
(5, '2403020000005', '2024-03-02', 9, '1', '0', 0, NULL, NULL, '2024-03-02 03:02:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_aset_units`
--

CREATE TABLE `data_aset_units` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `yang_menyerahkan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_dokumen_serahterima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_aset_units`
--

INSERT INTO `data_aset_units` (`id`, `kode_transaksi`, `tgl_transaksi`, `user_id`, `yang_menyerahkan`, `upload_dokumen_serahterima`, `status`, `created_at`, `updated_at`) VALUES
(1, '2402260000001', '2024-02-26', 4, 'Administrator', NULL, NULL, '2024-02-27 03:04:58', '2024-02-27 03:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barangs`
--

CREATE TABLE `history_stok_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `databarang_id` bigint UNSIGNED DEFAULT NULL,
  `barangmasuk_id` bigint UNSIGNED DEFAULT NULL,
  `itemdatapengaju_id` bigint UNSIGNED DEFAULT NULL,
  `qty` int DEFAULT '0',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_stok_barangs`
--

INSERT INTO `history_stok_barangs` (`id`, `databarang_id`, `barangmasuk_id`, `itemdatapengaju_id`, `qty`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 12, 'Insert Data Barang', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(2, 1, 1, NULL, 1, 'Barang Masuk', '2024-02-26 09:43:28', '2024-02-26 09:43:28'),
(3, 1, 2, NULL, 2, 'Barang Masuk', '2024-02-27 02:00:18', '2024-02-27 02:00:18'),
(4, 1, 3, NULL, 1, 'Barang Masuk', '2024-02-27 02:01:49', '2024-02-27 02:01:49'),
(5, 1, 4, NULL, 1, 'Barang Masuk', '2024-02-27 03:03:49', '2024-02-27 03:03:49'),
(6, 1, NULL, 1, 1, 'Barang Dipinjam', '2024-02-27 03:04:49', '2024-02-27 03:04:49'),
(7, 2, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:46:47', '2024-02-28 03:46:47'),
(8, 3, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:47:28', '2024-02-28 03:47:28'),
(9, 4, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:47:58', '2024-02-28 03:47:58'),
(10, 5, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:49:20', '2024-02-28 03:49:20'),
(11, 6, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:49:42', '2024-02-28 03:49:42'),
(12, 7, NULL, NULL, 20, 'Insert Data Barang', '2024-02-28 03:50:04', '2024-02-28 03:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `item_barang_masuks`
--

CREATE TABLE `item_barang_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `barangmasuk_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `harga` double NOT NULL,
  `jumlah` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_barang_masuks`
--

INSERT INTO `item_barang_masuks` (`id`, `barangmasuk_id`, `user_id`, `barang_id`, `qty`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 100000, 100000, '2024-02-26 09:43:28', NULL),
(2, 2, 1, 1, 2, 50000, 100000, '2024-02-27 02:00:18', NULL),
(3, 3, 1, 1, 1, 25000, 25000, '2024-02-27 02:01:49', NULL),
(4, 4, 1, 1, 1, 50000, 50000, '2024-02-27 03:03:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_data_aset_units`
--

CREATE TABLE `item_data_aset_units` (
  `id` bigint UNSIGNED NOT NULL,
  `dataasetunit_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `kondisi_barang` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_data_aset_units`
--

INSERT INTO `item_data_aset_units` (`id`, `dataasetunit_id`, `barang_id`, `qty`, `kondisi_barang`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '2024-02-27 03:04:58', '2024-02-27 03:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `item_data_pengadaan_barangs`
--

CREATE TABLE `item_data_pengadaan_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_data_pengajus`
--

CREATE TABLE `item_data_pengajus` (
  `id` bigint UNSIGNED NOT NULL,
  `datapengaju_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `selisih` int DEFAULT NULL,
  `status_persetujuanatasan` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_persetujuanadmin` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_data_pengajus`
--

INSERT INTO `item_data_pengajus` (`id`, `datapengaju_id`, `barang_id`, `qty`, `selisih`, `status_persetujuanatasan`, `status_persetujuanadmin`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '1', '0', NULL, '2024-02-26 09:29:41', '2024-02-27 03:04:49'),
(2, 2, 1, 1, 0, '0', NULL, NULL, '2024-02-27 03:32:21', NULL),
(3, 3, 6, 2, 0, '0', NULL, NULL, '2024-02-28 03:51:37', NULL),
(4, 3, 5, 2, 0, '0', NULL, NULL, '2024-02-28 03:51:37', NULL),
(5, 3, 4, 2, 0, '0', NULL, NULL, '2024-02-28 03:51:37', NULL),
(6, 3, 7, 2, 0, '0', NULL, NULL, '2024-02-28 03:51:37', NULL),
(7, 4, 5, 2, 0, '1', NULL, NULL, '2024-02-28 04:25:04', '2024-02-29 02:51:06'),
(8, 4, 4, 2, 0, '3', NULL, 'tidak usah, karena sudah ada yang lama', '2024-02-28 04:25:04', '2024-03-01 03:41:54'),
(9, 4, 6, 1, 0, '1', NULL, NULL, '2024-02-28 04:25:04', '2024-02-28 04:34:15'),
(10, 4, 7, 1, 0, '1', NULL, NULL, '2024-02-28 04:25:04', '2024-02-28 04:34:15'),
(12, 5, 2, 1, 0, '0', NULL, NULL, '2024-03-02 03:02:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_transaksi_pengadaan_barangs`
--

CREATE TABLE `item_transaksi_pengadaan_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `pengadaan_barang_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `code_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `id` bigint UNSIGNED NOT NULL,
  `jenisbarang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`id`, `jenisbarang`, `created_at`, `updated_at`) VALUES
(1, 'Transportasi', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(2, 'Alat Berat', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(3, 'Kelas', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(4, 'Aset Staff', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(5, 'Alat Bersih', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(6, 'Elektronik', '2024-02-26 09:10:14', '2024-02-26 09:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_10_21_113838_create_data_unit_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2023_08_30_073816_create_jenisbarang_table', 1),
(6, '2023_08_31_233114_create_satuans_table', 1),
(7, '2023_09_02_075359_create_databarangs_table', 1),
(8, '2023_09_06_121526_create_suppliers_table', 1),
(9, '2023_09_06_122303_create_barangmasuks_table', 1),
(10, '2023_09_06_143004_create_item_barang_masuks_table', 1),
(11, '2023_09_14_013051_add_new_column_last_seen', 1),
(12, '2023_09_18_091044_create_datapengajus_table', 1),
(13, '2023_09_21_110358_create_item_data_pengajus_table', 1),
(14, '2023_11_11_152242_create_data_aset_units_table', 1),
(15, '2023_11_11_152338_create_item_data_aset_units_table', 1),
(16, '2023_11_14_103919_create_history_stok_barangs_table', 1),
(17, '2023_11_21_095406_create_item_data_pengadaan_barangs_table', 1),
(18, '2023_11_24_102054_create_transaksi_pengadaan_barangs_table', 1),
(19, '2023_11_25_121723_create_item_transaksi_pengadaan_barangs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuans`
--

CREATE TABLE `satuans` (
  `id` bigint UNSIGNED NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuans`
--

INSERT INTO `satuans` (`id`, `satuan`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Unit', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(2, 'Box', 24, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(3, 'Pcs', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(4, 'Kg', 7, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(5, 'Buah', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(6, 'Roll', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(7, 'Set', 12, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(8, 'Botol', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(9, 'Batang', 1, '2024-02-26 09:10:14', '2024-02-26 09:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Toko Gajah Terbang', 'Jalan Satelit Sumenep', '085234769810', '2024-02-26 09:10:14', '2024-02-26 09:10:14'),
(2, 'Toko Wijaya Abadi', 'Jalan Manalagi Mangga', '087432109876', '2024-02-26 09:10:14', '2024-02-26 09:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pengadaan_barangs`
--

CREATE TABLE `transaksi_pengadaan_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_transaksi` enum('0','1','2','3','4','5') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status_pengajuan` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_unit` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_unit` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_unit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `kode_unit`, `nama_unit`, `lokasi_unit`, `status_unit`, `created_at`, `updated_at`) VALUES
(1, '001', 'BAU-IT', 'G. Kapanjin', 1, '2024-02-26 09:10:13', '2024-02-28 04:07:22'),
(2, '002', 'BAUK', 'G. Campaka', 1, '2024-02-28 04:06:18', '2024-02-28 04:06:18'),
(3, '003', 'Perustakaan', 'G. Campaka', 1, '2024-02-28 04:08:11', '2024-02-28 04:08:11'),
(4, '004', 'Arsinum', 'G. Arsinum', 1, '2024-02-28 04:14:50', '2024-02-28 04:14:50'),
(5, '005', 'Laboratorium Komputer', 'G. Campaka', 1, '2024-02-28 04:16:39', '2024-02-28 04:16:39'),
(6, '006', 'Laboratorium Manufaktur', 'G. Campaka', 1, '2024-02-28 04:17:09', '2024-02-28 04:17:28'),
(7, '007', 'Radio UNIBA MADURA', 'G. Kapanjin', 1, '2024-02-28 04:18:25', '2024-02-28 04:18:25'),
(8, '008', 'IT', 'G. Kapanjin', 1, '2024-02-28 04:19:24', '2024-02-28 04:19:24'),
(9, '009', 'Akademik', 'G. Campaka', 1, '2024-02-28 04:19:46', '2024-02-28 04:19:46'),
(10, '010', 'Keuangan', 'G. Campaka', 1, '2024-02-28 04:20:01', '2024-02-28 04:20:01'),
(11, '011', 'Kadep', 'G. Campaka', 1, '2024-02-28 04:20:35', '2024-02-28 04:20:35'),
(12, '012', 'Dekan', 'G. Campaka', 1, '2024-02-28 04:20:49', '2024-02-28 04:20:49'),
(13, '013', 'Rektorat', 'G. Campaka', 1, '2024-02-28 04:21:10', '2024-02-28 04:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('administrator','admingudang','kepalagudang','atasan','pengaju','keuangan','rektor') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admingudang',
  `unit_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `unit_id`, `password`, `remember_token`, `created_at`, `updated_at`, `last_seen`) VALUES
(1, 'Administrator', 'administrator@gmail.com', NULL, 'administrator', 1, '$2y$10$GYjVNGfcm.f1ho7/n3uoyOfeXPw8TMvJIiC9LLu5C4UNU4mvd8SFe', NULL, '2024-02-26 09:10:14', '2024-03-19 03:03:35', '2024-03-19 03:03:35'),
(2, 'Admin Gudang', 'admingudang@gmail.com', NULL, 'admingudang', 1, '$2y$10$csHWxhzd/8uSE.hWEeAMweZljfTSwrqMkF8CAYSvUvc.lyesy/3Qy', NULL, '2024-02-26 09:10:14', '2024-02-26 09:10:14', NULL),
(3, 'Kepala Gudang', 'kepalagudang@gmail.com', NULL, 'kepalagudang', 1, '$2y$10$hdNa.i2Lrjm5ZYv2OUyhbe2YSaG4mKrK96d/NshM1nTuI.5/gnf8m', NULL, '2024-02-26 09:10:14', '2024-02-26 09:10:14', NULL),
(4, 'Pengaju', 'pengaju@gmail.com', NULL, 'pengaju', 1, '$2y$10$YGKZtwogUTUmQAOpephryu6franb3INv4.0hx8/SQhwT.Ihnh5oo6', NULL, '2024-02-26 09:10:14', '2024-03-19 03:20:29', '2024-03-19 03:20:29'),
(5, 'Berly Akmam Basyaz', 'berlianalovely@gmail.com', NULL, 'atasan', 1, '$2y$10$cE/5f0bOcxQj.nUahhkWYex8oq//Qd4LIQehA97NKRs10g7L.p0WS', NULL, '2024-02-26 09:10:14', '2024-03-16 02:28:17', '2024-03-16 02:28:17'),
(6, 'Keuangan', 'keuangan@gmail.com', NULL, 'keuangan', 1, '$2y$10$bXRgM3uhRidvzysZ5Q2tLOroA7X69nnXybaGMQTVNxkRNrobSmbpa', NULL, '2024-02-26 09:10:14', '2024-02-26 09:10:14', NULL),
(7, 'rektor', 'rektor@gmail.com', NULL, 'rektor', 1, '$2y$10$uVkE4SqbT0T5bhRfvbTFh.ji0m8IZm4lMhiH8wBm646wbp2hzzNs2', NULL, '2024-02-26 09:10:14', '2024-02-26 09:10:14', NULL),
(8, 'Andy Yulianto', 'andyyulianto@gmail.com', NULL, 'pengaju', 1, '$2y$10$u7aczMQQyPqQobQwsMrKJeQpP7zJc92Uqz7Yv/Ara2S3FXtZkSXdm', NULL, '2024-02-28 04:23:13', '2024-03-14 06:20:10', '2024-03-14 06:20:10'),
(9, 'raga', 'raga@gmail.com', NULL, 'pengaju', 2, '$2y$10$j..fBMZ3TjnoLhewPQtFHOpOplu6VI81GyQzvD8VFwg6fYYsTiVs6', NULL, '2024-03-02 03:01:20', '2024-03-02 05:27:22', '2024-03-02 05:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangmasuks_kode_nota_unique` (`kode_nota`),
  ADD KEY `barangmasuks_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `barang_lainnyas`
--
ALTER TABLE `barang_lainnyas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_lainnyas_data_pengaju_id_foreign` (`data_pengaju_id`),
  ADD KEY `barang_lainnyas_jenis_id_foreign` (`jenis_id`);

--
-- Indexes for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `databarangs_jenis_id_foreign` (`jenis_id`),
  ADD KEY `databarangs_satuan_id_foreign` (`satuan_id`);

--
-- Indexes for table `datapengajus`
--
ALTER TABLE `datapengajus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `datapengajus_code_pengajuan_unique` (`code_pengajuan`),
  ADD KEY `datapengajus_user_id_foreign` (`user_id`);

--
-- Indexes for table `data_aset_units`
--
ALTER TABLE `data_aset_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_aset_units_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `data_aset_units_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_stok_barangs`
--
ALTER TABLE `history_stok_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_barang_masuks`
--
ALTER TABLE `item_barang_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_barang_masuks_barangmasuk_id_foreign` (`barangmasuk_id`),
  ADD KEY `item_barang_masuks_user_id_foreign` (`user_id`),
  ADD KEY `item_barang_masuks_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `item_data_aset_units`
--
ALTER TABLE `item_data_aset_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_data_aset_units_dataasetunit_id_foreign` (`dataasetunit_id`),
  ADD KEY `item_data_aset_units_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `item_data_pengadaan_barangs`
--
ALTER TABLE `item_data_pengadaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_data_pengadaan_barangs_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `item_data_pengajus`
--
ALTER TABLE `item_data_pengajus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_data_pengajus_datapengaju_id_foreign` (`datapengaju_id`),
  ADD KEY `item_data_pengajus_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `item_transaksi_pengadaan_barangs`
--
ALTER TABLE `item_transaksi_pengadaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_transaksi_pengadaan_barangs_pengadaan_barang_id_foreign` (`pengadaan_barang_id`),
  ADD KEY `item_transaksi_pengadaan_barangs_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `satuans`
--
ALTER TABLE `satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_pengadaan_barangs`
--
ALTER TABLE `transaksi_pengadaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_pengadaan_barangs_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksi_pengadaan_barangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_unit_id_foreign` (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_lainnyas`
--
ALTER TABLE `barang_lainnyas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databarangs`
--
ALTER TABLE `databarangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `datapengajus`
--
ALTER TABLE `datapengajus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_aset_units`
--
ALTER TABLE `data_aset_units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_stok_barangs`
--
ALTER TABLE `history_stok_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_barang_masuks`
--
ALTER TABLE `item_barang_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_data_aset_units`
--
ALTER TABLE `item_data_aset_units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_data_pengadaan_barangs`
--
ALTER TABLE `item_data_pengadaan_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_data_pengajus`
--
ALTER TABLE `item_data_pengajus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_transaksi_pengadaan_barangs`
--
ALTER TABLE `item_transaksi_pengadaan_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `satuans`
--
ALTER TABLE `satuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_pengadaan_barangs`
--
ALTER TABLE `transaksi_pengadaan_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangmasuks`
--
ALTER TABLE `barangmasuks`
  ADD CONSTRAINT `barangmasuks_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `barang_lainnyas`
--
ALTER TABLE `barang_lainnyas`
  ADD CONSTRAINT `barang_lainnyas_data_pengaju_id_foreign` FOREIGN KEY (`data_pengaju_id`) REFERENCES `datapengajus` (`id`),
  ADD CONSTRAINT `barang_lainnyas_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenisbarang` (`id`);

--
-- Constraints for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD CONSTRAINT `databarangs_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenisbarang` (`id`),
  ADD CONSTRAINT `databarangs_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `satuans` (`id`);

--
-- Constraints for table `datapengajus`
--
ALTER TABLE `datapengajus`
  ADD CONSTRAINT `datapengajus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `data_aset_units`
--
ALTER TABLE `data_aset_units`
  ADD CONSTRAINT `data_aset_units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_barang_masuks`
--
ALTER TABLE `item_barang_masuks`
  ADD CONSTRAINT `item_barang_masuks_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `databarangs` (`id`),
  ADD CONSTRAINT `item_barang_masuks_barangmasuk_id_foreign` FOREIGN KEY (`barangmasuk_id`) REFERENCES `barangmasuks` (`id`),
  ADD CONSTRAINT `item_barang_masuks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_data_aset_units`
--
ALTER TABLE `item_data_aset_units`
  ADD CONSTRAINT `item_data_aset_units_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `databarangs` (`id`),
  ADD CONSTRAINT `item_data_aset_units_dataasetunit_id_foreign` FOREIGN KEY (`dataasetunit_id`) REFERENCES `data_aset_units` (`id`);

--
-- Constraints for table `item_data_pengadaan_barangs`
--
ALTER TABLE `item_data_pengadaan_barangs`
  ADD CONSTRAINT `item_data_pengadaan_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `databarangs` (`id`);

--
-- Constraints for table `item_data_pengajus`
--
ALTER TABLE `item_data_pengajus`
  ADD CONSTRAINT `item_data_pengajus_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `databarangs` (`id`),
  ADD CONSTRAINT `item_data_pengajus_datapengaju_id_foreign` FOREIGN KEY (`datapengaju_id`) REFERENCES `datapengajus` (`id`);

--
-- Constraints for table `item_transaksi_pengadaan_barangs`
--
ALTER TABLE `item_transaksi_pengadaan_barangs`
  ADD CONSTRAINT `item_transaksi_pengadaan_barangs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `databarangs` (`id`),
  ADD CONSTRAINT `item_transaksi_pengadaan_barangs_pengadaan_barang_id_foreign` FOREIGN KEY (`pengadaan_barang_id`) REFERENCES `transaksi_pengadaan_barangs` (`id`);

--
-- Constraints for table `transaksi_pengadaan_barangs`
--
ALTER TABLE `transaksi_pengadaan_barangs`
  ADD CONSTRAINT `transaksi_pengadaan_barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
