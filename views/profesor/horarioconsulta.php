<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profesores';

?>
<?php $this->params['breadcrumbs'][] = $this->title; ?>

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
                <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo"]) ?>
            </div>
            <div class="col-md-4">
                <?= $f->field($form, "idprofesor")->dropDownList($profesores, ["prompt" => "Profesor"]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a('Refrescar', ['profesor/horarioconsulta'], ['class' => 'btn btn-info']) ?>
            </div>
        </div>
        <?php $f->end() ?>
        <div class="row">
            <div class="col-md-12">
                <h4><span class="label label-warning"><?= $ciclo_actual ?></span></h4>
                <hr width="100%">
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
                                <th></th>
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
                        ?>
                            <tr>
                                <td><?= $row['desc_carrera'] ?></td>
                                <td><?= $row['desc_grupo'] ?></td>
                                <td><?= $row['desc_materia'] ?></td>
                                <td><?= $row['creditos'] ?></td>
                                <td><?= $lunes ?></td>
                                <td><?= $martes ?></td>
                                <td><?= $miercoles ?></td>
                                <td><?= $jueves ?></td>
                                <td><?= $viernes ?></td>
                                <td><?= $sabado ?></td>
                                <td>
                                    <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."profesor/listaalumnos=".$row['idgrupo'] ?>" class="idgrupo btn btn-success" data-toggle="modal" data-target="#grupos">Lista</a>
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