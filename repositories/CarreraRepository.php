<?php

namespace app\repositories;

use app\models\carrera\Carrera;

use app\repositories\BaseRepository;

class CarreraRepository extends BaseRepository
{
    protected $table = ['cat_carreras'];
    public $campos = ['idcarrera', 'cve_carrera', 'desc_carrera', 'no_semestres', 'plan_estudios'];
    protected $select = [];
    protected $joins = [];
    protected $where = [
        'cve_carrera',
        'desc_carrera',
        'no_semestres',
        'plan_estudios'
    ];
    protected $orderBy = ['idcarrera' => SORT_DESC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    public function __construct(Carrera $model)
    {
        parent::__construct($model);
    }

    #region public function listadoAlumnosGrupoCiclo($idciclo)
    public function getCarreraEstudiante(int $idestudiante)
    {
        $table = 'cat_carreras';
        $select = [
            'cat_carreras.idcarrera',
            'cat_carreras.desc_carrera',
            'estudiantes.nombre_estudiante'
        ];
        $joins = [
            ['estudiantes', 'cat_carreras.idcarrera=estudiantes.idcarrera']
        ];
        $where = [
            ['=', 'estudiantes.idestudiante', $idestudiante]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion

    #region public function datosEncabezadoPorGrupoCiclo(int $idgrupo, int $idciclo)
    public function datosEncabezadoPorGrupoCiclo(int $idgrupo, int $idciclo)
    {
        $table = 'cat_carreras';
        $select = [
            'ciclo.desc_ciclo',
            'cat_carreras.desc_carrera',
            'cat_carreras.plan_estudios',
            'grupos.desc_grupo',
            'grupos.desc_grupo_corto',
            'cat_materias.desc_materia',
            'CONCAT(profesores.apaterno, " ", profesores.amaterno, " ", profesores.nombre_profesor) AS profesor'
        ];
        $joins = [
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera'],
            ['ciclo', 'ciclo.idciclo = grupos.idciclo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['profesores', 'grupos.idprofesor = profesores.idprofesor'],
        ];
        $where = [
            ['=', 'grupos.idgrupo', $idgrupo],
            ['=', 'ciclo.idciclo', $idciclo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'one';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion

    #region public function listaMateriasPorGrupoCiclo(int $idgrupo, int $idciclo)
    public function listaMateriasPorGrupoCiclo(int $idgrupo, int $idciclo)
    {
        $table = 'cat_carreras';
        $select = [
            'ciclo.desc_ciclo',
            'cat_carreras.desc_carrera',
            'cat_carreras.plan_estudios',
            'grupos.desc_grupo',
            'grupos.desc_grupo_corto',
            'cat_materias.desc_materia',
            'CONCAT(profesores.apaterno, " ", profesores.amaterno, " ", profesores.nombre_profesor) AS profesor'
        ];
        $joins = [
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera'],
            ['ciclo', 'ciclo.idciclo = grupos.idciclo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['profesores', 'grupos.idprofesor = profesores.idprofesor'],
        ];
        $where = [
            ['=', 'grupos.idgrupo', $idgrupo],
            ['=', 'ciclo.idciclo', $idciclo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion

    #region public function datosEncabezadoActasCalificaciones(int $idgrupo)
    public function datosEncabezadoActasCalificaciones(int $idgrupo)
    {
        $table = 'cat_carreras';
        $select = [
            'ciclo.desc_ciclo',
            'cat_carreras.desc_carrera',
            'cat_carreras.plan_estudios',
            'grupos.desc_grupo',
            'grupos.desc_grupo_corto',
            'cat_materias.desc_materia',
            'cat_materias.creditos',
            'CONCAT(profesores.apaterno, " ", profesores.amaterno, " ", profesores.nombre_profesor) AS profesor',
            '(SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo) AS total_estudiantes'
        ];
        $joins = [
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera'],
            ['ciclo', 'ciclo.idciclo = grupos.idciclo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['profesores', 'grupos.idprofesor = profesores.idprofesor'],
        ];
        $where = [
            ['=', 'grupos.idgrupo', $idgrupo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'one';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    #endregion
}