<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = ($status == 1) ? "Modificar Profesor" : "Nuevo Profesor";
$this->params["breadcrumbs"][] = ["label" => "Profesores", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

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
                    <?php $bloqueado_curp = ($model->idprofesor != "") ? true : false; ?>
                    <?= $form->field($model, "curp")->input("text", ["maxlength" => 20, "autocomplete" => "off", "readonly" => $bloqueado_curp]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "nombre_profesor")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "apaterno")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "amaterno")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <?= $form->field($model, "cve_estatus")->dropDownList($clave_estatus)?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php $email = ($model->idprofesor != "") ? $usuario->email : ""; ?>
                    <?= $form->field($model, "email")->input("email", ["maxlength" => 100, "autocomplete" => "off", "value" => $email]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php $password = ($model->idprofesor != "") ? $model->curp : ""; ?>
                    <?= $form->field($model, "password")->input("password", ["maxlength" => 15, "autocomplete" => "off", "value" => $password]) ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["profesor/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "estado")->hiddenInput(["value"=> $status, "readonly" => true])->label(false) ?>
<?= $form->field($model, "idprofesor")->hiddenInput(["value"=> $model->idprofesor, "readonly" => true])->label(false) ?>
<?= $form->field($model, "fecha_registro")->hiddenInput(["value" => ($model->fecha_registro == '') ? date('Y-m-d h:i:s') : $model->fecha_registro, "readonly" => true])->label(false) ?>
<?= $form->field($model, "fecha_actualizacion")->hiddenInput(["value" => ($model->idprofesor != '') ? date('Y-m-d h:i:s') : $model->fecha_actualizacion, "readonly" => true])->label(false) ?>
<?php $form->end() ?>