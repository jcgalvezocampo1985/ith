<?php

namespace app\models\grupoestudiante;

use Yii;
use yii\base\Model;
//use yii\data\ActiveDataProvider;
//use yii\data\ArrayDataProvider;

class GrupoEstudianteSearch extends Model
{
    public $idgrupo;
    public $idmateria;
    public $desc_materia;
    public $creditos;
    public $num_semestre;
    public $desc_ciclo;
    public $desc_grupo;

    public function rules()
    {
        return [
            [["idgrupo", "idmateria"], "integer"],
            [["desc_materia", "creditos", "num_semestre", "desc_ciclo", "desc_grupo"], "safe"]
        ];
    }

    /*
    public function search($params)
    {
        $query = (new \yii\db\Query())->from(["a" => "grupos"])
                                      ->select([
                                            "a.idgrupo",
	                                        "a.idmateria",
	                                        "a.desc_grupo",
	                                        "a.num_semestre",
                                            "b.desc_materia",
                                            "b.creditos",
                                            "c.desc_ciclo"
                                        ])
                                      ->innerJoin(["b" => "cat_materias"], "a.idmateria = b.idmateria")
                                      ->innerJoin(["c" => "ciclo"], "a.idciclo = c.idciclo")
                                      ->where(["a.idcarrera" =>  2, "a.idciclo" => 2])
                                      ->andFilterWhere(["NOT IN", "a.idgrupo", "SELECT
			                                                                        idgrupo
		                                                                        FROM
			                                                                        horario_estudiante_v
		                                                                        WHERE
			                                                                        idestudiante = 201240034
                                                                                AND idciclo = 2"]);

        $dataProvider = new ActiveDataProvider([
            "query" => $query,
            "pagination" => [
                "pageSize" => 5,
            ],
            "sort" => [
                "attributes" => [
                    "idgrupo",
                    "idmateria",
                    "desc_materia",
                    "creditos",
                    "num_semestre",
                    "desc_ciclo",
                    "desc_grupo"
                ],
                "defaultOrder" => [
                    "desc_ciclo" => SORT_DESC,
                    "num_semestre" => SORT_DESC,
                    "desc_materia" => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere(["like", "b.desc_materia", $this->desc_materia]);
        
        //$query->andFilterWhere(["like", "a.desc_grupo", $this->desc_grupo])
              //->andFilterWhere(["like", "a.num_semestre", $this->num_semestre])
              //->andFilterWhere(["like", "b.desc_materia", $this->desc_materia])
              //->andFilterWhere(["like", "b.creditos", $this->creditos])
              //->andFilterWhere(["like", "c.desc_ciclo", $this->desc_ciclo]);
        
        return $dataProvider;
    }
    */
}