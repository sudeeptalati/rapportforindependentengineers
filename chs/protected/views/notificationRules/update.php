

<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



 
 
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>

<br>

<h3>Notification Rule# <?php echo $model->jobStatus->name; ?></h3>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'showDialogue'=>'0')); ?>