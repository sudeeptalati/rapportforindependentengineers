<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enquiry_number')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preferred_contact_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'manufacturer_id')->textInput() ?>

    <?= $form->field($model, 'technician_id')->textInput() ?>

    <?= $form->field($model, 'model_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fault_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'preferred_visit_date')->textInput() ?>

    <?= $form->field($model, 'preferred_visit_time')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hear_about_us_dropdown')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hear_about_us_freetext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
