<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Deadregions */

$this->title = 'Create Deadregions';
$this->params['breadcrumbs'][] = ['label' => 'Deadregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deadregions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
