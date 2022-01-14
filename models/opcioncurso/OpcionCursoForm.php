<?php

namespace app\models\opcioncurso;

use Yii;
use yii\base\Model;

class OpcionCursoForm extends Model
{
    public $idopcion_curso;
    public $desc_opcion_curso;
    public $desc_opcion_curso_corto;

    public function rules()
    {
        return [
            [["desc_opcion_curso", "desc_opcion_curso_corto"], "required", "message" => "Requerido"],
            ["desc_opcion_curso", "string", "min" => 1, "max" => 15, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 15 caracteres"],
            ["desc_opcion_curso", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ.\s]+$/i", "message" => "Solo letras"],
            ["desc_opcion_curso_corto", "string", "min" => 1, "max" => 1, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 1 caracter"],
            ["idopcion_curso", "integer"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idopcion_curso" => "",
            "desc_opcion_curso" => "Opción Curso",
            "desc_opcion_curso_corto" => "Descripción Corta"
        ];
    }
}