<h1 align="center">Route on Google map </h1>
 
<?php

$engineer = Engineer::model()->findByPk($engineer_id);
$enginner_name=$engineer->first_name; 
$selected_date='';

$engineer_address_latitudes=$engineer->contactDetails->latitudes;
$engineer_address_longitudes=$engineer->contactDetails->longitudes;

$engineer_address_array=array();
$engineer_address_array['latitude']=$engineer_address_latitudes;
$engineer_address_array['longitude']=$engineer_address_longitudes;


$customer_address=array();
$i=1;
foreach ($route_map_results as $r){
	
	//echo '<hr>'.var_dump($r->servicecall_id);
	//echo '<hr>'.$r->servicecall_id;
	
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
		$fulladd=$fulladd.'<br>'.$servicecall->customer->postcode;		
		
		
		
		
	if ($servicecall->customer->latitudes!='' && $servicecall->customer->longitudes !='' )
	{	
		$selected_date=date('l, F j, Y', $r->visit_start_date);  
		/*
		echo "<br><br>";
		echo "<li><b>".$i.'</b> -- '.$fulladd;
		echo '<br>'. date('l, j-F-Y', $r->visit_start_date);  
		echo '----'.date('g:i a', $r->visit_start_date).' -'.date( 'g:i a', $r->visit_end_date);  
		
		*/
//		echo "  ".$servicecall->customer->latitudes;
//		echo "  ".$servicecall->customer->longitudes;
		
		//echo "</li>";
		//$fulladd=$fulladd.'<br>'.date('l, j-F-Y', $r->visit_start_date);  
		$infocontent='<br>'.date('g:i a', $r->visit_start_date).' -'.date( 'g:i a', $r->visit_end_date);  
		$infocontent=$infocontent.'<br>'.$fulladd.'<br><hr>';

		$customer_location=array($infocontent,$servicecall->customer->latitudes,$servicecall->customer->longitudes);
		
		array_push($customer_address,$customer_location);
	}
	else
	{
		echo '<br><li><b>Coordinates not found.......finding the coordinatess</b>';
		updatecoordinates($fulladd,$servicecall->customer->id);
		echo '<br><b>Please refresh the page </li>';
		echo "<SCRIPT LANGUAGE='javascript'>location.reload(true);</SCRIPT>";
		
	}
	
	$i++;
}///end of foreach ($route_map_results as $r){

//print_r($customer_address);

$customer_address_js_array = json_encode($customer_address);
$engg_address_js_array = json_encode($engineer_address_array);

//echo "var javascript_array = ". $customer_address_js_array . ";\n";
 
?>

 
 
 <!-- Google map -->
 
			

<table>
	<tr>	
		<td><h3 align="center"><?php echo $enginner_name; ?></h3></td>
		<td><h3><?php echo $selected_date; ?></h3></td>
	</tr>
	<tr>	
		<td valign='top'>
			<ul id="marker_list"></ul>
		</td>
		<td valign='top'>
			<div id="map"></div>
		</td>
	</tr>
</table>
 
<?php 
		echo CHtml::scriptFile("https://maps.googleapis.com/maps/api/js");
		echo CHtml::scriptFile("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");

?>
	
<style>
#map {
	width: 600px;
	height: 1000px;
	margin: 0px;
	padding: 0px
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

td, h1, h2, h3{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

}


li {
    color: #0088CC;
    cursor: pointer;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    list-style-type: none;
    margin-left:-40px

}
ul {
	cursor: default;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

}

</style>
	
	
<script>
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	//multidimesion array
	var todayslocations= new Array();
	var addresses = <?php echo $customer_address_js_array; ?>;

	var engg_address=<?php echo $engg_address_js_array ?>;


	if(engg_address.latitude==null)
		alert("Co-ordinates of Engineer's address cannot ne found. Please update the latitudes and longitudes field of engineer's postcode");


	console.log(engg_address.latitude);


	var center = new google.maps.LatLng(54.93022, -4.030);
	var map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 6,
					  center: center,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					});
	var bounds = new google.maps.LatLngBounds();
	
	//Creates a infowindow object.
	infoWnd = new google.maps.InfoWindow();

	var lastindex=addresses.length-1;

	var home_lat_lng=new google.maps.LatLng(engg_address.latitude,engg_address.longitude );

	var firstlatlng = new google.maps.LatLng(addresses[0][1],addresses[0][2] );
	var lastlatlng = new google.maps.LatLng(addresses[lastindex][1],addresses[lastindex][2] );
	createlinebetweentwopostcodes(map, home_lat_lng , firstlatlng);
	createlinebetweentwopostcodes(map, home_lat_lng , lastlatlng);
	
	 
	var homeicon='https://chart.googleapis.com/chart?chst=d_simple_text_icon_left&chld=|14|2F5DE6|corporate|24|0EC78D|';
	infocontent='<strong>Office</strong>';
	marker=createMarker(map, home_lat_lng,infocontent, homeicon);
	//Creates a sidebar button for the marker
	createMarkerButton(marker);
	 
	 
	 
	function initialize() {
		for (var x = 0; x < addresses.length; x++) {
				var jobno=x+1; ////since x strats with 0

				//var myicon='https://chart.googleapis.com/chart?chst=d_bubble_icon_text_small&chld=car|bb|'+jobno+'|FFFFFF|000000';
	 			  var myicon='https://chart.googleapis.com/chart?chst=d_map_spin&chld=0.7|0|FFFF00|13|b|'+jobno;
				
				var latlng = new google.maps.LatLng(addresses[x][1],addresses[x][2] );
				map.setCenter(latlng);
				map.setZoom(12);
					
				
				infocontent='<strong>'+jobno+'</strong>:'+ addresses[x][0];
				marker=createMarker(map, latlng,infocontent, myicon);
				
				//Creates a sidebar button for the marker
				createMarkerButton(marker);
				/*	
				new google.maps.Marker({
					position: latlng,
					map: map,
					icon:myicon,
					title:addresses[x][0]
				});
				
				*/
				bounds.extend(latlng); 
				
				var start_latlng = new google.maps.LatLng(addresses[x][1],addresses[x][2] );
				
				 
				if (lastindex==x)
				{
					var end_latlng = new google.maps.LatLng(addresses[x][1],addresses[x][2] );
				}else
				{
					var end_latlng = new google.maps.LatLng(addresses[x+1][1],addresses[x+1][2] );

				}
				
				 
				createlinebetweentwopostcodes(map, start_latlng , end_latlng);
				
		}///end of for (var x = 0; x < addresses.length; x++) { 	
		
		map.fitBounds(bounds);
		
		
	}//end of function initialize() {

	
	function createMarker(map, latlng, title, my_custom_icon) {
	//Creates a marker
	  var marker = new google.maps.Marker({
		position : latlng,
		map : map,
		icon:my_custom_icon,
		title : title
	  });
	  
	  //The infoWindow is opened when the sidebar button is clicked
	  google.maps.event.addListener(marker, "click", function(){
		infoWnd.setContent("<strong>" + title + "</title>");
		infoWnd.open(map, marker);
	  });
	  return marker;
	}//end of function createMarker
	
	
	function createMarkerButton(marker) {
	  //Creates a sidebar button
	  var ul = document.getElementById("marker_list");
	  var li = document.createElement("li");
	  var title = marker.getTitle();
	  li.innerHTML = title;
	  ul.appendChild(li);
	  
	  //Trigger a click event to marker when the button is clicked.
	  google.maps.event.addDomListener(li, "click", function(){
		google.maps.event.trigger(marker, "click");
	  });
	}//end of function createMarkerButton


				
	function createlinebetweentwopostcodes (map, start_latlng , end_latlng)
	{	 
		 //console.log('start coordinates'+start_latlng);
		 //console.log('end coordinates'+end_latlng);
		
		var line = new google.maps.Polyline({
			path: [
				start_latlng, 
				end_latlng
			],
			strokeColor: "#0088CC",
			strokeOpacity: 1.0,
			strokeWeight: 5,
			map: map
		});
	}////end of	function createlinebetweentwopostcodes()

	
	
	
	
    </script>
	
<?php
function updatecoordinates($p_code, $cid)	
{
	echo 'I ma called';
	$p_code= preg_replace('/\s+/', '', $p_code);
	
	$url='http://maps.googleapis.com/maps/api/geocode/json?address='.$p_code;
	$urldata=Setup::model()->curl_file_get_contents($url);
	$json_data=json_decode($urldata);
	//echo '<br><a href='.$url.' target="_blank">'.$url.'</a>';
	//echo '<br>OUTPUT '.$urldata;
	
	
	if ($json_data->status!="ZERO_RESULTS")
	{
 
		$lat= $json_data->results[0]->geometry->location->lat;
		$lng= $json_data->results[0]->geometry->location->lng;
		echo '<br> latPostcode  is  :'.$p_code;
		echo '<br> lat is  :'.$lat;
		echo '<br> long is :'.$lng;
		echo '<br> cid is :'.$cid;
		
		
		$customerModel=Customer::model()->findByPk($cid);
		
		//echo ' Product Id:'. $customerModel->product_id;;
		$customerModel->latitudes=$lat;
		$customerModel->longitudes=$lng;
		$customerModel->save();
		
	}
		
	
	
}///end of function updatecoordinates($p_code, $cid)



?>