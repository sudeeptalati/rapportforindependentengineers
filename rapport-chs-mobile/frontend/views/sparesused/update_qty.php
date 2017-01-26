<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sparesused */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sparesused-form">

 <?php $form = ActiveForm::begin(); ?>
 
 
	<div class="mobile_content">
		<?php echo $model->item_name;?>
	</div>

	<div class="mobile_content">
		<?php echo $model->part_number;?>
	</div>
	<br>
	<table class="full_width">
		<tr>
			<td>
				<?= $form->field($model, 'quantity')->textInput() ?>
			</td>
			<td>
				<?= $form->field($model, 'unit_price')->textInput() ?>
			</td>
			<td>
				<?= $form->field($model, 'total_price')->textInput(['readonly'=>'readonly']) ?>
			</td>
		</tr>
	</table>

 
<!--
    <?= $form->field($model, 'master_item_id')->textInput() ?>

    <?= $form->field($model, 'servicecall_id')->textInput() ?>

    <?= $form->field($model, 'item_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'part_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'unit_price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'date_ordered')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'created_by_user')->textInput() ?>
    
    <?= $form->field($model, 'used')->textInput() ?>
-->
 <style>
 label {
   
  width:100px;
}
 </style>
	<?= $form->field($model, 'used')->radioList([ '0' => 'No', '1' => 'Yes',]); ?>



    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group" style="float:right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	
	<div style="float:left;">
        <?php $backurl=Yii::$app->request->referrer; ?>
        	 
        <a class="btn btn-info" href="<?php echo $backurl;?>" >
  			<i class="fa fa-long-arrow-left fa-lg"></i> Back
  		</a>
  
  
    </div>


    <?php ActiveForm::end(); ?>

</div>




<?php

 
$this->registerJs('


$("#sparesused-quantity" ).keyup(function() {
       calculatetotalprice();
	});
    
$("#sparesused-unit_price" ).keyup(function() {
       calculatetotalprice();
	});
    
    

function calculatetotalprice()
{
	qty=$("#sparesused-quantity" ).val();
	price=$("#sparesused-unit_price" ).val();
	
	spares_total_price=price*qty;
	
	$("#sparesused-total_price" ).val(spares_total_price);
	
}////end of function calculatetotalprice()



');

?>

