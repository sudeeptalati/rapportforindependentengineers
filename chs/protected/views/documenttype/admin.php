<?php
/* @var $this DocumenttypeController */
/* @var $model Documenttype */

$this->layout='column1';
//include(Yii::app()->request->baseUrl.'/protected/views/documentsmanuals/menu.php');

$this->renderPartial('//documentsmanuals/menu');


?>

<h1>Manage Document Types</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documenttype-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'info',
		array(
			'name'=>'category',
			'filter'=>$model->getdocumentcategory(),

					),

		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
