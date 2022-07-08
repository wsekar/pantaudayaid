-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2022 at 03:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdayapju`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pju`
--

CREATE TABLE `data_pju` (
  `id_pju` int(20) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `latitude` varchar(1024) NOT NULL,
  `longitude` varchar(1024) NOT NULL,
  `nomor_trafo` varchar(30) NOT NULL,
  `jenis_lampu` varchar(50) NOT NULL,
  `jenis_tiang` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pju`
--

INSERT INTO `data_pju` (`id_pju`, `id_petugas`, `latitude`, `longitude`, `nomor_trafo`, `jenis_lampu`, `jenis_tiang`, `alamat`) VALUES
(1, 1, '-7.639331399999999', '111.5480179', 'BLT0228', 'LED', '12', 'Jalan Tanjung Raya No.45, Manisrejo, Madiun City, East Java, Indonesia'),
(2, 3, '-7.6357173', '111.5483929', 'BLT0228', 'LED', '12', 'Jalan Tanjung Raya No.3, Manisrejo, Madiun City, East Java, Indonesia'),
(3, 4, '-7.630565499999999', '111.5168408', 'BLT0287', 'PIJAR', 'PEMDA', 'Jalan KH Agus Salim No.12, Pandean, Madiun City, East Java, Indonesia'),
(4, 1, '-7.634278799999999', '111.5307345', 'BLT311', 'BOXKWH', 'NON PLN', 'Jalan Abdulrahman Saleh No.3, Kejuron, Madiun City, East Java, Indonesia'),
(5, 3, '-7.638474800000002', '111.5481165', 'BLT0228', 'LED', '12', 'Jalan Tanjung Raya No.15, Manisrejo, Madiun City, East Java, Indonesia'),
(6, 4, '-7.6525557', '111.5218483', 'BLT282', 'LAMPU HIAS', 'NON TIANG', 'Jalan Soekarno - Hatta No.15, Demangan, Madiun City, East Java, Indonesia'),
(7, 3, '-7.6163675', '111.5319249', 'BLT271', 'BOHLAM', '9', 'Jalan Biliton No.23, Madiun Lor, Madiun City, East Java, Indonesia'),
(8, 4, '-7.624112599999999', '111.5254328', 'BLT211', 'BOHLAM', '9', 'Jalan Bali No.12, Madiun Lor, Madiun City, East Java, Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_pju`
--

CREATE TABLE `monitoring_pju` (
  `id_monitoring_pju` int(20) NOT NULL,
  `id_pju` int(20) NOT NULL,
  `id_staff` int(12) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `gambar_monitoring_pju` varchar(50) NOT NULL,
  `daya_monitoring_pju` varchar(10) NOT NULL,
  `kategori_daya` varchar(50) NOT NULL,
  `latitude_monitoring_pju` varchar(1024) NOT NULL,
  `longitude_monitoring_pju` varchar(1024) NOT NULL,
  `tanggal_monitoring_pju` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_pju`
--

INSERT INTO `monitoring_pju` (`id_monitoring_pju`, `id_pju`, `id_staff`, `id_petugas`, `gambar_monitoring_pju`, `daya_monitoring_pju`, `kategori_daya`, `latitude_monitoring_pju`, `longitude_monitoring_pju`, `tanggal_monitoring_pju`) VALUES
(1, 5, 1, 3, 'Gambar_8.jpg', '90 w', 'High Voltage', '-7.638474800000002', '111.5481165', '22/05/2022'),
(2, 1, 1, 3, 'Gambar_6.jpg', '200 w', 'High Voltage', '-7.639331399999999', '111.5480179', '2022/05/22'),
(3, 4, 1, 3, 'Gambar_9.jpg', '100 w', 'High Voltage', '-7.634278799999999', '111.5307345', '2022/05/22'),
(4, 4, 1, 1, 'Gambar_5.jpg', '80 w', 'High Voltage', '-7.634278799999999', '111.5307345', '2022/05/23'),
(5, 1, 1, 1, 'Gambar_7.jpg', '120 w', 'High Voltage', '-7.639331399999999', '111.5480179', '2022/05/25'),
(6, 5, 1, 1, 'Gambar_2.jpg', '150 w', 'High Voltage', '-7.638474800000002', '111.5481165', '2022/05/26'),
(7, 5, 1, 4, 'Gambar_1.jpg', '200 w', 'High Voltage', '-7.638474800000002', '111.5481165', '04/07/2022'),
(8, 5, 1, 4, 'Gambar_3.jpg', '90 w', 'High Voltage', '-7.638474800000002', '111.5481165', '04/07/2022');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(12) NOT NULL,
  `kode_petugas` varchar(35) NOT NULL,
  `nama_petugas` varchar(80) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `kode_petugas`, `nama_petugas`, `username`, `password`, `email`, `telephone`) VALUES
(1, 'PTG001', 'Rafly Faisal Akbar', 'raffa23', 'raffa23', 'raffa23@gmail.com', '08566754332'),
(2, 'PTG002', 'Air Rumi Akbar', 'airrumi67', 'airrumi6', 'airrumi@gmail.com', '085776998990'),
(3, 'PTG003', 'Kenzie Bimantara', 'kenziebmntr', 'kenzie01', 'kenziebmntr@gmail.com', '081387920675'),
(4, 'PTG004', 'Naufal Ramadhan', 'naufalrama', 'naufal12', 'naufal12@gmail.com', '081288923746');

-- --------------------------------------------------------

--
-- Table structure for table `staff_administrasi`
--

CREATE TABLE `staff_administrasi` (
  `id_staff` int(12) NOT NULL,
  `kode_staff` varchar(10) NOT NULL,
  `username_staff` varchar(30) NOT NULL,
  `password_staff` varchar(8) NOT NULL,
  `email_staff` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_administrasi`
--

INSERT INTO `staff_administrasi` (`id_staff`, `kode_staff`, `username_staff`, `password_staff`, `email_staff`) VALUES
(1, 'ADM01', 'nuriya23', 'nuriya23', 'nuriyaa@gmail.com'),
(2, 'ADM02', 'nana', 'nana', 'nana@gmail.com'),
(3, 'ADM03', 'zidane', 'zidane04', 'zidanee@gmail.com'),
(4, 'ADM04', 'wibi161', 'wibi', 'wibi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pju`
--
ALTER TABLE `data_pju`
  ADD PRIMARY KEY (`id_pju`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `monitoring_pju`
--
ALTER TABLE `monitoring_pju`
  ADD PRIMARY KEY (`id_monitoring_pju`),
  ADD KEY `id_pju` (`id_pju`),
  ADD KEY `id_staff` (`id_staff`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `staff_administrasi`
--
ALTER TABLE `staff_administrasi`
  ADD PRIMARY KEY (`id_staff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pju`
--
ALTER TABLE `data_pju`
  MODIFY `id_pju` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monitoring_pju`
--
ALTER TABLE `monitoring_pju`
  MODIFY `id_monitoring_pju` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_administrasi`
--
ALTER TABLE `staff_administrasi`
  MODIFY `id_staff` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_pju`
--
ALTER TABLE `data_pju`
  ADD CONSTRAINT `data_pju_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_pju`
--
ALTER TABLE `monitoring_pju`
  ADD CONSTRAINT `monitoring_pju_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_pju_ibfk_2` FOREIGN KEY (`id_pju`) REFERENCES `data_pju` (`id_pju`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_pju_ibfk_3` FOREIGN KEY (`id_staff`) REFERENCES `staff_administrasi` (`id_staff`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
