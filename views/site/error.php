<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$exception = Yii::$app->getErrorHandler()->exception;
    $errorCode = $exception->statusCode;
    if($errorCode == "404"){
        $img = '404.png';
        $message = "Lo sentimos la pagina que busca ha cambiado o ya no existe";
    }else if($errorCode == "403"){
        $img = '403.png';
        $message = "Lo sentimos usted no tiene permitido entrar a esta página";
    }
?>
<div class="site-error">
    <div>
        <?= Html::img('@web/img/'.$img, ['alt' => 'My logo', 'style' => 'display:block;margin:auto;']) ?>
    </div>
    <div class="alert alert-danger">
        <h3 class="text-center"><?= nl2br(Html::encode($message)) ?></h3>
    </div>
</div>