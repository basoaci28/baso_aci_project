-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2022 at 01:28 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qDmgh8dJsK`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `list_reseller` int(10) NOT NULL,
  `list_user` int(10) NOT NULL,
  `list_product` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `nama`, `foto`) VALUES
(1, 'Promo Gopay 1', 'https://www.rajabeli.com/wp-content/uploads/2020/07/applikasi-gopay.png'),
(2, 'Promo Gopay 2', 'https://www.rajabeli.com/wp-content/uploads/2020/07/applikasi-gopay.png');

-- --------------------------------------------------------

--
-- Table structure for table `imagetable`
--

CREATE TABLE `imagetable` (
  `id` int(2) NOT NULL,
  `img_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imagetable`
--

INSERT INTO `imagetable` (`id`, `img_name`, `img_path`) VALUES
(1, 'meong2', 'Uploads/meong2.jpg'),
(2, 'meong2', '/storage/ssd3/187/18601187/public_html/basoaci-main/image/resellerimg/'),
(3, 'meong2', '/storage/ssd3/187/18601187/public_html/basoaci-main/image/resellerimg/$image_name.jpeg'),
(4, 'meong5', '/storage/ssd3/187/18601187/public_html/basoaci-main/image/resellerimg/$image_name.jpeg'),
(5, 'meong6', '/storage/ssd3/187/18601187/public_html/basoaci-main/image/cobaimg/$image_name.jpeg'),
(6, 'meong6', '/storage/ssd3/187/18601187/public_html/basoaci-main/image/cobaimg/$image_name.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `gambar`, `deskripsi`) VALUES
(1, 'https://aplikasiresellerbasoaci28api.000webhostapp.com/basoaci-main/image/pengumuman/87-1620238949046.png', 'Selalu pantau disini untuk tau update terbaru Baso Aci 28'),
(2, 'https://aplikasiresellerbasoaci28api.000webhostapp.com/basoaci-main/image/pengumuman/Cute%20Avatar.png', 'Jadi reseller banyak lebihnya lohhh\r\n'),
(3, 'https://aplikasiresellerbasoaci28api.000webhostapp.com/basoaci-main/image/pengumuman/398-1620238949046.png', 'Kumpulkan 6 buah sticker untuk mendapatkan mangkok cantik');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `stok` int(9) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `nama`, `detail`, `stok`, `harga`, `gambar`) VALUES
(1, 'Baso Aci original', 'Baso aci, cuanki, sukro, batagor', 7, '8000', 'https://basoaci-project.herokuapp.com/image/product/301-IMG-20191029-WA0071.jpg'),
(2, 'Baso Aci Tulang Rangu', 'Baso aci, cuanki, sukro, batagor', 7, '8000', 'https://basoaci-project.herokuapp.com/image/product/344-DSC_1680.JPG'),
(7, 'Cimol kriukkkk nyoyy', 'Cimol crispy', 10, '8000', 'https://basoaci-project.herokuapp.com/image/product/453-IMG-20200629-WA0098.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reseller`
--

CREATE TABLE `reseller` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `is_verified` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reseller`
--

INSERT INTO `reseller` (`id`, `nama`, `email`, `password`, `alamat`, `foto`, `no_hp`, `is_verified`) VALUES
(1, 'Ahmad', 'Ahmad44@gmail.com', '202022', 'JL.Mekarsari No.5, Brebes', 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80', '08174848223', 1),
(2, 'Dita Kurnia', 'kurniadita@gmail.com', 'adkdita', 'Tegal', 'https://images.unsplash.com/photo-1605462863863-10d9e47e15ee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '08123456722', 0),
(3, 'Ahmad Malik F', 'malik88@gmail.com', '121200', 'Pemalang', 'https://images.unsplash.com/photo-1605462863863-10d9e47e15ee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '081227333901', 0),
(46, '4444', NULL, '4', '4444', 'Foto gagal ditambahkan', '4444', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `alamat`, `no_hp`) VALUES
(1, 'Salman', 'salman@gmail.com', '111111', 'Brebes', '081227846885'),
(2, 'Andi Sha', 'mrandi90@gmail.com', 'andi882', 'JL. Moh. Hatta No.23, Brebes', '085728887361'),
(3, 'Bagus Heryawan', 'bagushero4@gmail.com', '777222', 'Bandung', '08234885908'),
(79, '123', NULL, '1', '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagetable`
--
ALTER TABLE `imagetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller`
--
ALTER TABLE `reseller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imagetable`
--
ALTER TABLE `imagetable`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reseller`
--
ALTER TABLE `reseller`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
