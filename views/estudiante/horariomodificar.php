<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Horario';
$this->params['breadcrumbs'][] = $this->title;

$idestudiante = $idestudiante != 999999999999 ? $idestudiante : ''
?>

<div class="panel panel-primary">
    <div class="panel-heading">Horario</div>
    <div class="panel-body">
        <div class="col-md-6">
            <?php
                $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("estudiante/horariomodificar"),
                    "enableClientValidation" => true
                ]);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo", "options" => [$idciclo=>["selected" => true]]]) ?>
                </div>
                <div class="col-md-6">
                    <?= $f->field($form, "idestudiante")->input("search", ["class" => "form-control", "placeholder" => "No. Control", "value" => $idestudiante]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                    <?= Html::a('Refrescar', ['estudiante/horariomodificar'], ['class' => 'btn btn-info']) ?>
            <?php $f->end() ?>
                <?php if($idciclo_actual == $idciclo): ?>
                <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/horarioagregar=".$idestudiante."=".$idciclo."=".$idcarrera ?>" id="horario_agregar" class="btn btn-info" data-toggle="modal" data-target="#materias">Asignar Materia</a>
                <?php endif ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-left">
            <h4>No. Control: <span class="small"><?= $idestudiante ?></span></h4>
            <h4>Estudiante: <span class="small"><?= $estudiante ?></span></h4>
        </div>
        <div class="col-md-3 text-left">
            <h4>Carrera: <span class="small"><?= $carrera ?></span></h4>
            <h4>Total de créditos: <span class="label label-warning"><?= $creditos ?></span></h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Materia</th>
                            <th>REP</th>
                            <th>CR</th>
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
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row['desc_materia'] ?></td>
                            <td><?= $row['desc_opcion_curso_corto'] ?></td>
                            <td><?= $row['creditos'] ?></td>
                            <td><?= $row['lunes'] ?></td>
                            <td><?= $row['martes'] ?></td>
                            <td><?= $row['miercoles'] ?></td>
                            <td><?= $row['jueves'] ?></td>
                            <td><?= $row['viernes'] ?></td>
                            <td><?= $row['sabado'] ?></td>
                            <td>
                                <?php if($idciclo_actual == $idciclo): ?>
                                <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/deletehorarioestudiante?idgrupo=".$row['idgrupo']."&idestudiante=".$row['idestudiante']."&idciclo=".$row['idciclo'] ?>" class="btn-sm btn-danger eliminar_materia">Eliminar</a>
                                <?php endif ?>
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
<div class="modal fade" id="materias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 85% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="classModalLabel">Asignar Materia</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc_materia">Materia</label>
                            <input type="text" name="desc_materia" id="desc_materia" class="form-control" placeholder="Materia" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/horarioagregar?idestudiante=".$idestudiante."&idciclo=".$idciclo."&idcarrera=".$idcarrera ?>" class="btn btn-primary" id="buscar_materia">Buscar</a>
                            <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/horarioagregar?idestudiante=".$idestudiante."&idciclo=".$idciclo."&idcarrera=".$idcarrera ?>" class="btn btn-info" id="refrecar_lista_materia">Refrescar</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span id="alumno_horario_agregar"></span>
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php if((count($model) == 0 && $status == 1) || (count($model) >= 0 && $status == 2)): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only"></span>
        <b><?= $msg ?></b>
    </div>
<?php endif ?>

<?php
$this->registerJs('
    $("#horario_agregar").on("click", function(e) {
        e.preventDefault();

        var valor_url = $(this).attr("href");
        var url = valor_url.split("=")[0];
        var idestudiante = valor_url.split("=")[1];
        var idciclo = valor_url.split("=")[2];
        var idcarrera = valor_url.split("=")[3];
alert(url);
        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idcarrera": idcarrera,
                "idestudiante": idestudiante,
                "idciclo": idciclo
            },
            beforeSend: function() {
                $("#alumno_horario_agregar").empty();
            },
            success: function(respuesta) {
                $("#alumno_horario_agregar").html(respuesta);
            }
        });
    });
');
?>