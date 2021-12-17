<?php

namespace app\models\ciclo;
use Yii;
use yii\db\ActiveRecord;

class Ciclo extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "ciclo";
    }
}