<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Engineer */

$this->title = 'Create Engineer';
$this->params['breadcrumbs'][] = ['label' => 'Engineers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engineer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
