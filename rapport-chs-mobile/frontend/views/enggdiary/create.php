<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Enggdiary */

$this->title = 'Create Enggdiary';
$this->params['breadcrumbs'][] = ['label' => 'Enggdiaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enggdiary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
