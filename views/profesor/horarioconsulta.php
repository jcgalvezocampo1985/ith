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
                        <?php
                        foreach($model as $row):
                            $lunes = $row["lunes"];
                            $martes = $row["martes"];
                            $miercoles = $row["miercoles"];
                            $jueves = $row["jueves"];
                            $viernes = $row["viernes"];
                            $sabado = $row["sabado"];

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
                                <td><?= $row["desc_carrera"] ?></td>
                                <td><?= $row["desc_grupo"] ?></td>
                                <td><?= $row["desc_materia"] ?></td>
                                <td><?= $row["creditos"] ?></td>
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
                                        <ul class="dropdown-menu  pull-right">
                                            <li><?= Html::a("Lista Alumnos", ["profesor/listaalumnos=".$row["idgrupo"]], ["class" => "idgrupo", "data-toggle" => "modal", "data-target" => "#grupos"]) ?></li>
                                            <?php if($idciclo == $ultimo_ciclo): ?>
                                            <?php //Html::a("Capturar Calificaciones", ["profesor/listaalumnoscalificacion?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false"], ["target" => "_parent"]) ?>
                                            <li><?= Html::a("Capturar Calificaciones S1", ["profesor/listaalumnoscalificacionseguimientos?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false&seguimiento=1"], ["target" => "_parent"]) ?></li>
                                            <li><?= Html::a("Capturar Calificaciones S2", ["profesor/listaalumnoscalificacionseguimientos?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false&seguimiento=2"], ["target" => "_parent"]) ?></li>
                                            <li><?= Html::a("Capturar Calificaciones S3", ["profesor/listaalumnoscalificacionseguimientos?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false&seguimiento=3"], ["target" => "_parent"]) ?></li>
                                            <li><?= Html::a("Capturar Calificaciones S4", ["profesor/listaalumnoscalificacionseguimientos?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false&seguimiento=4"], ["target" => "_parent"]) ?></li>
                                            <?php if($regularizacion_status == 1): ?>
                                            <li><?= Html::a("Capturar Calificaciones Regularización", ["profesor/listaalumnoscalificacionregularizacion?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo."&idprofesor=".$idprofesor."&ultimo_ciclo=".$ultimo_ciclo."&r=false"], ["target" => "_parent"]) ?></li>
                                            <?php endif ?>
                                            <?php endif ?>
                                            <li><?= Html::a("Reporte Calificaciones", ["reporte/listaalumnoscalificacion?idgrupo=".$row["idgrupo"]."&idciclo=".$idciclo], ["target" => "_parent"]) ?></li>
                                            <li><?= Html::a("Generar Acta", ["actacalificacion/generaracta?idgrupo=".$row["idgrupo"]]) ?></li>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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
$this->registerJs('
    $(".idgrupo").on("click", function(e) {
        e.preventDefault();

        var idciclo1 = $("#ciclosearch-idciclo").val();
        var idciclo2 = $("#cicloprofesorsearch-idciclo").val();
        var idciclo = (idciclo1 === undefined) ? idciclo2 : idciclo1;
        var valor = $(this).attr("href");
        var url = valor.split("=")[0];
        var idgrupo = valor.split("=")[1];

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idgrupo": idgrupo,
                "idciclo": idciclo
            },
            beforeSend: function() {
                $("#lista_alumnos").empty();
            },
            //data: "idgrupo=" + id + "&idciclo=" + idciclo,
            success: function(respuesta) {
                $("#lista_alumnos").html(respuesta);
            }
        });
    });
');
?>