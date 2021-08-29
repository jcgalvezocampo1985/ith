<?php

namespace app\models\login;

use Yii;
use yii\base\model;
use app\models\login\Usuario;

class UsuarioForm extends model
{
    public $curp;
    public $nombre_usuario;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['curp', 'nombre_usuario', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Requerido'],
            ['curp', 'string', 'min' => 3, 'max' => 20, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 20 caracteres'],
            ['curp', 'match', 'pattern' => "/^.[0-9A-Za-z]+$/i", 'message' => 'Sólo valores alfanuméricos'],
            ['curp', 'curp_existe'],
            ['nombre_usuario', 'required', 'message' => 'Requerido'],
            ['nombre_usuario', 'string', 'min' => 8, 'max' => 45, 'tooShort' => 'Mínimo 8 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['nombre_usuario', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['email', 'string', 'min' => 8, 'max' => 100, 'tooShort' => 'Mínimo 8 caracteres', 'tooLong' => 'Máximo 100 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email', 'email_existe'],
            ['password', 'string', 'min' => 8, 'max' => 16, 'tooShort' => 'Mínimo 8 caracteres', 'tooLong' => 'Máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'curp' => 'CURP',
            'nombre_usuario' => 'Nombre',
            'email' => 'Email',
            'password' => 'Contraseña',
            'password_repeat' => 'Repite Contraseña',
        ];
    }

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Usuario::find()->where("email=:email", [":email" => $this->email]);
        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email ingresado ya existe");
        }
    }
 
    /*
    public function username_existe($attribute, $params)
    {
        //Buscar el username en la tabla
        $table = Usuario::find()->where("nombre_usuario=:nombre_usuario", [":nombre_usuario" => $this->nombre_usuario]);

        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El usuario seleccionado existe");
        }
    }
    */

    public function curp_existe($attribute, $params)
    {
        //Buscar la CURP en la tabla
        $table = Usuario::find()->where("curp=:curp", [":curp" => $this->curp]);

        //Si la CURP existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "CURP ya existe");
        }
    }
}