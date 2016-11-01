<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 27/10/2016
 * Time: 12:45
 */

use common\models\Sparesused;
use common\models\Enggdiary;

?>

<!-- FONT AWESOME-->
<script src="https://use.fortawesome.com/860d66d0.js"></script>
<script src="https://use.fortawesome.com/a8e251d4.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<style type="text/css">

    hr {
        color: sienna;
    }

    p {
        margin-left: 20px;
    }

    body {

        background-color: transparent;
        font-family: "Helvetica";
    }

    table {
        /*
        border: 8px outset green;
        */
    }

    td {
        vertical-align: top;
        font-size: 10px;

        /*
        border: 3px dotted green;
        */
    }

</style>

<table style="width:100%;    ">
    <tr>
        <td align="left">
            <h3>Service Call ID#</h3>
            <h2><?php echo $model->service_reference_number; ?></h2>
            <br><b>
                <small>Attending Engineer:</small>
            </b><br>
            <?php echo $model->engineer->company; ?><br>
            <?php echo $model->engineer->fullname; ?>
            <br>
            <?php echo $model->engineer->contactDetails->town; ?>&nbsp;
            <?php echo $model->engineer->contactDetails->postcode; ?>
            <br>
            Phone:
            <?php if ($model->engineer->contactDetails->telephone != "")
                echo $model->engineer->contactDetails->telephone;
            ?> <?php if ($model->engineer->contactDetails->mobile != "")
                echo "," . $model->engineer->contactDetails->mobile;
            ?><br>
            <?php echo $model->engineer->contactDetails->email; ?>

        </td>
        <td>
            <h3 style="text-align: center;">Visit & Invoice Date</h3>
            <?php
            if (isset($model->enggdiary->visit_start_date)) {
                ?>
                <h2><?php echo date('l, j-F-Y', $model->enggdiary->visit_start_date); ?></h2>
                <h2><?php echo date('g:i a', $model->enggdiary->visit_start_date) . ' -' . date('g:i a', $model->enggdiary->visit_end_date); ?></h2>
                <?php
            }///end of if ($model->enggdiary->visit_start_date)
            ?>
        </td>

        <td align="right" style="font-size:8px;">
            <?php

            $company_logo =Yii::$app->params['company_logo_url'];
            echo '<img style="vertical-align: top" src="' . $company_logo . '" /><br>';

            ?>

            <?php

            $company_name = $company_details->company;
            $company_address = $company_details->address;
            $company_town = $company_details->town;
            $company_postcode_s = $company_details->postcode_s;
            $company_postcode_e = $company_details->postcode_e;

            $company_email = $company_details->email;
            $company_telephone = $company_details->telephone;
            $company_mobile = $company_details->mobile;
            $company_alternate = $company_details->alternate;
            $company_fax = $company_details->fax;
            $company_website = $company_details->website;
            $company_vat_no = $company_details->vat_reg_no;
            $company_reg_no = $company_details->company_number;

            echo $company_name . "<br>" . $company_address . " ," . $company_town . "&nbsp;" . $company_postcode_s . "&nbsp;" . $company_postcode_e;
            echo "<br> Phone:" . $company_telephone . "&nbsp;&nbsp;&nbsp;&nbsp; Fax:" . $company_fax . "&nbsp;&nbsp;&nbsp;&nbsp;<br>Email:" . $company_email;

            if (!empty($company_vat_no))
                echo "<br>VAT No:" . $company_vat_no;
            if (!empty($company_reg_no))
                echo " <br>&nbsp;&nbsp;&nbsp;&nbsp; Company No.:" . $company_reg_no;

            ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>
</table>

<!-- THIS TABLE HAVE 4 COLUMNS -->
<table style="width:100%; ">


    <tr>
        <td colspan="2">
            <table style='width:100%'>
                <tr>
                    <td style='width:30%'><h3><i>Customer Details</i></h3>
                    </td>
                    <td style='width:30%'><h3><i>Contact Details</i></h3>
                    </td>
                    <td style='width:40%;text-align:right;'><h3><i>Invoice Details</i></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style="width:450px;">
                            <tr>
                                <td><b>Name</b><br><font size="4">
                                        <?php echo $model->customer->title ?>&nbsp;
                                        <?php echo $model->customer->fullname ?>
                                    </font></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Address</b><br><font size="4">
                                        <?php echo $model->customer->address_line_1 . " " . $model->customer->address_line_2 . " " . $model->customer->address_line_3 . ", " . $model->customer->town; ?>
                                    </font></td>
                            </tr>
                            <tr>
                                <td><b>Postcode</b><br><font size="4">
                                        <?php echo $model->customer->postcode; ?> </font>
                                </td>

                                <td><!--
				<small><b>County (District)</b></small>
				<br>
				<?php //echo $model->customer->postcode?>
				 -->
                                </td>

                                <td>
                                    <!--
			<small><b>Country</b></small>
				<br>
				<?php echo $model->customer->country ?>
			 -->

                                </td>


                            </tr>

                        </table>
                    </td>
                    <td><b>Telephone</b>
                        <br><font size="4">
                            <?php echo $model->customer->telephone; ?>
                        </font><br><br>
                        <b>Mobile</b>
                        <br><font size="4">
                            <?php echo $model->customer->mobile; ?>
                        </font><br><br>
                        <b>Parking</b>
                        <br><font size="4">
                            <?php echo $model->customer->fax; ?>
                        </font><br><br></h3>
                    </td>
                    <td style='text-align:right;'>
                        <font size="4"><?php echo $model->contract->name; ?></font>
                        <br>
                        <?php //echo $model->contract->mainContactDetails->address_line_1;?>
                        <!--<br>
			<?php echo $model->contract->maincontactdetails->address_line_2; ?>
			<br>
			<?php echo $model->contract->maincontactdetails->address_line_3; ?>
			<br>
			-->
                        <?php //echo $model->contract->mainContactDetails->town;?>

                        <?php //echo $model->contract->mainContactDetails->postcode;?>
                        <!--
			<br><br>
			<?php echo $model->contract->maincontactdetails->telephone; ?>
			<br>
			<?php echo $model->contract->maincontactdetails->email; ?>
			-->

                    </td>
                </tr>

            </table>
            <b>Email: </b> <?php echo $model->customer->email; ?>

        </td>
    </tr>


    <tr>
        <td colspan="2">

            <!-- THESE ARE  NOTES FROM THE SERVICE CALL TABLE  -->
            <!--
<b><small>Call Requirement / Instruction Notes</small></b>
<br><i><?php echo $model->notes ?></i>
-->


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
</table>

<table style="width:100%">
    <tr>
        <td colspan="4"><h3><i>Product Details</i></h3></td>
    </tr>
    <tr>

        <td width=20%>


            <?php $brandname=strtolower($model->product->brand->name); ?>
            <?php $brandname=preg_replace('/\s+/', '', $brandname); ?>
            <i class="ukw-logo-fa ukw-logo-fa-<?php echo $brandname;?> fa-3x"></i>
            <?php $producttypename=strtolower($model->product->productType->name); ?>
            <?php $producttypename=preg_replace('/\s+/', '', $producttypename); ?>
            <i class="ukwfa ukwfa-<?php echo $producttypename;?> fa-3x"></i>
            <br>


            <?php echo $model->product->brand->name; ?>
            <?php echo '' . $model->product->productType->name; ?>




        </td>
        <td width=20%>
            <small><b>Model</b></small>
            <br>
            <?php echo $model->product->model_number; ?>
        </td>
        <td width=20%>
            <small><b>Serial Number</b></small>
            <br>
            <?php echo $model->product->serial_number; ?>
        </td>
        <td width=20%>
            <small><b>Product Code</b></small>
            <br>
            <?php echo $model->product->production_code; ?>
        </td>
        <td width=20%>
            <small><b>Colour</b></small>
            <br>
            <?php echo $model->product->enr_number; ?>
        </td>
    </tr>
    <!--
		<tr>
			<td><small><b>Retailer</b></small>
			<br>
			<?php echo $model->product->purchased_from; ?>
			</td>
			<td ><small><b>Date of Purchase</b></small>
			<br>
			<?php
    if ($model->product->purchase_date != '')
        echo date('d-M-Y', $model->product->purchase_date); ?>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		-->
    <tr>
        <td colspan="5">
            <hr>
        </td>
    </tr>
</table>


<!--
		<td style="width:30%; vertical-align:top; ">
		<small><b>Product Notes</b></small>
		<br><?php echo $model->product->notes ?>
		</td>
	 -->

<table style="width:100%">
    <tr>
        <td colspan="4"><h3><i>Fault Reported Details</h3></i></td>
    </tr>
    <tr>
        <td>
            <small><b>Contract</b></small>
            <br>
            <?php echo $model->product->contract->name; ?>
            <br>
            <small><b>Reported </b></small>
            <br>
            <?php
            if (!empty($model->fault_date)) {
                //echo $model->fault_date;
                $fault_date = date('d-M-Y', $model->fault_date);
                echo $fault_date;

            }

            ?>
        </td>
        <td>
            <small><b>Refrence No#</b></small>
            <br>
            <?php echo $model->insurer_reference_number; ?>
            <br>
            <small><b>Agreement No./ Plan No</b></small>
            <br>
            <?php echo $model->fault_code; ?>


        </td>
        <td colspan="2">
            <small><b><?php
                    echo $model->getAttributeLabel('notes');
                    ?> </b></small>

            <br><b style="background: yellow;padding: 2px;">
                <?php
                echo $model->notes;


                ?>
            </b>


            <!--

			<small><b>End</b></small>
			<br>
			<?php
            if ($model->product->warranty_date != '') {

                echo date('d-M-Y', $end_date);
            }

            ?>
	        -->
        </td>
    </tr>

    <tr>
        <td colspan="4" style="width:30%; vertical-align:top;">
            <small><b>Issue Reported</b></small>
            <br>
            <?php echo $model->fault_description ?><br><br><br>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
</table>


<table style="width:100%;padding:-5;">
    <tr>
        <td colspan="4"><h3><i>Technician Report</i></h3></td>
    </tr>
    <tr>
        <td colspan="4">
            <small><b>Work Carried out or Inspection</b></small>
            <br><?php echo $model->work_carried_out; ?>
            <br><br><br><br><br>
            <b>
                <small>Please detail any test or results carried out</small>
            </b>
            <br><br>
            <br><br>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <small><b>Spares</b>


            </small>
            <table style="width:650px;border-collapse:collapse;">
                <tr>
                    <td width=10% style="border:1px solid black;">Qty.</td>
                    <td width=20% style="border:1px solid black;">Part Number</td>
                    <td width=30% style="border:1px solid black;">Description</td>
                    <td width=5% style="border:1px solid black;">Used</td>
                    <td width=5% style="border:1px solid black;">Req.</td>
                    <td width=15% style="border:1px solid black;">Price</td>
                    <td width=15% style="border:1px solid black;">Total</td>
                </tr>

                <?php //for ($i=1;$i<7;$i++){?>

                <?php

                $sparesModel = Sparesused::loadallsparesbyservicecallid($model->id);

                if (count($sparesModel ) > 0) {
                    echo "<br>Spares are used";

                    foreach ($sparesModel as $data) {
                        //echo "<br>".$data->id."&nbsp;&nbsp;&nbsp;";
// 		echo "Quantity = ".$data->quantity;
// 		echo "Paert Number = ".$part_num = $data->part_number;
// 		echo "Item Name = ".$desc = $data->item_name;
// 		echo "Uniy price = ".$price = $data->unit_price;
// 		echo "Total = ".$total = $data->total_price;
                        ?>
                        <tr>
                            <td style="border-right:1px solid black; border-left:1px solid black;"><?php echo $data->quantity; ?></td>
                            <td style="border-right:1px solid black;"><?php echo $data->part_number; ?></td>
                            <td style="border-right:1px solid black;"><?php echo $data->item_name; ?></td>
                            <td style="border-right:1px solid black;">
                                <?php if ($data->used == 1): ?>
                                    <span>✔</span>
                                <?php endif; ?>
                            </td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><?php echo $data->unit_price; ?></td>
                            <td style="border-right:1px solid black;"><?php echo $data->total_price; ?></td>
                        </tr>
                        <?php
                    }//end of foreach().

                }//end of if().

                else {

                    for ($i = 1; $i < 7; $i++) {
                        ?>
                        <tr>
                            <td style="border-right:1px solid black; border-left:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                            <td style="border-right:1px solid black;"><br></td>
                        </tr>
                        <?php
                    }//end of for.

                }//end of else().
                ?>

                <?php //}//end if outer for().?>

                <tr>
                    <td colspan="6"
                        style="border-left:1px solid black;border-right:1px solid black;border-top:1px solid black;  text-align:right;">
                        Subtotal
                    </td>
                    <td style="border:1px solid black;"><?php echo $model->total_cost; ?></td>
                </tr>
                <tr>
                    <td colspan="6"
                        style="border-left:1px solid black;border-right:1px solid black;  text-align:right;">VAT
                    </td>
                    <td style="border:1px solid black;"><?php echo $model->vat_on_total; ?></td>
                </tr>
                <tr>
                    <td colspan="6"
                        style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;  text-align:right;">
                        Total
                    </td>
                    <td style="border:1px solid black;"><?php echo $model->net_cost; ?></td>
                </tr>

            </table><!-- end of Spares Table -->
        </td>
    </tr><!-- END OF SPARES TD -->


</table>
<br><br><br>


<table style="width:100%">
    <tr>
        <td>Date of first Visit
            <?php
            $allvisits = Enggdiary::loadallappointmentsbyservicecall_id($model->id);
            foreach ($allvisits as $v) {
                echo "<br>" . date('d-M-Y', $v->visit_start_date);
            }

            ?>
        </td>
        <td>Date of Completion
            <br><?php
            if (!empty($model->job_finished_date))
                echo date('d-M-Y', $model->job_finished_date);
            ?>
        </td>
        <td>Engineer's Signature</td>
        <td>Customer's Signature</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid sienna;"></td>
        <td style="border-bottom: 1px solid sienna;"></td>
        <td style="border-bottom: 1px solid sienna;"></td>
        <td style="border-bottom: 1px solid sienna;"></td>

    </tr>

</table>
<!--
			<br>
			<small><b>Payment: </b></small>&nbsp;
			<?php
if ($model->job_payment_date != '')
    echo date('d-M-Y', $model->job_payment_date);

?>
			<br>
			<small><b>Completion:	</b></small>&nbsp;
			<?php if ($model->job_finished_date)
    echo date('d-M-Y', $model->job_finished_date); ?>

			 -->


