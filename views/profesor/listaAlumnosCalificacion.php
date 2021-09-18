<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

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
                <?= Html::a("Regresar", ["profesor/horarioconsulta?idciclo=".$idciclo."&idprofesor=".$idprofesor], ["class" => "btn btn-info"]) ?>
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
                            <th>P1</th>
                            <th>P2</th>
                            <th>P3</th>
                            <th>P4</th>
                            <th>P5</th>
                            <th>P6</th>
                            <th>P7</th>
                            <th>P8</th>
                            <th>P9</th>
                            <th>Prom.</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        <?php foreach($model as $row): ?>
                        <?php
                            $p1 = $row['p1'];
                            $p2 = $row['p2'];
                            $p3 = $row['p3'];
                            $p4 = $row['p4'];
                            $p5 = $row['p5'];
                            $p6 = $row['p6'];
                            $p7 = $row['p7'];
                            $p8 = $row['p8'];
                            $p9 = $row['p9'];
                            $s1 = $row['s1'];
                            $s2 = $row['s2'];
                            $s3 = $row['s3'];
                            $s4 = $row['s4'];
                            $s5 = $row['s5'];
                            $s6 = $row['s6'];
                            $s7 = $row['s7'];
                            $s8 = $row['s8'];
                            $s9 = $row['s9'];

                            if ($p1 > 0) {
                                $promedio_p = round($p1,0);
                            }
                            if ($p2 > 0) {
                                $promedio_p = round(($p1+$p2)/2, 0);
                            }
                            if ($p3 > 0) {
                                $promedio_p = round(($p1+$p2+$p3)/3, 0);
                            }
                            if ($p4 > 0) {
                                $promedio_p = round(($p1+$p2+$p3+$p4)/4, 0);
                            }
                            if ($p5 > 0) {
                                $promedio_p = round(($p1+$p2+$p3+$p4+$p5)/5, 0);
                            }
                            if ($p6 > 0) {
                                $promedio_p = round(($p1+$p2+$p3+$p4+$p5+$p6)/6, 0);
                            }
                            if ($p7 > 0) {
                                $promedio_p = round(($p1+$p2+$p3+$p4+$p5+$p6+$p7)/7, 0);
                            }
                            if($p8 > 0){
                                $promedio_p = round(($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8)/8, 0);
                            }
                            if($p9 > 0){
                                $promedio_p = round(($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8+$p9)/9, 0);
                            }

                            if ($s1 > 0) {
                                $promedio_s = round($s1,0);
                            }
                            if ($s2 > 0) {
                                $promedio_s = round(($s1+$s2)/2, 0);
                            }
                            if ($s3 > 0) {
                                $promedio_s = round(($s1+$s2+$s3)/3, 0);
                            }
                            if ($s4 > 0) {
                                $promedio_s = round(($s1+$s2+$s3+$s4)/4, 0);
                            }
                            if ($s5 > 0) {
                                $promedio_s = round(($s1+$s2+$s3+$s4+$s5)/5, 0);
                            }
                            if ($s6 > 0) {
                                $promedio_s = round(($s1+$s2+$s3+$s4+$s5+$s6)/6, 0);
                            }
                            if ($s7 > 0) {
                                $promedio_s = round(($s1+$s2+$s3+$s4+$s5+$s6+$s7)/7, 0);
                            }
                            if($s8 > 0){
                                $promedio_s = round(($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8)/8, 0);
                            }
                            if($s9 > 0){
                                $promedio_s = round(($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8+$s9)/9, 0);
                            }
                            
                        ?>
                        <tr>
                            <td rowspan="3"><?= $row['idestudiante'] ?></td>
                            <td rowspan="3"><?= $row['nombre_estudiante'] ?></td>
                            <td rowspan="3"><?= $row['desc_opcion_curso'] ?></td>
                        </tr>
                        <tr>
                            <td>P</td>
                            <td><input type="number" name="p1[]" class="validar_calificacion" maxlength="3" value="<?= $p1 ?>" /></td>
                            <td><input type="number" name="p2[]" class="validar_calificacion" maxlength="3" value="<?= $p2 ?>" /></td>
                            <td><input type="number" name="p3[]" class="validar_calificacion" maxlength="3" value="<?= $p3 ?>" /></td>
                            <td><input type="number" name="p4[]" class="validar_calificacion" maxlength="3" value="<?= $p4 ?>" /></td>
                            <td><input type="number" name="p5[]" class="validar_calificacion" maxlength="3" value="<?= $p5 ?>" /></td>
                            <td><input type="number" name="p6[]" class="validar_calificacion" maxlength="3" value="<?= $p6 ?>" /></td>
                            <td><input type="number" name="p7[]" class="validar_calificacion" maxlength="3" value="<?= $p7 ?>" /></td>
                            <td><input type="number" name="p8[]" class="validar_calificacion" maxlength="3" value="<?= $p8 ?>" /></td>
                            <td><input type="number" name="p9[]" class="validar_calificacion" maxlength="3" value="<?= $p9 ?>" /></td>
                            <td><?= $promedio_p ?></td>
                        </tr>
                        <tr>
                            <td>S</td>
                            <td><input type="number" name="s1[]" class="validar_calificacion" maxlength="3" value="<?= $s1 ?>" /></td>
                            <td><input type="number" name="s2[]" class="validar_calificacion" maxlength="3" value="<?= $s2 ?>" /></td>
                            <td><input type="number" name="s3[]" class="validar_calificacion" maxlength="3" value="<?= $s3 ?>" /></td>
                            <td><input type="number" name="s4[]" class="validar_calificacion" maxlength="3" value="<?= $s4 ?>" /></td>
                            <td><input type="number" name="s5[]" class="validar_calificacion" maxlength="3" value="<?= $s5 ?>" /></td>
                            <td><input type="number" name="s6[]" class="validar_calificacion" maxlength="3" value="<?= $s6 ?>" /></td>
                            <td><input type="number" name="s7[]" class="validar_calificacion" maxlength="3" value="<?= $s7 ?>" /></td>
                            <td><input type="number" name="s8[]" class="validar_calificacion" maxlength="3" value="<?= $s8 ?>" /></td>
                            <td><input type="number" name="s9[]" class="validar_calificacion" maxlength="3" value="<?= $s9 ?>" /></td>
                            <td><?= $promedio_s ?></td>
                        </tr>
                        <input type="hidden" name="idestudiante[]" value="<?= $row["idestudiante"] ?>" readonly="true" />
                        <?php endforeach ?>
                        <input type="hidden" name="idgrupo" value="<?= $idgrupo ?>" readonly="true" />
                        <input type="hidden" name="idciclo" value="<?= $idciclo ?>" readonly="true" />
                        <input type="hidden" name="idprofesor" value="<?= $idprofesor ?>" readonly="true" />
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

