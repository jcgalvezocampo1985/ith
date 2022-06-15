<?php

namespace app\models\estudiante;

use yii\base\Model;

class EstudianteSearch extends Model
{
    public $buscar;

    public function rules()
    {
        return [
            ["buscar", "required", "message" => "Requerido"],
            ["buscar", "match", "pattern" => "/^[0-9a-zA-ZaéíóúÁÉÍÓÚ]+$/i", "message" => "Solo números y letras"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "buscar" => "Buscar"
        ];
    }
}