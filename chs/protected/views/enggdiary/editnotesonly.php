<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 05/07/2016
 * Time: 11:05
 */


$service_id = $_GET['id'];
$servicecallModel = Servicecall::model()->findByPk($service_id);
$diary_id = $servicecallModel->engg_diary_id;

$notes=$servicecallModel->enggdiary->notes;

$diarymodel = Enggdiary::model()->findByPk($diary_id);


$actionurl=Yii::app()->createUrl('/enggdiary/editnotesonly', array('diary_id' => $diary_id));

?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'editnotesonly-form',
        'action' => $actionurl,

    )); ?>


    <?php echo $form->errorSummary($diarymodel); ?>

    <div class="row">
        <?php echo $form->label($diarymodel,'notes'); ?>
        <?php echo $form->textArea($diarymodel, 'notes');?>
    </div>

    <?php echo $form->hiddenField($diarymodel,'id'); ?>

    <div class="row submit">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->