<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_materias".
 *
 * @property int $idmateria
 * @property string $cve_materia
 * @property string $desc_materia
 * @property int $creditos
 * @property string|null $fecha_registro
 * @property string|null $fecha_actualizacion
 * @property string|null $cve_estatus
 *
 * @property Grupo[] $grupos
 * @property Semestre[] $semestres
 * @property CatCarrera[] $idcarreras
 */
class CatMaterias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_materias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cve_materia', 'desc_materia', 'creditos'], 'required'],
            [['creditos'], 'integer'],
            [['fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['cve_materia'], 'string', 'max' => 15],
            [['desc_materia'], 'string', 'max' => 95],
            [['cve_estatus'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmateria' => 'Idmateria',
            'cve_materia' => 'Cve Materia',
            'desc_materia' => 'Desc Materia',
            'creditos' => 'Creditos',
            'fecha_registro' => 'Fecha Registro',
            'fecha_actualizacion' => 'Fecha Actualizacion',
            'cve_estatus' => 'Cve Estatus',
        ];
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['idmateria' => 'idmateria']);
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasMany(Semestre::className(), ['idmateria' => 'idmateria']);
    }

    /**
     * Gets query for [[Idcarreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcarreras()
    {
        return $this->hasMany(CatCarrera::className(), ['idcarrera' => 'idcarrera'])->viaTable('semestres', ['idmateria' => 'idmateria']);
    }
}
