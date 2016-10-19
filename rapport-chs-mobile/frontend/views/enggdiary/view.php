<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Enggdiary */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enggdiaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enggdiary-view">

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
            'engineer_id',
            'visit_start_date',
            'visit_end_date',
            'slots',
            'servicecall_id',
            'user_id',
            'created',
            'modified',
            'status',
            'notes:ntext',
        ],
    ]) ?>

</div>
