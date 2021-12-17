<?php

namespace app\models\grupo;
use Yii;
use yii\db\ActiveRecord;

class Grupo extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "grupos";
    }
}