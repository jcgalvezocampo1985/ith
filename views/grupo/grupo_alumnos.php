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
        <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("profesor/horarioconsulta"),
                    "enableClientValidation" => true
                ]);
        ?>
        <div class="row">
            <div class="col-md-4">
                <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo", "options" => [$idciclo=>["selected" => true]]]) ?>
            </div>
            <div class="col-md-4">
                <?= $f->field($form, "idprofesor")->dropDownList($profesores, ["prompt" => "Profesor", "options" => [$idprofesor=>["selected" => true]]]) ?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h4>Ciclo:<br /><span class="label label-warning"><?= $ciclo_actual ?></span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a('Refrescar', ['profesor/horarioconsulta'], ['class' => 'btn btn-info']) ?>
                <?php if($idciclo): ?>
                <?= Html::a("Reporte Calificaciones", ["reporte/listaalumnoscalificacionprofesor?idprofesor=".$idprofesor."&idciclo=".$idciclo], ["target" => "_parent", "class" => "btn btn-warning"]) ?>
                <?php endif ?>
            </div>
        </div>
        <?php $f->end() ?>
        <hr width="100%">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Grupo</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
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