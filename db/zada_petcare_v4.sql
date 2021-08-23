/*
 Navicat Premium Data Transfer

 Source Server         : DATABASE-ENDRA
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : zada_petcare

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 21/08/2021 20:42:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin@mail.com', '$2a$04$IPKPWcGQebSpg02tnLK5qOLuaWP4zNrtK1HRTIF9i4Y1RG60si2VS');
INSERT INTO `admin` VALUES (3, 'admin@gmail.com1', '$2y$10$ImcFkoWuABpj9BvBXsD/.O/fIGVUlgio2p2PBHAnQ/Es5BXoa6JcC');

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `id_produk` int(11) NULL DEFAULT NULL,
  `harga` bigint(20) NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `relasi_transaksi`(`id_transaksi`) USING BTREE,
  CONSTRAINT `relasi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES (6, 12, 21, 120000, '', 1);
INSERT INTO `detail_transaksi` VALUES (7, 12, 23, 58000, 'test', 4);
INSERT INTO `detail_transaksi` VALUES (8, 13, 21, 120000, '', 2);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (7, 'MAKANAN KUCING');
INSERT INTO `kategori` VALUES (9, 'LAYANAN');
INSERT INTO `kategori` VALUES (11, 'AKSESORIS');
INSERT INTO `kategori` VALUES (12, 'VITAMIN & OBAT-OBATAN');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` bigint(20) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'default.jpg',
  `id_kategori` int(11) NULL DEFAULT NULL,
  `stock` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (21, 'ROYAL CANIN 1 KG', 120000, 'royal_canin1.jpg', 7, 7);
INSERT INTO `produk` VALUES (22, 'MEO ADULT - 500 GRAM', 57000, 'meo2.jpeg', 7, 8);
INSERT INTO `produk` VALUES (23, 'MEO ADULT 1 - KG', 58000, 'meo_adult.jpeg', 7, 25);
INSERT INTO `produk` VALUES (25, 'KALUNG KUCING', 5000, 'oem_oem_kalung_kucing-_anjing_polos_warna_biru_muda_-lebar_1_cm-_full021.jpg', 11, 25);
INSERT INTO `produk` VALUES (26, 'TALI TUNTUN KUCING', 55000, 'inv_fd98cef2-280c-4345-b311-228c9e21bd3f_606_606.jpg', 11, 10);
INSERT INTO `produk` VALUES (27, 'GUNTING KUKU KUCING', 16000, 'vetma-pet-and-poultry_vetma-pet-and-poultry-gunting-kuku-hewan_full02.jpg', 11, 25);
INSERT INTO `produk` VALUES (28, 'PENGGEMUK KUCING', 98000, 'e4512640058176a47da9270c9350833f.jpeg', 12, 25);
INSERT INTO `produk` VALUES (29, 'PAKET GROOMING ANTAR JEMPUT', 75000, '', 9, 16);

-- ----------------------------
-- Table structure for tarif_ongkir
-- ----------------------------
DROP TABLE IF EXISTS `tarif_ongkir`;
CREATE TABLE `tarif_ongkir`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jarak_minimal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_jarak_minimal` bigint(20) NULL DEFAULT NULL,
  `harga` bigint(20) NULL DEFAULT NULL,
  `status_jarak_minimal` enum('aktif','tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'tidak',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tarif_ongkir
-- ----------------------------
INSERT INTO `tarif_ongkir` VALUES (1, '5', 5000, 12000, 'aktif');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `koordinat_pengambilan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `alamat_pengambilan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `koordinat_pengantaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_pengantaran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `total_pembelian` bigint(20) NULL DEFAULT NULL,
  `ongkir` bigint(20) NULL DEFAULT NULL,
  `status` enum('selesai','proses','diantar','diambil','keranjang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'proses',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (12, 3, '-7.8243331,110.4284221', 'Jl. Wonosari No.KM.8,5, Gandu, Sendangtirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573, Indonesia', '-7.782850112907894,110.37170140131379', 'Jl. Jend. Sudirman No.49, Terban, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224, Indonesia', 1160800, 808800, 'proses', NULL, '2021-08-20 12:13:53');
INSERT INTO `transaksi` VALUES (13, 3, '-7.8243331,110.4284221', 'Jl. Wonosari No.KM.8,5, Gandu, Sendangtirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573, Indonesia', '-7.8243331,110.4284221', 'Jl. Wonosari No.KM.8,5, Gandu, Sendangtirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573, Indonesia', NULL, NULL, 'proses', NULL, NULL);
INSERT INTO `transaksi` VALUES (14, 7, '-7.7599049,110.4090461', 'amikom', '-7.7599049,110.4090461', 'amikom', NULL, NULL, 'proses', NULL, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `koordinat_alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (3, '081252', 'test', '$2y$10$oiqwKq5PYcbEF99vzxggZe7Aop5dvvzLyPeagFFHDMZgIebuiSzFq', '-7.782850112907894,110.37170140131379', 'lesehan camiles');
INSERT INTO `user` VALUES (4, '087999888', 'test 2', '$2y$10$bykso3kqVlEblrXo2fsPFu5GVPMrtAyp5eg0Ef.TQDcVMNkIGxuG6', '110.37453381403351,-7.783708485055077', '');
INSERT INTO `user` VALUES (7, '081222', 'test', '$2y$10$o5rQ0/XtmLgwK8t7Usr4CuaTz0ydEYVZSFRvZ7t7N.Xdtkv7PaKMO', '-7.7599049,110.4090461', 'amikom');

SET FOREIGN_KEY_CHECKS = 1;
