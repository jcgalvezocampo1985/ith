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

use app\models\carrera\Carrera;
use app\models\carrera\CarreraForm;
use app\models\carrera\CarreraSearch;

class CarreraController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'update', 'delete', 'horariomodificar', 'deletehorarioestudiante', 'horarioagregar', 'agregarmateria'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 'create', 'update', 'delete', 'horariomodificar', 'deletehorarioestudiante', 'horarioagregar', 'agregarmateria'],//Especificar que acciones tiene permitidas este usuario
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
                            //El administrador tiene permisos sobre las siguientes acciones
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
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
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
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['horariomodificar', 'deletehorarioestudiante', 'horarioagregar', 'agregarmateria'],//Especificar que acciones tiene permitidas este usuario
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

    public function actionIndex()
    {
        $form = new EstudianteSearch;
        $idestudiante = null;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
                $table = new \yii\db\Query();
                $model = $table->from(['a' => 'estudiantes'])
                               ->select(['a.idestudiante', 
	                                'a.nombre_estudiante', 
	                                'a.email', 
	                                'a.sexo', 
	                                'a.num_semestre', 
	                                'a.cve_estatus',
                                    'b.desc_carrera'])
                               ->innerJoin(['b' => 'cat_carreras'], '`b`.`idcarrera`=`a`.`idcarrera`')
                               ->where(["like", "a.idestudiante", $search])
                               ->orWhere(["like", "a.nombre_estudiante", $search])
                               ->orWhere(["like", "a.email", $search])
                               ->orderBy('a.idestudiante');
                
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $table = new \yii\db\Query();
            $model = $table->from(['a' => 'estudiantes'])
                       ->select(['a.idestudiante', 
	                        'a.nombre_estudiante', 
	                        'a.email', 
	                        'a.sexo', 
	                        'a.num_semestre', 
	                        'a.cve_estatus',
                            'b.desc_carrera'])
                       ->innerJoin(['b' => 'cat_carreras'], '`b`.`idcarrera`=`a`.`idcarrera`')
                       ->orderBy('a.idestudiante');                     
        }

        $count = clone $table;
        $pages = new Pagination([
                    "pageSize" => 20,
                    "totalCount" => $count->count(),
                ]);

        $model = $table->offset($pages->offset)
                       ->limit($pages->limit)
                       ->all();

        if(count($model) == 0){
            $error = 2;
            $msg = "No se encontró información relacionada con el criterio de búsqueda";
        }
        
        return $this->render("index", ["model" => $model, "form" => $form, "msg" => $msg, "error" => $error, "pages" => $pages]);
    }

    public function actionCreate($msg = "", $error = "")
    {
        $model = new EstudianteForm;
        $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
        $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
        $carrera = ArrayHelper::map(Carrera::find()->all(), 'idcarrera', 'desc_carrera');

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->idestudiante = $modelo["idestudiante"];
            $model->nombre_estudiante = $modelo["nombre_estudiante"];
            $model->email = $modelo["email"];
            $model->sexo = $modelo["sexo"];
            $model->idcarrera = $modelo["idcarrera"];
            $model->num_semestre = $modelo["num_semestre"];
            $model->fecha_registro = $modelo["fecha_registro"];
            $model->fecha_actualizacion = $modelo["fecha_actualizacion"];
            $model->cve_estatus = $modelo["cve_estatus"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error, "sexo" => $sexo, "num_semestre" => $num_semestre, "carrera" => $carrera]);
    }

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
            $existe_idestudiante = Estudiante::find()->where(["idestudiante" => $idestudiante])->count();
            $existe_email = Estudiante::find()->where(["email" => $email])->count();

            if ($model->validate())
            {
                if ($existe_idestudiante == 0)
                {
                    if ($existe_email == 0)
                    {
                        $table = new Estudiante();
                        $table->idestudiante = $model->idestudiante;
                        $table->nombre_estudiante = $model->nombre_estudiante;
                        $table->email = $model->email;
                        $table->sexo = $model->sexo;
                        $table->idcarrera = $model->idcarrera;
                        $table->num_semestre = $model->num_semestre;
                        $table->fecha_registro = Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                        $table->fecha_actualizacion = Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
                        $table->cve_estatus = $model->cve_estatus;

                        if ($table->insert())
                        {
                            $msg = "Estudiante agregado";
                            $error = 1;
                        }
                        else
                        {
                            $msg = "Ocurrió un error al intentar agregar el estudiante, intenta nuevamente";
                            $error = 3;
                        }
                    }
                    else
                    {
                        $msg = "Email ya existe";
                        $error = 3;
                    }
                }
                else
                {
                    $msg = "No. Control ya existe";
                    $error = 3;
                }

                $modelo = [
                    "idestudiante" => $model->idestudiante,
                    "nombre_estudiante" => $model->nombre_estudiante,
                    "email" => $model->email,
                    "sexo" => $model->sexo,
                    "idcarrera" => $model->idcarrera,
                    "num_semestre" => $model->num_semestre,
                    "fecha_registro" => $model->fecha_registro,
                    "fecha_actualizacion" => $model->fecha_actualizacion,
                    "cve_estatus" => $model->cve_estatus
                ];

                return $this->redirect(["estudiante/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }

    public function actionEdit($idestudiante, $msg = "", $error = "")
    {
        $idestudiante = Html::encode($idestudiante);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new EstudianteForm;
            $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
            $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
            $carrera = ArrayHelper::map(Carrera::find()->all(), 'idcarrera', 'desc_carrera');

            if($idestudiante)
            {
                $table = Estudiante::findOne($idestudiante);

                if($table)
                {
                    $model->idestudiante = $table->idestudiante;
                    $model->nombre_estudiante = $table->nombre_estudiante;
                    $model->email = $table->email;
                    $model->sexo = $table->sexo;
                    $model->idcarrera = $table->idcarrera;
                    $model->num_semestre = $table->num_semestre;
                    $model->fecha_registro = Carbon::parse(strtotime($table->fecha_registro))->format('Y-m-d');
                    $model->fecha_actualizacion = Carbon::parse(strtotime($table->fecha_actualizacion))->format('Y-m-d');
                    $model->cve_estatus = $table->cve_estatus;
                }
                else
                {
                    return $this->redirect(["estudiante/index"]);
                }
            }
            else
            {
                return $this->redirect(["estudiante/index"]);
            }
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error, "sexo" => $sexo, "num_semestre" => $num_semestre, "carrera" => $carrera]);
    }

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
            $idestudiante = $model->idestudiante;
            $msg = false;

            if($model->validate())
            {
                $table = Estudiante::findOne($idestudiante);

                if ($table) {
                    $table->nombre_estudiante = $model->nombre_estudiante;
                    $table->email = $model->email;
                    $table->sexo = $model->sexo;
                    $table->idcarrera = $model->idcarrera;
                    $table->num_semestre = $model->num_semestre;
                    $table->fecha_registro = Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                    $table->fecha_actualizacion = Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
                    $table->cve_estatus = $model->cve_estatus;

                    if($table->update())
                    {
                        $msg = "Registro actualizado";
                    }
                    else
                    {
                        $msg = "No detectaron cambios en el registro";
                    }
                    $error = 1;
                }
                else
                {
                    $msg = "Alumno no encontrado";
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(["estudiante/edit", "idestudiante" => $idestudiante, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idestudiante = Html::encode($_POST["idestudiante"]);

            $total_relacion = GrupoEstudiante::find()
                                            ->where(["idestudiante" => $idestudiante])
                                            ->count();
            if($total_relacion == 0)
            {
                if(Estudiante::deleteAll("idestudiante=:idestudiante", [":idestudiante" => $idestudiante]))
                {
                    $error = 1;
                    $msg = "Registro eliminado";
                }
                else
                {
                    $error = 3;
                    $msg = "Error al eliminar el registro";
                }
            }
            else
            {
                $error = 3;
                $msg = "El registro no puede ser eliminado, debido a que contiene información relacionada";
            }
            header("Location: ".Url::toRoute("/estudiante/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }
}