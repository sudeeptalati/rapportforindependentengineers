<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Servicecall */

$this->title = 'Create Servicecall';
$this->params['breadcrumbs'][] = ['label' => 'Servicecalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicecall-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
