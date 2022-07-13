<?php

namespace app\repositories;

use app\models\profesorseguimiento\ProfesorSeguimiento;

use app\repositories\BaseRepository;

class ProfesorSeguimientoRepository extends BaseRepository
{
    protected $table = ['profesores_seguimientos'];
    protected $primaryKey = 'idseguimiento';
    protected $campos = ['idciclo', 'idprofesor', 'seguimiento', 'bandera'];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;
    public $model;

    /* #region public function __construct(ProfesorSeguimiento $model) */
    public function __construct(ProfesorSeguimiento $model)
    {
        parent::__construct($model);
    }
    /* #endregion */

    /* #region public function querySeguimientos($idciclo) */
    public function querySeguimientos(int $idciclo)
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
        $paginate = true;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function countSeguimientoCicloBandera(int $idciclo, int $seguimiento, int $bandera) */
    public function countSeguimientoCicloBandera(int $idciclo, int $seguimiento, int $bandera)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'seguimiento' => $seguimiento, 'bandera' => $bandera])->count();
    }
    /* #endregion */

    /* #region public function countSeguimientoCicloProfesor(int $idciclo, int $idprofesor, int $seguimiento) */
    public function countSeguimientoCicloProfesor(int $idciclo, int $idprofesor, int $seguimiento)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'idprofesor' => $idprofesor, 'seguimiento' => $seguimiento])->count();
    }
    /* #endregion */

    /* #region public function oneSeguimientoCicloProfesor(int $idciclo, int $idprofesor, int $seguimiento) */
    public function oneSeguimientoCicloProfesor(int $idciclo, int $idprofesor, int $seguimiento)
    {
        return $this->model->find()->where(['idciclo' => $idciclo, 'idprofesor' => $idprofesor, 'seguimiento' => $seguimiento])->one();
    }
    /* #endregion */

    /* #region public function countSeguimientoCicloProfesorBandera(int $idciclo, int $idprofesor, int $seguimiento, int $bandera) */
    public function countSeguimientoCicloProfesorBandera(int $idciclo, int $idprofesor, int $seguimiento, int $bandera)
    {
        return $this->model->find()
                           ->where([
                                'idciclo' => $idciclo,
                                'idprofesor' => $idprofesor,
                                'seguimiento' => $seguimiento,
                                'bandera' => $bandera
                           ])
                           ->count();
    }
    /* #endregion */
}