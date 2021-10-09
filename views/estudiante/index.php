<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Estudiantes";
$this->params["breadcrumbs"][] = $this->title;
?>
<?= Yii::$app->view->renderFile('@app/views/errors/error.php', ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Estudiantes</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
                $f = ActiveForm::begin([
                        "method" => "get",
                        "action" => Url::toRoute("estudiante/index"),
                        "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["estudiante/index"], ["class" => "btn btn-info"]) ?>
                <?= Html::a("Nuevo Estudiante", ["estudiante/create"], ["class" => "btn btn-info"]) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sexo</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row['idestudiante'] ?></td>
                            <td><?= $row['nombre_estudiante'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['sexo'] ?></td>
                            <td><?= $row['desc_carrera'] ?></td>
                            <td><?= $row['num_semestre'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?= Html::a("Modificar", ["/estudiante/edit?idestudiante=".$row["idestudiante"]]) ?></li>
                                        <li><?= Html::a("Eliminar", ["#"], ["data-toggle" => "modal", "data-target" => "#idestudiante_".$row["idestudiante"].""]) ?></li>
                                        <li><?= Html::a("Boleta", "boletacalificacion=".$row["idestudiante"], ["data-toggle" => "modal", "data-target" => "#boleta_horario", "class" => "boleta_calificacion", "id" => "boleta"]) ?></li>
                                        <li><?= Html::a("Horario", "horarioalumnos=".$row["idestudiante"], ["data-toggle" => "modal", "data-target" => "#boleta_horario", "class" => "boleta_calificacion", "id" => "horario"]) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="idestudiante_<?= $row["idestudiante"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="danger">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Mensaje:</span>
                                            ¿Desea eliminar al estudiante con No. Control <?= $row["idestudiante"] ?>?
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= Html::beginForm(Url::toRoute("estudiante/delete"), "POST") ?>
                                            <input type="hidden" name="idestudiante" value="<?= $row["idestudiante"] ?>">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        <?= Html::endForm() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="boleta_horario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 85% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="classModalLabel"><span id="boleta_horario_header"></span></h4>
            </div>
            <div class="modal-body">
                <span id="boleta_horario_contenido"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?= LinkPager::widget(["pagination" => $pages]); ?>
<?php
$this->registerCss('
    .table-responsive{
        overflow-y: visible !important;
    }
    @media (max-width: 767px){
        .table-responsive .dropdown-menu{
            position: static !important;
        }
    }
    @media (min-width: 768px){
        .table-responsive{
            overflow: inherit;
        }
    }
');

$this->registerJs('$(document).ready(function(){
    $(".boleta_calificacion").on("click", function(e) {
        e.preventDefault();

        let boleta = $(this).attr("id");
        let valor_url = $(this).attr("href");
        let url = valor_url.split("=")[0];
        let idestudiante = valor_url.split("=")[1];
        let titulo = (boleta == "boleta") ? "Boleta de Calificacion" : "Horario del Estudiante"

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idestudiante": idestudiante,
            },
            beforeSend: function() {
                $("#boleta_horario_header, #boleta_horario_contenido").empty();
            },
            success: function(respuesta) {
                $("#boleta_horario_header").html(titulo);
                $("#boleta_horario_contenido").html(respuesta);
            }
        });
    });
})');
?>