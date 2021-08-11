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
<div class="form-group">
    <?= $form->field($model, "idestudiante")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "nombre_estudiante")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "email")->input("email") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "sexo")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "num_semestre")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "fecha_registro")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "fecha_actualizacion")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "idcarrera")->input("text") ?>
</div>
<div class="form-group">
    <?= $form->field($model, "cve_estatus")->input("text") ?>
</div>
<?= Html::submitInput("Guardar", ["class" => "btn btn-primary"]) ?>
<?php $form->end() ?>