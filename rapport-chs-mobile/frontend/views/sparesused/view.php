<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sparesused */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sparesuseds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sparesused-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'master_item_id',
            'servicecall_id',
            'item_name:ntext',
            'part_number:ntext',
            'unit_price',
            'quantity',
            'total_price',
            'date_ordered',
            'created',
            'modified',
            'created_by_user',
            'used',
            'notes:ntext',
        ],
    ]) ?>

</div>
