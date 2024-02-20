-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2024 pada 13.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `approval`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `user`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$Fcogi5THQu78haq2FvQAweTRiftQVsPM5fkGNqy8TpdSJdANA.amW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_acara`
--

CREATE TABLE `master_acara` (
  `id_acara` int(11) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `durasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_acara`
--

INSERT INTO `master_acara` (`id_acara`, `nama_acara`, `tahun`, `durasi`) VALUES
(1, 'Bimtek Penyusunan Master Plan Smart City Tahap 1', 2023, 420),
(2, 'Bimtek Penyusunan Master Plan Smart City Tahap 2', 2023, 420),
(3, 'Bimtek Penyusunan Master Plan Smart City Tahap 3', 2023, 420),
(4, 'Bimtek Penyusunan Master Plan Smart City Tahap 4', 2023, 420),
(5, 'Webinar SPBE Seri 1: Monitoring dan Evaluasi Back-up Data Aplikasi SPBE', 2023, 120),
(6, 'Webinar SPBE Seri 2: Monitoring dan Evaluasi Penggunaan Antivirus & Sertifikat Elektronik', 2023, 240),
(7, 'Webinar SPBE Seri 3: Sosialisasi Layanan Server dan Aplikasi', 2023, 180),
(8, 'Webinar SPBE Seri 4: Monitoring dan Evaluasi Pengelolaan Email Resmi Kedinasan Pemerintah Kabupaten Kediri', 2023, 150),
(9, 'Webinar SPBE Seri 5: Sosialisasi Peraturan Bupati No 24 Tahun 2023 tentang SPBE Pemerintah Kabupaten Kediri', 2023, 120),
(10, 'Webinar FGD: Manajemen Aset TIK Pemerintah Kabupaten Kediri', 2023, 180);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_opd`
--

CREATE TABLE `master_opd` (
  `id_opd` int(11) NOT NULL,
  `nama_opd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_opd`
--

INSERT INTO `master_opd` (`id_opd`, `nama_opd`) VALUES
(1, 'BAGIAN TATA PEMERINTAH'),
(2, 'BAGIAN KESEJAHTERAAN RAKYAT'),
(3, 'BAGIAN HUKUM'),
(4, 'BAGIAN PEREKONOMIAN DAN SUMBER DAYA ALAM'),
(5, 'BAGIAN PENGADAAN BARANG/JASA DAN ADMINISTRASI PEMBANGUNAN'),
(6, 'BAGIAN ORGANISASI'),
(7, 'BAGIAN UMUM'),
(8, 'BAGIAN PROTOKOL DAN KOMUNIKASI PIMPINAN'),
(9, 'BAGIAN PERENCANAAN DAN KEUANGAN'),
(10, 'SEKRETARIAT DPRD'),
(11, 'INSPEKTORAT'),
(12, 'DINAS PENDIDIKAN'),
(13, 'DINAS PARIWISATA DAN KEBUDAYAAN'),
(14, 'DINAS PENGENDALIAN PENDUDUK, KELUARGA BERENCANA PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK'),
(15, 'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL'),
(16, 'DINAS PEMBERDAYAAN MASYARAKAT DAN PEMERINTAHAN DESA'),
(17, 'DINAS KESEHATAN'),
(18, 'DINAS SOSIAL'),
(19, 'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU'),
(20, 'DINAS KOPERASI DAN USAHA MIKRO'),
(21, 'DINAS PERDAGANGAN DAN PERINDUSTRIAN'),
(22, 'DINAS TENAGA KERJA'),
(23, 'DINAS KOMUNIKASI DAN INFORMATIKA'),
(24, 'DINAS PERUMAHAN DAN KAWASAN PERMUKIMAN'),
(25, 'DINAS PEKERJAAN UMUM DAN PENATAAN RUANG'),
(26, 'DINAS PERHUBUNGAN'),
(27, 'DINAS LINGKUNGAN HIDUP'),
(28, 'DINAS KETAHANAN PANGAN DAN PETERNAKAN'),
(29, 'DINAS PERTANIAN DAN PERKEBUNAN'),
(30, 'DINAS PERIKANAN'),
(31, 'DINAS KEARSIPAN DAN PERPUSTAKAAN'),
(32, 'SATPOL PP'),
(33, 'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA (BKPSDM)'),
(34, 'BADAN PENGELOLA KEUANGAN DAN ASET DAERAH (BPKAD)'),
(35, 'BADAN PENDAPATAN DAERAH'),
(36, 'BADAN RISET DAN INOVASI DAERAH (BRIDA)'),
(37, 'BADAN PERENCANAAN PEMBANGUNAN DAERAH (BAPPEDA)'),
(38, 'BADAN PENANGGULANGAN BENCANA DAERAH (BPBD)'),
(39, 'BADAN KESATUAN BANGSA DAN POLITIK (BAKESBANGPOL)'),
(40, 'UOBK RSUD SIMPANG LIMA GUMUL PADA DINAS KESEHATAN'),
(41, 'UOBK RSUD KABUPATEN KEDIRI PADA DINAS KESEHATAN (RSKK)'),
(42, 'KECAMATAN SEMEN'),
(43, 'KECAMATAN MOJO'),
(44, 'KECAMATAN KRAS'),
(45, 'KECAMATAN NGADILUWIH'),
(46, 'KECAMATAN KANDAT'),
(47, 'KECAMATAN WATES'),
(48, 'KECAMATAN NGANCAR'),
(49, 'KECAMATAN PUNCU'),
(50, 'KECAMATAN PLOSOKLATEN'),
(51, 'KECAMATAN GURAH'),
(52, 'KECAMATAN PAGU'),
(53, 'KECAMATAN GAMPENGREJO'),
(54, 'KECAMATAN GROGOL'),
(55, 'KECAMATAN PAPAR'),
(56, 'KECAMATAN PURWOASRI'),
(57, 'KECAMATAN PLEMAHAN'),
(58, 'KECAMATAN PARE'),
(59, 'KECAMATAN KEPUNG'),
(60, 'KECAMATAN KANDANGAN'),
(61, 'KECAMATAN TAROKAN'),
(62, 'KECAMATAN KUNJANG'),
(63, 'KECAMATAN BANYAKAN'),
(64, 'KECAMATAN RINGINREJO'),
(65, 'KECAMATAN KAYENKIDUL'),
(66, 'KECAMATAN NGASEM'),
(67, 'KECAMATAN BADAS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_acara` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `surat_tugas` varchar(255) DEFAULT NULL,
  `tahun_acara` int(4) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `status_pengajuan` enum('Approved','Awaiting','Declined') DEFAULT NULL,
  `keterangan_decline` varchar(50) DEFAULT NULL,
  `status_email` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `master_acara`
--
ALTER TABLE `master_acara`
  ADD PRIMARY KEY (`id_acara`);

--
-- Indeks untuk tabel `master_opd`
--
ALTER TABLE `master_opd`
  ADD PRIMARY KEY (`id_opd`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `pengajuan_ibfk_1` (`id_opd`),
  ADD KEY `id_acara` (`id_acara`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_acara`
--
ALTER TABLE `master_acara`
  MODIFY `id_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `master_opd`
--
ALTER TABLE `master_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `id_acara` FOREIGN KEY (`id_acara`) REFERENCES `master_acara` (`id_acara`),
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `master_opd` (`id_opd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
