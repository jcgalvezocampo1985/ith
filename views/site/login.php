<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Acceso al Sistema</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?= $form->field($model, 'curp')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?= Html::submitButton('Acceder', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        <!--Html::a("Registrarse", ["site/register"], ["class" => "btn btn-success"])
                        Html::a("Recuperar Contraseña", ["site/recoverpass"], ["class" => "btn btn-warning"]) -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
