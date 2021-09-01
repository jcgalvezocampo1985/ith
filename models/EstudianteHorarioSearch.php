<?php

namespace app\models;
use Yii;
use yii\base\model;

class EstudianteHorarioSearch extends model
{
    public $idestudiante;
    public $idciclo;

    public function rules()
    {
        return [
            [["idestudiante", "idciclo"], "required", "message" => "Requerido"],
            ["idestudiante", "match", "pattern" => "/^[0-9a-zA-Z]+$/i", "message" => "Solo números y letras"],
            ["idciclo", "match", "pattern" => "/^[0-9]+$/i", "message" => "Solo números"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idestudiante" => "No. Control",
            "idciclo" => "Periodo"
        ];
    }
}