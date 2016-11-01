<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Servicecall */

$this->title = 'Update Servicecall: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicecalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicecall-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
