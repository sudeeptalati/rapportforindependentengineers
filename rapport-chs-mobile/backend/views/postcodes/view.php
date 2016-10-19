<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Postcodes */

$this->title = $model->postcode_id;
$this->params['breadcrumbs'][] = ['label' => 'Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postcodes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->postcode_id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'postcode_id',
            'postcode_s',
            'p_x',
            'p_y',
            'old_latitude',
            'old_longitude',
            'roundrobin',
        ],
    ]) ?>

</div>
