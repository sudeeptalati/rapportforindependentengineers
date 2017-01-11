<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/08/2016
 * Time: 13:17
 */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'servicecall-updateServicecall-form',
    'action' => Yii::app()->createUrl('servicecall/updateservicecalldialog&servicecall_id=' . $_GET['id']),
    'enableAjaxValidation' => false,

)); ?>


<?php if (isset($_GET['error_msg'])): ?>
    <div class="error">
        <?php echo $_GET['error_msg']; ?>
    </div>
<?php endif; ?>

<?php $servicecall_id = $_GET['id']; ?>
<?php $serviecallmodel = Servicecall::model()->findByPk($servicecall_id); ?>


<table>
    <tr>
        <td>
            <!-- ***** Fault  Date**** -->

            <?php
            $fault_date_string="";
            if (!empty($serviecallmodel->fault_date)) {
                $fault_date_string = date('j-F-Y', $serviecallmodel->fault_date);
            }
             ?>



            <?php echo $form->labelEx($serviecallmodel, 'fault_date'); ?>
            <?php echo CHtml::textField('fault_date_string',$fault_date_string,array('id'=>'fault_date_string', 'readonly' => 'readonly', 'style' => 'cursor: pointer'));?>
            <?php echo $form->hiddenField($serviecallmodel, 'fault_date' ); ?>
            <?php echo $form->error($serviecallmodel, 'fault_date'); ?>


            <?php echo $form->labelEx($serviecallmodel, 'fault_description'); ?>
            <?php echo $form->textArea($serviecallmodel, 'fault_description', array('style' => 'width:600px;height:100px;')); ?>
            <?php echo $form->error($serviecallmodel, 'fault_description'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'work_carried_out'); ?>
            <?php echo $form->textArea($serviecallmodel, 'work_carried_out', array('style' => 'width:600px;height:100px;')); ?>
            <?php echo $form->error($serviecallmodel, 'work_carried_out'); ?>


            <table>
                <tr>
                    <td>
                        <?php echo $form->labelEx($serviecallmodel, 'test_results'); ?>
                        <?php echo $form->textArea($serviecallmodel, 'test_results', array('style' => 'width:200px;height:200px;')); ?>
                        <?php echo $form->error($serviecallmodel, 'test_results'); ?>

                    </td>
                    <td>

                        <!-- ***** Fault  Date**** -->

                        <?php
                        $fault_date_string="";
                        if (!empty($serviecallmodel->fault_date)) {
                            $fault_date_string = date('j-F-Y', $serviecallmodel->fault_date);
                        }
                        ?>



                        <?php echo $form->labelEx($serviecallmodel, 'fault_date'); ?>
                        <?php echo $fault_date_string; ?>


                        <!-- ***** Job Completed Date**** -->
                        <br>
                        <?php
                        $job_finished_date_string="";
                        if (!empty($serviecallmodel->job_finished_date)) {
                            $job_finished_date_string = date('j-F-Y', $serviecallmodel->job_finished_date);
                        }
                        ?>

                        <?php echo $form->labelEx($serviecallmodel, 'job_finished_date'); ?>
                        <?php echo CHtml::textField('job_finished_date_string',$job_finished_date_string,array('id'=>'job_finished_date_string', 'readonly' => 'readonly','style' => 'cursor: pointer;')); ?>
                        <?php echo $form->hiddenField($serviecallmodel, 'job_finished_date'); ?>
                        <?php echo $form->error($serviecallmodel, 'job_finished_date'); ?>

                        <hr>

                        <!-- Job Payment date  -->


                        <?php
                        $job_payment_date_string="";
                        if (!empty($serviecallmodel->job_payment_date)) {
                            $job_payment_date_string = date('j-F-Y', $serviecallmodel->job_payment_date);
                        }
                        ?>

                        <?php echo $form->labelEx($serviecallmodel, 'job_payment_date'); ?>
                        <?php echo CHtml::textField('job_payment_date_string',$job_payment_date_string,array('id'=>'job_payment_date_string','readonly' => 'readonly', 'style' => 'cursor: pointer;')); ?>
                        <?php echo $form->hiddenField($serviecallmodel, 'job_payment_date'); ?>
                        <?php echo $form->error($serviecallmodel, 'job_payment_date'); ?>

                        <!-- Job Payment date END  -->
                    </td>
                </tr>
            </table>


        </td>
        <td>

            <?php echo $form->labelEx($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->textField($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->error($serviecallmodel, 'fault_code'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'insurer_reference_number'); ?>
            <?php echo $form->textField($serviecallmodel, 'insurer_reference_number'); ?>
            <?php echo $form->error($serviecallmodel, 'insurer_reference_number'); ?>

            <?php $serviecallmodel->contract_id = $serviecallmodel->contract->id; ?>
            <?php echo $form->labelEx($serviecallmodel, 'contract_id'); ?>
            <?php echo CHtml::activeDropDownList($serviecallmodel, 'contract_id', $serviecallmodel->getAllContract()); ?>
            <?php echo $form->error($serviecallmodel, 'contract_id'); ?>





        </td>
    </tr>
</table>
<table>
    <tr>
        <td>
            <!--
            <?php echo $form->labelEx($serviecallmodel, 'contract_id'); ?>
            <?php echo CHtml::activeDropDownList($serviecallmodel, 'contract_id', $serviecallmodel->getAllContract()); ?>
            <?php echo $form->error($serviecallmodel, 'contract_id'); ?>
           


            <?php echo $form->labelEx($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->textField($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->error($serviecallmodel, 'fault_code'); ?>
 			-->
            <hr>

            <i class="fa fa-money fa-2x"></i>

            <?php echo $form->labelEx($serviecallmodel, 'total_cost'); ?>
            <?php echo $form->textField($serviecallmodel, 'total_cost', array('readonly' => 'readonly', 'size' => '10', 'style' => 'text-align:right')); ?>
            <?php echo $form->error($serviecallmodel, 'total_cost'); ?>



            <?php echo $form->labelEx($serviecallmodel, 'vat_on_total'); ?>
            <?php echo $form->textField($serviecallmodel, 'vat_on_total', array('size' => '10', 'style' => 'text-align:right')); ?>
            <?php echo $form->error($serviecallmodel, 'vat_on_total'); ?>





            <?php
            /*
            $invoicePresentModel = Invoice::model()->findByAttributes(array('servicecall_id' => $serviecallmodel->id));
            if ($invoicePresentModel) {
                //echo "<br> Idof invoice = ".$invoicePresentModel->id;
                $invoiceModel = Invoice::model()->findByPk($invoicePresentModel->id);
            } else {
                $invoiceModel = Invoice::model();
            }

            */
            ?>

            <?php //echo $form->labelEx($invoiceModel, 'shipping_handling_cost'); ?>
            <?php //echo $form->textField($invoiceModel, 'shipping_handling_cost', array('size' => '10', 'style' => 'text-align:right')); ?>
            <?php //echo $form->error($invoiceModel, 'shipping_handling_cost'); ?>


            <?php //echo $form->labelEx($invoiceModel, 'labour_cost'); ?>
            <?php //echo $form->textField($invoiceModel, 'labour_cost', array('size' => '10', 'style' => 'text-align:right')); ?>
            <?php //echo $form->error($invoiceModel, 'labour_cost'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'work_summary'); ?>
            <?php //echo $form->textField($serviecallmodel,'work_summary',array('rows'=>6, 'cols'=>50)); ?>

            <?php
            $works_array = array();
            array_push($works_array, '');
            array_push($works_array, 'RETURNED WITH ENGINEER VISIT');
            array_push($works_array, 'RETURNED WITHOUT ENGINEER VISIT');
            array_push($works_array, 'REPAIRED');
            array_push($works_array, 'CALL AVOIDANCE ENGINEER');
            array_push($works_array, 'CANCELLED');
            array_push($works_array, 'SPARES ONLY');
            array_push($works_array, 'CALL AVOIDANCE CC');
            array_push($works_array, 'CUSTOMER CHARGED');
            array_push($works_array, 'NOT KNOWN');
            array_push($works_array, 'WRITTEN OFF - BER ');


            ?>
            <?php echo $form->dropDownList($serviecallmodel, 'work_summary', array_combine($works_array, $works_array)); ?>

        </td>
        <td>
            <hr>
            <?php //echo $form->labelEx($serviecallmodel, 'spares_notes'); ?>
            <?php //echo $form->textArea($serviecallmodel, 'spares_notes', array('style' => 'width:600px;height:100px;')); ?>
            <?php //echo $form->error($serviecallmodel, 'spares_notes'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'notes'); ?>
            <?php echo $form->textArea($serviecallmodel, 'notes', array('style' => 'width:600px;height:100px;')); ?>
            <?php echo $form->error($serviecallmodel, 'notes'); ?>



            <?php echo $form->label($serviecallmodel, 'job_status_id'); ?>
            <?php echo $form->dropDownList($serviecallmodel, 'job_status_id', Jobstatus::model()->getAllPublishedListdata(), array('style' => 'width:600px;')); ?>
            <?php echo $form->error($serviecallmodel, 'job_status_id'); ?>

        </td>


    </tr>
</table>


<div class="success">

    <?php echo CHtml::submitButton('Save'); ?>


    <?php $serviecallmodel->comments=""; ?>

    <?php echo $form->labelEx($serviecallmodel, 'comments'); ?>
    <?php echo $form->textArea($serviecallmodel, 'comments', array('rows' => 4, 'cols' => '30')); ?>
    <?php echo $form->error($serviecallmodel, 'comments'); ?>
</div>
<?php $this->endWidget(); ?>


<?php

Yii::app()->clientScript->registerScript('dateselect', "


  
       var fault_date_string = new Pikaday(
        {
            field: document.getElementById('fault_date_string'),
            format: 'D-MMM-YYYY',
            onSelect : function(date) {
            
                 
                unix_time=this.getMoment().format('X'); ////To format to UNIX time                
                $('#Servicecall_fault_date').val(unix_time);
            },
        });
        
        
        var job_finished_date_string = new Pikaday(
        {
            field: document.getElementById('job_finished_date_string'),
            format: 'D-MMM-YYYY',
            onSelect : function(date) {
                unix_time=this.getMoment().format('X'); ////To format to UNIX time                
                $('#Servicecall_job_finished_date').val(unix_time);
            },
        });
        
        
        var job_payment_date_string = new Pikaday(
        {
            field: document.getElementById('job_payment_date_string'),
            format: 'D-MMM-YYYY',
            onSelect : function(date) {
                unix_time=this.getMoment().format('X'); ////To format to UNIX time                
                $('#Servicecall_job_payment_date').val(unix_time);
            },
        });
 

");
?>


