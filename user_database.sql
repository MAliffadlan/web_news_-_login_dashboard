-- ========================================
-- DATABASE USER/LOGIN DASHBOARD
-- File: user_database.sql
-- ========================================
-- Database untuk sistem login admin dashboard
-- Jalankan file ini di phpMyAdmin setelah berita_database.sql

USE `pw2`;

-- ========================================
-- TABEL USER
-- ========================================
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- User default admin
INSERT INTO `user` (`username`, `password`, `nama`) VALUES
('admin', 'admin', 'Administrator');
