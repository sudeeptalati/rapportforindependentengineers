<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/07/2016
 * Time: 11:19
 */

use yii\helpers\Html;

use yii\widgets\DetailView;
?>

    <table style="width: 100%">
        <tr>
            <td style="width: 50%">
                <h2>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <?= Html::encode($expenseModel->expense_title) ?>
                </h2>
            </td>
            <td style="width: 50%">
                <h4>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo Yii::$app->user->identity->username; ?>
                </h4>

            </td>
        </tr>
    </table>

<?= DetailView::widget([
    'model' => $expenseModel,
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
        //'submission_date',
        //'approval_date',
        //'approved_by',
        'total_spend',
        //'amount_reimbursed',
        //'previous_balance',
        'created',
        //'modified',
        'notes:ntext',
    ],
]) ?>