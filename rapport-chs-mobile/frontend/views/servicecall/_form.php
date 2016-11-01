<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Servicecall */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicecall-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_reference_number')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'contract_id')->textInput() ?>

    <?= $form->field($model, 'engineer_id')->textInput() ?>

    <?= $form->field($model, 'insurer_reference_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'job_status_id')->textInput() ?>

    <?= $form->field($model, 'fault_date')->textInput() ?>

    <?= $form->field($model, 'fault_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fault_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'engg_diary_id')->textInput() ?>

    <?= $form->field($model, 'work_carried_out')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spares_used_status_id')->textInput() ?>

    <?= $form->field($model, 'total_cost')->textInput() ?>

    <?= $form->field($model, 'vat_on_total')->textInput() ?>

    <?= $form->field($model, 'net_cost')->textInput() ?>

    <?= $form->field($model, 'job_payment_date')->textInput() ?>

    <?= $form->field($model, 'job_finished_date')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by_user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'cancelled')->textInput() ?>

    <?= $form->field($model, 'closed')->textInput() ?>

    <?= $form->field($model, 'number_of_visits')->textInput() ?>

    <?= $form->field($model, 'activity_log')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'recalled_job')->textInput() ?>

    <?= $form->field($model, 'work_summary')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
