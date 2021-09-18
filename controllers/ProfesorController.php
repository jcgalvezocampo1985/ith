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

use app\models\Profesor;
use app\models\ProfesorForm;
use app\models\ProfesorSearch;
use app\models\User;
use app\models\Ciclo;
use app\models\CicloSearch;
use app\models\CicloProfesorSearch;
use app\models\GrupoEstudiante;

class ProfesorController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'update', 'delete', 'horario', 'listaalumnos', 'horarioconsulta'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 'create', 'update', 'delete', 'horario', 'listaalumnos', 'horarioconsulta'],//Especificar que acciones tiene permitidas este usuario
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
                            'actions' => ['index', 'horario', 'listaalumnos'],//Especificar que acciones tiene permitidas este usuario
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
        if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1))
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
        exit;
        $form = new ProfesorSearch;
        $search = null;
        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->q);
                $table = Profesor::find()
                                 ->where(["like", "curp", $search])
                                 ->orWhere(["like", "nombre_profesor", $search])
                                 ->orWhere(["like", "apaterno", $search])
                                 ->orWhere(["like", "amaterno", $search])
                                 ->orWhere(["like", "cve_estatus", $search]);
                $status = 1;
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

        return $this->render("index", ['model' => $model, 'form' => $form, 'status' => $status, "pages" => $pages]);
    }

    public function actionCreate()
    {
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
                $table = new Profesor();
                $table->curp = $model->curp;
                $table->nombre_profesor = $model->nombre_profesor;
                $table->apaterno = $model->apaterno;
                $table->amaterno = $model->amaterno;
                $table->fecha_registro = $model->fecha_registro;
                $table->fecha_actualizacion = $model->fecha_actualizacion;

                if($table->insert())
                {
                    $model->curp = "";
                    $model->nombre_profesor = "";
                    $model->apaterno = "";
                    $model->amaterno = "";
                    $model->fecha_registro = "";
                    $model->fecha_actualizacion = "";

                    $msg = "Profesor agregado";
                }
                else
                {
                    $msg = "Ocurrió un error al intentar agregar el nuevo profesor, intenta nuevamente";
                }
            }
            else
            {
                $model->getErrors();
            }
        }

        return $this->render("form", ["model" => $model, "msg" => $msg]);
    }

    public function actionUpdate()
    {
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

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Html::encode($_POST["idestudiante"]);

            if(Profesor::deleteAll("idestudiante=:idestudiante", [":idestudiante" => $id]))
            {
                echo "Registro eliminado, redireccionando...";
                echo "<meta http-equiv='refresh' content='2; ".Url::toRoute("estudiante/index")."'>";
            }
            else
            {
                echo "Error al eliminar el registro, redireccionando...";
                echo "<meta http-equiv='refresh' content='2; ".Url::toRoute("estudiante/index")."'>";
            }
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }

    public function actionHorario()
    {
        $form = new CicloSearch;
        $idciclo = Ciclo::find()->max("idciclo");
        $ciclo = Ciclo::find()->where(["idciclo" => $idciclo])->one();
        $curp = Html::encode(Yii::$app->user->identity->curp);
        $sql_profesor = Profesor::find()->where(["curp" => $curp])->One();
        $idprofesor = $sql_profesor->idprofesor;

        $ciclos = ArrayHelper::map(Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all(), 'idciclo', 'desc_ciclo');
 
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
                              ->bindValue(':idprofesor', $idprofesor)
                              ->bindValue(':idciclo', $idciclo)
                              ->queryAll();

        $ciclo_actual = ($idciclo) ? (count($model) > 0) ? $model[0]['desc_ciclo'] : $ciclo['desc_ciclo'] : $ciclo->desc_ciclo;

        return $this->render("horario", ['model' => $model, 'form' => $form, 'ciclos' => $ciclos, 'idciclo' => $idciclo, 'ciclo_actual' => $ciclo_actual]);
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

        return $this->render("horarioconsulta", ["model" => $model, "form" => $form, "ciclos" => $ciclos, "idciclo" => $idciclo, "ciclo_actual" => $ciclo, "idprofesor" => $idprofesor,"profesores" => $profesores]);
    }

    public function actionListaalumnoscalificacion($idgrupo, $idciclo, $idprofesor)
    {
        if(isset($idgrupo))
        {
            $idgrupo = Html::encode($idgrupo);
            $idprofesor = Html::encode($idprofesor);
            $idciclo = (Html::encode($idciclo) == "") ? Ciclo::find()->max("idciclo") : Html::encode($idciclo);

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
	                            "grupos_estudiantes.s1",
	                            "grupos_estudiantes.s2",
	                            "grupos_estudiantes.s3",
	                            "grupos_estudiantes.s4",
	                            "grupos_estudiantes.s5",
	                            "grupos_estudiantes.s6",
	                            "grupos_estudiantes.s7",
	                            "grupos_estudiantes.s8",
	                            "grupos_estudiantes.s9",
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
                                    "grupos.desc_grupo"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["cat_materias"], "cat_materias.idmateria = grupos.idmateria")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->andFilterWhere(["grupos.idciclo" => $idciclo])
                            ->all();

            return $this->render("listaAlumnosCalificacion", ["model" => $model, "model1" => $model1, "idciclo" => $idciclo, "idgrupo" => $idgrupo, "idprofesor" => $idprofesor]);
        }
    }

    public function actionGuardarcalificacion()
    {
        if(Yii::$app->request->post())
        {
            $idgrupo = Html::encode($_POST["idgrupo"]);
            $idciclo = Html::encode($_POST["idciclo"]);
            $idprofesor = Html::encode($_POST["idprofesor"]);

            $total = count($_POST["p1"]);

            for($i = 0; $i < $total; $i++)
            {
                $idestudiante = Html::encode($_POST["idestudiante"][$i]);

                $p1 = Html::encode($_POST["p1"][$i]);
                $p1 = ($p1 < 0) ? 0 : $p1;
                $p2 = Html::encode($_POST["p2"][$i]);
                $p2 = ($p2 < 0) ? 0 : $p2;
                $p3 = Html::encode($_POST["p3"][$i]);
                $p3 = ($p3 < 0) ? 0 : $p3;
                $p4 = Html::encode($_POST["p4"][$i]);
                $p4 = ($p4 < 0) ? 0 : $p4;
                $p5 = Html::encode($_POST["p5"][$i]);
                $p5 = ($p5 < 0) ? 0 : $p5;
                $p6 = Html::encode($_POST["p6"][$i]);
                $p6 = ($p6 < 0) ? 0 : $p6;
                $p7 = Html::encode($_POST["p7"][$i]);
                $p7 = ($p7 < 0) ? 0 : $p7;
                $p8 = Html::encode($_POST["p8"][$i]);
                $p8 = ($p8 < 0) ? 0 : $p8;
                $p9 = Html::encode($_POST["p9"][$i]);
                $p9 = ($p9 < 0) ? 0 : $p9;

                $s1 = Html::encode($_POST["s1"][$i]);
                $s1 = ($s1 < 0) ? 0 : $s1;
                $s2 = Html::encode($_POST["s2"][$i]);
                $s2 = ($s2 < 0) ? 0 : $s2;
                $s3 = Html::encode($_POST["s3"][$i]);
                $s3 = ($s3 < 0) ? 0 : $s3;
                $s4 = Html::encode($_POST["s4"][$i]);
                $s4 = ($s4 < 0) ? 0 : $s4;
                $s5 = Html::encode($_POST["s5"][$i]);
                $s5 = ($s5 < 0) ? 0 : $s5;
                $s6 = Html::encode($_POST["s6"][$i]);
                $s6 = ($s6 < 0) ? 0 : $s6;
                $s7 = Html::encode($_POST["s7"][$i]);
                $s7 = ($s7 < 0) ? 0 : $s7;
                $s8 = Html::encode($_POST["s8"][$i]);
                $s8 = ($s8 < 0) ? 0 : $s8;
                $s9 = Html::encode($_POST["s9"][$i]);
                $s9 = ($s9 < 0) ? 0 : $s9;

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
                    $table->s1 = $s1;
                    $table->s2 = $s2;
                    $table->s3 = $s3;
                    $table->s4 = $s4;
                    $table->s5 = $s5;
                    $table->s6 = $s6;
                    $table->s7 = $s7;
                    $table->s8 = $s8;
                    $table->s9 = $s9;
                    $table->fecha_actualizacion = date("Y-m-d h:i:s");
                    $table->update();
                }    
            }
            header("Location: ".Url::toRoute("/profesor/listaalumnoscalificacion?idgrupo=$idgrupo&idciclo=$idciclo&idprofesor=$idprofesor"));
            exit;
        }
    }
}