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

 Date: 02/08/2021 20:00:16
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
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `id_produk` int(11) NULL DEFAULT NULL,
  `harga` bigint(20) NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  INDEX `relasi_transaksi`(`id_transaksi`) USING BTREE,
  CONSTRAINT `relasi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` bigint(20) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'default.jpg',
  `id_kategori` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (21, 'Royal Canin 1 KG', 120000, 'royal_canin1.jpg', 7);
INSERT INTO `produk` VALUES (22, 'Moe 500 Gram', 57000, 'meo2.jpeg', 7);
INSERT INTO `produk` VALUES (23, 'Meo Adult 1KG', 58000, 'meo_adult.jpeg', 7);

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
INSERT INTO `tarif_ongkir` VALUES (3, '5', 35000, 3000, 'aktif');
INSERT INTO `tarif_ongkir` VALUES (4, '0.5', 1144, 1144, 'tidak');
INSERT INTO `tarif_ongkir` VALUES (7, '0.4', 444, 4444, 'aktif');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `koordinat_pengambilan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_pengambilan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `koordinat_pengantaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_pembelian` bigint(20) NULL DEFAULT NULL,
  `ongkir` bigint(20) NULL DEFAULT NULL,
  `status` enum('selesai','proses','diantar','diambil') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'proses',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, 1, '1221', 'asdfasdf', '131231', 5000, 5000, 'proses', 'asdfa');
INSERT INTO `transaksi` VALUES (2, 1, '11212', 'asdfasdfasdf', '2424234', 5000, 1222, 'diantar', '123123');
INSERT INTO `transaksi` VALUES (3, 1, '12312313', 'asdfasdfadf', '123123123', 5000, 123312, 'diambil', '123123');
INSERT INTO `transaksi` VALUES (4, 1, '123123123', 'asdfasfaf', '11231323', 5000, 123123, 'selesai', '12313');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `koordinat_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
