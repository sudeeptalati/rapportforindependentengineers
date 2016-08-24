<?php
/* @var $this MasterItemsController */
/* @var $model MasterItems */

$this->breadcrumbs=array(
	'Master Items'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MasterItems', 'url'=>array('index')),
	array('label'=>'Create MasterItems', 'url'=>array('create')),
	array('label'=>'View MasterItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MasterItems', 'url'=>array('admin')),
);
?>

<h1>Update Master Items</h1>
<h2> <?php echo $model->name; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>