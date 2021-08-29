<?php

use yii\helpers\Html;
$idciclo = $_GET["idciclo"];
?>
<div class="panel panel-primary">
    <div class="panel-heading">Lista de alumnos</div>
    <div class="panel-body">
        <?php
        if(count($model) > 0){
            echo Html::a("Descargar Lista", ["reporte/listaalumnos?idgrupo=$idgrupo&idciclo=$idciclo"], ["class" => "btn btn-success"]);
        }
        ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Opción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model as $row): ?>
                <tr>
                    <td><?= $row['idestudiante'] ?></td>
                    <td><?= $row['nombre_estudiante'] ?></td>
                    <td><?= $row['sexo'] ?></td>
                    <td><?= $row['desc_opcion_curso'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
