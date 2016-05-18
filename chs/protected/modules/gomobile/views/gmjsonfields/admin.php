
<?php include('gomobile_menu.php');  
 

$this->menu=array(
	array('label'=>'Create GmJsonFields', 'url'=>array('create')),
);

 
?>

<h2>Data Fields to be Sent</h2>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gm-json-fields-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'field_type',
		'field_relation',
		'field_label',
		'sort_order',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
			),
		/*
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}',
		),
	),
)); ?>
