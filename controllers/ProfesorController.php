<?php

namespace app\controllers;

use Yii;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use Carbon\Carbon;

use app\models\User;

use app\models\ciclo\CicloSearch;
use app\models\profesor\ProfesorForm;
use app\models\profesor\ProfesorSearch;
use app\models\ciclo\CicloProfesorSearch;

use app\repositories\CicloRepository;
use app\repositories\GrupoRepository;
use app\repositories\CarreraRepository;
use app\repositories\UsuarioRepository;
use app\repositories\ProfesorRepository;
use app\repositories\EstudianteRepository;
use app\repositories\RolUsuarioRepository;
use app\repositories\ProfesorSeguimientoRepository;
use app\repositories\GrupoEstudianteRepository;

class ProfesorController extends Controller
{
    private $profesorRepository;
    private $cicloRepository;
    private $usuarioRepository;
    private $rolUsuarioRepository;
    private $grupoRepository;
    private $profesorSeguimientoRepository;
    private $estudianteRepository;
    private $carreraRepository;
    private $grupoEstudianteRepository;

    /* #region public function behaviors() */
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => [
                        'index', 
                        'create',
                        'store',
                        'edit',
                        'update',
                        'delete',
                        'horario',
                        'listaalumnos',
                        'horarioconsulta',
                        'listaalumnoscalificacionseguimientos',
                        'guardarcalificacionseguimientos',
                        'listaalumnoscalificacionregularizacion',
                        'guardarcalificacionregularizacion',
                        'horarioprofesor',
                        'horarioprofesorconsulta',
                        'consultarprofesor'
                    ],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => [
                                'index', 
                                'create',
                                'store',
                                'edit',
                                'update',
                                'delete',
                                'horario',
                                'listaalumnos',
                                'horarioconsulta',
                                'listaalumnoscalificacionseguimientos',
                                'guardarcalificacionseguimientos',
                                'listaalumnoscalificacionregularizacion',
                                'guardarcalificacionregularizacion',
                                'horarioprofesor',
                                'horarioprofesorconsulta',
                                'consultarprofesor'
                            ],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1);
                            },  
                        ],
                        [
                            //Servicios escolares tiene permisos sobre las siguientes acciones
                            'actions' => [
                                'index', 
                                'create',
                                'store',
                                'edit',
                                'update',
                                'delete',
                                'horario',
                                'listaalumnos',
                                'horarioconsulta',
                                'listaalumnoscalificacionseguimientos',
                                'guardarcalificacionseguimientos',
                                'listaalumnoscalificacionregularizacion',
                                'guardarcalificacionregularizacion',
                                'horarioprofesor',
                                'horarioprofesorconsulta',
                                'consultarprofesor'
                            ],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El profesor tiene permisos sobre las siguientes acciones
                            'actions' => [
                                'horario',
                                'listaalumnos',
                                'listaalumnoscalificacionseguimientos',
                                'guardarcalificacionseguimientos',
                                'listaalumnoscalificacionregularizacion',
                                'guardarcalificacionregularizacion',
                                'horarioprofesor'
                            ],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                            },  
                        ],
                        [
                            //División de estudios tiene permisos sobre las siguientes acciones
                            'actions' => [
                                'index', 
                                'create',
                                'store',
                                'edit',
                                'update',
                                'delete',
                                'horario',
                                'listaalumnos',
                                'horarioconsulta',
                                'listaalumnoscalificacionseguimientos',
                                'guardarcalificacionseguimientos',
                                'listaalumnoscalificacionregularizacion',
                                'guardarcalificacionregularizacion',
                                'horarioprofesor',
                                'horarioprofesorconsulta',
                                'consultarprofesor'
                            ],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4);
                            },  
                        ]
                    ],
                ],
                //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
                //sólo se puede acceder a través del método post
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
        ];
    }
    /* #endregion */

    /* #region public function __construct() */
    public function __construct($id, $module,
                                ProfesorRepository $profesorRepository,
                                CicloRepository $cicloRepository,
                                UsuarioRepository $usuarioRepository,
                                RolUsuarioRepository $rolUsuarioRepository,
                                GrupoRepository $grupoRepository,
                                ProfesorSeguimientoRepository $profesorSeguimientoRepository,
                                EstudianteRepository $estudianteRepository,
                                CarreraRepository $carreraRepository,
                                GrupoEstudianteRepository $grupoEstudianteRepository
                                )
    {
        parent::__construct($id, $module);
        $this->profesorRepository = $profesorRepository;
        $this->cicloRepository = $cicloRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->rolUsuarioRepository = $rolUsuarioRepository;
        $this->grupoRepository = $grupoRepository;
        $this->profesorSeguimientoRepository = $profesorSeguimientoRepository;
        $this->estudianteRepository = $estudianteRepository;
        $this->carreraRepository = $carreraRepository;
        $this->grupoEstudianteRepository = $grupoEstudianteRepository;
    }
    /* #endregion */

    /* #region public function actionIndex() */
    public function actionIndex()
    {
        $form = new ProfesorSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;
        $ciclos = $this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]);
        $ultimo_ciclo = $this->cicloRepository->maxId();

        $model = $this->profesorRepository->all();//Se ejecuta consulta de todos los registgros

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $this->profesorRepository->search = Html::encode($form->buscar);//Pasamos parámetro para la búsqueda

                $model = $this->profesorRepository->all(true);//Se ejecuta consulta con parámetro de búsqueda
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->profesorRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages', 'ciclos', 'ultimo_ciclo'));
    }
    /* #endregion */

    /* #region public function actionCreate($msg = "", $error = "") */
    public function actionCreate($msg = "", $error = "")
    {
        $model = new ProfesorForm;
        $clave_estatus = ['VIG' => 'VIGENTE'];
        $status = 0;

        if(Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'clave_estatus'));
    }
    /* #endregion */

    /* #region public function actionStore() */
    public function actionStore()
    {
        $model = new ProfesorForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $idprofesor = $model->idprofesor;
            $existe_profesor = $this->profesorRepository->totalProfesor((int)$idprofesor);

            if ($model->validate())
            {
                if ($existe_profesor == 0)
                {
                    if ($this->profesorRepository->store($model))
                    {
                        $idusuario = $this->usuarioRepository->maxId() + 1;
                        $model1 = [
                            'idusuario' => $idusuario,
                            'nombre_usuario' => $model->curp,
                            'email' => $model->email,
                            'password' => crypt($model->password, Yii::$app->params['salt']),
                            'cve_estatus' => 'VIG',
                            'activate' => 1,
                            'curp' => $model->curp,
                            'fecha_registro' => $model->fecha_registro,
                            'fecha_actualizacion' => $model->fecha_actualizacion,                        
                        ];

                        if($this->usuarioRepository->store($model1))
                        {
                            $model2 = [
                                'idusuario' => $idusuario,
                                'idrol' => 3
                            ];

                            if($this->rolUsuarioRepository->store($model2))
                            {
                                $msg = 'Profesor agregado';
                                $error = 1;
                            }
                            else
                            {
                                $msg = 'Ocurrió un error al intentar agregar el profesor, intenta nuevamente';
                                $error = 3;
                            }
                        }
                        else
                        {
                            $msg = 'Ocurrió un error al intentar agregar el profesor, intenta nuevamente';
                            $error = 3;
                        }
                    }
                    else
                    {
                        $msg = 'Ocurrió un error al intentar agregar el profesor, intenta nuevamente';
                        $error = 3;
                    }
                }
                else
                {
                    $msg = 'Usuario ya existe';
                    $error = 3;
                }

                $modelo = [
                    'idprofesor' => $model->idprofesor,
                    'curp' => $model->curp,
                    'nombre_profesor' => $model->nombre_profesor,
                    'apaterno' => $model->apaterno,
                    'amaterno' => $model->amaterno,
                    'fecha_registro' => $model->fecha_registro,
                    'fecha_actualizacion' => $model->fecha_actualizacion,
                    'cve_estatus' => $model->cve_estatus
                ];

                return $this->redirect(['profesor/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(['profesor/index']);
        }
    }
    /* #endregion */

    /* #region public function actionEdit($idprofesor, $msg = "", $error = "") */
    public function actionEdit($idprofesor, $msg = "", $error = "")
    {
        if(Yii::$app->request->get())
        {
            $idprofesor = Html::encode($idprofesor);
            $msg = Html::encode($msg);
            $error = Html::encode($error);
            $model = new ProfesorForm;
            $status = 1;

            if($idprofesor)
            {
                $clave_estatus = ["VIG" => "VIGENTE", "BT" => "BAJA TEMPORAL", "BD" => "BAJA DEFINITIVA"];
                $table = $this->profesorRepository->get($idprofesor);

                if($table)
                {
                    $model->attributes = $table->attributes;

                    $usuario = $this->usuarioRepository->consultarUsuarioPorCurp($table->curp);// Usuario::find()->where(["curp" => $table->curp])->one();
                }
                else
                {
                    return $this->redirect(['profesor/index']);
                }
            }
            else
            {
                return $this->redirect(['profesor/index']);
            }
        }
        else
        {
            return $this->redirect(['profesor/index']);
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'clave_estatus', 'usuario'));
    }
    /* #endregion */

    /* #region public function actionUpdate() */
    public function actionUpdate()
    {
        $model = new ProfesorForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $idprofesor = $model->idprofesor;
                $msg = false;

                $table = $this->profesorRepository->get($idprofesor);

                if($table)
                {
                    $error = 1;

                    $usuario = $this->usuarioRepository->consultarUsuarioPorCurp($model->curp);
                    $idusuario = $usuario->idusuario;

                    $model1 = [
                        'idusuario' => $idusuario,
                        'nombre_usuario' => $model->curp,
                        'email' => $model->email,
                        'password' => crypt($model->password, Yii::$app->params['salt']),
                        'cve_estatus' => $model->cve_estatus,
                        'authKey' => '',
                        'accessToken' => '',
                        'activate' => 1,
                        'curp' => $model->curp,
                        'fecha_registro' => $model->fecha_registro,
                        'fecha_actualizacion' => $model->fecha_actualizacion,
                        'verification_code' => ''                           
                    ];

                    if($this->profesorRepository->update($model, $idprofesor))
                    {
                        if($this->usuarioRepository->update($model1, $idusuario))
                        {
                            $msg = 'Registro actualizado';
                        }
                        else
                        {
                            $msg = 'No detectaron cambios en el registro';
                        }
                    }
                    else
                    {
                        $msg = 'No detectaron cambios en el registro';
                    }
                }
                else
                {
                    $msg = 'Profesor no encontrado';
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(['profesor/edit', 'idprofesor' => $idprofesor, 'msg' => $msg, 'error' => $error]);
        }
        else
        {
            return $this->redirect(['profesor/index']);
        }
    }
    /* #endregion */

    /* #region public function actionDelete() */
    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idprofesor = Html::encode($_POST["idprofesor"]);

            $total_relacion = $this->grupoRepository->totalRelacionProfesores($idprofesor);

            if($total_relacion == 0)
            {
                if($this->profesorRepository->destroy($idprofesor))
                {
                    $error = 1;
                    $msg = 'Registro eliminado';
                }
                else
                {
                    $error = 3;
                    $msg = 'Error al eliminar el registro';
                }
            }
            else
            {
                $error = 3;
                $msg = 'El registro no puede ser eliminado, debido a que contiene información relacionada';
            }
            header('Location: '.Url::toRoute('/profesor/index?msg='.$msg.'&error='.$error));
            exit;
        }
        else
        {
            return $this->redirect(['profesor/index']);
        }
    }
    /* #endregion */

    /* #region public function actionHorario() */
    //Este método lo utiliza el profesor logueado
    public function actionHorario()
    {
        $form = new CicloSearch;
        $idciclo = $this->cicloRepository->maxId();
        $ultimo_ciclo = $idciclo;
        $ciclo = $this->cicloRepository->consultaDatosCiclo($idciclo);

        $curp = Html::encode(Yii::$app->user->identity->curp);
        $sql_profesor = $this->profesorRepository->datosProfesorPorCurp($curp);
        $idprofesor = $sql_profesor->idprofesor;

        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
            }
            else
            {
                $form->getErrors();
            }
        }

        $model = $this->profesorRepository->viewHorarioProfesorPorCiclo($idprofesor, $idciclo);

        $ciclo_actual = ($idciclo) ? ((count($model) > 0) ? $model[0]["desc_ciclo"] : $ciclo["desc_ciclo"]) : $ciclo->desc_ciclo;

        $regularizacion_status = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($idciclo, $idprofesor, 5, 1);
        $seguimiento1 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($idciclo, $idprofesor, 1, 1);
        $seguimiento2 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($idciclo, $idprofesor, 2, 1);
        $seguimiento3 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($idciclo, $idprofesor, 3, 1);
        $seguimiento4 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($idciclo, $idprofesor, 4, 1);

        return $this->render('horario', compact('model', 'form', 'ciclos', 'idciclo', 'idprofesor', 'ciclo_actual', 'ultimo_ciclo', 'regularizacion_status', 'seguimiento1', 'seguimiento2', 'seguimiento3', 'seguimiento4'));
    }
    /* #endregion */

    /* #region public function actionListaalumnos() */
    public function actionListaalumnos()//Imprime la lista de alumnos en pantalla
    {
        $this->layout = 'main1';//Cambio de layout

        if(Yii::$app->request->get('idgrupo'))
        {

            $idgrupo = Html::encode($_GET['idgrupo']);
            $idciclo = (Html::encode($_GET['idciclo']) == "") ? $this->cicloRepository->maxId() : Html::encode($_GET['idciclo']);

            $model = $this->estudianteRepository->listaAlumnosCuerpo($idgrupo, $idciclo);

            $model1 = $this->carreraRepository->datosMateriasCarreraPorGrupoCiclo($idgrupo, $idciclo);

            return $this->render('listaAlumnos', compact('model', 'model1', 'idciclo', 'idgrupo'));
        }
    }
    /* #endregion */

    /* #region public function actionHorarioconsulta() */
    public function actionHorarioconsulta()
    {
        $form = new CicloProfesorSearch;

        $ciclo_actual = null;
        $idciclo = null;
        $idprofesor = null;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $profesores = \MyGlobalFunctions::dropDownList($this->profesorRepository->listaRegistros(['apaterno' => SORT_ASC, 'amaterno' => SORT_ASC, 'nombre_profesor' => SORT_ASC]), 'idprofesor', ['apaterno', 'amaterno', 'nombre_profesor']);
        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
        $model = $this->profesorRepository->viewHorarioProfesor();

        if($form->load(Yii::$app->request->get()) || Yii::$app->request->get())
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
                $idprofesor = Html::encode($form->idprofesor);

                $sql = $this->cicloRepository->consultaDatosCiclo($idciclo);
                $ciclo_actual = $sql['desc_ciclo'];

                $model = $this->profesorRepository->viewHorarioProfesorPorCiclo($idprofesor, $idciclo);
            }
            else
            {
                $form->getErrors();
            }
        }

        $ultimo_ciclo = $this->cicloRepository->maxId();

        $regularizacion_status = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 5, 1);
        $seguimiento1 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 1, 1);
        $seguimiento2 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 2, 1);
        $seguimiento3 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 3, 1);
        $seguimiento4 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 4, 1);

        return $this->render('horarioconsulta', compact('model', 'form', 'msg', 'error', 'ciclos', 'idciclo', 'ciclo_actual', 'idprofesor', 'profesores', 'ultimo_ciclo', 'regularizacion_status', 'seguimiento1', 'seguimiento2', 'seguimiento3', 'seguimiento4'));
    }
    /* #endregion */

    /* #region public function actionListaalumnoscalificacion($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo) */
    /* public function actionListaalumnoscalificacion($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo)
    {
        if(isset($idgrupo))
        {
            $idgrupo = Html::encode($idgrupo);
            $idprofesor = Html::encode($idprofesor);
            $idciclo = (Html::encode($idciclo) == "") ? Ciclo::find()->max("idciclo") : Html::encode($idciclo);
            $ultimo_ciclo = Html::encode($ultimo_ciclo);

            $model = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
	                            "estudiantes.sexo",
	                            "cat_opcion_curso.desc_opcion_curso",
                                "grupos_estudiantes.p1",
	                            "grupos_estudiantes.p2",
	                            "grupos_estudiantes.p3",
	                            "grupos_estudiantes.p4",
	                            "grupos_estudiantes.p5",
	                            "grupos_estudiantes.p6",
	                            "grupos_estudiantes.p7",
	                            "grupos_estudiantes.p8",
	                            "grupos_estudiantes.p9",
	                            "grupos_estudiantes.s1",
	                            "grupos_estudiantes.s2",
	                            "grupos_estudiantes.s3",
	                            "grupos_estudiantes.s4",
	                            "grupos_estudiantes.s5",
	                            "grupos_estudiantes.s6",
	                            "grupos_estudiantes.s7",
	                            "grupos_estudiantes.s8",
	                            "grupos_estudiantes.s9",
                                "grupos_estudiantes.sp1",
	                            "grupos_estudiantes.sp2",
	                            "grupos_estudiantes.sp3",
	                            "grupos_estudiantes.sp4",
	                            "grupos_estudiantes.sp5",
	                            "grupos_estudiantes.sp6",
	                            "grupos_estudiantes.sp7",
	                            "grupos_estudiantes.sp8",
	                            "grupos_estudiantes.sp9"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

            $model1 = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                    "cat_materias.desc_materia",
    	                            "cat_carreras.desc_carrera",
                                    "grupos.num_semestre",
                                    "grupos.desc_grupo",
                                    "CONCAT( profesores.apaterno,' ',profesores.amaterno,' ',profesores.nombre_profesor) AS profesor"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["cat_materias"], "cat_materias.idmateria = grupos.idmateria")
                            ->innerJoin(["profesores"], "profesores.idprofesor = grupos.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->andFilterWhere(["grupos.idciclo" => $idciclo])
                            ->all();

            $regular = ProfesorSeguimiento::find()->where(["idciclo" => $ultimo_ciclo, "idprofesor" => $idprofesor, "seguimiento" => 5, "bandera" => 1])->count();

            $ultimo_seguimiento = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor, "seguimiento" => "<5"])->max("seguimiento");

            return $this->render("listaAlumnosCalificacion", ["model" => $model,
                                                              "model1" => $model1,
                                                              "idciclo" => $idciclo,
                                                              "idgrupo" => $idgrupo,
                                                              "idprofesor" => $idprofesor,
                                                              "ultimo_ciclo" => $ultimo_ciclo,
                                                              "ultimo_seguimiento" => $ultimo_seguimiento]);
        }
    } */
    /* #endregion */

    /* #region public function actionGuardarcalificacion() */
    /* public function actionGuardarcalificacion()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST["idgrupo"]);
            $idciclo = Html::encode($_POST["idciclo"]);
            $idprofesor = Html::encode($_POST["idprofesor"]);
            $ultimo_ciclo = Ciclo::find()->max("idciclo");
            $r = Html::encode($_POST["r"]);

            $seguimiento1 = ProfesorSeguimiento::find()->where(["idciclo" => $ultimo_ciclo, "idprofesor" => $idprofesor, "seguimiento" => 1, "bandera" => 1])->count();
            $seguimiento2 = ProfesorSeguimiento::find()->where(["idciclo" => $ultimo_ciclo, "idprofesor" => $idprofesor, "seguimiento" => 2, "bandera" => 1])->count();
            $seguimiento3 = ProfesorSeguimiento::find()->where(["idciclo" => $ultimo_ciclo, "idprofesor" => $idprofesor, "seguimiento" => 3, "bandera" => 1])->count();
            $seguimiento4 = ProfesorSeguimiento::find()->where(["idciclo" => $ultimo_ciclo, "idprofesor" => $idprofesor, "seguimiento" => 4, "bandera" => 1])->count();

            $total = count($_POST["p1"]);

            for($i = 0; $i < $total; $i++)
            {
                $idestudiante = Html::encode($_POST["idestudiante"][$i]);

                $p1 = Html::encode($_POST["p1"][$i]);
                $p2 = Html::encode($_POST["p2"][$i]);
                $p3 = Html::encode($_POST["p3"][$i]);
                $p4 = Html::encode($_POST["p4"][$i]);
                $p5 = Html::encode($_POST["p5"][$i]);
                $p6 = Html::encode($_POST["p6"][$i]);
                $p7 = Html::encode($_POST["p7"][$i]);
                $p8 = Html::encode($_POST["p8"][$i]);
                $p9 = Html::encode($_POST["p9"][$i]);

                $table = GrupoEstudiante::findOne(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante]);

                if($table)
                {
                    $seguimiento = ($seguimiento1 == 1) ? 1 : (($seguimiento2 == 1) ? 2 : (($seguimiento3 == 1) ? 3 : (($seguimiento4 == 1) ? 4 : "")));
                    $ultimo_seguimiento = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor])->max("seguimiento");

                    $sp2_sql = GrupoEstudiante::find()->select("sp2")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp2", [1, 2, 3, 4]])->one();
                    $sp3_sql = GrupoEstudiante::find()->select("sp3")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp3", [1, 2, 3, 4]])->one();
                    $sp4_sql = GrupoEstudiante::find()->select("sp4")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp4", [1, 2, 3, 4]])->one();
                    $sp5_sql = GrupoEstudiante::find()->select("sp5")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp5", [1, 2, 3, 4]])->one();
                    $sp6_sql = GrupoEstudiante::find()->select("sp6")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp6", [1, 2, 3, 4]])->one();
                    $sp7_sql = GrupoEstudiante::find()->select("sp7")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp7", [1, 2, 3, 4]])->one();
                    $sp8_sql = GrupoEstudiante::find()->select("sp8")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp8", [1, 2, 3, 4]])->one();
                    $sp9_sql = GrupoEstudiante::find()->select("sp9")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp9", [1, 2, 3, 4]])->one();

                    $sp2_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp2", [1, 2, 3, 4]])->count();
                    $sp3_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp3", [1, 2, 3, 4]])->count();
                    $sp4_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp4", [1, 2, 3, 4]])->count();
                    $sp5_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp5", [1, 2, 3, 4]])->count();
                    $sp6_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp6", [1, 2, 3, 4]])->count();
                    $sp7_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp7", [1, 2, 3, 4]])->count();
                    $sp8_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp8", [1, 2, 3, 4]])->count();
                    $sp9_sql_total = GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp9", [1, 2, 3, 4]])->count();

                    $sp1 = 1;
                    $sp2 = ($p2 != "") ? (($sp2_sql_total > 0) ? $sp2_sql->sp2 : $seguimiento) : "";
                    $sp3 = ($p3 != "") ? (($sp3_sql_total > 0) ? $sp3_sql->sp3 : $seguimiento) : "";
                    $sp4 = ($p4 != "") ? (($sp4_sql_total > 0) ? $sp4_sql->sp4 : $seguimiento) : "";
                    $sp5 = ($p5 != "") ? (($sp5_sql_total > 0) ? $sp5_sql->sp5 : (($ultimo_seguimiento == 4) ? $ultimo_seguimiento : $seguimiento)) : "";
                    $sp6 = ($p6 != "") ? (($sp6_sql_total > 0) ? $sp6_sql->sp6 : (($ultimo_seguimiento == 4) ? $ultimo_seguimiento : $seguimiento)) : "";
                    $sp7 = ($p7 != "") ? (($sp7_sql_total > 0) ? $sp7_sql->sp7 : (($ultimo_seguimiento == 4) ? $ultimo_seguimiento : $seguimiento)) : "";
                    $sp8 = ($p8 != "") ? (($sp8_sql_total > 0) ? $sp8_sql->sp8 : (($ultimo_seguimiento == 4) ? $ultimo_seguimiento : $seguimiento)) : "";
                    $sp9 = ($p9 != "") ? (($sp9_sql_total > 0) ? $sp9_sql->sp9 : (($ultimo_seguimiento == 4) ? $ultimo_seguimiento : $seguimiento)) : "";

                    $table->p1 = $p1;
                    $table->p2 = $p2;
                    $table->p3 = $p3;
                    $table->p4 = $p4;
                    $table->p5 = $p5;
                    $table->p6 = $p6;
                    $table->p7 = $p7;
                    $table->p8 = $p8;
                    $table->p9 = $p9;

                    $table->sp1 = $sp1;
                    $table->sp2 = $sp2;
                    $table->sp3 = $sp3;
                    $table->sp4 = $sp4;
                    $table->sp5 = $sp5;
                    $table->sp6 = $sp6;
                    $table->sp7 = $sp7;
                    $table->sp8 = $sp8;
                    $table->sp9 = $sp9;

                    // Asigna calificaciones para calificaciones de repetición
                    $table->s1 = ($p1 == "NA") ? $p1 : "";
                    $table->s2 = ($p2 == "NA") ? $p2 : "";
                    $table->s3 = ($p3 == "NA") ? $p3 : "";
                    $table->s4 = ($p4 == "NA") ? $p4 : "";
                    $table->s5 = ($p5 == "NA") ? $p5 : "";
                    $table->s6 = ($p6 == "NA") ? $p6 : "";
                    $table->s7 = ($p7 == "NA") ? $p7 : "";
                    $table->s8 = ($p8 == "NA") ? $p8 : "";
                    $table->s9 = ($p9 == "NA") ? $p9 : "";

                    $table->update();
                }    
            }

            header("Location: ".Url::toRoute("/profesor/listaalumnoscalificacion?idgrupo=$idgrupo&idciclo=$idciclo&idprofesor=$idprofesor&ultimo_ciclo=$ultimo_ciclo&r=$r"));
            exit;
        }
    } */
    /* #endregion */

    /* #region public function actionListaalumnoscalificacionseguimientos($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo) */
    public function actionListaalumnoscalificacionseguimientos($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo)
    {
        if(isset($idgrupo))
        {
            $idgrupo = Html::encode($idgrupo);
            $idprofesor = Html::encode($idprofesor);
            $idciclo = (Html::encode($idciclo) == '') ? $this->cicloRepository->maxId() : Html::encode($idciclo);
            $ultimo_ciclo = Html::encode($ultimo_ciclo);

            $model = $this->estudianteRepository->calificacionesPorGrupoCiclo((int)$idgrupo, (int)$idciclo);

            $model1 = $this->carreraRepository->datosCalificacionesPorGrupoCiclo((int)$idgrupo, (int)$idciclo);
            
            $seguimiento1 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($ultimo_ciclo, $idprofesor, 1, 1);
            $seguimiento2 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($ultimo_ciclo, $idprofesor, 2, 1);
            $seguimiento3 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($ultimo_ciclo, $idprofesor, 3, 1);
            $seguimiento4 = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera($ultimo_ciclo, $idprofesor, 4, 1);

            return $this->render('listaAlumnosCalificacionSeguimientos', compact('model', 'model1', 'idciclo', 'idgrupo', 'idprofesor', 'seguimiento1', 'seguimiento2', 'seguimiento3', 'seguimiento4', 'ultimo_ciclo'));
        }
    }
    /* #endregion */

    /* #region public function actionGuardarcalificacionseguimientos() */
    public function actionGuardarcalificacionseguimientos()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST['idgrupo']);
            $idciclo = Html::encode($_POST['idciclo']);
            $idprofesor = Html::encode($_POST['idprofesor']);
            $ultimo_ciclo = $this->cicloRepository->maxId();
            $r = Html::encode($_POST['r']);
            $seguimiento = Html::encode($_POST['seguimiento']);

            $total = count($_POST['p1']);

            for($i = 0; $i < $total; $i++)
            {
                $idestudiante = Html::encode($_POST['idestudiante'][$i]);

                $p1 = Html::encode($_POST['p1'][$i]);
                $p2 = Html::encode($_POST['p2'][$i]);
                $p3 = Html::encode($_POST['p3'][$i]);
                $p4 = Html::encode($_POST['p4'][$i]);
                $p5 = Html::encode($_POST['p5'][$i]);
                $p6 = Html::encode($_POST['p6'][$i]);
                $p7 = Html::encode($_POST['p7'][$i]);
                $p8 = Html::encode($_POST['p8'][$i]);
                $p9 = Html::encode($_POST['p9'][$i]);

                $table = $this->grupoEstudianteRepository->consultaDatoGrupoEstudiante((int)$idgrupo, (int)$idestudiante);

                if($table)
                {
                    $table->p1 = $p1;
                    $table->p2 = $p2;
                    $table->p3 = $p3;
                    $table->p4 = $p4;
                    $table->p5 = $p5;
                    $table->p6 = $p6;
                    $table->p7 = $p7;
                    $table->p8 = $p8;
                    $table->p9 = $p9;

                    $sp1_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp1');//GrupoEstudiante::find()->select("sp1")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp1", [1, 2, 3, 4]])->one();
                    $sp2_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp2');//GrupoEstudiante::find()->select("sp2")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp2", [1, 2, 3, 4]])->one();
                    $sp3_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp3');//GrupoEstudiante::find()->select("sp3")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp3", [1, 2, 3, 4]])->one();
                    $sp4_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp4');//GrupoEstudiante::find()->select("sp4")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp4", [1, 2, 3, 4]])->one();
                    $sp5_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp5');//GrupoEstudiante::find()->select("sp5")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp5", [1, 2, 3, 4]])->one();
                    $sp6_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp6');//GrupoEstudiante::find()->select("sp6")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp6", [1, 2, 3, 4]])->one();
                    $sp7_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp7');//GrupoEstudiante::find()->select("sp7")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp7", [1, 2, 3, 4]])->one();
                    $sp8_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp8');//GrupoEstudiante::find()->select("sp8")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp8", [1, 2, 3, 4]])->one();
                    $sp9_sql = $this->grupoEstudianteRepository->oneSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp9');//GrupoEstudiante::find()->select("sp9")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp9", [1, 2, 3, 4]])->one();

                    $sp1_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp1');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp1", [1, 2, 3, 4]])->count();
                    $sp2_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp2');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp2", [1, 2, 3, 4]])->count();
                    $sp3_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp3');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp3", [1, 2, 3, 4]])->count();
                    $sp4_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp4');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp4", [1, 2, 3, 4]])->count();
                    $sp5_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp5');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp5", [1, 2, 3, 4]])->count();
                    $sp6_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp6');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp6", [1, 2, 3, 4]])->count();
                    $sp7_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp7');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp7", [1, 2, 3, 4]])->count();
                    $sp8_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp8');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp8", [1, 2, 3, 4]])->count();
                    $sp9_sql_total = $this->grupoEstudianteRepository->countSeguimientoParcialPorGrupoEstudiante((int)$idgrupo, (int)$idestudiante, 'sp9');//GrupoEstudiante::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->andWhere(["in", "sp9", [1, 2, 3, 4]])->count();

                    $sp1 = ($p1 != '') ? (($sp1_sql_total > 0) ? $sp1_sql->sp1 : $seguimiento) : '';
                    $sp2 = ($p2 != '') ? (($sp2_sql_total > 0) ? $sp2_sql->sp2 : $seguimiento) : '';
                    $sp3 = ($p3 != '') ? (($sp3_sql_total > 0) ? $sp3_sql->sp3 : $seguimiento) : '';
                    $sp4 = ($p4 != '') ? (($sp4_sql_total > 0) ? $sp4_sql->sp4 : $seguimiento) : '';
                    $sp5 = ($p5 != '') ? (($sp5_sql_total > 0) ? $sp5_sql->sp5 : $seguimiento) : '';
                    $sp6 = ($p6 != '') ? (($sp6_sql_total > 0) ? $sp6_sql->sp6 : $seguimiento) : '';
                    $sp7 = ($p7 != '') ? (($sp7_sql_total > 0) ? $sp7_sql->sp7 : $seguimiento) : '';
                    $sp8 = ($p8 != '') ? (($sp8_sql_total > 0) ? $sp8_sql->sp8 : $seguimiento) : '';
                    $sp9 = ($p9 != '') ? (($sp9_sql_total > 0) ? $sp9_sql->sp9 : $seguimiento) : '';

                    $table->sp1 = $sp1;
                    $table->sp2 = $sp2;
                    $table->sp3 = $sp3;
                    $table->sp4 = $sp4;
                    $table->sp5 = $sp5;
                    $table->sp6 = $sp6;
                    $table->sp7 = $sp7;
                    $table->sp8 = $sp8;
                    $table->sp9 = $sp9;

                    /** Asigna calificaciones para calificaciones de repetición */
                    $table->s1 = ($p1 == 'NA') ? '' : '';
                    $table->s2 = ($p2 == 'NA') ? '' : '';
                    $table->s3 = ($p3 == 'NA') ? '' : '';
                    $table->s4 = ($p4 == 'NA') ? '' : '';
                    $table->s5 = ($p5 == 'NA') ? '' : '';
                    $table->s6 = ($p6 == 'NA') ? '' : '';
                    $table->s7 = ($p7 == 'NA') ? '' : '';
                    $table->s8 = ($p8 == 'NA') ? '' : '';
                    $table->s9 = ($p9 == 'NA') ? '' : '';

                    $table->update();
                }    
            }

            header('Location: '.Url::toRoute('/profesor/listaalumnoscalificacionseguimientos?idgrupo='.$idgrupo.'&idciclo='.$idciclo.'&idprofesor='.$idprofesor.'&ultimo_ciclo='.$ultimo_ciclo.'&r='.$r.'&seguimiento='.$seguimiento));
            exit;
        }
    }
    /* #endregion */

    /* #region public function actionListaalumnoscalificacionregularizacion($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo) */
    public function actionListaalumnoscalificacionregularizacion($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo)
    {
        if(isset($idgrupo))
        {
            $idgrupo = Html::encode($idgrupo);
            $idprofesor = Html::encode($idprofesor);
            $idciclo = (Html::encode($idciclo) == '') ? $this->cicloRepository->maxId() : Html::encode($idciclo);
            $ultimo_ciclo = Html::encode($ultimo_ciclo);
            $regularizacion_status = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$idciclo, (int)$idprofesor, 5, 1);

            $model = $this->estudianteRepository->calificacionesPorGrupoCiclo((int)$idgrupo, (int)$idciclo);

            $model1 = $this->carreraRepository->datosCalificacionesPorGrupoCiclo((int)$idgrupo, (int)$idciclo);

            return $this->render('listaAlumnosCalificacionRepeticion', compact('model', 'model1', 'idciclo', 'idgrupo', 'idprofesor', 'ultimo_ciclo', 'regularizacion_status'));
        }
    }
    /* #endregion */

    /* #region public function actionGuardarcalificacionregularizacion() */
    public function actionGuardarcalificacionregularizacion()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST['idgrupo']);
            $idciclo = Html::encode($_POST['idciclo']);
            $idprofesor = Html::encode($_POST['idprofesor']);
            $ultimo_ciclo = $this->cicloRepository->maxId();
            $r = Html::encode($_POST['r']);

            $regularizacion_status = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesorBandera((int)$ultimo_ciclo, (int)$idprofesor, 5, 1);

            if($regularizacion_status == 1)
            {
                $total = count($_POST['s1']);

                for($i = 0; $i < $total; $i++)
                {
                    $idestudiante = Html::encode($_POST['idestudiante'][$i]);

                    $s1 = Html::encode($_POST['s1'][$i]);
                    $s2 = Html::encode($_POST['s2'][$i]);
                    $s3 = Html::encode($_POST['s3'][$i]);
                    $s4 = Html::encode($_POST['s4'][$i]);
                    $s5 = Html::encode($_POST['s5'][$i]);
                    $s6 = Html::encode($_POST['s6'][$i]);
                    $s7 = Html::encode($_POST['s7'][$i]);
                    $s8 = Html::encode($_POST['s8'][$i]);
                    $s9 = Html::encode($_POST['s9'][$i]);

                    $id = [
                        'idgrupo' => $idgrupo,
                        'idestudiante' => $idestudiante
                    ];

                    $datos = [
                        's1' => $s1,
                        's2' => $s2,
                        's3' => $s3,
                        's4' => $s4,
                        's5' => $s5,
                        's6' => $s6,
                        's7' => $s7,
                        's8' => $s8,
                        's9' => $s9
                    ];

                    $this->grupoEstudianteRepository->update($datos, $id);
                }
            }
            header('Location: '.Url::toRoute('/profesor/listaalumnoscalificacionregularizacion?idgrupo='.$idgrupo.'&idciclo='.$idciclo.'&idprofesor='.$idprofesor.'&ultimo_ciclo='.$ultimo_ciclo.'&r='.$r));
            exit;
        }
    }
    /* #endregion */

    /* #region public function actionHorarioprofesor() */
    public function actionHorarioprofesor()
    {
        $this->layout = 'main2';

        $idciclo = $this->cicloRepository->maxId();
        $idprofesor = Html::encode($_GET['idprofesor']);
        $ciclos = $this->cicloRepository->consultarCiclos(); //Ciclo::find()->orderBy(['idciclo' => SORT_DESC])->all();

        $model = $this->profesorRepository->viewHorarioProfesorPorCiclo((int)$idprofesor, (int)$idciclo);

        return $this->render('horario_profesor', compact('model', 'ciclos', 'idciclo', 'idprofesor'));
    }
    /* #endregion */

    /* #region public function actionHorarioprofesorconsulta() */
    public function actionHorarioprofesorconsulta()
    {
        $this->layout = 'main2';

        $idciclo = Html::encode($_GET['idciclo']);
        $idprofesor = Html::encode($_GET['idprofesor']);

        $model = $this->profesorRepository->viewHorarioProfesorPorCiclo((int)$idprofesor, (int)$idciclo);

        return $this->render('horario_profesor', compact('model', 'idciclo'));
    }
    /* #endregion */

    /* #region public function actionConsultarprofesor() */
    public function actionConsultarprofesor()
    {
        $idprofesor = Html::encode($_GET['idprofesor']);
        $profesor = $this->profesorRepository->datosProfesorPorId((int)$idprofesor);// Profesor::find()->where(["idprofesor" => $idprofesor])->one();

        return $profesor->apaterno.' '.$profesor->amaterno.' '.$profesor->nombre_profesor;
    }
    /* #endregion */
}