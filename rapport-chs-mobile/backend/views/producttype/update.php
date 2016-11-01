<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Producttype */

$this->title = 'Update Producttype: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="producttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
