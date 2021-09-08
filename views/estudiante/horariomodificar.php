<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Horario';

$this->params['breadcrumbs'][] = $this->title;
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
            <?php $f->end() ?>
                <?php if($idciclo_actual == $idciclo): ?>
                <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/horarioagregar=".$idestudiante."=".$idciclo."=".$idcarrera ?>" id="horario_agregar" class="btn btn-info" data-toggle="modal" data-target="#materias">Asignar Materia</a>
                <?php endif ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <h4>Carrera<br /><span class="small"><?= $carrera ?></span></h4>
        </div>
        <div class="col-md-2 text-center">
            <h4>Total de créditos<br /><span class="label label-warning"><?= $creditos ?></span></h4>
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
                <div id="alumno_horario_agregar"></div>
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