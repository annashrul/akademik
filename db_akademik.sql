-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2018 at 01:28 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_detail_pembayaran` int(11) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `bulan` enum('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember') NOT NULL,
  `jumlah_uang` varchar(20) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `kembalian` varchar(20) NOT NULL DEFAULT 'uang pas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_detail_pembayaran`, `nis`, `nama`, `id_kelas`, `jurusan`, `jenis`, `biaya`, `bulan`, `jumlah_uang`, `tanggal_bayar`, `kembalian`) VALUES
(18, 'rpl18001', 'Annashrul Yusuf', 'X-RPL-A', 'Rekayasa Perangkat Lunak', 'bangunan', '100000', 'januari', '200000', '0000-00-00', '100000'),
(19, 'tkr18001', 'Okta Febri Pangestu', 'X-TKR-A', 'Teknik Kendaraan Ringan', 'bangunan', '100000', 'januari', '200000', '0000-00-00', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nig` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('cowo','cewe') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nig`, `nama`, `email`, `tgl_lahir`, `no_hp`, `photo`, `alamat`, `jenis_kelamin`) VALUES
(51, 'pgri301', 'annashrul yusuf', 'anashrulyusuf@gmail.com', '1997-04-06', '085324544191', 'annashrul_yusuf(pgri301)2018.jpg', 'jln kebon manggu rt 01 rw 04 padasuka cimahi', 'cowo'),
(52, 'pgri302', 'Dedi Rahmat', 'dedirahmat@gmail.com', '2018-06-15', '087676721761', 'Dedi_Rahmat(pgri302)2018.jpg', 'padasuka', 'cowo'),
(53, 'pgri303', 'Sutisna', 'sutisna@gmail.com', '2018-06-21', '085324544191', 'Sutisna(pgri303)2018.jpg', 'jln kebon manggu rt 01 rw 04 padasuka cimahi', 'cowo');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') NOT NULL,
  `jam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_guru`, `id_kelas`, `id_jurusan`, `id_pelajaran`, `hari`, `jam`) VALUES
(50, 51, 10, 39, 63, 'Senin', '07.00 - 08.00'),
(93, 53, 10, 39, 60, 'Senin', '12.00 - 14.00'),
(94, 52, 20, 1, 64, 'Kamis', '07.00 - 08.00'),
(95, 52, 18, 38, 64, 'Selasa', '12.00 - 14.00'),
(96, 53, 22, 18, 60, 'Selasa', '08.00 - 10.00'),
(97, 51, 19, 1, 63, 'Kamis', '08.00 - 10.00'),
(98, 51, 15, 2, 61, 'Jumat', '07.00 - 10.00');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Teknik Komputer Jaringan'),
(2, 'Rekayasa Perangkat Lunak'),
(18, 'Teknik Pendingin & Tata Udara'),
(38, 'Teknik Kendaraan Ringan'),
(39, 'Elektronika Industri');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `daftar_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `daftar_kelas`) VALUES
(10, 39, 'X-EIND-A'),
(11, 39, 'X-EIND-B'),
(15, 2, 'X-RPL-A'),
(16, 2, 'X-RPL-B'),
(17, 38, 'X-TKR-A'),
(18, 38, 'X-TKR-B'),
(19, 1, 'X-TKJ-A'),
(20, 1, 'X-TKJ-B'),
(21, 18, 'X-TPTU-A'),
(22, 18, 'X-TPTU-B'),
(23, 39, 'XI-EIND-A'),
(24, 39, 'XI-EIND-B'),
(25, 39, 'XII-EIND-A'),
(26, 39, 'XII-EIND-B'),
(27, 2, 'XI-RPL-A'),
(28, 2, 'XI-RPL-B'),
(29, 2, 'XII-RPL-A'),
(30, 2, 'XII-RPL-B'),
(31, 38, 'XI-TKR-A'),
(32, 38, 'XI-TKR-B'),
(33, 38, 'XII-TKR-A'),
(34, 38, 'XII-TKR-B'),
(35, 18, 'XI-TPTU-A'),
(36, 18, 'XI-TPTU-B'),
(37, 18, 'XII-TPTU-A'),
(38, 18, 'XII-TPTU-B'),
(39, 1, 'XI-TKJ-A'),
(40, 1, 'XI-TKJ-B'),
(41, 1, 'XII-TKJ-A'),
(42, 1, 'XII-TKJ-A');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL DEFAULT 'umum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `id_jurusan`, `nama_pelajaran`, `keterangan`) VALUES
(60, 0, 'IPA', 'umum'),
(61, 0, 'IPS', 'umum'),
(62, 0, 'PKN', 'umum'),
(63, 0, 'Agama', 'umum'),
(64, 2, 'Algoritma', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `jenis` enum('spp','bangunan','ujikom') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `biaya`, `jenis`) VALUES
(1, '150000', 'spp'),
(2, '100000', 'bangunan');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hak_akses` enum('admin','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `id_siswa`, `id_guru`, `username`, `password`, `hak_akses`) VALUES
(8, 0, 0, 'admin', 'admin', 'admin'),
(10, 0, 51, 'pgri301', 'pgri301', 'guru'),
(11, 0, 52, 'pgri302', 'pgri302', 'guru'),
(12, 0, 0, 'rpl18001', 'rpl18001', 'siswa'),
(13, 0, 0, 'rpl18003', 'rpl18003', 'siswa'),
(14, 0, 0, 'ein18001', 'ein18001', 'siswa'),
(17, 0, 0, 'tkr18001', 'tkr18001', 'siswa'),
(18, 0, 0, 'tptu18001', 'tptu18001', 'siswa'),
(19, 0, 0, 'tkj18001', 'tkj18001', 'siswa'),
(20, 0, 0, 'tptu18002', 'tptu18002', 'siswa'),
(21, 0, 0, 'ein18002', 'ein18002', 'siswa'),
(48, 0, 0, 'ein18003', 'ein18003', 'siswa'),
(49, 0, 0, 'rpl18004', 'rpl18004', 'siswa'),
(50, 0, 0, 'tptu18003', 'tptu18003', 'siswa'),
(51, 0, 53, 'pgri303', 'pgri303', 'guru'),
(52, 0, 0, 'rpl18001', 'rpl18001', 'siswa'),
(53, 0, 0, 'rpl18002', 'rpl18002', 'siswa'),
(54, 61, 0, 'tkj18001', 'tkj18001', 'siswa'),
(55, 62, 0, 'rpl18002', 'rpl18002', 'siswa'),
(56, 0, 0, 'rpl18001', 'rpl18001', 'siswa'),
(57, 0, 0, 'tkj18001', 'tkj18001', 'siswa'),
(58, 65, 0, 'eind18001', 'eind18001', 'siswa'),
(59, 0, 0, 'eind18001', 'eind18001', 'siswa'),
(60, 0, 0, 'rpl18001', 'rpl18001', 'siswa'),
(61, 68, 0, 'tkj18001', 'tkj18001', 'siswa'),
(62, 69, 0, 'tkr18001', 'tkr18001', 'siswa'),
(63, 70, 0, 'tptu18001', 'tptu18001', 'siswa'),
(64, 71, 0, 'eind18002', 'eind18002', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('cowo','cewe') NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `status` enum('aktif','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_jurusan`, `id_kelas`, `nis`, `nama`, `photo`, `alamat`, `no_hp`, `tgl_lahir`, `jenis_kelamin`, `angkatan`, `status`) VALUES
(66, 39, 10, 'eind18001', 'Abdul Dilan', 'Abdul_Dilan(eind18001)18.jpg', 'jln kebon manggu rt 01 rw 04 padasuka cimahi', '085324544191', '2000-03-05', 'cowo', '2015', 'aktif'),
(67, 2, 15, 'rpl18001', 'Annashrul Yusuf', 'annashrul_yusuf(rpl18001)18.JPG', 'jln kebon manggu rt 01 rw 04 padasuka cimahi', '085324544191', '2000-04-06', 'cowo', '2015', 'aktif'),
(68, 1, 19, 'tkj18001', 'Dera Rudiana', 'Dera_Rudiana(tkj18001)18.jpg', 'jln cimenteng rt 02 rw 04 cipageran cimahi', '087654562161', '2000-11-26', 'cowo', '2015', 'aktif'),
(69, 38, 17, 'tkr18001', 'Okta Febri Pangestu', 'Okta_Febri_Pangestu(tkr18001)18.jpg', 'jln contong rt 10 rw 02 padasuka cimahi', '085764345262', '2000-10-23', 'cowo', '2015', 'aktif'),
(70, 18, 21, 'tptu18001', 'Rana Yoga Saputra', 'Rana_Yoga_Saputra(tptu18001)18.jpg', 'jln tipar barat rt 04 rw 02 bandung barat', '087666736342', '2000-05-28', 'cowo', '2015', 'aktif'),
(71, 39, 11, 'eind18002', 'Dede Rahman Maulana', 'Dede_Rahman_Maulana(eind18002)18.jpg', 'jln cibabat no 178 cimahi', '085636736181', '2000-07-15', 'cowo', '2015', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id_detail_pembayaran`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id_detail_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
