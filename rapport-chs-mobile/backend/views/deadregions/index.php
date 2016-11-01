<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DeadregionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deadregions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deadregions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Deadregions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dead_id',
            'postcode:ntext',
            'product_type_name:ntext',
            'brand_name:ntext',
            'latitude',
            // 'longitude',
            // 'postcode_s',
            // 'postcode_e',
            // 'product_id',
            // 'manufacturer_id',
            // 'resolved',
            // 'ip_address',
            // 'date_logged',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
