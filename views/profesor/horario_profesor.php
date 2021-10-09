<?php
use yii\helpers\Html;
?>
<div class="table-responsive">
    <div class="panel panel-primary">
        <div class="panel-heading">Profesores</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Carrera</th>
                            <th>Grupo</th>
                            <th>Materia</th>
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
                    <?php
                    foreach($model as $row):
                        $lunes = $row['lunes'];
                        $martes = $row['martes'];
                        $miercoles = $row['miercoles'];
                        $jueves = $row['jueves'];
                        $viernes = $row['viernes'];
                        $sabado = $row['sabado'];

                        if($row["lunes"] != ""){
                            $lunes1 = explode("-", $row["lunes"]);
                            $lunes = $lunes1[0]."-<br />".$lunes1[1];
                        }
                        if($row["martes"] != ""){
                            $martes1 = explode("-", $row["martes"]);
                            $martes = $martes1[0]."-<br />".$martes1[1];
                        }
                        if($row["miercoles"] != ""){
                            $miercoles1 = explode("-", $row["miercoles"]);
                            $miercoles = $miercoles1[0]."-<br />".$miercoles1[1];
                        }
                        if($row["jueves"] != ""){
                            $jueves1 = explode("-", $row["jueves"]);
                            $jueves = $jueves1[0]."-<br />".$jueves1[1];
                        }
                        if($row["viernes"] != ""){
                            $viernes1 = explode("-", $row["viernes"]);
                            $viernes = $viernes1[0]."-<br />".$viernes1[1];
                        }
                    ?>
                        <tr>
                            <td><?= $row['desc_carrera'] ?></td>
                            <td><?= $row['desc_grupo'] ?></td>
                            <td><?= $row['desc_materia'] ?></td>
                            <td><?= $lunes ?></td>
                            <td><?= $martes ?></td>
                            <td><?= $miercoles ?></td>
                            <td><?= $jueves ?></td>
                            <td><?= $viernes ?></td>
                            <td><?= $sabado ?></td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?= Html::a("Lista Alumnos", ["reporte/listaalumnos?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo]) ?></li>
                                        <li><?= Html::a("Reporte Calificaciones", ["reporte/listaalumnoscalificacion?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo], ["target" => "_parent"]) ?></li>
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