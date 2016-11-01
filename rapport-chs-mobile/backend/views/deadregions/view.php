<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Deadregions */

$this->title = $model->dead_id;
$this->params['breadcrumbs'][] = ['label' => 'Deadregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deadregions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dead_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dead_id], [
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
            'dead_id',
            'postcode:ntext',
            'product_type_name:ntext',
            'brand_name:ntext',
            'latitude',
            'longitude',
            'postcode_s',
            'postcode_e',
            'product_id',
            'manufacturer_id',
            'resolved',
            'ip_address',
            'date_logged',
        ],
    ]) ?>

</div>
