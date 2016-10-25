<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentsmanualsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentsmanuals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentsmanuals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Documentsmanuals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'document_type_id',
            'name:ntext',
            'description:ntext',
            'brand_id',
            // 'product_type_id',
            // 'model_nos:ntext',
            // 'created',
            // 'created_by_user_id',
            // 'filename:ntext',
            // 'version:ntext',
            // 'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
