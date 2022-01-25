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
use yii\data\Pagination;

use app\models\User;
use app\models\login\Usuario;
use app\models\login\UsuarioFormCRUD;
use app\models\login\UsuarioSearch;

class UsuarioController extends Controller
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
        $form = new UsuarioSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $table = new \yii\db\Query();
        $model = $table->from(["usuarios"])
                       ->select(["idusuario",
                                 "nombre_usuario",
	                             "email", 
	                             "cve_estatus", 
                                 "activate",
                                 "curp",
	                             "fecha_registro", 
	                             "fecha_actualizacion"
                        ])
                       ->orderBy(["nombre_usuario" => SORT_ASC]);

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->idusuario);
                $model = $table->where(["like", "idusuario", $search])
                               ->orWhere(["like", "nombre_usuario", $search])
                               ->orWhere(["like", "email", $search])
                               ->orWhere(["like", "cve_estatus", $search])
                               ->orWhere(["like", "activate", $search])
                               ->orWhere(["like", "curp", $search])
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
                    "pageSize" => 10,
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
        $model = new UsuarioFormCRUD();
        $clave_estatus = ["VIG" => "VIG"];

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->desc_ciclo = $modelo["desc_ciclo"];
            $model->semestre = $modelo["semestre"];
            $model->anio = $modelo["anio"];
            $model->cve_estatus = $modelo["cve_estatus"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error, "clave_estatus" => $clave_estatus]);
    }

    public function actionStore()
    {
        $model = new UsuarioFormCRUD;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                $table = new Usuario();
                $table->nombre_usuario = $model->curp;
                $table->email = $model->email;
                $table->password = $model->curp;
                $table->cve_estatus = $model->cve_estatus;
                $table->activate = 1;
                $table->curp = $model->curp;
                $table->fecha_registro = $model->fecha_registro;
                $table->fecha_actualizacion = "";

                if ($table->insert())
                {
                    $msg = "Usuario agregado";
                    $error = 1;
                }
                else
                {
                    $msg = "Ocurrió un error al intentar agregar el usuairo, intenta nuevamente";
                    $error = 3;
                }

                $modelo = [
                    "email" => $model->desc_ciclo,
                    "curp" => $model->semestre,
                    "fecha_registro" => $model->anio,
                    "cve_estatus" => $model->cve_estatus
                ];

                return $this->redirect(["usuario/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["usuario/index"]);
        }
    }

    public function actionEdit($id, $msg = "", $error = "")
    {/*
        $idciclo = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new CicloForm;

            if($idciclo)
            {
                $table = Ciclo::findOne($idciclo);

                if($table)
                {
                    $model->idciclo = $table->idciclo;
                    $model->desc_ciclo = $table->desc_ciclo;
                    $model->semestre = $table->semestre;
                    $model->anio = $table->anio;
                    $model->cve_estatus = $table->cve_estatus;
                }
                else
                {
                    return $this->redirect(["ciclo/index"]);
                }
            }
            else
            {
                return $this->redirect(["ciclo/index"]);
            }
        }
        else
        {
            return $this->redirect(["ciclo/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error]);*/
    }

    public function actionUpdate()
    {/*
        $model = new CicloForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idciclo = $model->idciclo;

            if($model->validate())
            {
                $table = Ciclo::findOne($idciclo);

                if ($table)
                {
                    $table->desc_ciclo = $model->desc_ciclo;
                    $table->semestre = $model->semestre;
                    $table->anio = $model->anio;
                    $table->fecha_actualizacion = date("Y-m-d h:i:s");
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
                    $msg = "Registro no encontrado";
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(["ciclo/edit", "id" => $idciclo, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["ciclo/index"]);
        }*/
    }

    public function actionDelete()
    {/*
        if(Yii::$app->request->post())
        {
            $idciclo = Html::encode($_POST["idciclo"]);

            $total_relacion = Grupo::find()
                                    ->where(["idciclo" => $idciclo])
                                    ->count();
            if($total_relacion == 0)
            {
                if(Ciclo::deleteAll("idciclo=:idciclo", [":idciclo" => $idciclo]))
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
            header("Location: ".Url::toRoute("/ciclo/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["ciclo/index"]);
        }*/
    }
}