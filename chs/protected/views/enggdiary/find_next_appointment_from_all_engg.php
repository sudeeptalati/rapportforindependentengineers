<?php	
$this->layout = 'main';

$servicecall_id = $_GET['servicecall_id'];
//$engineer_id = $_GET['engineer_id'];
$servicecallmodel = Servicecall::model()->findbyPK(array('id' => $servicecall_id));
$current_customer_postcode = $servicecallmodel->customer->postcode;
$engineer_name = $servicecallmodel->engineer->fullname;
$servicecallmodel = Servicecall::model()->findbyPK(array('id' => $servicecall_id));
$model = Enggdiary::model();
//$no_next_days = 10;
$no_next_days = $model->getconsiderdaysforslotavailabity();
$allowedtraveldistancebetweenpostcodes = $model->gettraveldistanceallowedbetweenpostcodes();
$totalnoofcallsperday = $model->getTotalnoofcallsperday();

$workingdaysofweekstring = $model->getworkingdaysinweek();
$workingdaysofweekarray = str_split($workingdaysofweekstring);
//print_r($workingdaysofweekarray);

$allactiveenggs=Engineer::model()->getallactiveengineerfordiaryandrouteplanning();


$today = date('d-m-Y');

//echo $data->servicecall->customer->postcode;
?>
<br>
<div>
	<div style='width:25%; float:left;'>
		<table>
			<tr>
				<td>
					<b>Customer PostCode:</b> 
				</td>
				<td>
				<?php echo $current_customer_postcode; ?>
				</td>
			</tr>
            <tr>
                <td>
                    <b>Engineer:</b>
                </td>
                <td>
                    <?php echo $engineer_name; ?>
                </td>
            </tr>
            <tr><td colspan="2"><hr></td> </tr>
            <tr>
                <td>
                    <b>Additional Notes in Diary:</b>
                </td>
                <td>

                    <?php echo CHtml::dropDownList('timeofcall', '',
                        array(	'Normal Call' => 'Normal Call',
                            'Morning Call' => 'Morning Call',
                            'Evening Call' => 'Evening Call',
                            'First Call' => 'First Call',
                            'Last Call' => 'Last Call',
                            'Special Call' => 'Special Call',

                        )
                    );



                    ?>
                    <br>
                    <?php echo CHtml::textArea('appointment_notes','',array('placeholder'=>'Additional Notes for call',
                            'style'=>'width:250px;height:100px;'

                        )
                    ); ?>
                </td>
            </tr>
		</table>
		
	</div>

	<div style='width:50%;float:right'>
		<b>Based on parameters</b>
		<br>
		<table>
			<tr>
				<td><b>Days Considered for Planning</b></td>
				<td><?php echo $no_next_days; ?> days</td>
			</tr>
			<tr>
				<td><b>Maximum Travel Distance Between Two postcodes</b></td>
				<td><?php echo $allowedtraveldistancebetweenpostcodes; ?> miles</td>
			</tr>
			<tr>
				<td><b>Maximum Number of Servicecalls per day Per Engineer</b></td>
				<td><?php echo $totalnoofcallsperday; ?> servicecalls</td>
			</tr>
            <tr>
                <td colspan="2">
                    <div class="success" id="route_planning_suggestion">

                        <div id="manual_booking"  style="border-bottom: solid #fff;margin-bottom:24px;">

                            <table>
                                    <tr>
                                        <td>
                                            <?php
                                            $baseUrl = Yii::app()->request->baseUrl;
                                            //$url = $baseUrl . "/index.php?r=enggdiary/bookingAppointment&id=" . $servicecall_id . "&engineer_id=" . $engineer_id;
                                            $url = $baseUrl . "/index.php?r=enggdiary/manuallyappointmentbooking&servicecall_id=" . $servicecall_id;
                                            ?>

                                            <div>
                                                <a href="<?php echo $url ?>">Book manually</a>
                                                <br>
                                                <a href="<?php echo $url ?>">
                                                    <i class="fa fa-calendar fa-3x"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                             <div class="infotooltip"><h4>Empty Days &nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i></h4>

                                                 <span class="infotooltiptext">

                                                    The following days in diary with associated engineers  has not been filled with any appointments.


                                                </span>
                                                 <div class="loading">
                                                     <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                                                 </div>
                                            </div>

                                            <div id="fullfreedaysofengg"></div>

                                        </td>
                                    </tr>
                            </table>


                        </div><!-- end of Manual Booking Div-->



                        <div class="infotooltip"><h4>Suggested Dates &nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i></h4>
                            <span class="infotooltiptext">
                            The suggested dates are calculated based on above parameters like Days Considered for Planning, Maximum Travel Distance Between Two postcodes & Maximum Number of Servicecalls per day Per Engineer.
                             However, you can also manually overwrite the diary from the above link of Book Manually or Empty Days.

                            </span>
                            <div class="loading">
                                <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
                            </div>
                        </div>



                        <div id="firstprefdiv"></div>
                        <div id="secondprefdiv"></div>
                        <div id="thirdprefdiv"></div>
                    </div><!--End of Success Div-->
                </td>
            </tr>
    	</table>
			
	</div>
</div>
<br>



<style>


    #map-canvas {
        height: 25%;
        width: 25%;
    }
    #content-pane {
        float:right;
        width:100%;
        padding-left: 2%;
    }
    #outputDiv {
        font-size: 16px;
    }
</style>
<div id="content-pane">



        <div class="note"  id='systemmessage'>
            <div id='loading' class="loading" style='display:none;text-align: center;'>
                <!--
                <img src="images/loading.gif" >
                -->
                <br>Please wait, the system is calculating the nearest suitable day
                <br>
                <div class="fa fa-spinner fa-spin fa-3x fa-fw" ></div>
            </div>

        </div>
    <div id="inputs">
        <p><button type="button" onclick="callme();">Show me Available Days</button></p>
    </div>
    <div class="notice" id="outputDiv"></div>
</div>
<div id="map-canvas"></div>




<hr>
<table>
    <tr>
        <?php

        $fullfreedays=array();

        $days_postcodes_array = array();
        $considered_dates = array();
        $selectday_row_dates = array();


        ////N	ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0)
        //1 (for Monday) through 7 (for Sunday)
        $time=time();
        $todaysweekday=date('N',$time);

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


        for ($i = 1; $i <= $no_next_days; $i++) {

            $forloopdate_time = $time + (86400 * $i);
            $forloopdate_string = date("d-M-Y l", $forloopdate_time);
            $forloop_day = date("d", $forloopdate_time);
            $forloop_month = date("m", $forloopdate_time);
            $forloop_year = date("Y", $forloopdate_time);
            $forloop_weekday = date("N", $forloopdate_time);




            $td_id=date("j-n-Y", $forloopdate_time);
            //array_push($selectday_row_dates, date("j-n-Y", $forloopdate_time));


            if ($forloop_weekday==1)
            {
                echo "</tr><tr>";

            }


            echo '<td id="'.$td_id.'" style="vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px;" class="quote"><b>'.$forloopdate_string . '</b></div>';
            //echo '<div style="height:10px; background:#9AFD95"></div>';
            if (in_array($forloop_weekday, $workingdaysofweekarray)) {


                $customer_postcodes = array();

                //echo '<br>	<b>NOT HOLIDAY</b>';
                echo "<div>";
                $forloop_start_date_time = mktime(0, 0, 0, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year
                $forloop_end_date_time = mktime(23, 59, 59, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year



                ///Now we will run the loop for each Engineer
                $dayheight=$totalnoofcallsperday*50;
                $dayheight=$dayheight.'px';

                $freeenggs_array=array();
                foreach ( $allactiveenggs as $ae)
                {

                    echo '<br><div style="border-radius:10px; padding:0 0 2px 10px; height:'.$dayheight.'; background:'.$ae->color.'; "><br>';

                    $engineer_id=$ae->id;
                    $data = Enggdiary::model()->getData($engineer_id, $forloop_start_date_time, $forloop_end_date_time);


                    if(count($data)==0)
                    {

                        $freeengg['engineer_id']=$ae->id;
                        $freeengg['engineer_name']=$ae->fullname;
                        array_push($freeenggs_array,$freeengg);

                    }///end of if(count($data) ==0)
                    elseif (count($data) >= $totalnoofcallsperday)   {


                        echo '<div style="transform: rotate(45deg);margin-bottom: -90px;margin-top: 25px;"><b>'.$ae->fullname.'</b> is fully booked</div>';
                        echo "<div style='opacity: 0.5;'>";
                        foreach ($data as $d) {
                            echo '<br>' . $d->servicecall->customer->postcode . '';
                            }
                        echo "</div>";


                    }
                    else{
                        echo '<div><b>'.$ae->fullname.'</b></div>';
                        foreach ($data as $d) {
                            $diary_customer_postcode = $d->servicecall->customer->postcode;
                            $diary_customer_postcode = strtoupper($diary_customer_postcode);
                            $diary_customer_postcode = trim($diary_customer_postcode);
                            echo ''. $d->servicecall->customer->postcode .'<br>';
                            array_push($customer_postcodes, $diary_customer_postcode);
                        }

                        //echo '<hr>'.date("j-n-Y", $forloopdate_time);
                        //$days_postcodes_array[$forloopdate_string]=$customer_postcodes;

                    }//end of else if (count($data)>=$totalnoofcallsperday)



                    echo '</div>';///end of foreach div of engg
                }///end of foreach ( $allactiveenggs as $active_engg)




                echo '</div>';///end of  echo "<div class='approved''>";
                //$no_next_days = $no_next_days + 1;

                array_push($days_postcodes_array, $customer_postcodes);
                array_push($considered_dates, date("j-n-Y", $forloopdate_time));


            }///end of if in_array
            else {

                echo '<div style="height:260px;" class="notice"><b>HOLIDAY</b></div>';
                $no_next_days = $no_next_days + 1;
            }///end of else of in_array

            //echo 'TOTAL FREE ENGGS.'.count($freeenggs_array);
            echo '</td>';

            if (count($freeenggs_array)>0 && in_array($forloop_weekday, $workingdaysofweekarray)) {

                if (count($freeenggs_array) != count($allactiveenggs)) {///to Avoid duplicate dates as these will be anyways considered by route plannng algorithm
                    $freeday = array();
                    $freeday['date_int'] = $forloop_start_date_time;
                    $freeday['date_str'] = '<b>' . date('l, d-F-Y', $forloop_start_date_time) . '</b>';
                    $freeday['input_date_str'] =date('d-n-Y', $forloop_start_date_time);///in the format 30-6-2016
                    $freeday['engineers'] = $freeenggs_array;
                    array_push($fullfreedays, $freeday);

                }
            }
        }//end of days forloop_end_date_time
        ?>
    </tr>


    <tr>
        <?php //echo json_encode($fullfreedays); ?>
    </tr>


</table>

<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
-->



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCxU9WGQ-qZ0AY7cE_TP5timk7sb2cQZ4">
</script>

<script>




    var map;
    var geocoder;
    var bounds = new google.maps.LatLngBounds();
    var markersArray = [];
    var x = 0;
    var considerdays =<?php echo $no_next_days; ?>;

    var considered_dates =<?php echo json_encode($considered_dates); ?>;
    var considered_postcodes =<?php echo json_encode($days_postcodes_array); ?>;
    var current_customer_postcode = '<?php echo $current_customer_postcode; ?>';
    var allowedtraveldistancebetweenpostcodes =<?php echo $allowedtraveldistancebetweenpostcodes; ?>;

    var fullfreedaysdata =<?php echo json_encode($fullfreedays); ?>;


    console.log("Considered Dates"+considered_dates);
    console.log("considered_postcodes"+considered_postcodes);

    var recievd_postcodes = [];
    var recievd_distances = [];
    var recievd_time = [];
    var autotimer;
    var engg_id ='';
    var service_id =<?php echo $servicecall_id; ?>;
    var firstnearestdate = '';


    var availabledatesinddmmyyyy = [];


    var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';


    $(document).ready(function () {
        callme();
    });



    function initialize() {
        var opts = {
            center: new google.maps.LatLng(55.6414923, -4.5296094),
            zoom: 10
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), opts);
        geocoder = new google.maps.Geocoder();
    }

    function calculateDistances() {


        if ((x < considered_postcodes.length))////so that it runs for all the postcodes
        {
            current_date = considered_dates[x];
            current_postcodes = considered_postcodes[x];
            d_array = [];
            d_array = current_postcodes;
            if (d_array.length != 0)
            {
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                        {
                            /*
                             origins: ['KA32SN', 'KA12NP'],
                             destinations: ['PA12BE'],
                             */
                            origins: [current_customer_postcode],
                            destinations: d_array,
                            travelMode: google.maps.TravelMode.DRIVING,
                            unitSystem: google.maps.UnitSystem.IMPERIAL,
                            avoidHighways: false,
                            avoidTolls: false
                        }, callback);

            }
            else
            {
                console.log('There are no calls Booked on Day  ' + current_date);
                availabledatesinddmmyyyy.push(current_date);

            }
            x++;

        }
        else
        {
            //x=0;
            filterdatabydistancebetweentwopostcodes();
            //alert('The system can only consider for '+considerdays+' days and plan. Please choose a date manually or leave call in logged state to book later.');
            showavailabledatesinddmmyyyy();
            clearInterval(autotimer);
        }
    }///end of function calculateDistance


    function showavailabledatesinddmmyyyy()
    {
        //console.log('------recievd_distances-----------'+recievd_distances);
        //console.log('------recievd_postcodes-----------'+recievd_postcodes);
        console.log('availablle days are availabledatesinddmmyyyy  ' + availabledatesinddmmyyyy);

		console.log('availablle days are availabledatesinddmmyyyy  ' + availabledatesinddmmyyyy.length);
		if(availabledatesinddmmyyyy.length==0)////means if system could not find any available dates we ask user to manually create diary entry
		{

				//document.getElementById('systemmessage')='<b>System cannot find any suitable dates, Please book the call manually</b>'
				document.getElementById('outputDiv').innerHTML += '<br><b>System cannot find any suitable dates, Please book the call manually from the above link.</b>';
				//document.getElementById('loading').style.display = 'none';
                ///stoploadingsign();
				//document.getElementById('systemmessage').style.display = 'block';

		}




		if (recievd_postcodes.length != 0)
        {
            //we will call this 3 times to get the 3 options
			for (var p=0;p<recievd_postcodes.length;p++)
			{
				if(p>2)
				break;////otherwise it will show more than 3 available days
				findthenextdaywithnearestpostcode();

            }
        }
        else
        {
            console.log('Recieve postcodes lenth 0. No Near Postcodes found');
        }


        availabledatesinddmmyyyy = sortavailabledatesinorder(availabledatesinddmmyyyy);
        console.log('=============AFTER SORTING ========================');
        console.log(availabledatesinddmmyyyy);
        findengineerinthatpostcode();
        /*
		createpreferecncebutton('0', availabledatesinddmmyyyy[0]);
        createpreferecncebutton('1', availabledatesinddmmyyyy[1]);
        createpreferecncebutton('2', availabledatesinddmmyyyy[2]);
		*/

		for (var p=0;p<availabledatesinddmmyyyy.length;p++)
		{

			if(p>2)
				break;////otherwise it will show more than 3 available days
			createpreferecncebutton(p, availabledatesinddmmyyyy[p]);
		}



        setonclickforpreferreddatesbtn();
    }//end of my fnc

    function sortavailabledatesinorder(da)
    {
        console.log('SORTING DATES : ' + da);
        var dateobjarray = [];
        var sorteddatestringarray = [];

        for (var n = 0; n < da.length; n++)
        {
            //console.log(da[n]);
            res = da[n].split("-");
            c_day = res[0];
            c_month = res[1] - 1;///since javascript month start from 0
            c_year = res[2];
            date_obj = new Date(c_year, c_month, c_day, 0, 0, 0, 0);
            dateobjarray.push(date_obj);
        }

        dateobjarray = dateobjarray.sort(sortByDateAsc);
        //console.log(dateobjarray);

        for (var n = 0; n < dateobjarray.length; n++)
        {
            //console.log(dateobjarray[n]);
            var d = dateobjarray[n];
            d_date = d.getDate();
            d_month = d.getMonth() + 1;
            d_year = d.getFullYear();
            d_string = d_date + "-" + d_month + "-" + d_year;
            sorteddatestringarray.push(d_string);
        }//end of for

        console.log(sorteddatestringarray);
        return sorteddatestringarray;

    }///end of sortavailabledatesinorder



    function sortByDateAsc(a, b) {
        return a < b ? -1 : a > b ? 1 : 0;
    }//end of function  sortByDateAsc()



    function filterdatabydistancebetweentwopostcodes()
    {
        /*
         recievd_distances
         recievd_postcodes
         allowedtraveldistancebetweenpostcodes
         */

        console.log('----------------------FILTERING DISTANCE NOW---------------------------------');
        console.log('Recieved Distances from customer postcodes  ' + recievd_distances);


        temp_googlerecievedpc_array = recievd_postcodes;
        temp_googlerecieveddistance_array = recievd_distances;
        recievd_postcodes = [];
        recievd_distances = [];
        for (var m = 0; m < temp_googlerecieveddistance_array.length; m++)
        {
            console.log('Recieved Distances ' + temp_googlerecieveddistance_array[m] + 'from customer postcodes  ' + temp_googlerecieveddistance_array[m]);

            if (temp_googlerecieveddistance_array[m] > allowedtraveldistancebetweenpostcodes)
            {
                ///find the postcode in recievd_postcodes array and delete it
                pc_to_be_deleted = temp_googlerecievedpc_array[m];
                var pc_to_be_deleted_index = recievd_postcodes.indexOf(pc_to_be_deleted);

                /*
                 recievd_postcodes.splice(pc_to_be_deleted_index, 1);
                 recievd_distances.splice(pc_to_be_deleted_index, 1);
                 */
                /*
                 for (var m=0;m<recievd_distances.length;m++)
                 {
                 console.log('Recieved Distances '+recievd_distances[m]+'from customer postcodes  '+recievd_postcodes[m]);


                 if (recievd_distances[m]>allowedtraveldistancebetweenpostcodes)
                 {

                 recievd_postcodes.splice(m, 1);
                 recievd_distances.splice(m, 1);
                 */
            }
            else
            {
                recievd_postcodes.push(temp_googlerecievedpc_array[m]);
                recievd_distances.push(temp_googlerecieveddistance_array[m]);
                document.getElementById('outputDiv').innerHTML += '<br>The nearest postcode to ' + current_customer_postcode + ' is ' + temp_googlerecievedpc_array[m] + ' is ' + temp_googlerecieveddistance_array[m] + ' miles';
            }



        }//end of for`

        console.log('filtered Recieved Distances' + recievd_distances);
        console.log('filtered Recieved POSTCODES' + recievd_postcodes);

    }//filterdatabydistancebetweentwopostcodes()

    function findthenextdaywithnearestpostcode()
    {
        console.log('********************findthenextdaywithnearestpostcode***********************************');
        console.log('FILTERED RECIEVED DISTANCES' + recievd_distances);
        console.log('FILTERED RECIEVED recievd_postcodes' + recievd_postcodes);
        if (recievd_postcodes.length > 0)
        {
            p = indexOfSmallest(recievd_distances);
            day_count = finddayofnearestpostcode(recievd_postcodes[p]);

			//nearestdate=adddaystodate(day_count+1); ///since day starts with 0
            //getting index of neartestday
            nearestdate = considered_dates[day_count]; ///since day starts with 0
            console.log('I AM IN RECEIEVD POSTCODELENGTH >0 Day Count'+day_count, engg_id, service_id, nearestdate);
            if (arraycontains(availabledatesinddmmyyyy, nearestdate) == true)
            {
                recievd_postcodes.splice(p, 1);
                recievd_distances.splice(p, 1);
                findthenextdaywithnearestpostcode();
            } else
            {
                console.log('NEXT NEAREST DATE IS' + nearestdate);
                availabledatesinddmmyyyy.push(nearestdate);

            }
        }
    }///end of findthenextdaywithnearestpostcode


    function setonclickforpreferreddatesbtn()
    {
        /*
        document.getElementById('outputDiv').innerHTML += '<br> The first  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[0] + '</b>	';
        document.getElementById('outputDiv').innerHTML += '<br> The Second Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[1] + '</b>	';
        document.getElementById('outputDiv').innerHTML += '<br> The Third  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[2] + '</b>	';
        document.getElementById('0preferecncebutton').onclick = selectthefirstavailableday;
        document.getElementById('1preferecncebutton').onclick = selectthesecondavailableday;
        document.getElementById('2preferecncebutton').onclick = selectthethirdavailableday;
		*/

		for (var p=0;p<availabledatesinddmmyyyy.length;p++)
		{
			if(p>2)
				break;////otherwise it will show more than 3 available days
			//document.getElementById('outputDiv').innerHTML += '<br> The NEXT Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[0] + '</b>	';
			var elementid=p+'preferecncebutton';
            //document.getElementById(elementid).onclick = selectthefirstavailableday;

            switch (p)
			{
                case 0:
        			 document.getElementById('firstprefdiv').innerHTML += '<b>' + formatgoogledateddmmyyyy(availabledatesinddmmyyyy[0]) + '</b> is 1st Available Day<br> ';

                    firstdropdownengg=createselectenggdropdown("0dropdownengg");
                    document.getElementById('firstprefdiv').appendChild(firstdropdownengg);

                    firststdaybtn=createabtn();
                    firststdaybtn.name="firststdaybtn";
                    firststdaybtn.id="firststdaybtn";
                    //document.getElementById('route_planning_suggestion').appendChild(firststdaybtn);
                    document.getElementById('firstprefdiv').appendChild(firststdaybtn);
                    $("#firststdaybtn").attr("onclick", "selectthefirstavailableday()");

                    break;

                case 1:
					 document.getElementById('secondprefdiv').innerHTML += '<br> <b>' + formatgoogledateddmmyyyy(availabledatesinddmmyyyy[1]) + '</b> is 2nd Available Day<br> 	';

                    seconddropdownengg=createselectenggdropdown("1dropdownengg");
                    document.getElementById('secondprefdiv').appendChild(seconddropdownengg);

                    seconddaybtn=createabtn();
                    seconddaybtn.name="seconddaybtn";
                    seconddaybtn.id="seconddaybtn";
                    //document.getElementById('route_planning_suggestion').appendChild(seconddaybtn);

                    document.getElementById('secondprefdiv').appendChild(seconddaybtn);
                    $("#seconddaybtn").attr("onclick", "selectthesecondavailableday()");

                    /*
                    seconddropdownengg=createselectenggdropdown("seconddropdownengg");
                    document.getElementById('secondprefdiv').appendChild(seconddropdownengg);
                    */

					break;

                case 2:
					 document.getElementById('thirdprefdiv').innerHTML += '<br> <b>' + formatgoogledateddmmyyyy(availabledatesinddmmyyyy[2]) + '</b> is 3rd Available Day<br> ';

                    thirddropdownengg=createselectenggdropdown("2dropdownengg");
                    document.getElementById('thirdprefdiv').appendChild(thirddropdownengg);

                    thirddaybtn=createabtn();
                    thirddaybtn.name="thirddaybtn";
                    thirddaybtn.id="thirddaybtn";
                    //document.getElementById('route_planning_suggestion').appendChild(thirddaybtn);
                    $("#thirddaybtn").attr("onclick", "selectthethirdavailableday()");
                    document.getElementById('thirdprefdiv').appendChild(thirddaybtn);

                    /*
                    thirddropdownengg=createselectenggdropdown("thirddropdownengg");
                    document.getElementById('thirdprefdiv').appendChild(thirddropdownengg);
                    */
                    break;


			}//end of switch


		}//for
	}


    function createabtn()
    {
        var btn = document.createElement("input");
        btn.type = "button";
        btn.value = "Book";
        btn.style = "margin:5px";
        return btn;
    }///end of function createabtn()



    function createselectenggdropdown(select_id)
    {
        //Create and append select list
        var selectList = document.createElement("select");
        selectList.id = select_id;
        return selectList;


    }///end of function createselectenggdropdown()


    function getselectedvalueofdropdownbyid(dd_id)
    {
        var e = document.getElementById(dd_id);
        console.log("Selected Engg: "+e.options[e.selectedIndex].text);
        return e.options[e.selectedIndex].value;

    }///end of function getselectedvalueofdropdownbyid(dd_id)


    function createpreferecncebutton(pref, dateid)
    {
        /*
        var preferencebutton = document.createElement("input");
        preferencebutton.id = pref + 'preferecncebutton';
        preferencebutton.name = pref + 'preferecncebutton';
        preferencebutton.type = "button";
        preferencebutton.value = "Available";
        preferencebutton.style = "margin:5px";
        //document.getElementById(dateid).style.background='#99FFCC';
        document.getElementById(dateid).appendChild(preferencebutton);
         */
        document.getElementById(dateid).style.background = '#66FF66';
        stoploadingsign();
        //document.getElementById('loading').style.display = 'none';


    }//end of createfirstpreferecncebutton





    function selectthefirstavailableday()
    {
        console.log('selectthefirstavailableday SELECTEWD');
        console.log(getselectedvalueofdropdownbyid("0dropdownengg"));
        selected_e_id=getselectedvalueofdropdownbyid("0dropdownengg");
        createNewDiaryEntry(availabledatesinddmmyyyy[0],selected_e_id);
    }///end of selectthefirstavailableday



    function selectthesecondavailableday()
    {
        console.log('selectthesecondavailableday SELECTEWD');
        //createNewDiaryEntry(availabledatesinddmmyyyy[1]);
        console.log(getselectedvalueofdropdownbyid("1dropdownengg"));
        selected_e_id=getselectedvalueofdropdownbyid("1dropdownengg");
        createNewDiaryEntry(availabledatesinddmmyyyy[1],selected_e_id);

    }///end of selectthesecondavailableday



    function selectthethirdavailableday()
    {
        console.log('THIRD preferecncebutton SELECTEWD');
        //createNewDiaryEntry(availabledatesinddmmyyyy[2]);
        console.log(getselectedvalueofdropdownbyid("2dropdownengg"));
        selected_e_id=getselectedvalueofdropdownbyid("2dropdownengg");
        createNewDiaryEntry(availabledatesinddmmyyyy[2],selected_e_id);

    }///endf of selectthethirdavailableday



    function selectthe1stfreeday()
    {
        console.log('selectthe1stfreeday SELECTEWD');
        console.log(getselectedvalueofdropdownbyid("0freeenggdd"));
        selected_e_id=getselectedvalueofdropdownbyid("0freeenggdd");
        createNewDiaryEntry(fullfreedaysdata[0].input_date_str,selected_e_id);

    }///endf of selectthe1stfreeday

    function selectthe2ndfreeday()
    {
        console.log('selectthe2ndfreeday SELECTEWD');
        console.log(getselectedvalueofdropdownbyid("1freeenggdd"));
        selected_e_id=getselectedvalueofdropdownbyid("1freeenggdd");
        createNewDiaryEntry(fullfreedaysdata[1].input_date_str,selected_e_id);

    }///endf of selectthe2ndfreeday

    function selectthe3rdfreeday()
    {
        console.log('selectthe3rdfreeday SELECTEWD');
        console.log(getselectedvalueofdropdownbyid("2freeenggdd"));
        selected_e_id=getselectedvalueofdropdownbyid("2freeenggdd");
        createNewDiaryEntry(fullfreedaysdata[2].input_date_str,selected_e_id);

    }///endf of selectthe3rdfreeday






    ////***==============================================================================*///
    function callback(response, status) {

        console.log(response);
        if (status != google.maps.DistanceMatrixStatus.OK) {
            alert('Error was: ' + status);
        } else {
            var origins = response.originAddresses;
            var destinations = response.destinationAddresses;
            var outputDiv = document.getElementById('outputDiv');
            outputDiv.innerHTML = '';
            deleteOverlays();

            for (var i = 0; i < origins.length; i++) {
                var results = response.rows[i].elements;
                addMarker(origins[i], false);
                for (var j = 0; j < results.length; j++) {
                    addMarker(destinations[j], true);

                    /*
                     outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
                     + ': ' + results[j].distance.text + ' in '
                     + results[j].duration.text + '<br>';
                     */
                    recievd_postcodes.push(destinations[j]);
                    rd = results[j].distance.text;
                    rd = rd.replace('mi', '');
                    rd = rd.trim();
                    rd = parseFloat(rd);
                    recievd_distances.push(rd);
                    recievd_time.push(results[j].duration.text);


                    /*
                     outputDiv.innerHTML += 'PA12BE  to ' + destinations[j]
                     + ': ' + results[j].distance.text + ' in '
                     + results[j].duration.text + '<br>';
                     */
                }
            }
        }
    }

    function addMarker(location, isDestination) {
        var icon;
        if (isDestination) {
            icon = destinationIcon;
        } else {
            icon = originIcon;
        }
        geocoder.geocode({'address': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                bounds.extend(results[0].geometry.location);
                map.fitBounds(bounds);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                });
                markersArray.push(marker);
            } else {
                alert('Geocode was not successful for the following reason: '
                        + status);
            }
        });
    }

    function deleteOverlays() {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    function callme()
    {

        document.getElementById('inputs').style.display = 'none';
        document.getElementById('loading').style.display = 'block';


        autotimer = setInterval(function () {
            calculateDistances();
            /*
             var div = document.getElementById('inputs');
             if (div.style.display !== 'none') {
             div.style.display = 'none';
             }
             else {
             div.style.display = 'block';
             }
             */
        }, 1000);
    }

    function indexOfSmallest(a) {
        var lowest = 0;
        for (var i = 1; i < a.length; i++) {
            if (a[i] < a[lowest])
                lowest = i;
        }
        return lowest;
    }


    function finddayofnearestpostcode(postcode)
    {
        postcode = postcode.trim();
        data =<?php echo json_encode($days_postcodes_array); ?>;
        foundonday = 'BLANK';

        console.log(data);
        console.log(postcode);

        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                //console.log(key + " -> " + data[key]);
                var day = key;

                for (t = 0; t < data[key].length; t++)
                {
                    current_pc = data[key][t];
                    //console.log(current_pc);
                    var n = postcode.indexOf(current_pc);
                    if (n != -1)
                    {
                        console.log('INDEX OF ' + postcode + ' in DAY ' + day + 'is ' + n);
                        //foundonday=parseInt(day)+1;//deactivated by SUDEEP TALATI
                        foundonday = parseInt(day);
                        return foundonday;
                    }


                }////for (t=0;t<data[key].length;t++)

            }///end of if (data.hasOwnProperty(key)) {

        }///end of for (var key in data)

    }





    function createNewDiaryEntry(dateofappointment, new_engineer_id)
    {
        alert('createNewDiaryEntry Called');

        timeofcall=document.getElementById('timeofcall').value;
        appointment_notes=document.getElementById('appointment_notes').value;
        notes='<b>'+timeofcall+'</b>:'+appointment_notes;


        var urlToCreate = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=api/createNewDiaryEntry&start_date=' + dateofappointment + '&engg_id=' + new_engineer_id + '&service_id='+service_id+'&notes='+notes;
        console.log(urlToCreate);


        $.ajax
                ({
                    type: 'POST',
                    url: urlToCreate,
                    cache: false,
                    modal: true,
                    success: function (data)
                    {
                        alert('Appointment Created' + data);
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=servicecall/view&id=' + service_id;
                    },
                    error: function ()
                    {
                        alert("ERROR");
                    },
                });//end of AJAX.

    }//end of createNewDiaryEntry().

//function finddayofnearestdate(nearestday)
    function adddaystodate(no_of_days)
    {
        var today = new Date();
        var nearestdate = new Date(today);
        nearestdate.setDate(today.getDate() + no_of_days);

        var dd = nearestdate.getDate();
        var mm = nearestdate.getMonth() + 1; //January is 0!
        var yyyy = nearestdate.getFullYear();


        rtn_date = dd + '-' + mm + '-' + yyyy;
        return rtn_date;
    }

    function arraycontains(a, obj) {
        var i = a.length;
        while (i--) {
            if (a[i] === obj) {
                return true;
            }
        }
        return false;
    }



    /////Finding Engineer

    function findengineerinthatpostcode()
    {
        console.log("----------------------findengineerinthatpostcode----------------------");


        console.log("Nearrst postcodes"+temp_googlerecievedpc_array);


        enggavailabledates=[];
        enggavailabledates[0]=availabledatesinddmmyyyy[0];
        enggavailabledates[1]=availabledatesinddmmyyyy[1];
        enggavailabledates[2]=availabledatesinddmmyyyy[2];


        var availabledates_options_jsonstr = JSON.stringify(enggavailabledates);
        var nearest_postcodes_jsonstr = JSON.stringify(temp_googlerecievedpc_array);

        console.log("Nearrst dates"+availabledates_options_jsonstr);
        console.log("Nearrst postcode"+nearest_postcodes_jsonstr);


    /*
        for(var i=0;i<availabledates_options.length;i++)
        {
            console.log("availabledates_options - "+availabledates_options[i]);
            //console.log("temp_googlerecievedpc_array - "+temp_googlerecievedpc_array[i]);

        }/////end of for(var i=0;i<temp_googlerecievedpc_array.length;i++)
    */
        var nearestenggurl= '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=enggdiary/findenggavailableondate/';


        var mydata={"dates":availabledates_options_jsonstr, "postcodes":nearest_postcodes_jsonstr}
        $.ajax
        ({
            type: 'POST',
            url: nearestenggurl,
            data:mydata,
            cache: false,
            modal: true,
            success: function (server_response_data)
            {
                json_output = JSON.parse(server_response_data);
                console.log(json_output);

                if (json_output.status=="OK") {
                    console.log("Status is OK");
                    createandupdateengineerdropdown(json_output);
                    createfullfreedayssection();


                }else
                {
                    console.log("Status is NOT OK"+server_response_data);

                    alert("Cannot Update Engineer");
                }
            },
            error: function ()
            {
                alert("ERROR");
            },
        });//end of AJAX.




    }///end of function findengineerinthatpostcode()

    function createandupdateengineerdropdown(available_dates) {

        console.log("---------createandupdateengineerdropdown--------");
        //createselectenggdropdown("firstselect");
        console.log(available_dates);

        for (var i=0;i<available_dates.result.length;i++) {

            console.log("---------Now updating enggs--------");


            res=available_dates.result[i];

            available_enggs=res.available_enggs;
            a_date=res.date;
            console.log("Now updating enggs--------"+a_date);

            selectid=i+"dropdownengg";

            console.log("Select Id"+selectid);

            var enggselect = document.getElementById(selectid);

            for ( var key in available_enggs) {

                engg = available_enggs[key];

                console.log(engg.engineer_name);
                console.log(engg.engineer_id);
                enggselect.options[enggselect.options.length] = new Option(engg.engineer_name,engg.engineer_id);

            }


        }//end of  for (var i=0;i<available_enggs.length().i++)


    }///end of function createandupdateengineerdropdown()


    function createfullfreedayssection() {


        fullfreeday_date=[];

        console.log('createfullfreedayssection-----------------');

        // for(var n=0;n<fullfreedaysdata.length;n++)
        for (var n = 0; n < fullfreedaysdata.length; n++) {

            if (n == 3)
                break;


            console.log(fullfreedaysdata[n]);
            console.log(fullfreedaysdata[n].date_str);
            console.log(fullfreedaysdata[n].input_date_str);


            fullfreeday_date.push(fullfreedaysdata[n].input_date_str);



            enggs_arr = fullfreedaysdata[n].engineers;

            enggselect = document.createElement("select");
            enggselect.setAttribute("id", n + "freeenggdd");

            for (var c = 0; c < enggs_arr.length; c++) {
                console.log(enggs_arr[c].engineer_name);
                console.log(enggs_arr[c].engineer_id);
                e_nm = enggs_arr[c].engineer_name;
                e_id = enggs_arr[c].engineer_id;
                enggselect.options[enggselect.options.length] = new Option(e_nm, e_id);
            }


            var enggselectdt_lbl = document.createElement("div");
            enggselectdt_lbl.innerHTML = fullfreedaysdata[n].date_str;

            document.getElementById("fullfreedaysofengg").appendChild(enggselectdt_lbl);
            document.getElementById("fullfreedaysofengg").appendChild(enggselect);

            freedaybtn=createabtn();
            freedaybtn.setAttribute("id", n+"freedaybtn");
            document.getElementById("fullfreedaysofengg").appendChild(freedaybtn);

            switch (n)
            {
            case 0 :
                freedaybtn.setAttribute("onclick", "selectthe1stfreeday()");
                //$("#freedaybtn").attr("onclick", "selectthe1stfreeday()");
                break;
            case 1 :
                freedaybtn.setAttribute("onclick", "selectthe2ndfreeday()");
                //$("#freedaybtn").attr("onclick", "selectthe2ndfreeday()");
                break;
            case 2 :
                freedaybtn.setAttribute("onclick", "selectthe3rdfreeday()");
                //$("#freedaybtn").attr("onclick", "selectthe3rdfreeday()");
                break;
            default:
                break;
            }




        }///for(var n=0;n<fullfreedaysdata.length;n++)
    }//end of function createfullfreedayssection()





    function formatgoogledateddmmyyyy(google_date)
    {
        ////This is because the month starts from 1 to 12 in google supplied dates
        var month = new Array(12);
        month[1] = "January";
        month[2] = "February";
        month[3] = "March";
        month[4] = "April";
        month[5] = "May";
        month[6] = "June";
        month[7] = "July";
        month[8] = "August";
        month[9] = "September";
        month[10] = "October";
        month[11] = "November";
        month[12] = "December";

        var weekday = new Array(7);
        weekday[0]=  "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";



        var g_date_array= google_date.split("-");
        ga_day=g_date_array[0];
        ga_month=g_date_array[1];
        ga_year=g_date_array[2];

        js_date=new Date(ga_year+"-"+ga_month+"-"+ga_day);///YYYY-MM-DD

        ga_weekday=js_date.getDay();///	Returns the day of the week (from 0-6)


        new_formatted_date=weekday[ga_weekday]+", "+ga_day+"- "+month[ga_month]+"-"+ga_year;

        return new_formatted_date;

    }///end of function formatgoogledateddmmyyyy(google_date)


    function stoploadingsign()
    {
        console.log("stoploadingsign Called ");
        var loadinddivs = document.getElementsByClassName("loading");

        console.log(loadinddivs);
        for (var l=0;l<loadinddivs.length;l++ )
        {
            loadinddivs[l].style.display = 'none';

        }

    }///end of function stoploadingsign()




</script>
