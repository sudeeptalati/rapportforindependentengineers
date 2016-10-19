<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EngineerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="engineer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'company_type_id') ?>

    <?= $form->field($model, 'wta_member') ?>

    <?php // echo $form->field($model, 'wta_associate_member') ?>

    <?php // echo $form->field($model, 'wta_membership_number') ?>

    <?php // echo $form->field($model, 'wta_membership_expiry_date') ?>

    <?php // echo $form->field($model, 'line_1') ?>

    <?php // echo $form->field($model, 'line_2') ?>

    <?php // echo $form->field($model, 'line_3') ?>

    <?php // echo $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'county') ?>

    <?php // echo $form->field($model, 'postcode_s') ?>

    <?php // echo $form->field($model, 'postcode_e') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'cell') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'on_holiday') ?>

    <?php // echo $form->field($model, 'blurb') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'ordering') ?>

    <?php // echo $form->field($model, 'web_site') ?>

    <?php // echo $form->field($model, 'unverified_email') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'business_principle') ?>

    <?php // echo $form->field($model, 'staffted_office') ?>

    <?php // echo $form->field($model, 'total_employees') ?>

    <?php // echo $form->field($model, 'total_engineers') ?>

    <?php // echo $form->field($model, 'average_response_time') ?>

    <?php // echo $form->field($model, 'average_turnover') ?>

    <?php // echo $form->field($model, 'company_reg_number') ?>

    <?php // echo $form->field($model, 'vat_number') ?>

    <?php // echo $form->field($model, 'working_premises') ?>

    <?php // echo $form->field($model, 'accept_contracts') ?>

    <?php // echo $form->field($model, 'accept_spot_contracts') ?>

    <?php // echo $form->field($model, 'accounts_contact_person') ?>

    <?php // echo $form->field($model, 'accounts_contact_address') ?>

    <?php // echo $form->field($model, 'accounts_telephone') ?>

    <?php // echo $form->field($model, 'accounts_email') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'phoneclicks') ?>

    <?php // echo $form->field($model, 'enquiryclick') ?>

    <?php // echo $form->field($model, 'impressions') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
