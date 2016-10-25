<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sparesused */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sparesused-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'master_item_id')->textInput() ?>

    <?= $form->field($model, 'servicecall_id')->textInput() ?>

    <?= $form->field($model, 'item_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'part_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'unit_price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'date_ordered')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'created_by_user')->textInput() ?>

    <?= $form->field($model, 'used')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
