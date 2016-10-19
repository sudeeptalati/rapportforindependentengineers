<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/07/2016
 * Time: 09:38
 */


use frontend\models\Dayexpense;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

////This is the expense id loaded from view of expenses
$expense_id = $_GET['id'];
$dayexpenses = Dayexpense::find()->where(['expense_id' => $expense_id,])->orderBy(['created' => SORT_DESC]);


$dayexpenseDataProvider = new ActiveDataProvider([
    'query' => $dayexpenses,
    'pagination' => false
]);

$net_expense=0;
$count=1;
//echo "========".count($dayexpenses->all());
?>




<div>
    <table class="table table-striped table-bordered">
        <tr>
            <td colspan="9">
                <h4 style="text-align: center; margin: 30px 0px">
                    <span class="fa fa-money" aria-hidden="true"></span>
                    Expenses Details
                    <span class="fa fa-list-ul" aria-hidden="true"></span>
                </h4>

            </td>
        </tr>

        <tr>
            <th style="width:1%"></th>
            <th style="width:14%"></th>
            <th style="width:60%" colspan="3"></th>
            <th style="width:15%" colspan="3"></th>
            <th style="width:10%" colspan="4"></th>
        </tr>

        <tr>
            <th>#</th>
            <th>
                <div class="fa fa-calendar" aria-hidden="true"></div>
                Date
            </th>
            <th>Reason</th>
            <th>Company</th>
            <th>Address</th>
            <th>Travel From</th>
            <th>Travel To</th>
            <th>Travel Mode</th>
            <th>Total</th>
        </tr>
        <?php foreach ($dayexpenses->all() as $day): ?>

            <tr>
                <td> <?= $count ?></td>
                <td>
                    <?= $day->date_of_spend ?>
                </td>
                <td><?= $day->reason ?></td>
                <td><?= $day->spend_for_company ?></td>
                <td><?= $day->company_address ?></td>
                <td><?= $day->travel_from ?></td>
                <td><?= $day->travel_to ?></td>
                <td><?= $day->travel_mode ?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div title="Accomodation Expense" class="fa fa-bed" style="margin:0px 5px;"></div>
                    <br>
                    <div class="btn-success" style="border-radius:10px; padding: 5px;">
                        ₹ <?= $day->accomodation_expense ?>
                    </div>
                    <?= $day->accomodation_details ?>

                </td>
                <td colspan="3">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <div title="Breakfast" class="fa fa-coffee" style="margin:0px 20px;"></div>
                                <div class="btn-success" style="border-radius:10px; padding: 5px; margin:0px 15px">
                                    ₹ <?= $day->breakfast_expense ?>
                                </div>
                            </td>
                            <td>
                                <div title="Lunch" class="fa fa-sun-o" style="margin: 0px 20px;">
                                    <span class="fa fa-cutlery"></span>
                                </div>
                                <div class="btn-success" style="border-radius:10px; padding: 5px; margin:0px 15px">
                                    ₹ <?= $day->lunch_expense ?>
                                </div>
                            </td>
                            <td>
                                <div title="Dinner" class="fa fa-moon-o" style="margin: 0px 20px;">
                                    <span class="fa fa-cutlery"></span>
                                </div>
                                <div class="btn-success" style="border-radius:10px; padding: 5px; margin:0px 15px">
                                    ₹ <?= $day->dinner_expense ?>
                                </div>
                            </td>
                            <td>
                                <div title="Other Expenses" style="margin: 0px 20px;">
                                    <div class="fa fa-beer" aria-hidden="true"></div>
                                    <div class="fa fa-glass" aria-hidden="true"></div>
                                    <div class="fa fa-trophy" aria-hidden="true"></div>
                                </div>
                                <div class="btn-success" style="border-radius:10px; padding: 5px; margin:0px 15px">
                                    ₹ <?= $day->other_expense_amount ?>
                                </div>
                                <?= $day->other_expense_details ?>
                            </td>

                        </tr>
                    </table>
                </td>

                <td colspan="3">
                    <div style="margin:0px 20px" title="Travel Expense">
                        <span class="fa fa-motorcycle" aria-hidden="true"></span>
                        <span class="fa fa-bus" aria-hidden="true"></span>
                        <span class="fa fa-plane" aria-hidden="true"></span>
                        <span class="fa fa-taxi" aria-hidden="true"></span>
                        <span class="fa fa-ship" aria-hidden="true"></span>
                        <span class="fa fa-subway" aria-hidden="true"></span>
                        <span class="fa fa-truck" aria-hidden="true"></span>
                        <span class="fa fa-bicycle" aria-hidden="true"></span>
                        <span class="fa fa-blind" aria-hidden="true"></span>
                    </div>

                    <div class="btn-success" style="border-radius:10px; padding: 5px; margin:0px 15px">
                        &nbsp; &nbsp;₹ <?= $day->total_travel_expense ?>
                    </div>
                </td>

                <td>
                    <br>
                    <div class="btn-success" style="border-radius:10px; padding: 5px;">
                        ₹ <?= $day->total_expense ?>
                        <?php $net_expense=$net_expense+$day->total_expense; ?>
                    </div>
                </td>
            </tr>
            <?php $count++; ?>
        <?php endforeach; ?>

        <tr>
            <th colspan="7" style="text-align: right;"> Total Spend </th>
            <th style="width: 10%; text-align: right;" colspan="4">
                <div class="btn-success" style="border-radius:10px; padding: 5px;">
                    ₹ <?= $net_expense ?>
                </div>
            </th>
        </tr>
    </table>


</div>

<!-- DISABELD AS ABOVE VIEW is Created as this view was too long
<div id="expensedetailslist" style="display: block;">

    <?= GridView::widget([
    'dataProvider' => $dayexpenseDataProvider,
    'rowOptions' => function ($model, $key, $index, $grid) {
        return ['style' => "cursor: pointer", 'data-id' => $model->id];
    },

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

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
        // 'modified',

        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'dayexpense'
        ],
    ],
]); ?>

</div>
-->



