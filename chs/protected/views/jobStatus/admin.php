<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Job Status : Manage</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/dashboardorder'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->

 


 

 
<?php 


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		//'name',
		array(	'name'=>'name',
				//'value' => 'CHtml::link($data->name, array("jobStatus/update&id=".$data->id))',
            'value' => 'CHtml::link($data->name, array("jobstatus/update&id=".$data->id), array("target"=>"_blank") )',
		 		'type'=>'raw',
        ),
		
		'keyword',
		
		'information',

	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		//'view_order',
    	
    	array(
      		'name'=>'dashboard_display',
      		'value'=>'$data->dashboard_display ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),



		array(	'name'=>'html_name',

			'type'=>'raw',
		),
		/*
		
		'updated_by_user_id',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}	{update}',
		),
	),
)); 

?>
 




