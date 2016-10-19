<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Dayexpense */
$this->title = 'Dayexpense:  ' . $model->reason;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['expense/index']];
$this->params['breadcrumbs'][] = ['label' => $model->expense->expense_title, 'url' => ['expense/view', 'id' => $model->expense_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= $this->render('_expense', [
        'expenseModel' => $expenseModel,
    ]) ?>

    <h2><span class="fa fa-list-ul"></span> Detail</h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'expense_id',
            //'user_id',
            'date_of_spend',
            'reason:ntext',
            'spend_for_company:ntext',
            'company_address:ntext',
            'travel_from:ntext',
            'travel_to:ntext',
            'travel_mode:ntext',
            'total_travel_expense',
            'accomodation_details:ntext',
            'accomodation_expense',
            'breakfast_expense',
            'lunch_expense',
            'dinner_expense',
            'other_expense_details:ntext',
            'other_expense_amount',
            'total_expense',
            'created',
            'modified',
        ],
    ]) ?>

</div>
