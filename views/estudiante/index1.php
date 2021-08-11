<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'ITH';

?>

<a href="<?= Url::toRoute('estudiante/create') ?>">Nuevo</a>

<?php
$f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("estudiante/index"),
    "enableClientValidation" => true
]);
?>

<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<h3><?php $search ?></h3>

<h1>Estudiantes</h1>
<table class="table table-bordered">
    <tr>
        <th>No. Control</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Sexo</th>
        <th>Carrera</th>
        <th>Semestre</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($model as $row): ?>
        <tr>
            <td><?= $row->idestudiante ?></td>
            <td><?= $row->nombre_estudiante ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->sexo ?></td>
            <td><?= $row->idcarrera ?></td>
            <td><?= $row->num_semestre ?></td>
            <td><a href="#">Editar</a></td>
            <td><a href="#">Eliminar</a></td>
        </tr>
    <?php endforeach ?>
</table>