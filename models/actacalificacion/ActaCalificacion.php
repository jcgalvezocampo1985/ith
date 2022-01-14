<?php

namespace app\models\actacalificacion;

use Yii;
use yii\db\ActiveRecord;

class ActaCalificacion extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "actas_calificaciones";
    }
}