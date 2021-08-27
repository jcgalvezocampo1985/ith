-- ----------------------------
-- Table structure for profesores
-- ----------------------------
DROP TABLE IF EXISTS `profesores`;
CREATE TABLE `profesores`  (
  `idprofesor` int(11) NOT NULL AUTO_INCREMENT,
  `curp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `nombre_profesor` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amaterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_registro` datetime NULL DEFAULT current_timestamp,
  `fecha_actualizacion` datetime NULL DEFAULT current_timestamp,
  `cve_estatus` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'VIG',
  PRIMARY KEY (`idprofesor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `roles_usuarios`;
CREATE TABLE `roles_usuarios`  (
  `idusuario` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  INDEX `fk_table1_cat_roles1_idx`(`idrol`) USING BTREE,
  INDEX `fk_table1_usuarios1_idx`(`idusuario`) USING BTREE,
  CONSTRAINT `fk_table1_cat_roles1` FOREIGN KEY (`idrol`) REFERENCES `cat_roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


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
-- View structure for boleta_detalle_v
-- ----------------------------
DROP VIEW IF EXISTS `boleta_detalle_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_detalle_v` AS SELECT
`actas_calificaciones`.`idestudiante` AS `idestudiante`,
`grupos`.`idciclo` AS `idciclo`,
`cat_materias`.`desc_materia` AS `desc_materia`,
`cat_materias`.`cve_materia` AS `cve_materia`,
`grupos`.`desc_grupo_corto` AS `desc_grupo`,
CASE
		WHEN `actas_calificaciones`.`idopcion_curso` = 2 THEN	'REP' 
		WHEN `actas_calificaciones`.`idopcion_curso` = 3 THEN	'ESP' 
		WHEN `actas_calificaciones`.`idopcion_curso` = 4 THEN	'DUAL' 
		WHEN `actas_calificaciones`.`idopcion_curso` = 5 THEN 'AUT'
		ELSE 'ORD' 
	END AS `opc_curso`,
	`cat_materias`.`creditos` AS `creditos`,
IF
	( `actas_calificaciones`.`seg_opt` = '', `actas_calificaciones`.`pri_opt`, `actas_calificaciones`.`seg_opt` ) AS `calificacion` 
FROM
	(( `actas_calificaciones` JOIN `grupos` ) JOIN `cat_materias` ) 
WHERE
	`actas_calificaciones`.`idgrupo` = `grupos`.`idgrupo` 
	AND `grupos`.`idmateria` = `cat_materias`.`idmateria`; ;

-- ----------------------------
-- View structure for boleta_encabezado_v
-- ----------------------------
DROP VIEW IF EXISTS `boleta_encabezado_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_encabezado_v` AS SELECT
`a`.`idestudiante` AS `idestudiante`,
`a`.`nombre_estudiante` AS `nombre_estudiante`,
`b`.`desc_carrera` AS `desc_carrera`,
`b`.`plan_estudios` AS `plan_estudios`,
`a`.`num_semestre` AS `num_semestre` 
FROM
	( `estudiantes` `a` JOIN `cat_carreras` `b` ); ;

-- ----------------------------
-- View structure for boleta_estudiante_encabezado
-- ----------------------------
DROP VIEW IF EXISTS `boleta_estudiante_encabezado`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `boleta_estudiante_encabezado` AS SELECT
`ciclo`.`idciclo` AS `idciclo`,
`ciclo`.`desc_ciclo` AS `desc_ciclo`,
`estudiantes`.`nombre_estudiante` AS `nombre_estudiante`,
`estudiantes`.`idestudiante` AS `idestudiante`,
`estudiantes`.`num_semestre` AS `num_semestre`,
`cat_carreras`.`desc_carrera` AS `desc_carrera`,
`cat_carreras`.`plan_estudios` AS `plan_estudios`,
`grupos`.`desc_grupo` AS `desc_grupo`
FROM
	(((
				`estudiantes`
				JOIN `cat_carreras` ON ( `estudiantes`.`idcarrera` = `cat_carreras`.`idcarrera` ))
		JOIN `grupos` ON ( `cat_carreras`.`idcarrera` = `grupos`.`idcarrera` ))
	JOIN `ciclo` ON ( `grupos`.`idciclo` = `ciclo`.`idciclo` )) ;

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
	`b`.`aula` AS `aula`,
	`a`.`idopcion_curso` AS `idopcion_curso`,
CASE
		WHEN `a`.`idopcion_curso` = 2 THEN 'R' 
		WHEN `a`.`idopcion_curso` = 3 THEN 'E' 
	END AS `desc_opcion_curso_corto`,
	`c`.`creditos` AS `creditos`,
	`b`.`lunes` AS `lunes`,
	`b`.`martes` AS `martes`,
	`b`.`miercoles` AS `miercoles`,
	`b`.`jueves` AS `jueves`,
	`b`.`viernes` AS `viernes`,
	`b`.`sabado` AS `sabado`,
	concat( `d`.`nombre_profesor`, ' ', `d`.`apaterno`, ' ', `d`.`amaterno` ) AS `profesor` 
FROM
	((( `grupos_estudiantes` `a` JOIN `grupos` `b` ) JOIN `cat_materias` `c` ) JOIN `profesores` `d` ) 
WHERE
	`a`.`idgrupo` = `b`.`idgrupo` 
	AND `b`.`idmateria` = `c`.`idmateria` 
	AND `b`.`idprofesor` = `d`.`idprofesor` ; ;

-- ----------------------------
-- View structure for horario_profesor_v
-- ----------------------------
DROP VIEW IF EXISTS `horario_profesor_v`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `horario_profesor_v` AS SELECT
	a.idprofesor AS idprofesor,
	a.idciclo AS idciclo,
	a.idcarrera AS idcarrera,
	b.cve_carrera AS cve_carrera,
	a.num_semestre AS num_semestre,
	a.idmateria AS idmateria,
	c.desc_materia AS desc_materia,
	c.cve_materia AS cve_materia,
	a.desc_grupo AS desc_grupo,
	a.aula AS aula,
	c.creditos AS creditos,
	a.lunes AS lunes,
	a.martes AS martes,
	a.miercoles AS miercoles,
	a.jueves AS jueves,
	a.viernes AS viernes,
	a.sabado AS sabado,
	a.idgrupo AS idgrupo,
	b.desc_carrera AS desc_carrera,
	ciclo.desc_ciclo 
FROM
	( ( grupos AS a JOIN cat_carreras AS b ) JOIN cat_materias AS c )
	INNER JOIN ciclo ON a.idciclo = ciclo.idciclo 
WHERE
	a.idcarrera = b.idcarrera 
	AND a.idmateria = c.idmateria ;

SET FOREIGN_KEY_CHECKS = 1;
