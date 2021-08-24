<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "Registro";
$this->params["breadcrumbs"][] = ["label" => "Usuarios", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => false,
    "enableAjaxValidation" => true
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Nuevo Usuario</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "nombre_usuario")->input("text", ["maxlength" => 45]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "curp")->input("text", ["maxlength" => 20]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "email")->input("email", ["maxlength" => 100]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "password")->input("password", ["maxlength" => 250]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "password_repeat")->input("password", ["maxlength" => 250]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-primary"]) ?>
                    <?= Html::a("Login", ["site/login"], ["class" => "btn btn-success"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $form->end() ?>