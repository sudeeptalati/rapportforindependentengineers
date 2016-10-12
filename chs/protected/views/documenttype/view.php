<?php
/* @var $this DocumenttypeController */
/* @var $model Documenttype */

$this->layout='column1';
$this->renderPartial('//documentsmanuals/menu');
?>

<h1>View Document Type #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'info',
	),
)); ?>
