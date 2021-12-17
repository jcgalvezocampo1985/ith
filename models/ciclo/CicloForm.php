<?php

namespace app\models\ciclo;

use yii\base\model;

class CicloForm extends model
{
    public $idciclo;
    public $desc_ciclo;
    public $semestre;
    public $anio;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [["desc_ciclo", "semestre", "anio", "cve_estatus"], "required", "message" => "Requerido"],
            ["desc_ciclo", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            [["semestre", "anio"], "integer", "message" => "Solo números"],
            ["semestre", "string", "min" => 1, "max" => 2, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 2 caracteres"],
            ["anio", "string", "min" => 4, "max" => 4, "tooShort" => "Mínimo 4 caracteres", "tooLong" => "Máximo 4 caracteres"],
            ["cve_estatus", "string", "min" => 1, "max" => 3, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 3 caracteres"],
            ["idciclo", "integer"],
            [["fecha_registro", "fecha_actualizacion"], "string", "min" => 1]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idciclo" => "",
            "desc_ciclo" => "Ciclo",
            "anio" => "Año",
            "semestre" => "Semestre",
            "cve_estatus" => "Status"
        ];
    }
}