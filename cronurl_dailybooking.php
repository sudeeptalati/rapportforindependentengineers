<?php
/*
if(isset ($_GET['task']))
	$task=$_GET['task'];
else
	$task='completetasks';


 
$rooturl="http://84.9.30.62:260/test/crontest/yii/chs/";

if ($task=='sendbookingnotification')
	triggerurl($rooturl."index.php?r=tasksToDo/sendbookingnotification");

if ($task=='completetasks')
	triggerurl($rooturl."index.php?r=tasksToDo/completeTasks");

*/


//$rooturl="http://84.9.30.62:255/careys/yii/chs/";

$rooturl="http://localhost/rapport/forengineers/rapportforindependentengineers/chs/";

triggerurl($rooturl."index.php?r=tasksToDo/sendbookingnotification");
 
////////////FUNCTIONS =///////////////
function triggerurl($url)
{
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_exec ($curl);
    curl_close ($curl);
}///end of function triggerurl($url)


?>