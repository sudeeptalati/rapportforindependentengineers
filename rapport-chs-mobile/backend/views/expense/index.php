<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


use backend\models\user;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Expenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1>
        <i class="fa fa-money" aria-hidden="true"></i>
        <?= Html::encode($this->title) ?>
    </h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return [ 'style' => "cursor: pointer",'data-id' => $model->id];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [
                'attribute' => 'userFullname',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select User']),

            ],

            'reference_number',
            'expense_title:ntext',
            //'from_date',
            // 'to_date',
            // 'status_id',




            // 'approval_date',
            // 'approved_by',
             'previous_balance',
             'total_spend',
             'amount_reimbursed',
            'submission_date',
            [
                'label'=>'Status',
                'format'=>'raw',
                'attribute'=>'statusName',
                'filter' => Html::activeDropDownList($searchModel, 'status_id', ArrayHelper::map(\frontend\models\Status::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Status']),

            ],
            // 'created',
            // 'modified',
            // 'notes:ntext',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = 'index.php?r=expense/view&id=' + id;

    });

");