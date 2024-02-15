-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2023 pada 04.37
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_peminjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuks`
--

CREATE TABLE `barangmasuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `ppn_angka` double DEFAULT 0,
  `ppn_persen` double DEFAULT 0,
  `diskon_angka` double DEFAULT 0,
  `diskon_persen` double DEFAULT 0,
  `total_bayar` double DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangmasuks`
--

INSERT INTO `barangmasuks` (`id`, `kode_nota`, `tanggal_pembelian`, `supplier_id`, `ppn_angka`, `ppn_persen`, `diskon_angka`, `diskon_persen`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, '00001', '2023-11-30', 1, NULL, 11, 50000, NULL, 1726000, '2023-11-30 04:27:50', '2023-11-30 04:27:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `databarangs`
--

CREATE TABLE `databarangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL,
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `databarangs`
--

INSERT INTO `databarangs` (`id`, `code_barang`, `nama_barang`, `jenis_id`, `stok`, `satuan_id`, `harga`, `created_at`, `updated_at`) VALUES
(1, '6847484745772', 'Kursi', 3, 28, 1, 500000, '2023-11-30 01:24:58', '2023-11-30 01:37:25'),
(2, '1614539859617', 'Proyektor', 3, 31, 3, 2100000, '2023-11-30 01:38:28', '2023-11-30 01:38:28'),
(3, '3166928304213', 'Keyboard', 3, 26, 3, 100000, '2023-11-30 01:39:33', '2023-11-30 01:39:33'),
(4, '5083560203346', 'Papan', 3, 30, 1, 120000, '2023-11-30 01:40:28', '2023-11-30 01:56:03'),
(5, '8531125937265', 'Jam', 4, 22, 3, 30000, '2023-11-30 01:41:41', '2023-11-30 01:56:03'),
(6, '9497873387220', 'Komputer', 3, 32, 1, 1600000, '2023-11-30 01:42:45', '2023-11-30 01:42:45'),
(7, '3704371759803', 'Buku', 4, 28, 5, 25000, '2023-11-30 01:43:55', '2023-11-30 01:43:55'),
(8, '6472631967228', 'Bulpen', 3, 32, 7, 3500, '2023-11-30 01:45:11', '2023-11-30 01:45:11'),
(9, '4342337379835', 'Spidol Snowman', 3, 27, 5, 7000, '2023-11-30 01:46:43', '2023-11-30 01:46:43'),
(10, '2524338835255', 'Sapu', 3, 25, 3, 15000, '2023-11-30 01:47:51', '2023-11-30 01:47:51'),
(11, '7898755836731', 'Kabel Proyektor', 4, 0, 3, 550000, '2023-11-30 01:49:14', '2023-11-30 02:03:02'),
(12, '5639347716679', 'HT', 4, 16, 3, 100000, '2023-11-30 01:50:19', '2023-11-30 04:27:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapengajus`
--

CREATE TABLE `datapengajus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_pengajuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_setujuatasan` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status_setujuadmin` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_pengajuan` tinyint(1) NOT NULL DEFAULT 0,
  `status_submit` tinyint(1) DEFAULT NULL,
  `upload_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `datapengajus`
--

INSERT INTO `datapengajus` (`id`, `code_pengajuan`, `tgl_pengajuan`, `user_id`, `status_setujuatasan`, `status_setujuadmin`, `status_pengajuan`, `status_submit`, `upload_dokumen`, `created_at`, `updated_at`) VALUES
(1, '2311300000001', '2023-11-16', 4, '3', '3', 1, 1, 'public/berkas/sd4LUrVKdtmO7xpPfAnu2X9mIO6Jw8Pe4X6qI1FA.pdf', '2023-11-30 01:52:35', '2023-11-30 01:56:03'),
(2, '2311300000002', '2023-11-30', 4, '3', '3', 1, 1, 'public/berkas/NYQbWetpMRZkJoRfTHPEGUx2SkreZlkcSeREwmaO.pdf', '2023-11-30 02:01:05', '2023-11-30 02:03:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_aset_units`
--

CREATE TABLE `data_aset_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `yang_menyerahkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_dokumen_serahterima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_aset_units`
--

INSERT INTO `data_aset_units` (`id`, `kode_transaksi`, `tgl_transaksi`, `user_id`, `yang_menyerahkan`, `upload_dokumen_serahterima`, `status`, `created_at`, `updated_at`) VALUES
(1, '2311300000001', '2023-11-16', 4, 'Administrator', NULL, NULL, '2023-11-30 01:56:52', '2023-11-30 01:56:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_stok_barangs`
--

CREATE TABLE `history_stok_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `databarang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barangmasuk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `itemdatapengaju_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `history_stok_barangs`
--

INSERT INTO `history_stok_barangs` (`id`, `databarang_id`, `barangmasuk_id`, `itemdatapengaju_id`, `qty`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 12, 'Insert Data Barang', '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(2, 2, NULL, NULL, 31, 'Insert Data Barang', '2023-11-30 01:38:28', '2023-11-30 01:38:28'),
(3, 3, NULL, NULL, 26, 'Insert Data Barang', '2023-11-30 01:39:33', '2023-11-30 01:39:33'),
(4, 4, NULL, NULL, 32, 'Insert Data Barang', '2023-11-30 01:40:28', '2023-11-30 01:40:28'),
(5, 5, NULL, NULL, 23, 'Insert Data Barang', '2023-11-30 01:41:41', '2023-11-30 01:41:41'),
(6, 6, NULL, NULL, 32, 'Insert Data Barang', '2023-11-30 01:42:45', '2023-11-30 01:42:45'),
(7, 7, NULL, NULL, 28, 'Insert Data Barang', '2023-11-30 01:43:55', '2023-11-30 01:43:55'),
(8, 8, NULL, NULL, 32, 'Insert Data Barang', '2023-11-30 01:45:11', '2023-11-30 01:45:11'),
(9, 9, NULL, NULL, 27, 'Insert Data Barang', '2023-11-30 01:46:43', '2023-11-30 01:46:43'),
(10, 10, NULL, NULL, 25, 'Insert Data Barang', '2023-11-30 01:47:51', '2023-11-30 01:47:51'),
(11, 11, NULL, NULL, 12, 'Insert Data Barang', '2023-11-30 01:49:14', '2023-11-30 01:49:14'),
(12, 12, NULL, NULL, 15, 'Insert Data Barang', '2023-11-30 01:50:19', '2023-11-30 01:50:19'),
(13, 4, NULL, 1, 2, 'Barang Dipinjam', '2023-11-30 01:56:03', '2023-11-30 01:56:03'),
(14, 5, NULL, 2, 1, 'Barang Dipinjam', '2023-11-30 01:56:03', '2023-11-30 01:56:03'),
(15, 11, NULL, 3, 13, 'Barang Dipinjam', '2023-11-30 02:03:02', '2023-11-30 02:03:02'),
(16, 12, NULL, 4, 16, 'Barang Dipinjam', '2023-11-30 02:03:02', '2023-11-30 02:03:02'),
(17, 12, 1, NULL, 16, 'Barang Masuk', '2023-11-30 04:27:50', '2023-11-30 04:27:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_barang_masuks`
--

CREATE TABLE `item_barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barangmasuk_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_barang_masuks`
--

INSERT INTO `item_barang_masuks` (`id`, `barangmasuk_id`, `user_id`, `barang_id`, `qty`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, 16, 100000, 1600000, '2023-11-30 04:27:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_data_aset_units`
--

CREATE TABLE `item_data_aset_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dataasetunit_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `kondisi_barang` enum('1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_data_aset_units`
--

INSERT INTO `item_data_aset_units` (`id`, `dataasetunit_id`, `barang_id`, `qty`, `kondisi_barang`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, '2', '2023-11-30 01:56:52', '2023-11-30 01:57:43'),
(2, 1, 5, 1, '2', '2023-11-30 01:56:52', '2023-11-30 01:57:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_data_pengadaan_barangs`
--

CREATE TABLE `item_data_pengadaan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_data_pengadaan_barangs`
--

INSERT INTO `item_data_pengadaan_barangs` (`id`, `barang_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 13, 0, '2023-11-30 02:03:43', '2023-12-05 02:33:50'),
(2, 12, 16, 0, '2023-11-29 02:03:43', '2023-12-05 02:33:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_data_pengajus`
--

CREATE TABLE `item_data_pengajus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datapengaju_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `selisih` int(11) DEFAULT NULL,
  `status_persetujuanatasan` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_persetujuanadmin` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_data_pengajus`
--

INSERT INTO `item_data_pengajus` (`id`, `datapengaju_id`, `barang_id`, `qty`, `selisih`, `status_persetujuanatasan`, `status_persetujuanadmin`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, 0, '1', '0', NULL, '2023-11-30 01:52:35', '2023-11-30 01:56:03'),
(2, 1, 5, 1, 0, '1', '0', NULL, '2023-11-30 01:52:35', '2023-11-30 01:56:03'),
(3, 2, 11, 13, -1, '1', '1', NULL, '2023-11-30 02:01:05', '2023-11-30 02:03:02'),
(4, 2, 12, 16, -1, '1', '1', NULL, '2023-11-30 02:01:05', '2023-11-30 02:03:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_transaksi_pengadaan_barangs`
--

CREATE TABLE `item_transaksi_pengadaan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksipengadaanbarang_id` bigint(20) NOT NULL,
  `barang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_transaksi_pengadaan_barangs`
--

INSERT INTO `item_transaksi_pengadaan_barangs` (`id`, `transaksipengadaanbarang_id`, `barang_id`, `code_barang`, `nama_barang`, `satuan`, `harga`, `qty`, `created_at`, `updated_at`) VALUES
(34, 31, 12, '5639347716679', 'HT', 'Pcs', 100000, 16, '2023-12-05 02:33:50', NULL),
(35, 31, 11, '7898755836731', 'Kabel Proyektor', 'Pcs', 550000, 13, '2023-12-05 02:33:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenisbarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenisbarang`
--

INSERT INTO `jenisbarang` (`id`, `jenisbarang`, `created_at`, `updated_at`) VALUES
(1, 'Transportasi', '2023-11-30 01:24:57', '2023-11-30 01:24:57'),
(2, 'Alat Berat', '2023-11-30 01:24:57', '2023-11-30 01:24:57'),
(3, 'Kelas', '2023-11-30 01:24:57', '2023-11-30 01:24:57'),
(4, 'Aset Staff', '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(5, 'Alat Bersih', '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(6, 'Elektronik', '2023-11-30 01:24:58', '2023-11-30 01:24:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuans`
--

CREATE TABLE `satuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `satuans`
--

INSERT INTO `satuans` (`id`, `satuan`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Unit', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(2, 'Box', 24, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(3, 'Pcs', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(4, 'Kg', 7, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(5, 'Buah', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(6, 'Roll', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(7, 'Set', 12, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(8, 'Botol', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(9, 'Batang', 1, '2023-11-30 01:24:58', '2023-11-30 01:24:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Toko Gajah Terbang', 'Jalan Satelit Sumenep', '085234769810', '2023-11-30 01:24:58', '2023-11-30 01:24:58'),
(2, 'Toko Wijaya Abadi', 'Jalan Manalagi Mangga', '087432109876', '2023-11-30 01:24:58', '2023-11-30 01:24:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengadaan_barangs`
--

CREATE TABLE `transaksi_pengadaan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_transaksi` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status_pengajuan` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_pengadaan_barangs`
--

INSERT INTO `transaksi_pengadaan_barangs` (`id`, `kode_transaksi`, `nama_transaksi`, `tgl_transaksi`, `user_id`, `status_transaksi`, `status_pengajuan`, `created_at`, `updated_at`) VALUES
(29, 'TRPB2312040000001', 'Acara Sosialisasi PMB', '2023-12-04', 1, '1', 0, '2023-12-03 23:50:14', NULL),
(31, 'TRPB2312050000002', 'Acara Wisuda Ke-2', '2023-12-05', 1, '1', 0, '2023-12-05 02:33:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_unit` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_unit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_unit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`id`, `kode_unit`, `nama_unit`, `lokasi_unit`, `status_unit`, `created_at`, `updated_at`) VALUES
(1, '001', 'IT', 'Gedung Campaka', 1, '2023-11-30 01:24:57', '2023-11-30 01:31:18'),
(2, '002', 'PMB', 'Gedung Campaka', 1, '2023-11-30 01:31:38', '2023-11-30 01:31:38'),
(3, '003', 'Security', 'Gedung Campaka', 1, '2023-11-30 01:32:04', '2023-11-30 01:32:04'),
(4, '004', 'Keuangan', 'Gedung Campaka', 1, '2023-11-30 01:32:32', '2023-11-30 01:32:32'),
(5, '005', 'Rektor', 'Gedung Campaka', 1, '2023-11-30 01:32:58', '2023-11-30 01:32:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('administrator','admingudang','kepalagudang','atasan','pengaju','keuangan','rektor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admingudang',
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `unit_id`, `password`, `remember_token`, `created_at`, `updated_at`, `last_seen`) VALUES
(1, 'Administrator', 'administrator@gmail.com', NULL, 'administrator', 1, '$2y$10$GtxjaYMg03RQxm9XLhlCfe2zI3gATgOOo4yPfwIi0gOQith8JaPVi', NULL, '2023-11-30 01:24:57', '2023-12-05 02:33:55', '2023-12-05 02:33:55'),
(2, 'Admin Gudang', 'admingudang@gmail.com', NULL, 'admingudang', 1, '$2y$10$nnYKGaaiYpGRIdgDx/z57eA5l20j.uhNjqDYU7xZBhVI/JXa320Zq', NULL, '2023-11-30 01:24:57', '2023-11-30 01:24:57', NULL),
(3, 'Kepala Gudang', 'kepalagudang@gmail.com', NULL, 'kepalagudang', 1, '$2y$10$6VkifoAIGD4BBDLXvKcFOelCRVDTeBvczf0PhwOtiHUl0rnfjOByK', NULL, '2023-11-30 01:24:57', '2023-11-30 01:24:57', NULL),
(4, 'Pengaju', 'pengaju@gmail.com', NULL, 'pengaju', 3, '$2y$10$Hn5OVJ.OdfBDJnCHXRRH2ulJPKM32cFVjGp.zJQ1i.Qzq1gfmRupy', NULL, '2023-11-30 01:24:57', '2023-11-30 02:02:21', '2023-11-30 02:02:21'),
(5, 'Atasan', 'atasan@gmail.com', NULL, 'atasan', 1, '$2y$10$2wSFOJiBouL8UDEd2T1OROjqXt75.Q3UsM86UrT0FHQjxEOvMFHue', NULL, '2023-11-30 01:24:57', '2023-11-30 02:01:35', '2023-11-30 02:01:35'),
(6, 'Keuangan', 'keuangan@gmail.com', NULL, 'keuangan', 4, '$2y$10$bJpinZ9lpQArmnqgXejnB.omi89wCpq05Pez0ruUrgb8lOQLF3.RW', NULL, '2023-11-30 01:24:57', '2023-11-30 01:34:35', NULL),
(7, 'rektor', 'rektor@gmail.com', NULL, 'rektor', 5, '$2y$10$XkWT9csAZMSZ/.1XkJoK../IlCvjKAo0Hmw6Nsmz3j2T4lAKU56Q.', NULL, '2023-11-30 01:24:57', '2023-11-30 01:34:59', NULL),
(8, 'Pengaju dua', 'pengajudua@gmail.com', NULL, 'pengaju', 3, '$2y$10$lMn9uFJwx/C/lrNPz163Y.ZoRYYMYIlVBtlzVd/YhCrX1zO1egCba', NULL, '2023-11-30 01:35:43', '2023-11-30 01:35:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangmasuks`
--
ALTER TABLE `barangmasuks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangmasuks_kode_nota_unique` (`kode_nota`);

--
-- Indeks untuk tabel `databarangs`
--
ALTER TABLE `databarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datapengajus`
--
ALTER TABLE `datapengajus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `datapengajus_code_pengajuan_unique` (`code_pengajuan`);

--
-- Indeks untuk tabel `data_aset_units`
--
ALTER TABLE `data_aset_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_aset_units_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `history_stok_barangs`
--
ALTER TABLE `history_stok_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_barang_masuks`
--
ALTER TABLE `item_barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_data_aset_units`
--
ALTER TABLE `item_data_aset_units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_data_pengadaan_barangs`
--
ALTER TABLE `item_data_pengadaan_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_data_pengajus`
--
ALTER TABLE `item_data_pengajus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_transaksi_pengadaan_barangs`
--
ALTER TABLE `item_transaksi_pengadaan_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `satuans`
--
ALTER TABLE `satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_pengadaan_barangs`
--
ALTER TABLE `transaksi_pengadaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_pengadaan_barangs_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangmasuks`
--
ALTER TABLE `barangmasuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `databarangs`
--
ALTER TABLE `databarangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `datapengajus`
--
ALTER TABLE `datapengajus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_aset_units`
--
ALTER TABLE `data_aset_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `history_stok_barangs`
--
ALTER TABLE `history_stok_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `item_barang_masuks`
--
ALTER TABLE `item_barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `item_data_aset_units`
--
ALTER TABLE `item_data_aset_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `item_data_pengadaan_barangs`
--
ALTER TABLE `item_data_pengadaan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `item_data_pengajus`
--
ALTER TABLE `item_data_pengajus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `item_transaksi_pengadaan_barangs`
--
ALTER TABLE `item_transaksi_pengadaan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `jenisbarang`
--
ALTER TABLE `jenisbarang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `satuans`
--
ALTER TABLE `satuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengadaan_barangs`
--
ALTER TABLE `transaksi_pengadaan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
