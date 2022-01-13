<?php

namespace app\models\estudiante;
use Yii;
use yii\db\ActiveRecord;

class Estudiante extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "estudiantes";
    }
}