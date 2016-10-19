<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 12/10/2016
 * Time: 11:15
 */

use common\models\Handyfunctions;

use yii\helpers\Url;


?>


<style>
    * {box-sizing:border-box;}
    ul {list-style-type: none;}
    body {font-family: Verdana,sans-serif;}

    .month {
        padding: 30px 60px;
        width: 100%;
        background: #2285c5;
    }

    .month ul {
        margin: 0;
        padding: 0;
    }

    .month ul li {
        color: white;
        font-size: 20px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .month .prev {
        float: left;
        padding-top: 10px;
        margin-left: -50px;

    }

    .month .next {
        float: right;
        padding-top: 10px;
        margin-right: -50px;
    }

    .weekdays {
        margin: 0;
        padding: 10px 0;
        background-color: #ddd;
    }

    .weekdays li {
        display: inline-block;
        width: 13.6%;
        color: #666;
        text-align: center;
    }

    .days {
        padding: 10px 0;
        background: #eee;
        margin: 0;
    }

    .days li  {
        list-style-type: none;
        display: inline-block;
        width: 13.6%;
        text-align: center;
        margin-bottom: 5px;
        font-size:16px;
        color: #777;
        height: 50px;
    }

    .days li .active > a{
        padding: 10px;
        background: #2285c5;
        color: white !important;
    }


    /* Add media queries for smaller screens */
    @media screen and (max-width:720px) {
        .weekdays li, .days li {width: 13.1%;}
    }

    @media screen and (max-width: 420px) {
        .weekdays li, .days li {width: 12.5%;}
        .days li .active {padding: 2px;}
    }

    @media screen and (max-width: 290px) {
        .weekdays li, .days li {width: 12.2%;}
    }

    .back_forward_btn{
        /*background-color: #00aa00;*/
        color:white;
        width: 50px;
        height: 50px;
        text-align: center;
        vertical-align: middle;
        padding: 10px;

    }
</style>



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

$month_string=Handyfunctions::get_month_string($date_int);
$year_digit=Handyfunctions::get_year_string($date_int);



////////Drawing calendar parameters
$first_date_of_month=Handyfunctions::get_first_date_of_month_string($date_int);
$first_date_of_month_int=strtotime($first_date_of_month);

/////1 (for Monday) through 7 (for Sunday)
$weekday_no=Handyfunctions::get_weekday_no_on_date($first_date_of_month_int);
$no_of_days_in_month=Handyfunctions::get_no_of_days_in_month($first_date_of_month_int);


$first_date_of_previous_month=Handyfunctions::get_first_date_of_previous_month_string($date_string);
$first_date_of_next_month=Handyfunctions::get_first_date_of_next_month_string($date_string);



$previous_month_url= Url::to(['site/calendar', 'date' => $first_date_of_previous_month]);
$next_month_url= Url::to(['site/calendar', 'date' => $first_date_of_next_month]);



?>


<div class="month">
    <ul>
        <li class="prev">
            <a class="back_forward_btn" href="<?php echo $previous_month_url;?>" >
                ❮
            </a>
        </li>
        <li class="next">
            <a class="back_forward_btn" href="<?php echo $next_month_url;?>">
                ❯
            </a>
        </li>



        <li style="text-align:center">
            <?php echo $month_string; ?>
        </li>
    </ul>
    <ul>
        <li style="text-align:center">
             <span style="font-size:18px">
                <?php echo $year_digit; ?>
            </span>
        </li>
    </ul>
</div>

<ul class="weekdays">
    <li>Mo</li>
    <li>Tu</li>
    <li>We</li>
    <li>Th</li>
    <li>Fr</li>
    <li>Sa</li>
    <li>Su</li>
</ul>

<ul class="days">
    <?php for($i=1;$i<$weekday_no;$i++):?>
        <li></li>
    <?php endfor;?>

    <?php for($i=1;$i<$no_of_days_in_month;$i++):?>

        <?php $for_loop_date_string = $i.'-'.$month_string.'-'.$year_digit; ?>

        <li>

            <?php
            $today_css_class='';

            $isToday=Handyfunctions::istodaysdate($for_loop_date_string);

            if ($isToday){
                $today_css_class='class="active"';
            }
            ?>


            <span <?php echo $today_css_class;?> >
                <?php $servicecall_url= Url::to(['enggdiary/showappointmentsfordate', 'date' => $for_loop_date_string    ]);?>
                <a href="<?php echo $servicecall_url;?>">
                    <?php echo $i;?>
                </a>
            </span>


        </li>
    <?php endfor;?>




    <!--
    <li>
        <a href="http://google.com">1</a>
    </li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
    <li>6</li>
    <li>7</li>
    <li>8</li>
    <li>9</li>
    <li><span class="active"> <a href="calendar.php" class="day_link">10 </a></span></li>
    <li>11</li>
    <li>12</li>
    <li>13</li>
    <li>14</li>
    <li>15</li>
    <li>16</li>
    <li>17</li>
    <li>18</li>
    <li>19</li>
    <li>20</li>
    <li>21</li>
    <li>22</li>
    <li>23</li>
    <li>24</li>
    <li>25</li>
    <li>26</li>
    <li>27</li>
    <li>28</li>
    <li>29</li>
    <li>30</li>
    <li>31</li>

    -->
</ul>



