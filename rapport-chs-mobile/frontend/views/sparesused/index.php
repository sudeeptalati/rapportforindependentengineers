<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SparesusedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sparesuseds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sparesused-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sparesused', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'master_item_id',
            'servicecall_id',
            'item_name:ntext',
            'part_number:ntext',
            // 'unit_price',
            // 'quantity',
            // 'total_price',
            // 'date_ordered',
            // 'created',
            // 'modified',
            // 'created_by_user',
            // 'used',
            // 'notes:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
