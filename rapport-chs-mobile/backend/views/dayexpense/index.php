<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DayexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dayexpenses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dayexpense-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Dayexpense'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'expense_id',
            'user_id',
            'date_of_spend',
            // 'reason:ntext',
            // 'spend_for_company:ntext',
            // 'company_address:ntext',
            // 'travel_from:ntext',
            // 'travel_to:ntext',
            // 'travel_mode:ntext',
            // 'total_travel_expense',
            // 'accomodation_details:ntext',
            // 'accomodation_expense',
            // 'breakfast_expense',
            // 'lunch_expense',
            // 'dinner_expense',
            // 'other_expense_details:ntext',
            // 'other_expense_amount',
            // 'total_expense',
            // 'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
