-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 05:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikum_ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(10) NOT NULL,
  `guru` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `guru`, `tanggal_lahir`, `alamat`, `id_user`) VALUES
('19833267', 'Ahadiyatu Rohmaniyyah S.pd', '1967-12-19', 'Jl. Raya Citayam No.8, Desa/Ke', 'U-009'),
('19843500', 'M.Yunus Aburrahman S.kom', '1985-07-24', 'Jl. Haji Akhyar, Kampung Rawa ', 'U-008'),
('19843659', 'Tasrif S.Pd', '1990-04-17', 'Sasak Panjang, Citayam, Kecama', 'U-014'),
('19843775', 'Khoirul Aditia S.Pd', '1998-05-20', 'Jl. Merpati No. 10, Jakarta', 'U-013'),
('19860990', 'Mita Amelia S.pd', '2000-02-02', 'Jlbelimbing , cipayung', 'U-007'),
('19887459', 'Dimas S.Pd', '1989-10-01', 'Ruko Kartini Grande, Jl. Raya ', 'U-010'),
('19887562', 'Reka sulistiya', '1993-06-05', 'Jl. Raya Cipayung Rt.02/10, De', 'U-012'),
('19888934', 'Harja Wijaya S.Pd', '1970-04-09', 'Jl. Raya Citayam, Bojong Pondo', 'U-011');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `id_mapel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `jam`, `id_kelas`, `id_mapel`) VALUES
('J-003', 'Senin', '07:00 - 08:30', 'K-004', 'M-003'),
('J-004', 'Senin', '07:00 - 08:30', 'K-003', 'M-004'),
('J-007', 'Senin', '08:30 - 10:00', 'K-002', 'M-003'),
('J-008', 'Senin', '08:30 - 10:00', 'K-005', 'M-004'),
('J-012', 'Senin', '10:00 - 11:30', 'K-002', 'M-004'),
('J-013', 'Senin', '10:00 - 11:30', 'K-005', 'M-003'),
('J-016', 'Senin', '13:00 - 14:30', 'K-001', 'M-003'),
('J-017', 'Senin', '13:00 - 14:30', 'K-002', 'M-004'),
('J-022', 'Senin', '08:30 - 10:00', 'K-005', 'M-003'),
('J-023', 'Senin', '07:00 - 08:30', 'K-004', 'M-001');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(10) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `ruangan` varchar(10) NOT NULL,
  `ketua_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `ruangan`, `ketua_kelas`) VALUES
('K-001', 'X-A', 'LT1-01', 'Dedi Pratama'),
('K-002', 'X-B', 'LT1-04', 'Vina Sari'),
('K-003', 'X-C', 'LT1-03', 'Yuni Mulani'),
('K-004', 'XI-A', 'LT2-04', 'Ahmad Rifai'),
('K-005', 'XI-B', 'LT2-03', 'Lukman Hakim');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` varchar(20) NOT NULL,
  `mapel` varchar(30) NOT NULL,
  `id_guru` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `mapel`, `id_guru`) VALUES
('M-001', 'Matematika', '19860990'),
('M-002', 'Bahasa Indonesia', '19843500'),
('M-003', 'Fisika', '19887562'),
('M-004', 'Bahasa Inggris', '19887459'),
('M-005', 'Prakarya', '19888934'),
('M-006', 'Seni Budaya', '19833267'),
('M-007', 'Penjaskes', '19843775'),
('M-008', 'Tahfidz', '19843659');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` varchar(5) NOT NULL,
  `id_siswa` varchar(10) NOT NULL,
  `id_ujian` varchar(10) NOT NULL,
  `total_soal` int(11) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `id_ujian`, `total_soal`, `jawaban_benar`, `nilai`) VALUES
('N-001', '6489093467', 'UJ-0001', 3, 1, 34),
('N-002', '6489093467', 'UJ-0010', 3, 3, 100),
('N-004', '6489093467', 'UJ-0009', 3, 2, 67),
('N-005', '6489093467', 'UJ-0002', 3, 3, 90),
('N-006', '2342340968', 'UJ-0002', 3, 2, 67),
('N-007', '2342340968', 'UJ-0001', 3, 3, 100),
('N-008', '2342340968', 'UJ-0010', 3, 3, 100),
('N-009', '2342340968', 'UJ-0009', 3, 2, 67),
('N-010', '6489093467', 'UJ-0004', 3, 1, 33),
('N-011', '6489093467', 'UJ-0012', 3, 3, 100),
('N-012', '6489093467', 'UJ-0006', 3, 3, 100),
('N-013', '6489093467', 'UJ-0014', 3, 0, 0),
('N-014', '2342340968', 'UJ-0004', 3, 3, 100),
('N-015', '2342340968', 'UJ-0012', 3, 3, 100),
('N-016', '2342340968', 'UJ-0006', 3, 3, 100),
('N-017', '2342340968', 'UJ-0014', 3, 1, 33),
('N-018', '1212424124', 'UJ-0002', 3, 3, 100),
('N-019', '1212424124', 'UJ-0010', 3, 2, 67),
('N-020', '1212424124', 'UJ-0004', 3, 3, 100),
('N-021', '1212424124', 'UJ-0012', 3, 1, 33),
('N-022', '1212424124', 'UJ-0001', 3, 2, 67),
('N-023', '1212424124', 'UJ-0009', 3, 2, 67),
('N-024', '1212424124', 'UJ-0006', 3, 3, 100),
('N-025', '1212424124', 'UJ-0014', 3, 1, 33),
('N-026', '1234567890', 'UJ-0002', 3, 2, 67),
('N-027', '1234567890', 'UJ-0010', 3, 2, 67),
('N-028', '1234567890', 'UJ-0004', 3, 2, 67),
('N-029', '1234567890', 'UJ-0012', 3, 1, 33),
('N-030', '1234567890', 'UJ-0001', 3, 1, 33),
('N-031', '1234567890', 'UJ-0009', 3, 1, 33),
('N-032', '1234567890', 'UJ-0006', 3, 3, 100),
('N-033', '1234567890', 'UJ-0014', 3, 1, 33),
('N-034', '4532523434', 'UJ-0002', 3, 2, 67),
('N-035', '4532523434', 'UJ-0010', 3, 3, 100),
('N-036', '4532523434', 'UJ-0004', 3, 3, 100),
('N-037', '4532523434', 'UJ-0012', 3, 2, 67),
('N-038', '4532523434', 'UJ-0001', 3, 3, 100),
('N-039', '4532523434', 'UJ-0009', 3, 2, 67),
('N-040', '4532523434', 'UJ-0006', 3, 3, 100),
('N-041', '4532523434', 'UJ-0014', 3, 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(10) NOT NULL,
  `siswa` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `siswa`, `tanggal_lahir`, `alamat`, `kontak`, `id_kelas`, `id_user`) VALUES
('1212424124', 'Dewi ayu Lestari', '2005-01-02', 'Jl. Sudirman No. 10, Jakarta', '081234567896', 'K-001', 'U-015'),
('1234567890', 'Andi Wijaya', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-001', 'U-016'),
('1234567891', 'Budi Santoso', '2005-02-02', 'Jl. Kenanga No. 15, Jakarta', '081234567891', 'K-001', 'U-017'),
('2112312312', 'Bayu Nugroho', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-002', 'U-023'),
('2323432432', 'Intan Permatasari', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-003', 'U-028'),
('2342340968', 'Siti Hanifah', '2006-10-18', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-003', 'U-004'),
('2342342342', 'Ayu Kartika', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-003', 'U-027'),
('2342342343', 'Siti Aisyah', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-002', 'U-020'),
('2342344122', 'Rizky Saputra', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-001', 'U-018'),
('2414344243', 'Citra Anggraini', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-004', 'U-033'),
('3423434134', 'Hendra Kurniawan', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-002', 'U-024'),
('4323423423', 'Dimas Yulianto', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-004', 'U-029'),
('4342342332', 'Adi Wijaya', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-003', 'U-026'),
('4523341243', 'Ahmad Prasetyo', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-001', 'U-019'),
('4532523434', 'Putri Maharani', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-002', 'U-021'),
('4634252323', 'Hana Ramadhani', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-005', 'U-035'),
('5343452323', 'Yuni Astuti', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-002', 'U-022'),
('5643435324', 'Budi Santoso', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-003', 'U-025'),
('6489093467', 'Atikah Rahmawati', '2006-07-01', 'Jl. Kenanga No. 15, Jakarta', '087855769000', 'K-005', 'U-006'),
('7436343452', 'Kirana Sari', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-005', 'U-034'),
('7454345345', 'Eka Putra', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-004', 'U-031'),
('7456343452', 'Galih Setiawan', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-004', 'U-030'),
('7466733525', 'Joko Susanto', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-005', 'U-036'),
('7534634642', 'Lutfi Hakim', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-005', 'U-037'),
('8453545643', 'Fitri Handayani', '2005-01-01', 'Jl. Merpati No. 10, Jakarta', '081234567890', 'K-004', 'U-032');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` varchar(20) NOT NULL,
  `id_ujian` varchar(10) NOT NULL,
  `soal` varchar(255) NOT NULL,
  `opsi` varchar(255) NOT NULL,
  `jawaban_benar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `soal`, `opsi`, `jawaban_benar`) VALUES
('S-003', 'UJ-0002', 'Kata \"atau\" merupakan konjungsi yang menyatakan...', 'Tujuan,Pilihan,Temporal,Kesimpulan,Syarat', 'Pilihan'),
('S-004', 'UJ-0002', 'Cerpen merupakan salah satu karya sastra yang berbentuk...', 'Nonfiksi,Bait,Prosa,Dialog,Lingkaran', 'Prosa'),
('S-005', 'UJ-0010', 'Perbedaan antara cerpen dan puisi adalah...', 'Penggunaan imajinasi,Alur,Gaya bahasa tertentu,Tema,Rumusan masalah', 'Alur'),
('S-006', 'UJ-0002', 'Di bawah ini yang termasuk ke dalam unsur intrinsik cerpen yaitu...', 'Latar atau setting,Sajak,Tipografi,Klimaks,Penulis', 'Latar atau setting'),
('S-007', 'UJ-0010', 'Di bawah ini yang tidak termasuk ke dalam jenis puisi lama yaitu...', 'Syair,Karmina,Gurindam,Myte,Lagu', 'Myte'),
('S-008', 'UJ-0010', 'Siapa Aku, Kecuali', 'Muhammad,Ramadan,Akbar,Orang Ciputat,Perempuan', 'Perempuan'),
('S-009', 'UJ-0009', '2 + X = 10', '15,6,9,2,8', '8'),
('S-010', 'UJ-0009', '10 Bola = 15.000 , 25 Bola = ...', '30.000,37.500,20.000,27.500,45.000', '37.500'),
('S-011', 'UJ-0001', '2x + 5y = 15 , 5x + y = 3 , x = ...', '20,10,0,5,3', '0'),
('S-012', 'UJ-0001', '1 + 2 + 3 + ... + 10 =', '110,30,150,55,60', '55'),
('S-013', 'UJ-0001', 'Luas Segitiga denga Tinggi = 25 dan Alas = 10 adalah...', '125,200,250,100,75', '125'),
('S-014', 'UJ-0009', 'Segitiga siku-siku dengan Alas = 15 dan Tinggi = 20, Berapa panjang sisi miring ?', '30,25,23,35,17', '25'),
('S-015', 'UJ-0006', 'Berikut ini yang termasuk ke dalam teknik pembuatan keramik adalah …', 'Teknik arsir,Teknik dussel,Teknik slab,Teknik pemalaman,Teknik air brush', 'Teknik slab'),
('S-016', 'UJ-0006', 'Karya seni patung termasuk ke dalam karya seni rupa …', '1 Dimensi,2 Dimensi,3 Dimensi,Terapan,Kerajinan', '3 Dimensi'),
('S-017', 'UJ-0006', 'Cabang dari seni rupa yang menciptakan sebuah alat komunikasi dengan gambar adalah …', 'Seni patung,Seni lukis,Seni kerajinan,Seni kriya,Desain komunikasi visual', 'Desain komunikasi visual'),
('S-018', 'UJ-0014', 'Secara umum, musik berfungsi sebagai media …', 'Rekreatif,Informatif,Atraktif,Estetik,Edukatif', 'Rekreatif'),
('S-019', 'UJ-0014', 'Berikut ini yang bukan termasuk dalam fungsi utama musik tradisional adalah …', 'Sarana upacara adat,Media ekspresi individu,Pengiring tari,Hiburan rakyat,Media promosi produk', 'Media promosi produk'),
('S-020', 'UJ-0014', 'Salah satu prinsip yang disebut sebagai seni rupa adalah …', 'Prinsip ritme,Prinsip persatuan,Prinsip orientasi,Prinsip keseimbangan,Prinsip estetika', 'Prinsip persatuan'),
('S-021', 'UJ-0004', '\"She __________ (to go) to the market every Saturday.\"', 'goes,went,going,gone,done', 'went'),
('S-022', 'UJ-0004', 'Pilih sinonim yang paling tepat untuk kata \"happy\":', 'Sad,Joyful,Angry,Tired,Unhappy', 'Joyful'),
('S-023', 'UJ-0004', 'Pilih antonim yang paling tepat untuk kata \"difficult\":', 'Easy,Hard,Complex,Tough,Not Easy', 'Easy'),
('S-024', 'UJ-0012', '\"If I __________ (to be) you, I would study harder.\"', 'am,was,were,be,are', 'am'),
('S-025', 'UJ-0012', 'When did the robbery happen?', 'Sunday morning,Saturday morning,Saturday afternoon,Monday evening,Sunday afternoon', 'Sunday morning'),
('S-026', 'UJ-0012', 'Bob: __________ with that sunglasses.', 'Do you have,You look so cool,Do you belong,You look happy,Are those yours', 'You look so cool');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` varchar(10) NOT NULL,
  `id_mapel` varchar(10) NOT NULL,
  `jenis_ujian` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_mapel`, `jenis_ujian`) VALUES
('UJ-0001', 'M-001', 'Ujian Tengah Semester'),
('UJ-0002', 'M-002', 'Ujian Tengah Semester'),
('UJ-0003', 'M-003', 'Ujian Tengah Semester'),
('UJ-0004', 'M-004', 'Ujian Tengah Semester'),
('UJ-0005', 'M-005', 'Ujian Tengah Semester'),
('UJ-0006', 'M-006', 'Ujian Tengah Semester'),
('UJ-0007', 'M-007', 'Ujian Tengah Semester'),
('UJ-0008', 'M-008', 'Ujian Tengah Semester'),
('UJ-0009', 'M-001', 'Ujian Akhir Semester'),
('UJ-0010', 'M-002', 'Ujian Akhir Semester'),
('UJ-0011', 'M-003', 'Ujian Akhir Semester'),
('UJ-0012', 'M-004', 'Ujian Akhir Semester'),
('UJ-0013', 'M-005', 'Ujian Akhir Semester'),
('UJ-0014', 'M-006', 'Ujian Akhir Semester'),
('UJ-0015', 'M-007', 'Ujian Akhir Semester'),
('UJ-0016', 'M-008', 'Ujian Akhir Semester');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_induk`, `password`, `fullname`, `role`) VALUES
('U-003', '19864268', '180898', 'Iis Sulastri', 'Kesiswaan'),
('U-004', '2342340968', '181006', 'Siti Hanifah', 'Siswa'),
('U-006', '6489093467', '010706', 'Atikah Rahmawati', 'Siswa'),
('U-007', '19860990', '020200', 'Mita Amelia S.pd', 'Guru'),
('U-008', '19843500', '240785', 'M.Yunus Aburrahman S.kom', 'Guru'),
('U-009', '19833267', '191267', 'Ahadiyatu Rohmaniyyah S.pd', 'Guru'),
('U-010', '19887459', '011089', 'Dimas S.Pd', 'Guru'),
('U-011', '19888934', '090470', 'Harja Wijaya S.Pd', 'Guru'),
('U-012', '19887562', '050693', 'Reka sulistiya', 'Guru'),
('U-013', '19843775', '200598', 'Khoirul Aditia S.Pd', 'Guru'),
('U-014', '19843659', '170490', 'Tasrif S.Pd', 'Guru'),
('U-015', '1212424124', '020105', 'Dewi Ayu Lestari', 'Siswa'),
('U-016', '1234567890', '010105', 'Andi Wijaya', 'Siswa'),
('U-017', '1234567891', '020205', 'Budi Santoso', 'Siswa'),
('U-018', '2342344122', '010105', 'Rizky Saputra', 'Siswa'),
('U-019', '4523341243', '010105', 'Ahmad Prasetyo', 'Siswa'),
('U-020', '2342342343', '010105', 'Siti Aisyah', 'Siswa'),
('U-021', '4532523434', '010105', 'Putri Maharani', 'Siswa'),
('U-022', '5343452323', '010105', 'Yuni Astuti', 'Siswa'),
('U-023', '2112312312', '010105', 'Bayu Nugroho', 'Siswa'),
('U-024', '3423434134', '010105', 'Hendra Kurniawan', 'Siswa'),
('U-025', '5643435324', '010105', 'Budi Santoso', 'Siswa'),
('U-026', '4342342332', '010105', 'Adi Wijaya', 'Siswa'),
('U-027', '2342342342', '010105', 'Ayu Kartika', 'Siswa'),
('U-028', '2323432432', '010105', 'Intan Permatasari', 'Siswa'),
('U-029', '4323423423', '010105', 'Dimas Yulianto', 'Siswa'),
('U-030', '7456343452', '010105', 'Galih Setiawan', 'Siswa'),
('U-031', '7454345345', '010105', 'Eka Putra', 'Siswa'),
('U-032', '8453545643', '010105', 'Fitri Handayani', 'Siswa'),
('U-033', '2414344243', '010105', 'Citra Anggraini', 'Siswa'),
('U-034', '7436343452', '010105', 'Kirana Sari', 'Siswa'),
('U-035', '4634252323', '010105', 'Hana Ramadhani', 'Siswa'),
('U-036', '7466733525', '010105', 'Joko Susanto', 'Siswa'),
('U-037', '7534634642', '010105', 'Lutfi Hakim', 'Siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `FK_user` (`id_user`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `kelas` (`kelas`),
  ADD UNIQUE KEY `ruangan` (`ruangan`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
