<?php

namespace app\repositories;

use app\models\login\Rol;

use app\repositories\BaseRepository;

class RolRepository extends BaseRepository
{
    protected $table = ['car_roles'];
    protected $primaryKey = 'idrol';
    protected $campos = ['idrol', 'desc_rol'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'idrol',
        'desc_rol'
    ];
    protected $orderBy = ['idrol' => SORT_DESC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    #region(collapsed) [public function __construct(Rol $model)]
    public function __construct(Rol $model)
    {
        parent::__construct($model);
    }
    #endregion
}