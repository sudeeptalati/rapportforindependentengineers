<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Dayexpense;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model frontend\models\Expense */

$this->title = $model->expense_title;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-view">


    <table style="width: 100%">
        <tr>
            <td style="width: 50%">
                <h1>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <?= Html::encode($this->title) ?>
                </h1>
            </td>
            <td style="width: 50%">
                <h4>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo Yii::$app->user->identity->username; ?>
                </h4>

            </td>
        </tr>
    </table>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php if ($model->total_spend!='0' || $model->total_spend!=''):  /// add form will be loaded in Draft or rejected status only?>
        <?= Html::a('Claim ₹', ['claimexpense', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to claim this expense. Once Expense is claimed you wil not be able to edit it.?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>


    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'reference_number',
            'expense_title:ntext',
            'from_date',
            'to_date',
            [
                'label'=>'Status',
                'format'=>'raw',
                'attribute'=>'statusName',
            ],
            //'status_id',
            'submission_date',
            'approval_date',
            'approved_by',
            'total_spend',
            'amount_reimbursed',
            'previous_balance',
            'created',
            'modified',
            'notes:ntext',
        ],
    ]) ?>


    <table style="width: 100%">
        <tr>
            <td style="width:33%">
                <h2>
                    <a id="showhide" style="cursor: pointer;">
                        <div id="onoffbtn" class="fa fa-toggle-on fa-2x"></div>
                    </a>
                </h2>
            </td>
            <td style="width:33%; text-align: center">
                <h2>
                    <span class="fa fa-list-ul"></span>
                    Details
                </h2>
            </td>
            <td style="width:33%">
                <div style="float:right;">
                    <?php if ($model->status_id<10):  /// add form will be loaded in Draft or rejected status only?>
                        <!--
                            <?= Html::a('<span title="Add More" class="fa fa-plus fa-2x"></span>', ['/dayexpense/create',  'expense_id' => $model->id], ['class' => 'btn btn-success']) ?>
                           -->
                        <a class="btn btn-success" href="#dayexpense-form"><span title="Add More" class="fa fa-plus fa-2x"></span>Add </a>
                    <?php endif; ?>
                </div>

            </td>
        </tr>
    </table>


    <div id="dayexpenses">
        <?php if($model->dayexpensesCount>= 1): ?>

              <?= $this->render('_dayexpenses', []);?>
        <?php endif; ?>


    </div><!-- dayexpenses -->

    <?php if ($model->status_id<10):  /// add form will be loaded in Draft or rejected status only?>

        <?php $newdayexpense= new Dayexpense(); ?>

        <?= $this->render('/dayexpense/_form', [
            'model' => $newdayexpense, 'expense_id' => $model->id,
        ]) ?>
    <?php endif; ?>

</div>




<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');

        if (id)
        {
            if(e.target == this)
                location.href = 'index.php?r=dayexpense/view&id=' + id;
        }
    });

     $('#showhide').click(function(){
        $('#expensedetailslist').toggle();

        var classnm=$('#onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-2x')
            $('#onoffbtn').removeClass('fa fa-toggle-on fa-2x').addClass('fa fa-toggle-off fa-2x');
        else
            $('#onoffbtn').removeClass('fa fa-toggle-off fa-2x').addClass('fa fa-toggle-on fa-2x');
    });

");


?>