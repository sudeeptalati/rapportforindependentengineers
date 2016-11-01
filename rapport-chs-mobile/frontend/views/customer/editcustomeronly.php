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

<?php $customer_model=Customer::findOne($customer_id);?>


<div class="customer-form">

    <?php $form = ActiveForm::begin([
        'action' =>['customer/updateeditcustomeronly','customer_id'=>$customer_id, 'servicecall_id'=>$servicecall_id, 'enggdiary_id'=>$enggdiary_id],
        'id' => 'edit_customer',
        'method' => 'post',

    ]);
    ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($customer_model, 'id')->hiddenInput()->label(false); ?>

    <hr>
    <div>
        <h2 class="text-center">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i>
        </h2>
        <table class="responsive-stacked-table">
            <tr>
                <td><?= $form->field($customer_model, 'title')->dropDownList(Handyfunctions::name_title()); ?></td>
                <td><?= $form->field($customer_model, 'first_name')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'last_name')->textInput(); ?></td>
            </tr>
        </table>

    </div>

    <hr>
    <div>
        <h3 class="text-center">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
        </h3>

        <table class="responsive-stacked-table">
            <tr>
                <td><?= $form->field($customer_model, 'address_line_1')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'address_line_2')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'address_line_3')->textInput(); ?></td>
            </tr>
            <tr>

                <td><?= $form->field($customer_model, 'town')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'postcode')->textInput(); ?></td>
            </tr>
            <tr>

                <td>
                    <i class="fa fa-car" aria-hidden="true"></i> <b>Parking Restrictions</b>

                    <?= $form->field($customer_model, 'fax')->textInput()->label(false); ?>

                </td>
            </tr>

        </table>




    </div>


    <hr>
    <div>
        <table class="full_width">
            <tr>
                <td class="text-center">
                    <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                </td>
                <td class="text-center">
                    <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                </td>
                <td class="text-center">
                    <i class="fa-2x">@</i>
                </td>

            </tr>

        </table>
        <h4 class="text-center">
        </h4>

        <table class="responsive-stacked-table">
            <tr>
                <td><?= $form->field($customer_model, 'telephone')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'mobile')->textInput(); ?></td>
                <td><?= $form->field($customer_model, 'email')->textInput(); ?></td>
            </tr>
        </table>
    </div>


    <?= $form->field($customer_model, 'notes')->textarea(['rows' => 6]) ?>


    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>