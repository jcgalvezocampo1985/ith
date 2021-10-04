<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = "Nuevo Profesor";
$this->params["breadcrumbs"][] = ["label" => "Profesores", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$estado = ($status == 1) ? true : false;
$action = ($status == 1) ? "update" : "store";

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => false,
    "enableAjaxValidation" => true,
    "action" => $action
]);
?>
<?= Yii::$app->view->renderFile("@app/views/errors/error.php", ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Nuevo Profesor</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "curp")->input("text", ["maxlength" => 20]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "nombre_profesor")->input("text", ["maxlength" => 45]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "apaterno")->input("text", ["maxlength" => 45]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "amaterno")->input("text", ["maxlength" => 45]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "fecha_registro")
                             ->widget(DatePicker::className(),[
                                "dateFormat" => "yyyy-MM-dd",
                                "clientOptions" => [
                                    "yearRange" => "-115:+0",
                                    "changeYear" => true
                                ],
                                "options" => [
                                    "class" => "form-control",
                                    "maxlength" => 19,
                                    "autocomplete" => "off",
                                    "readonly" => true
                                ]
                        ])
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "fecha_actualizacion")
                             ->widget(DatePicker::className(),[
                                "dateFormat" => "yyyy-MM-dd",
                                "clientOptions" => [
                                    "yearRange" => "-115:+0",
                                    "changeYear" => true
                                ],
                                "options" => [

                                    "class" => "form-control",
                                    "maxlength" => 19,
                                    "autocomplete" => "off",
                                    "readonly" => true
                                ]
                             ])
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "cve_estatus")->input("text", ["maxlength" => 3]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["profesor/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "estado")->hiddenInput(["value"=> $status])->label(false); ?>
<?php $form->end() ?>