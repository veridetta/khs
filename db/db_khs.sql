/* membuat table user */
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/* insert data user */
INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin'),
(2, 'user', 'user', 'User', 'user');
/*membuat data mahasiswa */
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert 5 data mahasiswa */
INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `kelas`, `jurusan`) VALUES
(1, '123456789', 'Nama 1', 'XI RPL 1', 'RPL'),
(2, '123456788', 'Nama 2', 'XI RPL 2', 'RPL'),
(3, '123456786', 'Nama 3', 'XI RPL 3', 'RPL'),
(4, '123456785', 'Nama 4', 'XI RPL 4', 'RPL'),
(5, '123456784', 'Nama 5', 'XI RPL 5', 'RPL');
/*membuat table prodi */
CREATE TABLE IF NOT EXISTS `prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  /*kode prodi*/
  `kode_prodi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert data prodi */
INSERT INTO `prodi` (`id`, `kode_prodi`, `nama`) VALUES
(1, 'RPL', 'Rekayasa Perangkat Lunak'),
(2, 'TKJ', 'Teknik Komputer Jaringan'),
(3, 'MM', 'Multimedia'),
(4, 'TPM', 'Teknik Pemesinan'),
(5, 'TKR', 'Teknik Kendaraan Ringan');
/* membuat table mata kuliah */
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  /*mengambil kode prodi*/
  `kode_prodi` varchar(255) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert data mata kuliah */
INSERT INTO `mata_kuliah` (`id`, `kode_prodi`, `kode_mk`, `nama`, `sks`) VALUES
(1, 'RPL', 'RPL1', 'Rekayasa Perangkat Lunak 1', 3),
(2, 'RPL', 'RPL2', 'Rekayasa Perangkat Lunak 2', 3),
(3, 'RPL', 'RPL3', 'Rekayasa Perangkat Lunak 3', 3),
(4, 'RPL', 'RPL4', 'Rekayasa Perangkat Lunak 4', 3),
(5, 'RPL', 'RPL5', 'Rekayasa Perangkat Lunak 5', 3),
(6, 'TKJ', 'TKJ1', 'Teknik Komputer Jaringan 1', 3),
(7, 'TKJ', 'TKJ2', 'Teknik Komputer Jaringan 2', 3),
(8, 'TKJ', 'TKJ3', 'Teknik Komputer Jaringan 3', 3),
(9, 'TKJ', 'TKJ4', 'Teknik Komputer Jaringan 4', 3),
(10, 'TKJ', 'TKJ5', 'Teknik Komputer Jaringan 5', 3),
(11, 'MM', 'MM1', 'Multimedia 1', 3),
(12, 'MM', 'MM2', 'Multimedia 2', 3),
(13, 'MM', 'MM3', 'Multimedia 3', 3),
(14, 'MM', 'MM4', 'Multimedia 4', 3),
(15, 'MM', 'MM5', 'Multimedia 5', 3),
(16, 'TPM', 'TPM1', 'Teknik Pemesinan 1', 3),
(17, 'TPM', 'TPM2', 'Teknik Pemesinan 2', 3),
(18, 'TPM', 'TPM3', 'Teknik Pemesinan 3', 3),
(19, 'TPM', 'TPM4', 'Teknik Pemesinan 4', 3),
(20, 'TPM', 'TPM5', 'Teknik Pemesinan 5', 3),
(21, 'TKR', 'TKR1', 'Teknik Kendaraan Ringan 1', 3),
(22, 'TKR', 'TKR2', 'Teknik Kendaraan Ringan 2', 3),
(23, 'TKR', 'TKR3', 'Teknik Kendaraan Ringan 3', 3),
(24, 'TKR', 'TKR4', 'Teknik Kendaraan Ringan 4', 3),
(25, 'TKR', 'TKR5', 'Teknik Kendaraan Ringan 5', 3);
/* membuat table tahun ajaran */
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert data 4 tahun ajaran */
INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`) VALUES
(3, '2018/2019'),
(4, '2019/2020');
/* membuat table semester */
CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert data 2 semester */
INSERT INTO `semester` (`id`, `semester`) VALUES
(1, 'Ganjil'),
(2, 'Genap');
/*membuat table nilai */
CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  /*mengambil kode prodi*/
  `kode_prodi` varchar(255) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  /* tahun ajaran */
  `tahun_ajaran` varchar(255) NOT NULL,
  /*semester*/
  `semester` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/* insert data nilai */
INSERT INTO `nilai` (`id`, `kode_prodi`, `kode_mk`, `tahun_ajaran`, `semester`, `nim`, `nama`, `nilai`) VALUES
(1, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0101', 'Rizki', 'A'),
(2, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0102', 'Rizki', 'A'),
(3, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0103', 'Rizki', 'A'),
(4, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0104', 'Rizki', 'A'),
(5, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0105', 'Rizki', 'A'),
(6, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0106', 'Rizki', 'A'),
(7, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0107', 'Rizki', 'A'),
(8, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0108', 'Rizki', 'A'),
(9, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0109', 'Rizki', 'A'),
(10, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0110', 'Rizki', 'A'),
(11, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0111', 'Rizki', 'A'),
(12, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0112', 'Rizki', 'A'),
(13, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0113', 'Rizki', 'A'),
(14, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0114', 'Rizki', 'A'),
(15, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0115', 'Rizki', 'A'),
(16, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0116', 'Rizki', 'A'),
(17, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0117', 'Rizki', 'A'),
(18, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0118', 'Rizki', 'A'),
(19, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0119', 'Rizki', 'A'),
(20, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0120', 'Rizki', 'A'),
(21, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0121', 'Rizki', 'A'),
(22, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0122', 'Rizki', 'A'),
(23, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0123', 'Rizki', 'A'),
(24, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0124', 'Rizki', 'A'),
(25, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0125', 'Rizki', 'A'),
(26, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0126', 'Rizki', 'A'),
(27, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0127', 'Rizki', 'A'),
(28, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0128', 'Rizki', 'A'),
(29, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0129', 'Rizki', 'A'),
(30, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0130', 'Rizki', 'A'),
(31, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0131', 'Rizki', 'A'),
(32, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0132', 'Rizki', 'A'),
(33, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0133', 'Rizki', 'A'),
(34, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0134', 'Rizki', 'A'),
(35, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0135', 'Rizki', 'A'),
(36, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0136', 'Rizki', 'A'),
(37, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0137', 'Rizki', 'A'),
(38, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0138', 'Rizki', 'A'),
(39, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0139', 'Rizki', 'A'),
(40, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0140', 'Rizki', 'A'),
(41, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0141', 'Rizki', 'A'),
(42, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0142', 'Rizki', 'A'),
(43, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0143', 'Rizki', 'A'),
(44, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0144', 'Rizki', 'A'),
(45, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0145', 'Rizki', 'A'),
(46, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0146', 'Rizki', 'A'),
(47, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0147', 'Rizki', 'A'),
(48, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0148', 'Rizki', 'A'),
(49, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0149', 'Rizki', 'A'),
(50, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0150', 'Rizki', 'A'),
(51, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0151', 'Rizki', 'A'),
(52, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0152', 'Rizki', 'A'),
(53, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0153', 'Rizki', 'A'),
(54, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0154', 'Rizki', 'A'),
(55, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0155', 'Rizki', 'A'),
(56, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0156', 'Rizki', 'A'),
(57, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0157', 'Rizki', 'A'),
(58, 'RPL', 'RPL1', '2018/2019', 'Ganjil', '16.01.53.0158', 'Rizki', 'A');

/*membuat table dosen*/
CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kode_prodi` int(11) NOT NULL,
  /*id mk*/
  `kode_mk` int(11) NOT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


