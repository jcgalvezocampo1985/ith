<?php

namespace app\models;
use Yii;
use yii\base\model;

class EstudianteSearch extends model
{
    public $q;

    public function rules()
    {
        return [
            ["q", "required", "message" => "Requerido"],
            ["q", "match", "pattern" => "/^[0-9]+$/i", "message" => "Solo números"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'q' => ''
        ];
    }
}