<?php

use common\models\Brand;
use common\models\Producttype;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DeadregionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Failed Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deadregions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="bg-warning btn container">
        <h3>
            <span class="fa-stack fa-lg">
                <i class="fa fa-location-arrow fa-stack-1x"></i>
                <i class="fa fa-ban fa-stack-2x  fa-rotate-90 text-danger"></i>
            </span>

            These are the postcodes that are not covered by any engineers.
        </h3>
    </div>

    <?php

    echo $this->render('markdeadregionsonmap');
    ?>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dead_id',
            'postcode:ntext',

            [
                'attribute' => 'product_id',
                'filter' => ArrayHelper::map(Producttype::find()->all(), 'product_id', 'product_type'),
                'value' => 'producttype.product_type'
            ],

            [
                'attribute' => 'manufacturer_id',
                'filter' => ArrayHelper::map(Brand::find()->all(), 'manufacturer_id', 'manufacturer'),
                'value' => 'brand.manufacturer',
            ],


            'latitude',
            'longitude',
            // 'postcode_s',
            // 'postcode_e',
            // 'product_id',
            // 'manufacturer_id',
            // 'resolved',
            // 'ip_address',
            'date_logged',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
