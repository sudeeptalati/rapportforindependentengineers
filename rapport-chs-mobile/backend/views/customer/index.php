<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer_id',
            'enquiry_number',
            'title',
            'first_name',
            'last_name',
            // 'line_1',
            // 'line_2',
            // 'line_3',
            // 'town',
            // 'county',
            // 'postcode',
            // 'email:email',
            // 'telephone',
            // 'cell',
            // 'preferred_contact_method',
            // 'product_id',
            // 'manufacturer_id',
            // 'technician_id',
            // 'model_number:ntext',
            // 'fault_description:ntext',
            // 'preferred_visit_date',
            // 'preferred_visit_time:ntext',
            // 'other_notes:ntext',
            // 'hear_about_us_dropdown',
            // 'hear_about_us_freetext',
            // 'ip_address',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
