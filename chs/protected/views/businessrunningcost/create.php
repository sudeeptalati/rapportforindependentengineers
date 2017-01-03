<div id="sidemenu">
    <?php include('setup_sidemenu.php'); ?>
</div>
<?php
/* @var $this BusinessrunningcostController */
/* @var $model Businessrunningcost */

/*
$this->breadcrumbs=array(
	'Businessrunningcosts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Businessrunningcost', 'url'=>array('index')),
	array('label'=>'Manage Businessrunningcost', 'url'=>array('admin')),
);

*/
?>

<h1>Add Business Running Cost</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>