<?php

namespace app\models\carrera;
use Yii;
use yii\base\Model;

class CarreraSearch extends Model
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
}