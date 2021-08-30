<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "Generar Password";
$this->params["breadcrumbs"][] = ["label" => "Profesores", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$form = ActiveForm::begin([
    "method" => "post"
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Generar Password</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="curp" id="curp" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Generar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["profesor/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <h4><span class="label label-warning"><?= $curp ?></span></h4>
        </div>
    </div>
</div>
<?php $form->end() ?>