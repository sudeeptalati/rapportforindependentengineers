<title>Booking Notification</title>
<?php 


triggerurl("http://84.9.30.62:255/careys/yii/cronurl_dailybooking.php"); 

////////////FUNCTIONS =///////////////
function triggerurl($url)
{
	$ch = curl_init();

	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HEADER, 0);

	// grab URL and pass it to the browser
	$out = curl_exec($ch);
	// close cURL resource, and free up system resources
	curl_close($ch);

	$fp = fopen('bookingemailsms.html', 'w');
	fwrite($fp, $out);
	fclose($fp);
	
	echo "<hr><hr><hr>".$out."<hr><hr><hr>";
    
}///end of function triggerurl($url)
