<?php
/* @var $this BusinessrunningcostController */
/* @var $model Businessrunningcost */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cost_of'); ?>
		<?php echo $form->textArea($model,'cost_of',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weekly_cost'); ?>
		<?php echo $form->textField($model,'weekly_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monthly_cost'); ?>
		<?php echo $form->textField($model,'monthly_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yearly_cost'); ?>
		<?php echo $form->textField($model,'yearly_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'daily_cost'); ?>
		<?php echo $form->textField($model,'daily_cost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->