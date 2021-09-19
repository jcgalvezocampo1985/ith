<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$url = ($_GET["r"] == "true") ? "horario" : "horarioconsulta";

if($idciclo != $ultimo_ciclo){
    header("Location: ".Url::toRoute("/profesor/".$url."?idgrupo=$idgrupo&idciclo=$idciclo&idprofesor=$idprofesor"));
    exit;
}

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "action" => "guardarcalificacion"
]);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Lista de alumnos</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <h4>Carrera: <small><?= $model1[0]['desc_carrera'] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Matería: <small><?= $model1[0]['desc_materia'] ?></small></h4>
            </div>
            <div class="col-md-2">
                <h4>Grupo: <small><?= $model1[0]['desc_grupo'] ?></small></h4>
            </div>
            <div class="col-md-2">
                <h4>Semestre: <small><?= $model1[0]['num_semestre'] ?></small></h4>
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-warning" name="guardar" value="Guardar" />
                <?= Html::a("Regresar", ["profesor/".$url."?idciclo=".$idciclo."&idprofesor=".$idprofesor], ["class" => "btn btn-info"]) ?>
            </div>
        </div>
        <hr width="100%">
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Opción</th>
                            <th>T</th>
                            <th class="text-center">P1</th>
                            <th class="text-center">P2</th>
                            <th class="text-center">P3</th>
                            <th class="text-center">P4</th>
                            <th class="text-center">P5</th>
                            <th class="text-center">P6</th>
                            <th class="text-center">P7</th>
                            <th class="text-center">P8</th>
                            <th class="text-center">P9</th>
                            <th class="text-center">Prom.</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        <?php foreach($model as $row): ?>
                        <?php
                            $p1 = ($row['p1'] == "") ? 0 : $row['p1'];
                            $p2 = ($row['p2'] == "") ? 0 : $row['p2'];
                            $p3 = ($row['p3'] == "") ? 0 : $row['p3'];
                            $p4 = ($row['p4'] == "") ? 0 : $row['p4'];
                            $p5 = ($row['p5'] == "") ? 0 : $row['p5'];
                            $p6 = ($row['p6'] == "") ? 0 : $row['p6'];
                            $p7 = ($row['p7'] == "") ? 0 : $row['p7'];
                            $p8 = ($row['p8'] == "") ? 0 : $row['p8'];
                            $p9 = ($row['p9'] == "") ? 0 : $row['p9'];

                            $s1 = ($row['s1'] == "") ? 0 : $row['s1'];
                            $s2 = ($row['s2'] == "") ? 0 : $row['s2'];
                            $s3 = ($row['s3'] == "") ? 0 : $row['s3'];
                            $s4 = ($row['s4'] == "") ? 0 : $row['s4'];
                            $s5 = ($row['s5'] == "") ? 0 : $row['s5'];
                            $s6 = ($row['s6'] == "") ? 0 : $row['s6'];
                            $s7 = ($row['s7'] == "") ? 0 : $row['s7'];
                            $s8 = ($row['s8'] == "") ? 0 : $row['s8'];
                            $s9 = ($row['s9'] == "") ? 0 : $row['s9'];

                            $r1 = "";
                            $r2 = "";
                            $r3 = "";
                            $r4 = "";
                            $r5 = "";
                            $r6 = "";
                            $r7 = "";
                            $r8 = "";
                            $r9 = "";

                            $promedio_p = "";

                            $p1 = ($row['s1'] >= 0 && $row['s1'] != "") ? $s1 : $p1;
                            $p2 = ($row['s2'] >= 0 && $row['s2'] != "") ? $s2 : $p2;
                            $p3 = ($row['s3'] >= 0 && $row['s3'] != "") ? $s3 : $p3;
                            $p4 = ($row['s4'] >= 0 && $row['s4'] != "") ? $s4 : $p4;
                            $p5 = ($row['s5'] >= 0 && $row['s5'] != "") ? $s5 : $p5;
                            $p6 = ($row['s6'] >= 0 && $row['s6'] != "") ? $s6 : $p6;
                            $p7 = ($row['s7'] >= 0 && $row['s7'] != "") ? $s7 : $p7;
                            $p8 = ($row['s8'] >= 0 && $row['s8'] != "") ? $s8 : $p8;
                            $p9 = ($row['s9'] >= 0 && $row['s9'] != "") ? $s9 : $p9;

                            if ($row['p1'] >= 0 && $row['p1'] != "") {
                                $promedio_p = round($p1, 0);
                                $r1 = "readonly";
                            }

                            if ($row['p2'] >= 0 && $row['p2'] != "") {
                                $promedio_p = round(($p1 + $p2) / 2, 0);
                                $r2 = "readonly";
                            }

                            if ($row['p3'] >= 0 && $row['p3'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3) / 3, 0);
                                $r3 = "readonly";
                            }

                            if ($row['p4'] >= 0 && $row['p4'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4) / 4, 0);
                                $r4 = "readonly";
                            }

                            if ($row['p5'] >= 0 && $row['p5'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5) / 5, 0);
                                $r5 = "readonly";
                            }

                            if ($row['p6'] >= 0 && $row['p6'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6) / 6, 0);
                                $r6 = "readonly";
                            }

                            if ($row['p7'] >= 0 && $row['p7'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7) / 7, 0);
                                $r7 = "readonly";
                            }

                            if ($row['p8'] >= 0 && $row['p8'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8) / 8, 0);
                                $r8 = "readonly";
                            }

                            if ($row['p9'] >= 0 && $row['p9'] != "") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9) / 9, 0);
                                $r9 = "readonly";
                            }
                        ?>
                        <tr>
                            <td rowspan="3"><?= $row['idestudiante'] ?></td>
                            <td rowspan="3"><?= $row['nombre_estudiante'] ?></td>
                            <td rowspan="3"><?= $row['desc_opcion_curso'] ?></td>
                        </tr>
                        <tr>
                            <td>P</td>
                            <td><input type="number" name="p1[]" class="validar_calificacion" maxlength="3" value="<?= $row['p1'] ?>" <?= $r1 ?> /></td>
                            <td><input type="number" name="p2[]" class="validar_calificacion" maxlength="3" value="<?= $row['p2'] ?>" <?= $r2 ?> /></td>
                            <td><input type="number" name="p3[]" class="validar_calificacion" maxlength="3" value="<?= $row['p3'] ?>" <?= $r3 ?> /></td>
                            <td><input type="number" name="p4[]" class="validar_calificacion" maxlength="3" value="<?= $row['p4'] ?>" <?= $r4 ?> /></td>
                            <td><input type="number" name="p5[]" class="validar_calificacion" maxlength="3" value="<?= $row['p5'] ?>" <?= $r5 ?> /></td>
                            <td><input type="number" name="p6[]" class="validar_calificacion" maxlength="3" value="<?= $row['p6'] ?>" <?= $r6 ?> /></td>
                            <td><input type="number" name="p7[]" class="validar_calificacion" maxlength="3" value="<?= $row['p7'] ?>" <?= $r7 ?> /></td>
                            <td><input type="number" name="p8[]" class="validar_calificacion" maxlength="3" value="<?= $row['p8'] ?>" <?= $r8 ?> /></td>
                            <td><input type="number" name="p9[]" class="validar_calificacion" maxlength="3" value="<?= $row['p9'] ?>" <?= $r9 ?> /></td>
                            <td rowspan="2" class="text-center"><h3><span class="label label-primary"><?= $promedio_p ?></span><h3></td>
                        </tr>
                        <tr>
                            <td>S</td>
                            <td><input type="number" name="s1[]" class="validar_calificacion" maxlength="3" value="<?= $row['s1'] ?>" /></td>
                            <td><input type="number" name="s2[]" class="validar_calificacion" maxlength="3" value="<?= $row['s2'] ?>" /></td>
                            <td><input type="number" name="s3[]" class="validar_calificacion" maxlength="3" value="<?= $row['s3'] ?>" /></td>
                            <td><input type="number" name="s4[]" class="validar_calificacion" maxlength="3" value="<?= $row['s4'] ?>" /></td>
                            <td><input type="number" name="s5[]" class="validar_calificacion" maxlength="3" value="<?= $row['s5'] ?>" /></td>
                            <td><input type="number" name="s6[]" class="validar_calificacion" maxlength="3" value="<?= $row['s6'] ?>" /></td>
                            <td><input type="number" name="s7[]" class="validar_calificacion" maxlength="3" value="<?= $row['s7'] ?>" /></td>
                            <td><input type="number" name="s8[]" class="validar_calificacion" maxlength="3" value="<?= $row['s8'] ?>" /></td>
                            <td><input type="number" name="s9[]" class="validar_calificacion" maxlength="3" value="<?= $row['s9'] ?>" /></td>
                        </tr>
                        <input type="hidden" name="idestudiante[]" value="<?= $row["idestudiante"] ?>" readonly="true" />
                        <?php endforeach ?>
                        <input type="hidden" name="idgrupo" value="<?= $idgrupo ?>" readonly="true" />
                        <input type="hidden" name="idciclo" value="<?= $idciclo ?>" readonly="true" />
                        <input type="hidden" name="idprofesor" value="<?= $idprofesor ?>" readonly="true" />
                        <input type="hidden" name="r" value="<?= $_GET["r"] ?>" readonly="true" />
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerCss('
.validar_calificacion{
    width: 40px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
');
?>

