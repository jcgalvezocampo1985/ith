<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Semestre */

$this->title = 'Create Semestre';
$this->params['breadcrumbs'][] = ['label' => 'Semestres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semestre-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
