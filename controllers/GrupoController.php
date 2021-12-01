<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

use app\models\User;
use app\models\ciclo\Ciclo;
use app\models\carrera\Carrera;
use app\models\materia\Materia;
use app\models\profesor\Profesor;
use app\models\grupo\Grupo;
use app\models\grupo\GrupoForm;
use app\models\grupo\GrupoSearch;
use app\models\grupoestudiante\GrupoEstudiante;

class GrupoController extends Controller
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
                            //El administrador tiene permisos sobre las siguientes acciones
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
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
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
                            //El administrador tiene permisos sobre las siguientes acciones
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
        $form = new GrupoSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        $table = new \yii\db\Query();
        $model = $table->from(["grupos"])
                       ->select(["grupos.idgrupo",
                                 "ciclo.desc_ciclo AS ciclo",
                                 "cat_carreras.desc_carrera AS carrera",
                                 "cat_materias.desc_materia AS materia",
                                 "CONCAT(profesores.apaterno,' ',profesores.amaterno,' ',profesores.nombre_profesor) AS profesor",
                                 "grupos.num_semestre",
                                 "grupos.desc_grupo_corto",
                                 "grupos.desc_grupo",
                                 "grupos.aula",
                                 "grupos.fecha_envio_acta",
                                 "grupos.horario",
                                 "grupos.lunes",
                                 "grupos.martes",
                                 "grupos.miercoles",
                                 "grupos.jueves",
                                 "grupos.viernes",
                                 "grupos.sabado"])
                       ->innerJoin(["ciclo"], "grupos.idciclo = ciclo.idciclo")
                       ->innerJoin(["cat_carreras"], "grupos.idcarrera = cat_carreras.idcarrera")
                       ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                       ->innerJoin(["profesores"], "grupos.idprofesor = profesores.idprofesor")
                       ->orderBy(["ciclo.idciclo" => SORT_DESC, "carrera" => SORT_ASC, "num_semestre" => SORT_DESC, "materia" => SORT_ASC]);

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
                $model = $table->where(["like", "ciclo.desc_ciclo", $search])
                               ->orWhere(["like", "cat_carreras.desc_carrera", $search])
                               ->orWhere(["like", "cat_materias.desc_materia", $search])
                               ->orWhere(["like", "profesores.apaterno", $search])
                               ->orWhere(["like", "profesores.amaterno", $search])
                               ->orWhere(["like", "profesores.nombre_profesor", $search])
                               ->orWhere(["like", "grupos.num_semestre", $search])
                               ->orWhere(["like", "grupos.desc_grupo_corto", $search])
                               ->orWhere(["like", "grupos.desc_grupo", $search])
                               ->orWhere(["like", "grupos.fecha_envio_acta", $search])
                               ->orWhere(["like", "grupos.horario", $search])
                               ->orWhere(["like", "grupos.lunes", $search])
                               ->orWhere(["like", "grupos.martes", $search])
                               ->orWhere(["like", "grupos.miercoles", $search])
                               ->orWhere(["like", "grupos.jueves", $search])
                               ->orWhere(["like", "grupos.viernes", $search])
                               ->orWhere(["like", "grupos.sabado", $search]);
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
        $model = new GrupoForm();
        $ciclos = ArrayHelper::map(Ciclo::find()->all(), "idciclo", "desc_ciclo");
        $carreras = ArrayHelper::map(Carrera::find()->all(), "idcarrera", "desc_carrera");
        $materias = ArrayHelper::map(Materia::find()->all(), "idmateria", "desc_materia");
        $profesores = ArrayHelper::map(Profesor::find()->orderBy(["apaterno" => SORT_ASC, "amaterno" => SORT_ASC, "nombre_profesor" => SORT_ASC])->asArray()->all(), "idprofesor", function($model){
            return $model["apaterno"]." ".$model["amaterno"]." ".$model["nombre_profesor"];
        });
        $idprofesor = null;
        $idciclo = null;
        $idcarrera = null;
        $idmateria = null;

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->idciclo = $modelo["idciclo"];
            $model->idcarrera = $modelo["idcarrera"];
            $model->idmateria = $modelo["idmateria"];
            $model->idprofesor = $modelo["idprofesor"];
            $model->num_semestre = $modelo["num_semestre"];
            $model->desc_grupo_corto = $modelo["desc_grupo_corto"];
            $model->desc_grupo = $modelo["desc_grupo"];
            $model->aula = $modelo["aula"];
            $model->horario = $modelo["horario"];
            $model->lunes = $modelo["lunes"];
            $model->martes = $modelo["martes"];
            $model->miercoles = $modelo["miercoles"];
            $model->jueves = $modelo["jueves"];
            $model->viernes = $modelo["viernes"];
            $model->sabado = $modelo["sabado"];
        }

        $data = ["model" => $model,
                "status" => 0,
                "msg" => $msg,
                "error" => $error,
                "ciclos" => $ciclos,
                "idprofesor" => $idprofesor,
                "idciclo" => $idciclo,
                "idcarrera" => $idcarrera,
                "idmateria" => $idmateria,
                "carreras" => $carreras,
                "materias" => $materias,
                "profesores" => $profesores];

        return $this->render("form", $data);
    }

    public function actionStore()
    {
        $model = new GrupoForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                $table = new Grupo();
                $table->idciclo = $model->idciclo;
                $table->idcarrera = $model->idcarrera;
                $table->idmateria = $model->idmateria;
                $table->idprofesor = $model->idprofesor;
                $table->num_semestre = $model->num_semestre;
                $table->desc_grupo_corto = $model->desc_grupo_corto;
                $table->desc_grupo = $model->desc_grupo;
                $table->aula = $model->aula;
                $table->horario = $model->horario;
                $table->lunes = $model->lunes;
                $table->martes = $model->martes;
                $table->miercoles = $model->miercoles;
                $table->jueves = $model->jueves;
                $table->viernes = $model->viernes;
                $table->sabado = $model->sabado;

                if ($table->insert())
                {
                    $msg = "Grupo agregado";
                    $error = 1;
                }
                else
                {
                    $msg = "Ocurrió un error al intentar agregar el grupo, intenta nuevamente";
                    $error = 3;
                }

                $modelo = [
                    "idciclo" => $model->idciclo,
                    "idcarrera" => $model->idcarrera,
                    "idmateria" => $model->idmateria,
                    "idprofesor" => $model->idprofesor,
                    "num_semestre" => $model->num_semestre,
                    "desc_grupo_corto" => $model->desc_grupo_corto,
                    "desc_grupo" => $model->desc_grupo,
                    "aula" => $model->aula,
                    "horario" => $model->horario,
                    "lunes" => $model->lunes,
                    "martes" => $model->martes,
                    "miercoles" => $model->miercoles,
                    "jueves" => $model->jueves,
                    "viernes" => $model->viernes,
                    "sabado" => $model->sabado
                ];

                return $this->redirect(["grupo/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
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

    public function actionEdit($id, $msg = "", $error = "")
    {
        $idgrupo = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        

        if(Yii::$app->request->get())
        {
            $model = new GrupoForm;
            $ciclos = ArrayHelper::map(Ciclo::find()->all(), "idciclo", "desc_ciclo");
            $carreras = ArrayHelper::map(Carrera::find()->all(), "idcarrera", "desc_carrera");
            $materias = ArrayHelper::map(Materia::find()->all(), "idmateria", "desc_materia");
            $profesores = ArrayHelper::map(Profesor::find()->orderBy(["apaterno" => SORT_ASC, "amaterno" => SORT_ASC, "nombre_profesor" => SORT_ASC])->asArray()->all(), "idprofesor", function($model){
                return $model["apaterno"]." ".$model["amaterno"]." ".$model["nombre_profesor"];
            });

            if($idgrupo)
            {
                $table = Grupo::findOne($idgrupo);

                if($table)
                {
                    $model->idgrupo = $table->idgrupo;
                    $model->idciclo = $table->idciclo;
                    $model->idcarrera = $table->idcarrera;
                    $model->idmateria = $table->idmateria;
                    $model->idprofesor = $table->idprofesor;
                    $model->num_semestre = $table->num_semestre;
                    $model->desc_grupo_corto = $table->desc_grupo_corto;
                    $model->desc_grupo = $table->desc_grupo;
                    $model->aula = $table->aula;
                    $model->horario = $table->horario;
                    $model->lunes = $table->lunes;
                    $model->martes = $table->martes;
                    $model->miercoles = $table->miercoles;
                    $model->jueves = $table->jueves;
                    $model->viernes = $table->viernes;
                    $model->sabado = $table->sabado;
                }
                else
                {
                    return $this->redirect(["grupo/index"]);
                }
            }
            else
            {
                return $this->redirect(["grupo/index"]);
            }
        }
        else
        {
            return $this->redirect(["grupo/index"]);
        }

        return $this->render("form", ["model" => $model,
                                      "status" => 1,
                                      "msg" => $msg,
                                      "error" => $error,
                                      "ciclos" => $ciclos,
                                      "carreras" => $carreras,
                                      "materias" => $materias,
                                      "profesores" => $profesores]);
    }

    public function actionUpdate()
    {
        $model = new GrupoForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idgrupo = $model->idgrupo;

            if($model->validate())
            {
                $table = Grupo::findOne($idgrupo);

                if ($table)
                {
                    $table->idciclo = $model->idciclo;
                    $table->idcarrera = $model->idcarrera;
                    $table->idmateria = $model->idmateria;
                    $table->idprofesor = $model->idprofesor;
                    $table->num_semestre = $model->num_semestre;
                    $table->desc_grupo_corto = $model->desc_grupo_corto;
                    $table->desc_grupo = $model->desc_grupo;
                    $table->aula = $model->aula;
                    $table->horario = $model->horario;
                    $table->lunes = $model->lunes;
                    $table->martes = $model->martes;
                    $table->miercoles = $model->miercoles;
                    $table->jueves = $model->jueves;
                    $table->viernes = $model->viernes;
                    $table->sabado = $model->sabado;

                    if($table->update())
                    {
                        $msg = "Registro actualizado";
                    }
                    else
                    {
                        $msg = "No se detectaron cambios en el registro";
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
            return $this->redirect(["grupo/edit", "id" => $idgrupo, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["grupo/index"]);
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST["idgrupo"]);

            $total_relacion = Grupo::find()
                                    ->where(["idgrupo" => $idgrupo])
                                    ->count();

            if($total_relacion == 0)
            {
                if(Grupo::deleteAll("idgrupo=:idgrupo", [":idgrupo" => $idgrupo]))
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
            header("Location: ".Url::toRoute("/grupo/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["grupo/index"]);
        }
    }

    public function actionGrupoalumnos()
    {
        return $this->render("grupo_alumnos", []);
    }
}