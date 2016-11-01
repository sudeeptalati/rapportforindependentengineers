<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 27/10/2016
 * Time: 16:04
 */

use common\models\Handyfunctions;
?>
<script src="https://use.fortawesome.com/860d66d0.js"></script>
<script src="https://use.fortawesome.com/a8e251d4.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<style type="text/css">
    h1{
        font-size: 40px;
        float: right;
        text-align: right;
        color:grey;
    }
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

    .full_width{
        width: 100%;
    }
    .content {
        font-size: 20px;
        font-weight: 300;
        padding-left: 10px;
        letter-spacing: 2px;
    }

    .title {
        font-size: 14px;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
    }


</style>

<table class="full_width">
    <tr>
        <td>
            <img src="<?php echo Yii::$app->params['company_logo_url'];?>" />
        </td>
        <td style="text-align: right">
            <h1>INVOICE</h1>

        </td>
    </tr>
    <tr>
        <td>
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
        <td style="text-align: right;">
            <table>
                <tr>
                    <td>
                        <span class="title">
                            Job Ref No.#
                        </span>
                    </td>

                    <td>
                        <span class="content">
                            <?php echo $model->service_reference_number;?>
                         </span>
                    </td>
                </tr>
           </table>

        </td>
    </tr>

</table>