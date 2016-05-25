<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Tasks To Dos</h1>


<?php 
$email_sms_image=CHtml::image(Yii::app()->request->baseUrl.'/images/email-sms.png');
echo CHtml::link($email_sms_image ,array('/tasksToDo/completeTasks'));
?>

<div id="submenu">   
<li><?php echo CHtml::link('Perform Tasks',array('/tasksToDo/completeTasks')); ?></li>
<li><?php echo CHtml::link('Manage Tasks',array('/tasksToDo/admin')); ?></li>
<li><?php echo CHtml::link('Tasks Lifetime',array('/tasksToDo/tasksLifetime')); ?></li>
<li><?php echo CHtml::link('Notification Rules',array('/notificationRules/admin')); ?></li>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tasks-to-do-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'task',
		array(
			'name'=>'frequency_type',
			 'filter'=>array('daily'=>'Daily','weekly'=>'Weekly', 'monthly'=>'Monthly'),
		),
		'status',
		'msgbody',
		'subject',
		'send_to',

		array( 'name'=>'created', 'value'=>'$data->created=="" ? "":date("d-M-Y",$data->created)'),
		array( 'name'=>'scheduled', 'value'=>'$data->scheduled=="" ? "":date("d-M-Y",$data->scheduled)'),
		array( 'name'=>'executed', 'value'=>'$data->executed=="" ? "":date("d-M-Y",$data->executed)'),
		array( 'name'=>'finished', 'value'=>'$data->finished=="" ? "":date("d-M-Y",$data->finished)'),
		/*
		'created',
		'scheduled',
		'executed',
		'finished',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
