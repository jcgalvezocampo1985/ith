<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'ITH';

?>

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

<div class="panel panel-primary">
    <div class="panel-heading">Boleta de calificación</div>
    <div class="panel-body">
        <hr width="100%">
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Ciclo</th>
                    <th>Boleta</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model as $row): ?>
                <tr>
                    <td><?= $row['idestudiante'] ?></td>
                    <td><?= $row['nombre_estudiante'] ?></td>
                    <td><?= $row['desc_carrera'] ?></td>
                    <td><?= $row['desc_ciclo'] ?></td>
                    <td><a href="<?= Url::toRoute(['reporte/boleta/', 'id' => $row['idestudiante']]) ?>" class="btn btn-success" href="#" role="button">Descargar</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>