<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Horario';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>
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
        <div class="row">
            <div class="col-md-4">
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "No. Control"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
            </div>
        </div>
        <div class="row">
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
                            <td><a href="<?= Url::toRoute(['reporte/horario/', 'id' => $row['idestudiante'], 'idciclo' => $row['idciclo']]) ?>" class="btn btn-success" role="button">Descargar</a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $f->end() ?>

<?php if(count($model) == 0 && $status == 1): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se encontró información relacionada al No. Control <?= $form->buscar ?>
    </div>
<?php endif ?>