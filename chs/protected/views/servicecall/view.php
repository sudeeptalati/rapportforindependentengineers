<?php include('servicecall_sidemenu.php'); ?>
<?php $baseUrl = Yii::app()->baseUrl; ?>
<?php $isAdmin = UserModule::isAdmin(); ?>
<?php $setupmodel = Setup::model(); ?>

<?php $customerModel = Customer::model()->findByPk($model->customer_id); ?>
<?php $productModel = Product::model()->findByPk($model->product_id); ?>


<?php

$editicom = '<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>';

//echo $model->enggdiary->status;
if ($model->engg_diary_id == NULL || $model->engg_diary_id == '' )
    $appointment_exists = false;
else
    $appointment_exists = true;

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


<style>
    .fixedElement {
        position: static;
        width: 800px;
        z-index: 100;
    }

</style>


<script>
    $(function () {
        $("#draggable").draggable();
    });

    $(function () {
        $("#toolbardraggable").draggable();
    });

    $(window).scroll(function (e) {
        var $el = $('.fixedElement');
        var isPositionFixed = ($el.css('position') == 'fixed');
        if ($(this).scrollTop() > 200 && !isPositionFixed) {
            $('.fixedElement').css({
                'position': 'fixed',
                'right': '0px',
                'top': '400px',
                'width': '400px',
                'cursor': 'move'
            });
        }
        if ($(this).scrollTop() < 200 && isPositionFixed) {
            $('.fixedElement').css({'position': 'static', 'top': '0px', 'width': '800px', 'cursor': 'default'});
        }
    });


</script>


<?php


if (isset($_GET['sparesdialog']))
    $showsparesdialog = $_GET['sparesdialog'];
else
    $showsparesdialog = false;


$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'add-spares-dialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Add Spares',
        'width' => '800px',
        'autoOpen' => $showsparesdialog,
        'resizable' => true,
        'modal' => 'true',
    ),
));
$newsparesmodel = new SparesUsed;
$this->renderPartial('/sparesUsed/searchandadd', array('service_id' => $model->id));
//$this->renderPartial('/sparesUsed/_form',array('model'=>$newsparesmodel,'service_id'=>$model->id));
$this->endWidget('zii.widgets.jui.CJuiDialog');
// the link that may open the dialog
?>



<div class="customerheadingbox" id="draggable"
     style="position: fixed;right: 14%; top: 4%;   width: 150px; height:auto;   padding-left: 35px; border-radius: 10px; cursor:move;">


    <h4>
        <i style="color:white;" class="fa fa-arrow-up" aria-hidden="true"></i>
        <a style="color:white;" href="#header">Top</a>
    </h4>
    <h4>
        <i style="color:white;" class="fa fa-users" aria-hidden="true"></i>
        <a style="color:white;" href="#content">Customer</a>
    </h4>

    <h4>
        <i style="color:white;" class="fa fa-archive" aria-hidden="true"></i>
        <a style="color:white;" href="#productbox">Product</a>
    </h4>

    <h4>
        <i style="color:white;" class="fa fa-wrench" aria-hidden="true"></i>
        <a style="color:white;" href="#servicebox">Service</a>
    </h4>

    <h4>
        <i style="color:white;" class="fa fa-gears" aria-hidden="true"></i>
        <a style="color:white;" href="#sparesbox">Spares</a>
    </h4>



    <h4>
        <i style="color:white;" class="fa fa-briefcase" aria-hidden="true"></i>
        <a style="color:white;" href="#enggreporting">Work Done</a>
    </h4>


    <h4>
        <i style="color:white;" class="fa fa-user" aria-hidden="true"></i>
        <a style="color:white;" href="#enginnerbox">Engineer</a>
    </h4>


    <h4>
        <i style="color:white;" class="fa fa-code-fork" aria-hidden="true"></i>

        <a style="color:white;" onclick="showhideactivitylog()" href="#activitylog">Activity Log</a>
        <script>
            function showhideactivitylog() {
                $('#activitylog-div').toggle();
            }
        </script>

    </h4>


    <h4>
        <i style="color:white;" class="fa fa-arrow-down" aria-hidden="true"></i>
        <a style="color:white;" href="#footer">Bottom</a>
    </h4>

</div>



<div style="text-align:center; ">
    <h1>Servicecall</h1>
</div>

<div class="servicetoolbar fixedElement" id="toolbardraggable">
    <table>
        <tr>
            <td style="width: 25%"></td>
            <td style="width: 25%"></td>
            <td style="width: 25%"></td>
            <td style="width: 25%"></td>
        </tr>
        <tr>
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
            <td style="text-align: right;">
                <?php
                $invoiceImgUrl = Yii::app()->request->baseUrl . '/images/invoice.png';
                $invoice = CHtml::image($invoiceImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Invoice'));
                echo CHtml::link($invoice, array('invoice', 'id' => $model->id), array('target' => '_blank'));
                ?>
            </td>
            <td style="text-align: right;">
                <?php
                $mobileImgUrl = Yii::app()->request->baseUrl . '/images/mobile.png';
                $mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width' => 35, 'height' => 35, 'title' => 'Send to Mobile'));
                echo CHtml::link($mobileImg, array('/gomobile/default/sendsingleservicecalltoserver', 'id' => $model->id), array('target' => '_blank'));
                ?>
            </td>


        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <div class="contentbox"
                                 style="background-color:<?php echo $model->jobStatus->backgroundcolor; ?> ">
                                <?php
                                $jobstatus_editbtn = '<h4 style="color:black;" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  ' . $model->jobStatus->name . '</h4>';
                                echo CHtml::link($jobstatus_editbtn,
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
                            </div>

                        </td>
                    </tr>
                </table>
            </td>
            <td colspan="2"><h1 style="color:green;text-align: right;">
                    #<?php echo $model->service_reference_number; ?></h1></td>
        </tr>
    </table>
</div>

<table style="width: 850px;">

    <tr>
        <td colspan="2">

            <?php if (isset($_GET['error_msg'])): ?>
                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'error-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Error',
                        'autoOpen' => true,
                        'resizable' => false,
                        'modal' => true,
                        'overflow' => 'hidden',

                    ),
                ));


                echo '<div class="error">'.$_GET['error_msg'].'</div>';

                $this->endWidget('zii.widgets.jui.CJuiDialog');
                // the link that may open the dialog
                ?>

                </div>
            <?php endif; ?>






            <div class="customerheadingbox contentbox">
                <?php
                Yii::app()->clientScript->registerScript('comments-div', "
                                        $('#comments-button').click(function(){
	                                    $('#comments-div').toggle();
	                                    return false;
                                        });
                                ");
                ?>


                <h4>
                    <?php $updatecomments = "<span style='color: white;' ><i class='fa fa-plus-square-o' ></i> Comments</span>"; ?>

                    <?php
                    echo CHtml::link($updatecomments,
                        '#', array(
                            'onclick' => '$("#update-comments-dialog").dialog("open"); return false;',
                        ));
                    ?>
                    <div class="right">
                        <?php $commentstext = "<span style='color: white;' id='activilitylogdivbutton'> <i class='fa fa-toggle-on'></i></span>"; ?>
                        <?php echo CHtml::link($commentstext, '#', array('id' => 'comments-button')); ?>
                    </div>
                </h4>

            </div>

            <div class="customerdatabox">
                <div>

                    <div id="comments-div" style="display:block">
                        <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
                    </div><!-- comments-form -->


                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'update-comments-dialog',
                        // additional javascript options for the dialog plugin

                        'options' => array(
                            'title' => 'Add Comments',
                            'autoOpen' => false,
                            'resizable' => false,
                            'modal' => true,
                            //'width'=>'600px',

                        ),
                    ));

                    $this->renderPartial('addcomments', array('model' => $model));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
                    ?>


                </div>
            </div>
        </td>
    </tr>




    <tr>
        <td colspan="2">
            <div class="customerbox contentbox"  id="customerbox">
                <div class="customerheadingbox headingbox">
                    <?php
                    $updatecustomertext = "<h4 style='color: white;'><i class='fa fa-users'></i>&nbsp;&nbsp;Customer <div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";

                    echo CHtml::link($updatecustomertext,
                        '#', array(
                            'onclick' => '$("#update-customer-dialog").dialog("open"); return false;',
                        ));
                    ?>
                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'update-customer-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Update Customer',
                            'autoOpen' => false,
                            'resizable' => false,
                            'modal' => 'true',
                            'width' => '60%',
                        ),
                    ));
                    $this->renderPartial('/customer/updatecustomerfromservicecall', array('model' => $customerModel));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
                    ?>

                </div>
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

                                <table>
                                    <tr>
                                        <th style="width: 10%"></th>
                                        <th style="width: 90%"></th>
                                    </tr>
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

                                <div class="fa fa-sticky-note-o fa-2x" aria-hidden="true"
                                     title="Customer Notes"></div>
                                &nbsp;&nbsp;&nbsp;
                                <?php echo $model->customer->notes; ?>


                            </td>
                            <td style="width: 50%; text-align: right;">


                                <a target="_blank"
                                   href="https://www.google.co.uk/maps?q=<?php echo strip_tags($address); ?>">
                                    <span class="fa fa-map-o fa-2x" aria-hidden="true"></span></a>
                                <br>
                                <div class="googlemapdiv" style="display:block; float: right;">
                                    <?php $this->renderPartial('postcodeongooglemap', array('address' => $address, 'postcode'=>$model->customer->postcode)); ?>
                                </div><!-- googlemapdiv -->

                            </td>
                        </tr>
                    </table>
                </div><!-- End of <div class="contentbox"> -->
            </div><!-- end of <div class="customerbox contentbox"> -->
        </td>
    </tr>

    <!-- End of Customer-->

    <!-- Product Box Start-->
    <tr>
        <td colspan="2">
            <div class="productbox contentbox" id="productbox">
                <div class="productheadingbox headingbox">

                    <?php
                    $updateproducttext = "<h4 style='color: white;'><i class='fa fa-archive'></i>&nbsp;&nbsp;Product <div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";

                    echo CHtml::link($updateproducttext,
                        '#', array(
                            'onclick' => '$("#update-product-dialog").dialog("open"); return false;',
                        ));
                    ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'update-product-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Update Product',
                            'autoOpen' => false,
                            'resizable' => false,
                            'modal' => 'true',
                            'width' => '60%',
                        ),
                    ));
                    $this->renderPartial('/product/updateproductfromservicecall', array('productModel' => $productModel));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
                    ?>



                </div>
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
                            <td>

                                <?php echo $model->product->brand->name; ?>
                                <br>
                                <?php $brandname=strtolower($model->product->brand->name); ?>
                                <?php $brandname=preg_replace('/\s+/', '', $brandname); ?>
                                 <i class="ukw-logo-fa ukw-logo-fa-<?php echo $brandname;?> fa-4x"></i>


                            </td>
                            <td><span class="datacontenttitle">Product Type</span>
                            <td>
                                <?php echo '' . $model->product->productType->name; ?>
                                <br>
                                <?php $producttypename=strtolower($model->product->productType->name); ?>
                                <?php $producttypename=preg_replace('/\s+/', '', $producttypename); ?>

                                <i class="ukwfa ukwfa-<?php echo $producttypename;?> fa-4x"></i>

                            </td>
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
                                <div title="Product Notes" class="fa fa-sticky-note-o fa-2x"
                                     aria-hidden="true"></div>
                                &nbsp;&nbsp;&nbsp;
                                <?php echo $model->product->notes; ?>
                            </td>
                        </tr>

                    </table>

                </div>
            </div><!-- end of <div class="productbox contentbox"> -->
        </td>
    </tr>
    <!-- Product Box End -->

    <!-- Servicecall Start-->
    <tr>
        <td colspan="2">
            <div class="servicebox contentbox" id="servicebox">
                <div class="serviceheadingbox headingbox">

                    <?php
                    $updateproducttext = "<h4 style='color: white;'><i class='fa fa-wrench'></i>&nbsp;&nbsp;Service Details<div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";
                    echo CHtml::link($updateproducttext,
                        '#', array(
                            'onclick' => '$("#update-servicelcall-dialog").dialog("open"); return false;',
                        ));
                    ?>

                    <?php

                    if (isset($_GET['openservicedialog']))
                        $autoopenservice=true;
                    else
                        $autoopenservice=false;



                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'update-servicelcall-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Update Servicecall',
                            'autoOpen' => $autoopenservice,
                            'resizable' => false,
                            'modal' => 'true',
                            'width' => '60%',
                        ),
                    ));
                    $this->renderPartial('/servicecall/updateservicecalldialog');
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
                    ?>



                </div>
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
                                <?php
                                $searchterm = '';
                                $searchterm .= ' ' . $model->product->brand->name;
                                $searchterm .= ' ' . $model->product->productType->name;
                                $searchterm .= ' ' . $model->product->model_number;
                                $searchterm .= ' ' . $model->fault_description;
                                ?>
                                <?php $google_fault_url = "https://www.google.co.uk/search?q=" . $searchterm; ?>


                                <div class="fa fa-file-text-o fa-2x" aria-hidden="true"></div>
                                    <span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_description'); ?></span>


                                <br>


                                <a href="<?php echo $google_fault_url; ?>" target="_blank">
                                    <?php echo CHtml::image('images/google.png', 'google', array('width'=>'100px','height'=>'100px','title'=>'image title here')); ?>
                                </a>
                                <br>
                                <?php echo $model->fault_description; ?>

                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;" id="sparesbox">
                        <tr class="notice">
                            <th colspan="5"><h4>Spares</h4></th>
                            <th colspan="3">
                                <?php
                                $sparesicon = '<h4 style="float:right;">Add <i class="fa fa-plus-square-o" aria-hidden="true"></i><i class="fa fa-wrench" aria-hidden="true"></i></h4>';
                                echo CHtml::link($sparesicon,'#', array('onclick' => '$("#add-spares-dialog").dialog("open"); return false;',));
                                ?>
                            </th>
                        </tr>


                        <?php $sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id' => $model->id)); ?>

                        <?php if (count($sparesModel) > 0) : ?>



                            <tr class="attention">
                                <th><span class="datacontenttitle">Used</span></th>
                                <th><span class="datacontenttitle">Item</span></th>
                                <th><span class="datacontenttitle">Part Number</span></th>
                                <th><span class="datacontenttitle">Quantity</span></th>
                                <th><span class="datacontenttitle">Unit Price</span></th>
                                <th><span class="datacontenttitle">Total Price</span></th>
                                <th><span class="datacontenttitle"></th>
                                <th><span class="datacontenttitle"></th>

                            </tr>
                            <?php $counter = 0; ?>

                            <?php foreach ($sparesModel as $data) { ?>

                                <?php $counter++;

                                if ($counter % 2 == 0)
                                    $rowclass = 'oddrow';
                                else
                                    $rowclass = 'evenrow';
                                ?>

                                <tr class="<?php echo $rowclass; ?>">


                                    <td>
                                        <?php if ($data->used == 1): ?>
                                            <span class="fa fa-check-square-o" aria-hidden="true"></span>
                                        <?php else: ?>
                                            <span class="fa fa-square-o" aria-hidden="true"></span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo $data->item_name; ?></td>
                                    <td><?php echo $data->part_number; ?></td>
                                    <td><?php echo $data->quantity; ?></td>
                                    <td><?php echo $data->unit_price; ?></td>
                                    <td><?php echo $data->total_price; ?></td>

                                    <td>

                                        <?php echo CHtml::link('<i title="Delete" class="fa fa-trash" aria-hidden="true"></i>', array('sparesUsed/delete', 'id' => $data->id, 'servicecall_id' => $model->id)); ?>

                                    </td>

                                    <td>

                                        <?php echo CHtml::link('<i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('sparesUsed/updateSpares', 'spares_id' => $data->id, 'servicecall_id' => $model->id)); ?>

                                    </td>

                                </tr>
                                <tr class="<?php echo $rowclass; ?>">

                                    <td></td>

                                    <td class="notes" colspan="7">
                                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>

                                        <?php echo $data->notes; ?>
                                    </td>
                                </tr>
                            <?php }//end of foreach of spares()?>


                            <tr class="download">
                                <td colspan="4"></td>
                                <td><span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('total_cost'); ?></span>
                                </td>
                                <td><b><?php echo $model->total_cost; ?></b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="download">
                                <td colspan="4"></td>
                                <td><span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('vat_on_total'); ?></span>
                                </td>
                                <td><b><?php echo $model->vat_on_total; ?></b></td>
                                <td></td>
                                <td></td>

                            </tr>
                            <tr class="download">
                                <td colspan="4"></td>
                                <td><span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('net_cost'); ?></span>
                                </td>
                                <td><b><?php echo $model->net_cost; ?></b></td>
                                <td></td>
                                <td></td>

                            </tr>
                        <?php endif; //end of if (count($sparesModel)>0) : ?>
                    </table>


                    <div class="workcarriedout" id="enggreporting">

                        <div class="datacontenttitle">
                            <div class="fa fa-briefcase fa-2x"></div>
                            <?php echo $model->getAttributeLabel('work_carried_out'); ?>
                        </div>
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

                        <table>
                            <tr>
                                <td>
                                    <div class="datacontenttitle">
                                        <?php echo $model->getAttributeLabel('job_finished_date'); ?>
                                    </div>
                                    <?php echo $setupmodel->formatdate($model->job_finished_date); ?>
                                </td>
                                <td>
                                    <div class="datacontenttitle">
                                        <?php echo $model->getAttributeLabel('job_payment_date'); ?>
                                    </div>
                                    <?php echo $setupmodel->formatdate($model->job_payment_date); ?>
                                </td>
                                <td>
                                    <div class="datacontenttitle">
                                        <?php echo $model->getAttributeLabel('work_summary'); ?>
                                    </div>
                                    <?php echo $model->work_summary; ?>
                                </td>

                            </tr>
                        </table>


                    </div><!-- end of <div class="workcarriedout">-->


                </div><!-- end of <div class="contentbox"> -->


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
                                        <td><?php echo $data->engineer->fullname; ?></td>
                                        <td style="color:maroon"><?php echo $data->jobStatus->name; ?></td>
                                    </tr>
                                    <?php
                                }///end of if
                            }//end of foreach().?>
                        </table>
                    </div>
                <?php endif; ////end of if (count($previousCall>0)): ?>

            </div><!--  <div class="servicebox contentbox">-->


        </td>
    </tr>
    <!-- Servicecall End -->

    <!-- Engineer Start-->

    <tr>
        <td colspan="2">
            <div id="enginnerbox" class="engineerbox contentbox">
                <div class="enginnerheadingbox headingbox">
                    <i class="ukwfa ukwfa-engineer-repair"></i>
                    Engineer
                </div>
                <div class="contentbox">
                    <table>
                        <tr>
                            <th style="width:10%"></th>
                            <th style="width:30%"></th>
                            <th style="width:40%"></th>
                        </tr>

                        <tr>
                            <td>
                                <div title="Customer" class="fa fa-user fa-2x"></div>
                            </td>
                            <td>
                                <?php echo $model->customer->fullname; ?>,
                                <?php echo $model->customer->postcode; ?>
                            </td>
                            <td>
                                <?php echo CHtml::link('<div class="fa fa-road" ></div> Book visit', array('enggdiary/findnextappointmentfromallengg/', 'servicecall_id' => $model->id, 'engineer_id' => $model->engineer_id)); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div title="Engineer" class="fa fa-wrench fa-2x"></div>
                            </td>
                            <td><?php echo $model->engineer->fullname; ?></td>
                            <td>



                                <?php
                                echo CHtml::link('<div class="ukwfa ukwfa-recall"></div> Change Engineer',
                                    '#', array(
                                        'onclick' => '$("#change-engineer-dialog").dialog("open"); return false;',
                                    ));
                                ?>


                                <?php
                                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                    'id' => 'change-engineer-dialog',
                                    // additional javascript options for the dialog plugin
                                    'options' => array(
                                        'title' => 'Change Engineer Only',
                                        'autoOpen' => false,
                                        'resizable' => false,
                                        'modal' => 'true',
                                    ),
                                ));
                                $this->renderPartial('changeEngineeronly');

                                $this->endWidget('zii.widgets.jui.CJuiDialog');
                                // the link that may open the dialog
                                ?>




                            </td>
                        </tr>

                        <?php if ($appointment_exists): ?>
                         <tr>
                                <td>
                                    <div>
                                        <?php echo CHtml::link('<span title="Show/Hide" class="fa fa-calendar fa-2x"></span>', '#', array('class' => 'dayview-button')); ?>

                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if ($model->enggdiary->status=='3')
                                        $appointment_fontcolor='inherit';
                                    else
                                        $appointment_fontcolor='#cccbcb';
                                    ?>

                                    <div style="color:<?php echo $appointment_fontcolor;?>">
                                    <?php echo $setupmodel->formatdatewithtime($model->enggdiary->visit_start_date); ?>
                                    <br>

                                    <?php echo $setupmodel->formatdatewithtime($model->enggdiary->visit_end_date); ?>
                                    </div>
                                </td>
                                <td>

                                   <?php if ($model->enggdiary->status=='3'): ?>

                                    <?php echo CHtml::link('<div class="fa fa-times"></div> Cancel appointment',"#", array("submit"=>array('enggdiary/cancelappointment/', 'diary_id'=>$model->engg_diary_id), 'confirm' => 'Are you sure you want to cancel the appointment?')); ?>
                                    &nbsp;&nbsp;
                                    <?php echo CHtml::link('<div class="fa fa-share"></div> Move appointment', array('enggdiary/viewFullDiary/', 'engg_id' => $model->engineer_id)); ?>

                                    <?php endif; ////if ($appointment_exists): ?>



                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="fa fa-envelope-o fa-2x title" title="Appointment">
                                    </div>
                                </td>
                                <td>
                                    <?php echo $model->enggdiary->notes; ?>
                                </td>
                                <td>
                                    <?php if ($model->enggdiary->status=='3'):  ?>

                                    <?php
                                    echo CHtml::link('<div class="fa fa-pencil-square-o"></div> Edit',
                                        '#', array(
                                            'onclick' => '$("#edit-diarynotes-dialog").dialog("open"); return false;',
                                        ));
                                    ?>


                                    <?php
                                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                        'id' => 'edit-diarynotes-dialog',
                                        // additional javascript options for the dialog plugin
                                        'options' => array(
                                            'title' => 'Edit Diary Notes',
                                            'autoOpen' => false,
                                            'resizable' => false,
                                            'modal' => 'true',
                                        ),
                                    ));
                                    $this->renderPartial('/enggdiary/editnotesonly');

                                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                                    // the link that may open the dialog
                                    ?>

                                    <?php  endif; ////if ($appointment_exists): ?>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <?php $all_appointments = Enggdiary::model()->getappointmentsbyserviceid($model->id); ?>
                                    <?php if (count($all_appointments) > 1): ?>
                                        <h5>Previous Appointments</h5>

                                        <table>
                                            <tr>
                                                <th class="datacontenttitle">Engineer</th>
                                                <th class="datacontenttitle">Visit Date</th>

                                                <th class="datacontenttitle">Notes</th>
                                            </tr>

                                            <?php foreach ($all_appointments as $a): ?>

                                                <?php if ($a->id != $model->engg_diary_id): ?>
                                                    <tr>
                                                        <td><?php echo $a->engineer->fullname; ?> </td>

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

                        <?php endif; ///if ($appointment_exists): ?>


                    </table>
                </div><!-- end of  <div class="contentbox"> -->

            </div><!-- end of <div class="engineerbox contentbox"> -->

            <?php if ($appointment_exists): ?>
                <?php
                Yii::app()->clientScript->registerScript('search', "
                    $('.dayview-button').click(function(){
                        $('.dayview').toggle();
                         return false;
                    });
                    ");
                ?>

                <?php echo CHtml::link('<span title="Hide" style="float: right" id="mbtn" class="fa fa-minus-square-o fa-2x"></span>', '#', array('class' => 'dayview-button')); ?>

                <div class="dayview" style="display:block">

                    <small>If moving the appointment, <a href="#enginnerbox"
                                                         onclick="window.location.reload(true);">refresh</a> the
                        page to reflect the changes
                    </small>

                    <?php
                    $route_date_string = date('Y-m-d', $model->enggdiary->visit_start_date);
                    $this->renderPartial('/enggdiary/viewday', array('engineer_id' => $model->engineer_id, 'selected_date_str' => $route_date_string));
                    ?>
                </div>

            <?php endif; ///if($appointment_exists): ?>


        </td>
    </tr>


    <!-- Engineer End -->


    <!-- Activity Log Start-->
    <tr>
        <td colspan="2">
            <div class="engineerbox contentbox" id="activitylog">

            <div class="enginnerheadingbox contentbox">

                <?php

                Yii::app()->clientScript->registerScript('activitylog-div', "
                                        $('#activitylog-button').click(function(){
	                                    $('#activitylog-div').toggle();
	                                    return false;
                                        });
                                ");
                ?>


                <?php $activitylogtext = "<h4 style='color: white;' id='activilitylogdivbutton'><i class='fa fa-code-fork'></i>&nbsp;&nbsp;Activity Log <div style='float:right;'><i class='fa fa-toggle-on'></i></div> <h4>"; ?>
                <?php echo CHtml::link($activitylogtext, '#', array('id' => 'activitylog-button')); ?>


            </div>
                 <div id="activitylog-div" style="display:none">
                    <?php $activity_array = json_decode($model->activity_log, true); ?>
                    <?php if (count($activity_array) > 0): ?>

                        <table>
                            <tr>
                                <th><span class="datacontenttitle">Activity Date</span></th>
                                <th><span class="datacontenttitle">Status</span></th>
                                <th><span class="datacontenttitle">User</span></th>
                                <th><span class="datacontenttitle">Engineer</span></th>
                            </tr>
                            <?php foreach ($activity_array as $ac): ?>
                                <tr>
                                    <td><?php echo $ac['time']; ?></td>
                                    <td><?php echo $ac['jobstatus']; ?></td>
                                    <td><?php echo $ac['user']; ?></td>
                                    <td><?php echo $ac['engineer']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>
    <!-- Activity Log  End-->

</table>


