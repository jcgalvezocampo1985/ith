SELECT
	actas_calificaciones.idestudiante,
	( SELECT nombre_estudiante FROM estudiantes WHERE idestudiante = actas_calificaciones.idestudiante ) AS nombre_estudiante,
	( SELECT cat_carreras.desc_carrera FROM estudiantes INNER JOIN cat_carreras ON estudiantes.idcarrera = cat_carreras.idcarrera WHERE estudiantes.idestudiante = actas_calificaciones.idestudiante ) AS carrera,
IF
	( actas_calificaciones.pri_opt <> "", actas_calificaciones.pri_opt, actas_calificaciones.seg_opt ) AS calificacion 
FROM
	actas_calificaciones
	INNER JOIN grupos ON actas_calificaciones.idgrupo = grupos.idgrupo 
WHERE
	grupos.idciclo = 2 
	AND grupos.idcarrera = 3
ORDER BY
	CONVERT ( calificacion, INTEGER ) DESC LIMIT 3