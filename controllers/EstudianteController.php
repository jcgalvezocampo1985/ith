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
use app\models\GrupoEstudiante;
use app\models\GrupoEstudianteForm;
use app\models\Carrera;
use app\models\Ciclo;
use app\models\Materia;
use app\models\OpcionCurso;
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
                          GROUP BY idciclo DESC
                          ORDER BY idciclo DESC";
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
                          GROUP BY idciclo
                          ORDER BY idciclo DESC";
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
        $idciclo_actual = Ciclo::find()->max("idciclo");
        $ciclos = ArrayHelper::map(Ciclo::find()->orderBy(['idciclo' => SORT_DESC])->all(), 'idciclo', 'desc_ciclo');
        $form = new EstudianteHorarioSearch;
        $msg = null;

        if ($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $idestudiante = Html::encode($form->idestudiante);
                $idciclo = Html::encode($form->idciclo);
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $idestudiante = (Html::encode(isset($_GET["idestudiante"]))) ? Html::encode($_GET["idestudiante"]) : "";
            $idciclo = (Html::encode(isset($_GET["idciclo"]))) ? Html::encode($_GET["idciclo"]) : "";
            $idgrupo = (Html::encode(isset($_GET["idgrupo"]))) ? Html::encode($_GET["idgrupo"]) : "";
            $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
            $status = (Html::encode(isset($_GET["status"]))) ? Html::encode($_GET["status"]) : 0;
        }

        $query = "SELECT
                    *
                  FROM
                    horario_estudiante_v
                  WHERE
                    idestudiante =:idestudiante
                  AND
                    idciclo = :idciclo
                  ORDER BY
                    lunes, viernes, sabado";
        $model = Yii::$app->db->createCommand($query)
                              ->bindValue(':idestudiante', $idestudiante)
                              ->bindValue(':idciclo', $idciclo)
                              ->queryAll();

        $table1 = new \yii\db\Query();
        $model1 = $table1->from(['grupos_estudiantes'])
                         ->select(['IF(COUNT(cat_materias.creditos) > 0, SUM(cat_materias.creditos), "") AS creditos'])
                         ->innerJoin(['grupos'], '`grupos_estudiantes`.`idgrupo`=`grupos`.`idgrupo`')
                         ->innerJoin(['cat_materias'], '`grupos`.`idmateria`=`cat_materias`.`idmateria`')
                         ->where(["grupos.idciclo" => $idciclo, "grupos_estudiantes.idestudiante" => $idestudiante])
                         ->all();
        $creditos = $model1[0]['creditos'];

        $table2 = new \yii\db\Query();
        $model2 = $table2->from(['cat_carreras'])
                         ->select(['cat_carreras.idcarrera','cat_carreras.desc_carrera'])
                         ->innerJoin(['estudiantes'], '`cat_carreras`.`idcarrera`=`estudiantes`.`idcarrera`')
                         ->where(["estudiantes.idestudiante" => $idestudiante])
                         ->all();
        $idcarrera = (count($model2) > 0) ? $model2[0]['idcarrera'] : "";
        $desc_carrera = (count($model2) > 0) ? $model2[0]['desc_carrera'] : "";

        if(count($model) <= 0 && $status == 1)
        {
            $msg = "No se encontraron registros relacionados con el No. Control ". $idestudiante;
        }

        return $this->render("horariomodificar", ["model" => $model, "form" => $form, "ciclos" => $ciclos, "idestudiante" => $idestudiante, "idciclo" => $idciclo, "idciclo_actual" => $idciclo_actual, "creditos" => $creditos, "idcarrera" => $idcarrera, "carrera" => $desc_carrera, "status" => $status, "msg" => $msg]);
    }

    public function actionDeletehorarioestudiante()
    {
        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($_GET["idestudiante"]);
            $idgrupo = Html::encode($_GET["idgrupo"]);
            $idciclo = Html::encode($_GET["idciclo"]);

            if(GrupoEstudiante::deleteAll(["idestudiante" => $idestudiante, "idgrupo" => $idgrupo]))
            {
                $msg = "Registro eliminado";
            }
            else
            {
                $msg = "Error al eliminar el registro";
            }

            header("Location: ".Url::toRoute("/estudiante/horariomodificar?idestudiante=$idestudiante&idgrupo=$idgrupo&idciclo=$idciclo&msg=$msg&status=2"));
            exit;
        }
    }

    public function actionHorarioagregar()
    {
        $this->layout = 'main2';//Cambio de layout

        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($_GET["idestudiante"]);
            $idciclo = Html::encode($_GET["idciclo"]);
            $idcarrera = Html::encode($_GET["idcarrera"]);

            $opcion_curso = OpcionCurso::find()->orderBy(['desc_opcion_curso' => SORT_ASC])->all();

            $query = "SELECT
	                    grupos.idgrupo,
	                    grupos.idmateria,
	                    cat_materias.desc_materia,
	                    cat_materias.creditos,
	                    grupos.num_semestre,
                        ciclo.desc_ciclo
                    FROM
    	                grupos
	                INNER JOIN cat_materias ON grupos.idmateria = cat_materias.idmateria
                    INNER JOIN ciclo ON grupos.idciclo = ciclo.idciclo 
                    WHERE
    	                grupos.idcarrera = :idcarrera
                    AND
                        grupos.idciclo = :idciclo
                    AND
                        grupos.idgrupo NOT IN ((
		                SELECT
			                idgrupo
		                FROM
			                horario_estudiante_v 
		                WHERE
			                idestudiante = :idestudiante AND idciclo = :idciclo 
		            ))
                    ORDER BY
	                    grupos.num_semestre DESC,
	                    cat_materias.desc_materia ASC";
            $materias = Yii::$app->db->createCommand($query)
                                     ->bindValue(':idestudiante', $idestudiante)
                                     ->bindValue(':idciclo', $idciclo)
                                     ->bindValue(':idcarrera', $idcarrera)
                                     ->queryAll();

            return $this->render("horarioagregar", ["materias" => $materias, "opcion_curso" => $opcion_curso, "idestudiante" => $idestudiante, "idciclo" => $idciclo, "idcarrera" => $idcarrera]);
        }
    }

    public function actionAgregarmateria()
    {
        if (Yii::$app->request->get())
        {
            $idgrupo = Html::encode($_GET["idgrupo"]);
            $idestudiante = Html::encode($_GET["idestudiante"]);
            $idopcion_curso = Html::encode($_GET["idopcion_curso"]);
            $idciclo = Html::encode($_GET["idciclo"]);

            $table = new GrupoEstudiante();
            $table->idgrupo = $idgrupo;
            $table->idestudiante = $idestudiante;
            $table->idopcion_curso = $idopcion_curso;
            $table->idciclo = $idciclo;
            $table->cve_estatus = "VIG";
            $table->idgrupoidestudiante = ($idgrupo.$idestudiante);

            if($table->insert())
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
        }
        else
        {
            $status = 0;
        }

        return $status;
    }
}