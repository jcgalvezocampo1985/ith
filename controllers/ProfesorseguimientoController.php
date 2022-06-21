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
use yii\helpers\ArrayHelper;
use yii\data\Pagination;

use app\models\profesor\Profesor;
use app\models\profesor\ProfesorSearch;
use app\models\ciclo\CicloProfesorSearch;
use app\models\ciclo\Ciclo;
use app\models\ciclo\CicloSearch;
use app\models\profesorseguimiento\ProfesorSeguimientoForm;
use app\models\profesorseguimiento\ProfesorSeguimiento;
use app\models\User;

use app\repositories\ProfesorSeguimientoRepository;
use app\repositories\CicloRepository;
use app\repositories\ProfesorRepository;

class ProfesorseguimientoController extends Controller
{
    private $profesorSeguimientoRepository;
    private $cicloRepository;
    private $profesorRepository;

    #region public function behaviors()
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 
                               'create',
                               'update',
                               'delete',
                               'horario',
                               'listaalumnos',
                               'horarioconsulta',
                               'listaalumnoscalificacion',
                               'guardarcalificacion',
                               'listaalumnoscalificacionregularizacion',
                               'guardarcalificacionregularizacion',
                               'horarioprofesor',
                               'horarioprofesorconsulta',
                               'consultarprofesor',
                               'seguimientos',
                               'asignarseguimiento',
                               'asignarseguimientos',
                               'seguimientosactivos'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 
                                          'create',
                                          'update',
                                          'delete',
                                          'horario',
                                          'listaalumnos',
                                          'horarioconsulta',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion',
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'horarioprofesor',
                                          'horarioprofesorconsulta',
                                          'consultarprofesor',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'seguimientosactivos'],//Especificar que acciones tiene permitidas este usuario
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
                                          'horarioconsulta',
                                          'listaalumnos',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'seguimientosactivos'
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
                            'actions' => ['index',
                                          'horario',
                                          'listaalumnos',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion',
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'seguimientosactivos'
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
                            'actions' => ['index',
                                          'horarioconsulta',
                                          'listaalumnos',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion', 
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'seguimientosactivos'
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

    #region public function __construct()
    public function __construct($id, $module, $config = [],
                                profesorSeguimientoRepository $profesorSeguimientoRepository,
                                cicloRepository $cicloRepository,
                                ProfesorRepository $profesorRepository
                                )
    {
        parent::__construct($id, $module, $config);
        $this->profesorSeguimientoRepository = $profesorSeguimientoRepository;
        $this->cicloRepository = $cicloRepository;
        $this->profesorRepository = $profesorRepository;
    }
    #endregion

    #region public function actionIndex()
    public function actionIndex()
    {
        $form = new CicloSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $idciclo = $this->cicloRepository->maxId();

        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
        $profesores = \MyGlobalFunctions::dropDownList($this->profesorRepository->listaRegistros(['apaterno' => SORT_ASC, 'amaterno' => SORT_ASC, 'nombre_profesor' => SORT_ASC]), 'idprofesor', ['apaterno', 'amaterno', 'nombre_profesor']);

        $model = $this->profesorSeguimientoRepository->querySeguimientos((int)$idciclo);

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);

                $model = $this->profesorSeguimientoRepository->querySeguimientos((int)$idciclo);//Se ejecuta consulta de todos los registgros
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->profesorSeguimientoRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        $sql = $this->cicloRepository->consultaDatosCiclo((int)$idciclo);
        $ciclo_actual = $sql['desc_ciclo'];

        $total_profesores = $this->profesorRepository->totalProfesores();
        $total_seguimiento1 = $this->profesorSeguimientoRepository->countSeguimientoCicloBandera((int)$idciclo, 1, 1);
        $total_seguimiento2 = $this->profesorSeguimientoRepository->countSeguimientoCicloBandera((int)$idciclo, 2, 1);
        $total_seguimiento3 = $this->profesorSeguimientoRepository->countSeguimientoCicloBandera((int)$idciclo, 3, 1);
        $total_seguimiento4 = $this->profesorSeguimientoRepository->countSeguimientoCicloBandera((int)$idciclo, 4, 1);
        $total_seguimiento5 = $this->profesorSeguimientoRepository->countSeguimientoCicloBandera((int)$idciclo, 5, 1);

        $ts1 = ($total_seguimiento1 == $total_profesores) ? 1 : 0;
        $ts2 = ($total_seguimiento2 == $total_profesores) ? 1 : 0;
        $ts3 = ($total_seguimiento3 == $total_profesores) ? 1 : 0;
        $ts4 = ($total_seguimiento4 == $total_profesores) ? 1 : 0;
        $regular = ($total_seguimiento5 == $total_profesores) ? 1 : 0;

        return $this->render('seguimientos', compact('model', 'form', 'msg', 'error', 'pages', 'ts1', 'ts2', 'ts3','ts4', 'regular', 'profesores', 'ciclos', 'ciclo_actual'));
    }
    #endregion

    #region public function actionAsignarseguimiento()
    public function actionAsignarseguimiento()
    {
        $idprofesor = (Html::encode(isset($_GET['idprofesor']))) ? Html::encode($_GET['idprofesor']) : null;
        $idciclo = (Html::encode(isset($_GET['idciclo']))) ? Html::encode($_GET['idciclo']) : null;
        $bandera = (Html::encode(isset($_GET['bandera']))) ? Html::encode($_GET['bandera']) : null;
        $seguimiento = (Html::encode(isset($_GET['seguimiento']))) ? Html::encode($_GET['seguimiento']) : null;

        if($bandera != '' && $idprofesor != '' && $seguimiento != '' && $idciclo != '')
        {
            $total_registro = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento);

            if ($total_registro == 0)
            {
                $model = [
                    'idciclo' => $idciclo,
                    'idprofesor' => $idprofesor,
                    'seguimiento' => $seguimiento,
                    'bandera' => $bandera              
                ];

                $this->profesorSeguimientoRepository->store($model);
            }
            else
            {
                $total_registro = $this->profesorSeguimientoRepository->oneSeguimientoCicloProfesor((int)$idciclo, (int)$idprofesor, (int)$seguimiento);
                $idseguimiento = $total_registro->idseguimiento;

                $model = [
                    'bandera' => $bandera
                ];

                $this->profesorSeguimientoRepository->update($model, $idseguimiento);
            }
        }
    }
    #endregion

    #region public function actionAsignarseguimientos()
    public function actionAsignarseguimientos()
    {
        $idciclo = (Html::encode(isset($_GET['idciclo']))) ? Html::encode($_GET['idciclo']) : null;
        $bandera = (Html::encode(isset($_GET['bandera']))) ? Html::encode($_GET['bandera']) : null;
        $seguimiento = (Html::encode(isset($_GET['seguimiento']))) ? Html::encode($_GET['seguimiento']) : null;

        if($bandera != '' && $seguimiento != '' && $idciclo != '')
        {
            $table = $this->profesorRepository->registrosProfesores();

            foreach($table as $row)
            {
                $idprofesor = $row['idprofesor'];

                $total_registro = $this->profesorSeguimientoRepository->countSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento);

                if($total_registro == 0)
                {
                    $table = new ProfesorSeguimiento;
                    $table->idciclo = $idciclo;
                    $table->idprofesor = $idprofesor;
                    $table->seguimiento = $seguimiento;
                    $table->bandera = $bandera; 
                    $table->insert();
                }
                else
                {
                    $total_registro = $this->profesorSeguimientoRepository->oneSeguimientoCicloProfesor($idciclo, $idprofesor, $seguimiento);
                    $idseguimiento = $total_registro->idseguimiento;

                    $model = ['bandera' => $bandera];

                    $this->profesorSeguimientoRepository->update($model, $idseguimiento);
                }
            }
        }
    }
    #endregion

    #region public function actionSeguimientosactivos()
    public function actionSeguimientosactivos()
    {
        $curp = Yii::$app->user->identity->curp;
        $idciclo = $this->cicloRepository->maxId();

        $model = $this->profesorRepository->profesorSeguimiento($idciclo, $curp);

        return $model;
    }
    #endregion
}