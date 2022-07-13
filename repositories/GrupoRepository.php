<?php

namespace app\repositories;
use yii\db\Query;

use app\models\grupo\Grupo;

use app\repositories\BaseRepository;

class GrupoRepository extends BaseRepository
{
    protected $table = ['grupos'];
    public $campos = ['idgrupo', 'idciclo', 'num_semestre', 'idcarrera', 'idmateria', 'idprofesor', 'desc_grupo_corto', 'desc_grupo', 'aula', 'fecha_envio_acta', 'horario', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
    protected $select = [
        'grupos.idgrupo',
        'ciclo.idciclo',
        'ciclo.desc_ciclo AS ciclo',
<<<<<<< HEAD
=======
        'grupos.idcarrera',
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
        'cat_carreras.desc_carrera AS carrera',
        'cat_materias.desc_materia AS materia',
        'cat_materias.creditos',
        'CONCAT(profesores.apaterno," ",profesores.amaterno," ",profesores.nombre_profesor) AS profesor',
        'grupos.num_semestre',
        'grupos.desc_grupo_corto',
        'grupos.desc_grupo',
        'grupos.aula',
        'grupos.fecha_envio_acta'
    ];
    protected $joins = [
        ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera'],
        ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
        ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
        ['profesores', 'grupos.idprofesor = profesores.idprofesor']
    ];
    protected $where = [
        'ciclo.desc_ciclo',
        'cat_carreras.desc_carrera',
        'cat_materias.desc_materia',
        'CONCAT(profesores.apaterno," ",profesores.amaterno," ",profesores.nombre_profesor)',
        'profesores.apaterno',
        'profesores.amaterno',
        'profesores.nombre_profesor',
        'grupos.num_semestre',
        'grupos.desc_grupo_corto',
        'grupos.desc_grupo',
        'grupos.fecha_envio_acta'
    ];
    protected $orderBy = [
        'ciclo.idciclo' => SORT_DESC,
        'cat_carreras.desc_carrera' => SORT_ASC,
        'grupos.num_semestre' => SORT_DESC,
        'cat_carreras.desc_carrera' => SORT_ASC
    ];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

<<<<<<< HEAD
    #region public function __construct(Grupo $model)
=======
    /* #region public function __construct(Grupo $model) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function __construct(Grupo $model)
    {
        parent::__construct($model);
    }
<<<<<<< HEAD
    #endregion

    #region public function totalRelacionCiclos($id)
    public function totalRelacionCiclos($id)
    {
        $total = $this->model->find()
                             ->where(['idciclo' => $id])
=======
    /* #endregion */

    /* #region public function totalRelacionCiclos(int $idciclo) */
    public function totalRelacionCiclos(int $idciclo)
    {
        $total = $this->model->find()
                             ->where(['idciclo' => $idciclo])
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
                             ->count();

        return $total;
    }
<<<<<<< HEAD
    #endregion

    #region public function totalRelacionCarreras($id)
    public function totalRelacionCarreras($id)
    {
        $total = $this->model->find()
                             ->where(['idcarrera' => $id])
=======
    /* #endregion */

    /* #region public function totalRelacionCarreras(int $idcarrera) */
    public function totalRelacionCarreras(int $idcarrera)
    {
        $total = $this->model->find()
                             ->where(['idcarrera' => $idcarrera])
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
                             ->count();

        return $total;
    }
<<<<<<< HEAD
    #endregion

    #region public function totalRelacionMaterias($id)
    public function totalRelacionMaterias($id)
    {
        $total = $this->model->find()
                             ->where(['idmateria' => $id])
=======
    /* #endregion */

    /* #region public function totalRelacionMaterias(int $idmateria) */
    public function totalRelacionMaterias(int $idmateria)
    {
        $total = $this->model->find()
                             ->where(['idmateria' => $idmateria])
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
                             ->count();

        return $total;
    }
<<<<<<< HEAD
    #endregion

    #region public function queryGrupoAlumnos($idgrupo)
    public function queryGrupoAlumnos($idgrupo)
=======
    /* #endregion */

    /* #region public function totalRelacionProfesores(int $idprofesor) */
    public function totalRelacionProfesores(int $idprofesor)
    {
        $total = $this->model->find()
                             ->where(['idprofesor' => $idprofesor])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function queryGrupoAlumnos(int $idgrupo) */
    public function queryGrupoAlumnos(int $idgrupo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'grupos_estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'ciclo.desc_ciclo',
            'grupos.desc_grupo',
            'cat_materias.desc_materia',
            'cat_carreras.desc_carrera',
            '(SELECT IF(pri_opt = "", seg_opt, pri_opt)
                FROM
            actas_calificaciones
                WHERE
            idgrupo = grupos_estudiantes.idgrupo AND idestudiante = grupos_estudiantes.idestudiante) AS promedio'
        ];
        $joins = [
            ['estudiantes', 'grupos_estudiantes.idestudiante = estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera']
        ];
        $where = [
            ['=', 'grupos_estudiantes.idgrupo', $idgrupo]
        ];
        $orderBy = [
<<<<<<< HEAD
            'estudiantes.idestudiante' => SORT_DESC
        ];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, false);

        return $query;
    }
    #endregion

    #region public function queryGrupoAlumnos($idgrupo)
    public function queryCicloCarreraEstudiante($idciclo, $idcarrera, $idestudiante, $desc_materia = '')
=======
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function queryCicloCarreraEstudiante(int $idciclo, int $idcarrera, int $idestudiante, string $desc_materia = '') */
    public function queryCicloCarreraEstudiante(int $idcarrera, int $idestudiante, string $desc_materia = '')
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'grupos_estudiantes';
        $select = [
            'grupos.idmateria'
        ];
        $joins = [
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo']
        ];
        $where = [
            ['=', 'grupos_estudiantes.idestudiante', $idestudiante]
        ];
<<<<<<< HEAD
        $orderBy = [
            
        ];
        $groupBy = [
            
        ];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);
=======
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569

        $materias = [];
        foreach($query as $row)
        {
            $materias[] = $row['idmateria'];
        }

        $filtro_materia = ['=', 'cat_carreras.idcarrera', $idcarrera];
        if($desc_materia != ''){
            $filtro_materia = ['LIKE', 'cat_materias.desc_materia', $desc_materia];
        }
        $table1 = 'grupos';
        $select1 = [
            'grupos.idgrupo',
            'grupos.idmateria',
            'cat_materias.desc_materia',
            'cat_materias.creditos',
            'grupos.num_semestre',
            'ciclo.desc_ciclo',
<<<<<<< HEAD
            'grupos.desc_grupo'
=======
            'grupos.desc_grupo',
            'CONCAT(profesores.nombre_profesor, " ",profesores.apaterno," ",profesores.amaterno) AS profesor'
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
        ];
        $joins1 = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera'],
<<<<<<< HEAD
            ['ciclo', 'grupos.idciclo = ciclo.idciclo']
=======
            ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
            ['profesores', 'grupos.idprofesor = profesores.idprofesor']
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
        ];
        $where1 = [
            ['=', 'cat_carreras.idcarrera', $idcarrera],
            ['NOT IN', 'grupos.idmateria', $materias],
            $filtro_materia
        ];
        $orderBy1 = [
            'ciclo.idciclo' => SORT_DESC,
            'cat_materias.desc_materia' => SORT_ASC
        ];
        $groupBy1 = ['cat_materias.idmateria'];
<<<<<<< HEAD

        $query1 = $this->getQuery($table1, $select1, $joins1, $where1, $orderBy1, $groupBy1);

        return $query1;
    }
    #endregion

    #region public function listadoGrupo($idciclo)
    public function listadoGrupo($idciclo)
=======
        $paginate1 = false;
        $registers1 = 'all';

        $query1 = $this->getQuery($table1, $select1, $joins1, $where1, $orderBy1, $groupBy1, $paginate1, $registers1);

        return $query1;
    }
    /* #endregion */

    /* #region public function listadoGrupo(int $idciclo) */
    public function listadoGrupo(int $idciclo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'grupos';
        $select = [
            'cat_materias.cve_materia',
            'grupos.idgrupo',
            'grupos.idprofesor'
        ];
        $joins = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'cat_materias.idmateria' => SORT_DESC
        ];
<<<<<<< HEAD

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, []);

        return $query;
    }
    #endregion
=======
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function listaGruposProfesorCiclo(int $idprofesor, int $idciclo) */
    public function listaGruposProfesorCiclo(int $idprofesor, int $idciclo)
    {
        $table = 'grupos';
        $select = [
            "grupos.idgrupo",
            "grupos.idciclo",
            "cat_materias.desc_materia"
        ];
        $joins = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idprofesor', $idprofesor],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function listaMateriasPorIdgrupo(int $idgrupo) */
    public function listaMateriasPorIdgrupo(int $idgrupo)
    {
        $table = 'grupos';
        $select = [
            'cat_materias.desc_materia'
        ];
        $joins = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
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
    /* #endregion */

    /* #region public function totalGruposAtentidosPorProfesorCiclo(int $idprofesor, int $idciclo) */
    public function totalGruposAtentidosPorProfesorCiclo(int $idprofesor, int $idciclo)
    {
        $total = $this->model->find()
                             ->where(['idprofesor' => $idprofesor, 'idciclo' => $idciclo])
                             ->groupBy('desc_grupo')
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function totalMateriasAtendidasPorProfesorCiclo(int $idprofesor, int $idciclo) */
    public function totalMateriasAtendidasPorProfesorCiclo(int $idprofesor, int $idciclo)
    {
        $total = $this->model->find()
                             ->where(['idprofesor' => $idprofesor, 'idciclo' => $idciclo])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function listaMateriasPorProfesorCiclo(int $idprofesor, int $idciclo) */
    public function listaMateriasPorProfesorCiclo(int $idprofesor, int $idciclo)
    {
        $table = 'grupos';
        $select = [
            'cat_materias.desc_materia',
            'cat_carreras.cve_carrera',
            '(SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo) AS total_estudiantes',
            '(SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE pri_opt <> "NA" AND pri_opt <> "" AND idgrupo = grupos.idgrupo) AS po',
            'ROUND(((SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE pri_opt <> "NA" AND pri_opt <> "" AND idgrupo = grupos.idgrupo) / (SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo)) * 100)  AS po_porcentaje',
            '(SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE seg_opt <> "NA" AND seg_opt <> "" AND idgrupo = grupos.idgrupo) AS so',
            'ROUND(((SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE seg_opt <> "NA" AND seg_opt <> "" AND idgrupo = grupos.idgrupo) / (SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo)) * 100)  AS so_porcentaje',
            '(SELECT
                COUNT(estudiantes.idestudiante) 
              FROM
                estudiantes
              INNER JOIN grupos_estudiantes ON estudiantes.idestudiante = grupos_estudiantes.idestudiante
              WHERE
                grupos_estudiantes.idgrupo = grupos.idgrupo
              AND
                estudiantes.cve_estatus = "DES"
            ) AS bajas'
        ];
        $joins = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera']
        ];
        $where = [
            ['=', 'grupos.idprofesor', $idprofesor],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'cat_carreras.desc_carrera' => SORT_ASC,
            'cat_materias.desc_materia' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
}