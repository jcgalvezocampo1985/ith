<?php

namespace app\models;
use Yii;
use yii\base\model;

class ProfesorSearch extends model
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
            'buscar' => 'Buscar'
        ];
    }
}