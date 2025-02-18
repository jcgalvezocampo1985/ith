<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\login\User;
use app\models\User as Usuario;

AppAsset::register($this);

if(!Yii::$app->user->isGuest){
    $profesor = Usuario::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
    $link = ($profesor) ? '/profesor/horario' : '/profesor/horarioconsulta';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Yii::$app->view->renderFile("@app/views/layouts/styles.php") ?>
    <?php $this->head() ?>
    <style>
        .container{
            width: auto;
        }
    </style>   
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? "" : (['label' => 'Profesores', 'url' => [$link]]),
            Yii::$app->user->isGuest ? "" : (['label' => 'Horario Estudiantes', 'url' => ['/estudiante/horariomodificar']]),
            ['label' => 'Boleta', 'url' => ['/estudiante/boleta']],
            ['label' => 'Horario', 'url' => ['/estudiante/horario']],
            ['label' => 'Calificaciones ', 'url' => ['/estudiante/calificaciones']],
            Yii::$app->user->isGuest ? "" :(
            ['label' => 'Admin', 'items' =>
                [
                    ['label' => 'Profesores', 'url' => ['/profesor/index']],
                    ['label' => 'Estudiantes', 'url' => ['/estudiante/index']],
                    ['label' => 'Seguimientos', 'url' => ['/profesorseguimiento/index']],
                    ['label' => 'Carreras', 'url' => ['/carrera/index']],
                    ['label' => 'Materias', 'url' => ['/materia/index']],
                    ['label' => 'Opc. Curso', 'url' => ['/opcioncurso/index']],
                    ['label' => 'Ciclos', 'url' => ['/ciclo/index']],
                    ['label' => 'Grupos', 'url' => ['/grupo/index']],
                    ['label' => 'Usuarios', 'url' => ['/usuario/index']],
                    ['label' => 'Evaluación Docente', 'url' => ['/evaluaciondocente/index']],
                ]
            ]),
            Yii::$app->user->isGuest ? (
                ['label' => 'Acceder', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->curp . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Instituto Tecnológico de Huimanguillo <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<?= Yii::$app->view->renderFile("@app/views/layouts/scripts.php") ?>
</body>
</html>
<?php $this->endPage() ?>