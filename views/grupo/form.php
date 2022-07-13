<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = ($status == 1) ? "Modificar Grupo" : "Nuevo Grupo";
$this->params["breadcrumbs"][] = ["label" => "Grupo", "url" => ["index"]];
$this->params["breadcrumbs"][] = $this->title;

$action = ($status == 1) ? "update" : "store";

$lunes = $model->lunes == '' ? '""-""' : $model->lunes;
$lunes = explode("-", $lunes);

$martes = $model->martes == '' ? '""-""' : $model->martes;
$martes = explode("-", $martes);

$miercoles = $model->miercoles == '' ? '""-""' : $model->miercoles;
$miercoles = explode("-", $miercoles);

$jueves = $model->jueves == '' ? '""-""' : $model->jueves;
$jueves = explode("-", $jueves);

$viernes = $model->viernes == '' ? '""-""' : $model->viernes;
$viernes = explode("-", $viernes);

$sabado = $model->sabado == '' ? '""-""' : $model->sabado;
$sabado = explode("-", $sabado);

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => true,
    "action" => $action
]);
?>
<?= Yii::$app->view->renderFile("@app/views/errors/error.php", ["msg" => $msg, "error" => $error]) ?>
<div class="panel panel-primary">
    <div class="panel-heading"><?= $this->title ?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idciclo")->dropDownList($ciclos, ["prompt" => "Ciclo"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idcarrera")->dropDownList($carreras, ["prompt" => "Carrera"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idmateria")->dropDownList($materias, ["prompt" => "Materia"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "idprofesor")->dropDownList($profesores, ["prompt" => "Profesor",]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "num_semestre")->input("text", ["maxlength" => 2, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "desc_grupo")->input("text", ["maxlength" => 45, "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "desc_grupo_corto")->input("text", ["maxlength" => 10, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "aula")->input("text", ["maxlength" => 20, "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, "horario")->input("text", ["maxlength" => 100, "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "lunes_inicio")->input("time", ["value" => $lunes[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "lunes_fin")->input("time", ["value" => $lunes[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "martes_inicio")->input("time", ["value" => $martes[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "martes_fin")->input("time", ["value" => $martes[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "miercoles_inicio")->input("time", ["value" => $miercoles[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "miercoles_fin")->input("time", ["value" => $miercoles[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "jueves_inicio")->input("time", ["value" => $jueves[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "jueves_fin")->input("time", ["value" => $jueves[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "viernes_inicio")->input("time", ["value" => $viernes[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "viernes_fin")->input("time", ["value" => $viernes[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "sabado_inicio")->input("time", ["value" => $sabado[0], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, "sabado_fin")->input("time", ["value" => $sabado[1], "maxlength" => 45, "class" => "form-control horario", "autocomplete" => "off"]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitInput("Guardar", ["class" => "btn btn-success"]) ?>
                    <?= Html::a("Regresar", ["grupo/index"], ["class" => "btn btn-warning"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $form->field($model, "idgrupo")->hiddenInput(["value"=> $model->idgrupo, "readonly" => true])->label(false) ?>
<?= $form->field($model, "lunes")->hiddenInput(["value"=> $model->lunes, "readonly" => true])->label(false) ?>
<?= $form->field($model, "martes")->hiddenInput(["value"=> $model->lunes, "readonly" => true])->label(false) ?>
<?= $form->field($model, "miercoles")->hiddenInput(["value"=> $model->miercoles, "readonly" => true])->label(false) ?>
<?= $form->field($model, "jueves")->hiddenInput(["value"=> $model->jueves, "readonly" => true])->label(false) ?>
<?= $form->field($model, "viernes")->hiddenInput(["value"=> $model->viernes, "readonly" => true])->label(false) ?>
<?= $form->field($model, "sabado")->hiddenInput(["value"=> $model->sabado, "readonly" => true])->label(false) ?>
<?php $form->end() ?>

<?php
$this->registerJs("
    $('.horario').on('change', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

        var diaCompleto = id.split('-')[1];
        var dia = diaCompleto.split('_')[0];

        if(id == 'grupoform-' + dia + '_inicio')
        {
            var inicio = $('#'+id).val();
            var fin = $('#grupoform-' + dia + '_fin').val();

            $('#grupoform-' + dia).val(inicio + '-' + fin);
        }
        else if(id == 'grupoform-' + dia + '_fin')
        {
            var inicio = $('#grupoform-' + dia + '_inicio').val();
            var fin = $('#'+id).val();

            $('#grupoform-' + dia).val(inicio + '-' + fin);
        }
    });
");
?>