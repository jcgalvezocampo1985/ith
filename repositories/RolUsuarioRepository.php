<?php

namespace app\repositories;

use app\models\login\RolUsuario;

use app\repositories\BaseRepository;

class RolUsuarioRepository extends BaseRepository
{
    protected $table = ['roles_usuario'];
    protected $primaryKey = '';
    protected $campos = ['idusuario', 'idrol'];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    /* #region public function __construct(RolUsuario $model) */
    public function __construct(RolUsuario $model)
    {
        parent::__construct($model);
    }
    /* #endregion */
}