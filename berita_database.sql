-- ========================================
-- DATABASE SISTEM BERITA
-- File: berita_database.sql
-- ========================================
-- Database dan tabel untuk sistem berita
-- Jalankan file ini di phpMyAdmin untuk membuat database dan tabel berita

-- Buat database
CREATE DATABASE IF NOT EXISTS `pw2`;
USE `pw2`;

-- ========================================
-- TABEL KATEGORI
-- ========================================
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(3) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(30) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data kategori
INSERT INTO `kategori` (`id_kategori`, `nm_kategori`, `deskripsi`) VALUES
(101, 'KRIMINAL', 'Segala jenis tindak kriminal'),
(102, 'OLAHRAGA', 'Segala jenis olahraga'),
(103, 'POLITIK', 'Segala jenis politik'),
(104, 'EKONOMI', 'Segala jenis berita sektor ekonomi');

-- ========================================
-- TABEL BERITA
-- ========================================
CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(3) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `headline` text NOT NULL,
  `isi` text NOT NULL,
  `pengirim` varchar(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data contoh berita
INSERT INTO `berita` (`id_berita`, `id_kategori`, `judul`, `headline`, `isi`, `pengirim`, `tanggal`) VALUES
(11, 102, 'MOTOGP', 'Pedrosa Mulai Klop dengan Ban Baru', 'JEREZ - Pembalap Repsol Honda, Dani Pedrosa mulai nyaman dengan kondisi motor barunya. Meski belum mengukir catatan sempurna, Pedrosa puas dengan hasil latihannya di Sirkuit Jerez pekan lalu.\r\n\r\n"Pada Jumat lalu kami menyelesaikan test drive di Sirkuit Jerez. Saat itu kami bekerja pada dua hal penting, menguji ban dan juga perangkat elektronik. Kami mengalami peningkatan pada dua hal tersebut. Meski begitu, masih banyak pekerjaan yang harus kami lakukan," ucap Pedrosa pada situs MotoGP.', 'Frisca Puspita ', '2015-12-09 23:31:08'),
(12, 104, 'WISATA', 'Libur Nasional Pilkada, Hotel di Daerah Wisata Banjir Pengunjung', ' Sebagian besar masyarakat menggunakan waktu libur nasional pada 9 Desember 2015 untuk berwisata. Libur nasional pada 9 Desember 2015 ini sebenarnya untuk memberikan kesempatan kepada warga negara Indonesia mengikuti pilkada serentak di 269 daerah di Tanah Air. \r\n\r\nWakil Ketua Perhimpunan Hotel dan Restoran Indonesia (PHRI), Johnnie Sugiarto mengatakan, sejumlah hotel di daerah wisata, seperti Bali dan Bangka Belitung mengalami kenaikan okupansi atau tingkat keterisian sampai 100 persen saat libur nasional Pemilihan Kepala Daerah (Pilkada).\r\n\r\nMomen Pilkada memang dimanfaatkan masyarakat untuk mengambil cuti panjang dan berlibur di Bali serta Bangka Belitung. ', 'Fiki Arianti', '2015-12-09 23:37:49'),
(14, 103, 'WAPRES BICARA', 'JK: Riza Chalid Bisa Jadi Buronan', 'Wakil Presiden Jusuf Kalla menegaskan, pengusaha Riza Chalid, yang disebut dalam rekaman pembicaraan kasus Papa Minta Saham, masih berstatus saksi. Namun, bila tidak kooperatif dengan penegak hukum, statusnya bisa ditingkatkan dan menjadi buronan.\r\n\r\n"Nanti kalau pengadilan dia tidak datang, bisa diadili sebagai in absentia. Kalau dipanggil keputusan itu saja, dia bisa buronan. Sekarang belum, masih saksi," kata JK, di Hotel Crown, Jakarta, Rabu (9/12/2015).\r\n\r\nPresiden Jokowi pun sudah meminta Kapolri Badrodin Haiti untuk menghadirkan Riza Chalid. Pencarian sang pengusaha minyak pun bakal melibatkan Interpol.', 'Silvanus Alvin', '2015-12-09 23:51:14');
