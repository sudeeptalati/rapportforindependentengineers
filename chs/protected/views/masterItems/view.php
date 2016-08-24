<?php
/* @var $this MasterItemsController */
/* @var $model MasterItems */

$this->breadcrumbs=array(
	'Master Items'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MasterItems', 'url'=>array('index')),
	array('label'=>'Create MasterItems', 'url'=>array('create')),
	array('label'=>'Update MasterItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MasterItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MasterItems', 'url'=>array('admin')),
);
?>

<h1>View MasterItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'part_number',
		'name',
		'description',
		'barcode',
		'category_id',
		'active',
		'image_url',
		'sale_price',
		'created',
		'modified',
	),
)); ?>
