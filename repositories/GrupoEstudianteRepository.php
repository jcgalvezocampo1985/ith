<?php

namespace app\repositories;

use app\models\grupoestudiante\GrupoEstudiante;

use app\repositories\BaseRepository;

class GrupoEstudianteRepository extends BaseRepository
{
    protected $table = ['ciclos'];
    public $campos = ['idciclo', 'desc_ciclo', 'semestre', 'anio', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'desc_ciclo',
        'semestre',
        'anio',
        'cve_estatus'
    ];
    protected $orderBy = ['idciclo' => SORT_DESC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    #region public function __construct(GrupoEstudiante $model)
    public function __construct(GrupoEstudiante $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function totalRelacionGrupos($id)
    public function totalRelacionGrupos($id)
    {
        $total = $this->model->find()
                             ->where(['idgrupo' => $id])
                             ->count();
        return $total;
    }
    #endregion

    #region public function totalRelacionOpcionCurso($id)
    public function totalRelacionOpcionCurso($id)
    {
        $total = $this->model->find()
                             ->where(['idopcion_curso' => $id])
                             ->count();
        return $total;
    }
    #endregion

    #region public function totalRelacionEstudiantes($id)
    public function totalRelacionEstudiantes($id)
    {
        $total = $this->model->find()
                             ->where(['idestudiante' => $id])
                             ->count();
        return $total;
    }
    #endregion

    #region public function getEstudianteCalificacionesCiclo($idestudiante, $idciclo)
    public function getEstudianteCalificacionesCiclo($idestudiante, $idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'ciclo.desc_ciclo',
            'grupos.num_semestre',
            'cat_carreras.desc_carrera',
            'cat_materias.desc_materia',
            'cat_materias.creditos',
            'cat_opcion_curso.desc_opcion_curso',
            'grupos_estudiantes.p1',
            'grupos_estudiantes.p2',
            'grupos_estudiantes.p3',
            'grupos_estudiantes.p4',
            'grupos_estudiantes.p5',
            'grupos_estudiantes.p6',
            'grupos_estudiantes.p7',
            'grupos_estudiantes.p8',
            'grupos_estudiantes.p9',
            'grupos_estudiantes.s1',
            'grupos_estudiantes.s2',
            'grupos_estudiantes.s3',
            'grupos_estudiantes.s4',
            'grupos_estudiantes.s5',
            'grupos_estudiantes.s6',
            'grupos_estudiantes.s7',
            'grupos_estudiantes.s8',
            'grupos_estudiantes.s9' 
        ];
        $joins = [
            ['estudiantes', 'grupos_estudiantes.idestudiante = estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'estudiantes.idcarrera = cat_carreras.idcarrera AND grupos.idcarrera = cat_carreras.idcarrera'],
            ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
            ['cat_opcion_curso', 'grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso']
        ];
        $where = [
            ['=', 'estudiantes.idestudiante', $idestudiante],
            ['=', 'ciclo.idciclo', $idciclo]
        ];
        $orderBy = [
            'cat_materias.desc_materia' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion

    #region public function getCreditosEstudianteCiclo(int $idestudiante, int $idciclo)
    public function getCreditosEstudianteCiclo(int $idestudiante, int $idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'IF(COUNT(cat_materias.creditos) > 0, SUM(cat_materias.creditos), "") AS creditos' 
        ];
        $joins = [
            ['grupos', 'grupos_estudiantes.idgrupo=grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria=cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo],
            ['=', 'grupos_estudiantes.idestudiante', $idestudiante]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion

    #region public function detroyGrupoEstudiante(int $idestudiante, int $idgrupo)
    public function detroyGrupoEstudiante(int $idestudiante, int $idgrupo)
    {
        $total = $this->model->deleteAll(['idestudiante' => $idestudiante, 'idgrupo' => $idgrupo]);

        return $total;
    }
    #endregion

    #region public function consultarCalificacionesPorGrupo($idgrupo)
    public function consultarCalificacionesPorGrupo($idgrupo)
    {
        $query = $this->model->find()
                             ->where(['idgrupo' => $idgrupo])
                             ->all();

        return $query;
    }
    #endregion
}