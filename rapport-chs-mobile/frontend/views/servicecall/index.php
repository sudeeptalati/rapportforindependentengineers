<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicecallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicecalls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicecall-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Servicecall', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'service_reference_number',
            'customer_id',
            'product_id',
            'contract_id',
            // 'engineer_id',
            // 'insurer_reference_number:ntext',
            // 'job_status_id',
            // 'fault_date',
            // 'fault_code:ntext',
            // 'fault_description:ntext',
            // 'engg_diary_id',
            // 'work_carried_out:ntext',
            // 'spares_used_status_id',
            // 'total_cost',
            // 'vat_on_total',
            // 'net_cost',
            // 'job_payment_date',
            // 'job_finished_date',
            // 'notes:ntext',
            // 'created_by_user_id',
            // 'created',
            // 'modified',
            // 'cancelled',
            // 'closed',
            // 'number_of_visits',
            // 'activity_log:ntext',
            // 'comments:ntext',
            // 'recalled_job',
            // 'work_summary:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
