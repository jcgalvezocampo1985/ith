<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profesores';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>

<div class="panel panel-primary">
    <div class="panel-heading">Profesores</div>
    <div class="panel-body">
        <div class="col-md-12">
            <hr width="100%">
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th>Carrera</th>
                        <th>Grupo</th>
                        <th>Aula</th>
                        <th>Materia</th>
                        <th>Créditos</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($model as $row):
                    $l = ($row['lunes']) ? explode("-", $row['lunes']) : "";
                    $m = ($row['martes']) ? explode("-", $row['martes']) : "";
                    $m1 = ($row['miercoles']) ? explode("-", $row['miercoles']) : "";
                    $j = ($row['jueves']) ? explode("-", $row['jueves']) : "";
                    $v = ($row['viernes']) ? explode("-", $row['viernes']) : "";
                    $s = ($row['sabado']) ? explode("-", $row['sabado']) : "";
                    $lunes = ($row['lunes']) ? $l[0]."-\n".$l[1] : "";
                    $martes = ($row['martes']) ? $m[0]."-\n".$m[1] : "";
                    $miercoles = ($row['miercoles']) ? $m1[0]."-\n".$m1[1] : "";
                    $jueves = ($row['jueves']) ? $j[0]."-\n".$j[1] : "";
                    $viernes = ($row['viernes']) ? $v[0]."-\n".$v[1] : "";
                    $sabado = ($row['sabado']) ? $s[0]."-\n".$s[1] : "";
                    ?>
                    <tr>
                        <td><?= $row['desc_carrera'] ?></td>
                        <td><?= $row['desc_grupo'] ?></td>
                        <td><?= $row['aula'] ?></td>
                        <td><?= $row['desc_materia'] ?></td>
                        <td><?= $row['creditos'] ?></td>
                        <td><?= $lunes ?></td>
                        <td><?= $martes ?></td>
                        <td><?= $miercoles ?></td>
                        <td><?= $jueves ?></td>
                        <td><?= $viernes ?></td>
                        <td><?= $sabado ?></td>
                        <td style="min-width: 90px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs">Acción</button>
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $row['idgrupo'] ?>" class="idgrupo" data-toggle="modal" data-target="#grupos" id="idgrupo">Lista</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="grupos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="classModalLabel">Lista de alumnos</h4>
            </div>
            <div class="modal-body">
                <div id="lista_alumnos"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>