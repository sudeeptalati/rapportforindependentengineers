<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

$this->breadcrumbs=array(
	'Gm Servicecalls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GmServicecalls', 'url'=>array('index')),
	array('label'=>'Create GmServicecalls', 'url'=>array('create')),
	array('label'=>'Update GmServicecalls', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GmServicecalls', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GmServicecalls', 'url'=>array('admin')),
);
?>

<h1>View GmServicecalls #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'servicecall_id',
		'mobile_status',
		'created',
		'modified',
	),
)); ?>
