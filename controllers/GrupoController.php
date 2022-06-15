<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
//use app\helpers\MyGlobalFunctions;

use app\models\User;
use app\models\grupo\GrupoForm;
use app\models\grupo\GrupoSearch;

use app\repositories\GrupoRepository;
use app\repositories\CicloRepository;
use app\repositories\GrupoEstudianteRepository;
use app\repositories\CarreraRepository;
use app\repositories\MateriaRepository;
use app\repositories\ProfesorRepository;

class GrupoController extends Controller
{
    private $grupoRepository;
    private $cicloRepository;
    private $grupoEstudianteRepository;
    private $carreraRepository;
    private $materiaRepository;
    private $profesorRepository;

    #region public function behaviors()
    public function behaviors()
    {
        return [
                "access" => [
                    "class" => AccessControl::className(),
                    "only" => ["index", "create", "store", "edit", "update", "delete", "grupoalumnos"],//Especificar que acciones se van proteger
                    "rules" => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            "actions" => ["index", "create", "store", "edit", "update", "delete", "grupoalumnos"],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1);
                            },  
                        ],
                        [
                            //Servicios escolares tiene permisos sobre las siguientes acciones
                            "actions" => ["index", "create", "store", "edit", "update", "delete"],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El profesor tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                            },  
                        ],
                        [
                            //División de estudios tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4);
                            },  
                        ]
                    ],
                ],
                //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
                //sólo se puede acceder a través del método post
                "verbs" => [
                    "class" => VerbFilter::className(),
                    "actions" => [
                        "logout" => ["post"],
                    ],
                ],
        ];
    }
    #endregion

    #region public function __construct()
    public function __construct($id, $module, $config = [],
                                GrupoRepository $grupoRepository,
                                CicloRepository $cicloRepository,
                                GrupoEstudianteRepository $grupoEstudianteRepository,
                                CarreraRepository $carreraRepository,
                                MateriaRepository $materiaRepository,
                                ProfesorRepository $profesorRepository
                                )
    {
        parent::__construct($id, $module, $config);
        $this->grupoRepository = $grupoRepository;
        $this->cicloRepository = $cicloRepository;
        $this->grupoEstudianteRepository = $grupoEstudianteRepository;
        $this->carreraRepository = $carreraRepository;
        $this->materiaRepository = $materiaRepository;
        $this->profesorRepository = $profesorRepository;
    }
    #endregion

    #region public function actionIndex()
    public function actionIndex()
    {
        $form = new GrupoSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $model = $this->grupoRepository->allQuery();//Se ejecuta consulta de todos los registgros

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $this->grupoRepository->search = Html::encode($form->buscar);//Pasamos parámetro para la búsqueda

                $model = $this->grupoRepository->allQuery(true);//Se ejecuta consulta con parámetro de búsqueda
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->grupoRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages'));
    }
    #endregion

    #region public function actionCreate($msg = '', $error = '')
    public function actionCreate($msg = '', $error = '')
    {

        $model = new GrupoForm();
        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
        $carreras = \MyGlobalFunctions::dropDownList($this->carreraRepository->listaRegistros(['desc_carrera' => SORT_ASC]), 'idcarrera', ['desc_carrera']);
        $materias = \MyGlobalFunctions::dropDownList($this->materiaRepository->listaRegistros(['desc_materia' => SORT_ASC]), 'idmateria', ['desc_materia']);
        $profesores = \MyGlobalFunctions::dropDownList($this->profesorRepository->listaRegistros(['apaterno' => SORT_ASC, 'amaterno' => SORT_ASC, 'nombre_profesor' => SORT_ASC]), 'idprofesor', ['apaterno', 'amaterno', 'nombre_profesor']);
        $idprofesor = null;
        $idciclo = null;
        $idcarrera = null;
        $idmateria = null;
        $status = 0;

        if(Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'ciclos', 'idprofesor', 'idciclo', 'idcarrera', 'idmateria', 'carreras', 'materias', 'profesores'));
    }
    #endregion

    #region public function actionStore()
    public function actionStore()
    {
        $model = new GrupoForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if ($this->grupoRepository->store($model))
                {
                    $msg = 'Grupo agregado';
                    $error = 1;
                }
                else
                {
                    $msg = 'Ocurrió un error al intentar agregar el grupo, intenta nuevamente';
                    $error = 3;
                }

                $modelo = [
                    'idciclo' => $model->idciclo,
                    'idcarrera' => $model->idcarrera,
                    'idmateria' => $model->idmateria,
                    'idprofesor' => $model->idprofesor,
                    'num_semestre' => $model->num_semestre,
                    'desc_grupo_corto' => $model->desc_grupo_corto,
                    'desc_grupo' => $model->desc_grupo,
                    'aula' => $model->aula,
                    'horario' => $model->horario,
                    'lunes' => $model->lunes,
                    'martes' => $model->martes,
                    'miercoles' => $model->miercoles,
                    'jueves' => $model->jueves,
                    'viernes' => $model->viernes,
                    'sabado' => $model->sabado
                ];

                return $this->redirect(['grupo/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["carrera/index"]);
        }
    }
    #endregion

    #region public function actionEdit($id, $msg = '', $error = '')
    public function actionEdit($id, $msg = '', $error ='')
    {
        $idgrupo = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);
        $status = 1;

        if(Yii::$app->request->get())
        {
            $model = new GrupoForm;
            $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
            $carreras = \MyGlobalFunctions::dropDownList($this->carreraRepository->listaRegistros(['desc_carrera' => SORT_ASC]), 'idcarrera', ['desc_carrera']);
            $materias = \MyGlobalFunctions::dropDownList($this->materiaRepository->listaRegistros(['desc_materia' => SORT_ASC]), 'idmateria', ['desc_materia']);
            $profesores = \MyGlobalFunctions::dropDownList($this->profesorRepository->listaRegistros(['apaterno' => SORT_ASC, 'amaterno' => SORT_ASC, 'nombre_profesor' => SORT_ASC]), 'idprofesor', ['apaterno', 'amaterno', 'nombre_profesor']);

            if($idgrupo)
            {
                $table = $this->grupoRepository->get($idgrupo);

                if($table)
                {
                    $model->attributes = $table->attributes;
                }
                else
                {
                    return $this->redirect(['grupo/index']);
                }
            }
            else
            {
                return $this->redirect(['grupo/index']);
            }
        }
        else
        {
            return $this->redirect(['grupo/index']);
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'ciclos', 'carreras', 'materias', 'profesores'));
    }
    #endregion

    #region public function actionUpdate()
    public function actionUpdate()
    {
        $model = new GrupoForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idgrupo = $model->idgrupo;

            if($model->validate())
            {
                $table = $this->grupoRepository->get($idgrupo);

                if ($table)
                {
                    if($this->grupoRepository->update($model, $idgrupo))
                    {
                        $msg = 'Registro actualizado';
                    }
                    else
                    {
                        $msg = 'No se detectaron cambios en el registro';
                    }
                    $error = 1;
                }
                else
                {
                    $msg = 'Registro no encontrado';
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(['grupo/edit', 'id' => $idgrupo, 'msg' => $msg, 'error' => $error]);
        }
        else
        {
            return $this->redirect(['grupo/index']);
        }
    }
    #endregion

    #region public function actionDelete()
    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST['idgrupo']);

            $total_relacion = $this->grupoEstudianteRepository->totalRelacionGrupos($idgrupo);

            if($total_relacion == 0)
            {
                if($this->grupoRepository->destroy($idgrupo))
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
            header('Location: '.Url::toRoute('/grupo/index?msg='.$msg.'&error='.$error));
            exit;
        }
        else
        {
            return $this->redirect(['grupo/index']);
        }
    }
    #endregion

    #region public function actionGrupoalumnos()
    public function actionGrupoalumnos()
    {
        $this->layout = 1;

        if(Yii::$app->request->get())
        {
            $idgrupo = Html::encode($_GET["idgrupo"]);

            $model = $this->grupoRepository->queryGrupoAlumnos($idgrupo);

            return $this->render('grupo_alumnos', compact('model'));
        }
    }
    #endregion
}