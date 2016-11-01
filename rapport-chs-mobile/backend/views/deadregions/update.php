<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Deadregions */

$this->title = 'Update Deadregions: ' . $model->dead_id;
$this->params['breadcrumbs'][] = ['label' => 'Deadregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dead_id, 'url' => ['view', 'id' => $model->dead_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deadregions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
