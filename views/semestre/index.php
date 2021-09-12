<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SemestreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Semestres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semestre-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Semestre', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcarrera',
            'idmateria',
            'num_semestre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
