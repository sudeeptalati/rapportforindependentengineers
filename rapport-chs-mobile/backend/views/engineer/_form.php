<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Engineer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="engineer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'company_type_id')->textInput() ?>

    <?= $form->field($model, 'wta_member')->textInput() ?>

    <?= $form->field($model, 'wta_associate_member')->textInput() ?>

    <?= $form->field($model, 'wta_membership_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wta_membership_expiry_date')->textInput() ?>

    <?= $form->field($model, 'line_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

     <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'on_holiday')->textInput() ?>

    <?= $form->field($model, 'blurb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published')->textInput() ?>

    <?= $form->field($model, 'ordering')->textInput() ?>

    <?= $form->field($model, 'web_site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unverified_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'business_principle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'staffted_office')->textInput() ?>

    <?= $form->field($model, 'total_employees')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_engineers')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'average_response_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'average_turnover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_reg_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vat_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'working_premises')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accept_contracts')->textInput() ?>

    <?= $form->field($model, 'accept_spot_contracts')->textInput() ?>

    <?= $form->field($model, 'accounts_contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounts_contact_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accounts_telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounts_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>
<!--
    <?= $form->field($model, 'phoneclicks')->textInput() ?>

    <?= $form->field($model, 'enquiryclicks')->textInput() ?>

    <?= $form->field($model, 'impressions')->textInput() ?>
-->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
