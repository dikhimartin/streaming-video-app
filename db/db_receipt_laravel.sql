/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : db_receipt_laravel

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 03/12/2020 18:29:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ek_group_users
-- ----------------------------
DROP TABLE IF EXISTS `ek_group_users`;
CREATE TABLE `ek_group_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Y = aktif, N= Tidak Aktif ',
  `additional` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ek_migrations
-- ----------------------------
DROP TABLE IF EXISTS `ek_migrations`;
CREATE TABLE `ek_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ek_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `ek_password_resets`;
CREATE TABLE `ek_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `ek_password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_password_resets
-- ----------------------------
INSERT INTO `ek_password_resets` VALUES ('dikhimartin@gmail.com', '$2y$10$Ando8DIReXy1fFxiUCLnb.BY2yfIaOkC9q8UlzYchIDa8aK3NuDJi', '2019-02-17 10:27:44');
INSERT INTO `ek_password_resets` VALUES ('dikhhyymartieenzblogger@gmail.com', '$2y$10$53KvVeKK225vlPQVWGTKjuvtLvBUUAd.8NFjZoQrQUjLEqoyqQkPi', '2019-02-17 10:49:07');

-- ----------------------------
-- Table structure for ek_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `ek_permission_role`;
CREATE TABLE `ek_permission_role`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  INDEX `FK_ek_permission_role_ek_roles`(`role_id`) USING BTREE,
  CONSTRAINT `FK_ek_permission_role_ek_roles` FOREIGN KEY (`role_id`) REFERENCES `ek_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_permission_role
-- ----------------------------
INSERT INTO `ek_permission_role` VALUES (5, 1);
INSERT INTO `ek_permission_role` VALUES (1, 1);
INSERT INTO `ek_permission_role` VALUES (9, 1);
INSERT INTO `ek_permission_role` VALUES (5, 3);
INSERT INTO `ek_permission_role` VALUES (6, 3);
INSERT INTO `ek_permission_role` VALUES (7, 3);
INSERT INTO `ek_permission_role` VALUES (8, 3);
INSERT INTO `ek_permission_role` VALUES (1, 3);
INSERT INTO `ek_permission_role` VALUES (2, 3);
INSERT INTO `ek_permission_role` VALUES (3, 3);
INSERT INTO `ek_permission_role` VALUES (4, 3);
INSERT INTO `ek_permission_role` VALUES (9, 3);
INSERT INTO `ek_permission_role` VALUES (10, 3);
INSERT INTO `ek_permission_role` VALUES (11, 3);
INSERT INTO `ek_permission_role` VALUES (12, 3);
INSERT INTO `ek_permission_role` VALUES (5, 2);
INSERT INTO `ek_permission_role` VALUES (1, 2);
INSERT INTO `ek_permission_role` VALUES (9, 2);

-- ----------------------------
-- Table structure for ek_permissions
-- ----------------------------
DROP TABLE IF EXISTS `ek_permissions`;
CREATE TABLE `ek_permissions`  (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `urutan` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_permissions
-- ----------------------------
INSERT INTO `ek_permissions` VALUES (1, 'roles-list', 'Role List', 'Role List', 2, '2017-06-21 14:24:23', '2017-06-21 14:24:23');
INSERT INTO `ek_permissions` VALUES (2, 'roles-create', 'Role Add', 'Role Add', 2, '2017-06-21 14:24:23', '2017-06-21 14:24:23');
INSERT INTO `ek_permissions` VALUES (3, 'roles-edit', 'Role Edit', 'Role Edit', 2, '2017-06-21 14:24:23', '2017-06-21 14:24:23');
INSERT INTO `ek_permissions` VALUES (4, 'roles-delete', 'Role Delete', 'Role Delete', 2, '2017-06-21 14:24:23', '2017-06-21 14:24:23');
INSERT INTO `ek_permissions` VALUES (5, 'users-list', 'Users List', 'users list', 1, '2017-06-22 07:00:00', '2017-06-22 07:00:00');
INSERT INTO `ek_permissions` VALUES (6, 'users-create', 'Users Create', 'users create', 1, '2017-06-22 07:00:00', '2017-06-22 07:00:00');
INSERT INTO `ek_permissions` VALUES (7, 'users-edit', 'Users Edit', 'users edit', 1, '2017-06-22 07:00:00', '2017-06-22 07:00:00');
INSERT INTO `ek_permissions` VALUES (8, 'users-delete', 'Users Delete', 'users delete', 1, '2017-06-22 07:00:00', '2017-06-22 07:00:00');
INSERT INTO `ek_permissions` VALUES (9, 'group_user-list', 'Group List', 'Group List', 5, '2019-07-04 04:39:00', '2019-07-04 04:39:01');
INSERT INTO `ek_permissions` VALUES (10, 'group_user-create', 'Group Create', 'Group Create', 5, '2019-07-04 04:39:22', '2019-07-04 04:39:23');
INSERT INTO `ek_permissions` VALUES (11, 'group_user-edit', 'Group Edit', 'Group Edit', 5, '2019-07-04 04:39:42', '2019-07-04 04:39:43');
INSERT INTO `ek_permissions` VALUES (12, 'group_user-delete', 'Group Delete', 'Group Delete', 5, '2019-07-04 04:40:00', '2019-07-04 04:40:01');

-- ----------------------------
-- Table structure for ek_role_user
-- ----------------------------
DROP TABLE IF EXISTS `ek_role_user`;
CREATE TABLE `ek_role_user`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `FK_ek_role_user_ek_roles`(`role_id`) USING BTREE,
  CONSTRAINT `FK_ek_role_user_ek_roles` FOREIGN KEY (`role_id`) REFERENCES `ek_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users join roles_user` FOREIGN KEY (`user_id`) REFERENCES `ek_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_role_user
-- ----------------------------
INSERT INTO `ek_role_user` VALUES (3, 'K00001', NULL, NULL);
INSERT INTO `ek_role_user` VALUES (2, 'K00002', '2019-07-03 20:41:42', '2019-07-03 20:41:42');
INSERT INTO `ek_role_user` VALUES (1, 'K00003', '2019-07-03 20:42:05', '2019-07-03 20:42:05');

-- ----------------------------
-- Table structure for ek_roles
-- ----------------------------
DROP TABLE IF EXISTS `ek_roles`;
CREATE TABLE `ek_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `additional` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_roles
-- ----------------------------
INSERT INTO `ek_roles` VALUES (1, 'Member Of Division', 'Sales', 'Sales', 'Y', '2017-06-21 08:58:15', '2020-03-20 12:18:02', '');
INSERT INTO `ek_roles` VALUES (2, 'Head of Division', 'Admin', 'Admin', 'Y', '2018-07-13 13:31:05', '2020-03-20 22:14:58', '');
INSERT INTO `ek_roles` VALUES (3, 'Super Admin', 'Super Admin', 'Super Admin', 'Y', '2019-01-18 10:27:27', '2020-03-20 16:45:22', '');

-- ----------------------------
-- Table structure for ek_users
-- ----------------------------
DROP TABLE IF EXISTS `ek_users`;
CREATE TABLE `ek_users`  (
  `id_users` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NULL',
  `nik` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telephone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_birth` date NULL DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` enum('L','P') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_level_user` int(11) NULL DEFAULT NULL,
  `image` varchar(125) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_by` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `status` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `additional` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_users`) USING BTREE,
  UNIQUE INDEX `nik`(`nik`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ek_users
-- ----------------------------
INSERT INTO `ek_users` VALUES ('K00001', 'superadmin', 'Dikhi Martin', '$2y$10$U4SlzAtPIIeP6gOWogltaOZjhh9AR8UnHPn6D2Q6tO3pEsMknalvq', 'dikhimartin@gmail.com', '081748334809', '2019-02-16', 'Bekasi', 'P', 3, '', 'fnlGnhqhGENI6jYg1L3pfNpODX3oSO1AhvkdOL3LrfIK8a4D40cvu265AuaW', 'K00001', 'K00001', '2019-01-07 16:33:38', '2020-12-02 22:32:16', 'Y', NULL);
INSERT INTO `ek_users` VALUES ('K00002', 'admin', 'Admin', '$2y$10$i6m3f/s1m8syXrub.nTamepK/UsHVCiej3jUwUZvzDLjAYezFRLwS', 'dikhi.martin@gmail.com', '085693086800', '2019-07-03', 'Ciketing Udik Rt.002/003, Bantargebang', 'P', 2, NULL, 'EHl67IlSSdjUGCW3r6p7JrDibJeSjAhLUcJe4CxtRMcpq96iaydYoAIA33pf', 'K00001', 'K00001', '2019-07-03 20:41:42', '2019-07-05 15:12:55', 'Y', NULL);
INSERT INTO `ek_users` VALUES ('K00003', 'userman', 'User', '$2y$10$IGXwb2SORE8Uyh6GpXguyOZNR5EW4V9hmI5sJPIlRTfQNpqfDd.Ey', 'dikhi.martin@gmail.com', '085219378505', '2019-07-03', 'Bd. Silvy Kusmiran Jl. Lama Citarik No. 185 Rt. 0101 Ds. Jatireja', 'L', 1, NULL, 'N0g2T14tf1tZs7yh4kjObFSS5a1vX5yeNBdonyQSmSYfq7WYtN1ReZybyy57', 'K00001', 'K00001', '2019-07-03 20:42:05', '2020-03-20 05:06:32', 'Y', NULL);

SET FOREIGN_KEY_CHECKS = 1;
