<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
