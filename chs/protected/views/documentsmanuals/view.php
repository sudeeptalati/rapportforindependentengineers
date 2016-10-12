<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */


$this->layout='column1';
include('menu.php');
?>



<div style="float: right">
	<?php echo CHtml::link('<i class="fa fa-pencil-square-o fa-3x" aria-hidden="true"></i>',array('update', 'id'=>$model->id)); ?>

</div>
<h1>View Documents & Manuals# <?php echo $model->name; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'parent_document_id',
		array(               // related city displayed as a link
			'name'=>'document_type_id',
			//'type'=>'raw',
			'value'=>$model->document_type->name,
		),

		'name',
		'description',


		array(               // related city displayed as a link
			'name'=>'brand_id',
			//'type'=>'raw',
			'value'=>$model->brand->name,
		),
		array(               // related city displayed as a link
			'name'=>'product_type_id',
			//'type'=>'raw',
			'value'=>$model->product_type->name,
		),


		'model_nos',

		array(               // related city displayed as a link
			'name'=>'created',
			//'type'=>'raw',
			'value'=>date("d-M-Y H:i:s",$model->created),
		),
		array(               // related city displayed as a link
			'name'=>'created_by_user_id',
			//'type'=>'raw',
			'value'=>$model->created_by_user->username,
		),
		//'created_by_user_id',
		'filename',
		'version',
	),
)); ?>



<h3 id="filename_title">
	<?php echo $model->filename; ?>
</h3>



<?php
$preview_link=Yii::app()->request->baseUrl."/documents_manuals/".$model->filename;
$this->renderPartial('minipreview', array('preview_link'=>$preview_link));
?>
