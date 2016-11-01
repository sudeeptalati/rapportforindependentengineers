<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Documentsmanuals */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Documentsmanuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentsmanuals-view">

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
            'document_type_id',
            'name:ntext',
            'description:ntext',
            'brand_id',
            'product_type_id',
            'model_nos:ntext',
            'created',
            'created_by_user_id',
            'filename:ntext',
            'version:ntext',
            'active',
        ],
    ]) ?>

</div>
