<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'first_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fullname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_line_1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_line_2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_line_3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'town')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'postcode_s')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'postcode_e')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'postcode')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'county')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'state')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'latitudes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'longitudes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telephone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mobile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fax')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by_user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'lockcode')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
