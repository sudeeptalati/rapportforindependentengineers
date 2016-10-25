<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 24/10/2016
 * Time: 17:35
 */


use yii\widgets\ActiveForm;

use common\models\Emailservicecall;

use yii\helpers\Html;


$emailservicecall=new Emailservicecall();
$emailservicecall->email=$servicecallmodel->customer->email;

$emailservicecall->servicecall_id=$servicecallmodel->id;
?>
<br>
<div class="email-servicecall-form note contentbox" >

    <?php $form = ActiveForm::begin([
        'action' =>['servicecall/emailservicecall' ],
        'id' => 'email_servicecall',
        'method' => 'post',

    ]);
    ?>
    <br>
    <?= $form->field($emailservicecall, 'email')->textInput(['placeholder'=>'Please enter an email address'])->label(false); ?>
    <?= $form->field($emailservicecall, 'servicecall_id')->hiddenInput()->label(false); ?>

    <table class="full_width">
        <tr>
            <td>
                <?= $form->field($emailservicecall, 'jobsheet')->checkbox() ?>
                <i class="" aria-hidden="true"></i>

            </td>
            <td>
                <?= $form->field($emailservicecall, 'invoice')->checkbox() ?>
            </td>
        </tr>
    </table>




    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-paper-plane" aria-hidden="true"></i>
 Send', ['class' => 'btn btn-info full_width']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
