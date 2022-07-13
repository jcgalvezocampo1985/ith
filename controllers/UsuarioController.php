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

use app\repositories\UsuarioRepository;
use app\repositories\RolRepository;
use app\repositories\RolUsuarioRepository;

class UsuarioController extends Controller
{
    private $usuarioRepository;
    private $rolRepository;
    private $rolUsuarioRepository;

    /* #region public function behaviors() */
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
    /* #endregion */

    /* #region public function __construct() */
    public function __construct($id, $module,
                                UsuarioRepository $usuarioRepository,
                                RolRepository $rolRepository,
                                RolUsuarioRepository $rolUsuarioRepository
                                )
    {
        parent::__construct($id, $module);
        $this->usuarioRepository = $usuarioRepository;
        $this->rolRepository = $rolRepository;
        $this->rolUsuarioRepository = $rolUsuarioRepository;;
    }
    /* #endregion */

    /* #region public function actionIndex() */
    public function actionIndex()
    {
        $form = new UsuarioSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $model = $this->usuarioRepository->all();//Se ejecuta consulta de todos los registgros

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $this->usuarioRepository->search = Html::encode($form->idusuario);//Pasamos parámetro para la búsqueda

                $model = $this->usuarioRepository->all(true);//Se ejecuta consulta con parámetro de búsqueda
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->usuarioRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages'));
    }
    /* #endregion */

    /* #region public function actionCreate($msg = "", $error = "") */
    public function actionCreate($msg = '', $error = '')
    {
        $model = new UsuarioFormCRUD;
        $clave_estatus = ['VIG' => 'VIGENTE'];
        $roles = \MyGlobalFunctions::dropDownList($this->rolRepository->listaRegistros(['idrol' => SORT_DESC]), 'idrol', ['desc_rol']);
        $status = 0;

        if(Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error', 'clave_estatus', 'roles'));
    }
    /* #endregion */

    /* #region public function actionStore() */
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
                $idusuario = $this->usuarioRepository->maxId() + 1;
                $model->idusuario = $idusuario;
                $model->nombre_usuario = $model->curp;
                $model->password = crypt($model->curp, Yii::$app->params['salt']);
                $model->activate = 1;
                $model->fecha_registro = date('Y-m-d h:i:s');

                if ($this->usuarioRepository->store($model))
                {
                    $model1 = [
                        'idusuario' => $idusuario,
                        'idrol' => $model->idrol
                    ];

                    $idrolusuario = $this->rolUsuarioRepository->store($model1);

                    $msg = 'Usuario agregado';
                    $error = 1;
                }
                else
                {
                    $msg = 'Ocurrió un error al intentar agregar el usuario, intenta nuevamente';
                    $error = 3;
                }

                $modelo = [
                    'idusuario' => $model->idusuario,
                    'email' => $model->email,
                    'cve_estatus' => $model->cve_estatus,
                    'curp' => $model->curp,
                    'fecha_registro' => $model->fecha_registro,
                    'fecha_actualizacion' => $model->fecha_actualizacion,
                    'idrol' => $model->idrol
                ];

                return $this->redirect(['usuario/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(['usuario/index']);
        }
    }
    /* #endregion */

    /* #region public function actionEdit($id, $msg = "", $error = "") */
    public function actionEdit($idusuario, $msg = "", $error = "")
    {
        if(Yii::$app->request->get())
        {
            $idusuario = Html::encode($idusuario);
            $msg = Html::encode($msg);
            $error = Html::encode($error);
            $model = new UsuarioFormCRUD;
            $status = 1;

            if($idusuario)
            {
                $table = $this->usuarioRepository->get($idusuario);
                $clave_estatus = ["VIG" => "VIGENTE", "BT" => "BAJA TEMPORAL", "BD" => "BAJA DEFINITIVA"];
                $roles = \MyGlobalFunctions::dropDownList($this->rolRepository->listaRegistros(['idrol' => SORT_DESC]), 'idrol', ['desc_rol']);

                if($table)
                {
                    $model->idrol = 1;
                    $model->attributes = $table->attributes;
                }
                else
                {
                    return $this->redirect(['usuario/index']);
                }
            }
            else
            {
                return $this->redirect(['usuario/index']);
            }
        }
        else
        {
            return $this->redirect(['usuario/index']);
        }
\MyGlobalFunctions::dd($model);
        return $this->render('form', compact('model', 'status', 'msg', 'error', 'clave_estatus', 'idusuario', 'roles'));
    }
    /* #endregion */

    /* #region public function actionUpdate() */
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
    /* #endregion */

    /* #region public function actionDelete() */
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
    /* #endregion */
}