<?php
/* @var $this DocumentsmanualsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documentsmanuals',
);

$this->menu=array(
	array('label'=>'Create Documentsmanuals', 'url'=>array('create')),
	array('label'=>'Manage Documentsmanuals', 'url'=>array('admin')),
);
?>

<h1>Documentsmanuals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
