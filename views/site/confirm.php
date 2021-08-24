<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
$this->title = "Registro";
$this->params["breadcrumbs"][] = ["label" => "Usuarios", "url" => ["register"]];
$this->params["breadcrumbs"][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">Nuevo Usuario</div>
    <div class="panel-body">
        <?php if($msg !== null): ?>
            <div class="alert alert-success" role="warning">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Mensaje:</span>
                <?= $msg ?>
            </div>
        <?php endif ?>
    </div>
</div>
