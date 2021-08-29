<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$this->title = 'Estudiantes';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>

<div class="panel panel-primary">
    <div class="panel-heading">Estudiantes</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
                $f = ActiveForm::begin([
                        "method" => "get",
                        "action" => Url::toRoute("estudiante/index"),
                        "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "q")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a('Refrescar', ['estudiante/index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Nuevo Estudiante', ['estudiante/create'], ['class' => 'btn btn-info']) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th>No. Control</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($model as $row): ?>
                    <tr>
                        <td><?= $row['idestudiante'] ?></td>
                        <td><?= $row['nombre_estudiante'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['sexo'] ?></td>
                        <td><?= $row['desc_carrera'] ?></td>
                        <td><?= $row['num_semestre'] ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs">Acción</button>
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= Html::a('Modificar', ['/estudiante/update?idestudiante='.$row['idestudiante']]) ?></li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#idestudiante_"<?= $row['idestudiante'] ?>>Eliminar</a>
                                    </li>
                                    <li><?= Html::a('Boleta', ['/reporte/boleta?id='.$row['idestudiante']]) ?></li>
                                    <li><?= Html::a('Horario', ['/reporte/horario?id='.$row['idestudiante']]) ?></li>
                                </ul>
                            </div>
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
<?= LinkPager::widget(["pagination" => $pages]); ?>

<?php if(count($model) == 0 && $status == 1): ?>
    <div class="alert alert-warning" role="warning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se encontró información relacionada con el criterio <?= $form->q ?>
    </div>
<?php endif ?>