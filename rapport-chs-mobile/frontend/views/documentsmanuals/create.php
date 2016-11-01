<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Documentsmanuals */

$this->title = 'Create Documentsmanuals';
$this->params['breadcrumbs'][] = ['label' => 'Documentsmanuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentsmanuals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
