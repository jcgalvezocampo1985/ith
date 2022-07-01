<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

use app\models\estudiante\EstudianteForm;
use app\models\estudiante\EstudianteSearch;
use app\models\estudiante\EstudianteHorarioSearch;
use app\models\grupoestudiante\GrupoEstudiante;
use app\models\User;

use app\repositories\EstudianteRepository;
use app\repositories\CicloRepository;
use app\repositories\CarreraRepository;
use app\repositories\GrupoEstudianteRepository;
use app\repositories\ActaCalificacionRepository;
use app\repositories\opcionCursoRepository;
use app\repositories\GrupoRepository;

class EstudianteController extends Controller
{
    private $estudianteRepository;
    private $cicloRepository;
    private $carreraRepository;
    private $grupoEstudianteRepository;
    private $actaCalificacionRepository;
    private $opcionCursoRepository;
    private $grupoRepository;

    #region(collapsed) [public function behaviors()]
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index',
                               'create',
                               'update',
                               'delete',
                               'boletacalificacion',
                               'horarioalumnos',
                               'horariomodificar',
                               'deletehorarioestudiante',
                               'horarioagregar',
                               'agregarmateria',
                    ],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
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
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
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
                            'actions' => [''],//Especificar que acciones tiene permitidas este usuario
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
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
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
    #endregion

    #region(collapsed) [public function __construct()]
    public function __construct($id, $module, $config = [],
                                EstudianteRepository $estudianteRepository,
                                CicloRepository $cicloRepository,
                                CarreraRepository $carreraRepository,
                                GrupoEstudianteRepository $grupoEstudianteRepository,
                                ActaCalificacionRepository $actaCalificacionRepository,
                                OpcionCursoRepository $opcionCursoRepository,
                                GrupoRepository $grupoRepository
                                )
    {
        parent::__construct($id, $module, $config);
        $this->estudianteRepository = $estudianteRepository;
        $this->cicloRepository = $cicloRepository;
        $this->carreraRepository = $carreraRepository;
        $this->grupoEstudianteRepository = $grupoEstudianteRepository;
        $this->actaCalificacionRepository = $actaCalificacionRepository;
        $this->opcionCursoRepository = $opcionCursoRepository;
        $this->grupoRepository = $grupoRepository;
    }
    #endregion

    #region(collapsed) [public function actionIndex()]
    public function actionIndex()
    {
        $form = new EstudianteSearch;
        $idestudiante = null;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $model = $this->estudianteRepository->allQuery();//Se ejecuta consulta de todos los registgros

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $this->estudianteRepository->search = Html::encode($form->buscar);//Pasamos parámetro para la búsqueda

                $model = $this->estudianteRepository->allQuery(true);//Se ejecuta consulta con parámetro de búsqueda
                
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->estudianteRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }
        
        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages'));
    }
    #endregion

    #region(collapsed) [public function actionCreate($msg = '', $error = '')]
    public function actionCreate($msg = '', $error = '')
    {
        $model = new EstudianteForm;
        $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
        $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
        $clave_estatus = ['VIG' => 'VIGENTE'];
        $carrera = \MyGlobalFunctions::dropDownList($this->carreraRepository->listaRegistros(['desc_carrera' => SORT_ASC]), 'idcarrera', ['desc_carrera']);
        $status = 0;

        if(Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'msg', 'error', 'sexo', 'num_semestre', 'status', 'carrera', 'clave_estatus'));
    }
    #endregion

    #region(collapsed) [public function actionStore()]
    public function actionStore()
    {
        $model = new EstudianteForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $idestudiante = $model->idestudiante;
            $email = $model->email;
            $existe_idestudiante = $this->estudianteRepository->totalRegistros($idestudiante);// Estudiante::find()->where(["idestudiante" => $idestudiante])->count();
            $existe_email = $this->estudianteRepository->existeEmail($email);//Estudiante::find()->where(["email" => $email])->count();

            if ($model->validate())
            {
                if ($existe_idestudiante == 0)
                {
                    if ($existe_email == 0)
                    {
                        if ($this->estudianteRepository->store($model))
                        {
                            $msg = 'Estudiante agregado';
                            $error = 1;
                        }
                        else
                        {
                            $msg = 'Ocurrió un error al intentar agregar el estudiante, intenta nuevamente';
                            $error = 3;
                        }
                    }
                    else
                    {
                        $msg = 'Email ya existe';
                        $error = 3;
                    }
                }
                else
                {
                    $msg = 'No. Control ya existe';
                    $error = 3;
                }

                $modelo = [
                    'idestudiante' => $model->idestudiante,
                    'nombre_estudiante' => $model->nombre_estudiante,
                    'email' => $model->email,
                    'sexo' => $model->sexo,
                    'idcarrera' => $model->idcarrera,
                    'num_semestre' => $model->num_semestre,
                    'fecha_registro' => $model->fecha_registro,
                    'fecha_actualizacion' => $model->fecha_actualizacion,
                    'cve_estatus' => $model->cve_estatus
                ];

                return $this->redirect(['estudiante/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(['estudiante/index']);
        }
    }
    #endregion

    #region(collapsed) [public function actionEdit($idestudiante, $msg = '', $error = '')]
    public function actionEdit($idestudiante, $msg = '', $error = '')
    {
        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($idestudiante);
            $msg = Html::encode($msg);
            $error = Html::encode($error);
            $status = 1;

            if($idestudiante)
            {
                $model = new EstudianteForm;
                $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
                $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
                $clave_estatus = ['VIG' => 'VIGENTE', 'BT' => 'BAJA TEMPORAL', 'BD' => 'BAJA DEFINITIVA', 'DES' => 'DESERTOR'];
                $carrera = \MyGlobalFunctions::dropDownList($this->carreraRepository->listaRegistros(['desc_carrera' => SORT_ASC]), 'idcarrera', ['desc_carrera']);

                $table = $this->estudianteRepository->get($idestudiante);

                if($table)
                {
                    $model->attributes = $table->attributes;
                }
                else
                {
                    return $this->redirect(['estudiante/index']);
                }
            }
            else
            {
                return $this->redirect(['estudiante/index']);
            }
        }
        else
        {
            return $this->redirect(['estudiante/index']);
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'sexo', 'num_semestre', 'carrera', 'clave_estatus'));
    }
    #endregion

    #region(collapsed) [public function actionUpdate()]
    public function actionUpdate()
    {
        $model = new EstudianteForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $idestudiante = $model->idestudiante;
                $msg = false;

                $table = $this->estudianteRepository->get($idestudiante);

                if ($table)
                {
                    if($this->estudianteRepository->update($model, $idestudiante))
                    {
                        $msg = 'Registro actualizado';
                    }
                    else
                    {
                        $msg = 'No detectaron cambios en el registro';
                    }
                    $error = 1;
                }
                else
                {
                    $msg = 'Alumno no encontrado';
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(['estudiante/edit', 'idestudiante' => $idestudiante, 'msg' => $msg, 'error' => $error]);
        }
        else
        {
            return $this->redirect(['estudiante/index']);
        }
    }
    #endregion

    #region(collapsed) [public function actionDelete()]
    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idestudiante = Html::encode($_POST['idestudiante']);

            $total_relacion = $this->grupoEstudianteRepository->totalRelacionEstudiantes($idestudiante);

            if($total_relacion == 0)
            {
                if($this->estudianteRepository->destroy($idestudiante))
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
            header('Location: '.Url::toRoute('/estudiante/index?msg='.$msg.'&error='.$error));
            exit;
        }
        else
        {
            return $this->redirect(['estudiante/index']);
        }
    }
    #endregion

    #region(collapsed) [public function actionHorario()]
    public function actionHorario()
    {
        $model = [];
        $form = new EstudianteSearch;
        $idestudiante = null;
        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
                $model = $this->estudianteRepository->viewEstudianteEncabezado($idestudiante);
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render('horario', compact('model', 'form', 'status'));
    }
    #endregion

    #region(collapsed) [public function actionBoleta()]
    public function actionBoleta()
    {
        $model = [];
        $form = new EstudianteSearch;
        $idestudiante = null;
        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
                $model = $this->estudianteRepository->viewEstudianteEncabezado($idestudiante);
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render('boleta', compact('model', 'form', 'status'));
    }
    #endregion

    #region(collapsed) [public function actionCalificaciones()]
    public function actionCalificaciones()
    {
        $model = [];
        $form = new EstudianteSearch;
        $idestudiante = null;
        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
                $model = $this->estudianteRepository->viewEstudianteEncabezado($idestudiante);
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render('calificaciones', compact('model', 'form', 'status'));
    }
    #endregion

    #region(collapsed) [public function actionCalificacionesporciclo()]
    public function actionCalificacionesporciclo()
    {
        $this->layout = 1;

        if (Yii::$app->request->get('idestudiante') && Yii::$app->request->get('idciclo'))
        {
            $idestudiante = Html::encode($_GET['idestudiante']);
            $idciclo = Html::encode($_GET['idciclo']);

            $idciclo_actual = $this->cicloRepository->maxId();

            $table = new \yii\db\Query();

            if($idciclo_actual == $idciclo)
            {
                $model = $this->grupoEstudianteRepository->getEstudianteCalificacionesCiclo($idestudiante, $idciclo);
                $view = 'calificaciones_por_ciclo_actual';
            }
            else
            {
                $model = $this->actaCalificacionRepository->getEstudianteCalificacionesCiclo($idestudiante, $idciclo);
                $view = 'calificaciones_por_ciclo';
            }

            return $this->render($view, compact('model'));
        }
        else
        {
            throw new \yii\web\HttpException(404,'Oops. Not logged in.');
        }
    }
    #endregion

    #region(collapsed) [public function actionBoletacalificacion()]
    public function actionBoletacalificacion()
    {
        $this->layout = 'main2';

        $idestudiante = Html::encode($_GET['idestudiante']);
        $model = $this->estudianteRepository->viewEstudianteEncabezado($idestudiante);

        return $this->render('boleta_calificacion', compact('model'));
    }
    #endregion

    #region(collapsed) [public function actionHorarioalumnos()]
    public function actionHorarioalumnos()
    {
        $this->layout = 'main2';
        $idestudiante = Html::encode($_GET['idestudiante']);

        $model = $this->estudianteRepository->viewEstudianteEncabezado($idestudiante);

        return $this->render('horario_alumno', compact('model'));
    }
    #endregion

    #region(collapsed) [public function actionHorariomodificar()]
    public function actionHorariomodificar()
    {
        $idciclo_actual = $this->cicloRepository->maxId();
        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
        $form = new EstudianteHorarioSearch;
        $msg = null;

        if ($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $idestudiante = Html::encode($form->idestudiante);
                $idciclo = Html::encode($form->idciclo);
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $idestudiante = (Html::encode(isset($_GET['idestudiante']))) ? Html::encode($_GET['idestudiante']) : 999999999999;
            $idciclo = (Html::encode(isset($_GET['idciclo']))) ? Html::encode($_GET['idciclo']) : 0;
            $idgrupo = (Html::encode(isset($_GET['idgrupo']))) ? Html::encode($_GET['idgrupo']) : 0;
            $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
            $status = (Html::encode(isset($_GET['status']))) ? Html::encode($_GET['status']) : 0;
        }

        $model = $this->estudianteRepository->viewHorarioEstudiante($idestudiante, $idciclo);
        $model1 = $this->grupoEstudianteRepository->getCreditosEstudianteCiclo($idestudiante, $idciclo);
        $model2 = $this->carreraRepository->getCarreraEstudiante($idestudiante);

        $creditos = $model1[0]['creditos'];
        $idcarrera = (count($model2) > 0) ? $model2[0]['idcarrera'] : '';
        $carrera = (count($model2) > 0) ? $model2[0]['desc_carrera'] : '';
        $estudiante = (count($model2) > 0) ? $model2[0]['nombre_estudiante'] : '';

        if(count($model) <= 0 && $status == 1)
        {
            $msg = 'No se encontraron registros relacionados con el No. Control '. $idestudiante;
        }

        return $this->render('horariomodificar', compact('model', 'form', 'ciclos', 'idestudiante', 'estudiante', 'idciclo', 'idciclo_actual', 'creditos', 'idcarrera', 'carrera', 'status', 'msg'));
    }
    #endregion

    #region(collapsed) [public function actionDeletehorarioestudiante()]
    public function actionDeletehorarioestudiante()
    {
        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($_GET['idestudiante']);
            $idgrupo = Html::encode($_GET['idgrupo']);
            $idciclo = Html::encode($_GET['idciclo']);

            $total_relacion = $this->actaCalificacionRepository->totalRelacionEstudianteGrupo($idestudiante, $idgrupo);

            if($total_relacion == 0)
            {
                if($this->grupoEstudianteRepository->detroyGrupoEstudiante($idestudiante, $idgrupo))
                {
                    $msg = 'Registro eliminado';
                }
                else
                {
                    $msg = 'Error al eliminar el registro';
                }
            }
            else
            {
                $msg = 'El registro no puede ser eliminado, debido a que tiene información relacionada';
            }

            header('Location: '.Url::toRoute('/estudiante/horariomodificar?idestudiante='.$idestudiante.'&idgrupo='.$idgrupo.'&idciclo='.$idciclo.'&msg='.$msg.'&status=2'));
            exit;
        }
    }
    #endregion

    #region(collapsed) [public function actionHorarioagregar()]
    public function actionHorarioagregar()
    {
        $this->layout = 'main2';//Cambio de layout

        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($_GET['idestudiante']);
            $idciclo = Html::encode($_GET['idciclo']);
            $idcarrera = Html::encode($_GET['idcarrera']);
            $desc_materia = '';

            $opcion_curso = $this->opcionCursoRepository->all();

            if(Html::encode(isset($_GET['desc_materia'])))
            {
                $desc_materia = Html::encode($_GET['desc_materia']);
            }

            $materias = $this->grupoRepository->queryCicloCarreraEstudiante($idcarrera, $idestudiante, $desc_materia);

            return $this->render('horarioagregar', compact('materias', 'opcion_curso', 'idestudiante', 'idciclo', 'idcarrera'));
        }
    }
    #endregion

    #region(collapsed) [public function actionAgregarmateria()]
    public function actionAgregarmateria()
    {
        if (Yii::$app->request->get())
        {
            $idgrupo = Html::encode($_GET['idgrupo']);
            $idestudiante = Html::encode($_GET['idestudiante']);
            $idopcion_curso = Html::encode($_GET['idopcion_curso']);
            $idciclo = Html::encode($_GET['idciclo']);

            $table = new GrupoEstudiante();
            $table->idgrupo = $idgrupo;
            $table->idestudiante = $idestudiante;
            $table->idopcion_curso = $idopcion_curso;
            $table->idciclo = $idciclo;
            $table->cve_estatus = 'VIG';
            $table->idgrupoidestudiante = ($idgrupo.$idestudiante);

            if($table->insert())
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
        }
        else
        {
            $status = 0;
        }

        return $status;
    }
    #endregion
}