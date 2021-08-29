DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` INT NOT NULL,
  `nombre_usuario` VARCHAR(45) NULL,
  `curp` VARCHAR(20) NULL,
  `contrasenia` VARCHAR(12) NULL,
  `fecha_registro` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  `cve_estatus` VARCHAR(3) NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;

DROP TABLE IF EXISTS `cat_roles` ;

CREATE TABLE IF NOT EXISTS `cat_roles` (
  `idrol` INT NOT NULL,
  `desc_rol` VARCHAR(15) NULL,
  PRIMARY KEY (`idrol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roles_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles_usuarios` ;

CREATE TABLE IF NOT EXISTS `roles_usuarios` (
  `idusuario` INT NOT NULL,
  `idrol` INT NOT NULL,
  CONSTRAINT `fk_table1_usuarios1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_cat_roles1`
    FOREIGN KEY (`idrol`)
    REFERENCES `cat_roles` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_table1_usuarios1_idx` ON `roles_usuarios` (`idusuario` ASC);

CREATE INDEX `fk_table1_cat_roles1_idx` ON `roles_usuarios` (`idrol` ASC);


-- -----------------------------------------------------
-- Table `modulos_rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `modulos_rol` ;

CREATE TABLE IF NOT EXISTS `modulos_rol` (
  `idmodulo` INT NOT NULL,
  `desc_modulo` VARCHAR(15) NULL,
  PRIMARY KEY (`idmodulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `permisos_rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `permisos_rol` ;

CREATE TABLE IF NOT EXISTS `permisos_rol` (
  `idpermiso` INT NOT NULL,
  `idmodulo` INT NOT NULL,
  `idrol` INT NOT NULL,
  `ALTA` VARCHAR(1) NULL,
  `BAJA` VARCHAR(1) NULL,
  `MODIFICACION` VARCHAR(1) NULL,
  `CONSULTA` VARCHAR(1) NULL,
  `EJECUCION` VARCHAR(1) NULL,
  PRIMARY KEY (`idpermiso`),
  CONSTRAINT `fk_permisos_rol_modulos_rol1`
    FOREIGN KEY (`idmodulo`)
    REFERENCES `modulos_rol` (`idmodulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_rol_cat_roles1`
    FOREIGN KEY (`idrol`)
    REFERENCES `cat_roles` (`idrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_permisos_rol_modulos_rol1_idx` ON `permisos_rol` (`idmodulo` ASC);

CREATE INDEX `fk_permisos_rol_cat_roles1_idx` ON `permisos_rol` (`idrol` ASC);


-- -----------------------------------------------------
-- Data for table `cat_roles`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (1, 'Administrador');
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (2, 'Escolares');
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (3, 'Profesor');
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (4, 'dep');
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (5, 'Estudiante');
INSERT INTO `cat_roles` (`idrol`, `desc_rol`) VALUES (6, 'consulta');

ALTER TABLE usuarios
MODIFY `nombre_usuario` VARCHAR(50) NOT NULL,
CHANGE COLUMN `contrasenia` `password` VARCHAR(250) NOT NULL AFTER `nombre_usuario`,
CHANGE COLUMN `cve_estatus` `cve_estatus` VARCHAR(3) NOT NULL AFTER `password`,
ADD COLUMN `curp` varchar(20) NOT NULL AFTER `idusuario`,
ADD COLUMN `email` varchar(100) NOT NULL AFTER `nombre_usuario`,
ADD COLUMN `authKey` varchar(250) NOT NULL AFTER `cve_estatus`,
ADD COLUMN `accessToken` varchar(250) NOT NULL AFTER `authKey`,
ADD COLUMN `activate` TINYINT(1) NOT NULL AFTER `accessToken`,
ADD COLUMN `verification_code` varchar(250) NOT NULL AFTER `fecha_actualizacion`;

INSERT INTO `usuarios` VALUES (5, 'GAOJ850722HTCLCN05', 'Juan Carlos', 'jcgalvezocampo@gmail.com', 'itNwR7nhba4nc', '', 'ae6ed01d0462b66a67b4684ee50901764eaf7e2449a7cd7cef9ed285c70e75f3ed4d8e6a6b73b154a5db93dd867420f1b44816d43c1d7e3c621c696a42c1ba666ebfd7d152b18301febabc2fae14a3de9656843c436b1d0718195d5a981a816d5b15bbd7', 'c98148bf9f22e572fa4123e6e6a05e9ac144936f8d84e5f60a0d1b03c2840953219ce83b84fb2413ec9ebaa7ef017451a910c28b43ca026302dacd2371d2f48f4543f0ed5cb9c89f34f93b85207afa717a60a812ac041d1a735c599e30d02b0f6f6735ae', 1, NULL, NULL, 'f0ae8928');

ALTER TABLE profesores
ADD COLUMN `curp` varchar(20) NOT NULL AFTER `idprofesor`;

UPDATE profesores SET `CURP` = 'GAOJ850722HTCLCN05' WHERE `idprofesor` = 25;


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
	WHEN `actas_calificaciones`.`idopcion_curso` = 2 THEN 'REP' 
	WHEN `actas_calificaciones`.`idopcion_curso` = 3 THEN 'ESP' 
	WHEN `actas_calificaciones`.`idopcion_curso` = 4 THEN 'DUAL' 
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
	AND `grupos`.`idmateria` = `cat_materias`.`idmateria`;

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
	( `estudiantes` `a` JOIN `cat_carreras` `b` );

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
	AND `b`.`idprofesor` = `d`.`idprofesor` ;

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
