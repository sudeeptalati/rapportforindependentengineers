
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<br>
<?php 

$no_next_days = ''; 
$allowedtraveldistancebetweenpostcodes = '';
$totalnoofcallsperday = '';
$workingdaysofweekstring = '';
$averagetimeperservicecall = '';
$totaldistancetobetravelledinaday = '';


$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";

$filename = $root.'/config/diary_parameters.json';

if(file_exists($filename))
{
	//echo "File exixts";
	$diarydata = file_get_contents($filename);
	$diaryDecodedData = json_decode($diarydata, true);
	//echo $filename."<br>";
	//print_r($diaryDecodedData);

	$no_next_days = $diaryDecodedData['no_next_days'];

	$plan_days_in_calendar_manual_booking = $diaryDecodedData['plan_days_in_calendar_manual_booking'];

	//echo "<br>user name = ".$gateway_username;
	$allowedtraveldistancebetweenpostcodes = $diaryDecodedData['allowedtraveldistancebetweenpostcodes'];
	//echo "<br>password = ".$gateway_password;
	$workingdaysofweekstring = $diaryDecodedData['workingdaysofweekstring'];
	//echo "<br>Api key = ".$gateway_apikey;
	$totalnoofcallsperday = $diaryDecodedData['totalnoofcallsperday'];
	$averagetimeperservicecall = $diaryDecodedData['averagetimeperservicecall'];
	$totaldistancetobetravelledinaday = $diaryDecodedData['totaldistancetobetravelledinaday'];
	
}



?>


<form action="<?php echo Yii::app()->createUrl('setup/diaryparametersview')?>" method="post">
	
	<b>Diary Planning Days (No. of days To be considered) </b><br><input type="text" name="no_next_days" value=<?php echo $no_next_days;?>><br><br>

	<b>Manual calendar booking (No. of days To be considered while manual booking)</b><br><input type="text" name="plan_days_in_calendar_manual_booking" value=<?php echo $plan_days_in_calendar_manual_booking;?>><br><br>

	<b>Allowed distance between two postcodes (in Miles)</b><br><input type="text" name="allowedtraveldistancebetweenpostcodes" value=<?php echo $allowedtraveldistancebetweenpostcodes;?>><br><br>
	
	<b>Working days of week</b><br><input type="text" name="workingdaysofweekstring" value=<?php echo $workingdaysofweekstring;?>>
			<br><small>Please use format 1234567 as 1 (for Monday) through 7 (for Sunday). <br>
		For Example:<br>
		For working days as Monday to Friday use 12345<br>
		For working days as Monday to Saturday use 123456<br>
		For working days as Tuesday to Sunday use 234567<br>
		</small><br>
	
	<b>No. of calls per day per Engineer</b><br><input type="text" name="totalnoofcallsperday" value=<?php echo $totalnoofcallsperday;?>><br><br>


    <b>Average time per call (in minutes)</b>


    <br />
    <select name="averagetimeperservicecall" >

        <option selected="selected" value="<?php echo $averagetimeperservicecall;?>"><?php echo $averagetimeperservicecall;?></option>
        <?php for( $i=1; $i<10;$i++) {

            $for_mins=$i*30;
            $for_hours=$for_mins/60;
            $for_hours=$for_hours.' hours';
            echo "<option value='".$for_mins."'>".$for_hours."</option>";

        }?>

    </select>



    <br />




    <b>Maximum Distance to be travelled in a day (in Miles)</b><br><input type="text" name="totaldistancetobetravelledinaday" value=<?php echo $totaldistancetobetravelledinaday;?>><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="diary_parameters_values"  type="submit" style="width:100px">
	
</form>	