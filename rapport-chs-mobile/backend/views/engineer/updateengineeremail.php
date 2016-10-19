<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 21/09/2016
 * Time: 14:02
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>


<?php
/* parameterized initialization */
$form = ActiveForm::begin();
$form->id = 'update_engineer_email';
$form->action = Url::to(['engineer/updateengineeremailforlogin', 'engineer_id' => $engineer->id]);
$form->method = 'post';

?>


<?= Html::textInput('engineer_email', $user->email, ['style' => 'width:100%']); ?>

<?= Html::hiddenInput('engineer_id', $engineer->id); ?>
<?= Html::hiddenInput('user_id', $user->id); ?>

    <br>
    <br>
<?= Html::submitButton('@  Update Email ', ['class' => 'btn btn-success', 'style' => 'width:100%']) ?>

<?php ActiveForm::end(); ?>