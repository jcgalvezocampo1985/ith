<?php

namespace app\models\profesorseguimiento;
use Yii;
use yii\db\ActiveRecord;

class ProfesorSeguimiento extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "profesores_seguimientos";
    }
}