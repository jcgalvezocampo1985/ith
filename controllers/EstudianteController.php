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

use app\models\Estudiante;
use app\models\EstudianteForm;
use app\models\EstudianteSearch;
use app\models\EstudianteHorarioSearch;
use app\models\Carrera;
use app\models\Ciclo;
use app\models\User;

class EstudianteController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'create', 'update', 'delete', 'horariomodificar'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 'create', 'update', 'delete', 'horario', 'boleta', 'horariomodificar'],//Especificar que acciones tiene permitidas este usuario
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
        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
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
                               ->where(["like", "a.idestudiante", $idestudiante])
                               ->orWhere(["like", "a.nombre_estudiante", $idestudiante])
                               ->orWhere(["like", "a.email", $idestudiante])
                               ->orderBy('a.idestudiante');  
                $status = 1;
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

        return $this->render("index", ["model" => $model, "form" => $form, "status" => $status, "pages" => $pages]);
    }

    public function actionCreate()
    {
        $model = new EstudianteForm;
        $msg = false;
        $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
        $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
        $carrera = ArrayHelper::map(Carrera::find()->all(), 'idcarrera', 'desc_carrera');

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Estudiante();
                $table->idestudiante = $model->idestudiante;
                $table->nombre_estudiante = $model->nombre_estudiante;
                $table->email = $model->email;
                $table->sexo = $model->sexo;
                $table->idcarrera = $model->idcarrera;
                $table->num_semestre = $model->num_semestre;
                $table->fecha_registro = $model->fecha_registro;
                $table->fecha_actualizacion = $model->fecha_actualizacion;
                $table->cve_estatus = $model->cve_estatus;

                if($table->insert())
                {
                    $model->idestudiante = "";
                    $model->nombre_estudiante = "";
                    $model->email = "";
                    $model->sexo = "";
                    $model->idcarrera = "";
                    $model->num_semestre = "";
                    $model->fecha_registro = "";
                    $model->fecha_actualizacion = "";
                    $model->cve_estatus = "";

                    $msg = "Estudiante agregado";
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

        return $this->render("form", ["model" => $model, "status" => 0, "msg" => $msg, "sexo" => $sexo, "num_semestre" => $num_semestre, "carrera" => $carrera]);
    }

    public function actionUpdate()
    {
        $model = new EstudianteForm;
        $msg = false;
        $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
        $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
        $carrera = ArrayHelper::map(Carrera::find()->all(), 'idcarrera', 'desc_carrera');

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = Estudiante::findOne($model->idestudiante);

                if($table)
                {
                    $table->nombre_estudiante = $model->nombre_estudiante;
                    $table->email = $model->email;
                    $table->sexo = $model->sexo;
                    $table->idcarrera = $model->idcarrera;
                    $table->num_semestre = $model->num_semestre;
                    $table->fecha_registro = $model->fecha_registro;
                    $table->fecha_actualizacion = $model->fecha_actualizacion;
                    $table->cve_estatus = $model->cve_estatus;

                    if($table->update())
                    {
                        $msg = "Registro actualizado";
                    }
                    else
                    {
                        $msg = "No detectaron cambios en el registro";
                    }
                }
                else
                {
                    $msg = "Alumno no encontrado";
                }
            }
            else
            {
                return $this->getErrors();
            }
        }

        if(Yii::$app->request->get("idestudiante"))
        {
            $id = Html::encode($_GET["idestudiante"]);
            if($id)
            {
                $table = Estudiante::findOne($id);

                if($table)
                {
                    $model->idestudiante = $table->idestudiante;
                    $model->nombre_estudiante = $table->nombre_estudiante;
                    $model->email = $table->email;
                    $model->sexo = $table->sexo;
                    $model->idcarrera = $table->idcarrera;
                    $model->num_semestre = $table->num_semestre;
                    $model->fecha_registro = $table->fecha_registro;
                    $model->fecha_actualizacion = $table->fecha_actualizacion;
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

        return $this->render("form", ["model" => $model, "status" => 1, "msg" => $msg, "sexo" => $sexo, "num_semestre" => $num_semestre, "carrera" => $carrera]);
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Html::encode($_POST["idestudiante"]);

            if(Estudiante::deleteAll("idestudiante=:idestudiante", [":idestudiante" => $id]))
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
        $table = new Estudiante;
        $model = $table->find()->where(["idestudiante" => 9999])->orderBy("nombre_estudiante")->all();

        $form = new EstudianteSearch;
        $idestudiante = null;

        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
                $query = "SELECT
                            *
                          FROM
                            boleta_estudiante_encabezado
                          WHERE
                            idestudiante = :idestudiante
                          GROUP BY idciclo";
                $model = Yii::$app->db->createCommand($query)
                                      ->bindValue(":idestudiante", $idestudiante)
                                      ->queryAll();

                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render("horario", ["model" => $model, "form" => $form, "status" => $status]);
    }

    public function actionBoleta()
    {
        $table = new Estudiante;
        $model = $table->find()->where(["idestudiante" => 99999])->orderBy("nombre_estudiante")->all();

        $form = new EstudianteSearch;
        $idestudiante = null;

        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->buscar);
                $query = "SELECT
                            *
                          FROM
                            boleta_estudiante_encabezado
                          WHERE
                            idestudiante = :idestudiante
                          GROUP BY idciclo";
                $model = Yii::$app->db->createCommand($query)
                                      ->bindValue(":idestudiante", $idestudiante)
                                      ->queryAll();

                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render("boleta", ["model" => $model, "form" => $form, "status" => $status]);
    }

    public function actionHorariomodificar()
    {
        $table = new Estudiante;
        $model = $table->find()->where(['idestudiante' => 9999])->orderBy('nombre_estudiante')->all();
        $ciclos = ArrayHelper::map(Ciclo::find()->all(), 'idciclo', 'desc_ciclo');

        $form = new EstudianteHorarioSearch;
        $idestudiante = null;

        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idestudiante = Html::encode($form->idestudiante);
                $idciclo = Html::encode($form->idciclo);

                $query = "SELECT
                            *
                         FROM
                            horario_estudiante_v
                         WHERE
                            idestudiante =:idestudiante
                         AND
                            idciclo = :idciclo";
                $model = Yii::$app->db->createCommand($query)
                                      ->bindValue(':idestudiante', $idestudiante)
                                      ->bindValue(':idciclo', $idciclo)
                                      ->queryAll();

                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render("horariomodificar", ["model" => $model, "form" => $form, "ciclos" => $ciclos, "status" => $status]);
    }
}