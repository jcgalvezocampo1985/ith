<?php

namespace app\repositories;

use app\models\materia\Materia;

use app\repositories\BaseRepository;

class MateriaRepository extends BaseRepository
{
    protected $table = ['cat_materias'];
    public $campos = ['idmateria', 'cve_materia', 'desc_materia', 'creditos', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'cve_materia',
        'desc_materia',
        'creditos',
        'fecha_registro',
        'fecha_actualizacion',
        'cve_estatus'
    ];
    protected $orderBy = ['desc_materia' => SORT_ASC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    #region public function __construct(Materia $model)
    public function __construct(Materia $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function listadoMateriaCiclo(int $idciclo)
    public function listadoMateriaCiclo(int $idciclo)
    {
        $table = 'cat_materias';
        $select = [
            'cat_materias.cve_materia',
            'cat_materias.desc_materia'
        ];
        $joins = [
            ['grupos', 'cat_materias.idmateria = grupos.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'cat_materias.desc_materia' => SORT_ASC
        ];
        $groupBy = [
            'cat_materias.idmateria'
        ];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion
}