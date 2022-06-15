<?php

namespace app\models\ciclo;
use yii\base\Model;

class CicloEvaluacionDocenteSearch extends Model
{
    public $idciclo;
    public $reporte;

    public function rules()
    {
        return [
            [["idciclo", "reporte"], "required", "message" => "Requerido"],
            ["idciclo", "match", "pattern" => "/^[0-9]+$/i", "message" => "Solo números"],
            ["reporte", "match", "pattern" => "/^[A-Za-z]+$/i", "message" => "Los letras"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idciclo" => "Periodo",
            "reporte" => "Reporte"
        ];
    }
}