<style>
    .beauty {
        background: #e8f2ff;
        position: absolute;
        z-index: 0;
        margin-left: 840px;
        text-align: center;
        border-radius: 10px;
    }

    .beauty:hover {
        cursor: pointer;
    }
</style>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    $(function () {
        $(".beauty").draggable();

        document.getElementById('beauty').style.position = 'fixed';
        document.getElementById('engineerbox').style.position = 'fixed';

    });
</script>


<?php
$this->layout = 'main';

$servicecall_id = $_GET['servicecall_id'];
$servicecallmodel = Servicecall::model()->findbyPK(array('id' => $servicecall_id));


$model = Enggdiary::model();
$setupmodel=Setup::model();

$daystoconsiderformanualbooking =$model->getdaystoconsiderformanualbooking();

$workingdaysofweekstring = $model->getworkingdaysinweek();
$workingdaysofweekarray = str_split($workingdaysofweekstring);

$totalnoofcallsperday = $model->getTotalnoofcallsperday();

$allactiveenggs = Engineer::model()->getallactiveengineersarray();


//echo $data->servicecall->customer->postcode;
?>

<div class="boxframe customerbox" style='width:40%; float:left;'>
    <div class="headingbox customerheadingbox">Customer</div>
        <div class="contentbox">
        <div class="title">
            <?php echo $servicecallmodel->customer->fullname; ?>

            <div class="address">
                <?php
                $line1 = $servicecallmodel->customer->address_line_1;
                $line2 = $servicecallmodel->customer->address_line_2;
                $line3 = $servicecallmodel->customer->address_line_3;
                $town = $servicecallmodel->customer->town;
                $postcode = $servicecallmodel->customer->postcode;

                ?>
                <?php echo $setupmodel->formataddressinhtml($line1, $line2, $line3, $town, $postcode); ?>
            </div>
        </div>
    </div><!-- end of content box-->

    <div class="containerbox productbox">
        <div class="headingbox productheadingbox">Product</div>
        <div class="contentbox">
            <div class="title">
                <?php echo $servicecallmodel->product->brand->name; ?>
                <?php echo $servicecallmodel->product->productType->name; ?>
            </div>
        </div>
    </div><!-- end of     <div class="containerbox productbox"> -->

    <div class="containerbox servicebox">
        <div class="headingbox serviceheadingbox">Service</div>
        <div class="contentbox">
            <div class="title">
                <?php echo $servicecallmodel->fault_description; ?>
            </div>
        </div>
    </div><!-- end of     <div class="containerbox productbox"> -->






    <div id="engineerbox" class="beauty containerbox engineerbox" style="cursor: move;" title="You can drag and move this window">
        <div class="headingbox enginnerheadingbox">Appointment
            <i class="fa fa-arrows" aria-hidden="true"></i></div>
        <div class="contentbox engineerbox">



        Additional Notes<br>

        <?php echo CHtml::dropDownList('timeofcall', '',
            array('Normal Call' => 'Normal Call',
                'Morning Call' => 'Morning Call',
                'Evening Call' => 'Evening Call',
                'First Call' => 'First Call',
                'Last Call' => 'Last Call',
                'Special Call' => 'Special Call',

            )
        );


        ?>
        <br>
        <?php echo CHtml::textArea('appointment_notes', '', array('placeholder' => 'Additional Notes for call',
                'style' => 'width:250px;height:100px;'

            )
        ); ?>
        </div>
    </div><!-- end of class="containerbox engineerbox" -->

    </div><!-- end of Boxframe -->










<div id="beauty" class="beauty">
    <div class="info headingbox" style=" border-radius: 10px;cursor: move;"
         title="You can move this window anywhere on screen. Simply click the mouse and move it across the screen. Thus, you can show/hide the engineers.">
      Engineers  <i class="fa fa-arrows" aria-hidden="true"></i>
    </div>

    <div style='cursor:pointer;width: 300px;top: 250px;right: 50px;'>
        <table>
            <?php foreach ($allactiveenggs as $e): ?>

                <tr onclick="showhideenggg(<?php echo $e->id ?>)" style="background: <?php echo $e->color; ?>;">
                    <td style="width: 30px;padding:12px 0px 12px 12px;">
                        <span id='btn<?php echo $e->id ?>' class="fa fa-toggle-on fa-2x"></span>
                    </td>
                    <td style="padding:15px;">
                        <?php echo $e->fullname ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>




<table>

    </tr>
    <tr>
        <td colspan='7'>
            <div class='success' style='text-align: center;font-size: 24px;font-weight: 400;letter-spacing: 4px; '>
                <?php echo date('F Y'); ?>
            </div>
        </td>
    <tr>
        <?php


        $today = date('d-m-Y');
        $time = time();


        //$today = '20-04-2016';
        //$time = strtotime($today);


        $todaysweekday = date('N', $time);

        $weekdaystartday = $time - (86400 * $todaysweekday) + 86400;

        $forloopdate_time = $weekdaystartday;

        for ($i = 1; $i <= $todaysweekday; $i++) {

            $forloopdate_string = date("d-M-Y l", $forloopdate_time);

            echo '<td  style="height:1px;vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px;" class="quote"><b>' . $forloopdate_string . '</b></div>';

            if ($i == $todaysweekday) {
                echo '<div style="height:85%;" class="alert" "><b>TODAY</b></div>';

            } else {
                echo '<div style="height:85%;" class="notice"><b>PAST DAYS</b></div>';
            }
            echo '</td>';


            $forloopdate_time = $forloopdate_time + 86400;
        }


        for ($i = 1; $i <= $daystoconsiderformanualbooking; $i++) {

            $forloopdate_time = $time + (86400 * $i);
            $forloopdate_string = date("d-M-Y l", $forloopdate_time);
            $forloop_day = date("d", $forloopdate_time);
            $forloop_month = date("m", $forloopdate_time);
            $forloop_year = date("Y", $forloopdate_time);
            $forloop_weekday = date("N", $forloopdate_time);


            $td_id = date("j-n-Y", $forloopdate_time);
            //array_push($selectday_row_dates, date("j-n-Y", $forloopdate_time));


            if ($forloop_weekday == 1) {
                echo "</tr><tr>";

            }

            if ($forloop_day == 1) {

                echo "</tr><tr><td colspan='7'><div class='success' style='text-align: center;font-size: 24px;font-weight: 400;letter-spacing: 4px;'>" . date('F Y', $forloopdate_time) . "</div></td>";

                if ($forloop_weekday != 1) {
                    $colspan = $forloop_weekday - 1;

                    echo "</tr><tr><td colspan='$colspan'></td>";
                } else {
                    echo "</tr><tr>";
                }


            }


            echo '<td id="' . $td_id . '" style="height:1px; vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px;" class="quote"><b>' . $forloopdate_string . '</b></div>';
            //echo '<div style="height:10px; background:#9AFD95"></div>';
            if (in_array($forloop_weekday, $workingdaysofweekarray)) {


                $customer_postcodes = array();

                //echo '<br>	<b>NOT HOLIDAY</b>';
                echo "<div>";
                $forloop_start_date_time = mktime(0, 0, 0, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year
                $forloop_end_date_time = mktime(23, 59, 59, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year


                ///Now we will run the loop for each Engineer
                $dayheight = $totalnoofcallsperday * 50;
                $dayheight = $dayheight . 'px';

                $freeenggs_array = array();
                foreach ($allactiveenggs as $ae) {

                    $engineer_id = $ae->id;
                    $engineer_name = $ae->fullname;
                    echo '<div class=' . $engineer_id . ' style="border-radius:10px; padding:10px; margin-top:10px;background:' . $ae->color . '">';

                    $data = Enggdiary::model()->getData($engineer_id, $forloop_start_date_time, $forloop_end_date_time);

                    echo '<div onclick="showhideenggg(' . $engineer_id . ')"  >';


                    echo '<div  style="cursor:pointer; color: #727272;" ><span class="fa fa-minus-square-o" style="margin: 5px;" ></span>&nbsp;&nbsp;<b>' . $ae->first_name . '</b><i ></i></div>';
                    echo '</div>';///end of foreach div of engg

                    echo '<div style="margin:10px;">';
                    //echo '<div class='.$engineer_id.'  >';
                    foreach ($data as $d) {
                        $diary_customer_postcode = $d->servicecall->customer->postcode;
                        $diary_customer_postcode = strtoupper($diary_customer_postcode);
                        $diary_customer_postcode = trim($diary_customer_postcode);
                        $visit_start_time_str = date('H:i', $d->visit_start_date);
                        echo '<small>' . $visit_start_time_str . '</small>&nbsp;&nbsp;' . $d->servicecall->customer->postcode . '<br>';

                    }///end of foreach ($data as $d)

                    $input_date = date('j-n-Y', $forloopdate_time);


                    ?>

                    <button class="themebtn-info" title="Book"
                            onclick="booktheappointmnet(<?php echo $engineer_id; ?>,  '<?php echo $engineer_name; ?>',  '<?php echo $input_date; ?>')">
                        <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;&nbsp;Book

                    </button>


                    <?php

                    echo '</div>';/// '<div class=$engineer_id>';

                    echo '</div>';/// end of foreach div';

                }///end of foreach ( $allactiveenggs as $active_engg)


                echo '</div>';///end of  echo "<div class='approved''>";


            }///end of if in_array
            else {

                echo '<div style="height:85%;" class="notice"><b>HOLIDAY</b></div>';
                $daystoconsiderformanualbooking = $daystoconsiderformanualbooking + 1;
            }///end of else of in_array


            echo '</td>';


        }//end of days forloop_end_date_time
        ?>
    </tr>


    <tr>
        <?php //echo json_encode($fullfreedays); ?>
    </tr>


</table>

<script>
    function showhideenggg(engg_id) {
        console.log('showhideenggg' + engg_id);
        var classnmforjquery = "." + engg_id;
        $(classnmforjquery).toggle();


        btnidname = 'btn' + engg_id;


        if (document.getElementById(btnidname).className == 'fa fa-toggle-on fa-2x') {
            document.getElementById(btnidname).className = 'fa fa-toggle-off fa-2x';
        } else {
            document.getElementById(btnidname).className = 'fa fa-toggle-on fa-2x';
        }

    }///end of function  showhideenggg(enggclassname) {


    function booktheappointmnet(new_engineer_id, new_engineer_name, dateofappointment) {
        console.log('Engg id' + new_engineer_id);
        console.log('Engg id' + new_engineer_name);
        console.log('Date id' + dateofappointment);


        service_id =<?php echo $servicecall_id; ?>;
        timeofcall = document.getElementById('timeofcall').value;
        appointment_notes = document.getElementById('appointment_notes').value;
        notes = '<b>' + timeofcall + '</b>:' + appointment_notes;
        console.log('notes' + notes);


        var urlToCreate = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=api/createNewDiaryEntry&start_date=' + dateofappointment + '&engg_id=' + new_engineer_id + '&service_id=' + service_id + '&notes=' + notes;
        console.log(urlToCreate);

        msg = "Are you sure you want to book appointment on " + dateofappointment + " for " + new_engineer_name;
        if (confirm(msg) === true) {
            console.log("You pressed OK!");


            $.ajax
            ({
                type: 'POST',
                url: urlToCreate,
                cache: false,
                modal: true,
                success: function (data) {
                    alert('Appointment Created' + data);
                    location.href = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=servicecall/view&id=' + service_id;
                },
                error: function () {
                    alert("ERROR");
                },
            });//end of AJAX.


        } else {
            console.log("You pressed Cancel!");
        }


    }///end of function booktheappointmnet(engg_id, dt)


    ////////////////////////////////////////Drag event ///////////////////////////////////////////


</script>


