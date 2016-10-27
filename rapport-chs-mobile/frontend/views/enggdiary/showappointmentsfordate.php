<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 13/10/2016
 * Time: 13:12
 */

use common\models\Handyfunctions;
use yii\helpers\Url;

$this->title=$date_string.'| Diary | Rapport';
?>



<h1><?php echo $date_string; ?> <?php echo $weekday; ?></h1>
<table class="responsivetable">
    <caption>Your Appointments</caption>
    <thead>
    <tr>
        <th style="width: 10%">Time</th>
        <th style="width: 30%">Customer</th>
        <th style="width: 20%">Actions</th>
        <th style="width: 40%">Address</th>
    </tr>
    </thead>
    <tbody>


    <?php foreach ($appointments as $app): ?>

        <?php
        $customer_address = Handyfunctions::formataddress(
            $app->servicecall->customer->address_line_1,
            $app->servicecall->customer->address_line_2,
            $app->servicecall->customer->address_line_3,
            $app->servicecall->customer->town,
            $app->servicecall->customer->postcode
        );

        $view_appointment_url=Url::to(['enggdiary/viewappointment', 'servicecall_id' => $app->servicecall_id, 'enggdiary_id'=>$app->id]);

        ?>

        <tr>
            <td data-th="Time">
                <?php echo Handyfunctions::format_time($app->visit_start_date); ?>
                -
                <?php echo Handyfunctions::format_time($app->visit_end_date); ?>

                <div style="float: right">
                    <a href="<?php echo $view_appointment_url;?>" style="color:#89c2f1">
                        <i class="fa fa-folder-open" aria-hidden="true"></i>

                        #<?php echo $app->servicecall->service_reference_number;?>
                    </a>

                </div>

            </td>



            <td>
                <?php echo $app->servicecall->customer->fullname; ?>
                <br>
                <small>
                    <?php echo $app->servicecall->jobstatus->html_name; ?>

                </small>
            </td>

            <td>

                <div>
                    <div style="float: left">
                        <?php if ($app->servicecall->customer->mobile): ?>
                            <a href="tel:<?php echo Handyfunctions::formatphonenoforuk($app->servicecall->customer->mobile); ?>">
                                <i class="fa fa-phone-square fa-3x" aria-hidden="true"></i>

                            </a>

                        <?php endif; ?>

                    </div>
                    <div style="float: right">
                        <a href="http://maps.google.com/?saddr=Current%20Location&daddr=<?php echo $customer_address; ?>">
                            <i class="fa fa-map-signs fa-3x" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>

            </td>

            <td>
                <?php echo $customer_address; ?>
            </td>
            <td>
                <?php //echo $app->servicecall->jobstatus->html_name; ?>
            </td>

        </tr>

    <?php endforeach; ?>


    </tbody>
</table>