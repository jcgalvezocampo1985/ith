<?php

namespace app\models;

use Yii;
use yii\base\model;

class GrupoEstudianteForm extends model
{
    public $idgrupo;
    public $idestudiante;
    public $idopcion_curso;
    public $idciclo;
    public $idgrupoidestudiante;
    public $idmateria;
    public $p1;
    public $p2;
    public $p3;
    public $p4;
    public $p5;
    public $p6;
    public $p7;
    public $p8;
    public $p9;
    public $s1;
    public $s2;
    public $s3;
    public $s4;
    public $s5;
    public $s6;
    public $s7;
    public $s8;
    public $s9;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [['idgrupo', 'idestudiante', 'idopcion_curso', 'idciclo'], 'required', 'message' => 'Requerido'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idgrupo' => 'Materia',
            'idestudiante' => 'Estudiante',
            'idopcion_curso' => '',
            'idciclo' => 'Ciclo'
        ];
    }
}