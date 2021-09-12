<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_carreras".
 *
 * @property int $idcarrera
 * @property string $cve_carrera
 * @property string $desc_carrera
 * @property int|null $no_semestres
 * @property string|null $plan_estudios
 *
 * @property Estudiantes[] $estudiantes
 * @property Grupos[] $grupos
 * @property Semestres[] $semestres
 * @property CatMaterias[] $idmaterias
 */
class CatCarreras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_carreras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cve_carrera', 'desc_carrera'], 'required'],
            [['no_semestres'], 'integer'],
            [['cve_carrera'], 'string', 'max' => 10],
            [['desc_carrera'], 'string', 'max' => 45],
            [['plan_estudios'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcarrera' => 'Idcarrera',
            'cve_carrera' => 'Cve Carrera',
            'desc_carrera' => 'Desc Carrera',
            'no_semestres' => 'No Semestres',
            'plan_estudios' => 'Plan Estudios',
        ];
    }

    /**
     * Gets query for [[Estudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantes()
    {
        return $this->hasMany(Estudiantes::className(), ['idcarrera' => 'idcarrera']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupos::className(), ['idcarrera' => 'idcarrera']);
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasMany(Semestres::className(), ['idcarrera' => 'idcarrera']);
    }

    /**
     * Gets query for [[Idmaterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmaterias()
    {
        return $this->hasMany(CatMaterias::className(), ['idmateria' => 'idmateria'])->viaTable('semestres', ['idcarrera' => 'idcarrera']);
    }
}
