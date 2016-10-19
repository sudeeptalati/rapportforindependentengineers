<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Postcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postcodes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'postcode_id')->textInput() ?>

    <?= $form->field($model, 'postcode_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_x')->textInput() ?>

    <?= $form->field($model, 'p_y')->textInput() ?>

    <?= $form->field($model, 'old_latitude')->textInput() ?>

    <?= $form->field($model, 'old_longitude')->textInput() ?>

    <?= $form->field($model, 'roundrobin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
