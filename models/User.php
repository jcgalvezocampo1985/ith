<?php

namespace app\models;

use app\models\login\Usuario;
use app\models\login\Rol;
use app\models\login\UsuarioRol;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    
    public $idusuario;
    public $curp;
    public $nombre_usuario;
    public $email;
    public $password;
    public $cve_estatus;
    public $authKey;
    public $accessToken;
    public $activate;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $verification_code;
    public $role;

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $idusuario */

    public static function findIdentity($idusuario)
    {
        
        $user = Usuario::find()
                        ->where("activate=:activate", [":activate" => 1])
                        ->andWhere("idusuario=:idusuario", ["idusuario" => $idusuario])
                        ->one();
        
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Usuario::find()
                        ->where("activate=:activate", [":activate" => 1])
                        ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                        ->all();

        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by curp
     *
     * @param  string      $curp
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($curp)
    {
        $users = Usuario::find()
                        ->where("activate=:activate", ["activate" => 1])
                        ->andWhere("curp=:curp", [":curp" => $curp])
                        ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->curp, $curp) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->idusuario;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if (crypt($password, $this->password) == $this->password)
        {
            return $password === $password;
        }
    }

    public static function isUserAutenticado($idusuario, $rol)
    {
        if(Usuario::findOne(["idusuario" => $idusuario, "activate" => "1"]))
        {
            /*
            * $rol[1 => Administrador, 2 => Escolares, 3 => Profesor, 4 => dep, 5 => Estudiante, 6 => Consulta]
            */
            if(UsuarioRol::findOne(["idusuario" => $idusuario, "idrol" => $rol]))
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    /*
    public static function isUserAdministrador($idusuario)
    {
        if (Usuario::findOne(["idusuario" => $idusuario, "activate" => "1"]))
        {
            if(UsuarioRol::findOne(["idusuario" => $idusuario, "idrol" => 1]))
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }    

    public static function isUserProfesor($idusuario)
    {
        if(Usuario::findOne(["idusuario" => $idusuario, "activate" => "1"]))
        {
            if(UsuarioRol::findOne(["idusuario" => $idusuario, "idrol" => 3]))
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
    */
}