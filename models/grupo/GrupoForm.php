<?php

namespace app\models\grupo;

use yii\base\model;

class GrupoForm extends model
{
    public $idgrupo;
    public $idciclo;
    public $idcarrera;
    public $idmateria;
    public $idprofesor;
    public $num_semestre;
    public $desc_grupo_corto;
    public $desc_grupo;
    public $aula;
    public $fecha_envio_acta;
    public $horario;
    public $lunes;
    public $martes;
    public $miercoles;
    public $jueves;
    public $viernes;
    public $sabado;

    public function rules()
    {
        return [
            [["idciclo", "idcarrera", "idmateria", "idprofesor", "desc_grupo_corto", "desc_grupo", "aula"], "required", "message" => "Requerido"],
            [["num_semestre"], "integer", "message" => "Solo números"],
            [["desc_grupo_corto", "desc_grupo", "aula"], "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ.\s]+$/i", "message" => "Solo letras"],
            ["num_semestre", "string", "min" => 1, "max" => 2, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 2 caracteres"],
            ["desc_grupo_corto", "string", "min" => 1, "max" => 10, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 10 caracteres"],
            ["desc_grupo", "string", "min" => 2, "max" => 45, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 45 caracteres"],
            ["aula", "string", "min" => 1, "max" => 20, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 20 caracteres"],
            ["horario", "string", "min" => 1, "max" => 100, "tooShort" => "Mínimo 1 caracter", "tooLong" => "Máximo 100 caracteres"],
            [["lunes", "martes", "miercoles", "jueves", "viernes", "sabado"], "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            ["idgrupo", "integer"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "idgrupo" => "",
            "idciclo" => "Ciclo",
            "idcarrera" => "Carrera",
            "idmateria" => "Materia",
            "idprofesor" => "Profesor",
            "num_semestre" => "No. Semestre",
            "desc_grupo_corto" => "Desc. Corta",
            "desc_grupo" => "Grupo",
            "aula" => "Aula",
            "fecha_envio_acta" => "Fecha Envio Acta",
            "horario" => "Horario",
            "lunes" => "Lunes",
            "martes" => "Martes",
            "miercoles" => "Miércoles",
            "jueves" => "Jueves",
            "viernes" => "Viernes",
            "sabado" => "Sábado"
        ];
    }
}