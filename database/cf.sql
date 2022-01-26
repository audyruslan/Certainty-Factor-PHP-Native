-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 12:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `img_dir` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`, `img_dir`) VALUES
('audyruslan', '$2y$10$YJMlsasuDDlkgqAUS/.XdOeu/6/gPq1Z9dr1xAe.j40T8TtjfnD5S', 'Audy Ruslan', 'image/1638426625.png'),
('fadli', '$2y$10$ZQlFQYq5ahX6DEVObwZe3e4jS6r52HyhTMmpeiTQAnMF67HORrwk.', 'Fadli Nur Zaman', 'image/1638426534.png');

-- --------------------------------------------------------

--
-- Table structure for table `gejala_hama`
--

CREATE TABLE `gejala_hama` (
  `kode_ghama` int(11) NOT NULL,
  `nama_ghama` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala_hama`
--

INSERT INTO `gejala_hama` (`kode_ghama`, `nama_ghama`) VALUES
(76, 'Aktivitas hama ini hanya berlangsung pada musim hujan selama 1-2 bulan '),
(77, 'Larva yang baru menetas melubangi batang, kemudian membuat terowongan hingga ke dasar batang sehingga tanaman menjadi kuning dan akhirnya '),
(78, 'Daun berlubang-lubang, pertumbuhan terlambat, menguning, jaringan membusuk atau gejala sundep'),
(79, 'Jika tanaman mengalami penyembuhan, maka pertumbuhannya akan kerdil. '),
(84, 'Larva kecil merusak daun serta serentak bergerombol dengan meninggalkan sisa-sisa epidermis bagian atas, bahkan hanya menyisakan tulang daunnya saja'),
(85, 'Biasanya larva berada dipermukaan bawah daun'),
(86, 'Umumnya muncul pada saat musim kemarau'),
(87, 'Membuat lubang kecil pada daun'),
(88, 'Membuat lubang gorokan pada batang, bunga jantan atau pangkal tongkol, sehingga batang tassel mudah patah'),
(89, 'Larva yang baru menetas akan makan pada jambul tongkol, dan kemudian membuat lubang masuk ke tongkol.'),
(90, 'Kotoran yang ditinggalkan larva menyebabkan bertumbuhnya jamur yang menghasilkan mikotoksin sehingga tongkol rusak.'),
(91, 'Penggerek ini juga dapat menyerang tanaman muda, terutama pada pucuk atau malai yang. dapat mengakibatkan tidak terbentuknya bunga jantan, berkurangnya hasil dan bahkan tanaman dapat mati');

-- --------------------------------------------------------

--
-- Table structure for table `gejala_penyakit`
--

CREATE TABLE `gejala_penyakit` (
  `kode_gpenyakit` int(11) NOT NULL,
  `nama_gpenyakit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hama`
--

CREATE TABLE `hama` (
  `kode_hama` int(11) NOT NULL,
  `nama_hama` varchar(50) NOT NULL,
  `det_hama` varchar(500) NOT NULL,
  `srn_hama` varchar(500) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hama`
--

INSERT INTO `hama` (`kode_hama`, `nama_hama`, `det_hama`, `srn_hama`, `gambar`) VALUES
(4, 'Hama Lalat Bibit (Atherigona sp)', '<p><span style=\"font-size:12.0pt;line-height:107%;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\r\nminor-latin;mso-ansi-language:EN-ID;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA\">Hama lalat bibit ini merupakan serangga yang baru menetas dan biasanya\r\nmenyerang dengan cara membuat atau melubangi batang tanaman jagung dan\r\nmemakannya sampai ke dasar batang dari tanaman jagung itu sendiri.&nbsp;</span><br></p>', '<span style=\"font-size:12.0pt;line-height:107%;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\r\nminor-latin;mso-ansi-language:EN-ID;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA\">Hama lalat bibit ini merupakan serangga yang baru menetas dan biasanya\r\nmenyerang dengan cara membuat atau melubangi batang tanaman jagung dan\r\nmemakannya sampai ke dasar batang dari tanaman jagung itu sendiri.&nbsp;</span>                                   ', 'lalatbibit.jpg'),
(5, 'Hama Ulat Grayak (Spodoptera frugiperda.) atau Fru', 'Ulat grayak merupakan serangga ngengat asli daerah tropis yang sebelumnya hanya ditemukan pada pertanaman jagung di Amerika Serikat, Argentina, dan Afrika. Tahun 2018 FAW memasuki Benua Asia di kawasan India, Myanmar, dan Thailand. ', 'Ulat grayak merupakan serangga ngengat asli daerah tropis yang sebelumnya hanya ditemukan pada pertanaman jagung di Amerika Serikat, Argentina, dan Afrika. Tahun 2018 FAW memasuki Benua Asia di kawasan India, Myanmar, dan Thailand.                                                 ', 'ulat grayak.jpg'),
(6, 'Hama Larva Penggerek Batang (Ostrinia funacalis)', 'Hama penggerek batang (Ostrinia funacalis) merupakan salah satu dari beberapa jenis hama yang menyerang tanaman jagung, menimbulkan kerusakan secara fisik dan mengakibatkan kerugian secara ekonomi sehingga memerlukan tindakan pengendalian. ', 'Hama penggerek batang (Ostrinia funacalis) merupakan salah satu dari beberapa jenis hama yang menyerang tanaman jagung, menimbulkan kerusakan secara fisik dan mengakibatkan kerugian secara ekonomi sehingga memerlukan tindakan pengendalian.                                                                                                                                                                                                                                                                     ', 'larva penggerek batang.jpg'),
(7, 'Hama Tongkol (Helicoverpa armigera Hbn. Noctuidae:', 'Helicoverpa armigera merupakan serangga dari kelompok ngengat yang larvanya menjadi salah satu hama penting pada pertanaman kapas dan jagung. ', 'Helicoverpa armigera merupakan serangga dari kelompok ngengat yang larvanya menjadi salah satu hama penting pada pertanaman kapas dan jagung.                                                                                                                        ', 'hama tongkol.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_hama`
--

CREATE TABLE `hasil_hama` (
  `id_hasil` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `hama` text NOT NULL,
  `ghama` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penyakit`
--

CREATE TABLE `hasil_penyakit` (
  `id_hasil` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `penyakit` text NOT NULL,
  `gejala` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_penyakit`
--

INSERT INTO `hasil_penyakit` (`id_hasil`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`) VALUES
(382, '2021-12-13 04:02:59', 'a:0:{}', 'a:0:{}', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_hama`
--

CREATE TABLE `kondisi_hama` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_hama`
--

INSERT INTO `kondisi_hama` (`id`, `kondisi`) VALUES
(13, 'Sangat Yakin'),
(14, 'Yakin'),
(15, 'Cukup Yakin'),
(16, 'Sedikit Yakin'),
(17, 'Tidak Tahu'),
(18, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_penyakit`
--

CREATE TABLE `kondisi_penyakit` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengetahuan_hama`
--

CREATE TABLE `pengetahuan_hama` (
  `kode_pengetahuan` int(11) NOT NULL,
  `kode_hama` int(11) NOT NULL,
  `kode_ghama` int(11) NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengetahuan_hama`
--

INSERT INTO `pengetahuan_hama` (`kode_pengetahuan`, `kode_hama`, `kode_ghama`, `mb`, `md`) VALUES
(111, 4, 76, 0.8, 0.2),
(112, 4, 77, 0.8, 0.2),
(113, 4, 78, 1.0, 0.2),
(114, 4, 79, 0.6, 0.4),
(115, 5, 80, 0.8, 0.2),
(116, 5, 84, 0.8, 0.2),
(117, 5, 85, 0.4, 0.6),
(118, 5, 86, 0.4, 0.6),
(119, 6, 87, 0.8, 0.2),
(120, 6, 88, 1.0, 0.2),
(121, 7, 89, 0.8, 0.2),
(122, 7, 90, 1.0, 0.0),
(123, 7, 91, 0.6, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `pengetahuan_penyakit`
--

CREATE TABLE `pengetahuan_penyakit` (
  `kode_pengetahuan` int(11) NOT NULL,
  `kode_penyakit` int(11) NOT NULL,
  `kode_gpenyakit` int(11) NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `det_penyakit` varchar(500) NOT NULL,
  `srn_penyakit` varchar(500) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `kode_post` int(11) NOT NULL,
  `nama_post` varchar(50) NOT NULL,
  `det_post` varchar(15000) NOT NULL,
  `srn_post` varchar(15000) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `gejala_hama`
--
ALTER TABLE `gejala_hama`
  ADD PRIMARY KEY (`kode_ghama`);

--
-- Indexes for table `gejala_penyakit`
--
ALTER TABLE `gejala_penyakit`
  ADD PRIMARY KEY (`kode_gpenyakit`);

--
-- Indexes for table `hama`
--
ALTER TABLE `hama`
  ADD PRIMARY KEY (`kode_hama`);

--
-- Indexes for table `hasil_hama`
--
ALTER TABLE `hasil_hama`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `hasil_penyakit`
--
ALTER TABLE `hasil_penyakit`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kondisi_hama`
--
ALTER TABLE `kondisi_hama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi_penyakit`
--
ALTER TABLE `kondisi_penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengetahuan_hama`
--
ALTER TABLE `pengetahuan_hama`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indexes for table `pengetahuan_penyakit`
--
ALTER TABLE `pengetahuan_penyakit`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`kode_post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gejala_hama`
--
ALTER TABLE `gejala_hama`
  MODIFY `kode_ghama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `gejala_penyakit`
--
ALTER TABLE `gejala_penyakit`
  MODIFY `kode_gpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hama`
--
ALTER TABLE `hama`
  MODIFY `kode_hama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hasil_hama`
--
ALTER TABLE `hasil_hama`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `hasil_penyakit`
--
ALTER TABLE `hasil_penyakit`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `kondisi_hama`
--
ALTER TABLE `kondisi_hama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kondisi_penyakit`
--
ALTER TABLE `kondisi_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengetahuan_hama`
--
ALTER TABLE `pengetahuan_hama`
  MODIFY `kode_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `pengetahuan_penyakit`
--
ALTER TABLE `pengetahuan_penyakit`
  MODIFY `kode_pengetahuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `kode_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `kode_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
