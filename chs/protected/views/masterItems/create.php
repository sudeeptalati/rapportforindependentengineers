<?php
/* @var $this MasterItemsController */
/* @var $model MasterItems */

$this->breadcrumbs=array(
	'Master Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MasterItems', 'url'=>array('index')),
	array('label'=>'Manage MasterItems', 'url'=>array('admin')),
);
?>

<h1>Create MasterItems</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>