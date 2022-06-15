<?php

namespace app\repositories;

use app\models\carrera\Carrera;

use app\Repositories\BaseRepository;

class CarreraRepository extends BaseRepository
{
    protected $table = ['cat_carreras'];
    public $campos = ['idcarrera', 'cve_carrera', 'desc_carrera', 'no_semestres', 'plan_estudios'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'cve_carrera',
        'desc_carrera',
        'no_semestres',
        'plan_estudios'
    ];
    protected $orderBy = ['idcarrera' => SORT_DESC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    public function __construct(Carrera $model)
    {
        parent::__construct($model);
    }

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function getCarreraEstudiante(int $idestudiante)
    {
        $table = 'cat_carreras';
        $select = [
            'cat_carreras.idcarrera',
            'cat_carreras.desc_carrera',
            'estudiantes.nombre_estudiante'
        ];
        $joins = [
            ['estudiantes', 'cat_carreras.idcarrera=estudiantes.idcarrera']
        ];
        $where = [
            ['=', 'estudiantes.idestudiante', $idestudiante]
        ];
        $orderBy = [];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

        return $query;
    }
    #endregion
}