



<?php
		
$waypointdata=array();
$selected_date_int='';
 $GLOBALS['foobar']='';
 
 
//foreach ($route_map_results as $r){

for($i=0;$i<count($route_map_results);$i++){
	$r=$route_map_results[$i];
	
	$servicecall=Servicecall::model()->findByPk($r->servicecall_id);
	$fulladd='';
 
	if ($servicecall->customer->address_line_1!='' && $servicecall->customer->address_line_1 !=null)
		$fulladd=$fulladd.$servicecall->customer->address_line_1;	

	if ($servicecall->customer->address_line_2!='' && $servicecall->customer->address_line_2 !=null)
		$fulladd=$fulladd.', '.$servicecall->customer->address_line_2;	

	if ($servicecall->customer->address_line_3!='' && $servicecall->customer->address_line_3 !=null)
		$fulladd=$fulladd.','.$servicecall->customer->address_line_3;	
		
	if ($servicecall->customer->town!='' && $servicecall->customer->town !=null)
		$fulladd=$fulladd.','.$servicecall->customer->town;	

	if ($servicecall->customer->postcode!='' && $servicecall->customer->postcode !=null)
		$fulladd=$fulladd.','.$servicecall->customer->postcode;		
		
	//echo '<br>'.$fulladd;
	$servicecalls_summary_array=array( 'current_route_order'=>$i,'new_route_order'=>'','diary_id'=>$r->id,'customer_postcode'=>$servicecall->customer->postcode);
	
	$selected_date_int=$r->visit_start_date;
	
	array_push($waypointdata,$servicecalls_summary_array);
	
	

}////end of 



//2014-06-12

$engineer = Engineer::model()->findByPk($engineer_id);
$workstartpostcode=$engineer->contactDetails->postcode; 
$workendpostcode=$engineer->contactDetails->postcode;
?>


<?php $selected_date_str=date('Y-m-d', $selected_date_int); ?>

 



<h1>Route Optimisation</h1>
<h3><?php //echo date('l, j-F-Y', $selected_date_int); ?></h3>
<table>
	<tr>
		<th>Engineer</th>
		<th>Start Postcode</th>
		<th>End Postcode</th>
	</tr>
	<tr>
		<td><h4><?php echo $engineer->fullname; ?><h4></td>
		<td><?php echo $workstartpostcode; ?></td>
		<td><?php echo $workendpostcode; ?></td>
	</tr>
</table>
<?php $this->renderPartial('viewday',array( 'engineer_id'=>$engineer_id , 'selected_date_str'=>$selected_date_str)); ?>
<?php 

if ($planroute=='1')
{
	optimiseroute($waypointdata, $workstartpostcode, $workendpostcode,$selected_date_int);
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function optimiseroute($waypoint_postcodes_and_diaryid, $origin_address,  $destination_address, $route_date )
{
	///preparing the data
	global $my_php_legs;
	$origin_address= preg_replace('/\s+/', '', $origin_address);
	$destination_address= preg_replace('/\s+/', '', $destination_address);
		
	$waypointpostcodes='optimize:true';///optimize:true|KA33AQ|KA269EL|KA309EB|KA260AL
	foreach ($waypoint_postcodes_and_diaryid as $pc)
	{
		/*
		echo '<hr><br>current_route --'.$pc['current_route_order'];
		echo '<br>new_route_order  --'.$pc['new_route_order'];
		echo '<br>Diarry Id--'.$pc['diary_id'];
		echo '<br>customer_postcode Id--'.$pc['customer_postcode'];
		*/
		$p_code= preg_replace('/\s+/', '', $pc['customer_postcode']);
		$waypointpostcodes=$waypointpostcodes.'|'.$p_code;
	}
	
	
	//echo $waypointpostcodes;
	
	$googleapikey='AIzaSyBr8_LWgeppcCwgYy2dvoBRzmCiNGsXy1Y';
	
	//$url='https://maps.googleapis.com/maps/api/directions/json?origin=KA12NP&destination=KA12NP&waypoints=optimize:true|KA33AQ|KA269EL|KA309EB|KA260AL&units=imperial';
	//$url='https://maps.googleapis.com/maps/api/directions/json?origin=IP2%200LB&destination=IP2%200LB&waypoints=optimize:true|IP45HF|IP45BA|IP14LB|IP76NG|CO76JS|CO33UA|CO28AW|CO45ZJ|CO28UJ|co29qe&units=imperial&key=AIzaSyBr8_LWgeppcCwgYy2dvoBRzmCiNGsXy1Y';
	
	$sslurl='https://maps.googleapis.com/maps/api/directions/json?origin='.$origin_address.'&destination='.$destination_address.'&waypoints='.$waypointpostcodes.'&units=imperial&key='.$googleapikey;
	//echo '<br><a href='.$sslurl.'>'.$sslurl.'</a><br>';

	$urldata=Setup::model()->curl_file_get_contents_by_sslurl($sslurl);
	//echo $urldata;
	$json_data=json_decode($urldata);
		
	
	
	
	$waypoint_order=$json_data->routes[0]->waypoint_order;
	
	//echo '<br>'.var_dump($waypoint_order).'<br>';
	
	
	
	$new_route_array=array();
	
	
	
	for ($i=0;$i<count($waypoint_order);$i++)
	{
		//echo '<br> Order'.$waypoint_order[$i];
		$x=$waypoint_order[$i];
		//echo 'my postcode is'.$waypoint_postcodes_and_diaryid[$x]['customer_postcode'];
		$cp=$waypoint_postcodes_and_diaryid[$x]['customer_postcode'];
		$d_id=$waypoint_postcodes_and_diaryid[$x]['diary_id'];
		
		//$data_array=array('new_route_order'=>$waypoint_order[$i], 'diary_id'=>$d_id,'customer_postcode'=>$cp);		
		$data_array=array('diary_id'=>$d_id,'customer_postcode'=>$cp);		
		array_push($new_route_array,$data_array );
		
	}///end of for ($i=0;$<count($waypoint_order);$i++)
	
	
	echo '<hr>';
	
	$starttime='';
	$s_month=date('n',$route_date);
	$s_day=date('j',$route_date);
	$s_year=date('Y',$route_date);
	 
	// Prints: October 3, 1975 was on a Friday
	
	$starttime=mktime(9,0,0,$s_month,$s_day,$s_year);
	$slot=1;
	$start_hour=9;///slot of each call
	
	
	/*
	echo '<table border=1>';
	echo '<tr>';
	echo '<th>Old Postcodes Route Order</th>';
	echo '<th>NEW  Postcodes Route Order</th>';
	echo '<th>Time</th>';
	echo '<th>Action</th>';
	echo '</tr>';
	*/
	for ($i=0;$i<count($new_route_array);$i++)
	{
		$appointment_time=mktime($start_hour,0,0,$s_month,$s_day,$s_year);
		
		/*
		echo '<tr>';
		echo '<td>'.$waypoint_postcodes_and_diaryid[$i]['customer_postcode'].'</td>';
		echo '<td>'.$new_route_array[$i]['customer_postcode'].'</td>';
		echo '<td>'.date("g:i a  j-F-Y", $appointment_time).'</td>';
		*/		
 
		$new_route_array[$i]['appointment']=date("g:i a", $appointment_time);
		$start_hour=$start_hour+$slot;
		///////updating the diary 
		///Starting from 9:00 am in morning and minimum 2 hours between the two calls
		
		$diary_id=$new_route_array[$i]['diary_id'];
		$visit_start_date=$appointment_time;
		$visit_end_date=$appointment_time+(60*45);;
		
		$update_diary=Enggdiary::model()->updateappointmentduration($diary_id, $visit_start_date , $visit_end_date);
		
		/*
		if ($update_diary==1)
			echo '<td><span style="color:green;"><b>Diary Updated</b></span></td>';
		else
			echo '<td><span style="color:red;"><b>Error in updating</b></span></td>';
		echo '</tr>';
		*/
	}
	
	//echo '</table>';
	
	
	?>
	
	
	

	<div id="routedetail">
	<?php
	echo "<i>Note: If you change the order in the above day, the following route could not be used then.<i>";
	echo "<h5>Start time is  ".date("g:i a  j-F-Y", $starttime).'</h5>';
	echo "<h5>Duration of each call including travelling time : ".$slot.' hour</h5>';
	
	$new_route_array[count($new_route_array)]['appointment']='Reaching Home';
	
	echo "<h3>Route Summary by Google Route Planner </h3>";
	
	echo '<table border=1>';
	echo '<tr>';
	echo '<th>Route Order</th>';
	echo '<th>Origin Address</th>';
	echo '<th>Destination  Address</th>';
	echo '<th>Travelling Distance</th>';
	echo '<th>Travelling Time</th>';
	echo '<th>Appointment</th>';
	echo '</tr>';
	
	if (isset($json_data->status)=="OK")
	{
		
		$routelist= $json_data->routes[0]->legs;
		 $GLOBALS['foobar']=json_encode($routelist);
		
		$i=1;
		foreach ($routelist as $leg)
		{
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$leg->start_address.'</td>';
			echo '<td>'.$leg->end_address.'</td>';
			echo '<td>'.$leg->distance->text.'</td>';
			echo '<td>'.$leg->duration->text.'</td>';
			echo '<td>'.$new_route_array[$i-1]['appointment'].'</td>';
			echo '</tr>';
			$i++;
		}///end of foreach routelist
		
	}
	else
	{
		echo '<br>Error: '.$json_data	;
	}
	
	echo '</table>';
	
 	echo "</div>";///end of div route detail
	
	
	}////end of function optimiseroute()

 //echo 'My php '. $GLOBALS['foobar'];
?>
