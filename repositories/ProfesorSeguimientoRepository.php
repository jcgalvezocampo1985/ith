<?php

namespace app\repositories;

use app\models\profesorseguimiento\ProfesorSeguimiento;

use app\repositories\BaseRepository;

class ProfesorSeguimientoRepository extends BaseRepository
{
    protected $table = ['ciclos'];
    public $campos = [];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;
    public $pages;
    public $model;

    #region public function __construct(ProfesorSeguimiento $model)
    public function __construct(ProfesorSeguimiento $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function querySeguimientos($idciclo)
    public function querySeguimientos($idciclo)
    {
        $table = 'profesores';
        $select = [
            'profesores.idprofesor',
            'profesores.nombre_profesor',
            'profesores.apaterno',
            'profesores.amaterno',
            '(SELECT bandera FROM profesores_seguimientos WHERE idciclo = '.$idciclo.' AND idprofesor = profesores.idprofesor AND seguimiento = 1) AS seguimiento1',
            '(SELECT bandera FROM profesores_seguimientos WHERE idciclo = '.$idciclo.' AND idprofesor = profesores.idprofesor AND seguimiento = 2) AS seguimiento2',
            '(SELECT bandera FROM profesores_seguimientos WHERE idciclo = '.$idciclo.' AND idprofesor = profesores.idprofesor AND seguimiento = 3) AS seguimiento3',
            '(SELECT bandera FROM profesores_seguimientos WHERE idciclo = '.$idciclo.' AND idprofesor = profesores.idprofesor AND seguimiento = 4) AS seguimiento4',
            '(SELECT bandera FROM profesores_seguimientos WHERE idciclo = '.$idciclo.' AND idprofesor = profesores.idprofesor AND seguimiento = 5) AS seguimiento5'
        ];
        $joins = [];
        $where = [];
        $orderBy = [
            'profesores.apaterno' => SORT_ASC,
            'profesores.amaterno' => SORT_ASC,
            'profesores.nombre_profesor' => SORT_ASC
        ];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, true);

        return $query;
    }
    #endregion

    #region public function countSeguimientoCicloBandera($idciclo, $seguimiento, $bandera)
    public function countSeguimientoCicloBandera($idciclo, $seguimiento, $bandera)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'seguimiento' => $seguimiento, 'bandera' => $bandera])->count();
    }
    #endregion

    #region public function countSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento)
    public function countSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'idprofesor' => $idprofesor, 'seguimiento' => $seguimiento])->count();
    }
    #endregion

    #region public function oneSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento)
    public function oneSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'idprofesor' => $idprofesor, 'seguimiento' => $seguimiento])->one();
    }
    #endregion
}