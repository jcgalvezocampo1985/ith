<?php

namespace app\models;

use Yii;
use yii\base\model;
use yii\data\ActiveDataProvider;
use app\models\Materia;

class MateriaSearch extends Materia
{
    public $idmateria;
    public $cve_materia;
    public $desc_materia;
    public $creditos;
    public $fecha_registro;
    public $fecha_actualizacion;
    public $cve_estatus;

    public function rules()
    {
        return [
            [["idmateria"], "integer"],
            [["cve_materia", "desc_materia", "creditos", "fecha_registro", "fecha_actualizacion", "cve_estatus"], "safe"]
        ];
    }

    public function search($params)
    {
        $query = Materia::find();

        $dataProvider = new ActiveDataProvider([
            "query" => $query
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
            "idmateria" => $this->idmateria
        ]);

        $query->andFilterWhere(["like", "cve_materia", $this->cve_materia])
              ->andFilterWhere(["like", "desc_materia", $this->desc_materia])
              ->andFilterWhere(["like", "creditos", $this->creditos])
              ->andFilterWhere(["like", "fecha_registro", $this->fecha_registro])
              ->andFilterWhere(["like", "fecha_actualizacion", $this->fecha_actualizacion])
              ->andFilterWhere(["like", "cve_estatus", $this->cve_estatus]);

        return $dataProvider;
    }
}