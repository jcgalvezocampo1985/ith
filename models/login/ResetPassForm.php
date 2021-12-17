<?php
namespace app\models\login;

use Yii;
use yii\base\model;

class ResetPassForm extends model
{
    public $email;
    public $password;
    public $password_repeat;
    public $verification_code;
    public $recover;

    public function rules()
    {
        return [
            [["email", "password", "password_repeat", "verification_code", "recover"], "required", "message" => "Requerido"],
            ["email", "string", "min" => 8, "max" => 100, "tooShort" => "Mínimo 8 caracteres", "tooLong" => "Máximo 100 caracteres"],
            ["email", "email", "message" => "Formato no válido"],
            ["password", "string", "min" => 8, "max" => 16, "tooShort" => "Mínimo 8 caracteres", "tooLong" => "Máximo 16 caracteres"],
            ["password_repeat", "compare", "compareAttribute" => "password", "message" => "Las contraseñas no coinciden"],
        ];
    }
}