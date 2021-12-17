/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100510
 Source Host           : localhost:3306
 Source Schema         : ithuimanguillo

 Target Server Type    : MariaDB
 Target Server Version : 100510
 File Encoding         : 65001

 Date: 17/12/2021 13:13:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for profesores_seguimientos
-- ----------------------------
DROP TABLE IF EXISTS `profesores_seguimientos`;
CREATE TABLE `profesores_seguimientos`  (
  `idseguimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idciclo` int(11) NULL DEFAULT NULL,
  `idprofesor` int(11) NULL DEFAULT NULL,
  `seguimiento` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bandera` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idseguimiento`) USING BTREE,
  INDEX `idciclo`(`idciclo`) USING BTREE,
  INDEX `idprofesor`(`idprofesor`) USING BTREE,
  CONSTRAINT `idciclo` FOREIGN KEY (`idciclo`) REFERENCES `ciclo` (`idciclo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `idprofesor` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;


ALTER TABLE grupos_estudiantes
ADD COLUMN `sp9` varchar(5) AFTER `p9`,
ADD COLUMN `sp8` varchar(5) AFTER `p9`,
ADD COLUMN `sp7` varchar(5) AFTER `p9`,
ADD COLUMN `sp6` varchar(5) AFTER `p9`,
ADD COLUMN `sp5` varchar(5) AFTER `p9`,
ADD COLUMN `sp4` varchar(5) AFTER `p9`,
ADD COLUMN `sp3` varchar(5) AFTER `p9`,
ADD COLUMN `sp2` varchar(5) AFTER `p9`,
ADD COLUMN `sp1` varchar(5) AFTER `p9`
