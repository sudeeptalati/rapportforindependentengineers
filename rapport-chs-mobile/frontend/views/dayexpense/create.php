<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Dayexpense */

$this->title = 'Expense details';
$this->params['breadcrumbs'][] = ['label' => 'Dayexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_expense', [
        'expenseModel' => $expenseModel,
    ]) ?>

    <?= $this->render('_form', [
        'model' => $model,'expense_id' => $expense_id,
    ]) ?>

</div>
