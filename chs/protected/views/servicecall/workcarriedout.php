<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 06/12/2016
 * Time: 13:12
 */





?>


<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'workcarriedout-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));

    ?>


    <?php echo CHtml::errorSummary($workcarriedoutmodel); ?>

    <p class="note"><?php echo 'Fields with <span class="required">*</span> are required.'; ?></p>

    <div class="contentbox servicebox">


        <div class="row submit right">
            <?php echo CHtml::submitButton('Submit The Claim', array('class'=>'btn btn-primary')); ?>
        </div>
        <table>
            <tr>
                <th style="width:50%;"></th>
                <th style="width:50%;"></th>
            </tr>
            <tr>
                <td>

                    <div class="row compactRadioGroup">
                        <?php echo $form->labelEx($workcarriedoutmodel, 'product_serial_number_available'); ?>
                        <?php

                        if (!empty($model->product->serial_number)) {
                            $workcarriedoutmodel->product_serial_number_available = 1;
                            $workcarriedoutmodel->product_serial_number = $model->product->serial_number;
                        }

                        echo $form->radioButtonList($workcarriedoutmodel, 'product_serial_number_available',
                            array(1 => 'Yes', 0 => 'No'),

                            array(
                                'separator' => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                                'tabindex' => '1',
                                'labelOptions' => array('style' => 'display:inline'), // add this code
                            )
                        ); // choose your own separator
                        ?>
                        <?php echo $form->error($workcarriedoutmodel, 'product_serial_number_available'); ?>
                        <hr>

                        <h4>
                            <?php
                            if ($workcarriedoutmodel->product_serial_number_available == 1)
                                echo $workcarriedoutmodel->product_serial_number;
                            else
                                echo $workcarriedoutmodel->product_serial_number_unavailable_reason;
                            ?>
                        </h4>


                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            ///////When YES is clicked for Product Serial Number///////
                            $('#Workcarriedout_product_serial_number_available_0').click(function () {
                                $('#reason_product_serial_no').hide('fast');
                                $('#product_serial_no').show('fast');
                                $('#Workcarriedout_product_serial_number').val('');
                                $('#Workcarriedout_product_serial_number_unavailable_reason').val('Serial Number is Provided:');
                            });

                            ///////When NO is clicked for Product Serial Number///////
                            $('#Workcarriedout_product_serial_number_available_1').click(function () {
                                $('#product_serial_no').hide('fast');
                                $('#reason_product_serial_no').show('fast');
                                $('#Workcarriedout_product_serial_number_unavailable_reason').val('');
                                $('#Workcarriedout_product_serial_number').val('00000000000000');
                            });
                        });
                    </script>


                    <div class="row" style="display: block; " id="product_serial_no">

                        <?php echo $form->labelEx($workcarriedoutmodel, 'product_serial_number'); ?>
                        <?php echo $form->textField($workcarriedoutmodel, 'product_serial_number', array('tabindex' => '3', 'style' => 'width:250px;')); ?>
                        <?php echo $form->error($workcarriedoutmodel, 'product_serial_number'); ?>
                    </div>

                    <div class="row" style="display: block; " id="reason_product_serial_no">
                        <?php echo $form->labelEx($workcarriedoutmodel, 'product_serial_number_unavailable_reason'); ?>
                        <?php echo $form->textArea($workcarriedoutmodel, 'product_serial_number_unavailable_reason', array('tabindex' => '4', 'style' => 'width:100%;height:100px;')); ?>
                        <?php echo $form->error($workcarriedoutmodel, 'product_serial_number_unavailable_reason'); ?>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <script type="text/javascript">


                            function showimagepreview(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#img_preview')
                                            .attr('src', e.target.result)
                                        //    .width('25%')
                                        //    .height('25%')
                                        ;
                                        $("#img_preview_a_tag").attr("href", e.target.result);
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>

                        <div class="row">
                            <?php echo $form->labelEx($workcarriedoutmodel, 'product_plating_image'); ?>
                            <?php echo $form->fileField($workcarriedoutmodel, 'product_plating_image', array('tabindex' => '5', 'onchange' => 'showimagepreview(this);')); ?>
                            <?php echo $form->error($workcarriedoutmodel, 'product_plating_image'); ?>
                        </div>

                        <!--<img id="img_preview" src="images/blank.png" alt="your image"/>
                        -->

                        <a class="image-popup-vertical-fit" id="img_preview_a_tag"
                           href="<?php echo $workcarriedoutmodel->product_plating_image_url . '?' . time(); ?>"
                           title="Product Image">
                            <img style='width:25%;' id="img_preview"
                                 src="<?php echo $workcarriedoutmodel->product_plating_image_url; ?>">
                        </a>

                        <div class="row">
                            <?php //echo $form->labelEx( $workcarriedoutmodel, 'product_plating_image_url' ); ?>
                            <?php echo $form->hiddenField($workcarriedoutmodel, 'product_plating_image_url', array('onchange' => 'showimagepreview(this);')); ?>
                            <?php echo $form->error($workcarriedoutmodel, 'product_plating_image_url'); ?>
                        </div>
                    </div>

                </td>

            </tr>
        </table>

    </div>


    <br>

    <div class="contentbox servicebox">
        <?php $workcarriedoutmodel->work_done = $model->work_carried_out; ?>
        <?php echo $form->labelEx($workcarriedoutmodel, 'work_done'); ?>
        <?php echo $form->textArea($workcarriedoutmodel, 'work_done', array('tabindex' => '6', 'style' => 'width:90%;height:100px;')); ?>
        <?php echo $form->error($workcarriedoutmodel, 'work_done'); ?>
    </div>


    <br>


    <div class="contentbox servicebox">
        <table>
            <tr>
                <td>
                    <?php
                    $first_apppointment=Enggdiary::model()->get_firstappointmentbyserviceid($model->id);
                    if ($first_apppointment)
                    {
                        echo "<br>".date('d-M-Y',$first_apppointment->visit_start_date);
                        $workcarriedoutmodel->first_visit_date=$first_apppointment->visit_start_date;
                    }else
                    {
                        $workcarriedoutmodel->first_visit_date="";
                    }
                    ?>


                    <?php
                    $first_visit_date_string="";
                    if (!empty($workcarriedoutmodel->first_visit_date)) {
                        $first_visit_date_string = date('j-F-Y', $workcarriedoutmodel->first_visit_date);
                    }
                    ?>

                    <?php echo $form->labelEx($workcarriedoutmodel, 'first_visit_date'); ?>
                    <?php echo CHtml::textField('first_visit_date_string',$first_visit_date_string,array('id'=>'first_visit_date_string', 'readonly' => 'readonly','style' => 'cursor: pointer;')); ?>
                    <?php echo $form->hiddenField($workcarriedoutmodel, 'first_visit_date'); ?>

                    <?php echo $form->error($workcarriedoutmodel, 'first_visit_date'); ?>




                </td>
                <td>


                    <?php $workcarriedoutmodel->job_completion_date=$model->job_finished_date; ?>


                    <?php
                    $job_completion_date_string="";
                    if (!empty($workcarriedoutmodel->job_completion_date)) {
                        $job_completion_date_string = date('j-F-Y', $workcarriedoutmodel->job_completion_date);
                    }
                    ?>

                    <?php echo $form->labelEx($workcarriedoutmodel, 'job_completion_date'); ?>
                    <?php echo CHtml::textField('job_completion_date_string',$job_completion_date_string,array('id'=>'job_completion_date_string', 'readonly' => 'readonly','style' => 'cursor: pointer;')); ?>
                    <?php echo $form->hiddenField($workcarriedoutmodel, 'job_completion_date'); ?>

                    <?php echo $form->error($workcarriedoutmodel, 'job_completion_date'); ?>


                </td>
                <td>


                    <div class="data_box">
                        <label>Payment Date</label>
                        <h6><?php echo $workcarriedoutmodel->findpaymentdateinchats($model->communications); ?></h6>
                    </div>


                </td>

            </tr>
        </table>

    </div>

    <br>

    <div class="contentbox servicebox">
        <div id="sparestable_div" class="data_box">
            <?php //echo $form->labelEx( $workcarriedoutmodel, 'spares_array' ); ?>
            <?php echo $form->hiddenField($workcarriedoutmodel, 'spares_array', array('style' => 'background:#DDD; width:90%;height:100px;')); ?>
            <?php echo $form->error($workcarriedoutmodel, 'spares_array'); ?>


            <table id="sparestable" style="width:100%;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Part Number</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>

                <?php $counter =0; ?>
                <?php $all_spares = Servicecall::model()->getallsparesbyserviceid($model->id); ?>
                <?php $all_spares_array = array(); ?>


                <?php foreach ($all_spares as $data): ?>

                <?php

                    $spare_array=array();
                    $spare_array['part_number_or_name']=$data->item_name.' '.$data->part_number;
                    $spare_array['qty']=$data->quantity;

                    array_push($all_spares_array, $spare_array);




                    $counter++;

                if ($counter % 2 == 0)
                    $rowclass = 'oddrow';
                else
                    $rowclass = 'evenrow';
                ?>

                <tr class="<?php echo $rowclass; ?>">


                    <td>
                        <!--

                        <?php $togglesparesused = $this->createUrl('sparesused/togglesparesused', array('id' => $data->id)); ?>
                        <a href="<?php echo $togglesparesused; ?>">
                            <?php if ($data->used == 1): ?>
                                <span class="fa fa-check-square-o" aria-hidden="true"></span>
                            <?php else: ?>
                                <span class="fa fa-square-o" aria-hidden="true"></span>
                            <?php endif; ?>
                        </a>
                        -->
                        
                        <?php echo $counter;?>

                    </td>
                    <td><?php echo $data->item_name; ?></td>
                    <td><?php echo $data->part_number; ?></td>
                    <td><?php echo $data->quantity; ?></td>
                    <td><?php echo $data->unit_price; ?></td>
                    <td><?php echo $data->total_price; ?></td>



                </tr>
                <?php endforeach ;//($sparesModel as $data): ?>


            </table>
        </div><!-- end of sparestable_div-->


    </div>



    <?php

    //{"spares":[{"part_number_or_name":"4545","qty":"14"},{"part_number_or_name":"7","qty":"4546"}]}
    //{"spares":[{"part_number_or_name":"4545","qty":"14"},{"part_number_or_name":"7","qty":"4546"}]}

    $spares=array();
    $spares['spares']=$all_spares_array;


    $workcarriedoutmodel->spares_array=json_encode($spares);


    ?>

    <div class="contentbox servicebox row submit">

        <?php //echo $form->labelEx( $workcarriedoutmodel, 'spares_array' ); ?>
        <?php echo $form->textField( $workcarriedoutmodel, 'spares_array', array('style' => 'background:#DDD; width:90%;height:100px;') ); ?>
        <?php echo $form->error( $workcarriedoutmodel, 'spares_array' ); ?>


        <?php echo CHtml::submitButton('Submit The Claim', array('class'=>'btn btn-primary')); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->




<?php

Yii::app()->clientScript->registerScript('search', "


  
      
        
        
        var job_completion_date_string = new Pikaday(
        {
            field: document.getElementById('job_completion_date_string'),
            format: 'D-MMM-YYYY',
            onSelect : function(date) {
                unix_time=this.getMoment().format('X'); ////To format to UNIX time                
                $('#Workcarriedout_job_completion_date').val(unix_time);
            },
        });
            
        var first_visit_date_string = new Pikaday(
        {
            field: document.getElementById('first_visit_date_string'),
            format: 'D-MMM-YYYY',
            onSelect : function(date) {
                unix_time=this.getMoment().format('X'); ////To format to UNIX time                
                $('#Workcarriedout_first_visit_date').val(unix_time);
            },
        });
        
        
      
        
        
        
        

  


    
    

");
?>