 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = ($status == 1) ? "Modificar Carrera" : "Nueva Carrera";
$this->params["breadcrumbs"][] = ["label" => "Carrera", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$action = ($status == 1) ? "update" : "store";

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => true,
    "action" => $action
]);
?>
<?= Yii::$app->view->renderFile("@app/views/errors/error.php", ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading"><?= $this->title ?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "cve_carrera")->input("text", ["maxlength" => 10, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "desc_carrera")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "no_semestres")->input("text", ["maxlength" => 2, "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <?= $form->field($model, "plan_estudios")->input("text", ["maxlength" => 30, "autocomplete" => "off"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["carrera/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "idcarrera")->hiddenInput(["value"=> $model->idcarrera, "readonly" => true])->label(false) ?>
<?php $form->end() ?>