<?php

namespace app\repositories;

use app\models\profesor\Profesor;

use app\repositories\BaseRepository;

class ProfesorRepository extends BaseRepository
{
    protected $table = ['profesores'];
    protected $primaryKey = 'idprofesor';
    protected $campos = ['idprofesor', 'curp', 'nombre_profesor', 'apaterno', 'amaterno', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'curp',
        'nombre_profesor',
        'apaterno',
        'amaterno',
        'fecha_registro',
        'fecha_actualizacion',
        'cve_estatus'
    ];
    protected $orderBy = ['idprofesor' => SORT_DESC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    public function __construct(Profesor $model)
    {
        parent::__construct($model);
    }
}