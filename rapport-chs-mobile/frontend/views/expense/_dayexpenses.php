<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/07/2016
 * Time: 09:38
 */


use yii\helpers\Html;
use frontend\models\Dayexpense;

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
////This is the expense id loaded from view of expenses
$expense_id=$_GET['id'];
$dayexpenses= Dayexpense::find()->where(['expense_id' => $expense_id, ])->orderBy(['created' => SORT_DESC]);


$dayexpenseDataProvider = new ActiveDataProvider([
    'query' => $dayexpenses,
    'pagination' => false
]);

?>


<div id="expensedetailslist" style="display: block;">

<?= GridView::widget([
    'dataProvider' => $dayexpenseDataProvider,
    'rowOptions'   => function ($model, $key, $index, $grid) {
        return [ 'style' => "cursor: pointer",'data-id' => $model->id];
    },

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        //'expense_id',
        //'user_id',
        'date_of_spend',
        'reason:ntext',
        'spend_for_company:ntext',
        /*
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
        */
        'total_expense',
        'created',
        //'modified',

        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'dayexpense'
        ],
    ],
]); ?>

</div>



