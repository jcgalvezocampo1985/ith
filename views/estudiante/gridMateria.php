<?php

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use app\models\Materia;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
/*
$query = new \yii\db\Query();
$query = "SELECT
            grupos.idgrupo,
	        grupos.idmateria,
	        cat_materias.desc_materia,
	        cat_materias.creditos,
	        grupos.num_semestre,
            ciclo.desc_ciclo,
            grupos.desc_grupo
          FROM
    	    grupos
	      INNER JOIN cat_materias ON grupos.idmateria = cat_materias.idmateria
          INNER JOIN ciclo ON grupos.idciclo = ciclo.idciclo 
          WHERE
    	    grupos.idcarrera = :idcarrera
          AND
            grupos.idciclo = :idciclo
          AND
            grupos.idgrupo NOT IN ((
		        SELECT
			        idgrupo
		        FROM
			        horario_estudiante_v 
		        WHERE
			        idestudiante = :idestudiante AND idciclo = :idciclo 
		    ))
          ORDER BY
	        grupos.num_semestre DESC,
	        cat_materias.desc_materia ASC";

$dataProvider = new ArrayDataProvider([
    'allModels' => Yii::$app->db->createCommand($query)
                                ->bindValue(':idestudiante', 201240034)
                                ->bindValue(':idciclo', 2)
                                ->bindValue(':idcarrera', 2)
                                ->queryAll(),
    'pagination' => [
        'pageSize' => 10
    ],
    'sort' => [
        'attributes' => [
            'idgrupo',
            'idmateria',
            'desc_materia',
            'creditos',
            'num_semestre',
            'desc_ciclo',
            'desc_grupo'
        ],
        'defaultOrder' => [
            'idgrupo' => SORT_ASC,
            'idmateria' => SORT_ASC,
            'desc_materia' => SORT_ASC,
            'creditos' => SORT_ASC,
            'num_semestre' => SORT_ASC,
            'desc_ciclo' => SORT_ASC,
            'desc_grupo' => SORT_ASC
        ]
    ]
]);*/
?>
<div class="panel panel-primary">
    <div class="panel-heading">Asignar materia</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
    	                        'idmateria',
                                'cve_materia',
                                [
                                    'attribute' => 'desc_materia',
                                    'label' => 'Materia'
                                ],
    	                        'creditos',
	                            'fecha_registro',
                                'fecha_actualizacion',
                                'cve_estatus'
                            ]
                        ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>