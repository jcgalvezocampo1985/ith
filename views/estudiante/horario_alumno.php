<?php
use yii\helpers\Html;
?>
<div class="panel panel-primary">
    <div class="panel-heading">Horario</div>
    <div class="panel-body">
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Carrera</th>
                            <th>Periodo</th>
                            <th>Boleta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row['idestudiante'] ?></td>
                            <td><?= $row['nombre_estudiante'] ?></td>
                            <td><?= $row['desc_carrera'] ?></td>
                            <td><?= $row['desc_ciclo'] ?></td>
                            <td><?= Html::a("Descargar", ["reporte/horario/", "id" => $row["idestudiante"], "idciclo" => $row["idciclo"]], ["class" => "btn btn-success"]) ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>