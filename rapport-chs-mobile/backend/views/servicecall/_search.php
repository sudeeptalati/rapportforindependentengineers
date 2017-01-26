<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicecallSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicecall-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'service_reference_number') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'contract_id') ?>

    <?php // echo $form->field($model, 'engineer_id') ?>

    <?php // echo $form->field($model, 'insurer_reference_number') ?>

    <?php // echo $form->field($model, 'job_status_id') ?>

    <?php // echo $form->field($model, 'fault_date') ?>

    <?php // echo $form->field($model, 'fault_code') ?>

    <?php // echo $form->field($model, 'fault_description') ?>

    <?php // echo $form->field($model, 'engg_diary_id') ?>

    <?php // echo $form->field($model, 'work_carried_out') ?>

    <?php // echo $form->field($model, 'spares_used_status_id') ?>

    <?php // echo $form->field($model, 'total_cost') ?>

    <?php // echo $form->field($model, 'vat_on_total') ?>

    <?php // echo $form->field($model, 'net_cost') ?>

    <?php // echo $form->field($model, 'job_payment_date') ?>

    <?php // echo $form->field($model, 'job_finished_date') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'created_by_user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'cancelled') ?>

    <?php // echo $form->field($model, 'closed') ?>

    <?php // echo $form->field($model, 'number_of_visits') ?>

    <?php // echo $form->field($model, 'activity_log') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'recalled_job') ?>

    <?php // echo $form->field($model, 'work_summary') ?>

    <?php // echo $form->field($model, 'admintime') ?>

    <?php // echo $form->field($model, 'remote_ref_no') ?>

    <?php // echo $form->field($model, 'remote_data_recieved') ?>

    <?php // echo $form->field($model, 'communications') ?>

    <?php // echo $form->field($model, 'remote_data_sent') ?>

    <?php // echo $form->field($model, 'test_results') ?>

    <?php // echo $form->field($model, 'received_remote_data_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
