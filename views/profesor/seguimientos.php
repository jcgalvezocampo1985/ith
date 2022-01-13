<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Seguimientos";
$this->params["breadcrumbs"][] = $this->title;
$total_seguimientos1 = ($ts1 == 1) ? "checked" : "";
$total_seguimientos2 = ($ts2 == 1) ? "checked" : "";
$total_seguimientos3 = ($ts3 == 1) ? "checked" : "";
$total_seguimientos4 = ($ts4 == 1) ? "checked" : "";
$regularizacion = ($regular == 1) ? "checked" : "";
?>
<?= Yii::$app->view->renderFile('@app/views/errors/error.php', ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading">Seguimientos</div>
    <div class="panel-body">
        <div class="col-md-4">
            <?php
            $f = ActiveForm::begin([
                    "method" => "get",
                    "action" => Url::toRoute("profesor/seguimientos"),
                    "enableClientValidation" => true
                ]);
            ?>
                <?= $f->field($form, "buscar")->input("search", ["class" => "form-control", "placeholder" => "Buscar..."]) ?>
                <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["profesor/seguimientos"], ["class" => "btn btn-info"]) ?>
            <?php $f->end() ?>
        </div>
        <div class="col-md-12">
            <hr width="100%">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Profesor</th>
                            <th class="text-center"><input type="checkbox" name="seguimientos1" id="seguimientos1" <?= $total_seguimientos1 ?> />Seguimiento 1</th>
                            <th class="text-center"><input type="checkbox" name="seguimientos2" id="seguimientos2" <?= $total_seguimientos2 ?> />Seguimiento 2</th>
                            <th class="text-center"><input type="checkbox" name="seguimientos3" id="seguimientos3" <?= $total_seguimientos3 ?> />Seguimiento 3</th>
                            <th class="text-center"><input type="checkbox" name="seguimientos4" id="seguimientos4" <?= $total_seguimientos4 ?> />Seguimiento 4</th>
                            <th class="text-center"><input type="checkbox" name="seguimientos5" id="seguimientos5" <?= $regularizacion ?> />2da. Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($model as $row):
                            $s1 = $row['seguimiento1'] == 1 ? "checked" : "";
                            $s2 = $row['seguimiento2'] == 1 ? "checked" : "";
                            $s3 = $row['seguimiento3'] == 1 ? "checked" : "";
                            $s4 = $row['seguimiento4'] == 1 ? "checked" : "";
                            $s5 = $row['seguimiento5'] == 1 ? "checked" : "";
                        ?>
                        <tr>
                            <td><?= $row['apaterno']." ".$row['amaterno']." ".$row['nombre_profesor'] ?></td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento1" id="seguimiento1" class="seguimiento1" value="<?= $row['idprofesor'] ?>" <?= $s1 ?>>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento2" id="seguimiento2" class="seguimiento2" value="<?= $row['idprofesor'] ?>" <?= $s2 ?>>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento3" id="seguimiento3" class="seguimiento3" value="<?= $row['idprofesor'] ?>" <?= $s3 ?>>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento4" id="seguimiento4" class="seguimiento4" value="<?= $row['idprofesor'] ?>" <?= $s4 ?>>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="seguimiento5" id="seguimiento5" class="seguimiento5" value="<?= $row['idprofesor'] ?>" <?= $s5 ?>>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= LinkPager::widget(["pagination" => $pages]); ?>

<?php
$this->registerJs('
$(document).ready(function(){
    $(".seguimiento1, .seguimiento2, .seguimiento3, .seguimiento4, .seguimiento5").on("click", function() {
        let idprofesor = $(this).val();
        let clase = $(this).attr("class");
        let bandera = "0";
        let seguimiento = "1";

        if(clase === "seguimiento2"){
            seguimiento = "2";
        }else if(clase === "seguimiento3"){
            seguimiento = "3";
        }else if(clase === "seguimiento4"){
            seguimiento = "4";
        }else if(clase === "seguimiento5"){
            seguimiento = "5";
        }

        if($(this).is(":checked")){
            bandera = "1";
        }

        $.ajax({
            url: "asignarseguimiento",
            type: "GET",
            data: {
                "seguimiento": seguimiento,
                "idprofesor": idprofesor,
                "bandera": bandera
            }
        });
    });

    $("#seguimientos1, #seguimientos2, #seguimientos3, #seguimientos4, #seguimientos5").on("click", function(){
        let id = $(this).attr("id");
        let bandera = "0";
        let seguimiento = "1";

        if(id === "seguimientos1"){
            seguimiento = "1";
            $(".seguimiento1").attr("checked", false);
            if($(this).is(":checked")){
                $(".seguimiento1").attr("checked", true);
                bandera = "1";
            }
        }else if(id === "seguimientos2"){
            seguimiento = "2";
            $(".seguimiento2").attr("checked", false);
            if($(this).is(":checked")){
                $(".seguimiento2").attr("checked", true);
                bandera = "1";
            }
        }else if(id === "seguimientos3"){
            seguimiento = "1";
            $(".seguimiento3").attr("checked", false);
            if($(this).is(":checked")){
                $(".seguimiento3").attr("checked", true);
                bandera = "1";
            }
        }else if(id === "seguimientos4"){
            seguimiento = "4";
            $(".seguimiento4").attr("checked", false);
            if($(this).is(":checked")){
                $(".seguimiento4").attr("checked", true);
                bandera = "1";
            }
        }else if(id === "seguimientos5"){
            seguimiento = "5";
            $(".seguimiento5").attr("checked", false);
            if($(this).is(":checked")){
                $(".seguimiento5").attr("checked", true);
                bandera = "1";
            }
        }

        $.ajax({
            url: "asignarseguimientos",
            type: "GET",
            data: {
                "seguimiento": seguimiento,
                "bandera": bandera
            }
        });
    });
})');
?>