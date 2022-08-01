<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Estudiantes";
$this->params["breadcrumbs"][] = $this->title;
?>
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
</style>
<div class="row">
    <div class="col-md-2">
        <h4>Ciclo: <small><?= $datos_grupo[0]["desc_ciclo"] ?></small></h4>
    </div>
    <div class="col-md-2">
        <h4>Carrera: <small><?= $datos_grupo[0]["profesor"] ?></small></h4>
    </div>
    <div class="col-md-3">
        <h4>Carrera: <small><?= $datos_grupo[0]["desc_carrera"] ?></small></h4>
    </div>
    <div class="col-md-3">
        <h4>Materia: <small><?= $datos_grupo[0]["desc_materia"] ?></small></h4>
    </div>
    <div class="col-md-2">
        <h4>Grupo: <small><?= $datos_grupo[0]["desc_grupo"] ?></small></h4>
    </div>
</div>
<div class="row">
    <form method="POST" id="datos-alumnos" action="return false;">
    <div class="col-md-6">
        <div class="form-group">
            <label for="idestudiante">Estudiante</label>
            <select name="idestudiante" id="idestudiante" class="form-control">
                <option value=""></option>
                <?php foreach($estudiantes as $row): ?>
                <option value="<?= $row['idestudiante'] ?>"><?= "(".$row['idestudiante'].") ".$row['nombre_estudiante'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="idopcioncurso">Opción</label>
            <select name="idopcioncurso" id="idopcioncurso" class="form-control">
                <option value=""></option>
                <?php foreach($opcion_cursos as $row): ?>
                <option value="<?= $row['idopcion_curso'] ?>"><?= $row['desc_opcion_curso'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."grupo/guardarestudiantesgrupo/" ?>" class="btn btn-primary" id="agregar-alumnos">Agregar</a>
        </div>
    </div>
    <input type="hidden" name="idgrupo" id="idgrupo" value="<?= $idgrupo?>" />
    </form>
</div>
<hr width="100%">
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-striped" id="tabla-estudiantes">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-center">No. Control</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Promedio</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($model as $row):
                    $promedio = $row["promedio"];
                ?>
                    <tr class="tr_clone">
                        <td><?= $row["idestudiante"] ?></td>
                        <td><?= $row["nombre_estudiante"] ?></td>
                        <td class="text-center <?= ($promedio >= 70) ? "bg-success text-success" : "bg-danger text-danger" ?>"><?= $row["promedio"] ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$this->registerCss('
.table-responsive {
  overflow-y: visible !important;
}
@media (max-width: 767px) {
    .table-responsive .dropdown-menu {
        position: static !important;
    }
}
@media (min-width: 768px) {
    .table-responsive {
        overflow: inherit;
    }
}
');
?>
<?= Yii::$app->view->renderFile("@app/views/grupo/scriptsModal.php") ?>