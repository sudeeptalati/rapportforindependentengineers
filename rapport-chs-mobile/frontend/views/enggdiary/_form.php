<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Enggdiary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enggdiary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'engineer_id')->textInput() ?>

    <?= $form->field($model, 'visit_start_date')->textInput() ?>

    <?= $form->field($model, 'visit_end_date')->textInput() ?>

    <?= $form->field($model, 'slots')->textInput() ?>

    <?= $form->field($model, 'servicecall_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
