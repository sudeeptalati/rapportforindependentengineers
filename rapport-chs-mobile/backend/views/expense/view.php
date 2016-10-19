<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Expense */

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
                    <h2>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <?php echo $model->userFullname; ?>
                    </h2>

                </td>
            </tr>
        </table>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [


                //'id',
                //'userFullname',
                'reference_number',
                'expense_title:ntext',
                'from_date',
                'to_date',
                [
                    'label' => 'Status',
                    'format' => 'raw',
                    'attribute' => 'statusName',
                ],
                'submission_date',
                'approval_date',

                [
                    'label' => 'Approved By',
                    'attribute' => 'approvedbyName',
                ],

                //'previous_balance',
                'total_spend',
                'amount_reimbursed',
                'created',
                'modified',
                'notes:ntext',
            ],
        ]) ?>


    </div>






<div id="dayexpenses">
    <?= $this->render('_dayexpenses', []); ?>
</div><!-- dayexpenses -->

<div style="float: left">
    <table>
        <tr>
            <td>
                <div>
                    <button id="showhideapprove" style="cursor: pointer;" class="btn btn-success">Approve</button>
                </div>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <div>
                    <button id="showhidereject" style="cursor: pointer;" class="btn btn-danger">Reject</button>
                </div>

            </td>
        </tr>
    </table>

</div>

<div id="approve" class="btn-success"
     style="display:none; padding:50px 100px; border-radius: 10px; width: 50%; float: right;" id="approve">
    <?= $this->render('_approve', ['model' => $model]); ?>
</div><!-- approve -->

<div id="reject" class="btn-danger"
     style="display:none; padding:50px 100px; border-radius: 10px; width: 50%; float: right;" id="approve">
    <?= $this->render('_reject', ['model' => $model]); ?>
</div><!-- reject -->

<?php
$this->registerJs("

     $('#showhideapprove').click(function(){
        $('#approve').toggle();
        $('#reject').hide();

    $('html, body').animate({
        scrollTop: $('#approve').offset().top
    }, 1000);



    });

    $('#showhidereject').click(function(){
        $('#reject').toggle();
        $('#approve').hide();

    $('html, body').animate({
        scrollTop: $('#reject').offset().top
    }, 1000);


    });




");


?>

