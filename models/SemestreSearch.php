<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Semestre;

/**
 * SemestreSearch represents the model behind the search form of `app\models\Semestre`.
 */
class SemestreSearch extends Semestre
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcarrera', 'idmateria', 'num_semestre'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Semestre::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcarrera' => $this->idcarrera,
            'idmateria' => $this->idmateria,
            'num_semestre' => $this->num_semestre,
        ]);

        return $dataProvider;
    }
}
