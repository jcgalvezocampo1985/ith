<?php

namespace app\models;

use Yii;
use yii\base\model;
use app\models\Profesor;

class ProfesorForm extends model
{
    public $curp;
    public $nombre_profesor;
    public $apaterno;
    public $amaterno;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [['curp', 'nombre_profesor', 'apaterno', 'amaterno', 'fecha_registro', 'cve_estatus'], 'required', 'message' => 'Requerido'],
            ['curp', 'string', 'min' => 3, 'max' => 20, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 20 caracteres'],
            ['curp', 'match', 'pattern' => "/^.[0-9A-Za-z]+$/i", 'message' => 'Sólo valores alfanuméricos'],
            ['curp', 'curp_existe'],
            ['nombre_profesor', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['nombre_profesor', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['nombre_profesor', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['apaterno', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['apaterno', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['amaterno', 'match', 'pattern' => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", 'message' => 'Sólo letras'],
            ['amaterno', 'string', 'min' => 3, 'max' => 45, 'tooShort' => 'Mínimo 3 caracteres', 'tooLong' => 'Máximo 45 caracteres'],
            ['fecha_registro', 'string', 'min' => 10, 'max' => 19, 'tooShort' => 'Mínimo 10 caracteres', 'tooLong' => 'Máximo 19 caracteres']
        ];
    }

    public function attributeLabels()
    {
        return [
            'curp' => 'CURP',
            'nombre_profesor' => 'Nombre',
            'apaterno' => 'Apellido Paterno',
            'amaterno' => 'Apellido Materno',
            'fecha_registro' => 'Fecha Registro',
            'fecha_actualizacion' => 'Fecha Actualización',
            'cve_estatus' => 'Status'
        ];
    }

    public function curp_existe($attribute, $params)
    {
        //Buscar el curp en la tabla
        $table = Profesor::find()->where("curp=:curp", [":curp" => $this->curp]);
        //Si el curp existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "La CURP ingresada ya existe");
        }
    }
}