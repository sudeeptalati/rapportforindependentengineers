<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ExpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-index">
    <h1>
        <i class="fa fa-money" aria-hidden="true"></i>
         <?= Html::encode($this->title) ?>
    </h1>
    <h2>Welcome <?php echo $loggedinuser->username; ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Expense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>

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

            'reference_number',
            'expense_title:ntext',
            //'from_date',
            // 'to_date',
            // 'status_id',
             'submission_date',
             'approval_date',
            // 'approved_by',
             'previous_balance',
             'total_spend',
             'amount_reimbursed',
             //'created',
            // 'modified',
             'notes:ntext',
            [
                'label'=>'Status',
                'format'=>'raw',
                'attribute'=>'statusName',
                'filter' => Html::activeDropDownList($searchModel, 'status_id', ArrayHelper::map(\frontend\models\Status::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Status']),

            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>


<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = 'index.php?r=expense/view&id=' + id;

    });

");