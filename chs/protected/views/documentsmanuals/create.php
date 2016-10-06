<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */

$this->breadcrumbs=array(
	'Documentsmanuals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Documentsmanuals', 'url'=>array('index')),
	array('label'=>'Manage Documentsmanuals', 'url'=>array('admin')),
);
?>

<h1>Create Documentsmanuals</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>