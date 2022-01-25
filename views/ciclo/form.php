 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = ($status == 1) ? "Modificar Ciclo" : "Nuevo Ciclo";
$this->params["breadcrumbs"][] = ["label" => "Ciclo", "url" => ["index"]];
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
                    <?= $form->field($model, "desc_ciclo")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "semestre")->input("text", ["maxlength" => 2, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "anio")->input("text", ["maxlength" => 4, "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <?= $form->field($model, "cve_estatus")->input("text", ["maxlength" => 3, "autocomplete" => "off"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["ciclo/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "idciclo")->hiddenInput(["value"=> $model->idciclo, "readonly" => true])->label(false) ?>
<?php $form->end() ?>