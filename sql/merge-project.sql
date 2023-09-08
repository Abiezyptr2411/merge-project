-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 11:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merge-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lokasi_kerja` text NOT NULL,
  `shift_line` varchar(128) NOT NULL,
  `aktivitas` text NOT NULL,
  `kondisi_kesehatan` varchar(128) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` varchar(100) NOT NULL,
  `estimated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `user_id`, `lokasi_kerja`, `shift_line`, `aktivitas`, `kondisi_kesehatan`, `waktu`, `keterangan`, `estimated`) VALUES
(6, 2, 'Latitude: -6.2114, Longitude: 106.8446', '09.00 - 18.00', 'Controlling', 'SEHAT', '2023-09-06 04:44:28', 'masuk', '2023-09-06'),
(7, 2, 'Latitude: -6.2114, Longitude: 106.8446', '09.00 - 18.00', 'controll', 'SEHAT', '2023-09-06 04:42:00', 'pulang', '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nama_brg` varchar(225) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `kondisi` text NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `id_kategori`, `id_unit`, `nama_brg`, `harga`, `kondisi`, `stok`, `created_at`) VALUES
('1251CIOFD', 2, 1, 'HP Pavillion 14 Gen-12th Core i7', '16000000', 'Baik', 10, '2023-09-08 09:16:49'),
('1287CIRSD', 2, 1, 'HP Pavillion 13 Aero Rayzen 7', '15000000', 'Baik', 10, '2023-09-08 09:17:11'),
('4190QZMCY', 2, 1, 'Printer Epson Gen II', '8000000', 'Baik', 5, '2023-09-08 09:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `invoice_number` char(20) NOT NULL,
  `id_brg` varchar(30) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('success','failed','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `invoice_number`, `id_brg`, `id_karyawan`, `jumlah`, `status`, `created_at`) VALUES
(9, 'STCK2023-001', '1251CIOFD', 'B019181', 5, 'success', '2023-09-08 09:16:49'),
(10, 'STCK2023-002', '1287CIRSD', 'B019187', 5, 'success', '2023-09-08 09:17:11');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `stock_out` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
   UPDATE barang SET stok = stok-NEW.jumlah
   WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `invoice_number` char(20) NOT NULL,
  `id_brg` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('success','failed','','') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `invoice_number`, `id_brg`, `jumlah`, `status`, `created_at`) VALUES
(31, 'STCM2023-001', '1251CIOFD', 10, 'success', '2023-09-08 09:14:07'),
(32, 'STCM2023-002', '1287CIRSD', 10, 'success', '2023-09-08 09:14:15'),
(33, 'STCM2023-003', '4190QZMCY', 5, 'success', '2023-09-08 09:14:21'),
(35, 'STCM2023-004', '1251CIOFD', 5, 'success', '2023-09-08 09:15:29'),
(36, 'STCM2023-005', '1287CIRSD', 5, 'success', '2023-09-08 09:16:14');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `stock_in` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
   UPDATE barang SET stok = stok+NEW.jumlah
   WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `nama_departement` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_departement`, `nama_departement`) VALUES
(1, 'Analytics Marketing'),
(2, 'Accounting'),
(3, 'General'),
(4, 'Huma Resources'),
(5, 'Software Development');

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kategori_izin` varchar(128) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `keterangan` text NOT NULL,
  `bukti` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_izin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`id_izin`, `user_id`, `kategori_izin`, `tgl_awal`, `tgl_akhir`, `keterangan`, `bukti`, `created_at`, `status_izin`) VALUES
(1, 2, 'Sakit', '2023-09-05', '2023-09-06', 'Sakit Demam', 'Readme.pdf', '2023-09-06 11:54:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(128) DEFAULT NULL,
  `gaji_pokok` varchar(100) DEFAULT NULL,
  `tunjangan_jabatan` varchar(100) DEFAULT NULL,
  `tunjangan_makan` varchar(100) DEFAULT NULL,
  `tunjangan_aktifitas` varchar(100) DEFAULT NULL,
  `tipe_pajak` varchar(128) DEFAULT NULL,
  `nominal_pajak` varchar(100) DEFAULT NULL,
  `bpjs` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tunjangan_jabatan`, `tunjangan_makan`, `tunjangan_aktifitas`, `tipe_pajak`, `nominal_pajak`, `bpjs`, `created_at`) VALUES
(1, 'Direktur', '10000000', '2000000', NULL, NULL, 'PPH 23', NULL, NULL, '2023-09-06 03:41:55'),
(2, 'Manager', '8000000', '1000000', NULL, NULL, 'PPH 23', NULL, NULL, '2023-09-06 03:42:06'),
(3, 'Supervisi', '7000000', '800000', NULL, NULL, 'PPH 23', NULL, NULL, '2023-09-06 03:42:29'),
(6, 'Staff', '6000000', '780000', NULL, NULL, 'PPH 23', NULL, NULL, '2023-09-06 03:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_karyawan` varchar(225) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `tgl_kontrak` date NOT NULL,
  `tgl_kontrak_berakhir` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `user_id`, `nama_karyawan`, `id_jabatan`, `id_departement`, `nik`, `no_kk`, `alamat`, `no_telp`, `bio`, `no_kontrak`, `tgl_kontrak`, `tgl_kontrak_berakhir`, `created_at`) VALUES
('B019181', 4, 'Andini Aisyah', 3, 3, '36756567889700001', '36756567889700008', 'Jl. Babelan Raya, No. 19 - Kec. Bekasi', NULL, NULL, '1710217893', '2022-01-01', '2023-02-01', '2023-09-04 12:45:17'),
('B019187', 2, 'Afrizal Harahap', 1, 1, '3674051211990001', '3674051211990003', 'Jl. Kebagusan Raya, No. 197 - Lebak Bulus', '085214543229', 'My job is to build your website so that it is functional and user-friendly but at the same time attractive. Moreover, I add personal touch to your product and make sure that is eye-catching and easy to use. My aim is to bring across your message and identity in the most creative way. I created web design for many famous brand companies.', '1710217891', '2021-01-01', '2023-09-29', '2023-09-06 16:20:09'),
('B019188', 3, 'Sukma Jayanti', 2, 2, '36756567889700001', '36756567889700008', 'Jl. Babelan Raya, No. 19 - Kec. Bekasi', NULL, NULL, '1710217892', '2023-01-01', '2023-06-01', '2023-09-03 07:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'ATK'),
(2, 'Main Asset'),
(3, 'P3K');

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `id_lembur` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal_lembur` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `pekerjaan` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `statement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`id_lembur`, `user_id`, `tanggal_lembur`, `jam_mulai`, `jam_akhir`, `pekerjaan`, `lampiran`, `statement`) VALUES
(3, 2, '2023-09-03', '19:00:00', '22:00:00', 'Fix issue', NULL, 0),
(5, 2, '2023-09-05', '20:00:00', '23:00:00', 'Fix bugs', NULL, 0),
(6, 3, '2023-09-05', '17:00:00', '19:00:00', 'Rerun dashboard', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id_pembayaran` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_karyawan` varchar(30) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `tanggal_penggajian` date NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `gaji_pokok` varchar(128) DEFAULT NULL,
  `upah_lembur` varchar(128) DEFAULT NULL,
  `tunjangan_aktivitas` varchar(128) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tunjangan_jabatan` varchar(128) DEFAULT NULL,
  `tunjangan_makan` varchar(128) DEFAULT NULL,
  `pph23` varchar(128) DEFAULT NULL,
  `bpjs` varchar(128) DEFAULT NULL,
  `pinjaman` varchar(128) DEFAULT NULL,
  `thp` varchar(128) DEFAULT NULL,
  `keterangan_pembayaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id_pembayaran`, `user_id`, `id_karyawan`, `tanggal_pembayaran`, `tanggal_penggajian`, `id_jabatan`, `id_departement`, `gaji_pokok`, `upah_lembur`, `tunjangan_aktivitas`, `qty`, `tunjangan_jabatan`, `tunjangan_makan`, `pph23`, `bpjs`, `pinjaman`, `thp`, `keterangan_pembayaran`) VALUES
('125138457CIOYX', 2, 'B019187', '2023-01-25', '2023-01-25', 1, 1, '10000000', '300000', '0', 1, '2000000', '0', '0', '0', '350000', '11950000', 'Pembayaran gaji periode, September 2023'),
('480619220GALFZ', 4, 'B019181', '2023-01-25', '2023-01-25', 3, 3, '7000000', '0', '0', 1, '800000', '0', '0', '0', '200000', '7600000', 'Pembayaran gaji periode, September 2023'),
('741907942TPAZY', 3, 'B019188', '2023-01-25', '2023-01-25', 2, 2, '8000000', '100000', '0', 1, '1000000', '0', '0', '0', '0', '9100000', 'Pembayaran gaji periode, September 2023');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_brg` varchar(30) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `status` enum('accepted','rejected','waiting confirm','return') NOT NULL,
  `date_request` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_accepted` timestamp NULL DEFAULT NULL,
  `date_rejected` timestamp NULL DEFAULT NULL,
  `date_returned` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`) VALUES
(1, 'Head Office'),
(2, 'Kantor Cabang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, '2023-09-03 07:49:11'),
(2, 'afrizal', 'afrizal@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1, '2023-09-06 16:38:48'),
(3, 'sukma', 'Sukma@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1, '2023-09-03 07:49:24'),
(4, 'andini', 'Andini@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1, '2023-09-03 07:49:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id_lembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
