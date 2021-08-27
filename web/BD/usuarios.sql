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

 Date: 27/08/2021 01:45:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `curp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `authKey` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accessToken` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_registro` datetime NULL DEFAULT NULL,
  `fecha_actualizacion` datetime NULL DEFAULT NULL,
  `verification_code` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idusuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (5, 'GAOJ850722HTCLCN05', 'Juan Carlos', 'jcgalvezocampo@gmail.com', 'itNwR7nhba4nc', '', 'ae6ed01d0462b66a67b4684ee50901764eaf7e2449a7cd7cef9ed285c70e75f3ed4d8e6a6b73b154a5db93dd867420f1b44816d43c1d7e3c621c696a42c1ba666ebfd7d152b18301febabc2fae14a3de9656843c436b1d0718195d5a981a816d5b15bbd7', 'c98148bf9f22e572fa4123e6e6a05e9ac144936f8d84e5f60a0d1b03c2840953219ce83b84fb2413ec9ebaa7ef017451a910c28b43ca026302dacd2371d2f48f4543f0ed5cb9c89f34f93b85207afa717a60a812ac041d1a735c599e30d02b0f6f6735ae', 1, NULL, NULL, 'f0ae8928');

SET FOREIGN_KEY_CHECKS = 1;
