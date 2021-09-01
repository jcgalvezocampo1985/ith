<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Horario';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>
<?php
$f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("estudiante/horariomodificar"),
    "enableClientValidation" => true
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Horario</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo"]) ?>
            </div>
            <div class="col-md-4">
                <?= $f->field($form, "idestudiante")->input("search", ["class" => "form-control", "placeholder" => "No. Control"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr width="100%">
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
                                <a href="<?= Url::toRoute(['reporte/horario/', 'id' => $row['idestudiante'], 'idciclo' => $row['idciclo']]) ?>" class="btn btn-danger" role="button">Eliminar</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="idestudiante_"<?= $row['idestudiante'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="danger">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Mensaje:</span>
                                        ¿Desea eliminar al estudiante con No. Control <?= $row['idestudiante'] ?>?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <?= Html::beginForm(Url::toRoute("estudiante/delete"), "POST") ?>
                                        <input type="hidden" name="idestudiante" value="<?= $row['idestudiante'] ?>">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <?= Html::endForm() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $f->end() ?>

<?php if(count($model) == 0 && $status == 1): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se encontró información relacionada al No. Control <?= $form->buscar ?>
    </div>
<?php endif ?>