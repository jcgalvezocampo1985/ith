<?php

namespace app\repositories;

use app\models\ciclo\Ciclo;

use app\repositories\BaseRepository;

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

    /* #region public function __construct(Ciclo $model */
    public function __construct(Ciclo $model)
    {
        parent::__construct($model);
    }
    /* #endregion */

    /* #region public function totalCiclo(int $idciclo */
    public function totalCiclo(int $idciclo)
    {
        $total = $this->model->find()
                             ->where(['idciclo' => $idciclo])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function consultaDatosCiclo(int $idciclo */
    public function consultaDatosCiclo(int $idciclo)
    {
        return $this->model->find()
                           ->where(['idciclo' => $idciclo])
                           ->one();
    }
    /* #endregion */

    /* #region public function consultarCiclos( */
    public function consultarCiclos()
    {
        return $this->model->find()
                           ->orderBy(['idciclo' => SORT_DESC])
                           ->all();
    }
    /* #endregion */
}