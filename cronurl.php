<?php

$rooturl="http://127.0.0.1/rapport/forengineers/rapportforindependentengineers/chs/";

triggerurl($rooturl."index.php?r=tasksToDo/sendbookingnotification");
triggerurl($rooturl."index.php?r=tasksToDo/completeTasks");





function triggerurl($url)
{
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_exec ($curl);
    curl_close ($curl);
}///end of function triggerurl($url)


?>