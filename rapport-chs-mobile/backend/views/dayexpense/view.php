<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Dayexpense */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dayexpenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'expense_id',
            'user_id',
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
