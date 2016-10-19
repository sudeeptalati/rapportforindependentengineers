<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/10/2016
 * Time: 12:09
 */


use yii\widgets\ActiveForm;

use common\models\Customer;
use common\models\Handyfunctions;

use yii\helpers\Html;

?>

<?php

$customer_model=Customer::findOne($customer_id);

?>


<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($customer_model, 'id')->hiddenInput()->label(false); ?>

    <hr>
    <div>
        <h2 class="text-center">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i>
        </h2>
        <?= $form->field($customer_model, 'title')->dropDownList(Handyfunctions::name_title()); ?>
        <?= $form->field($customer_model, 'first_name')->textInput(); ?>
        <?= $form->field($customer_model, 'last_name')->textInput(); ?>

    </div>

    <hr>
    <div>
        <h3 class="text-center">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
        </h3>

        <?= $form->field($customer_model, 'address_line_1')->textInput(); ?>
        <?= $form->field($customer_model, 'address_line_2')->textInput(); ?>
        <?= $form->field($customer_model, 'address_line_3')->textInput(); ?>
        <?= $form->field($customer_model, 'town')->textInput(); ?>
        <?= $form->field($customer_model, 'postcode')->textInput(); ?>

        <i class="fa fa-car" aria-hidden="true"></i> <b>Parking Restrictions</b>

        <?= $form->field($customer_model, 'fax')->textInput()->label(false); ?>

    </div>


    <hr>
    <div>
        <h4 class="text-center">
            <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
            <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
            <i class="fa-2x">@</i>
        </h4>

        <?= $form->field($customer_model, 'telephone')->textInput(); ?>


        <?= $form->field($customer_model, 'mobile')->textInput(); ?>

        <?= $form->field($customer_model, 'email')->textInput(); ?>
    </div>















    <?= $form->field($customer_model, 'notes')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($customer_model->isNewRecord ? 'Create' : 'Update', ['class' => $customer_model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>