<?php
namespace app\models\login;

use Yii;
use yii\base\model;

class RecoverPassForm extends model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Requerido'],
            ['email', 'string', 'min' => 8, 'max' => 100, 'tooShort' => 'Mínimo 8 caracteres', 'tooLong' => 'Máximo 100 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
        ];
    }
}