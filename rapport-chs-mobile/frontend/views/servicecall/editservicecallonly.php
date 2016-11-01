<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 21/10/2016
 * Time: 12:59
 */


use yii\widgets\ActiveForm;

use common\models\Customer;
use common\models\Handyfunctions;

use yii\helpers\Html;

?>


<div class="servicecall-form">

    <?php $form = ActiveForm::begin([
        'action' =>['servicecall/updateeditservicecallonly', 'servicecall_id'=>$servicecallmodel->id,'enggdiary_id'=>$enggdiary_id,  ],
        'id' => 'edit_servicecall',
        'method' => 'post',

    ]);
    ?>

    <table class="responsive-stacked-table">
        <tr>
            <td>
                <?= $form->field($servicecallmodel, 'work_carried_out')->textarea(['rows' => 6]) ?>
            </td>
            <td>
                <?= $form->field($servicecallmodel, 'notes')->textarea(['rows' => 6]) ?>
            </td>
        </tr>
    </table>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
