<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profesores';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">Profesores</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h4>Ciclo:<br /><span class="label label-warning"><?= $ciclo_actual ?></span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
            </div>
        </div>
        <hr width="100%">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Control</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Semestre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCss('
.table-responsive {
  overflow-y: visible !important;
}
@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
        position: static !important;
    }
}
@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
');
?>