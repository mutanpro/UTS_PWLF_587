-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 11:44 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log` int(11) NOT NULL,
  `nim` char(13) NOT NULL,
  `no_hp_lama` char(12) NOT NULL,
  `no_hp_baru` char(13) NOT NULL,
  `tgl_diubah` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id_log`, `nim`, `no_hp_lama`, `no_hp_baru`, `tgl_diubah`) VALUES
(4, '161240000567', '087543567899', '08345566', '2019-11-04 07:35:47'),
(5, '161240000587', '161240000587', '08574033732', '2019-11-04 13:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` char(13) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL DEFAULT 'L',
  `alamat` text NOT NULL,
  `no_hp` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama`, `jk`, `alamat`, `no_hp`) VALUES
('161240000567', 'Ah. Hasan Umam Fikri', 'L', 'dfgh', '08345566'),
('161240000587', 'Nur Ahmad Mutanassik', 'L', 'Mayong Jepara', '08574033732');

--
-- Triggers `tbl_mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `log_nohp` AFTER UPDATE ON `tbl_mahasiswa` FOR EACH ROW BEGIN
IF (NEW.no_hp != OLD.no_hp) THEN
          INSERT INTO tbl_log (nim, no_hp_lama, no_hp_baru, tgl_diubah)
Values (old.nim,old.no_hp,new.no_hp,NOW());

      END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mahasiswa`
-- (See below for the actual view)
--
CREATE TABLE `view_mahasiswa` (
`nim` char(13)
,`nama` varchar(255)
,`alamat` text
,`jk` enum('L','P')
,`no_hp` char(13)
);

-- --------------------------------------------------------

--
-- Structure for view `view_mahasiswa`
--
DROP TABLE IF EXISTS `view_mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mahasiswa`  AS  (select `tbl_mahasiswa`.`nim` AS `nim`,`tbl_mahasiswa`.`nama` AS `nama`,`tbl_mahasiswa`.`alamat` AS `alamat`,`tbl_mahasiswa`.`jk` AS `jk`,`tbl_mahasiswa`.`no_hp` AS `no_hp` from `tbl_mahasiswa`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
