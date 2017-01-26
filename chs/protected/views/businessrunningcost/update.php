<div id="sidemenu">
    <?php include('setup_sidemenu.php'); ?>
</div>
<?php
/* @var $this BusinessrunningcostController */
/* @var $model Businessrunningcost */

/*
$this->breadcrumbs=array(
	'Businessrunningcosts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Businessrunningcost', 'url'=>array('index')),
	array('label'=>'Create Businessrunningcost', 'url'=>array('create')),
	array('label'=>'View Businessrunningcost', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Businessrunningcost', 'url'=>array('admin')),
);
*/
?>

<h1>Update Business Running Cost</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>