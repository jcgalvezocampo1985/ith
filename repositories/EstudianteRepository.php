<?php

namespace app\repositories;

use app\models\estudiante\Estudiante;

use app\repositories\BaseRepository;

class EstudianteRepository extends BaseRepository
{
    protected $table = ['estudiantes'];
    public $campos = ['idestudiante', 'idcarrera', 'nombre_estudiante', 'email', 'sexo', 'num_semestre', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus'];
    protected $select = [
        'estudiantes.idestudiante',
        'estudiantes.nombre_estudiante',
        'estudiantes.email',
        'estudiantes.sexo',
        'estudiantes.num_semestre',
        'estudiantes.cve_estatus',
        'cat_carreras.desc_carrera'
    ];
    protected $joins = [
        ['cat_carreras', 'cat_carreras.idcarrera = estudiantes.idcarrera']
    ];
    protected $where = [
                'estudiantes.idestudiante',
                'estudiantes.nombre_estudiante',
                'estudiantes.email'
    ];
    protected $orderBy = ['estudiantes.nombre_estudiante' => SORT_ASC];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

<<<<<<< HEAD
    #region public function __construct(Estudiante $model)
=======
    /* #region public function __construct(Estudiante $model) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function __construct(Estudiante $model)
    {
        parent::__construct($model);
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

    /* #region public function totalRelacionCarreras($id) */
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

    #region public function listadoAlumnosCiclo($idciclo)
    public function listadoAlumnosCiclo($idciclo)
=======
    /* #endregion */

    /* #region public function listadoAlumnosCiclo($idciclo) */
    public function listadoAlumnosCiclo(int $idciclo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'cat_carreras.idcarrera',
            'cat_carreras.plan_estudios',
            'grupos.num_semestre'
        ];
        $joins = [
            ['cat_carreras', 'estudiantes.idcarrera = cat_carreras.idcarrera'],
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [
            'estudiantes.nombre_estudiante'
        ];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function listadoAlumnosCiclo($idciclo)
    public function listadoAlumnoCiclo($idciclo)
=======
    /* #endregion */

    /* #region public function listadoAlumnosCiclo($idciclo) */
    public function listadoAlumnoCiclo(int $idciclo)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'cat_materias.cve_materia',
            'grupos.idgrupo'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'grupos.idgrupo' => SORT_ASC,
            'estudiantes.idestudiante' => SORT_ASC,
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function viewEstudianteEncabezado(int $idestudiante, int $idciclo = 0)
=======
    /* #endregion */

    /* #region public function viewEstudianteEncabezado(int $idestudiante, int $idciclo = 0) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function viewEstudianteEncabezado(int $idestudiante, int $idciclo = 0)
    {
        if ($idciclo != 0) {
            $query = 'SELECT
                        *
                      FROM
                        boleta_estudiante_encabezado
                      WHERE
                        idestudiante = :idestudiante
                      AND
                        idciclo = :idciclo';

            $where = [
                'idestudiante' => $idestudiante,
                'idciclo' => $idciclo
            ];
            $registers = 'one';
        } else {
            $query = 'SELECT
                        *
                      FROM
                        boleta_estudiante_encabezado
                      WHERE
                        idestudiante = :idestudiante
                      GROUP BY idciclo
                      ORDER BY idciclo DESC';

            $where = [
                'idestudiante' => $idestudiante
            ];

            $registers = 'all';
        }

        $result = $this->getView($query, $where, $registers);

        return $result;
    }
<<<<<<< HEAD
    #endregion

    #region public function viewEstudianteBoletaDetalle(int $idestudiante, int $idciclo)
=======
    /* #endregion */

    /* #region public function viewEstudianteBoletaDetalle(int $idestudiante, int $idciclo) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function viewEstudianteBoletaDetalle(int $idestudiante, int $idciclo)
    {
        $query = "SELECT
                    *
                  FROM
                    boleta_detalle_v
                  WHERE
                    idestudiante = :idestudiante
                  AND
                    idciclo = :idciclo
                  ORDER BY
                    desc_materia ASC";

        $where = [
            'idestudiante' => $idestudiante,
            'idciclo' => $idciclo
        ];

        $registers = 'all';

        $result = $this->getView($query, $where, $registers);

        return $result;
    }
<<<<<<< HEAD
    #endregion

    #region public function viewHorarioEstudiante(int $idestudiante)
=======
    /* #endregion */

    /* #region public function viewHorarioEstudiante(int $idestudiante) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function viewHorarioEstudiante(int $idestudiante, int $idciclo)
    {
        $query = "SELECT
                    *
                  FROM
                    horario_estudiante_v
                  WHERE
                    idestudiante =:idestudiante
                  AND
                    idciclo = :idciclo
                  ORDER BY
                    lunes, viernes, sabado";

        $where = [
            'idestudiante' => $idestudiante,
            'idciclo' => $idciclo
        ];

        $registers = 'all';

        $result = $this->getView($query, $where, $registers);

        return $result;
    }
<<<<<<< HEAD
    #endregion

    #region public function listadoAlumnosGruposPorCiclo(int $idciclo)
=======
    /* #endregion */

    /* #region public function listadoAlumnosGruposPorCiclo(int $idciclo) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function listadoAlumnosGruposPorCiclo(int $idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'grupos_estudiantes.idestudiante',
	        'cat_materias.cve_materia',
	        'grupos.idgrupo'
        ];
        $joins = [
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'grupos.idgrupo' => SORT_ASC,
            'grupos_estudiantes.idestudiante' => SORT_ASC,
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function listaAlumnosEncabezadoCiclo(int $idgrupo, int $idciclo)
=======
    /* #endregion */

    /* #region public function listaAlumnosEncabezado(int $idgrupo, int $idciclo) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function listaAlumnosEncabezado(int $idgrupo, int $idciclo)
    {
        $table = 'cat_carreras';
        $select = [
            'ciclo.desc_ciclo',
            'cat_carreras.desc_carrera',
            'cat_carreras.plan_estudios',
            'grupos.desc_grupo',
            'grupos.desc_grupo_corto',
            'cat_materias.desc_materia'
        ];
        $joins = [
            ['grupos', 'cat_carreras.idcarrera = grupos.idcarrera'],
            ['ciclo', 'ciclo.idciclo = grupos.idciclo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idgrupo', $idgrupo],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'one';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function listaAlumnosCuerpo(int $idgrupo, int $idciclo)
=======
    /* #endregion */

    /* #region public function listaAlumnosCuerpo(int $idgrupo, int $idciclo) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function listaAlumnosCuerpo(int $idgrupo, int $idciclo)
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'estudiantes.sexo',
            'cat_opcion_curso.desc_opcion_curso',
            'cat_materias.desc_materia'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['cat_opcion_curso', 'grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos_estudiantes.idgrupo', $idgrupo],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function calificacionesPorGrupoCiclo(int $idgrupo, int $idciclo)
=======
    /* #endregion */

    /* #region public function calificacionesPorGrupoCiclo(int $idgrupo, int $idciclo) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function calificacionesPorGrupoCiclo(int $idgrupo, int $idciclo)
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
<<<<<<< HEAD
=======
            'estudiantes.sexo',
            'cat_opcion_curso.desc_opcion_curso',
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
            'grupos_estudiantes.p1', 'grupos_estudiantes.p2', 'grupos_estudiantes.p3',
            'grupos_estudiantes.p4', 'grupos_estudiantes.p5', 'grupos_estudiantes.p6',
            'grupos_estudiantes.p7', 'grupos_estudiantes.p8', 'grupos_estudiantes.p9',
            'grupos_estudiantes.s1', 'grupos_estudiantes.s2', 'grupos_estudiantes.s3',
            'grupos_estudiantes.s4', 'grupos_estudiantes.s5', 'grupos_estudiantes.s6',
            'grupos_estudiantes.s7', 'grupos_estudiantes.s8', 'grupos_estudiantes.s9',
            'grupos_estudiantes.sp1', 'grupos_estudiantes.sp2', 'grupos_estudiantes.sp3',
            'grupos_estudiantes.sp4', 'grupos_estudiantes.sp5', 'grupos_estudiantes.sp6',
            'grupos_estudiantes.sp7', 'grupos_estudiantes.sp8', 'grupos_estudiantes.sp9'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['cat_opcion_curso', 'grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos_estudiantes.idgrupo', $idgrupo],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
<<<<<<< HEAD
    #endregion
=======
    /* #endregion */

    /* #region public function listaAlumnosCalificacionesPorGrupoCiclo(int $idgrupo, int $idciclo) */
    public function listaAlumnosCalificacionesPorGrupoCiclo(int $idgrupo, int $idciclo)
    {
        $table = 'estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'cat_materias.desc_materia',
            'grupos_estudiantes.p1', 'grupos_estudiantes.p2', 'grupos_estudiantes.p3',
            'grupos_estudiantes.p4', 'grupos_estudiantes.p5', 'grupos_estudiantes.p6',
            'grupos_estudiantes.p7', 'grupos_estudiantes.p8', 'grupos_estudiantes.p9',
            'grupos_estudiantes.s1', 'grupos_estudiantes.s2', 'grupos_estudiantes.s3',
            'grupos_estudiantes.s4', 'grupos_estudiantes.s5', 'grupos_estudiantes.s6',
            'grupos_estudiantes.s7', 'grupos_estudiantes.s8', 'grupos_estudiantes.s9',
            'grupos_estudiantes.sp1', 'grupos_estudiantes.sp2', 'grupos_estudiantes.sp3',
            'grupos_estudiantes.sp4', 'grupos_estudiantes.sp5', 'grupos_estudiantes.sp6',
            'grupos_estudiantes.sp7', 'grupos_estudiantes.sp8', 'grupos_estudiantes.sp9'
        ];
        $joins = [
            ['grupos_estudiantes', 'estudiantes.idestudiante = grupos_estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos_estudiantes.idgrupo', $idgrupo],
            ['=', 'grupos.idciclo', $idciclo]
        ];
        $orderBy = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function totalRegistros($idestudiante) */
    public function totalRegistros(int $idestudiante)
    {
        $total = $this->model->find()
                             ->where(['idestudiante' => $idestudiante])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function existeEmail(string $email) */
    public function existeEmail(string $email)
    {
        $total = $this->model->find()
                             ->where(['email' => $email])
                             ->count();

        return $total;
    }
    /* #endregion */

    /* #region public function getAlumnosNoExistentesPorGrupo(int $idgrupo) */
    public function getEstudiantesNoExistentesPorGrupo(int $idcarrera, int $idgrupo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'grupos_estudiantes.idestudiante'
        ];
        $joins = [];
        $where = [
            ['=', 'grupos_estudiantes.idgrupo', $idgrupo]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        $estudiantes = [];
        foreach($query as $row)
        {
            $estudiantes[] = $row['idestudiante'];
        }

        $table1 = 'estudiantes';
        $select1 = [
            'estudiantes.idestudiante', 
            'estudiantes.nombre_estudiante'
        ];
        $joins1 = [];
        $where1 = [
            ['=', 'estudiantes.idcarrera', $idcarrera],
            ['NOT IN', 'estudiantes.idestudiante', $estudiantes]
        ];
        $orderBy1 = [
            'estudiantes.nombre_estudiante' => SORT_ASC
        ];
        $groupBy1 = [];
        $paginate1 = false;
        $registers1 = 'all';

        $query1 = $this->getQuery($table1, $select1, $joins1, $where1, $orderBy1, $groupBy1, $paginate1, $registers1);

        return $query1;
    }
    /* #endregion */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
}