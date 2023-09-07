<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

use app\models\User;
use app\models\opcioncurso\OpcionCursoForm;
use app\models\opcioncurso\OpcionCursoSearch;

use app\repositories\OpcionCursoRepository;
use app\repositories\GrupoEstudianteRepository;

class OpcioncursoController extends Controller
{
    private $opcionCursoRepository;
    private $grupoEstudianteRepository;

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
    /* #endregion */

    /* #region public function __construct() */
    public function __construct($id, $module,
                                OpcionCursoRepository $opcionCursoRepository,
                                GrupoEstudianteRepository $grupoEstudianteRepository
                                )
    {
        parent::__construct($id, $module);
        $this->opcionCursoRepository = $opcionCursoRepository;
        $this->grupoEstudianteRepository = $grupoEstudianteRepository;
    }
    /* #endregion */

    /* #region public function actionIndex() */
    public function actionIndex()
    {
        $form = new OpcionCursoSearch;
        $msg = (Html::encode(isset($_GET['msg']))) ? Html::encode($_GET['msg']) : null;
        $error = (Html::encode(isset($_GET['error']))) ? Html::encode($_GET['error']) : null;

        $model = $this->opcionCursoRepository->all();//Se ejecuta consulta de todos los registgros

        if ($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $this->opcionCursoRepository->search = Html::encode($form->buscar);//Pasamos parámetro para la búsqueda

                $model = $this->opcionCursoRepository->all(true);//Se ejecuta consulta con parámetro de búsqueda
            }
            else
            {
                $form->getErrors();
            }
        }

        $pages = $this->opcionCursoRepository->getPages();

        if (count($model) == 0)
        {
            $error = 2;
            $msg = 'No se encontró información relacionada con el criterio de búsqueda';
        }

        return $this->render('index', compact('model', 'form', 'msg', 'error', 'pages'));
    }
    /* #endregion */

    /* #region public function actionCreate($msg = '', $error = '') */
    public function actionCreate($msg = '', $error = '')
    {
        $model = new OpcionCursoForm();
        $status = 0;

        if (Yii::$app->request->get() && $error != 1)
        {
            $model->attributes = $_GET['modelo'];
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error'));
    }
    /* #endregion */

    /* #region public function actionStore() */
    public function actionStore()
    {
        $model = new OpcionCursoForm;

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if ($this->opcionCursoRepository->store($model))
                {
                    $msg = 'Opción Curso agregada';
                    $error = 1;
                }
                else
                {
                    $msg = 'Ocurrió un error al intentar agregar la Opción Curso, intenta nuevamente';
                    $error = 3;
                }

                $modelo = [
                    'desc_opcion_curso' => $model->desc_opcion_curso,
                    'desc_opcion_curso_corto' => $model->desc_opcion_curso_corto
                ];

                return $this->redirect(['opcioncurso/create', 'msg' => $msg, 'error' => $error, 'modelo' => $modelo]);
            }
            else
            {
                $model->getErrors();
            }
        }
        else
        {
            return $this->redirect(['opcioncurso/index']);
        }
    }
    /* #endregion */

    /* #region public function actionEdit($id, $msg = '', $error = '') */
    public function actionEdit($id, $msg = '', $error = '')
    {
        $idopcion_curso = Html::encode($id);
        $msg = Html::encode($msg);
        $error = Html::encode($error);
        $status = 1;

        if (Yii::$app->request->get())
        {
            $model = new OpcionCursoForm;

            if ($idopcion_curso)
            {
                $table = $this->opcionCursoRepository->get($idopcion_curso);

                if ($table)
                {
                    $model->attributes = $table->attributes;
                }
                else
                {
                    return $this->redirect(['opcioncurso/index']);
                }
            }
            else
            {
                return $this->redirect(['opcioncurso/index']);
            }
        }
        else
        {
            return $this->redirect(['opcioncurso/index']);
        }

        return $this->render('form', compact('model', 'status', 'msg', 'error'));
    }
    /* #endregion */

    /* #region public function actionUpdate() */
    public function actionUpdate()
    {
        $model = new OpcionCursoForm;

        if ($model->load(Yii::$app->request->post()))
        {
            $idopcion_curso = $model->idopcion_curso;

            if ($model->validate())
            {
                $table = $this->opcionCursoRepository->get($idopcion_curso);

                if ($table)
                {
                    if ($this->opcionCursoRepository->update($model, $idopcion_curso))
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
            return $this->redirect(['opcioncurso/edit', 'id' => $idopcion_curso, 'msg' => $msg, 'error' => $error]);
        }
        else
        {
            return $this->redirect(['opcioncurso/index']);
        }
    }
    /* #endregion */

    /* #region public function actionDelete() */
    public function actionDelete()
    {
        if (Yii::$app->request->post())
        {
            $idopcion_curso = Html::encode($_POST['idopcion_curso']);

            $total_relacion = $this->grupoEstudianteRepository->totalRelacionOpcionCurso($idopcion_curso);

            if ($total_relacion == 0)
            {
                if ($this->opcionCursoRepository->destroy($idopcion_curso))
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
            header('Location: '.Url::toRoute('/opcioncurso/index?msg='.$msg.'&error='.$error));
            exit;
        }
        else
        {
            return $this->redirect(["opcioncurso/index"]);
        }
    }
    /* #endregion */
}