
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>




<h3>Login from Other Devices</h3>

	<p class="attention	">
	If you want to access this rapport system from other devices like mobile phone, tablet or other PC, 
	open a new browser and point to the following url.
	</p>

<div class="media">
	<?php
	$url = gethostbyname(trim(`hostname`)).Yii::app()->baseUrl;
	$url="http://".$url;
	?>
	<a href="<?php echo $url ?>" target="_blank"><?php echo $url ?></a>
</div>

	


<img src="<?php echo Yii::app()->request->baseUrl.'/images/otherdevices.png';?>" width="350" height="250"/>






<small>
	<p class="attention">Conditions:<br>
		1. All Devices should be in same Wi-Fi network. Specially the Mobile phones and tablets are connected through WIFI and not 3G.<br>
		2. Check if firewall is not blocking this connection with other device. Check the firewall settings of the the current machine and routers.<br>
</small></p>

		