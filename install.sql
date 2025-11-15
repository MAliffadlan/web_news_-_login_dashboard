-- Tambahan untuk tabel user (login dashboard)
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert default user (username: admin, password: admin)
INSERT INTO `user` (`username`, `password`, `nama`) VALUES
('admin', 'admin', 'Administrator');
