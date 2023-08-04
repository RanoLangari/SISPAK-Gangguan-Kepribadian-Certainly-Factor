-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 03:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gangguan_kepribadian`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id_d` varchar(10) NOT NULL,
  `idduser` varchar(10) NOT NULL,
  `iddgej` varchar(10) NOT NULL,
  `dgej` varchar(100) NOT NULL,
  `dbot` float NOT NULL,
  `dfrasa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` varchar(10) NOT NULL,
  `id_kuser` varchar(10) NOT NULL,
  `id_kpenyakit` varchar(10) NOT NULL,
  `kpenyakit` varchar(100) NOT NULL,
  `persentase` float NOT NULL,
  `id_ksolusi` varchar(10) NOT NULL,
  `kdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_kuser`, `id_kpenyakit`, `kpenyakit`, `persentase`, `id_ksolusi`, `kdate`) VALUES
('K01', 'U03', 'JG09', 'dependen', 98.04, 'S09', '09/07/2023, 09:52:14 am'),
('K02', 'U04', 'JG08', 'avoidant', 98.45, 'S08', '09/07/2023, 11:03:14 am'),
('K03', 'U05', 'JG07', 'narsisitik', 100, 'S07', '10/07/2023, 09:28:46 am'),
('K04', 'U06', 'JG09', 'dependen', 100, 'S09', '10/07/2023, 09:51:34 am'),
('K05', 'U07', 'JG10', 'obsesif kompulsif', 99.51, 'S10', '10/07/2023, 11:21:40 am'),
('K06', 'U08', 'JG09', 'dependen', 99.54, 'S09', '10/07/2023, 11:31:52 am'),
('K07', 'U09', 'JG07', 'narsisitik', 100, 'S07', '10/07/2023, 11:44:19 am'),
('K08', 'U10', 'JG03', 'skizotipal', 87.3, 'S03', '11/07/2023, 09:13:09 am'),
('K09', 'U11', 'JG07', 'narsisitik', 96.73, 'S07', '11/07/2023, 09:36:05 am'),
('K10', 'U12', 'JG07', 'narsisitik', 100, 'S07', '11/07/2023, 09:58:11 am'),
('K11', 'U13', 'JG03', 'skizotipal', 99.99, 'S03', '11/07/2023, 10:26:24 am'),
('K12', 'U14', 'JG07', 'narsisitik', 100, 'S07', '11/07/2023, 10:46:31 am'),
('K13', 'U15', 'JG03', 'skizotipal', 96.55, 'S03', '01/08/2023, 08:33:42 am'),
('K14', 'U16', 'JG09', 'dependen', 96.59, 'S09', '01/08/2023, 08:44:54 am'),
('K15', 'U17', 'JG10', 'obsesif kompulsif', 99.62, 'S10', '01/08/2023, 09:35:31 am'),
('K16', 'U18', 'JG10', 'obsesif kompulsif', 99.42, 'S10', '01/08/2023, 09:46:20 am'),
('K17', 'U19', 'JG10', 'obsesif kompulsif', 100, 'S10', '01/08/2023, 10:13:20 am'),
('K18', 'U20', 'JG08', 'avoidant', 74.67, 'S08', '01/08/2023, 10:36:03 am');

-- --------------------------------------------------------

--
-- Table structure for table `solusi`
--

CREATE TABLE `solusi` (
  `id_solusi` varchar(10) NOT NULL,
  `id_spenyakit` varchar(10) NOT NULL,
  `n_spenyakit` varchar(100) NOT NULL,
  `des_solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solusi`
--

INSERT INTO `solusi` (`id_solusi`, `id_spenyakit`, `n_spenyakit`, `des_solusi`) VALUES
('S01', 'JG01', 'paranoid', 'Mengelola stress dengan baik, pemberian dukungan dari keluarga, menjaga hubungan sosial dengan orang lain, berpartisipasi aktif dalam pergaulan dan aktivitas yang disenangi, berbagi cerita dengan teman dan keluarga saat menghadapi masalah, serta melakukan konsultasi ke psikolog sehingga di berikan terapi thought records.'),
('S02', 'JG02', 'skizoid', 'Menghindari Stress, selalu berpikir positif, menggunakan waktu luang untuk hal hal yang baik,  Melakukan pelatihan keterampilan sosial dengan psikolog.'),
('S03', 'JG03', 'skizotipal', 'Melakukan terapi kognitif dengan mencari tahu penyebab munculnya pikiran dan perilaku negatif serta mengubahnya ke arah positif, melakukan pengobatan antipsikotik dengan pengobatan komunitas dan pelatihan keterampilan social berkonsultasi dengan psikolog.'),
('S04', 'JG04', 'antisosial', 'Melakukan konsultasi ke psikolog sehingga mendapatkan terapi seperti Cognitive behavior therapy, schema focused therapy, dan dialectical behavior therapy.'),
('S05', 'JG05', 'ambang', 'Berlatih komunikasi yang terbuka dan sehat, waspada dan tenang dalam menghadapi ancaman, berkonsultasi ke psikolog agar dapat melakukan psikoterapi dan farmakoterapi berupa antidepresan amitriptyline dan imipramine.'),
('S06', 'JG06', 'histrionik', 'Melakukan konsultasi ke psikolog sehingga bisa diberikan psikoterapi metode suportif dan dinamis serta farmakoterapi.'),
('S07', 'JG07', 'narsisitik', 'Melakukan psikoterapi dan farmakoterapi ke psikolog, melakukan terapi dirumah dengan melibatkan anggita keluarga yaitu terapi bicara unutk membantu menjalin hubungan yang lebih baik dengan orang lain.'),
('S08', 'JG08', 'avoidant', 'Konsultasi dengan psikolog agar diberikan pengobatan Selective Serotonin Reuptake Inhibitors (SSRI) dan Venlafaxin serta pengobatan farmakoterapi.'),
('S09', 'JG09', 'dependen', 'Berkonsultasi ke psikolog sehingga mendaptkan terapi kepribadian dan pengobatan CBT (Cognitive Behavioral Therapy).'),
('S10', 'JG10', 'obsesif kompulsif', 'Berkonsultasi ke psikolog sehingga mendaptlkan pengobatan CBT (Cognitive Behavioral Therapy).');

-- --------------------------------------------------------

--
-- Table structure for table `taturancf`
--

CREATE TABLE `taturancf` (
  `id_cf` varchar(10) NOT NULL,
  `id_agejala` varchar(10) NOT NULL,
  `agejala` varchar(200) NOT NULL,
  `id_apenyakit` varchar(10) NOT NULL,
  `apenyakit` varchar(30) NOT NULL,
  `frasa` varchar(30) NOT NULL,
  `bobotcf` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taturancf`
--

INSERT INTO `taturancf` (`id_cf`, `id_agejala`, `agejala`, `id_apenyakit`, `apenyakit`, `frasa`, `bobotcf`) VALUES
('A01', 'G01', 'Banyak kecurigaan terhadap orang lain\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A02', 'G02', 'bersikap kasar', 'JG01', 'paranoid', 'kadang', 0.6),
('A03', 'G03', 'Kesulitan bersosialisasi dengan orang lain\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A04', 'G04', 'Tidak mempercayai teman dekat (sahabat)\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A05', 'G05', 'Kurang berminat atau kurang menyukai hubungan dekat seperti berpacaran\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A06', 'G06', 'Susah  memiliki teman akrab\r\n', 'JG01', 'paranoid', 'kadang', 0.6),
('A07', 'G07', 'Membatasi diri dalam hubungan yang lebih dekat karena takut dipermalukan atau diperolok\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A08', 'G08', 'Keengganan untuk menjalani hubungan dengan orang lain\r\n', 'JG01', 'paranoid', 'sering', 0.8),
('A09', 'G03', 'Kesulitan bersosialisasi dengan orang lain\r\n', 'JG02', 'skizoid', 'sering', 0.8),
('A10', 'G05', 'Kurang berminat atau kurang menyukai hubungan dekat seperti berpacaran\r\n', 'JG02', 'skizoid', 'sering', 0.8),
('A11', 'G06', 'Kurang berminat untuk berinteraksi dengan lawan jenis\r\n', 'JG02', 'skizoid', 'sering', 0.8),
('A12', 'G07', ' Bersikap masa bodoh terhadap pujian atau kritikan orang lain\r\n', 'JG02', 'skizoid', 'kadang', 0.6),
('A13', 'G08', ' Tidak mampu mengekspresikan kemarahan terhadap orang lain\r\n', 'JG02', 'skizoid', 'jarang', 0.4),
('A14', 'G22', 'Perasaan kosong (tidak merasakan kebahagiaan, harapan, kepuasan, atau keinginan terhadap sesuatu)\r\n', 'JG02', 'skizoid', 'sering', 0.8),
('A15', 'G32', 'Keengganan untuk menjalani hubungan dengan orang lain\r\n', 'JG02', 'skizoid', 'sering', 0.8),
('A16', 'G03', 'Kesulitan bersosialisasi dengan orang lain\r\n', 'JG03', 'skizotipal', 'sering', 0.8),
('A17', 'G05', 'Kurang berminat atau kurang menyukai hubungan dekat seperti berpacaran\r\n', 'JG03', 'skizotipal', 'sering', 0.8),
('A18', 'G09', ' Rasa cemas saat melakukan interaksi sosial\r\n', 'JG03', 'skizotipal', 'kadang', 0.6),
('A19', 'G10', 'Susah  memiliki teman akrab\r\n', 'JG03', 'skizotipal', 'kadang', 0.6),
('A20', 'G11', ' Ekspresi emosional yang berlebih\r\n', 'JG03', 'skizotipal', 'sering', 0.8),
('A21', 'G12', 'Perasaan yang kuat untuk berhak mendapatkan sesuatu\r\n', 'JG03', 'skizotipal', 'kadang', 0.6),
('A22', 'G17', 'Menunjukkan emosi dan perilaku yang tidak stabil\r\n', 'JG03', 'skizotipal', 'sering', 0.8),
('A23', 'G18', ' Sangat sulit mengendalikan kemarahan\r\n', 'JG03', 'skizotipal', 'sering', 0.8),
('A24', 'G23', 'Sering merasakan kemarahan', 'JG03', 'skizotipal', 'sering', 0.8),
('A25', 'G24', ' Gaya bicara yang berlebihan atau bertele-tele\r\n', 'JG03', 'skizotipal', 'kadang', 0.6),
('A26', 'G11', ' Ekspresi emosional yang berlebih\r\n', 'JG04', 'Antisosial', 'sering', 0.8),
('A27', 'G13', 'Mudah tersinggung', 'JG04', 'Antisosial', 'sering', 0.8),
('A28', 'G14', 'Bersikap agresif dalam menanggapi sesuatu\r\n', 'JG04', 'Antisosial', 'selalu', 1),
('A29', 'G15', ' Kurang memiliki rasa penyesalan\r\n', 'JG04', 'Antisosial', 'selalu', 1),
('A30', 'G16', ' Memperhatikan keselamatan diri sendiri tapi tidak dengan orang lain\r\n', 'JG04', 'Antisosial', 'sering', 0.8),
('A31', 'G19', 'Perilaku semena-mena tanpa memikirkan akibat yang terjadi\r\n', 'JG04', 'Antisosial', 'sering', 0.8),
('A32', 'G43', 'Tidak suka mengikuti aturan norma sosial yang berlaku\r\n', 'JG04', 'Antisosial', 'selalu', 0.9),
('A33', 'G11', ' Ekspresi emosional yang berlebih\r\n', 'JG05', 'Ambang', 'sering', 0.8),
('A34', 'G15', ' Kurang memiliki rasa penyesalan\r\n', 'JG05', 'Ambang', 'sering', 0.8),
('A35', 'G16', ' Memperhatikan keselamatan diri sendiri tapi tidak dengan orang lain\r\n', 'JG05', 'Ambang', 'kadang', 0.6),
('A36', 'G17', 'Menunjukkan emosi dan perilaku yang tidak stabil\r\n', 'JG05', 'Ambang', 'selalu', 1),
('A37', 'G18', ' Sangat sulit mengendalikan kemarahan\r\n', 'JG05', 'Ambang', 'sering', 0.8),
('A38', 'G19', 'Perilaku semena-mena tanpa memikirkan akibat yang terjadi\r\n', 'JG05', 'Ambang', 'sering', 0.8),
('A39', 'G20', 'Menunjukkan perilaku sangat boros\r\n', 'JG05', 'Ambang', 'sering', 0.8),
('A40', 'G23', 'Sering merasakan kemarahan', 'JG05', 'Ambang', 'sering', 0.8),
('A41', 'G08', ' Tidak mampu mengekspresikan kemarahan terhadap orang lain\r\n', 'JG06', 'Histrionik', 'jarang', 0.4),
('A42', 'G11', ' Ekspresi emosional yang berlebih\r\n', 'JG06', 'Histrionik', 'sering', 0.8),
('A43', 'G17', 'Menunjukkan emosi dan perilaku yang tidak stabil\r\n', 'JG06', 'Histrionik', 'sering', 0.8),
('A44', 'G18', ' Sangat sulit mengendalikan kemarahan\r\n', 'JG06', 'Histrionik', 'sering', 0.8),
('A45', 'G21', ' Sangat mudah dipengaruhi orang lain\r\n', 'JG06', 'Histrionik', 'kadang', 0.6),
('A46', 'G22', 'Perasaan kosong (tidak merasakan kebahagiaan, harapan, kepuasan, atau keinginan terhadap sesuatu)\r\n', 'JG06', 'Histrionik', 'sering', 0.8),
('A47', 'G23', 'Sering merasakan kemarahan', 'JG06', 'Histrionik', 'sering', 0.8),
('A48', 'G24', ' Gaya bicara yang berlebihan atau bertele-tele\r\n', 'JG06', 'Histrionik', 'kadang', 0.6),
('A49', 'G44', 'Suka menjadi pusat perhatian', 'JG06', 'Histrionik', 'sering', 0.8),
('A50', 'G12', 'Perasaan yang kuat untuk berhak mendapatkan sesuatu\r\n', 'JG07', 'Narsisitik', 'kadang', 0.6),
('A51', 'G25', 'Keinginan yang tinggi untuk dipuji\r\n', 'JG07', 'Narsisitik', 'selalu', 1),
('A52', 'G26', 'Iri pada orang lain', 'JG07', 'Narsisitik', 'sering', 0.8),
('A53', 'G27', 'Kecenderungan memanfaatkan orang lain\r\n', 'JG07', 'Narsisitik', 'sering', 0.8),
('A54', 'G28', 'Terfokus pada keberhasilan', 'JG07', 'Narsisitik', 'sering', 0.8),
('A55', 'G29', ' Suka memuji kelebihan dalam diri sendiri\r\n', 'JG07', 'Narsisitik', 'selalu', 1),
('A56', 'G40', ' Pengabdian yang berlebihan pada pekerjaan, hingga mengabaikan kesenangan dan persahabatan\r\n', 'JG07', 'Narsisitik', 'kadang', 0.6),
('A57', 'G42', 'Sangat terfokus pada detail', 'JG07', 'Narsisitik', 'sering', 0.8),
('A58', 'G03', 'Kesulitan bersosialisasi dengan orang lain\r\n', 'JG08', 'Avoidant', 'sering', 0.8),
('A59', 'G05', 'Kurang berminat atau kurang menyukai hubungan dekat seperti berpacaran\r\n', 'JG08', 'Avoidant', 'sering', 0.8),
('A60', 'G10', 'Susah  memiliki teman akrab', 'JG08', 'Avoidant', 'kadang', 0.6),
('A61', 'G30', 'Merasa rendah diri', 'JG08', 'Avoidant', 'kadang', 0.6),
('A62', 'G31', 'Membatasi diri dalam hubungan yang lebih dekat karena takut dipermalukan atau diperolok\r\n', 'JG08', 'Avoidant', 'sering', 0.8),
('A63', 'G32', 'Keengganan untuk menjalani hubungan dengan orang lain\r\n', 'JG08', 'Avoidant', 'sering', 0.8),
('A64', 'G33', 'Merasa diri tidak mampu dan tidak menarik\r\n', 'JG08', 'Avoidant', 'sering', 0.8),
('A65', 'G35', 'Sulit melakukan segala sesuatu sendiri\r\n', 'JG08', 'Avoidant', 'selalu', 1),
('A66', 'G36', 'Kurangnya rasa percaya diri', 'JG08', 'Avoidant', 'sering', 0.8),
('A67', 'G30', 'Merasa rendah diri', 'JG09', 'Dependen', 'kadang', 0.6),
('A68', 'G33', 'Merasa diri tidak mampu dan tidak menarik\r\n', 'JG09', 'Dependen', 'sering', 0.8),
('A69', 'G34', 'Sulit mengambil keputusan tanpa saran dan dukungan berlebih dari orang lain\r\n', 'JG09', 'Dependen', 'selalu', 1),
('A70', 'G35', 'Sulit melakukan segala sesuatu sendiri\r\n', 'JG09', 'Dependen', 'selalu', 1),
('A71', 'G36', 'Kurangnya rasa percaya diri', 'JG09', 'Dependen', 'sering', 0.8),
('A72', 'G37', 'Bergantung terhadap orang lain', 'JG09', 'Dependen', 'selalu', 1),
('A73', 'G38', ' Kesulitan mengekspresikan ketidaksetujuan dengan orang lain\r\n', 'JG09', 'Dependen', 'kadang', 0.6),
('A74', 'G28', ' Terfokus pada keberhasilan', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A75', 'G39', 'Bersifat Perfeksionis', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A76', 'G40', ' Pengabdian yang berlebihan pada pekerjaan, hingga mengabaikan kesenangan dan persahabatan\r\n', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A77', 'G41', ' Bersifat  keras kepala', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A78', 'G42', 'Sangat terfokus pada detail', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A79', 'G45', ' Suka melakukan segala sesuatu secara berulang  (mencuci tangan terus menerus padahal sudah melakuka', 'JG10', 'Obsesif Kompulsif', 'Sering', 0.8),
('A80', 'G46', 'Perasaan cemas yang berlebihan\r\n', 'JG10', 'Obsesif Kompulsif', 'Selalu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tgejala`
--

CREATE TABLE `tgejala` (
  `id_gejala` varchar(10) NOT NULL,
  `n_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgejala`
--

INSERT INTO `tgejala` (`id_gejala`, `n_gejala`) VALUES
('G01', 'banyak kecurigaan terhadap orang lain'),
('G02', 'bersikap kasar'),
('G03', 'kesulitan bersosialisasi dengan orang lain'),
('G04', 'tidak mempercayai teman dekat (sahabat)'),
('G05', 'kurang berminat atau kurang menyukai hubungan dekat seperti berpacaran'),
('G06', 'kurang berminat untuk berinteraksi dengan lawan jenis'),
('G07', 'bersikap masa bodoh terhadap pujian atau kritikan orang lain'),
('G08', 'tidak mampu mengekspresikan kemarahan terhadap orang lain'),
('G09', 'rasa cemas saat melakukan interaksi sosial'),
('G10', 'susah  memiliki teman akrab'),
('G11', 'ekspresi emosional yang berlebih'),
('G12', 'perasaan yang kuat untuk berhak mendapatkan sesuatu'),
('G13', 'mudah tersinggung'),
('G14', 'bersikap agresif dalam menanggapi sesuatu'),
('G15', 'kurang memiliki rasa penyesalan'),
('G16', 'memperhatikan keselamatan diri sendiri tapi tidak dengan orang lain'),
('G17', 'menunjukkan emosi dan perilaku yang tidak stabil'),
('G18', 'sangat sulit mengendalikan kemarahan'),
('G19', 'perilaku semena-mena tanpa memikirkan akibat yang terjadi'),
('G20', 'menunjukkan perilaku sangat boros'),
('G21', 'sangat mudah dipengaruhi orang lain'),
('G22', 'perasaan kosong (tidak merasakan kebahagiaan, harapan, kepuasan, atau keinginan terhadap sesuatu)'),
('G23', 'sering merasakan kemarahan'),
('G24', 'gaya bicara yang berlebihan atau bertele-tele'),
('G25', 'keinginan yang tinggi untuk dipuji'),
('G26', 'iri pada orang lain'),
('G27', 'kecenderungan memanfaatkan orang lain'),
('G28', 'terfokus pada keberhasilan'),
('G29', 'suka memuji kelebihan dalam diri sendiri'),
('G30', 'merasa rendah diri'),
('G31', 'membatasi diri dalam hubungan yang lebih dekat karena takut dipermalukan atau diperolok'),
('G32', 'keengganan untuk menjalani hubungan dengan orang lain'),
('G33', 'merasa diri tidak mampu dan tidak menarik'),
('G34', 'sulit mengambil keputusan tanpa saran dan dukungan berlebih dari orang lain'),
('G35', 'sulit melakukan segala sesuatu sendiri'),
('G36', 'kurangnya rasa percaya diri'),
('G37', 'bergantung terhadap orang lain'),
('G38', 'kesulitan mengekspresikan ketidaksetujuan dengan orang lain'),
('G39', 'bersifat perfeksionis'),
('G40', 'pengabdian yang berlebihan pada pekerjaan, hingga mengabaikan kesenangan dan persahabatan'),
('G41', 'bersifat  keras kepala'),
('G42', 'sangat terfokus pada detail'),
('G43', 'tidak suka mengikuti aturan norma sosial yang berlaku'),
('G44', 'suka menjadi pusat perhatian'),
('G45', 'suka melakukan segala sesuatu secara berulang  (mencuci tangan terus menerus padahal sudah melakukan'),
('G46', 'perasaan cemas yang berlebihan');

-- --------------------------------------------------------

--
-- Table structure for table `tpenyakit`
--

CREATE TABLE `tpenyakit` (
  `id_penyakit` varchar(10) NOT NULL,
  `n_penyakit` varchar(100) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpenyakit`
--

INSERT INTO `tpenyakit` (`id_penyakit`, `n_penyakit`, `solusi`) VALUES
('JG01', 'paranoid', 'Mengelola stress dengan baik, pemberian dukungan dari keluarga, menjaga hubungan sosial dengan orang lain, berpartisipasi aktif dalam pergaulan dan aktivitas yang disenangi, berbagi cerita dengan teman dan keluarga saat menghadapi masalah, serta melakukan konsultasi ke psikolog sehingga di berikan terapi thought records.'),
('JG02', 'skizoid', 'Menghindari Stress, selalu berpikir positif, menggunakan waktu luang untuk hal hal yang baik,  Melakukan pelatihan keterampilan sosial dengan psikolog.'),
('JG03', 'skizotipal', 'Melakukan terapi kognitif dengan mencari tahu penyebab munculnya pikiran dan perilaku negatif serta mengubahnya ke arah positif, melakukan pengobatan antipsikotik dengan pengobatan komunitas dan pelatihan keterampilan social berkonsultasi dengan psikolog.'),
('JG04', 'antisosial', 'Melakukan konsultasi ke psikolog sehingga mendapatkan terapi seperti Cognitive behavior therapy, schema focused therapy, dan dialectical behavior therapy.'),
('JG05', 'ambang', 'Berlatih komunikasi yang terbuka dan sehat, waspada dan tenang dalam menghadapi ancaman, berkonsultasi ke psikolog agar dapat melakukan psikoterapi dan farmakoterapi berupa antidepresan amitriptyline dan imipramine.'),
('JG06', 'histrionik', 'Melakukan konsultasi ke psikolog sehingga bisa diberikan psikoterapi metode suportif dan dinamis serta farmakoterapi.'),
('JG07', 'narsisitik', 'Melakukan psikoterapi dan farmakoterapi ke psikolog, melakukan terapi dirumah dengan melibatkan anggita keluarga yaitu terapi bicara unutk membantu menjalin hubungan yang lebih baik dengan orang lain.'),
('JG08', 'avoidant', 'Konsultasi dengan psikolog agar diberikan pengobatan Selective Serotonin Reuptake Inhibitors (SSRI) dan Venlafaxin serta pengobatan farmakoterapi.'),
('JG09', 'dependen', 'Berkonsultasi ke psikolog sehingga mendaptkan terapi kepribadian dan pengobatan CBT (Cognitive Behavioral Therapy).'),
('JG10', 'obsesif kompulsif', 'Berkonsultasi ke psikolog sehingga mendaptlkan pengobatan CBT (Cognitive Behavioral Therapy).');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id_tuser` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id_tuser`, `username`, `password`, `nama`, `jenis_kelamin`, `prodi`, `alamat`, `hp`, `level`) VALUES
('U01', 'admin', '$2y$10$Kkabht3R0udJy32.8HNGbe3vMOJuYSak6maBqWtp89TtSLpEvVPJO', 'admin', 'Perempuan', 'NULL', 'admin', 'admin', 'admin'),
('U03', 'archangela', '$2y$10$GjHFBluWg9/FPFbU/j7FXuAvKO841NBxi2ku73isow4aLAkcY6pjS', 'Archangela Zita Hardin ', 'Perempuan', 'Ilmu Komputer	', 'Penfui', '081256633480', 'client'),
('U04', 'dimas', '$2y$10$KGcsTzPGLM7bPFJXqdzOPOxppTetaVb9cE37h9gsxnMm56ywH/aSG', 'Dimas Suhada', 'Laki-Laki', 'Ilmu Komputer	', 'Bolok', '082360929369', 'client'),
('U05', 'shanty', '$2y$10$79Sc8bljde0BTNBm37BVeuOloDV0VLtKkPZaebz3zCIfuv6DOCIOu', 'Shanty Ratu Djawa', 'Perempuan', 'Ilmu Komputer	', 'Penfui', '082144999266', 'client'),
('U06', 'fadli', '$2y$10$6mnVwal7MmnFEMdlWZ7pYOKyXzfqv5xEw/5m3kKh1zLQhxik92DBa', 'Fadli F. Djati', 'Laki-Laki', 'Ilmu Komputer	', 'nasi panaf', '081339453510', 'client'),
('U07', 'delsiana', '$2y$10$r3ZmnGSGfwF64wJtjHvOIOyIrINI6I2XsgKdf/9eIFMcq.QtDUe3S', 'Delsiana Osi Seran ', 'Perempuan', 'Ilmu Komputer	', 'penfui', '081339415331', 'client'),
('U08', 'irene', '$2y$10$OO98MQCq7Kxob9w7pEe3CuQx.umDJwkTFbXeU8UnHbgITIjbrPpbq', 'Irene Dewi Lorenza', 'Perempuan', 'Ilmu Komputer	', 'Liliba', '081237451462', 'client'),
('U09', ' trivena', '$2y$10$kUhw0YDZVhvcySLJn9p6UOX85y5D2Y23f9HpJdnFZPub/USE1MhKa', 'Trivena Dayana Missa', 'Perempuan', 'Ilmu Komputer	', 'Lasiana', '081238027617', 'client'),
('U10', ' kisan', '$2y$10$gy92swJrrYAE6dE6jb8R3O9BXnTcIwbdvXQmNf5xgTsJRFHD6CqHm', 'Kisan Emiliano Rape Tupen ', 'Laki-Laki', 'Ilmu Komputer	', 'Liliba', '082146276880', 'client'),
('U11', 'monica', '$2y$10$ItqmDYY/WrE0NhwDuBCGj./53REBgICtsK8SbV6VXWLfMjO9C31nC', 'Monica puan', 'Perempuan', 'Teknik Elektro	', 'penfui', '085239928493', 'client'),
('U12', 'natalia', '$2y$10$kflyFG8JxrqVi.mS.ZEXz.BWUVdYhgCh7xG4pwcpdWbYXUgA0uok.', 'Natalia Kharina Angsari', 'Perempuan', 'Biologi	', 'Lanudal-penfui', '081337536074', 'client'),
('U13', ' ahmad', '$2y$10$XNMhF8kqYdEP8Anpgsx0f.mBage0qnjFq8KKF7Ma9nt01hR7h/O/S', 'Ahmad Abdullah ', 'Laki-Laki', 'Teknik Pembuatan Tenun Ikat	', 'oesapa\r\n', '085239650758', 'client'),
('U14', ' eufemia', '$2y$10$t1G0icMl/wjR8BZbkksMHeydg6NDXq6RCyPFg8Vq3PcYYSAadms1G', 'Eufemia Putri Ndung', 'Perempuan', 'Kimia	', 'Penfui', '081314469717', 'client'),
('U15', ' syahril', '$2y$10$rdmWNPQYL2Dumqrdj399iesgynBANEbAySWGv7zK8qeOEko8LGC7u', 'Syahril Rudi', 'Laki-Laki', 'Teknik Sipil	', 'Oesapa', '082457826826', 'client'),
('U16', ' maria', '$2y$10$NHao.zW31UodFG3zaNHeq.hNmrNamfbSUdfUZALurDo6HYkVeJ0Ee', 'Maria Fatima Seran', 'Perempuan', 'Teknik Arsitektur	', 'Penfui', '082567834235', 'client'),
('U17', ' yusitiana', '$2y$10$m7PUL6G6SZdhA7ps.xY0EO18WOCEU5s28Cat6Z.DwfxBkh72f28t2', 'Yusitiana Claris Fransiska Gala ', 'Perempuan', 'Matematika	', 'Tuak Daun Merah', '082254278741', 'client'),
('U18', ' clarita', '$2y$10$4esOMz0ZRpYi2ao0zUh0GOaG0OtvRZbtdMX6eLvGwqgzu.peOvayi', 'Clarita Anastasia ', 'Perempuan', 'Teknik Pertambangan	', 'Liliba', '082237241569', 'client'),
('U19', 'krisantus', '$2y$10$2hwd.FiC6H45zCHPPmBlUO7zfqCEpUqSiFAc0TEKdKZ/Gd89myva.', 'Krisantus Taek', 'Laki-Laki', 'Teknik Mesin	', 'Oesapa', '082123498490', 'client'),
('U20', ' antonius', '$2y$10$CfXK6N5IFzQx3lfdmmAygO0Me457KSaLCwNkGohMQkhe9jyl1TswS', 'Antonius Dasilva', 'Laki-Laki', 'Fisika	', 'Belo', '085237658702', 'client'),
('U21', 'marselina', '$2y$10$hw7YptFUzT.R6rSgU0SJGeyr/CgRjVdP7KzsqSPE3BES97Emwhh1q', 'Marselina Devita Manek', 'Perempuan', 'Ilmu Komputer	', 'penfui', '081339982567', 'client'),
('U22', 'rivaldy ', '$2y$10$k9Y9a29SIEXs/kIjBezSmOu7ckax8z4SykIZDoFTqXkXPPBSzADnm', 'Antonius Rivaldy Praing', 'Laki-Laki', 'Ilmu Komputer	', 'Liliba', '081236328172', 'client'),
('U23', 'ruvina', '$2y$10$Rk355LnBKzDf4V04a81WsebP01e3NPLMZr8G0DZeGEwjxYBPFzlHy', 'Ruvina F. Malelak', 'Perempuan', 'Ilmu Komputer	', 'Penfui', '085339007588', 'client'),
('U24', 'frederico', '$2y$10$pdj27L41sJBEOQkalLq6eeYc407zu6GjBnoORHooPrTyUh/KrAw3C', 'Frederico H. Andreas Mae', 'Laki-Laki', 'Ilmu Komputer	', 'Liliba', '082335593119', 'client'),
('U25', 'christian', '$2y$10$rwpe6a7Io5AAIceUezL8VuNehfLpuG6UsxIPOIuuCfMBoE68XJLrC', 'Christian Umbu Hermantho Edy', 'Laki-Laki', 'Ilmu Komputer	', 'Oesapa', '082144766276', 'client'),
('U26', 'vladimir', '$2y$10$8Sv2gT2fv2YnOW2Loh2VA.FCfCjVXVqDFAJFCtt1WDPGzvqOqLAMG', 'Vladimir Ivan Koroh ', 'Laki-Laki', 'Ilmu Komputer	', 'Oeba', '082266571794', 'client'),
('U27', 'florensia ', '$2y$10$rRsRFMoXvpTlzRw2/ePXEe4jnQwdKIAUhf1ANMEwpG5okbJamFaXW', 'Florensia Fatima Bau', 'Perempuan', 'Ilmu Komputer	', 'Matani', '082138124645', 'client'),
('U28', 'selena', '$2y$10$do/ikxoCg3bpTTA3vEbKpeh6Hypg/GJ7wrMtg.27pLguvuH/Xi5p6', 'Selena Amtiran', 'Perempuan', 'Teknik Pembuatan Tenun Ikat	', 'Belo', '082359567840', 'client'),
('U29', 'andini ', '$2y$10$9sFneWLrU8xl.HHTGPIn8uSbUbj3zCNDFG.9l8bL5/vhKr852lZWy', 'Andini Mustika', 'Perempuan', 'Ilmu Komputer	', 'Liliba', '082147813599', 'client'),
('U30', 'agustina ', '$2y$10$IQvNyMQN5YVQr0cFfEadi.wKqI1tkvn3nBd.teu5SOioNTP3KY39i', 'Agustina Malelak', 'Perempuan', 'Biologi	', 'Penfui', '082356478964', 'client'),
('U31', 'rambumu', '$2y$10$E7AtJyspS9DsoapKJid.OOHAdpfMfcGptH7wN9iGObMAXkn6URmzC', 'Rambu Mura', 'Perempuan', 'Ilmu Komputer	', 'Liliba', '081237563131', 'client'),
('U32', 'natonis', '$2y$10$LC51Se4jHwA2oHwq7QQau.2LtMx0ZQvKbXnN7XqxTb4wry.U039Uq', 'Maria Rima Natonis', 'Perempuan', 'Teknik Pembuatan Tenun Ikat	', 'Babau', '081239640568', 'client'),
('U33', 'arnold', '$2y$10$iZ/je.Q1nffGgZUsRmVz1urH9BiSW/6X.ElnX3jU9W8sfZetlX7X.', 'Arnold Nubantimo ', 'Laki-Laki', 'Teknik Pembuatan Tenun Ikat	', 'Oeba', '085237450143', 'client'),
('U34', 'lenggu', '$2y$10$11TKvTp8KMMwcrqOBvbYiuyv/oC6a4O5UKYI5IwcAUqKk7BEbmtha', 'Ireni Dewintan Lenggu ', 'Perempuan', 'Ilmu Komputer	', 'Alak', '081337348980', 'client'),
('U35', 'frumensia', '$2y$10$STsSMIGoql4MLmIdCArOQei4vooihVP94DJDpwEYlvwPIMEvqdkPO', 'Frumensia Nirwana Nendong', 'Perempuan', 'Ilmu Komputer	', 'Penfui', '082247876211', 'client'),
('U36', 'goreti', '$2y$10$CxVxYeeEvcb7bGgLAilON.34g8wWLV/hQ/TYOKTChd5I8VBcWzFVe', 'Maria G Nago', 'Perempuan', 'Ilmu Komputer	', 'Penfui', '082145345449', 'client'),
('U37', 'auristela', '$2y$10$WO42NvzjRPUtRgq9YGfUx.EphcIGdra24ojtbuis9r2OwRiOQ1tOK', 'Maria Auristela', 'Perempuan', 'Teknik Pertambangan	', 'Liliba', '082239147865', 'client'),
('U38', 'rivaldi', '$2y$10$TR9cf1WqhPwUAaIh8ZdReeTU147zWeH0tzMc0cmdXb8oGSK8UPdL6', 'Rivaldi Soares', 'Laki-Laki', 'Teknik Pertambangan	', 'TDM', '081239645813', 'client'),
('U39', 'bernardino', '$2y$10$ZO8whsBvHenqim094VUYTOh/3Ix0h.4ZgqukniPrauY0uhhATMxs.', 'Bernardino Dosantos', 'Laki-Laki', 'Teknik Arsitektur	', 'Lasiana', '081239845730', 'client'),
('U40', 'fransiska', '$2y$10$acKoq0k0lDTr5AKlUXfw9OGL8a4vgCIYMtJcHMsydhZ0l/DywqqAu', 'Fransiska Gau', 'Perempuan', 'Kimia	', 'Alak', '081339088130', 'client'),
('U41', 'andreas', '$2y$10$b3DZwpRzWLUeOrC4gbV7SuykXfOOAKKUOklsvN5AHRJj6ybvAvmCq', 'Andreas Sabon', 'Laki-Laki', 'Ilmu Komputer	', 'Matani', '081237645860', 'client'),
('U42', 'alenaf', '$2y$10$iKQVGynXUlaEl7WcbwxEDuQpg3JQxDt4kjs702C.SpLJDj98vDwT.', 'Maria Alenaf', 'Perempuan', 'Teknik Sipil	', 'Liliba', '081246422677', 'client'),
('U43', 'melanie', '$2y$10$PT2i.c7Zog1xanC2pBDfpu4azV8dJ1boKWilwta7G99JzP1qdDaZ2', 'Melanie Dacosta', 'Perempuan', 'Teknik Pembuatan Tenun Ikat	', 'Alak', '082237734675', 'client'),
('U44', 'johanes ', '$2y$10$A/S01PjaAY2Q8NxMCq6In.9viaZFzVbwaseUiqWqvKkz5ae9qPj5K', 'Johanes Vianey', 'Laki-Laki', 'Teknik Sipil	', 'Liliba', '085237065644', 'client'),
('U45', 'cristian ', '$2y$10$/sr3r/z0iQQN74KeQeeAEu6tgogwbz840Vl0eQ.a.H8z9XkfV.CKu', 'Cristian Usfinit ', 'Laki-Laki', 'Teknik Mesin	', 'Oesapa', '085239654786', 'client'),
('U46', 'anastasia ', '$2y$10$VsigMOOF7kLCaz3GNLDsfOyZSJqPr.9YuZSIsI6iZzSR.9/nmAVHi', 'Anastasia Kopa', 'Perempuan', 'Teknik Pertambangan	', 'Liliba', '085375639045', 'client'),
('U47', 'celine', '$2y$10$kKnHqTN1470CKCiPnmtby.FziRqvp8ypIiEIx8.pXOKeB1aWlGUkq', 'Maria Celine Lada', 'Perempuan', 'Biologi	', 'Penfui', '085349856745', 'client'),
('U48', ' juleita', '$2y$10$Dk6ojMJwv2QiF5mK.fqd7.A7vYTiBqxbXjJEsPQXi1guZZ1dt3ncy', 'Maria Juleita Rato', 'Perempuan', 'Biologi	', 'Oesapa', '082237678950', 'client'),
('U49', ' alfredo', '$2y$10$yrmeVLkwN3xtMjReYRgCpOVpwSubvi4BRclFphYJgk840gqJw5nE2', 'Alfredo Lau', 'Laki-Laki', 'Fisika	', 'Liliba', '081239674867', 'client'),
('U50', ' theresia', '$2y$10$GWE46AbCxKWrzXRBCPE/Z.fFSNid7pVT2wwGWI0Wv2ZbcW/TtBMQG', 'Maria Theresia Usboko', 'Perempuan', 'Fisika	', 'Oeba', '081237654823', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id_d`),
  ADD KEY `diagnosis_ibfk_1` (`idduser`),
  ADD KEY `iddgej` (`iddgej`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_kpenyakit` (`id_kpenyakit`),
  ADD KEY `id_ksolusi` (`id_ksolusi`),
  ADD KEY `id_kuser` (`id_kuser`);

--
-- Indexes for table `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id_solusi`),
  ADD KEY `id_spenyakit` (`id_spenyakit`);

--
-- Indexes for table `taturancf`
--
ALTER TABLE `taturancf`
  ADD PRIMARY KEY (`id_cf`),
  ADD KEY `id_agejala` (`id_agejala`),
  ADD KEY `id_apenyakit` (`id_apenyakit`);

--
-- Indexes for table `tgejala`
--
ALTER TABLE `tgejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `tpenyakit`
--
ALTER TABLE `tpenyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_tuser`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`idduser`) REFERENCES `tuser` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnosis_ibfk_2` FOREIGN KEY (`iddgej`) REFERENCES `tgejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_kpenyakit`) REFERENCES `tpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`id_ksolusi`) REFERENCES `solusi` (`id_solusi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_3` FOREIGN KEY (`id_kuser`) REFERENCES `tuser` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solusi`
--
ALTER TABLE `solusi`
  ADD CONSTRAINT `solusi_ibfk_1` FOREIGN KEY (`id_spenyakit`) REFERENCES `tpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taturancf`
--
ALTER TABLE `taturancf`
  ADD CONSTRAINT `taturancf_ibfk_1` FOREIGN KEY (`id_agejala`) REFERENCES `tgejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taturancf_ibfk_2` FOREIGN KEY (`id_apenyakit`) REFERENCES `tpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
