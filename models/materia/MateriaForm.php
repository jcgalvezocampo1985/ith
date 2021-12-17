<?php

namespace app\models\materia;

use Yii;
use yii\base\model;

class MateriaForm extends model
{
    public $idmateria;
    public $cve_materia;
    public $desc_materia;
    public $creditos;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [["cve_materia", "desc_materia", "creditos", "cve_estatus"], "required", "message" => "Requerido"],
            ["cve_materia", "string", "min" => 1, "max" => 15, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 15 caracteres"],
            ["desc_materia", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ.\s]+$/i", "message" => "Solo letras"],
            ["desc_materia", "string", "min" => 3, "max" => 95, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 95 caracteres"],
            ["creditos", "integer", "message" => "Solo números"],
            ["creditos", "string", "min" => 1, "max" => 2, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 2 caracteres"],
            ["cve_estatus", "string", "min" => 1, "max" => 3, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 3 caracteres"],
            ["idmateria", "integer"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idmateria" => "",
            "cve_materia" => "Clave",
            "desc_materia" => "Materia",
            "creditos" => "Créditos",
            "cve_estatus" => "Estatus"
        ];
    }
}