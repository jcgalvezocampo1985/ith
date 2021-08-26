<div class="panel panel-primary">
    <div class="panel-heading">Lista de alumnos</div>
    <div class="panel-body">
        <a href="<?= Yii::$app->request->hostInfo.Yii::$app->homeUrl."reporte/listaalumnos?idgrupo=".$idgrupo ?>" class="btn btn-success">Descargar Lista</a>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th>No. Control</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Opción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model as $row): ?>
                <tr>
                    <td><?= $row['idestudiante'] ?></td>
                    <td><?= $row['nombre_estudiante'] ?></td>
                    <td><?= $row['sexo'] ?></td>
                    <td><?= $row['desc_opcion_curso'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
