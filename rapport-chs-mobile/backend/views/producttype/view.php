<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Producttype */

$this->title = $model->product_type;
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producttype-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <!--
        <?= Html::a('Delete', ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'product_type',
        ],
    ]) ?>

</div>
