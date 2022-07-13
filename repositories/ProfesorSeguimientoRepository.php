<?php

namespace app\repositories;

use app\models\profesorseguimiento\ProfesorSeguimiento;

use app\repositories\BaseRepository;

class ProfesorSeguimientoRepository extends BaseRepository
{
<<<<<<< HEAD
    protected $table = ['ciclos'];
    public $campos = [];
=======
    protected $table = ['profesores_seguimientos'];
    protected $primaryKey = 'idseguimiento';
    protected $campos = ['idciclo', 'idprofesor', 'seguimiento', 'bandera'];
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;
<<<<<<< HEAD
    public $pages;
    public $model;

    #region public function __construct(ProfesorSeguimiento $model)
=======
    public $model;

    /* #region public function __construct(ProfesorSeguimiento $model) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function __construct(ProfesorSeguimiento $model)
    {
        parent::__construct($model);
    }
<<<<<<< HEAD
    #endregion

    #region public function querySeguimientos($idciclo)
    public function querySeguimientos($idciclo)
=======
    /* #endregion */

    /* #region public function querySeguimientos($idciclo) */
    public function querySeguimientos(int $idciclo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD

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
=======
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
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
}