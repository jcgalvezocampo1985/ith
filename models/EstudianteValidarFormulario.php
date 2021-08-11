<?php

namespace app\models;
use Yii;
use yii\base\model;

class EstudianteValidarFormulario extends model
{
    public $idestudiante;

    public function rules()
    {
        return [
            ['idestudiante', 'required', 'message' => 'Requerido'],
            ['idestudiante', 'match', 'pattern' => "/^.[0-9]+$/i", 'message' => 'Sólo se aceptan valores numericos']
        ];
    }

    public function attributeLabels()
    {
        return [
            'idestudiante' => 'No. Control'
        ];
    }
}