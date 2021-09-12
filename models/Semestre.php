<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semestres".
 *
 * @property int $idcarrera
 * @property int $idmateria
 * @property int $num_semestre
 *
 * @property CatCarreras $idcarrera0
 * @property CatMaterias $idmateria0
 */
class Semestre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semestres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcarrera', 'idmateria', 'num_semestre'], 'required'],
            [['idcarrera', 'idmateria', 'num_semestre'], 'integer'],
            [['idcarrera', 'idmateria'], 'unique', 'targetAttribute' => ['idcarrera', 'idmateria']],
            [['idcarrera'], 'exist', 'skipOnError' => true, 'targetClass' => CatCarreras::className(), 'targetAttribute' => ['idcarrera' => 'idcarrera']],
            [['idmateria'], 'exist', 'skipOnError' => true, 'targetClass' => CatMaterias::className(), 'targetAttribute' => ['idmateria' => 'idmateria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcarrera' => 'Idcarrera',
            'idmateria' => 'Idmateria',
            'num_semestre' => 'Num Semestre',
        ];
    }

    /**
     * Gets query for [[Idcarrera0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcarrera0()
    {
        return $this->hasOne(CatCarreras::className(), ['idcarrera' => 'idcarrera']);
    }

    /**
     * Gets query for [[Idmateria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmateria0()
    {
        return $this->hasOne(CatMaterias::className(), ['idmateria' => 'idmateria']);
    }
}
