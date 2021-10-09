<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Profesores";
$this->params["breadcrumbs"][] = $this->title;
?>
<?= Yii::$app->view->renderFile('@app/views/errors/error.php', ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Profesores</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("profesor/index"),
                    "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["profesor/index"], ["class" => "btn btn-info"]) ?>
                <?= Html::a("Nuevo Profesor", ["profesor/create"], ["class" => "btn btn-info"]) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row->curp ?></td>
                            <td><?= $row->nombre_profesor ?></td>
                            <td><?= $row->apaterno ?></td>
                            <td><?= $row->amaterno ?></td>
                            <td><?= $row->cve_estatus ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu pull-right"">
                                        <li><?= Html::a("Modificar", ["/profesor/edit?idprofesor=".$row->idprofesor]) ?></li>
                                        <li><?= Html::a("Eliminar", ["#"], ["data-toggle" => "modal", "data-target" => "#idprofesor_".$row->idprofesor.""]) ?></li>
                                        <li><?= Html::a("Horario", "horarioprofesor=".$row["idprofesor"], ["data-toggle" => "modal", "data-target" => "#modal_horario_profesor", "class" => "horario_profesor"]) ?></li>
                                        <li><?= Html::a("Grupos", ["/reporte/boleta?id=".$row["idprofesor"]]) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="idprofesor_<?= $row["idprofesor"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            ¿Desea eliminar al profesor <?= $row->nombre_profesor." ".$row->apaterno." ".$row->amaterno ?>?
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= Html::beginForm(Url::toRoute("profesor/delete"), "POST") ?>
                                            <input type="hidden" name="idprofesor" value="<?= $row["idprofesor"] ?>">
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
<div class="modal fade" id="modal_horario_profesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 85% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="classModalLabel">Horario del Profesor</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idciclo">Ciclo</label>
                            <select name="idciclo" id="idciclo" class="form-control">
                                <?php foreach($ciclos as $row):?>
                                <option value="<?= $row["idciclo"] ?>"><?= $row["desc_ciclo"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <h4>Profesor: <span class="small" id="profesor_nombre"></span></h4>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::a("Buscar", ["horarioprofesorconsulta"], ["id" => "buscar", "class" => "btn btn-primary"]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span id="horario_contenido"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <input type="hidden" name="idprofesor" id="idprofesor" readonly="yes" />
                <input type="hidden" name="ultimo_ciclo" id="ultimo_ciclo" readonly="yes" value="<?= $ultimo_ciclo ?>" />
            </div>
        </div>
    </div>
</div>
<?= LinkPager::widget(["pagination" => $pages]); ?>
<?php
$this->registerCss('
.table-responsive {
  overflow-y: visible !important;
}
@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
        position: static !important;
    }
}
@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
');

$this->registerJs('$(document).ready(function(){
    $(".horario_profesor").on("click", function(e) {
        e.preventDefault();

        let valor_url = $(this).attr("href");
        let url = valor_url.split("=")[0];
        let idprofesor = valor_url.split("=")[1];

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idprofesor": idprofesor,
            },
            beforeSend: function() {
                $("#idprofesor").val("");
                $("#horario_contenido").empty();
            },
            success: function(respuesta) {
                $("#idprofesor").val(idprofesor);
                $("#horario_contenido").html(respuesta);
            }
        });

        $.ajax({
            url: "consultarprofesor",
            type: "GET",
            data: {
                "idprofesor": idprofesor
            },
            beforeSend: function() {
                $("#profesor_nombre").empty();
            },
            success: function(respuesta) {
                $("#profesor_nombre").html(respuesta);
            }
        });
    });

    $("#buscar").on("click", function(e){
        e.preventDefault();

        let url = $(this).attr("href");
        let idciclo = $("#idciclo").val();
        let idprofesor = $("#idprofesor").val();

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idprofesor": idprofesor,
                "idciclo": idciclo,
            },
            beforeSend: function() {
                $("#horario_contenido").empty();
            },
            success: function(respuesta) {
                $("#horario_contenido").html(respuesta);
            }
        });
    });

    $("#modal_horario_profesor").on("hidden.bs.modal", function(e) {
        e.preventDefault;
        let idciclo = $("#ultimo_ciclo").val();

        $("#idciclo").val(idciclo);
    });
})');
?>