<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h3>Manage Notifications</h3>
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notification-rules-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'/id/"+$.fn.yiiGridView.getSelection(id);}',

	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'job_status_id',
		//array('name'=>'status_changed','value'=>'$data->jobStatus->name'),
			array(
					'name'=>'job_status_id',
					'value'=>'JobStatus::item("JobStatus",$data->job_status_id)',
					'filter'=>JobStatus::items('JobStatus'),
			),
		//'active',
			//'customer_notification_code',
		array('name'=>'customer_notification','value'=>'$data->customerNotificationCode->notify_by', 'filter'=>false),
		//'engineer_notification_code',
		array('name'=>'engineer_notification','value'=>'$data->engineerNotificationCode->notify_by', 'filter'=>false),
		//'warranty_provider_notification_code',
		array('name'=>'warranty_provider_notification','value'=>'$data->warrantyProviderNotificationCode->notify_by', 'filter'=>false),
		//'notify_others',
		array(
			'name'=>'notify_others',
			'value'=>'($data->notify_others == 0) ? "No" : "Yes"',
			'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		'frequency',

		array(
			'name'=>'active',
			'header'=>'Enabled',
			'value'=>'($data->active == 0) ? "No" : "Yes"',
			'filter'=>array('1'=>'Yes', '0'=>'No'),
		),


		/*
		'created',
		'modified',
		'delete',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>

