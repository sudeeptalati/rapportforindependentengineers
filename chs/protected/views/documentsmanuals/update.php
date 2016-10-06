<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */

$this->breadcrumbs=array(
	'Documentsmanuals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documentsmanuals', 'url'=>array('index')),
	array('label'=>'Create Documentsmanuals', 'url'=>array('create')),
	array('label'=>'View Documentsmanuals', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Documentsmanuals', 'url'=>array('admin')),
);
?>

<h1>Update Documentsmanuals <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>