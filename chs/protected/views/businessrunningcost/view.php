<?php
/* @var $this BusinessrunningcostController */
/* @var $model Businessrunningcost */

$this->breadcrumbs=array(
	'Businessrunningcosts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Businessrunningcost', 'url'=>array('index')),
	array('label'=>'Create Businessrunningcost', 'url'=>array('create')),
	array('label'=>'Update Businessrunningcost', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Businessrunningcost', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Businessrunningcost', 'url'=>array('admin')),
);
?>

<h1>View Businessrunningcost #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cost_of',
		'weekly_cost',
		'monthly_cost',
		'yearly_cost',
		'daily_cost',
	),
)); ?>
