<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contract_id')->textInput() ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'product_type_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'engineer_id')->textInput() ?>

    <?= $form->field($model, 'purchased_from')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'purchase_date')->textInput() ?>

    <?= $form->field($model, 'warranty_date')->textInput() ?>

    <?= $form->field($model, 'model_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'serial_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'production_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'enr_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fnr_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'discontinued')->textInput() ?>

    <?= $form->field($model, 'warranty_for_months')->textInput() ?>

    <?= $form->field($model, 'purchase_price')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by_user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'cancelled')->textInput() ?>

    <?= $form->field($model, 'lockcode')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
