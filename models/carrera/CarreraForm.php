<?php

namespace app\models;

use Yii;
use yii\base\model;
use app\models\Estudiante;

class CarreraForm extends model
{
    public $idcarrera;
    public $cve_carrera;
    public $desc_carrera;
    public $no_semestres;
    public $plan_estudios;
    public $estado;

    public function rules()
    {
        return [
            [["estado", "cve_carrera", "desc_carrera", "no_semestres", "plan_estudios"], "required", "message" => "Requerido"],
            ["cve_carrera", "string", "min" => 1, "max" => 10, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 10 caracteres"],
            ["desc_carrera", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", "message" => "Solo letras"],
            ["desc_carrera", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            ["no_semestres", "integer", "message" => "Solo números"],
            ["no_semestres", "string", "min" => 1, "max" => 2, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 2 caracteres"],
            ["plan_estudios", "string", "min" => 3, "max" => 30, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 30 caracteres"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idcarrera" => "",
            "cve_carrera" => "Clave",
            "desc_carrera" => "Materia",
            "no_semestres" => "No. Semestres",
            "plan_estudios" => "Plan de Estudio",
            "estado" => "Estado"
        ];
    }
}