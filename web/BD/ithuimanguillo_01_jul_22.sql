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

 Date: 01/07/2022 06:04:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for actas_calificaciones
-- ----------------------------
DROP TABLE IF EXISTS `actas_calificaciones`;
CREATE TABLE `actas_calificaciones`  (
  `idacta_cal` int(11) NOT NULL AUTO_INCREMENT,
  `idgrupo` int(11) NOT NULL,
  `idestudiante` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idopcion_curso` int(11) NULL DEFAULT NULL,
  `pri_opt` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `seg_opt` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  PRIMARY KEY (`idacta_cal`) USING BTREE,
  INDEX `fk_actas_calificaciones_grupos_estudiantes1_idx`(`idestudiante`, `idgrupo`) USING BTREE,
  INDEX `fk_actas_calificaciones_cat_opcion_curso1_idx`(`idopcion_curso`) USING BTREE,
  CONSTRAINT `fk_actas_calificaciones_cat_opcion_curso1` FOREIGN KEY (`idopcion_curso`) REFERENCES `cat_opcion_curso` (`idopcion_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_actas_calificaciones_grupos_estudiantes1` FOREIGN KEY (`idestudiante`, `idgrupo`) REFERENCES `grupos_estudiantes` (`idestudiante`, `idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of actas_calificaciones
-- ----------------------------

-- ----------------------------
-- Table structure for cat_carreras
-- ----------------------------
DROP TABLE IF EXISTS `cat_carreras`;
CREATE TABLE `cat_carreras`  (
  `idcarrera` int(11) NOT NULL AUTO_INCREMENT,
  `cve_carrera` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `desc_carrera` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_semestres` int(11) NULL DEFAULT NULL,
  `plan_estudios` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idcarrera`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_carreras
-- ----------------------------
INSERT INTO `cat_carreras` VALUES (1, 'IAAS', 'ING. EN INNOVACION AGRICOLA SUSTENTABLE', 9, 'IIAS-2010-221');
INSERT INTO `cat_carreras` VALUES (2, 'ILOG', 'ING. EN LOGÍSTICA', 9, 'ILOG-2009-202');
INSERT INTO `cat_carreras` VALUES (3, 'IPET', 'ING. PETROLERA', 9, 'IPET-2010-231');
INSERT INTO `cat_carreras` VALUES (4, 'IPET-MIXTA', 'ING. PETROLERA MIXTA', 9, 'IPET-2010-231');

-- ----------------------------
-- Table structure for cat_materias
-- ----------------------------
DROP TABLE IF EXISTS `cat_materias`;
CREATE TABLE `cat_materias`  (
  `idmateria` int(11) NOT NULL AUTO_INCREMENT,
  `cve_materia` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `desc_materia` varchar(95) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `creditos` int(11) NOT NULL,
  `fecha_registro` datetime NULL DEFAULT NULL,
  `fecha_actualizacion` datetime NULL DEFAULT NULL,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idmateria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 156 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_materias
-- ----------------------------
INSERT INTO `cat_materias` VALUES (1, 'PEA-1023', 'PRODUCTIVIDAD DE POZOS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (2, 'PED-1011', 'ESTÁTICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (3, 'LOF-0930', 'TÓPICOS DE INGENIERÍA MECÁNICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (4, 'PRJ-1805', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (5, 'PRJ-1804', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (6, 'PED-1012', 'FLUJO MULTIFÁSICO EN TUBERÍAS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (7, 'AEF-1049', 'MICROBIOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (8, 'PEG-1026', 'QUÍMICA ORGÁNICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (9, 'PED-1019', 'MECÁNICA DE FLUIDOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (10, 'PED-1029', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (11, 'PED-1014', 'GEOLOGÍA DE YACIMIENTOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (12, 'PED-1016', 'HIDRAÚLICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (13, 'PED-1027', 'RECUPERACIÓN SECUNDARIA Y MEJORADA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (14, 'PED-1028', 'SISTEMAS ARTIFICIALES', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (15, 'LOC-0905', 'COMPRAS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (16, 'LOC-0926', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (17, 'ACF-0902', 'CÁLCULO INTEGRAL', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (18, 'ACF-0903', 'ÁLGEBRA LINEAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (19, 'AEF-1025', 'ESTADISTICA INFERENCIAL II', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (20, 'ASC-1003', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (21, 'ACF-0905', 'ECUACIONES DIFERENCIALES', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (22, 'ACF-0901', 'CÁLCULO DIFERENCIAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (23, 'ACF-0902.', 'CÁLCULO INTEGRAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (24, 'PEQ-1009', 'ECONOMÍA', 3, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (25, 'TDF-1803', 'TALLER DE COMERCIO INTERNACIONAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (26, 'TDD-1805', 'NEGOCIOS INTERNACIONALES', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (27, 'LOE-0924', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (28, 'AEC-1023', 'PROBABILIDAD Y ESTADÍSTICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (29, 'PEC-1022', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (30, 'ACC-0906', 'FUNDAMENTOS DE INVESTIGACIÓN', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (31, 'LOC-0929', 'TIPOLOGÍA DEL PRODUCTO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (32, 'LOC-0911', 'ENTORNO ECONÓMICO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (33, 'LOC-0928', 'SERVICIO AL CLIENTE', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (34, 'TDC-1804', 'ADMINISTRACIÓN ESTRATÉGICA', 4, '2022-04-24 08:58:04', '2022-04-24 08:58:04', 'VIG');
INSERT INTO `cat_materias` VALUES (35, 'ASF-1014', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (36, 'ASF-1006', 'BOTÁNICA APLICADA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (37, 'ACA-0909', 'TALLER DE INVESTIGACIÓN I', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (38, 'LOF-0931', 'TRÁFICO Y TRANSPORTE', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (39, 'LOD-0915', 'GEOGRAFÍA PARA EL TRANSPORTE', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (40, 'ASF-1019', 'QUÍMICA ANALÍTICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (41, 'AEF-1019', 'EDAFOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (42, 'ASF-1021', 'SISTEMAS DE RIEGO PRESURIZADO', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (43, 'PED-1002', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL', 5, '2022-04-24 19:36:12', '2022-04-24 07:24:17', 'VIG');
INSERT INTO `cat_materias` VALUES (44, 'ASD-1007', 'DESARROLLO COMUNITARIO', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (45, 'LOC-0908', 'DESARROLLO HUMANO Y ORGANIZACIONAL', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (46, 'ACD-0908', 'DESARROLLO SUSTENTABLE', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (47, 'ASF-1009', 'ELEMENTOS DE TERMODINÁMICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (48, 'ACA-0907', 'TALLER DE ÉTICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (49, 'LOD-0923', 'LEGISLACIÓN ADUANERA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (50, 'PEQ-1018', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA', 3, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (51, 'LOD-0906', 'CONTABILIDAD Y COSTOS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (52, 'LOC-0907', 'CULTURA DE CALIDAD', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (53, 'TDG-1802', 'ADMINISTRACIÓN FINANCIERA', 6, '2022-04-26 11:55:02', '2022-04-26 11:55:31', 'VIG');
INSERT INTO `cat_materias` VALUES (54, 'TDC-1806', 'SISTEMA DE CALIDAD', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (55, 'AEF-1001', 'AGROCLIMATOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (56, 'ASF-1012', 'FISIOLOGÍA VEGETAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (57, 'AED-1002', 'AGROECOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (58, 'ASF-1017', 'OLERICULTURA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (59, 'AEF-1016', 'DISEÑOS EXPERIMENTALES', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (60, 'FID-1805', 'INDUSTRIALIZACIÓN DE PRODUCTOS AGRÍCOLAS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (61, 'ASD-1001', 'AGRONEGOCIOS I', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (62, 'FIF-1804', 'GENOTÉCNIA VEGETAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (63, 'PED-1010', 'ELECTRICIDAD Y MAGNETISMO', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (64, 'AEF-1038', 'INSTRUMENTACIÓN', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (65, 'LOH-0902', 'BASE DE DATOS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (66, 'TDC-1801', 'TALLER DE COACHING', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (67, 'LOE-0922', 'INVESTIGACIÓN DE OPERACIONES II', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (68, 'ASF-1010', 'ESTADÍSTICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (69, 'AEQ-1064', 'TECNOLOGÍAS DE LA INFORMACIÓN Y LAS COMUNICACIONES', 3, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (70, 'AEC-1037', 'INGENIERÍA ECONÓMICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (71, 'AED-1044', 'MERCADOTECNIA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (72, 'PEQ-1001', 'ADMINISTRACIÓN', 3, '2022-04-24 08:55:06', '2022-06-17 11:17:54', 'VIG');
INSERT INTO `cat_materias` VALUES (73, 'FIF-1802', 'BIOTECNOLOGÍA VEGETAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (74, 'ASF-1015', 'MÉTODOS ESTADÍSTICOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (75, 'ASF-1016', 'NUTRICIÓN VEGETAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (76, 'ASD-1020', 'SISTEMA DE PRODUCCIÓN AGRÍCOLA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (77, 'PEC-1004', 'ANÁLISIS NUMÉRICO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (78, 'PED-1008', 'DINÁMICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (79, 'LOC-0903', 'CADENA DE SUMINISTRO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (80, 'LOH-0909', 'DIBUJO ASISTIDO POR COMPUTADORA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (81, 'LOC-0925', 'PROCESOS DE FABRICACIÓN Y MANEJO DE MATERIALES', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (82, 'PEA-1005', 'CALIDAD EN LA INDUSTRIA PETROLERA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (83, 'AEF-1024', 'ESTADÍSTICA INFERENCIAL I', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (84, 'LOC-0919', 'INTRODUCCIÓN A LA INGENIERÍA EN LOGÍSTICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (85, 'LOF-0912', 'FINANZAS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (86, 'LOF-0918', 'INNOVACIÓN', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (87, 'AED-1030', 'FORMULACIÓN Y EVALUACIÓN DE PROYECTOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (88, 'ASC-1013', 'INOCUIDAD ALIMENTARIA Y BIOSEGURIDAD', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (89, 'ACA-0910', 'TALLER DE INVESTIGACIÓN II', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (90, 'PED-1006', 'COMPUTACIÓN PARA INGENIERÍA PETROLERA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (91, 'PEA-1003', 'ANÁLISIS E INTERPRETACIÓN DE PLANOS Y DISEÑO DE INGENIERÍA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (92, 'ASQ-1008', 'DISEÑO AGRÍCOLA ASISTIDO POR  COMPUTADORA', 3, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (93, 'AEM-1066', 'TOPOGRAFÍA', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (94, 'LOC-0914', 'FUNDAMENTOS DE DERECHO', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (95, 'AEF-1042', 'MECÁNICA CLÁSICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (96, 'PED-1020', 'MÉTODOS ELÉCTRICOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (97, 'ASQ-1023', 'TALLER DE ELEMENTOS DE MECÁNICA DE SÓLIDOS', 3, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (98, 'AED-1023', 'ENTOMOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (99, 'AEJ-1028', 'FITOPATOLOGÍA', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (100, 'LOF-0901', 'ALMACENES', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (101, 'ASF-1018', 'PRINCIPIOS DE ELECTROMECÁNICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (102, 'LOC-0913', 'FUNDAMENTOS DE ADMINISTRACIÓN', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (103, 'ASD-1002', 'AGRONEGOCIOS II', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (104, 'PRV-1802', 'ANÁLISIS DE MÉTODO DE PRODUCCIÓN', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (105, 'PED-1015', 'GEOLOGÍA PETROLERA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (106, 'PED-1017', 'INGENIERÍA DE PERFORACIÓN DE POZOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (107, 'AEF-1017', 'ECOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (108, 'PEG-1025', 'QUÍMICA INORGÁNICA', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (109, 'AEF-1056', 'QUÍMICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (110, 'ASF-1004', 'BIOLOGÍA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (111, 'AED-1006', 'BIOQUÍMICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (112, 'ASF-1005', 'BIOLOGÍA MOLECULAR', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (113, 'LOC-0927', 'QUÍMICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (114, 'ASF-1022', 'SISTEMAS DE RIEGO SUPERFICIAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (115, 'ASF-1011', 'FERTIRRIGACIÓN', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (116, 'FID-1801', 'INNOVACIÓN TECNOLOGICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (117, 'PED-1031', 'TERMODINÁMICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (118, 'PEQ-1007', 'CONDUCCIÓN Y MANEJO DE HIDROCARBUROS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (119, 'PRF-1803', 'COMPORTAMIENTO DE LOS YACIMIENTOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (120, 'PED-1021', 'PETROFÍSICA Y REGISTRO DE POZOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (121, 'ACF-0904', 'CÁLCULO VECTORIAL', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (122, 'PRJ-1801', 'SIMULACIÓN NUMÉRICA DE YACIMIENTOS', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (123, 'PED-1013', 'GEOLOGÍA DE EXPLOTACIÓN DEL PETRÓLEO', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (124, 'PED-1024', 'PROPIEDADES DE LOS FLUÍDOS PETROLEROS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (125, 'LOJ-0917', 'HIGIENE Y SEGURIDAD', 6, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (126, 'LOH-0904', 'COMERCIO INTERNACIONAL', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (127, 'AEC-1018', 'ECONOMÍA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (128, 'LOE-0920', 'INVENTARIOS', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (129, 'RP', 'RESIDENCIA PROFESIONAL', 10, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (130, 'LOE-0921', 'INVESTIGACIÓN DE OPERACIONES I', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (131, 'ING', 'MÓDULO INGLÉS', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (132, 'TUT-1', 'TUTORÍA 1', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (133, 'TUT-2', 'TUTORÍA 2', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (134, 'AEF-1036', 'HIDRÁULICA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (135, 'FIF-1803', 'FORMULACIÓN Y EVALUACIÓN DE PROYECTOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (136, 'AEF-1029', 'FORMULACIÓN Y EVALUACIÓN DE PROYECTOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (137, 'AEC-1053', 'PROBABILIDAD Y ESTADÍSTICA', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (138, 'LOC-0910', 'EMPAQUE, ENVASE Y EMBALAJE', 4, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (139, 'PED-1030', 'TERMINACIÓN Y MANTENIMIENTO DE POZOS', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (140, 'PRD-1806', 'INGENIERÍA DE PERFORACIÓN DE POZOS AVANZADA', 5, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (141, 'ING-34', 'MÓDULO INGLÉS III Y IV', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (142, 'ING-56', 'MÓDULO INGLÉS V Y VI', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (143, 'ING-78', 'MÓDULO INGLÉS VII Y VIII', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (144, 'ING-910', 'MÓDULO INGLÉS IX Y X', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (145, 'ING-1', 'MÓDULO INGLÉS I', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (146, 'ING-2', 'MÓDULO INGLÉS II', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (147, 'ING-3', 'MÓDULO INGLÉS III', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (148, 'ING-4', 'MÓDULO INGLÉS IV', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (149, 'ING-5', 'MÓDULO INGLÉS V', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (150, 'ING-6', 'MÓDULO INGLÉS VI', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (151, 'ING-7', 'MÓDULO INGLÉS VII', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (152, 'ING-8', 'MÓDULO INGLÉS VIII', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (153, 'ING-9', 'MÓDULO INGLÉS IX', 0, NULL, NULL, NULL);
INSERT INTO `cat_materias` VALUES (154, 'ING-10', 'MÓDULO INGLÉS X', 0, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for cat_opcion_curso
-- ----------------------------
DROP TABLE IF EXISTS `cat_opcion_curso`;
CREATE TABLE `cat_opcion_curso`  (
  `idopcion_curso` int(11) NOT NULL AUTO_INCREMENT,
  `desc_opcion_curso` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `desc_opcion_curso_corto` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idopcion_curso`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_opcion_curso
-- ----------------------------
INSERT INTO `cat_opcion_curso` VALUES (1, 'ORDINARIO', 'O');
INSERT INTO `cat_opcion_curso` VALUES (2, 'REPETICION', 'R');
INSERT INTO `cat_opcion_curso` VALUES (3, 'ESPECIAL', 'E');
INSERT INTO `cat_opcion_curso` VALUES (6, 'Dual', 'D');

-- ----------------------------
-- Table structure for cat_roles
-- ----------------------------
DROP TABLE IF EXISTS `cat_roles`;
CREATE TABLE `cat_roles`  (
  `idrol` int(11) NOT NULL,
  `desc_rol` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idrol`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_roles
-- ----------------------------
INSERT INTO `cat_roles` VALUES (1, 'Administrador');
INSERT INTO `cat_roles` VALUES (2, 'Serv. Escolares');
INSERT INTO `cat_roles` VALUES (3, 'Profesor');
INSERT INTO `cat_roles` VALUES (4, 'Div. Estudios');
INSERT INTO `cat_roles` VALUES (5, 'Estudiante');
INSERT INTO `cat_roles` VALUES (6, 'Consulta');

-- ----------------------------
-- Table structure for ciclo
-- ----------------------------
DROP TABLE IF EXISTS `ciclo`;
CREATE TABLE `ciclo`  (
  `idciclo` int(11) NOT NULL AUTO_INCREMENT,
  `desc_ciclo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  PRIMARY KEY (`idciclo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ciclo
-- ----------------------------
INSERT INTO `ciclo` VALUES (1, 'MAR - JUL 2021', 1, 2021, '2022-04-22 04:33:05', '2022-04-22 05:08:44', 'VIG');
INSERT INTO `ciclo` VALUES (2, 'AGO 21 - ENE 22', 2, 2021, '2021-08-13 20:29:58', '2021-08-13 20:29:58', 'VIG');
INSERT INTO `ciclo` VALUES (3, 'ENE - JUN 22', 4, 2022, '2022-02-01 03:38:28', '2022-06-17 11:18:14', 'VIG');

-- ----------------------------
-- Table structure for estudiantes
-- ----------------------------
DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes`  (
  `idestudiante` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_estudiante` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexo` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idcarrera` int(11) NOT NULL,
  `num_semestre` int(11) NULL DEFAULT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  PRIMARY KEY (`idestudiante`) USING BTREE,
  INDEX `fk_estudiantes_cat_carreras1_idx`(`idcarrera`) USING BTREE,
  CONSTRAINT `fk_estudiantes_cat_carreras1` FOREIGN KEY (`idcarrera`) REFERENCES `cat_carreras` (`idcarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of estudiantes
-- ----------------------------
INSERT INTO `estudiantes` VALUES ('151240020', 'ROMERO FLORES ROSA YULIANA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('151240043', 'GUTIERREZ GUTIERREZ ERICK DANIEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240002', 'CRUZ RAMOS ERICK FABIAN', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240003', 'GONZÁLEZ GIL ARTURO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240013', 'BOFIL PÉREZ EROS AUGUSTO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240014', 'RUEDA LÓPEZ LEONARDO GABRIEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240021', 'HERNÁNDEZ TORRES JUAN DANIEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240024', 'DOMÍNGUEZ GERÓNIMO DIANA IBETH', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240029', 'RICARDEZ GARCÍA JOSÉ FRANCISCO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240030', 'PATIÑO QUINTERO JULIA SAMANTHA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240031', 'SÁNCHEZ LÓPEZ EDUARDO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240033', 'VERA MORALES PAOLA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240039', 'GALLARDO DAVID ADRIAN ERNESTO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240042', 'PAZOS VILLEGAS GRECIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240053', 'MENA DE LA ROSA EYDER', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('161240056', 'HERNÁNDEZ CONCEPCIÓN JOSÉ ALBERTO', 'huimanguillo.tecnm.mx', 'M', 1, 11, '2021-12-09 21:53:25', '2021-12-09 21:53:25', 'VIG');
INSERT INTO `estudiantes` VALUES ('171240001', 'GAMAS PABLO NANCY BERENICE', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240002', 'TORRUCO CARRILLO GUSTAVO ÁNGEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240004', 'ZAPATA BALAN GABRIELA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240009', 'LÓPEZ JIMENÉZ ESTRELLITA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240011', 'HERNÁNDEZ CONCEPCIÓN OSIRIS', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240012', 'RAMÍREZ RODRÍGUEZ DANIEL ENRIQUE', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240014', 'VIDAL LEÓN VICTORIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240015', 'RAMOS MENDOZA MIGUEL ÁNGEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240016', 'LÓPEZ MORENO MARIA GUADALUPE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240017', 'PARDO LEYVA PABLO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240018', 'CUSTODIO DE LA ROSA FRANCISCO DEL CARMEN', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240019', 'JIMÉNEZ SALAYA GUSTAVO ALEJANDRO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240020', 'CARTAGENA SEGURA LUZ ESTHER', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240021', 'DOMÍNGUEZ ÁLVAREZ RUFINO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240022', 'LINARES VIDAÑA XENIA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240025', 'CRUZ JIMÉNEZ ROSA RACHEL', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240026', 'GARCÍA BARAHONA NANCY', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240027', 'GONZÁLEZ CANO ÁNGEL ANTONIO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240029', 'MÉNDEZ SANTIAGO MADELÍN', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240031', 'GONZÁLEZ URBINA FABIAN', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240032', 'CUPIDO PÉREZ BETHZAYDA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240034', 'LEÓN CADENA ÁNGEL ROSENDO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240035', 'SÁNCHEZ REYES CARLOS ANDERSON', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240037', 'CRUZ NOTARIO JONATHAN KENNEY', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240044', 'RAMÓN LARIOS LIZBETH SUSANA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('171240046', 'HERNÁNDEZ OLAN JESÚS DAVID', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240001', 'AGUIRRE LÓPEZ YESENIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240002', 'ARIAS TORRES MARÍA FERNANDA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240004', 'GARDUZA DE LA CRUZ NARCISO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240008', 'SÁNCHEZ PABLO ANA PATRICIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240012', 'CANO OLÁN MARÍA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240015', 'CANO LÓPEZ JIREHT SHIKARI', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240016', 'RUIZ TORRES PATSY MINELIZ', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240018', 'JÁCOME BASTIDA SALVADOR', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240023', 'CÓRDOVA CÓRDOVA ANTONIO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240026', 'NOTARIO HERRERA JESÚS MANUEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240028', 'MÉNDEZ VIDAL ENIX RUBI', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240031', 'CHAN ALEJANDRO IRVING UZIEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240032', 'PÉREZ CRUZ CARLOS AUGUSTO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240035', 'CASTRO QUE JOSÉ CARLOS', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240036', 'RAMÍREZ MORALES EMANUEL DEL CARMEN', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240040', 'GÓMEZ GÓMEZ HUMBERTO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240041', 'TIQUET RAMÍREZ LÁZARO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240043', 'LARA ADORNO JOSÉ TRINIDAD', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240046', 'TORRES JIMÉNEZ ANA LUCERO', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240048', 'CONCEPCIÓN SÁNCHEZ YULISSA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240051', 'LÓPEZ CÓRDOVA IVÁN', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240054', 'GAMAS COLLADO EMMANUEL', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240057', 'KU SALAYA KEVIN YANG', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240058', 'MÁRQUEZ GARCÍA JOSEFINA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240059', 'MONTIEL CUEVAS ÁNGEL RACIEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240061', 'IZQUIERDO MENA JOSMAR JOEY', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240063', 'RÁMIREZ OLAN JESSICA GUADALUPE', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240065', 'GONZÁLEZ GONZÁLEZ XIOMARA ITZEL', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240066', 'ISIDRO LUCAS JESÚS', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240068', 'ALPUCHE RAMOS DANIELA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240069', 'SOLIS ARELLANO ISRAEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240075', 'CORREA CADENA YULIANA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240076', 'LÓPEZ JIMÉNEZ JOSÉ MANUEL', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('181240082', 'SÁNCHEZ ADORNO ALICIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240002', 'ARCOS GONZÁLEZ VERONICA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240006', 'ESCOBAR SÁNCHEZ INGRID', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240014', 'LÓPEZ CRUZ JENNIFER', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240015', 'MARTINEZ DE ESCOBAR ESPINOZA PERLA RUBI', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240017', 'OCHOA JACINTO IRVING ALEXIS', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240018', 'ALEGRÍA DE LA ROSA MIRIAN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240021', 'POSADA HERRERA RODRIGO IVÁN', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240024', 'RIOS SÁNCHEZ GABRIEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240025', 'SALAYA CEFERINO ERIK ROBERTO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240027', 'SANCHEZ VALENZUELA DIEGO GUADALUPE', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240033', 'GARCÍA SÁNCHEZ ARISBETH GUADALUPE', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240035', 'JIMÉNEZ CRUZ RASHELL', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240038', 'NARANJO TORRUCO MERCEDES', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240039', 'NOTARIO HERRERA FERNANDO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240041', 'PALMA ÁLVAREZ RUBICEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240044', 'RUEDA RAMOS LEONEL ANTONIO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240045', 'RAMOS COLIN VICTOR MANUEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240047', 'VALENZUELA CÓRDOVA ÁNGELA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240049', 'GONZÁLEZ LÓPEZ ÁNGEL GABRIEL', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240050', 'HEREDIA MENDEZ FLOR YULISA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240051', 'HERNÁNDEZ BROCA ANTONIO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240052', 'HERNÁNDEZ PABLO RUBI CRISTHELL', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240055', 'PÉREZ VÁZQUEZ ALEXANDER', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240058', 'VÁZQUEZ CASTILLO GLORIA ARACELY', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240059', 'ALCUDIA JIMENEZ RICARDO ALBERTO', 'huimanguillo.tecnm.mx', 'M', 2, 3, '2021-09-07 09:47:06', '2021-09-07 09:47:06', 'VIG');
INSERT INTO `estudiantes` VALUES ('191240060', 'PARDO TOLEDO YAMILET', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240003', 'COLLADO BROCA VICTOR ANDRES', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240006', 'PIÑERA CRUZ CARLOS ARTURO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240007', 'ALPUCHE ROMERO ELIUD', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240008', 'GAMAS COLLADO MARIO ELIAS', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240015', 'HERRERA ROMERO NADIA CITLALI', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240018', 'LANDERO SÁNCHEZ NORBERTO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240022', 'REYES BECERRA ÁNGEL', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA', 'huimanguillo.tecnm.mx', 'F', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240034', 'CUSTODIO GARCÍA PRISCILA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240053', 'PÉREZ PÉREZ JACQUELINE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240055', 'REYES DE DIOS  HEIDY GISELLE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240056', 'ROSAS ORDOÑEZ ARTURO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240058', 'SANTIAGO ACOSTA MARLENE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240061', 'SOLANO MÉNDEZ CRISTIAN', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240067', 'VALENZUELA CARRETO KENIA LETICIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240068', 'VIDAL LEÓN LIZBETH', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240069', 'ZENTENO RAMÓN DAMIÁN', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240071', 'ALONSO GARCÍA DEYSI MARIA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240073', 'BARJAU VALIER BRAYAN', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240074', 'CASTILLO MARTÍNEZ ROBERTO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240078 ', 'RUIZ AGUILAR LEOPOLDO', 'huimanguillo.tecnm.mx', 'M', 4, 3, '2021-12-09 21:57:54', '2021-12-09 21:57:54', 'VIG');
INSERT INTO `estudiantes` VALUES ('201240079', 'CRUZ LÁZARO FRANCISCO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240080', 'CUPIDO CADENAS LUIS AMIR', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240081', 'CUPIDO CADENAS WILBERT ALI', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240084', 'ECHEVARRIA DE LA CRUZ EDWIN', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240090', 'GERÓNIMO VENTURA JAZMÍN', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240095', 'JIMÉNEZ URGELL JOSE JULIÁN', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240098', 'LÓPEZ SEGURA CRISTIAN AARON', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240108', 'CRUZ VÁZQUEZ HEBERT', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240112', 'CORNELIO SANTIAGO BRENDA ITZEL', 'huimanguillo.tecnm.mx', 'F', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240113', 'FACUNDO DE LA O JORGE', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240117', 'OLEA MENESES JUAN PABLO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240119', 'GUZMÁN PÉREZ TOMAS', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240120', 'MORALES CÓRDOBA ROBERTO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240124', 'YAÑEZ JIMÉNEZ JOSÉ LUIS', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240128', 'MORALES RODRÍGUEZ RAFAEL', 'huimanguillo.tecnm.mx', 'M', 1, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240129', 'ABASCAL SÁNCHEZ MELINA', 'masanchez@huimanguillo.tecnm.mx', 'F', 4, 1, '2022-06-17 11:17:04', '2022-06-17 11:17:04', 'VIG');
INSERT INTO `estudiantes` VALUES ('201240130', 'LÓPEZ CÓRDOVA JULIO ADRIAN', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240132', 'ALEMÁN ZAVALA GONZÁLO RAMÓN', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', 'huimanguillo.tecnm.mx', 'F', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('201240137', 'ÁLVAREZ SAN MARTÍN VICTOR MANUEL', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240001', 'MORENO GOMEZ DOLORES RAQUEL', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240003', 'LÓPEZ LÓPEZ MARÍA DEL ROSARIO', 'huimanguillo.tecnm.mx', 'F', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240004', 'DOMÍNGUEZ RAMOS IRVING', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240005', 'MORALES TOSCA BERENICE', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240006', 'SILVA ORAMAS ERNESTO ALONSO', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240008', 'VALENZUELA COLORADO DANIEL ALBERTO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240009', 'VERA ORTÍZ DULCE MARIA', 'huimanguillo.tecnm.mx', 'F', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240010', 'PRADO CRUZ JUAN MINERVO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240011', 'CALCANEO CARRETA ALLISON', 'huimanguillo.tecnm.mx', 'F', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240013', 'SALMERON VERA GUSTAVO', 'huimanguillo.tecnm.mx', 'M', 4, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240014', 'NOTARIO HAAS IRWIN GEOVANNI', 'huimanguillo.tecnm.mx', 'M', 2, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('211240020', 'GÓMEZ DE LA CRUZ HEYDI MARGARITA', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240021', 'ALEJANDRO HERNÁNDEZ ALFONSO', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240022', 'MARTINEZ GOMEZ FROYLAN', 'l211240022@huimanguillo.tecnm.mx', 'M', 2, 1, '2022-01-14 00:00:00', '2022-01-14 00:00:00', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240023', 'COLORADO GUTIÉRREZ JUDITH ALEJANDRA', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240024', 'LÓPEZ LÓPEZ MANUEL', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240025', 'PÉREZ RAMOS ROBERTO DE JESÚS', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240027', 'RAMÍREZ GUITIÉRREZ JUAN ELÍAS', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240028', 'MARTÍNEZ GONZÁLEZ HANNS VADIR', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240029', 'ROSALDO ALEJANDRO SHEYLA CRISTHELL', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240030', 'TORRES LEÓN JESÚS', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240031', 'CÁRDENAS BENÍTEZ ARLETHE ANAHÍ', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240032', 'HERNÁNDEZ JIMÉNEZ LIZBETH YURIDIA', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240034', 'NARANJO TORRUCO PERLA', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240035', 'DOMÍNGEZ CADENAS DIANA PAOLA', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240036', 'DIONISIO ÁLVAREZ LIZBETH DEL CARMEN', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240037', 'OSORIO ROMERO  DIANA PAOLA  ', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240038', 'TORRUCO OLÁN MARÍA GUADALUPE', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240039', 'CALVILLO BRITO ANA PAOLA', 'huimanguillo.tecnm.mx', 'F', 1, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240040', 'CRUZ TOVILLA MARÍA JESÚS', 'huimanguillo.tecnm.mx', 'F', 1, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240042', 'HERNÁNDEZ IZQUIERDO MARÍA GUADALUPE  ', 'huimanguillo.tecnm.mx', 'F', 1, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240043', 'MONTEJO BERNARDO LUIS ROBERTO', 'huimanguillo.tecnm.mx', 'M', 1, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240044', 'BERNARDO GONZÁLEZ JUAN MANUEL', 'huimanguillotecnm@com.mx', 'M', 1, 1, '2021-08-30 04:52:12', '2022-01-27 00:00:00', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240045', 'MENDOZA ACOSTA LIZBETH SUSANA', 'l211240045@huimanguillo.tecnm.mx', 'F', 1, 2, '2021-08-30 04:52:12', '2022-02-03 00:00:00', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240047', 'ESCUDERO CÓRDOVA ESTRELLA GUADALUPE ', 'huimanguillo.tecnm.mx', 'F', 1, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240048', 'CARRERA DÍAZ ITASHIANA', 'huimanguillo.tecnm.mx', 'F', 1, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240049', 'LÓPEZ MARTÍNEZ  SALIM SEBASTIÁN  ', 'huimanguillo.tecnm.mx', 'M', 1, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240051', 'ROSALDO SÁNHEZ JOSÉ JULIÁN', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240052', 'GERÓNIMO VENTURA MARÍA NELVA  ', 'huimanguillo.tecnm.mx', 'F', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240053', 'VENTURA  AGUILAR  ASUNCIÓN ', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240054', 'TORRES MADRIGAL ANI LEYDI', 'huimanguillo.tecnm.mx', 'F', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240055', 'DE LA CRUZ OLAN PRICILA', 'huimanguillo.tecnm.mx', 'F', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240057', 'JIMÉNEZ LINARES  KEVIN SEBASTIÁN  ', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240059', 'MARTÍNEZ TORRES MARCO ANTONIO', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240060', 'AGUILAR HERNÁNDEZ JUAN DIEGO', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240062', 'MARÍN ESCUDERO JUNIOR EMMANUEL', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240063', 'LÓPEZ MÉNDEZ YESENIA', 'huimanguillo.tecnm.mx', 'F', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240064', 'MORENO CÓRDOVA GUSTAVO EMILIANO', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240065', 'MÉNDEZ MURILLO MIGUEL IMANOL', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240068', 'PÉREZ PAREDES RODOLFO', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240069', 'ÁLVAREZ OSORIO GEOVANI', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240070', 'RODRÍGUEZ JIMÉNEZ  JESÚS EDUARDO', 'jerjimenez@huimanguillo.tecnm.mx', 'F', 4, 1, '2021-09-07 07:01:55', '2022-04-26 04:11:37', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240071', 'HERNÁNDEZ RAMOS JENNIFER IVETTE', 'huimanguillo.tecnm.mx', 'F', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240072', 'MENA RAMOS RUBÍ ESTELA', 'huimanguillo.tecnm.mx', 'F', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240073', 'RODRÍGUEZ DE LA CRUZ CARLOS ALBERTO', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240074', 'FACUNDO VILLALOBOS EMILIO  ', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240075', 'PALMA ALONSO OMAR', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240076', 'GARCÍA MIRANDA JOSÉ LUIS', 'huimanguillo.tecnm.mx', 'M', 4, 1, '2021-08-30 04:52:12', '2021-08-30 04:52:12', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240078', 'COLORADO GUTIÉRREZ EVA JAZMÍN', 'huimanguillo.tecnm.mx', 'F', 2, 1, '2022-01-13 16:51:52', '2022-01-13 16:51:52', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240080', 'ALEJANDRO JIMÈNEZ ADOLFO ÂNGEL', 'huimanguillo.tecnm.mx', 'M', 1, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240081', 'OLÁN PÉREZ OMAR', 'ooperez@huimanguillo.tecnm.mx', 'M', 2, 1, '2021-09-07 07:01:55', '2022-04-26 11:50:30', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240082', 'RODRÍGUEZ MORALES JONATHAN JESÚS', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240083', 'LÓPEZ GONZÁLEZ CLAUDIA PAOLA', 'huimanguillo.tecnm.mx', 'F', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240084', 'ACUÑA GUTIERREZ ÁNDRES', 'huimanguillo.tecnm.mx', 'M', 3, 1, '2021-09-07 07:01:55', '2021-09-07 07:01:55', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240085', 'GARCIA LOPEZ GABRIELA', 'L211240085@huimanguillo.tecnm.mx', 'F', 2, 1, '2022-01-14 00:00:00', '2022-01-14 00:00:00', 'VIG');
INSERT INTO `estudiantes` VALUES ('211240087', 'DE LA ROSA HERRERA JOSÉ JULIAN', 'huimanguillo.tecnm.mx', 'M', 2, 1, '2022-01-13 16:50:16', '2022-01-13 16:50:16', 'VIG');
INSERT INTO `estudiantes` VALUES ('220785', 'juan', 'jpere@pemex.com', 'M', 1, 1, '2022-06-16 08:44:28', NULL, 'VIG');
INSERT INTO `estudiantes` VALUES ('221240001', 'MONTIEL CUEVAS HECTOR MANUEL', 'l221240001@huimanguillo.tecnm.mx', 'M', 3, 1, '2022-02-01 00:00:00', NULL, 'VIG');
INSERT INTO `estudiantes` VALUES ('221240002', 'SÁNCHEZ RAMÍREZ NATANAEL', 'l221240002@huimanguillo.tecnm.mx', 'M', 4, 1, '2022-02-02 00:00:00', '2022-02-02 00:00:00', 'VIG');
INSERT INTO `estudiantes` VALUES ('221240003', 'ESCOBAR PALMA ERIKA GUADALUPE', 'l221240003@huimanguillo.tecnm.mx', 'F', 3, 1, '2022-02-02 00:00:00', NULL, 'VIG');
INSERT INTO `estudiantes` VALUES ('B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', 'huimanguillo.tecnm.mx', 'M', 3, NULL, NULL, NULL, NULL);
INSERT INTO `estudiantes` VALUES ('B16300482', 'LÓPEZ TORRES FATIMA GUADALUPE', 'lb16300482@huimanguillo.tecnm.mx', 'F', 3, 9, '2022-02-03 00:00:00', NULL, 'VIG');

-- ----------------------------
-- Table structure for grupos
-- ----------------------------
DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos`  (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `idciclo` int(11) NOT NULL,
  `num_semestre` int(11) NULL DEFAULT NULL,
  `idcarrera` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `idprofesor` int(11) NOT NULL,
  `desc_grupo_corto` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `desc_grupo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aula` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_envio_acta` datetime NULL DEFAULT NULL,
  `horario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lunes` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `martes` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `miercoles` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jueves` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `viernes` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sabado` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `observaciones` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idgrupo`) USING BTREE,
  INDEX `fk_grupos_ciclo1_idx`(`idciclo`) USING BTREE,
  INDEX `fk_grupos_profesores1_idx`(`idprofesor`) USING BTREE,
  INDEX `fk_grupos_cat_materias1_idx`(`idmateria`) USING BTREE,
  INDEX `fk_grupos_cat_carreras1_idx`(`idcarrera`) USING BTREE,
  CONSTRAINT `fk_grupos_cat_carreras1` FOREIGN KEY (`idcarrera`) REFERENCES `cat_carreras` (`idcarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_cat_materias1` FOREIGN KEY (`idmateria`) REFERENCES `cat_materias` (`idmateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_ciclo1` FOREIGN KEY (`idciclo`) REFERENCES `ciclo` (`idciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_profesores1` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 323 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grupos
-- ----------------------------
INSERT INTO `grupos` VALUES (1, 1, NULL, 3, 1, 16, 'A', 'VI A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (2, 1, NULL, 3, 2, 16, 'A', 'II A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (3, 1, NULL, 2, 3, 9, 'A', 'IV A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (4, 1, NULL, 3, 4, 7, 'A', 'VIII A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (5, 1, NULL, 3, 5, 7, 'A', 'VIII A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (6, 1, NULL, 3, 6, 7, 'A', 'VI A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (7, 1, NULL, 1, 7, 8, 'A', 'IV A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (8, 1, NULL, 3, 8, 8, 'A', 'II A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (9, 1, NULL, 3, 9, 7, 'A', 'IV A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (10, 1, NULL, 3, 10, 7, 'A', 'IV A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (11, 1, NULL, 3, 11, 16, 'A', 'II A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (12, 1, NULL, 3, 12, 16, 'A', 'VI A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (13, 1, NULL, 3, 13, 21, 'A', 'VIII A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (14, 1, NULL, 3, 14, 21, 'A', 'VIII A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (15, 1, NULL, 2, 15, 15, 'A', 'IV A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (16, 1, NULL, 2, 16, 15, 'A', 'VI A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (17, 1, NULL, 4, 17, 15, 'A', 'II A IPET MIXTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (18, 1, NULL, 4, 18, 15, 'A', 'II A IPET MIXTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (19, 1, NULL, 3, 18, 2, 'A', 'II A   IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (20, 1, NULL, 2, 19, 2, 'A', 'IV A   ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (21, 1, NULL, 1, 20, 25, 'A', 'IV A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (22, 1, NULL, 3, 21, 19, 'A', 'IV A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (23, 1, NULL, 1, 22, 19, 'A', 'II A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (24, 1, NULL, 2, 23, 19, 'A', 'II A  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (25, 1, NULL, 3, 23, 19, 'A', 'II A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (26, 1, NULL, 4, 24, 5, 'A', 'II A IPET MIXTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (27, 1, NULL, 2, 25, 5, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (28, 1, NULL, 2, 26, 5, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (29, 1, NULL, 3, 24, 5, 'A', 'II A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (30, 1, NULL, 2, 27, 25, 'A', 'VI A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (31, 1, NULL, 2, 28, 25, 'A', 'V A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (32, 1, NULL, 3, 29, 25, 'A', 'IV A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (33, 1, NULL, 2, 30, 11, 'A', 'II A  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (34, 1, NULL, 2, 31, 3, 'A', 'IV A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (35, 1, NULL, 2, 32, 3, 'A', 'IV A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (36, 1, NULL, 2, 33, 3, 'A', 'VI A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (37, 1, NULL, 2, 34, 3, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (38, 1, NULL, 1, 35, 18, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (39, 1, NULL, 1, 36, 18, 'A', 'II A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (40, 1, NULL, 1, 37, 18, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (41, 1, NULL, 2, 38, 13, 'A', 'IV A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (42, 1, NULL, 2, 39, 13, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (43, 1, NULL, 1, 12, 13, 'A', 'VIII A IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (44, 1, NULL, 1, 40, 12, 'A', 'II A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (45, 1, NULL, 1, 41, 12, 'A', 'II A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (46, 1, NULL, 1, 42, 12, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (47, 1, NULL, 3, 43, 17, 'A', 'IV A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (48, 1, NULL, 1, 44, 17, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (49, 1, NULL, 2, 45, 4, 'A', 'II A  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (50, 1, NULL, 3, 46, 17, 'A', 'IV A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (51, 1, NULL, 1, 47, 17, 'A', 'II A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (52, 1, NULL, 2, 48, 4, 'A', 'IIA  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (53, 1, NULL, 2, 49, 4, 'A', 'VI A  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (54, 1, NULL, 3, 50, 4, 'A', 'VI A  IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (55, 1, NULL, 2, 51, 10, 'A', 'II A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (56, 1, NULL, 2, 52, 10, 'A', 'VI A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (57, 1, NULL, 2, 53, 10, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (58, 1, NULL, 2, 54, 10, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (59, 1, NULL, 1, 55, 1, 'A', 'IV A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (60, 1, NULL, 1, 56, 1, 'A', 'IV A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (61, 1, NULL, 1, 57, 1, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (62, 1, NULL, 1, 58, 1, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (63, 1, NULL, 1, 59, 20, 'A', 'IV A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (64, 1, NULL, 1, 60, 24, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (65, 1, NULL, 1, 61, 24, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (66, 1, NULL, 1, 62, 24, 'A', 'VI A  IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (67, 1, NULL, 3, 63, 9, 'A', 'IV A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (68, 1, NULL, 3, 64, 9, 'A', 'VI A IPET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (69, 1, NULL, 2, 65, 22, 'A', 'IV A  ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (70, 1, NULL, 2, 66, 23, 'A', 'VIII A ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (71, 1, NULL, 2, 67, 2, 'A', 'VI A   ILOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (72, 1, NULL, 1, 68, 2, 'A', 'II A   IIAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (73, 1, NULL, 4, 2, 16, 'A', 'III A IPET MIXTA', '', '2021-09-01 03:32:04', '', '', '', '', '', '', '', NULL);
INSERT INTO `grupos` VALUES (74, 1, NULL, 4, 8, 8, 'A', 'II A  IPET MIXTA', '', '2021-09-01 03:32:04', '', '', '', '', '', '', '', NULL);
INSERT INTO `grupos` VALUES (75, 1, NULL, 4, 11, 16, 'A', 'III A IPET MIXTA', '', '2021-09-01 03:32:04', '', '', '', '', '', '', '', NULL);
INSERT INTO `grupos` VALUES (101, 2, 1, 1, 69, 22, NULL, '1-IAS', NULL, NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '', '', '', NULL);
INSERT INTO `grupos` VALUES (102, 2, 7, 2, 70, 23, NULL, '7-LOG', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', '', NULL);
INSERT INTO `grupos` VALUES (103, 2, 5, 2, 71, 14, NULL, '5-LOG', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (104, 2, 3, 3, 72, 14, NULL, '3-PET', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '', '', '', NULL);
INSERT INTO `grupos` VALUES (105, 2, 7, 1, 73, 20, NULL, '7-IAS', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (106, 2, 3, 1, 74, 20, NULL, '3-IAS', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (107, 2, 5, 1, 75, 1, NULL, '5- IAS', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL);
INSERT INTO `grupos` VALUES (108, 2, 5, 1, 76, 1, NULL, '5- IAS', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (109, 2, 1, 3, 22, 19, NULL, '1-PET 1 ILOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (110, 2, 1, 2, 22, 19, NULL, '1-PET 1 ILOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (111, 2, 3, 3, 77, 19, NULL, '3-PET', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', '', NULL);
INSERT INTO `grupos` VALUES (112, 2, 3, 1, 17, 19, NULL, '3-IAS', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (113, 2, 3, 4, 77, 19, NULL, '3-PET- MAX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (114, 2, 1, 4, 22, 19, NULL, '1-PET- MAX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (115, 2, 3, 3, 78, 15, NULL, '3-PET', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (116, 2, 3, 2, 79, 15, NULL, '3-LOG', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', '', NULL);
INSERT INTO `grupos` VALUES (117, 2, 7, 2, 16, 15, NULL, '7-LOG', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', NULL);
INSERT INTO `grupos` VALUES (118, 2, 3, 4, 78, 15, NULL, '3-PET- MAX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (119, 2, 1, 2, 80, 6, NULL, '1-LOG', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (120, 2, 5, 2, 81, 6, NULL, '5-LOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', '', NULL);
INSERT INTO `grupos` VALUES (121, 2, 5, 3, 82, 2, NULL, '5-PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', '', NULL);
INSERT INTO `grupos` VALUES (122, 2, 3, 2, 18, 2, NULL, '3-LOG - 1 IAS', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (123, 2, 1, 1, 18, 2, NULL, '3-LOG - 1 IAS', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (124, 2, 3, 2, 83, 2, NULL, '3-LOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (125, 2, 7, 2, 67, 2, NULL, '7-LOG', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (126, 2, 1, 2, 84, 10, NULL, '1-LOG', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', '', NULL);
INSERT INTO `grupos` VALUES (127, 2, 3, 2, 85, 10, NULL, '3-LOG', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL);
INSERT INTO `grupos` VALUES (128, 2, 7, 2, 86, 10, NULL, '7-LOG', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (129, 2, 7, 2, 87, 10, NULL, '7-LOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (130, 2, 7, 1, 88, 1, NULL, '7-IAS', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (131, 2, 5, 3, 37, 4, NULL, '5-PET', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', '', NULL);
INSERT INTO `grupos` VALUES (132, 2, 7, 3, 89, 4, NULL, '7-PET-IAS-LOG', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', '', NULL);
INSERT INTO `grupos` VALUES (133, 2, 7, 1, 89, 4, NULL, '7-PET-IAS-LOG', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', '', NULL);
INSERT INTO `grupos` VALUES (134, 2, 7, 2, 89, 4, NULL, '7-PET-IAS-LOG', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', '', NULL);
INSERT INTO `grupos` VALUES (135, 2, 1, 1, 30, 4, NULL, '1-IAS - 1 PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', '', NULL);
INSERT INTO `grupos` VALUES (136, 2, 1, 3, 30, 4, NULL, '1-IAS - 1 PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', '', NULL);
INSERT INTO `grupos` VALUES (137, 2, 1, 3, 90, 26, NULL, '1-PET', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (138, 2, 5, 3, 91, 13, NULL, '5-PET', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (139, 2, 3, 1, 92, 13, NULL, '3-IAS', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '', '', '', NULL);
INSERT INTO `grupos` VALUES (140, 2, 3, 1, 93, 13, NULL, '3-IAS', NULL, NULL, NULL, '14:00-16:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '', NULL);
INSERT INTO `grupos` VALUES (141, 2, 3, 2, 94, 4, NULL, '3-ILOG', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', NULL);
INSERT INTO `grupos` VALUES (142, 2, 3, 2, 95, 9, NULL, '3-LOG', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL);
INSERT INTO `grupos` VALUES (143, 2, 5, 3, 96, 9, NULL, '5-PET', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (144, 2, 1, 1, 97, 9, NULL, '1-IAS', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', '', NULL);
INSERT INTO `grupos` VALUES (145, 2, 5, 1, 98, 18, NULL, '5-IAS', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (146, 2, 5, 1, 99, 18, NULL, '5-IAS', NULL, NULL, NULL, '14:00-16:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '', NULL);
INSERT INTO `grupos` VALUES (147, 2, 5, 2, 100, 25, NULL, '5-LOG', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (148, 2, 3, 1, 101, 25, NULL, '3-IAS', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL);
INSERT INTO `grupos` VALUES (149, 2, 1, 4, 90, 25, NULL, '1-PET-MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (150, 2, 1, 2, 102, 3, NULL, '1-LOG', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', '', NULL);
INSERT INTO `grupos` VALUES (151, 2, 7, 1, 103, 3, NULL, '7-IAS', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (152, 2, 3, 4, 72, 3, NULL, '3-PET-MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (153, 2, 7, 3, 104, 21, NULL, '7-PET', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL);
INSERT INTO `grupos` VALUES (154, 2, 1, 3, 105, 21, NULL, '1-PET', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (155, 2, 7, 3, 106, 21, NULL, '7-PET', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (156, 2, 5, 1, 46, 17, NULL, '5-IAS', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL);
INSERT INTO `grupos` VALUES (157, 2, 3, 1, 107, 17, NULL, '3-IAS', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (158, 2, 1, 3, 108, 17, NULL, '1-PET', NULL, NULL, NULL, '13:00-15:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (159, 2, 1, 4, 108, 17, NULL, '1-PET- MAX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (160, 2, 1, 1, 109, 17, NULL, '1-IAS', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (161, 2, 1, 1, 48, 11, NULL, '1-IAS/PET', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (162, 2, 1, 3, 48, 11, NULL, '1-IAS/PET', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', '', NULL);
INSERT INTO `grupos` VALUES (163, 2, 1, 4, 48, 11, NULL, '1-PET-MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (164, 2, 1, 4, 30, 11, NULL, '1-PET-MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (165, 2, 1, 1, 110, 8, NULL, '1-IAS', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (166, 2, 3, 1, 111, 8, NULL, '3-IAS', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL);
INSERT INTO `grupos` VALUES (167, 2, 5, 1, 112, 8, NULL, '5-IAS', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (168, 2, 1, 2, 113, 8, NULL, '1-LOG', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', NULL);
INSERT INTO `grupos` VALUES (170, 2, 5, 1, 114, 12, NULL, '5-IAS', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (171, 2, 7, 1, 115, 12, NULL, '7-IAS', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (172, 2, 7, 1, 116, 12, NULL, '7-IAS', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL);
INSERT INTO `grupos` VALUES (173, 2, 3, 3, 117, 12, NULL, '3-PET', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (174, 2, 3, 4, 117, 12, NULL, '3-PET-MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (175, 2, 7, 3, 118, 7, NULL, '7-PET', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL);
INSERT INTO `grupos` VALUES (176, 2, 7, 3, 119, 7, NULL, '7-PET', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (177, 2, 5, 3, 120, 7, NULL, '5-PET', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL);
INSERT INTO `grupos` VALUES (178, 2, 3, 3, 121, 7, NULL, '3-PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL);
INSERT INTO `grupos` VALUES (179, 2, 3, 4, 121, 7, NULL, '3-PET- MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 2', NULL);
INSERT INTO `grupos` VALUES (180, 2, 7, 3, 122, 16, NULL, '7-PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (181, 2, 3, 3, 123, 16, NULL, '3-PET', NULL, NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL);
INSERT INTO `grupos` VALUES (182, 2, 3, 4, 123, 16, NULL, '3-PET- MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (183, 2, 5, 3, 124, 16, NULL, '5-PET', NULL, NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL);
INSERT INTO `grupos` VALUES (184, 2, 5, 2, 125, 16, NULL, '5-LOG', NULL, NULL, NULL, '09:00-10:00 11:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL);
INSERT INTO `grupos` VALUES (185, 2, 7, 2, 126, 5, NULL, '7-LOG', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', '', NULL);
INSERT INTO `grupos` VALUES (186, 2, 1, 2, 127, 5, NULL, '1-LOG', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', '', NULL);
INSERT INTO `grupos` VALUES (187, 2, 5, 2, 128, 5, NULL, '5-LOG', NULL, NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', NULL);
INSERT INTO `grupos` VALUES (188, 2, 1, 4, 105, 0, NULL, '1-PET- MIX', NULL, NULL, NULL, '', '', '', '', '', 'TRIMESTRE 1', NULL);
INSERT INTO `grupos` VALUES (189, 2, 9, 1, 129, 0, NULL, '9-IAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (190, 2, 9, 2, 129, 0, NULL, '9-PET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (191, 2, 9, 3, 129, 0, NULL, '9-LOG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (192, 2, 9, 2, 53, 6, NULL, '9-LOG', NULL, NULL, NULL, '08:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (193, 2, 9, 2, 34, 14, NULL, '9-LOG', NULL, NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (194, 2, 9, 2, 19, 25, NULL, '4-LOG', NULL, NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (195, 2, 8, 3, 87, 3, NULL, '8-PET', NULL, NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (196, 2, 4, 2, 130, 15, NULL, '4-PET', NULL, NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (197, 2, 6, 3, 10, 9, NULL, '6-PET', NULL, NULL, NULL, '11:00-12:00 ', '11:00-12:00 ', '11:00-12:00 ', '11:00-12:00 ', '11:00-12:00 ', NULL, NULL);
INSERT INTO `grupos` VALUES (198, 2, 2, 3, 11, 16, NULL, '2-PET', NULL, NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (199, 2, 1, 4, 105, 7, NULL, '1-PET-MIX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `grupos` VALUES (200, 3, 2, 2, 48, 11, NULL, 'II-ILOG', '10', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (201, 3, 2, 2, 17, 19, NULL, 'II-ILOG', '10', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (202, 3, 2, 2, 137, 25, NULL, 'II-ILOG', '10', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (203, 3, 2, 2, 45, 5, NULL, 'II-ILOG', '10', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (204, 3, 2, 2, 30, 11, NULL, 'II-ILOG', '10', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (205, 3, 2, 2, 51, 10, NULL, 'II-ILOG', '10', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (206, 3, 2, 2, 132, 6, NULL, 'II-ILOG', '', NULL, NULL, '', '', '', '', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (207, 3, 4, 2, 15, 5, NULL, 'IV-ILOG', '11', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (208, 3, 4, 2, 31, 3, NULL, 'IV-ILOG', '11', NULL, NULL, '13:00-14:00', '13:00-14:01', '13:00-14:02', '13:00-14:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (209, 3, 4, 2, 19, 2, NULL, 'IV-ILOG', '11', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (210, 3, 4, 2, 3, 9, NULL, 'IV-ILOG', '11', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (211, 3, 4, 2, 32, 10, NULL, 'IV-ILOG', '11', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (212, 3, 4, 2, 65, 22, NULL, 'IV-ILOG', '11', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (213, 3, 6, 2, 138, 15, NULL, 'VI-ILOG', '12', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (214, 3, 6, 2, 38, 13, NULL, 'VI-ILOG', '12', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (215, 3, 6, 2, 67, 15, NULL, 'VI-ILOG', '12', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (216, 3, 6, 2, 46, 17, NULL, 'VI-ILOG', '12', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (217, 3, 6, 2, 52, 2, NULL, 'VI-ILOG', '12', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (218, 3, 6, 2, 37, 4, NULL, 'VI-ILOG', '12', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (219, 3, 8, 2, 39, 6, NULL, 'VIII-ILOG', '13', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (220, 3, 8, 2, 66, 23, NULL, 'VIII-ILOG', '13', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (221, 3, 8, 2, 25, 28, NULL, 'VIII-ILOG', '13', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (222, 3, 8, 2, 26, 3, NULL, 'VIII-ILOG', '13', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (223, 3, 8, 2, 54, 10, NULL, 'VIII-ILOG', '13', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (224, 3, 8, 2, 53, 10, NULL, 'VIII-ILOG', '13', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '12:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (225, 3, 9, 2, 129, 29, NULL, 'IX-ILOG', '', NULL, NULL, '', '', '', '', '', NULL, NULL);
INSERT INTO `grupos` VALUES (230, 3, 2, 1, 22, 19, NULL, 'II-IIAS', '4', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (231, 3, 2, 1, 40, 8, NULL, 'II-IIAS', '4', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (232, 3, 2, 1, 41, 12, NULL, 'II-IIAS', '4', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (233, 3, 2, 1, 47, 17, NULL, 'II-IIAS', '4', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (234, 3, 2, 1, 36, 18, NULL, 'II-IIAS', '4', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (235, 3, 2, 1, 68, 2, NULL, 'II-IIAS', '4', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (236, 3, 2, 1, 133, 12, NULL, 'II-IIAS', '', NULL, NULL, '', '', '', '', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (237, 3, 2, 1, 133, 13, NULL, 'II-IIAS', '', NULL, NULL, '', '', '', '', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (238, 3, 4, 1, 134, 13, NULL, 'IV-IIAS', '5', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (239, 3, 4, 1, 55, 28, NULL, 'IV-IIAS', '5', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (240, 3, 4, 1, 59, 20, NULL, 'IV-IIAS', '5', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (241, 3, 4, 1, 56, 28, NULL, 'IV-IIAS', '5', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (242, 3, 4, 1, 7, 8, NULL, 'IV-IIAS', '5', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (243, 3, 4, 1, 20, 26, NULL, 'IV-IIAS', '5', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (244, 3, 6, 1, 44, 4, NULL, 'VI-IIAS', '6', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (245, 3, 6, 1, 42, 12, NULL, 'VI-IIAS', '6', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (246, 3, 6, 1, 57, 17, NULL, 'VI-IIAS', '6', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (247, 3, 6, 1, 58, 28, NULL, 'VI-IIAS', '6', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (248, 3, 6, 1, 35, 18, NULL, 'VI-IIAS', '6', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (249, 3, 6, 1, 37, 4, NULL, 'VI-IIAS', '6', NULL, NULL, '8:00-9:00', '8:00-9:00', '8:00-9:00', '8:00-9:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (250, 3, 8, 1, 62, 12, NULL, 'VIII-IIAS', '7', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (251, 3, 8, 1, 135, 12, NULL, 'VIII-IIAS', '7', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (252, 3, 8, 1, 60, 1, NULL, 'VIII-IIAS', '7', NULL, NULL, '08:00-09:00', '', '', '08:00-09:00', '11:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (253, 3, 9, 1, 129, 28, 'sdf', 'IXIIAS', 'sdf', NULL, '', '12:00', '', '', '', '', '', NULL);
INSERT INTO `grupos` VALUES (260, 3, 2, 3, 8, 28, NULL, 'II-IPET', '1', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-9:00 y 12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (261, 3, 2, 3, 17, 19, NULL, 'II-IPET', '1', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (262, 3, 2, 3, 18, 2, NULL, 'II-IPET', '1', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (263, 3, 2, 3, 11, 16, NULL, 'II-IPET', '1', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (264, 3, 2, 3, 2, 15, NULL, 'II-IPET', '1', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (265, 3, 2, 3, 24, 6, NULL, 'II-IPET', '1', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '', '', NULL, NULL);
INSERT INTO `grupos` VALUES (266, 3, 2, 3, 133, 14, NULL, 'II-IPET', '1', NULL, NULL, '', '', '', '13:00-14:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (267, 3, 4, 3, 29, 25, NULL, 'IV-IPET', '2', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (268, 3, 4, 3, 43, 17, NULL, 'IV-IPET', '2', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (269, 3, 4, 3, 63, 9, NULL, 'IV-IPET', '2', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (270, 3, 4, 3, 9, 7, NULL, 'IV-IPET', '2', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (271, 3, 4, 3, 21, 28, NULL, 'IV-IPET', '2', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (272, 3, 4, 3, 46, 17, NULL, 'IV-IPET', '2', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (273, 3, 6, 3, 6, 28, NULL, 'VI-IPET', '3', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (274, 3, 6, 3, 10, 7, NULL, 'VI-IPET', '3', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (275, 3, 6, 3, 50, 4, NULL, 'VI-IPET', '3', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '', '', NULL, NULL);
INSERT INTO `grupos` VALUES (276, 3, 6, 3, 1, 16, NULL, 'VI-IPET', '3', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '', NULL, NULL);
INSERT INTO `grupos` VALUES (277, 3, 6, 3, 64, 9, NULL, 'VI-IPET', '3', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (278, 3, 6, 3, 12, 16, NULL, 'VI-IPET', '3', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (279, 3, 8, 3, 139, 16, NULL, 'VIII-IPET', '8', NULL, NULL, '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', '08:00-09:00', NULL, NULL);
INSERT INTO `grupos` VALUES (280, 3, 8, 3, 13, 21, NULL, 'VIII-IPET', '8', NULL, NULL, '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', '10:00-11:00', NULL, NULL);
INSERT INTO `grupos` VALUES (281, 3, 8, 3, 14, 21, NULL, 'VIII-IPET', '8', NULL, NULL, '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', '11:00-12:00', NULL, NULL);
INSERT INTO `grupos` VALUES (282, 3, 8, 3, 5, 28, NULL, 'VIII-IPET', '8', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-14:00', NULL, NULL);
INSERT INTO `grupos` VALUES (283, 3, 8, 3, 4, 7, NULL, 'VIII-IPET', '8', NULL, NULL, '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-14:00', '13:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (284, 3, 8, 3, 140, 16, NULL, 'VIII-IPET', '8', NULL, NULL, '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', '09:00-10:00', NULL, NULL);
INSERT INTO `grupos` VALUES (285, 3, 9, 3, 136, 14, NULL, 'IX-IPET', '', NULL, NULL, '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', '12:00-13:00', NULL, NULL);
INSERT INTO `grupos` VALUES (286, 3, 9, 3, 129, 29, NULL, 'IX-IPET', '', NULL, NULL, '', '', '', '', '', NULL, NULL);
INSERT INTO `grupos` VALUES (291, 3, 1, 1, 145, 28, NULL, 'IIAS', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (292, 3, 1, 2, 145, 28, NULL, 'ILOG', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (293, 3, 1, 3, 145, 28, NULL, 'IPET', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (294, 3, 1, 1, 146, 28, NULL, 'IIAS', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (295, 3, 1, 2, 146, 28, NULL, 'ILOG', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (296, 3, 1, 3, 146, 28, NULL, 'IPET', '11', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (297, 3, 2, 1, 147, 28, NULL, 'IIAS', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (298, 3, 2, 2, 147, 28, NULL, 'ILOG', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (299, 3, 2, 3, 147, 28, NULL, 'IPET', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (300, 3, 2, 1, 148, 28, NULL, 'IIAS', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (301, 3, 2, 2, 148, 28, NULL, 'ILOG', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (302, 3, 2, 3, 148, 28, NULL, 'IPET', 'LAB. DE CÓMPUTO', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (303, 3, 4, 1, 149, 28, NULL, 'IIAS', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (304, 3, 4, 2, 149, 28, NULL, 'ILOG', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (305, 3, 4, 3, 149, 28, NULL, 'IPET', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (306, 3, 4, 1, 150, 28, NULL, 'IIAS', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (307, 3, 4, 2, 150, 28, NULL, 'ILOG', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (308, 3, 4, 3, 150, 28, NULL, 'IPET', 'AULA HÍBRIDA', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (309, 3, 6, 1, 151, 28, NULL, 'IIAS', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (310, 3, 6, 2, 151, 28, NULL, 'ILOG', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (311, 3, 6, 3, 151, 28, NULL, 'IPET', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (312, 3, 6, 1, 152, 28, NULL, 'IIAS', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (313, 3, 6, 2, 152, 28, NULL, 'ILOG', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (314, 3, 6, 3, 152, 28, NULL, 'IPET', '13', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (315, 3, 8, 1, 153, 28, NULL, 'IIAS', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (316, 3, 8, 2, 153, 28, NULL, 'ILOG', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (317, 3, 8, 3, 153, 28, NULL, 'IPET', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (318, 3, 8, 1, 154, 28, NULL, 'IIAS', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (319, 3, 8, 2, 154, 28, NULL, 'ILOG', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);
INSERT INTO `grupos` VALUES (320, 3, 8, 3, 154, 28, NULL, 'IPET', '12', NULL, NULL, '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', '14:00-15:00', NULL, NULL);

-- ----------------------------
-- Table structure for grupos_estudiantes
-- ----------------------------
DROP TABLE IF EXISTS `grupos_estudiantes`;
CREATE TABLE `grupos_estudiantes`  (
  `idgrupo` int(11) NOT NULL,
  `idestudiante` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idopcion_curso` int(11) NOT NULL,
  `p1` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p2` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p3` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p4` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p5` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p6` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p7` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p8` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `p9` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp1` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp2` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp3` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp4` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp5` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp6` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp7` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp8` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sp9` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s1` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s2` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s3` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s4` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s5` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s6` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s7` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s8` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `s9` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  `idciclo` int(11) NULL DEFAULT NULL,
  `idgrupoidestudiante` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idgrupo`, `idestudiante`) USING BTREE,
  INDEX `fk_grupos_estudiantes_cat_opcion_curso1_idx`(`idopcion_curso`) USING BTREE,
  INDEX `fk_grupos_estudiantes_estudiantes1_idx`(`idestudiante`) USING BTREE,
  INDEX `fk_grupos_estudiantes_grupos1_idx`(`idgrupo`) USING BTREE,
  CONSTRAINT `fk_grupos_estudiantes_cat_opcion_curso1` FOREIGN KEY (`idopcion_curso`) REFERENCES `cat_opcion_curso` (`idopcion_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_estudiantes_estudiantes1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiantes` (`idestudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_estudiantes_grupos1` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grupos_estudiantes
-- ----------------------------
INSERT INTO `grupos_estudiantes` VALUES (201, '151240020', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-19 11:09:04', '2022-06-19 11:09:04', 'VIG', 3, '201151240020');
INSERT INTO `grupos_estudiantes` VALUES (261, '151240043', 1, '78', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '80', '', '', '', '', '', '', '', '', '2022-06-19 11:09:26', '2022-06-19 11:09:26', 'VIG', 3, '261151240043');
INSERT INTO `grupos_estudiantes` VALUES (261, '161240002', 1, '75', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '86', '', '', '', '', '', '', '', '', '2022-06-19 11:10:49', '2022-06-19 11:10:49', 'VIG', 3, '261161240002');

-- ----------------------------
-- Table structure for migracion_actas
-- ----------------------------
DROP TABLE IF EXISTS `migracion_actas`;
CREATE TABLE `migracion_actas`  (
  `no` int(11) NOT NULL,
  `cve` varchar(130) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pqt` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mat` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `crd` int(11) NULL DEFAULT NULL,
  `genero` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `control` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `edual` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aut` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rep` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `esp` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `po` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `so` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idprofesor` int(11) NULL DEFAULT NULL,
  `cve_materia` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `carrera` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idcarrera` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `materia` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idmateria` int(11) NULL DEFAULT NULL,
  `idgrupo` int(11) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migracion_actas
-- ----------------------------
INSERT INTO `migracion_actas` VALUES (1, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '', '90', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (2, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '96', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (3, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '95', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (4, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '93', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (5, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '89', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (6, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '95', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (7, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '', '85', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (8, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '', '', '', '90', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (9, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '94', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (10, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '', '76', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (11, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '93', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (12, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '', '80', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (13, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '', '75', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (14, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '*', '', '', 'NA', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (15, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'M', '151240043', 'GUTIERREZ GUTIERREZ ERICK DANIEL', '', '', '', '', '81', '', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (16, 'PRODUCTIVIDAD DE POZOS  PEA-1023', 'VI A IPET', 'PRODUCTIVIDAD DE POZOS  ', 4, 'F', '171240001', 'GAMAS PABLO NANCY BERENICE', '', '', '', '', '', 'NA', 16, 'PEA-1023', 'IPET', '3', 'PRODUCTIVIDAD DE POZOS  ', 1, 1);
INSERT INTO `migracion_actas` VALUES (1, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', '', 'NA', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (2, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '93', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (3, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '94', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (4, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '', '88', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (5, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '91', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (6, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'NA', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (7, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '', '81', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (8, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', '', '81', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (9, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'NA', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (10, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', '', '76', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (11, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '93', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (12, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '91', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (13, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'NA', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (14, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '85', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (15, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '', '79', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (16, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '97', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (17, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', '86', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (18, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '', '86', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (19, 'ESTÁTICA  PED-1011', 'II A  IPET', 'ESTÁTICA  ', 5, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'NA', '', 16, 'PED-1011', 'IPET', '3', 'ESTÁTICA  ', 2, 2);
INSERT INTO `migracion_actas` VALUES (1, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (2, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (3, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (4, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (5, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (6, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (7, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (8, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (9, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (10, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (11, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (12, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '73', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (13, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (14, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (15, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (16, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (17, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'F', '181240028', 'MÉNDEZ VIDAL ENIX RUBI', '', '', '*', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (18, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '181240059', 'MONTIEL CUEVAS ÁNGEL RACIEL', '', '', '', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (19, 'TÓPICOS DE INGENIERÍA MECÁNICA  LOF-0930', 'IV A ILOG', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 5, 'M', '181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', '', '', '*', '', '90', '', 9, 'LOF-0930', 'ILOG', '2', 'TÓPICOS DE INGENIERÍA MECÁNICA  ', 3, 3);
INSERT INTO `migracion_actas` VALUES (1, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'M', '171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', '', '', '', '', '87', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (2, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'M', '171240037', 'CRUZ NOTARIO JONATHAN KENNEY', '', '', '', '', '93', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (3, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'M', '171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', '', '', '', '', '73', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (4, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'F', '171240001', 'GAMAS PABLO NANCY BERENICE', '', '', '', '', 'NA', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (5, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'M', '171240012', 'RAMÍREZ RODRÍGUEZ DANIEL ENRIQUE', '', '', '', '', 'NA', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (6, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'M', '171240002', 'TORRUCO CARRILLO GUSTAVO ÁNGEL', '', '', '', '', '97', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (7, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'F', '161240030', 'PATIÑO QUINTERO JULIA SAMANTHA', '', '', '', '', '92', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (8, 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  PRJ-1805', 'VIII A  IPET', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 6, 'F', '161240033', 'VERA MORALES PAOLA DEL CARMEN', '', '', '', '', '94', '', 7, 'PRJ-1805', 'IPET', '3', 'ADMINISTRACIÓN INTEGRAL DE YACIMIENTOS  ', 4, 4);
INSERT INTO `migracion_actas` VALUES (1, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', '', '', '', '', '86', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (2, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '171240037', 'CRUZ NOTARIO JONATHAN KENNEY', '', '', '', '', '94', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (3, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', '', '', '', '', '78', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (4, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '171240012', 'RAMÍREZ RODRÍGUEZ DANIEL ENRIQUE', '', '', '', '', 'NA', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (5, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '171240002', 'TORRUCO CARRILLO GUSTAVO ÁNGEL', '', '', '', '', '98', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (6, 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   PRJ-1804', 'VIII A  IPET', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 6, 'M', '161240002', 'CRUZ RAMOS ERICK FABIAN', '', '', '', '', '93', '', 7, 'PRJ-1804', 'IPET', '3', 'CARACTERIZACIÓN ESTÁTICA Y DINÁMICA DE YACIMIENTOS   ', 5, 5);
INSERT INTO `migracion_actas` VALUES (1, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '94', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (2, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '94', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (3, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '92', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (4, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '95', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (5, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '87', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (6, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '95', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (7, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '95', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (8, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '92', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (9, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '87', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (10, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '89', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (11, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '85', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (12, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '86', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (13, 'FLUJO MULTIFÁSICO EN TUBERÍAS  PED-1012', 'VI A  IPET', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 5, 'F', '161240030', 'PATIÑO QUINTERO JULIA SAMANTHA', '', '', '*', '', '90', '', 7, 'PED-1012', 'IPET', '3', 'FLUJO MULTIFÁSICO EN TUBERÍAS  ', 6, 6);
INSERT INTO `migracion_actas` VALUES (1, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'M', '191240049', 'GONZÁLEZ LÓPEZ ÁNGEL GABRIEL ', '', '', '', '', 'NA', '', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (2, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'F', '191240050', 'HEREDIA MENDEZ FLOR YULISA ', '', '', '', '', '94', '', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (3, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'M', '191240051', 'HERNÁNDEZ BROCA ANTONIO ', '', '', '', '', '', '83', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (4, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'F', '191240052', 'HERNÁNDEZ PABLO RUBI CRISTHELL ', '', '', '', '', '92', '', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (5, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'M', '191240055', 'PÉREZ VÁZQUEZ ALEXANDER', '', '', '', '', '86', '', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (6, 'MICROBIOLOGÍA  AEF-1049', 'IV A  IIAS', 'MICROBIOLOGÍA  ', 5, 'F', '191240058', 'VÁZQUEZ CASTILLO GLORIA ARACELY', '', '', '', '', 'NA', '', 8, 'AEF-1049', 'IIAS', '1', 'MICROBIOLOGÍA  ', 7, 7);
INSERT INTO `migracion_actas` VALUES (1, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', '80', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (2, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '98', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (3, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '96', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (4, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '92', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (5, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '98', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (6, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'NA', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (7, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '90', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (8, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', '94', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (9, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'NA', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (10, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', '83', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (11, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '91', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (12, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '98', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (13, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'NA', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (14, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '93', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (15, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '88', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (16, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '97', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (17, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', '94', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (18, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '97', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (19, 'QUÍMICA ORGÁNICA PEG-1026', 'II A  IPET', 'QUÍMICA ORGÁNICA ', 5, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'NA', '', 8, 'PEG-1026', 'IPET', '3', 'QUÍMICA ORGÁNICA ', 8, 8);
INSERT INTO `migracion_actas` VALUES (1, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', '', '', '', '', '89', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (2, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', '', '', '', '', 'NA', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (3, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', '', '', '', '', '87', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (4, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', '', '', '', '', '92', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (5, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240035', 'JIMÉNEZ CRUZ RASHELL ', '', '', '', '', '93', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (6, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', '', '', '', '', '77', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (7, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240038', 'NARANJO TORRUCO MERCEDES ', '', '', '', '', 'NA', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (8, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240039', 'NOTARIO HERRERA FERNANDO ', '', '', '', '', '92', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (9, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240041', 'PALMA ÁLVAREZ RUBICEL', '', '', '', '', '91', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (10, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240045', 'RAMOS COLIN VICTOR MANUEL ', '', '', '', '', '93', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (11, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', '', '', '', '', '90', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (12, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240044', 'RUEDA RAMOS LEONEL ANTONIO ', '', '', '', '', '90', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (13, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', '', '', '', '', '86', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (14, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE ', '', '', '', '', '90', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (15, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO ', '', '', '', '', '87', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (16, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240047', 'VALENZUELA CÓRDOVA ÁNGELA ', '', '', '', '', '92', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (17, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '85', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (18, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '90', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (19, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '', '', '88', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (20, 'MECÁNICA DE FLUIDOS  PED-1019', 'IV A  IPET', 'MECÁNICA DE FLUIDOS  ', 5, 'F', '191240033', 'GARCÍA SÁNCHEZ ARISBETH GUADALUPE', '', '', '', '', 'NA', '', 7, 'PED-1019', 'IPET', '3', 'MECÁNICA DE FLUIDOS  ', 9, 9);
INSERT INTO `migracion_actas` VALUES (1, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '94', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (2, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '96', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (3, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '91', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (4, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '92', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (5, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '88', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (6, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '98', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (7, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '84', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (8, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '', '', '86', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (9, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '94', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (10, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '89', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (11, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '90', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (12, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '87', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (13, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '85', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (14, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '*', '', 'NA', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (15, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', '171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', '', '', '', '', '88', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (16, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'F', '171240001', 'GAMAS PABLO NANCY BERENICE', '', '', '*', '', 'NA', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (17, 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  PED-1029', 'IV A  IPET', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 5, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '94', '', 7, 'PED-1029', 'IPET', '3', 'SISTEMAS DE BOMBEO EN LA INDUSTRIA PETROLERA  ', 10, 10);
INSERT INTO `migracion_actas` VALUES (1, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', '', 'NA', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (2, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '94', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (3, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '', '88', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (4, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '', '91', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (5, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '93', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (6, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'NA', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (7, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '', '84', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (8, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', '84', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (9, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'NA', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (10, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', '', '76', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (11, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '', '85', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (12, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '93', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (13, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'NA', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (14, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '92', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (15, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '', '89', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (16, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '97', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (17, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', '89', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (18, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '94', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (19, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'NA', '', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (20, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', '', '', '*', '', '', 'NA', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (21, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'M', '191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', '', '', '*', '', '', 'NA', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (22, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '171240001', 'GAMAS PABLO NANCY BERENICE', '', '', '*', '', '', 'NA', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (23, 'GEOLOGÍA DE YACIMIENTOS  PED-1014', 'II A IPET', 'GEOLOGÍA DE YACIMIENTOS  ', 5, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '*', '', '', '83', 16, 'PED-1014', 'IPET', '3', 'GEOLOGÍA DE YACIMIENTOS  ', 11, 11);
INSERT INTO `migracion_actas` VALUES (1, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '', '91', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (2, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '98', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (3, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '96', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (4, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '94', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (5, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '90', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (6, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '97', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (7, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '', '90', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (8, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '', '90', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (9, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '', 'NA', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (10, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '92', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (11, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '', '86', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (12, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '', 'NA', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (13, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '', '', '', 'NA', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (14, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', '', '', '', '', '', '88', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (15, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '161240002', 'CRUZ RAMOS ERICK FABIAN', '', '', '', '', '', '83', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (16, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'M', '161240039', 'GALLARDO DAVID ADRIAN ERNESTO', '', '', '', '', '', '92', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (17, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '161240030', 'PATIÑO QUINTERO JULIA SAMANTHA', '', '', '', '', '', '87', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (18, 'HIDRAÚLICA  PED-1016', 'VI A  IPET', 'HIDRAÚLICA  ', 5, 'F', '161240033', 'VERA MORALES PAOLA DEL CARMEN', '', '', '', '', '90', '', 16, 'PED-1016', 'IPET', '3', 'HIDRAÚLICA  ', 12, 12);
INSERT INTO `migracion_actas` VALUES (1, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', '', '', '', '', '87', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (2, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '171240037', 'CRUZ NOTARIO JONATHAN KENNEY', '', '', '', '', '82', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (3, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', '', '', '', '', '82', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (4, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'F', '171240001', 'GAMAS PABLO NANCY BERENICE', '', '', '', '', 'NA', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (5, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '171240012', 'RAMÍREZ RODRÍGUEZ DANIEL ENRIQUE', '', '', '', '', 'NA', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (6, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '171240002', 'TORRUCO CARRILLO GUSTAVO ÁNGEL', '', '', '', '', '92', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (7, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '86', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (8, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '95', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (9, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '95', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (10, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '91', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (11, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '89', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (12, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '89', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (13, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '87', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (14, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '', '', '88', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (15, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '90', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (16, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '82', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (17, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '95', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (18, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '88', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (19, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '', '', 'NA', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (20, 'RECUPERACIÓN SECUNDARIA Y MEJORADA  PED-1027', 'VIII A  IPET', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 5, 'M', '161240002', 'CRUZ RAMOS ERICK FABIAN', '', '', '', '', '86', '', 21, 'PED-1027', 'IPET', '3', 'RECUPERACIÓN SECUNDARIA Y MEJORADA  ', 13, 13);
INSERT INTO `migracion_actas` VALUES (1, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '171240003', 'ÁLVAREZ SAN MARTÍN MANUEL ABRAHAM', '', '', '', '', '88', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (2, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '171240037', 'CRUZ NOTARIO JONATHAN KENNEY', '', '', '', '', '81', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (3, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '171240028', 'DOMÍNGUEZ CADENAS EDGAR JOHAN', '', '', '', '', '83', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (4, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '171240012', 'RAMÍREZ RODRÍGUEZ DANIEL ENRIQUE', '', '', '', '', 'NA', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (5, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '171240002', 'TORRUCO CARRILLO GUSTAVO ÁNGEL', '', '', '', '', '95', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (6, 'SISTEMAS ARTIFICIALES  PED-1028', 'VIII A  IPET', 'SISTEMAS ARTIFICIALES  ', 5, 'M', '161240039', 'GALLARDO DAVID ADRIAN ERNESTO', '', '', '', '', '89', '', 21, 'PED-1028', 'IPET', '3', 'SISTEMAS ARTIFICIALES  ', 14, 14);
INSERT INTO `migracion_actas` VALUES (1, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '70', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (2, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '99', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (3, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (4, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (5, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (6, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (7, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '99', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (8, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (9, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '99', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (10, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '99', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (11, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '99', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (12, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '80', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (13, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '70', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (14, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', '70', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (15, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (16, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'M', '191240025', 'SALAYA CEFERINO ERIK ROBERTO', '', '', '', '', '70', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (17, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '90', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (18, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '100', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (20, 'COMPRAS  LOC-0905', 'IV A ILOG', 'COMPRAS  ', 4, 'F', '181240028', 'MÉNDEZ VIDAL ENIX RUBI', '', '', '', '', '98', '', 15, 'LOC-0905', 'ILOG', '2', 'COMPRAS  ', 15, 15);
INSERT INTO `migracion_actas` VALUES (1, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (2, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240012', 'CANO OLÁN MARÍA DEL CARMEN', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (3, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'M', '181240023', 'CÓRDOVA CÓRDOVA ANTONIO', '', '', '', '', '85', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (4, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', '', '', '', '', '99', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (5, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', '', '', '', '', '97', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (6, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'M', '181240004', 'GARDUZA DE LA CRUZ NARCISO', '', '', '', '', '70', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (7, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (8, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'M', '181240066', 'ISIDRO LUCAS JESÚS', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (9, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'M', '181240018', 'JÁCOME BASTIDA SALVADOR', '', '', '', '', '95', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (10, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (11, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', '', '', '', '', '85', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (12, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', '', '', '', '', '85', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (13, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'M', '181240026', 'NOTARIO HERRERA JESÚS MANUEL', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (14, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', '', '', '', '', '95', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (15, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (16, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240082', 'SÁNCHEZ ADORNO ALICIA', '', '', '', '', '93', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (17, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '95', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (18, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '181240046', 'TORRES JIMÉNEZ ANA LUCERO', '', '', '', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (19, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '171240020', 'CARTAGENA SEGURA LUZ ESTHER', '', '', '*', '', '70', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (20, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '171240016', 'LÓPEZ MORENO MARIA GUADALUPE', '', '', '*', '', '88', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (21, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', '', '', '*', '', '70', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (22, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '171240014', 'VIDAL LEÓN VICTORIA', '', '', '*', '', '70', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (23, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '161240024', 'DOMÍNGUEZ GERÓNIMO DIANA IBETH', '', '', '*', '', '70', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (24, 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  LOC-0926', 'VI A ILOG', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 4, 'F', '171240032', 'CUPIDO PÉREZ BETHZAYDA', '', '', '*', '', '100', '', 15, 'LOC-0926', 'ILOG', '2', 'PROGRAMACIÓN DE PROCESOS PRODUCTIVOS  ', 16, 16);
INSERT INTO `migracion_actas` VALUES (1, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'F', '201240129', 'ABASCAL SÁNCHEZ MELINA', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (2, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240132', 'ALEMÁN ZAVALA GONZÁLO RAMÓN', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (3, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240007', 'ALPUCHE ROMERO ELIUD ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (4, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240137', 'ÁLVAREZ SAN MARTÍN VICTOR MANUEL', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (5, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240073', 'BARJAU VALIER BRAYAN', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (6, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'F', '201240112', 'CORNELIO SANTIAGO BRENDA ITZEL ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (7, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240079', 'CRUZ LÁZARO FRANCISCO', '', '', '', '', '90', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (8, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240113', 'FACUNDO DE LA O JORGE ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (9, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240119', 'GUZMÁN PÉREZ TOMAS', '', '', '', '', '90', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (10, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240018', 'LANDERO SÁNCHEZ NORBERTO ', '', '', '', '', '85', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (11, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240130', 'LÓPEZ CÓRDOVA JULIO ADRIAN', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (12, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240120', 'MORALES CÓRDOBA ROBERTO ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (13, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240117', 'OLEA MENESES JUAN PABLO ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (14, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '201240124', 'YAÑEZ JIMÉNEZ JOSÉ LUIS ', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (15, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'F', '211240011', 'CALCANEO CARRETA ALLISON', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (16, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '211240004', 'DOMÍNGUEZ RAMOS IRVING', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (17, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'F', '211240003', 'LÓPEZ LÓPEZ MARÍA DEL ROSARIO', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (18, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '211240010', 'PRADO CRUZ JUAN MINERVO', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (19, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '211240008', 'VALENZUELA COLORADO DANIEL ALBERTO', '', '', '', '', '98', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (20, 'CÁLCULO INTEGRAL   ACF-0902', 'II A IPET MIXTA', 'CÁLCULO INTEGRAL   ', 4, 'M', '211240013', 'SALMERON VERA GUSTAVO', '', '', '', '', '70', '', 15, 'ACF-0902', 'IXTA', '4', 'CÁLCULO INTEGRAL   ', 17, 17);
INSERT INTO `migracion_actas` VALUES (1, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'F', '201240129', 'ABASCAL SÁNCHEZ MELINA', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (2, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240132', 'ALEMÁN ZAVALA GONZÁLO RAMÓN', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (3, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240007', 'ALPUCHE ROMERO ELIUD ', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (4, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240137', 'ÁLVAREZ SAN MARTÍN VICTOR MANUEL', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (5, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240073', 'BARJAU VALIER BRAYAN', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (6, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'F', '201240112', 'CORNELIO SANTIAGO BRENDA ITZEL ', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (7, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240079', 'CRUZ LÁZARO FRANCISCO', '', '', '', '', '90', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (8, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240113', 'FACUNDO DE LA O JORGE ', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (9, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240119', 'GUZMÁN PÉREZ TOMAS', '', '', '', '', '90', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (10, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240018', 'LANDERO SÁNCHEZ NORBERTO ', '', '', '', '', '85', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (11, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240130', 'LÓPEZ CÓRDOVA JULIO ADRIAN', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (12, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240120', 'MORALES CÓRDOBA ROBERTO ', '', '', '', '', '100', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (13, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240117', 'OLEA MENESES JUAN PABLO ', '', '', '', '', '100', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (14, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '201240124', 'YAÑEZ JIMÉNEZ JOSÉ LUIS ', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (15, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'F', '211240011', 'CALCANEO CARRETA ALLISON', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (16, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '211240004', 'DOMÍNGUEZ RAMOS IRVING', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (17, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'F', '211240003', 'LÓPEZ LÓPEZ MARÍA DEL ROSARIO', '', '', '', '', '100', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (18, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '211240010', 'PRADO CRUZ JUAN MINERVO', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (19, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '211240008', 'VALENZUELA COLORADO DANIEL ALBERTO', '', '', '', '', '98', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (20, 'ÁLGEBRA LINEAL  ACF-0903', 'II A IPET MIXTA', 'ÁLGEBRA LINEAL  ', 4, 'M', '211240013', 'SALMERON VERA GUSTAVO', '', '', '', '', '70', '', 15, 'ACF-0903', 'IXTA', '4', 'ÁLGEBRA LINEAL  ', 18, 18);
INSERT INTO `migracion_actas` VALUES (1, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (2, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '84', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (3, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '82', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (4, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '87', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (5, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '79', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (6, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (7, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '83', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (8, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (9, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (10, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (11, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '71', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (12, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '82', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (13, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (14, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '77', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (15, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '', '70', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (16, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '87', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (17, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', '', '73', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (18, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '84', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (19, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (20, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'M', '191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', '', '', '', '', 'NA', '', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (21, 'ÁLGEBRA LINEAL  ACF-0903', 'II A   IPET', 'ÁLGEBRA LINEAL  ', 5, 'F', '191240038', 'NARANJO TORRUCO MERCEDES ', '', '', '', '', '', '70', 2, 'ACF-0903', 'IPET', '3', 'ÁLGEBRA LINEAL  ', 18, 19);
INSERT INTO `migracion_actas` VALUES (1, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (2, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (3, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '', '72', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (4, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '80', '', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (5, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '', '76', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (6, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (7, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '81', '81', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (8, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '', '77', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (9, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (10, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (24, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240015', 'MARTINEZ DE ESCOBAR ESPINOZA PERLA RUBI', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (11, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (12, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '', '74', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (13, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (14, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', '', 'NA', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (15, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '', 'NA', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (16, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '191240025', 'SALAYA CEFERINO ERIK ROBERTO', '', '', '', '', '', 'NA', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (17, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '', '90', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (18, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '100', '', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (19, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '181240028', 'MÉNDEZ VIDAL ENIX RUBI', '', '', '*', '', 'NA', '', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (20, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', '', '', '*', '', '', 'NA', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (21, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '*', '', '', '70', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (22, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '161240013', 'BOFIL PÉREZ EROS AUGUSTO', '', '', '*', '', 'NA', '', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (23, 'ESTADISTICA INFERENCIAL II  AEF-1025', 'IV A   ILOG', 'ESTADISTICA INFERENCIAL II  ', 5, 'M', '161240021', 'HERNÁNDEZ TORRES JUAN DANIEL', '', '', '', '', 'NA', '', 2, 'AEF-1025', 'ILOG', '2', 'ESTADISTICA INFERENCIAL II  ', 19, 20);
INSERT INTO `migracion_actas` VALUES (1, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'M', '191240049', 'GONZÁLEZ LÓPEZ ÁNGEL GABRIEL ', '', '', '', '', '85', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (2, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'F', '191240050', 'HEREDIA MENDEZ FLOR YULISA ', '', '', '', '', '85', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (3, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'M', '191240051', 'HERNÁNDEZ BROCA ANTONIO ', '', '', '', '', '85', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (4, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'F', '191240052', 'HERNÁNDEZ PABLO RUBI CRISTHELL ', '', '', '', '', '85', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (5, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'M', '191240055', 'PÉREZ VÁZQUEZ ALEXANDER', '', '', '', '', '85', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (6, 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ASC-1003', 'IV A  IIAS', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 4, 'F', '191240058', 'VÁZQUEZ CASTILLO GLORIA ARACELY', '', '', '', '', 'NA', '', 25, 'ASC-1003', 'IIAS', '1', 'BASE DE DATOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA ', 20, 21);
INSERT INTO `migracion_actas` VALUES (1, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', '', '', '', '', '91', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (2, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240033', 'GARCÍA SÁNCHEZ ARISBETH GUADALUPE', '', '', '', '', 'NA', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (3, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', '', '', '', '', '90', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (4, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', '', '', '', '', '93', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (5, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240035', 'JIMÉNEZ CRUZ RASHELL ', '', '', '', '', '94', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (6, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', '', '', '', '', '', 'NA', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (7, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '79', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (8, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240038', 'NARANJO TORRUCO MERCEDES ', '', '', '', '', 'NA', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (9, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240039', 'NOTARIO HERRERA FERNANDO ', '', '', '', '', '93', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (10, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240041', 'PALMA ÁLVAREZ RUBICEL', '', '', '', '', '91', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (11, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240045', 'RAMOS COLIN VICTOR MANUEL ', '', '', '', '', '89', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (12, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', '', '', '', '', '89', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (13, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240044', 'RUEDA RAMOS LEONEL ANTONIO ', '', '', '', '', '90', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (14, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', '', '', '', '', '', '88', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (15, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE ', '', '', '', '', '', 'NA', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (16, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'M', '191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO ', '', '', '', '', '', '90', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (17, 'ECUACIONES DIFERENCIALES  ACF-0905', 'IV A  IPET', 'ECUACIONES DIFERENCIALES  ', 5, 'F', '191240047', 'VALENZUELA CÓRDOVA ÁNGELA ', '', '', '', '', '90', '', 19, 'ACF-0905', 'IPET', '3', 'ECUACIONES DIFERENCIALES  ', 21, 22);
INSERT INTO `migracion_actas` VALUES (1, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240003', 'COLLADO BROCA VICTOR ANDRES ', '', '', '', '', '', '80', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (2, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', '', '', '', '', 'NA', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (3, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240008', 'GAMAS COLLADO MARIO ELIAS ', '', '', '', '', '88', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (4, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO ', '', '', '', '', '', '70', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (5, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'F', '201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', '', '', '', '', '100', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (6, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO ', '', '', '', '', '98', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (7, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'F', '201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', '', '', '', '', 'NA', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (8, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'F', '201240015', 'HERRERA ROMERO NADIA CITLALI', '', '', '', '', '', '70', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (9, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'F', '201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA ', '', '', '', '', '98', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (10, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', '', '', '', '', '74', '74', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (11, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240128', 'MORALES RODRÍGUEZ RAFAEL', '', '', '', '', 'NA', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (12, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '201240022', 'REYES BECERRA ÁNGEL ', '', '', '', '', '94', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (13, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'F', '201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA ', '', '', '', '', '98', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (14, 'CÁLCULO DIFERENCIAL ACF-0901', 'II A  IIAS', 'CÁLCULO DIFERENCIAL ', 5, 'M', '191240049', 'GONZÁLEZ LÓPEZ ÁNGEL GABRIEL ', '', '', '*', '', '76', '', 19, 'ACF-0901', 'IIAS', '1', 'CÁLCULO DIFERENCIAL ', 22, 23);
INSERT INTO `migracion_actas` VALUES (1, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240034', 'CUSTODIO GARCÍA PRISCILA', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (2, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (3, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (4, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (5, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240053', 'PÉREZ PÉREZ JACQUELINE', '', '', '', '', '87', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (6, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240006', 'PIÑERA CRUZ CARLOS ARTURO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (7, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240055', 'REYES DE DIOS  HEIDY GISELLE', '', '', '', '', '93', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (8, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240056', 'ROSAS ORDOÑEZ ARTURO', '', '', '', '', '85', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (9, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240058', 'SANTIAGO ACOSTA MARLENE', '', '', '', '', '75', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (10, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240061', 'SOLANO MÉNDEZ CRISTIAN ', '', '', '', '', '93', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (11, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (12, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240067', 'VALENZUELA CARRETO KENIA LETICIA ', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (13, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240068', 'VIDAL LEÓN LIZBETH', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (14, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240069', 'ZENTENO RAMÓN DAMIÁN', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (15, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '211240001', 'MORENO GOMEZ DOLORES RAQUEL ', '', '', '', '', '90', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (16, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (17, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '211240005', 'MORALES TOSCA BERENICE', '', '', '', '', '73', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (18, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '211240014', 'NOTARIO HAAS IRWIN GEOVANNI', '', '', '', '', '90', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (19, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '211240006', 'SILVA ORAMAS ERNESTO ALONSO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (20, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (21, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '211240009', 'VERA ORTÍZ DULCE MARIA', '', '', '', '', '97', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (22, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '*', '', '73', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (23, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (24, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'M', '181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', '', '', '*', '', '80', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (25, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '*', '', '90', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (26, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  ILOG', 'CÁLCULO INTEGRAL  ', 5, 'F', '191240015', 'MARTINEZ DE ESCOBAR ESPINOZA PERLA RUBI', '', '', '', '', '93', '', 19, 'ACF-0902', 'ILOG', '2', 'CÁLCULO INTEGRAL  ', 23, 24);
INSERT INTO `migracion_actas` VALUES (1, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', '83', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (2, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '97', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (3, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '97', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (4, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '90', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (5, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '97', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (6, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (7, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '83', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (8, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', '87', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (9, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (10, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', '80', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (11, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '90', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (12, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '97', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (13, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (14, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '97', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (15, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '87', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (16, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '92', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (17, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (18, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '90', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (19, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'NA', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (20, 'CÁLCULO INTEGRAL  ACF-0902', 'II A  IPET', 'CÁLCULO INTEGRAL  ', 5, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '87', '', 19, 'ACF-0902', 'IPET', '3', 'CÁLCULO INTEGRAL  ', 23, 25);
INSERT INTO `migracion_actas` VALUES (1, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'F', '201240129', 'ABASCAL SÁNCHEZ MELINA', '', '', '', '', '92', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (2, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240132', 'ALEMÁN ZAVALA GONZÁLO RAMÓN', '', '', '', '', '84', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (3, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240007', 'ALPUCHE ROMERO ELIUD ', '', '', '', '', '80', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (4, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240137', 'ÁLVAREZ SAN MARTÍN VICTOR MANUEL', '', '', '', '', '80', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (5, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240073', 'BARJAU VALIER BRAYAN', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (6, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'F', '201240112', 'CORNELIO SANTIAGO BRENDA ITZEL ', '', '', '', '', '98', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (7, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240079', 'CRUZ LÁZARO FRANCISCO', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (8, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240113', 'FACUNDO DE LA O JORGE ', '', '', '', '', '74', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (9, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240119', 'GUZMÁN PÉREZ TOMAS', '', '', '', '', '75', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (10, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240018', 'LANDERO SÁNCHEZ NORBERTO ', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (11, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240130', 'LÓPEZ CÓRDOVA JULIO ADRIAN', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (12, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240120', 'MORALES CÓRDOBA ROBERTO ', '', '', '', '', '83', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (13, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240117', 'OLEA MENESES JUAN PABLO ', '', '', '', '', '90', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (14, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '201240124', 'YAÑEZ JIMÉNEZ JOSÉ LUIS ', '', '', '', '', '75', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (15, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'F', '211240011', 'CALCANEO CARRETA ALLISON', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (16, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '211240004', 'DOMÍNGUEZ RAMOS IRVING', '', '', '', '', '78', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (17, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'F', '211240003', 'LÓPEZ LÓPEZ MARÍA DEL ROSARIO', '', '', '', '', '95', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (18, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '211240010', 'PRADO CRUZ JUAN MINERVO', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (19, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '211240013', 'SALMERON VERA GUSTAVO', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (20, 'ECONOMÍA  PEQ-1009', 'II A IPET MIXTA', 'ECONOMÍA  ', 3, 'M', '211240008', 'VALENZUELA COLORADO DANIEL ALBERTO', '', '', '', '', '78', '', 5, 'PEQ-1009', 'IXTA', '4', 'ECONOMÍA  ', 24, 26);
INSERT INTO `migracion_actas` VALUES (1, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240020', 'CARTAGENA SEGURA LUZ ESTHER', '', '', '', '', 'N/A', '80', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (2, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240032', 'CUPIDO PÉREZ BETHZAYDA', '', '', '', '', '93', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (3, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'M', '171240046', 'HERNÁNDEZ OLAN JESÚS DAVID', '', '', '', '', '92', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (4, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240009', 'LÓPEZ JIMENÉZ ESTRELLITA DEL CARMEN', '', '', '', '', '100', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (5, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240016', 'LÓPEZ MORENO MARIA GUADALUPE', '', '', '', '', '90', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (6, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'M', '171240017', 'PARDO LEYVA PABLO', '', '', '', '', '92', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (7, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240044', 'RAMÓN LARIOS LIZBETH SUSANA', '', '', '', '', '90', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (8, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'M', '171240015', 'RAMOS MENDOZA MIGUEL ÁNGEL', '', '', '', '', '92', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (9, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '151240020', 'ROMERO FLORES ROSA YULIANA', '', '', '', '', 'N/A', 'N/A', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (10, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', '', '', '', '', '95', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (11, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240014', 'VIDAL LEÓN VICTORIA', '', '', '', '', 'N/A', '80', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (12, 'TALLER DE COMERCIO INTERNACIONAL  TDF-1803', 'VIII A ILOG', 'TALLER DE COMERCIO INTERNACIONAL  ', 5, 'F', '171240004', 'ZAPATA BALAN GABRIELA', '', '', '', '', '90', '', 5, 'TDF-1803', 'ILOG', '2', 'TALLER DE COMERCIO INTERNACIONAL  ', 25, 27);
INSERT INTO `migracion_actas` VALUES (1, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240020', 'CARTAGENA SEGURA LUZ ESTHER', '', '', '', '', '85', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (2, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240032', 'CUPIDO PÉREZ BETHZAYDA', '', '', '', '', '90', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (3, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'M', '171240046', 'HERNÁNDEZ OLAN JESÚS DAVID', '', '', '', '', '93', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (4, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240009', 'LÓPEZ JIMENÉZ ESTRELLITA DEL CARMEN', '', '', '', '', '98', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (5, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240016', 'LÓPEZ MORENO MARIA GUADALUPE', '', '', '', '', '90', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (6, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'M', '171240017', 'PARDO LEYVA PABLO', '', '', '', '', '95', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (7, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240044', 'RAMÓN LARIOS LIZBETH SUSANA', '', '', '', '', '94', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (8, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'M', '171240015', 'RAMOS MENDOZA MIGUEL ÁNGEL', '', '', '', '', '95', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (9, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', '', '', '', '', '95', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (10, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'M', '161240031', 'SÁNCHEZ LÓPEZ EDUARDO', '', '', '', '', '92', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (11, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240014', 'VIDAL LEÓN VICTORIA', '', '', '', '', '85', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (12, 'NEGOCIOS INTERNACIONALES   TDC-1805', 'VIII A ILOG', 'NEGOCIOS INTERNACIONALES   ', 5, 'F', '171240004', 'ZAPATA BALAN GABRIELA', '', '', '', '', '90', '', 5, 'TDC-1805', 'ILOG', '2', 'NEGOCIOS INTERNACIONALES   ', 26, 28);
INSERT INTO `migracion_actas` VALUES (1, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240071', 'ALONSO GARCÍA DEYSI MARIA', '', '', '', '', '70', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (2, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240074', 'CASTILLO MARTÍNEZ ROBERTO ', '', '', '', '', '90', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (3, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240077', 'CÓRDOVA HERNÁNDEZ JONATHAN JOSÉ', '', '', '', '', '90', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (4, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240108', 'CRUZ VÁZQUEZ HEBERT', '', '', '', '', '80', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (5, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240080', 'CUPIDO CADENAS LUIS AMIR ', '', '', '', '', '95', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (6, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240081', 'CUPIDO CADENAS WILBERT ALI ', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (7, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240083', 'DE LA CRUZ MONTIEL BRENDA ESTHELA ', '', '', '', '', '92', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (8, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240084', 'ECHEVARRIA DE LA CRUZ EDWIN ', '', '', '', '', '85', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (9, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240133', 'GARCÍA GONZÁLEZ DULCE CONSUELO', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (10, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240011', 'GARDUZA OVANDO ÁNGEL ENRIQUE', '', '', '', '', '70', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (11, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240090', 'GERÓNIMO VENTURA JAZMÍN ', '', '', '', '', '95', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (12, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240092', 'HERNÁNDEZ CADENAS MIGUEL ENRIQUE ', '', '', '', '', '94', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (13, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240094', 'HERNÁNDEZ PARDO VÍCTOR MANUEL ', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (14, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240095', 'JIMÉNEZ URGELL JOSE JULIÁN ', '', '', '', '', '90', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (15, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240096', 'LÓPEZ CABELLO JESÚS DEL CARMEN', '', '', '', '', '85', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (16, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240097', 'LÓPEZ LIMÓN KARLA ALESSANDRA ', '', '', '', '', '93', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (17, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240098', 'LÓPEZ SEGURA CRISTIAN AARON ', '', '', '', '', '85', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (18, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'F', '201240100', 'MAGAÑA DOMÍNGUEZ SALOMÉ ', '', '', '', '', '90', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (19, 'ECONOMÍA  PEQ-1009', 'II A IPET', 'ECONOMÍA  ', 3, 'M', '201240021', 'MORENO RODRÍGUEZ ANTONIO ARTURO', '', '', '', '', 'N/A', '', 5, 'PEQ-1009', 'IPET', '3', 'ECONOMÍA  ', 24, 29);
INSERT INTO `migracion_actas` VALUES (1, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240001', 'AGUIRRE LÓPEZ YESENIA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (2, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240068', 'ALPUCHE RAMOS DANIELA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (3, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240002', 'ARIAS TORRES MARÍA FERNANDA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (4, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (5, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240012', 'CANO OLÁN MARÍA DEL CARMEN', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (6, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '181240023', 'CÓRDOVA CÓRDOVA ANTONIO', '', '', '', '', '80', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (7, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (8, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (9, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (10, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '181240004', 'GARDUZA DE LA CRUZ NARCISO', '', '', '', '', '70', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (11, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (12, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '181240066', 'ISIDRO LUCAS JESÚS', '', '', '', '', '90', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (13, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '181240018', 'JÁCOME BASTIDA SALVADOR', '', '', '', '', '85', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (14, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (15, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', '', '', '', '', '80', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (16, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (17, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '181240026', 'NOTARIO HERRERA JESÚS MANUEL', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (18, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', '', '', '', '', '80', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (19, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', '', '', '', '', '90', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (20, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240082', 'SÁNCHEZ ADORNO ALICIA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (21, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (22, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'F', '181240046', 'TORRES JIMÉNEZ ANA LUCERO', '', '', '', '', '100', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (23, 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   LOE-0924', 'VI A ILOG', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 4, 'M', '161240031', 'SÁNCHEZ LÓPEZ EDUARDO', '', '', '', '', '90', '', 25, 'LOE-0924', 'ILOG', '2', 'MODELOS DE SIMULACIÓN Y LOGÍSITICA   ', 27, 30);
INSERT INTO `migracion_actas` VALUES (1, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240034', 'CUSTODIO GARCÍA PRISCILA', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (2, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (3, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (4, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', '', '', '', '', '80', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (5, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240053', 'PÉREZ PÉREZ JACQUELINE', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (6, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240006', 'PIÑERA CRUZ CARLOS ARTURO', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (7, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240055', 'REYES DE DIOS  HEIDY GISELLE', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (8, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240056', 'ROSAS ORDOÑEZ ARTURO', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (9, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240058', 'SANTIAGO ACOSTA MARLENE', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (10, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240061', 'SOLANO MÉNDEZ CRISTIAN ', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (11, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (12, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240067', 'VALENZUELA CARRETO KENIA LETICIA ', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (13, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '201240068', 'VIDAL LEÓN LIZBETH', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (14, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '201240069', 'ZENTENO RAMÓN DAMIÁN', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (15, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '211240001', 'MORENO GOMEZ DOLORES RAQUEL ', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (16, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (17, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '211240005', 'MORALES TOSCA BERENICE', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (18, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'M', '211240006', 'SILVA ORAMAS ERNESTO ALONSO', '', '', '', '', '70', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (19, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (20, 'PROBABILIDAD Y ESTADÍSTICA  AEC-1023', 'V A ILOG', 'PROBABILIDAD Y ESTADÍSTICA  ', 4, 'F', '211240009', 'VERA ORTÍZ DULCE MARIA', '', '', '', '', '100', '', 25, 'AEC-1023', 'ILOG', '2', 'PROBABILIDAD Y ESTADÍSTICA  ', 28, 31);
INSERT INTO `migracion_actas` VALUES (1, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', '', '', '', '', '70', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (2, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240033', 'GARCÍA SÁNCHEZ ARISBETH GUADALUPE', '', '', '', '', '85', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (3, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', '', '', '', '', '70', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (4, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (5, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', '', '', '', '', '85', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (6, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240035', 'JIMÉNEZ CRUZ RASHELL ', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (7, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', '', '', '', '', '85', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (8, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240038', 'NARANJO TORRUCO MERCEDES ', '', '', '', '', '70', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (9, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240039', 'NOTARIO HERRERA FERNANDO ', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (10, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240041', 'PALMA ÁLVAREZ RUBICEL', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (11, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240045', 'RAMOS COLIN VICTOR MANUEL ', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (12, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', '', '', '', '', '100', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (13, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240044', 'RUEDA RAMOS LEONEL ANTONIO ', '', '', '', '', '85', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (14, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', '', '', '', '', '80', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (15, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE ', '', '', '', '', '70', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (16, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', '191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO ', '', '', '', '', '85', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (17, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'F', '191240047', 'VALENZUELA CÓRDOVA ÁNGELA ', '', '', '', '', '80', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (18, 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  PEC-1022', 'IV A IPET', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 4, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '80', '', 25, 'PEC-1022', 'IPET', '3', 'PROBABILIDAD Y ESTADÍSTICA APLICADA AL CAMPO PETROLERO  ', 29, 32);
INSERT INTO `migracion_actas` VALUES (1, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240034', 'CUSTODIO GARCÍA PRISCILA', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (2, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', '', '', '', '', '99', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (3, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', '', '', '', '', '99', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (4, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '211240014', 'NOTARIO HAAS IRWIN GEOVANNI', '', '', '', '', '88', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (5, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (6, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240053', 'PÉREZ PÉREZ JACQUELINE', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (7, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240006', 'PIÑERA CRUZ CARLOS ARTURO', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (8, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240055', 'REYES DE DIOS  HEIDY GISELLE', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (9, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240056', 'ROSAS ORDOÑEZ ARTURO', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (10, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240058', 'SANTIAGO ACOSTA MARLENE', '', '', '', '', '89', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (11, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240061', 'SOLANO MÉNDEZ CRISTIAN ', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (12, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (13, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240067', 'VALENZUELA CARRETO KENIA LETICIA ', '', '', '', '', '75', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (14, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '201240068', 'VIDAL LEÓN LIZBETH', '', '', '', '', '94', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (15, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '201240069', 'ZENTENO RAMÓN DAMIÁN', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (16, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '211240001', 'MORENO GOMEZ DOLORES RAQUEL ', '', '', '', '', '82', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (17, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (18, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '211240005', 'MORALES TOSCA BERENICE', '', '', '', '', '87', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (19, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '211240006', 'SILVA ORAMAS ERNESTO ALONSO', '', '', '', '', 'NA', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (20, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (21, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'F', '211240009', 'VERA ORTÍZ DULCE MARIA', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (22, 'FUNDAMENTOS DE INVESTIGACIÓN  ACC-0906', 'II A  ILOG', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 4, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '100', '', 11, 'ACC-0906', 'ILOG', '2', 'FUNDAMENTOS DE INVESTIGACIÓN  ', 30, 33);
INSERT INTO `migracion_actas` VALUES (1, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '84', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (2, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '94', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (3, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '94', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (4, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '88', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (5, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '92', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (6, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '90', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (7, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '92', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (8, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '88', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (9, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '94', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (10, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '100', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (11, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '94', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (12, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '88', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (13, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '89', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (14, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240025', 'SALAYA CEFERINO ERIK ROBERTO', '', '', '', '', '', 'NA', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (15, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '97', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (16, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '100', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (17, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240068', 'ALPUCHE RAMOS DANIELA', '', '', '', '', '72', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (18, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240002', 'ARIAS TORRES MARÍA FERNANDA', '', '', '', '', '89', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (19, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', '', '', '', '', '90', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (20, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240028', 'MÉNDEZ VIDAL ENIX RUBI', '', '', '', '', '', '70', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (21, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '84', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (22, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240001', 'AGUIRRE LÓPEZ YESENIA', '', '', '', '', '90', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (23, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'M', '181240059', 'MONTIEL CUEVAS ÁNGEL RACIEL', '', '', '', '', '', 'NA', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (24, 'TIPOLOGÍA DEL PRODUCTO  LOC-0929', 'IV A ILOG', 'TIPOLOGÍA DEL PRODUCTO  ', 4, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '89', '', 3, 'LOC-0929', 'ILOG', '2', 'TIPOLOGÍA DEL PRODUCTO  ', 31, 34);
INSERT INTO `migracion_actas` VALUES (1, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '', '80', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (2, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '91', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (3, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '92', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (4, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '86', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (5, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '90', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (6, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '88', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (7, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '90', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (8, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '85', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (9, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '92', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (10, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '95', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (11, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '93', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (12, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '88', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (13, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '84', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (14, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', '80', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (15, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '82', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (16, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'M', '191240025', 'SALAYA CEFERINO ERIK ROBERTO', '', '', '', '', '', '72', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (17, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '96', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (18, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '100', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (19, 'ENTORNO ECONÓMICO  LOC-0911', 'IV A ILOG', 'ENTORNO ECONÓMICO  ', 4, 'F', '191240015', 'MARTINEZ DE ESCOBAR ESPINOZA PERLA RUBI', '', '', '', '', '89', '', 3, 'LOC-0911', 'ILOG', '2', 'ENTORNO ECONÓMICO  ', 32, 35);
INSERT INTO `migracion_actas` VALUES (1, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240001', 'AGUIRRE LÓPEZ YESENIA', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (2, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240068', 'ALPUCHE RAMOS DANIELA', '', '', '', '', '', 'NA', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (3, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240002', 'ARIAS TORRES MARÍA FERNANDA', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (4, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (5, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240012', 'CANO OLÁN MARÍA DEL CARMEN', '', '', '', '', '98', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (6, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240023', 'CÓRDOVA CÓRDOVA ANTONIO', '', '', '', '', '85', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (7, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (8, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', '', '', '', '', '100', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (9, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (10, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240004', 'GARDUZA DE LA CRUZ NARCISO', '', '', '', '', '', '70', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (11, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', '', '', '', '', '100', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (12, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240066', 'ISIDRO LUCAS JESÚS', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (13, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240018', 'JÁCOME BASTIDA SALVADOR', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (14, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', '', '', '', '', '100', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (15, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', '', '', '', '', '87', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (16, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', '', '', '', '', '85', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (17, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (18, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '181240026', 'NOTARIO HERRERA JESÚS MANUEL', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (19, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (20, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (21, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240082', 'SÁNCHEZ ADORNO ALICIA', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (22, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '90', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (23, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240046', 'TORRES JIMÉNEZ ANA LUCERO', '', '', '', '', '100', '', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (24, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'M', '161240021', 'HERNÁNDEZ TORRES JUAN DANIEL', '', '', '', '', '', '75', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (25, 'SERVICIO AL CLIENTE  LOC-0928', 'VI A ILOG', 'SERVICIO AL CLIENTE  ', 4, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '', '', '', '78', 3, 'LOC-0928', 'ILOG', '2', 'SERVICIO AL CLIENTE  ', 33, 36);
INSERT INTO `migracion_actas` VALUES (1, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240020', 'CARTAGENA SEGURA LUZ ESTHER', '', '', '', '', '90', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (2, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240032', 'CUPIDO PÉREZ BETHZAYDA', '', '', '', '', '97', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (3, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'M', '171240046', 'HERNÁNDEZ OLAN JESÚS DAVID', '', '', '', '', '100', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (4, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240009', 'LÓPEZ JIMENÉZ ESTRELLITA DEL CARMEN', '', '', '', '', '100', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (5, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240016', 'LÓPEZ MORENO MARIA GUADALUPE', '', '', '', '', '85', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (6, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'M', '171240017', 'PARDO LEYVA PABLO', '', '', '', '', '95', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (7, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240044', 'RAMÓN LARIOS LIZBETH SUSANA', '', '', '', '', '95', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (8, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'M', '171240015', 'RAMOS MENDOZA MIGUEL ÁNGEL', '', '', '', '', '100', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (9, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', '', '', '', '', '85', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (10, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240014', 'VIDAL LEÓN VICTORIA', '', '', '', '', '85', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (11, 'ADMINISTRACIÓN ESTRATÉGICA  TDC-1804', 'VIII A ILOG', 'ADMINISTRACIÓN ESTRATÉGICA  ', 4, 'F', '171240004', 'ZAPATA BALAN GABRIELA', '', '', '', '', '97', '', 3, 'TDC-1804', 'ILOG', '2', 'ADMINISTRACIÓN ESTRATÉGICA  ', 34, 37);
INSERT INTO `migracion_actas` VALUES (1, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240035', 'CASTRO QUE JOSÉ CARLOS', '', '', '', '', '81', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (2, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'F', '181240048', 'CONCEPCIÓN SÁNCHEZ YULISSA', '', '', '', '', '94', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (3, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'F', '181240075', 'CORREA CADENA YULIANA', '', '', '', '', '93', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (4, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240054', 'GAMAS COLLADO EMMANUEL', '', '', '', '', '93', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (5, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'F', '181240065', 'GONZÁLEZ GONZÁLEZ XIOMARA ITZEL', '', '', '', '', '92', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (6, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240061', 'IZQUIERDO MENA JOSMAR JOEY', '', '', '', '', '96', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (7, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240057', 'KU SALAYA KEVIN YANG', '', '', '', '', '95', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (8, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240051', 'LÓPEZ CÓRDOVA IVÁN', '', '', '', '', '94', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (9, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240076', 'LÓPEZ JIMÉNEZ JOSÉ MANUEL', '', '', '', '', 'NA', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (10, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240032', 'PÉREZ CRUZ CARLOS AUGUSTO', '', '', '', '', '75', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (11, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240036', 'RAMÍREZ MORALES EMANUEL DEL CARMEN', '', '', '', '', '93', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (12, 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ASF-1014', 'VI A  IIAS', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 5, 'M', '181240063', 'RÁMIREZ OLAN JESSICA GUADALUPE', '', '', '', '', '77', '', 18, 'ASF-1014', 'IIAS', '1', 'INTRODUCCIÓN A LA AGRICULTURA PROTEGIDA  ', 35, 38);
INSERT INTO `migracion_actas` VALUES (1, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240003', 'COLLADO BROCA VICTOR ANDRES ', '', '', '', '', '88', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (2, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', '', '', '', '', 'NA', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (3, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240008', 'GAMAS COLLADO MARIO ELIAS ', '', '', '', '', '91', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (4, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO ', '', '', '', '', '88', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (5, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'F', '201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', '', '', '', '', '99', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (6, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO ', '', '', '', '', '90', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (7, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'F', '201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', '', '', '', '', '100', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (8, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'F', '201240015', 'HERRERA ROMERO NADIA CITLALI', '', '', '', '', 'NA', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (9, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'F', '201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA ', '', '', '', '', '96', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (10, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', '', '', '', '', '84', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (11, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240128', 'MORALES RODRÍGUEZ RAFAEL', '', '', '', '', '85', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (12, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'M', '201240022', 'REYES BECERRA ÁNGEL ', '', '', '', '', '95', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (13, 'BOTÁNICA APLICADA  ASF-1009', 'II A  IIAS', 'BOTÁNICA APLICADA  ', 5, 'F', '201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA ', '', '', '', '', '98', '', 18, 'ASF-1009', 'IIAS', '1', 'BOTÁNICA APLICADA  ', 36, 39);
INSERT INTO `migracion_actas` VALUES (1, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240035', 'CASTRO QUE JOSÉ CARLOS', '', '', '', '', '83', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (2, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'F', '181240048', 'CONCEPCIÓN SÁNCHEZ YULISSA', '', '', '', '', '94', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (3, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'F', '181240075', 'CORREA CADENA YULIANA', '', '', '', '', '96', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (4, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240054', 'GAMAS COLLADO EMMANUEL', '', '', '', '', '97', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (5, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'F', '181240065', 'GONZÁLEZ GONZÁLEZ XIOMARA ITZEL', '', '', '', '', '96', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (6, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240061', 'IZQUIERDO MENA JOSMAR JOEY', '', '', '', '', '97', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (7, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240057', 'KU SALAYA KEVIN YANG', '', '', '', '', '98', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (8, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240051', 'LÓPEZ CÓRDOVA IVÁN', '', '', '', '', '98', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (9, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240076', 'LÓPEZ JIMÉNEZ JOSÉ MANUEL', '', '', '', '', 'NA', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (10, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240032', 'PÉREZ CRUZ CARLOS AUGUSTO', '', '', '', '', '83', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (11, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240036', 'RAMÍREZ MORALES EMANUEL DEL CARMEN', '', '', '', '', '97', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (12, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240063', 'RÁMIREZ OLAN JESSICA GUADALUPE', '', '', '', '', '73', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (13, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '', '', '74', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (14, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '*', '', 'NA', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (15, 'TALLER DE INVESTIGACIÓN I  ACA-0909', 'VI A  IIAS', 'TALLER DE INVESTIGACIÓN I  ', 4, 'F', '161240042', 'PAZOS VILLEGAS GRECIA', '', '', '*', '', 'NA', '', 18, 'ACA-0909', 'IIAS', '1', 'TALLER DE INVESTIGACIÓN I  ', 37, 40);
INSERT INTO `migracion_actas` VALUES (1, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240001', 'AGUIRRE LÓPEZ YESENIA', '', '', '', '', '97', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (2, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240068', 'ALPUCHE RAMOS DANIELA', '', '', '', '', '74', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (3, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240002', 'ARIAS TORRES MARÍA FERNANDA', '', '', '', '', '74', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (4, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (5, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240012', 'CANO OLÁN MARÍA DEL CARMEN', '', '', '', '', '100', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (6, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240023', 'CÓRDOVA CÓRDOVA ANTONIO', '', '', '', '', '77', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (7, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', '', '', '', '', '99', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (8, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', '', '', '', '', '99', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (9, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', '', '', '', '', '96', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (10, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240004', 'GARDUZA DE LA CRUZ NARCISO', '', '', '', '', 'NA', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (11, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', '', '', '', '', '100', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (12, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240066', 'ISIDRO LUCAS JESÚS', '', '', '', '', '97', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (13, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240018', 'JÁCOME BASTIDA SALVADOR', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (14, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', '', '', '', '', '100', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (15, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (16, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240028', 'MÉNDEZ VIDAL ENIX RUBI', '', '', '', '', 'NA', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (17, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240074', 'MORALES DOMÍNGUEZ MIGUEL EDUARDO', '', '', '', '', '76', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (18, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', '', '', '', '', '98', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (19, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240026', 'NOTARIO HERRERA JESÚS MANUEL', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (20, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '', '', '90', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (21, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', '', '', '', '', '96', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (22, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', '', '', '', '', '98', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (23, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240082', 'SÁNCHEZ ADORNO ALICIA', '', '', '', '', '90', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (24, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (25, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '181240046', 'TORRES JIMÉNEZ ANA LUCERO', '', '', '', '', '100', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (26, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240001', 'ACOSTA GAMAS CHRISTIAN JAIR', '', '', '', '', '77', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (27, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240018', 'ALEGRÍA DE LA ROSA MIRIAN', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (28, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240002', 'ARCOS GONZÁLEZ VERONICA', '', '', '', '', '98', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (29, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240006', 'ESCOBAR SÁNCHEZ INGRID', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (30, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240007', 'FUENTES SÁNCHEZ CASSANDRA DEL CARMEN', '', '', '', '', '95', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (31, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240009', 'GARCÍA RODRÍGUEZ ALONDRA PALOMA', '', '', '', '', '94', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (32, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240020', 'GONZÁLEZ RODRÍGUEZ MELISSA DE JESÚS', '', '', '', '', '97', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (33, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240010', 'HERNÁNDEZ AGUILAR HECTOR DAVID', '', '', '', '', '83', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (34, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240011', 'HERNÁNDEZ BARAHONA KEYRI YULIANA', '', '', '', '', '90', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (35, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240014', 'LÓPEZ CRUZ JENNIFER', '', '', '', '', '99', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (36, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240015', 'MARTINEZ DE ESCOBAR ESPINOZA PERLA RUBI', '', '', '', '', '92', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (37, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240016', 'MENA GUTIÉRREZ GELISTLI ESTHER', '', '', '', '', '94', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (38, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240017', 'OCHOA JACINTO IRVING ALEXIS', '', '', '', '', '80', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (39, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240021', 'POSADA HERRERA RODRIGO IVÁN', '', '', '', '', '75', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (40, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240022', 'RAMÍREZ RODRÍGUEZ ESTEBAN', '', '', '', '', 'NA', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (41, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240024', 'RIOS SÁNCHEZ GABRIEL', '', '', '', '', '77', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (42, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '191240025', 'SALAYA CEFERINO ERIK ROBERTO', '', '', '', '', 'NA', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (43, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240028', 'SÁNCHEZ LÓPEZ ESTEFANIA', '', '', '', '', '98', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (44, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '191240029', 'VÁZQUEZ VELÁZQUEZ LANDY', '', '', '', '', '100', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (46, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '181240059', 'MONTIEL CUEVAS ÁNGEL RACIEL', '', '', '', '', '70', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (45, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'F', '161240042', 'PAZOS VILLEGAS GRECIA', '', '', '', '', 'NA', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (47, 'TRÁFICO Y TRANSPORTE  LOF-0931', 'IV A ILOG', 'TRÁFICO Y TRANSPORTE  ', 5, 'M', '161240031', 'SÁNCHEZ LÓPEZ EDUARDO', '', '', '', '', '98', '', 13, 'LOF-0931', 'ILOG', '2', 'TRÁFICO Y TRANSPORTE  ', 38, 41);
INSERT INTO `migracion_actas` VALUES (1, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240020', 'CARTAGENA SEGURA LUZ ESTHER', '', '', '', '', '93', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (2, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240032', 'CUPIDO PÉREZ BETHZAYDA', '', '', '', '', '99', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (3, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'M', '171240046', 'HERNÁNDEZ OLAN JESÚS DAVID', '', '', '', '', '100', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (4, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240009', 'LÓPEZ JIMENÉZ ESTRELLITA DEL CARMEN', '', '', '', '', '100', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (5, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240016', 'LÓPEZ MORENO MARIA GUADALUPE', '', '', '', '', '95', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (6, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'M', '171240017', 'PARDO LEYVA PABLO', '', '', '', '', '99', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (7, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240044', 'RAMÓN LARIOS LIZBETH SUSANA', '', '', '', '', '100', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (8, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'M', '171240015', 'RAMOS MENDOZA MIGUEL ÁNGEL', '', '', '', '', '100', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (9, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240008', 'SALOMÓN DOMÍNGUEZ TERESITA DE JESÚS', '', '', '', '', '95', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (10, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240014', 'VIDAL LEÓN VICTORIA', '', '', '', '', '77', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (11, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'F', '171240004', 'ZAPATA BALAN GABRIELA', '', '', '', '', '99', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (12, 'GEOGRAFÍA PARA EL TRANSPORTE  LOD-0915', 'VIII A ILOG', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 5, 'M', '161240031', 'SÁNCHEZ LÓPEZ EDUARDO', '', '', '', '', '98', '', 13, 'LOD-0915', 'ILOG', '2', 'GEOGRAFÍA PARA EL TRANSPORTE  ', 39, 42);
INSERT INTO `migracion_actas` VALUES (1, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'M', '191240049', 'GONZÁLEZ LÓPEZ ÁNGEL GABRIEL ', '', '', '', '', '87', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (2, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'F', '191240050', 'HEREDIA MENDEZ FLOR YULISA ', '', '', '', '', '93', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (3, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'M', '191240051', 'HERNÁNDEZ BROCA ANTONIO ', '', '', '', '', '98', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (4, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'F', '191240052', 'HERNÁNDEZ PABLO RUBI CRISTHELL ', '', '', '', '', '98', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (5, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'M', '191240055', 'PÉREZ VÁZQUEZ ALEXANDER', '', '', '', '', '100', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (6, 'HIDRAÚLICA  AEF-1036', 'VIII A IIAS', 'HIDRAÚLICA  ', 5, 'F', '191240058', 'VÁZQUEZ CASTILLO GLORIA ARACELY', '', '', '', '', 'NA', '', 13, 'AEF-1036', 'IIAS', '1', 'HIDRAÚLICA  ', 12, 43);
INSERT INTO `migracion_actas` VALUES (1, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240003', 'COLLADO BROCA VICTOR ANDRES ', '', '', '', '', '81', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (2, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', '', '', '', '', '', 'NA', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (3, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240008', 'GAMAS COLLADO MARIO ELIAS ', '', '', '', '', '', '79', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (4, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO ', '', '', '', '', '74', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (5, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'F', '201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', '', '', '', '', '97', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (6, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO ', '', '', '', '', '100', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (7, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'F', '201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', '', '', '', '', '70', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (8, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'F', '201240015', 'HERRERA ROMERO NADIA CITLALI', '', '', '', '', '74', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (9, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'F', '201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA ', '', '', '', '', '79', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (10, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', '', '', '', '', '89', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (11, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240128', 'MORALES RODRÍGUEZ RAFAEL', '', '', '', '', '', 'NA', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (12, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '201240022', 'REYES BECERRA ÁNGEL ', '', '', '', '', '77', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (13, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'F', '201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA ', '', '', '', '', '98', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (14, 'QUÍMICA ANALÍTICA ASF-1019', 'II A  IIAS', 'QUÍMICA ANALÍTICA ', 5, 'M', '191240055', 'PÉREZ VÁZQUEZ ALEXANDER', '', '', '*', '', '76', '', 12, 'ASF-1019', 'IIAS', '1', 'QUÍMICA ANALÍTICA ', 40, 44);
INSERT INTO `migracion_actas` VALUES (1, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240003', 'COLLADO BROCA VICTOR ANDRES ', '', '', '', '', '84', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (2, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', '', '', '', '', '', 'NA', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (3, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240008', 'GAMAS COLLADO MARIO ELIAS ', '', '', '', '', '84', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (4, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO ', '', '', '', '', '81', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (5, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'F', '201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', '', '', '', '', '99', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (6, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO ', '', '', '', '', '97', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (7, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'F', '201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', '', '', '', '', '75', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (8, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'F', '201240015', 'HERRERA ROMERO NADIA CITLALI', '', '', '', '', '', 'NA', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (9, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'F', '201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA ', '', '', '', '', '87', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (10, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', '', '', '', '', '93', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (11, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240128', 'MORALES RODRÍGUEZ RAFAEL', '', '', '', '', '', 'NA', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (12, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'M', '201240022', 'REYES BECERRA ÁNGEL ', '', '', '', '', '82', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (13, 'EDAFOLOGÍA AEF-1019', 'II A  IIAS', 'EDAFOLOGÍA ', 5, 'F', '201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA ', '', '', '', '', '95', '', 12, 'AEF-1019', 'IIAS', '1', 'EDAFOLOGÍA ', 41, 45);
INSERT INTO `migracion_actas` VALUES (1, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240035', 'CASTRO QUE JOSÉ CARLOS', '', '', '', '', '78', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (2, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'F', '181240048', 'CONCEPCIÓN SÁNCHEZ YULISSA', '', '', '', '', '91', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (3, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'F', '181240075', 'CORREA CADENA YULIANA', '', '', '', '', '91', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (4, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240054', 'GAMAS COLLADO EMMANUEL', '', '', '', '', '76', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (5, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'F', '181240065', 'GONZÁLEZ GONZÁLEZ XIOMARA ITZEL', '', '', '', '', '83', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (6, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240061', 'IZQUIERDO MENA JOSMAR JOEY', '', '', '', '', '91', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (7, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240057', 'KU SALAYA KEVIN YANG', '', '', '', '', '97', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (8, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240051', 'LÓPEZ CÓRDOVA IVÁN', '', '', '', '', '88', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (9, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240076', 'LÓPEZ JIMÉNEZ JOSÉ MANUEL', '', '', '', '', '', 'NA', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (10, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240032', 'PÉREZ CRUZ CARLOS AUGUSTO', '', '', '', '', '', '77', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (11, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240036', 'RAMÍREZ MORALES EMANUEL DEL CARMEN', '', '', '', '', '91', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (12, 'SISTEMAS DE RIEGO PRESURIZADO  ASF-1021', 'VI A  IIAS', 'SISTEMAS DE RIEGO PRESURIZADO  ', 5, 'M', '181240063', 'RÁMIREZ OLAN JESSICA GUADALUPE', '', '', '', '', '78', '', 12, 'ASF-1021', 'IIAS', '1', 'SISTEMAS DE RIEGO PRESURIZADO  ', 42, 46);
INSERT INTO `migracion_actas` VALUES (1, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', '', '', '', '', '91', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (2, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', '', '', '', '', '88', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (3, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', '', '', '', '', '97', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (4, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240035', 'JIMÉNEZ CRUZ RASHELL ', '', '', '', '', '98', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (5, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240039', 'NOTARIO HERRERA FERNANDO ', '', '', '', '', '95', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (6, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240041', 'PALMA ÁLVAREZ RUBICEL', '', '', '', '', '97', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (7, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240060', 'PARDO TOLEDO YAMILET', '', '', '', '', '70', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (8, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240045', 'RAMOS COLIN VICTOR MANUEL ', '', '', '', '', '95', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (9, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', '', '', '', '', '94', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (10, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240044', 'RUEDA RAMOS LEONEL ANTONIO ', '', '', '', '', '97', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (11, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', '', '', '', '', '79', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (12, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE ', '', '', '', '', '96', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (13, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO ', '', '', '', '', '80', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (14, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'F', '191240047', 'VALENZUELA CÓRDOVA ÁNGELA ', '', '', '', '', '94', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (15, 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  PED-1002', 'IV A  IPET', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 5, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '*', '', '93', '', 17, 'PED-1002', 'IPET', '3', 'ADMINISTRACIÓN DE LA SEGURIDAD Y PROTECCIÓN AMBIENTAL  ', 43, 47);
INSERT INTO `migracion_actas` VALUES (1, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240035', 'CASTRO QUE JOSÉ CARLOS', '', '', '', '', '85', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (2, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'F', '181240048', 'CONCEPCIÓN SÁNCHEZ YULISSA', '', '', '', '', '90', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (3, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'F', '181240075', 'CORREA CADENA YULIANA', '', '', '', '', '90', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (4, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240054', 'GAMAS COLLADO EMMANUEL', '', '', '', '', '84', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (5, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'F', '181240065', 'GONZÁLEZ GONZÁLEZ XIOMARA ITZEL', '', '', '', '', '91', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (6, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240061', 'IZQUIERDO MENA JOSMAR JOEY', '', '', '', '', '95', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (7, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240057', 'KU SALAYA KEVIN YANG', '', '', '', '', '98', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (8, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240051', 'LÓPEZ CÓRDOVA IVÁN', '', '', '', '', '90', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (9, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240076', 'LÓPEZ JIMÉNEZ JOSÉ MANUEL', '', '', '', '', '80', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (10, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240032', 'PÉREZ CRUZ CARLOS AUGUSTO', '', '', '', '', '90', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (11, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240036', 'RAMÍREZ MORALES EMANUEL DEL CARMEN', '', '', '', '', '97', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (12, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '181240063', 'RÁMIREZ OLAN JESSICA GUADALUPE', '', '', '', '', 'NA', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (13, 'DESARROLLO COMUNITARIO ASD-1007', 'VI A  IIAS', 'DESARROLLO COMUNITARIO ', 5, 'M', '161240003', 'GONZÁLEZ GIL ARTURO', '', '', '', '', '75', '', 17, 'ASD-1007', 'IIAS', '1', 'DESARROLLO COMUNITARIO ', 44, 48);
INSERT INTO `migracion_actas` VALUES (1, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240034', 'CUSTODIO GARCÍA PRISCILA', '', '', '', '', '99', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (2, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', '', '', '', '', '98', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (3, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', '', '', '', '', '98', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (4, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '211240014', 'NOTARIO HAAS IRWIN GEOVANNI', '', '', '', '', '88', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (5, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (6, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240053', 'PÉREZ PÉREZ JACQUELINE', '', '', '', '', '100', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (7, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240006', 'PIÑERA CRUZ CARLOS ARTURO', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (8, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240055', 'REYES DE DIOS  HEIDY GISELLE', '', '', '', '', '100', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (9, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240056', 'ROSAS ORDOÑEZ ARTURO', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (10, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240058', 'SANTIAGO ACOSTA MARLENE', '', '', '', '', '85', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (11, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240061', 'SOLANO MÉNDEZ CRISTIAN ', '', '', '', '', '100', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (12, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (13, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240067', 'VALENZUELA CARRETO KENIA LETICIA ', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (14, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '201240068', 'VIDAL LEÓN LIZBETH', '', '', '', '', '92', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (15, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '201240069', 'ZENTENO RAMÓN DAMIÁN', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (16, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '211240001', 'MORENO GOMEZ DOLORES RAQUEL ', '', '', '', '', '83', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (17, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (18, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '211240005', 'MORALES TOSCA BERENICE', '', '', '', '', '86', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (19, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'M', '211240006', 'SILVA ORAMAS ERNESTO ALONSO', '', '', '', '', 'NA', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (20, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', '', '', '', '', '99', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (21, 'DESARROLLO HUMANO Y ORGANIZACIONAL  LOC-0908', 'II A  ILOG', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 4, 'F', '211240009', 'VERA ORTÍZ DULCE MARIA', '', '', '', '', '100', '', 4, 'LOC-0908', 'ILOG', '2', 'DESARROLLO HUMANO Y ORGANIZACIONAL  ', 45, 49);
INSERT INTO `migracion_actas` VALUES (1, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240030', 'CASTILLO LÓPEZ LITZY DEL CARMEN', '', '', '', '', '90', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (2, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240068', 'GEORGANA  ALVARADO JUAN JOSÉ', '', '', '', '', 'NA', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (3, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240064', 'HERNÁNDEZ RAMOS JOSÉ IGNACIO', '', '', '', '', '91', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (4, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240013', 'HERNÁNDEZ ZAMUDIO ANA PATRICIA', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (5, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240035', 'JIMÉNEZ CRUZ RASHELL ', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (6, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240036', 'LÓPEZ AGUILAR MARIO EMILIANO', '', '', '', '', 'NA', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (7, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240038', 'NARANJO TORRUCO MERCEDES ', '', '', '', '', 'NA', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (8, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240039', 'NOTARIO HERRERA FERNANDO ', '', '', '', '', '95', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (9, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240041', 'PALMA ÁLVAREZ RUBICEL', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (10, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240060', 'PARDO TOLEDO YAMILET', '', '', '', '', '70', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (11, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240045', 'RAMOS COLIN VICTOR MANUEL ', '', '', '', '', '94', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (12, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240023', 'RAMOS HERNÁNDEZ FLOR MAGDALY', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (13, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240044', 'RUEDA RAMOS LEONEL ANTONIO ', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (14, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240061', 'SÁNCHEZ MARTÍNEZ ANYI MICHELL', '', '', '', '', '76', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (15, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240031', 'SÁNCHEZ RODRÍGUEZ HENRY GUADALUPE ', '', '', '', '', '94', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (16, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '191240043', 'SÁNCHEZ SALAYA RAFAEL MAURICIO ', '', '', '', '', '76', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (17, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'F', '191240047', 'VALENZUELA CÓRDOVA ÁNGELA ', '', '', '', '', '95', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (18, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '*', '', 'NA', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (19, 'DESARROLLO SUSTENTABLE  ACD-0908', 'IV A  IPET', 'DESARROLLO SUSTENTABLE  ', 5, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '98', '', 17, 'ACD-0908', 'IPET', '3', 'DESARROLLO SUSTENTABLE  ', 46, 50);
INSERT INTO `migracion_actas` VALUES (1, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240003', 'COLLADO BROCA VICTOR ANDRES ', '', '', '', '', '86', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (2, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240004', 'DE LA CRUZ PÉREZ JOSÉ MAURICIO', '', '', '', '', 'NA', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (3, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240008', 'GAMAS COLLADO MARIO ELIAS ', '', '', '', '', '82', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (4, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240009', 'GAMAS PÉREZ CRISTIAN ALEJANDRO ', '', '', '', '', '84', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (5, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'F', '201240012', 'GARDUZA SÁNCHEZ VANESSA AMAIRANY', '', '', '', '', '91', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (6, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240013', 'HERNÁNDEZ CONCEPCIÓN HUMBERTO ', '', '', '', '', '94', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (7, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'F', '201240014', 'HERNÁNDEZ DE LOS SANTOS KAREN MONSERRAT', '', '', '', '', '71', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (8, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'F', '201240015', 'HERRERA ROMERO NADIA CITLALI', '', '', '', '', 'NA', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (9, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'F', '201240016', 'JIMÉNEZ LÓPEZ VIRIDIANA ', '', '', '', '', '92', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (10, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240019', 'MENA DE LA ROSA JOSÉ FRANCISCO', '', '', '', '', '90', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (11, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240128', 'MORALES RODRÍGUEZ RAFAEL', '', '', '', '', 'NA', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (12, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'M', '201240022', 'REYES BECERRA ÁNGEL ', '', '', '', '', '94', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (13, 'ELEMENTOS DE TERMODINÁMICA ASF-1009', 'II A  IIAS', 'ELEMENTOS DE TERMODINÁMICA ', 5, 'F', '201240023', 'RUIZ MENDOZA ZAIRA DEL ALBA ', '', '', '', '', '95', '', 17, 'ASF-1009', 'IIAS', '1', 'ELEMENTOS DE TERMODINÁMICA ', 47, 51);
INSERT INTO `migracion_actas` VALUES (1, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240034', 'CUSTODIO GARCÍA PRISCILA', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (2, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240048', 'LÓPEZ JIMÉNEZ MARIO ÁNGEL', '', '', '', '', '99', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (3, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240052', 'NARANJO ESCUDERO MIGUEL ALEJANDRO', '', '', '', '', '99', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (4, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '211240014', 'NOTARIO HAAS IRWIN GEOVANNI', '', '', '', '', '88', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (5, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240126', 'PÉREZ HERNÁNDEZ LARISSA YAZMIN', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (6, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240053', 'PÉREZ PÉREZ JACQUELINE', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (7, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240006', 'PIÑERA CRUZ CARLOS ARTURO', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (8, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240055', 'REYES DE DIOS  HEIDY GISELLE', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (9, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240056', 'ROSAS ORDOÑEZ ARTURO', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (10, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240058', 'SANTIAGO ACOSTA MARLENE', '', '', '', '', '89', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (11, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240061', 'SOLANO MÉNDEZ CRISTIAN ', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (12, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240066', 'VALENCIA VAZCONCELOS ERICK EDUARDO', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (13, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240067', 'VALENZUELA CARRETO KENIA LETICIA ', '', '', '', '', '75', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (14, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '201240068', 'VIDAL LEÓN LIZBETH', '', '', '', '', '94', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (15, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '201240069', 'ZENTENO RAMÓN DAMIÁN', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (16, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '211240001', 'MORENO GOMEZ DOLORES RAQUEL ', '', '', '', '', '82', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (17, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '211240002', 'MARTÍNEZ GÓMEZ VICENTE ALEJANDRO', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (18, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '211240005', 'MORALES TOSCA BERENICE', '', '', '', '', '87', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (19, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'M', '211240006', 'SILVA ORAMAS ERNESTO ALONSO', '', '', '', '', 'NA', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (20, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '211240007', 'DE LA CRUZ OLIVA IRMA PAOLA', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (21, 'TALLER DE ÉTICA   ACA-0907', 'IIA  ILOG', 'TALLER DE ÉTICA   ', 5, 'F', '211240009', 'VERA ORTÍZ DULCE MARIA', '', '', '', '', '100', '', 4, 'ACA-0907', 'ILOG', '2', 'TALLER DE ÉTICA   ', 48, 52);
INSERT INTO `migracion_actas` VALUES (1, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240001', 'AGUIRRE LÓPEZ YESENIA', '', '', '', '', '95', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (2, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240068', 'ALPUCHE RAMOS DANIELA', '', '', '', '', 'NA', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (3, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240002', 'ARIAS TORRES MARÍA FERNANDA', '', '', '', '', '81', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (4, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240007', 'BOCANEGRA SÁNCHEZ KAREN ITZEL', '', '', '', '', '92', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (5, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240012', 'CANO OLÁN MARÍA DEL CARMEN', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (6, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '181240023', 'CÓRDOVA CÓRDOVA ANTONIO', '', '', '', '', '87', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (7, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240052', 'CÓRDOVA MÉNDEZ FRANCISCA', '', '', '', '', '94', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (8, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240073', 'DE LA FUENTE MARTÍNEZ OSIRIS ALEJANDRA', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (9, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240013', 'DOMÍNGUEZ PÉREZ MERARI SUNNEY', '', '', '', '', '92', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (10, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '181240004', 'GARDUZA DE LA CRUZ NARCISO', '', '', '', '', '92', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (11, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240019', 'HERNÁNDEZ RAMÍREZ HANNIA ISABEL', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (12, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '181240066', 'ISIDRO LUCAS JESÚS', '', '', '', '', '91', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (13, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '181240018', 'JÁCOME BASTIDA SALVADOR', '', '', '', '', '95', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (14, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240047', 'MARTÍNEZ LÓPEZ ANDREA BERENICE', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (15, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240055', 'MARTÍNEZ PAYRÓ ANGIE FERNANDA', '', '', '', '', '89', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (16, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240044', 'MORALES LARA ROSA MARÍA DE LOS ÁNGELES', '', '', '', '', '87', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (17, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '181240026', 'NOTARIO HERRERA JESÚS MANUEL', '', '', '', '', '98', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (18, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240009', 'OSORIO SALAYA ITZAYANA DEL CARMEN', '', '', '', '', '90', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (19, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240020', 'RAMOS LÓPEZ RUBI DEL CARMEN', '', '', '', '', '90', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (20, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240045', 'ROSALDO SÁNCHEZ YULIANA DEL CARMEN', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (21, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240082', 'SÁNCHEZ ADORNO ALICIA', '', '', '', '', '91', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (22, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240008', 'SÁNCHEZ PABLO ANA PATRICIA', '', '', '', '', '95', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (23, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'F', '181240046', 'TORRES JIMÉNEZ ANA LUCERO', '', '', '', '', '100', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (24, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '161240031', 'SÁNCHEZ LÓPEZ EDUARDO', '', '', '', '', '90', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (25, 'LEGISLACIÓN ADUANERA   LOD-0923', 'VI A  ILOG', 'LEGISLACIÓN ADUANERA   ', 5, 'M', '161240021', 'HERNÁNDEZ TORRES JUAN DANIEL', '', '', '', '', '89', '', 4, 'LOD-0923', 'ILOG', '2', 'LEGISLACIÓN ADUANERA   ', 49, 53);
INSERT INTO `migracion_actas` VALUES (1, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240027', 'ACOSTA DE LA CRUZ IRVIN ALEJANDRO', '', '', '', '', '92', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (2, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240015', 'CANO LÓPEZ JIREHT SHIKARI', '', '', '', '', '95', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (3, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240031', 'CHAN ALEJANDRO IRVING UZIEL', '', '', '', '', '100', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (4, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240033', 'CÓRDOVA ÓLAN CARLOS ALBERTO', '', '', '', '', '97', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (5, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'F', '181240050', 'GALLEGOS SÁNCHEZ KARLA GUADALUPE', '', '', '', '', '93', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (6, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240040', 'GÓMEZ GÓMEZ HUMBERTO', '', '', '', '', '100', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (7, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240043', 'LARA ADORNO JOSÉ TRINIDAD', '', '', '', '', '90', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (8, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240070', 'LÓPEZ SEGURA JOSÉ ARMANDO', '', '', '', '', '90', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (9, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'F', '181240058', 'MÁRQUEZ GARCÍA JOSEFINA', '', '', '', '', '91', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (10, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240060', 'MARTÍNEZ GARCÍA JUAN DIEGO', '', '', '', '', '81', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (11, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'F', '181240016', 'RUIZ TORRES PATSY MINELIZ', '', '', '', '', '100', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (12, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240069', 'SOLIS ARELLANO ISRAEL', '', '', '', '', '93', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (13, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '181240041', 'TIQUET RAMÍREZ LÁZARO', '', '', '', '', '85', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (14, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'F', '191240063', 'DE LA CRUZ RODRÍGUEZ LAURA CECILIA', '', '', '', '', 'NA', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (15, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '161240002', 'CRUZ RAMOS ERICK FABIAN', '', '', '*', '', '90', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (16, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', '161240029', 'RICARDEZ GARCÍA JOSÉ FRANCISCO', '', '', '*', '', '83', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);
INSERT INTO `migracion_actas` VALUES (17, 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  PEQ-1018', 'VI A  IPET', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 3, 'M', 'B156P1225', 'MERCADO ESCAMILLA LUIS EDUARDO', '', '', '', '', '100', '', 4, 'PEQ-1018', 'IPET', '3', 'LEGISLACIÓN EN LA INDUSTRIA PETROLERA  ', 50, 54);

-- ----------------------------
-- Table structure for modulos_rol
-- ----------------------------
DROP TABLE IF EXISTS `modulos_rol`;
CREATE TABLE `modulos_rol`  (
  `idmodulo` int(11) NOT NULL,
  `desc_modulo` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idmodulo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modulos_rol
-- ----------------------------

-- ----------------------------
-- Table structure for permisos_rol
-- ----------------------------
DROP TABLE IF EXISTS `permisos_rol`;
CREATE TABLE `permisos_rol`  (
  `idpermiso` int(11) NOT NULL,
  `idmodulo` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `ALTA` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `BAJA` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `MODIFICACION` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `CONSULTA` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `EJECUCION` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idpermiso`) USING BTREE,
  INDEX `fk_permisos_rol_modulos_rol1_idx`(`idmodulo`) USING BTREE,
  INDEX `fk_permisos_rol_cat_roles1_idx`(`idrol`) USING BTREE,
  CONSTRAINT `fk_permisos_rol_cat_roles1` FOREIGN KEY (`idrol`) REFERENCES `cat_roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_rol_modulos_rol1` FOREIGN KEY (`idmodulo`) REFERENCES `modulos_rol` (`idmodulo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permisos_rol
-- ----------------------------

-- ----------------------------
-- Table structure for profesores
-- ----------------------------
DROP TABLE IF EXISTS `profesores`;
CREATE TABLE `profesores`  (
  `idprofesor` int(11) NOT NULL AUTO_INCREMENT,
  `curp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_profesor` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  `cat_dep` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`idprofesor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profesores
-- ----------------------------
INSERT INTO `profesores` VALUES (1, 'jedive.ac', 'Jedive', 'Abarca', 'Córdova', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (2, 'juan.ag', 'Juan Carlos', 'Adorno', 'Guerra', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (3, 'francisco.ar', 'Francisco', 'Alvarado', 'Rueda', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (4, 'patricia.cc', 'Patricia del Carmen', 'Cadenas', 'Cadenas', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (5, 'leydi.cm', 'Leydi Susana', 'Castillo', 'Montero', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (6, 'nadxieli.cc', 'Nadxieli Guadalupe', 'Chevez', 'Cruz', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (7, 'juan.ca', 'Juan Ángel', 'Cruz', 'Alejandro', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (8, 'doraliz.sm', 'Doraliz', 'De los Santos', 'Mena', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (9, 'luis.eg', 'Luis Alberto', 'Escudero', 'González', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (10, 'gustavo.hc', 'Gustavo Adolfo', 'Hernández', 'Cadenas', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (11, 'maria.ih', 'Ma. Del Carmen', 'Izquierdo', 'Hernández', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (12, 'raquel.jr', 'Raquel', 'Jiménez', 'Ramírez', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (13, 'yulma.jl', 'Yulma', 'Jiménez', 'Lara', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (14, 'guadalupe.mv', 'Guadalupe', 'Martínez', 'Vichel', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (15, 'braulio.mg', 'Braulio Alberto', 'Mateos', 'Gallegos', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (16, 'jose.mm', 'José Alberto', 'Méndez', 'Montiel', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (17, 'jose.nt', 'José', 'Notario', 'Torres', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (18, 'maricela.pp', 'Maricela', 'Pablo', 'Pérez', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (19, 'alexis.pm', 'Alexis', 'Piña', 'Marcial', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (20, 'pedro.sm', 'Pedro', 'Salvador', 'Morales', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (21, 'bladimir.sr', 'Bladimir', 'Sánchez', 'Ramírez', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (22, 'jose.th', 'José Javier', 'Torres', 'Hernández', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (23, 'leticia.va', 'Leticia', 'Valenzuela', 'Alamilla', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (24, 'lorena.vh', 'Lorena', 'Vázquez', 'Hernández', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (25, 'manuel.vl', 'Manuel Ernesto', 'Villalobos', 'López', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (26, 'marcela.zs', 'Marcela', 'Zamora', 'Santiago', NULL, NULL, NULL, '1');
INSERT INTO `profesores` VALUES (28, '', 'Por asignar', ' ', ' ', '2021-08-18 08:52:33', '2021-08-18 08:52:33', 'VIG', '1');
INSERT INTO `profesores` VALUES (29, '  ', '  ', '  ', '  ', '2022-02-01 10:30:35', '2022-02-01 10:30:35', 'VIG', '1');
INSERT INTO `profesores` VALUES (37, 'jose', 'josefo', 'jose', 'jose', '2022-06-16 00:00:00', '2022-06-17 05:35:40', 'VIG', '1');
INSERT INTO `profesores` VALUES (38, 'juan', 'juan', 'juan', 'juan', '2022-06-17 05:37:13', NULL, 'VIG', '1');
INSERT INTO `profesores` VALUES (43, 'raul', 'raulos', 'rauasa', 'asasda', '2022-06-19 11:25:32', '2022-06-19 11:41:16', 'VIG', '1');
INSERT INTO `profesores` VALUES (44, 'REL', 'REL', 'REL', 'REL', '2022-06-19 11:48:58', NULL, 'VIG', '1');

-- ----------------------------
-- Table structure for profesores_seguimientos
-- ----------------------------
DROP TABLE IF EXISTS `profesores_seguimientos`;
CREATE TABLE `profesores_seguimientos`  (
  `idseguimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idciclo` int(11) NULL DEFAULT NULL,
  `idprofesor` int(11) NULL DEFAULT NULL,
  `seguimiento` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bandera` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idseguimiento`) USING BTREE,
  INDEX `idciclo`(`idciclo`) USING BTREE,
  INDEX `idprofesor`(`idprofesor`) USING BTREE,
  CONSTRAINT `idciclo` FOREIGN KEY (`idciclo`) REFERENCES `ciclo` (`idciclo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `idprofesor` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profesores_seguimientos
-- ----------------------------
INSERT INTO `profesores_seguimientos` VALUES (33, 3, 29, '1', '0');
INSERT INTO `profesores_seguimientos` VALUES (34, 3, 1, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (35, 3, 2, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (36, 3, 3, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (37, 3, 4, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (38, 3, 5, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (39, 3, 6, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (40, 3, 7, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (41, 3, 8, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (42, 3, 9, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (43, 3, 10, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (44, 3, 11, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (45, 3, 12, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (46, 3, 13, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (47, 3, 14, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (48, 3, 15, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (49, 3, 16, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (50, 3, 17, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (51, 3, 18, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (52, 3, 19, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (53, 3, 20, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (54, 3, 21, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (55, 3, 22, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (56, 3, 23, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (57, 3, 24, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (58, 3, 25, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (59, 3, 26, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (60, 3, 28, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (61, 3, 37, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (62, 3, 38, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (63, 3, 43, '1', '1');
INSERT INTO `profesores_seguimientos` VALUES (64, 3, 44, '1', '1');

-- ----------------------------
-- Table structure for roles_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `roles_usuarios`;
CREATE TABLE `roles_usuarios`  (
  `idusuario` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  INDEX `fk_table1_usuarios1_idx`(`idusuario`) USING BTREE,
  INDEX `fk_table1_cat_roles1_idx`(`idrol`) USING BTREE,
  CONSTRAINT `fk_table1_cat_roles1` FOREIGN KEY (`idrol`) REFERENCES `cat_roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles_usuarios
-- ----------------------------
INSERT INTO `roles_usuarios` VALUES (5, 1);
INSERT INTO `roles_usuarios` VALUES (6, 3);
INSERT INTO `roles_usuarios` VALUES (7, 3);
INSERT INTO `roles_usuarios` VALUES (8, 3);
INSERT INTO `roles_usuarios` VALUES (9, 3);
INSERT INTO `roles_usuarios` VALUES (10, 3);
INSERT INTO `roles_usuarios` VALUES (11, 3);
INSERT INTO `roles_usuarios` VALUES (12, 3);
INSERT INTO `roles_usuarios` VALUES (13, 3);
INSERT INTO `roles_usuarios` VALUES (14, 3);
INSERT INTO `roles_usuarios` VALUES (15, 3);
INSERT INTO `roles_usuarios` VALUES (16, 3);
INSERT INTO `roles_usuarios` VALUES (17, 3);
INSERT INTO `roles_usuarios` VALUES (18, 3);
INSERT INTO `roles_usuarios` VALUES (19, 3);
INSERT INTO `roles_usuarios` VALUES (20, 3);
INSERT INTO `roles_usuarios` VALUES (21, 3);
INSERT INTO `roles_usuarios` VALUES (22, 3);
INSERT INTO `roles_usuarios` VALUES (23, 3);
INSERT INTO `roles_usuarios` VALUES (24, 3);
INSERT INTO `roles_usuarios` VALUES (25, 3);
INSERT INTO `roles_usuarios` VALUES (26, 3);
INSERT INTO `roles_usuarios` VALUES (27, 3);
INSERT INTO `roles_usuarios` VALUES (28, 3);
INSERT INTO `roles_usuarios` VALUES (29, 3);
INSERT INTO `roles_usuarios` VALUES (30, 3);
INSERT INTO `roles_usuarios` VALUES (31, 3);
INSERT INTO `roles_usuarios` VALUES (32, 1);
INSERT INTO `roles_usuarios` VALUES (33, 1);
INSERT INTO `roles_usuarios` VALUES (34, 2);
INSERT INTO `roles_usuarios` VALUES (35, 4);
INSERT INTO `roles_usuarios` VALUES (36, 2);
INSERT INTO `roles_usuarios` VALUES (37, 1);

-- ----------------------------
-- Table structure for semestres
-- ----------------------------
DROP TABLE IF EXISTS `semestres`;
CREATE TABLE `semestres`  (
  `idcarrera` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `num_semestre` int(11) NOT NULL,
  PRIMARY KEY (`idcarrera`, `idmateria`) USING BTREE,
  INDEX `fk_semestre_carrera_idx`(`idcarrera`) USING BTREE,
  INDEX `fk_semestre_materia1_idx`(`idmateria`) USING BTREE,
  CONSTRAINT `fk_semestre_carrera` FOREIGN KEY (`idcarrera`) REFERENCES `cat_carreras` (`idcarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_semestre_materia1` FOREIGN KEY (`idmateria`) REFERENCES `cat_materias` (`idmateria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of semestres
-- ----------------------------

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `authKey` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `accessToken` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activate` tinyint(1) NULL DEFAULT NULL,
  `curp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_registro` datetime NULL DEFAULT NULL,
  `fecha_actualizacion` datetime NULL DEFAULT NULL,
  `verification_code` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (5, 'administrador', 'jcgalvezocampo@gmail.com', 'itNwR7nhba4nc', '', 'ae6ed01d0462b66a67b4684ee50901764eaf7e2449a7cd7cef9ed285c70e75f3ed4d8e6a6b73b154a5db93dd867420f1b44816d43c1d7e3c621c696a42c1ba666ebfd7d152b18301febabc2fae14a3de9656843c436b1d0718195d5a981a816d5b15bbd7', 'c98148bf9f22e572fa4123e6e6a05e9ac144936f8d84e5f60a0d1b03c2840953219ce83b84fb2413ec9ebaa7ef017451a910c28b43ca026302dacd2371d2f48f4543f0ed5cb9c89f34f93b85207afa717a60a812ac041d1a735c599e30d02b0f6f6735ae', 1, 'administrador', NULL, NULL, 'f0ae8928');
INSERT INTO `usuarios` VALUES (6, 'jedive.ac', '', 'itNwR7nhba4nc', '', '', '', 1, 'jedive.ac', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (7, 'juan.ag', '', 'itNwR7nhba4nc', '', '', '', 1, 'juan.ag', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (8, 'francisco.ar', '', 'itNwR7nhba4nc', '', '', '', 1, 'francisco.ar', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (9, 'patricia.cc', '', 'itNwR7nhba4nc', '', '', '', 1, 'patricia.cc', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (10, 'leydi.cm', '', 'itNwR7nhba4nc', '', '', '', 1, 'leydi.cm', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (11, 'nadxieli.cc', '', 'itNwR7nhba4nc', '', '', '', 1, 'nadxieli.cc', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (12, 'juan.ca', '', 'itNwR7nhba4nc', '', '', '', 1, 'juan.ca', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (13, 'doraliz.sm', '', 'itNwR7nhba4nc', '', '', '', 1, 'doraliz.sm', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (14, 'luis.eg', '', 'itNwR7nhba4nc', '', '', '', 1, 'luis.eg', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (15, 'gustavo.hc', '', 'itNwR7nhba4nc', '', '', '', 1, 'gustavo.hc', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (16, 'maria.ih', '', 'itNwR7nhba4nc', '', '', '', 1, 'maria.ih', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (17, 'yulma.jl', '', 'itNwR7nhba4nc', '', '', '', 1, 'yulma.jl', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (18, 'raquel.jr', '', 'itNwR7nhba4nc', '', '', '', 1, 'raquel.jr', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (19, 'guadalupe.mv', '', 'itNwR7nhba4nc', '', '', '', 1, 'guadalupe.mv', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (20, 'braulio.mg', '', 'itNwR7nhba4nc', '', '', '', 1, 'braulio.mg', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (21, 'jose.mm', '', 'itNwR7nhba4nc', '', '', '', 1, 'jose.mm', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (22, 'jose.nt', '', 'itNwR7nhba4nc', '', '', '', 1, 'jose.nt', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (23, 'maricela.pp', '', 'itNwR7nhba4nc', '', '', '', 1, 'maricela.pp', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (24, 'alexis.pm', '', 'itNwR7nhba4nc', '', '', '', 1, 'alexis.pm', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (25, 'pedro.sm', '', 'itNwR7nhba4nc', '', '', '', 1, 'pedro.sm', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (26, 'bladimir.sr', '', 'itNwR7nhba4nc', '', '', '', 1, 'bladimir.sr', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (27, 'jose.th', '', 'itNwR7nhba4nc', '', '', '', 1, 'jose.th', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (28, 'leticia.va', '', 'itNwR7nhba4nc', '', '', '', 1, 'leticia.va', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (29, 'lorena.vh', '', 'itNwR7nhba4nc', '', '', '', 1, 'lorena.vh', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (30, 'manuel.vl', '', 'itNwR7nhba4nc', '', '', '', 1, 'manuel.vl', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (31, 'marcela.zs', '', 'itNwR7nhba4nc', '', '', '', 1, 'marcela.zs', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (32, 'glopez', '', 'itNwR7nhba4nc', '', '', '', 1, 'glopez', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (33, 'administrador', '', 'itNwR7nhba4nc', '', '', '', 1, 'administrador', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (34, 'servicios escolares', '', 'itNwR7nhba4nc', '', '', '', 1, 'servicios.escolares', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (35, 'division de estudios', '', 'itNwR7nhba4nc', '', '', '', 1, 'division.estudios', NULL, NULL, '');
INSERT INTO `usuarios` VALUES (36, 'jefe.academico', 'ith@ith.edu.mx', 'itNwR7nhba4nc', NULL, NULL, NULL, 1, 'jefe.academico', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (37, 'juango', 'juan.go@mail.com', 'itV.t3tjyEkcE', 'VIG', NULL, NULL, 1, 'juango', '2022-06-29 07:12:50', NULL, NULL);

-- ----------------------------
-- View structure for boleta_detalle_v
-- ----------------------------
DROP VIEW IF EXISTS `boleta_detalle_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_detalle_v` AS select `actas_calificaciones`.`idestudiante` AS `idestudiante`,`grupos`.`idciclo` AS `idciclo`,`cat_materias`.`desc_materia` AS `desc_materia`,`cat_materias`.`cve_materia` AS `cve_materia`,`grupos`.`desc_grupo_corto` AS `desc_grupo`,case when `actas_calificaciones`.`idopcion_curso` = 2 then 'REP' when `actas_calificaciones`.`idopcion_curso` = 3 then 'ESP' when `actas_calificaciones`.`idopcion_curso` = 4 then 'DUAL' when `actas_calificaciones`.`idopcion_curso` = 5 then 'AUT' else 'ORD' end AS `opc_curso`,`cat_materias`.`creditos` AS `creditos`,if(`actas_calificaciones`.`seg_opt` = '',`actas_calificaciones`.`pri_opt`,`actas_calificaciones`.`seg_opt`) AS `calificacion` from ((`actas_calificaciones` join `grupos`) join `cat_materias`) where `actas_calificaciones`.`idgrupo` = `grupos`.`idgrupo` and `grupos`.`idmateria` = `cat_materias`.`idmateria`;

-- ----------------------------
-- View structure for boleta_encabezado_v
-- ----------------------------
DROP VIEW IF EXISTS `boleta_encabezado_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_encabezado_v` AS select `a`.`idestudiante` AS `idestudiante`,`a`.`nombre_estudiante` AS `nombre_estudiante`,`b`.`desc_carrera` AS `desc_carrera`,`b`.`plan_estudios` AS `plan_estudios`,`a`.`num_semestre` AS `num_semestre` from (`estudiantes` `a` join `cat_carreras` `b`);

-- ----------------------------
-- View structure for boleta_estudiante_encabezado
-- ----------------------------
DROP VIEW IF EXISTS `boleta_estudiante_encabezado`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_estudiante_encabezado` AS select `ciclo`.`idciclo` AS `idciclo`,`ciclo`.`desc_ciclo` AS `desc_ciclo`,`estudiantes`.`nombre_estudiante` AS `nombre_estudiante`,`estudiantes`.`idestudiante` AS `idestudiante`,`estudiantes`.`num_semestre` AS `num_semestre`,`cat_carreras`.`desc_carrera` AS `desc_carrera`,`cat_carreras`.`plan_estudios` AS `plan_estudios`,`grupos`.`desc_grupo` AS `desc_grupo` from (((`estudiantes` join `cat_carreras` on(`estudiantes`.`idcarrera` = `cat_carreras`.`idcarrera`)) join `grupos` on(`cat_carreras`.`idcarrera` = `grupos`.`idcarrera`)) join `ciclo` on(`grupos`.`idciclo` = `ciclo`.`idciclo`));

-- ----------------------------
-- View structure for horario_estudiante_v
-- ----------------------------
DROP VIEW IF EXISTS `horario_estudiante_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `horario_estudiante_v` AS SELECT
	`a`.`idestudiante` AS `idestudiante`,
	`b`.`idciclo` AS `idciclo`,
	`b`.`num_semestre` AS `num_semestre`,
	`b`.`idmateria` AS `idmateria`,
	`c`.`desc_materia` AS `desc_materia`,
	`c`.`cve_materia` AS `cve_materia`,
	`b`.`desc_grupo_corto` AS `desc_grupo_corto`,
	`b`.`desc_grupo` AS `desc_grupo`,
	`b`.`aula` AS `aula`,
	`a`.`idopcion_curso` AS `idopcion_curso`,
CASE
		
		WHEN `a`.`idopcion_curso` = 2 THEN
		'R' 
		WHEN `a`.`idopcion_curso` = 3 THEN
		'E' 
	END AS `desc_opcion_curso_corto`,
	`c`.`creditos` AS `creditos`,
	`b`.`lunes` AS `lunes`,
	`b`.`martes` AS `martes`,
	`b`.`miercoles` AS `miercoles`,
	`b`.`jueves` AS `jueves`,
	`b`.`viernes` AS `viernes`,
	`b`.`sabado` AS `sabado`,
	concat( `d`.`nombre_profesor`, ' ', `d`.`apaterno`, ' ', `d`.`amaterno` ) AS `profesor`,
	`a`.`idgrupo` AS `idgrupo` 
FROM
	((( `grupos_estudiantes` `a` JOIN `grupos` `b` ) JOIN `cat_materias` `c` ) JOIN `profesores` `d` ) 
WHERE
	`a`.`idgrupo` = `b`.`idgrupo` 
	AND `b`.`idmateria` = `c`.`idmateria` 
	AND `b`.`idprofesor` = `d`.`idprofesor`;

-- ----------------------------
-- View structure for horario_profesor_v
-- ----------------------------
DROP VIEW IF EXISTS `horario_profesor_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `horario_profesor_v` AS select `a`.`idprofesor` AS `idprofesor`,`a`.`idciclo` AS `idciclo`,`a`.`idcarrera` AS `idcarrera`,`b`.`cve_carrera` AS `cve_carrera`,`a`.`num_semestre` AS `num_semestre`,`a`.`idmateria` AS `idmateria`,`c`.`desc_materia` AS `desc_materia`,`c`.`cve_materia` AS `cve_materia`,`a`.`desc_grupo` AS `desc_grupo`,`a`.`aula` AS `aula`,`c`.`creditos` AS `creditos`,`a`.`lunes` AS `lunes`,`a`.`martes` AS `martes`,`a`.`miercoles` AS `miercoles`,`a`.`jueves` AS `jueves`,`a`.`viernes` AS `viernes`,`a`.`sabado` AS `sabado`,`a`.`idgrupo` AS `idgrupo`,`b`.`desc_carrera` AS `desc_carrera`,`ciclo`.`desc_ciclo` AS `desc_ciclo` from (((`grupos` `a` join `cat_carreras` `b`) join `cat_materias` `c`) join `ciclo` on(`a`.`idciclo` = `ciclo`.`idciclo`)) where `a`.`idcarrera` = `b`.`idcarrera` and `a`.`idmateria` = `c`.`idmateria`;

SET FOREIGN_KEY_CHECKS = 1;