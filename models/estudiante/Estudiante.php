<?php

namespace app\models\estudiante;
use Yii;
use yii\db\ActiveRecord;

class Estudiante extends ActiveRecord
{
    public $oldRecord;

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return "estudiantes";
    }

    public function afterFind()
    {
		$this->oldRecord = clone $this;

        return parent::afterFind();	
    }
}