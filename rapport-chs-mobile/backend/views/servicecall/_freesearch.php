<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/01/2017
 * Time: 11:46
 */

use common\models\Handyfunctions;

/*
echo "<hr><br>".$result->postcode;
echo "---- Total Servicecalls ".count($result->servicecalls);
echo "---- Total Products ".count($result->products);
*/
$css = Yii::$app->request->baseUrl . '/css/site.css';


?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl . '/css/site.css'; ?> ">
    <script src="https://use.fontawesome.com/e1a64274e1.js"></script>
    <!-- UKW Logo set -->
    <script src="https://use.fortawesome.com/860d66d0.js"></script>
    <!-- UKW Icon set -->
    <script src="https://use.fortawesome.com/a8e251d4.js"></script>
    <!-- Recaptcha-->


<?php foreach ($freesearch_data as $data): ?>

    <table class="responsive-stacked-table freesearchresults">
        <tr>
            <td>
                <div class="customerdatabox">


                    <table class="full_width">
                        <tr>
                            <td>
                                <div class="customerheadingbox white_color customerdatabox">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $data->title; ?>&nbsp; <?php echo $data->fullname; ?>
                                </div>
                                <div class="address_contact">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>

                                    <?php echo Handyfunctions::formataddressinhtml(
                                        $data->address_line_1,
                                        $data->address_line_2,
                                        $data->address_line_3,
                                        $data->town,
                                        $data->postcode
                                    ); ?>
                                </div>

                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <?php echo $data->telephone; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fa fa-mobile" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <?php echo $data->mobile; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>


                    <!--- END OF CONTACTS -->
                    <div class="productbox contentbox">


                        <?php foreach ($data->products as $product): ?>

                            <table class="full_width">
                                <tr>
                                    <td>
                                        <?php echo Handyfunctions::getawesomebrandicon($product->brand->name); ?>
                                        <?php echo Handyfunctions::getawesomeapplianceicon($product->productType->name); ?>
                                    </td>

                                    <td>
                                        <?php echo $product->brand->name; ?>

                                    </td>

                                    <td>
                                        <?php echo $product->productType->name; ?>

                                    </td>

                                    <td>
                                        <?php echo $product->model_number; ?>

                                    </td>

                                    <td>

                                        <?php echo $product->serial_number; ?>

                                    </td>
                                </tr>
                            </table>


                            <div class="w contentbox">

                                <table>

                                    <?php foreach ($product->servicecalls as $servicecall): ?>
                                        <tr>
                                            <td class="border_right_white" style="width: 5%">
                                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                            </td>
                                            <td class="border_right_white" style="width: 10%">
                                                <?php echo $servicecall->service_reference_number; ?>
                                                <div title="Reported Date" style="text-align: right; font-size: 12px; font-weight: 400">
                                                    <?php echo Handyfunctions::format_date_short($servicecall->fault_date); ?>
                                                </div>
                                            </td>
                                            <td class="border_right_white" style="width: 15%">
                                                <?php echo $servicecall->jobstatus->html_name; ?>
                                                <div title="Completion Date" style="text-align: right; font-size: 12px; font-weight: 400">
                                                    <?php echo Handyfunctions::format_date_short($servicecall->job_finished_date); ?>
                                                </div>

                                            </td>
                                            <td class="border_right_white" style="width: 35%">
                                                <?php echo $servicecall->fault_description; ?>
                                            </td>
                                            <td class="border_right_white" style="width: 35%">
                                                <?php echo $servicecall->work_carried_out; ?>
                                            </td>


                                        </tr>
                                    <?php endforeach;///end of foreach ($data->servicecalls as $servicecall): ?>
                                </table>
                            </div>


                        <?php endforeach;///end of foreach foreach ($data->products as $product): ?>
                    </div>

                </div><!-- end of  <div class="customerdatabox">-->
            </td>
        </tr>
    </table>


<?php endforeach; ///end of foreach ($freesearch_data as $result): ?>