<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\Pagination;

use app\models\User;
use app\models\grupo\Grupo;
use app\models\carrera\Carrera;
use app\models\carrera\CarreraForm;
use app\models\carrera\CarreraSearch;

class CarreraController extends Controller
{
    #region public function behaviors()
    public function behaviors()
    {
        return [
                "access" => [
                    "class" => AccessControl::className(),
                    "only" => ["index", "create", "store", "edit", "update", "delete"],//Especificar que acciones se van proteger
                    "rules" => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
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

    #region public function actionIndex()
    public function actionIndex()
    {
        $form = new CarreraSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $table = new \yii\db\Query();
        $model = $table->from(["cat_carreras"])
                       ->select(["idcarrera", 
	                             "cve_carrera", 
	                             "desc_carrera", 
	                             "no_semestres", 
	                             "plan_estudios"])
                       ->orderBy("desc_carrera");

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
                $model = $table->where(["like", "cve_carrera", $search])
                               ->orWhere(["like", "desc_carrera", $search])
                               ->orWhere(["like", "no_semestres", $search])
                               ->orWhere(["like", "plan_estudios", $search]);
            }
            else
            {
                $form->getErrors();
            }
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
    #endregion

    #region public function actionCreate($msg = "", $error = "")
    public function actionCreate($msg = "", $error = "")
    {
        $model = new CarreraForm();

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->cve_carrera = $modelo["cve_carrera"];
            $model->desc_carrera = $modelo["desc_carrera"];
            $model->no_semestres = $modelo["no_semestres"];
            $model->plan_estudios = $modelo["plan_estudios"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error]);
    }
    #endregion

    #region public function actionStore()
    public function actionStore()
    {
        $model = new CarreraForm;

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                $table = new Carrera();
                $table->cve_carrera = $model->cve_carrera;
                $table->desc_carrera = $model->desc_carrera;
                $table->no_semestres = $model->no_semestres;
                $table->plan_estudios = $model->plan_estudios;

                if ($table->insert())
                {
                    $msg = "Carrera agregada";
                    $error = 1;
                }
                else
                {
                    $msg = "Ocurrió un error al intentar agregar la carrera, intenta nuevamente";
                    $error = 3;
                }

                $modelo = [
                    "cve_carrera" => $model->cve_carrera,
                    "desc_carrera" => $model->desc_carrera,
                    "no_semestres" => $model->no_semestres,
                    "plan_estudios" => $model->plan_estudios
                ];

                return $this->redirect(["carrera/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
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

    #region public function actionEdit($id, $msg = "", $error = "")
    public function actionEdit($id, $msg = "", $error = "")
    {
        $idcarrera = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new CarreraForm;

            if($idcarrera)
            {
                $table = Carrera::findOne($idcarrera);

                if($table)
                {
                    $model->idcarrera = $table->idcarrera;
                    $model->cve_carrera = $table->cve_carrera;
                    $model->desc_carrera = $table->desc_carrera;
                    $model->no_semestres = $table->no_semestres;
                    $model->plan_estudios = $table->plan_estudios;
                }
                else
                {
                    return $this->redirect(["carrera/index"]);
                }
            }
            else
            {
                return $this->redirect(["carrera/index"]);
            }
        }
        else
        {
            return $this->redirect(["carrera/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error]);
    }
    #endregion

    #region public function actionUpdate()
    public function actionUpdate()
    {
        $model = new CarreraForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idcarrera = $model->idcarrera;

            if($model->validate())
            {
                $table = Carrera::findOne($idcarrera);

                if ($table)
                {
                    $table->cve_carrera = $model->cve_carrera;
                    $table->desc_carrera = $model->desc_carrera;
                    $table->no_semestres = $model->no_semestres;
                    $table->plan_estudios= $model->plan_estudios;

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
                    $msg = "Registro no encontrado";
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(["carrera/edit", "id" => $idcarrera, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["carrera/index"]);
        }
    }
    #endregion

    #region public function actionDelete()
    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idcarrera = Html::encode($_POST["idcarrera"]);

            $total_relacion = Grupo::find()
                                    ->where(["idcarrera" => $idcarrera])
                                    ->count();
            if($total_relacion == 0)
            {
                if(Carrera::deleteAll("idcarrera=:idcarrera", [":idcarrera" => $idcarrera]))
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
            header("Location: ".Url::toRoute("/carrera/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["carrera/index"]);
        }
    }
    #endregion
}