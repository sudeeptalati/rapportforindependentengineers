<?php
/* @var $this BusinessrunningcostController */
/* @var $data Businessrunningcost */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_of')); ?>:</b>
	<?php echo CHtml::encode($data->cost_of); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weekly_cost')); ?>:</b>
	<?php echo CHtml::encode($data->weekly_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_cost')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yearly_cost')); ?>:</b>
	<?php echo CHtml::encode($data->yearly_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('daily_cost')); ?>:</b>
	<?php echo CHtml::encode($data->daily_cost); ?>
	<br />


</div>