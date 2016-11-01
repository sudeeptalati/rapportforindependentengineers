<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Producttype */

$this->title = 'Create Producttype';
$this->params['breadcrumbs'][] = ['label' => 'Producttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
