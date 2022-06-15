<?php

namespace app\repositories;

use app\models\ciclo\Ciclo;

use app\Repositories\BaseRepository;

class CicloRepository extends BaseRepository
{
    protected $table = ['ciclos'];
    protected $primaryKey = 'idciclo';
    protected $campos = ['idciclo', 'desc_ciclo', 'semestre', 'anio', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
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

    public function __construct(Ciclo $model)
    {
        parent::__construct($model);
    }
}