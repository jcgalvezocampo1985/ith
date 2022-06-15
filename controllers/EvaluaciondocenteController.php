<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

use app\models\ciclo\CicloEvaluacionDocenteSearch;
use app\models\User;
use app\repositories\CicloRepository;

class EvaluaciondocenteController extends Controller
{
    private $cicloRepository;

    #region public function behaviors()
    public function behaviors()
    {
        return [
                "access" => [
                    "class" => AccessControl::className(),
                    "only" => ["index"],//Especificar que acciones se van proteger
                    "rules" => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            "actions" => ["index"],//Especificar que acciones tiene permitidas este usuario
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
                            "actions" => ["index"],//Especificar que acciones tiene permitidas este usuario
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

    public function __construct($id, $module, $config = [], CicloRepository $cicloRepository)
    {
        parent::__construct($id, $module, $config);
        $this->cicloRepository = $cicloRepository;
    }

    public function actionIndex()
    {
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;
        $idciclo = null;
        $reporte = null;

        //Listado de reportes a imprimir
        $reporteLista = [
            ['id' => 'dalu', 'name' => '(DALU) Lista de estudiantes que evaluarán'],
            ['id' => 'dcat', 'name' => '(DCAT) Lista de docentes'],
            ['id' => 'ddep', 'name' => '(DDEP) Lista de departamentos'],
            ['id' => 'desp', 'name' => '(DESP) Lista de carreras'],
            ['id' => 'dgau', 'name' => '(DGAU) Lista de los grupos ofertados'],
            ['id' => 'dlis', 'name' => '(DLIS) Lista de estudiantes por grupos'],
            ['id' => 'dret', 'name' => '(DRET) Listado de materias que deben se evaluadas'],
        ];

        $form = new CicloEvaluacionDocenteSearch;
        $ciclos = \MyGlobalFunctions::dropDownList($this->cicloRepository->listaRegistros(['idciclo' => SORT_DESC]), 'idciclo', ['desc_ciclo']);
        $reportes = \MyGlobalFunctions::dropDownList($reporteLista, 'id', ['name']);

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
                $reporte = Html::encode($form->reporte);

                header("Location: ".Url::toRoute('/reporte/'.$reporte.'?idciclo='.$idciclo));
                exit;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render("index", compact('form', 'ciclos', 'idciclo', 'reporte', 'reportes', 'msg', 'error'));
    }
}