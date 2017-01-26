<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/01/2017
 * Time: 13:23
 */

use common\models\Jobstatus;
use common\models\Servicecall;
use common\models\Handyfunctions;

$dashboard_job_statuses = JobStatus::getDashboradJobStatuses();


?>


<?php foreach ($dashboard_job_statuses as $job_status): ?>

    <?php $servicecalls_for_js = Servicecall::get_servicecalls_by_job_status_id($job_status->id); ?>
    <?php if(count($servicecalls_for_js )>0): ?>

    <?php $job_status_div_id = 'job_status_' . strtolower($job_status->keyword) . '_div'; ?>
    <?php $job_status_div_toggle_btn_id = 'job_status_' . strtolower($job_status->keyword) . '_toggle_btn'; ?>


    <div id="job_statuses">


        <div id="<?php echo $job_status_div_toggle_btn_id; ?>" style="color:#010e07;border-radius:20px;background-color: <?php echo $job_status->backgroundcolor; ?>">
            <table class="full_width">
                <tr>
                    <td>
                        <h3>
                            <?php echo $job_status->html_name; ?>
                        </h3>

                    </td>

                    <td>
                        <div style="float: right" class="contentbox mobile_content">
                            (<?php echo count($servicecalls_for_js); ?>)

                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </div>

                    </td>
                </tr>
            </table>
        </div>




        <div id="<?php echo $job_status_div_id; ?>" style="border-radius:20px;opacity:0.7;display: none;background-color: <?php echo $job_status->backgroundcolor; ?>">

            <table class="responsive-stacked-table">

                <?php foreach ($servicecalls_for_js as $job) : ?>

                    <tr>
                        <td><?php echo $job->service_reference_number; ?></td>
                        <td><?php echo Handyfunctions::format_date_short($job->fault_date); ?></td>
                        <td><?php echo $job->customer->fullname; ?></td>
                        <td><?php echo $job->customer->town; ?>, <?php echo $job->customer->postcode; ?></td>
                        <td><?php echo $job->product->brand->name; ?> <?php echo $job->product->productType->name; ?> </td>
                        <td><?php echo $job->product->model_number; ?> </td>
                        <td><?php echo $job->contract->short_name; ?> </td>
                        <td><?php echo $job->engineer->fullname; ?> </td>
                    </tr>

                <?php endforeach; ///end of <?php foreach ($servicecalls_for_js as $job) :            ?>
            </table>

        </div><!-- end of  <div id="$job_status_div_id;?>">-->

    </div><!-- end of <div id="job_statuses">-->
    <?php endif; ///end of if(count($servicecalls_for_js )>0) ?>


    <?php
    $this->registerJs("

     $('#" . $job_status_div_toggle_btn_id . "').click(function(){
        $('#" . $job_status_div_id . "').toggle();

    });    
 
    ");


    ?>


<?php endforeach;///end of  foreach ($dashboard_job_statuses as $dash_job_status):?>

