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
        <div class="col-md-4">
            <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("profesor/horario"),
                    "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "idciclo")->dropDownList($ciclos, ["prompt" => "Periodo"]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a('Refrescar', ['profesor/horario'], ['class' => 'btn btn-info']) ?>
            <?php $f->end() ?>
        </div>
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

                        if($lunes){
                            $dia = explode("-", $lunes);
                            $lunes = $dia[0]."-\n".$dia[1];
                        }
                        if($martes){
                            $dia1 = explode("-", $martes);
                            $martes = $dia1[0]."-\n".$dia1[1];
                        }
                        if($miercoles){
                            $dia2 = explode("-", $miercoles);
                            $miercoles = $dia2[0]."-\n".$dia2[1];
                        }
                        if($jueves){
                            $dia3 = explode("-", $jueves);
                            $jueves = $dia3[0]."-\n".$dia3[1];
                        }
                        if($viernes){
                            $dia4 = explode("-", $viernes);
                            $viernes = $dia4[0]."-\n".$dia4[1];
                        }
                        if($sabado){
                            $dia5 = explode("-", $sabado);
                            $sabado = $dia5[0]."-\n".$dia5[1];
                        }
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
                        <td style="min-width: 90px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs">Acción</button>
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."profesor/listaalumnos=".$row['idgrupo'] ?>" class="idgrupo" data-toggle="modal" data-target="#grupos">Lista</a>
                                    </li>
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