<?php
/* @var $this DocumenttypeController */
/* @var $model Documenttype */

$this->layout='column1';
$this->renderPartial('//documentsmanuals/menu');
?>

<h1>Update Document Type <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>