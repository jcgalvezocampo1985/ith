<?php

namespace app\repositories;

use yii\db\Query;
use yii\data\Pagination;
use app\models\estudiante\Estudiante;

use app\Repositories\BaseRepository;

class EstudianteRepository extends BaseRepository
{
    protected $table = ['estudiantes'];
    public $campos = ['idestudiante', 'idcarrera', 'nombre_estudiante', 'email', 'sexo', 'num_semestre', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [
        'estudiantes.idestudiante', 
        'estudiantes.nombre_estudiante', 
        'estudiantes.email', 
        'estudiantes.sexo', 
        'estudiantes.num_semestre', 
        'estudiantes.cve_estatus',
        'cat_carreras.desc_carrera'
    ];
    protected $joins = [
        ['cat_carreras', 'cat_carreras.idcarrera = estudiantes.idcarrera']
    ];
    protected $where = [
                'estudiantes.idestudiante',
                'estudiantes.nombre_estudiante',
                'estudiantes.email'
    ];
    protected $orderBy = ['estudiantes.nombre_estudiante' => SORT_ASC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    #region public function __construct(Estudiante $model)
    public function __construct(Estudiante $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function totalRelacionCarreras($id)
    public function totalRelacionCarreras($id)
    {
        $total = $this->model->find()
                             ->where(['idcarrera' => $id])
                             ->count();

        return $total;
    }
    #endregion

    #region public function listadoAlumnosCiclo($idciclo)
    public function listadoAlumnosCiclo($idciclo)
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'cat_carreras.idcarrera',
            'cat_carreras.plan_estudios',
            'grupos.num_semestre'
        ];
        $joins = [
            ['cat_carreras', 'estudiantes.idcarrera = cat_carreras.idcarrera'],
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [
            'estudiantes.nombre_estudiante'
        ];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function listadoAlumnosGrupoCiclo($idciclo)
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'cat_materias.cve_materia',
            'grupos.idgrupo'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'grupos.idgrupo' => SORT_ASC,
            'estudiantes.idestudiante' => SORT_ASC,
        ];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion

    #region public function viewEstudiante(int $idestudiante)
    public function viewEstudiante(int $idestudiante)
    {
        $query = 'SELECT
                    *
                  FROM
                    boleta_estudiante_encabezado
                  WHERE
                    idestudiante = :idestudiante
                  GROUP BY idciclo
                  ORDER BY idciclo DESC';

        $where = [
            'idestudiante' => $idestudiante
        ];

        $result = $this->getView($query, $where);

        return $result;
    }
    #endregion

    #region public function viewEstudiante(int $idestudiante)
    public function viewHorarioEstudiante(int $idestudiante, int $idciclo)
    {
        $query = 'SELECT
                    *
                  FROM
                    horario_estudiante_v
                  WHERE
                    idestudiante =:idestudiante
                  AND
                    idciclo = :idciclo
                  ORDER BY
                    lunes, viernes, sabado';

        $where = [
            'idestudiante' => $idestudiante,
            'idciclo' => $idciclo
        ];

        $result = $this->getView($query, $where);

        return $result;
    }
    #endregion

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function listadoAlumnosGrupoCiclos($idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'cat_materias.cve_materia',
            'grupos.idgrupo'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'grupos.idgrupo' => SORT_ASC,
            'estudiantes.idestudiante' => SORT_ASC,
        ];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion
}