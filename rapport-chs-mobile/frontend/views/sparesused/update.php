<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sparesused */

$this->title = 'Update Sparesused: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sparesuseds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sparesused-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
