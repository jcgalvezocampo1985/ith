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
                                <th>T1</th>
                                <th>T2</th>
                                <th>T3</th>
                                <th>T4</th>
                                <th>T5</th>
                                <th>T6</th>
                                <th>T7</th>
                                <th>T8</th>
                                <th>T9</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($model as $row):
                            $c1 = ($row['s1'] != "") ? $row['s1'] : $row['p1'];
                            $c2 = ($row['s2'] != "") ? $row['s2'] : $row['p2'];
                            $c3 = ($row['s3'] != "") ? $row['s3'] : $row['p3'];
                            $c4 = ($row['s4'] != "") ? $row['s4'] : $row['p4'];
                            $c5 = ($row['s5'] != "") ? $row['s5'] : $row['p5'];
                            $c6 = ($row['s6'] != "") ? $row['s6'] : $row['p6'];
                            $c7 = ($row['s7'] != "") ? $row['s7'] : $row['p7'];
                            $c8 = ($row['s8'] != "") ? $row['s8'] : $row['p8'];
                            $c9 = ($row['s9'] != "") ? $row['s9'] : $row['p9'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $row['num_semestre'] ?></td>
                            <td><?= $row['desc_materia'] ?></td>
                            <td class="text-center"><?= $row['creditos'] ?></td>
                            <td class="<?= ($c1 == "NA") ? "bg-danger text-danger" : (($c1 >= 70) ? "bg-success text-success" : "") ?>"><?= $c1 ?></td>
                            <td class="<?= ($c2 == "NA") ? "bg-danger text-danger" : (($c2 >= 70) ? "bg-success text-success" : "") ?>"><?= $c2 ?></td>
                            <td class="<?= ($c3 == "NA") ? "bg-danger text-danger" : (($c3 >= 70) ? "bg-success text-success" : "") ?>"><?= $c3 ?></td>
                            <td class="<?= ($c4 == "NA") ? "bg-danger text-danger" : (($c4 >= 70) ? "bg-success text-success" : "") ?>"><?= $c4 ?></td>
                            <td class="<?= ($c5 == "NA") ? "bg-danger text-danger" : (($c5 >= 70) ? "bg-success text-success" : "") ?>"><?= $c5 ?></td>
                            <td class="<?= ($c6 == "NA") ? "bg-danger text-danger" : (($c6 >= 70) ? "bg-success text-success" : "") ?>"><?= $c6 ?></td>
                            <td class="<?= ($c7 == "NA") ? "bg-danger text-danger" : (($c7 >= 70) ? "bg-success text-success" : "") ?>"><?= $c7 ?></td>
                            <td class="<?= ($c8 == "NA") ? "bg-danger text-danger" : (($c8 >= 70) ? "bg-success text-success" : "") ?>"><?= $c8 ?></td>
                            <td class="<?= ($c9 == "NA") ? "bg-danger text-danger" : (($c9 >= 70) ? "bg-success text-success" : "") ?>"><?= $c9 ?></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>