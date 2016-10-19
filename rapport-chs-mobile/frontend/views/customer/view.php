<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

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
            'product_id',
            'title:ntext',
            'first_name:ntext',
            'last_name:ntext',
            'fullname:ntext',
            'address_line_1:ntext',
            'address_line_2:ntext',
            'address_line_3:ntext',
            'town:ntext',
            'postcode_s:ntext',
            'postcode_e:ntext',
            'postcode:ntext',
            'county:ntext',
            'state:ntext',
            'country:ntext',
            'latitudes:ntext',
            'longitudes:ntext',
            'telephone:ntext',
            'mobile:ntext',
            'fax:ntext',
            'email:ntext',
            'notes:ntext',
            'created_by_user_id',
            'created',
            'modified',
            'lockcode',
        ],
    ]) ?>

</div>
