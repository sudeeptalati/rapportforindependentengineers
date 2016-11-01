<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sparesused */

$this->title = 'Create Sparesused';
$this->params['breadcrumbs'][] = ['label' => 'Sparesuseds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sparesused-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
