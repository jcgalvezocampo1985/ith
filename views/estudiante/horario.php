<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Horario';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>
<h3><?php $search ?></h3>
<?php
$f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("estudiante/horario"),
    "enableClientValidation" => true
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Horario</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?= $f->field($form, "q")->input("search", ["class" => "form-control", "placeholder" => "No. Control"]) ?>
            <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
        </div>
        <div class="col-md-12">
        <hr width="100%">
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th>No. Control</th>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Periodo</th>
                        <th>Horario</th>
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
</div>

<?php $f->end() ?>

<?php if(count($model) == 0 && $status == 1): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se encontró información relacionada al No. Control <?= $form->q ?>
    </div>
<?php endif ?>