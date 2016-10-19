<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Dayexpense */

$this->title = 'Dayexpense:  ' . $model->reason;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['expense/index']];
$this->params['breadcrumbs'][] = ['label' => $model->expense->expense_title, 'url' => ['expense/view', 'id' => $model->expense_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-update">

    <h1><?= Html::encode($this->title) ?></h1>





    <?= $this->render('_expense', [
        'expenseModel' => $expenseModel,
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,'expense_id' => $expense_id,
    ]) ?>

</div>
