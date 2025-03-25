/*
 Navicat Premium Dump SQL

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80039 (8.0.39)
 Source Host           : localhost:3306
 Source Schema         : db_ci3

 Target Server Type    : MySQL
 Target Server Version : 80039 (8.0.39)
 File Encoding         : 65001

 Date: 25/03/2025 13:05:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absensi
-- ----------------------------
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi`  (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `jadwal` date NOT NULL,
  `keterangan` enum('Hadir','Sakit','Izin','Absen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `npm` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_absen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dokumen
-- ----------------------------
DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE `dokumen`  (
  `id_doc` int NOT NULL AUTO_INCREMENT,
  `nama_doc` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title_doc` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_doc` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_matkul` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_dosen` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `komentar_doc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe_doc` int NOT NULL,
  `size` int NOT NULL,
  `berkas` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_doc`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen`  (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nip` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_dosen` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_dosen` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_hp` varchar(13) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tmp_lahir` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dosen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hasilstudi
-- ----------------------------
DROP TABLE IF EXISTS `hasilstudi`;
CREATE TABLE `hasilstudi`  (
  `id_studi` int NOT NULL AUTO_INCREMENT,
  `kode_dosen` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_matkul` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `npm` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kehadiran` int NOT NULL,
  `uts` int NOT NULL,
  `tugas` int NOT NULL,
  `uas` int NOT NULL,
  `average` int NOT NULL,
  `grade` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_studi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenjang` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_jurusan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES (2, 'Teknik Informatika', 'Sarjana');
INSERT INTO `jurusan` VALUES (3, 'Sistem Informasi', 'Sarjana');
INSERT INTO `jurusan` VALUES (4, 'Manajemen Informasi', 'Diploma');
INSERT INTO `jurusan` VALUES (5, 'Teknik Komputer', 'Diploma');

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa`  (
  `id_mhs` int NOT NULL AUTO_INCREMENT,
  `npm` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_mhs` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tmp_lahir` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ortu` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_ortu` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(56) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_mhs`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for matkul
-- ----------------------------
DROP TABLE IF EXISTS `matkul`;
CREATE TABLE `matkul`  (
  `id_matkul` int NOT NULL AUTO_INCREMENT,
  `kode_matkul` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `matkul` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_dosen` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_matkul`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Admin');
INSERT INTO `menu` VALUES (2, 'User');
INSERT INTO `menu` VALUES (3, 'Dosen');
INSERT INTO `menu` VALUES (4, 'Mahasiswa');
INSERT INTO `menu` VALUES (5, 'Menu');
INSERT INTO `menu` VALUES (6, 'Informasi');

-- ----------------------------
-- Table structure for menu_akses
-- ----------------------------
DROP TABLE IF EXISTS `menu_akses`;
CREATE TABLE `menu_akses`  (
  `id_akses` int NOT NULL AUTO_INCREMENT,
  `id_role` int NOT NULL,
  `id_menu` int NOT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_akses
-- ----------------------------
INSERT INTO `menu_akses` VALUES (1, 1, 1);
INSERT INTO `menu_akses` VALUES (5, 2, 2);
INSERT INTO `menu_akses` VALUES (6, 3, 3);
INSERT INTO `menu_akses` VALUES (7, 4, 4);
INSERT INTO `menu_akses` VALUES (16, 3, 2);
INSERT INTO `menu_akses` VALUES (17, 4, 2);
INSERT INTO `menu_akses` VALUES (38, 4, 6);
INSERT INTO `menu_akses` VALUES (39, 2, 6);
INSERT INTO `menu_akses` VALUES (40, 3, 6);
INSERT INTO `menu_akses` VALUES (45, 1, 2);
INSERT INTO `menu_akses` VALUES (46, 1, 5);
INSERT INTO `menu_akses` VALUES (54, 1, 6);
INSERT INTO `menu_akses` VALUES (57, 1, 3);
INSERT INTO `menu_akses` VALUES (58, 1, 4);

-- ----------------------------
-- Table structure for menu_short
-- ----------------------------
DROP TABLE IF EXISTS `menu_short`;
CREATE TABLE `menu_short`  (
  `id_short` int NOT NULL AUTO_INCREMENT,
  `nama_short` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_tabel` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `card_class` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `text_upper` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `text_count` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ikon_class` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_short`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_short
-- ----------------------------
INSERT INTO `menu_short` VALUES (1, 'Mahasiswa Terdata', 'mahasiswa', 'card bg-primary shadow h-100 py-2', 'text-xs font-weight-bold text-light text-uppercase mb-1', 'h5 mb-0 font-weight-bold text-light', 'fas fa-user fa-2x text-light', 'admin/dataMHS');
INSERT INTO `menu_short` VALUES (2, 'Dosen Terdata', 'dosen', 'card bg-success shadow h-100 py-2', 'text-xs font-weight-bold text-light text-uppercase mb-1', 'h5 mb-0 font-weight-bold text-light', 'fas fa-user fa-2x text-light', 'admin/dataDosen');
INSERT INTO `menu_short` VALUES (3, 'Matkul Terdata', 'matkul', 'card bg-info shadow h-100 py-2', 'text-xs font-weight-bold text-light text-uppercase mb-1', 'h5 mb-0 font-weight-bold text-light', 'fas fa-book fa-2x text-light', 'admin/dataMatkul');
INSERT INTO `menu_short` VALUES (5, 'Jurusan Terdata', 'jurusan', 'card bg-primary shadow h-100 py-2', 'text-xs font-weight-bold text-light text-uppercase mb-1', 'h5 mb-0 font-weight-bold text-light', 'fas fa-user-graduate fa-2x text-light', 'admin/dataJurusan');
INSERT INTO `menu_short` VALUES (6, 'Akun User', 'user', 'card bg-info shadow h-100 py-2', 'text-xs font-weight-bold text-light text-uppercase mb-1', 'h5 mb-0 font-weight-bold text-light', 'fas fa-user-tie fa-2x text-light', 'admin/dataUser');

-- ----------------------------
-- Table structure for menu_sub
-- ----------------------------
DROP TABLE IF EXISTS `menu_sub`;
CREATE TABLE `menu_sub`  (
  `id_submenu` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `nama_sub` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ikon` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id_submenu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_sub
-- ----------------------------
INSERT INTO `menu_sub` VALUES (1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-home', 1);
INSERT INTO `menu_sub` VALUES (2, 2, 'Profil Saya', 'user', 'fas fa-fw fa-user', 1);
INSERT INTO `menu_sub` VALUES (3, 3, 'Siakad Dosen', 'dosen', 'fas fa-fw fa-home', 1);
INSERT INTO `menu_sub` VALUES (4, 4, 'Siakad Mahasiswa', 'mahasiswa', 'fas fa-fw fa-home', 1);
INSERT INTO `menu_sub` VALUES (6, 1, 'Account', 'admin/dataUser', 'fas fa-fw fa-user-tie', 1);
INSERT INTO `menu_sub` VALUES (7, 4, 'Hasil Studi', 'mahasiswa/studi', 'fas fa-fw fa-tasks', 1);
INSERT INTO `menu_sub` VALUES (8, 3, 'Absensi', 'dosen/absen', 'fas fa-fw fa-user', 1);
INSERT INTO `menu_sub` VALUES (9, 3, 'Hasil Studi', 'dosen/studi', 'fas fa-fw fa-tasks', 1);
INSERT INTO `menu_sub` VALUES (10, 5, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1);
INSERT INTO `menu_sub` VALUES (11, 1, 'Data Mahasiswa', 'admin/dataMHS', 'fas fa-fw fa-user', 1);
INSERT INTO `menu_sub` VALUES (12, 1, 'Data Dosen', 'admin/dataDosen', 'fas fa-fw fa-user', 1);
INSERT INTO `menu_sub` VALUES (13, 1, 'Data Jurusan', 'admin/dataJurusan', 'fas fa-fw fa-user-graduate', 1);
INSERT INTO `menu_sub` VALUES (14, 1, 'Data Matkul', 'admin/dataMatkul', 'fas fa-fw fa-book', 1);
INSERT INTO `menu_sub` VALUES (15, 5, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1);
INSERT INTO `menu_sub` VALUES (18, 1, 'Data Role', 'admin/dataRole', 'fas fa-fw fa-users', 1);
INSERT INTO `menu_sub` VALUES (19, 5, 'Shortcut Management', 'menu/short', 'fas fa-fw fa-folder-open', 1);
INSERT INTO `menu_sub` VALUES (22, 6, 'Info Website', 'user/info', 'fas fa-fw fa-info-circle', 1);
INSERT INTO `menu_sub` VALUES (24, 3, 'Dokumen Ajar', 'dosen/dokumen', 'fas fa-fw fa-folder', 1);
INSERT INTO `menu_sub` VALUES (25, 4, 'Materi dan Tugas', 'mahasiswa/dokumen', 'fas fa-fw fa-folder', 1);
INSERT INTO `menu_sub` VALUES (26, 4, 'Absensi', 'mahasiswa/absensi', 'fas fa-fw fa-check-square', 1);
INSERT INTO `menu_sub` VALUES (27, 3, 'Quiz', 'dosen/quiz', 'fas fa-book', 1);
INSERT INTO `menu_sub` VALUES (28, 4, 'Quiz', 'mahasiswa/quiz', 'fas fa-book', 1);
INSERT INTO `menu_sub` VALUES (29, 3, 'formabsen', 'dosen/formabsen', 'fas fa-book', 0);

-- ----------------------------
-- Table structure for quiz
-- ----------------------------
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE `quiz`  (
  `id_quiz` int NOT NULL AUTO_INCREMENT,
  `judul_quiz` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_matkul` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_dosen` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pertanyaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jawaban` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_quiz`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quiz
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_role` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL,
  `identity` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 'Administrator');
INSERT INTO `user_role` VALUES (2, 'Member');
INSERT INTO `user_role` VALUES (3, 'Dosen');
INSERT INTO `user_role` VALUES (4, 'Mahasiswa');

-- ----------------------------
-- Table structure for user_token
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token`  (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_token
-- ----------------------------

-- ----------------------------
-- Table structure for waktu_shift
-- ----------------------------
DROP TABLE IF EXISTS `waktu_shift`;
CREATE TABLE `waktu_shift`  (
  `id_shift` bigint NOT NULL AUTO_INCREMENT,
  `kode_shift` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `shift_awal` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `shift_akhir` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_shift`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of waktu_shift
-- ----------------------------
INSERT INTO `waktu_shift` VALUES (1, 'P', '08:00:00', '12:00:00');
INSERT INTO `waktu_shift` VALUES (2, 'M', '19:00:00', '23:00:00');

SET FOREIGN_KEY_CHECKS = 1;
