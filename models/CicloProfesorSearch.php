<?php

namespace app\models;
use Yii;
use yii\base\model;

class CicloProfesorSearch extends model
{
    public $idciclo;
    public $idprofesor;

    public function rules()
    {
        return [
            [["idciclo", "idprofesor"], "required", "message" => "Requerido"],
            [["idciclo", "idprofesor"], "match", "pattern" => "/^[0-9]+$/i", "message" => "Solo números"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idciclo" => "Periodo",
            "idprofesor" => "Profesor"
        ];
    }
}