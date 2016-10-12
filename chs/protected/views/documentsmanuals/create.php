<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */

include('menu.php');


$this->layout='column1';
?>

<h1>Upload Documents &  Manuals</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>