<?php

namespace app\repositories;

use app\models\actacalificacion\ActaCalificacion;

use app\repositories\BaseRepository;

class ActaCalificacionRepository extends BaseRepository
{
    protected $table = ['actas_calificaciones'];
    protected $primaryKey = 'idacta_cal';
    protected $campos = ['idacta_cal', 'idgrupo', 'idestudiante', 'idopcion_curso', 'pri_opt', 'seg_opt', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

<<<<<<< HEAD
    #region public function __construct(ActaCalificacion $model)
=======
    /* #region public function __construct(ActaCalificacion $model) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function __construct(ActaCalificacion $model)
    {
        parent::__construct($model);
    }
<<<<<<< HEAD
    #endregion

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function getEstudianteCalificacionesCiclo($idestudiante, $idciclo)
=======
    /* #endregion */

    /* #region public function getEstudianteCalificacionesCiclo(int $idestudiante, int $idciclo) */
    public function getEstudianteCalificacionesCiclo(int $idestudiante, int $idciclo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'actas_calificaciones';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'ciclo.desc_ciclo',
            'cat_carreras.desc_carrera',
            'grupos.num_semestre',
            'cat_materias.desc_materia',
            'cat_materias.creditos',
            'cat_opcion_curso.desc_opcion_curso',
            'IF(actas_calificaciones.pri_opt <> "", actas_calificaciones.pri_opt, actas_calificaciones.seg_opt ) AS calificacion'
        ];
        $joins = [
            ['grupos_estudiantes', 'actas_calificaciones.idestudiante = grupos_estudiantes.idestudiante AND actas_calificaciones.idgrupo = grupos_estudiantes.idgrupo'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera'],
            ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
            ['cat_opcion_curso', 'actas_calificaciones.idopcion_curso = cat_opcion_curso.idopcion_curso AND grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso'],
            ['estudiantes', 'cat_carreras.idcarrera = estudiantes.idcarrera AND grupos_estudiantes.idestudiante = estudiantes.idestudiante']
        ];
        $where = [
            ['=', 'actas_calificaciones.idestudiante', $idestudiante],
            ['=', 'ciclo.idciclo', $idciclo]
        ];
        $orderBy = [
            'ciclo.idciclo' => SORT_DESC
        ];
        $groupBy = [];
<<<<<<< HEAD

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion

    #region public function totalRelacionEstudiantes($id)
    public function totalRelacionEstudianteGrupo($idestudiante, $idgrupo)
=======
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function totalRelacionEstudianteGrupo(int $idestudiante, int $idgrupo) */
    public function totalRelacionEstudianteGrupo(int $idestudiante, int $idgrupo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $total = $this->model->find()
                             ->where(['idestudiante' => $idestudiante, 'idgrupo' => $idgrupo])
                             ->count();
        return $total;
    }
<<<<<<< HEAD
    #endregion
=======
    /* #endregion */

    /* #region public function datosCuerpoActasCalificaciones(int $idgrupo) */
    public function datosCuerpoActasCalificaciones(int $idgrupo)
    {
        $table = 'actas_calificaciones';
        $select = [
            'estudiantes.sexo',
            'actas_calificaciones.idestudiante',
            'estudiantes.nombre_estudiante',
            'actas_calificaciones.pri_opt', 
            'actas_calificaciones.seg_opt',
            '(CASE
                WHEN actas_calificaciones.idopcion_curso = 2 THEN
                "REP"
                WHEN actas_calificaciones.idopcion_curso = 3 THEN
                "ESP"
                WHEN actas_calificaciones.idopcion_curso = 4 THEN
                "DUAL"
                WHEN actas_calificaciones.idopcion_curso = 5 THEN
                "AUT" ELSE "ORD"
            END) AS opc_curso',
            '(SELECT lunes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS lunes',
            '(SELECT martes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS martes',
            '(SELECT miercoles FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS miercoles',
            '(SELECT jueves FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS jueves',
            '(SELECT viernes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS viernes',
            '(SELECT sabado FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS sabado'
        ];
        $joins = [
            ['estudiantes', 'estudiantes.idestudiante = actas_calificaciones.idestudiante']
        ];
        $where = [
            ['=', 'actas_calificaciones.idgrupo', $idgrupo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function totalRegistrosPorGrupoEstudiante(int $idgrupo, int $idestudiante) */
    public function totalRegistrosPorGrupoEstudiante(int $idgrupo, int $idestudiante)
    {
        $total = $this->model->find()
                             ->where(['idgrupo' => $idgrupo, 'idestudiante' => $idestudiante])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function selectIdPorGrupoEstudiante(int $idgrupo, int $idestudiante) */
    public function selectIdPorGrupoEstudiante(int $idgrupo, int $idestudiante)
    {
        $total = $this->model->find()
                             ->select('idacta_cal')
                             ->where(['idgrupo' => $idgrupo, 'idestudiante' => $idestudiante])
                             ->one();

        return $total;
    }
    /* #endregion */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
}