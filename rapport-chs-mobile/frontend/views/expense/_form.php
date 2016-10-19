<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Expense */
/* @var $form yii\widgets\ActiveForm */

$model->user_id = Yii::$app->user->identity->id;
$model->status_id= 1; ///as 1 is draft status

?>

<div class="expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--

    <?= $form->field($model, 'reference_number')->textInput() ?>


    <?= $form->field($model, 'submission_date')->textInput() ?>

    <?= $form->field($model, 'approval_date')->textInput() ?>

    <?= $form->field($model, 'approved_by')->textInput() ?>

    <?= $form->field($model, 'previous_balance')->textInput() ?>

    <?= $form->field($model, 'total_spend')->textInput() ?>

    <?= $form->field($model, 'amount_reimbursed')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

-->

    <?= $form->field($model, 'user_id')->textInput()->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'status_id')->textInput()->hiddenInput()->label(false); ?>


    <?= $form->field($model, 'expense_title')->textInput() ?>

    <table style="width: 100%">
        <tr>
            <td style="width:45%">
                <?= $form->field($model,'from_date')->widget(DatePicker::className(),['clientOptions' => [ 'dateFormat'=>'yy-mm-dd','defaultDate' => date('Y-m-d')]])->textInput(['placeholder' => 'From Date']) ?>
            </td>
            <td style="width:10%">

            </td>
            <td style="width:45%">
                <?= $form->field($model,'to_date')->widget(DatePicker::className(),['clientOptions' => [ 'dateFormat'=>'yy-mm-dd','defaultDate' => date('Y-m-d')]])->textInput(['placeholder' => 'From Date']) ?>
            </td>
        </tr>
    </table>







    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
