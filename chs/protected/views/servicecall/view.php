<?php include('servicecall_sidemenu.php'); ?>
<?php $baseUrl = Yii::app()->baseUrl; ?>
<?php $isAdmin = UserModule::isAdmin(); ?>
<?php $setupmodel = Setup::model(); ?>
<?php $productModel = Product::model(); ?>



<?php
//CALCULATING VALID UNTILL.

$php_warranty_date = $model->product->warranty_date;
$php_waranty_months = $model->product->warranty_for_months;
$res = '';
if (!empty ($php_warranty_date)) {
    $warranty_until = strtotime(date("Y-M-d", $php_warranty_date) . " +" . $php_waranty_months . " month");
    $res = date('d-M-Y', $warranty_until);
} else {
    $warranty_until = '';
}
?>


<table>
    <tr>
        <td colspan="2" style="text-align:center">
            <h2>Servicecall</h2>
        </td>
    </tr>
    <tr>
        <td style="text-align:left;width:50%">
            <a href="javascript: history.go(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>
        </td>

        <td style="text-align:right; width:30%">

            <table>
                <tr>
                    <td>
                        <?php

                        $editicom = '<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>';
                        if ($model->job_status_id > 100) {
                            if (UserModule::isAdmin())
                                echo CHtml::link($editicom, array('update', 'id' => $model->id), array('onclick' => 'return false;', 'style' => 'color:gray;')) . "&nbsp;&nbsp;	<small>(Call is Closed)</small>";
                            //echo "<br>here";
                        } else
                            echo CHtml::link($editicom, array('update', 'id' => $model->id), array('title' => 'Edit'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $previewImgUrl = Yii::app()->request->baseUrl . '/images/pdf.gif';
                        $previewImg = CHtml::image($previewImgUrl, 'Preview', array('width' => 35, 'height' => 35, 'title' => 'Preview in Pdf'));
                        echo CHtml::link($previewImg, array('Preview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $htmlImgUrl = Yii::app()->request->baseUrl . '/images/html_file.png';
                        $htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Preview in HTML'));
                        echo CHtml::link($htmlImg, array('htmlPreview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $htmlImgUrl = Yii::app()->request->baseUrl . '/images/invoice.png';
                        $htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Invoice'));
                        echo CHtml::link($htmlImg, array('htmlPreview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $mobileImgUrl = Yii::app()->request->baseUrl . '/images/mobile.png';
                        $mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width' => 35, 'height' => 35, 'title' => 'Send to Mobile'));
                        echo CHtml::link($mobileImg, array('/gomobile/default/sendsingleservicecalltoserver', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>

                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <th style="width:50%; padding:20px;">
            <table>
                <tr>
                    <td>
                        <div class="contentbox"
                             style="background-color:<?php echo $model->jobStatus->backgroundcolor; ?> ">

                            <?php
                            echo CHtml::link(CHtml::image('images/icons/edit.png', 'Change', array('width' => '20px')),
                                '#', array(
                                    'onclick' => '$("#change-jobstatus-dialog").dialog("open"); return false;',
                                ));
                            ?>


                            <?php
                            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                'id' => 'change-jobstatus-dialog',
                                // additional javascript options for the dialog plugin
                                'options' => array(
                                    'title' => 'Change Status',
                                    'autoOpen' => false,
                                    'resizable' => false,
                                    'modal' => 'true',
                                ),
                            ));
                            $this->renderPartial('changejobstatusonly');
                            $this->endWidget('zii.widgets.jui.CJuiDialog');
                            // the link that may open the dialog
                            ?>


                            <?php echo $model->jobStatus->name; ?>


                        </div>

                    </td>
                </tr>
            </table>


        </th>
        <th>
            <h1 style="color:green;text-align: right;"><?php echo $model->service_reference_number; ?></h1>
        </th>
    </tr>


    <tr>
        <td colspan="2">
            <div class="customerbox contentbox">
                <div class="customerheadingbox headingbox">Customer</div>
                <div class="contentbox">

                    <table>
                        <tr>
                            <td style="width: 50%">
                                <?php echo $model->customer->fullname; ?>

                                <div class="address">
                                    <?php
                                    $line1 = $model->customer->address_line_1;
                                    $line2 = $model->customer->address_line_2;
                                    $line3 = $model->customer->address_line_3;
                                    $town = $model->customer->town;
                                    $postcode = $model->customer->postcode;
                                    $address = $setupmodel->formataddressinhtml($line1, $line2, $line3, $town, $postcode);

                                    ?>
                                    <?php echo $address; ?>
                                </div>

                                <table style="width:20%">
                                    <tr>
                                        <td><span class="fa fa-mobile"></span></td>
                                        <td>
                                            <?php echo $model->customer->mobile; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-mobile"></span></td>
                                        <td>
                                            <?php echo $model->customer->fax; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-phone"></span></td>
                                        <td>
                                            <?php echo $model->customer->telephone; ?>
                                        </td>
                                    </tr>
                                </table>

                                <div class="fa fa-sticky-note-o fa-2x" aria-hidden="true" title="Customer Notes"></div>
                                &nbsp;&nbsp;&nbsp;
                                <?php echo $model->customer->notes; ?>


                            </td>
                            <td style="width: 50%; text-align: right;">


                                <a target="_blank"
                                   href="https://www.google.co.uk/maps?q=<?php echo strip_tags($address); ?>">
                                    <span class="fa fa-map-o fa-2x" aria-hidden="true"></span></a>
                                <br>
                                <div class="googlemapdiv" style="display:block; float: right;">
                                    <?php $this->renderPartial('postcodeongooglemap', array('address' => $address)); ?>
                                </div><!-- googlemapdiv -->

                            </td>
                        </tr>
                    </table>
                </div><!-- End of <div class="contentbox"> -->
            </div><!-- end of <div class="customerbox contentbox"> -->
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="productbox contentbox">
                <div class="productheadingbox headingbox">Product</div>
                <div class="contentbox">
                    <table style="width: 100%">

                        <tr>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                        </tr>
                        <tr>
                            <td><span class="datacontenttitle">Brand</span>
                            <td><?php echo '' . $model->product->brand->name; ?></td>
                            <td><span class="datacontenttitle">Product Type</span>
                            <td><?php echo '' . $model->product->productType->name; ?></td>
                        </tr>
                        <tr>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('model_number'); ?></span>
                            <td><?php echo '' . $model->product->model_number; ?></td>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('serial_number'); ?></span>
                            <td><?php echo '' . $model->product->serial_number; ?></td>
                        </tr>

                        <tr>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('enr_number'); ?></span>
                            <td><?php echo '' . $model->product->enr_number; ?></td>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('production_code'); ?></span>
                            <td><?php echo '' . $model->product->production_code; ?></td>
                        </tr>

                        <tr>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('purchased_from'); ?></span>
                            <td><?php echo '' . $model->product->purchased_from; ?></td>

                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('purchase_date'); ?></span>
                            <td><?php echo Setup::model()->formatdate($model->product->purchase_date); ?></td>
                        </tr>
                        <tr>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('warranty_date'); ?></span>
                            <td><?php echo Setup::model()->formatdate($model->product->warranty_date); ?></td>

                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('warranty_until'); ?></span>
                            <td><?php echo $res; ?></td>
                        </tr>
                        <tr>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('discontinued'); ?></span>
                            </td>
                            <td><?php
                                if ($model->product->discontinued == 0)
                                    echo 'No';
                                else
                                    echo 'Yes';
                                ?>
                            </td>
                            <td><span
                                    class="datacontenttitle"><?php echo $productModel->getAttributeLabel('fnr_number'); ?></span>
                            <td><?php echo '' . $model->product->fnr_number; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div title="Product Notes" class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></div>
                                &nbsp;&nbsp;&nbsp;
                                <?php echo $model->product->notes; ?>
                            </td>
                        </tr>

                    </table>

                </div>
            </div><!-- end of <div class="productbox contentbox"> -->
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="servicebox contentbox">
                <div class="serviceheadingbox headingbox">Servicecall</div>
                <div class="contentbox">
                    <table>
                        <tr>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                            <th style="width: 25%"></th>
                        </tr>
                        <tr>
                            <td>
                                <div
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_date'); ?></div>
                            </td>
                            <td>
                                <?php echo $setupmodel->formatdate($model->fault_date); ?>
                            </td>
                            <td>
                                <div
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('contract_id'); ?></div>
                            </td>
                            <td>
                                <?php echo $model->contract->name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_code'); ?></div>
                            </td>
                            <td>
                                <?php echo $model->fault_code; ?>
                            </td>
                            <td>
                                <div
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('insurer_reference_number'); ?></div>
                            </td>
                            <td>
                                <?php echo $model->insurer_reference_number; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="fa fa-file-text-o fa-2x" aria-hidden="true"></div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_description'); ?></span>
                                <br>
                                <?php echo $model->fault_description; ?>

                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;">
                        <?php
                        if ($model->spares_used_status_id == 1) {
                            ?>

                            <?php //echo "Spares used";
                            $sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id' => $model->id));
                            ?>

                            <tr>
                                <th colspan="5"><h4>Spares</h4></th>
                            </tr>
                            <tr>
                                <th><span class="datacontenttitle">Item</span></th>
                                <th><span class="datacontenttitle">Part Number</span></th>
                                <th><span class="datacontenttitle">Quantity</span></th>
                                <th><span class="datacontenttitle">Unit Price</span></th>
                                <th><span class="datacontenttitle">Total Price</span></th>
                            </tr>
                            <!--
                            <tr>
                                <td colspan='8'>
                                    <hr>
                                </td>
                            </tr>
                            -->
                            <?php foreach ($sparesModel as $data) { ?>
                                <tr>
                                    <td><?php echo $data->item_name; ?></td>
                                    <td><?php echo $data->part_number; ?></td>

                                    <td><?php echo $data->quantity; ?></td>
                                    <td><?php echo $data->unit_price; ?></td>
                                    <td><?php echo $data->total_price; ?></td>

                                </tr>
                            <?php }//end of foreach of spares()?>


                            <tr>
                                <td colspan="3"></td>
                                <td><span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('total_cost'); ?></span>
                                </td>
                                <td><b><?php echo $model->total_cost; ?></b></td>
                            </tr>

                        <?php }//end of if($spares_used == 1).?>

                    </table>

                    <?php $previousCall = $model->previousCall($model->customer_id); ?>
                    <?php if (count($previousCall) != 1): ?>

                        <div class="contentbox">
                            <h4>Previous Service Details </h4>
                        </div>
                        <div class="customerdatabox">
                            <table>
                                <tr>
                                    <th><span class="datacontenttitle">Service Ref#</span></th>
                                    <th><span class="datacontenttitle">Product</span></th>
                                    <th><span class="datacontenttitle">Reported Date</span></th>
                                    <th><span class="datacontenttitle">Fault Description</span></th>
                                    <th><span class="datacontenttitle">Engineer Visited</span></th>
                                    <th><span class="datacontenttitle">Job Status</span></th>
                                </tr>

                                <?php


                                foreach ($previousCall as $data) {
                                    if ($data->service_reference_number != $model->service_reference_number)//////since we want to skip the current service call
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo CHtml::link($data->service_reference_number, array('view', 'id' => $data->id)); ?></td>
                                            <td><?php echo "<b>" . $data->product->productType->name . "<b>"; ?></td>
                                            <td><?php
                                                if (!empty($data->fault_date))
                                                    echo date('d-M-Y', $data->fault_date);
                                                ?>
                                            </td>
                                            <td><?php echo $data->fault_description; ?></td>
                                            <td><?php echo $data->engineer->company . ', ' . $data->engineer->fullname; ?></td>
                                            <td style="color:maroon"><?php echo $data->jobStatus->name; ?></td>
                                        </tr>
                                        <?php
                                    }///end of if
                                }//end of foreach().?>
                            </table>
                        </div>
                    <?php endif; ////end of if (count($previousCall>0)): ?>

                    <div class="workcarriedout">

                        <h4>
                            <div class="fa fa-briefcase fa-2x"></div>
                            <?php echo $model->getAttributeLabel('work_carried_out'); ?>
                        </h4>
                        <div class="contentbox">
                            <?php echo $model->work_carried_out; ?>
                        </div>

                        <div class="datacontenttitle">
                            <?php echo $model->getAttributeLabel('notes'); ?>
                        </div>
                        <div class="contentbox">
                            <?php echo $model->notes; ?>
                        </div>

                        <div class="datacontenttitle">
                            <?php echo $model->getAttributeLabel('comments'); ?>
                        </div>
                        <div class="contentbox">
                            <?php echo $model->comments; ?>
                        </div>


                    </div><!-- end of <div class="workcarriedout">-->


                </div><!-- end of <div class="contentbox"> -->

            </div><!--  <div class="servicebox contentbox">-->


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="engineerbox contentbox">
                <div class="enginnerheadingbox headingbox">Engineer</div>
                <div class="contentbox">
                    <table>
                        <tr>
                            <th style="width:5%"></th>
                            <th style="width:35%"></th>
                            <th style="width:60%"></th>
                        </tr>
                        <tr>
                            <td>
                                <div class="fa fa-wrench fa-2x"></div>
                            </td>
                            <td><?php echo $model->engineer->fullname; ?></td>
                            <td>
                                <?php echo CHtml::link('<div class="fa fa-road" ></div> Book another visit', array('enggdiary/findnextappointmentfromallengg/', 'servicecall_id'=>$model->id, 'engineer_id'=>$model->engineer_id));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fa fa-calendar fa-2x title" title="Appointment">
                                </div>
                            </td>
                            <td><?php echo $setupmodel->formatdatewithtime($model->enggdiary->visit_start_date); ?></td>
                            <td>

                                <?php echo CHtml::link('<div class="fa fa-share"></div> Move this appointment', array('enggdiary/viewFullDiary/', 'engg_id'=>$model->engineer_id));
                                ?>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fa fa-envelope-o fa-2x title" title="Appointment">
                                </div>
                            </td>
                            <td><?php echo $model->enggdiary->notes; ?></td>
                            <td>

                                <?php echo CHtml::link('<div class="fa fa-pencil-square-o"></div> Edit', array('/enggdiary/update/', 'id'=>$model->engg_diary_id)); ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <h5>Previous Appointments</h5>
                                <?php $all_appointments=Enggdiary::model()->getappointmentsbyserviceid($model->id);?>
                                <?php if (count($all_appointments)>1): ?>
                                    <table>
                                        <tr>
                                            <th class="datacontenttitle">Visit Date</th>
                                            <th class="datacontenttitle">Notes</th>
                                        </tr>

                                    <?php foreach ($all_appointments as $a): ?>

                                        <?php if ($a->id!=$model->engg_diary_id): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $setupmodel->formatdatewithtime($a->visit_start_date); ?>
                                                    -
                                                    <?php echo date('H:i A', $a->visit_end_date); ?>
                                                </td>
                                                <td><?php echo $a->notes; ?> </td>
                                            </tr>
                                        <?php endif;///end of if ($a->id!=$model->engg_diary_id): ?>

                                    <?php endforeach; ?>
                                    </table>

                                <?php endif; ///end of if (count($all_appointments)>1):?>
                            </td>
                        </tr>
                    </table>
                </div><!-- end of  <div class="contentbox"> -->
            </div><!-- end of <div class="engineerbox contentbox"> -->
        </td>
    </tr>

    <tr>
        <th style="width:50%; padding:20px;">
            <table>
                <tr>
                    <td>
                        <div class="contentbox"
                             style="background-color:<?php echo $model->jobStatus->backgroundcolor; ?> ">

                            <?php
                            echo CHtml::link(CHtml::image('images/icons/edit.png', 'Change', array('width' => '20px')),
                                '#', array(
                                    'onclick' => '$("#change-jobstatus-dialog").dialog("open"); return false;',
                                ));
                            ?>
                            <?php echo $model->jobStatus->name; ?>
                        </div>

                    </td>
                </tr>
            </table>
        </th>
        <th>
            <h1 style="color:green;text-align: right;"><?php echo $model->service_reference_number; ?></h1>
        </th>
    </tr>

    <tr>
        <td style="text-align:left;width:50%">
            <a href="javascript: history.go(-1)"><i class="fa fa-arrow-left fa-2x"></i></a>
        </td>

        <td style="text-align:right; width:30%">

            <table>
                <tr>
                    <td>
                        <?php

                        $editicom = '<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>';
                        if ($model->job_status_id > 100) {
                            if (UserModule::isAdmin())
                                echo CHtml::link($editicom, array('update', 'id' => $model->id), array('onclick' => 'return false;', 'style' => 'color:gray;')) . "&nbsp;&nbsp;	<small>(Call is Closed)</small>";
                            //echo "<br>here";
                        } else
                            echo CHtml::link($editicom, array('update', 'id' => $model->id), array('title' => 'Edit'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $previewImgUrl = Yii::app()->request->baseUrl . '/images/pdf.gif';
                        $previewImg = CHtml::image($previewImgUrl, 'Preview', array('width' => 35, 'height' => 35, 'title' => 'Preview in Pdf'));
                        echo CHtml::link($previewImg, array('Preview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $htmlImgUrl = Yii::app()->request->baseUrl . '/images/html_file.png';
                        $htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Preview in HTML'));
                        echo CHtml::link($htmlImg, array('htmlPreview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $htmlImgUrl = Yii::app()->request->baseUrl . '/images/invoice.png';
                        $htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Invoice'));
                        echo CHtml::link($htmlImg, array('htmlPreview', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                    <td>
                        <?php
                        $mobileImgUrl = Yii::app()->request->baseUrl . '/images/mobile.png';
                        $mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width' => 35, 'height' => 35, 'title' => 'Send to Mobile'));
                        echo CHtml::link($mobileImg, array('/gomobile/default/sendsingleservicecalltoserver', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>



