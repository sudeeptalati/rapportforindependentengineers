<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Servicecall */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicecalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicecall-view">

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
            'service_reference_number',
            'customer_id',
            'product_id',
            'contract_id',
            'engineer_id',
            'insurer_reference_number:ntext',
            'job_status_id',
            'fault_date',
            'fault_code:ntext',
            'fault_description:ntext',
            'engg_diary_id',
            'work_carried_out:ntext',
            'spares_used_status_id',
            'total_cost',
            'vat_on_total',
            'net_cost',
            'job_payment_date',
            'job_finished_date',
            'notes:ntext',
            'created_by_user_id',
            'created',
            'modified',
            'cancelled',
            'closed',
            'number_of_visits',
            'activity_log:ntext',
            'comments:ntext',
            'recalled_job',
            'work_summary:ntext',
        ],
    ]) ?>

</div>
