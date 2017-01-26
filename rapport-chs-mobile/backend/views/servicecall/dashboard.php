<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/01/2017
 * Time: 10:45
 */
use yii\helpers\Html;
use common\models\Handyfunctions;

$no_of_jobs_stats_data = Handyfunctions::get_no_of_servicecalls_stats_data();
$no_of_jobs_stats_data_json = json_decode($no_of_jobs_stats_data);

$recalled_jobs_stats_data = Handyfunctions::get_recalled_stats_data();
$recalled_jobs_stats_json = json_decode($recalled_jobs_stats_data);


?>

<table class="responsive-stacked-table">
    <tr>
        <td style="width: 70%;"></td>
        <td colspan="2" style="width:30%;">
            <h3 style="text-align: center">
                <i class="fa fa-tachometer" aria-hidden="true"></i>

                Performance
            </h3>
        </td>
    </tr>
    <tr>
        <td>
            <?= Html::textInput('magic_search_box', '', ['id' => 'magic_search_box', 'class' => 'magic_searchbox', 'placeholder' => 'Search here.............']); ?>
        </td>
        <td style="width: 15%">
            <div class="mobile_content attention square_icon_box_large" id="no-of-jobs-toggle-btn"
                 style="cursor: pointer;">

                <h4>
                    <i class="fa fa-wrench fa-1x" aria-hidden="true"></i>
                    Jobs
                </h4>

                <?php echo Handyfunctions::format_performance_percentage_html($no_of_jobs_stats_data_json->performance->last_month); ?>
            </div>
        </td>
        <td style="width: 15%">


            <div class="mobile_content attention square_icon_box_large" id="recalled-jobs-toggle-btn"
                 style="cursor: pointer;">
                <h4>
                    <i class="fa fa-repeat fa-1x" aria-hidden="true"></i>
                    Recalls
                </h4>
                <?php echo Handyfunctions::format_performance_percentage_html($recalled_jobs_stats_json->performance->last_month); ?>
            </div>
        </td>
    </tr>
</table>

<div id="no_of_jobs_stats_div" style="display: none; float: right" class="servicebox contentbox">
    <?= $this->render('dashboard/_no_of_servicecalls_stats', ['no_of_jobs_stats_data_json' => $no_of_jobs_stats_data_json]); ?>
</div>

<div id="recalled_jobs_stats_div" style="display: none; float: right" class="engineerbox contentbox">
    <?= $this->render('dashboard/_no_of_recalled_stats', ['recalled_jobs_stats_json' => $recalled_jobs_stats_json]); ?>
</div>


<!-- TO DISPLAY THE SEARCH RESULTS-->
<div id="searchresultdata"></div>


<table class="full_width">
    <tr>
        <td style="width: 30%;vertical-align: top">

            <div class="attention" style="vealign: top;">
                <h3>Recent 10 Jobs
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                </h3>

                <table class="responsive-stacked-table">
                    <tr>
                        <td>202772</td>
                        <td>Call the Customer</td>
                    </tr>

                    <tr>
                        <td>202732</td>
                        <td>Check Stock</td>
                    </tr>

                    <tr>
                        <td>202752</td>
                        <td>Refer the manufacturer</td>
                    </tr>

                    <tr>
                        <td>202772</td>
                        <td>Call the Customer</td>
                    </tr>


                </table>
            </div>

        </td>
        <td style="width: 70%;text-align: right">
            <div id="dashboard_jobs">
                <h2 id="dashboard-job_statuses-toggle-btn">
                    <i class="fa fa-dashcube" aria-hidden="true"></i>
                    Statuses
                </h2>

                <div id="dashboard_job_statuses_div" style="cursor: pointer;">
                    <?= $this->render('dashboard/_dashboard_display_jobs'); ?>
                </div>
            </div><!-- end of <div id="dashboard_jobs">-->

        </td>
    </tr>
</table>


<table class="full_width">
    <tr>
        <td>
            <div class="square_icon_box_large attention">
                <h3>
                    Diary
                </h3><i class="fa fa-calendar fa-2x" aria-hidden="true"></i>

            </div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
        <td>
            <div class="square_icon_box_large attention"></div>
        </td>
    </tr>
</table>


<!--JS Functions-->

<?php
$this->registerJs("

     $('#no-of-jobs-toggle-btn').click(function(){
        $('#no_of_jobs_stats_div').toggle();

    });    
     
     $('#recalled-jobs-toggle-btn').click(function(){
        $('#recalled_jobs_stats_div').toggle();
     });


     $('#dashboard-job_statuses-toggle-btn').click(function(){
        $('#dashboard_job_statuses_div').toggle();
     });



 
");


?>

