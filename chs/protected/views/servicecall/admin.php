<?php
include('servicecall_sidemenu.php');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('servicecall-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Manage Servicecalls</h1>


<?php $gridVar = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',

	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',
	'filter'=>$model,

	'columns'=>array(
		//'id',
		//'service_reference_number',
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
        ),
		//'customer_id',
		array('header' => 'Customer','name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('header' => 'Postcode','name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array(	'header' => 'Product',
            	'name'=>'product_name',
				'value'=>'$data->product->brand->name." ".$data->product->productType->name',
				'filter'=>false
				),
			
		array('name'=>'model_number','value'=>'$data->product->model_number'),
		array('name'=>'serial_number','value'=>'$data->product->serial_number'),
		
		//'contract_id',
		array('name'=>'contract_name','value'=>'$data->contract->name'),
		
		//'engineer_id',
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
	
	//	'created_by_user_id',
		
		array('header' => 'RaisedBy',
            	'name'=>'user_name','value'=>'$data->createdByUser->profile->lastname','filter'=>false),

			/*
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::published_item("JobStatus",$data->job_status_id)',
			'type'=>'raw',
			'filter'=>JobStatus::published_items('JobStatus'),
		),
		*/

		array(
			'name'=>'job_status_id',
			'value' => 'CHtml::link($data->jobStatus->html_name, array("Servicecall/view&id=".$data->id))',

			'filter'=>JobStatus::model()->getAllPublishedListdata(),
			'type'=>'raw',
		),


		array('name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)', 'filter'=>false),
		/*
		'insurer_reference_number',
		'job_status_id',
		'fault_date',
		'fault_code',
		'fault_description',
		'engg_diary_id',
		'work_carried_out',
		'spares_used_status_id',
		'total_cost',
		'vat_on_total',
		'net_cost',
		'job_payment_date',
		'job_finished_date',
		'notes',
		'created',
		'modified',
		'cancelled',
		'closed',
		*/
	 
		array(	 
		'header'=>'Raise a new Servicecall',
		'value' => 'CHtml::link("RAISE A NEW CALL", array("Servicecall/existingCustomer","customer_id"=>$data->customer_id,"product_id"=>$data->product_id))',
		'type'=>'raw',
		),
		
	),
));



//$i=0;
//foreach ($gridVar->dataProvider->data as $data)
//{
//
//echo "<br>reff no = ".$data->service_reference_number;
//
//$i++;
//}
//
//echo "<br>i = ".$i;

?>
