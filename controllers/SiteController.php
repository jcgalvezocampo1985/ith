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

use app\models\login\LoginForm;
use app\models\login\RecoverPassForm;
use app\models\login\ResetPassForm;
use app\models\login\Usuario;
use app\models\login\UsuarioForm;
use app\models\login\UsuarioFormGenerar;
use app\models\User;
use app\models\login\Rol;
use app\models\login\UsuarioRol;

class SiteController extends Controller
{
    /*
    public function behaviors()
    {
       return [
               'access' => [
                   'class' => AccessControl::className(),
                   'only' => ['index', 'resetpass', 'recoverpass', 'confirm', 'register', 'generarpassword'],//Especificar que acciones se van proteger
                   'rules' => [
                       [
                           //El administrador tiene permisos sobre las siguientes acciones
                           'actions' => ['index', 'resetpass', 'recoverpass', 'confirm', 'register', 'generarpassword'],//Especificar que acciones tiene permitidas este usuario
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
                           //Los usuarios simples tienen permisos sobre las siguientes acciones
                           'actions' => ['index'],//Especificar que acciones tiene permitidas este usuario
                           //Esta propiedad establece que tiene permisos
                           'allow' => true,
                           //Usuarios autenticados, el signo ? es para invitados
                           'roles' => ['@'],
                           //Este método nos permite crear un filtro sobre la identidad del usuario
                           //y así establecer si tiene permisos o no
                           'matchCallback' => function ($rule, $action) {
                               //Llamada al método que comprueba si es un usuario simple
                               //return User::isUserProfesor(Yii::$app->user->identity->idusuario);
                               return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                           },
                       ],
                       [
                           //Los usuarios simples tienen permisos sobre las siguientes acciones
                           'actions' => ['index'],//Especificar que acciones tiene permitidas este usuario
                           //Esta propiedad establece que tiene permisos
                           'allow' => true,
                           //Usuarios autenticados, el signo ? es para invitados
                           'roles' => ['@'],
                           //Este método nos permite crear un filtro sobre la identidad del usuario
                           //y así establecer si tiene permisos o no
                           'matchCallback' => function ($rule, $action) {
                               //Llamada al método que comprueba si es un usuario simple
                               //return User::isUserProfesor(Yii::$app->user->identity->idusuario);
                               return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                           },
                       ],
                       [
                           //Los usuarios simples tienen permisos sobre las siguientes acciones
                           'actions' => ['index'],//Especificar que acciones tiene permitidas este usuario
                           //Esta propiedad establece que tiene permisos
                           'allow' => true,
                           //Usuarios autenticados, el signo ? es para invitados
                           'roles' => ['@'],
                           //Este método nos permite crear un filtro sobre la identidad del usuario
                           //y así establecer si tiene permisos o no
                           'matchCallback' => function ($rule, $action) {
                               //Llamada al método que comprueba si es un usuario simple
                               //return User::isUserProfesor(Yii::$app->user->identity->idusuario);
                               return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4);
                           },
                       ],
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
*/
    /**
    * {
    @inheritdoc}
    */

    #region public function actions()
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    #endregion

    /**
    * Displays homepage.
    *
    * @return string
    */

    #region public function actionIndex()
    public function actionIndex()
    {
        //return $this->render('index');
        return $this->redirect(["profesor/index"]);
    }
    #endregion

    /**
    * Login action.
    *
    * @return Response|string
    */

    #region public function actionLogin()
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            //return $this->redirect(["site/index"]);
            if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1))
            {
                return $this->redirect(["profesor/horarioconsulta"]);
            }
            else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2))
            {
                return $this->redirect(["profesor/horarioconsulta"]);
            }
            else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3))
            {
                return $this->redirect(["profesor/horario"]);
            }
            else if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4))
            {
                return $this->redirect(["profesor/horarioconsulta"]);
            }
            if(User::isUserAutenticado(Yii::$app->user->identity->idusuario, 5))
            {
                return $this->redirect(["site/index"]);;
            }
            else
            {
                return $this->redirect(["site/index"]);
            }
        }
 
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1)) {
                return $this->redirect(["profesor/horarioconsulta"]);
            } elseif (User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2)) {
                return $this->redirect(["profesor/horarioconsulta"]);
            } elseif (User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3)) {
                return $this->redirect(["profesor/horario"]);
            } elseif (User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4)) {
                return $this->redirect(["profesor/horarioconsulta"]);
            }
        } else {
            return $this->render("login", ["model" => $model]);
        }
    }
    #endregion

    /**
    * Logout action.
    *
    * @return Response
    */

    #region public function actionLogout()
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    #endregion

    #region public function randKey($str = '', $long = 0)
    private function randKey($str = '', $long = 0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;

        for ($x = 0; $x<$long; $x++) {
            $key .= $str[rand($start, $limit)];
        }

        return $key;
    }
    #endregion

    #region public function actionRegister()
    public function actionRegister()
    {
        //Creamos la instancia con el model de validación
        $model = new UsuarioForm;

        //Mostrará un mensaje en la vista cuando el usuario se haya registrado
        $msg = null;

        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return ActiveForm::validate($model);
        }

        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                //Preparamos la consulta para guardar el usuario
                $idusuario = Usuario::find()->max("idusuario");
                $table = new Usuario;
                $table->idusuario = $idusuario + 1;
                $table->nombre_usuario = $model->nombre_usuario;
                $table->curp = $model->curp;
                $table->email = $model->email;
                //Encriptamos el password
                $table->password = crypt($model->password, Yii::$app->params['salt']);
                //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
                //clave será utilizada para activar el usuario
                $table->authKey = $this->randKey('abcdef0123456789', 200);
                //Creamos un token de acceso único para el usuario
                $table->accessToken = $this->randKey('abcdef0123456789', 200);

                //Si el registro es guardado correctamente
                if ($table->insert()) {
                    //Nueva consulta para obtener el id del usuario
                    //Para confirmar al usuario se requiere su id y su authKey
                    $user = $table->find()->where(['email' => $model->email])->one();
                    $idusuario = urlencode($user->idusuario);
                    $authKey = urlencode($user->authKey);

                    $subject = 'Confirmar registro';
                    $body = '<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>';
                    $body .= "<a href='http://ithuimanguillo.test/site/confirm?idusuario=".$idusuario.'&authKey='.$authKey."'>Confirmar</a>";

                    //Enviamos el correo
                    Yii::$app->mailer->compose()
                                     ->setTo($user->email)
                                     ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                                     ->setSubject($subject)
                                     ->setHtmlBody($body)
                                     ->send();

                    $model->nombre_usuario = null;
                    $model->curp = null;
                    $model->email = null;
                    $model->password = null;
                    $model->password_repeat = null;

                    $msg = 'Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo';
                } else {
                    $msg = 'Ha ocurrido un error al llevar a cabo tu registro';
                }
            } else {
                $model->getErrors();
            }
        }

        return $this->render('registro', ['model' => $model, 'msg' => $msg]);
    }
    #endregion

    #region public function actionConfirm()
    public function actionConfirm()
    {
        $table = new Usuario;
        $msg = null;

        if (Yii::$app->request->get()) {
            //Obtenemos el valor de los parámetros get
            $idusuario = Html::encode($_GET['idusuario']);
            $authKey = $_GET['authKey'];

            if ((int)$idusuario) {
                //Realizamos la consulta para obtener el registro
                $model = $table
                        ->find()
                        ->where('idusuario=:idusuario', [':idusuario' => $idusuario])
                        ->andWhere('authKey=:authKey', [':authKey' => $authKey]);

                //Si el registro existe
                if ($model->count() == 1) {
                    $activar = Usuario::findOne($idusuario);
                    $activar->activate = 1;

                    if ($activar->update()) {
                        $msg = 'Enhorabuena registro llevado a cabo correctamente';
                    } else {
                        $msg = 'Ha ocurrido un error al realizar el registro';
                    }
 
                    return $this->render('confirm', ['msg' => $msg]);
                } else { //Si no existe redireccionamos a login
                    return $this->redirect(['site/login']);
                }
            } else { //Si id no es un número entero redireccionamos a login
                return $this->redirect(['site/login']);
            }
        }
    }
    #endregion

    #region public function actionRecoverpass()
    public function actionRecoverpass()
    {
        //Instancia para validar el formulario
        $model = new RecoverPassForm;
  
        //Mensaje que será mostrado al usuario en la vista
        $msg = null;
  
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                //Buscar al usuario a través del email
                $table = Usuario::find()->where("email=:email", [":email" => $model->email]);
    
                //Si el usuario existe
                if ($table->count() == 1) {
                    //Crear variables de sesión para limitar el tiempo de restablecido del password
                    //hasta que el navegador se cierre
                    $session = new Session;
                    $session->open();
     
                    //Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
                    $session["recover"] = $this->randKey("abcdef0123456789", 200);
                    $recover = $session["recover"];
     
                    //También almacenaremos el id del usuario en una variable de sesión
                    //El id del usuario es requerido para generar la consulta a la tabla users y
                    //restablecer el password del usuario
                    $table = Usuario::find()->where("email=:email", [":email" => $model->email])->one();
                    $session["id_recover"] = $table->idusuario;
     
                    //Esta variable contiene un número hexadecimal que será enviado en el correo al usuario
                    //para que lo introduzca en un campo del formulario de reseteado
                    //Es guardada en el registro correspondiente de la tabla users
                    $verification_code = $this->randKey("abcdef0123456789", 8);
                    //Columna verification_code
                    $table->verification_code = $verification_code;
                    //Guardamos los cambios en la tabla users
                    $table->save();
     
                    //Creamos el mensaje que será enviado a la cuenta de correo del usuario
                    $subject = "Restablecimiento de contraseña";
                    $body = "<p>Copie el siguiente código de verificación para restablecer su contraseña ... ";
                    $body .= "<strong>".$verification_code."</strong></p>";
                    $body .= "<p><a href='http://ithuimanguillo.test/site/resetpass'>Restablecer contraseña</a></p>";

                    //Enviamos el correo
                    Yii::$app->mailer->compose()
                                     ->setTo($model->email)
                                     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                                     ->setSubject($subject)
                                     ->setHtmlBody($body)
                                     ->send();
     
                    //Vaciar el campo del formulario
                    $model->email = null;
     
                    //Mostrar el mensaje al usuario
                    $msg = "Le hemos enviado un mensaje a su cuenta de correo para que pueda restablecer su contraseña";
                } else { //El usuario no existe
                    $msg = "Ha ocurrido un error";
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
    }
    #endregion
 
    #region public function actionResetpass()
    public function actionResetpass()
    {
        //Instancia para validar el formulario
        $model = new ResetPassForm;
  
        //Mensaje que será mostrado al usuario
        $msg = null;
  
        //Abrimos la sesión
        $session = new Session;
        $session->open();
  
        //Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
        if (empty($session["recover"]) || empty($session["id_recover"]))
        {
            return $this->redirect(["site/index"]);
        }
        else
        {
            $recover = $session["recover"];
            //El valor de esta variable de sesión la cargamos en el campo recover del formulario
            $model->recover = $recover;
   
            //Esta variable contiene el id del usuario que solicitó restablecer el password
            //La utilizaremos para realizar la consulta a la tabla users
            $id_recover = $session["id_recover"];
        }

        //Si el formulario es enviado para resetear el password
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                //Si el valor de la variable de sesión recover es correcta
                if($recover == $model->recover)
                {
                    //Preparamos la consulta para resetear el password, requerimos el email, el id 
                    //del usuario que fue guardado en una variable de session y el código de verificación
                    //que fue enviado en el correo al usuario y que fue guardado en el registro
                    $table = Usuario::findOne(["email" => $model->email, "idusuario" => $id_recover, "verification_code" => $model->verification_code]);

                    //Encriptar el password
                    $table->password = crypt($model->password, Yii::$app->params["salt"]);

                    //Si la actualización se lleva a cabo correctamente
                    if ($table->save())
                    {
                        //Destruir las variables de sesión
                        $session->destroy();

                        //Vaciar los campos del formulario
                        $model->email = null;
                        $model->password = null;
                        $model->password_repeat = null;
                        $model->recover = null;
                        $model->verification_code = null;

                        $msg = "Enhorabuena, contraseña restablecida correctamente, redireccionando a la página de login ...";
                        $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
                    }
                    else
                    {
                        $msg = "Ha ocurrido un error";
                    }
                }
                else
                {
                    $model->getErrors();
                }
            }
        }

        return $this->render("resetpass", ["model" => $model, "msg" => $msg]);
    }
    #endregion

    #region public function actionGenerarpassword()
    public function actionGenerarpassword()
    {
        //Creamos la instancia con el model de validación
        $model = new UsuarioFormGenerar;

        //Mostrará un mensaje en la vista cuando el usuario se haya registrado
        $msg = null;
        $password = null;

        //Validación mediante ajax
        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return ActiveForm::validate($model);
        }

        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if($model->load( Yii::$app->request->post()))
        {
            $password = crypt($model->curp, Yii::$app->params['salt']);
            /*if($model->validate())
            {
                //Preparamos la consulta para guardar el usuario
                $table = new Usuario;
                $table->curp = $model->curp;
                $table->nombre_usuario = $model->nombre_usuario;
                $table->email = $model->email;
                //Encriptamos el password
                $table->password = crypt($model->password, Yii::$app->params['salt']);
                //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
                //clave será utilizada para activar el usuario
                $table->cve_estatus = "1";
                $table->authKey = $this->randKey('abcdef0123456789', 200);
                //Creamos un token de acceso único para el usuario
                $table->accessToken = $this->randKey('abcdef0123456789', 200);
                $table->activate = 1;
                $table->fecha_registro = date("Y-m-d h:i:s");
                $table->fecha_actualizacion = date("Y-m-d h:i:s");
                $table->verification_code = "1";
                
                //Si el registro es guardado correctamente
                if($table->insert())
                {
                    //Nueva consulta para obtener el id del usuario
                    //Para confirmar al usuario se requiere su id y su authKey
                    $user = $table->find()->where(['email' => $model->email])->one();
                    $idusuario = urlencode($user->idusuario);
                    $authKey = urlencode($user->authKey);

                    $subject = 'Confirmar registro';
                    $body = '<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>';
                    $body .= "<a href='http://ithuimanguillo.test/site/confirm?idusuario=".$idusuario.'&authKey='.$authKey."'>Confirmar</a>";

                    //Enviamos el correo
                    Yii::$app->mailer->compose()
                                     ->setTo($user->email)
                                     ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                                     ->setSubject($subject)
                                     ->setHtmlBody($body)
                                     ->send();

                    $model->nombre_usuario = null;
                    $model->curp = null;
                    $model->email = null;
                    $model->password = null;
                    $model->password_repeat = null;

                    $msg = 'Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo';
                }
                else
                {
                    $msg = 'Ha ocurrido un error al llevar a cabo tu registro';
                }

            }
            else
            {
                $model->getErrors();
            }*/
        }

        return $this->render('generarpassword', ['model' => $model, 'msg' => $msg, 'password' => $password]);
    }
    #endregion
}