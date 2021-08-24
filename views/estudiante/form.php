<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "Nuevo Estudiante";
$this->params["breadcrumbs"][] = ["label" => "Estudiantes", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$estado = ($status == 1) ? true : false ;

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => false,
    "enableAjaxValidation" => true
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Nuevo Estudiante</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idestudiante")->input("text", ["maxlength" => 15, "readonly" => $estado]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "nombre_estudiante")->input("text", ["maxlength" => 200]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "email")->input("email", ["maxlength" => 45, "readonly" => $estado]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "sexo")->dropDownList($sexo, ["prompt" => ""]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "num_semestre")->dropDownList($num_semestre, ["prompt" => ""])?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idcarrera")->dropDownList($carrera, ["prompt" => ""]) ?>
                </div>
            </div>
        </div>
        <div class="row">
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
                    <?= Html::a("Regresar", ["estudiante/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "estado")->hiddenInput(["value"=> $status])->label(false); ?>
<?php $form->end() ?>
<?php if($msg){ ?>
    <div class="alert alert-success" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Mensaje:</span>
        <?= $msg ?>
    </div>
<?php } ?>