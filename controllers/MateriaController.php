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
use app\models\materia\Materia;
use app\models\materia\MateriaForm;
use app\models\materia\MateriaSearch;

class MateriaController extends Controller
{
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
                            //Servicios escolaes tiene permisos sobre las siguientes acciones
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

    public function actionIndex()
    {
        $form = new MateriaSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $table = new \yii\db\Query();
        $model = $table->from(["cat_materias"])
                       ->select(["idmateria", 
	                             "cve_materia", 
	                             "desc_materia", 
	                             "creditos",
                                 "fecha_registro",
                                 "fecha_actualizacion",
                                 "cve_estatus"])
                       ->orderBy("desc_materia");   

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
                $model = $table->where(["like", "cve_materia", $search])
                               ->orWhere(["like", "desc_materia", $search])
                               ->orWhere(["like", "creditos", $search])
                               ->orWhere(["like", "fecha_registro", $search])
                               ->orWhere(["like", "fecha_actualizacion", $search]);
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

    public function actionCreate($msg = "", $error = "")
    {
        $model = new MateriaForm();

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->cve_materia = $modelo["cve_materia"];
            $model->desc_materia = $modelo["desc_materia"];
            $model->creditos = $modelo["creditos"];
            $model->cve_estatus = $modelo["cve_estatus"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error]);
    }

    public function actionStore()
    {
        $model = new MateriaForm;

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                $table = new Materia();
                $table->cve_materia = $model->cve_materia;
                $table->desc_materia = $model->desc_materia;
                $table->creditos = $model->creditos;
                $table->cve_estatus = $model->cve_estatus;
                $table->fecha_registro = date("y-m-d h:i:s");

                if ($table->insert())
                {
                    $msg = "Materia agregada";
                    $error = 1;
                }
                else
                {
                    $msg = "Ocurrió un error al intentar agregar la materia, intenta nuevamente";
                    $error = 3;
                }

                $modelo = [
                    "cve_materia" => $model->cve_materia,
                    "desc_materia" => $model->desc_materia,
                    "creditos" => $model->creditos,
                    "cve_estatus" => $model->cve_estatus
                ];

                return $this->redirect(["materia/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["materia/index"]);
        }
    }

    public function actionEdit($id, $msg = "", $error = "")
    {
        $idmateria = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new MateriaForm;

            if($idmateria)
            {
                $table = Materia::findOne($idmateria);

                if($table)
                {
                    $model->idmateria = $table->idmateria;
                    $model->cve_materia = $table->cve_materia;
                    $model->desc_materia = $table->desc_materia;
                    $model->creditos = $table->creditos;
                    $model->cve_estatus = $table->cve_estatus;
                }
                else
                {
                    return $this->redirect(["materia/index"]);
                }
            }
            else
            {
                return $this->redirect(["materia/index"]);
            }
        }
        else
        {
            return $this->redirect(["materia/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error]);
    }

    public function actionUpdate()
    {
        $model = new MateriaForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idmateria = $model->idmateria;

            if($model->validate())
            {
                $table = Materia::findOne($idmateria);

                if ($table)
                {
                    $table->cve_materia = $model->cve_materia;
                    $table->desc_materia = $model->desc_materia;
                    $table->creditos = $model->creditos;
                    $table->cve_estatus= $model->cve_estatus;
                    $table->fecha_actualizacion= date("y-m-d h:i:s");

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
            return $this->redirect(["materia/edit", "id" => $idmateria, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["materia/index"]);
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idmateria = Html::encode($_POST["idmateria"]);

            $total_relacion = Grupo::find()
                                    ->where(["idmateria" => $idmateria])
                                    ->count();
            if($total_relacion == 0)
            {
                if(Materia::deleteAll("idmateria=:idmateria", [":idmateria" => $idmateria]))
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
            header("Location: ".Url::toRoute("/materia/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["materia/index"]);
        }
    }
}