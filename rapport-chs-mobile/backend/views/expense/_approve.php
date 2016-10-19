<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 11/07/2016
 * Time: 14:50
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model->amount_reimbursed=$model->total_spend;
$model->status_id='30'; ///As 30 is the status Id for approval
$model->notes='Good Work Guys :)';
$model->approval_date=date('Y-m-d H:i:s');
$model->approved_by=Yii::$app->user->identity->id;

?>



<?php
$form = ActiveForm::begin([
    'id' => 'expense-form',
    'options' => ['class' => 'form-horizontal'],
    'action' => 'index.php?r=expense/approve&id='.$model->id,
]) ?>
<?= $form->field($model, 'amount_reimbursed')->textInput(['style' => 'width:50%;']) ?>
<?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <div>
        <?= Html::submitButton('Approve', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?= $form->field($model, 'status_id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'approval_date')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'approved_by')->hiddenInput()->label(false) ?>

<?php ActiveForm::end() ?>
