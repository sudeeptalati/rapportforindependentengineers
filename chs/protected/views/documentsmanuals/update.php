<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */

$this->layout='column1';

include('menu.php');
?>

<h1>Update Documents & Manuals# <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>