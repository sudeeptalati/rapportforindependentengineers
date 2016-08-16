<hr>
<?php
/*
$today="15-May-2016";
$time=strtotime($today);
*/
$time=time();
$todaysweekday=date('N',$time);
echo "<hr>Today is".date('l',$time).'------'.$todaysweekday;

?>


<table>
    <tr>
        <?php


        $weekdaystartday=$time - (86400 * $todaysweekday)+86400;

        $forloopdate_time=$weekdaystartday;

        for ($i=1;$i<=$todaysweekday;$i++)
        {

            $forloopdate_string = date("d-M-Y l", $forloopdate_time);

            echo '<td  style="vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px;" class="quote"><b>'.$forloopdate_string . '</b></div>';

            if ($i==$todaysweekday)
            {
                echo '<div style="height:260px;" class="alert" "><b>TODAY</b></div>';

            }else
            {
                echo '<div style="height:260px;" class="notice"><b>PAST DAYS</b></div>';
            }
            echo '</td>';


            $forloopdate_time=$forloopdate_time+86400;
        }


        $no_next_days=14;

        for ($i = 1; $i <= $no_next_days; $i++) {

            $forloopdate_time = $time + (86400 * $i);
            $forloopdate_string = date("d-M-Y l", $forloopdate_time);
            $forloop_day = date("d", $forloopdate_time);
            $forloop_month = date("m", $forloopdate_time);
            $forloop_year = date("Y", $forloopdate_time);
            $forloop_weekday = date("N", $forloopdate_time);


            if ($forloop_weekday==1)
            {
                echo "</tr><tr>";

            }



            echo '<td  style="vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px;" class="quote"><b>'.$forloopdate_string . '</b></div>';
            echo '<div style="height:260px;" class="approved" "><b></b></div>';
            echo '</td>';
        }

        ?>
    </tr>
</table>
<hr>