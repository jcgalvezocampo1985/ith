<?php

namespace app\models\materia;

use Yii;
use yii\db\ActiveRecord;

class Materia extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "cat_materias";
    }
}