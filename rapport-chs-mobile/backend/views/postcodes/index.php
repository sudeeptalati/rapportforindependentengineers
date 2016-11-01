<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostcodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postcodes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Postcodes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'postcode_id',
            'postcode_s',
            'p_x',
            'p_y',
            'old_latitude',
            // 'old_longitude',
            // 'roundrobin',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{update}',],
        ],
    ]); ?>
</div>
