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

    #region public function __construct(ActaCalificacion $model)
    public function __construct(ActaCalificacion $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function getEstudianteCalificacionesCiclo($idestudiante, $idciclo)
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

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion

    #region public function totalRelacionEstudiantes($id)
    public function totalRelacionEstudianteGrupo($idestudiante, $idgrupo)
    {
        $total = $this->model->find()
                             ->where(['idestudiante' => $idestudiante, 'idgrupo' => $idgrupo])
                             ->count();
        return $total;
    }
    #endregion
}