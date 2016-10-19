<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DayexpenseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dayexpense-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'expense_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'date_of_spend') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'spend_for_company') ?>

    <?php // echo $form->field($model, 'company_address') ?>

    <?php // echo $form->field($model, 'travel_from') ?>

    <?php // echo $form->field($model, 'travel_to') ?>

    <?php // echo $form->field($model, 'travel_mode') ?>

    <?php // echo $form->field($model, 'total_travel_expense') ?>

    <?php // echo $form->field($model, 'accomodation_details') ?>

    <?php // echo $form->field($model, 'accomodation_expense') ?>

    <?php // echo $form->field($model, 'breakfast_expense') ?>

    <?php // echo $form->field($model, 'lunch_expense') ?>

    <?php // echo $form->field($model, 'dinner_expense') ?>

    <?php // echo $form->field($model, 'other_expense_details') ?>

    <?php // echo $form->field($model, 'other_expense_amount') ?>

    <?php // echo $form->field($model, 'total_expense') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
