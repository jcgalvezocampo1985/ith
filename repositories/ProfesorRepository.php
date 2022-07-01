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

    #region(collapsed) [public function __construct(Profesor $model)]
    public function __construct(Profesor $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region(collapsed) [public function totalProfesor(int $idprofesor)]
    public function totalProfesor(int $idprofesor)
    {
        $total = $this->model->find()
                             ->where(['idprofesor' => $idprofesor])
                             ->count();

        return $total;
    }
    #endregion

    #region(collapsed) [public function totalProfesores()]
    public function totalProfesores()
    {
        $total = $this->model->find()->count();

        return $total;
    }
    #endregion

    #region(collapsed) [public function registrosProfesores()]
    public function registrosProfesores()
    {
        $total = $this->model->find()->all();

        return $total;
    }
    #endregion

    #region(collapsed) [public function datosProfesorPorCurp(string $curp)]
    public function datosProfesorPorCurp(string $curp)
    {
        $query = $this->model->find()
                             ->where(['curp' => $curp])
                             ->one();

        return $query;
    }
    #endregion

    #region(collapsed) [public function datosProfesorPorId(int $idprofesor)]
    public function datosProfesorPorId(int $idprofesor)
    {
        $query = $this->model->find()
                             ->where(['idprofesor' => $idprofesor])
                             ->one();

        return $$query;
    }
    #endregion

    #region(collapsed) [public function viewHorarioProfesorPorCiclo(int $idprofesor, int $idciclo)]
    public function viewHorarioProfesorPorCiclo(int $idprofesor, int $idciclo)
    {
        $query = "SELECT
                    *
                  FROM
                    horario_profesor_v
                  WHERE
                    idprofesor = :idprofesor
                  AND
	                idciclo = :idciclo
                  ORDER BY
                    lunes, viernes, sabado";

        $where = [
            'idprofesor' => $idprofesor,
            'idciclo' => $idciclo
        ];

        $registers = 'all';

        $result = $this->getView($query, $where, $registers);

        return $result;
    }
    #endregion

    #region(collapsed) [public function viewHorarioProfesor()]
    public function viewHorarioProfesor()
    {
        $query = "SELECT
                    *
                  FROM
                    horario_profesor_v
                  WHERE
                    idprofesor = null
                  ORDER BY
                    lunes, viernes, sabado";

        $where = [];

        $registers = 'all';

        $result = $this->getView($query, $where, $registers);

        return $result;
    }
    #endregion

    #region(collapsed) [public function profesorSeguimiento(int $idciclo, string $curp)]
    public function profesorSeguimiento(int $idciclo, string $curp)
    {
        $table = 'profesores';
        $select = [
            'profesores_seguimientos.idseguimiento'
        ];
        $joins = [
            ['profesores_seguimientos', 'profesores.idprofesor = profesores_seguimientos.idprofesor']
        ];
        $where = [
            ['=', 'profesores.curp', $curp],
            ['=', 'profesores_seguimientos.idciclo', $idciclo],
            ['=', 'profesores_seguimientos.bandera', '1']
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'count';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion
}