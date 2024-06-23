-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 04:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bukawarung`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL,
  `admin_no_rek` varchar(50) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `atas_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`, `admin_no_rek`, `nama_bank`, `atas_nama`) VALUES
(1, 'Poltekpos', 'admin', 'fcea920f7412b5da7be0cf42b8c93759', '+6282217604816', 'poltekpos@gmail.com', 'Jl. Petojo VIJ VI, Cideng, Gambir, Jakarta Pusat 10150.', '0021321212312121', 'MANDIRI', 'DANI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`id`, `user_id`, `product_id`, `qty`) VALUES
(25, 3, 5, 1),
(33, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart_voucher`
--

CREATE TABLE `tb_cart_voucher` (
  `user_id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_cart_voucher`
--

INSERT INTO `tb_cart_voucher` (`user_id`, `kode`) VALUES
(5, 'gacor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(4, 'Laptop'),
(5, 'Handphone'),
(6, 'Handsfree'),
(7, 'Pakaian Pria'),
(8, 'Pakaian Wanita'),
(9, 'Buah'),
(10, 'Sayur Segar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `data_created`, `stok`) VALUES
(5, 4, 'laptop Hp', 4000000, '<p><strong>Untuk Anda </strong>dibidang editing, dengan layar 360 derajat serta tauchscreen dan dilengkapi dengan stylus.</p>\r\n', 'produk1589853135.png', 1, '2020-05-19 01:52:15', 44),
(6, 4, 'laptop Lenovo', 6000000, '<p><strong>Khusus&nbsp;</strong>Anda yang suka bekerja dimana saja. dengan bobot ringan sehingga nyaman dibawa kemana mana.</p>\r\n', 'produk1589853165.png', 1, '2020-05-19 01:52:45', 48),
(7, 4, 'laptop acer', 8000000, '<p>Cokok, Untuk anak pekerjaan Office dan editing ringan&nbsp;</p>\r\n', 'produk1589853182.png', 1, '2020-05-19 01:53:02', 0),
(8, 5, 'handphone Advan C5', 1000000, '<p><strong>Hp Lokal,&nbsp;</strong>&nbsp;Kualitas Impor</p>\r\n', 'produk1589853203.png', 1, '2020-05-19 01:53:23', 50),
(9, 5, 'handphone Esia Hidayah', 1500000, '<p><strong>Bundling&nbsp;</strong>dengan kartu Esia 2,5 GB selama 6 Bulan</p>\r\n', 'produk1589853226.png', 1, '2020-05-19 01:53:46', 50),
(10, 5, 'handphone nokia n212', 2500000, '<p><strong>Pertama!!&nbsp;</strong>dengan jaringan 3G</p>\r\n', 'produk1589853256.png', 1, '2020-05-19 01:54:16', 49),
(11, 6, 'headset xiomi', 50000, '<p>Harga murah kualitas premium</p>\r\n', 'produk1589853286.png', 1, '2020-05-19 01:54:46', 50),
(12, 6, 'handset samseng', 100000, '<p>Headset samseng original, garansi resmi TAM</p>\r\n', 'produk1589853315.png', 1, '2020-05-19 01:55:15', 50),
(13, 6, 'Headphone Oddo', 150000, '<p><strong>Kualitas Mantap Harga Murah.</strong></p>\r\n', 'produk1589853342.png', 1, '2020-05-19 01:55:42', 50),
(14, 7, 'kemeja pria', 100000, '<p><strong>Tampil Formal, Namun Tetep Gaya.</strong><br />\r\nBahan katun sehingga nyaman dipakai.</p>\r\n', 'produk1589853370.png', 1, '2020-05-19 01:56:10', 50),
(15, 7, 'pakaian koko', 150000, '<p><strong>Tampil Gaya,</strong>&nbsp;Buktikan bahwa anda adalah yang membuat pakaian ini terlihat keren.</p>\r\n', 'produk1589853389.png', 1, '2020-05-19 01:56:29', 50),
(16, 8, 'pakaian wanita santai', 200000, '<p><strong>Pakaian Santai,&nbsp;</strong>nyaman dipakai sehari hari.</p>\r\n', 'produk1589853410.png', 1, '2020-05-19 01:56:50', 50),
(17, 8, 'pakaian atasan merah', 400000, '<p><strong>Model Fasion Terkini,&nbsp;</strong>dapat selama stok masih ada.</p>\r\n', 'produk1589853431.png', 1, '2020-05-19 01:57:11', 50),
(18, 9, 'pisang', 150000, '<p><strong>Pisang Segar,&nbsp;</strong>Cocok untuk dimakan langsung maupun dibuat jus atau <em>milkshake</em></p>\r\n', 'produk1589853455.png', 1, '2020-05-19 01:57:35', 50),
(19, 9, 'rambutan', 20000, '<p><strong>Rambutan Segar,</strong>&nbsp;lengkapi kebutuhan nutrisi anda dengan memakan buah yang berkualitas setiap hari.</p>\r\n', 'produk1589853479.png', 1, '2020-05-19 01:57:59', 48),
(20, 10, 'brokoli', 30000, '<p><strong>Brokoli Hijau Pilihan Petani Lokal</strong>, dipetik langsung dengan tangan tangan petani lokal yang berpengalaman.</p>\r\n', 'produk1589853498.png', 1, '2020-05-19 01:58:18', 45),
(21, 10, 'sayur kol', 40000, '<p>Kol segar yang dipanen langsung dari kebun.</p>\r\n', 'produk1589853518.png', 1, '2020-05-19 01:58:38', 46);

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayat_voucher`
--

CREATE TABLE `tb_riwayat_voucher` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id_voucher` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `harga_bayar` int(12) NOT NULL,
  `total_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`transaksi_id`, `user_id`, `created_at`, `status`, `bukti_pembayaran`, `harga_total`, `harga_bayar`, `total_potongan`) VALUES
(38, 5, '2023-05-24 01:07:22', 'Barang Telah Dikirim', 'bukti_bayar1684890442.png', 110000, 100000, 10000),
(39, 5, '2023-05-24 01:22:11', 'Barang Telah Dikirim', 'bukti_bayar1684891331.png', 6000000, 5980000, 20000),
(40, 5, '2023-05-24 01:33:00', 'Barang Telah Dikirim', 'bukti_bayar1684891980.png', 4000000, 4000000, 0),
(41, 5, '2023-05-24 01:38:04', 'Barang Telah Dikirim', 'bukti_bayar1684892284.png', 8000000, 7990000, 10000),
(42, 5, '2023-05-24 01:40:02', 'Barang Telah Dikirim', 'bukti_bayar1684892402.png', 4000000, 3990000, 10000),
(43, 5, '2023-05-24 01:56:51', 'Barang Telah Dikirim', 'bukti_bayar1684893411.png', 4000000, 3990000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_product`
--

CREATE TABLE `tb_transaksi_product` (
  `id_tp` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_product`
--

INSERT INTO `tb_transaksi_product` (`id_tp`, `transaksi_id`, `product_id`, `qty`, `harga_satuan`) VALUES
(13, 32, 21, 4, 40000),
(14, 33, 20, 1, 30000),
(15, 33, 21, 1, 40000),
(16, 34, 10, 1, 2500000),
(17, 35, 6, 1, 6000000),
(18, 35, 21, 1, 40000),
(19, 35, 20, 1, 30000),
(20, 36, 6, 1, 6000000),
(21, 36, 7, 1, 8000000),
(22, 36, 20, 1, 30000),
(23, 37, 20, 1, 30000),
(24, 37, 19, 1, 20000),
(25, 38, 20, 3, 30000),
(26, 38, 19, 1, 20000),
(27, 39, 6, 1, 6000000),
(28, 40, 5, 1, 4000000),
(29, 41, 7, 1, 8000000),
(30, 42, 5, 1, 4000000),
(31, 43, 5, 1, 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reff` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `fullname`, `username`, `email`, `no_telp`, `password`, `reff`) VALUES
(3, 'dani f', 'dani11', 'dani@mail.com', '0982178352', 'fcea920f7412b5da7be0cf42b8c93759', '2bti'),
(4, 'Dimas Ardianto', 'dimasardnt', 'dimas@gmail.com', '089647129890', 'cffbad68bb97a6c3f943538f119c992c', '2bti'),
(5, 'adit', 'adit123', 'adit@mail.com', '08987654', '25f9e794323b453885f5181f1b624d0b', '2bti');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `deskripsi` varchar(254) DEFAULT NULL,
  `reff` varchar(10) NOT NULL,
  `for_all` tinyint(1) NOT NULL,
  `type` varchar(11) NOT NULL DEFAULT 'persen',
  `value` int(11) NOT NULL,
  `max_potongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `nama`, `kode`, `deskripsi`, `reff`, `for_all`, `type`, `value`, `max_potongan`) VALUES
(2, 'Dani Ferdinan', 'danigacor88', 'test', '2bti', 0, 'nominal', 10000, 10000),
(3, 'dimas', 'gacor', 'test guys', '2bti', 0, 'persen', 20, 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart_voucher`
--
ALTER TABLE `tb_cart_voucher`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tb_riwayat_voucher`
--
ALTER TABLE `tb_riwayat_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tb_transaksi_product`
--
ALTER TABLE `tb_transaksi_product`
  ADD PRIMARY KEY (`id_tp`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_riwayat_voucher`
--
ALTER TABLE `tb_riwayat_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_transaksi_product`
--
ALTER TABLE `tb_transaksi_product`
  MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
