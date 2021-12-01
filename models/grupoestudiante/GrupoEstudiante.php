<?php

namespace app\models\grupoestudiante;
use Yii;
use yii\db\ActiveRecord;

class GrupoEstudiante extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "grupos_estudiantes";
    }
}