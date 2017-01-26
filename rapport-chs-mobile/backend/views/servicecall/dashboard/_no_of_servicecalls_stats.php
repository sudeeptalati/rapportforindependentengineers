<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/01/2017
 * Time: 12:13
 */

use common\models\Handyfunctions;

?>


<table id="no-of-jobs-table" style="width: 600px" >
    <tr>
        <td colspan="4">
            <h3 style="text-align: center">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                &nbsp;&nbsp;&nbsp;
                Total Service Calls
                &nbsp;&nbsp;&nbsp;
                <i class="fa fa-wrench fa-flip-horizontal" aria-hidden="true"></i>
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
        <th class="border_bottom_white"></th>


    </tr>


    <tr>

        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->last_7_days; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->last_30_days; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->last_365_days; ?>
        </td>
        <th class="border_bottom_white">
            Last

        </th>
    </tr>


    <tr>

        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->previous_week; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->previous_month; ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo $no_of_jobs_stats_data_json->previous_year; ?>
        </td>
        <th class="border_bottom_white">
            Previous

        </th>
    </tr>


    <tr>

        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($no_of_jobs_stats_data_json->performance->last_week); ?>
        </td>
        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($no_of_jobs_stats_data_json->performance->last_month); ?>
        </td>

        <td class="mobile_content border_bottom_white">
            <?php echo Handyfunctions::format_performance_percentage_html($no_of_jobs_stats_data_json->performance->last_year); ?>
        </td>

        <th class="border_bottom_white">
            Perentage

        </th>
    </tr>


    <tr>
        <td colspan="4">

        </td>
    </tr>
</table><!--<table id="no-of-jobs-table"> -->
