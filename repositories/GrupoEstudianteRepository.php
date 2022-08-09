<?php

namespace app\repositories;

use app\models\grupoestudiante\GrupoEstudiante;

use app\repositories\BaseRepository;

class GrupoEstudianteRepository extends BaseRepository
{
    protected $table = ['grupos_estudiantes'];
    public $campos = ['idgrupo', 'idestudiante', 'idopcion_curso', 'p1', 'p2','p3','p4','p5','p6','p7','p8', 'p9', 'sp1', 'sp2', 'sp3', 'sp4', 'sp5', 'sp6', 'sp7', 'sp8', 'sp9', 's1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9', 'fecha_registro', 'fecha_actualizacion', 'cve_estatus', 'idciclo', 'idgrupoidestudiante'];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 15;
    public $search;

    /* #region public function __construct(GrupoEstudiante $model) */
    public function __construct(GrupoEstudiante $model)
    {
        parent::__construct($model);
    }
    /* #endregion */

    /* #region public function totalRelacionGrupos(int $idgrupo) */
    public function totalRelacionGrupos(int $idgrupo)
    {
        $total = $this->model->find()
                             ->where(['idgrupo' => $idgrupo])
                             ->count();
        return $total;
    }
    /* #endregion */

    /* #region public function totalRelacionOpcionCurso(int $idopcion_curso) */
    public function totalRelacionOpcionCurso(int $idopcion_curso)
    {
        $total = $this->model->find()
                             ->where(['idopcion_curso' => $idopcion_curso])
                             ->count();
        return $total;
    }
    /* #endregion */

    /* #region public function totalRelacionEstudiantes(int $idestudiante) */
    public function totalRelacionEstudiantes($idestudiante)
    {
        $total = $this->model->find()
                             ->where(['idestudiante' => $idestudiante])
                             ->count();
        return $total;
    }
    /* #endregion */

    /* #region public function getEstudianteCalificacionesCiclo(int $idestudiante, int $idciclo) */
    public function getEstudianteCalificacionesCiclo($idestudiante, int $idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'estudiantes.idestudiante',
            'estudiantes.nombre_estudiante',
            'ciclo.desc_ciclo',
            'grupos.num_semestre',
            'cat_carreras.desc_carrera',
            'cat_materias.desc_materia',
            'cat_materias.creditos',
            'cat_opcion_curso.desc_opcion_curso',
            'grupos_estudiantes.p1',
            'grupos_estudiantes.p2',
            'grupos_estudiantes.p3',
            'grupos_estudiantes.p4',
            'grupos_estudiantes.p5',
            'grupos_estudiantes.p6',
            'grupos_estudiantes.p7',
            'grupos_estudiantes.p8',
            'grupos_estudiantes.p9',
            'grupos_estudiantes.s1',
            'grupos_estudiantes.s2',
            'grupos_estudiantes.s3',
            'grupos_estudiantes.s4',
            'grupos_estudiantes.s5',
            'grupos_estudiantes.s6',
            'grupos_estudiantes.s7',
            'grupos_estudiantes.s8',
            'grupos_estudiantes.s9' 
        ];
        $joins = [
            ['estudiantes', 'grupos_estudiantes.idestudiante = estudiantes.idestudiante'],
            ['grupos', 'grupos_estudiantes.idgrupo = grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria = cat_materias.idmateria'],
            ['cat_carreras', 'estudiantes.idcarrera = cat_carreras.idcarrera AND grupos.idcarrera = cat_carreras.idcarrera'],
            ['ciclo', 'grupos.idciclo = ciclo.idciclo'],
            ['cat_opcion_curso', 'grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso']
        ];
        $where = [
            ['=', 'estudiantes.idestudiante', $idestudiante],
            ['=', 'ciclo.idciclo', $idciclo]
        ];
        $orderBy = [
            'cat_materias.desc_materia' => SORT_ASC
        ];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function getCreditosEstudianteCiclo(int $idestudiante, int $idciclo) */
    public function getCreditosEstudianteCiclo($idestudiante, int $idciclo)
    {
        $table = 'grupos_estudiantes';
        $select = [
            'IF(COUNT(cat_materias.creditos) > 0, SUM(cat_materias.creditos), "") AS creditos' 
        ];
        $joins = [
            ['grupos', 'grupos_estudiantes.idgrupo=grupos.idgrupo'],
            ['cat_materias', 'grupos.idmateria=cat_materias.idmateria']
        ];
        $where = [
            ['=', 'grupos.idciclo', $idciclo],
            ['=', 'grupos_estudiantes.idestudiante', $idestudiante]
        ];
        $orderBy = [];
        $groupBy = [];
        $paginate = false;
        $registers = 'all';

        $query = $this->getQuery($table, $select, $joins, $where, $orderBy, $groupBy, $paginate, $registers);

        return $query;
    }
    /* #endregion */

    /* #region public function detroyGrupoEstudiante(int $idestudiante, int $idgrupo) */
    public function detroyGrupoEstudiante($idestudiante, int $idgrupo)
    {
        $total = $this->model->deleteAll(['idestudiante' => $idestudiante, 'idgrupo' => $idgrupo]);

        return $total;
    }
    /* #endregion */

    /* #region public function consultarCalificacionesPorGrupo(int $idgrupo) */
    public function consultarCalificacionesPorGrupo(int $idgrupo)
    {
        $query = $this->model->find()
                             ->where(['idgrupo' => $idgrupo])
                             ->all();

        return $query;
    }
    /* #endregion */

    /* #region public function consultaDatoGrupoEstudiante(int $idgrupo, int $idestudiante) */
    public function consultaDatoGrupoEstudiante(int $idgrupo, $idestudiante)
    {
        $query = $this->model->findOne(['idgrupo' => $idgrupo, "idestudiante" => $idestudiante]);

        return $query;
    }
    /* #endregion */

    /* #region public function oneSeguimientoParcialPorGrupoEstudiante(int $idgrupo, int $idestudiante, string $campo) */
    public function oneSeguimientoParcialPorGrupoEstudiante(int $idgrupo, $idestudiante, string $campo)
    {
        $query = $this->model->find()
                             ->select($campo)
                             ->where(['idgrupo' => $idgrupo, 'idestudiante' => $idestudiante])
                             ->andWhere(['in', $campo, [1, 2, 3, 4]])
                             ->one();

        return $query;
    }
    /* #endregion */

    /* #region public function countSeguimientoParcialPorGrupoEstudiante(int $idgrupo, int $idestudiante, string $campo) */
    public function countSeguimientoParcialPorGrupoEstudiante(int $idgrupo, $idestudiante, string $campo)
    {
        $query = $this->model->find()
                             ->select($campo)
                             ->where(['idgrupo' => $idgrupo, 'idestudiante' => $idestudiante])
                             ->andWhere(['in', $campo, [1, 2, 3, 4]])
                             ->count();

        return $query;
    }
    /* #endregion */
}