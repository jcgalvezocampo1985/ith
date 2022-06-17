<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

use app\models\User;
use app\models\ciclo\CicloForm;
use app\models\ciclo\CicloSearch;

use app\repositories\CicloRepository;
use app\repositories\GrupoRepository;

class CicloController extends Controller
{
    private $cicloRepository;
    private $grupoRepository;

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

    #region public function __construct()
    public function __construct($id, $module,
                                CicloRepository $cicloRepository,
                                GrupoRepository $grupoRepository
                                )
    {
        parent::__construct($id, $module);
        $this->cicloRepository = $cicloRepository;
        $this->grupoRepository = $grupoRepository;
    }
    #endregion

    #region public function actionIndex()
    public function actionIndex()
    {
        $form = new CicloSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $model = $this->cicloRepository->all();//Se ejecuta consulta de todos los registgros

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $this->cicloRepository->search = Html::encode($form->idciclo);//Pasamos parámetro para la búsqueda

                $model = $this->cicloRepository->all(true);//Se ejecuta consulta con parámetro de búsqueda
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->cicloRepository->getPages();

        if(count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages'));
    }
    #endregion

    #region public function actionCreate($msg = '', $error = '')
    public function actionCreate($msg = '', $error = '')
    {
        $model = new CicloForm();
        $status = 0;

        if(Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error'));
    }
    #endregion

    #region public function actionStore()
    public function actionStore()
    {
        $model = new CicloForm;

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if ($this->cicloRepository->store($model))
                {
                    $msg = 'Ciclo agregado';
                    $error = 1;
                }
                else
                {
                    $msg = 'Ocurrió un error al intentar agregar el ciclo, intenta nuevamente';
                    $error = 3;
                }

                $modelo = [
                    'desc_ciclo' => $model->desc_ciclo,
                    'semestre' => $model->semestre,
                    'anio' => $model->anio,
                    'cve_estatus' => $model->cve_estatus
                ];

                return $this->redirect(['ciclo/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            } 
        }
        else
        {
            return $this->redirect(['ciclo/index']);
        }
    }
    #endregion

    #region public function actionEdit($id, $msg = '', $error = ')
    public function actionEdit($id, $msg = '', $error = '')
    {
        $idciclo = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);
        $status = 1;

        if(Yii::$app->request->get())
        {
            $model = new CicloForm;

            if($idciclo)
            {
                $table = $this->cicloRepository->get($idciclo);

                if($table)
                {
                    $model->attributes = $table->attributes;
                }
                else
                {
                    return $this->redirect(['ciclo/index']);
                }
            }
            else
            {
                return $this->redirect(['ciclo/index']);
            }
        }
        else
        {
            return $this->redirect(['ciclo/index']);
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error'));
    }
    #endregion

    #region public function actionUpdate()
    public function actionUpdate()
    {
        $model = new CicloForm;

        if($model->load(Yii::$app->request->post()))
        {
            $idciclo = $model->idciclo;

            if($model->validate())
            {
                $table = $this->cicloRepository->get($idciclo);

                if ($table)
                {
                    if($this->cicloRepository->update($model, $idciclo))
                    {
                        $msg = 'Registro actualizado';
                    }
                    else
                    {
                        $msg = 'No detectaron cambios en el registro';
                    }
                    $error = 1;
                }
                else
                {
                    $msg = 'Registro no encontrado';
                    $error = 2;
                }
            }
            else
            {
                return $this->getErrors();
            }
            return $this->redirect(['ciclo/edit', 'id' => $idciclo, 'msg' => $msg, 'error' => $error]);
        }
        else
        {
            return $this->redirect(['ciclo/index']);
        }
    }
    #endregion

    #region public function actionDelete()
    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $idciclo = Html::encode($_POST['idciclo']);

            $total_relacion = $this->grupoRepository->totalRelacionCiclos($idciclo);

            if($total_relacion == 0)
            {
                if($this->cicloRepository->destroy($idciclo))
                {
                    $error = 1;
                    $msg = 'Registro eliminado';
                }
                else
                {
                    $error = 3;
                    $msg = 'Error al eliminar el registro';
                }
            }
            else
            {
                $error = 3;
                $msg = 'El registro no puede ser eliminado, debido a que contiene información relacionada';
            }
            header('Location: '.Url::toRoute('/ciclo/index?msg='.$msg.'&error='.$error));
            exit;
        }
        else
        {
            return $this->redirect(['ciclo/index']);
        }
    }
    #endregion
}