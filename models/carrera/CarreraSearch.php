<?php

namespace app\models;
use Yii;
use yii\base\model;

class EstudianteSearch extends model
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