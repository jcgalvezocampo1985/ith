<?php

namespace app\models\login;
use Yii;
use yii\db\ActiveRecord;

class Rol extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'cat_roles';
    }
    
}