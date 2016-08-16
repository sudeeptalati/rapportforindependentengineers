<?php
/* @var $this MasterItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Master Items',
);

$this->menu=array(
	array('label'=>'Create MasterItems', 'url'=>array('create')),
	array('label'=>'Manage MasterItems', 'url'=>array('admin')),
);
?>

<h1>Master Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
