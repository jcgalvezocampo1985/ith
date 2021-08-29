<?php

namespace app\models;
use Yii;
use yii\base\model;

class ProfesorSearch extends model
{
    public $q;

    public function rules()
    {
        return [
            ["q", "required", "message" => "Requerido"],
            ["q", "match", "pattern" => "/^[0-9a-zA-Z]+$/i", "message" => "Solo números y letras"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'q' => ''
        ];
    }
}