<?php

namespace app\models\login;

use Yii;
use yii\base\Model;
use app\models\login\Usuario;

class UsuarioFormCRUD extends Model
{
    public $idusuario;
    public $email;
    public $cve_estatus;
    public $curp;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $estado;

    public function rules()
    {
        return [
            [["estado", "email", "cve_estatus", "curp"], "required", "message" => "Requerido"],
            ["email", "string", "min" => 8, "max" => 100, "tooShort" => "Mínimo 8 caracteres", "tooLong" => "Máximo 100 caracteres"],
            ["email", "email", "message" => "Formato no válido"],
            ["email", "email_existe"],
            ["curp", "string", "min" => 3, "max" => 20, "tooShort" => "Mínimo 3 caracteres", "tooLong" => "Máximo 20 caracteres"],
            ["curp", "curp_existe"],
            ["idusuario", "integer"]
        ];
    }

    public function attributeLabels()
    {
        return [
            "curp" => "CURP",
            "email" => "Email",
            "cve_estatus" => "Estatus",
            "fecha_registro" => "Fecha Registro",
            "fecha_actualizacion" => "Fecha Actualización"
        ];
    }

    public function email_existe($attribute, $params)
    {
        $table = Usuario::find()->where("email=:email", [":email" => $this->email]);

        if ($table->count() >= 1 && $this->estado == 0)
        {
            $this->addError($attribute, "El email ingresado ya existe");
        }
    }

    public function curp_existe($attribute, $params)
    {
        $table = Usuario::find()->where("curp=:curp", [":curp" => $this->curp]);

        if ($table->count() >= 1 && $this->estado == 0)
        {
            $this->addError($attribute, "CURP ya existe");
        }
    }
}