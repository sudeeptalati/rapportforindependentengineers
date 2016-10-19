<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 12/10/2016
 * Time: 10:11
 */

use common\models\Handyfunctions;

use yii\helpers\Url;



?>

<?php

$date = Yii::$app->request->get('date');

if ($date)
{
    $date_string=$date;
}else
{
    $date_string=Handyfunctions::get_todays_date_string();
}





$date_int=strtotime($date_string);


//Day of the month without leading zeros	1 to 31
$date_of_month_digit=Handyfunctions::get_date_of_month($date_int);

///January through December
$month_string=Handyfunctions::get_month_string($date_int);

//	Examples: 1999 or 2003
$year_digit=Handyfunctions::get_year_string($date_int);

$weekday=Handyfunctions::get_weekday_string($date_int);


$previous_day=Handyfunctions::get_previous_day($date_string);
$next_day=Handyfunctions::get_next_day($date_string);

$previous_day_url=Url::to(['site/index', 'date' => $previous_day]);
$next_day_url=Url::to(['site/index', 'date' => $next_day]);

?>
<div class="today_border">
    <?php $calendar_url= Url::to(['site/calendar']);?>
    <div class="today_month">
        <table style="width: 100%">
            <tr>
                <td>
                    <a class="link_white_color" href="<?php echo $previous_day_url;?>">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                </td>
                <td>
                    <a class="link_white_color" href="<?php echo $next_day_url;?>">
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </td>
            </tr>
        </table>

        <a class="link_white_color" href="<?php echo $calendar_url;?>">
            <?php echo $month_string; ?>
        </a>

    </div>
    <?php $servicecall_url= Url::to(['enggdiary/showappointmentsfordate', 'date' => $date_string    ]);?>
    <a href="<?php echo $servicecall_url;?>">
        <div class="todays_date">
            <?php echo $date_of_month_digit; ?>
        </div>
        <div class="today_weekday">
            <?php echo $weekday; ?>
        </div>
    </a>
</div>
