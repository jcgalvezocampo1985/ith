<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div class="panel panel-primary">
    <div class="panel-heading">Asignar materia</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                    <?php Pjax::begin([
                        'enablePushState' => false,
                        'enableReplaceState' => false
                    ]); ?>
                    <?= GridView::widget([
                            //'id' => 'alumno_horario_agregar',
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'attribute' => 'desc_ciclo',
                                    'label' => 'Ciclo',
                                    'filter' => false
                                ],
                                [
                                    'attribute' => 'desc_grupo',
                                    'label' => 'Grupo',
                                    'filter' => false
                                ],
                                [
                                    'attribute' => 'desc_materia',
                                    'label' => 'Materia'
                                ],
                                [
                                    'attribute' => 'creditos',
                                    'label' => 'Créditos',
                                    'filter' => false
                                ],
                                [
                                    'attribute' => 'num_semestre',
                                    'label' => 'Semestre',
                                    'filter' => false
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}'
                                ],
                            ]
                        ]);
                    ?>
                    <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>