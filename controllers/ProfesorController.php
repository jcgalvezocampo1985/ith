<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;
use yii\widgets\ActiveForm;
use yii\filters\AccessController;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;

use app\models\Profesor;
use app\models\ProfesorForm;
use app\models\ProfesorSearch;
//use app\models\Alumno;
use app\models\User;
use app\models\Ciclo;
//use app\models\CicloForm;
use app\models\CicloSearch;

class ProfesorController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'update', 'delete', 'horario', 'listaalumnos'],//Especificar que acciones se van proteger
                    'rules' => [
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
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario,3);
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
        return $this->redirect(["horario"]);

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
        $idciclo = null;

        $curp = Html::encode(Yii::$app->user->identity->curp);
        $sql_profesor = Profesor::find()->where(["curp" => $curp])->One();
        $idprofesor = $sql_profesor->idprofesor;

        $ciclos = ArrayHelper::map(Ciclo::find()->all(), 'idciclo', 'desc_ciclo');
 
        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);

                $sql = "SELECT
                            *
                        FROM
                            horario_profesor_v
                        WHERE
                            idprofesor = :idprofesor
                        AND
                            idciclo = :idciclo";
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
        else
        {
            $sql = "SELECT
                        *
                    FROM
                        horario_profesor_v
                    WHERE
                        idprofesor = :idprofesor
                    AND
	                    idciclo = (SELECT MAX(idciclo) FROM ciclo)";
            $model = Yii::$app->db->createCommand($sql)
                                  ->bindValue(':idprofesor', $idprofesor)
                                  ->queryAll();         
        }

        return $this->render("horario", ['model' => $model, 'form' => $form, 'ciclos' => $ciclos, 'idciclo' => $idciclo]);
    }

    public function actionListaalumnos()
    {
        $this->layout = 'main1';//Cambio de layout

        if(Yii::$app->request->get("idgrupo"))
        {
            $idgrupo = Html::encode($_GET["idgrupo"]);

            $query = "SELECT
	                    estudiantes.idestudiante,
	                    estudiantes.nombre_estudiante,
	                    estudiantes.sexo,
	                    cat_opcion_curso.desc_opcion_curso
                      FROM
	                    estudiantes
	                  INNER JOIN grupos_estudiantes ON estudiantes.idestudiante = grupos_estudiantes.idestudiante
	                  INNER JOIN cat_opcion_curso ON grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso
                      WHERE
                        grupos_estudiantes.idgrupo=:idgrupo";
            $model = Yii::$app->db->createCommand($query)
                                  ->bindValue(':idgrupo', $idgrupo)
                                  ->queryAll();

            return $this->render("listaAlumnos", ["model" => $model, "idgrupo" => $idgrupo]);
        }
    }
}