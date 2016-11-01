<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contract_id',
            'brand_id',
            'product_type_id',
            'customer_id',
            'engineer_id',
            'purchased_from:ntext',
            'purchase_date',
            'warranty_date',
            'model_number:ntext',
            'serial_number:ntext',
            'production_code:ntext',
            'enr_number:ntext',
            'fnr_number:ntext',
            'discontinued',
            'warranty_for_months',
            'purchase_price',
            'notes:ntext',
            'created_by_user_id',
            'created',
            'modified',
            'cancelled',
            'lockcode',
        ],
    ]) ?>

</div>
