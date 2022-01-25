<?php

namespace app\models\carrera;

use Yii;
use yii\base\Model;

class CarreraForm extends Model
{
    public $idcarrera;
    public $cve_carrera;
    public $desc_carrera;
    public $no_semestres;
    public $plan_estudios;

    public function rules()
    {
        return [
            [["cve_carrera", "desc_carrera", "no_semestres", "plan_estudios"], "required", "message" => "Requerido"],
            ["cve_carrera", "string", "min" => 1, "max" => 10, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 10 caracteres"],
            ["desc_carrera", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ.\s]+$/i", "message" => "Solo letras"],
            ["desc_carrera", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            ["no_semestres", "integer", "message" => "Solo números"],
            ["no_semestres", "string", "min" => 1, "max" => 2, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 2 caracteres"],
            ["plan_estudios", "string", "min" => 1, "max" => 30, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 30 caracteres"],
            ["idcarrera", "integer"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idcarrera" => "",
            "cve_carrera" => "Clave",
            "desc_carrera" => "Carrera",
            "no_semestres" => "No. Semestres",
            "plan_estudios" => "Plan de Estudio",
            "estado" => "Estado"
        ];
    }
}