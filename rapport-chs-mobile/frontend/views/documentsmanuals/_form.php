<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Documentsmanuals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentsmanuals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_type_id')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'product_type_id')->textInput() ?>

    <?= $form->field($model, 'model_nos')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'created_by_user_id')->textInput() ?>

    <?= $form->field($model, 'filename')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'version')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
