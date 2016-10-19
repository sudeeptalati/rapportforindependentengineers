<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Dayexpense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dayexpense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'expense_id')->textInput()->hiddenInput()->label(false); ?> ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'date_of_spend')->textInput() ?>

    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spend_for_company')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'travel_from')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'travel_to')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'travel_mode')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_travel_expense')->textInput() ?>

    <?= $form->field($model, 'accomodation_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accomodation_expense')->textInput() ?>

    <?= $form->field($model, 'breakfast_expense')->textInput() ?>

    <?= $form->field($model, 'lunch_expense')->textInput() ?>

    <?= $form->field($model, 'dinner_expense')->textInput() ?>

    <?= $form->field($model, 'other_expense_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_expense_amount')->textInput() ?>

    <?= $form->field($model, 'total_expense')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
