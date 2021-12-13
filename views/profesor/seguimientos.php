<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Seguimientos";
$this->params["breadcrumbs"][] = $this->title;
?>
<?= Yii::$app->view->renderFile('@app/views/errors/error.php', ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Seguimientos</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("profesor/seguimientos"),
                    "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["profesor/seguimientos"], ["class" => "btn btn-info"]) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Profesor</th>
                            <th class="text-center">Seguimiento 1</th>
                            <th class="text-center">Seguimiento 2</th>
                            <th class="text-center">Seguimiento 3</th>
                            <th class="text-center">Seguimiento 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row->apaterno." ".$row->amaterno." ".$row->nombre_profesor ?></td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento1" id="seguimiento1" class="seguimiento1" value="1">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento2" id="seguimiento2" class="seguimiento2" value="2">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento3" id="seguimiento3" class="seguimiento3" value="3">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento4" id="seguimiento4" class="seguimiento4" value="4">
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= LinkPager::widget(["pagination" => $pages]); ?>
<?php

$this->registerJs('$(document).ready(function(){
    $(".seguimiento").on("click", function(e) {
        e.preventDefault();

        let valor_seguimiento = $(this).val();

/*        
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
        });*/
    });
})');
?>