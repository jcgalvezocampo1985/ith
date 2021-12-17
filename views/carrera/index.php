<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Carrera";
$this->params["breadcrumbs"][] = $this->title;
?>
<?= Yii::$app->view->renderFile("@app/views/errors/error.php", ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Carreras</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
                $f = ActiveForm::begin([
                        "method" => "get",
                        "action" => Url::toRoute("carrera/index"),
                        "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["carrera/index"], ["class" => "btn btn-info"]) ?>
                <?= Html::a("Nueva Carrera", ["carrera/create"], ["class" => "btn btn-info"]) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Carrera</th>
                            <th>No. Semestres</th>
                            <th>Plan de Estudios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $row): ?>
                        <tr>
                            <td><?= $row["cve_carrera"] ?></td>
                            <td><?= $row["desc_carrera"] ?></td>
                            <td><?= $row["no_semestres"] ?></td>
                            <td><?= $row["plan_estudios"] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?= Html::a("Modificar", ["/carrera/edit?id=".$row["idcarrera"]]) ?></li>
                                        <li><?= Html::a("Eliminar", ["#"], ["data-toggle" => "modal", "data-target" => "#idcarrera_".$row["idcarrera"].""]) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="idcarrera_<?= $row["idcarrera"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            ¿Desea eliminar la carrera <?= $row["desc_carrera"] ?>?
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= Html::beginForm(Url::toRoute("carrera/delete"), "POST") ?>
                                            <input type="hidden" name="idcarrera" value="<?= $row["idcarrera"] ?>">
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
<?= LinkPager::widget(["pagination" => $pages]); ?>
<?php
$this->registerCss("
    .table-responsive{
        overflow-y: visible !important;
    }
    @media (max-width: 767px){
        .table-responsive .dropdown-menu{
            position: static !important;
        }
    }
    @media (min-width: 768px){
        .table-responsive{
            overflow: inherit;
        }
    }
");
?>