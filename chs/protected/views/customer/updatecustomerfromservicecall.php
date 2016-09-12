<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 02/08/2016
 * Time: 13:33
 */

?>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-form',
        'action' => Yii::app()->createUrl('customer/updatecustomerfromservicecall&servicecall_id=' . $_GET['id']),
        //'enableAjaxValidation'=>false,
        'enableAjaxValidation' => false,
    )); ?>

    <?php


    /*
        if (!empty($model->product->id)){
            $productModel = Product::model()->findByPk($model->product_id);
        } else {
            $productModel = Product::model();
        }
    */


    ?>


    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    echo $form->errorSummary($model);
    ?>

    <!-- ***** MASTER TABLE FOR LAYOUT AND CURVES ******* -->
    <table>


        <!-- ******* DISPLAYING CUSTOMER  ********* -->
        <!-- CODE FOR MASTER TABLE TO CHANGE COLOR -->
        <tr>
            <td style="background-color: #C7E8FD; border-radius: 15px; vertical-align: top;">
                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR END -->


                <!-- FIELDS FOR  CUSTOMER  -->
                <?php echo $form->errorSummary($model); ?>


                <table>
                    <tr>
                        <th colspan="3"></th>
                    </tr>


                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'title'); ?>
                            <?php echo $form->textField($model, 'title', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'title'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'last_name'); ?>
                            <?php echo $form->textField($model, 'last_name', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'last_name'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'first_name'); ?>
                            <?php echo $form->textField($model, 'first_name', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'first_name'); ?>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <?php echo $form->labelEx($model, 'postcode'); ?>
                            <?php echo $form->textField($model, 'postcode'); ?>
                            <?php echo $form->error($model, 'postcode'); ?>


                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <?php echo $form->labelEx($model, 'address_line_1'); ?>
                            <?php echo $form->textField($model, 'address_line_1', array('size' => 68)); ?>
                            <?php echo $form->error($model, 'address_line_1'); ?>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'address_line_2'); ?>
                            <?php echo $form->textField($model, 'address_line_2', array('size' => 30)); ?>
                            <?php echo $form->error($model, 'address_line_2'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'address_line_3'); ?>
                            <?php echo $form->textField($model, 'address_line_3', array('size' => 30)); ?>
                            <?php echo $form->error($model, 'address_line_3'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'town'); ?>
                            <?php echo $form->textField($model, 'town', array('size' => 30)); ?>
                            <?php echo $form->error($model, 'town'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'country'); ?>
                            <?php echo $form->textField($model, 'country', array('size' => 30)); ?>
                            <?php echo $form->error($model, 'country'); ?>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3"><br><b><i>Contact Details</i></b></td>
                    </tr>


                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'telephone'); ?>
                            <?php echo $form->textField($model, 'telephone', array('placeholder' => 'home landline')); ?>
                            <?php echo $form->error($model, 'telephone'); ?>

                            <?php echo $form->labelEx($model, 'fax'); ?>
                            <?php echo $form->textField($model, 'fax', array('placeholder' => 'work landline')); ?>
                            <?php echo $form->error($model, 'fax'); ?>
                        </td>
                        <td>


                            <?php echo $form->labelEx($model, 'mobile'); ?>
                            <div class="infotooltip">
                                <div style="margin-top: -24px;margin-left: 54px;font-size: 10px;">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    with country code & without 0
                                </div>
                                <span class="infotooltiptext">
                                   <small>
                                       <br>(Please enter number preceding with your country code
                                       <br>Like if you are based in UK your number will 447501662739 or if you are based in India write 919893139091)
                                   </small>
                                </span>
                            </div>

                            <?php echo $form->textField($model, 'mobile', array('placeholder' => 'mobile with country code without 0 ')); ?>
                            <?php echo $form->error($model, 'mobile'); ?>


                        </td>
                        <td></td>



                    </tr>

                    <tr>
                        <td colspan="2">
                            <?php //echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('placeholder' => 'customer email', 'style' => 'width: 450px;')); ?>
                            <?php echo $form->error($model, 'email'); ?>

                            <?php echo $form->labelEx($model, 'notes'); ?>
                            <?php echo $form->textArea($model, 'notes', array('style' => 'width: 450px; height:100px;', 'value' => '')); ?>
                            <?php echo $form->error($model, 'notes'); ?>


                        </td>
                    </tr>
                    <!-- END OF CUSTOMER INNER TABLE -->
                </table>

                <div class="contentbox">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Register This New Customer' : 'Save'); ?>
                </div>
                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR -->
            </td>
        </tr>

    </table><!-- END OF MASTER TABLE WITH CURVES -->


    <?php $this->endWidget(); ?>

</div><!-- form -->



