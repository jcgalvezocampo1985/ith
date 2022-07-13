<?php

namespace app\repositories;

use app\models\opcioncurso\OpcionCurso;

use app\repositories\BaseRepository;

class OpcionCursoRepository extends BaseRepository
{
    protected $table = ['cat_materias'];
    public $campos = ['idopcion_curso', 'desc_opcion_curso', 'desc_opcion_curso_corto'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'idopcion_curso',
        'desc_opcion_curso',
        'desc_opcion_curso_corto'
    ];
    protected $orderBy = ['desc_opcion_curso' => SORT_ASC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    /* #region public function __construct(OpcionCurso $model) */
    public function __construct(OpcionCurso $model)
    {
        parent::__construct($model);
    }
    /* #endregion */
}