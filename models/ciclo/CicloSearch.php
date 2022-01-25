<?php

namespace app\models\ciclo;

use yii\base\Model;

class CicloSearch extends Model
{
    public $idciclo;

    public function rules()
    {
        return [
            ["idciclo", "required", "message" => "Requerido"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idciclo" => "Buscar"
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