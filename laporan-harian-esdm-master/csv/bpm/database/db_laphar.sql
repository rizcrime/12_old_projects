-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Mei 2019 pada 04.45
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_laphar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_geologi_gempa_bumi`
--

CREATE TABLE IF NOT EXISTS `r_lap_geologi_gempa_bumi` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `LOKASI` text,
  `INFORMASI` text,
  `KONDISI_GEOLOGI_DT` text,
  `PENYEBAB_GEMPA` text,
  `DAMPAK_GEMPA` text,
  `REKOMENDASI` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_geologi_gempa_bumi`
--

INSERT INTO `r_lap_geologi_gempa_bumi` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `LOKASI`, `INFORMASI`, `KONDISI_GEOLOGI_DT`, `PENYEBAB_GEMPA`, `DAMPAK_GEMPA`, `REKOMENDASI`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'Gempa bumi di baratlaut Daruba, Maluku Utara', 'Gempa bumi terjadi pada hari Rabu, 24 April 2019, pukul 09:17:20 WIB. Berdasarkan\r\ninformasi dari BMKG, pusat gempa bumi terletak pada koordinat 2.29°LU dan 128.15°BT,\r\ndengan magnitudo 5.2 pada kedalaman 100 km, berjarak 31 km BaratLaut Daruba, Maluku Utara.\r\n', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', NULL, 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', NULL, 2, '2019-05-12 01:05:32', 'WEB', NULL, NULL, NULL),
(2, '2019-05-13', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', NULL, 'Wilayah yang berdekatan dengan pusat gempa bumi pada umumnya tersusun oleh batuan\r\nvulkanik berumur Pra Tersier, dimana sebagian batuan telah mengalami pelapukan. Batuan\r\nyang telah mengalami pelapukan tersebut dapat memperkuat efek guncangan gempa bumi.\r\n', 'Y', 2, '2019-05-12 03:05:07', 'WEB', 2, '2019-05-12 03:05:46', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_geologi_gerakan_tanah`
--

CREATE TABLE IF NOT EXISTS `r_lap_geologi_gerakan_tanah` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `KETERANGAN` text,
  `DETAIL` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_geologi_gerakan_tanah`
--

INSERT INTO `r_lap_geologi_gerakan_tanah` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `KETERANGAN`, `DETAIL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'Prakiraan wilayah potensi tejadi gerakan tanah di Indonesia pada bulan  April  2019\r\ndibandingkan Maret  2019, potensinya relatif sama tingginya    utamanya wilyah indonesia\r\nbagian Timur, namun terjadi penurunan potensinya meliputi wilayah   Wilayah Sumatera\r\nbagian Timur,Jawa , Bali . dan Nusantenggara Barat.\r\n\r\nGerakan tanah terakhir terjadi :\r\n\r\n1. \r\nKabupaten Sukabumi, Provinsi Jawa Barat \r\n2. \r\nKabupaten Ciamis, Provinsi Jawa Barat \r\n3. Kota Bandar Lampung, Provinsi  Lampung\r\n4. \r\nKabupaten Kotabaru, Provinsi Kalimantan Selatan \r\n\r\nPenyebab gerakan tanah adalah pelapukan tanah yang tebal, kemiringan lereng yang terjal,\r\nserta dipicu oleh curah hujan yang tinggi dengan durasi yang lama sebelum terjadinya\r\ngerakan tanah.', 'Dampak : Gerakan tanah / tanah longsor menyebabkan  1 rumah rusak di  Kabupaten\r\nSukabumi, Provinsi Jawa Barat dan di Kabupaten Ciamis, Provinsi Jawa Barat, akses jalan\r\nterhambat di Kota Bandar Lampung, Provinsi  Lampung, 3 rumah rusak berat dan 4 rumah\r\nrusak ringan,   2 orang meninggal dunia di Kabupaten Kotabaru, Provinsi Kalimantan Selatan.\r\nPeta prakiraan potensi gerakan tanah dari Badan Geologi perlu diacu sebagai peringatan\r\ndini.  Masyarakat dapat mengunduh melalui www.vsi.esdm.go.id', NULL, 2, '2019-05-12 01:05:32', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_geologi_gunung_api`
--

CREATE TABLE IF NOT EXISTS `r_lap_geologi_gunung_api` (
`ID_LAPORAN` int(11) NOT NULL,
  `ID_GUNUNG` int(11) DEFAULT NULL,
  `ID_AKTIVITAS` int(11) DEFAULT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `KETERANGAN` text,
  `DETAIL` text,
  `REKOMENDASI` text,
  `VONA` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_geologi_gunung_api`
--

INSERT INTO `r_lap_geologi_gunung_api` (`ID_LAPORAN`, `ID_GUNUNG`, `ID_AKTIVITAS`, `TANGGAL_LAPORAN`, `KETERANGAN`, `DETAIL`, `REKOMENDASI`, `VONA`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, 1, 1, '2019-05-12', 'Dari kemarin hingga pagi ini visual Gunungapi terlihat jelas hingga tertutup kabut. Teramati\r\nasap kawah berwarna putih dengan intensitas tebal, tinggi sekitar 200 meter dari puncak.\r\n\r\nMelalui rekaman seismograf pada 24 April 2019 tercatat:\r\n- 2 kali gempa Hembusan\r\n- 1 kali gempa Tektonik Jauh', 'VONA terkirim kode warna ORANGE, terbit tanggal 21 April 2019 pukul 21:41 WITA, terkait\r\npenurunan intensitas erupsi pasca erupsi pukul 18:56 WITA dengan tinggi kolom abu ± 3.000\r\nm di atas puncak. Kolom abu teramati berwarna kelabu dengan intensitas tebal condong ke\r\narah barat.', '- Masyarakat/pengunjung agar tidak melakukan aktivitas di dalam radius 3 km untuk sektor\r\nUtara - Barat, 4 km untuk sektor Selatan - Barat, dan dalam jarak 7 km untuk sektor Selatan -\r\nTenggara, di dalam jarak 6 km untuk sektor Tenggara - Timur serta di dalam jarak 4 km\r\nuntuk sektor Utara-Timur \r\n- Masyarakat yang bermukim di sepanjang aliran sungai yang berhulu di Gunung Sinabung \r\nagar mewaspadai potensi banjir lahar terutama pada saat terjadi hujan lebat.', 'VONA terkirim kode warna ORANGE, terbit tanggal 21 April 2019 pukul 21:41 WITA, terkait\r\npenurunan intensitas erupsi pasca erupsi pukul 18:56 WITA dengan tinggi kolom abu ± 3.000\r\nm di atas puncak. Kolom abu teramati berwarna kelabu dengan intensitas tebal condong ke\r\narah barat.', NULL, 2, '2019-05-12 01:05:03', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_klik_ebtke`
--

CREATE TABLE IF NOT EXISTS `r_lap_klik_ebtke` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `JENIS` char(1) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_klik_ebtke`
--

INSERT INTO `r_lap_klik_ebtke` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `JENIS`, `URL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'Test', 'T', 'CNN Indonesia: Energi Terbarukan Bisa Bikin Pemerintah Hemat Puluhan Triliun (Netral)', 'Y', 2, '2019-05-12 03:05:10', 'WEB', 2, '2019-05-12 03:05:01', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_klik_gatrik`
--

CREATE TABLE IF NOT EXISTS `r_lap_klik_gatrik` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `JENIS` varchar(50) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_klik_gatrik`
--

INSERT INTO `r_lap_klik_gatrik` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `JENIS`, `URL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'Test', 'Tidak Netral', 'Tess', 'Y', 2, '2019-05-12 03:05:49', 'WEB', 2, '2019-05-12 03:05:14', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_klik_geologi`
--

CREATE TABLE IF NOT EXISTS `r_lap_klik_geologi` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `JENIS` char(1) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_klik_geologi`
--

INSERT INTO `r_lap_klik_geologi` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `JENIS`, `URL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'Tet', 'N', 'https://www.cnnindonesia.com/ekonomi/20190424095301-85-389098/energi-terbarukanbisa-bikin-pemerintah-hemat-puluhan-triliun', 'Y', 2, '2019-05-12 03:05:03', 'WEB', 2, '2019-05-12 03:05:29', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_klik_migas`
--

CREATE TABLE IF NOT EXISTS `r_lap_klik_migas` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `JENIS` char(1) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_klik_migas`
--

INSERT INTO `r_lap_klik_migas` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `JENIS`, `URL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(3, '2019-05-12', 'CNN Indonesia: Energi Terbarukan Bisa Bikin Pemerintah Hemat Puluhan Triliun (Netral)', 'N', 'https://www.cnnindonesia.com/ekonomi/20190424095301-85-389098/energi-terbarukanbisa-bikin-pemerintah-hemat-puluhan-triliun', 'Y', 2, '2019-05-12 03:05:59', 'WEB', 2, '2019-05-12 03:05:08', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_klik_minerba`
--

CREATE TABLE IF NOT EXISTS `r_lap_klik_minerba` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `JENIS` char(1) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_klik_minerba`
--

INSERT INTO `r_lap_klik_minerba` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `JENIS`, `URL`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-12', 'TEst', 'N', 'fff', 'Y', 2, '2019-05-12 03:05:38', 'WEB', 2, '2019-05-12 03:05:21', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_berita_opec_harian`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_berita_opec_harian` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `BERITA` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_berita_opec_harian`
--

INSERT INTO `r_lap_pusdatin_berita_opec_harian` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `BERITA`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(2, '2019-05-10', 'gdddd', NULL, 1, '2019-05-10 12:05:10', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_harga_bbm`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_harga_bbm` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `JENIS_TERTENTU` text,
  `BBM_UMUM` text,
  `PROG_IND_SATU_HRG` text,
  `HARGA_PERNEGARA` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_harga_bbm`
--

INSERT INTO `r_lap_pusdatin_harga_bbm` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `JENIS_TERTENTU`, `BBM_UMUM`, `PROG_IND_SATU_HRG`, `HARGA_PERNEGARA`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-10', 'Tet', 'test', 'etet', 'tttt', NULL, 1, '2019-05-10 12:05:59', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_harga_bb_acuan`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_harga_bb_acuan` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `HARGA` text,
  `SUMBER` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_harga_bb_acuan`
--

INSERT INTO `r_lap_pusdatin_harga_bb_acuan` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `HARGA`, `SUMBER`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(2, '2019-05-10', 'Ter', 'SSSS', NULL, 1, '2019-05-10 12:05:06', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_harga_mineral_acuan`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_harga_mineral_acuan` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `HARGA` text,
  `SUMBER` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_harga_mineral_acuan`
--

INSERT INTO `r_lap_pusdatin_harga_mineral_acuan` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `HARGA`, `SUMBER`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(3, '2019-05-10', 'GG', 'ggg', NULL, 1, '2019-05-10 12:05:55', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_icp`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_icp` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `KETERANGAN` text NOT NULL,
  `PROD_01` double(12,0) DEFAULT NULL,
  `PROD_02` double(12,0) DEFAULT NULL,
  `PROD_03` double(12,0) DEFAULT NULL,
  `PROD_04` double(12,0) DEFAULT NULL,
  `PROD_05` double(12,0) DEFAULT NULL,
  `PROD_06` double(12,0) DEFAULT NULL,
  `PROD_07` double(12,0) DEFAULT NULL,
  `PROD_08` double(12,0) DEFAULT NULL,
  `PROD_09` double(12,0) DEFAULT NULL,
  `PROD_10` double(12,0) DEFAULT NULL,
  `PROD_11` double(12,0) DEFAULT NULL,
  `PROD_12` double(12,0) DEFAULT NULL,
  `PROD_TAHUNAN` double(12,0) DEFAULT NULL,
  `APBN` double(12,0) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_icp`
--

INSERT INTO `r_lap_pusdatin_icp` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `KETERANGAN`, `PROD_01`, `PROD_02`, `PROD_03`, `PROD_04`, `PROD_05`, `PROD_06`, `PROD_07`, `PROD_08`, `PROD_09`, `PROD_10`, `PROD_11`, `PROD_12`, `PROD_TAHUNAN`, `APBN`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-10', 'Rata-rata ICP Bulanan\r\nJan  : 56,55 USD/Barrel. \r\nFeb  : 61,31 USD/Barrel.\r\nMar  : 63,60 USD/Barrel.\r\nRata-rata ICP Bulanan Januari s.d Maret 2019 adalah 60,49 USD/Barrel.\r\nAsumsi APBN 2019 adalah 70 USD/Barrel.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 1, '2019-05-10 12:05:54', 'WEB', 2, '2019-05-10 15:05:16', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_lift_tb`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_lift_tb` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `LIFT_MB` text,
  `POSISI_STOCK` text,
  `SALUR_GAS` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_lift_tb`
--

INSERT INTO `r_lap_pusdatin_lift_tb` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `LIFT_MB`, `POSISI_STOCK`, `SALUR_GAS`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-10', 'Test', 'Test', 'Test', NULL, 1, '2019-05-10 12:05:48', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_prod_ekui_migas`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_prod_ekui_migas` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `PROD_HARIAN` double(12,0) DEFAULT NULL,
  `PROD_BULANAN` double(12,0) DEFAULT NULL,
  `PROD_TAHUNAN` double(12,0) DEFAULT NULL,
  `APBN` double(12,0) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_prod_ekui_migas`
--

INSERT INTO `r_lap_pusdatin_prod_ekui_migas` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `PROD_HARIAN`, `PROD_BULANAN`, `PROD_TAHUNAN`, `APBN`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-10', 3, 5, 5, 7, 'Y', 1, '2019-05-10 11:05:28', 'WEB', 2, '2019-05-10 15:05:33', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_prod_gas`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_prod_gas` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `PROD_HARIAN` double(12,0) DEFAULT NULL,
  `PROD_BULANAN` double(12,0) DEFAULT NULL,
  `PROD_TAHUNAN` double(12,0) DEFAULT NULL,
  `APBN` double(12,0) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_prod_gas`
--

INSERT INTO `r_lap_pusdatin_prod_gas` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `PROD_HARIAN`, `PROD_BULANAN`, `PROD_TAHUNAN`, `APBN`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-10', 3, 4, 5, 6, 'Y', 1, '2019-05-10 11:05:14', 'WEB', 2, '2019-05-12 03:05:21', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_prod_minyak`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_prod_minyak` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `PROD_HARIAN` double(12,0) DEFAULT NULL,
  `PROD_BULANAN` double(12,0) DEFAULT NULL,
  `PROD_TAHUNAN` double(12,0) DEFAULT NULL,
  `APBN` double(12,0) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_prod_minyak`
--

INSERT INTO `r_lap_pusdatin_prod_minyak` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `PROD_HARIAN`, `PROD_BULANAN`, `PROD_TAHUNAN`, `APBN`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '0000-00-00', 1, 2, 3, 4, 'Y', NULL, '2019-05-10 07:05:18', 'WEB', 2, '2019-05-10 14:05:17', 'WEB'),
(2, '0000-00-00', 12, 23, 45, 12, 'Y', 1, '2019-05-10 07:05:48', 'WEB', 2, '2019-05-10 14:05:34', 'WEB'),
(3, '0000-00-00', 0, 0, 0, 0, 'Y', 1, '2019-05-10 07:05:53', 'WEB', 2, '2019-05-10 14:05:36', 'WEB'),
(4, '0000-00-00', 0, 0, 0, 0, 'Y', 1, '2019-05-10 07:05:55', 'WEB', 2, '2019-05-10 14:05:08', 'WEB'),
(5, '0000-00-00', 0, 0, 0, 0, 'Y', 1, '2019-05-10 07:05:58', 'WEB', 2, '2019-05-10 14:05:12', 'WEB'),
(6, '2019-05-10', 0, 0, 0, 0, 'Y', 1, '2019-05-10 07:05:56', 'WEB', 2, '2019-05-10 14:05:51', 'WEB'),
(7, '2019-05-10', 0, 0, 0, 0, 'Y', 1, '2019-05-10 07:05:21', 'WEB', 2, '2019-05-10 14:05:21', 'WEB'),
(8, '2019-05-10', 0, 0, 0, 0, 'Y', 1, '2019-05-10 08:05:54', 'WEB', 2, '2019-05-10 14:05:18', 'WEB'),
(9, '1970-01-01', 0, 0, 0, 0, 'Y', 1, '2019-05-10 08:05:19', 'WEB', 2, '2019-05-10 14:05:12', 'WEB'),
(10, '1970-01-01', 0, 0, 0, 0, 'Y', 1, '2019-05-10 08:05:34', 'WEB', 2, '2019-05-10 14:05:27', 'WEB'),
(11, '1970-01-01', 0, 0, 0, 0, NULL, 1, '2019-05-10 08:05:34', 'WEB', NULL, NULL, NULL),
(12, '1970-01-01', 0, 0, 0, 0, NULL, 1, '2019-05-10 08:05:20', 'WEB', NULL, NULL, NULL),
(13, '1970-01-01', 0, 0, 0, 0, NULL, 1, '2019-05-10 08:05:26', 'WEB', NULL, NULL, NULL),
(14, '1970-01-01', 0, 0, 0, 0, NULL, 1, '2019-05-10 08:05:50', 'WEB', NULL, NULL, NULL),
(15, '1970-01-01', 0, 0, 0, 0, NULL, 1, '2019-05-10 08:05:50', 'WEB', NULL, NULL, NULL),
(16, '2019-05-28', 0, 0, 0, 0, NULL, 1, '2019-05-10 11:05:30', 'WEB', NULL, NULL, NULL),
(17, '2019-05-10', 3, 5, 6, 6, NULL, 1, '2019-05-10 12:05:23', 'WEB', NULL, NULL, NULL),
(18, '2019-05-12', 23444, 55555, 66334, 56422, NULL, 5, '2019-05-12 16:05:21', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_prog_peny_prem_jamali`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_prog_peny_prem_jamali` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `PROGRES` text,
  `CATATAN` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_prog_peny_prem_jamali`
--

INSERT INTO `r_lap_pusdatin_prog_peny_prem_jamali` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `PROGRES`, `CATATAN`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-31', 'Tet', 'Tttt', NULL, 1, '2019-05-10 12:05:24', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_lap_pusdatin_stts_tl`
--

CREATE TABLE IF NOT EXISTS `r_lap_pusdatin_stts_tl` (
`ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date DEFAULT NULL,
  `STATUS` text,
  `IS_POST` char(1) DEFAULT NULL,
  `USER_ENTRY` int(1) DEFAULT NULL,
  `TANGGAL_ENTRY` datetime DEFAULT NULL,
  `FLATFORM_ENTRY` varchar(20) DEFAULT NULL,
  `USER_POST` int(1) DEFAULT NULL,
  `TANGGAL_POST` datetime DEFAULT NULL,
  `FLATFORM_POST` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_lap_pusdatin_stts_tl`
--

INSERT INTO `r_lap_pusdatin_stts_tl` (`ID_LAPORAN`, `TANGGAL_LAPORAN`, `STATUS`, `IS_POST`, `USER_ENTRY`, `TANGGAL_ENTRY`, `FLATFORM_ENTRY`, `USER_POST`, `TANGGAL_POST`, `FLATFORM_POST`) VALUES
(1, '2019-05-17', 'Tet', NULL, 1, '2019-05-10 12:05:22', 'WEB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_aktivitas`
--

CREATE TABLE IF NOT EXISTS `t_aktivitas` (
`ID_AKTIVITAS` int(11) NOT NULL,
  `LEVEL` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_aktivitas`
--

INSERT INTO `t_aktivitas` (`ID_AKTIVITAS`, `LEVEL`) VALUES
(1, 'Level 1'),
(2, 'Level 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_gunung`
--

CREATE TABLE IF NOT EXISTS `t_gunung` (
`ID_GUNUNG` int(11) NOT NULL,
  `NAMA_GUNUNG` varchar(200) DEFAULT NULL,
  `ID_KABKOT` int(4) DEFAULT NULL,
  `ID_PROVINSI` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_gunung`
--

INSERT INTO `t_gunung` (`ID_GUNUNG`, `NAMA_GUNUNG`, `ID_KABKOT`, `ID_PROVINSI`) VALUES
(1, 'Gunungapi Sinabung', NULL, NULL),
(2, 'Gunungapi Agung', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hak_akses_role`
--

CREATE TABLE IF NOT EXISTS `t_hak_akses_role` (
`ID_HAK_AKSES` int(4) NOT NULL,
  `ID_ROLE` int(4) NOT NULL,
  `ID_KATEGORI` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_hak_akses_role`
--

INSERT INTO `t_hak_akses_role` (`ID_HAK_AKSES`, `ID_ROLE`, `ID_KATEGORI`) VALUES
(4, 2, 1),
(5, 3, 2),
(6, 5, 3),
(9, 1, 1),
(10, 1, 2),
(11, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jenis_berita`
--

CREATE TABLE IF NOT EXISTS `t_jenis_berita` (
`ID_JENIS_BERITA` int(11) NOT NULL,
  `JENIS_BERITA` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_jenis_berita`
--

INSERT INTO `t_jenis_berita` (`ID_JENIS_BERITA`, `JENIS_BERITA`) VALUES
(1, 'Netral'),
(2, 'Tidak Netral');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jenis_laporan`
--

CREATE TABLE IF NOT EXISTS `t_jenis_laporan` (
`ID_JENIS_LAPORAN` int(4) NOT NULL,
  `URUTAN_LAPORAN` smallint(6) NOT NULL,
  `ID_KATEGORI` int(4) DEFAULT NULL,
  `JENIS_LAPORAN` varchar(200) DEFAULT NULL,
  `CONTROLLER` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_jenis_laporan`
--

INSERT INTO `t_jenis_laporan` (`ID_JENIS_LAPORAN`, `URUTAN_LAPORAN`, `ID_KATEGORI`, `JENIS_LAPORAN`, `CONTROLLER`) VALUES
(1, 1, 1, 'Produksi Minyak', NULL),
(2, 2, 1, 'ICP', NULL),
(3, 3, 1, 'Produksi Gas', NULL),
(4, 4, 1, 'Produksi Ekuivalen Minyak dan Gas', NULL),
(5, 5, 1, 'Lifting Tahun Berjalan', NULL),
(6, 6, 1, 'Harga BBM', NULL),
(7, 7, 1, 'Progres Penyaluran Premium Jamali', NULL),
(8, 8, 1, 'Berita OPEC Harian', NULL),
(9, 9, 1, 'Harga Batubara Acuan', NULL),
(10, 10, 1, 'Harga Mineral Acuan', NULL),
(11, 11, 1, 'Status Ketenagalistrikan', NULL),
(12, 1, 2, 'Gunung Api', NULL),
(13, 2, 2, 'Gerakan Tanah', NULL),
(14, 3, 2, 'Gempa Bumi', NULL),
(15, 1, 3, 'Bidang Migas', NULL),
(16, 2, 3, 'Bidang Minerba', NULL),
(17, 3, 3, 'Bidang Ketenagalistrikan', NULL),
(18, 4, 3, 'Bidang EBTKE', NULL),
(19, 5, 3, 'Bidang Geologi', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kabkot`
--

CREATE TABLE IF NOT EXISTS `t_kabkot` (
`ID_KABKOT` int(11) NOT NULL,
  `ID_PROVINSI` int(11) DEFAULT NULL,
  `NAMA_KABKOT` varchar(200) DEFAULT NULL,
  `MULAI_EXIST` date DEFAULT NULL,
  `AKHIR_EXIST` date DEFAULT NULL,
  `IS_KOTA` smallint(6) DEFAULT NULL,
  `KODE_NEGARA` varchar(10) DEFAULT NULL,
  `NAMA_KABKOT_EN` varchar(50) DEFAULT NULL,
  `DATE_MODIFIED` date DEFAULT NULL,
  `EDIT_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9472 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kabkot`
--

INSERT INTO `t_kabkot` (`ID_KABKOT`, `ID_PROVINSI`, `NAMA_KABKOT`, `MULAI_EXIST`, `AKHIR_EXIST`, `IS_KOTA`, `KODE_NEGARA`, `NAMA_KABKOT_EN`, `DATE_MODIFIED`, `EDIT_BY`) VALUES
(1101, 11, 'Kabupaten Simeulue', '0000-00-00', NULL, 0, NULL, 'Simeulue Regency', NULL, NULL),
(1102, 11, 'Kabupaten Aceh Singkil', '0000-00-00', NULL, 0, NULL, 'Aceh Singkil Regency', NULL, NULL),
(1103, 11, 'Kabupaten Aceh Selatan', '0000-00-00', NULL, 0, NULL, 'Aceh Selatan Regency', NULL, NULL),
(1104, 11, 'Kabupaten Aceh Tenggara', '0000-00-00', NULL, 0, NULL, 'Aceh Tenggara Regency', NULL, NULL),
(1105, 11, 'Kabupaten Aceh Timur', '0000-00-00', NULL, 0, NULL, 'Aceh Timur Regency', NULL, NULL),
(1106, 11, 'Kabupaten Aceh Tengah', '0000-00-00', NULL, 0, NULL, 'Aceh Tengah Regency', NULL, NULL),
(1107, 11, 'Kabupaten Aceh Barat', '0000-00-00', NULL, 0, NULL, 'Aceh Barat Regency', NULL, NULL),
(1108, 11, 'Kabupaten Aceh Besar', '0000-00-00', NULL, 0, NULL, 'Aceh Besar Regency', NULL, NULL),
(1109, 11, 'Kabupaten Pidie', '0000-00-00', NULL, 0, NULL, 'Pidie Regency', NULL, NULL),
(1110, 11, 'Kabupaten Bireuen', '0000-00-00', NULL, 0, NULL, 'Bireuen Regency', NULL, NULL),
(1111, 11, 'Kabupaten Aceh Utara', '0000-00-00', NULL, 0, NULL, 'Aceh Utara Regency', NULL, NULL),
(1112, 11, 'Kabupaten Aceh Barat Daya', '0000-00-00', NULL, 0, NULL, 'Aceh Barat Daya Regency', NULL, NULL),
(1113, 11, 'Kabupaten Gayo Lues', '0000-00-00', NULL, 0, NULL, 'Aceh Gayo Lues Regency', NULL, NULL),
(1114, 11, 'Kabupaten Aceh Tamiang', '0000-00-00', NULL, 0, NULL, 'Aceh Tamiang Regency', NULL, NULL),
(1115, 11, 'Kabupaten Nagan Raya', '0000-00-00', NULL, 0, NULL, 'Nagan Raya Regency', NULL, NULL),
(1116, 11, 'Kabupaten Aceh Jaya', '0000-00-00', NULL, 0, NULL, 'Aceh Jaya Regency', NULL, NULL),
(1117, 11, 'Kabupaten Bener Meriah', NULL, '0000-00-00', 0, NULL, 'Bener Meriah Regency', NULL, NULL),
(1118, 11, 'Kabupaten Pidie Jaya', '0000-00-00', NULL, 0, NULL, 'Pidie Jaya Regency', NULL, NULL),
(1171, 11, 'Kota Banda Aceh', '0000-00-00', NULL, 1, NULL, 'Banda Aceh', NULL, NULL),
(1172, 11, 'Kota Sabang', '0000-00-00', NULL, 1, NULL, 'Sabang', NULL, NULL),
(1173, 11, 'Kota Langsa', '0000-00-00', NULL, 1, NULL, 'Langsa', NULL, NULL),
(1174, 11, 'Kota Lhokseumawe', '0000-00-00', NULL, 1, NULL, 'Lhokseumawe', NULL, NULL),
(1175, 11, 'Kota Subulussalam', '0000-00-00', NULL, 1, NULL, 'Subulussalam', NULL, NULL),
(1201, 12, 'Kabupaten Nias', '0000-00-00', NULL, 0, NULL, 'Nias Regency', NULL, NULL),
(1202, 12, 'Kabupaten Mandailing Natal', '0000-00-00', NULL, 0, NULL, 'Mandailing Natal Regency', NULL, NULL),
(1203, 12, 'Kabupaten Tapanuli Selatan', '0000-00-00', NULL, 0, NULL, 'Tapanuli Selatan Regency', NULL, NULL),
(1204, 12, 'Kabupaten Tapanuli Tengah', '0000-00-00', NULL, 0, NULL, 'Tapanuli Tengah Regency', NULL, NULL),
(1205, 12, 'Kabupaten Tapanuli Utara', '0000-00-00', NULL, 0, NULL, 'Tapanuli Utara Regency', NULL, NULL),
(1206, 12, 'Kabupaten Toba Samosir', '0000-00-00', NULL, 0, NULL, 'Toba Samosir Regency', NULL, NULL),
(1207, 12, 'Kabupaten Labuhan Batu', '0000-00-00', NULL, 0, NULL, 'Labuhan Batu Regency', NULL, NULL),
(1208, 12, 'Kabupaten Asahan', '0000-00-00', NULL, 0, NULL, 'Asahan Regency', NULL, NULL),
(1209, 12, 'Kabupaten Simalungun', '0000-00-00', NULL, 0, NULL, 'Simalungun Regency', NULL, NULL),
(1210, 12, 'Kabupaten Dairi', '0000-00-00', NULL, 0, NULL, 'Dairi Regency', NULL, NULL),
(1211, 12, 'Kabupaten Karo', '0000-00-00', NULL, 0, NULL, 'Karo Regency', NULL, NULL),
(1212, 12, 'Kabupaten Deli Serdang', '0000-00-00', NULL, 0, NULL, 'Deli Serdang Regency', NULL, NULL),
(1213, 12, 'Kabupaten Langkat', '0000-00-00', NULL, 0, NULL, 'Langkat Regency', NULL, NULL),
(1214, 12, 'Kabupaten Nias Selatan', '0000-00-00', NULL, 0, NULL, 'Nias Selatan Regency', NULL, NULL),
(1215, 12, 'Kabupaten Humbang Hasundutan', '0000-00-00', NULL, 0, NULL, 'Humbang Hasundutan Regency', NULL, NULL),
(1216, 12, 'Kabupaten Pakpak Bharat', '0000-00-00', NULL, 0, NULL, 'Pakpak Barat Regency', NULL, NULL),
(1217, 12, 'Kabupaten Samosir', NULL, '0000-00-00', NULL, NULL, 'Samosir Regency', NULL, NULL),
(1218, 12, 'Kabupaten Serdang Bedagai', NULL, '0000-00-00', NULL, NULL, 'Serdang Bedagai Regency', NULL, NULL),
(1219, 12, 'Kabupaten Batu Bara', '0000-00-00', NULL, 0, NULL, 'Batu Bara Regency', NULL, NULL),
(1220, 12, 'Kabupaten Padang Lawas Utara', '0000-00-00', NULL, 0, NULL, 'Padang Lawas Utara Regency', NULL, NULL),
(1221, 12, 'Kabupaten Padang Lawas', NULL, NULL, 0, NULL, 'Padang Lawas Regency', NULL, NULL),
(1222, 12, 'Kabupaten Labuhanbatu Selatan', NULL, NULL, 0, NULL, 'Labuhanbatu Selatan Regency', NULL, NULL),
(1223, 12, 'Kabupaten Labuhanbatu Utara', NULL, NULL, 0, NULL, 'Labuhanbatu Utara Regency', NULL, NULL),
(1224, 12, 'Kabupaten Nias Utara', NULL, NULL, 0, NULL, 'Nias Utara Regency', NULL, NULL),
(1225, 12, 'Kabupaten Nias Barat', NULL, NULL, 0, NULL, 'Nias Barat Regency', NULL, NULL),
(1271, 12, 'Kota Sibolga', '0000-00-00', NULL, 1, NULL, 'Sibolga', NULL, NULL),
(1272, 12, 'Kota Tanjung Balai', '0000-00-00', NULL, 1, NULL, 'Tanjung Balai', NULL, NULL),
(1273, 12, 'Kota Pematangsiantar', '0000-00-00', NULL, 1, NULL, 'Pematangsiantar', NULL, NULL),
(1274, 12, 'Kota Tebing Tinggi', '0000-00-00', NULL, 1, NULL, 'Tebing Tinggi', NULL, NULL),
(1275, 12, 'Kota Medan', '0000-00-00', NULL, 1, NULL, 'Medan', NULL, NULL),
(1276, 12, 'Kota Binjai', '0000-00-00', NULL, 1, NULL, 'Binjai', NULL, NULL),
(1277, 12, 'Kota Padangsidimpuan', '0000-00-00', NULL, 1, NULL, 'Padang Sidempuan', NULL, NULL),
(1278, 12, 'Kota Gunung Sitoli', '0000-00-00', NULL, 1, NULL, 'Gunung Sitoli Regency', NULL, NULL),
(1301, 13, 'Kabupaten Kepulauan Mentawai', '0000-00-00', NULL, 0, NULL, 'Kepulauan Mentawai Regency', NULL, NULL),
(1302, 13, 'Kabupaten Pesisir Selatan', '0000-00-00', NULL, 0, NULL, 'Pesisir Selatan Regency', NULL, NULL),
(1303, 13, 'Kabupaten Solok', '0000-00-00', NULL, 0, NULL, 'Solok Regency', NULL, NULL),
(1304, 13, 'Kabupaten Sijunjung', '0000-00-00', NULL, 0, NULL, 'Sijunjung Regency', NULL, NULL),
(1305, 13, 'Kabupaten Tanah Datar', '0000-00-00', NULL, 0, NULL, 'Tanah Datar Regency', NULL, NULL),
(1306, 13, 'Kabupaten Padang Pariaman', '0000-00-00', NULL, 0, NULL, 'Padang Pariaman Regency', NULL, NULL),
(1307, 13, 'Kabupaten Agam', '0000-00-00', NULL, 0, NULL, 'Agam Regency', NULL, NULL),
(1308, 13, 'Kabupaten Lima Puluh Kota', '0000-00-00', NULL, 0, NULL, 'Lima Puluh Kota Regency', NULL, NULL),
(1309, 13, 'Kabupaten Pasaman', '0000-00-00', NULL, 0, NULL, 'Pasaman Regency', NULL, NULL),
(1310, 13, 'Kabupaten Solok Selatan', NULL, NULL, 0, NULL, 'Solok Selatan Regency', NULL, NULL),
(1311, 13, 'Kabupaten Dharmasraya', NULL, '0000-00-00', 0, NULL, 'Dharmasraya Regency', NULL, NULL),
(1312, 13, 'Kabupaten Pasaman Barat', NULL, '0000-00-00', 0, NULL, 'Pasaman Barat Regency', NULL, NULL),
(1371, 13, 'Kota Padang', '0000-00-00', NULL, 1, NULL, 'Padang', NULL, NULL),
(1372, 13, 'Kota Solok', '0000-00-00', NULL, 1, NULL, 'Solok', NULL, NULL),
(1373, 13, 'Kota Sawah Lunto', '0000-00-00', NULL, 1, NULL, 'Sawah Lunto', NULL, NULL),
(1374, 13, 'Kota Padang Panjang', '0000-00-00', NULL, 1, NULL, 'Padang Panjang', NULL, NULL),
(1375, 13, 'Kota Bukittinggi', '0000-00-00', NULL, 1, NULL, 'Bukittinggi', NULL, NULL),
(1376, 13, 'Kota Payakumbuh', '0000-00-00', NULL, 1, NULL, 'Payakumbuh', NULL, NULL),
(1377, 13, 'Kota Pariaman', '0000-00-00', NULL, 1, NULL, 'Pariaman', NULL, NULL),
(1401, 14, 'Kabupaten Kuantan Singingi', '0000-00-00', NULL, 0, NULL, 'Kuantan Singingi Regency', NULL, NULL),
(1402, 14, 'Kabupaten Indragiri Hulu', '0000-00-00', NULL, 0, NULL, 'Indragiri Hulu Regency', NULL, NULL),
(1403, 14, 'Kabupaten Indragiri Hilir', '0000-00-00', NULL, 0, NULL, 'Indragiri Hilir Regency', NULL, NULL),
(1404, 14, 'Kabupaten Pelalawan', '0000-00-00', NULL, 0, NULL, 'Pelalawan Regency', NULL, NULL),
(1405, 14, 'Kabupaten Siak', '0000-00-00', NULL, 0, NULL, 'Siak Regency', NULL, NULL),
(1406, 14, 'Kabupaten Kampar', '0000-00-00', NULL, 0, NULL, 'Kampar Regency', NULL, NULL),
(1407, 14, 'Kabupaten Rokan Hulu', '0000-00-00', NULL, 0, NULL, 'Rokan Hulu Regency', NULL, NULL),
(1408, 14, 'Kabupaten Bengkalis', '0000-00-00', NULL, 0, NULL, 'Bengkalis Regency', NULL, NULL),
(1409, 14, 'Kabupaten Rokan Hilir', '0000-00-00', NULL, 0, NULL, 'Rokan Hilir Regency', '0000-00-00', 'HUSAIN'),
(1410, 14, 'Kabupaten Kepulauan Meranti', '0000-00-00', NULL, 0, NULL, 'Kepulauan Meranti Regency', NULL, NULL),
(1471, 14, 'Kota Pekanbaru', '0000-00-00', NULL, 1, NULL, 'Pekanbaru', NULL, NULL),
(1473, 14, 'Kota Dumai', '0000-00-00', NULL, 1, NULL, 'Dumai', NULL, NULL),
(1501, 15, 'Kabupaten Kerinci', '0000-00-00', NULL, 0, NULL, 'Kerinci Regency', NULL, NULL),
(1502, 15, 'Kabupaten Merangin', '0000-00-00', NULL, 0, NULL, 'Merangin Regency', NULL, NULL),
(1503, 15, 'Kabupaten Sarolangun', '0000-00-00', NULL, 0, NULL, 'Sarolangun Regency', NULL, NULL),
(1504, 15, 'Kabupaten Batang Hari', '0000-00-00', NULL, 0, NULL, 'Batang Hari Regency', NULL, NULL),
(1505, 15, 'Kabupaten Muaro Jambi', '0000-00-00', NULL, 0, NULL, 'Muaro Jambi Regency', NULL, NULL),
(1506, 15, 'Kabupaten Tanjung Jabung Timur', '0000-00-00', NULL, 0, NULL, 'Tanjung Jabung Timur Regency', NULL, NULL),
(1507, 15, 'Kabupaten Tanjung Jabung Barat', '0000-00-00', NULL, 0, NULL, 'Tanjung Jabung Barat Regency', NULL, NULL),
(1508, 15, 'Kabupaten Tebo', '0000-00-00', NULL, 0, NULL, 'Tebo Regency', NULL, NULL),
(1509, 15, 'Kabupaten Bungo', '0000-00-00', NULL, 0, NULL, 'Bungo Regency', NULL, NULL),
(1571, 15, 'Kota Jambi', '0000-00-00', NULL, 1, NULL, 'Jambi', NULL, NULL),
(1572, 15, 'Kota Sungai Penuh', '0000-00-00', NULL, 1, NULL, 'Sungai Penuh', NULL, NULL),
(1601, 16, 'Kabupaten Ogan Komering Ulu', '0000-00-00', NULL, 0, NULL, 'Ogan Komering Ulu Regency', NULL, NULL),
(1602, 16, 'Kabupaten Ogan Komering Ilir', '0000-00-00', NULL, 0, NULL, 'Ogan Komering Ilir Regency', NULL, NULL),
(1603, 16, 'Kabupaten Muara Enim', '0000-00-00', NULL, 0, NULL, 'Muara Enim Regency', NULL, NULL),
(1604, 16, 'Kabupaten Lahat', '0000-00-00', NULL, 0, NULL, 'Lahat Regency', NULL, NULL),
(1605, 16, 'Kabupaten Musi Rawas', '0000-00-00', NULL, 0, NULL, 'Musi Rawas Regency', NULL, NULL),
(1606, 16, 'Kabupaten Musi Banyuasin', '0000-00-00', NULL, 0, NULL, 'Musi Banyuasin Regency', NULL, NULL),
(1607, 16, 'Kabupaten Banyuasin', '0000-00-00', NULL, 0, NULL, 'Banyuasin Regency', NULL, NULL),
(1608, 16, 'Kabupaten Ogan Komering Ulu Selatan', '0000-00-00', NULL, 0, NULL, 'Ogan Komering Ulu Selatan Regency', NULL, NULL),
(1609, 16, 'Kabupaten Ogan Komering Ulu Timur', '0000-00-00', NULL, 0, NULL, 'Ogan Komering Ulu Timur Regency', NULL, NULL),
(1610, 16, 'Kabupaten Ogan Ilir', NULL, '0000-00-00', NULL, NULL, 'Ogan Ilir Regency', NULL, NULL),
(1611, 16, 'Kabupaten Empat Lawang', '0000-00-00', NULL, 0, NULL, 'Empat Lawang Regency', NULL, NULL),
(1612, 16, 'Kabupaten Penukal Abab Lematang Ilir', '0000-00-00', NULL, 0, NULL, 'Penukal Abab Lematang Ilir Regency', NULL, NULL),
(1613, 16, 'Kabupaten Musi Rawas Utara', '0000-00-00', NULL, 0, NULL, 'North Musi Rawas Regency', NULL, NULL),
(1671, 16, 'Kota Palembang', '0000-00-00', NULL, 1, NULL, 'Palembang', NULL, NULL),
(1672, 16, 'Kota Prabumulih', '0000-00-00', NULL, 1, NULL, 'Prabumulih', NULL, NULL),
(1673, 16, 'Kota Pagar Alam', '0000-00-00', NULL, 1, NULL, 'Pagar Alam', NULL, NULL),
(1674, 16, 'Kota Lubuk Linggau', '0000-00-00', NULL, 1, NULL, 'Lubuk Linggau', NULL, NULL),
(1701, 17, 'Kabupaten Bengkulu Selatan', '0000-00-00', NULL, 0, NULL, 'Bengkulu Selatan Regency', NULL, NULL),
(1702, 17, 'Kabupaten Rejang Lebong', '0000-00-00', NULL, 0, NULL, 'Rejang Lebong Regency', NULL, NULL),
(1703, 17, 'Kabupaten Bengkulu Utara', '0000-00-00', NULL, 0, NULL, 'Bengkulu Utara Regency', NULL, NULL),
(1704, 17, 'Kabupaten Kaur', '0000-00-00', NULL, 0, NULL, 'Kaur Regency', NULL, NULL),
(1705, 17, 'Kabupaten Seluma', '0000-00-00', NULL, 0, NULL, 'Seluma Regency', NULL, NULL),
(1706, 17, 'Kabupaten Mukomuko', '0000-00-00', NULL, 0, NULL, 'Mukomuko Regency', NULL, NULL),
(1707, 17, 'Kabupaten Lebong', '0000-00-00', NULL, 0, NULL, 'Lebong Regency', NULL, NULL),
(1708, 17, 'Kabupaten Kepahiang', '0000-00-00', NULL, 0, NULL, 'Kepahiang Regency', NULL, NULL),
(1709, 17, 'Kabupaten Bengkulu Tengah', '0000-00-00', NULL, 0, NULL, 'Bengkulu Tengah Regency', NULL, NULL),
(1771, 17, 'Kota Bengkulu', '0000-00-00', NULL, 1, NULL, 'Bengkulu', NULL, NULL),
(1801, 18, 'Kabupaten Lampung Barat', '0000-00-00', NULL, 0, NULL, 'Lampung Barat Regency', NULL, NULL),
(1802, 18, 'Kabupaten Tanggamus', '0000-00-00', NULL, 0, NULL, 'Tanggamus Regency', NULL, NULL),
(1803, 18, 'Kabupaten Lampung Selatan', '0000-00-00', NULL, 0, NULL, 'Lampung Selatan Regency', NULL, NULL),
(1804, 18, 'Kabupaten Lampung Timur', '0000-00-00', NULL, 0, NULL, 'Lampung Timur Regency', NULL, NULL),
(1805, 18, 'Kabupaten Lampung Tengah', '0000-00-00', NULL, 0, NULL, 'Lampung Tengah Regency', NULL, NULL),
(1806, 18, 'Kabupaten Lampung Utara', '0000-00-00', NULL, 0, NULL, 'Lampung Utara Regency', NULL, NULL),
(1807, 18, 'Kabupaten Way Kanan', '0000-00-00', NULL, 0, NULL, 'Way Kanan Regency', NULL, NULL),
(1808, 18, 'Kabupaten Tulang Bawang', '0000-00-00', NULL, 0, NULL, 'Tulang Bawang Regency', NULL, NULL),
(1809, 18, 'Kabupaten Mesuji', '0000-00-00', NULL, 0, NULL, 'Mesuji Regency', NULL, NULL),
(1810, 18, 'Kabupaten Tulang Bawang Barat', '0000-00-00', NULL, 0, '0', 'Tulang Bawang Barat Regency', NULL, NULL),
(1811, 18, 'Kabupaten Pesawaran', '0000-00-00', NULL, 0, '0', 'Pesawaran Regency', NULL, NULL),
(1812, 18, 'Kabupaten Pringsewu', '0000-00-00', NULL, 0, '0', 'Pringsewu Regency', NULL, NULL),
(1813, 18, 'Kabupaten Pesisir Barat', '0000-00-00', NULL, 0, NULL, 'Pesisir Barat Regency', NULL, NULL),
(1871, 18, 'Kota Bandar Lampung', '0000-00-00', NULL, 1, NULL, 'Bandar Lampung', NULL, NULL),
(1872, 18, 'Kota Metro', '0000-00-00', NULL, 1, NULL, 'Metro', NULL, NULL),
(1901, 19, 'Kabupaten Bangka', '0000-00-00', NULL, 0, NULL, 'Bangka Regency', NULL, NULL),
(1902, 19, 'Kabupaten Belitung', '0000-00-00', NULL, 0, NULL, 'Belitung Regency', NULL, NULL),
(1903, 19, 'Kabupaten Bangka Barat', '0000-00-00', NULL, 0, NULL, 'Bangka Barat Regency', NULL, NULL),
(1904, 19, 'Kabupaten Bangka Tengah', '0000-00-00', NULL, 0, NULL, 'Bangka Tengah Regency', NULL, NULL),
(1905, 19, 'Kabupaten Bangka Selatan', '0000-00-00', NULL, 0, NULL, 'Bangka Selatan Regency', NULL, NULL),
(1906, 19, 'Kabupaten Belitung Timur', '0000-00-00', NULL, 0, NULL, 'Belitung Timur Regency', NULL, NULL),
(1971, 19, 'Kota Pangkalpinang', '0000-00-00', NULL, 1, NULL, 'Pangkalpinang', NULL, NULL),
(2001, 20, 'Kabupaten Karimun', '0000-00-00', NULL, 0, NULL, 'Karimun Regency', NULL, NULL),
(2002, 20, 'Kabupaten Bintan', '0000-00-00', NULL, 0, NULL, 'Bintan Regency', NULL, NULL),
(2003, 20, 'Kabupaten Natuna', '0000-00-00', NULL, 0, NULL, 'Natuna Regency', NULL, NULL),
(2004, 20, 'Kabupaten lingga', NULL, '0000-00-00', NULL, NULL, 'lingga Regency', NULL, NULL),
(2005, 20, 'Kabupaten Kepulauan Anambas', '0000-00-00', NULL, 0, NULL, 'Kepulauan Anambas Regency', NULL, NULL),
(2071, 20, 'Kota Batam', '0000-00-00', NULL, 1, NULL, 'Batam', NULL, NULL),
(2072, 20, 'Kota Tanjungpinang', '0000-00-00', NULL, 1, NULL, 'Tanjungpinang', NULL, NULL),
(3101, 31, 'Kota Administrasi Kepulauan Seribu', '0000-00-00', '0000-00-00', 1, '', 'Thousand Islands (Indonesia)', '2018-11-21', 'admin3'),
(3171, 31, 'Kota Administrasi Jakarta Selatan', '0000-00-00', NULL, 1, NULL, 'South Jakarta', NULL, NULL),
(3172, 31, 'Kota Administrasi Jakarta Timur', '0000-00-00', NULL, 1, NULL, 'East Jakarta', NULL, NULL),
(3173, 31, 'Kota Administrasi Jakarta Pusat', '0000-00-00', NULL, 1, NULL, 'Central Jakarta', NULL, NULL),
(3174, 31, 'Kota Administrasi Jakarta Barat', '0000-00-00', NULL, 1, NULL, 'West Jakarta', NULL, NULL),
(3175, 31, 'Kota Administrasi Jakarta Utara', '0000-00-00', NULL, 1, NULL, 'North Jakarta', NULL, NULL),
(3201, 32, 'Kabupaten Bogor', '0000-00-00', NULL, 0, NULL, 'Bogor Regency', NULL, NULL),
(3202, 32, 'Kabupaten Sukabumi', '0000-00-00', NULL, 0, NULL, 'Sukabumi Regency', NULL, NULL),
(3203, 32, 'Kabupaten Cianjur', '0000-00-00', NULL, 0, NULL, 'Cianjur Regency', NULL, NULL),
(3204, 32, 'Kabupaten Bandung', '0000-00-00', NULL, 0, NULL, 'Bandung Regency', NULL, NULL),
(3205, 32, 'Kabupaten Garut', '0000-00-00', NULL, 0, NULL, 'Garut Regency', NULL, NULL),
(3206, 32, 'Kabupaten Tasikmalaya', '0000-00-00', NULL, 0, NULL, 'Tasikmalaya Regency', NULL, NULL),
(3207, 32, 'Kabupaten Ciamis', '0000-00-00', NULL, 0, NULL, 'Ciamis Regency', NULL, NULL),
(3208, 32, 'Kabupaten Kuningan', '0000-00-00', NULL, 0, NULL, 'Kuningan Regency', NULL, NULL),
(3209, 32, 'Kabupaten Cirebon', '0000-00-00', NULL, 0, NULL, 'Cirebon Regency', NULL, NULL),
(3210, 32, 'Kabupaten Majalengka', '0000-00-00', NULL, 0, NULL, 'Majalengka Regency', NULL, NULL),
(3211, 32, 'Kabupaten Sumedang', '0000-00-00', NULL, 0, NULL, 'Sumedang Regency', NULL, NULL),
(3212, 32, 'Kabupaten Indramayu', '0000-00-00', NULL, 0, NULL, 'Indramayu Regency', NULL, NULL),
(3213, 32, 'Kabupaten Subang', '0000-00-00', NULL, 0, NULL, 'Subang Regency', NULL, NULL),
(3214, 32, 'Kabupaten Purwakarta', '0000-00-00', NULL, 0, NULL, 'Purwakarta Regency', NULL, NULL),
(3215, 32, 'Kabupaten Karawang', '0000-00-00', NULL, 0, NULL, 'Karawang Regency', NULL, NULL),
(3216, 32, 'Kabupaten Bekasi', '0000-00-00', NULL, 0, NULL, 'Bekasi Regency', NULL, NULL),
(3217, 32, 'Kabupaten Bandung Barat', NULL, NULL, NULL, NULL, 'Bandung Barat Regency', NULL, NULL),
(3218, 32, 'Kabupaten Pangandaran', '0000-00-00', NULL, NULL, NULL, 'Pangandaran Regency', NULL, NULL),
(3271, 32, 'Kota Bogor', '0000-00-00', NULL, 1, NULL, 'Bogor', NULL, NULL),
(3272, 32, 'Kota Sukabumi', '0000-00-00', NULL, 1, NULL, 'Sukabumi', NULL, NULL),
(3273, 32, 'Kota Bandung', '0000-00-00', NULL, 1, NULL, 'Bandung', NULL, NULL),
(3274, 32, 'Kota Cirebon', '0000-00-00', NULL, 1, NULL, 'Cirebon', '0000-00-00', 'HUSAIN'),
(3275, 32, 'Kota Bekasi', '0000-00-00', NULL, 1, NULL, 'Bekasi', NULL, NULL),
(3276, 32, 'Kota Depok', '0000-00-00', NULL, 1, NULL, 'Depok', NULL, NULL),
(3277, 32, 'Kota Cimahi', '0000-00-00', NULL, 1, NULL, 'Cimahi', NULL, NULL),
(3278, 32, 'Kota Tasikmalaya', '0000-00-00', NULL, 1, NULL, 'Tasikmalaya', NULL, NULL),
(3279, 32, 'Kota Banjar', '0000-00-00', NULL, 1, NULL, 'Banjar', NULL, NULL),
(3301, 33, 'Kabupaten Cilacap', '0000-00-00', NULL, 0, NULL, 'Cilacap Regency', NULL, NULL),
(3302, 33, 'Kabupaten Banyumas', '0000-00-00', NULL, 0, NULL, 'Banyumas Regency', NULL, NULL),
(3303, 33, 'Kabupaten Purbalingga', '0000-00-00', NULL, 0, NULL, 'Purbalingga Regency', NULL, NULL),
(3304, 33, 'Kabupaten Banjarnegara', '0000-00-00', NULL, 0, NULL, 'Banjarnegara Regency', NULL, NULL),
(3305, 33, 'Kabupaten Kebumen', '0000-00-00', NULL, 0, NULL, 'Kebumen Regency', NULL, NULL),
(3306, 33, 'Kabupaten Purworejo', '0000-00-00', NULL, 0, NULL, 'Purworejo Regency', NULL, NULL),
(3307, 33, 'Kabupaten Wonosobo', '0000-00-00', NULL, 0, NULL, 'Wonosobo Regency', NULL, NULL),
(3308, 33, 'Kabupaten Magelang', '0000-00-00', NULL, 0, NULL, 'Magelang Regency', NULL, NULL),
(3309, 33, 'Kabupaten Boyolali', '0000-00-00', NULL, 0, NULL, 'Boyolali Regency', NULL, NULL),
(3310, 33, 'Kabupaten Klaten', '0000-00-00', NULL, 0, NULL, 'Klaten Regency', NULL, NULL),
(3311, 33, 'Kabupaten Sukoharjo', '0000-00-00', NULL, 0, NULL, 'Sukoharjo Regency', NULL, NULL),
(3312, 33, 'Kabupaten Wonogiri', '0000-00-00', NULL, 0, NULL, 'Wonogiri Regency', NULL, NULL),
(3313, 33, 'Kabupaten Karanganyar', '0000-00-00', NULL, 0, NULL, 'Karanganyar Regency', NULL, NULL),
(3314, 33, 'Kabupaten Sragen', '0000-00-00', NULL, 0, NULL, 'Sragen Regency', NULL, NULL),
(3315, 33, 'Kabupaten Grobogan', '0000-00-00', NULL, 0, NULL, 'Grobogan Regency', NULL, NULL),
(3316, 33, 'Kabupaten Blora', '0000-00-00', NULL, 0, NULL, 'Blora Regency', NULL, NULL),
(3317, 33, 'Kabupaten Rembang', '0000-00-00', NULL, 0, NULL, 'Rembang Regency', NULL, NULL),
(3318, 33, 'Kabupaten Pati', '0000-00-00', NULL, 0, NULL, 'Pati Regency', NULL, NULL),
(3319, 33, 'Kabupaten Kudus', '0000-00-00', NULL, 0, NULL, 'Kudus Regency', NULL, NULL),
(3320, 33, 'Kabupaten Jepara', '0000-00-00', NULL, 0, NULL, 'Jepara Regency', NULL, NULL),
(3321, 33, 'Kabupaten Demak', '0000-00-00', NULL, 0, NULL, 'Demak Regency', NULL, NULL),
(3322, 33, 'Kabupaten Semarang', '0000-00-00', NULL, 0, NULL, 'Semarang Regency', NULL, NULL),
(3323, 33, 'Kabupaten Temanggung', '0000-00-00', NULL, 0, NULL, 'Temanggung Regency', NULL, NULL),
(3324, 33, 'Kabupaten Kendal', '0000-00-00', NULL, 0, NULL, 'Kendal Regency', NULL, NULL),
(3325, 33, 'Kabupaten Batang', '0000-00-00', NULL, 0, NULL, 'Batang Regency', NULL, NULL),
(3326, 33, 'Kabupaten Pekalongan', '0000-00-00', NULL, 0, NULL, 'Pekalongan Regency', NULL, NULL),
(3327, 33, 'Kabupaten Pemalang', '0000-00-00', NULL, 0, NULL, 'Pemalang Regency', NULL, NULL),
(3328, 33, 'Kabupaten Tegal', '0000-00-00', NULL, 0, NULL, 'Tegal Regency', NULL, NULL),
(3329, 33, 'Kabupaten Brebes', '0000-00-00', NULL, 0, NULL, 'Brebes Regency', NULL, NULL),
(3371, 33, 'Kota Magelang', '0000-00-00', NULL, 1, NULL, 'Magelang', NULL, NULL),
(3372, 33, 'Kota Surakarta', '0000-00-00', NULL, 1, NULL, 'Surakarta', NULL, NULL),
(3373, 33, 'Kota Salatiga', '0000-00-00', NULL, 1, NULL, 'Salatiga', NULL, NULL),
(3374, 33, 'Kota Semarang', '0000-00-00', NULL, 1, NULL, 'Semarang', NULL, NULL),
(3375, 33, 'Kota Pekalongan', '0000-00-00', NULL, 1, NULL, 'Pekalongan', NULL, NULL),
(3376, 33, 'Kota Tegal', '0000-00-00', NULL, 1, NULL, 'Tegal', NULL, NULL),
(3401, 34, 'Kabupaten Kulon Progo', '0000-00-00', NULL, 0, NULL, 'Kulon Progo Regency', NULL, NULL),
(3402, 34, 'Kabupaten Bantul', '0000-00-00', NULL, 0, NULL, 'Bantul Regency', NULL, NULL),
(3403, 34, 'Kabupaten Gunungkidul', '0000-00-00', NULL, 0, NULL, 'Gunungkidul Regency', NULL, NULL),
(3404, 34, 'Kabupaten Sleman', '0000-00-00', NULL, 0, NULL, 'Sleman Regency', NULL, NULL),
(3471, 34, 'Kota Yogyakarta', '0000-00-00', NULL, 1, NULL, 'Yogyakarta', NULL, NULL),
(3501, 35, 'Kabupaten Pacitan', '0000-00-00', NULL, 0, NULL, 'Pacitan Regency', NULL, NULL),
(3502, 35, 'Kabupaten Ponorogo', '0000-00-00', NULL, 0, NULL, 'Ponorogo Regency', NULL, NULL),
(3503, 35, 'Kabupaten Trenggalek', '0000-00-00', NULL, 0, NULL, 'Trenggalek Regency', NULL, NULL),
(3504, 35, 'Kabupaten Tulungagung', '0000-00-00', NULL, 0, NULL, 'Tulungagung Regency', NULL, NULL),
(3505, 35, 'Kabupaten Blitar', '0000-00-00', NULL, 0, NULL, 'Blitar Regency', NULL, NULL),
(3506, 35, 'Kabupaten Kediri', '0000-00-00', NULL, 0, NULL, 'Kediri Regency', NULL, NULL),
(3507, 35, 'Kabupaten Malang', '0000-00-00', NULL, 0, NULL, 'Malang Regency', NULL, NULL),
(3508, 35, 'Kabupaten Lumajang', '0000-00-00', NULL, 0, NULL, 'Lumajang Regency', NULL, NULL),
(3509, 35, 'Kabupaten Jember', '0000-00-00', NULL, 0, NULL, 'Jember Regency', NULL, NULL),
(3510, 35, 'Kabupaten Banyuwangi', '0000-00-00', NULL, 0, NULL, 'Banyuwangi Regency', NULL, NULL),
(3511, 35, 'Kabupaten Bondowoso', '0000-00-00', NULL, 0, NULL, 'Bondowoso Regency', NULL, NULL),
(3512, 35, 'Kabupaten Situbondo', '0000-00-00', NULL, 0, NULL, 'Situbondo Regency', NULL, NULL),
(3513, 35, 'Kabupaten Probolinggo', '0000-00-00', NULL, 0, NULL, 'Probolinggo Regency', NULL, NULL),
(3514, 35, 'Kabupaten Pasuruan', '0000-00-00', NULL, 1, NULL, 'Pasuruan Regency', NULL, NULL),
(3515, 35, 'Kabupaten Sidoarjo', '0000-00-00', NULL, 0, NULL, 'Sidoarjo Regency', NULL, NULL),
(3516, 35, 'Kabupaten Mojokerto', '0000-00-00', NULL, 0, NULL, 'Mojokerto Regency', NULL, NULL),
(3517, 35, 'Kabupaten Jombang', '0000-00-00', NULL, 0, NULL, 'Jombang Regency', NULL, NULL),
(3518, 35, 'Kabupaten Nganjuk', '0000-00-00', NULL, 0, NULL, 'Nganjuk Regency', NULL, NULL),
(3519, 35, 'Kabupaten Madiun', '0000-00-00', NULL, 0, NULL, 'Madiun Regency', NULL, NULL),
(3520, 35, 'Kabupaten Magetan', '0000-00-00', NULL, 0, NULL, 'Magetan Regency', NULL, NULL),
(3521, 35, 'Kabupaten Ngawi', '0000-00-00', NULL, 0, NULL, 'Ngawi Regency', NULL, NULL),
(3522, 35, 'Kabupaten Bojonegoro', '0000-00-00', NULL, 0, NULL, 'Bojonegoro Regency', NULL, NULL),
(3523, 35, 'Kabupaten Tuban', '0000-00-00', NULL, 0, NULL, 'Tuban Regency', NULL, NULL),
(3524, 35, 'Kabupaten Lamongan', '0000-00-00', NULL, 0, NULL, 'Lamongan Regency', NULL, NULL),
(3525, 35, 'Kabupaten Gresik', '0000-00-00', NULL, 0, NULL, 'Gresik Regency', NULL, NULL),
(3526, 35, 'Kabupaten Bangkalan', '0000-00-00', NULL, 0, NULL, 'Bangkalan Regency', NULL, NULL),
(3527, 35, 'Kabupaten Sampang', '0000-00-00', NULL, 0, NULL, 'Sampang Regency', NULL, NULL),
(3528, 35, 'Kabupaten Pamekasan', '0000-00-00', NULL, 0, NULL, 'Pamekasan Regency', NULL, NULL),
(3529, 35, 'Kabupaten Sumenep', '0000-00-00', NULL, 0, NULL, 'Sumenep Regency', NULL, NULL),
(3571, 35, 'Kota Kediri', '0000-00-00', NULL, 1, NULL, 'Kediri', NULL, NULL),
(3572, 35, 'Kota Blitar', '0000-00-00', NULL, 1, NULL, 'Blitar', NULL, NULL),
(3573, 35, 'Kota Malang', '0000-00-00', NULL, 1, NULL, 'Malang', NULL, NULL),
(3574, 35, 'Kota Probolinggo', '0000-00-00', NULL, 1, NULL, 'Probolinggo', NULL, NULL),
(3575, 35, 'Kota Pasuruan', '0000-00-00', NULL, 1, NULL, 'Pasuruan', NULL, NULL),
(3576, 35, 'Kota Mojokerto', '0000-00-00', NULL, 1, NULL, 'Mojokerto', NULL, NULL),
(3577, 35, 'Kota Madiun', '0000-00-00', NULL, 1, NULL, 'Madiun', NULL, NULL),
(3578, 35, 'Kota Surabaya', '0000-00-00', NULL, 1, NULL, 'Surabaya', NULL, NULL),
(3579, 35, 'Kota Batu', '0000-00-00', NULL, 1, NULL, 'Batu', NULL, NULL),
(3601, 36, 'Kabupaten Pandeglang', '0000-00-00', NULL, 0, NULL, 'Pandeglang Regency', NULL, NULL),
(3602, 36, 'Kabupaten Lebak', '0000-00-00', NULL, 0, NULL, 'Lebak Regency', NULL, NULL),
(3603, 36, 'Kabupaten Tangerang', '0000-00-00', NULL, 0, NULL, 'Tangerang Regency', NULL, NULL),
(3604, 36, 'Kabupaten Serang', '0000-00-00', NULL, 0, NULL, 'Serang Regency', NULL, NULL),
(3671, 36, 'Kota Tangerang', '0000-00-00', NULL, 1, NULL, 'Tangerang', NULL, NULL),
(3672, 36, 'Kota Cilegon', '0000-00-00', NULL, 1, NULL, 'Cilegon', NULL, NULL),
(3673, 36, 'Kota Tangerang Selatan', '0000-00-00', NULL, 1, '1', 'South Tangerang', NULL, NULL),
(3674, 36, 'Kota Serang', '0000-00-00', NULL, 1, NULL, 'Serang', NULL, NULL),
(5101, 51, 'Kabupaten Jembrana', '0000-00-00', NULL, 0, NULL, 'Jembrana Regency', '0000-00-00', 'insert ulang, data kabkot tidak ditemukan - by husain'),
(5102, 51, 'Kabupaten Tabanan', '0000-00-00', NULL, 0, NULL, 'Tabanan Regency', NULL, NULL),
(5103, 51, 'Kabupaten Badung', '0000-00-00', NULL, 0, NULL, 'Badung Regency', NULL, NULL),
(5104, 51, 'Kabupaten Gianyar', '0000-00-00', NULL, 0, NULL, 'Gianyar Regency', NULL, NULL),
(5105, 51, 'Kabupaten Klungkung', '0000-00-00', NULL, 0, NULL, 'Klungkung Regency', NULL, NULL),
(5106, 51, 'Kabupaten Bangli', '0000-00-00', NULL, 0, NULL, 'Bangli Regency', NULL, NULL),
(5107, 51, 'Kabupaten Karangasem', '0000-00-00', NULL, 0, NULL, 'Karangasem Regency', NULL, NULL),
(5108, 51, 'Kabupaten Buleleng', '0000-00-00', NULL, 0, NULL, 'Buleleng Regency', NULL, NULL),
(5171, 51, 'Kota Denpasar', '0000-00-00', NULL, 1, NULL, 'Denpasar', NULL, NULL),
(5201, 52, 'Kabupaten Lombok Barat', '0000-00-00', NULL, 0, NULL, 'Lombok Barat Regency', NULL, NULL),
(5202, 52, 'Kabupaten Lombok Tengah', '0000-00-00', NULL, 0, NULL, 'Lombok Tengah Regency', NULL, NULL),
(5203, 52, 'Kabupaten Lombok Timur', '0000-00-00', NULL, 0, NULL, 'Lombok Timur Regency', NULL, NULL),
(5204, 52, 'Kabupaten Sumbawa', '0000-00-00', NULL, 0, NULL, 'Sumbawa Regency', NULL, NULL),
(5205, 52, 'Kabupaten Dompu', '0000-00-00', NULL, 0, NULL, 'Dompu Regency', NULL, NULL),
(5206, 52, 'Kabupaten Bima', '0000-00-00', NULL, 0, NULL, 'Bima Regency', NULL, NULL),
(5207, 52, 'Kabupaten Sumbawa Barat', NULL, '0000-00-00', NULL, NULL, 'Sumbawa Barat Regency', NULL, NULL),
(5208, 52, 'Kabupaten Lombok Utara', '0000-00-00', NULL, 0, NULL, 'Lombok Utara Regency', NULL, NULL),
(5271, 52, 'Kota Mataram', '0000-00-00', NULL, 1, NULL, 'Mataram', NULL, NULL),
(5272, 52, 'Kota Bima', '0000-00-00', NULL, 1, NULL, 'Bima', NULL, NULL),
(5301, 53, 'Kabupaten Sumba Barat', '0000-00-00', NULL, 0, NULL, 'Sumba Barat Regency', NULL, NULL),
(5302, 53, 'Kabupaten Sumba Timur', '0000-00-00', NULL, 0, NULL, 'Sumba Timur Regency', NULL, NULL),
(5303, 53, 'Kabupaten Kupang', '0000-00-00', NULL, 0, NULL, 'Kupang Regency', NULL, NULL),
(5304, 53, 'Kabupaten Timor Tengah Selatan', '0000-00-00', NULL, 0, NULL, 'Timor Tengah Selatan Regency', NULL, NULL),
(5305, 53, 'Kabupaten Timor Tengah Utara', '0000-00-00', NULL, 0, NULL, 'Timor Tengah Utara Regency', NULL, NULL),
(5306, 53, 'Kabupaten Belu', '0000-00-00', NULL, 0, NULL, 'Belu Regency', NULL, NULL),
(5307, 53, 'Kabupaten Alor', '0000-00-00', NULL, 0, NULL, 'Alor Regency', NULL, NULL),
(5308, 53, 'Kabupaten Lembata', '0000-00-00', NULL, 0, NULL, 'Lembata Regency', NULL, NULL),
(5309, 53, 'Kabupaten Flores Timur', '0000-00-00', NULL, 0, NULL, 'Flores Timur Regency', NULL, NULL),
(5310, 53, 'Kabupaten Sikka', '0000-00-00', NULL, 0, NULL, 'Sikka Regency', NULL, NULL),
(5311, 53, 'Kabupaten Ende', '0000-00-00', NULL, 0, NULL, 'Ende Regency', NULL, NULL),
(5312, 53, 'Kabupaten Ngada', '0000-00-00', NULL, 0, NULL, 'Ngada Regency', NULL, NULL),
(5313, 53, 'Kabupaten Manggarai', '0000-00-00', NULL, 0, NULL, 'Manggarai Regency', NULL, NULL),
(5314, 53, 'Kabupaten Rote Ndao', '0000-00-00', NULL, 0, NULL, 'Rote Ndao Regency', NULL, NULL),
(5315, 53, 'Kabupaten Manggarai Barat', '0000-00-00', NULL, 0, NULL, 'Manggarai Barat Regency', NULL, NULL),
(5316, 53, 'Kabupaten Sumba Tengah', '0000-00-00', NULL, 0, NULL, 'Sumba Tengah Regency', NULL, NULL),
(5317, 53, 'Kabupaten Sumba Barat Daya', '0000-00-00', NULL, 0, NULL, 'Sumba Barat Daya Regency', NULL, NULL),
(5318, 53, 'Kabupaten Nagekeo', '0000-00-00', NULL, 0, NULL, 'Nagekeo Regency', NULL, NULL),
(5319, 53, 'Kabupaten Manggarai Timur', '0000-00-00', NULL, 0, NULL, 'Manggarai Timur Regency', NULL, NULL),
(5320, 53, 'Kabupaten Sabu Raijua', '0000-00-00', NULL, 0, NULL, 'Sabu Raijua Regency', NULL, NULL),
(5321, 53, 'Kabupaten Malaka', '0000-00-00', NULL, 0, NULL, 'Malaka Regency', NULL, NULL),
(5371, 53, 'Kota Kupang', '0000-00-00', NULL, 1, NULL, 'Kupang', NULL, NULL),
(6101, 61, 'Kabupaten Sambas', '0000-00-00', NULL, 0, NULL, 'Sambas Regency', NULL, NULL),
(6102, 61, 'Kabupaten Bengkayang', '0000-00-00', NULL, 0, NULL, 'Bengkayang Regency', NULL, NULL),
(6103, 61, 'Kabupaten Landak', '0000-00-00', NULL, 0, NULL, 'Landak Regency', NULL, NULL),
(6104, 61, 'Kabupaten Mempawah', '0000-00-00', NULL, 0, NULL, 'Mempawah Regency', '0000-00-00', 'HUSAIN'),
(6105, 61, 'Kabupaten Sanggau', '0000-00-00', NULL, 0, NULL, 'Sanggau Regency', NULL, NULL),
(6106, 61, 'Kabupaten Ketapang', '0000-00-00', NULL, 0, NULL, 'Ketapang Regency', NULL, NULL),
(6107, 61, 'Kabupaten Sintang', '0000-00-00', NULL, 0, NULL, 'Sintang Regency', NULL, NULL),
(6108, 61, 'Kabupaten Kapuas Hulu', '0000-00-00', NULL, 0, NULL, 'Kapuas Hulu Regency', NULL, NULL),
(6109, 61, 'Kabupaten Sekadau', NULL, '0000-00-00', NULL, NULL, 'Sekadau Regency', NULL, NULL),
(6110, 61, 'Kabupaten Melawi', '0000-00-00', NULL, 0, NULL, 'Melawi Regency', NULL, NULL),
(6111, 61, 'Kabupaten Kayong Utara', '0000-00-00', NULL, 0, 'null', 'Kayong Utara Regency', NULL, NULL),
(6112, 61, 'Kabupaten Kubu Raya', '0000-00-00', NULL, 0, NULL, 'Kubu Raya Regency', NULL, NULL),
(6171, 61, 'Kota Pontianak', '0000-00-00', NULL, 1, NULL, 'Pontianak', '0000-00-00', 'HUSAIN'),
(6172, 61, 'Kota Singkawang', '0000-00-00', NULL, 1, NULL, 'Singkawang', NULL, NULL),
(6201, 62, 'Kabupaten Kotawaringin Barat', '0000-00-00', NULL, 0, NULL, 'Kotawaringin Barat Regency', NULL, NULL),
(6202, 62, 'Kabupaten Kotawaringin Timur', '0000-00-00', NULL, 0, NULL, 'Kotawaringin Timur Regency', NULL, NULL),
(6203, 62, 'Kabupaten Kapuas', '0000-00-00', NULL, 0, NULL, 'Kapuas Regency', NULL, NULL),
(6204, 62, 'Kabupaten Barito Selatan', '0000-00-00', NULL, 0, NULL, 'Barito Selatan Regency', NULL, NULL),
(6205, 62, 'Kabupaten Barito Utara', '0000-00-00', NULL, 0, NULL, 'Barito Utara Regency', NULL, NULL),
(6206, 62, 'Kabupaten Sukamara', '0000-00-00', NULL, 0, NULL, 'Sukamara Regency', NULL, NULL),
(6207, 62, 'Kabupaten Lamandau', '0000-00-00', NULL, 0, NULL, 'Lamandau Regency', NULL, NULL),
(6208, 62, 'Kabupaten Seruyan', '0000-00-00', NULL, 0, NULL, 'Seruyan Regency', NULL, NULL),
(6209, 62, 'Kabupaten Katingan', '0000-00-00', NULL, 0, NULL, 'Katingan Regency', NULL, NULL),
(6210, 62, 'Kabupaten Pulang Pisau', '0000-00-00', NULL, 0, NULL, 'Pulang Pisau Regency', NULL, NULL),
(6211, 62, 'Kabupaten Gunung Mas', '0000-00-00', NULL, 0, NULL, 'Gunung Mas Regency', NULL, NULL),
(6212, 62, 'Kabupaten Barito Timur', '0000-00-00', NULL, 0, NULL, 'Barito Timur Regency', NULL, NULL),
(6213, 62, 'Kabupaten Murung Raya', '0000-00-00', NULL, 0, NULL, 'Murung Raya Regency', NULL, NULL),
(6271, 62, 'Kota Palangka Raya', '0000-00-00', NULL, 1, NULL, 'Palangka Raya', NULL, NULL),
(6301, 63, 'Kabupaten Tanah Laut', '0000-00-00', NULL, 0, NULL, 'Tanah Laut Regency', NULL, NULL),
(6302, 63, 'Kabupaten Kotabaru', '0000-00-00', NULL, 0, NULL, 'Kotabaru Regency', NULL, NULL),
(6303, 63, 'Kabupaten Banjar', '0000-00-00', NULL, 0, NULL, 'Banjar Regency', NULL, NULL),
(6304, 63, 'Kabupaten Barito Kuala', '0000-00-00', NULL, 0, NULL, 'Barito Kuala Regency', NULL, NULL),
(6305, 63, 'Kabupaten Tapin', '0000-00-00', NULL, 0, NULL, 'Tapin Regency', NULL, NULL),
(6306, 63, 'Kabupaten Hulu Sungai Selatan', '0000-00-00', NULL, 0, NULL, 'Hulu Sungai Selatan Regency', NULL, NULL),
(6307, 63, 'Kabupaten Hulu Sungai Tengah', '0000-00-00', NULL, 0, NULL, 'Hulu Sungai Tengah Regency', NULL, NULL),
(6308, 63, 'Kabupaten Hulu Sungai Utara', '0000-00-00', NULL, 0, NULL, 'Hulu Sungai Utara Regency', NULL, NULL),
(6309, 63, 'Kabupaten Tabalong', '0000-00-00', NULL, 0, NULL, 'Tabalong Regency', NULL, NULL),
(6310, 63, 'Kabupaten Tanah Bumbu', '0000-00-00', NULL, 0, NULL, 'Tanah Bumbu Regency', NULL, NULL),
(6311, 63, 'Kabupaten Balangan', '0000-00-00', NULL, 0, NULL, 'Balangan Regency', NULL, NULL),
(6371, 63, 'Kota Banjarmasin', '0000-00-00', NULL, 1, NULL, 'Banjarmasin', NULL, NULL),
(6372, 63, 'Kota Banjarbaru', '0000-00-00', NULL, 1, NULL, 'Banjarbaru', NULL, NULL),
(6401, 64, 'Kabupaten Paser', '0000-00-00', NULL, 0, NULL, 'Paser Regency', NULL, NULL),
(6402, 64, 'Kabupaten Kutai Barat', '0000-00-00', NULL, 0, NULL, 'Kutai Barat Regency', NULL, NULL),
(6403, 64, 'Kabupaten Kutai Kartanegara', '0000-00-00', NULL, 0, NULL, 'Kutai Kartanegara Regency', NULL, NULL),
(6404, 64, 'Kabupaten Kutai Timur', '0000-00-00', NULL, 0, NULL, 'Kutai Timur Regency', NULL, NULL),
(6405, 64, 'Kabupaten Berau', '0000-00-00', NULL, 0, NULL, 'Berau Regency', NULL, NULL),
(6406, 65, 'Kabupaten Malinau', '0000-00-00', NULL, 0, NULL, 'Malinau Regency', NULL, NULL),
(6407, 65, 'Kabupaten Bulungan', '0000-00-00', NULL, 0, NULL, 'Bulungan Regency', '0000-00-00', 'HUSAIN'),
(6408, 65, 'Kabupaten Nunukan', '0000-00-00', NULL, 0, NULL, 'Nunukan Regency', NULL, NULL),
(6409, 64, 'Kabupaten Penajam Paser Utara', '0000-00-00', NULL, 0, NULL, 'Penajam Paser Utara Regency', NULL, NULL),
(6411, 64, 'Kabupaten Mahakam Hulu', '0000-00-00', NULL, 0, NULL, 'Mahakam Hulu Regency', NULL, NULL),
(6471, 64, 'Kota Balikpapan', '0000-00-00', NULL, 1, NULL, 'Balikpapan', NULL, NULL),
(6472, 64, 'Kota Samarinda', '0000-00-00', NULL, 1, NULL, 'Samarinda', NULL, NULL),
(6473, 65, 'Kota Tarakan', '0000-00-00', NULL, 1, NULL, 'Tarakan', NULL, NULL),
(6474, 64, 'Kota Bontang', '0000-00-00', NULL, 1, NULL, 'Bontang', NULL, NULL),
(6503, 65, 'Kabupaten Tana Tidung', '0000-00-00', NULL, 0, '1', 'Tana Tidung Regency', NULL, NULL),
(7101, 71, 'Kabupaten Bolaang Mangondow', NULL, '0000-00-00', 0, NULL, 'Bolaang Mangondow Regency', NULL, NULL),
(7102, 71, 'Kabupaten Minahasa', NULL, '0000-00-00', 0, NULL, 'Minahasa Regency', NULL, NULL),
(7103, 71, 'Kabupaten Kepulauan Sangihe ', NULL, '0000-00-00', 0, NULL, 'Kepulauan Sangihe  Regency', NULL, NULL),
(7104, 71, 'Kabupaten Kepulauan Talaud', NULL, '0000-00-00', 0, NULL, 'Kepulauan Talaud Regency', NULL, NULL),
(7105, 71, 'Kabupaten Minahasa Selatan', NULL, '0000-00-00', 0, NULL, 'Minahasa Selatan Regency', NULL, NULL),
(7106, 71, 'Kabupaten Minahasa Utara', NULL, '0000-00-00', 0, NULL, 'Minahasa Utara Regency', NULL, NULL),
(7107, 71, 'Kabupaten Bolaang Mongondow Utara', '0000-00-00', NULL, 0, NULL, 'Bolaang Mongondow Utara Regency', NULL, NULL),
(7108, 71, 'Kabupaten Siau Tagulandang Biaro', '0000-00-00', NULL, 0, NULL, 'Siau Tagulandang Biaro Regency', NULL, NULL),
(7109, 71, 'Kabupaten Minahasa Tenggara', '0000-00-00', NULL, 0, NULL, 'Minahasa Tenggara Regency', NULL, NULL),
(7110, 71, 'Kabupaten Bolaang Mongondow Selatan', '0000-00-00', NULL, 0, NULL, 'Bolaang Mongondow Selatan Regency', NULL, NULL),
(7111, 71, 'Kabupaten Bolaang Mongondow Timur', '0000-00-00', NULL, 0, NULL, 'Bolaang Mongondow Timur Regency', NULL, NULL),
(7171, 71, 'Kota Manado', NULL, '0000-00-00', 1, NULL, 'Manado', NULL, NULL),
(7172, 71, 'Kota Bitung', NULL, '0000-00-00', 1, NULL, 'Bitung', NULL, NULL),
(7173, 71, 'Kota Tomohon', NULL, '0000-00-00', 1, NULL, 'Tomohon', NULL, NULL),
(7174, 71, 'Kota Kotamobagu', NULL, '0000-00-00', 1, NULL, 'Kotamobagu', NULL, NULL),
(7201, 72, 'Kabupaten Banggai Kepulauan', NULL, '0000-00-00', 0, '1', 'Banggai Kepulauan Regency', NULL, NULL),
(7202, 72, 'Kabupaten Banggai', NULL, '0000-00-00', 0, '1', 'Banggai Regency', NULL, NULL),
(7203, 72, 'Kabupaten Morowali', NULL, '0000-00-00', 0, '1', 'Morowali Regency', NULL, NULL),
(7204, 72, 'Kabupaten Poso', NULL, '0000-00-00', 0, '1', 'Poso Regency', NULL, NULL),
(7205, 72, 'Kabupaten Donggala', NULL, '0000-00-00', 0, '1', 'Donggala Regency', NULL, NULL),
(7206, 72, 'Kabupaten Toli Toli', NULL, '0000-00-00', 0, '1', 'Toli Toli Regency', NULL, NULL),
(7207, 72, 'Kabupaten Buol', NULL, '0000-00-00', 0, '1', 'Buol Regency', NULL, NULL),
(7208, 72, 'Kabupaten Parigi Moutong', '0000-00-00', NULL, 0, '1', 'Parigi Moutong Regency', NULL, NULL),
(7209, 72, 'Kabupaten Tojo Una-una', NULL, '0000-00-00', 0, '1', 'Tojo Una-una Regency', NULL, NULL),
(7210, 72, 'Kabupaten Sigi', NULL, NULL, 0, '1', 'Sigi Regency', NULL, NULL),
(7211, 72, 'Kabupaten Banggai Laut', '0000-00-00', NULL, 0, '1', 'Banggai Laut Regency', NULL, NULL),
(7212, 72, 'Kabupaten Morowali Utara', NULL, '0000-00-00', 0, '1', 'Morowali Utara Regency', NULL, NULL),
(7271, 72, 'Kota Palu', NULL, '0000-00-00', 1, '1', 'Palu City', NULL, NULL),
(7301, 73, 'Kabupaten Kepulauan Selayar', NULL, '0000-00-00', 0, NULL, 'Kepulauan Selayar Regency', NULL, NULL),
(7302, 73, 'Kabupaten Bulukumba', NULL, '0000-00-00', 0, NULL, 'Bulukumba Regency', NULL, NULL),
(7303, 73, 'Kabupaten Bantaeng', NULL, '0000-00-00', 0, NULL, 'Bantaeng Regency', NULL, NULL),
(7304, 73, 'Kabupaten Jeneponto', NULL, '0000-00-00', 0, NULL, 'Jeneponto Regency', NULL, NULL),
(7305, 73, 'Kabupaten Takalar', NULL, '0000-00-00', 0, NULL, 'Takalar Regency', NULL, NULL),
(7306, 73, 'Kabupaten Gowa', NULL, '0000-00-00', 0, NULL, 'Gowa Regency', NULL, NULL),
(7307, 73, 'Kabupaten Sinjai', NULL, '0000-00-00', 0, NULL, 'Sinjai Regency', NULL, NULL),
(7308, 73, 'Kabupaten Maros', NULL, '0000-00-00', 0, NULL, 'Maros Regency', NULL, NULL),
(7309, 73, 'Kabupaten Pangkajene Dan Kepulauan', NULL, '0000-00-00', 0, NULL, 'Pangkajene Dan Kepulauan Regency', NULL, NULL),
(7310, 73, 'Kabupaten Barru', NULL, '0000-00-00', 0, NULL, 'Barru Regency', NULL, NULL),
(7311, 73, 'Kabupaten Bone', NULL, '0000-00-00', 0, NULL, 'Bone Regency', NULL, NULL),
(7312, 73, 'Kabupaten Soppeng', NULL, '0000-00-00', 0, NULL, 'Soppeng Regency', NULL, NULL),
(7313, 73, 'Kabupaten Wajo', NULL, '0000-00-00', 0, NULL, 'Wajo Regency', NULL, NULL),
(7314, 73, 'Kabupaten Sidenreng Rappang', NULL, '0000-00-00', 0, NULL, 'Sidenreng Rappang Regency', NULL, NULL),
(7315, 73, 'Kabupaten Pinrang', NULL, '0000-00-00', 0, NULL, 'Pinrang Regency', NULL, NULL),
(7316, 73, 'Kabupaten Enrekang', NULL, '0000-00-00', 0, NULL, 'Enrekang Regency', NULL, NULL),
(7317, 73, 'Kabupaten Luwu', NULL, '0000-00-00', 0, NULL, 'Luwu Regency', NULL, NULL),
(7318, 73, 'Kabupaten Tana Toraja', NULL, '0000-00-00', 0, NULL, 'Tana Toraja Regency', NULL, NULL),
(7322, 73, 'Kabupaten Luwu Utara', '0000-00-00', NULL, 0, NULL, 'Luwu Utara Regency', NULL, NULL),
(7325, 73, 'Kabupaten Luwu Timur', '0000-00-00', NULL, 0, NULL, 'Luwu Timur Regency', NULL, NULL),
(7326, 73, 'Kabupaten Toraja Utara', '0000-00-00', NULL, 0, NULL, 'Toraja Utara Regency', NULL, NULL),
(7371, 73, 'Kota Makassar', '0000-00-00', NULL, 1, NULL, 'Makassar', NULL, NULL),
(7372, 73, 'Kota Pare-pare', '0000-00-00', NULL, 1, NULL, 'Pare-pare', NULL, NULL),
(7373, 73, 'Kota Palopo', '0000-00-00', NULL, 1, NULL, 'Palopo', NULL, NULL),
(7401, 74, 'Kabupaten Buton', '0000-00-00', NULL, 0, NULL, 'Buton Regency', NULL, NULL),
(7402, 74, 'Kabupaten Muna', '0000-00-00', NULL, 0, NULL, 'Muna Regency', NULL, NULL),
(7403, 74, 'Kabupaten Konawe', '0000-00-00', NULL, 0, NULL, 'Konawe Regency', NULL, NULL),
(7404, 74, 'Kabupaten Kolaka', '0000-00-00', NULL, 0, NULL, 'Kolaka Regency', NULL, NULL),
(7405, 74, 'Kabupaten Konawe Selatan', '0000-00-00', NULL, 0, NULL, 'Konawe Selatan Regency', NULL, NULL),
(7406, 74, 'Kabupaten Bombana', NULL, '0000-00-00', NULL, NULL, 'Bombana Regency', NULL, NULL),
(7407, 74, 'Kabupaten Wakatobi', NULL, '0000-00-00', NULL, NULL, 'Wakatobi Regency', NULL, NULL),
(7408, 74, 'Kabupaten Kolaka Utara', '0000-00-00', NULL, 0, NULL, 'North Kolaka Regency', NULL, NULL),
(7409, 74, 'Kabupaten Buton Utara', '0000-00-00', NULL, 0, NULL, 'Buton Utara Regency', NULL, NULL),
(7410, 74, 'Kabupaten Konawe Utara', '0000-00-00', NULL, 0, NULL, 'Konawe Utara Regency', NULL, NULL),
(7411, 74, 'Kabupaten Kolaka Timur', '0000-00-00', NULL, 0, NULL, 'East Kolaka Regency', '0000-00-00', 'HUSAIN'),
(7412, 74, 'Kabupaten Konawe Kepulauan', '0000-00-00', NULL, 0, NULL, 'Konawe Kepulauan Regency', NULL, NULL),
(7413, 74, 'Kabupaten Muna Barat', '0000-00-00', NULL, 0, NULL, 'Muna Barat Regency', NULL, NULL),
(7414, 74, 'Kabupaten Buton Tengah', '0000-00-00', NULL, 0, NULL, 'Middle Buton Regency', NULL, NULL),
(7415, 74, 'Kabupaten Buton Selatan', '0000-00-00', NULL, 0, NULL, 'Buton Selatan Regency', NULL, NULL),
(7471, 74, 'Kota Kendari', '0000-00-00', NULL, 1, NULL, 'Kendari', NULL, NULL),
(7472, 74, 'Kota Baubau', '0000-00-00', NULL, 1, NULL, 'Baubau', NULL, NULL),
(7501, 75, 'Kabupaten Boalemo', '0000-00-00', NULL, 0, NULL, 'Boalemo Regency', NULL, NULL),
(7502, 75, 'Kabupaten Gorontalo', '0000-00-00', NULL, 0, NULL, 'Gorontalo Regency', NULL, NULL),
(7503, 75, 'Kabupaten Pohuwato', '0000-00-00', NULL, 0, NULL, 'Pohuwato Regency', NULL, NULL),
(7504, 75, 'Kabupaten Bone Bolango', '0000-00-00', NULL, 0, NULL, 'Bone Bolango Regency', NULL, NULL),
(7505, 75, 'Kabupaten Gorontalo Utara', '0000-00-00', NULL, 0, NULL, 'Gorontalo Utara Regency', NULL, NULL),
(7571, 75, 'Kota Gorontalo', '0000-00-00', NULL, 1, NULL, 'Gorontalo', NULL, NULL),
(7601, 76, 'Kabupaten Majene', '0000-00-00', NULL, 0, NULL, 'Majene Regency', NULL, NULL),
(7602, 76, 'Kabupaten Polewali Mandar', '0000-00-00', NULL, 0, NULL, 'Polewali Mandar Regency', NULL, NULL),
(7603, 76, 'Kabupaten Mamasa', '0000-00-00', NULL, 0, NULL, 'Mamasa Regency', NULL, NULL),
(7604, 76, 'Kabupaten Mamuju', '0000-00-00', NULL, 0, NULL, 'Mamuju Regency', NULL, NULL),
(7605, 76, 'Kabupaten Mamuju Utara', '0000-00-00', NULL, 0, NULL, 'Mamuju Utara Regency', NULL, NULL),
(7606, 76, 'Kabupaten Mamuju Tengah', '0000-00-00', NULL, 0, NULL, 'Mamuju Tengah Regency', NULL, NULL),
(8101, 81, 'Kabupaten Maluku Tenggara Barat', '0000-00-00', NULL, 0, NULL, 'Maluku Tenggara Barat Regency', NULL, NULL),
(8102, 81, 'Kabupaten Maluku Tenggara', '0000-00-00', NULL, 0, NULL, 'Maluku Tenggara Regency', NULL, NULL),
(8103, 81, 'Kabupaten Maluku Tengah', '0000-00-00', NULL, 0, NULL, 'Maluku Tengah Regency', NULL, NULL),
(8104, 81, 'Kabupaten Buru', '0000-00-00', NULL, 0, NULL, 'Buru Regency', NULL, NULL),
(8105, 81, 'Kabupaten Kepulauan Aru', NULL, '0000-00-00', NULL, NULL, 'Kepulauan Aru Regency', NULL, NULL),
(8106, 81, 'Kabupaten Seram Bagian Barat ', NULL, '0000-00-00', NULL, NULL, 'Seram Bagian Barat  Regency', NULL, NULL),
(8107, 81, 'Kabupaten Seram Bagian Timur', NULL, '0000-00-00', NULL, NULL, 'Seram Bagian Timur Regency', NULL, NULL),
(8108, 81, 'Kabupaten Maluku Barat Daya', '0000-00-00', NULL, NULL, NULL, 'Maluku Barat Daya Regency', NULL, NULL),
(8171, 81, 'Kota Ambon', '0000-00-00', NULL, 1, NULL, 'Ambon', NULL, NULL),
(8172, 81, 'Kota Tual', NULL, NULL, 1, NULL, 'Tual', NULL, NULL),
(8201, 82, 'Kabupaten Halmahera Barat', '0000-00-00', NULL, 0, NULL, 'Halmahera Barat Regency', NULL, NULL),
(8202, 82, 'Kabupaten Halmahera Tengah', '0000-00-00', NULL, 0, NULL, 'Halmahera Tengah Regency', NULL, NULL),
(8203, 82, 'Kabupaten Kepulauan Sula', '0000-00-00', NULL, 0, NULL, 'Kepulauan Sula Regency', NULL, NULL),
(8204, 82, 'Kabupaten Halmahera Selatan', '0000-00-00', NULL, 0, NULL, 'Halmahera Selatan Regency', NULL, NULL),
(8205, 82, 'Kabupaten Halmahera Utara', '0000-00-00', NULL, 0, NULL, 'Halmahera Utara Regency', NULL, NULL),
(8206, 82, 'Kabupaten Halmahera Timur', '0000-00-00', NULL, 0, NULL, 'Halmahera Timur Regency', NULL, NULL),
(8207, 82, 'Kabupaten Pulau Morotai', '0000-00-00', NULL, 0, NULL, 'Morotai Island Regency', NULL, NULL),
(8208, 82, 'Kabupaten Pulau Taliabu', '0000-00-00', NULL, 0, NULL, 'Taliabu Island Regency', NULL, NULL),
(8271, 82, 'Kota Ternate', '0000-00-00', NULL, 1, NULL, 'Ternate', NULL, NULL),
(8272, 82, 'Kota Tidore Kepulauan', '0000-00-00', NULL, 1, NULL, 'Tidore Islands', NULL, NULL),
(9101, 91, 'Kabupaten Fakfak', '0000-00-00', NULL, 0, NULL, 'Fak Fak Regency', NULL, NULL),
(9102, 91, 'Kabupaten Kaimana', '0000-00-00', NULL, 0, NULL, 'Kaimana Regency', NULL, NULL),
(9103, 91, 'Kabupaten Teluk Wondama', '0000-00-00', NULL, 0, NULL, 'Teluk Wondama Regency', NULL, NULL),
(9104, 91, 'Kabupaten Teluk Bintuni', '0000-00-00', NULL, 0, NULL, 'Teluk Bintuni Regency', NULL, NULL),
(9105, 91, 'Kabupaten Manokwari', '0000-00-00', NULL, 0, NULL, 'Manokwari Regency', NULL, NULL),
(9106, 91, 'Kabupaten Sorong Selatan', '0000-00-00', NULL, 0, NULL, 'Sorong Selatan Regency', NULL, NULL),
(9107, 91, 'Kabupaten Sorong', '0000-00-00', NULL, 0, NULL, 'Sorong Regency', NULL, NULL),
(9108, 91, 'Kabupaten Raja Ampat', '0000-00-00', NULL, 0, NULL, 'Raja Ampat Regency', NULL, NULL),
(9110, 91, 'Kabupaten Maybrat', '0000-00-00', '0000-00-00', 0, NULL, 'Maybrat Regency', '0000-00-00', 'tw_admin'),
(9111, 91, 'Kabupaten Manokwari Selatan', '0000-00-00', NULL, 0, NULL, 'South Manokwari Regency', NULL, 'tw_admin'),
(9112, 91, 'Kabupaten Pegunungan Arfak', '0000-00-00', NULL, 0, NULL, 'Arfak Mountains Regency', NULL, 'tw_admin'),
(9171, 91, 'Kota Sorong', '0000-00-00', NULL, 1, NULL, 'Sorong', NULL, NULL),
(9401, 94, 'Kabupaten Merauke', '0000-00-00', NULL, 0, NULL, 'Merauke Regency', NULL, NULL),
(9402, 94, 'Kabupaten Jayawijaya', '0000-00-00', NULL, 0, NULL, 'Jayawijaya Regency', NULL, NULL),
(9403, 94, 'Kabupaten Jayapura', '0000-00-00', NULL, 0, NULL, 'Jayapura Regency', NULL, NULL),
(9404, 94, 'Kabupaten Nabire', '0000-00-00', NULL, 0, NULL, 'Nabire Regency', NULL, NULL),
(9405, 94, 'Kabupaten Fak - Fak', NULL, '0000-00-00', NULL, NULL, 'Fak - Fak Regency', NULL, NULL),
(9407, 94, 'Kabupaten Manokwari', NULL, '0000-00-00', NULL, NULL, 'Manokwari Regency', NULL, NULL),
(9408, 94, 'Kabupaten Kepulauan Yapen', NULL, '0000-00-00', NULL, NULL, 'Yapen Island Regency', NULL, NULL),
(9409, 94, 'Kabupaten Biak Numfor', NULL, '0000-00-00', NULL, NULL, 'Biak Numfor Regency', NULL, NULL),
(9410, 94, 'Kabupaten Paniai', NULL, '0000-00-00', NULL, NULL, 'Paniai Regency', NULL, NULL),
(9411, 94, 'Kabupaten Puncak Jaya', NULL, '0000-00-00', NULL, NULL, 'Puncak Jaya Regency', NULL, NULL),
(9412, 94, 'Kabupaten Mimika', NULL, '0000-00-00', NULL, NULL, 'Mimika Regency', NULL, NULL),
(9413, 94, 'Kabupaten Boven Digoel', NULL, '0000-00-00', NULL, NULL, 'Boven Digoel Regency', NULL, NULL),
(9414, 94, 'Kabupaten Mappi', NULL, '0000-00-00', NULL, NULL, 'Mappi Regency', NULL, NULL),
(9415, 94, 'Kabupaten Asmat', NULL, '0000-00-00', NULL, NULL, 'Asmat Regency', NULL, NULL),
(9416, 94, 'Kabupaten Yahukimo', NULL, '0000-00-00', NULL, NULL, 'Yahukimo Regency', NULL, NULL),
(9417, 94, 'Kabupaten Pegunungan Bintang', NULL, '0000-00-00', NULL, NULL, 'Pegunungan Bintang Regency', NULL, NULL),
(9418, 94, 'Kabupaten Tolikara', NULL, '0000-00-00', NULL, NULL, 'Tolikara Regency', NULL, NULL),
(9419, 94, 'Kabupaten Sarmi', NULL, '0000-00-00', NULL, NULL, 'Sarmi Regency', NULL, NULL),
(9420, 94, 'Kabupaten Keerom', NULL, '0000-00-00', NULL, NULL, 'Keerom Regency', NULL, NULL),
(9422, 94, 'Kabupaten Sorong Selatan', NULL, '0000-00-00', NULL, NULL, 'Sorong Selatan Regency', NULL, NULL),
(9423, 94, 'Kabupaten Raja Ampat', NULL, '0000-00-00', NULL, NULL, 'Raja Ampat Regency', NULL, NULL),
(9424, 94, 'Kabupaten Teluk Bintuni', NULL, '0000-00-00', NULL, NULL, 'Teluk Bintuni Regency', NULL, NULL),
(9425, 94, 'Kabupaten Teluk Wondama', NULL, '0000-00-00', NULL, NULL, 'Teluk Wondama Regency', NULL, NULL),
(9426, 94, 'Kabupaten Waropen', NULL, '0000-00-00', NULL, NULL, 'Waropen Regency', NULL, NULL),
(9427, 94, 'Kabupaten Supiori', NULL, NULL, NULL, NULL, 'Supiori Regency', NULL, NULL),
(9428, 94, 'Kabupaten Mamberamo Raya', '0000-00-00', NULL, 0, NULL, 'Mamberamo Raya Regency', NULL, NULL),
(9429, 94, 'Kabupaten Nduga', NULL, NULL, 0, NULL, 'Nduga Regency', NULL, NULL),
(9430, 94, 'Kabupaten Lanny Jaya', NULL, NULL, 0, NULL, 'Lanny Jaya Regency', NULL, NULL),
(9431, 94, 'Kabupaten Memberamo Tengah', NULL, NULL, 0, NULL, 'Memberamo Tengah Regency', NULL, NULL),
(9432, 94, 'Kabupaten Yalimo', NULL, NULL, NULL, NULL, 'Yalimo Regency', NULL, NULL),
(9433, 94, 'Kabupaten Puncak', NULL, NULL, NULL, NULL, 'Puncak Regency', NULL, NULL),
(9434, 94, 'Kabupaten Dogiyai', NULL, NULL, NULL, NULL, 'Dogiyai Regency', NULL, NULL),
(9435, 94, 'Kabupaten Intan Jaya', NULL, NULL, NULL, NULL, 'Intan Jaya Regency', NULL, NULL),
(9436, 94, 'Kabupaten Deiyai', NULL, NULL, NULL, NULL, 'Deiyai Regency', NULL, NULL),
(9437, 94, 'Kabupaten Tambrauw', '0000-00-00', NULL, 0, NULL, 'Tambrauw Regency', NULL, NULL),
(9471, 94, 'Kota Jayapura', NULL, '0000-00-00', NULL, NULL, 'Jayapura', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kategori`
--

CREATE TABLE IF NOT EXISTS `t_kategori` (
`ID_KATEGORI` int(11) NOT NULL,
  `KATEGORI_LAPORAN` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kategori`
--

INSERT INTO `t_kategori` (`ID_KATEGORI`, `KATEGORI_LAPORAN`) VALUES
(1, 'PUSDATIN'),
(2, 'GEOLOGI'),
(3, 'KLIK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_provinsi`
--

CREATE TABLE IF NOT EXISTS `t_provinsi` (
`ID_PROVINSI` int(11) NOT NULL,
  `ID_WILAYAH` varchar(3) DEFAULT NULL,
  `NAMA_PROVINSI` varchar(200) DEFAULT NULL,
  `MULAI_EXIST` date DEFAULT NULL,
  `AKHIR_EXIST` date DEFAULT NULL,
  `KODE_PROVINSI` varchar(10) DEFAULT NULL,
  `NAMA_PROVINSI_EN` varchar(50) DEFAULT NULL,
  `DATE_MODIFIED` date DEFAULT NULL,
  `EDIT_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_provinsi`
--

INSERT INTO `t_provinsi` (`ID_PROVINSI`, `ID_WILAYAH`, `NAMA_PROVINSI`, `MULAI_EXIST`, `AKHIR_EXIST`, `KODE_PROVINSI`, `NAMA_PROVINSI_EN`, `DATE_MODIFIED`, `EDIT_BY`) VALUES
(11, '01', 'Aceh', '0000-00-00', '0000-00-00', '', 'Aceh ', '2018-11-21', 'admin3'),
(12, '01', 'Sumatera Utara', '0000-00-00', NULL, NULL, 'North Sumatera', NULL, NULL),
(13, '01', 'Sumatera Barat', '0000-00-00', NULL, NULL, 'West Sumatera', NULL, NULL),
(14, '01', 'Riau', '0000-00-00', NULL, NULL, 'Riau', NULL, NULL),
(15, '01', 'Jambi', '0000-00-00', NULL, NULL, 'Jambi', NULL, NULL),
(16, '01', 'Sumatera Selatan', '0000-00-00', NULL, NULL, 'South Sumatera', NULL, NULL),
(17, '01', 'Bengkulu', '0000-00-00', NULL, NULL, 'Bengkulu', NULL, NULL),
(18, '01', 'Lampung', '0000-00-00', NULL, NULL, 'Lampung', NULL, NULL),
(19, '01', 'Kepulauan Bangka Belitung', '0000-00-00', NULL, NULL, 'Bangka Belitung', NULL, NULL),
(20, '01', 'Kepulauan Riau', '0000-00-00', NULL, NULL, 'Riau Islands', NULL, NULL),
(31, '02', 'DKI Jakarta', '0000-00-00', NULL, NULL, 'Jakarta Capital Territory', NULL, NULL),
(32, '02', 'Jawa Barat', '0000-00-00', NULL, NULL, 'West Java', NULL, NULL),
(33, '02', 'Jawa Tengah', '0000-00-00', NULL, NULL, 'Central Java', NULL, NULL),
(34, '02', 'Daerah Istimewa Yogyakarta', '0000-00-00', NULL, NULL, 'Special Region Of Yogyakarta', NULL, NULL),
(35, '02', 'Jawa Timur', '0000-00-00', NULL, NULL, 'East Java', NULL, NULL),
(36, '02', 'Banten', '0000-00-00', NULL, NULL, 'Banten', NULL, NULL),
(51, '03', 'Bali', '0000-00-00', NULL, NULL, 'Bali', NULL, NULL),
(52, '03', 'Nusa Tenggara Barat', '0000-00-00', NULL, NULL, 'West Nusa Tenggara', NULL, NULL),
(53, '03', 'Nusa Tenggara Timur', '0000-00-00', NULL, NULL, 'East Nusa Tenggara', NULL, NULL),
(61, '04', 'Kalimantan Barat', '0000-00-00', NULL, NULL, 'West Kalimantan', NULL, NULL),
(62, '04', 'Kalimantan Tengah', '0000-00-00', NULL, NULL, 'Central Kalimantan', NULL, NULL),
(63, '04', 'Kalimantan Selatan', '0000-00-00', NULL, NULL, 'South Kalimantan', NULL, NULL),
(64, '04', 'Kalimantan Timur', '0000-00-00', NULL, NULL, 'East Kalimantan', NULL, NULL),
(65, '04', 'Kalimantan Utara', '0000-00-00', NULL, NULL, 'North Kalimantan', NULL, NULL),
(71, '05', 'Sulawesi Utara', '0000-00-00', NULL, NULL, 'North Sulawesi', NULL, NULL),
(72, '05', 'Sulawesi Tengah', '0000-00-00', NULL, NULL, 'Central Sulawesi', NULL, NULL),
(73, '05', 'Sulawesi Selatan', '0000-00-00', NULL, NULL, 'South Sulawesi', NULL, NULL),
(74, '05', 'Sulawesi Tenggara', '0000-00-00', NULL, NULL, 'South East Sulawesi', NULL, NULL),
(75, '05', 'Gorontalo', '0000-00-00', NULL, NULL, 'Gorontalo', NULL, NULL),
(76, '05', 'Sulawesi Barat', '0000-00-00', NULL, NULL, 'West Sulawesi', NULL, NULL),
(81, '06', 'Maluku', '0000-00-00', NULL, NULL, 'Maluku', NULL, NULL),
(82, '06', 'Maluku Utara', '0000-00-00', NULL, NULL, 'North Maluku', NULL, NULL),
(91, '07', 'Papua Barat', '0000-00-00', NULL, NULL, 'West Irian', NULL, NULL),
(94, '07', 'Papua', '0000-00-00', NULL, NULL, 'Papua', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_role`
--

CREATE TABLE IF NOT EXISTS `t_role` (
`ID_ROLE` int(4) NOT NULL,
  `ROLE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_role`
--

INSERT INTO `t_role` (`ID_ROLE`, `ROLE`) VALUES
(1, 'SUPER_ADMIN'),
(2, 'PUSDATIN'),
(3, 'GEOLOGI'),
(5, 'KLIK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
`ID_USER` int(4) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `ID_ROLE` int(4) DEFAULT NULL,
  `PASSWORD` varchar(70) DEFAULT NULL,
  `NAMA_USER` varchar(120) DEFAULT NULL,
  `IS_POST` char(1) DEFAULT NULL,
  `TGL_LOGIN` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`ID_USER`, `USERNAME`, `ID_ROLE`, `PASSWORD`, `NAMA_USER`, `IS_POST`, `TGL_LOGIN`) VALUES
(2, 'admin', 1, '202cb962ac59075b964b07152d234b70', 'Admin', 'Y', '2019-05-12 16:03:13'),
(5, 'samuel', 2, '202cb962ac59075b964b07152d234b70', 'Samuel', 'T', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_lap_geologi_gempa_bumi`
--
ALTER TABLE `r_lap_geologi_gempa_bumi`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_geologi_gerakan_tanah`
--
ALTER TABLE `r_lap_geologi_gerakan_tanah`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_geologi_gunung_api`
--
ALTER TABLE `r_lap_geologi_gunung_api`
 ADD PRIMARY KEY (`ID_LAPORAN`), ADD KEY `ID_AKTIVITAS` (`ID_AKTIVITAS`), ADD KEY `ID_GUNUNG` (`ID_GUNUNG`);

--
-- Indexes for table `r_lap_klik_ebtke`
--
ALTER TABLE `r_lap_klik_ebtke`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_klik_gatrik`
--
ALTER TABLE `r_lap_klik_gatrik`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_klik_geologi`
--
ALTER TABLE `r_lap_klik_geologi`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_klik_migas`
--
ALTER TABLE `r_lap_klik_migas`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_klik_minerba`
--
ALTER TABLE `r_lap_klik_minerba`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_berita_opec_harian`
--
ALTER TABLE `r_lap_pusdatin_berita_opec_harian`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_harga_bbm`
--
ALTER TABLE `r_lap_pusdatin_harga_bbm`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_harga_bb_acuan`
--
ALTER TABLE `r_lap_pusdatin_harga_bb_acuan`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_harga_mineral_acuan`
--
ALTER TABLE `r_lap_pusdatin_harga_mineral_acuan`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_icp`
--
ALTER TABLE `r_lap_pusdatin_icp`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_lift_tb`
--
ALTER TABLE `r_lap_pusdatin_lift_tb`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_prod_ekui_migas`
--
ALTER TABLE `r_lap_pusdatin_prod_ekui_migas`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_prod_gas`
--
ALTER TABLE `r_lap_pusdatin_prod_gas`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_prod_minyak`
--
ALTER TABLE `r_lap_pusdatin_prod_minyak`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_prog_peny_prem_jamali`
--
ALTER TABLE `r_lap_pusdatin_prog_peny_prem_jamali`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `r_lap_pusdatin_stts_tl`
--
ALTER TABLE `r_lap_pusdatin_stts_tl`
 ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `t_aktivitas`
--
ALTER TABLE `t_aktivitas`
 ADD PRIMARY KEY (`ID_AKTIVITAS`);

--
-- Indexes for table `t_gunung`
--
ALTER TABLE `t_gunung`
 ADD PRIMARY KEY (`ID_GUNUNG`);

--
-- Indexes for table `t_hak_akses_role`
--
ALTER TABLE `t_hak_akses_role`
 ADD PRIMARY KEY (`ID_HAK_AKSES`);

--
-- Indexes for table `t_jenis_berita`
--
ALTER TABLE `t_jenis_berita`
 ADD PRIMARY KEY (`ID_JENIS_BERITA`);

--
-- Indexes for table `t_jenis_laporan`
--
ALTER TABLE `t_jenis_laporan`
 ADD PRIMARY KEY (`ID_JENIS_LAPORAN`), ADD KEY `FK_REFERENCE_4` (`ID_KATEGORI`);

--
-- Indexes for table `t_kabkot`
--
ALTER TABLE `t_kabkot`
 ADD PRIMARY KEY (`ID_KABKOT`);

--
-- Indexes for table `t_kategori`
--
ALTER TABLE `t_kategori`
 ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `t_provinsi`
--
ALTER TABLE `t_provinsi`
 ADD PRIMARY KEY (`ID_PROVINSI`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
 ADD PRIMARY KEY (`ID_ROLE`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
 ADD PRIMARY KEY (`ID_USER`,`USERNAME`), ADD KEY `FK_REFERENCE_1` (`ID_ROLE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_lap_geologi_gempa_bumi`
--
ALTER TABLE `r_lap_geologi_gempa_bumi`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_lap_geologi_gerakan_tanah`
--
ALTER TABLE `r_lap_geologi_gerakan_tanah`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_geologi_gunung_api`
--
ALTER TABLE `r_lap_geologi_gunung_api`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_klik_ebtke`
--
ALTER TABLE `r_lap_klik_ebtke`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_klik_gatrik`
--
ALTER TABLE `r_lap_klik_gatrik`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_klik_geologi`
--
ALTER TABLE `r_lap_klik_geologi`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_klik_migas`
--
ALTER TABLE `r_lap_klik_migas`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_lap_klik_minerba`
--
ALTER TABLE `r_lap_klik_minerba`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_berita_opec_harian`
--
ALTER TABLE `r_lap_pusdatin_berita_opec_harian`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_harga_bbm`
--
ALTER TABLE `r_lap_pusdatin_harga_bbm`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_harga_bb_acuan`
--
ALTER TABLE `r_lap_pusdatin_harga_bb_acuan`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_harga_mineral_acuan`
--
ALTER TABLE `r_lap_pusdatin_harga_mineral_acuan`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_icp`
--
ALTER TABLE `r_lap_pusdatin_icp`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_lift_tb`
--
ALTER TABLE `r_lap_pusdatin_lift_tb`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_prod_ekui_migas`
--
ALTER TABLE `r_lap_pusdatin_prod_ekui_migas`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_prod_gas`
--
ALTER TABLE `r_lap_pusdatin_prod_gas`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_prod_minyak`
--
ALTER TABLE `r_lap_pusdatin_prod_minyak`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_prog_peny_prem_jamali`
--
ALTER TABLE `r_lap_pusdatin_prog_peny_prem_jamali`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_lap_pusdatin_stts_tl`
--
ALTER TABLE `r_lap_pusdatin_stts_tl`
MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_aktivitas`
--
ALTER TABLE `t_aktivitas`
MODIFY `ID_AKTIVITAS` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_gunung`
--
ALTER TABLE `t_gunung`
MODIFY `ID_GUNUNG` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_hak_akses_role`
--
ALTER TABLE `t_hak_akses_role`
MODIFY `ID_HAK_AKSES` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_jenis_berita`
--
ALTER TABLE `t_jenis_berita`
MODIFY `ID_JENIS_BERITA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_jenis_laporan`
--
ALTER TABLE `t_jenis_laporan`
MODIFY `ID_JENIS_LAPORAN` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `t_kabkot`
--
ALTER TABLE `t_kabkot`
MODIFY `ID_KABKOT` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9472;
--
-- AUTO_INCREMENT for table `t_kategori`
--
ALTER TABLE `t_kategori`
MODIFY `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_provinsi`
--
ALTER TABLE `t_provinsi`
MODIFY `ID_PROVINSI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
MODIFY `ID_ROLE` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
MODIFY `ID_USER` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `r_lap_geologi_gunung_api`
--
ALTER TABLE `r_lap_geologi_gunung_api`
ADD CONSTRAINT `r_lap_geologi_gunung_api_ibfk_1` FOREIGN KEY (`ID_AKTIVITAS`) REFERENCES `t_aktivitas` (`ID_AKTIVITAS`),
ADD CONSTRAINT `r_lap_geologi_gunung_api_ibfk_2` FOREIGN KEY (`ID_GUNUNG`) REFERENCES `t_gunung` (`ID_GUNUNG`);

--
-- Ketidakleluasaan untuk tabel `t_jenis_laporan`
--
ALTER TABLE `t_jenis_laporan`
ADD CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `t_kategori` (`ID_KATEGORI`);

--
-- Ketidakleluasaan untuk tabel `t_user`
--
ALTER TABLE `t_user`
ADD CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`ID_ROLE`) REFERENCES `t_role` (`ID_ROLE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
