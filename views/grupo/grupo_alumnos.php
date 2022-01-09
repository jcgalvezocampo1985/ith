<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Profesores";
$this->params["breadcrumbs"][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">Profesores</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <h4>Ciclo: <small><?= $model[0]["desc_ciclo"] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Carrera: <small><?= $model[0]["desc_carrera"] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Materia: <small><?= $model[0]["desc_materia"] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Grupo: <small><?= $model[0]["desc_grupo"] ?></small></h4>
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
                                <th>Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($model as $row):
                            $promedio = $row["promedio"];
                            $color = "";
                            if($promedio == "NA" || $promedio == "N/A"){
                                $color = "bg-danger text-danger";
                            }else if($promedio >= 70){
                                $color = "bg-success text-success";
                            }

                        ?>
                            <tr>
                                <td><?= $row["idestudiante"] ?></td>
                                <td><?= $row["nombre_estudiante"] ?></td>
                                <td class="<?= $color ?>"><?= $row["promedio"] ?></td>
                            </tr>
                        <?php endforeach ?>
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