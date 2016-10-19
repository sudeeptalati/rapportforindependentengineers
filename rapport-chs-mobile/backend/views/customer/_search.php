<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'enquiry_number') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'line_1') ?>

    <?php // echo $form->field($model, 'line_2') ?>

    <?php // echo $form->field($model, 'line_3') ?>

    <?php // echo $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'county') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'cell') ?>

    <?php // echo $form->field($model, 'preferred_contact_method') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'manufacturer_id') ?>

    <?php // echo $form->field($model, 'technician_id') ?>

    <?php // echo $form->field($model, 'model_number') ?>

    <?php // echo $form->field($model, 'fault_description') ?>

    <?php // echo $form->field($model, 'preferred_visit_date') ?>

    <?php // echo $form->field($model, 'preferred_visit_time') ?>

    <?php // echo $form->field($model, 'other_notes') ?>

    <?php // echo $form->field($model, 'hear_about_us_dropdown') ?>

    <?php // echo $form->field($model, 'hear_about_us_freetext') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
