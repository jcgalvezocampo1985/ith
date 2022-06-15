<?php

namespace app\repositories;
use yii\db\Query;

use app\models\grupo\Grupo;

use app\Repositories\BaseRepository;

class GrupoRepository extends BaseRepository
{
    protected $table = ['grupos'];
    public $campos = ['idgrupo', 'idciclo', 'num_semestre', 'idcarrera', 'idmateria', 'idprofesor', 'desc_grupo_corto', 'desc_grupo', 'aula', 'fecha_envio_acta', 'horario', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
    protected $select = [
        'grupos.idgrupo',
        'ciclo.idciclo',
        'ciclo.desc_ciclo AS ciclo',
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

    #region public function __construct(Grupo $model)
    public function __construct(Grupo $model)
    {
        parent::__construct($model);
    }
    #endregion

    #region public function totalRelacionCiclos($id)
    public function totalRelacionCiclos($id)
    {
        $total = $this->model->find()
                             ->where(['idciclo' => $id])
                             ->count();

        return $total;
    }
    #endregion

    #region public function totalRelacionCarreras($id)
    public function totalRelacionCarreras($id)
    {
        $total = $this->model->find()
                             ->where(['idcarrera' => $id])
                             ->count();

        return $total;
    }
    #endregion

    #region public function totalRelacionMaterias($id)
    public function totalRelacionMaterias($id)
    {
        $total = $this->model->find()
                             ->where(['idmateria' => $id])
                             ->count();

        return $total;
    }
    #endregion

    #region public function queryGrupoAlumnos($idgrupo)
    public function queryGrupoAlumnos($idgrupo)
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
            'estudiantes.idestudiante' => SORT_DESC
        ];
        $groupBy = [];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, false);

        return $query;
    }
    #endregion

    #region public function queryGrupoAlumnos($idgrupo)
    public function queryCicloCarreraEstudiante($idciclo, $idcarrera, $idestudiante, $desc_materia = '')
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
        $orderBy = [
            
        ];
        $groupBy = [
            
        ];

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy);

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
            'grupos.desc_grupo'
        ];
        $joins1 = [
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'grupos.idcarrera = cat_carreras.idcarrera'],
            ['ciclo', 'grupos.idciclo = ciclo.idciclo']
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

        $query1 = $this->getQuery($table1, $select1, $joins1, $where1, $orderBy1, $groupBy1);

        return $query1;
    }
    #endregion

    #region public function listadoGrupo($idciclo)
    public function listadoGrupo($idciclo)
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

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, []);

        return $query;
    }
    #endregion
}