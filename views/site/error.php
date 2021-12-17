<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$exception = Yii::$app->getErrorHandler()->exception;
    $errorCode = $exception->statusCode;
    switch ($errorCode){
        case "404":
            $message = "Ups lo sentimos creo que la pagina que busca ha cambiado o ya no existe";            
        case "403":
            $message = "Lo sentimos usted no tiene permitido entrar a esta página";
    }  
?>
<div class="site-error">

    <h1><?= Html::encode("Error: #" . $errorCode) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
