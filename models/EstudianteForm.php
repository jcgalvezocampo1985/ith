<?php

namespace app\models;
use Yii;
use yii\base\model;

class EstudianteForm extends model
{
    public $idestudiante;
    public $nombre_estudiante;
    public $email;
    public $sexo;
    public $idcarrera;
    public $num_semestre;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            ['idestudiante', 'required', 'message' => 'Requerido'],
            
            ['idestudiante', 'match', 'pattern' => "/^.[0-9a-z]+$/i", 'message' => 'Sólo se aceptan valores alfanuméricos'],
            ['nombre_estudiante', 'required', 'message' => 'Requerido'],
            ['nombre_estudiante', 'string', 'message' => 'Sólo letras'],
            ['nombre_estudiante', 'match', 'pattern' => "/^.[a-z]+$/i", 'message' => 'Sólo letras'],
            //['nombre_estudiante', 'length' => [1, 100], 'message' => 'Mínimo 1 letra máximo 100'],
            ['email', 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Caracteres mínimo 5 y máximo 80'],
            ['email', 'email', 'message' =>'Formato no válido'],
            ['sexo', 'required', 'message' => 'Requerido'],
            ['num_semestre', 'required', 'message' => 'Requerido'],
            ['fecha_registro', 'required', 'message' => 'Requerido'],
            ['fecha_actualizacion', 'required', 'message' => 'Requerido'],
            ['cve_estatus', 'required', 'message' => 'Requerido'],
            ['idcarrera', 'required', 'message' => 'Requerido']
        ];
    }

    public function attributeLabels()
    {
        return [
            'idestudiante' => 'No. Control',
            'nombre_estudiante' => 'Nombre',
            'email' => 'Email',
            'sexo' => 'Sexo',
            'num_semestre' => 'Semestre',
            'fecha_registro' => 'Fecha Registro',
            'fecha_actualizacion' => 'Fecha Actuaización',
            'cve_estatus' => 'Clave Status',
            'idcarrera' => 'Carrera',
        ];
    }
}