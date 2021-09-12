<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Semestre */

$this->title = 'Update Semestre: ' . $model->idcarrera;
$this->params['breadcrumbs'][] = ['label' => 'Semestres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcarrera, 'url' => ['view', 'idcarrera' => $model->idcarrera, 'idmateria' => $model->idmateria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semestre-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
