<?php

namespace app\models;

use Yii;
use yii\base\model;
use app\models\Ciclo;

class CicloForm extends model
{
    public $desc_ciclo;
    public $semestre;
    public $anio;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [['desc_ciclo', 'semestre', 'anio', 'fecha_registro', 'cve_estatus'], 'required', 'message' => 'Requerido'],
            /*['desc_ciclo', 'string', 'min' => 3, 'max' => 20, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 20 caracteres'],
            ['curp', 'match', 'pattern' => "/^.[0-9A-Za-z]+$/i", 'message' => 'Sólo valores alfanuméricos'],
            ['curp', 'curp_existe'],
            ['nombre_profesor', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['nombre_profesor', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['nombre_profesor', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['apaterno', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['apaterno', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['amaterno', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['amaterno', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['fecha_registro', 'string', 'min' => 10, 'max' => 19, 'tooShort' => 'Mínimo 10 caracteres', 'tooLong' => 'Máximo 19 caracteres']*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'desc_ciclo' => 'Ciclo',
            'anio' => 'Año',
            'semestre' => 'Semestre',
            'fecha_registro' => 'Fecha Registro',
            'fecha_actualizacion' => 'Fecha Actualización',
            'cve_estatus' => 'Status'
        ];
    }
}