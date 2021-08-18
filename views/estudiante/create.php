<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<a href="<?= Url::toRoute('estudiante/index') ?>">Alumnos</a>

<h1>Nuevo Estudiante</h1>
<?php
$form = ActiveForm::begin([
    "method" => "post",
    "enableClientValidation" => true
]);
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "idestudiante")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "nombre_estudiante")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "email")->input("email") ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "sexo")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "num_semestre")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "fecha_registro")->input("text") ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "fecha_actualizacion")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "idcarrera")->input("text") ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->field($model, "cve_estatus")->input("text") ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitInput("Guardar", ["class" => "btn btn-primary"]) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>