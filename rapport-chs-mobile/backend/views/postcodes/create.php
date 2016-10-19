<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Postcodes */

$this->title = 'Create Postcodes';
$this->params['breadcrumbs'][] = ['label' => 'Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postcodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
