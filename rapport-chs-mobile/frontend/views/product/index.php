<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contract_id',
            'brand_id',
            'product_type_id',
            'customer_id',
            // 'engineer_id',
            // 'purchased_from:ntext',
            // 'purchase_date',
            // 'warranty_date',
            // 'model_number:ntext',
            // 'serial_number:ntext',
            // 'production_code:ntext',
            // 'enr_number:ntext',
            // 'fnr_number:ntext',
            // 'discontinued',
            // 'warranty_for_months',
            // 'purchase_price',
            // 'notes:ntext',
            // 'created_by_user_id',
            // 'created',
            // 'modified',
            // 'cancelled',
            // 'lockcode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
