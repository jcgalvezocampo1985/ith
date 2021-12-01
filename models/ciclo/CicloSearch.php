<?php

namespace app\models\ciclo;

use yii\base\model;

class CicloSearch extends model
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
    /*
    public $idciclo;

    public function rules()
    {
        return [
            ["idciclo", "required", "message" => "Requerido"],
            ["idciclo", "match", "pattern" => "/^[0-9]+$/i", "message" => "Solo números"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idciclo" => "Periodo"
        ];
    }
    */
}