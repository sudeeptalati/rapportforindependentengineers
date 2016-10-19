<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnggdiarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enggdiaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enggdiary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Enggdiary', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'engineer_id',
            'visit_start_date',
            'visit_end_date',
            'slots',
            // 'servicecall_id',
            // 'user_id',
            // 'created',
            // 'modified',
            // 'status',
            // 'notes:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
