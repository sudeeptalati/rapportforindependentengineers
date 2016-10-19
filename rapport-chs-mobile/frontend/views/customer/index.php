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

            'id',
            'product_id',
            'title:ntext',
            'first_name:ntext',
            'last_name:ntext',
            // 'fullname:ntext',
            // 'address_line_1:ntext',
            // 'address_line_2:ntext',
            // 'address_line_3:ntext',
            // 'town:ntext',
            // 'postcode_s:ntext',
            // 'postcode_e:ntext',
            // 'postcode:ntext',
            // 'county:ntext',
            // 'state:ntext',
            // 'country:ntext',
            // 'latitudes:ntext',
            // 'longitudes:ntext',
            // 'telephone:ntext',
            // 'mobile:ntext',
            // 'fax:ntext',
            // 'email:ntext',
            // 'notes:ntext',
            // 'created_by_user_id',
            // 'created',
            // 'modified',
            // 'lockcode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
