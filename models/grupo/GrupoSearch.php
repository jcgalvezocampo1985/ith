<?php

namespace app\models\grupo;

use yii\base\Model;

class GrupoSearch extends Model
{
    public $buscar;

    public function rules()
    {
        return [
            ["buscar", "required", "message" => "Requerido"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "buscar" => "Buscar"
        ];
    }
}