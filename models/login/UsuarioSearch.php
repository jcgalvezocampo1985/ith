<?php

namespace app\models\login;

use yii\base\Model;

class UsuarioSearch extends Model
{
    public $idusuario;

    public function rules()
    {
        return [
            ["idusuario", "required", "message" => "Requerido"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idusuario" => "Buscar"
        ];
    }
}