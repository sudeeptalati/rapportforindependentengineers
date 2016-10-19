<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DayexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dayexpenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dayexpense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
