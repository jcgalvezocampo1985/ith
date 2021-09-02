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
    $link = ($profesor == 1) ? '/profesor/' : '/profesor/horarioconsulta';
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
            //['label' => 'Sitio', 'url' => ['/site/']],
            //['label' => 'Usuarios', 'url' => ['/usuario/']],
            Yii::$app->user->isGuest ? "" : (['label' => 'Profesores', 'url' => [$link]]),
            //Yii::$app->user->isGuest ? "" : (['label' => 'ProfesoresH', 'url' => ['/profesor/horarioconsulta']]),
            //['label' => 'Estudiantes', 'url' => ['/estudiante/']],
            ['label' => 'Boleta', 'url' => ['/estudiante/boleta']],
            ['label' => 'Horario', 'url' => ['/estudiante/horario']],
            /*['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],*/
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
</body>
</html>
<?php $this->endPage() ?>