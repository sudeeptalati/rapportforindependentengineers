<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostcodesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postcodes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'postcode_id') ?>

    <?= $form->field($model, 'postcode_s') ?>

    <?= $form->field($model, 'p_x') ?>

    <?= $form->field($model, 'p_y') ?>

    <?= $form->field($model, 'old_latitude') ?>

    <?php // echo $form->field($model, 'old_longitude') ?>

    <?php // echo $form->field($model, 'roundrobin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
