<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */



include('menu.php');


$this->layout='column1';


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documentsmanuals-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>




<h1>Manage Documents & Manuals</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documentsmanuals-grid',
	'dataProvider'=>$model->search(),

    'filter'=>$model,
	'columns'=>array(
		//'id',


        array(
            'header'=>'Preview',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/search.gif", "Preview",array("onclick"=>"show_doc_preview(\'$data->filename\')"))',


            'type'=>'raw',
            'filter'=>false
        ),



        array(
			'name'=>'document_type_id',
			'value' => '$data->document_type->name',
			'type'=>'raw',
			'filter'=>$model->getAllDocumenttypesforDropdown(),
		),


		'name',
		'description',

		array(
			'name'=>'product_type_id',
			'value' => '$data->product_type->name',
			'type'=>'raw',
			'filter'=>Product::model()->getProductTypes()
		),

		array(
			'name'=>'brand_id',
			'value' => '$data->brand->name',
			'type'=>'raw',
			'filter'=>Product::model()->getAllBrands()
		),

		'filename',

		'model_nos',
		array( 'name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y H:i:s",$data->created)', 'filter'=>false),

		array(
			'name'=>'created_by_user_id',
			'value' => '$data->created_by_user->username',
			'type'=>'raw',
			'filter'=>false
		),




		//'version',



		//'brand_id',
		//'product_type_id',
		/*
		'created_by_user_id',

		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    function show_doc_preview(rowid)
    {
        console.log("Show cdoc "+rowid);

        var src="<?php echo Yii::app()->request->baseUrl; ?>/documents_manuals/"+rowid;

		$("#img_preview_tag").attr("src", src);
		$("#new_window_link").attr("href", src);


        console.log("Show cdoc "+src);

        $( "#dialog" ).dialog( "open" );


    }





	$( function() {
		$( "#dialog" ).dialog({


            //minWidth: "800px",
			//minHeight: "800px",
			width:'auto',
		    modal:true,
			autoOpen: false,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#opener" ).on( "click", function() {
			$( "#dialog" ).dialog( "open" );
		});
	} );





</script>


<div id="dialog" title="Preview"  >
	<?php
	$preview_link=Yii::app()->request->baseUrl."/documents_manuals/".$model->filename;
	$this->renderPartial('minipreview', array('preview_link'=>$preview_link));

	?>
</div>

<!--
<button id="opener">Open Dialog</button>
-->