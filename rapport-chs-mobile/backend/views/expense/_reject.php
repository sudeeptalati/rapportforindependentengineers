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
$model->status_id='5'; ///As 5 is the status Id for reject

?>



<?php
$form = ActiveForm::begin([
    'id' => 'expense-form',
    'options' => ['class' => 'form-horizontal'],
    'action' => 'index.php?r=expense/reject&id='.$model->id,
]) ?>
<?= $form->field($model, 'notes')->textarea(['rows' => 6, 'value' => '']) ?>

<div class="form-group">
    <div>
        <?= Html::submitButton('Reject', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?= $form->field($model, 'status_id')->hiddenInput()->label(false) ?>

<?php ActiveForm::end() ?>
