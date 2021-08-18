/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : project-petcare

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 18/08/2021 22:07:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4  ROW_FORMAT = Dynamic;

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
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(0) NULL DEFAULT NULL,
  `id_produk` int(0) NULL DEFAULT NULL,
  `harga` bigint(0) NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4  NULL,
  `jumlah` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `relasi_transaksi`(`id_transaksi`) USING BTREE,
  CONSTRAINT `relasi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES (6, 12, 21, 120000, '', 1);
INSERT INTO `detail_transaksi` VALUES (7, 12, 23, 58000, 'test', 4);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4  ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (7, 'Makanan Kucing');
INSERT INTO `kategori` VALUES (9, 'Layanan');
INSERT INTO `kategori` VALUES (11, 'aksesoris');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
  `harga` bigint(0) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 NULL DEFAULT 'default.jpg',
  `id_kategori` int(0) NULL DEFAULT NULL,
  `stock` bigint(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4  ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (21, 'Royal Canin 1 KG', 120000, 'royal_canin1.jpg', 7, 9);
INSERT INTO `produk` VALUES (22, 'Moe 500 Gram', 57000, 'meo2.jpeg', 7, 8);
INSERT INTO `produk` VALUES (23, 'Meo Adult 1KG', 58000, 'meo_adult.jpeg', 7, 6);

-- ----------------------------
-- Table structure for tarif_ongkir
-- ----------------------------
DROP TABLE IF EXISTS `tarif_ongkir`;
CREATE TABLE `tarif_ongkir`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `jarak_minimal` varchar(255) CHARACTER SET utf8mb4 NULL DEFAULT NULL,
  `harga_jarak_minimal` bigint(0) NULL DEFAULT NULL,
  `harga` bigint(0) NULL DEFAULT NULL,
  `status_jarak_minimal` enum('aktif','tidak') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'tidak',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tarif_ongkir
-- ----------------------------
INSERT INTO `tarif_ongkir` VALUES (1, '5', 5000, 12000, 'aktif');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `id_user` int(0) NULL DEFAULT NULL,
  `koordinat_pengambilan` text CHARACTER SET utf8mb4  NULL,
  `alamat_pengambilan` longtext CHARACTER SET utf8mb4  NULL,
  `koordinat_pengantaran` text CHARACTER SET utf8mb4  NOT NULL,
  `alamat_pengantaran` longtext CHARACTER SET utf8mb4  NULL,
  `total_pembelian` bigint(0) NULL DEFAULT NULL,
  `ongkir` bigint(0) NULL DEFAULT NULL,
  `status` enum('selesai','proses','diantar','diambil','keranjang') CHARACTER SET utf8mb4  NOT NULL DEFAULT 'proses',
  `catatan` text CHARACTER SET utf8mb4  NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4  ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, 1, '1221', 'asdfasdf', '131231', NULL, 5000, 5000, 'proses', 'asdfa');
INSERT INTO `transaksi` VALUES (2, 1, '11212', 'asdfasdfasdf', '2424234', NULL, 5000, 1222, 'diantar', '123123');
INSERT INTO `transaksi` VALUES (3, 1, '12312313', 'asdfasdfadf', '123123123', NULL, 5000, 123312, 'diambil', '123123');
INSERT INTO `transaksi` VALUES (4, 1, '123123123', 'asdfasfaf', '11231323', NULL, 5000, 123123, 'selesai', '12313');
INSERT INTO `transaksi` VALUES (12, 3, '-7.783118520486451,110.37170140131379', 'Jl. Jend. Sudirman No.38, Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224, Indonesia', '-7.7599049,110.4090461', 'Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281, Indonesia', NULL, NULL, 'keranjang', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT,
  `no_hp` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  `koordinat_alamat` varchar(255) CHARACTER SET utf8mb4  NULL DEFAULT NULL,
  `alamat` longtext CHARACTER SET utf8mb4  NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (3, '081252', 'test', '$2y$10$oiqwKq5PYcbEF99vzxggZe7Aop5dvvzLyPeagFFHDMZgIebuiSzFq', '110.4284221,-7.8243331', 'lesehan camiles');
INSERT INTO `user` VALUES (4, '087999888', 'test 2', '$2y$10$bykso3kqVlEblrXo2fsPFu5GVPMrtAyp5eg0Ef.TQDcVMNkIGxuG6', '110.37453381403351,-7.783708485055077', '');
INSERT INTO `user` VALUES (5, NULL, NULL, '$2y$10$QHaATDsvkeo4fC9wDWbSrOAjby7o9T1tkmnmz/awjVPiaIOE4TbIe', '110.4083417,-7.792714199999999', 'akakom');

SET FOREIGN_KEY_CHECKS = 1;
