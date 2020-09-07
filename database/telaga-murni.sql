-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2019 pada 12.03
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telaga-murni`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `kd_bank` varchar(6) NOT NULL,
  `nm_bank` varchar(10) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `nm_rek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bank`
--

INSERT INTO `tbl_bank` (`kd_bank`, `nm_bank`, `no_rek`, `nm_rek`) VALUES
('BNK001', 'BRI', '3543-01-028735-53-3', 'RINDI PRATAMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `kd_jenis` varchar(6) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`kd_jenis`, `nama_jenis`) VALUES
('KJM001', 'Manual'),
('KJM002', 'Matic');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'asbi', 'asbi', 'user'),
(3, 'intan', 'intan', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `kd_mobil` varchar(6) NOT NULL,
  `foto_mobil` text NOT NULL,
  `type_mobil` varchar(50) NOT NULL,
  `kd_jenis` varchar(6) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`kd_mobil`, `foto_mobil`, `type_mobil`, `kd_jenis`, `merk`, `no_polisi`, `warna`, `harga`, `status`) VALUES
('MBL002', 'avanza2017.jpg', 'Avanza Tahun 2017', 'KJM001', 'Toyota', 'BA 1703 BV', 'Hitam', 300000, 0),
('MBL003', 'splash2016.jpg', 'Splash Tahun 2016', 'KJM001', 'Suzuki', 'BA 1972 RO', 'Putih', 300000, 1),
('MBL004', 'karimun2016.jpg', 'Karimun Tahun 2016', 'KJM001', 'Suzuki', 'F 1518 EY', 'Abu-abu', 250000, 0),
('MBL006', 'avanza2016.jpg', 'Avanza Tahun 2016', 'KJM001', 'Toyota', 'B 1949 ZFV', 'Abu-abu', 300000, 1),
('MBL007', 'avanza 2018.jpg', 'Avanza Tahun 2018', 'KJM002', 'Toyota', 'B 2272 BZJ', 'Putih', 300000, 0),
('MBL008', 'xenia2016.jpg', 'Xenia Tahun 2016', 'KJM001', 'Daihatsu', 'BA 1003 TL', 'Putih', 300000, 1),
('MBL009', 'avanza2014.jpg', 'Avanza Tahun 2014', 'KJM001', 'Toyota', 'BA 1480 TA', 'Putih', 300000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `kd_pelanggan` varchar(6) NOT NULL,
  `id` int(11) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nm_pelanggan` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `fotoktp` text NOT NULL,
  `status_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`kd_pelanggan`, `id`, `no_ktp`, `nm_pelanggan`, `tgl_lahir`, `alamat`, `no_hp`, `fotoktp`, `status_peminjaman`) VALUES
('PLG001', 3, '1371111234567890', 'Intan Paresmawarati', '1998-06-20', 'Lubuk Basung', '081234567891', 'avatar2.png', 1),
('PLG002', 2, '1371111234567892', 'Asbi Ramadhan', '1998-11-26', 'Padang', '081212345678', 'avatar5.png', 1),
('PLG003', 1, '1371111234567847', 'Indah Permata Sari', '1997-11-27', 'Pasar Tiku Lubuk Basung', '081321234232', 'avatar3.png', 1),
('PLG004', 1, '1371111234567123', 'Putra Ramadhan', '1998-06-11', 'Padang', '085212323456', 'avatar.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `kd_bayar` varchar(6) NOT NULL,
  `kd_transaksi` varchar(6) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `pembayaran` varchar(10) NOT NULL,
  `nm_bank` varchar(10) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `nm_rek` varchar(50) NOT NULL,
  `bukti_bayar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`kd_bayar`, `kd_transaksi`, `tgl_bayar`, `pembayaran`, `nm_bank`, `no_rek`, `nm_rek`, `bukti_bayar`) VALUES
('BYR001', 'TRS001', '2019-10-28', 'Cash', '', '', '', ''),
('BYR002', 'TRS002', '2019-10-28', 'Transfer', 'BRI', '54701234567890123', 'ASBI RAMADHAN', 'cirrus.png'),
('BYR003', 'TRS003', '2019-10-27', 'Transfer', 'BRI', '54701234567812345', 'PUTRA RAMADHAN', 'mastercard.png'),
('BYR004', 'TRS004', '2019-11-04', 'Cash', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `kd_kembali` varchar(6) NOT NULL,
  `kd_transaksi` varchar(6) NOT NULL,
  `terlambat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`kd_kembali`, `kd_transaksi`, `terlambat`) VALUES
('KBL001', 'TRS001', 1),
('KBL002', 'TRS002', 0),
('KBL003', 'TRS003', 3),
('KBL004', 'TRS004', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `kd_transaksi` varchar(6) NOT NULL,
  `kd_mobil` varchar(6) NOT NULL,
  `kd_pelanggan` varchar(6) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `jml_harga` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `status_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`kd_transaksi`, `kd_mobil`, `kd_pelanggan`, `tgl_sewa`, `tgl_kembali`, `jml_harga`, `denda`, `status_bayar`, `status_kembali`) VALUES
('TRS001', 'MBL007', 'PLG001', '2019-10-27', '2019-11-02', 1800000, 300000, 1, 1),
('TRS002', 'MBL002', 'PLG002', '2019-10-29', '2019-10-31', 600000, 0, 1, 1),
('TRS003', 'MBL009', 'PLG004', '2019-10-28', '2019-10-31', 900000, 900000, 1, 1),
('TRS004', 'MBL004', 'PLG003', '2019-11-04', '2019-11-09', 1250000, 500000, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`kd_bank`);

--
-- Indeks untuk tabel `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`kd_jenis`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`kd_mobil`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`kd_bayar`);

--
-- Indeks untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`kd_kembali`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
