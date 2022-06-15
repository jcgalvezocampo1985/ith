<?php

namespace app\models\grupo;

use yii\base\Model;

class GrupoForm extends Model
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
    public $lunes_inicio;
    public $lunes_fin;
    public $martes_inicio;
    public $martes_fin;
    public $miercoles_inicio;
    public $miercoles_fin;
    public $jueves_inicio;
    public $jueves_fin;
    public $viernes_inicio;
    public $viernes_fin;
    public $sabado_inicio;
    public $sabado_fin;
    public $lunes;
    public $martes;
    public $miercoles;
    public $jueves;
    public $viernes;
    public $sabado;
    public $domingo;

    public function rules()
    {
        return [
            [["idciclo", "idcarrera", "idmateria", "idprofesor", "desc_grupo_corto", "desc_grupo", "aula"], "required", "message" => "Requerido"],
            [["num_semestre"], "integer", "message" => "Solo números"],
            [["desc_grupo_corto", "desc_grupo", "aula"], "match", "pattern" => "/^.[0-9a-zA-ZáéíóúÁÉÍÓÚ.\s]+$/i", "message" => "Solo letras"],
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
            "lunes_inicio" => "Lunes Inicio",
            "lunes_fin" => "Lunes Fin",
            "martes_inicio" => "Martes Inicio",
            "martes_fin" => "Martes Fin",
            "miercoles_inicio" => "Miércoles Inicio",
            "miercoles_fin" => "Miércoles Fin",
            "jueves_inicio" => "Jueves Inicio",
            "jueves_fin" => "Jueves Fin",
            "viernes_inicio" => "Viernes Inicio",
            "viernes_fin" => "Viernes Fin",
            "sabado_inicio" => "Sábado Inicio",
            "sabado_fin" => "Sábado Fin"
        ];
    }
}