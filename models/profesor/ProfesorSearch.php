<?php

namespace app\models\profesor;
use yii\base\Model;

class ProfesorSearch extends Model
{
    public $buscar;

    public function rules()
    {
        return [
            ["buscar", "required", "message" => "Requerido"],
            ["buscar", "match", "pattern" => "/^[0-9a-zA-Z]+$/i", "message" => "Solo números y letras"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "buscar" => "Buscar"
        ];
    }
}