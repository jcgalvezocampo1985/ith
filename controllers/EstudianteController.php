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

use app\models\estudiante\Estudiante;
use app\models\estudiante\EstudianteForm;
use app\models\estudiante\EstudianteSearch;
use app\models\estudiante\EstudianteHorarioSearch;
use app\models\grupoestudiante\GrupoEstudiante;
use app\models\grupoestudiante\GrupoEstudianteSearch;
use app\models\carrera\Carrera;
use app\models\opcioncurso\OpcionCurso;
use app\models\ciclo\Ciclo;
use app\models\actacalificacion\ActaCalificacion;
use app\models\User;

class EstudianteController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index',
                               'create',
                               'update',
                               'delete',
                               'boletacalificacion',
                               'horarioalumnos',
                               'horariomodificar',
                               'deletehorarioestudiante',
                               'horarioagregar',
                               'agregarmateria',
                    ],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
                            ],//Especificar que acciones tiene permitidas este usuario
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
                            //Servicios escolares tiene permisos sobre las siguientes acciones
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
                            ],//Especificar que acciones tiene permitidas este usuario
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
                            //El profesor tiene permisos sobre las siguientes acciones
                            'actions' => [''],//Especificar que acciones tiene permitidas este usuario
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
                            //División de estudios tiene permisos sobre las siguientes acciones
                            'actions' => ['index',
                                          'create',
                                          'update',
                                          'delete',
                                          'boletacalificacion',
                                          'horarioalumnos',
                                          'horariomodificar',
                                          'deletehorarioestudiante',
                                          'horarioagregar',
                                          'agregarmateria'
                            ],//Especificar que acciones tiene permitidas este usuario
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
        $form = new EstudianteSearch;
        $idestudiante = null;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->buscar);
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
                               ->where(["like", "a.idestudiante", $search])
                               ->orWhere(["like", "a.nombre_estudiante", $search])
                               ->orWhere(["like", "a.email", $search])
                               ->orderBy('a.idestudiante');
                
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

        if(count($model) == 0){
            $error = 2;
            $msg = "No se encontró información relacionada con el criterio de búsqueda";
        }
        
        return $this->render("index", ["model" => $model, "form" => $form, "msg" => $msg, "error" => $error, "pages" => $pages]);
    }

    public function actionCreate($msg = "", $error = "")
    {
        $model = new EstudianteForm;
        $sexo = ["M" => "Masculino", "F" => "Femenino"];
        $num_semestre = ["1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10"];
        $clave_estatus = ["VIG" => "VIG"];
        $carrera = ArrayHelper::map(Carrera::find()->all(), "idcarrera", "desc_carrera");

        if(Yii::$app->request->get() && $error != 1)
        {
            $modelo = $_GET["modelo"];
            $model->idestudiante = $modelo["idestudiante"];
            $model->nombre_estudiante = $modelo["nombre_estudiante"];
            $model->email = $modelo["email"];
            $model->sexo = $modelo["sexo"];
            $model->idcarrera = $modelo["idcarrera"];
            $model->num_semestre = $modelo["num_semestre"];
            $model->fecha_registro = $modelo["fecha_registro"];
            $model->fecha_actualizacion = $modelo["fecha_actualizacion"];
            $model->cve_estatus = $modelo["cve_estatus"];
        }

        return $this->render("form", ["model" => $model,
                                      "status" => 0,
                                      "msg" => $msg,
                                      "error" => $error,
                                      "sexo" => $sexo,
                                      "num_semestre" => $num_semestre,
                                      "carrera" => $carrera,
                                      "clave_estatus" => $clave_estatus]);
    }

    public function actionStore()
    {
        $model = new EstudianteForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $idestudiante = $model->idestudiante;
            $email = $model->email;
            $existe_idestudiante = Estudiante::find()->where(["idestudiante" => $idestudiante])->count();
            $existe_email = Estudiante::find()->where(["email" => $email])->count();

            if ($model->validate())
            {
                if ($existe_idestudiante == 0)
                {
                    if ($existe_email == 0)
                    {
                        $table = new Estudiante();
                        $table->idestudiante = $model->idestudiante;
                        $table->nombre_estudiante = $model->nombre_estudiante;
                        $table->email = $model->email;
                        $table->sexo = $model->sexo;
                        $table->idcarrera = $model->idcarrera;
                        $table->num_semestre = $model->num_semestre;
                        $table->fecha_registro = $model->fecha_registro; //Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                        $table->fecha_actualizacion = "";//Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
                        $table->cve_estatus = $model->cve_estatus;

                        if ($table->insert())
                        {
                            $msg = "Estudiante agregado";
                            $error = 1;
                        }
                        else
                        {
                            $msg = "Ocurrió un error al intentar agregar el estudiante, intenta nuevamente";
                            $error = 3;
                        }
                    }
                    else
                    {
                        $msg = "Email ya existe";
                        $error = 3;
                    }
                }
                else
                {
                    $msg = "No. Control ya existe";
                    $error = 3;
                }

                $modelo = [
                    "idestudiante" => $model->idestudiante,
                    "nombre_estudiante" => $model->nombre_estudiante,
                    "email" => $model->email,
                    "sexo" => $model->sexo,
                    "idcarrera" => $model->idcarrera,
                    "num_semestre" => $model->num_semestre,
                    "fecha_registro" => $model->fecha_registro,
                    "fecha_actualizacion" => $model->fecha_actualizacion,
                    "cve_estatus" => $model->cve_estatus
                ];

                return $this->redirect(["estudiante/create", "msg" => $msg, "error" => $error, "modelo" => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }

    public function actionEdit($idestudiante, $msg = "", $error = "")
    {
        $idestudiante = Html::encode($idestudiante);
        $msg = Html::encode($msg);
        $error = Html::encode($error);

        if(Yii::$app->request->get())
        {
            $model = new EstudianteForm;
            $sexo = ['M' => 'Masculino', 'F' => 'Femenino'];
            $num_semestre = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
            $clave_estatus = ["VIG" => "VIG", "BAJA TEMPORAL" => "BAJA TEMPORAL", "BAJA DEFINITIVA" => "BAJA DEFINITIVA"];
            $carrera = ArrayHelper::map(Carrera::find()->all(), 'idcarrera', 'desc_carrera');

            if($idestudiante)
            {
                $table = Estudiante::findOne($idestudiante);

                if($table)
                {
                    $model->idestudiante = $table->idestudiante;
                    $model->nombre_estudiante = $table->nombre_estudiante;
                    $model->email = $table->email;
                    $model->sexo = $table->sexo;
                    $model->idcarrera = $table->idcarrera;
                    $model->num_semestre = $table->num_semestre;
                    $model->fecha_registro = Carbon::parse(strtotime($table->fecha_registro))->format('Y-m-d');
                    $model->fecha_actualizacion = Carbon::parse(strtotime($table->fecha_actualizacion))->format('Y-m-d');
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

        return $this->render("form", ["model" => $model,
                                      "status" => 1,
                                      "msg" => $msg,
                                      "error" => $error,
                                      "sexo" => $sexo,
                                      "num_semestre" => $num_semestre,
                                      "carrera" => $carrera,
                                      "clave_estatus" => $clave_estatus
                                    ]);
    }

    public function actionUpdate()
    {
        $model = new EstudianteForm;

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()))
        {
            $idestudiante = $model->idestudiante;
            $msg = false;

            if($model->validate())
            {
                $table = Estudiante::findOne($idestudiante);

                if ($table) {
                    $table->nombre_estudiante = $model->nombre_estudiante;
                    $table->email = $model->email;
                    $table->sexo = $model->sexo;
                    $table->idcarrera = $model->idcarrera;
                    $table->num_semestre = $model->num_semestre;
                    //$table->fecha_registro = "";//Carbon::parse(strtotime($model->fecha_registro))->format('Y-m-d');
                    $table->fecha_actualizacion = $model->fecha_actualizacion; //Carbon::parse(strtotime($model->fecha_actualizacion))->format('Y-m-d');
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
                    $msg = "Alumno no encontrado";
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(["estudiante/edit", "idestudiante" => $idestudiante, "msg" => $msg, "error" => $error]);
        }
        else
        {
            return $this->redirect(["estudiante/index"]);
        }
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idestudiante = Html::encode($_POST["idestudiante"]);

            $total_relacion = GrupoEstudiante::find()
                                            ->where(["idestudiante" => $idestudiante])
                                            ->count();
            if($total_relacion == 0)
            {
                if(Estudiante::deleteAll("idestudiante=:idestudiante", [":idestudiante" => $idestudiante]))
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
            header("Location: ".Url::toRoute("/estudiante/index?msg=$msg&error=$error"));
            exit;
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

    public function actionBoletacalificacion()
    {
        $this->layout = 'main2';
        $idestudiante = Html::encode($_GET["idestudiante"]);

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
        return $this->render("boleta_calificacion", ["model" => $model]);
    }

    public function actionHorarioalumnos()
    {
        $this->layout = 'main2';
        $idestudiante = Html::encode($_GET["idestudiante"]);

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
        return $this->render("horario_alumno", ["model" => $model]);
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
                         ->innerJoin(['grupos'], 'grupos_estudiantes.idgrupo=grupos.idgrupo')
                         ->innerJoin(['cat_materias'], 'grupos.idmateria=cat_materias.idmateria')
                         ->where(["grupos.idciclo" => $idciclo, "grupos_estudiantes.idestudiante" => $idestudiante])
                         ->all();

        $table2 = new \yii\db\Query();
        $model2 = $table2->from(['cat_carreras'])
                         ->select(['cat_carreras.idcarrera','cat_carreras.desc_carrera', 'estudiantes.nombre_estudiante'])
                         ->innerJoin(['estudiantes'], 'cat_carreras.idcarrera=estudiantes.idcarrera')
                         ->where(["estudiantes.idestudiante" => $idestudiante])
                         ->all();
 
        $creditos = $model1[0]['creditos'];
        $idcarrera = (count($model2) > 0) ? $model2[0]['idcarrera'] : "";
        $desc_carrera = (count($model2) > 0) ? $model2[0]['desc_carrera'] : "";
        $estudiante = (count($model2) > 0) ? $model2[0]['nombre_estudiante'] : "";

        if(count($model) <= 0 && $status == 1)
        {
            $msg = "No se encontraron registros relacionados con el No. Control ". $idestudiante;
        }

        return $this->render("horariomodificar", ["model" => $model, 
                                                  "form" => $form, 
                                                  "ciclos" => $ciclos, 
                                                  "idestudiante" => $idestudiante, 
                                                  "estudiante" => $estudiante, 
                                                  "idciclo" => $idciclo, 
                                                  "idciclo_actual" => $idciclo_actual, 
                                                  "creditos" => $creditos, 
                                                  "idcarrera" => $idcarrera, 
                                                  "carrera" => $desc_carrera, 
                                                  "status" => $status, 
                                                  "msg" => $msg]);
    }

    public function actionDeletehorarioestudiante()
    {
        if(Yii::$app->request->get())
        {
            $idestudiante = Html::encode($_GET["idestudiante"]);
            $idgrupo = Html::encode($_GET["idgrupo"]);
            $idciclo = Html::encode($_GET["idciclo"]);

            $acta_calificacion = ActaCalificacion::find()
                                                 ->where(["idestudiante" => $idestudiante, "idgrupo" => $idgrupo])
                                                 ->count();

            if($acta_calificacion == 0)
            {
                if(GrupoEstudiante::deleteAll(["idestudiante" => $idestudiante, "idgrupo" => $idgrupo]))
                {
                    $msg = "Registro eliminado";
                }
                else
                {
                    $msg = "Error al eliminar el registro";
                }
            }
            else
            {
                $msg = "El registro no puede ser eliminado, debido a que tiene información relacionada";
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

            $table = new \yii\db\Query();
            $materias = $table->from(["grupos"])
                              ->select([
                                    "grupos.idgrupo",
	                                "grupos.idmateria",
        	                        "cat_materias.desc_materia",
	                                "cat_materias.creditos",
	                                "grupos.num_semestre",
                                    "ciclo.desc_ciclo",
                                    "grupos.desc_grupo"
                                ])
                                ->orderBy(["grupos.num_semestre" => SORT_DESC, "cat_materias.desc_materia" => SORT_ASC])
                                ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                                ->innerJoin(["ciclo"], "grupos.idciclo = ciclo.idciclo")
                                ->where(["grupos.idcarrera" => $idcarrera])
                                ->andFilterWhere(["grupos.idciclo" => $idciclo])
                                ->andFilterWhere(["NOT IN", "grupos.idgrupo", (new \yii\db\Query())
                                                                                    ->select('idgrupo')
                                                                                    ->from('horario_estudiante_v')
                                                                                    ->where(["idestudiante" => $idestudiante, "idciclo" => $idciclo])]);

            if(Html::encode(isset($_GET["desc_materia"])))
            {
                $desc_materia = Html::encode($_GET["desc_materia"]);
                $materias = $table->andFilterWhere(["LIKE", "cat_materias.desc_materia", $desc_materia]);
            }

            $materias = $table->all();

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