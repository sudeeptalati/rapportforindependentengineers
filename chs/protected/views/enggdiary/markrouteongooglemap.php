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


	$fulladd=Setup::model()->formataddress($servicecall->customer->address_line_1, $servicecall->customer->address_line_2, $servicecall->customer->address_line_3, $servicecall->customer->town, $servicecall->customer->postcode);




	if ($servicecall->customer->latitudes!='' && $servicecall->customer->longitudes !='' )
	{	
		$selected_date=date('l, F j, Y', $r->visit_start_date);  
		/*
		echo "<br><br>";
		echo '<br>'. date('l, j-F-Y', $r->visit_start_date);
		echo '----'.date('g:i a', $r->visit_start_date).' -'.date( 'g:i a', $r->visit_end_date);  
		echo "<li><b>".$i.'</b> -- '.$fulladd;
		echo "  ".$servicecall->customer->latitudes;
		echo "  ".$servicecall->customer->longitudes;

		*/

		//echo "</li>";
		//$fulladd=$fulladd.'<br>'.date('l, j-F-Y', $r->visit_start_date);
		//

		$coordinates_update_url= "index.php?r=customer/updatecustomeraddresscoordinates&customer_id=".$servicecall->customer_id;

		$infocontent='';


		$infocontent=$infocontent.'<br>'.date('g:i a', $r->visit_start_date).' -'.date( 'g:i a', $r->visit_end_date);
		$infocontent=$infocontent.'<br>'.$fulladd.'<br>';
		$infocontent=$infocontent."<a title='If you are finding the location on map as incorrect, click here. This will update the coordinate (latitude and longitude) of the address.' target='''_blank' href='".$coordinates_update_url."'>Relocate On Map</a>";
		$infocontent=$infocontent."<hr>";

		$customer_location=array($infocontent,$servicecall->customer->latitudes,$servicecall->customer->longitudes);
		
		array_push($customer_address,$customer_location);
	}
	else
	{
		echo '<br><li><b>Coordinates not found.......finding the coordinatess</b>';
		Customer::model()->update_customer_address_coordinates($servicecall->customer->id);
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

<!-- Google Services Start -->
<?php $google_maps_api_key=Yii::app()->params['google_maps_api_key'];?>
<?php echo CHtml::scriptFile("https://maps.googleapis.com/maps/api/js?key=".$google_maps_api_key); ?>
<!-- Google ServicesEnd -->
	
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

	function updatecoordinates(customer_id)
	{


		var urltoupdatecoordinates = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=customer/updatecustomerpostcodecoordinates&customer_id='+customer_id;

		console.log('updatecoordinates url'+urltoupdatecoordinates);



		$.get( urltoupdatecoordinates, function( data ) {
			if (data=="SAVED")
			{
				location.reload();
			}
			else
			{
				alert('Canoot Update customer address corrodinates'+data);
			}
		});








	}///end of 	function updatecoordinates()








</script>
	
<?php
function updatecoordinates($p_code, $cid)	
{



	
}///end of function updatecoordinates($p_code, $cid)



?>