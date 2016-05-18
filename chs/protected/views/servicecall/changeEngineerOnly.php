<?php 

$service_id = $_GET['service_id'];

$servicecallModel = Servicecall::model()->findByPk($service_id);

// echo "<br>Service call id in change engg = ".$service_id;
// echo "<br>Diary id of servicecall = ".$servicecallModel->engg_diary_id;
// echo "<br>Engineer name = ".$servicecallModel->enggdiary->engineer->fullname;
// echo "<br>Status of the service call = ".$servicecallModel->enggdiary->status;


?>

<center>
 	<b>
 		Changing Engineer for service call no :<?php echo $servicecallModel->service_reference_number;?>
 		<br>Current Engineer : <?php echo $servicecallModel->engineer->company.",".$servicecallModel->engineer->fullname;?>
 	</b>
 </center>
 
 <br>
 
 <script type="text/javascript">

function engg_change(id)
{
	
	//alert("Selected id = "+id);
	if(id == '')
	{
		alert("All engineers cannot be selected..!!!!!!! Select any one engineer.");
		//document.getElementById('change_engineer_submit').disabled = true;
		$('#change_engineer_submit').attr("disabled", true); 
	}
	else
		$('#change_engineer_submit').attr("disabled", false);
}//end if engg_change().
 


 </script> 

<?php

$baseUrl=Yii::app()->request->baseUrl;

 

$changeEnggUrl=$baseUrl.'/index.php?r=Servicecall/selectEngineer&diary_id='.$servicecallModel->engg_diary_id.'&service_id='.$service_id;

$updateServicecallChangeEngineerForm=$this->beginWidget('CActiveForm', array(
		'id'=>'updateService-changeEngineer-form',
		'enableAjaxValidation'=>false,
		'action'=>$changeEnggUrl,
		'method'=>'get'

));

$model = Servicecall::model();
//$engg_id = 0;
$data=CHtml::listData(Engineer::model()->findAll(array('order'=>"`fullname` ASC")), 'id', 'fullname', 'company');

echo $updateServicecallChangeEngineerForm->dropDownList($model, 'engineer_id', $data,
									array('onchange'=>'js:engg_change(this.value)')
								);

echo "&nbsp;&nbsp;".CHtml::submitButton('Change', array('id'=>'change_engineer_submit'));

$this->endWidget();

?>

<!-- ******************* GETTING DISTANCE BETWEEN  PLACES FROM GOOGLE API ******************** -->

<?php 
/* CODE TO GET DISTANCE FROM GOOGLE DELETE FROM HERE WHEN YOU COPY THIS CODE IN RIGHT PLACE. 
echo "<hr>";
//echo "Here";
//$url = "http://maps.googleapis.com/maps/api/directions/json?origin=KA3 1PZ&destination=KA1 2NP&sensor=false&units=imperial";
$url = "http://maps.googleapis.com/maps/api/directions/json?origin=KA1%202NP&destination=KA8%208JE&waypoints=ka3%201pz&sensor=false&units=imperial";

$jsonfile = curl_file_get_contents($url);

$jsondata = json_decode($jsonfile);

//echo "<br>DATA from google server = ".$jsonfile;

echo "<br>Distance between src and dest = ".$jsondata->routes[0]->legs[0]->distance->text;

echo "<hr>";


function curl_file_get_contents($request)
{
	$curl_req = curl_init($request);


	curl_setopt($curl_req, CURLOPT_URL, $request);
	curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

	$contents = curl_exec($curl_req);

	curl_close($curl_req);

	return $contents;
}///end of functn curl File get contents


*/

?>

<!-- ******************* GETTING DISTANCE BETWEEN  PLACES FROM GOOGLE API ******************** -->
