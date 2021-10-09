<?php

namespace app\models;

use Yii;
use yii\base\model;
use app\models\Profesor;
use app\models\login\Usuario;

class ProfesorForm extends model
{
    public $idprofesor;
    public $curp;
    public $nombre_profesor;
    public $apaterno;
    public $amaterno;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;
    public $password;
    public $email;
    public $estado;

    public function rules()
    {
        return [
            [["estado", "email", "password", "curp", "nombre_profesor", "apaterno", "amaterno", "fecha_registro", "cve_estatus"], "required", "message" => "Requerido"],
            ["idprofesor", "integer", "message" => "Solo números"],
            ["curp", "string", "min" => 3, "max" => 20, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 20 caracteres"],
            ["curp", "match", "pattern" => "/^.[0-9A-Za-z.]+$/i", "message" => "Solo valores alfanuméricos"],
            ["curp", "curp_existe"],
            ["nombre_profesor", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", "message" => "Solo letras"],
            ["nombre_profesor", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", "message" => "Solo letras"],
            ["nombre_profesor", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            ["apaterno", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", "message" => "Solo letras"],
            ["apaterno", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            ["amaterno", "match", "pattern" => "/^.[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/i", "message" => "Solo letras"],
            ["amaterno", "string", "min" => 3, "max" => 45, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 45 caracteres"],
            [["fecha_registro", "fecha_actualizacion"], "string", "min" => 10, "max" => 19, "tooShort" => "Mínimo 10 caracteres", "tooLong" => "Máximo 19 caracteres"],
            ["email", "string", "min" => 8, "max" => 100, "tooShort" => "Mínimo 8 caracteres", "tooLong" => "Máximo 100 caracteres"],
            ["email", "email", "message" => "Formato no válido"],
            ["email", "email_existe"],
        ];
    }

    public function attributeLabels()
    {
        return [
            "curp" => "Usuario",
            "nombre_profesor" => "Nombre",
            "apaterno" => "Apellido Paterno",
            "amaterno" => "Apellido Materno",
            "fecha_registro" => "Fecha Registro",
            "fecha_actualizacion" => "Fecha Actualización",
            "cve_estatus" => "Clave Status",
            "password" => "Contraseña",
            "email" => "Email"
        ];
    }

    public function curp_existe($attribute, $params)
    {
        $table = Profesor::find()->where("curp=:curp", [":curp" => $this->curp]);

        if ($table->count() >= 1 && $this->estado == 0)
        {
            $this->addError($attribute, "La CURP ingresada ya existe");
        }
    }

    public function email_existe($attribute, $params)
    {
        $table = Usuario::find()->where("email=:email", [":email" => $this->email]);

        if ($table->count() == 1 && $this->estado == 0)
        {
            $this->addError($attribute, "El email ingresado ya existe");
        }
    }
}