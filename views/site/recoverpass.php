<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Login";
$this->params["breadcrumbs"][] = $this->title;

$form = ActiveForm::begin([
            "method" => "post",
            "enableClientValidation" => true
        ]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Recuperar Contraseña</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "email")->input("email") ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= Html::submitButton('Recuperar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a("Login", ["site/login"], ["class" => "btn btn-success"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php if($msg !== null): ?>
    <div class="alert alert-success" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Mensaje:</span>
        <?= $msg ?>
    </div>
<?php endif ?>
