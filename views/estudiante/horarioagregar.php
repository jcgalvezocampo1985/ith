<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="panel panel-primary">
    <div class="panel-heading">Asignar materia</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabla">
                        <thead>
                            <tr>
                                <th>Ciclo</th>
                                <th>Grupo</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Semestre</th>
                                <th>Opción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="lista_materias">
                            <?php foreach($materias as $row): ?>
                            <tr id="fila-<?= $row['idgrupo'].$idestudiante ?>">
                                <td><?= $row['desc_ciclo'] ?></td>
                                <td><?= $row['desc_grupo'] ?></td>
                                <td><?= $row['desc_materia'] ?></td>
                                <td><?= $row['creditos'] ?></td>
                                <td><?= $row['num_semestre'] ?></td>
                                <td>
                                    <select name="idopcion_curso[]" id="idopcion_curso-<?= $row['idgrupo'].$idestudiante ?>" class="idopcion_curso">
                                        <option value=""></option>
                                        <?php foreach($opcion_curso as $row1): ?>
                                        <option value="<?= $row1["idopcion_curso"] ?>"><?= $row1["desc_opcion_curso"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>
                                    <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."estudiante/agregarmateria" ?>" class="btn-sm btn-warning agregar_materia" id="fila-<?= $row['idgrupo'].$idestudiante ?>">Agregar</a>
                                    <input type="hidden" name="idgrupo" id="idgrupo-<?= $row['idgrupo'].$idestudiante ?>" value="<?= $row['idgrupo'] ?>" readonly="true" />
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </div>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="idestudiante" id="idestudiante" value="<?= $idestudiante ?>" readonly="true" />
<input type="hidden" name="idciclo" id="idciclo" value="<?= $idciclo ?>" readonly="true" />
<?php
$this->registerJs('$(document).ready(function(){
    $(".agregar_materia").on("click", function(e) {
        e.preventDefault();

        var url = $(this).attr("href");
        var fila = $(this).attr("id");
        var numero = fila.split("-")[1];

        var idopcion_curso = $("#idopcion_curso-" + numero).val();
        var idestudiante = $("#idestudiante").val();
        var idciclo = $("#idciclo").val();
        var idgrupo = $("#idgrupo-" + numero).val();

        if (idopcion_curso !== "") {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    "idgrupo": idgrupo,
                    "idopcion_curso": idopcion_curso,
                    "idestudiante": idestudiante,
                    "idciclo": idciclo
                },
                success: function(data) {
                    if (data == "1") {
                        $("tr#fila-" + numero).remove();
                        alert("Materia agregada");
                    }
                }
            });
        } else {    
            alert("Selecciona la opción del curso");
        }
    });
})', \yii\web\VIEW::POS_HEAD);
?>