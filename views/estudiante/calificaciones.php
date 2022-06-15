<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Historial Calificaciones';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>
<?php
$f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("estudiante/calificaciones"),
    "enableClientValidation" => true
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Historial de calificaciones</div>
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
                            <th>Calificaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row['idestudiante'] ?></td>
                            <td><?= $row['nombre_estudiante'] ?></td>
                            <td><?= $row['desc_carrera'] ?></td>
                            <td><?= $row['desc_ciclo'] ?></td>
                            <td><?= Html::a("Calificaciones", ["/estudiante/calificacionesporciclo=".$row["idestudiante"]."=".$row["idciclo"]], ["class" => "calificaciones btn btn-success", "data-toggle" => "modal", "data-target" => "#grupos"]) ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $f->end() ?>

<div class="modal fade" id="grupos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="classModalLabel">Historial de calificaciones</h4>
            </div>
            <div class="modal-body">
                <div id="lista_alumnos"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php if(count($model) == 0 && $status == 1): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se encontró información relacionada al No. Control <?= $form->buscar?>
    </div>
<?php endif ?>

<?php
$this->registerJs('
    $(".calificaciones").on("click", function(e) {
        e.preventDefault();

        var valor = $(this).attr("href");
        var url = valor.split("=")[0];
        var idestudiante = valor.split("=")[1];
        var idciclo = valor.split("=")[2];

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idestudiante": idestudiante,
                "idciclo": idciclo
            },
            beforeSend: function() {
                $("#lista_alumnos").empty();
            },
            success: function(respuesta) {
                $("#lista_alumnos").html(respuesta);
            }
        });
    });
');
?>