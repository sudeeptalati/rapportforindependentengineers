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
        <?= Html::a('Update', ['update', 'id' => $model->customer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customer_id], [
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
            'customer_id',
            'enquiry_number',
            'title',
            'first_name',
            'last_name',
            'line_1',
            'line_2',
            'line_3',
            'town',
            'county',
            'postcode',
            'email:email',
            'telephone',
            'cell',
            'preferred_contact_method',
            'product_id',
            'manufacturer_id',
            'technician_id',
            'model_number:ntext',
            'fault_description:ntext',
            'preferred_visit_date',
            'preferred_visit_time:ntext',
            'other_notes:ntext',
            'hear_about_us_dropdown',
            'hear_about_us_freetext',
            'ip_address',
            'created',
        ],
    ]) ?>

</div>
