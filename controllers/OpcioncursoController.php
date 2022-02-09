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
use app\models\grupoestudiante\GrupoEstudiante;
use app\models\opcioncurso\OpcionCurso;
use app\models\opcioncurso\OpcionCursoForm;
use app\models\opcioncurso\OpcionCursoSearch;

class OpcioncursoController extends Controller
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
        $form = new OpcionCursoSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $table = new \yii\db\Query();
        $model = $table->from(["cat_opcion_curso"])
                       ->select(["idopcion_curso",
                                 "desc_opcion_curso",
                                 "desc_opcion_curso_corto"])
                       ->orderBy("desc_opcion_curso");

        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $search = Html::encode($form->buscar);
                $model = $table->where(["like", "desc_opcion_curso", $search])
                               ->orWhere(["like", "desc_opcion_curso_corto", $search]);
            } else {
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

        if (count($model) == 0) {
            $error = 2;
            $msg = "No se encontró información relacionada con el criterio de búsqueda";
        }

        return $this->render("index", ["model" => $model, "form" => $form, "msg" => $msg, "error" => $error, "pages" => $pages]);
    }
    #endregion

    #region public function actionCreate($msg = "", $error = "")
    public function actionCreate($msg = "", $error = "")
    {
        $model = new OpcionCursoForm();

        if (Yii::$app->request->get() && $error != 1) {
            $modelo = $_GET["modelo"];
            $model->desc_opcion_curso = $modelo["desc_opcion_curso"];
            $model->desc_opcion_curso_corto = $modelo["desc_opcion_curso_corto"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error]);
    }
    #endregion

    #region public function actionStore()
    public function actionStore()
    {
        $model = new OpcionCursoForm;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new OpcionCurso();
                $table->desc_opcion_curso = $model->desc_opcion_curso;
                $table->desc_opcion_curso_corto = $model->desc_opcion_curso_corto;

                if ($table->insert()) {
                    $msg = "Opción Curso agregada";
                    $error = 1;
                } else {
                    $msg = "Ocurrió un error al intentar agregar la Opción Curso, intenta nuevamente";
                    $error = 3;
                }

                $modelo = [
                    "desc_opcion_curso" => $model->desc_opcion_curso,
                    "desc_opcion_curso_corto" => $model->desc_opcion_curso_corto
                ];

                return $this->redirect(["opcioncurso/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            } else {
                $model->getErrors();
            }
        } else {
            return $this->redirect(["opcioncurso/index"]);
        }
    }
    #endregion

    #region public function actionEdit($id, $msg = "", $error = "")
    public function actionEdit($id, $msg = "", $error = "")
    {
        $idopcion_curso = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if (Yii::$app->request->get()) {
            $model = new OpcionCursoForm;

            if ($idopcion_curso) {
                $table = OpcionCurso::findOne($idopcion_curso);

                if ($table) {
                    $model->idopcion_curso = $table->idopcion_curso;
                    $model->desc_opcion_curso = $table->desc_opcion_curso;
                    $model->desc_opcion_curso_corto = $table->desc_opcion_curso_corto;
                } else {
                    return $this->redirect(["opcioncurso/index"]);
                }
            } else {
                return $this->redirect(["opcioncurso/index"]);
            }
        } else {
            return $this->redirect(["opcioncurso/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error]);
    }
    #endregion

    #region public function actionUpdate()
    public function actionUpdate()
    {
        $model = new OpcionCursoForm;

        if ($model->load(Yii::$app->request->post())) {
            $idopcion_curso = $model->idopcion_curso;

            if ($model->validate()) {
                $table = OpcionCurso::findOne($idopcion_curso);

                if ($table) {
                    $table->desc_opcion_curso = $model->desc_opcion_curso;
                    $table->desc_opcion_curso_corto = $model->desc_opcion_curso_corto;

                    if ($table->update()) {
                        $msg = "Registro actualizado";
                    } else {
                        $msg = "No detectaron cambios en el registro";
                    }
                    $error = 1;
                } else {
                    $msg = "Registro no encontrado";
                    $error = 2;
                }
            } else {
                return $this->getErrors();
            }
            return $this->redirect(["opcioncurso/edit", "id" => $idopcion_curso, "msg" => $msg, "error" => $error]);
        } else {
            return $this->redirect(["opcioncurso/index"]);
        }
    }
    #endregion

    #region public function actionDelete()
    public function actionDelete()
    {
        if (Yii::$app->request->post()) {
            $idopcion_curso = Html::encode($_POST["idopcion_curso"]);

            $total_relacion = GrupoEstudiante::find()
                                            ->where(["idopcion_curso" => $idopcion_curso])
                                            ->count();

            if ($total_relacion == 0) {
                if (OpcionCurso::deleteAll("idopcion_curso=:idopcion_curso", [":idopcion_curso" => $idopcion_curso])) {
                    $error = 1;
                    $msg = "Registro eliminado";
                } else {
                    $error = 3;
                    $msg = "Error al eliminar el registro";
                }
            } else {
                $error = 3;
                $msg = "El registro no puede ser eliminado, debido a que contiene información relacionada";
            }
            header("Location: ".Url::toRoute("/opcioncurso/index?msg=$msg&error=$error"));
            exit;
        } else {
            return $this->redirect(["opcioncurso/index"]);
        }
    }
    #endregion
}