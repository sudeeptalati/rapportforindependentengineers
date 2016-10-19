<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/09/2016
 * Time: 11:00
 */


use common\models\Handyfunctions;
use frontend\assets\LocateAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

LocateAsset::register($this);

?>

<style>
    .form-section-baseline {
        margin-top: 40px;
        border-bottom: thick solid #dcdcdc;
        margin-bottom: 20px;

    }

    .form-section-heading {
        background: gainsboro;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        text-align: right;
        padding: 10px 18px;
        font-weight: 300;
        letter-spacing: 3px;
        font-size: 18px;
        margin-bottom: 20px;
    }
    .equiry-form-small-textfield{
        width: 100px;
        margin: 0px 10px;
    }
    .enquiry-form-textfield
    {
        margin:0px 10px;
        width: 250px;
    }
    .enquiry-form-full-width-field {
        width: 100%;
        margin: 0px 10px;

    }
</style>


<h1><i class="ukwfa ukwfa-engineer-repair"></i> <?php echo $new_customer_model->engineer->name; ?></h1>

<div class="alert-danger">
    <?php echo Handyfunctions::print_model_errors($new_customer_model); ?>
</div>


<table style="width: 100%">
    <tr>
        <th style="width: 33%"></th>
        <th style="width: 33%"></th>
        <th style="width: 33%"></th>
    </tr>
    <tr>
        <td>
            <h1 style="text-align: center">
                <i class="fa fa-street-view" aria-hidden="true"></i>
                <h4 style="text-align: center" title="Your Postcode">
                    <?php echo $new_customer_model->postcode; ?>
                </h4>
            </h1>
        </td>


        <td title="Your Product Type">
            <h1 style="text-align: center">
                <?php echo Handyfunctions::getawesomeapplianceicon($product_type_name); ?>
            </h1>

            <h4 style="text-align: center" title="Your Product Type">
                <?php echo $product_type_name; ?>
            </h4>
        </td>
        <td title="Your Product Make (Brand) ">
            <h1 style="text-align: center">
                <?php echo Handyfunctions::getawesomebrandicon($brand_name); ?>
            </h1>
            <h4 style="text-align: center" title="Your Product Make (Brand)">
                <?php echo $brand_name; ?>
            </h4>
        </td>

    </tr>
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>

</table>


<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>


    <table style="width: 100%">
        <tr>
            <th style="width: 33%"></th>
            <th style="width: 33%"></th>
            <th style="width: 33%"></th>
        </tr>
        <!-- Personal Details -->
        <tr>
            <td colspan="2">
                <div class="form-section-baseline">
                </div>
            </td>
            <td>
                <div class="form-section-heading">
                    About You
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <div class="equiry-form-small-textfield">
                                <?= $form->field($new_customer_model, 'title')->textInput()->dropDownList(Handyfunctions::name_title())->label(false) ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield">
                                <?= $form->field($new_customer_model, 'last_name', ['inputOptions' => ['placeholder'=>'Please Enter your Name', 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>

                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <!-- Address Details -->
        <tr>
            <td colspan="2">
                <div class="form-section-baseline">
                </div>
            </td>
            <td>
                <div class="form-section-heading">
                    Address
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <div class="equiry-form-small-textfield">
                                <?= $form->field($new_customer_model, 'line_1', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('line_1'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield">
                                <?= $form->field($new_customer_model, 'line_2', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('line_2'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield">
                                <?= $form->field($new_customer_model, 'line_3', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('line_3'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>

            </td>
        </tr>

        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <div class="enquiry-form-textfield">
                                <?= $form->field($new_customer_model, 'town', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('town'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>

                        </td>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'county', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('county'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>

                        </td>
                    </tr>
                </table>

                <div class="enquiry-form-textfield" >
                    <?= $form->field($new_customer_model, 'postcode', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('postcode'), 'class'=>'form-control']])->textInput()->label(false); ?>
                </div>

            </td>
        </tr>

        <!-- Contact Details -->
        <tr>
            <td colspan="2">
                <div class="form-section-baseline">
                </div>
            </td>
            <td>
                <div class="form-section-heading">
                    Contact
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">


                <table>
                    <tr>
                        <td colspan="2">

                            <div class="enquiry-form-full-width-field " >
                                <?= $form->field($new_customer_model, 'email', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('email'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'telephone', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('telephone'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'cell', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('cell'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>

                        </td>
                    </tr>
                </table>
                <div class="enquiry-form-textfield" >
                    <?= $form->field($new_customer_model, 'preferred_contact_method')->hint($new_customer_model->getAttributeLabel('preferred_contact_method'))->dropDownList(Handyfunctions::preferred_contact_method_drop_down())->label(false) ?>
                </div>

            </td>
        </tr>

        <!-- Appliance-->
        <tr>
            <td colspan="2">
                <div class="form-section-baseline">
                </div>
            </td>
            <td>
                <div class="form-section-heading">
                    Appliance
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'product_id')->dropDownList(Handyfunctions::get_all_product_types_of_engineer_for_drop_down($new_customer_model->technician_id), ['prompt' => 'Please select your Appliance'])->label(false); ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'manufacturer_id')->dropDownList(Handyfunctions::get_all_brands_of_engineer_for_drop_down($new_customer_model->technician_id), ['prompt' => 'Please select it\'s Make'])->label(false); ?>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-form-textfield" >
                                <?= $form->field($new_customer_model, 'model_number', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('model_number'), 'class'=>'form-control']])->textInput()->label(false); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="enquiry-form-full-width-field" >
                                <?= $form->field($new_customer_model, 'fault_description', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('fault_description'), 'class'=>'form-control']])->textarea()->label(false); ?>
                            </div>
                            <div class="enquiry-form-full-width-field" >
                                <?= $form->field($new_customer_model, 'other_notes', ['inputOptions' => ['placeholder'=>$new_customer_model->getAttributeLabel('other_notes'), 'class'=>'form-control']])->textarea()->label(false); ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="enquiry-form-full-width-field" >
                                <?= $form->field($new_customer_model, 'preferred_visit_time')->hint($new_customer_model->getAttributeLabel('preferred_visit_time'))->dropDownList(['AM' => 'AM', 'PM' => 'PM'])->label(false) ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="enquiry-form-full-width-field" >
                                <?= $form->field($new_customer_model, 'hear_about_us_dropdown')->hint($new_customer_model->getAttributeLabel('hear_about_us_dropdown'))->dropDownList(Handyfunctions::hear_about_us_drop_down())->label(false) ?>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>


    <div class="g-recaptcha" data-sitekey="<?php echo Yii::$app->params['recaptcha_key']; ?>"></div>


    <?= $form->field($new_customer_model, 'technician_id')->hiddenInput()->label(false) ?>

    <?= $form->field($new_customer_model, 'agree_t_c')->checkbox()->label(false) ?>


    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton($new_customer_model->isNewRecord ? 'Send Now' : 'Update', ['class' => 'btn btn-success btn-lg', 'style' => 'width:50%']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

