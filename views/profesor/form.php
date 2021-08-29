<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "Nuevo Profesor";
$this->params["breadcrumbs"][] = ["label" => "Profesores", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => false,
    "enableAjaxValidation" => true
]);
?>
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
                    <?= $form->field($model, "fecha_registro")->input("fecha_registro", ["maxlength" => 19]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "fecha_actualizacion")->input("fecha_actualizacion", ["maxlength" => 19]) ?>
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
<?php $form->end() ?>
<?php if($msg){ ?>
    <div class="alert alert-success" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Mensaje:</span>
        <?= $msg ?>
    </div>
<?php } ?>