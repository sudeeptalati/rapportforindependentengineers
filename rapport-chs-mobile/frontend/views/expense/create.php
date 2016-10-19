<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Expense */

$this->title = 'Create Expense';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-create">


    <table style="width: ">
        <tr>
            <td style="width: 50%">
                <h1>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <?= Html::encode($this->title) ?>
                </h1>
            </td>
            <td style="width: 50%">
                <h4>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo Yii::$app->user->identity->username; ?>
                </h4>

            </td>
        </tr>
    </table>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
