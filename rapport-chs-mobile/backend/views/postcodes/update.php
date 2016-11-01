<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Postcodes */

$this->title = 'Update Postcodes: ' . $model->postcode_id;
$this->params['breadcrumbs'][] = ['label' => 'Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->postcode_id, 'url' => ['view', 'id' => $model->postcode_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="postcodes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
