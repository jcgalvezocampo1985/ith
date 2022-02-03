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

use app\models\profesor\Profesor;
use app\models\profesor\ProfesorSearch;
use app\models\ciclo\CicloProfesorSearch;
use app\models\ciclo\Ciclo;
use app\models\ciclo\CicloSearch;
use app\models\profesorseguimiento\ProfesorSeguimiento;
use app\models\User;

class SeguimientoController extends Controller
{
    #region public function behaviors()
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 
                               'create',
                               'update',
                               'delete',
                               'horario',
                               'listaalumnos',
                               'horarioconsulta',
                               'listaalumnoscalificacion',
                               'guardarcalificacion',
                               'listaalumnoscalificacionregularizacion',
                               'guardarcalificacionregularizacion',
                               'horarioprofesor',
                               'horarioprofesorconsulta',
                               'consultarprofesor',
                               'seguimientos',
                               'asignarseguimiento',
                               'asignarseguimientos',
                               'seguimientosactivos'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['index', 
                                          'create',
                                          'update',
                                          'delete',
                                          'horario',
                                          'listaalumnos',
                                          'horarioconsulta',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion',
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'horarioprofesor',
                                          'horarioprofesorconsulta',
                                          'consultarprofesor',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'seguimientosactivos'],//Especificar que acciones tiene permitidas este usuario
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
                                          'horarioconsulta',
                                          'listaalumnos',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'seguimientosactivos'
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
                            'actions' => ['index',
                                          'horario',
                                          'listaalumnos',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion',
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'seguimientosactivos'
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
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                            },  
                        ],
                        [
                            //División de estudios tiene permisos sobre las siguientes acciones
                            'actions' => ['index',
                                          'horarioconsulta',
                                          'listaalumnos',
                                          'seguimientos',
                                          'asignarseguimiento',
                                          'asignarseguimientos',
                                          'listaalumnoscalificacion',
                                          'guardarcalificacion', 
                                          'listaalumnoscalificacionregularizacion',
                                          'guardarcalificacionregularizacion',
                                          'seguimientosactivos'
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
    #endregion

    #region public function actionIndex()
    public function actionIndex()
    {
        $form = new CicloSearch;
        $msg = (Html::encode(isset($_GET["msg"]))) ? Html::encode($_GET["msg"]) : null;
        $error = (Html::encode(isset($_GET["error"]))) ? Html::encode($_GET["error"]) : null;
        $idciclo = Ciclo::find()->max("idciclo");
        $profesores = ArrayHelper::map(Profesor::find()->orderBy(["apaterno" => SORT_ASC, "amaterno" => SORT_ASC, "nombre_profesor" => SORT_ASC])->asArray()->all(),'idprofesor', function($model){
            return $model['apaterno']." ".$model['amaterno']." ".$model['nombre_profesor'];
        });
        $ciclos = ArrayHelper::map(Ciclo::find()->orderBy(["idciclo" => SORT_DESC])->all(), 'idciclo', 'desc_ciclo');

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $idciclo = Html::encode($form->idciclo);
                $table = (new \yii\db\Query())
                            ->from(["profesores"])
                            ->select(["profesores.idprofesor",
                                       "profesores.nombre_profesor",
                                       "profesores.apaterno",
                                       "profesores.amaterno",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 1) AS seguimiento1",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 2) AS seguimiento2",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 3) AS seguimiento3",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 4) AS seguimiento4",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 5) AS seguimiento5"])
                            ->orderBy(["profesores.apaterno" => SORT_ASC, "profesores.amaterno" => SORT_ASC, "profesores.nombre_profesor" => SORT_ASC]);
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $table = (new \yii\db\Query())
                            ->from(["profesores"])
                            ->select(["profesores.idprofesor",
                                       "profesores.nombre_profesor",
                                       "profesores.apaterno",
                                       "profesores.amaterno",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 1) AS seguimiento1",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 2) AS seguimiento2",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 3) AS seguimiento3",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 4) AS seguimiento4",
                                       "(SELECT bandera FROM profesores_seguimientos WHERE idciclo = $idciclo AND idprofesor = profesores.idprofesor AND seguimiento = 5) AS seguimiento5"])
                            ->orderBy(["profesores.apaterno" => SORT_ASC, "profesores.amaterno" => SORT_ASC, "profesores.nombre_profesor" => SORT_ASC]);
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

        $sql = Ciclo::find()->where(["idciclo" => $idciclo])->one();
        $ciclo = $sql['desc_ciclo'];

        $total_profesores = Profesor::find()->count();
        $total_seguimiento1 = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "seguimiento" => 1, "bandera" => 1])->count();
        $total_seguimiento2 = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "seguimiento" => 2, "bandera" => 1])->count();
        $total_seguimiento3 = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "seguimiento" => 3, "bandera" => 1])->count();
        $total_seguimiento4 = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "seguimiento" => 4, "bandera" => 1])->count();
        $total_seguimiento5 = ProfesorSeguimiento::find()->where(["idciclo" => $idciclo, "seguimiento" => 5, "bandera" => 1])->count();

        $ts1 = ($total_seguimiento1 == $total_profesores) ? 1 : 0;
        $ts2 = ($total_seguimiento2 == $total_profesores) ? 1 : 0;
        $ts3 = ($total_seguimiento3 == $total_profesores) ? 1 : 0;
        $ts4 = ($total_seguimiento4 == $total_profesores) ? 1 : 0;
        $regular = ($total_seguimiento5 == $total_profesores) ? 1 : 0;

        return $this->render("seguimientos", ["model" => $model,
                                              "form" => $form,
                                              "msg" => $msg,
                                              "error" => $error,
                                              "pages" => $pages,
                                              "ts1" => $ts1,
                                              "ts2" => $ts2,
                                              "ts3" => $ts3,
                                              "ts4" => $ts4,
                                              "regular" => $regular,
                                              "profesores" => $profesores,
                                              "ciclos" => $ciclos,
                                              "ciclo_actual" => $ciclo,
                                            ]);
    }
    #endregion

    #region public function actionAsignarseguimiento()
    public function actionAsignarseguimiento()
    {
        $idprofesor = (Html::encode(isset($_GET["idprofesor"]))) ? Html::encode($_GET["idprofesor"]) : null;
        $idciclo = (Html::encode(isset($_GET["idciclo"]))) ? Html::encode($_GET["idciclo"]) : null;
        $bandera = (Html::encode(isset($_GET["bandera"]))) ? Html::encode($_GET["bandera"]) : null;
        $seguimiento = (Html::encode(isset($_GET["seguimiento"]))) ? Html::encode($_GET["seguimiento"]) : null;

        if($bandera != "" && $idprofesor != "" && $seguimiento != "" && $idciclo != "")
        {
            $total_registro = ProfesorSeguimiento::find()
                                                 ->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor, "seguimiento" => $seguimiento])
                                                 ->count();

            if($total_registro == 0)
            {
                $table = new ProfesorSeguimiento();
                $table->idciclo = $idciclo;
                $table->idprofesor = $idprofesor;
                $table->seguimiento = $seguimiento;
                $table->bandera = $bandera;
                $table->insert();
            }
            else
            {
                $total_registro = ProfesorSeguimiento::find()
                                                     ->select('idseguimiento')
                                                     ->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor, "seguimiento" => $seguimiento])
                                                     ->one();

                $idseguimiento = $total_registro->idseguimiento;

                $table = ProfesorSeguimiento::findOne($idseguimiento);
                $table->bandera = $bandera;
                $table->update();
            }
        }
    }
    #endregion

    #region public function actionAsignarseguimientos()
    public function actionAsignarseguimientos()
    {
        $idciclo = (Html::encode(isset($_GET["idciclo"]))) ? Html::encode($_GET["idciclo"]) : null;
        $bandera = (Html::encode(isset($_GET["bandera"]))) ? Html::encode($_GET["bandera"]) : null;
        $seguimiento = (Html::encode(isset($_GET["seguimiento"]))) ? Html::encode($_GET["seguimiento"]) : null;

        if($bandera != "" && $seguimiento != "" && $idciclo != "")
        {
            $table = (new \yii\db\Query())
                            ->from(["profesores"])
                            ->select(["profesores.idprofesor"])
                            ->all();

            foreach($table as $row)
            {
                $idprofesor = $row['idprofesor'];
                $total_registro = ProfesorSeguimiento::find()
                                                    ->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor, "seguimiento" => $seguimiento])
                                                    ->count();

                if($total_registro == 0)
                {
                    $table = new ProfesorSeguimiento();
                    $table->idciclo = $idciclo;
                    $table->idprofesor = $idprofesor;
                    $table->seguimiento = $seguimiento;
                    $table->bandera = $bandera;
                    $table->insert();
                }
                else
                {
                    $total_registro = ProfesorSeguimiento::find()
                                                        ->select('idseguimiento')
                                                        ->where(["idciclo" => $idciclo, "idprofesor" => $idprofesor, "seguimiento" => $seguimiento])
                                                        ->one();

                    $idseguimiento = $total_registro->idseguimiento;

                    $table = ProfesorSeguimiento::findOne($idseguimiento);
                    $table->bandera = $bandera;
                    $table->update();
                }
            }
            
        }
    }
    #endregion

    #region public function actionSeguimientosactivos()
    public function actionSeguimientosactivos()
    {
        $curp = Yii::$app->user->identity->curp;
        $idciclo = Ciclo::find()->max("idciclo");

        $model = (new \yii\db\Query())
            ->from(["profesores"])
            ->innerJoin(["profesores_seguimientos"], "profesores.idprofesor = profesores_seguimientos.idprofesor")
            ->where(["profesores.curp" => $curp, "profesores_seguimientos.idciclo" => $idciclo, "profesores_seguimientos.bandera" => "1"])
            ->count();

        return $model;
    }
    #endregion
}