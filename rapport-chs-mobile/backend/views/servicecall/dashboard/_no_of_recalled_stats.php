<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/01/2017
 * Time: 12:13
 */
use common\models\Handyfunctions;


?>


<table id="recalled-jobs-table" style="width: 600px" >

    <tr>
        <td colspan="4">
            <h3 style="text-align: center">
                <i class="fa fa-repeat" aria-hidden="true"></i>
                <i class="fa fa-wrench" aria-hidden="true"></i>


                &nbsp;&nbsp;&nbsp;
                Total Recalled Service Calls
                &nbsp;&nbsp;&nbsp;
                <i class="fa fa-wrench fa-flip-horizontal" aria-hidden="true"></i>
                <i class="fa fa-repeat fa-flip-horizontal" aria-hidden="true"></i>

            </h3>
        </td>
    </tr>

    <tr>
        <td class="mobile_content border_bottom_white">
            Week
        </td>
        <td class="mobile_content border_bottom_white">
            Month
        </td>
        <td class="mobile_content border_bottom_white">
            Year
        </td>
        <th class="border_bottom_white">

        </th>

    </tr>

    <tr >

        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->last_7_days; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->last_30_days; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->last_365_days; ?>
        </td>
        <th class="border_bottom_white">
            Last

        </th>
    </tr>


    <tr >

        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->previous_week; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->previous_month; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $recalled_jobs_stats_json->previous_year; ?>
        </td>
        <th class="border_bottom_white">
            Previous

        </th>
    </tr>


    <tr>

        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($recalled_jobs_stats_json->performance->last_week); ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($recalled_jobs_stats_json->performance->last_month); ?>
        </td>

        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($recalled_jobs_stats_json->performance->last_year); ?>
        </td>

        <th class="border_bottom_white" >
            Perentage

        </th>
    </tr>

</table><!--<table id="recalled-jobs-table"> -->


