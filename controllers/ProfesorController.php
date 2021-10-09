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
use Carbon\Carbon;

use app\models\Profesor;
use app\models\ProfesorForm;
use app\models\ProfesorSearch;
use app\models\User;
use app\models\Ciclo;
use app\models\CicloSearch;
use app\models\CicloProfesorSearch;
use app\models\Grupo;
use app\models\login\Usuario;
use app\models\RolUsuario;

class ProfesorController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'update', 'delete', 'horario', 'listaalumnos', 'horarioconsulta', 'listaalumnoscalificacion', 'guardarcalificacion'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 'create', 'update', 'delete', 'horario', 'listaalumnos', 'horarioconsulta', 'listaalumnoscalificacion', 'guardarcalificacion'],//Especificar que acciones tiene permitidas este usuario
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
                            'actions' => ['index', 'horarioconsulta', 'listaalumnos'],//Especificar que acciones tiene permitidas este usuario
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
                            'actions' => ['index', 'horario', 'listaalumnos', 'listaalumnoscalificacion', 'guardarcalificacion'],//Especificar que acciones tiene permitidas este usuario
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
                            'actions' => ['index', 'horarioconsulta', 'listaalumnos', 'listaalumnoscalificacion', 'guardarcalificacion'],//Especificar que acciones tiene permitidas este usuario
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
        /*if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1))
        {
            return $this->redirect(["horarioconsulta"]);
        }
        else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2))
        {
            return $this->redirect(["horarioconsulta"]);
        }
        else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3))
        {
            return $this->redirect(["horario"]);
        } 
        else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4))
        {
            return $this->redirect(["horarioconsulta"]);
        }
        exit;*/
        $form = new ProfesorSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;
        $ciclos = Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all();
        $idciclo = Ciclo::find()->max("idciclo");

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
                $table = Profesor::find()
                                 ->where(["like", "curp", $search])
                                 ->orWhere(["like", "nombre_profesor", $search])
                                 ->orWhere(["like", "apaterno", $search])
                                 ->orWhere(["like", "amaterno", $search])
                                 ->orWhere(["like", "cve_estatus", $search]);
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $table = Profesor::find();
                 
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

        return $this->render("index", ["model" => $model, "form" => $form, "msg" => $msg, "error" => $error, "pages" => $pages, "ciclos" => $ciclos, "ultimo_ciclo" => $idciclo]);
    }

    public function actionCreate($msg = "", $error = "")
    {
        $model = new ProfesorForm;

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->idprofesor = $modelo["idprofesor"];
            $model->curp = $modelo["curp"];
            $model->nombre_profesor = $modelo["nombre_profesor"];
            $model->apaterno = $modelo["apaterno"];
            $model->amaterno = $modelo["amaterno"];
            $model->fecha_registro = $modelo["fecha_registro"];
            $model->fecha_actualizacion = $modelo["fecha_actualizacion"];
            $model->cve_estatus = $modelo["cve_estatus"];
        }

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "error" => $error]);
    }

    public function actionStore()
    {
        $model = new ProfesorForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $idprofesor = $model->idprofesor;
            $existe_profesor = Profesor::find()->where(["idprofesor" => $idprofesor])->count();

            if ($model->validate())
            {
                if ($existe_profesor == 0)
                {
                    $table = new Profesor();
                    $table->curp = $model->curp;
                    $table->nombre_profesor = $model->nombre_profesor;
                    $table->apaterno = $model->apaterno;
                    $table->amaterno = $model->amaterno;
                    $table->fecha_registro = Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                    $table->fecha_actualizacion = Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
                    $table->cve_estatus = $model->cve_estatus;

                    if ($table->insert())
                    {
                        $idusuario = Usuario::find()->max("idusuario") + 1;
                        $table1 = new Usuario();
                        $table1->idusuario = $idusuario;
                        $table1->nombre_usuario = $model->curp;
                        $table1->email = $model->email;
                        $table1->activate = 1;
                        $table1->curp = $model->curp;
                        $table1->fecha_registro = Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                        $table1->fecha_actualizacion = Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
                        $table1->password = crypt($model->password, Yii::$app->params['salt']);
                        $table1->insert();

                        $table2 = new RolUsuario();
                        $table2->idusuario = $idusuario;
                        $table2->idrol = 3;

                        $msg = "Profesor agregado";
                        $error = 1;
                    }
                    else
                    {
                        $msg = "Ocurrió un error al intentar agregar el profesor, intenta nuevamente";
                        $error = 3;
                    }
                }
                else
                {
                    $msg = "Usuario ya existe";
                    $error = 3;
                }

                $modelo = [
                    "idprofesor" => $model->idprofesor,
                    "curp" => $model->curp,
                    "nombre_profesor" => $model->nombre_profesor,
                    "apaterno" => $model->apaterno,
                    "amaterno" => $model->amaterno,
                    "fecha_registro" => $model->fecha_registro,
                    "fecha_actualizacion" => $model->fecha_actualizacion,
                    "cve_estatus" => $model->cve_estatus
                ];

                return $this->redirect(["profesor/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["profesor/index"]);
        }
    }

    public function actionEdit($idprofesor, $msg = "", $error = "")
    {
        $idestudiante = Html::encode($idprofesor);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new ProfesorForm;

            if($idprofesor)
            {
                $table = Profesor::findOne($idprofesor);

                if($table)
                {
                    $model->idprofesor = $table->idprofesor;
                    $model->curp = $table->curp;
                    $model->nombre_profesor = $table->nombre_profesor;
                    $model->apaterno = $table->apaterno;
                    $model->amaterno = $table->amaterno;
                    $model->fecha_registro = Carbon::parse(strtotime($table->fecha_registro))->format('Y-m-d');
                    $model->fecha_actualizacion = Carbon::parse(strtotime($table->fecha_actualizacion))->format('Y-m-d');
                    $model->cve_estatus = $table->cve_estatus;
                }
                else
                {
                    return $this->redirect(["profesor/index"]);
                }
            }
            else
            {
                return $this->redirect(["profesor/index"]);
            }
        }
        else
        {
            return $this->redirect(["profesor/index"]);
        }

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "error" => $error]);

        $model = new ProfesorForm;
        $msg = false;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = Profesor::findOne($model->idestudiante);

                if($table)
                {
                    $table->curp = $model->curp;
                    $table->nombre_profesor = $model->nombre_profesor;
                    $table->apaterno = $model->apaterno;
                    $table->amaterno = $model->amaterno;
                    $table->fecha_registro = $model->fecha_registro;
                    $table->fecha_actualizacion = $model->fecha_actualizacion;
                    $table->cve_estatus = $model->cve_estatus;

                    if($table->update())
                    {
                        $status = true;
                        $msg = "Registro actualizado";
                    }
                    else
                    {
                        $msg = "No detectaron cambios en el registro";
                    }
                }
                else
                {
                    $msg = "Profesor no encontrado";
                }
            }
            else
            {
                return $this->getErrors();
            }
        }

        if(Yii::$app->request->get("idprofesor"))
        {
            $id = Html::encode($_GET["idprofesor"]);
            if($id)
            {
                $table = Profesor::findOne($id);

                if($table)
                {
                    $model->curp = $table->curp;
                    $model->nombre_profesor = $table->nombre_profesor;
                    $model->apaterno = $table->apaterno;
                    $model->amaterno = $table->amaterno;
                    $model->fecha_registro = $table->fecha_registro;
                    $model->fecha_actualizacion = $table->fecha_actualizacion;
                    $model->cve_estatus = $table->cve_estatus;
                }
                else
                {
                    return $this->redirect(["profesor/index"]);
                }
            }
            else
            {
                return $this->redirect(["profesor/index"]);
            }
        }
        else
        {
            return $this->redirect(["profesor/index"]);
        }

        return $this->render("form", ["model" => $model,  "msg" => $msg]);
    }

    public function actionUpdate()
    {
        $model = new ProfesorForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            $idprofesor = $model->idprofesor;
            $msg = false;

            if($model->validate())
            {
                $table = Profesor::findOne($idprofesor);

                if($table)
                {
                    $table->curp = $model->curp;
                    $table->nombre_profesor = $model->nombre_profesor;
                    $table->apaterno = $model->apaterno;
                    $table->amaterno = $model->amaterno;
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
                    $msg = "Profesor no encontrado";
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(["profesor/edit", "idprofesor" => $idprofesor, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["profesor/index"]);
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idprofesor = Html::encode($_POST["idprofesor"]);

            $total_relacion = Grupo::find()
                                    ->where(["idprofesor" => $idprofesor])
                                    ->count();

            if($total_relacion == 0)
            {
                if(Profesor::deleteAll("idprofesor=:idprofesor", [":idprofesor" => $idprofesor]))
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
            header("Location: ".Url::toRoute("/profesor/index?msg=$msg&error=$error"));
            exit;
        }
        else
        {
            return $this->redirect(["profesor/index"]);
        }
    }

    public function actionHorario()
    {
        $form = new CicloSearch;
        $idciclo = Ciclo::find()->max("idciclo");
        $ultimo_ciclo = $idciclo;
        $ciclo = Ciclo::find()->where(["idciclo" => $idciclo])->one();

        $curp = Html::encode(Yii::$app->user->identity->curp);
        $sql_profesor = Profesor::find()->where(["curp" => $curp])->One();
        $idprofesor = $sql_profesor->idprofesor;

        $ciclos = ArrayHelper::map(Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all(), "idciclo", "desc_ciclo");
 
        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
            }
            else
            {
                $form->getErrors();
            }
        }

        $sql = "SELECT
                    *
                FROM
                    horario_profesor_v
                WHERE
                    idprofesor = :idprofesor
                AND
	                idciclo = :idciclo
                ORDER BY
                    lunes, viernes, sabado";
        $model = Yii::$app->db->createCommand($sql)
                              ->bindValue(":idprofesor", $idprofesor)
                              ->bindValue(":idciclo", $idciclo)
                              ->queryAll();

        $ciclo_actual = ($idciclo) ? ((count($model) > 0) ? $model[0]["desc_ciclo"] : $ciclo["desc_ciclo"]) : $ciclo->desc_ciclo;

        return $this->render("horario", ["model" => $model, "form" => $form, "ciclos" => $ciclos, "idciclo" => $idciclo, "idprofesor" => $idprofesor, "ciclo_actual" => $ciclo_actual, "ultimo_ciclo" => $ultimo_ciclo]);
    }

    public function actionListaalumnos()
    {
        $this->layout = 'main1';//Cambio de layout

        if(Yii::$app->request->get("idgrupo"))
        {

            $idgrupo = Html::encode($_GET["idgrupo"]);
            $idciclo = (Html::encode($_GET["idciclo"]) == "") ? Ciclo::find()->max("idciclo") : Html::encode($_GET["idciclo"]);

            $model = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
	                            "estudiantes.sexo",
	                            "cat_opcion_curso.desc_opcion_curso"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

            $model1 = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                    "cat_materias.desc_materia",
    	                            "cat_carreras.desc_carrera"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["cat_materias"], "cat_materias.idmateria = grupos.idmateria")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->andFilterWhere(["grupos.idciclo" => $idciclo])
                            ->all();

            return $this->render("listaAlumnos", ["model" => $model, "model1" => $model1, "idciclo" => $idciclo, "idgrupo" => $idgrupo]);
        }
    }

    public function actionHorarioconsulta()
    {
        $form = new CicloProfesorSearch;
        $ciclo = null;
        $idciclo = null;
        $idprofesor = null;
        $profesores = ArrayHelper::map(Profesor::find()->orderBy(["apaterno" => SORT_ASC, "amaterno" => SORT_ASC, "nombre_profesor" => SORT_ASC])->asArray()->all(),'idprofesor', function($model){
            return $model['apaterno']." ".$model['amaterno']." ".$model['nombre_profesor'];
        });
        $ciclos = ArrayHelper::map(Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all(), 'idciclo', 'desc_ciclo');

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
                $idprofesor = Html::encode($form->idprofesor);

                $sql = Ciclo::find()->where(["idciclo" => $idciclo])->one();
                $ciclo = $sql['desc_ciclo'];

                $sql = "SELECT
                            *
                        FROM
                            horario_profesor_v
                        WHERE
                            idprofesor = :idprofesor
                        AND
                            idciclo = :idciclo
                        ORDER BY
                            lunes, viernes, sabado";
                $model = Yii::$app->db->createCommand($sql)
                                      ->bindValue(':idprofesor', $idprofesor)
                                      ->bindValue(':idciclo', $idciclo)
                                      ->queryAll();
            }
            else
            {
                $form->getErrors();
            }
        }
        else if(Yii::$app->request->get())
        {
            $idciclo = Html::encode($_GET["idciclo"]);
            $idprofesor = Html::encode($_GET["idprofesor"]);

            $sql = Ciclo::find()->where(["idciclo" => $idciclo])->one();
            $ciclo = $sql['desc_ciclo'];

                $sql = "SELECT
                            *
                        FROM
                            horario_profesor_v
                        WHERE
                            idprofesor = :idprofesor
                        AND
                            idciclo = :idciclo
                        ORDER BY
                            lunes, viernes, sabado";
                $model = Yii::$app->db->createCommand($sql)
                                      ->bindValue(':idprofesor', $idprofesor)
                                      ->bindValue(':idciclo', $idciclo)
                                      ->queryAll();
        }
        else
        {
            $sql = "SELECT
                        *
                    FROM
                        horario_profesor_v
                    WHERE
                        idprofesor = null
                    ORDER BY
                        lunes, viernes, sabado";
            $model = Yii::$app->db->createCommand($sql)
                                  ->queryAll();
        }

        $ultimo_ciclo = Ciclo::find()->max("idciclo");

        return $this->render("horarioconsulta", ["model" => $model, "form" => $form, "ciclos" => $ciclos, "idciclo" => $idciclo, "ciclo_actual" => $ciclo, "idprofesor" => $idprofesor, "profesores" => $profesores, "ultimo_ciclo" => $ultimo_ciclo]);
    }

    public function actionListaalumnoscalificacion($idgrupo, $idciclo, $idprofesor, $ultimo_ciclo)
    {
        if(isset($idgrupo))
        {
            $idgrupo = Html::encode($idgrupo);
            $idprofesor = Html::encode($idprofesor);
            $idciclo = (Html::encode($idciclo) == "") ? Ciclo::find()->max("idciclo") : Html::encode($idciclo);
            $ultimo_ciclo = Html::encode($ultimo_ciclo);

            $model = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
	                            "estudiantes.sexo",
	                            "cat_opcion_curso.desc_opcion_curso",
                                "grupos_estudiantes.p1",
	                            "grupos_estudiantes.p2",
	                            "grupos_estudiantes.p3",
	                            "grupos_estudiantes.p4",
	                            "grupos_estudiantes.p5",
	                            "grupos_estudiantes.p6",
	                            "grupos_estudiantes.p7",
	                            "grupos_estudiantes.p8",
	                            "grupos_estudiantes.p9",
                                "grupos_estudiantes.p10",
                                "grupos_estudiantes.p11",
                                "grupos_estudiantes.p12",
                                "grupos_estudiantes.p13",
                                "grupos_estudiantes.p14",
                                "grupos_estudiantes.p15",
                                "grupos_estudiantes.p16",
	                            "grupos_estudiantes.s1",
	                            "grupos_estudiantes.s2",
	                            "grupos_estudiantes.s3",
	                            "grupos_estudiantes.s4",
	                            "grupos_estudiantes.s5",
	                            "grupos_estudiantes.s6",
	                            "grupos_estudiantes.s7",
	                            "grupos_estudiantes.s8",
	                            "grupos_estudiantes.s9",
                                "grupos_estudiantes.s10",
                                "grupos_estudiantes.s11",
                                "grupos_estudiantes.s12",
                                "grupos_estudiantes.s13",
                                "grupos_estudiantes.s14",
                                "grupos_estudiantes.s15",
                                "grupos_estudiantes.s16"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

            $model1 = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                    "cat_materias.desc_materia",
    	                            "cat_carreras.desc_carrera",
                                    "grupos.num_semestre",
                                    "grupos.desc_grupo",
                                    "CONCAT( profesores.apaterno,' ',profesores.amaterno,' ',profesores.nombre_profesor) AS profesor"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["cat_materias"], "cat_materias.idmateria = grupos.idmateria")
                            ->innerJoin(["profesores"], "profesores.idprofesor = grupos.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->andFilterWhere(["grupos.idciclo" => $idciclo])
                            ->all();

            return $this->render("listaAlumnosCalificacion", ["model" => $model, "model1" => $model1, "idciclo" => $idciclo, "idgrupo" => $idgrupo, "idprofesor" => $idprofesor, "ultimo_ciclo" => $ultimo_ciclo]);
        }
    }

    public function actionGuardarcalificacion()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST["idgrupo"]);
            $idciclo = Html::encode($_POST["idciclo"]);
            $idprofesor = Html::encode($_POST["idprofesor"]);
            $r = Html::encode($_POST["r"]);
            $ultimo_ciclo = Ciclo::find()->max("idciclo");

            $total = count($_POST["p1"]);

            for($i = 0; $i < $total; $i++)
            {
                $idestudiante = Html::encode($_POST["idestudiante"][$i]);

                $p1 = Html::encode($_POST["p1"][$i]);
                $p2 = Html::encode($_POST["p2"][$i]);
                $p3 = Html::encode($_POST["p3"][$i]);
                $p4 = Html::encode($_POST["p4"][$i]);
                $p5 = Html::encode($_POST["p5"][$i]);
                $p6 = Html::encode($_POST["p6"][$i]);
                $p7 = Html::encode($_POST["p7"][$i]);
                $p8 = Html::encode($_POST["p8"][$i]);
                $p9 = Html::encode($_POST["p9"][$i]);
                $p10 = Html::encode($_POST["p10"][$i]);
                $p11 = Html::encode($_POST["p11"][$i]);
                $p12 = Html::encode($_POST["p12"][$i]);
                $p13 = Html::encode($_POST["p13"][$i]);
                $p14 = Html::encode($_POST["p14"][$i]);
                $p15 = Html::encode($_POST["p15"][$i]);
                $p16 = Html::encode($_POST["p16"][$i]);

                /*$s1 = Html::encode($_POST["s1"][$i]);
                $s2 = Html::encode($_POST["s2"][$i]);
                $s3 = Html::encode($_POST["s3"][$i]);
                $s4 = Html::encode($_POST["s4"][$i]);
                $s5 = Html::encode($_POST["s5"][$i]);
                $s6 = Html::encode($_POST["s6"][$i]);
                $s7 = Html::encode($_POST["s7"][$i]);
                $s8 = Html::encode($_POST["s8"][$i]);
                $s9 = Html::encode($_POST["s9"][$i]);*/

                $table = GrupoEstudiante::findOne(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante]);

                if($table)
                {
                    $table->p1 = $p1;
                    $table->p2 = $p2;
                    $table->p3 = $p3;
                    $table->p4 = $p4;
                    $table->p5 = $p5;
                    $table->p6 = $p6;
                    $table->p7 = $p7;
                    $table->p8 = $p8;
                    $table->p9 = $p9;
                    $table->p10 = $p10;
                    $table->p11 = $p11;
                    $table->p12 = $p12;
                    $table->p13 = $p13;
                    $table->p14 = $p14;
                    $table->p15 = $p15;
                    $table->p16 = $p16;
                    /*$table->s1 = $s1;
                    $table->s2 = $s2;
                    $table->s3 = $s3;
                    $table->s4 = $s4;
                    $table->s5 = $s5;
                    $table->s6 = $s6;
                    $table->s7 = $s7;
                    $table->s8 = $s8;
                    $table->s9 = $s9;*/
                    $table->fecha_actualizacion = date("Y-m-d h:i:s");
                    $table->update();
                }    
            }

            header("Location: ".Url::toRoute("/profesor/listaalumnoscalificacion?idgrupo=$idgrupo&idciclo=$idciclo&idprofesor=$idprofesor&ultimo_ciclo=$ultimo_ciclo&r=$r"));
            exit;
        }
    }

    public function actionHorarioprofesor()
    {
        $this->layout = 'main2';

        $idciclo = Ciclo::find()->max("idciclo");
        $idprofesor = Html::encode($_GET["idprofesor"]);
        $ciclos = Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all();

        $sql = "SELECT
                    *
                FROM
                    horario_profesor_v
                WHERE
                    idprofesor = :idprofesor
                AND
	                idciclo = :idciclo
                ORDER BY
                    lunes, viernes, sabado";
        $model = Yii::$app->db->createCommand($sql)
                              ->bindValue(":idprofesor", $idprofesor)
                              ->bindValue(":idciclo", $idciclo)
                              ->queryAll();

        return $this->render("horario_profesor", ["model" => $model, "ciclos" => $ciclos, "idciclo" => $idciclo, "idprofesor" => $idprofesor]);
    }

    public function actionHorarioprofesorconsulta()
    {
        $this->layout = 'main2';

        $idciclo = Html::encode($_GET["idciclo"]);
        $idprofesor = Html::encode($_GET["idprofesor"]);

        $sql = "SELECT
                    *
                FROM
                    horario_profesor_v
                WHERE
                    idprofesor = :idprofesor
                AND
	                idciclo = :idciclo
                ORDER BY
                    lunes, viernes, sabado";
        $model = Yii::$app->db->createCommand($sql)
                              ->bindValue(":idprofesor", $idprofesor)
                              ->bindValue(":idciclo", $idciclo)
                              ->queryAll();

        return $this->render("horario_profesor", ["model" => $model, "idciclo" => $idciclo]);
    }

    public function actionConsultarprofesor()
    {
        $idprofesor = Html::encode($_GET["idprofesor"]);
        $profesor = Profesor::find()->where(["idprofesor" => $idprofesor])->one();

        echo $profesor->apaterno." ".$profesor->amaterno." ".$profesor->nombre_profesor;
    }
}