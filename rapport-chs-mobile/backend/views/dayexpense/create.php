<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dayexpense */

$this->title = Yii::t('app', 'Create Dayexpense');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dayexpenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
