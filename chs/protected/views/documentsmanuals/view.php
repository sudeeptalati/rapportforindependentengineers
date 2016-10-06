<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */

$this->breadcrumbs=array(
	'Documentsmanuals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Documentsmanuals', 'url'=>array('index')),
	array('label'=>'Create Documentsmanuals', 'url'=>array('create')),
	array('label'=>'Update Documentsmanuals', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Documentsmanuals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documentsmanuals', 'url'=>array('admin')),
);
?>

<h1>View Documentsmanuals #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_document_id',
		'name',
		'description',
		'brand_id',
		'product_type_id',
		'model_nos',
		'created',
		'created_by_user_id',
	),
)); ?>
