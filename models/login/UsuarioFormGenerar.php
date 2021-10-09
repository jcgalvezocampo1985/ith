<?php

namespace app\models\login;

use Yii;
use yii\base\model;
use app\models\login\Usuario;

class UsuarioFormGenerar extends model
{
    public $curp;

    public function rules()
    {
        return [
            [["curp"], "required", "message" => "Requerido"],
        ];
    }

    public function attributeLabels()
    {
        return [
            "curp" => "Password"
        ];
    }
}