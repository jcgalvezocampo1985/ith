<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Evaluación Docente';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Yii::$app->view->renderFile("@app/views/errors/error.php", ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Evaluación Docente</div>
    <div class="panel-body">
        <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("evaluaciondocente/index"),
                    "enableClientValidation" => true
                ]);
        ?>
        <div class="row">
            <div class="col-md-4">
                <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo", "options" => [$idciclo=>["selected" => true]]]) ?>
            </div>
            <div class="col-md-4">
                <?= $f->field($form, "reporte")->dropDownList($reportes, ["prompt" => "Reporte"]) ?>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton("Descargar", ["class" => "btn btn-primary"]) ?>
            </div>
        </div>
        <?php $f->end() ?>
        <hr width="100%">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div>