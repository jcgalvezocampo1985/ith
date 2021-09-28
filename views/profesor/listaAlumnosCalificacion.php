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
    <div class="panel-heading">Captura de calificaciones</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <h4>Carrera: <small><?= $model1[0]['desc_carrera'] ?></small></h4>
            </div>
            <div class="col-md-2">
                <h4>Grupo: <small><?= $model1[0]['desc_grupo'] ?></small></h4>
            </div>
            <div class="col-md-3">
                <h4>Profesor: <small><?= $model1[0]['profesor'] ?></small></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Matería: <small><?= $model1[0]['desc_materia'] ?></small></h4>
            </div>
            <div class="col-md-2">
                <h4>Semestre: <small><?= $model1[0]['num_semestre'] ?></small></h4>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <input type="submit" class="btn btn-success" name="guardar" id="guardar" value="Guardar" />
                <?= Html::a("Regresar", ["profesor/".$url."?idciclo=".$idciclo."&idprofesor=".$idprofesor], ["class" => "btn btn-primary"]) ?>
                <?= Html::a("Refrescar", ["profesor/listaalumnoscalificacion?idgrupo=$idgrupo&idciclo=$idciclo&idprofesor=$idprofesor&ultimo_ciclo=$ultimo_ciclo&r=false"], ["class" => "btn btn-info", "id" => "refrescar"]) ?>
                <?= Html::a("<span class='glyphicon glyphicon-print'></span>", ["reporte/listaalumnoscalificacion?idgrupo=".$idgrupo."&idciclo=".$idciclo], ["target" => "_parent", "class" => "btn btn-warning"]) ?>
            </div>
        </div>
        <hr width="100%">
        <div id="mensaje_error">
            <div class="alert" role="warning" id="alerta">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span id="mensaje_texto"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Opción</th>
                            <th>Opc.</th>
                            <th class="text-center">C1</th>
                            <th class="text-center">C2</th>
                            <th class="text-center">C3</th>
                            <th class="text-center">C4</th>
                            <th class="text-center">C5</th>
                            <th class="text-center">C6</th>
                            <th class="text-center">C7</th>
                            <th class="text-center">C8</th>
                            <th class="text-center">C9</th>
                            <th class="text-center">Prom.</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        <?php $i = 1;?>
                        <?php foreach($model as $row): ?>
                        <?php
                            $p1 = (!is_numeric($row['p1'])) ? 0 : $row['p1'];
                            $p2 = (!is_numeric($row['p2'])) ? 0 : $row['p2'];
                            $p3 = (!is_numeric($row['p3'])) ? 0 : $row['p3'];
                            $p4 = (!is_numeric($row['p4'])) ? 0 : $row['p4'];
                            $p5 = (!is_numeric($row['p5'])) ? 0 : $row['p5'];
                            $p6 = (!is_numeric($row['p6'])) ? 0 : $row['p6'];
                            $p7 = (!is_numeric($row['p7'])) ? 0 : $row['p7'];
                            $p8 = (!is_numeric($row['p8'])) ? 0 : $row['p8'];
                            $p9 = (!is_numeric($row['p9'])) ? 0 : $row['p9'];

                            $s1 = (!is_numeric($row['s1'])) ? 0 : $row['s1'];
                            $s2 = (!is_numeric($row['s2'])) ? 0 : $row['s2'];
                            $s3 = (!is_numeric($row['s3'])) ? 0 : $row['s3'];
                            $s4 = (!is_numeric($row['s4'])) ? 0 : $row['s4'];
                            $s5 = (!is_numeric($row['s5'])) ? 0 : $row['s5'];
                            $s6 = (!is_numeric($row['s6'])) ? 0 : $row['s6'];
                            $s7 = (!is_numeric($row['s7'])) ? 0 : $row['s7'];
                            $s8 = (!is_numeric($row['s8'])) ? 0 : $row['s8'];
                            $s9 = (!is_numeric($row['s9'])) ? 0 : $row['s9'];

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

                            $p1 = (is_numeric($row['s1'])) ? $s1 : $p1;
                            $p2 = (is_numeric($row['s2'])) ? $s2 : $p2;
                            $p3 = (is_numeric($row['s3'])) ? $s3 : $p3;
                            $p4 = (is_numeric($row['s4'])) ? $s4 : $p4;
                            $p5 = (is_numeric($row['s5'])) ? $s5 : $p5;
                            $p6 = (is_numeric($row['s6'])) ? $s6 : $p6;
                            $p7 = (is_numeric($row['s7'])) ? $s7 : $p7;
                            $p8 = (is_numeric($row['s8'])) ? $s8 : $p8;
                            $p9 = (is_numeric($row['s9'])) ? $s9 : $p9;

                            if (is_numeric($row['p1']) || $row['p1'] == "NA") {
                                $promedio_p = round($p1, 0);
                                $r1 = "readonly";
                            }

                            if (is_numeric($row['p2']) || $row['p2'] == "NA") {
                                $promedio_p = round(($p1 + $p2) / 2, 0);
                                $r2 = "readonly";
                            }

                            if (is_numeric($row['p3']) || $row['p3'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3) / 3, 0);
                                $r3 = "readonly";
                            }

                            if (is_numeric($row['p4']) || $row['p4'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4) / 4, 0);
                                $r4 = "readonly";
                            }

                            if (is_numeric($row['p5']) || $row['p5'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5) / 5, 0);
                                $r5 = "readonly";
                            }

                            if (is_numeric($row['p6']) || $row['p6'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6) / 6, 0);
                                $r6 = "readonly";
                            }

                            if (is_numeric($row['p7']) || $row['p7'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7) / 7, 0);
                                $r7 = "readonly";
                            }

                            if (is_numeric($row['p8']) || $row['p8'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8) / 8, 0);
                                $r8 = "readonly";
                            }

                            if (is_numeric($row['p9']) || $row['p9'] == "NA") {
                                $promedio_p = round(($p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9) / 9, 0);
                                $r9 = "readonly";
                            }
                        ?>
                        <tr>
                            <td><?= $row['idestudiante'] ?></td>
                            <td><?= $row['nombre_estudiante'] ?></td>
                            <td><?= $row['desc_opcion_curso'] ?></td>
                            <td class="text-center">P</td>
                            <td class="text-center"><input type="text" name="p1[]" class="calificacion verificar_espacio_h verificar_espacio_v1" id="p1-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p1'] ?>" <?= $r1 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p2[]" class="calificacion verificar_espacio_h verificar_espacio_v2" id="p2-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p2'] ?>" <?= $r2 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p3[]" class="calificacion verificar_espacio_h verificar_espacio_v3" id="p3-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p3'] ?>" <?= $r3 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p4[]" class="calificacion verificar_espacio_h verificar_espacio_v4" id="p4-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p4'] ?>" <?= $r4 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p5[]" class="calificacion verificar_espacio_h verificar_espacio_v5" id="p5-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p5'] ?>" <?= $r5 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p6[]" class="calificacion verificar_espacio_h verificar_espacio_v6" id="p6-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p6'] ?>" <?= $r6 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p7[]" class="calificacion verificar_espacio_h verificar_espacio_v7" id="p7-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p7'] ?>" <?= $r7 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p8[]" class="calificacion verificar_espacio_h verificar_espacio_v8" id="p8-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p8'] ?>" <?= $r8 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><input type="text" name="p9[]" class="calificacion verificar_espacio_h verificar_espacio_v9" id="p9-<?= $row['idestudiante'] ?>" maxlength="3" value="<?= $row['p9'] ?>" <?= $r9 ?> autocomplete="off"  pattern="([N]{1}[A]{1})|([7-9]{1}[0-9]{1})|([1]{1}[0]{2})" /></td>
                            <td class="text-center"><span class="label label-<?= ($promedio_p < 70) ? "danger" : "primary" ?>" style="font-size: 14px;"><?= ($promedio_p == "NA" && $promedio_p < 70) ? "NA" : $promedio_p ?></span></td>
                        </tr>
                        <input type="hidden" name="idestudiante[]" value="<?= $row["idestudiante"] ?>" readonly="true" id="idestudiante<?= $i ?>" />
                        <?php $i++; ?>
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
<div class="alert alert-info" role="warning">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span><b>Premisas:</b></span>
    <br />
    <ul>
        <li>Sólo se permite ingresar valores númericos <b>mayor o igual a 70, menor o igual a 100 y NA</b> (cuando el estudiante no apruebe la materia).</li>
        <li>No se permite dejar cuadros de texto antecesores en blanco <b>(no podrá capturar en C2, si C1 está en blanco y así sucesivamente)</b>.</li>
        <li>No se permite dejar cuadros de texto en blanco de un parcial al capturar la calificación <b>(no se guardarán los cambios, si en un parcial faltan estudiantes por capturar su calificación).</b></li>
    </ul>
</div>
<?php
$this->registerCss('
.calificacion{
    width: 40px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
}
.error_input{
    border: 2px solid #ff3333;
    border-radius: 1px;
}
#mensaje_error{
    display: none;
');

$this->registerJs('$(document).ready(function(){
    $("#refrescar").on("click", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");

        if (confirm("¿Desea refrescar la ventana?")) {
            $(location).attr("href", url)
        }
    });

    $(".verificar_espacio_h").on("keyup", function() {
        var id_estudiante = $(this).attr("id");
        var id = id_estudiante.split("-")[0];
        var idestudiante = id_estudiante.split("-")[1];

        if (id != "p1") {
            var i = (id.split("p")[1]) - 1;
            var p = $("#p" + i + "-" + idestudiante).val();

            if (p == "") {
                $("#mensaje_error").stop(true);
                $("#" + id_estudiante).val("");
                $("#p1-" + idestudiante).focus();
                $("#alerta").removeClass("alert-success").addClass("alert-danger");
                $("#mensaje_texto").html("El cuadro de texto correspondiente al <b>C" + i + "</b> del estudiante con <b>No. Control " + idestudiante + "</b> no debe quedar en blanco");
                $("#mensaje_error").slideDown(1000).delay(5000).slideUp(1000);
            }
        }
    });
    
    $("#guardar").on("click", function(e) {
        e.preventDefault();

        if ($("#formulario")[0].checkValidity()) {
            let nFilas = $("#tabla tbody tr").length;
            let inputs_vacios1 = 0;
            let inputs_vacios2 = 0;
            let inputs_vacios3 = 0;
            let inputs_vacios4 = 0;
            let inputs_vacios5 = 0;
            let inputs_vacios6 = 0;
            let inputs_vacios7 = 0;
            let inputs_vacios8 = 0;
            let inputs_vacios9 = 0;
            let total_inputs_vacios = 0;
            let filas = 0;

            inputs_vacios1 = evaluar_vacios(nFilas, 1);
            inputs_vacios2 = evaluar_vacios(nFilas, 2);
            inputs_vacios3 = evaluar_vacios(nFilas, 3);
            inputs_vacios4 = evaluar_vacios(nFilas, 4);
            inputs_vacios5 = evaluar_vacios(nFilas, 5);
            inputs_vacios6 = evaluar_vacios(nFilas, 6);
            inputs_vacios7 = evaluar_vacios(nFilas, 7);
            inputs_vacios8 = evaluar_vacios(nFilas, 8);
            inputs_vacios9 = evaluar_vacios(nFilas, 9);

            if (inputs_vacios1 < nFilas) {
                filas = nFilas;
                total_inputs_vacios = inputs_vacios1;
            }
            if (inputs_vacios2 < nFilas) {
                filas = nFilas * 2;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2;
            }
            if (inputs_vacios3 < nFilas) {
                filas = nFilas * 3;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3;
            }
            if (inputs_vacios4 < nFilas) {
                filas = nFilas * 4;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4;
            }
            if (inputs_vacios5 < nFilas) {
                filas = nFilas * 5;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4 + inputs_vacios5;
            }
            if (inputs_vacios6 < nFilas) {
                filas = nFilas * 6
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4 + inputs_vacios5 + inputs_vacios6;
            }
            if (inputs_vacios7 < nFilas) {
                filas = nFilas * 7;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4 + inputs_vacios5 + inputs_vacios6 + inputs_vacios7;
            }
            if (inputs_vacios8 < nFilas) {
                filas = nFilas * 8;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4 + inputs_vacios5 + inputs_vacios6 + inputs_vacios7 + inputs_vacios8;
            }
            if (inputs_vacios9 < nFilas) {
                filas = nFilas * 9;
                total_inputs_vacios = inputs_vacios1 + inputs_vacios2 + inputs_vacios3 + inputs_vacios4 + inputs_vacios5 + inputs_vacios6 + inputs_vacios7 + inputs_vacios8 + inputs_vacios9;
            }

            evaluar_error(inputs_vacios1, 1, nFilas);
            evaluar_error(inputs_vacios2, 2, nFilas);
            evaluar_error(inputs_vacios3, 3, nFilas);
            evaluar_error(inputs_vacios4, 4, nFilas);
            evaluar_error(inputs_vacios5, 5, nFilas);
            evaluar_error(inputs_vacios6, 6, nFilas);
            evaluar_error(inputs_vacios7, 7, nFilas);
            evaluar_error(inputs_vacios8, 8, nFilas);
            evaluar_error(inputs_vacios9, 9, nFilas);

            if (total_inputs_vacios == 0 && total_inputs_vacios < filas) {
                $(".calificacion").removeClass("error_input");
                $("#guardar").attr("disabled", "disabled");
                $("#alerta").removeClass("alert-danger").addClass("alert-success");
                $("#mensaje_texto").html("Las calificaciones han sido cargadas correctamente");
                $("#mensaje_error").slideDown(1000).delay(1000).slideUp(1000, function() {
                    $("#guardar").removeAttr("disabled");
                    $("#formulario").submit();
                });
            } else if (total_inputs_vacios > 0) {
                $("#alerta").removeClass("alert-success").addClass("alert-danger");
                $("#guardar").attr("disabled", "disabled");
                $("#mensaje_error").stop(true);
                $("#mensaje_texto").html("No deben quedar estudiantes con parciales vacios en sus respectivos cuadros de texto");
                $("#mensaje_error").slideDown(1000).delay(4000).slideUp(1000, function(){
                    $("#guardar").removeAttr("disabled");
                });
                
            }
        } else {
            $("#formulario")[0].reportValidity();
        }
    });

    function evaluar_error(inputs_vacios, id, filas) {
        if (inputs_vacios < filas && inputs_vacios > 0) {
            for (i = 1; i <= filas; i++) {
                let idestudiante = $("#idestudiante" + i).val();
                let calificacion = $("#p" + id + "-" + idestudiante).val();

                if (calificacion == "") {
                    $("#p" + id + "-" + idestudiante).addClass("error_input");
                } else {
                    $("#p" + id + "-" + idestudiante).removeClass("error_input");
                }
            }
        } else if (inputs_vacios == 0) {
            $(".verificar_espacio_v" + id).removeClass("error_input");
        }
    }

    function evaluar_vacios(filas, id) {
        let inputs_vacios = 0;

        for (let i = 1; i <= filas; i++) {
            let idestudiante = $("#idestudiante" + i).val();
            let calificacion = $("#p" + id + "-" + idestudiante).val();

            if (calificacion == "") {
                inputs_vacios = inputs_vacios + 1;
            }
        }
        return inputs_vacios;
    }
})');
?>