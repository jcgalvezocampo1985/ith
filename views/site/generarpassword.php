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
    <div class="panel-heading">Generar Password</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "curp")->input("text", ["maxlength" => 20]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Generar", ["class" => "btn btn-primary"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
             <h4><span class="label label-success"><?= $password ?></span></h4>
        </div>
    </div>
</div>
<?php $form->end() ?>