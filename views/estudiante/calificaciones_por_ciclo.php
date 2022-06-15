<?php
$this->title = "Historial de calificaciones";
$this->params["breadcrumbs"][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">Historial de calificaciones</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <h4>Ciclo: <small><?= $model[0]["desc_ciclo"] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Carrera: <small><?= $model[0]["desc_carrera"] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>No. Control: <small><?= $model[0]['idestudiante'] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Estudiante: <small><?= $model[0]['nombre_estudiante'] ?></small></h4>
            </div>
        </div>
        <hr width="100%">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Semestre</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Opción</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td class="text-center"><?= $row['num_semestre'] ?></td>
                            <td><?= $row['desc_materia'] ?></td>
                            <td class="text-center"><?= $row['creditos'] ?></td>
                            <td><?= $row['desc_opcion_curso'] ?></td>
                            <td class="text-center <?= ($row['calificacion'] >= "70") ? "bg-success text-success" : "bg-danger text-danger" ?>"><?= $row["calificacion"] ?></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>