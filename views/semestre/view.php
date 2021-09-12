<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Semestre */

$this->title = $model->idcarrera;
$this->params['breadcrumbs'][] = ['label' => 'Semestres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="semestre-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idcarrera' => $model->idcarrera, 'idmateria' => $model->idmateria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idcarrera' => $model->idcarrera, 'idmateria' => $model->idmateria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcarrera',
            'idmateria',
            'num_semestre',
        ],
    ]) ?>

</div>
