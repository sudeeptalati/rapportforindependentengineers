<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Font Awesome-->
    <script src="https://use.fontawesome.com/e1a64274e1.js"></script>
    <!-- UKW Logo set -->
    <script src="https://use.fortawesome.com/860d66d0.js"></script>
    <!-- UKW Icon set -->
    <script src="https://use.fortawesome.com/a8e251d4.js"></script>
    <!-- Recaptcha-->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
<?php $this->beginBody() ?>

<?= Html::hiddenInput('google_maps_api_key',Yii::$app->params['google_maps_api_key'], ['id'=>'google_maps_api_key']) ?>
<?= Html::hiddenInput('frontend_url',Yii::$app->params['frontend_url'], ['id'=>'frontend_url']) ?>

<div class="wrap">
    <?php
       NavBar::begin([
        'brandLabel' => 'Today',
        'brandUrl' => Yii::$app->homeUrl,
        //'brandUrl' => 'index.php?r=findanengineer',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',

        ],
    ]);
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        //$menuItems[] = ['label' => 'Find WTA Member', 'url' => ['/findanengineer/findwtamember']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        $menuItems = [
            ['label' => 'Calendar', 'url' => ['/site/calendar']],
            //['label' => 'Website Integration', 'url' => ['/site/about']],
//            ['label' => 'WTA Members', 'url' => ['/findanengineer/findwtamember']],
//            ['label' => 'Website Integration', 'url' => ['/engineer/webintegration']],
//            ['label' => 'Customers', 'url' => ['/customer']],
//            ['label' => 'Failed Regions', 'url' => ['/deadregions']],
//            ['label' => 'Account', 'url' => ['/engineer']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
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
        <p class="pull-left">&copy; &nbsp;UK Whitegoods Ltd. <?= date('Y') ?></p>
        <!--
        <p class="pull-right"><?= Yii::powered() ?></p>
        -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
