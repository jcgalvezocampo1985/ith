<?php

namespace app\models\grupoestudiante;

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
    public $p10;
    public $p11;
    public $p12;
    public $p13;
    public $p14;
    public $p15;
    public $p16;
    public $s1;
    public $s2;
    public $s3;
    public $s4;
    public $s5;
    public $s6;
    public $s7;
    public $s8;
    public $s9;
    public $s10;
    public $s11;
    public $s12;
    public $s13;
    public $s14;
    public $s15;
    public $s16;
    public $sp1;
    public $sp2;
    public $sp3;
    public $sp4;
    public $sp5;
    public $sp6;
    public $sp7;
    public $sp8;
    public $sp9;
    public $sp10;
    public $sp11;
    public $sp12;
    public $sp13;
    public $sp14;
    public $sp15;
    public $sp16;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [["idgrupo", "idestudiante", "idopcion_curso", "idciclo"], "required", "message" => "Requerido"],
            [["p1","p2","p3","p4","p5","p6","p7","p8","p9","p10","p11","p12","p13","p14","p15","p16",
              "s1","s2","s3","s4","s5","s6","s7","s8","s9","s10","s11","s12","s13","s14","s15","s16",
              "sp1","sp2","sp3","sp4","sp5","sp6","sp7","sp8","sp9","sp10","sp11","sp12","sp13","sp14","sp15","sp16"], "pattern" => "/^.[0-9]+$/i", "message" => "Sólo valores alfanuméricos"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idgrupo" => "Materia",
            "idestudiante" => "Estudiante",
            "idopcion_curso" => "",
            "idciclo" => "Ciclo"
        ];
    }
}